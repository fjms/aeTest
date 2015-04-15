<?php
session_start();
require '../scripts/bdutil.php';

try {
    include_once("./viafirma/includes.php");

    ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL, "http://localhost", "dev_UPO", "ZGWJM5TZ3W07C1HMAFXKP7X157BFL");

    $viafirmaClient = ViafirmaClientFactory::getInstance();
    
    // Cargamos el archivo
    $filename = "resource/exampleSign.pdf";
    $file = fopen($filename, 'r');
    $datos = fread($file, filesize($filename));
    fclose($file);

    //Subimos el documento al servidor
    $idFirma = $viafirmaClient->prepareFirmaWithTypeFileAndFormatSign("exampleSign.pdf", MimeType::$PDF, $datos, SignatureType::$PADES_BASIC);

    //Iniciamos el proceso de firma
    //Url de retorno a la aplicación (tras el proceso de firma)
    $viafirmaClient->solicitarFirma($idFirma, "http://localhost/aeTest/viafirma/firmaResponse.php");
    
} catch (Exception $ex) {
    
}