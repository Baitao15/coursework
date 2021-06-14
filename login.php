<?php

session_start();

include_once("connection.php");

array_map("htmlspecialchars", $_POST);

$stmt = $conn->prepare("SELECT * FROM customer WHERE email = :email;");
$stmt->blindparam(':email', $_POST['email']);