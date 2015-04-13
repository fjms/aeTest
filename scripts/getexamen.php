<?php

require './segAlu.php';
require './bdutil.php'; // RedBeanPHP 4.1.4

if (isset($_SESSION['id_resultado'])) {
    $resultado = R::load('resultado', $_SESSION['id_resultado']);
    if ($resultado->estado === 'iniciado') {
        $id_examen = $resultado->examen_id;
        $exam = R::load('examen', $id_examen);
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
            echo '</div><div class="panel-footer">'
            . '<label>Respuesta:&nbsp;</label>'
            . '<label class="radio-inline">'
            . '<input type="radio" name="respuesta' . $i . '" value="a">A'
            . '</label>'
            . '<label class="radio-inline">'
            . '<input type="radio" name="respuesta' . $i . '" value="b">B'
            . '</label>'
            . '<label class="radio-inline">'
            . '<input type="radio" name="respuesta' . $i . '" value="c">C'
            . '</label>'
            . '<label class="radio-inline">'
            . '<input type="radio" name="respuesta' . $i . '" value="d">D'
            . '</label>'
            . '</div></div>';
            $i++;
        }
        echo '<button class="btn btn-outline btn-primary btn-group-justified" type="submit">Finalizar examen</button>';
    } else {
        echo '<div class="alert alert-danger">El examen ha finalizado.</div>';
    }
}