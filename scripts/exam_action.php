<?php

require './segAlu.php';
require './bdutil.php'; // RedBeanPHP 4.1.4


$resultado_alumno = R::load('resultado', $_SESSION['id_resultado']);

$id_examen = $resultado_alumno->examen_id;
$exam = R::load('examen', $id_examen);

$respuestas_alumno = [];
$num_correctas = 0;
$i=1;
foreach ($exam->sharedPreguntayrespuestaList as $pregunta) {
    
    $solucion = $pregunta->correcta;
    if(isset($_POST['respuesta' . $i])){
        $respuestas_alumno[]= $_POST['respuesta' . $i];
    } else {
        $respuestas_alumno[]= 'x'; // Se considera respuesta en blanco
    }
    if(isset($_POST['respuesta' . $i]) && $_POST['respuesta' . $i] === $solucion){
        $num_correctas++;
    }
    $i++;
}
$resultado_alumno->nota = $num_correctas;
$resultado_alumno->estado = 'finalizado';
$resultado_alumno->respuestas = json_encode($respuestas_alumno);
R::store($resultado_alumno);


