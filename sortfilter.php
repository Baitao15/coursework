<?php
// when sort form submitted
if($_POST['type']=='sort'){
    // set the inputs as variables
    $order=$_POST['order'];
    $sort=$_POST['sort'];
    // if there was no filter applied
    if($_POST['filter']=='none'){
        // redirect to grocerypage.php with corresponding sort variables
        header('Location: grocerypage.php?sort='.$sort.'&order='.$order);
    }
    // if there was at least one filter applied
    else{
        $filter=$_POST['filter'];
        // redirect to grocerypage.php with corresponding sort and filter variables
        header('Location: grocerypage.php?sort='.$sort.'&order='.$order.'&cat='.$filter);
    }
}

// when filter form submitted
if($_POST['type']=='filter'){
    // begin with null categories variable
    $categories="";
    // counter for while loop
    $count='1';
    // after an item has been added, the SQL being appended needs to include OR
    $atleastone=false;

    /* This section loops through all of the checkboxes to see wether or not they
    have been checked. SQL code is appended to the variable $categories accordingly. */
    while($count<=6){
        // if the checkbox has been selected
        if(isset($_POST[$count])){
            // if there has not been something appended already
            if($atleastone==false){
                // append
                // N.B. $_POST[$count] is the name of the category,
                // which is determined by the 'value' of the checkbox on the previous page
                $categories.="category='".$_POST[$count]."'";
                // an item has been appended, so set to true
                $atleastone=true;
            }
            // there has been something appended already 
            else{
                // so append with an OR
                $categories.=" OR category='".$_POST[$count]."'";
            }
        }
        $count=$count+1;
    }
    // redirect user back to grocery page with correct variables
    if($_POST['sort']=='none'){
        header('Location: grocerypage.php?cat='.$categories);
    }
    else{
        $order=$_POST['order'];
        $sort=$_POST['sort'];
        header('Location: grocerypage.php?cat='.$categories.'&sort='.$sort.'&order='.$order);
    }
}
?>