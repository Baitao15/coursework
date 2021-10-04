<!DOCTYPE html>

<?php
    session_start();

    include_once("connection.php");

    $_SESSION['backURL']='basketpage.php';
?>

<html>
    <head>
        <title>Your Basket</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>

<body>

    <!-- navigation bar -->
    <div id=navbar>
        <a href=homepage.php>Home</a>
        <a href=grocerypage.php>Groceries</a>
        <a href=basketpage.php>Basket</a>
        <?php 
            if (!isset($_SESSION['email'])){
                echo("<a href=registerpage.php>Register</a> <a href=loginpage.php>Login</a>");
            }
            if (isset($_SESSION['email'])){  
                echo("<a href=accountpage.php>Account</a> <a href=logout.php>Logout</a>");
            }
        ?>
    </div>
    <br><br><br>
    <?php
    if (!isset($_SESSION['basket'])){
        echo("Your basket is empty!<br>");
        echo('<a href="grocerypage.php">Add items</a>');
    }
    if (isset($_SESSION['basket'])){
        echo("<table class='table'>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>");
        $total=0;
        for ($i=0; $i<(count($_SESSION['basket'])); $i++){
            $itemid=($_SESSION['basket'][$i][0]);
            $stmt = $conn->prepare("SELECT itemname, itemprice FROM item WHERE itemid = $itemid");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<tr><td>'.$row['itemname'].'</td>');
                echo('<td>'.$_SESSION['basket'][$i][1].'</td>'); 
                $price = ($row['itemprice'])*($_SESSION['basket'][$i][1]);
                echo('<td>'.'£'.$price.'</td>');
                echo('</tr>');
                $total=$total+$price;
            }  
        }
        echo("</table>
            <b>Total<br>
            £".$total."<b>");
        
        echo("<a href='checkoutpage.php' class='btn btn-sm'>Checkout</a>");
    }
    ?>

</body>
</html>