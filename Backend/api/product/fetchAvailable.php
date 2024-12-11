<?php

require_once __DIR__ . '/../../controller/ProductController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');


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

$productController = new ProductController();
$respone = $productController->fetchAvailable($offset, $limit);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
