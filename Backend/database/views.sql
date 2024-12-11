USE prismora;

DROP VIEW IF EXISTS products_available;
CREATE VIEW products_available AS
SELECT * FROM products WHERE status = 'Available';

DROP VIEW IF EXISTS products_stop_selling;
CREATE VIEW products_stop_selling AS
SELECT * FROM products WHERE status = 'Stop Selling';

DROP VIEW IF EXISTS products_sold_out;
CREATE VIEW products_sold_out AS
SELECT * FROM products WHERE status = 'Sold Out';

DROP VIEW IF EXISTS bought_products;
CREATE VIEW bought_products AS
SELECT PIO.order_id, P.id AS product_id, P.name AS product_name, 
       P.price AS buy_price, PIO.quantity AS buy_quantity, PIO.subtotal_price
FROM product_in_orders PIO, products P
WHERE PIO.product_id = P.id;

DROP VIEW IF EXISTS user_histories;
CREATE VIEW user_histories AS
SELECT S.id AS user_id, O.id AS order_id
FROM users S, orders O 
WHERE S.id = O.customer_id;