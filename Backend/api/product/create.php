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

$name = $data['name'] ?? null;
if (!$name) {
    setStatusCodeAndEchoJson(400, 'Name is required', null);
    exit;
}

$price = $data['price'] ?? null;
if ($price === null) {
    setStatusCodeAndEchoJson(400, 'Price is required', null);
    exit;
}

$description = $data['description'] ?? null;

$quantity = $data['quantity'] ?? null;
if ($quantity === null) {
    setStatusCodeAndEchoJson(400, 'Quantity is required', null);
    exit;
}

$category_id = $data['category_id'] ?? null;
$status = $data['status'] ?? null;

$productController = new ProductController();
$respone = $productController->insertProduct($name, $price, $description, $quantity, $category_id, $status);
setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>