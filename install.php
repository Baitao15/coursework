<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

// creating tables
$stmt = $conn->prepare("DROP TABLE IF EXISTS customer;
CREATE TABLE customer
(customerid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(50) NOT NULL,
password VARCHAR(255) NOT NULL,
forename VARCHAR(20),
surname VARCHAR(20),
phoneno INT(11),
postcode VARCHAR(7),
address VARCHAR(30),
cardno INT(255))");
$stmt->execute();

//inserting defualt data into the customer table
$email = "example@example.com";
$hashed_password = password_hash("12345", PASSWORD_DEFAULT);
$forename = "john";
$surname = "doe";
$phoneno = "01832277122";
$postcode = "NN188LA";
$address = "10 Downing Street";
//encrypting card number using password hash
$cardno = password_hash("1111222233334444", PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO customer(email, password, forename, surname, phoneno, postcode, address, cardno)
VALUES(:email, :password, :forename, :surname, :phoneno, :postcode, :address, :cardno)");

$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hashed_password);
$stmt->bindParam(':forename', $forename);
$stmt->bindParam(':surname', $surname);
$stmt->bindParam(':phoneno', $phoneno);
$stmt->bindParam(':postcode', $postcode);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':cardno', $cardno);
$stmt->execute();


$stmt = $conn->prepare("DROP TABLE IF EXISTS admin;
CREATE TABLE admin
(userid INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
forename VARCHAR(20) NOT NULL,
surname VARCHAR(20) NOT NULL,
password VARCHAR(255) NOT NULL)");
$stmt->execute();

//inserting defualt data into the admin table
$forename = "default";
$surname = "admin";
$hashed_password = password_hash("12345", PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admin(forename, surname, password)
VALUES(:forename, :surname ,:password)");

$stmt->bindParam(':forename', $forename);
$stmt->bindParam(':surname', $surname);
$stmt->bindParam(':password', $hashed_password);
$stmt->execute();


$stmt = $conn->prepare("DROP TABLE IF EXISTS item;
CREATE TABLE item
(itemid INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
itemname VARCHAR(30) NOT NULL,
category VARCHAR(20) NOT NULL,
description VARCHAR(100),
itemprice DECIMAL(4) NOT NULL,
offerid INT(2))");
$stmt->execute();

$stmt = $conn->prepare("DROP TABLE IF EXISTS basket;
CREATE TABLE basket
(customerid INT(6),
itemid INT(4),
qty INT(2) NOT NULL,
CONSTRAINT basket_key PRIMARY KEY (customerid, itemid))");
$stmt->execute();

$stmt = $conn->prepare("DROP TABLE IF EXISTS offer;
CREATE TABLE offer
(offerid INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
offername VARCHAR(30) NOT NULL,
offertype VARCHAR(10) NOT NULL,
num1 INT(3) NOT NULL,
num2 INT(3))");
$stmt->execute();



$conn=null;

?>