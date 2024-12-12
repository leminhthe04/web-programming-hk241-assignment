<?php

require_once __DIR__ . '/../../controller/ProductController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    Util::setStatusCodeAndEchoJson(400, 'Product ID is required', null);
    exit;
}
$id = intval(htmlspecialchars($_GET['id']));

$productController = new ProductController();
$respone = $productController->getById($id);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>