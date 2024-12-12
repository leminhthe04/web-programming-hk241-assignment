<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../lib/utils.php';
require_once __DIR__ . '/ProductImage.php';

class Product {

    private $conn;

    public function __construct() {
        $this->conn = Database::connect(); // get connection from database.php
    }


    public function getAll($offset, $limit) {
        $page_count = Util::getPageCount('products', $limit);

        $stmt = $this->conn->prepare("CALL findAllProducts(?, ?)");
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = Util::fetch($table);
        $stmt->close();

        // Get image for each product
        $productImage = new ProductImage();
        foreach ($arr as $key => $product) {

            $product['image'] = $productImage->getAllByProductId($product['id']);
            $arr[$key] = $product;
        }
        return [ "page_count" => $page_count, "data" => $arr ];        
    }

    public function getById($id) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL findById('products', ?)");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $table = $stmt->get_result();
            $arr = Util::fetch($table);
            if($table) $table->free();
            $stmt->close();

            Get image for this product
            $productImage = new ProductImage();
            $arr[0]['image'] = $productImage->getAllByProductId($id);

            return $arr;
        } catch (mysqli_sql_exception $e) {
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function getAllAvailable($offset, $limit) {
        $page_count = Util::getPageCount('products_available', $limit);
        $stmt = $this->conn->prepare("CALL findAll('products_available', ?, ?)");
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = Util::fetch($table);
        $stmt->close();
        return [ "page_count" => $page_count, "data" => $arr ];        
    }

    public function getAllStopSelling($offset, $limit) {
        $page_count = Util::getPageCount('products_stop_selling', $limit);
        $stmt = $this->conn->prepare("CALL findAll('products_stop_selling', ?, ?)");
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = Util::fetch($table);
        $stmt->close();
        return [ "page_count" => $page_count, "data" => $arr ];
    }

    public function getAllSoldOut($offset, $limit) {
        $page_count = Util::getPageCount('products_sold_out', $limit);
        $stmt = $this->conn->prepare("CALL findAll('products_sold_out', ?, ?)");
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = Util::fetch($table);
        $stmt->close();
        return [ "page_count" => $page_count, "data" => $arr ];
    }

    public function getAllByCategoryId($category_id, $offset, $limit) {
        $page_count = Util::getPageCountByField('products', 'category_id', $category_id, $limit);
        $stmt = $this->conn->prepare("CALL findAllByField('products', 'category_id', ?, ?, ?)");
        $stmt->bind_param("iii", $category_id, $offset, $limit);
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = Util::fetch($table);
        $stmt->close();

        // Get image for each product
        $productImage = new ProductImage();
        foreach ($arr as $key => $product) {
            $product['image'] = $productImage->getAllByProductId($product['id']);
            $arr[$key] = $product;
        }

        return [ "page_count" => $page_count, "data" => $arr ];
    }


    // INSERT INTO products(name, price, description, quantity, category_id, status) VALUES
    //  (_name, _price, _description, _quantity, _category_id, _status);
    public function insertProduct($name, $price, $description, $quantity, $category_id, $status) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL insertProduct(?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sdsiis", $name, $price, $description, $quantity, $category_id, $status);
            $stmt->execute();
            $result = $stmt->get_result();
            $res = Util::getResponseArray(201, "Product created", ["id" => $result->fetch_assoc()['id']]);
            $result->free();
            $stmt->close();
            return $res;
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateName($id, $name) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateProductName(?, ?)");
            $stmt->bind_param("is", $id, $name);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Name updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updatePrice($id, $price) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateProductPrice(?, ?)");
            $stmt->bind_param("id", $id, $price);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Price updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateDescription($id, $description) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateProductDescription(?, ?)");
            $stmt->bind_param("is", $id, $description);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Description updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateQuantity($id, $quantity) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateProductQuantity(?, ?)");
            $stmt->bind_param("ii", $id, $quantity);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Quantity updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateCategoryId($id, $category_id) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateProductCategoryId(?, ?)");
            $stmt->bind_param("ii", $id, $category_id);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Category ID updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateStatus($id, $status) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateProductStatus(?, ?)");
            $stmt->bind_param("is", $id, $status);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Status updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function deleteById($id) {

        // Actually, we just soft delete the product by setting its status to 'Stop Selling'
        $updateStatusResponse = $this->updateStatus($id, 'Stop Selling');
        if ($updateStatusResponse['code'] != 200) {
            return $updateStatusResponse;
        }

        return Util::getResponseArray(200, "Product soft deleted (by changing status to 'Stop Selling')", null);

        // try {
        //     $stmt = $this->conn->prepare("CALL deleteById('products', ?);");
        //     $stmt->bind_param("i", $id);
        //     $stmt->execute();
        //     $stmt->close();
        //     return Util::getResponseArray(200, "Product deleted", null);
        // } catch (mysqli_sql_exception $e) {
        //     return Util::getResponseArray(400, $e->getMessage(), null);
        // }
    }

    public function deleteAll() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        // Actually, we just soft delete all products by setting their status to 'Stop Selling'
        try {
            $stmt = $this->conn->prepare("CALL updateValueForWholeColumn('products', 'status', 'Stop Selling')");
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "All products soft deleted (by changing status to 'Stop Selling')", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
        
        // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        // try {
        //     $stmt = $this->conn->prepare("CALL deleteAll('products')");
        //     $stmt->execute();
        //     $stmt->close();
        //     return Util::getResponseArray(200, "All products deleted", null);
        // } catch (mysqli_sql_exception $e) {
        //     return Util::getResponseArray(400, $e->getMessage(), null);
        // }
    }

    public function searchProductByToken($token){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
       
        try {
            $stmt = $this->conn->prepare("CALL findByNameHasToken(?);");
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $table = $stmt->get_result();
            $arr = Util::fetch($table);
            if ($table) $table->free();
            $stmt->close();
            return $arr;
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }
}

?>