<?php

require_once __DIR__ . '/../../controller/ProductImageController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$productImageController = new ProductImageController();
$respone = $productImageController->getAll();
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
