<!DOCTYPE html>

<?php
    session_start();

    $_SESSION['backURL']='homepage.php';
?>

<html>
    <head>
        <title>Longda - Home</title>
        <link rel="stylesheet" href="style.css">
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

    <!-- welcome message
    <p id=welcome>
        <h3>Welcome to the Longda Online Shop.</h3>
        <a href=loginpage.php>Login</a> for the best experience. Not a customer yet? <a href=registerpage.php>Register</a>
    </p> -->

</body>
</html>