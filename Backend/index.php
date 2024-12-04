<?php

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__.'/lib/utils.php';


$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if (preg_match('/^\/api\/user\/all$/', $uri)){
    require __DIR__.'/api/user/getAll.php';
    exit;
}

if (preg_match('/^\/api\/user\/detail\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/user/detail.php';
    exit;
}

if (preg_match('/^\/api\/user\/signup$/', $uri)){
    require __DIR__.'/api/user/signup.php';
    exit;
}

if (preg_match('/^\/api\/user\/login$/', $uri)){
    require __DIR__.'/api/user/login.php';
    exit;
}

if (preg_match('/^\/api\/user\/change-pass\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/user/changePassword.php';
    exit;
}

if (preg_match('/^\/api\/user\/update\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/user/update.php';
    exit;
}

if (preg_match('/^\/api\/user\/delete\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/user/delete.php';
    exit;
}


if (preg_match('/^\/api\/user\/delete\/all$/', $uri)){
    require __DIR__.'/api/user/deleteAll.php';
    exit;
}


// echo $uri;

setStatusCodeAndEchoJson(404, 'Endpoint not found', null);
?>
