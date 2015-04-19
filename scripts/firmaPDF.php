<?php

require './segAlu.php';
require './bdutil.php'; // RedBeanPHP 4.1.4
require '../tcpdf/tcpdf.php';


if (isset($_POST['enviar']) && isset($_SESSION['id_resultado'])) {
    header('Location: ../viafirma/firma.php');
} else {
    header('Location: ../alum/alumno.php');
}

