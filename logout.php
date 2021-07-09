<?php
session_start();

if (!isset($_SESSION['backURL'])){
    $backURL= "/";
}else{
    $backURL=$_SESSION['backURL'];
}
unset($_SESSION['backURL']);
header('Location: ' . $backURL);

if(isset($_SESSION['email']))
{
    unset($_SESSION['email']);
}
header("Location: homepage.php");
?>