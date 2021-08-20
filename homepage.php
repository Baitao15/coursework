<!DOCTYPE html>

<?php
    session_start();

    $_SESSION['backURL']='homepage.php';
?>

<html>
    <head>
        <title>Longda - Home</title>
    </head>

<body>

    <!-- navigation bar -->
    <p id=navbar>
    <?php 
        if (!isset($_SESSION['email'])){
            echo("<a href=loginpage.php>Login</a> <a href=registerpage.php>Register</a>");
        }
        if (isset($_SESSION['email'])){  
            echo("<a href=logout.php>Logout</a> <a href=accountpage.php>Account</a>");
        }
    ?>
        <a href=groceries.php>Groceries</a>
        <a href=homepage.php>Home</a>
    </p>

    <!-- welcome message -->
    <p id=welcome>
        <h3>Welcome to the Longda Online Shop.</h3>
        <a href=loginpage.php>Login</a> for the best experience. Not a customer yet? <a href=registerpage.php>Register</a>
    </p>

</body>
</html>