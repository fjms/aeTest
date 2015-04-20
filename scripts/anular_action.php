<?php
require './segAlu.php';
require './bdutil.php'; // RedBeanPHP 4.1.4

$examenes = R::findAll('examen');
$anulacion =  R::dispense( 'anulacion' );
$anulacion->user = R::load('user', $_SESSION['id_usuario']);
foreach ($examenes as $examen) {
    $anulacion->sharedExamenList[]=$examen;
}


R::store($anulacion);
