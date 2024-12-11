<?php

require_once __DIR__ . '/../../controller/OrderController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$customer_id = $_GET['customer_id'] ?? null;
if (!$product_id) {
    Util::setStatusCodeAndEchoJson(400, 'Customer ID is required');
    exit();
}
$customer_id = intval(htmlspecialchars($customer_id));


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
$response = $orderController->findByUserId($customer_id, $offset, $limit);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
