<?php
// link to connection.php to gain access to the database
include_once('connection.php');
// start session to access basket and customer id session variables
session_start();
// keeping track of wether a valid payment method has been selected
$payment=false;

// cardnumber is the input from the new payment method form
// if it is null, check the radio input (card)
if($_POST['cardnumber']==""){
    if(!isset($_POST['card'])){
        // if no payment method is selected, redirect to checkout page with message
        $_SESSION['message'] = 'Please choose a valid payment method';
        header('Location: checkoutpage.php');
    }
    else{
        // if there was a saved card selected, set payment to true
        $payment=true;
        // for purposes discussed in the 'Design' section of my write-up, no acutal payments will be taken
    }
}

else{
    // the new payment method form was used, so set payment to true
    $payment=true;
    if($_POST['savecard']=="T"){
        // if user selected checkbox on previous page, save the card details to the database
        $lastfour=substr($_POST['cardnumber'], -4, 4);
        $cardnumber=password_hash($_POST['cardnumber'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO card(cardno, lastfour, expdate, cardholdername, postcode, address)
        VALUES(:cardno,:lastfour,:expdate,:cardholdername,:postcode,:address)");

        $stmt->bindParam(':cardno', $cardnumber);
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

        // link newly saved card to current user's account
        $stmt = $conn->prepare("INSERT INTO customercard(customerid, cardid)
        VALUES(:customerid,:cardid)");

        $stmt->bindParam(':customerid', $_SESSION['id']);
        $stmt->bindParam(':cardid', $cardid);
        $stmt->execute();
    }
}

// address1 is the input from the new payment method form
// if it is null, check the radio input (address)
if ($_POST['address1']==""){
    if(!isset($_POST['address'])){
        // if no delivery address is selected, redirect to checkout page with message
        $_SESSION['message'] = 'Please choose a valid address';
        header('Location: checkoutpage.php');
    }
    else{
        // if payment is true
        if($payment==true){
            // declare ordercontents variable
            $ordercontents=":";
            // for each item and its quantity in the basket,
            // append it to the ordercontents variable
            // use of encoding to reduce storage required
            // and to make it easier to retrieve items as itemid and qty are given
            // the format is :itemid1,qty1:itemid2,qty2:itemid3,qty3:
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