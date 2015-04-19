<?php

/*
 *  Recibe las respuestas del examen del alumno y le asigna una nota.
 */

require './segAlu.php';
require './bdutil.php'; // RedBeanPHP 4.1.4
require '../tcpdf/tcpdf.php';

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
// Logo
        $image_file = '../bootstrap/img/olavide.jpg';
        $this->Image($image_file, 10, 10, 50, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
// Set font
        $this->SetY(25);
        $this->SetFont('helvetica', 'B', 20);
// Title
        $resultado = R::load('resultado', $_SESSION['id_resultado']);
        $this->Cell(0, 15, 'Examen ' . $resultado->examen->nombre, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom

        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 10);
        // Page number
        $usuario = R::load('user', $_SESSION['id_usuario']);

        $this->Cell(0, 10, 'Usuario: ' . $usuario->nombre . ' ' . $usuario->apellidos, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

}

if (isset($_POST['enviar'])) {
    
    $resultado = R::load('resultado', $_SESSION['id_resultado']);
    $respuestas_alumno = [];
    $num_correctas = 0;
    $num_nocontestadas = 0;
    $i = 1;
    foreach ($resultado->sharedPreguntayrespuestaList as $pregunta) {
        $solucion = $pregunta->correcta;
        if (isset($_POST['respuesta' . $i])) {
            $respuestas_alumno[] = $_POST['respuesta' . $i];
        } else {
            $respuestas_alumno[] = 'x'; // Se considera respuesta en blanco
            $num_nocontestadas++;
        }
        if (isset($_POST['respuesta' . $i]) && $_POST['respuesta' . $i] === $solucion) {
            $num_correctas++;
        }
        $i++;
    }
    $num_incorrectas = 10 - $num_correctas - $num_nocontestadas;
    $resultado->p_correctas = $num_correctas;
    $resultado->p_incorrectas = $num_incorrectas;
    $resultado->p_nocontestadas = $num_nocontestadas;
    $resultado->nota = $num_correctas - ((1 / 3.0) * $num_incorrectas);
    $resultado->respuestas = json_encode($respuestas_alumno);
    $_SESSION['id_resultado'] = R::store($resultado);
    //GENERAR PDF
    //Limpio buffer de salida
    ob_end_clean();
// Crear el documento
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('aeTest App');
    $pdf->SetTitle('aeTest');
    $pdf->SetSubject('Resultados de usuario');
    $pdf->SetKeywords('TCPDF, PDF, palabras, claves');
// Contenido de la cabecera
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// Fuente de la cabecera y el pie de página
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// Márgenes
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// Saltos de página automáticos.
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// Establecer el ratio para las imagenes que se puedan utilizar
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// Establecer la fuente
    $pdf->SetFont('helvetica', 'BI', 12);
// Añadir página
    $pdf->AddPage();
    //$pdf->writeHTML('<br/><br/><br/><h3>Resultados del examen</h3><br/><br/>', true, false, true, false, '');
    $resultado = R::load('resultado', $_SESSION['id_resultado']);
    $respuestas = json_decode($resultado->respuestas);
    $html = '<br><br><br><br><h3>Resultados</h3><table border="1"><thead><tr><th>Pregunta</th><th>Respuesta</th></tr></thead><tbody>';
    for ($i = 0; $i < 10; $i++) {
        $n = $i + 1;
        $html = $html . '<tr><th>' . $n . '</th><th>' . $respuestas[$i] . '</th></tr>';
    }
    $html = $html . '</tbody></table><span>Nota: ' . $resultado->nota . '</span>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// Fuente de la cabecera y el pie de página
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// Márgenes
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// Saltos de página automáticos.
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// Establecer el ratio para las imagenes que se puedan utilizar
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// Establecer la fuente
    $pdf->SetFont('times', 'BI', 16);
    //CREAMOS PDF
    $name = sha1($_SESSION['dni']) . "-" . date('YmdHis') . ".pdf";
    $filelocation = "C:\\xampp\\htdocs\\aeTest\\examenes";
    //Linux
    //$filelocation = "/var/www/aeTest/examenes";
    $fileNL = $filelocation . "\\" . $name;
    $pdf->Output($fileNL, 'F');
    $_SESSION['filename'] = $name;
    
    
    header('Location: ../alum/resultadoexamen.php');
} else {
    header('Location: ../index.php');
}

