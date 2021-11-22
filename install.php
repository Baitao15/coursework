<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

// creating customer table
$stmt = $conn->prepare("DROP TABLE IF EXISTS customer;
CREATE TABLE customer
(customerid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(50) NOT NULL,
password VARCHAR(255) NOT NULL,
forename VARCHAR(20),
surname VARCHAR(20),
phoneno INT(11))");
$stmt->execute();

// inserting defualt data into the customer table
$email = "example@example.com";
$hashed_password = password_hash("12345", PASSWORD_DEFAULT);
$forename = "john";
$surname = "doe";
$phoneno = "01832277122";

$stmt = $conn->prepare("INSERT INTO customer(email, password, forename, surname, phoneno)
VALUES(:email, :password, :forename, :surname, :phoneno)");

$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hashed_password);
$stmt->bindParam(':forename', $forename);
$stmt->bindParam(':surname', $surname);
$stmt->bindParam(':phoneno', $phoneno);
$stmt->execute();


// creating customer address linking table
$stmt = $conn->prepare("DROP TABLE IF EXISTS customeraddress;
CREATE TABLE customeraddress
(customerid INT(6) NOT NULL,
addressid INT(8) NOT NULL)");
$stmt->execute();

// inserting data into table
$customerid = 1;
$addressid = 1;

$stmt = $conn->prepare("INSERT INTO customeraddress(customerid, addressid)
VALUES(:customerid, :addressid)");

$stmt->bindParam(':customerid', $customerid);
$stmt->bindParam(':addressid', $addressid);
$stmt->execute();

// creating address table
$stmt = $conn->prepare("DROP TABLE IF EXISTS address;
CREATE TABLE address
(addressid INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
address1 VARCHAR(32) NOT NULL,
address2 VARCHAR(32),
city VARCHAR(20) NOT NULL,
county VARCHAR(20) NOT NULL,
postcode VARCHAR(7) NOT NULL)");
$stmt->execute();

// inserting data into address table
$address1 = "10 Downing Street";
$address2 = "Flat 2";
$city = "Oundle";
$county ="Northamptonshire";
$postcode = "NN188LA";

$stmt = $conn->prepare("INSERT INTO address(address1, address2, city, county, postcode)
VALUES(:address1, :address2, :city, :county, :postcode)");

$stmt->bindParam(':address1', $address1);
$stmt->bindParam(':address2', $address2);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':county', $county);
$stmt->bindParam(':postcode', $postcode);
$stmt->execute();


// creating customer card linking table
$stmt = $conn->prepare("DROP TABLE IF EXISTS customercard;
CREATE TABLE customercard
(customerid INT(6) NOT NULL,
cardid INT(8) NOT NULL)");
$stmt->execute();

// inserting data into table
$customerid = 1;
$cardid = 1;

$stmt = $conn->prepare("INSERT INTO customercard(customerid, cardid)
VALUES(:customerid, :cardid)");

$stmt->bindParam(':customerid', $customerid);
$stmt->bindParam(':cardid', $cardid);
$stmt->execute();

// creating card table
$stmt = $conn->prepare("DROP TABLE IF EXISTS card;
CREATE TABLE card
(cardid INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
cardno VARCHAR(128) NOT NULL,
lastfour INT(4) NOT NULL,
expdate DATE NOT NULL,
cardholdername VARCHAR(32) NOT NULL,
postcode VARCHAR(7) NOT NULL,
address VARCHAR(32) NOT NULL)");
$stmt->execute();

// inserting data into address table
// encrypting card number using hash
$cardno = password_hash("1111222233334444", PASSWORD_DEFAULT);
$lastfour = "4444";
$expdate = "2021-10-01";
$cardholdername = "E EXAMPLE";
// for this section, i will just use the same address and postcode from line 64

$stmt = $conn->prepare("INSERT INTO card(cardno, lastfour, expdate, cardholdername, postcode, address)
VALUES(:cardno, :lastfour, :expdate, :cardholdername, :postcode, :address1)");

$stmt->bindParam(':cardno', $cardno);
$stmt->bindParam(':lastfour', $lastfour);
$stmt->bindParam(':expdate', $expdate);
$stmt->bindParam(':cardholdername', $cardholdername);
$stmt->bindParam(':postcode', $postcode);
$stmt->bindParam(':address1', $address1);
$stmt->execute();


// creating admin table
$stmt = $conn->prepare("DROP TABLE IF EXISTS admin;
CREATE TABLE admin
(userid INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
forename VARCHAR(20) NOT NULL,
surname VARCHAR(20) NOT NULL,
password VARCHAR(255) NOT NULL)");
$stmt->execute();

// inserting defualt data into the admin table
$forename = "default";
$surname = "admin";
$hashed_password = password_hash("12345", PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admin(forename, surname, password)
VALUES(:forename, :surname ,:password)");

$stmt->bindParam(':forename', $forename);
$stmt->bindParam(':surname', $surname);
$stmt->bindParam(':password', $hashed_password);
$stmt->execute();

// creating item table
$stmt = $conn->prepare("DROP TABLE IF EXISTS item;
CREATE TABLE item
(itemid INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
itemname VARCHAR(30) NOT NULL,
itemimage VARCHAR(255),
category VARCHAR(20) NOT NULL,
description VARCHAR(100),
itemprice DECIMAL(4,2) NOT NULL,
stock INT(3) NOT NULL,
offerid INT(2))");
$stmt->execute();

// inserting default data into the item table
$itemname="Apples Loose";
$itemimage="apples";
$category="produce";
$description="Crisp and Juicy";
$price=0.4;
$stock=99;
$image="apples.jpeg";

$stmt = $conn->prepare("INSERT INTO item(itemname, itemimage, category, description, itemprice, stock)
VALUES(:itemname, :itemimage, :category ,:description, :itemprice, :stock)");

$stmt->bindParam(':itemname', $itemname);
$stmt->bindParam(':itemimage', $image);
$stmt->bindParam(':category', $category);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':itemprice', $price);
$stmt->bindParam(':stock', $stock);
$stmt->execute();


$itemname="Banana 6pk";
$category="produce";
$description="Ripe and Ready";
$price=1.2;
$stock=99;

$stmt = $conn->prepare("INSERT INTO item(itemname, category, description, itemprice, stock)
VALUES(:itemname, :category ,:description, :itemprice, :stock)");

$stmt->bindParam(':itemname', $itemname);
$stmt->bindParam(':category', $category);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':itemprice', $price);
$stmt->bindParam(':stock', $stock);
$stmt->execute();

$itemname="Pear 4pk";
$category="produce";
$description="Juicy";
$price=1;
$stock=99;
$stmt->execute();

$itemname="Watermelon";
$category="produce";
$description="Sweet and Juicy";
$price=1.5;
$stock=99;
$stmt->execute();

$itemname="Oranges 1kg";
$category="produce";
$description="Tangy and Juicy";
$price=1;
$stock=99;
$stmt->execute();

$itemname="Strawberries 500g";
$category="produce";
$description="Sweet and Juicy";
$price=2;
$stock=99;
$stmt->execute();

$itemname="Tiger Bread";
$category="bakery";
$description="Freshly Baked";
$price=0.8;
$stock=99;
$stmt->execute();

$itemname="White Bread";
$category="bakery";
$description="Freshly Baked";
$price=0.6;
$stock=99;
$stmt->execute();
$stmt->execute();
$stmt->execute();
$stmt->execute();
$stmt->execute();
$stmt->execute();
$stmt->execute();
$stmt->execute();
$stmt->execute();
$stmt = $conn->prepare("DROP TABLE IF EXISTS offer;
CREATE TABLE offer
(offerid INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
offername VARCHAR(30) NOT NULL,
offertype VARCHAR(10) NOT NULL,
num1 INT(3) NOT NULL,
num2 INT(3))");
$stmt->execute();

$stmt = $conn->prepare("DROP TABLE IF EXISTS orderr;
CREATE TABLE orderr
(orderid INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
customerid INT(6),
addressid INT(8),
ordercontents VARCHAR(256))");
$stmt->execute();

$conn=null;

?>