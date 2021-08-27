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
  <!--  login form  -->
    Staff Login
    </div>
    <br>
    <form action="adminlogin.php" method="POST">
        StaffID
        <br>
        <input type="text" name="userid" required>
        <br>
        <br>
        Password
        <br>
        <input type="password" name="password" required>
        <br>
        <br>
        <input type="submit" value="Login">
    </form>
    </div>
</body>

</html>