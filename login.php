<?php

session_start();

include_once("connection.php");

array_map("htmlspecialchars", $_POST);

$stmt = $conn->prepare("SELECT * FROM customer WHERE email = :email;");
$stmt->bindparam(':email', $_POST['email']);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
    $hashed= $row['password'];
    $attempt= $_POST['password'];
    
    if(password_verify($attempt,$hashed)){
        $_SESSION['id']=$row["customerid"];
        $_SESSION['email']=$row["email"];
        // if no backURL is set, then default redirect to homepage
        if (!isset($_SESSION['backURL'])){
            $backURL= "homepage.php";
        }else{
            $backURL=$_SESSION['backURL'];
        }
        unset($_SESSION['backURL']);
        header('Location: ' . $backURL);
    }
    else{
        $_SESSION['message']='Incorrect email or password, please try again';
        header('Location: loginpage.php');
    }
}

