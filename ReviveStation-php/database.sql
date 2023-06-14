-- Skapa databasen
CREATE DATABASE revivestation;

-- Skapa tabellen 'sellers'
CREATE TABLE sellers (
    seller_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(45),
    total_items_submitted INT(11),
    total_items_sold INT(11),
    total_sales_amount INT(11)
);

-- Skapa tabellen 'items'
CREATE TABLE items (
    item_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    seller_id INT(11),
    name VARCHAR(45),
    submitted_date DATETIME,
    sold TINYINT(1),
    price DECIMAL(10,2),
    FOREIGN KEY (seller_id) REFERENCES sellers(seller_id)
);
