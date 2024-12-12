<?php

require_once __DIR__ . '/../../controller/ProductController.php';
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

$price = $data['price'] ?? null;
if ($price === null) {
    Util::setStatusCodeAndEchoJson(400, 'Price is required', null);
    exit;
}
$price = intval(htmlspecialchars($price));

$description = $data['description'] ? htmlspecialchars($data['description']) : null;

$quantity = $data['quantity'] ?? null;
if ($quantity === null) {
    Util::setStatusCodeAndEchoJson(400, 'Quantity is required', null);
    exit;
}
$quantity = htmlspecialchars($quantity);

$category_id = $data['category_id'] ? htmlspecialchars($data['category_id']) : null;

$status = $data['status'] ? htmlspecialchars($data['status']) : null;


$image_urls = $data['image_urls'] ?? null;
if($image_urls != null && !is_array($image_urls)){
    Util::setStatusCodeAndEchoJson(400, 'Image URLs must be an array', null);
    exit;
}

foreach($image_urls as $url){
    if(!is_string($url)){
        Util::setStatusCodeAndEchoJson(400, 'Image URL must be a string', null);
        exit;
    }
    $url = htmlspecialchars($url);
}

// echo print_r($image_urls);

// print_r($image_urls);


$productController = new ProductController();
$respone = $productController->insertProduct($name, $price, $description, $quantity, $category_id, $status, $image_urls);
Util::setStatusCodeAndEchoJson($respone['code'], $respone['message'], $respone['data']);
?>