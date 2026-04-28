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