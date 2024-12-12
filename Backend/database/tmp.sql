USE prismora;

MYSQLDUMP -u lemin -p prismora > tmp1.sql

CREATE DATABASE exclusive;

MYSQL -u lemin -p exclusive < tmp.sql