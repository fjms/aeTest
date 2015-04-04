<?php

session_start();
require './tcpdf/tcpdf.php';
require './scripts/bdutil.php';

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
// Logo
        $image_file = './bootstrap/img/olavide.jpg';
        $this->Image($image_file, 10, 10, 50, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
// Set font
        $this->SetY(25);
        $this->SetFont('helvetica', 'B', 20);
// Title
        $this->Cell(0, 15, 'Tarjeta Identificativa aeTest', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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

if (!isset($_SESSION['pdf'])) {
    header('Location: index.php');
} else {
//Limpio buffer de salida
    ob_end_clean();
// Crear el documento
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('aeTest App');
    $pdf->SetTitle('aeTest');
    $pdf->SetSubject('Coordenadas de usuario');
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
    $pdf->writeHTML('<br/><br/><br/><h3>Matriz de coordenadas</h3><br/><br/>', true, false, true, false, '');
    $letras = [" C1", "  C2 ", "C3", " C4 ", " C5", " C6 ", " C7", " C8"];
//$letras = ["0 ", " 1 ", " 2 ", "3 ", "4 ", "5 ", "6 ", "7 "];
    $num = 1;
    $cont = 0;
    $pdf->Write(0, "         ", '', false, 'C', false, 0, true, true, 0);
    foreach ($letras as $x) {
        $pdf->Write(0, $x . "   ", '', false, 'C', false, 0, true, true, 0);
    }
    $j = 0;
    $matriz = $_SESSION['pdf'];

    foreach ($matriz as $i) {
        if ($j == 0 || $j == 8 || $j == 16 || $j == 24 || $j == 32 || $j == 40 || $j == 48 || $j == 56 || $j == 64) {
            $fila = ($j / 8) + 1;
            $pdf->writeHTML("\n", true, 0, true, 0);
            $pdf->Write(0, 'F' . $fila . "     ", '', false, 'C', false, 0, true, true, 0);
        }
        $pdf->Write(0, $i . "   ", '', false, 'C', false, 0, true, true, 0);
        $j = $j + 1;
    }
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
//Cerramos y damos salida al fichero PDF
    $pdf->Output('nombre.pdf', 'I');
    //Eliminar variable session
}
