CREATE DATABASE IF NOT EXISTS spice_isle CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE spice_isle;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(255) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  full_name VARCHAR(150),
  role ENUM('user','admin') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS tours (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  description TEXT,
  duration_hours DECIMAL(4,2),
  price DECIMAL(10,2),
  image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  tour_id INT NOT NULL,
  booking_date DATE NOT NULL,
  guests INT DEFAULT 1,
  status ENUM('pending','confirmed','cancelled') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  email VARCHAR(255),
  subject VARCHAR(255),
  message TEXT,
  status ENUM('new','read') DEFAULT 'new',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Sample admin user: email admin@example.com, password: AdminPass123!
INSERT INTO users (username, email, password_hash, full_name, role)
VALUES ('admin', 'admin@example.com', '$2b$12$bfHkEgWIPOgJiicPQADBTusg5lQDKD/12Mh6RuLdfIgyHrwMAOZW6', 'Site Admin', 'admin');

-- Sample tours
INSERT INTO tours (title, description, duration_hours, price, image)
VALUES
('Island Highlights', 'A full-day tour of the island''s highlights including beaches and landmarks.', 8.00, 120.00, 'images/island1.jpg'),
('Sunset Cruise', 'Relaxing evening cruise with snorkeling and refreshments.', 3.50, 65.00, 'images/cruise.jpg');
