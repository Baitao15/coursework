<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

// hashing the password
$hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

// sending the data to the database
$stmt = $conn->prepare("INSERT INTO customers(email,password)
VALUES(:email,:password)");

$stmt->bindParam(':username', $_POST["dusername"]);
$stmt->bindParam(':password', $hashed_password);
$stmt->execute();

//redirecting the user to the login page
header('Location: .php')

?>