<?php

require_once __DIR__ . '/../model/Order.php';

class OrderController {

    private function quantityIsValid($quantity) {
        return filter_var($quantity, FILTER_VALIDATE_INT) && $quantity > 0;
    }
    private function shippingAddressIsValid($shipping_address) {
        return strlen($shipping_address) >= 5 && strlen($shipping_address) <= 100;
    }
    private function statusIsValid($status) {
        return $status === "pending" || $status === "shipping" || $status === "completed";
    }
    private function fieldAreValid($quantity, $shipping_address) {
        if (!$this->quantityIsValid($quantity))
            return ["message" => "Quantity must be a positive integer"];
        if (!$this->shippingAddressIsValid($shipping_address))
            return ["message" => "Shipping address must be between 5 and 100 characters"];
        return ["message" => "Valid"];
    }

    public function fetch($offset, $limit) {
        $order = new Order();
        $res = $order->fetch($offset, $limit); // a fetch array or null
        if (isset($res['code'])) return $res;
        return empty($res['data']) ? 
            Util::getResponseArray(200, "There is no order in system now", [])
        :   Util::getResponseArray(200, "Found orders", $res);
    }

    public function getById($id) {
        $order = new Order();
        $res = $order->getById($id);
        if (isset($res['code'])) return $res;
        return Util::getResponseArray(200, "Order detail found", $res);
    }

    public function fetchByProductId($product_id, $offset, $limit) {
        $order = new Order();
        $res = $order->fetchByProductId($product_id, $offset, $limit);
        if (isset($res['code'])) return $res;
        return empty($res['data']) ? 
            Util::getResponseArray(200, "There is no order of this product", [])
        :   Util::getResponseArray(200, "Found orders of product", $res);
    }

    public function fetchByUserId($customer_id, $offset, $limit) {
        $order = new Order();
        $res = $order->fetchByUserId($customer_id, $offset, $limit);
        if (isset($res['code'])) return $res;
        return empty($res['data']) ? 
            Util::getResponseArray(200, "There is no order of this customer", [])
        :   Util::getResponseArray(200, "Found orders of customer", $res);
    }

    public function create($customer_id, $product_id, $quantity, $shipping_address) {
        $order = new Order();
        return $order->insertOrder($customer_id, $product_id, $quantity, $shipping_address);
    }

    public function updateStatus($id, $status) {
        if (!$this->statusIsValid($status)) {
            return Util::getResponseArray(400, "Status must be 'pending', 'shipping' or 'completed'", null);
        }
        $order = new Order();
        return $order->updateStatus($id, $status);
    }


}


?>