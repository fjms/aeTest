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
            $resultado = R::dispense('resultado'); //Entidad Intermedia USUARIO_EXAMEN = RESULTADO
            $usuario = R::load('user', $_SESSION['id_usuario']);
            $resultado->user = $usuario; //Many to One
            $resultado->examen = $examen; //Many to One
            $resultado->fecha = R::isoDate();
            $_SESSION['id_resultado'] = R::store($resultado);
            header('Location: ../alum/exam.php');
        }
    }
} else {
    header('Location: ../alum/doexam.php');
}


