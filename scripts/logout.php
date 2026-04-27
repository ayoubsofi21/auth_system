<?php
session_start();

$logout_button = $_POST['logout'];

if(isset($logout_button)) {
    session_unset();
    session_destroy();
    header("Location: ../public/login.php");
    
    }


?>




