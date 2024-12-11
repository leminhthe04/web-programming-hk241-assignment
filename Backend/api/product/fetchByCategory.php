<?php

require_once __DIR__ . '/../../controller/ProductController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$category_id = $_GET['category_id'] ?? null;
if (!$category_id) {
    Util::setStatusCodeAndEchoJson(400, 'Category ID is required');
    exit;
}
$category_id = intval(htmlspecialchars($category_id));


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
$respone = $productController->fetchByCategory($category_id, $offset, $limit);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
