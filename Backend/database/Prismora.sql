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
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    name                    VARCHAR(50)                 UNIQUE                          NOT NULL
);

CREATE TABLE products (
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    name                    VARCHAR(255)                 UNIQUE                         NOT NULL,
    price                   INT                                             NOT NULL,
    quantity                INT                                                         NOT NULL,
    description             TEXT,
    category_id             INT,
    buy_count               INT                         DEFAULT 0                       NOT NULL,
    rating_count            INT                         DEFAULT 0                       NOT NULL,
    avg_rating              DECIMAL(2, 1)               DEFAULT 0.0                     NOT NULL,
    creation_date           TIMESTAMP                   DEFAULT CURRENT_TIMESTAMP       NOT NULL,
    status                  ENUM('Available', 'Stop Selling', 'Sold Out')
                                                        DEFAULT 'Available'             NOT NULL,

    CONSTRAINT FK_products__categories
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);


CREATE TABLE product_images (
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    product_id              INT                                                         NOT NULL,
    url                     VARCHAR(255)                                                NOT NULL,

    CONSTRAINT FK_product_images__products
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,

    UNIQUE(product_id, url)
);


-- SELECT * FROM products;

-- DELETE FROM products WHERE id > 25;

-- SELECT * FROM product_images;


CREATE TABLE orders (
    id                      INT                         AUTO_INCREMENT                  PRIMARY KEY,
    customer_id             INT                                                         NOT NULL,
    total_price             INT                         DEFAULT 0                       NOT NULL,
    creation_date           TIMESTAMP                   DEFAULT CURRENT_TIMESTAMP       NOT NULL,
    shipping_address        TEXT                                                        NOT NULL,
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
    subtotal_price          INT                         DEFAULT 0                       NOT NULL,

    UNIQUE(order_id, product_id),

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
    time                    TIMESTAMP                   DEFAULT CURRENT_TIMESTAMP       NOT NULL,

    CHECK (rating >= 1 AND rating <= 5),

    CONSTRAINT FK_reviews__product_in_orders
    FOREIGN KEY (product_id) REFERENCES product_in_orders(product_id),

    CONSTRAINT FK_reviews__orders
    FOREIGN KEY (customer_id) REFERENCES orders(customer_id)
);