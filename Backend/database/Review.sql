USE prismora;

-- POST
DROP PROCEDURE IF EXISTS insertReview;
CREATE PROCEDURE insertReview (
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

    CALL checkExist('product_in_orders', 'product_id', _product_id, @isExistProduct);
    IF NOT @isExistProduct THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'Product not in any order';
    END IF;

    CALL checkExist('orders', 'customer_id', _customer_id, @isExistCustomer);
    IF NOT @isExistCustomer THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'This customer has not ordered this product';
    END IF;


    INSERT INTO reviews(customer_id, product_id, rating, comment) VALUES
        (_customer_id, _product_id, _rating, _comment);

    SET @current_rating_count = (SELECT rating_count FROM products WHERE id = _product_id);
    SET @current_rating = (SELECT avg_rating FROM products WHERE id = _product_id);
    SET @new_rating = (@current_rating * @current_rating_count + _rating) / (@current_rating_count + 1);
    UPDATE products
    SET avg_rating = @new_rating,
        rating_count = @current_rating_count + 1
    WHERE id = _product_id;


    SELECT LAST_INSERT_ID() AS id;
END;


DROP PROCEDURE IF EXISTS findAllReviewByProductId;
CREATE PROCEDURE findAllReviewByProductId (
    IN _product_id INT, 
    IN _offset INT, 
    IN _limit INT
) BEGIN

    CALL checkExist('products', 'id', _product_id, @isExistProduct);
    IF NOT @isExistProduct THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'Product not found';
    END IF;

    SELECT R.id AS review_id, R.product_id, U.id AS customer_id, U.name AS customer_name, R.rating, R.comment, R.time
    FROM reviews R, users U
    WHERE R.customer_id = U.id AND R.product_id = _product_id
    LIMIT _offset, _limit;
END;

DROP PROCEDURE IF EXISTS findAllReviewByUserId;
CREATE PROCEDURE findAllReviewByUserId (
    IN _user_id INT, 
    IN _offset INT, 
    IN _limit INT
) BEGIN 
    CALL checkExist('users', 'id', _user_id, @isExistUser);
    IF NOT @isExistUser THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'User not found';
    END IF;

    SELECT R.id AS review_id, R.product_id, U.id AS customer_id, U.name AS customer_name, R.rating, R.comment, R.time
    FROM reviews R, users U
    WHERE R.customer_id = U.id AND R.customer_id = _user_id
    LIMIT _offset, _limit;
END;

-- INSERT INTO reviews(customer_id, product_id, rating, comment) VALUES
--     (1, 1, 3, 'Điện thoại Iphone 17 này thật tuyệt!');
-- INSERT INTO reviews(customer_id, product_id, rating, comment) VALUES
--     (1, 1, 4, 'Sản phẩm này rất tốt');
-- INSERT INTO reviews(customer_id, product_id, rating, comment) VALUES
--     (2, 1, 4, 'Thật tuyệt!');


-- CALL findAllReviewByProductId(1, 0, 10);
-- CALL findAllReviewByUserId(1, 0, 10);

-- SELECT * FROM reviews;

DROP PROCEDURE IF EXISTS updateReviewRating;
CREATE PROCEDURE updateReviewRating (IN _id INT, IN _rating INT)
BEGIN CALL updateFieldById('reviews', _id, 'rating', _rating); END;

DROP PROCEDURE IF EXISTS updateReviewComment;
CREATE PROCEDURE updateReviewComment (IN _id INT, IN _comment TEXT)
BEGIN CALL updateFieldById('reviews', _id, 'comment', _comment); END;



-- CALL findAll('users');


-- CALL findAll('products');


-- CALL insertReview(1, 3, 3, 'Điện thoại Iphone 17 này thật tuyệt!');

-- CALL insertReview(1, 6, 4, 'Cà phê này uống tỉnh vãi');

-- CALL insertReview(1, 3, 4, 'Tôi mua một lần nữa, vẫn rất hài lòng');

-- CALL insertReview(2, 5, 6, 'Thitk hổ này ngon quá');

-- CALL insertReview(2, 3, 1, 'Điện thoại này không đáng tiền');

-- CALL updateReviewRating(4, 1);

-- CALL updateReviewComment(4, 'Thịt hổ này không ngon như tôi nghĩ');

-- CALL findAllByProductId(3);

-- CALL findAllByUserId(1);

-- CALL findAll('reviews');