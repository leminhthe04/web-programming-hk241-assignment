<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../lib/utils.php';

class Review {

    private $conn;

    public function __construct() {
        $this->conn = Database::connect(); // get connection from database.php
    }

    public function getAll() {
        $stmt = $this->conn->prepare("CALL findAll('reviews')");
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = fetch($table);
        if ($table) $table->free();
        $stmt->close();
        return $arr;        
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("CALL findById('reviews', ?)");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = fetch($table);
        if($table) $table->free();
        $stmt->close();
        return $arr;
    }

    public function getAllByProductId($product_id){
        $stmt = $this->conn->prepare("CALL findAllByProductId(?)");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = fetch($table);
        if($table) $table->free();
        $stmt->close();
        return $arr;
    }

    public function getAllByUserId($user_id){
        $stmt = $this->conn->prepare("CALL findAllByUserId(?)");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = fetch($table);
        if($table) $table->free();
        $stmt->close();
        return $arr;
    }

    // INSERT INTO reviews(customer_id, product_id, rating, comment) VALUES
    // (_customer_id, _product_id, _rating, _comment);
    public function insertReview($customer_id, $product_id, $rating, $comment) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL insertReview(?, ?, ?, ?)");
            $stmt->bind_param("iiis", $customer_id, $product_id, $rating, $comment);
            $stmt->execute();
            $result = $stmt->get_result();
            $res = getResponseArray(201, "Review created", ["id" => $result->fetch_assoc()['id']]);
            $result->free();
            $stmt->close();
            return $res;
        } catch (mysqli_sql_exception $e) {
            return getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateRating($id, $rating) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateReviewRating(?, ?)");
            $stmt->bind_param("ii", $id, $rating);
            $stmt->execute();
            $stmt->close();
            return getResponseArray(200, "Rating updated", null);
        } catch (mysqli_sql_exception $e) {
            return getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateComment($id, $comment) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateReviewComment(?, ?)");
            $stmt->bind_param("is", $id, $comment);
            $stmt->execute();
            $stmt->close();
            return getResponseArray(200, "Comment updated", null);
        } catch (mysqli_sql_exception $e) {
            return getResponseArray(400, $e->getMessage(), null);
        }
    }
}

?>