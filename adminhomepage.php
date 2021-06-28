<html>

<?php

session_start(); 
if (!isset($_SESSION['userid']))
{   
    header("Location:adminloginpage.php");
}
?>

<head>
    <title>Longda Admin - Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- navigation bar -->
    <p id=navbar>
        <a href=adminhomepage.php>Home</a>
        <a href=newadminpage.php>Add Admin Account</a>
    </p>
</body>

</html>