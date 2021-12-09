<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

session_start();

// checking the email is not already associated with an account
$email=$_POST["email"];
$stmt = $conn->prepare("SELECT email FROM customer WHERE email = :email;");
$stmt->bindparam(':email', $email);
$stmt->execute();

if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    // if the email is found in the database, redirect user to register page with error message
    $_SESSION['message']='Email is already registered with an account. <a href=loginpage.php>Login</a>';
    header('Location: registerpage.php');
}

else{
    // hashing the password
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // sending the data to the database
    $stmt = $conn->prepare("INSERT INTO customer(email,password)
    VALUES(:email,:password)");

    $stmt->bindParam(':email', $_POST["email"]);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();

    // getting user details from the database
    $stmt = $conn->prepare("SELECT email FROM customer WHERE email = :email;");
    $stmt->bindparam(':email', $email);
    $stmt->execute();

    // logging user in and redirecting to previous page
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){    
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
}