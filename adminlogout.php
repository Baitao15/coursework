<?php
// start session to access session variables
session_start();

// if userid session variable is set
if(isset($_SESSION['userid']))
{
    // unset it
    unset($_SESSION['userid']);
}

// redirect user to login page
header("Location: adminloginpage.php");
?>