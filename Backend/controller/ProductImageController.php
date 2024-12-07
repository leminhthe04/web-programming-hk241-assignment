<?php

require_once __DIR__ . '/../model/ProductImage.php';

class ProductImageController {

    private function urlIsValidValue($url) {
        return  $url  &&  strlen($url) <= 500;
    }

    private function fieldAreValid($url) {
        if (!$this->urlIsValidValue($url))
            return ["message" => "Url must be less than 500 characters"];
        return ["message" => "Valid"];
    }

    public function getAll() {
        $productImage = new ProductImage();
        $res = $productImage->getAll(); // a fetch array or null
        if ($res){
            return getResponseArray(200, "Found product images", $res);
        }
        
        return getResponseArray(200, "There is no product image in system now", []);
    }

    public function getById($id) {
        $productImage = new ProductImage();
        $res = $productImage->getById($id);

        if ($res) {
            return getResponseArray(200, "Product image found", $res);
        }
        return getResponseArray(404, "Product image not found", null);
    }

    public function getAllByProductId($product_id) {
        $productImage = new ProductImage();
        $res = $productImage->getAllByProductId($product_id);
        if ($res) {
            return getResponseArray(200, "Found images of product", $res);
        }
        return getResponseArray(200, "There is no image of this product", []);        
    }

    public function insertProductImage($product_id, $url) {
        
        // check field is valid in private function, if not return error message
        $validMessage = $this->fieldAreValid($url)['message'];
        if ($validMessage !== "Valid") {
            return getResponseArray(400, $validMessage, null);
        }
        
        $productImage = new ProductImage();
        return $productImage->insertProductImage($product_id, $url);
    }

    public function deleteProductImage($id) {
        $productImage = new ProductImage();
        return $productImage->deleteById($id);
    }
}

?>