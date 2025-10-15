CREATE DATABASE IF NOT EXISTS employee_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE employee_db;

CREATE TABLE IF NOT EXISTS employees (
  employee_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  position VARCHAR(150) DEFAULT NULL,
  department VARCHAR(150) DEFAULT NULL,
  email VARCHAR(255) DEFAULT NULL,
  contact_number VARCHAR(50) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data
INSERT INTO employees (name, position, department, email, contact_number) VALUES
('Ana Santos','Software Developer','IT','ana.santos@example.com','09170001111'),
('Carlos Reyes','HR Specialist','Human Resources','carlos.reyes@example.com','09172223333'),
('Marisol Dela Cruz','Accountant','Finance','marisol.dc@example.com','09174445555');
