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
    <title>View Orders</title>
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

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <table class='table'>
                <tr>
                    <th>OrderID</th>
                    <th>Customer</th>
                    <th>Delivery Address</th>
                    <th>Order Total</th>
                </tr>
                <?php
                $stmt = $conn->prepare("SELECT * FROM orderr ORDER BY orderid");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $orderid=$row['orderid'];
                    $customerid=$row['customerid'];
                    $addressid=$row['addressid'];
                    $oc=$row['ordercontents'];

                    $stmt1 = $conn->prepare("SELECT * FROM customer WHERE customerid=$customerid");
                    $stmt1->execute();
                    $row = $stmt1->fetch(PDO::FETCH_ASSOC);
                    $forename=$row['forename'];
                    $surname=$row['surname'];

                    $stmt2 = $conn->prepare("SELECT * FROM address WHERE addressid=$addressid");
                    $stmt2->execute();
                    $row = $stmt2->fetch(PDO::FETCH_ASSOC);
                    $address=$row['address1'];

                    $total=0;
                    while(strlen($oc)>3){
                        $colon=strpos($oc,':');
                        $comma=strpos($oc,',');

                        $itemid=(substr($oc, ($colon+1), (($comma-1)-($colon))));
                        
                        $oc=substr($oc,($colon+1));

                        $colon=strpos($oc,':');
                        $comma=strpos($oc,',');

                        $qty=(substr($oc, ($comma+1), (($colon-1)-($comma))));

                        $oc=substr($oc,($comma+1));

                        $stmt3 = $conn->prepare("SELECT * FROM item WHERE itemid = $itemid");
                        $stmt3->execute();
                        $row = $stmt3->fetch(PDO::FETCH_ASSOC);
                        $total=$total+($row['itemprice']*$qty);
                    }
                    
                    echo("<tr>");
                        echo("<td><a href='specificorder.php?id=".$orderid."'>".$orderid."</a></td>");
                        echo("<td>".$forename.' '.$surname."</td>");
                        echo("<td>".$address."</td>");
                        echo("<td>£".number_format(($total), 2)."</td>");
                    echo("</tr>");
                }
                ?>
            </table>
        </div>
    </div>

</body>
</html>

