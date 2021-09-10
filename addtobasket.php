<?php
session_start();
// creating session variable basket
// use of 2D array, storing itemid and quantity
if (!isset($_SESSION['basket'])){
    $_SESSION['basket']=array();
}

// creating temporary array to hold id and qty
$temp=array();

$itemid=$_POST['id'];
$qty=$_POST['qty'];

// adding id and qyt to temporary array
array_push($temp, $itemid, $qty);

// adding temporary array to basket array
array_push($_SESSION['basket'], $temp);

?>