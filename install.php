<?php
include_once("connection.php");

$stmt = $conn->prepare("DROP TABLE IF EXISTS customers;
CREATE TABLE customers
(customerid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(50) NOT NULL,
password VARCHAR(50) NOT NULL,
forename INT(20) NOT NULL,
surname VARCHAR(20) NOT NULL,
phoneno INT(11) NOT NULL,
postcode VARCHAR(7) NOT NULL,
address VARCHAR(30) NOT NULL,
cardno INT(16))");
$stmt->execute();

$conn=null;

// header("Location: login.php");

?>