<html>

<head>
    <title>Register</Title>
</head>


<body>

<!-- return to the homepage -->
<p>
    <a href=homepage.php>Home</a>
</p>

<!-- basic text for the page, including a form for users to create an account -->
<p>
    Register
    <form action="register.php" method="POST">
    Email <input type="text" name="email" required><br>
    Password <input type="password" name="password" required><br>
    <br>
    <input type="submit" value="Register"><br>
    Already have an account?
    <a href=loginpage.php>Login</a>
    </form>
</p>
</body>

</html>