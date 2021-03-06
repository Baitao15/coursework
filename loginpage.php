<html>

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
    <br><br><br><br><br>
    <div class="col-sm-4"></div>
    <!-- basic text for the page, including a form for users to login -->
    <div class="text-center">
    <div class="col-sm-4">
      <h3>Login</h3>
      <div class=form>
        <b>Welcome back</b><br>
        <?php
        // display and then unset failed login message if applicable
            if (isset($_SESSION['message'])){
              echo("<div class='message'>".$_SESSION['message']."</div>");
              unset($_SESSION['message']);
            }
        ?>
        <!-- login form -->
        <form action="login.php" method="POST">
            <br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <input type="submit" value="Login" class="btn btn-lg">
        </form>
      </div>
    <!-- option for users to register an account if they don't have one already -->
    Don't have an account?
    <a href=registerpage.php>Sign Up</a>
    </div>
    </div>
</body>

</html>
