<?php
session_start();
require './bdutil.php';

function generaclave(&$repetido) {
    $i = 1;
    $claves = rand(100, 999);
    $repetido[] = $claves;
    while ($i < 64) {
        $num = rand(100, 999);
        if (!in_array($num, $repetido)) {
            $repetido[] = $num;
            $claves = $claves . ',' . $num;
            $i++;
        }
    }
    return $claves;
}

if (isset($_SESSION['id_usuario']) && isset($_POST['enviar'])) {
    $claves =[];
    $clave = generaclave($claves);
    $alu = R::load('user', $_SESSION['id_usuario']);
    $alu->password = $clave;
    R::store($alu);
    $_SESSION['pdf']=$claves;
    header('Location: ../imprimirPDF.php');
} else {
    header('Location: ../coordenadas.php');
}
