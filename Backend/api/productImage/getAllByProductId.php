<?php

require_once __DIR__ . '/../../controller/ProductImageController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$product_id = $_GET['product_id'] ?? null;
if (!$product_id) {
    Util::setStatusCodeAndEchoJson(400, 'Product ID is required');
    exit();
}
$product_id = intval(htmlspecialchars($product_id));

$productImageController = new ProductImageController();
$respone = $productImageController->getAllByProductId($product_id);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
