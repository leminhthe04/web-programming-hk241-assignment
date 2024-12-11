<?php

require_once __DIR__ . '/../../controller/ReviewController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$user_id = $_GET['user_id'] ?? null;
if (!$user_id) {
    Util::setStatusCodeAndEchoJson(400, 'User ID is required');
    exit;
}
$user_id = intval(htmlspecialchars($user_id));


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


$reviewController = new ReviewController();
$respone = $reviewController->fetchByUserId($user_id, $offset, $limit);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
