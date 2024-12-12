<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../lib/utils.php';

class Order {

    private $conn;

    public function __construct() {
        $this->conn = Database::connect(); // get connection from database.php
    }


    public function fetch($offset, $limit) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $page_count = Util::getPageCount('orders', $limit);
            $stmt = $this->conn->prepare("CALL findAll('orders', ?, ?)");
            $stmt->bind_param("ii", $offset, $limit);
            $stmt->execute();
            $table = $stmt->get_result();
            $arr = Util::fetch($table);
            $stmt->close();
            return [ "page_count" => $page_count, "data" => $arr ];     
        } catch (mysqli_sql_exception $e) {
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function getById($id) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $stmt = $this->conn->prepare("CALL findById('orders', ?)");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $table = $stmt->get_result();
            $order = Util::fetch($table)[0];
            $stmt->close();

            $stmt = $this->conn->prepare("CALL findDetailOrder(?)");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $table = $stmt->get_result();
            $products = Util::fetch($table);
            $stmt->close();

            $order['products'] = $products;
            // $data = ["order" => $order, "products" => $products];
            return $order;
        } catch (mysqli_sql_exception $e) {
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    public function fetchByProductId($product_id, $offset, $limit) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $page_count = Util::getPageCountByField('orders', 'product_id', $product_id, $limit);
            $stmt = $this->conn->prepare("CALL findAllByField('orders', 'product_id', ?, ?, ?)");
            $stmt->bind_param("iii", $product_id, $offset, $limit);
            $stmt->execute();
            $table = $stmt->get_result();
            $arr = Util::fetch($table);
            $stmt->close();
            return [ "page_count" => $page_count, "data" => $arr ];
        } catch (mysqli_sql_exception $e) {   
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }


    public function fetchByUserId($customer_id, $offset, $limit) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $page_count = Util::getPageCountByField('orders', 'customer_id', $customer_id, $limit);
            $stmt = $this->conn->prepare("CALL findAllByField('orders', 'customer_id', ?, ?, ?)");
            $stmt->bind_param("iii", $customer_id, $offset, $limit);
            $stmt->execute();
            $table = $stmt->get_result();
            $arr = Util::fetch($table);
            $stmt->close();
            return [ "page_count" => $page_count, "data" => $arr ];
        } catch (mysqli_sql_exception $e) {   
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }

    // public function findById($id) {
    //     mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    //     try {
    //         $stmt = $this->conn->prepare("CALL findById('orders', ?)");
    //         $stmt->bind_param("i", $id);
    //         $stmt->execute();
    //         $table = $stmt->get_result();
    //         $arr = Util::fetch($table);
    //         $stmt->close();
    //         return $arr;
    //     } catch (mysqli_sql_exception $e) {
    //         return Util::getResponseArray(400, $e->getMessage(), null);
    //     }
    // }

    public function insertOrder($customer_id, $product_id, $quantity, $shipping_address) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL insertOrder(?, ?)");
            $stmt->bind_param("is", $customer_id, $shipping_address);
            $stmt->execute();
            $result = $stmt->get_result();
            $order_id = $result->fetch_assoc()['id'];
            $res = Util::getResponseArray(201, "Order created", ["id" => $order_id]);
            $stmt->close();

            $stmt = $this->conn->prepare("CALL insertProductInOrder(?, ?, ?)");
            $stmt->bind_param("iii", $order_id, $product_id, $quantity);
            $stmt->execute();
            $stmt->close();
            $res['message'] .= "\nCreated product in order";
            return $res;
        } catch (mysqli_sql_exception $e) {
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }


    public function updateStatus($id, $status) {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $stmt = $this->conn->prepare("CALL updateOrderStatus(?, ?)");
            $stmt->bind_param("is", $id, $status);
            $stmt->execute();
            $stmt->close();
            return Util::getResponseArray(200, "Status updated", null);
        } catch (mysqli_sql_exception $e) {
            return Util::getResponseArray(400, $e->getMessage(), null);
        }
    }
}

?>