<?php

require_once __DIR__ . '/../../controller/ReviewController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$reviewController = new ReviewController();
$respone = $reviewController->getAll();
setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
