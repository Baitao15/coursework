<?php

// linking to connection.php to gain access to the database
include_once("connection.php");

// if adding item, data is sent to the database
if ($_POST["type"]=="add"){
    $stmt = $conn->prepare("INSERT INTO item(itemname, itemimage, category, description, itemprice, stock)
    VALUES(:itemname, :itemimage, :category, :description, :itemprice, :stock)");

    $stmt->bindParam(':itemname', $_POST["itemname"]);
    $stmt->bindParam(':itemimage', $_POST["itemimage"]);
    $stmt->bindParam(':category', $_POST["category"]);
    $stmt->bindParam(':description', $_POST["description"]);
    $stmt->bindParam(':itemprice', $_POST["price"]);
    $stmt->bindParam(':stock', $_POST["stock"]);
    $stmt->execute();
}

if ($_POST["type"]=="edit"){
    $stmt = $conn->prepare("SELECT * FROM item");
    $stmt->execute();

    // set variables to match current contents of table
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $name=$row['itemname'];
        $image=$row['itemimage'];
        $cat=$row['category'];
        $desc=$row['description'];
        $price=$row['itemprice'];
        $stock=$row['stock'];
    }

    

    $stmt = $conn->prepare("UPDATE item SET ");
}

header('Location: manageitempage.php');

?>

