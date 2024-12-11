-- user-defined error code:

-- 45200: general successful operation
-- 45201: successful created
-- 45202: successful updated
-- 45204: successful deleted

-- 45400: invalid value for a given argument (wrong data type, wrong format, etc.)
-- 45401: duplicate unique value
-- 45404: not found



-- POST
DROP PROCEDURE IF EXISTS insertReview;
DELIMITER // CREATE PROCEDURE insertReview (
    IN _customer_id INT,
    IN _product_id INT,
    IN _rating INT,
    IN _comment TEXT
) BEGIN

    CALL checkExist('users', 'id', _customer_id, @isExistCustomer);
    IF NOT @isExistCustomer THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'Customer not found';
    END IF;

    CALL checkExist('products', 'id', _product_id, @isExistProduct);
    IF NOT @isExistProduct THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'Product not found';
    END IF;

    INSERT INTO reviews(customer_id, product_id, rating, comment) VALUES
        (_customer_id, _product_id, _rating, _comment);

    SELECT LAST_INSERT_ID() AS id;
END // DELIMITER ;


DROP PROCEDURE IF EXISTS findAllByProductId;
DELIMITER // CREATE PROCEDURE findAllByProductId (IN _product_id INT) 
BEGIN CALL findAllByField('reviews', 'product_id', _product_id); END // DELIMITER ;


DROP PROCEDURE IF EXISTS findAllByUserId;
DELIMITER // CREATE PROCEDURE findAllByUserId (IN _user_id INT) 
BEGIN CALL findAllByField('reviews', 'customer_id', _user_id); END // DELIMITER ;


DROP PROCEDURE IF EXISTS updateReviewRating;
DELIMITER // CREATE PROCEDURE updateReviewRating (IN _id INT, IN _rating INT)
BEGIN CALL updateFieldById('reviews', _id, 'rating', _rating); END // DELIMITER ;

DROP PROCEDURE IF EXISTS updateReviewComment;
DELIMITER // CREATE PROCEDURE updateReviewComment (IN _id INT, IN _comment TEXT)
BEGIN CALL updateFieldById('reviews', _id, 'comment', _comment); END // DELIMITER ;



CALL findAll('users');


CALL findAll('products');


CALL insertReview(1, 3, 3, 'Điện thoại Iphone 17 này thật tuyệt!');

CALL insertReview(1, 6, 4, 'Cà phê này uống tỉnh vãi');

CALL insertReview(1, 3, 4, 'Tôi mua một lần nữa, vẫn rất hài lòng');

CALL insertReview(2, 5, 6, 'Thitk hổ này ngon quá');

CALL insertReview(2, 3, 1, 'Điện thoại này không đáng tiền');

CALL updateReviewRating(4, 1);

CALL updateReviewComment(4, 'Thịt hổ này không ngon như tôi nghĩ');

CALL findAllByProductId(3);

CALL findAllByUserId(1);

CALL findAll('reviews');