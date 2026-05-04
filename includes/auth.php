<?php
function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../public/login.php");
        exit();
    }
}

function requireRole($role) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        header('location: ../scripts/login_logic.php');
        exit();
    }
}