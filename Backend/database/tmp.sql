USE prismora;

SELECT * FROM orders O, product_in_orders PIO
WHERE O.id = PIO.order_id;

SELECT * FROM reviews;

SELECT * FROM products;

call insertReview(1, 1, 5, 'Sản phẩm này thật tuyệt');
call insertReview(2, 13, 3, 'Cái này cũng tàm tạm');
call insertReview(14, 8, 1, 'So bad');



call insertOrder(2, 'KTX khu B');
SELECT * FROM orders;
call insertProductInOrder(20, 13, 1);



