<?php

session_start();
require '../scripts/bdutil.php';

try {
    include_once("./viafirma/includes.php");

    ViafirmaClientFactory::init("http://services.viafirma.com/viafirma","http://services.viafirma.com/viafirma/rest", "http://localhost", "dev_UPO", "ZGWJM5TZ3W07C1HMAFXKP7X157BFL");

    $viafirmaClient = ViafirmaClientFactory::getInstance();

    // Cargamos el archivo
    $filename = "../examenes/" . $_SESSION['filename'];
    try {

        $file = fopen($filename, 'r');
        $datos = fread($file, filesize($filename));
        fclose($file);
    } catch (Exception $ex) {
        echo "<pre>" . $ex . "</pre>";
    }
    //Subimos el documento al servidor
    $idFirma = $viafirmaClient->prepareFirmaWithTypeFileAndFormatSign($_SESSION['filename'], MimeType::$PDF, $datos, SignatureType::$PADES_BASIC);

    //Iniciamos el proceso de firma
    //Url de retorno a la aplicación (tras el proceso de firma)
    $viafirmaClient->solicitarFirma($idFirma, "http://localhost/aeTest/viafirma/firmaResponse.php");
} catch (Exception $ex) {
    echo "<pre>" . $ex . "</pre>";
}