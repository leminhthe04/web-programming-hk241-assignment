<?php

require_once __DIR__ . '/../model/Review.php';

class ReviewController {

    private function ratingIsValidValue($rating) {
        return filter_var($rating, FILTER_VALIDATE_INT) && 
               $rating > 0 && $rating <= 5;
    }
    private function commentIsValidValue($comment) {
        return $comment === null || strlen($comment) <= 1000;
    }

    private function fieldAreValid($rating, $comment) {
        if (!$this->ratingIsValidValue($rating))
            return ["message" => "Rating must be an integer between 1 and 5"];
        if (!$this->commentIsValidValue($comment))
            return ["message" => "Comment must be less than 1000 characters"];
        return ["message" => "Valid"];
    }

    public function fetch($offset, $limit) {
        $review = new Review();
        $res = $review->getAll($offset, $limit); // a fetch array or null
        if (isset($res['code'])) return $res;
        return empty($res['data']) ? 
            Util::getResponseArray(200, "There is no review in system now", [])
        :   Util::getResponseArray(200, "Found all reviews", $res);
    }

    public function getById($id) {
        $review = new Review();
        $res = $review->getById($id);
        if (isset($res['code'])) return $res;
        return Util::getResponseArray(200, "Review found", $res);
    }

    public function fetchByProductId($product_id, $offset, $limit) {
        $review = new Review();
        $res = $review->getAllByProductId($product_id, $offset, $limit);
        if (isset($res['code'])) return $res;
        return empty($res['data']) ? 
            Util::getResponseArray(200, "There is no review of this product", [])
        :   Util::getResponseArray(200, "Found reviews of product", $res);
    }

    public function fetchByUserId($user_id, $offset, $limit) {
        $review = new Review();
        $res = $review->getAllByUserId($user_id, $offset, $limit);
        if (isset($res['code'])) return $res;
        return empty($res['data']) ? 
            Util::getResponseArray(200, "There is no review of this user", [])
        :   Util::getResponseArray(200, "Found reviews of user", $res);
    }


    public function insertReview($customer_id, $product_id, $rating, $comment) {

        // check some field are valid in private functions, if not return error message for the first invalid field
        $validMessage = $this->fieldAreValid($rating, $comment)['message'];
        if ($validMessage !== "Valid") {
            return Util::getResponseArray(400, $validMessage, null);
        }
        
        $review = new Review();
        return $review->insertReview($customer_id, $product_id, $rating, $comment);
    }

    public function updateReviewRating($id, $rating) {
        if (!$this->ratingIsValidValue($rating)) {
            return Util::getResponseArray(400, "Rating must be an integer between 1 and 5", null);
        }

        $review = new Review();
        return $review->updateRating($id, $rating);
    }

    public function updateReviewComment($id, $comment) {
        if (!$this->commentIsValidValue($comment)) {
            return Util::getResponseArray(400, "Comment must be less than 1000 characters", null);
        }

        $review = new Review();
        return $review->updateComment($id, $comment);
    }
}

?>