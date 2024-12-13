USE prismora;

DROP PROCEDURE IF EXISTS insertUser; 
CREATE PROCEDURE insertUser (
    IN _name VARCHAR(50),
    IN _sex ENUM('M', 'F'),
    IN _password VARCHAR(255),
    IN _email VARCHAR(50),
    IN _phone CHAR(10),
    IN _role ENUM('admin', 'customer'),
    IN _avt_url TEXT,
    IN _address TEXT
) BEGIN

    CALL checkUniqueValue('users', 'email', _email, @isUniqueEmail);
    IF NOT @isUniqueEmail THEN
        SIGNAL SQLSTATE '45401' 
               SET MESSAGE_TEXT = 'Email already exists in another account!';
    END IF;

    CALL checkUniqueValue('users', 'phone', _phone, @isUniquePhone);
    IF NOT @isUniquePhone THEN
        SIGNAL SQLSTATE '45401'
                SET MESSAGE_TEXT = 'Phone number already exists in another account!';
    END IF;


    INSERT INTO users(name, sex, password, email, phone, role, avt_url, address) VALUES
        (_name, _sex, _password, _email, _phone, _role, _avt_url, _address);

    SELECT LAST_INSERT_ID() AS id;
END;


DROP PROCEDURE IF EXISTS findUserHistory;
CREATE PROCEDURE findUserHistory (
    IN _user_id INT
) BEGIN
    CALL checkExist('users', 'id', _user_id, @isExistUser);
    IF NOT @isExistUser THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'User not found';
    END IF;

    SELECT * FROM user_histories WHERE user_id = _user_id;
END;


-- PUT
DROP PROCEDURE IF EXISTS updateUserName;
CREATE PROCEDURE updateUserName (IN _id INT, IN _name VARCHAR(50))
BEGIN CALL updateFieldById('users', _id, 'name', _name); END;

DROP PROCEDURE IF EXISTS updateUserSex;
CREATE PROCEDURE updateUserSex (IN _id INT, IN _sex ENUM('M', 'F'))
BEGIN CALL updateFieldById('users', _id, 'sex', _sex); END;

DROP PROCEDURE IF EXISTS updateUserPassword;
CREATE PROCEDURE updateUserPassword (IN _id INT, IN _password VARCHAR(255))
BEGIN CALL updateFieldById('users', _id, 'password', _password); END;

DROP PROCEDURE IF EXISTS updateUserEmail;
CREATE PROCEDURE updateUserEmail (IN _id INT, IN _email VARCHAR(50))
BEGIN 
    CALL checkUniqueValueForUpdate('users', 'email', _email, _id, @isUniqueEmail);
    IF NOT @isUniqueEmail THEN
        SIGNAL SQLSTATE '45401' 
               SET MESSAGE_TEXT = 'Email already exists in another account!';
    END IF;

    CALL updateFieldById('users', _id, 'email', _email); 
END;

DROP PROCEDURE IF EXISTS updateUserPhone;
CREATE PROCEDURE updateUserPhone (IN _id INT, IN _phone CHAR(10))
BEGIN 
    CALL checkUniqueValueForUpdate('users', 'phone', _phone, _id, @isUniquePhone);
    IF NOT @isUniquePhone THEN
        SIGNAL SQLSTATE '45401'
                SET MESSAGE_TEXT = 'Phone number already exists in another account!';
    END IF;

    CALL updateFieldById('users', _id, 'phone', _phone); 
END;

DROP PROCEDURE IF EXISTS updateUserRole;
CREATE PROCEDURE updateUserRole (IN _id INT, IN _role ENUM('admin', 'customer'))
BEGIN CALL updateFieldById('users', _id, 'role', _role); END;

DROP PROCEDURE IF EXISTS updateUserAvtUrl;
CREATE PROCEDURE updateUserAvtUrl (IN _id INT, IN _avt_url TEXT)
BEGIN CALL updateFieldById('users', _id, 'avt_url', _avt_url); END;

DROP PROCEDURE IF EXISTS updateUserAddress;
CREATE PROCEDURE updateUserAddress (IN _id INT, IN _address TEXT)
BEGIN CALL updateFieldById('users', _id, 'address', _address); END;


DROP PROCEDURE IF EXISTS updateUser;
CREATE PROCEDURE updateUser (
    IN _id INT,
    IN _name VARCHAR(50),
    IN _sex ENUM('M', 'F'),
    IN _password VARCHAR(255),
    IN _email VARCHAR(50),
    IN _phone CHAR(10),
    IN _role ENUM('admin', 'customer'),
    IN _avt_url TEXT,
    IN _address TEXT
)
BEGIN
    CALL updateUserName(_id, _name);
    CALL updateUserSex(_id, _sex);
    CALL updateUserPassword(_id, _password);
    CALL updateUserEmail(_id, _email);
    CALL updateUserPhone(_id, _phone);
    CALL updateUserRole(_id, _role);
    CALL updateUserAvtUrl(_id, _avt_url);
    CALL updateUserAddress(_id, _address);
END;





-- CALL insertUser('Nguyen Van B', 'M', '123456', 'nguyenB@gmail.com', '0123456790', 'admin', 'avt_url', '192 ĐPB, Q.1, TP.HCM');

-- CALL insertUser('Nguyen Van A', 'M', '123456', 'nguyenA@gmail.com', '0123456789', 'admin', 'avt_url', '193 ĐPB, Q.1, TP.HCM');

-- CALL insertUser('Nguyen Van C', 'M', '123456', 'nguyenC@gmail.com', '0123456791', 'admin', 'avt_url', '194 ĐPB, Q.1, TP.HCM');

-- CALL findAll('users');


-- -- CALL updateUser(2, 'Nguyen Van B', 'M', '123457', 'nguyenB1@gmail.com', '0123456795', 'customer', 'avt_url', '192 ĐPB, Q.1, TP.HCM');

-- CALL updateUserPassword(19, 'nguyenthibemuoimot2');
-- CALL updateUserPassword(4, 'nguyenvanc');
-- --  $sql = "CALL updateUserPassword($id, '$password')";
-- CALL updateUserPassword(16, '$argon2id$v=19$m=65536,t=4,p=1$ekxzLmNFTS9scW02dGNCSA$LbaD6p5IQ9k251zQVUrmSvQ9Fwt7+RSn8sZXuJXH3hk')

-- CALL deleteById('users', 2);


-- CALL deleteAll('users');

-- CALL findById('users', 5);

-- CALL findByUniqueField('users', 'email', 'leminhthe04@gmail.com');