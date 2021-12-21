<?php
include_once('connection.php');

session_start();

$payment=false;

if($_POST['cardnumber']==""){
    if(!isset($_POST['card'])){
        $_SESSION['message'] = 'Please choose a valid payment method';
        header('Location: checkoutpage.php');
    }
    else{
        $payment=true;
    }
}

else{
    $payment=true;

    $lastfour=substr($_POST['cardnumber'], 0, -4);

    $stmt = $conn->prepare("INSERT INTO card(cardno, lastfour, expdate, cardholdername, postcode, address)
    VALUES(:cardno,:lastfour,:expdate,:cardholdername,:postcode,:address)");

    $stmt->bindParam(':cardno', $_POST['cardnumber']);
    $stmt->bindParam(':lastfour', $lastfour);
    $stmt->bindParam(':expdate', $_POST['expirydate']);
    $stmt->bindParam(':cardholdername', $_POST['cardholdername']);
    $stmt->bindParam(':postcode', $_POST['billingpostcode']);
    $stmt->bindParam(':address', $_POST['billingaddress']);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT cardid FROM card ORDER BY cardid DESC LIMIT 1");
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $cardid=$row['cardid'];

    $stmt = $conn->prepare("INSERT INTO customercard(customerid, cardid)
    VALUES(:customerid,:cardid)");

    $stmt->bindParam(':customerid', $_SESSION['id']);
    $stmt->bindParam(':cardid', $cardid);
    $stmt->execute();
}

if ($_POST['address1']==""){
    if(!isset($_POST['address'])){
        $_SESSION['message'] = 'Please choose a valid address';
        header('Location: checkoutpage.php');
    }
    else{
        if($payment==true){
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

            unset($_SESSION['basket']);
            header('Location: ordersummarypage.php');
        }
    }
}
else{
    if($payment==true){
        $stmt = $conn->prepare("INSERT INTO address(address1, address2, city, county, postcode)
        VALUES(:address1,:address2,:city,:county,:postcode)");

        $stmt->bindParam(':address1', $_POST['address1']);
        $stmt->bindParam(':address2', $_POST['address2']);
        $stmt->bindParam(':city', $_POST['city']);
        $stmt->bindParam(':county', $_POST['county']);
        $stmt->bindParam(':postcode', $_POST['postcode']);
        $stmt->execute();

        $stmt = $conn->prepare("SELECT addressid FROM address ORDER BY addressid DESC LIMIT 1");
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $addressid=$row['addressid'];

        $stmt = $conn->prepare("INSERT INTO customeraddress(customerid, addressid)
        VALUES(:customerid,:addressid)");

        $stmt->bindParam(':customerid', $_SESSION['id']);
        $stmt->bindParam(':addressid', $addressid);
        $stmt->execute();


        $ordercontents=":";
        for ($i=0; $i<(count($_SESSION['basket'])); $i++){
            $itemid=($_SESSION['basket'][$i][0]);
            $qty=($_SESSION['basket'][$i][1]);
            $ordercontents.= ($itemid.','.$qty.':');
        }

        $stmt = $conn->prepare("INSERT INTO orderr(customerid, addressid, ordercontents)
        VALUES(:customerid,:addressid,:ordercontents)");

        $stmt->bindParam(':customerid', $_SESSION['id']);
        $stmt->bindParam(':addressid', $addressid);
        $stmt->bindParam(':ordercontents', $ordercontents);
        $stmt->execute();

        unset($_SESSION['basket']);
        header('Location: ordersummarypage.php');
    }
}
?>