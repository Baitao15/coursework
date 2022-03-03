<?php
// linking to connection.php to gain access to the database
include_once("connection.php");
// start session to access userid and total session variable
session_start();
// setting customerid variable to be used to place the order
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
    <!-- reduced navigation bar -->
    <div id=navbar>
        <a href=basketpage.php>Back to Basket</a>
    </div>
    <br><br>
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <?php
        // display error message if applicable
        if (isset($_SESSION['message'])){
            echo("<div class='message'><h3>".$_SESSION['message']."</h3></div>");
            unset($_SESSION['message']);
        }
        ?>
        <form action='placeorder.php' method="POST" class="form-inline">
            <h3>1. Delivery Address</h3>
                <?php
                // if user is logged in, display saved delivery addresses
                if (isset($_SESSION['email'])){
                    echo("<h4>Saved Adresses</h4>");
                    // select address ids from customer-address linking table which are associated with current user
                    $stmt = $conn->prepare("SELECT addressid FROM customeraddress WHERE customerid = $customerid");
                    $stmt->execute();
                    // fetch each corresponding address from the address table by its id
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $addressid=($row['addressid']);
                        $stmt = $conn->prepare("SELECT * FROM address WHERE addressid = $addressid");
                        $stmt->execute();
                        // display each address as a radio for customer users to select
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo('<input type="radio" id="'.$row["addressid"].'" name="address" value="'.$row["addressid"].'">
                            <label for='.$row["addressid"].'>');
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
            <!-- collapsible panel for using different address form -->
            <div class="panel panel-default">
                <div class="panel-heading" class="collapse">
                    <a data-toggle="collapse" href="#collapse1"><h5>Use Different Address</h5></a>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <input type="text" name="recipent" placeholder="Recipient Name" ><br><br>
                        <input type="text" name="address1" placeholder="Address Line 1" ><br><br>
                        <input type="text" name="address2" placeholder="Address Line 2 (optional)"><br><br>
                        <input type="text" name="city" placeholder="City/Town/Village" ><br><br>
                        <input type="text" name="county" placeholder="County"><br><br>
                        <input type="text" name="postcode" placeholder="Postcode"><br><br>
                    </div>
                </div>
            </div>
            <h3>2. Payment Details</h3>
                <?php
                // if user is logged in, display saved payment options
                if (isset($_SESSION['email'])){  
                    echo("<h4>Saved Cards</h4>");
                    // select card ids from customer-card linking table which are associated with current user
                    $stmt = $conn->prepare("SELECT cardid FROM customercard WHERE customerid = $customerid");
                    $stmt->execute();
                    $cards=array();
                    // fetch each corresponding payment method from the card table by its id
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $cardid=($row['cardid']);
                        $stmt = $conn->prepare("SELECT * FROM card WHERE cardid = $cardid");
                        $stmt->execute();
                        // display each payment method as a radio for customer users to select
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo('<input type="radio" id="'.$row["cardid"].'" name="card" value="'.$row["cardid"].'">
                            <label for='.$row["cardid"].'>');
                                echo("****".$row["lastfour"]."<br>");
                                echo($row["cardholdername"]);
                            echo('</label><br>');
                        }
                    }
                }
                ?>
            <!-- collapsible panel for using different payment method form -->
            <div class="panel panel-default">
                <div class="panel-heading" class="collapse">
                    <a data-toggle="collapse" href="#collapse2"><h5>Use Different Payment Mehtod</h5></a>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        Card Details<br>
                        <input type="text" name="cardnumber" placeholder="Card Number"><br><br>
                        <input type="month" name="expirydate"><br><br>
                        <input type="text" name="cardholdername" placeholder="Cardholder Name"><br><br>
                        <input type="number" name="seccode" placeholder="Security Code"><br><br>
                        Billing Address<br>
                        <input type="text" name="billingaddress" placeholder="Address"><br><br>
                        <input type="text" name="billingpostcode" placeholder="Postcode"><br><br>
                        Save this card?
                        <input type="checkbox" name="savecard" value="T">
                    </div>
                </div>
            </div>
            <h3>3. Confirm and Place</h3>
                <!-- display order total -->
                Order Total: <?php echo('£'.number_format(($_SESSION['total']), 2));?><br>
                <!-- place order button to submit the forms -->
                <input type="submit" value="Order & Pay" class="btn btn-lg">
        </form>
    </div>
</body>
</html>

