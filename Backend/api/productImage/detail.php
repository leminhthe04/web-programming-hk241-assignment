<?php

require_once __DIR__ . '/../../controller/ProductImageController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    setStatusCodeAndEchoJson(400, 'Product ID is required', null);
    exit;
}

$id = intval($_GET['id']);

$productImageController = new ProductImageController();
$respone = $productImageController->getById($id);
setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>