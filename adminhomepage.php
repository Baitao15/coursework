<html>

<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

// checking authorised user
session_start(); 
if (!isset($_SESSION['userid'])){   
    header("Location:adminloginpage.php");
}

// getting admin name
$findid = ($_SESSION['userid']);
$stmt = $conn->prepare("SELECT forename FROM admin WHERE userid = $findid");
$stmt->bindparam(':forename', $_POST['forename']);
$stmt->execute();

echo("<br>");echo("<br>");echo("<br>");echo("<br>");echo("<br>");echo("<br>");echo("<br>");echo("<br>");
echo($_POST['forename']);
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

    <p>Hi </p>

</body>

</html>
