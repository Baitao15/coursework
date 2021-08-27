<!DOCTYPE html>

<?php
    session_start();

    $_SESSION['backURL']='homepage.php';
?>

<html>
    <head>
        <title>Longda - Home</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>

<body>

    <!-- navigation bar -->
    <div id=navbar>
        <a href=homepage.php>Home</a>
        <a href=groceries.php>Groceries</a>
        <?php 
            if (!isset($_SESSION['email'])){
                echo("<a href=registerpage.php>Register</a> <a href=loginpage.php>Login</a>");
            }
            if (isset($_SESSION['email'])){  
                echo("<a href=accountpage.php>Account</a> <a href=logout.php>Logout</a>");
            }
        ?>
    </div>
    <br>
    <br>
    <br>
    <!-- welcome message -->
    <div class="container text-center">
        <h3>Welcome to the Longda Online Shop</h3>
        <a href=loginpage.php>Login</a> for the best experience.
        Not a customer yet? <a href=registerpage.php>Register</a>
    </div>

</body>
</html>