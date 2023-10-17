<?php
include_once("include/header.php");
include_once("include/DBUtil.php");

session_start();

if (isset($_SESSION['admin_name']) || isset($_SESSION['user_name'])) {

    if (isset($_SESSION['admin_name'])) {
        $email = $_SESSION['admin_name'];
    } elseif (isset($_SESSION['user_name'])) {
        $email = $_SESSION['user_name'];
    }

    mysqli_query($conn, "UPDATE user_form SET status = 'inactive' WHERE email = '$email'");

    session_destroy();
}

header('location: login.php');
?>
