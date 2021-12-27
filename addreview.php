<?php
session_start();
include_once("connection.php");

$stmt = $conn->prepare("INSERT INTO review(customerid, itemid, reviewtitle, reviewtext, stars)
VALUES(:customerid, :itemid ,:reviewtitle, :reviewtext, :stars)");

$customerid=$_SESSION['id'];
$itemid=$_POST['itemid'];
$title=$_POST['title'];
$text=$_POST['text'];
$stars=$_POST['star'];

$stmt->bindParam(':customerid', $customerid);
$stmt->bindParam(':itemid', $itemid);
$stmt->bindParam(':reviewtitle', $title);
$stmt->bindParam(':reviewtext', $text);
$stmt->bindParam(':stars', $stars);
$stmt->execute();
?>

