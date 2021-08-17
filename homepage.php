<!DOCTYPE html>

<?php
    session_start(); 
    
    $loggedin=false;

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
    <p id=navbar>
    <?php 
        if ($loggedin==false){
            echo("<a href=loginpage.php>Login</a><a href=registerpage.php>Register</a>");
        }
        if ($loggedin==true){   
            echo("<a href=logout.php>Logout</a><a href=accountpage.php>Account</a>");
        }

    ?>
        <a href=groceries.php>Groceries</a>
        <a href=homepage.php>Home</a>
    </p>

</body>
</html>