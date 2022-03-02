<?php
// linking to connection.php to gain access to the database
include_once("connection.php");
// checking authorised user
session_start(); 
if (!isset($_SESSION['userid'])){   
    header("Location:adminloginpage.php");
}
// getting admin forename
$findid = ($_SESSION['userid']);
$stmt = $conn->prepare("SELECT forename FROM admin WHERE userid = $findid");
$stmt->execute();
?>
<html>
<head>
    <title>Longda Admin - Home</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <!-- navigation bar -->
    <div id=navbar>
        <a href=adminhomepage.php>Home</a>
        <a href=orderpage.php>Orders</a>
        <a href=insightpage.php>Insights</a>
        <a href=manageitempage.php>Items</a>
        <a href=manageofferpage.php>Offers</a>
        <a href=manageaccountpage.php>Account</a>
        <a href=adminlogout.php>Logout</a>
    </div>
    <!-- displaying welcome message -->
    <div class="container">
        <div class="jumbotron">
            <h3>
                <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo("<h1>Hi, ".$row["forename"]."</h1>");
                        echo("<h3>What would you like to do?</h3>");
                    }
                ?>
            </h3>
        </div>
    </div>
</body>
</html>
