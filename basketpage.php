<!DOCTYPE html>

<?php
    // start session to access basket session variable
    session_start();
    // link to database to access items data
    include_once("connection.php");
    // setting backURL session variable for redirects
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
    // if no basket variable has been set, print error message
    if (!isset($_SESSION['basket'])){
        echo('<div class="container text-center">');
            echo('<h4>');
                echo("Your basket is empty!<br><br>");
                // link to grocery page to allow users to add items
                echo('<a href="grocerypage.php">Add items</a>');
            echo('</h4>');
        echo('</div>');
    }
    // if basket variable has been set, display contents in table
    if (isset($_SESSION['basket'])){
        echo("<div class='row'>
                <div class='col-sm-2'></div>
                <div class='col-sm-8'>
                    <table class='table'>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>");
        // total price of order
        $total=0;
        // for each item in the basket array
        for ($i=0; $i<(count($_SESSION['basket'])); $i++){
            // use them item id to fetch its details
            $itemid=($_SESSION['basket'][$i][0]);
            $stmt = $conn->prepare("SELECT itemname, itemprice FROM item WHERE itemid = $itemid");
            $stmt->execute();
            // display item data in table
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo('<tr><td>'.$row['itemname'].'</td>');
                // display quantity of item
                echo('<td>'.$_SESSION['basket'][$i][1].'</td>');
                // calculate and display price of number of items
                $price = ($row['itemprice'])*($_SESSION['basket'][$i][1]);
                echo('<td>'.'£'.number_format(($price), 2).'</td>');
                echo('</tr>');
                // add calculated price to total
                $total=$total+$price;
            }  
        }
        // close table and display total cost of all items in basket
        echo("</table>
            <b>Total<br>
            £".number_format(($total), 2)."</b><br>");
        // button for proceeding to checkout
        echo("<form action='checkoutpage.php' method='POST' class='form-inline'>
                <input type='hidden' name='total' value='$total'>
                <input type='submit' value='Checkout' class='btn btn-sm'>
            </form>
            </div>
            </div>");
        // set total session variable so that it can be retrieved by checkout.php
        $_SESSION['total']=$total;
    }
    ?>
</body>
</html>