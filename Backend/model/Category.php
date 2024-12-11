<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../lib/utils.php';

class Category {

    private $conn;

    public function __construct() {
        $this->conn = Database::connect(); // get connection from database.php
    }


    public function getAll($offset, $limit) {
        $page_count = Util::getPageCount('categories', $limit);

        $stmt = $this->conn->prepare("CALL findAll('categories', ?, ?)");
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = Util::fetch($table);
        $stmt->close();
        return [ "page_count" => $page_count, "data" => $arr ];        
    }

    public function getById($id) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try{
            $stmt = $this->conn->prepare("CALL findById('categories', ?)");
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

    public function insertCategory($name) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL insertCategory(?)");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
            $res = Util::getResponseArray(201, "Category created", ["id" => $result->fetch_assoc()['id']]);
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
            $stmt = $this->conn->prepare("CALL updateCategoryName(?, ?)");
            $stmt->bind_param("is", $id, $name);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Name updated", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function deleteById($id) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL deleteById('categories', ?);");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Category deleted", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function deleteAll() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL deleteAll('categories')");
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "All categories deleted", null);
        } catch (mysqli_sql_exception $e) {
            
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }
}

?>