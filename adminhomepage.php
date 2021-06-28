<html>

<?php
// checking authorised user
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
        <a href=manageofferpage.php>Offers</a>
        <a href=manageitempage.php>Items</a>
        <a href=manageaccountpage.php>Accounts</a>
        <a href=adminhomepage.php>Home</a>
    </p>
</body>

</html>