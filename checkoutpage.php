<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

// getting relevant data from the database
$stmt = $conn->prepare("SELECT * FROM customer");
$stmt->execute();

session_start();

$_SESSION['backURL']='homepage.php';
?>

<html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>

<body>
    <!-- navigation bar -->
    <div id=navbar>
        <a href=basketpage.php>Back to Basket</a>
    </div>
    <br><br>
    <h3>1. Delivery Address</h3>
        <?php
            // if (isset($_SESSION['email'])){
            //     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //         echo('a')
            //     }
            // }
        ?>
        <form action='changecustomerdetails.php'>
            <input type="text" name="recipent" placeholder="Recipient Name" required><br><br>
            <input type="text" name="address1" placeholder="Address Line 1" required><br><br>
            <input type="text" name="address2" placeholder="Address Line 2 (optional)"><br><br>
            <input type="text" name="city" placeholder="City/Town/Village" required><br><br>
            <input type="text" name="county" placeholder="County" required><br><br>
            <input type="text" name="postcode" placeholder="Postcode" required><br><br>
        </form>
    <h3>2. Payment Details</h3>
    <h3>3. Confirm and Place</h3>
</body>
</html>

