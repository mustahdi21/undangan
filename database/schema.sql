-- Import this file into an existing database selected in phpMyAdmin/aaPanel.
-- On shared hosting, CREATE DATABASE privileges are often not granted.

SET NAMES utf8mb4;
SET time_zone = '+00:00';

CREATE TABLE IF NOT EXISTS users (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) UNIQUE NOT NULL,
  whatsapp VARCHAR(30) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('user','admin','finance','cs','content_manager','super_admin') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS plans (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL UNIQUE,
  price INT NOT NULL,
  active_days INT NOT NULL,
  features JSON NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS subscriptions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  plan_id BIGINT UNSIGNED NOT NULL,
  status ENUM('trial','active','expired','suspended') DEFAULT 'trial',
  active_at DATETIME NULL,
  expires_at DATETIME NULL,
  CONSTRAINT fk_subscriptions_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_subscriptions_plan FOREIGN KEY (plan_id) REFERENCES plans(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO plans (name, price, active_days, features)
VALUES
('Free', 0, 1, JSON_OBJECT('can_publish', false, 'watermark', true, 'max_invitation', 1)),
('Basic', 49000, 30, JSON_OBJECT('can_publish', true, 'watermark', true, 'max_invitation', 1)),
('Premium', 99000, 90, JSON_OBJECT('can_publish', true, 'watermark', false, 'max_invitation', 10)),
('Ultimate', 199000, 365, JSON_OBJECT('can_publish', true, 'watermark', false, 'max_invitation', 999))
ON DUPLICATE KEY UPDATE
price = VALUES(price),
active_days = VALUES(active_days),
features = VALUES(features);
