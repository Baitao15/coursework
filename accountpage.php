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
    <div class='row'>
        <div class='col-sm-3'></div>
        <div class='col-sm-6'>
            <h3>Your Account</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-3'></div>
        <div class='col-sm-2'>
            Personal Details
        </div>
        <div class='col-sm-2'>
            Previous Orders
        </div>
    </div>
