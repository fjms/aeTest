<?php

require './segAlu.php';
require './bdutil.php'; // RedBeanPHP 4.1.4


$aErrores = [];

if (isset($_POST['id_examen']) && isset($_POST['password_examen'])) {

    if (empty($_POST['id_examen'])) {
        header('Location: ../alum/doexam.php');
    } else { //validamos el campo tiene que ser un numero y obtenemos el examen de la bd
        if (filter_var($_POST['id_examen'], FILTER_VALIDATE_INT) === false) {
            header('Location: ../alum/doexam.php');
        } else {
            $id_examen = $_POST['id_examen'];
            $examen = R::load('examen', $id_examen);
        }
    }
    if (empty($_POST['password_examen'])) {
        header('Location: ../alum/doexam.php');
    } else { // saneamos entrada cadena y vemos si coincide con examen bd
        $password = filter_input(INPUT_POST, 'password_examen', FILTER_SANITIZE_STRING);
        if ($examen->password === $password) {
            $examen_en_bd = R::findOne('resultado', 'user_id = ? and examen_id = ?', [$_SESSION['id_usuario'], $id_examen]);
            if (isset($examen_en_bd)) {
                if ($examen_en_bd->estado === 'iniciado') {
                    echo 'RECUPERAMOS EXAMEN';
                } else {
                    header('Location: ../alum/exam.php');
                }
            } else { // NO EXISTE EL EXAMEN => Lo creamos
                $resultado = R::dispense('resultado'); //Entidad Intermedia USUARIO_EXAMEN = RESULTADO
                $usuario = R::load('user', $_SESSION['id_usuario']);
                $resultado->user = $usuario; //Many to One
                $resultado->examen = $examen; //Many to One
                $resultado->estado = 'iniciado';
                $_SESSION['id_resultado'] = R::store($resultado);
                header('Location: ../alum/exam.php');
            }
            /*
              if($examen_en_bd->estado === 'iniciado'){
              // Recupero el examen
              echo 'Recuperando examen';
              } else {


              }
             */
        } else {
            $aErrores[] = 'contraseña incorrecta';
            header('Location: ../alum/doexam.php');
        }
    }
} else {
    header('Location: ../alum/doexam.php');
}


