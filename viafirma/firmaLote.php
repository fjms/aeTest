<?php

session_start();
require '../scripts/bdutil.php';

try {
    include_once("./viafirma/includes.php");

    ViafirmaClientFactory::init("http://services.viafirma.com/viafirma", "http://services.viafirma.com/viafirma/rest", "http://localhost", "dev_UPO", "ZGWJM5TZ3W07C1HMAFXKP7X157BFL");
    //ViafirmaClientFactory::init("http://services.viafirma.com/viafirma", "http://services.viafirma.com/viafirma/rest", "http://localhost");

    $viafirmaClient = ViafirmaClientFactory::getInstance();
    $idLote = $viafirmaClient->iniciarFirmaEnLotes(SignatureType::$XADES);
   
    foreach ($_SESSION['filenames'] as $name) {
        $filename = "../examenes/" . $name;
        try {
            $file = fopen($filename, 'r');
            $datos = fread($file, filesize($filename));
            fclose($file);
        } catch (Exception $ex) {
            echo "<pre>" . $ex . "</pre>";
        }
        $viafirmaClient->addDocumentoFirmaEnLote($idLote,$name,MimeType::$PDF,$datos);
        
    }

    $viafirmaClient->solicitarFirma($idLote,"http://localhost/aeTest/viafirma/firmaLoteResponse.php");
} catch (Exception $ex) {
    echo "<pre>" . $ex . "</pre>";
}