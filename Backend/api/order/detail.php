<?php

require_once __DIR__ . '/../../controller/OrderController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    Util::setStatusCodeAndEchoJson(400, 'Order ID is required', null);
    exit;
}
$id = intval(htmlspecialchars($_GET['id']));


$orderController = new OrderController();
$respone = $orderController->getById($id);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>