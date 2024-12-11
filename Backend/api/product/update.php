<?php

require_once __DIR__ . '/../../controller/ProductController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

if (!$data) {
    Util::setStatusCodeAndEchoJson(400, 'Invalid JSON', null);
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$id) {
    Util::setStatusCodeAndEchoJson(400, 'Product ID is required', null);
    exit;
}
$id = intval(htmlspecialchars($id));

$productController = new ProductController();

$responses = [];

$name = $data['name'] ?? null;
if ($name) {
    $name = htmlspecialchars($name);
    $responses['name'] = $productController->updateProductName($id, $name);
}

$price = $data['price'] ?? null;
if ($price !== null) {
    $price = htmlspecialchars($price);
    $responses['price'] = $productController->updateProductPrice($id, $price);
}

$quantity = $data['quantity'] ?? null;
if ($quantity !== null) {
    $quantity = htmlspecialchars($quantity);
    $responses['quantity'] = $productController->updateProductQuantity($id, $quantity);
}

$description = $data['description'] ?? null;
if ($description !== null) {
    $description = htmlspecialchars($description);
    $responses['description'] = $productController->updateProductDescription($id, $description);
}

$category_id = $data['category_id'] ?? null;
if ($category_id) {
    $category_id = htmlspecialchars($category_id);
    $responses['category_id'] = $productController->updateProductCategory($id, $category_id);
}

$status = $data['status'] ?? null;
if ($status !== null) {
    $status = htmlspecialchars($status);
    $responses['status'] = $productController->updateProductStatus($id, $status);
}

$fields = array_keys($responses);
$code = 200;
$message = '';
foreach ($fields as $field) {
    if ($responses[$field]['code'] != 200) {
        $code = $responses[$field]['code'];
    }
    $message .= $responses[$field]['message'] . "\n";
}

Util::setStatusCodeAndEchoJson($code, $message, null);
?>