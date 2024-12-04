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
DROP PROCEDURE IF EXISTS insertProduct;
CREATE PROCEDURE insertProduct (
    IN _name VARCHAR(50),
    IN _price DECIMAL(10, 2),
    IN _description TEXT,
    IN _quantity INT,
    IN _category_id INT,
    IN _status ENUM('Available', 'Stop Selling', 'Sold Out')
) BEGIN

    CALL checkUniqueValue('products', 'name', _name, @isUniqueName);
    IF NOT @isUniqueName THEN
        SIGNAL SQLSTATE '45401' 
               SET MESSAGE_TEXT = 'This product name already exists!';
    END IF;

    IF _category_id IS NOT NULL THEN
        CALL checkExist('categories', 'id', _category_id, @isExistCategory);
        IF NOT @isExistCategory THEN
            SIGNAL SQLSTATE '45404'
                SET MESSAGE_TEXT = 'Category not found';
        END IF;
    END IF;

    INSERT INTO products(name, price, description, quantity, category_id, status) VALUES
        (_name, _price, _description, _quantity, _category_id, _status);

    SELECT LAST_INSERT_ID() AS id;
END;



-- PUT
DROP PROCEDURE IF EXISTS updateProductName;
CREATE PROCEDURE updateProductName (IN _id INT, IN _name VARCHAR(50))
BEGIN 
    CALL checkUniqueValueForUpdate('products', 'name', _name, _id, @isUniqueName);
    IF NOT @isUniqueName THEN
        SIGNAL SQLSTATE '45401' 
               SET MESSAGE_TEXT = 'This product name already exists!';
    END IF;

    CALL updateFieldById('products', _id, 'name', _name); 
END;

DROP PROCEDURE IF EXISTS updateProductPrice;
CREATE PROCEDURE updateProductPrice (IN _id INT, IN _price DECIMAL(10, 2))
BEGIN CALL updateFieldById('products', _id, 'price', _price); END;

DROP PROCEDURE IF EXISTS updateProductDescription;
CREATE PROCEDURE updateProductDescription (IN _id INT, IN _description TEXT)
BEGIN CALL updateFieldById('products', _id, 'description', _description); END;

DROP PROCEDURE IF EXISTS updateProductQuantity;
CREATE PROCEDURE updateProductQuantity (IN _id INT, IN _quantity INT)
BEGIN CALL updateFieldById('products', _id, 'quantity', _quantity); END;


DROP PROCEDURE IF EXISTS updateProductCategoryId;
CREATE PROCEDURE updateProductCategoryId (IN _id INT, IN _category_id INT)
BEGIN 
    
    IF _category_id IS NOT NULL THEN
        CALL checkExist('categories', 'id', _category_id, @isExistCategory);
        IF NOT @isExistCategory THEN
            SIGNAL SQLSTATE '45404'
                SET MESSAGE_TEXT = 'Category not found';
        END IF;
    END IF;

    CALL updateFieldById('products', _id, 'category_id', _category_id); 
END;


DROP PROCEDURE IF EXISTS updateProductStatus;
CREATE PROCEDURE updateProductStatus (IN _id INT, IN _status ENUM('Available', 'Stop Selling', 'Sold Out'))
BEGIN CALL updateFieldById('products', _id, 'status', _status); END;



DROP PROCEDURE IF EXISTS findByNameHasToken;
CREATE PROCEDURE findByNameHasToken (IN _token VARCHAR(255))
BEGIN CALL findByFieldHasToken('products', 'name', _token); END;



CALL insertProduct("Iphone 15", 1000.00, "The best phone ever", 100, 12);

CALL insertProduct("Iphone 16", 1000.00, "The best phone ever", 100, 13);

CALL insertProduct("Iphone 17", 1000.00, "The best phone ever", 100, 15);

CALL insertProduct("Lion", 2000.23, "The king of the jungle", 10, 13);

CALL insertProduct("Tiger", 2000.23, "The king of the jungle", 13, 14);


CALL findAll('products');


CALL updateProductName(1, 'Iphone 21');

CALL updateProductPrice(5, 99999.00);

CALL updateProductDescription(1, 'It is not the best phone ever');

CALL updateProductQuantity(1, 2000);

CALL updateProductCategoryId(1, 15);

CALL updateProductStatus(1, 'Stop Selling');

UPDATE products SET status = 'Stop Selling';


CALL findByNameHasToken('k');


