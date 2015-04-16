<?php

require './segAlu.php';
require './bdutil.php'; // RedBeanPHP 4.1.4


$aErrores = [];

if (isset($_POST['id_examen'])) {

    if (empty($_POST['id_examen'])) {
        header('Location: ../alum/doexam.php');
    } else { //validamos el campo tiene que ser un numero y obtenemos el examen de la bd
        if (filter_var($_POST['id_examen'], FILTER_VALIDATE_INT) === false) {
            header('Location: ../alum/doexam.php');
        } else {
            $id_examen = $_POST['id_examen'];
            $examen = R::load('examen', $id_examen);
            //Generamos un resultado cada vez que se intenta un examen (cuenta como convocatoria)
            $resultado = R::dispense('resultado');
            $usuario = R::load('user', $_SESSION['id_usuario']);
            $resultado->user = $usuario; //Many to One
            $resultado->examen = $examen; //Many to One
            $resultado->fecha = R::isoDate();
            $resultado->p_correctas = 0;
            $resultado->p_incorrectas = 0;
            $resultado->p_nocontestadas = 10;
            $resultado->nota = 0;
            $resultado->estado = 'no_firmado';
            $repetidos = array();
            $i = 1;
            while ($i <= 10) {
                $id_pregunta = rand(1, 40);
                if (in_array($id_pregunta, $repetidos)) {//Si esta repetido
                } else { //Si no esta repetido
                    $i++;
                    array_push($repetidos, $id_pregunta);
                    $pregunta = R::load('preguntayrespuesta', $id_pregunta);
                    $pregunta->sharedResultadoList[] = $resultado; // Crea tabla intermedia resultado_preguntayrespuesta
                    R::store($pregunta);
                }
            }
            $_SESSION['id_resultado'] = R::store($resultado);
            header('Location: ../alum/exam.php');
        }
    }
} else {
    header('Location: ../alum/doexam.php');
}


