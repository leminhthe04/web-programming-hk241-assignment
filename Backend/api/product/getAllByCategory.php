<?php

require_once __DIR__ . '/../../controller/ProductController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$category_id = $_GET['category_id'] ?? null;
if (!$category_id) {
    setStatusCodeAndEchoJson(400, 'Category ID is required');
    exit();
}

$productController = new ProductController();
$respone = $productController->getAllByCategory($category_id);
setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
