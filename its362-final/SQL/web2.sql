CREATE DATABASE web2;

USE web2;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    is_admin TINYINT DEFAULT 0
);

INSERT INTO users (username, password, is_admin) VALUES
('admin', 'passProtect', 1),
('user', 'tester21', 0);