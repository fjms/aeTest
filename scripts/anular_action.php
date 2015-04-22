<?php

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
        
        $this->Cell(0, 15, 'Renuncia ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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

$examenes = R::findAll('examen');
$anulacion = R::findOne('anulacion', 'user_id = ?', [$_SESSION['id_usuario']]);

if (empty($anulacion)) {
    $anulacion = R::dispense('anulacion');
    $anulacion->user = R::load('user', $_SESSION['id_usuario']);
}
$filenames = [];
foreach ($examenes as $examen) {
    $anulacion->sharedExamenList[] = $examen;
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
    $user = R::load('user', $_SESSION['id_usuario']);
    $html = '<br><br><br><br><br><p>YO, ' . $user->nombre . ' ' . $user->apellidos . ' con DNI ' . $_SESSION['dni'] . ', manifiesto mi deseo de no realizar el examen ' . $examen->nombre . '.</p>';
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
    $name = 'AN-'.sha1($_SESSION['dni']) . "-" . $examen->id . ".pdf";
    $filelocation = "C:\\xampp\\htdocs\\aeTest\\examenes";
    //Linux
    //$filelocation = "/var/www/aeTest/examenes";
    $fileNL = $filelocation . "\\" . $name;
    $pdf->Output($fileNL, 'F');
    $filenames[] = $name;
}
$_SESSION['filenames'] = $filenames;

R::store($anulacion);

header('Location: ../viafirma/firmaLote.php');
