<html>

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

<head>
    <title>Longda Admin - Home</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <!-- navigation bar -->
    <p id=navbar>
        <a href=adminhomepage.php>Home</a>
        <a href=insightpage.php>Insights</a>
        <a href=manageaccountpage.php>Accounts</a>
        <a href=manageitempage.php>Items</a>
        <a href=manageofferpage.php>Offers</a>
        <a href=adminlogout.php>Logout</a>
    </p>
    <!-- displaying welcome message -->
    <div class="jumbotron">
        <h3>
            <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo("Hi, ".$row["forename"]);
                }
                echo($findid);
            ?>
        </h3>
    </div>
</body>
</html>
