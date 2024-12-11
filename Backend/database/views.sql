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