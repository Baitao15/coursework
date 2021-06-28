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
        <a href=logout.php>Logout</a>
        <a href=newofferpage.php>Add Account</a>
        <a href=newitempage.php>Add Account</a>
        <a href=newadminpage.php>Add Account</a>
        <a href=adminhomepage.php>Home</a>
    </p>
</body>

</html>