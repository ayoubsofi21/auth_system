<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "edusync";
$conn = "";

try{
    $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_pass);
    // echo'connected with succefully';
}catch(PDOException $e){
    echo 'error'.$e->getMessage();
}



?>