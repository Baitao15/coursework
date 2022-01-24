<?php
    session_start();
    include_once("connection.php");
    $id=$_GET['id'];
?>

<html>
<head>
    <title>Order Details - Order ID <?php echo($id); ?></title>
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
    <br><br><br><br>
    <!-- order details -->
    <div class=row>
        <div class="col-sm-2"></div>
        <div class="col-sm-4"></div>
        <div class="col-sm-6"></div>
    </div> 
</body>
</html>


