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

$name = $data['name'] ?? null;
if (!$name) {
    Util::setStatusCodeAndEchoJson(400, 'Name is required', null);
    exit;
}

$sex = $data['sex'] ?? null;
if (!$sex) {
    Util::setStatusCodeAndEchoJson(400, 'Sex is required', null);
}

$password = $data['password'] ?? null;
if (!$password) {
    Util::setStatusCodeAndEchoJson(400, 'Password is required', null);
    exit;
}

$email = $data['email'] ?? null;
if (!$email) {
    Util::setStatusCodeAndEchoJson(400, 'Email is required', null);
    exit;
}

$phone = $data['phone'] ?? null;
if (!$phone) {
    Util::setStatusCodeAndEchoJson(400, 'Phone is required', null);
    exit;
}

$role = $data['role'] ?? 'customer';
$avatar = $data['avt_url'] ?? null;

$address = $data['address'];
if (!$address) {
    Util::setStatusCodeAndEchoJson(400, 'Address is required', null);
    exit;
}

$userController = new UserController();
$respone = $userController->insertUser($name, $sex, $password, $email, $phone, $role, $avatar, $address);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>