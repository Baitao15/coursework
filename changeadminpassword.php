<?php

// linking to connection.php to gain access to the database
include_once("connection.php");

array_map("htmlspecialchars", $_POST);

// starting session
session_start();
    
$stmt = $conn->prepare("SELECT * FROM admin WHERE userid = :userid;");
$stmt->bindparam(':userid', $_SESSION['userid']);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

// setting variables
    $hashed= $row['password'];
    $cpass= $_POST['cpass'];
    $npass= password_hash($_POST['npass'], PASSWORD_DEFAULT);

// checking current password match
    if(password_verify($cpass,$hashed)){
        // changing password
        $stmt = $conn->prepare("UPDATE admin(password)
        SET(:password)
        WHERE userid = :userid");
        $stmt->bindparam(':userid', $_SESSION['userid']);
        $stmt->bindParam(':password', $npass);
        $stmt->execute();
        header('Location: manageaccountpage.php');
    
    }else{
        
    }
}