<?php

require_once __DIR__ . '/../../controller/ReviewController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$product_id = $_GET['product_id'] ?? null;
if (!$product_id) {
    setStatusCodeAndEchoJson(400, 'Product ID is required');
    exit();
}

$reviewController = new ReviewController();
$respone = $reviewController->getAllByProductId($product_id);
setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
