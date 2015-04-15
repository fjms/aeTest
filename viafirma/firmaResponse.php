<?php
session_start();
require '../scripts/bdutil.php';

include_once("./viafirma/includes.php");

function retErrorLogin() {
    $_SESSION['errorlogin'] = 1;
    header('Location: ../index.php');
}

class firmaResponse extends ViafirmaClientResponse {

// Proceso de Autenticación correcto: recibe un objeto UsuarioGenericoViafirma
    public function authenticateOK($usuarioGenerico) {
       
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
        echo "Id de firma devuelto: ".$usuarioGenerico->signId;
    }

}



$test = new firmaResponse();
$test->process();
?>