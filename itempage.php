<!DOCTYPE html>

<?php
    session_start();
    include_once("connection.php");

    $itemid=$_GET['id'];

    if(isset($_GET['cont'])){
        $cont=$_GET['cont'];
    }
    else{
        $cont='desc';
    }
?>

<html>
    <head>
        <title>
            <?php
                $stmt = $conn->prepare("SELECT itemname FROM item WHERE itemid=$itemid");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo($row['itemname']);
                echo(' - Longda Shop');
            ?>
        </title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

<body>
    <!-- navigation bar -->
    <div id=navbar>
        <a href=homepage.php>Home</a>
        <a href=grocerypage.php>Groceries</a>
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

    <br><br><br>
    <?php
        $stmt = $conn->prepare("SELECT * FROM item WHERE itemid=$itemid");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class=row>
        <div class="col-sm-1"></div>
        <div class="col-sm-3">
            <?php echo('<img src="/coursework/images/'.$row["itemimage"].'" width=100% height=100%>');?>
        </div>
        <div class="col-sm-6">
            <h1>
                <?php echo($row["itemname"]);?>
            </h1>
            <hr class="solid1">
            <h2>
                <?php echo("£".$row["itemprice"]."<br>");?>
            </h2>
            <form action="addtobasket.php" method="POST" class="form-inline">
                <?php echo('<input type="hidden" name="id" value='.$row["itemid"].">");?>
                <input type="number" placeholder="Qty" name="qty" min="1" max="99" value="1" required>
                <br><input type="submit" value="Add" class="btn btn-lg"><br>
            </form><br>
            <hr class="solid2">
            <div class=row>
                <div class="col-sm-6">
                    <h3 class="text-center">
                        <?php echo('<a href="itempage.php?id='.$itemid.'&cont=desc" class="desc-rev">')?>Description</a>
                    </h3>
                    <?php
                        if($cont=='desc'){
                            echo('<hr class="solidgold">');
                        }
                        if($cont=='rev'){
                            echo('<hr class="solid2">');
                        }
                    ?>
                </div>
                <div class="col-sm-6">
                    <h3 class="text-center">
                        <?php echo('<a href="itempage.php?id='.$itemid.'&cont=rev" class="desc-rev">')?>Reviews</a>
                    </h3>
                    <?php
                        if($cont=='rev'){
                            echo('<hr class="solidgold">');
                        }
                        if($cont=='desc'){
                            echo('<hr class="solid2">');
                        }
                    ?>
                </div>
            </div>
            <?php
                if($cont=='desc'){
                    echo('<div class="text-left">'.$row['description'].'</div>');
                }
                if($cont=='rev'){
                    echo('<div class="text-right">
                            <button id="writeRevBtn" class=btn btn-lg>Write a Review</button>
                        </div>');
                    
                    if(isset($_SESSION['message'])){
                        echo('<h3 class="text-success"><b>'.$_SESSION['message'].'</b></h3>');
                        unset($_SESSION['message']);
                    }

                    $stmt = $conn->prepare("SELECT * FROM review WHERE itemid=$itemid");
                    $stmt->execute();

                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $customerid=$row['customerid'];

                        $stmt2 = $conn->prepare("SELECT forename FROM customer WHERE customerid=$customerid");
                        $stmt2->execute();

                        while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                            // displaying name of reviewer
                            echo($row2['forename'].'<br>');
                            // displaying stars
                            echo('<div style="color:rgb(255, 183, 0); font-size:150%;">');
                            $clearstars=(5-$row['stars']);
                            for ($count = 1; $count <= $row['stars']; $count++){
                                echo('&#9733;');
                            }
                            while($clearstars!=0){
                                echo('&#9734;');
                                $clearstars=($clearstars-1);
                            }
                            echo('</div>');
                            echo('<b>'.$row['reviewtitle'].'</b>');
                            echo('<br>'.$row['reviewtext'].'<br>');
                            echo('<hr class="solid1">');
                        }
                    }
                }
            ?>
        <div class="col-sm-2"></div>
    </div>
    <!-- Modal -->
    <div id="writeRevModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h3> Write a Review</h3>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form action="addreview.php" method="POST" id="writeRevForm">
                        <label class="label-text" id="rating">Overall Rating</label>
                        <br>
                        <div class="stars">
                            <div class="text-center">
                                <input class="star star-5" id="star-5" type="radio" value="5" name="star" required>
                                <label class="star star-5" for="star-5"></label>
                                <input class="star star-4" id="star-4" type="radio" value="4" name="star">
                                <label class="star star-4" for="star-4"></label>
                                <input class="star star-3" id="star-3" type="radio" value="3" name="star">
                                <label class="star star-3" for="star-3"></label>
                                <input class="star star-2" id="star-2" type="radio" value="2" name="star">
                                <label class="star star-2" for="star-2"></label>
                                <input class="star star-1" id="star-1" type="radio" value="1" name="star">
                                <label class="star star-1" for="star-1"></label>
                            </div>
                        </div>
                        <hr class="solid1">
                        <label class="label-text" for="title">Add a Headline</label><br>
                        <input type="text" name="title" id="title" style="width: 100%;" maxlength="32"
                        placeholder="What's most important to know?" required>
                        <hr class="solid1">
                        <label class="label-text" for="text">Add a Written Review</label><br>
                        <textarea name="text" id="text" style="width: 100%;" rows="5" cols ="1" maxlength="255"
                        placeholder="What did you like or dislike? (maximum 255 characters)" required></textarea>
                        <input type="hidden" name="itemid" value=<?php echo($itemid)?>>
                        <input type="submit" value="Submit" class="btn btn-lg"><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    // get modal
    var modal = document.getElementById("writeRevModal");

    // get the button that opens the modal
    var btn = document.getElementById("writeRevBtn");

    // get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // if user clicks button, open modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // if user clicks on <span> (i.e. "x"), close  modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // if user clicks anywhere outside of the modal, close modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>

<!-- if(isset($_GET['id'])){
    $itemid=$_GET['id'];
    $_SESSION['backURL']='itempage.php?'.$itemid;
} -->


