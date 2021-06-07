<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

// creating tables
$stmt = $conn->prepare("DROP TABLE IF EXISTS customers;
CREATE TABLE customers
(customerid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(50) NOT NULL,
password VARCHAR(50) NOT NULL,
forename INT(20),
surname VARCHAR(20),
phoneno INT(11),
postcode VARCHAR(7),
address VARCHAR(30),
cardno INT(16))");
$stmt->execute();

$conn=null;

?>