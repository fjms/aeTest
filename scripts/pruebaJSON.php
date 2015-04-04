<?php
require './bdutil.php';

$examenes = R::findAll( 'examen' );
$datos = R::exportAll($examenes, FALSE, array('examen'));

/*
$c = count($examenes);
$data =[
    "draw"=>6,
    "recordsTotal"=> $c,
    "recordsFiltered"=>$c,
    "data"=> $datos
];*/
echo json_encode($datos);
