<?php
session_start();
require './bdutil.php'; // RedBeanPHP 4.1.4

$aErrores = array();
$patron_password = "/[0-9]{3,3}$/";
if (isset($_POST['dni']) && isset($_POST['password'])) {
// DNI:
    if (empty($_POST['dni'])) {
        $aErrores[] = "Debe especificar el dni";
    } else {
        //Valido dni con expresion regular
        if (is_valid_dni_nie($_POST['dni'])) {
            $dni = $_POST['dni'];
        } else {
            $aErrores[] = "Formato de Dni incorrecto";
        }
    }
    if (empty($_POST['password'])) {
        $aErrores[] = "Debe especificar el password";
    } else {
        //Valido password con expresion regular
        if (preg_match($patron_password, $_POST['password'])) {
            $pw = $_POST['password'];
        } else {
            $aErrores[] = "Password Incorrecto";
        }
    }
} else { //Si entra directamente a la pagina lo redirigimos a inicio
    header('Location: ../index.php');
}
if (count($aErrores) > 0) { // Si tiene errores lo enviamos a inicio
    retErrorLogin();
} else { //Todo a ido bien
    $dni_sha1 = sha1($dni);
    $user = R::findOne('user', 'dni LIKE ?', [$dni_sha1]);
    if (empty($user)) { // Si no exise el usuario;
        retErrorLogin();
    } else {
        $password = explode(',', $user->password);
        if ($password[$_SESSION['posicion']] == $pw) {
            if($user->rol == 1){
              $_SESSION['rol'] = 1;
              $_SESSION['id_usuario'] = $user->id;
              header('Location: ../admin.php');
            } else {
              $_SESSION['rol'] = 0;
              $_SESSION['id_usuario'] = $user->id;
              $_SESSION['nombre_alumno'] = $user->nombre;
              $_SESSION['dni'] = $dni;
              header('Location: ../alum/alumno.php');
            }
        } else {
            retErrorLogin();
        }
    }
}

function retErrorLogin() {
    $_SESSION['errorlogin'] = 1;
    header('Location: ../index.php');
}

function is_valid_dni_nie($string) {
    if (strlen($string) != 9 ||
            preg_match('/^[XYZ]?([0-9]{7,8})([a-zA-Z])$/', $string, $matches) !== 1) {
        return false;
    } else {
        return true;
    }
/*
    $map = 'TRWAGMYFPDXBNJZSQVHLCKE';

    list(, $number, $letter) = $matches;

    return strtoupper($letter) === $map[((int) $number) % 23];/*
 * 
 */
}

function generaCoordenadas() {
    $array = '';
    for ($i = 0; $i < 64; $i++) {
        $num = rand(100, 999);
        if ($i != 0) {
            $array = $array . ',' . $num;
        } else {
            $array = $num;
        }
    }
    return $array;
}
