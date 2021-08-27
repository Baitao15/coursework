<html>

<head>
  <title>Login - Longda Staff</title>
  <link rel="stylesheet" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
  <!-- navigation bar -->
  <div id=navbar>
    <a href=adminhomepage.php>Longda</a>
  </div>
  <br><br><br><br><br>
  <div class="col-sm-4"></div>
  <!--  login form  -->
  <div class="text-center">
  <div class="col-sm-4">
    Staff Login
    <br>
    <div class=form>
    <form action="adminlogin.php" method="POST">
        StaffID
        <br>
        <input type="text" name="userid" placeholder="userid" required><br><br>
        <input type="password" name="password" placeholder="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    </div>
  </div>
  </div>
</body>

</html>

