<?php

require_once __DIR__ . '/../../controller/ReviewController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

if (!$data) {
    setStatusCodeAndEchoJson(400, 'Invalid JSON', null);
    exit;
}

$customer_id = $data['customer_id'] ?? null;
if (!$customer_id) {
    setStatusCodeAndEchoJson(400, 'Customer ID is required', null);
    exit;
}

$product_id = $data['product_id'] ?? null;
if (!$product_id) {
    setStatusCodeAndEchoJson(400, 'Product ID is required', null);
    exit;
}

$rating = $data['rating'] ?? null;
if ($rating === null) {
    setStatusCodeAndEchoJson(400, 'Rating is required', null);
    exit;
}

$comment = $data['comment'] ?? null;

$reviewController = new ReviewController();
$respone = $reviewController->insertReview($customer_id, $product_id, $rating, $comment);
setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>