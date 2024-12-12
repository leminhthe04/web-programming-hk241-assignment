USE prismora;

SELECT COUNT(*) FROM products
GROUP BY category_id;