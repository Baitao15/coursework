<!DOCTYPE html>

<?php
    session_start();

    include_once("connection.php");

    $_SESSION['backURL']='homepage.php';
?>

<html>
    <head>
        <title>Longda - Groceries</title>
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

    <!-- groceries -->
    <div class="groceries">
        <?php
            // getting relevant data from the database
            $stmt = $conn->prepare("SELECT itemid, itemname, itemprice FROM item");
            $stmt->execute();
            // displaying each item and its details
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo($row["itemname"]."<br>".$row["itemprice"]."<br>");
                echo('<form action="addtobasket.php" method="POST" class="form-inline">');
                echo('<input type="hidden" name="id" value='.$row["itemid"].">");
                echo('<input type="number" name="qty" min="1" max="99">');
                echo('<input type="submit" value="Add" class="btn btn-sm"><br>');
                echo("</form>");
            }
        ?>
    </div>

