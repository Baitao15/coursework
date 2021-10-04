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
    
}

header('Location: manageitempage.php');

?>
