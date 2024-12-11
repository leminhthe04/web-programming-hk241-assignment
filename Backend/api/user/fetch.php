<?php

require_once __DIR__ . '/../../controller/UserController.php';
require_once __DIR__ . '/../../lib/utils.php';

header('Content-Type: application/json');

$offset = $_GET['offset'];
if ($offset == null) {
    Util::setStatusCodeAndEchoJson(400, 'Offset is required', null);
    exit;
}

$limit = $_GET['limit'];
if ($limit == null) {
    Util::setStatusCodeAndEchoJson(400, 'Limit is required', null);
    exit;
}

$userController = new UserController();
$respone = $userController->fetch($offset, $limit);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>
