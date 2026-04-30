<?php
include(__DIR__ . "/database.php");


$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];
$signup_btn = $_POST['signup'];

if (empty($name) || empty($email) || empty($password) || empty($password_confirmation)){
    header("Location: ../public/register.php?error=empty");
    exit();
}

if(!filter_var($email , FILTER_VALIDATE_EMAIL)) {
    header("Location: ../public/register.php?error=empty");
    exit();
}

// 

$sql = "INSERT INTO users(firstname , email , password)
VALUES (? , ? , ?)";

$stmt = $conn->prepare($sql);

$result = $stmt->execute([$name , $email , $password]);
if(isset($signup_btn)){
    if($result){
       header("Location: ../login.php");
        exit();

    }
//     header("Location: ../public/login.php");
   
}else{
        echo 'error';
    }








?>




