<?php
// start session to access session variables
session_start();
// link to database to check account details
include_once("connection.php");

array_map("htmlspecialchars", $_POST);
// fetch details from database where userid row matches userid input
$stmt = $conn->prepare("SELECT * FROM admin WHERE userid = :userid;");
$stmt->bindparam(':userid', $_POST['userid']);
$stmt->execute();

// if entered userid exists in the admin table
$records = $stmt->fetchAll();
if($records){
    // fetch details from database
    $stmt->execute();
    // iterate through each row in the database
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $hashed= $row['password'];
        $attempt= $_POST['password'];
        // if hashed password attempt matches saved hashed password
        if(password_verify($attempt,$hashed)){
            // set userid session variable (user is logged in)
            $_SESSION['userid']=$row["userid"];
            // redirect user to admin home page
            header('Location: adminhomepage.php');
        // if password is invalid
        }else{
            // redirect to login page
            header('Location: adminloginpage.php');
        }
    }
}
// if entered userid is not found in the admin table
else{
    // redirect to login page
    header('Location: adminloginpage.php');
}
?>

a