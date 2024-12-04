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

$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;
if (!$product_id) {
    setStatusCodeAndEchoJson(400, 'Product ID is requireddddd', null);
    exit;
}


$user_id = $data['user_id'] ?? null;
if (!$user_id) {
    setStatusCodeAndEchoJson(400, 'User ID is required', null);
    exit;
}

$rating = $data['rating'] ?? null;
if ($rating === null) {
    setStatusCodeAndEchoJson(400, 'Rating is required', null);
    exit;
}

$comment = $data['comment'] ?? null;

$reviewController = new ReviewController();
$response = $reviewController->insertReview($user_id, $product_id, $rating, $comment);
setStatusCodeAndEchoJson($response['code'], $response['message'], $response['data']);
?>