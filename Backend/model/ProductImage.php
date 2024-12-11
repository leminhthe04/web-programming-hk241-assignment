<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../lib/utils.php';

class ProductImage {

    private $conn;

    public function __construct() {
        $this->conn = Database::connect(); // get connection from database.php
    }


    public function getAll() {
        $stmt = $this->conn->prepare("CALL findAll('product_images', 0, 99999)");
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = Util::fetch($table);
        if ($table) $table->free();
        $stmt->close();
        return $arr;        
    }

    public function getById($id) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $stmt = $this->conn->prepare("CALL findById('product_images', ?)");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $table = $stmt->get_result();
            $arr = Util::fetch($table);
            if($table) $table->free();
            $stmt->close();
            return $arr;
        } catch (mysqli_sql_exception $e) {
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function getAllByProductId($product_id) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL findByProductId(?)");
            $stmt->bind_param("i", $product_id);
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


    // INSERT INTO products(name, price, description, quantity, category_id, status) VALUES
    //  (_name, _price, _description, _quantity, _category_id, _status);
    public function insertProductImage($product_id, $url) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL insertProductImage(?, ?)");
            $stmt->bind_param("is", $product_id, $url);
            $stmt->execute();
            $result = $stmt->get_result();
            $res = Util::getResponseArray(201, "Product Image created", ["id" => $result->fetch_assoc()['id']]);
            $result->free();
            $stmt->close();
            return $res;
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }


    public function deleteById($id) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL deleteById('product_images', ?);");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Product Image deleted", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }
}

?>