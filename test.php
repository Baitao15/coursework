<!-- <html>

<head>
    <style> -->
<!-- body {
  font-family: Arial, Helvetica, sans-serif;
}

.navbar {
  overflow: hidden;
  background-color: #333;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
} -->
    <!-- </style>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <div id='navbar'>
        <a href=grocerypage.php class="dropbtn">Groceries</a>
        <div class="dropdown-content">
            <a href="grocerypage.php?cat=produce" class="droplink">Fruit & Veg</a><br>
            <a href="grocerypage.php?cat=bakery" class="droplink">Bakery</a><br>
            <a href="grocerypage.php?cat=fresh" class="droplink">Fresh</a><br>
            <a href="grocerypage.php?cat=frozen" class="droplink">Frozen</a><br>
            <a href="grocerypage.php?cat=cupboard" class="droplink">Pantry</a><br>
            <a href="grocerypage.php?cat=other" class="droplink">Other</a>
        </div>
    </div>
</body> -->

<html>
<head>
    <title>TEST</title>
</head>
<body>
<?php
include_once("connection.php");

$sort='itemname';
$order='ASC';

$category="'produce' OR 'bakery'";

$stmt = $conn->prepare("SELECT * FROM item WHERE stock>0 AND category=$category ORDER BY $sort $order;");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo($row['itemname'].'<br>');
}

?>
</body>
</html>