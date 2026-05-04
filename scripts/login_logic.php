<?php
session_start();
include("database.php");

// check request method
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../public/login.php");
    exit();
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// validation
if (empty($email) || empty($password)) {
    header("Location: ../public/login.php?error=empty");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../public/login.php?error=invalid_email");
    exit();
}

// get user
$stmt = $conn->prepare("
    SELECT users.*, roles.label AS role_label
    FROM users
    LEFT JOIN roles ON users.role_id = roles.id
    WHERE email = ?
");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: ../public/login.php?error=not_found");
    exit();
}

if (!password_verify($password, $user['password'])) {
    header("Location: ../public/login.php?error=wrong_password");
    exit();
}
// save session
$_SESSION['user_id'] = $user['id'];
$_SESSION['email'] = $user['email'];
$_SESSION['name'] = $user['firstname'];
$_SESSION['role'] = $user['role_label'] ?? null;

// redirect by role
if ($user['role_label'] == 'Admin') {
    header("Location: ../admin/admin_dashboard.php");
    exit();
}

if ($user['role_label'] == 'Prof') {
    header("Location: ../teacher/dashboard.php");
    exit();
}

if ($user['role_label'] == 'Student') {
    header("Location: ../student/student_dashboard.php");
    exit();
}

// fallback
header("Location: ../public/dashboard.php");
exit();