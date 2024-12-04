DROP DATABASE IF EXISTS prismora;
CREATE DATABASE prismora CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE prismora;



CREATE TABLE users (
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    name                    VARCHAR(50)                                                 NOT NULL,
    sex                     ENUM('M', 'F')                                              NOT NULL,
    avt_url                 TEXT                        DEFAULT NULL,
    address                 TEXT                                                        NOT NULL,
    email                   VARCHAR(50)                 UNIQUE                          NOT NULL,
    password                VARCHAR(255)                                                NOT NULL,
    phone                   CHAR(10)                    UNIQUE                          NOT NULL,
    role                    ENUM ('admin', 'customer')  DEFAULT 'customer'              NOT NULL
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
    buy_count               INT                         DEFAULT 0                       NOT NULL,
    avg_rating              DECIMAL(2, 1)               DEFAULT 0.0                     NOT NULL,
    creation_date           TIMESTAMP                   DEFAULT CURRENT_TIMESTAMP       NOT NULL,
    status                  ENUM('Available', 'Stop Selling', 'Sold Out')
                                                        DEFAULT 'Available'             NOT NULL,

    CONSTRAINT FK_products__categories
    FOREIGN KEY (category) REFERENCES categories(name)
);


CREATE TABLE product_images (
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    product_id              INT                                                         NOT NULL,
    url                     TEXT                                                        NOT NULL,

    CONSTRAINT FK_product_images__products
    FOREIGN KEY (product_id) REFERENCES products(id)
);


CREATE TABLE orders (
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    customer_id             INT                                                         NOT NULL,
    total_price             DECIMAL(10, 2)                                              NOT NULL,
    creation_date           TIMESTAMP                   DEFAULT CURRENT_TIMESTAMP       NOT NULL,
    status                  ENUM('pending', 'shipping', 'completed') 
                                                        DEFAULT 'pending'               NOT NULL,

    CONSTRAINT FK_orders__users
    FOREIGN KEY (customer_id) REFERENCES users(id)
);

CREATE TABLE product_in_orders (
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    order_id                INT                                                         NOT NULL,
    product_id              INT                                                         NOT NULL,
    quantity                INT                                                         NOT NULL,
    subtotal_price          DECIMAL(10, 2)                                              NOT NULL,

    CONSTRAINT FK_product_in_orders__orders
    FOREIGN KEY (order_id) REFERENCES orders(id),

    CONSTRAINT FK_product_in_orders__products
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE reviews (
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    customer_id             INT                                                         NOT NULL,
    product_id              INT                                                         NOT NULL,
    rating                  INT                                                         NOT NULL,
    comment                 TEXT,
    time                    TIMESTAMP                   DEFAULT CURRENT_TIMESTAMP       NOT NULL
);