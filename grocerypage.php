<!DOCTYPE html>

<?php
    session_start();

    include_once("connection.php");

    $_SESSION['backURL']='grocerypage.php';
?>

<html>
    <head>
        <title>Longda - Groceries</title>
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

    <!-- groceries -->
    <div class="groceries">
        <?php
            // getting relevant data from the database
            $stmt = $conn->prepare("SELECT itemid, itemname, itemimage, itemprice FROM item WHERE stock>0");
            $stmt->execute();
            // counter
            $i=0;
            // displaying each item and its details
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // every four items, a new row will be started
                if ($i==0){
                    echo('<div class=row>');
                    echo('<div class="col-sm-2"></div>');
                }
                echo('<div class="col-sm-2">');
                    echo('<div class="panel panel-default text-center">');
                        echo('<div class="panel-heading"><b>'.$row["itemname"]."</b></div>");
                        echo('<div><img src="/coursework/images/'.$row["itemimage"].'" width="128" height="128"></div>');
                        echo("<br>"."£".$row["itemprice"]."<br>");
                        echo('<form action="addtobasket.php" method="POST" class="form-inline">');
                            echo('<input type="hidden" name="id" value='.$row["itemid"].">");
                            echo('<input type="number" placeholder="Qty" name="qty" min="1" max="99" value="1" required>');
                            echo('<br><input type="submit" value="Add" class="btn btn-sm"><br>');
                        echo("</form><br>");
                    echo('</div>');
                echo('</div>');
                $i=$i+1;
                if ($i==4){
                    echo('<div class="col-sm-2"></div>');
                    echo('</div>');
                    $i=0;
                }
            }
        ?>
    </div>

