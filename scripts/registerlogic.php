<?php
include(__DIR__ . "/database.php");
session_start();

// check if form submitted
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../public/register.php");
    exit();
}

// safe reading
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$password_confirmation = $_POST['password_confirmation'] ?? '';

// validation
if (empty($name) || empty($email) || empty($password) || empty($password_confirmation)) {
    header("Location: ../public/register.php?error=empty");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../public/register.php?error=invalid_email");
    exit();
}

if ($password !== $password_confirmation) {
    header("Location: ../public/register.php?error=password_mismatch");
    exit();
}

// check duplicate email
$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->execute([$email]);

if ($check->fetch()) {
    header("Location: ../public/register.php?error=email_exists");
    exit();
}

// hash password (IMPORTANT)
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// insert user
$sql = "INSERT INTO users (firstname, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$name, $email, $hashedPassword]);

if ($result) {
    header("Location: ../public/login.php?success=registered");
    exit();
} else {
    header("Location: ../public/register.php?error=server");
    exit();
}