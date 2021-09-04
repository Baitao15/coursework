<html>
<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

// checking authorised user
session_start(); 
if (!isset($_SESSION['userid'])){   
    header("Location:adminloginpage.php");
}

?>

<head>
    <title>Manage Account</title>
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
        <a href=manageitempage.php>Items</a>
        <a href=manageofferpage.php>Offers</a>
        <a href=manageaccountpage.php>Account</a>
        <a href=adminlogout.php>Logout</a>
    </p>

    <br><br>

    <!-- account details -->
    <?php
        $findid = ($_SESSION['userid']);
        $stmt = $conn->prepare("SELECT forename, surname FROM admin WHERE userid = $findid");
    ?>
    <h3>Personal Details</h3>
    <b>Forename</b><br>
    <?php
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo($row["forename"]);
        }
    ?>
    <br><br><b>Surname</b><br>
    <?php
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo($row["surname"]);
        }
    ?>


    <h3>Login Details</h3>
    <b>UserID</b><br>
    <?php
        echo($_SESSION['userid']);
    ?>
    <br><br><b>Password</b><br>
    *****<br>
    Change Password
    <form action="changeadminpassword.php" method="POST">
        <br>
        <input type="password" name="cpass" placeholder="Current Password" required><br><br>
        <input type="password" name="npass" placeholder="New Password" required><br><br>
        <input type="submit" value="Change" class="btn btn-lg">
    </form>



</body>
</html>

