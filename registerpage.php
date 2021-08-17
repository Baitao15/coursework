<html>

<head>
    <title>Register</Title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- return to the homepage -->
<p id=navbar>
    <a href=homepage.php>Home</a>
</p>

<!-- basic text for the page, including a form for users to create an account -->
<p class=form>
    Register
    <form action="register.php" method="POST">
    Email <input type="text" name="email" required><br>
    Password <input type="password" name="password" required><br>
    <br>
    <div id=registerbutton>
    <input type="submit" value="Register">
    </div>
    <br>
    Already have an account?
    <a href=loginpage.php>Login</a>
    </form>
</p>
</body>

</html>