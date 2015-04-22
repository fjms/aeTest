<?php
session_start();
require '../scripts/bdutil.php';

include_once("./viafirma/includes.php");


class firmaLoteResponse extends ViafirmaClientResponse {

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
        
        echo $usuarioGenerico->signId;
       
        //header('Location:../alum/alumno.php');
    }

}



$test = new firmaLoteResponse();
$test->process();
?>