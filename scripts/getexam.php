<?php

require './segAdmin.php';
require './bdutil.php'; // RedBeanPHP 4.1.4

if (isset($_GET['q'])) {
    $id = $_GET['q']; //Validar
    
    $exam = R::load('examen', $id);
//echo json_encode($exam->sharedPreguntayrespuestaList);
    $i = 1;
    foreach ($exam->sharedPreguntayrespuestaList as $pregunta) {
        echo '<div class="panel panel-primary"><div class="panel-heading">';
        echo $i . '.&nbsp;' . $pregunta->pregunta;
        echo '</div><div class="panel-body">';
        echo 'A.&nbsp;' . $pregunta->respuesta1;
        echo '<br>';
        echo 'B.&nbsp;' . $pregunta->respuesta2;
        echo '<br>';
        echo 'C.&nbsp;' . $pregunta->respuesta3;
        echo '<br>';
        echo 'D.&nbsp;' . $pregunta->respuesta4;
        echo '</div></div>';
        $i++;
    } 
}
