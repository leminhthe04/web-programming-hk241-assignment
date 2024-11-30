CREATE DATABASE prismora;

USE prismora;


CREATE TABLE users (
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    name                    VARCHAR(50)                                                 NOT NULL,
    sex                     ENUM('M', 'F')                                              NOT NULL,
    avt_url                 TEXT                                                        NOT NULL,
    email                   VARCHAR(50)                 UNIQUE                          NOT NULL,
    password                VARCHAR(255)                                                NOT NULL,
    phone                   CHAR(10)                    UNIQUE                          NOT NULL,
    role                    ENUM ('admin', 'customer')  DEFAULT 'customer',
);

CREATE TABLE categories (
    name                    VARCHAR(50)                                                PRIMARY KEY
);

CREATE TABLE products (
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    name                    VARCHAR(50)                 UNIQUE                          NOT NULL,
    price                   DECIMAL(10, 2)                                              NOT NULL,
    quantity                INT                                                         NOT NULL,
    description             TEXT,
    category                VARCHAR(50)                                                 NOT NULL,
    price                   DECIMAL(10, 2)                                              NOT NULL,
    buy_count               INT                         DEFAULT 0,
    avg_rating              DECIMAL(2, 1)               DEFAULT 0.0,
    creation_date           TIMESTAMP                   DEFAULT CURRENT_TIMESTAMP,
    status                  ENUM('

    ADD CONSTRAINT FK_products_categories
    FOREIGN KEY (category) REFERENCES categories(name)
);


CREATE TABLE product_images (
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    product_id              INT                                                         NOT NULL,
    url                     TEXT                                                        NOT NULL,

    ADD CONSTRAINT FK_product_images_products
    FOREIGN KEY (product_id) REFERENCES products(id)
);


CREATE TABLE orders (
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    user_id                 INT                                                         NOT NULL,
    total_price             DECIMAL(10, 2)                                              NOT NULL,
    status                  ENUM('pending', 'shipping', 'completed') DEFAULT 'pending',
    creation_date           TIMESTAMP                   DEFAULT CURRENT_TIMESTAMP,

    ADD CONSTRAINT FK_orders_users
    FOREIGN KEY (user_id) REFERENCES users(id)
);