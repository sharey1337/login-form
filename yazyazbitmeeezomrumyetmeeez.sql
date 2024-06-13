-- Veritabanı oluşturma
CREATE DATABASE IF NOT EXISTS shareydata;
USE shareydata;

-- Kullanıcı tablosu oluşturma
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Örnek kullanıcı verileri ekleme
INSERT INTO users (username, password, email) VALUES
('sharey', 'sharey1332', 'sharey@sharey.pro');
