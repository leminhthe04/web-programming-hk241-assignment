<?php

require_once __DIR__ . '/../../controller/ProductImageController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$product_id = $_GET['product_id'] ?? null;
if (!$product_id) {
    setStatusCodeAndEchoJson(400, 'Product ID is required');
    exit();
}

$productImageController = new ProductImageController();
$respone = $productImageController->getAllByProductId($product_id);
setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
