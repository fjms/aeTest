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
            $_SESSION['id_examen'] = $id_examen;
            header('Location: ../alum/exam.php');
        }
    }
} else {
    header('Location: ../alum/doexam.php');
}


