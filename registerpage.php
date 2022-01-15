<html>

<head>
    <title>Register</title>
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
<!-- basic text for the page, including a form for users to create an account -->
<div class="text-center">
<div class="col-sm-4">
    <h3>Register</h3>
    <div class=form>
        <b>Registering is quick and easy</b><br>
        <?php
        // display and then unset invalid email message if applicable
            session_start();
            if (isset($_SESSION['message'])){
              echo("<div class='message'>".$_SESSION['message']."</div>");
              unset($_SESSION['message']);
            }
        ?>
        <br>
        <form action="register.php" method="POST" class="form-inline">
            <input type="text" name="forename" placeholder="First Name" required><br><br>
            <input type="text" name="surname" placeholder="Surname" required><br><br>
            <input type="tel" name="phoneno" placeholder="Phone e.g. 08888 888888" pattern="[0]{1}[0-9]{4} [0-9]{6}" required><br><br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Choose a Password" required><br><br>
            <input type="submit" value="Register" class="btn btn-lg">
            <br>
        </form>
    </div>
    Already have an account?
    <a href=loginpage.php>Login</a>
</div>
</div>
</body>

</html>