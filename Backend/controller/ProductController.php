<?php

require_once __DIR__ . '/../model/Product.php';
require_once __DIR__ . '/../model/Category.php';
require_once __DIR__ . '/../controller/ProductImageController.php';

class ProductController {

    private function statusIsValidValue($status) {
        return in_array($status, ['Available', 'Stop Selling', 'Sold Out']);
    }
    private function nameIsValidFormat($name) {
        return strlen($name) >= 5 && strlen($name) <= 50;
    }
    private function priceIsValidValue($price) {
        return is_numeric($price) && $price >= 0;
    }
    private function categoryIdIsValidValue($category_id) {
        if (!$category_id) return true;
        $category = new Category();
        $res = $category->getById($category_id);
        return !isset($res['code']) ? true : false;
    }
    private function quantityIsValidValue($quantity) {
        return is_numeric($quantity) && $quantity >= 0;
    }

    private function fieldAreValid($name, $price, $quantity, $category_id) {
        if (!$this->nameIsValidFormat($name))
            return ["message" => "Name must be between 5 and 50 characters"];
        if (!$this->priceIsValidValue($price))
            return ["message" => "Price must be a positive number"];
        if (!$this->categoryIdIsValidValue($category_id))
            return ["message" => "Category not exist"];
        if (!$this->quantityIsValidValue($quantity))
            return ["message" => "Quantity must be a non-negative integer"];
        return ["message" => "Valid"];
    }

    public function fetch($offset, $limit) {
        $product = new Product();
        $res = $product->getAll($offset, $limit); // a fetch array or null
        if (isset($res['code'])) return $res;
        
        return empty($res['data']) ? 
            Util::getResponseArray(200, "There is no product in system now", [])
        :   Util::getResponseArray(200, "Found products", $res);
    }

    public function getById($id) {
        $product = new Product();
        $res = $product->getById($id);
        if (isset($res['code'])) return $res;
        return Util::getResponseArray(200, "Product found", $res);
    }

    public function fetchAvailable($offset, $limit) {
        $product = new Product();
        $res = $product->getAllAvailable($offset, $limit);
        if (isset($res['code'])) return $res;
        return empty($res['data']) ? 
            Util::getResponseArray(200, "There is no available product now", [])
        :   Util::getResponseArray(200, "Found available products", $res);
    }

    public function fetchStopSelling($offset, $limit) {
        $product = new Product();
        $res = $product->getAllStopSelling($offset, $limit);
        if (isset($res['code'])) return $res;
        return empty($res['data']) ? 
            Util::getResponseArray(200, "There is no stop selling product now", [])
        :   Util::getResponseArray(200, "Found stop selling products", $res);
    }

    public function fetchSoldOut($offset, $limit) {
        $product = new Product();
        $res = $product->getAllSoldOut($offset, $limit);
        if (isset($res['code'])) return $res;
        return empty($res['data']) ? 
            Util::getResponseArray(200, "There is no sold out product now", [])
        :   Util::getResponseArray(200, "Found sold out products", $res);
    }

    public function fetchByCategory($category_id, $offset, $limit) {
        $product = new Product();
        $res = $product->getAllByCategoryId($category_id, $offset, $limit);
        if (isset($res['code'])) return $res;
        return empty($res['data']) ? 
            Util::getResponseArray(200, "There is no product in this category now", [])
        :   Util::getResponseArray(200, "Found products in category", $res);
    }


    public function insertProduct($name, $price, $description, $quantity, $category_id, $status, $image_urls) {
        
        // check some field are valid in private functions, if not return error message for the first invalid field
        $validMessage = $this->fieldAreValid($name, $price, $quantity, $category_id, $status)['message'];
        if ($validMessage !== "Valid") {
            return Util::getResponseArray(400, $validMessage, null);
        }
        
        if (!$status) {
            $status = $quantity == 0 ? "Sold Out" : "Available";
        }

        if ($status === "Sold Out"  &&  $quantity > 0) {
            return Util::getResponseArray(400, "Quantity and status 'Sold Out' are unreasonable", null);
        }

        if ($status === "Available" && $quantity == 0) {
            return Util::getResponseArray(400, "Quantity and status 'Available' are unreasonable", null);
        }

        $product = new Product();
        $respone = $product->insertProduct($name, $price, $description, $quantity, $category_id, $status);

        // print_r($respone);

        if ($respone['code'] != 201) return $respone;

        $product_id = $respone['data']['id'];

        // print_r($image_urls);
        if ($image_urls) {
            $productImageController = new ProductImageController();
            foreach ($image_urls as $url) {
                $productImageController->insertProductImage($product_id, $url);
            }
            $respone['message'] .= "\nProduct images created";
        }

        return $respone;
    }

