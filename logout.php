<?php
session_start();
if (isset($_SESSION['auth'])) {
    //authentication = false
    //user= false
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    $_SESSION['message']="Logged out";
}
header('location: index.php');
?>