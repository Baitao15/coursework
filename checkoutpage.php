<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

session_start();

$_SESSION['backURL']='homepage.php';
?>

<html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>

<body>

    <!-- navigation bar -->
    <div id=navbar>
        <a href=basketpage.php>Back to Basket</a>
    </div>
    <br><br>
    <h3>1. Delivery Address</h3>
    <h3>2. Delivery Details</h3>
    <h3>3. Payment Details</h3>
</body>
</html>
