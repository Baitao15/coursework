<?php

session_start();

include_once("connection.php");

array_map("htmlspecialchars", $_POST);

$stmt = $conn->prepare("SELECT * FROM admin WHERE userid = :userid;");
$stmt->bindparam(':userid', $_POST['userid']);
$stmt->execute();


while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
    $hashed= $row['password'];
    $attempt= $_POST['password'];
    echo($hashed);
    echo($attempt);
    
    if(password_verify($attempt,$hashed)){
        $_SESSION['userid']=$row["userid"];
        if (!isset($_SESSION['backURL'])){
            $backURL= "/";
        }else{
            $backURL=$_SESSION['backURL'];
        }
        unset($_SESSION['backURL']);
        header('Location: ' . $backURL);
        header('Location: adminhomepage.php');
    
    }else{
        echo("error");
    }
}
