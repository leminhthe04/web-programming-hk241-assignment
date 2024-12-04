<?php

require_once __DIR__ . '/../../controller/ReviewController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$user_id = $_GET['user_id'] ?? null;
if (!$user_id) {
    setStatusCodeAndEchoJson(400, 'User ID is required');
    exit();
}

$reviewController = new ReviewController();
$respone = $reviewController->getAllByUserId($user_id);
setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
