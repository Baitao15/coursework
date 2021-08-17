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
</head>

<body>
    Login
    </div>
    <br>
    <form action="login.php" method="POST">
        Email
        <br>
        <input type="text" name="email" required>
        <br>
        <br>
        Password
        <br>
        <input type="password" name="password" required>
        <br>
        <br>
        <input type="submit" value="Login">
    </form>
    <?php
        if ($loggedin==true){
          echo("<p>
                You are already logged in.
                Return to the <a href=homepage.php>Home Page</a>
                <a href=logout.php>Logout</a>
                </p>");
        }
    ?>
    </div>
</body>

</html>
