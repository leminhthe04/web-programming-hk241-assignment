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

$password = $data['password'] ?? null;
if (!$password) {
    Util::setStatusCodeAndEchoJson(400, 'Password is required', null);
    exit;
}


$email = $data['email'] ? htmlspecialchars($data['email']) : null;
// $phone = $data['phone'] ? htmlspecialchars($data['phone']) : null;


if ($email === null) {
    Util::setStatusCodeAndEchoJson(400, 'Email is required', null);
    exit;
}

$userController = new UserController();
// $respone = $email ? $userController->authenticateUserByEmail($email, $password)
    // : $userController->authenticateUserByPhone($phone, $password);
$respone = $userController->authenticateUserByEmail($email, $password);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);


?>