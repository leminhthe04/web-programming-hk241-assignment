<?php

require_once __DIR__ . '/../../controller/ProductController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$id) {
    Util::setStatusCodeAndEchoJson(400, 'Product ID is required', null);
    exit;
}
$id = intval(htmlspecialchars($id));

$productController = new ProductController();
$respone = $productController->deleteProduct($id);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>