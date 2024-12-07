<?php

require_once __DIR__ . '/../../controller/ProductController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$productController = new ProductController();
$respone = $productController->getAll();
setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
