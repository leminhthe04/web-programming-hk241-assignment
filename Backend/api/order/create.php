<?php

require_once __DIR__ . '/../../controller/OrderController.php';
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

$customer_id = $data['customer_id'] ?? null;
if (!$customer_id) {
    Util::setStatusCodeAndEchoJson(400, 'Customer ID is required');
    exit();
}
$customer_id = intval(htmlspecialchars($customer_id));

$quantity = $data['quantity'] ?? null;
if (!$quantity) {
    Util::setStatusCodeAndEchoJson(400, 'Quantity is required');
    exit();
}
$quantity = htmlspecialchars($quantity);

$shipping_address = $data['shipping_address'] ?? null;
if (!$shipping_address) {
    Util::setStatusCodeAndEchoJson(400, 'Shipping Address is required');
    exit();
}
$shipping_address = htmlspecialchars($shipping_address);


$orderController = new OrderController();
$respone = $orderController->create($customer_id, $product_id, $quantity, $shipping_address);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>