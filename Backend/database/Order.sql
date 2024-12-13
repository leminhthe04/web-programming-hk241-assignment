USE prismora;



DROP PROCEDURE IF EXISTS findDetailOrder;
CREATE PROCEDURE findDetailOrder (
    IN _order_id INT
) BEGIN
    
    CALL checkExist('orders', 'id', _order_id, @isExistOrder);
    IF NOT @isExistOrder THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'Order not found';
    END IF;

    SELECT * FROM bought_products WHERE order_id = _order_id;
END;




DROP PROCEDURE IF EXISTS insertOrder;
CREATE PROCEDURE insertOrder (
    IN _customer_id INT,
    IN _shipping_address TEXT
) BEGIN

    CALL checkExist('users', 'id', _customer_id, @isExistCustomer);
    IF NOT @isExistCustomer THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'Customer not found';
    END IF;

    INSERT INTO orders(customer_id, shipping_address) VALUES 
    (_customer_id, _shipping_address);

    SELECT LAST_INSERT_ID() AS id;
END;


DROP PROCEDURE IF EXISTS insertProductInOrder;
CREATE PROCEDURE insertProductInOrder (
    IN _order_id INT,
    IN _product_id INT,
    IN _quantity INT
) BEGIN

    CALL checkExist('orders', 'id', _order_id, @isExistOrder);
    IF NOT @isExistOrder THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'Order not found';
    END IF;

    CALL checkExist('products', 'id', _product_id, @isExistProduct);
    IF NOT @isExistProduct THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'Product not found';
    END IF;

    IF EXISTS (SELECT * FROM product_in_orders WHERE order_id = _order_id AND product_id = _product_id) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Product already exists in order';
    END IF;

    SET @stored_quantity = (SELECT quantity FROM products WHERE id = _product_id);
    IF _quantity > @stored_quantity THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Not enough quantity for this product to add to order';
    END IF;
    UPDATE products 
    SET quantity = @stored_quantity - _quantity,
        buy_count = _quantity
    WHERE id = _product_id;

    SET @price = (SELECT price FROM products WHERE id = _product_id);
    INSERT INTO product_in_orders(order_id, product_id, quantity, subtotal_price) VALUES
        (_order_id, _product_id, _quantity, @price * _quantity);

    SET @current_order_total_price = (SELECT total_price FROM orders WHERE id = _order_id);
    SET @new_order_total_price = @current_order_total_price + @price * _quantity;
    UPDATE orders SET total_price = @new_order_total_price WHERE id = _order_id;

    SELECT LAST_INSERT_ID() AS id;
END;


DROP PROCEDURE IF EXISTS updateOrderStatus;
CREATE PROCEDURE updateOrderStatus (
    IN _order_id INT,
    IN _status VARCHAR(50)
) BEGIN

    CALL checkExist('orders', 'id', _order_id, @isExistOrder);
    IF NOT @isExistOrder THEN
        SIGNAL SQLSTATE '45404'
            SET MESSAGE_TEXT = 'Order not found';
    END IF;

    CALL updateFieldById('orders', _order_id, 'status', _status);
END;


-- CALL findAll('orders', 0, 10);


-- INSERT INTO products (id, name, price, quantity) VALUES (100, 'Mango', 100, 20);
-- INSERT INTO products (id, name, price, quantity) VALUES (101, 'Apple', 50, 30);
-- INSERT INTO orders (id, customer_id, shipping_address) VALUES (100, 1, "Tô Hiến Thành, Sơn Trà, Đà Nẵng");
-- CALL insertProductInOrder(100, 100, 2);
-- CALL insertProductInOrder(100, 101, 3);
-- SELECT * FROM product_in_orders WHERE order_id >= 100;
-- SELECT * FROM orders WHERE id >= 100;
-- SELECT * FROM products WHERE id >= 100;


-- SELECT * FROM orders;
-- CALL findById('orders', 100);

-- SET FOREIGN_KEY_CHECKS = 0;
-- DELETE FROM orders;
-- DELETE FROM product_in_orders WHERE order_id >= 100 AND product_id >= 100;
-- DELETE FROM orders WHERE id >= 100;
-- DELETE FROM products WHERE id >= 100;
-- SET FOREIGN_KEY_CHECKS = 1;