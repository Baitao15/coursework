<?php
include_once('connection.php');
if (!isset($_POST['address1'])){
    if(!isset($_POST['address'])){
        $_SESSION['message'] = 'Please enter a valid address';
        header('Location: checkoutpage.php');
    }
    else{
        $stmt = $conn->prepare("SELECT addressid FROM customeraddress WHERE customerid = $customerid");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $addressid=($row['addressid']);
                    $stmt = $conn->prepare("SELECT * FROM address WHERE addressid = $addressid");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){};
    }
}
// header('Location: ordersummarypage.php');
?>