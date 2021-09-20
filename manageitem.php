<?php

// linking to connection.php to gain access to the database
include_once("connection.php");

// if adding item
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

header('Location: manageitempage.php');

?>