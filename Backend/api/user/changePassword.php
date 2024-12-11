<?php

require_once __DIR__ . '/../../controller/UserController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$jsonData = file_get_contents('php://input');

$data = json_decode($jsonData, true);

if (!$data) {
    Util::setStatusCodeAndEchoJson(400, 'Invalid JSON', null);
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$id) {
    Util::setStatusCodeAndEchoJson(400, 'User ID is required', null);
    exit;
}

$currentPassword = $data['current_password'] ?? null;
if(!$currentPassword) {
    Util::setStatusCodeAndEchoJson(400, 'Current password is required', null);
    exit;
}

$newPassword = $data['new_password'] ?? null;
if(!$newPassword) {
    Util::setStatusCodeAndEchoJson(400, 'New password is required', null);
    exit;
}


$userController = new UserController();
$respone = $userController->changeUserPassword($id, $currentPassword, $newPassword);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>