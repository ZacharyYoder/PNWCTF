CREATE DATABASE pnwctf;

USE pnwctf;

-- USERS TABLE
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- FLAGS / CHALLENGES TABLE
CREATE TABLE flags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    challenge_name VARCHAR(100) NOT NULL,
    flag VARCHAR(255) NOT NULL UNIQUE,
    points INT DEFAULT 100
);

-- SUBMISSIONS TABLE
CREATE TABLE submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    flag_id INT,
    submitted_flag VARCHAR(255),
    is_correct BOOLEAN DEFAULT FALSE,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (flag_id) REFERENCES flags(id)
);