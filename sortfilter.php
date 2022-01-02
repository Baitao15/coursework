<?php
if($_POST['type']=='sort'){
    $order=$_POST['order'];
    $sort=$_POST['sort'];
    if($_POST['filter']=='none'){
        header('Location: grocerypage.php?sort='.$sort.'&order='.$order);
    }
    else{
        $filter=$_POST['filter'];
        header('Location: grocerypage.php?sort='.$sort.'&order='.$order.'&cat='.$filter);
    }
}
?>

