<!DOCTYPE html>

<?php
    session_start(); 
    if (isset($_SESSION['email']))
    {   
        $loggedin=true;
    }
?>

<html>
    <head>
        <title>Longda - Home</title>
        <link rel="stylesheet" href="style.css">
    </head>
<body>
    <!-- navigation bar -->
    <?php 
    if ($loggedin=true)
    {   
        echo("<p id=navbar>
        <a href=logout.php>Logout</a>
        <a href=registerpage.php>Register</a>
        <a href=groceries.php>Groceries</a>
        <a href=homepage.php>Home</a>
    </p>");
    }
    else{
        echo("FALSE");
    }
?>
    <!-- <p id=navbar>
        <a href=loginpage.php>Login</a>
        <a href=registerpage.php>Register</a>
        <a href=groceries.php>Groceries</a>
        <a href=homepage.php>Home</a>
    </p> -->

</body>
</html>