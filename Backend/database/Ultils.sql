USE prismora;

DROP PROCEDURE IF EXISTS showColumns;
CREATE PROCEDURE showColumns (IN tableName VARCHAR(50))
BEGIN
    SELECT COLUMN_NAME, DATA_TYPE, IS_NULLABLE, COLUMN_DEFAULT
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME LIKE tableName;
END;



DROP PROCEDURE IF EXISTS findAll;
CREATE PROCEDURE findAll (IN _tableName VARCHAR(50))
BEGIN
    SET @tableName = _tableName;
    SET @query = CONCAT('SELECT * FROM ', @tableName);
    PREPARE stmt FROM @query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END;


DROP PROCEDURE IF EXISTS findAllByField;
CREATE PROCEDURE findAllByField (
    IN _tableName VARCHAR(50),
    IN _columnName VARCHAR(50),
    IN _value VARCHAR(255)
)
BEGIN
    SET @tableName = _tableName;
    SET @columnName = _columnName;
    SET @value = _value;

    SET @query = CONCAT('SELECT * FROM ', @tableName, ' WHERE ', @columnName, ' = ?');
    PREPARE stmt FROM @query;
    EXECUTE stmt USING @value;

    DEALLOCATE PREPARE stmt;
END;


DROP PROCEDURE IF EXISTS checkUniqueValue;
CREATE PROCEDURE checkUniqueValue (
    IN _tableName VARCHAR(50),
    IN _columnName VARCHAR(50),
    IN _value VARCHAR(255),
    OUT isUnique BOOLEAN
)
BEGIN

    SET @query = CONCAT(
        'SELECT NOT EXISTS (SELECT 1 FROM ', _tableName, 
        ' WHERE ', _columnName, ' = ?) INTO @result'
    );

    PREPARE stmt FROM @query;
    SET @value = _value;
    EXECUTE stmt USING @value;

    SET isUnique = @result;

    DEALLOCATE PREPARE stmt;
END;


-- check if the value is unique in the table, except for the record with the given id (record to be updated)
DROP PROCEDURE IF EXISTS checkUniqueValueForUpdate;
CREATE PROCEDURE checkUniqueValueForUpdate (
    IN _tableName VARCHAR(50),
    IN _columnName VARCHAR(50),
    IN _value VARCHAR(255),
    IN _id INT,
    OUT isUnique BOOLEAN
)
BEGIN

    SET @query = CONCAT(
        'SELECT COUNT(*) INTO @result FROM ', _tableName, 
        ' WHERE ', _columnName, ' = ? AND id != ?;'
    );


    PREPARE stmt FROM @query;
    SET @value = _value;
    SET @id = _id;
    EXECUTE stmt USING @value, @id;

    SET isUnique = (@result = 0);

    DEALLOCATE PREPARE stmt;
END;



DROP PROCEDURE IF EXISTS checkExist;
CREATE PROCEDURE checkExist (
    IN _tableName VARCHAR(50),
    IN _columnName VARCHAR(50),
    IN _value VARCHAR(255),
    OUT isExist BOOLEAN
)
BEGIN
    SET @tableName = _tableName;
    SET @columnName = _columnName;
    SET @value = _value;

    SET @checkQuery = CONCAT('SELECT COUNT(*) INTO @countRec FROM ', @tableName, ' WHERE ', @columnName, ' = ?');
    PREPARE stmtCheck FROM @checkQuery;
    EXECUTE stmtCheck USING @value;

    SET isExist = (@countRec > 0);

    DEALLOCATE PREPARE stmtCheck;
END;


DROP PROCEDURE IF EXISTS findById;
CREATE PROCEDURE findById (
    IN _tableName VARCHAR(255),
    IN _id INT
)
BEGIN

    CALL checkExist(_tableName, 'id', _id, @isExist);
    IF NOT @isExist THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Record not found';
    END IF;

    SET @tableName = _tableName;
    SET @id = _id;

    SET @query = CONCAT('SELECT * FROM ', @tableName, ' WHERE id = ?');
    PREPARE stmt FROM @query;
    EXECUTE stmt USING @id;

    DEALLOCATE PREPARE stmt;
