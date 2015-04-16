<?php

/*
 *  Recibe las respuestas del examen del alumno y le asigna una nota.
 */

require './segAlu.php';
require './bdutil.php'; // RedBeanPHP 4.1.4

if (isset($_POST['enviar'])) {
    
    $resultado = R::load('resultado', $_SESSION['id_resultado']);
    $respuestas_alumno = [];
    $num_correctas = 0;
    $num_nocontestadas = 0;
    $i = 1;
    foreach ($resultado->sharedPreguntayrespuestaList as $pregunta) {
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
    $resultado->p_correctas = $num_correctas;
    $resultado->p_incorrectas = $num_incorrectas;
    $resultado->p_nocontestadas = $num_nocontestadas;
    $resultado->nota = $num_correctas - ((1 / 3.0) * $num_incorrectas);
    $resultado->respuestas = json_encode($respuestas_alumno);
    $_SESSION['id_resultado'] = R::store($resultado);
    //GENERAR PDF
    
    header('Location: ../alum/resultadoexamen.php');
} else {
    header('Location: ../index.php');
}

