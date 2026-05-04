CREATE DATABASE edusync;
USE edusync;

-- ========================
-- ROLES
-- ========================
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label ENUM('Admin','Prof','Student') NOT NULL
);

-- ========================
-- USERS
-- ========================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- ========================
-- CLASSES
-- ========================
CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    classroom_number VARCHAR(50) NOT NULL
);

-- ========================
-- COURSES
-- ========================
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    total_hours INT NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- ========================
-- STUDENTS
-- ========================
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_of_birth DATE NOT NULL,
    student_number VARCHAR(50) UNIQUE NOT NULL,
    user_id INT UNIQUE,
    class_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (class_id) REFERENCES classes(id)
);

-- ========================
-- ENROLLMENTS
-- ========================
CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    enrolled_at DATE NOT NULL,
    status ENUM('Actif','Termine') DEFAULT 'Actif',
    student_id INT,
    course_id INT,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (course_id) REFERENCES courses(id),
    UNIQUE (student_id, course_id)
);

-- ========================
-- INSERT DATA
-- ========================

-- ROLES
INSERT INTO roles (label) VALUES
('Admin'), ('Prof'), ('Student');

-- USERS
INSERT INTO users (firstname, lastname, email, password, role_id) VALUES
('Omar', 'Zahiri', 'omar.student@gmail.com', MD5('2121'), 3),
('Salma', 'Bennani', 'salma.student@gmail.com', MD5('2121'), 3),
('Hassan', 'Kabbaj', 'hassan.student@gmail.com', MD5('2121'), 3),
('Imad', 'El Fassi', 'imad.student@gmail.com', MD5('2121'), 3),
('Fatima', 'El Idrissi', 'fatima.student@gmail.com', MD5('123456'), 3),
('Mohamed', 'Amrani', 'mohamed.prof@gmail.com', MD5('123456'), 2),
('Nadia', 'Bouzid', 'nadia.prof@gmail.com', MD5('123456'), 2),
('Khalid', 'Rachidi', 'ayoub.admin@gmail.com', MD5('2121'), 1);

-- CLASSES
INSERT INTO  classes (name,classroom_number) VALUES
('3A Dev', 'C303'),
('4A Dev', 'D404'),
('5A Dev', 'E505'),
('Reseaux 1', 'N101'),
('Reseaux 2', 'N102'),
('Data Science 1', 'DS201'),
('Data Science 2', 'DS202'),
('Multimedia', 'M110');

-- COURSES
INSERT INTO courses (title, description, total_hours, user_id) VALUES
('SQL Basics', 'Introduction to SQL', 30, 6),
('Web Development', 'HTML CSS JS', 40, 6);

-- STUDENTS
INSERT INTO students (date_of_birth, student_number, user_id, class_id) VALUES
('2000-05-10', 'STU001', 1, 1),
('2001-08-15', 'STU002', 2, 2);

-- ENROLLMENTS
INSERT INTO enrollments (enrolled_at, student_id, course_id, status) VALUES
('2024-01-10', 1, 1, 'Actif'),
('2024-01-12', 1, 2, 'Actif'),
('2024-01-15', 2, 1, 'Termine');