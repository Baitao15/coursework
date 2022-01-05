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

if($_POST['type']=='filter'){
    $categories="";
    $count='1';
    $atleastone=false;

    while($count<=6){
        if(isset($_POST[$count])){
            if($atleastone==false){
                $categories.="category='".$_POST[$count]."'";
                $atleastone=true;
            }
            else{
                $categories.=" OR category='".$_POST[$count]."'";
            }
        }
        $count=$count+1;
    }

    header('Location: grocerypage.php?cat='.$categories);
}
?>