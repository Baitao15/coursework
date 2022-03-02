<?php
// start session to access email session variable
session_start();
// link to database to check account details
include_once("connection.php");

array_map("htmlspecialchars", $_POST);
// fetch details from database where email row matches email input
$stmt = $conn->prepare("SELECT * FROM customer WHERE email = :email;");
$stmt->bindparam(':email', $_POST['email']);
$stmt->execute();

// if entered email exists in the customer table
$records = $stmt->fetchAll();
if($records){
    // fetch details from database
    $stmt->execute();
    // iterate through each row
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $hashed= $row['password'];
        $attempt= $_POST['password'];
        // if hashed password attempt matches saved hashed password
        if(password_verify($attempt,$hashed)){
            // set session variables (user is logged in)
            $_SESSION['id']=$row["customerid"];
            $_SESSION['email']=$row["email"];
            // if no backURL is set, then default redirect to homepage
            if (!isset($_SESSION['backURL'])){
                $backURL= "homepage.php";
            // otherwise, redirect to previous page
            }else{
                $backURL=$_SESSION['backURL'];
            }
            unset($_SESSION['backURL']);
            header('Location: ' . $backURL);
        }
        // if password attempt does not match saved password
        else{
            // return error message
            $_SESSION['message']='Incorrect email or password, please try again';
            // direct back to login page
            header('Location: loginpage.php');
        }
    }
}
// if entered email is not found in database
else{
    // return error message and direct back to login page
    $_SESSION['message']='Incorrect email or password, please try again';
    header('Location: loginpage.php');
}
