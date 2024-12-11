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

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$id) {
    Util::setStatusCodeAndEchoJson(400, 'Order ID is required', null);
    exit;
}

$orderController = new OrderController();

$responses = [];

$status = $data['status'] ?? null;
if ($status !== null) {
    $status = htmlspecialchars($status);
    $responses['status'] = $orderController->updateStatus($id, $status);
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