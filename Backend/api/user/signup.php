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
$name = htmlspecialchars($name);

$sex = $data['sex'] ?? null;
if (!$sex) {
    Util::setStatusCodeAndEchoJson(400, 'Sex is required', null);
}
$sex = htmlspecialchars($sex);

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
$email = htmlspecialchars($email);

$phone = $data['phone'] ?? null;
if (!$phone) {
    Util::setStatusCodeAndEchoJson(400, 'Phone is required', null);
    exit;
}
$phone = htmlspecialchars($phone);

$role = $data['role'] ?? 'customer';
$role = htmlspecialchars($role);
$avatar = $data['avt_url'] ?? null;
$avatar = htmlspecialchars($avatar);

$address = $data['address'];
if (!$address) {
    Util::setStatusCodeAndEchoJson(400, 'Address is required', null);
    exit;
}
$address = htmlspecialchars($address);

$userController = new UserController();
$respone = $userController->insertUser($name, $sex, $password, $email, $phone, $role, $avatar, $address);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>