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

$userController = new UserController();

$responses = [];

$name = $data['name'] ?? null;
if ($name !== null) {
    $name = htmlspecialchars($name);
    $responses['name'] = $userController->updateUserName($id, $name);
}

$email = $data['email'] ?? null;
if ($email !== null) {
    $email = htmlspecialchars($email);
    $responses['email'] = $userController->updateUserEmail($id, $email);
}

$phone = $data['phone'] ?? null;
if ($phone !== null) {
    $phone = htmlspecialchars($phone);
    $responses['phone'] = $userController->updateUserPhone($id, $phone);
}

$sex = $data['sex'] ?? null;
if ($sex !== null) {
    $sex = htmlspecialchars($sex);
    $responses['sex'] = $userController->updateUserSex($id, $sex);
}

$role = $data['role'] ?? null;
if ($role !== null) {
    $role = htmlspecialchars($role);
    $responses['role'] = $userController->updateUserRole($id, $role);
}

$avatar = $data['avt_url'] ?? null;
if ($avatar !== null) {
    $avatar = htmlspecialchars($avatar);
    $responses['avt_url'] = $userController->updateUserAvatar($id, $avatar);
}

$address = $data['address'] ?? null;
if ($address !== null) {
    $address = htmlspecialchars($address);
    $responses['address'] = $userController->updateUserAddress($id, $address);
}

$fields = array_keys($responses);
$code = 200;
$message = '';
foreach ($fields as $field) {
    if ($responses[$field]['code'] != 200) {
        $code = $responses[$field]['code'];
    }
    $message .= $responses[$field]['message'] . "\n";
}

Util::setStatusCodeAndEchoJson($code, $message, null);
?>