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
    <?php
        $stmt = $conn->prepare("SELECT * FROM item WHERE itemid=$itemid");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class=row>
    <div class="col-sm-1"></div>
        <div class="col-sm-3">
            <?php echo('<img src="/coursework/images/'.$row["itemimage"].'" width=100% height=100%>');?>
        </div>
        <div class="col-sm-6">
            <h1>
                <?php echo($row["itemname"]);?>
            </h1>
            <hr class="solid1">
            <h2>
                <?php echo("£".$row["itemprice"]."<br>");?>
            </h2>
            <form action="addtobasket.php" method="POST" class="form-inline">
                <?php echo('<input type="hidden" name="id" value='.$row["itemid"].">");?>
                <input type="number" placeholder="Qty" name="qty" min="1" max="99" value="1" required>
                <br><input type="submit" value="Add" class="btn btn-lg"><br>
            </form><br>
            <hr class="solid2">
            <div class=row>
                <div class="col-sm-6">
                    <h3 class='text-center'>Description</h3>
                </div>
                <div class="col-sm-6">
                    <h3 class='text-center'>Reviews</h3>
                </div>
            </div>
            <hr class="solid1">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div class="col-sm-2">
        </div>
<!-- if(isset($_GET['id'])){
    $itemid=$_GET['id'];
    $_SESSION['backURL']='itempage.php?'.$itemid;
} -->