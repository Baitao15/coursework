<!DOCTYPE html>

<?php
    session_start(); 
    if (isset($_SESSION['name']))
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
    <p id=navbar>
        <a href=loginpage.php>Login</a>
        <a href=registerpage.php>Sign Up</a>
        <a href=groceries.php>Groceries</a>
        <a href=homepage.php>Home</a>
    </p>

</body>
</html>