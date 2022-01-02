<!DOCTYPE html>

<?php
    session_start();

    include_once("connection.php");

    $_SESSION['backURL']='grocerypage.php';
?>

<html>
    <head>
        <title>Longda - Groceries</title>
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    </head>

<body>

    <!-- navigation bar -->
    <div id=navbar>
        <a href=homepage.php>Home</a>
        <a href=grocerypage.php class="dropbtn">Groceries</a>
        <a href=basketpage.php>Basket</a>
        <?php 
            if (!isset($_SESSION['email'])){
                echo("<a href=registerpage.php>Register</a> <a href=loginpage.php>Login</a>");
            }
            if (isset($_SESSION['email'])){  
                echo("<a href=accountpage.php>Account</a> <a href=logout.php>Logout</a>");
            }
        ?>
    </div>

    <!-- <div class="dropdown-content">
        <a href="grocerypage.php?cat=produce">Fruit & Veg</a><br>
        <a href="grocerypage.php?cat=bakery">Bakery</a><br>
        <a href="grocerypage.php?cat=fresh">Fresh</a><br>
        <a href="grocerypage.php?cat=frozen">Frozen</a><br>
        <a href="grocerypage.php?cat=cupboard">Pantry</a><br>
        <a href="grocerypage.php?cat=other">Other</a>
    </div> -->

    <br><br><br>

    <!-- groceries -->
    <div class="groceries">
        <?php
            // getting relevant data from the database
            if((!isset($_GET['sort']))&&(!isset($_GET['cat']))){
                $stmt = $conn->prepare("SELECT itemid, itemname, itemimage, itemprice FROM item WHERE stock>0");
            }
            else{
                if(isset($_GET['sort'])){
                    $sort=$_GET['sort'];
                    $order=$_GET['order'];

                    if(isset($_GET['cat'])){
                        $stmt = $conn->prepare("SELECT itemid, itemname, itemimage, itemprice FROM item
                        WHERE stock>0 AND category='$category' ORDER BY $sort $order");
                    }
                    else{
                        $stmt = $conn->prepare("SELECT itemid, itemname, itemimage, itemprice FROM item
                        WHERE stock>0 ORDER BY $sort $order");
                    }
                }
                else{
                    $stmt = $conn->prepare("SELECT itemid, itemname, itemimage, itemprice FROM item
                    WHERE stock>0 AND category='$category'");
                }
            }
            $stmt->execute();
        ?>
        <!-- sort and filter buttons-->
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="dropdown">
                <button id="sortBtn" class="btn dropbtn" onclick="sortDrop()">
                    Sort
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter-left" viewBox="0 0 16 16">
                        <path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                </button>
                <div id="sortDropdown" class="dropdown-content">
                    <form action="sortfilter.php" method="POST" id="sortForm" style="padding: 10%;">
                        <div class="text-center">
                            <input id="order-asc" type="radio" value="ASC" name="order" style="display: none;" required>
                            <label id="order-asc" for="order-asc">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-sort-down-alt" viewBox="0 0 16 16">
                                    <path d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293V3.5zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1h-1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1h-3zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1h-5zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5z"/>
                                </svg>
                            </label>
                            <input id="order-des" type="radio" value="DESC" name="order" style="display: none;">
                            <label id="order-des" for="order-des">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-sort-up" viewBox="0 0 16 16">
                                    <path d="M3.5 12.5a.5.5 0 0 1-1 0V3.707L1.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.498.498 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L3.5 3.707V12.5zm3.5-9a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
                                </svg>
                            </label>
                        </div>
                        <hr class="solid1">
                        <input id="price" type="radio" value="itemprice" name="sort" required>
                        <label for="price">Price</label><br>
                        <input id="name" type="radio" value="itemname" name="sort">
                        <label for="name">Name</label>
                        <input type="hidden" name="type" value='sort'>
                        <input type="hidden" name="filter" value=<?php if(isset($category)){echo($category);} else{echo('none');}?>>
                        <br><div class="text-center"><input type="submit" value="Apply" class="btn btn-lg"></div>
                    </form>
                </div>
            </div>
            <div class="dropdown">
                <button id="filterBtn" class="btn dropbtn" onclick="filterDrop()">
                    Filter
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
                    </svg>
                </button>
                <div id="filterDropdown" class="dropdown-content" style="width: 250%;">
                    <form action="sortfilter.php" method="POST" id="filterForm" style="padding: 10%;">
                        <label for="category">Category</label>
                        <div id="category">
                            <input id="produce" type="checkbox" value="produce" name="category" required>
                            <label for="produce">Fruit & Veg</label><br>
                            <input id="bakery" type="checkbox" value="bakery" name="category">
                            <label for="bakery">Bakery</label><br>
                            <input id="fresh" type="checkbox" value="fresh" name="category">
                            <label for="fresh">Fresh</label><br>
                            <input id="frozen" type="checkbox" value="frozen" name="category">
                            <label for="frozen">Frozen</label><br>
                            <input id="cupboard" type="checkbox" value="cupboard" name="category">
                            <label for="cupboard">Food Cupboard</label><br>
                            <input id="other" type="checkbox" value="other" name="category">
                            <label for="other">Other</label>
                        </div>
                        <input type="hidden" name="type" value='filter'>
                        <input type="hidden" name="sort" value=<?php if(isset($sort)){echo($sort);}?>>
                        <br><div class="text-center"><input type="submit" value="Apply" class="btn btn-lg"></div>
                    </form>
                </div>
            </div>
        </div>
        <?php
            // counter
            $i=0;
            // displaying each item and its details
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // every four items, a new row will be started
                if ($i==0){
                    echo('<br><div class=row>');
                    echo('<div class="col-sm-2"></div>');
                }
                echo('<div class="col-sm-2">');
                    echo('<div class="panel panel-default text-center">');
                        echo('<div class="panel-heading"><b>');
                            echo('<a href=itempage.php?id='.$row["itemid"].'>');
                                echo('<itemtitle>');
                                    echo($row["itemname"]);
                                echo('</itemtitle>');
                            echo('</a>');
                        echo('</b></div>');
                        echo('<a href=itempage.php?id='.$row["itemid"].'>');
                            echo('<div><img src="/coursework/images/'.$row["itemimage"].'" width="128" height="128"></div>');
                        echo('</a>');
                        echo("<br>"."£".$row["itemprice"]."<br>");
                        echo('<form action="addtobasket.php" method="POST" class="form-inline">');
                            echo('<input type="hidden" name="id" value='.$row["itemid"].">");
                            echo('<input type="number" placeholder="Qty" name="qty" min="1" max="99" value="1" required>');
                            echo('<br><input type="submit" value="Add" class="btn btn-sm"><br>');
                        echo("</form><br>");
                    echo('</div>');
                echo('</div>');
                $i=$i+1;
                if ($i==4){
                    echo('<div class="col-sm-2"></div>');
                    echo('</div>');
                    $i=0;
                }
            }
        ?>
    </div>
<script>
    // when user clicks on drop button, toggle between showing and hiding contents
    function sortDrop(){
        document.getElementById("sortDropdown").classList.toggle("show");
    }

    function filterDrop() {
        document.getElementById("filterDropdown").classList.toggle("show");
    }

</script>
</body>
</html>
<!-- // close the dropdown if the user clicks outside of it
    window.onclick = function(event){
        if(!((event.target.matches('#sortBtn'))||(event.target.matches('#sortDropdown')))){
            var dropdown = document.getElementByID("sortDropdown");
            if(dropdown.classList.contains('show')){
                dropdown.classList.remove('show');
            }
        }
    } -->