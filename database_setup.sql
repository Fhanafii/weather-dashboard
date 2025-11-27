-- Database setup for Weather Dashboard
-- Run this SQL script to create the database and users table

-- Create database (if not exists)
CREATE DATABASE IF NOT EXISTS weather_dashboard;

-- Use the database
USE weather_dashboard;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert a sample user (username: admin, password: password)
-- Note: In production, use a strong password and hash it properly
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'); -- password: password

-- You can add more users as needed
-- INSERT INTO users (username, password) VALUES ('user2', 'hashed_password_here');
