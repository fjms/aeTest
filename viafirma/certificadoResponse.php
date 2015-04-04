<?php

session_start();
require '../scripts/bdutil.php';

include_once("./viafirma/includes.php");

function retErrorLogin() {
    $_SESSION['errorlogin'] = 1;
    header('Location: ../index.php');
}

class certificadoResponse extends ViafirmaClientResponse {

// Proceso de Autenticación correcto: recibe un objeto UsuarioGenericoViafirma
    public function authenticateOK($usuarioGenerico) {
        $dni = sha1($usuarioGenerico->numberUserId);
        $user = R::findOne('user', 'dni LIKE ?', [$dni]);
        if (empty($user)) { // Si no exise el usuario;
            retErrorLogin();
        } else {
            if ($user->rol == 1) {
                $_SESSION['rol'] = 1;
                $_SESSION['id_usuario'] = $user->id;
                header('Location: ../admin.php');
            } else {
                $_SESSION['rol'] = 0;
                $_SESSION['id_usuario'] = $user->id;
                header('Location: ../alum/alumno.php');
            }
        }
    }

    // Firma o Autenticación cancelada por el usuario
    public function cancel() {
        header('Location: ../index.php');
    }

    // Error en el proceso de Firma o Autenticación: recibe String con el error
    public function error($error) {
        echo $error;
    }

    // Proceso de Firma correcto: recibe un objeto UsuarioGenericoViafirma
    public function signOK($usuarioGenerico) {
        
    }

}



$test = new certificadoResponse();
$test->process();
?>