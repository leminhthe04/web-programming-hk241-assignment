<?php

require_once __DIR__ . '/../../controller/CategoryController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

if (!$data) {
    Util::setStatusCodeAndEchoJson(400, 'Invalid JSON', null);
    exit;
}

$name = $data['name'] ?? null;
if (!$name) {
    Util::setStatusCodeAndEchoJson(400, 'Name is required', null);
    exit;
}
$name = htmlspecialchars($name);

$categoryController = new CategoryController();
$respone = $categoryController->insertCategory($name);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>