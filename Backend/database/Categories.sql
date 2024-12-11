USE prismora;


-- POST
DROP PROCEDURE IF EXISTS insertCategory;
CREATE PROCEDURE insertCategory (
    IN _name VARCHAR(50)
) BEGIN

    CALL checkUniqueValue('categories', 'name', _name, @isUniqueName);
    IF NOT @isUniqueName THEN
        SIGNAL SQLSTATE '45401' 
               SET MESSAGE_TEXT = 'This category has been created before!';
    END IF;


    INSERT INTO categories(name) VALUES (_name);

    SELECT LAST_INSERT_ID() AS id;
END;



-- PUT
DROP PROCEDURE IF EXISTS updateCategoryName;
CREATE PROCEDURE updateCategoryName (IN _id INT, IN _name VARCHAR(50))
BEGIN 
    CALL checkUniqueValueForUpdate('categories', 'name', _name, _id, @isUniqueName);
    IF NOT @isUniqueName THEN
        SIGNAL SQLSTATE '45401' 
               SET MESSAGE_TEXT = 'This category has been created before!';
    END IF;

    CALL updateFieldById('categories', _id, 'name', _name); 
END;



-- CALL insertCategory('Fruits');

-- CALL insertCategory('Vegetables');

-- CALL insertCategory('Meat');

-- CALL insertCategory('Fish');

-- CALL insertCategory('Seafood');

CALL findAll('categories', 0, 10);

-- CALL updateCategoryName(1, 'Mangoes');

-- CALL deleteById('categories', 2);

-- CALL deleteAll('categories');