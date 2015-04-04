<?php

require './segAdmin.php';
require './bdutil.php'; // RedBeanPHP 4.1.4

if (isset($_GET['q'])) {
    $id = $_GET['q']; //Validar
    $exam = R::load('examen', $id);
    $i = 1;
    echo '<div class="panel-heading">Respuestas Correctas</div><div class="panel-body">';
    foreach ($exam->sharedPreguntayrespuestaList as $pregunta) {

        echo $i . '.&nbsp;' . strtoupper($pregunta->correcta) . '<br>';
        $i++;
    }
    echo '</div>';
}
