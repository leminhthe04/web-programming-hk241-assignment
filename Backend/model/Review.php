<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../lib/utils.php';

class Review {

    private $conn;

    public function __construct() {
        $this->conn = Database::connect(); // get connection from database.php
    }

    public function getAll($offset, $limit) {
        $page_count = Util::getPageCount('reviews', $limit);

        $stmt = $this->conn->prepare("CALL findAll('reviews', ?, ?)");
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $table = $stmt->get_result();
        $arr = Util::fetch($table);
        if ($table) $table->free();
        $stmt->close();
        return [ "page_count" => $page_count, "data" => $arr];
    }

    public function getById($id) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try{
            $stmt = $this->conn->prepare("CALL findById('reviews', ?)");
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

    public function getAllByProductId($product_id, $offset, $limit) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        try {
            $page_count = Util::getPageCountByField('reviews', 'product_id', $product_id, $limit);

            $stmt = $this->conn->prepare("CALL findAllReviewByProductId(?, ?, ?)");
            $stmt->bind_param("iii", $product_id, $offset, $limit);
            $stmt->execute();
            $table = $stmt->get_result();
            $arr = Util::fetch($table);
            if($table) $table->free();
            $stmt->close();
            return [ "page_count" => $page_count, "data" => $arr];
        } catch (mysqli_sql_exception $e) {
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function getAllByUserId($user_id, $offset, $limit) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $page_count = Util::getPageCountByField('reviews', 'customer_id', $user_id, $limit);

            $stmt = $this->conn->prepare("CALL findAllReviewByUserId(?, ?, ?)");
            $stmt->bind_param("iii", $user_id, $offset, $limit);
            $stmt->execute();
            $table = $stmt->get_result();
            $arr = Util::fetch($table);
            if($table) $table->free();
            $stmt->close();
            return [ "page_count" => $page_count, "data" => $arr];
        } catch (mysqli_sql_exception $e) {
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
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
            $res = Util::getResponseArray(201, "Review created", ["id" => $result->fetch_assoc()['id']]);
            $result->free();
            $stmt->close();
            return $res;
        } catch (mysqli_sql_exception $e) {
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateRating($id, $rating) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $stmt = $this->conn->prepare("CALL updateReviewRating(?, ?)");
            $stmt->bind_param("ii", $id, $rating);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Rating updated", null);
        } catch (mysqli_sql_exception $e) {
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function updateComment($id, $comment) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $stmt = $this->conn->prepare("CALL updateReviewComment(?, ?)");
            $stmt->bind_param("is", $id, $comment);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Comment updated", null);
        } catch (mysqli_sql_exception $e) {
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }
}

?>