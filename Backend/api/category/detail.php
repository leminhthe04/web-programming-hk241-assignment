<?php

require_once __DIR__ . '/../../controller/CategoryController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    Util::setStatusCodeAndEchoJson(400, 'Category ID is required', null);
    exit;
}
$id = intval(htmlspecialchars($_GET['id']));

$categoryController = new CategoryController();
$respone = $categoryController->getById($id);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>