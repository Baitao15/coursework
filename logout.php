<?php
session_start();

if(isset($_SESSION['email']))
{
    unset($_SESSION['email']);
}

$loggedin=false;

if (isset($_SESSION['email']))
{   
    $loggedin=true;
}

if ($loggedin==false){
    echo("<p>false</p>");
}
if ($loggedin==true){
    echo("<p>true</p>");
}

header("Location: homepage.php");
?>