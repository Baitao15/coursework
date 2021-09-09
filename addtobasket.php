<?php
session_start();
// creating session variable basket
// use of 2D array, storing itemid and quantity
if (!isset($_SESSION['basket'])){
    $_SESSION['basket']=array();
}

$temp=array();

$itemid=$_POST['id'];
$qty=$_POST['qty'];

array_push($temp, $itemid, $qty);

echo($temp[0].$temp[1]);

?>