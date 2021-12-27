<?php
include_once("connection.php");

$stmt = $conn->prepare("DROP TABLE IF EXISTS review;
CREATE TABLE review
(reviewid INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
customerid INT(6) NOT NULL,
itemid INT(4) NOT NULL,
reviewtitle VARCHAR(32) NOT NULL,
reviewtext VARCHAR(255) NOT NULL,
stars INT(1) NOT NULL)");
$stmt->execute();

$stmt = $conn->prepare("INSERT INTO review(customerid, itemid, reviewtitle, reviewtext, stars)
VALUES(:customerid, :itemid ,:reviewtitle, :reviewtext, :stars)");

$customerid=1;
$itemid=1;
$title='Sweet and Delicious';
$text='Very sweet, perfect for a healthy snack';
$stars=5;

$stmt->bindParam(':customerid', $customerid);
$stmt->bindParam(':itemid', $itemid);
$stmt->bindParam(':reviewtitle', $title);
$stmt->bindParam(':reviewtext', $text);
$stmt->bindParam(':stars', $stars);
$stmt->execute();
?>