use edusync;
INSERT INTO users (firstname, lastname, email, password, role_id) VALUES
('Omar', 'Zahiri', 'omar.student@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 3),
('Salma', 'Bennani', 'salma.student@gmail.com', 'c81e728d9d4c2f636f067f89cc14862c', 3),
('Hassan', 'Kabbaj', 'hassan.student@gmail.com', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 3),
('Imad', 'El Fassi', 'imad.student@gmail.com', 'a87ff679a2f3e71d9181a67b7542122c', 3),
('Fatima', 'El Idrissi', 'fatima.student@gmail.com', 'e4da3b7fbbce2345d7772b0674a318d5', 3),

('Mohamed', 'Amrani', 'mohamed.prof@gmail.com', '1679091c5a880faf6fb5e6087eb1b2dc', 2),
('Nadia', 'Bouzid', 'nadia.prof@gmail.com', '8f14e45fceea167a5a36dedd4bea2543', 2),

('Khalid', 'Rachidi', 'khalid.admin@gmail.com', 'c9f0f895fb98ab9159f51fd0297e236d', 1);
INSERT INTO classes(name, classroom_number) VALUES('3A Dev', 'C303'),
('4A Dev', 'D404'),
('5A Dev', 'E505'),
('Réseaux 1', 'N101'),
('Réseaux 2', 'N102'),
('Data Science 1', 'DS201'),
('Data Science 2', 'DS202'),
('Multimédia', 'M110');


use  EDUSYNC;
CREATE roles(id int PRIMARY KEY AUTO_INCREMENT ,label varchar(255))
CREATE TABLE users(id int PRIMARY KEY AUTO_INCREMENT ,firstname varchar(100),lastname varchar(100),email varchar(150) UNIQUE,password varchar(255),role_id int,Foreign Key (role_id) REFERENCES roles(id));
CREATE TABLE classes(id int PRIMARY KEY AUTO_INCREMENT ,name varchar(100),classroom_number varchar(255)) ;
CREATE TABLE courses(id int  PRIMARY KEY AUTO_INCREMENT ,title varchar(255),description text ,total_hours int,user_id int,FOREIGN KEY (user_id) REFERENCES users(id));
CREATE TABLE students(id int PRIMARY KEY AUTO_INCREMENT,dateofbirth date ,student_number varchar(100) UNIQUE,user_id int UNIQUE,class_id int ,FOREIGN KEY (user_id) REFERENCES users(id),FOREIGN KEY (class_id) REFERENCES classes(id)); 

-- create table enrollemnt 
CREATE TABLE enrollments(id int PRIMARY KEY AUTO_INCREMENT,enrolled_at date,student_id int ,course_id int,FOREIGN KEY (student_id) REFERENCES students(id),FOREIGN KEY (course_id) REFERENCES courses(id) ,  UNIQUE (student_id, course_id)); 
ALTER Table enrollments add status ENUM('actif','termine') DEFAULT('actif');

SELECT*FROM courses;
ALTER Table roles MODIFY label ENUM( "Admin", "Prof", "Student") not NULL;

-- ok now i want to insert data to each table 
INSERT INTO roles(label)VALUES('Admin'),('Prof'),('Student');
ALTER TABLE roles AUTO_INCREMENT=1;
-- 123456 654321 212121
INSERT INTO users (firstname, lastname, email, password, role_id) VALUES('Imane', 'Zahra', 'imane.student@gmail.com', MD5('212121'), 2),
('Ali', 'Ahmadi', 'ali.admin@gmail.com', MD5('123456'), 1),
('Sara', 'Benali', 'sara.prof@gmail.com', MD5('232334'), 2),
('Youssef', 'Karimi', 'youssef.student@gmail.com', MD5('654321'), 3);
INSERT INTO classes (name, classroom_number) VALUES
('1A Dev', 'A101'),
('2A Dev', 'B202');
INSERT INTO courses (title, description, total_hours, user_id) VALUES
('SQL Basics', 'Introduction to SQL', 30, 2),
('Web Development', 'HTML CSS JS', 40, 2);

INSERT INTO students (dateofbirth, student_number, user_id, class_id) VALUES
('2000-05-10', 'STU001', 3, 1),
('2001-08-15', 'STU002', 4, 2);
ALTER TABLE enrollments ADD status ENUM('Actif','termine');
INSERT INTO enrollments(enrolled_at,student_id,course_id,status)VALUES('2024-01-10', 1, 1, 'actif'),
('2024-01-12', 1, 2, 'Actif'),
('2024-01-15', 2, 1, 'termine');




select users.firstname ,users.lastname,roles.label from  users 
INNER JOIN roles on roles.id=users.role_id
INNER JOIN courses on users.id=courses.user_id 
INNER JOIN enrollments on courses.id=enrollments.course_id WHERE enrollments.status='actif' and roles.label='prof';
