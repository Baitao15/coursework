<!DOCTYPE html>

<?php
    session_start(); 
    if (isset($_SESSION['email']))
    {   
        $loggedin=true;
    }
    else{
        $loggedin=false;
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
        if ($loggedin=true)
        {   
            echo("<a href=logout.php>Logout</a>");
        }
        else{
            echo("<a href=logout.php>Logout</a>
            <a href=registerpage.php>Register</a>");
    }
    ?>
        <a href=groceries.php>Groceries</a>
        <a href=homepage.php>Home</a>
    </p>

</body>
</html>