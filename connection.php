<?php
// setting variables, which will be used to login to the database
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "longda";

// attempting to connect to the database
try {
    // passing the variabes through to login to the database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // if the database is accessed successfully, a success message is returned
    // echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    // if the connection fails, an error message is returned
    // echo "Connection failed: " . $e->getMessage();
    }
?>