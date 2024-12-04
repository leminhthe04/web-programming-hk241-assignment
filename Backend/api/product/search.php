<?php

require_once __DIR__ . '/../../controller/ProductController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

if (!$data) {
    setStatusCodeAndEchoJson(400, 'Invalid JSON', null);
    exit;
}

$key = $data['key'] ?? null;
if (!$key) {
    setStatusCodeAndEchoJson(400, 'Key is required', null);
    exit;
}

$productController = new ProductController();
$respone = $productController->searchProducts($key);
setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>