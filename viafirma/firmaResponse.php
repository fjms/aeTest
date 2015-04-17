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
        $resultado = R::load('resultado', $_SESSION['id_resultado']);
        $resultado->estado='firmado';
        $resultado->datetime = R::isoDateTime();
        $resultado->firma=$usuarioGenerico->signId;
        R::store($resultado);
        header('Location:../alum/alumno.php');
    }

}



$test = new firmaResponse();
$test->process();
?>