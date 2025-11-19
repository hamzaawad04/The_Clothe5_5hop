DROP DATABASE IF EXISTS theclothe55shop;
CREATE DATABASE theclothe55shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE theclothe55shop;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name  VARCHAR(255) NOT NULL,
    email      VARCHAR(255) UNIQUE NOT NULL,
    password   VARCHAR(255) NOT NULL,
    role       ENUM('customer','admin') NOT NULL,
    phone      VARCHAR(15) NULL
) ENGINE=InnoDB AUTO_INCREMENT=1;

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10;

CREATE TABLE products (
    product_id           INT AUTO_INCREMENT PRIMARY KEY,
    name                 VARCHAR(255) NOT NULL,
    description          TEXT,
    base_price           DECIMAL(10,2) NOT NULL,
    low_stock_threshold  INT,
    category_id          INT NOT NULL,
    CONSTRAINT fk_products_category
        FOREIGN KEY (category_id)
        REFERENCES categories(category_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=1001;

CREATE TABLE product_images (
    product_id INT NOT NULL,
    url        VARCHAR(255) NOT NULL,
    is_primary BOOLEAN NOT NULL,
    CONSTRAINT pk_product_images PRIMARY KEY (product_id, url),
    CONSTRAINT fk_product_images_product
        FOREIGN KEY (product_id)
        REFERENCES products(product_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE product_variants (
    variant_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    size       VARCHAR(50) NOT NULL,
    colour     VARCHAR(50),
    stock_qty  INT NOT NULL,
    CONSTRAINT fk_variants_product
        FOREIGN KEY (product_id)
        REFERENCES products(product_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=501;

CREATE TABLE carts (
    cart_id       INT AUTO_INCREMENT PRIMARY KEY,
    user_id       INT,
    session_token VARCHAR(255),
    CONSTRAINT fk_carts_user
        FOREIGN KEY (user_id)
        REFERENCES users(user_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=9001; 

CREATE TABLE cart_items (
    cart_id    INT NOT NULL,
    variant_id INT NOT NULL,
    qty        INT NOT NULL,
    CONSTRAINT pk_cart_items PRIMARY KEY (cart_id, variant_id),
    CONSTRAINT fk_cart_items_cart
        FOREIGN KEY (cart_id)
        REFERENCES carts(cart_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_cart_items_variant
        FOREIGN KEY (variant_id)
        REFERENCES product_variants(variant_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE orders (
    order_id       INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT,
    status         ENUM('pending','paid','shipped','completed','cancelled') NOT NULL,
    total_amount   DECIMAL(10,2) NOT NULL,
    ship_name      VARCHAR(255) NOT NULL,
    ship_address   TEXT NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    order_date     DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_orders_user
        FOREIGN KEY (user_id)
        REFERENCES users(user_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=2001;

CREATE TABLE order_items (
    order_id   INT NOT NULL,
    product_id INT NOT NULL,
    variant_id INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    qty        INT NOT NULL,
    line_total DECIMAL(10,2) NOT NULL,
    CONSTRAINT pk_order_items PRIMARY KEY (order_id, product_id, variant_id),
    CONSTRAINT fk_order_items_order
        FOREIGN KEY (order_id)
        REFERENCES orders(order_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    CONSTRAINT fk_order_items_product
        FOREIGN KEY (product_id)
        REFERENCES products(product_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    CONSTRAINT fk_order_items_variant
        FOREIGN KEY (variant_id)
        REFERENCES product_variants(variant_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE wishlist (
    user_id    INT,
    product_id INT,
    variant_id INT NULL,
    note       TEXT,
    KEY idx_wishlist_user_product_variant (user_id, product_id, variant_id),
    CONSTRAINT fk_wishlist_user
        FOREIGN KEY (user_id)
        REFERENCES users(user_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_wishlist_product
        FOREIGN KEY (product_id)
        REFERENCES products(product_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_wishlist_variant
        FOREIGN KEY (variant_id)
        REFERENCES product_variants(variant_id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE inventory_transaction (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    variant_id     INT,
    change_qty     INT NOT NULL,
    reason         ENUM('sale','restock','return','adjustment','incoming_order') NOT NULL,
    CONSTRAINT fk_inventory_variant
        FOREIGN KEY (variant_id)
        REFERENCES product_variants(variant_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7001;

CREATE TABLE returns (
    order_id    INT,
    status      ENUM('requested','approved','received','refunded') NOT NULL,
    reason_text TEXT,
    CONSTRAINT pk_returns PRIMARY KEY (order_id),
    CONSTRAINT fk_returns_order
        FOREIGN KEY (order_id)
        REFERENCES orders(order_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=1001;

CREATE TABLE contact_messages (
    user_id INT NULL,
    message TEXT NOT NULL,
    status  ENUM('new','in_progress','closed') NOT NULL,
    KEY idx_contact_messages_user (user_id),
    CONSTRAINT fk_contact_messages_user
        FOREIGN KEY (user_id)
        REFERENCES users(user_id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
) ENGINE=InnoDB;

SET FOREIGN_KEY_CHECKS = 1;
