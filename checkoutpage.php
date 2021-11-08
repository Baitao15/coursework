<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

session_start();

$customerid=($_SESSION['id']);
?>

<html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

<body>
    <!-- navigation bar -->
    <div id=navbar>
        <a href=basketpage.php>Back to Basket</a>
    </div>
    <br><br>
    <form action='placeorder.php'>
        <h3>1. Delivery Address</h3>        
            <?php
            if (isset($_SESSION['email'])){  
                echo("<h4>Saved Adresses</h4>");
                $stmt = $conn->prepare("SELECT addressid FROM customeraddress WHERE customerid = $customerid");
                $stmt->execute();
                $addresses=array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $addressid=($row['addressid']);
                    $stmt = $conn->prepare("SELECT * FROM address WHERE addressid = $addressid");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo('<input type="radio" name="address" value="'.$row["addressid"].'"><label>');
                        echo($row["address1"]."<br>");
                        echo($row["address2"]."<br>");
                        echo($row["city"]."<br>");
                        echo($row["county"]."<br>");
                        echo($row["postcode"]."<br>");
                        echo('</label><br>');
                    } 
                }    
            }
            ?>
        <div class="panel panel-default">
            <div class="panel-heading" class="collapse">
                <a data-toggle="collapse" href="#collapse1">Use Different Address</a>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">
                    <input type="text" name="recipent" placeholder="Recipient Name" required><br><br>
                    <input type="text" name="address1" placeholder="Address Line 1" required><br><br>
                    <input type="text" name="address2" placeholder="Address Line 2 (optional)"><br><br>
                    <input type="text" name="city" placeholder="City/Town/Village" required><br><br>
                    <input type="text" name="county" placeholder="County" required><br><br>
                    <input type="text" name="postcode" placeholder="Postcode" required><br><br>
                </div>
            </div>
        </div>
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

