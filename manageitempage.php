<html>

<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

// checking authorised user
session_start(); 
if (!isset($_SESSION['userid'])){   
    header("Location:adminloginpage.php");
}

// getting admin forename
$findid = ($_SESSION['userid']);
$stmt = $conn->prepare("SELECT forename FROM admin WHERE userid = $findid");
$stmt->execute();
?>

<head>
    <title>Manage Items</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <!-- navigation bar -->
    <p id=navbar>
        <a href=adminhomepage.php>Home</a>
        <a href=insightpage.php>Insights</a>
        <a href=manageitempage.php>Items</a>
        <a href=manageofferpage.php>Offers</a>
        <a href=manageaccountpage.php>Account</a>
        <a href=adminlogout.php>Logout</a>
    </p>
<br><br><br>
    <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo("Hi ".$row["forename"].", what would you like to do?");
        }
    ?>


<br><br><br>
    <h4>Add New Item</h4>
    <form action="manageitem.php" method="POST">
        <input type="text" name="itemname" placeholder="Item Name" required><br><br>
        <input type="file" name="itemimage"><br>
        <select name="category" required>
            <option disabled selected>--Category--</option>
            <option value="fresh">Fresh Food</option>
            <option value="produce">Produce</option>
            <option value="bakery">Bakery</option>
            <option value="cupboard">Food Cupboard</option>
            <option value="frozen">Frozen</option>
            <option value="other">Other</option>
        </select><br><br>
        <input type="text" name="description" placeholder="Description (optional)"><br><br>
        <input type="number" name="price" placeholder="Price" step=".01" required><br><br>
        <input type="number" name="stock" placeholder="Stock" required><br>
        <input type="hidden" name="type" value="add"><br><br>
        <input type="submit" value="Add" class="btn btn-sm">
        <br>
    </form>

</body>
</html>
