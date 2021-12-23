<!DOCTYPE html>

<?php
    session_start();
    include_once("connection.php");
    $itemid=$_GET['id'];
?>

<html>
    <head>
        <title>
            <?php
                $stmt = $conn->prepare("SELECT itemname FROM item WHERE itemid=$itemid");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo($row['itemname']);
                echo(' - Longda Shop');
            ?>
        </title>
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
    <div class=row>
    <div class="col-sm-1"></div>
    <?php
        $stmt = $conn->prepare("SELECT * FROM item WHERE itemid=$itemid");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo('<div class="col-sm-3">');
            echo('<img src="/coursework/images/'.$row["itemimage"].'" width=100% height=100%>');
        echo('</div>');
        
        echo('<div class="col-sm-6">');
            echo('<h1>');
                echo($row["itemname"]);
            echo('</h1>');
            echo('<hr class="solid1">');
            echo('<h2>');
                echo("£".$row["itemprice"]."<br>");
            echo('</h2>');
            echo('<form action="addtobasket.php" method="POST" class="form-inline">');
                echo('<input type="hidden" name="id" value='.$row["itemid"].">");
                echo('<input type="number" placeholder="Qty" name="qty" min="1" max="99" value="1" required>');
                echo('<br><input type="submit" value="Add" class="btn btn-lg"><br>');
            echo("</form><br>");
                ?>
            <hr class="solid2">

            <div class="col-sm-6">
                <h3 class='text-center'>Description</h3>
            </div>
            <div class="col-sm-6">
                <h3 class='text-center'>Reviews</h3>
            </div>
        </div>

        <div class="col-sm-2">
        </div>
<!-- if(isset($_GET['id'])){
    $itemid=$_GET['id'];
    $_SESSION['backURL']='itempage.php?'.$itemid;
} -->