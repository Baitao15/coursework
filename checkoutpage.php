<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

session_start();

$customerid=($_SESSION['id']);

// getting relevant data from the database
$stmt = $conn->prepare("SELECT * FROM customer WHERE customerid = $customerid");
$stmt->execute();
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
    <form action='placeorder.php'>
        <h3>1. Delivery Address</h3>            
            <input type="text" name="recipent" placeholder="Recipient Name" required><br><br>
            <input type="text" name="address1" placeholder="Address Line 1" required><br><br>
            <input type="text" name="address2" placeholder="Address Line 2 (optional)"><br><br>
            <input type="text" name="city" placeholder="City/Town/Village" required><br><br>
            <input type="text" name="county" placeholder="County" required><br><br>
            <input type="text" name="postcode" placeholder="Postcode" required><br><br>

        <h3>2. Payment Details</h3>
            <input type="text" name="cardnumber" placeholder="Card Number" required><br><br>
            <input type="month" name="expirydate" required><br><br>
            <input type="text" name="cardholdername" placeholder="Cardholder Name" required><br><br>
            
        <h3>3. Confirm and Place</h3>
            Order Total: <?php echo('£'.$_SESSION['total']);?><br>
            <input type="submit" value="Order & Pay" class="btn btn-lg">

    </form>
</body>
</html>

