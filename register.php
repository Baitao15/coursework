<html>

<head>
    <title>Register</Title>
</head>

<body>
<!-- basic text for the page, including a form for users to create an account -->
Register
    <form action="signup.php" method="POST">
    Email <input type="text" name="email" required><br>
    Password <input type="text" name="password" required><br>
    <br>
    <input type="submit" value="Register"><br>
    </form>
    <br>
</body>

<?php
// linking to connection.php to gain access to the database
include_once("connection.php");

// hashing the password
$hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

// sending the data to the database
$stmt = $conn->prepare("INSERT INTO customers(email,password)
VALUES(:email,:password)");

$stmt->bindParam(':username', $_POST["dusername"]);
$stmt->bindParam(':password', $hashed_password);
$stmt->execute();

//redirecting the user to the login page
header('Location: .php')

?>

</html>