<?php

require_once __DIR__ . '/../../controller/ReviewController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    Util::setStatusCodeAndEchoJson(400, 'Review ID is required', null);
    exit;
}

$id = intval(htmlspecialchars($_GET['id']));


$reviewController = new ReviewController();
$respone = $reviewController->getById($id);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>