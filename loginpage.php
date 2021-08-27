<html>

<?php
    session_start();

    $loggedin=false;

    if (isset($_SESSION['email']))
    {   
        $loggedin=true;
    }

?>

<head>
  <title>Login - Longda</title>
  <link rel="stylesheet" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
  <!-- return to the homepage -->
    <p id=navbar>
        <a href=homepage.php>Home</a>
    </p>

    Login
    </div>
    <br>
    <form action="login.php" method="POST">
        Email
        <br>
        <input type="text" name="email" required>
        <br><br>
        Password
        <br>
        <input type="password" name="password" required>
        <br><br>
        <input type="submit" value="Login">
    </form>
        
        <!-- <p>
          You are already logged in. <br>
          Return to the <a href=homepage.php>Home Page</a> <br>
          <a href=logout.php>Logout</a>
        </p> -->
    </div>
</body>

</html>
