<?php
include_once('connection.php');
if ($_POST['address1']==""){
    if(!isset($_POST['address'])){
        $_SESSION['message'] = 'Please choose a valid address';
        header('Location: checkoutpage.php');
    }
    else{
        $addressid=$_POST['address'];
        $stmt = $conn->prepare("SELECT * FROM address WHERE addressid = $addressid");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo($row['address1']);
        }
    }
}
// header('Location: ordersummarypage.php');
?>