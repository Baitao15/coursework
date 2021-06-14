<?php

session_start();

include_once("connection.php");

array_map("htmlspecialchars", $_POST);

$stmt = $conn->prepare("SELECT * FROM customer WHERE email = :email;");
$stmt->blindparam(':email', $_POST['email']);
$stmt->execute();


while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
    $hashed= $row['password'];
    $attempt= $_POST['password'];
    
    if(password_verify($attempt,$hashed)){
        $_SESSION['email']=$row["email"];
        if (!isset($_SESSION['backURL'])){
            $backURL= "/";
        }else{
            $backURL=$_SESSION['backURL'];
        }
        unset($_SESSION['backURL']);
        header('Location: ' . $backURL);

        header('Location: homepage.php');
    
    }else{

        header('Location: login.php');
    }
}
