-- user-defined error code:

-- 45200: general successful operation
-- 45201: successful created
-- 45202: successful updated
-- 45204: successful deleted

-- 45400: invalid value for a given argument (wrong data type, wrong format, etc.)
-- 45401: duplicate unique value
-- 45404: not found



-- POST
-- $name, $price, $description, $quantity, $category_id, $status
DROP PROCEDURE IF EXISTS insertProductImage;
CREATE PROCEDURE insertProductImage (
    IN _product_id INT,
    IN _url VARCHAR(255)
) BEGIN
    CALL checkExist('products', 'id', _product_id, @isExistProduct);
    IF NOT @isExistProduct THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'Product not found';
    END IF;

    INSERT INTO product_images(product_id, url) VALUES (_product_id, _url);

    SELECT LAST_INSERT_ID() AS id;
END;


DROP PROCEDURE IF EXISTS findByProductId;
CREATE PROCEDURE findByProductId (IN _product_id INT)
BEGIN CALL findByUniqueField('product_images', 'product_id', _product_id); END;


CALL insertProductImage(1, 'https://hinh1.jpg');

CALL insertProductImage(1, 'https://hinh2.jpg');

CALL insertProductImage(2, 'https://hinh3.jpg');

CALL insertProductImage(2, 'https://hinh4.jpg');

CALL insertProductImage(3, 'https://hinh5.jpg');

CALL insertProductImage(3, 'https://hinh6.jpg');

CALL insertProductImage(3, 'https://hinh7.jpg');


CALL findAll('product_images');

CALL findById('product_images', 14);


