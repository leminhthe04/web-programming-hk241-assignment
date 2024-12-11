<?php

require_once __DIR__ . '/../../controller/OrderController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$product_id = $_GET['product_id'] ?? null;
if (!$product_id) {
    Util::setStatusCodeAndEchoJson(400, 'Product ID is required');
    exit();
}
$product_id = intval(htmlspecialchars($product_id));


$offset = $_GET['offset'];
if (!isset($offset)) {
    Util::setStatusCodeAndEchoJson(400, 'Offset is required', null);
    exit;
}
$offset = intval(htmlspecialchars($offset));

$limit = $_GET['limit'];
if (!isset($limit)) {
    Util::setStatusCodeAndEchoJson(400, 'Limit is required', null);
    exit;
}
$limit = intval(htmlspecialchars($limit));


$orderController = new OrderController();
$response = $orderController->findByProductId($product_id, $offset, $limit);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
