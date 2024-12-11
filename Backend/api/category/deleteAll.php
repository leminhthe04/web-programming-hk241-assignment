<?php

require_once __DIR__ . '/../../controller/CategoryController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$categoryController = new CategoryController();
$respone = $categoryController->deleteAllCategories();
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>