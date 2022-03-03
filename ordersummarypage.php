<!DOCTYPE html>

<?php
    session_start();
    include_once('connection.php');
    $id = $_SESSION['id'];
?>

<html>
    <head>
        <title>Order Confirmed</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>

<body>
    <!-- navigation bar -->
    <div id=navbar>
        <a href=homepage.php>Home</a>
        <?php 
            if (!isset($_SESSION['email'])){
                echo("<a href=registerpage.php>Register</a> <a href=loginpage.php>Login</a>");
            }
            if (isset($_SESSION['email'])){  
                echo("<a href=accountpage.php>Account</a> <a href=logout.php>Logout</a>");
            }
        ?>
    </div>
    <br>
    <!-- main body -->
        <div class="container text-center">
            <h3>Thank You!</h3>
            Order placed successfully
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <table class='table'>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </table>
            </div>
        </div>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM orderr WHERE customerid = $id ORDER BY orderid DESC LIMIT 1");
                    $stmt->execute();

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    $oc=$row['ordercontents'];

                    $total=0;
                    
                    while(strlen($oc)>2){
                        $colon=strpos($oc,':');
                        $comma=strpos($oc,',');

                        $itemid=(substr($oc, ($colon+1), (($comma-1)-($colon))));
                        
                        $oc=substr($oc,($colon+1));

                        $colon=strpos($oc,':');
                        $comma=strpos($oc,',');

                        $qty=(substr($oc, ($comma+1), (($colon-1)-($comma))));

                        $oc=substr($oc,($comma+1));

                        $stmt = $conn->prepare("SELECT * FROM item WHERE itemid = $itemid");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo('<tr>');
                            echo('<td>');
                                echo($row['itemname']);
                            echo('</td>');
                            echo('<td>');
                                echo($qty);
                            echo('</td>');
                            echo('<td>');
                                echo('£'.number_format(($row['itemprice']*$qty), 2));
                            echo('</td>');
                        echo('</tr>');
                        $total=$total+($row['itemprice']*$qty);
                    }
                    ?>
                </table>
            <?php
            echo('<b>Order Total</b>: £'.number_format(($total), 2));
            ?>
            </div>
        </div>
</body>
</html>