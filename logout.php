<?php
session_start();

if(isset($_SESSION['userid']))
{
    unset($_SESSION['userid']);
}

if(isset($_SESSION['email']))
{
    unset($_SESSION['email']);
}

if(isset($_SESSION['basket']))
{
    unset($_SESSION['basket']);
}

header("Location: homepage.php");
?>

