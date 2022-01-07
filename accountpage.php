<!DOCTYPE html>

<?php
    session_start();

    include_once("connection.php");

    $_SESSION['backURL']='accountpage.php';
?>

<html>
    <head>
        <title>Your Account</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>

<body>

    <!-- navigation bar -->
    <div id=navbar>
        <a href=homepage.php>Home</a>
        <a href=grocerypage.php>Groceries</a>
        <a href=basketpage.php>Basket</a>
        <?php 
            if (!isset($_SESSION['email'])){
                echo("<a href=registerpage.php>Register</a> <a href=loginpage.php>Login</a>");
            }
            if (isset($_SESSION['email'])){  
                echo("<a href=accountpage.php>Account</a> <a href=logout.php>Logout</a>");
            }
        ?>
    </div>
    <br><br><br>
    <?php
    $stmt = $conn->prepare("SELECT * FROM customer WHERE email = :email");
    $stmt->bindparam(':email', $_SESSION['email']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC)
    ?>
    <div class='row'>
        <div class='col-sm-3'></div>
        <div class='col-sm-6'>
            <h3>Your Account</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-3'></div>
        <div class='col-sm-2'>
            <b>Personal Details</b>
            <br><br>
            First Name:<br>
            <?php echo($row['forename']); ?>
            <br><br>
            Surname:<br>
            <?php echo($row['surname']); ?>
            <br><br>
            Telephone Number:<br>
            <?php echo($row['phoneno']); ?>
            <br><br>
        </div>
        <div class='col-sm-2'>
            <b>Account Details</b>
            <br><br>
            Email:<br>
            <?php echo($row['email']); ?>
            <br><br>
            Password:<br>
            *****
            <br><br>
        </div>
        <div class='col-sm-2'>
            <b>Previous Orders</b>
        </div>
    </div>
