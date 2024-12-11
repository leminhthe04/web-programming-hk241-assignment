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
    $responses['name'] = $productController->updateProductName($id, $name);
}
$name = htmlspecialchars($name);

$price = $data['price'] ?? null;
if ($price !== null) {
    $responses['price'] = $productController->updateProductPrice($id, $price);
}
$price = intval(htmlspecialchars($price));

$quantity = $data['quantity'] ?? null;
if ($quantity !== null) {
    $responses['quantity'] = $productController->updateProductQuantity($id, $quantity);
}
$quantity = intval(htmlspecialchars($quantity));

$description = $data['description'] ?? null;
if ($description !== null) {
    $responses['description'] = $productController->updateProductDescription($id, $description);
}
$description = htmlspecialchars($description);

$category_id = $data['category_id'] ?? null;
if ($category_id) {
    $responses['category_id'] = $productController->updateProductCategory($id, $category_id);
}
$category_id = intval(htmlspecialchars($category_id));

$status = $data['status'] ?? null;
if ($status !== null) {
    $responses['status'] = $productController->updateProductStatus($id, $status);
}
$status = intval(htmlspecialchars($status));


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