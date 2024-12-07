<?php

require_once __DIR__ . '/../../controller/ProductImageController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$id) {
    setStatusCodeAndEchoJson(400, 'Product image ID is required', null);
    exit;
}

$productImageController = new ProductImageController();
$respone = $productImageController->deleteProductImage($id);
setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>