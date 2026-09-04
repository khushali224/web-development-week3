CREATE DATABASE IF NOT EXISTS rasit_watch_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE rasit_watch_db;
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS wishlist_items;
DROP TABLE IF EXISTS cart_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;
SET FOREIGN_KEY_CHECKS=1;
CREATE TABLE users(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(120) NOT NULL,email VARCHAR(190) NOT NULL UNIQUE,password VARCHAR(255) NOT NULL,role ENUM("customer","admin") NOT NULL DEFAULT "customer",address TEXT,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE products(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(160) NOT NULL,price DECIMAL(10,2) NOT NULL,image TEXT NOT NULL,description TEXT NOT NULL,category VARCHAR(80) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE orders(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,product_id INT NOT NULL,quantity INT NOT NULL,total_amount DECIMAL(10,2) NOT NULL,status VARCHAR(40) NOT NULL DEFAULT "Placed",created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE RESTRICT);
CREATE TABLE cart_items(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,product_id INT NOT NULL,quantity INT NOT NULL DEFAULT 1,updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,UNIQUE KEY uq_cart(user_id,product_id),FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE);
CREATE TABLE wishlist_items(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,product_id INT NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,UNIQUE KEY uq_wishlist(user_id,product_id),FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE);
CREATE TABLE reviews(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NOT NULL,product_id INT NOT NULL,rating TINYINT NOT NULL,comment TEXT NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE);
INSERT INTO users(name,email,password,role) VALUES("Rasit Admin","admin@gmail.com","$2y$12$dyy5uN0JAyUDbkhjnpovgOQpIMXt3kWkGGFe.zUrctYysH4LiReQ2","admin");
INSERT INTO products(name,price,image,description,category) VALUES
("Rasit Classic Black",4999,"https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=900&q=85","Refined black dial with a clean silhouette for everyday wear.","Classic"),
("Rasit Chrono Steel",7999,"https://images.unsplash.com/photo-1539874754764-5a96559165b0?auto=format&fit=crop&w=900&q=85","Sport-inspired steel styling with a confident chronograph look.","Chronograph"),
("Rasit Heritage Gold",9999,"https://images.unsplash.com/photo-1524805444758-089113d48a6d?auto=format&fit=crop&w=900&q=85","Warm gold tones and an elegant profile inspired by timeless design.","Luxury"),
("Rasit Minimal Silver",5999,"https://images.unsplash.com/photo-1523170335258-f5ed11844a49?auto=format&fit=crop&w=900&q=85","Minimal silver styling designed to complement any outfit.","Minimal"),
("Rasit Midnight",6999,"https://images.unsplash.com/photo-1508057198894-247b23fe5ade?auto=format&fit=crop&w=900&q=85","Deep midnight tones for a modern understated statement.","Modern"),
("Rasit Executive",8999,"https://images.unsplash.com/photo-1522312346375-d1a52e2b99b3?auto=format&fit=crop&w=900&q=85","Polished executive styling for meetings and milestones.","Executive");
