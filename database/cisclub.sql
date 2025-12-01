-- DIU CIS Club Portal Database
-- Created: 2025
-- Database: cisclub_portal

CREATE DATABASE IF NOT EXISTS cisclub_portal;
USE cisclub_portal;

-- Admin Users Table
CREATE TABLE admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    student_id VARCHAR(20),
    status ENUM('pending', 'active', 'inactive') DEFAULT 'pending',
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories Table
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(100) NOT NULL,
    description TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Events Table
CREATE TABLE events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_name VARCHAR(200) NOT NULL,
    description TEXT,
    category_id INT,
    date_start DATE NOT NULL,
    date_end DATE,
    time_start TIME,
    location VARCHAR(200),
    image VARCHAR(255),
    max_participants INT,
    status ENUM('upcoming', 'ongoing', 'completed', 'cancelled') DEFAULT 'upcoming',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Event Registrations Table
CREATE TABLE event_registrations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_id INT NOT NULL,
    user_id INT NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_registration (event_id, user_id)
);

-- News Table
CREATE TABLE news (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255),
    status ENUM('published', 'draft') DEFAULT 'published',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sponsors Table
CREATE TABLE sponsors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sponsor_name VARCHAR(100) NOT NULL,
    logo VARCHAR(255),
    website VARCHAR(255),
    description TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Committee Members Table
CREATE TABLE committee_members (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    image VARCHAR(255),
    email VARCHAR(100),
    facebook VARCHAR(255),
    linkedin VARCHAR(255),
    phone VARCHAR(20),
    display_order INT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contact Messages Table
CREATE TABLE contact_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Default Admin (Password: admin123)
INSERT INTO admin_users (full_name, username, password) 
VALUES ('Admin User', 'admin', 'admin123');

-- Insert Sample Categories
INSERT INTO categories (category_name, description, status) VALUES
('Workshop', 'Technical workshops and training sessions', 'active'),
('Competition', 'Programming and tech competitions', 'active'),
('Seminar', 'Educational seminars and talks', 'active'),
('Social Event', 'Club social gatherings and networking', 'active'),
('Career Fair', 'Career development and job fairs', 'active');

-- Insert Sample News
INSERT INTO news (title, description, status) VALUES
('Welcome to DIU CIS Club Portal', 'We are excited to launch our new web portal for better communication and event management.', 'published'),
('Programming Contest 2025', 'Annual programming contest will be held next month. Stay tuned for registration details.', 'published');
