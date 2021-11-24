<?php
include_once('connection.php');

session_start();

if ($_POST['address1']==""){
    if(!isset($_POST['address'])){
        $_SESSION['message'] = 'Please choose a valid address';
        header('Location: checkoutpage.php');
    }
    else{
        $ordercontents=":";
        for ($i=0; $i<(count($_SESSION['basket'])); $i++){
            $itemid=($_SESSION['basket'][$i][0]);
            $qty=($_SESSION['basket'][$i][1]);
            $ordercontents.= ($itemid.','.$qty.':');
        }
        $stmt = $conn->prepare("INSERT INTO orderr(customerid, addressid, ordercontents)
        VALUES(:customerid,:addressid,:ordercontents)");

        $stmt->bindParam(':customerid', $_SESSION['id']);
        $stmt->bindParam(':addressid', $_POST['address']);
        $stmt->bindParam(':ordercontents', $ordercontents);
        $stmt->execute();
    }
}
header('Location: ordersummarypage.php');
?>