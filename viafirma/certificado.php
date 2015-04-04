<?php

try {
    // 1) Importación de clases necesarias
    include_once("./viafirma/includes.php");


    // 2) Inicialización del cliente, indicando la Url de su aplicación como parámetro
    ViafirmaClientFactory::init($VIAFIRMA_SERVICE_URL, $VIAFIRMA_SERVICE_URL, "http://localhost", "dev_UPO", "ZGWJM5TZ3W07C1HMAFXKP7X157BFL");
    // 3) Obtener instancia del Cliente de Viafirma
    $viafirmaClient = ViafirmaClientFactory::getInstance();
    // 4) Invocación de método concreto
    $viafirmaClient->solicitarAutenticacion("http://localhost/aeTest/viafirma/certificadoResponse.php");
} catch (Exception $exception) {
    echo "<pre>" . $exception . "</pre>";
}
?>
