<?php

require_once __DIR__ . '/../../controller/ReviewController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    setStatusCodeAndEchoJson(400, 'Review ID is required', null);
    exit;
}

$id = intval($_GET['id']);

$reviewController = new ReviewController();
$respone = $reviewController->getById($id);
setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>