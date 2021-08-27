<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<!-- return to the homepage -->
<p id=navbar>
    <a href=homepage.php>Home</a>
</p>
<br>
<br>
<br>
<br>
<br>
<div class="col-sm-4"></div>
<!-- basic text for the page, including a form for users to create an account -->
<div class="text-center">
<div class="col-sm-4">
    <h3>Register</h3>
    <div class=form>
        <b>Registering is quick and easy</b><br><br>
        <form action="register.php" method="POST" class="form-inline">
            <input type="text" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <b><input type="submit" value="Register" class="btn btn-lg"></b>
            <br>
        </form>
    </div>
    Already have an account?
    <a href=loginpage.php>Login</a>
</div>
</div>
</body>

</html>