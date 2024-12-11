<?php

require_once __DIR__ . '/../../controller/ProductImageController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

if (!$data) {
    Util::setStatusCodeAndEchoJson(400, 'Invalid JSON', null);
    exit;
}

$product_id = $data['product_id'] ?? null;
if (!$product_id) {
    Util::setStatusCodeAndEchoJson(400, 'Product ID is required');
    exit();
}
$product_id = intval(htmlspecialchars($product_id));

$url = $data['url'] ?? null;
if (!$url) {
    Util::setStatusCodeAndEchoJson(400, 'URL is required');
    exit();
}
$url = htmlspecialchars($url);

$productImageController = new ProductImageController();
$respone = $productImageController->insertProductImage($product_id, $url);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>