<?php

/*
 *  Recibe las respuestas del examen del alumno y le asigna una nota.
 */

require './segAlu.php';
require './bdutil.php'; // RedBeanPHP 4.1.4

if (isset($_POST['enviar'])) {
    $resultado_alumno = R::load('resultado', $_SESSION['id_resultado']);

    $id_examen = $resultado_alumno->examen_id;
    $exam = R::load('examen', $id_examen);

    $respuestas_alumno = [];
    $num_correctas = 0;
    $num_nocontestadas = 0;
    $i = 1;
    foreach ($exam->sharedPreguntayrespuestaList as $pregunta) {

        $solucion = $pregunta->correcta;
        if (isset($_POST['respuesta' . $i])) {
            $respuestas_alumno[] = $_POST['respuesta' . $i];
        } else {
            $respuestas_alumno[] = 'x'; // Se considera respuesta en blanco
            $num_nocontestadas++;
        }
        if (isset($_POST['respuesta' . $i]) && $_POST['respuesta' . $i] === $solucion) {
            $num_correctas++;
        }
        $i++;
    }

    $num_incorrectas = 10 - $num_correctas - $num_nocontestadas;
    $resultado_alumno->p_correctas = $num_correctas;
    $resultado_alumno->p_incorrectas = $num_incorrectas;
    $resultado_alumno->p_nocontestadas = $num_nocontestadas;
    $resultado_alumno->nota = $num_correctas - ((1 / 3.0) * $num_incorrectas);
    $resultado_alumno->estado = 'finalizado';
    $resultado_alumno->respuestas = json_encode($respuestas_alumno);
    R::store($resultado_alumno);
    header('Location: ../alum/resultadoexamen.php');
} else {
    header('Location: ../index.php');
}

