<?php

require_once __DIR__ . '/../../controller/ReviewController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

if (!$data) {
    Util::setStatusCodeAndEchoJson(400, 'Invalid JSON', null);
    exit;
}

$id = isset($_GET['id']) ? intval(htmlspecialchars($_GET['id'])) : null;
if (!$id) {
    Util::setStatusCodeAndEchoJson(400, 'Review ID is required', null);
    exit;
}

$reviewController = new ReviewController();

$responses = [];

$rating = $data['rating'] ?? null;
if ($rating !== null) {
    $rating = htmlspecialchars($rating);
    $responses['rating'] = $reviewController->updateReviewRating($id, $rating);
}

$comment = $data['comment'] ?? null;
if ($comment !== null) {
    $comment = htmlspecialchars($comment);
    $responses['comment'] = $reviewController->updateReviewComment($id, $comment);
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