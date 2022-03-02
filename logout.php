<?php
// gain access to session variables
session_start();

// unset all existing session variables
if(isset($_SESSION['id']))
{
    unset($_SESSION['id']);
}

if(isset($_SESSION['email']))
{
    unset($_SESSION['email']);
}

if(isset($_SESSION['basket']))
{
    unset($_SESSION['basket']);
}

// redirect user to home page
header("Location: homepage.php");
?>

