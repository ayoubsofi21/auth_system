-- Active: 1777541647777@@127.0.0.1@3306@edusync
CREATE DATABASE edusync ;
USE edusync ;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    label VARCHAR(20)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(20) NOT NULL,
    lastname VARCHAR(20) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(256) NOT NULL,
    roles_id INT ,
    FOREIGN KEY (roles_id) REFERENCES roles(id)
);


CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    classrom_number INT NOT NULL
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    total_hours INT NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id));



CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_of_birth DATE NOT NULL,
    student_number INT NOT NULL,
    classes_id INT,
    FOREIGN KEY (classes_id) REFERENCES classes(id),
    users_id INT UNIQUE,
    FOREIGN KEY (users_id) REFERENCES users(id)
);


CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    enrolled_at DATE NOT NULL,
    status ENUM ('Actif' , 'Terminé') NOT NULL,
    students_id INT ,
    FOREIGN KEY (students_id) REFERENCES students(id),
    courses_id INT ,
    FOREIGN KEY (courses_id) REFERENCES courses(id),
    UNIQUE (students_id , courses_id)
);

INSERT INTO roles (label)
VALUES ('Admin'),
        ('Prof'),
        ('Student');


INSERT INTO students(student_number , ){
VALUES()
};

