<?php
include(__DIR__ . "/database.php");
$email = $_POST['email'];
$password = $_POST['password'];

$_SESSION['email'] = $email;


if(empty($email) || empty($password)) {
    header("Location: ../public/login.php?error=empty");
    exit();
}

if(!filter_var($email , FILTER_VALIDATE_EMAIL)) {
    header("Location: ../public/login.php?error=empty");
    exit();
}

if(isset($_POST['login'])){
    header("Location: ../public/dashboard.php");
}

// $sql = "SELECT email , password 
// FROM users
// ";

// $result = query($conn , $sql);
$sql = $conn->prepare("SELECT * FROM users where email = ? ");

$sql->execute([$email]);

$user = $sql->fetch();

// while($user) {
    if ($user['email'] == $email && $user['password'] == $password) {
        session_start();
        $_SESSION['name'] = $user['firstname'];
        // $_SESSION['name'] = $user['email'];
        header("Location: ../public/dashboard.php");
        exit();
    }else{
        header("Location: ../public/login.php");
    }
// }

?>