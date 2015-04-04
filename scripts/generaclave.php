<?php
session_start();
require './bdutil.php';

function generaclave(&$repetido) {
    $i = 1;
    $repetido = [];
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
   /* 
    for($i=1;$i<=64;$i++){
        echo $claves[$i-1].'-';
        if($i%8 == 0){
            echo '<br>';
        }
    }
    */
} else {
    header('Location: ../coordenadas.php');
}
