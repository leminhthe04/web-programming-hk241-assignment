<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__.'/lib/utils.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];


header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// header("Access-Control-Allow-Credentials: true");



// $uri = str_replace('/Assignment/Backend', '', $uri);


if ($method == 'OPTIONS') {
    // CORS preflight request
    http_response_code(200);
    exit;
}


// if (preg_match('/\/api\/hi$/', $uri)){
//     require __DIR__.'/api/hi.php';
//     exit;
// } 

////////////////////// USER APIs //////////////////////

if (preg_match('/\/api\/user\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['offset'] = $matches[1];
    $_GET['limit'] = $matches[2];
    require __DIR__.'/api/user/fetch.php';
    exit;
}

if (preg_match('/\/api\/user\/detail\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/user/detail.php';
    exit;
}


if (preg_match('/\/api\/user\/history\/(\d+)\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    $_GET['offset'] = $matches[2];
    $_GET['limit'] = $matches[3];
    require __DIR__.'/api/user/history.php';
    exit;
}


if (preg_match('/\/api\/user\/signup$/', $uri)){
    require __DIR__.'/api/user/signup.php';
    exit;
}

if ($method = 'POST' &&  preg_match('/\/api\/user\/login$/', $uri)){
    require __DIR__.'/api/user/login.php';
    exit;
}

if (preg_match('/\/api\/user\/change-pass\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/user/changePassword.php';
    exit;
}

if (preg_match('/\/api\/user\/update\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/user/update.php';
    exit;
}

if (preg_match('/\/api\/user\/delete\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/user/delete.php';
    exit;
}


if (preg_match('/\/api\/user\/delete\/all$/', $uri)){
    require __DIR__.'/api/user/deleteAll.php';
    exit;
}


////////////////////// CATEGORY APIs //////////////////////

if (preg_match('/\/api\/category\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['offset'] = $matches[1];
    $_GET['limit'] = $matches[2];
    require __DIR__.'/api/category/fetch.php';
    exit;
}

if (preg_match('/\/api\/category\/detail\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/category/detail.php';
    exit;
}

if (preg_match('/\/api\/category\/create$/', $uri)){
    require __DIR__.'/api/category/create.php';
    exit;
}

if (preg_match('/\/api\/category\/update\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/category/update.php';
    exit;
}

if (preg_match('/\/api\/category\/delete\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/category/delete.php';
    exit;
}

if (preg_match('/\/api\/category\/delete\/all$/', $uri)){
    require __DIR__.'/api/category/deleteAll.php';
    exit;
}


///////////////////////////// PRODUCT APIs /////////////////////////////

if (preg_match('/\/api\/product\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['offset'] = $matches[1];
    $_GET['limit'] = $matches[2];
    require __DIR__.'/api/product/fetch.php';
    exit;
}

if (preg_match('/\/api\/product\/detail\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/product/detail.php';
    exit;
}

if (preg_match('/\/api\/product\/available\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['offset'] = $matches[1];
    $_GET['limit'] = $matches[2];
    require __DIR__.'/api/product/fetchAvailable.php';
    exit;
}

if (preg_match('/\/api\/product\/stopselling\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['offset'] = $matches[1];
    $_GET['limit'] = $matches[2];
    require __DIR__.'/api/product/fetchStopSelling.php';
    exit;
}

if (preg_match('/\/api\/product\/soldout\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['offset'] = $matches;
    $_GET['limit'] = $matches[2];
    require __DIR__.'/api/product/fetchSoldOut.php';
    exit;
}

if (preg_match('/\/api\/product\/category\/(\d+)\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['category_id'] = $matches[1];
    $_GET['offset'] = $matches[2];
    $_GET['limit'] = $matches[3];
    require __DIR__.'/api/product/fetchByCategory.php';
    exit;
}


if (preg_match('/\/api\/product\/create$/', $uri)){
    require __DIR__.'/api/product/create.php';
    exit;
}

if (preg_match('/\/api\/product\/update\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/product/update.php';
    exit;
}

if (preg_match('/\/api\/product\/delete\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/product/delete.php';
    exit;
}

if (preg_match('/\/api\/product\/delete\/all$/', $uri)){
    require __DIR__.'/api/product/deleteAll.php';
    exit;
}


if (preg_match('/\/api\/product\/search\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['offset'] = $matches[1];
    $_GET['limit'] = $matches[2];
    require __DIR__.'/api/product/search.php';
    exit;
}

if (preg_match('/\/api\/product\/review\/(\d+)$/', $uri, $matches)){
    $_GET['product_id'] = $matches[1];
    require __DIR__.'/api/product/postReview.php';
    exit;
}


///////////////////////////// PRODUCT IMAGE APIs //////////////////////

if (preg_match('/\/api\/product-image\/all$/', $uri)){
    require __DIR__.'/api/productImage/getAll.php';
    exit;
}

if (preg_match('/\/api\/product-image\/detail\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/productImage/detail.php';
    exit;
}

if (preg_match('/\/api\/product-image\/product\/(\d+)$/', $uri, $matches)){
    $_GET['product_id'] = $matches[1];
    require __DIR__.'/api/productImage/getAllByProductId.php';
    exit;
}

if (preg_match('/\/api\/product-image\/create$/', $uri)){
    require __DIR__.'/api/productImage/create.php';
    exit;
}

if (preg_match('/\/api\/product-image\/delete\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/productImage/delete.php';
    exit;
}


///////////////////////////// REVIEW APIs /////////////////////////////

if (preg_match('/\/api\/review\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['offset'] = $matches[1];
    $_GET['limit'] = $matches[2];
    require __DIR__.'/api/review/fetch.php';
    exit;
}

if (preg_match('/\/api\/review\/detail\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/review/detail.php';
    exit;
}

if (preg_match('/\/api\/review\/product\/(\d+)\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['product_id'] = $matches[1];
    $_GET['offset'] = $matches[2];
    $_GET['limit'] = $matches[3];
    require __DIR__.'/api/review/fetchByProductId.php';
    exit;
}

if (preg_match('/\/api\/review\/user\/(\d+)\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['user_id'] = $matches[1];
    $_GET['offset'] = $matches[2];
    $_GET['limit'] = $matches[3];
    require __DIR__.'/api/review/fetchByUserId.php';
    exit;
}

if (preg_match('/\/api\/review\/create$/', $uri)){
    require __DIR__.'/api/review/create.php';
    exit;
}

if (preg_match('/\/api\/review\/update\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/review/update.php';
    exit;
}

//////////////////////////////// ORDER APIs /////////////////////////////

if (preg_match('/\/api\/order\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['offset'] = $matches[1];
    $_GET['limit'] = $matches[2];
    require __DIR__.'/api/order/fetch.php';
    exit;
}

if (preg_match('/\/api\/order\/detail\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/order/detail.php';
    exit;
}

if (preg_match('/\/api\/order\/product\/(\d+)\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['product_id'] = $matches[1];
    $_GET['offset'] = $matches[2];
    $_GET['limit'] = $matches[3];
    require __DIR__.'/api/order/fetchByProductId.php';
    exit;
}


if (preg_match('/\/api\/order\/user\/(\d+)\/fetch\/(\d+)\/(\d+)$/', $uri, $matches)){
    $_GET['customer_id'] = $matches[1];
    $_GET['offset'] = $matches[2];
    $_GET['limit'] = $matches[3];
    require __DIR__.'/api/order/fetchByUserId.php';
    exit;
}

if (preg_match('/\/api\/order\/create$/', $uri)){
    require __DIR__.'/api/order/create.php';
    exit;
}

if (preg_match('/\/api\/order\/update\/(\d+)$/', $uri, $matches)){
    $_GET['id'] = $matches[1];
    require __DIR__.'/api/order/update.php';
    exit;
}




//////////////////////////////////////////////////////////////////////

// if (preg_match('/\/database\/database.php$/', $uri)){
//     require __DIR__.'/database/database.php';
//     exit;
// }

// echo $uri;

Util::setStatusCodeAndEchoJson(404, 'Endpoint not found', null);
?>