END;



DROP PROCEDURE IF EXISTS findByUniqueField;
CREATE PROCEDURE findByUniqueField (
    IN _tableName VARCHAR(255),
    IN _columnName VARCHAR(255),
    IN _value VARCHAR(255)
)
BEGIN
    
    CALL checkExist(_tableName, _columnName, _value, @isExist);
    IF NOT @isExist THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Record not found';
    END IF;

    SET @tableName = _tableName;
    SET @columnName = _columnName;
    SET @value = _value;

    SET @query = CONCAT('SELECT * FROM ', @tableName, ' WHERE ', @columnName, ' = ?');
    PREPARE stmt FROM @query;
    EXECUTE stmt USING @value;

    DEALLOCATE PREPARE stmt;
END;




DROP PROCEDURE IF EXISTS updateFieldById;
CREATE PROCEDURE updateFieldById (
    IN _tableName VARCHAR(255),
    IN _id INT,
    IN _columnName VARCHAR(255),
    IN _value VARCHAR(255)
)
BEGIN

    CALL checkExist(_tableName, 'id', _id, @isExist);
    IF NOT @isExist THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Record not found';
    END IF;

    SET @tableName = _tableName;
    SET @id = _id;
    SET @columnName = _columnName;
    SET @value = _value;

    SET @query = CONCAT('UPDATE ', @tableName, ' SET ', @columnName, ' = ? WHERE id = ?');
    PREPARE stmt FROM @query;
    EXECUTE stmt USING @value, @id;

    DEALLOCATE PREPARE stmt;
END;



DROP PROCEDURE IF EXISTS deleteById;
CREATE PROCEDURE deleteById (
    IN _tableName VARCHAR(255),
    IN _id INT
)
BEGIN

    CALL checkExist(_tableName, 'id', _id, @isExist);

    SET @tableName = _tableName;
    SET @id = _id;

    SET @query = CONCAT('DELETE FROM ', @tableName, ' WHERE id = ?');
    PREPARE stmt FROM @query;
    EXECUTE stmt USING @id;

    DEALLOCATE PREPARE stmt;
END;


DROP PROCEDURE IF EXISTS deleteAll;
CREATE PROCEDURE deleteAll (IN _tableName VARCHAR(50))
BEGIN
    SET @tableName = _tableName;
    SET @query = CONCAT('DELETE FROM ', @tableName);
    PREPARE stmt FROM @query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END;


DROP PROCEDURE IF EXISTS updateValueForWholeColumn;
CREATE PROCEDURE updateValueForWholeColumn (
    IN _tableName VARCHAR(255),
    IN _columnName VARCHAR(255),
    IN _value VARCHAR(255)
)
BEGIN
    SET @tableName = _tableName;
    SET @columnName = _columnName;
    SET @value = _value;

    SET @query = CONCAT('UPDATE ', @tableName, ' SET ', @columnName, ' = ?');
    PREPARE stmt FROM @query;
    EXECUTE stmt USING @value;

    DEALLOCATE PREPARE stmt;
END;


DROP PROCEDURE IF EXISTS findByFieldHasToken;
CREATE PROCEDURE findByFieldHasToken (
    IN _tableName VARCHAR(255),
    IN _columnName VARCHAR(255),
    IN _token VARCHAR(255)
)
BEGIN
    SET @tableName = _tableName;
    SET @columnName = _columnName;
    SET @token = _token;

    SET @query = CONCAT("SELECT * FROM ", @tableName, " WHERE ", @columnName, " LIKE '%", @token, "%';");
    PREPARE stmt FROM @query;
    EXECUTE stmt;

    DEALLOCATE PREPARE stmt;
END;