    public function updateProductName($id, $name) {
        if (!$this->nameIsValidFormat($name)) {
            return Util::getResponseArray(400, "Name must be between 5 and 50 characters", null);
        }

        $product = new Product();
        return $product->updateName($id, $name);
    }

    public function updateProductPrice($id, $price) {
        if (!$this->priceIsValidValue($price)) {
            return Util::getResponseArray(400, "Price must be a positive number", null);
        }

        $product = new Product();
        return $product->updatePrice($id, $price);
    }

    public function updateProductQuantity($id, $quantity) {
        if (!$this->quantityIsValidValue($quantity)) {
            return Util::getResponseArray(400, "Quantity must be a non-negative integer", null);
        }

        $product = new Product();

        $currentProductStatus = $product->getById($id)[0]['status'];
        if($quantity == 0 && $currentProductStatus == 'Available') {
            $product->updateStatus($id, 'Sold Out');
        } else if ($quantity > 0 && $currentProductStatus == 'Sold Out') {
            $product->updateStatus($id, 'Available');
        }
        return $product->updateQuantity($id, $quantity);
    }

    public function updateProductDescription($id, $description) {
        $product = new Product();
        return $product->updateDescription($id, $description);
    }

    public function updateProductStatus($id, $status) {
        if (!$this->statusIsValidValue($status)) {
            return Util::getResponseArray(400, "Status must be 'Available', 'Stop Selling' or 'Sold Out'", null);
        }
        
        $product = new Product();

        $currentProductQuantity = $product->getById($id)[0]['quantity'];

        if ($status == 'Sold Out' && $currentProductQuantity > 0) {
            return Util::getResponseArray(400, "Current quantity of this product is greater than 0, cannot set status to 'Sold Out'", null);
        } else if($status == 'Available' && $currentProductQuantity == 0) {
            return Util::getResponseArray(400, "Current quantity of this product is 0, cannot set status to 'Available'", null);
        }

        return $product->updateStatus($id, $status);
    }


    public function updateProductCategory($id, $category_id) {
        // if (!$this->categoryIdIsValidValue($category_id)) {
        //     return Util::getResponseArray(400, "Category not exist", null);
        // }

        $product = new Product();
        return $product->updateCategoryId($id, $category_id);
    }


    public function deleteProduct($id) {
        $product = new Product();
        return $product->deleteById($id);
    }

    public function deleteAllProducts() {
        $product = new Product();
        return $product->deleteAll();
    }

    public function searchProducts($key, $offset, $limit) {

        $tokens = array_filter(explode(' ', trim($key)));

        $product = new Product();

        $res = [];
        foreach ($tokens as $_ => $token) {
            $thisTokenProducts = $product->searchProductByToken($token);
            if (isset($thisTokenProducts['code'])) return $thisTokenProducts;

            $existedProductIds = array_column($res, 'id');
            foreach ($thisTokenProducts as $p) {
                if (!in_array($p['id'], $existedProductIds)) {
                    $res[$p['id']]  = $p;
                }
            }
        }

        // print_r($res);
        if (empty($res)) {
            return Util::getResponseArray(200, "There is no product match your search", []);
        }

        ksort($res);
        $page_count = ceil(count($res) / $limit);
        $res = array_slice($res, $offset, $limit);
        $data = [
            "page_count" => $page_count,
            "data" => $res
        ];
        return Util::getResponseArray(200, "Found products", $data);
    }

}

?>