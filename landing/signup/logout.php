<?php
include_once("include/header.php");
include_once("include/DBUtil.php");

session_start();

// Check if the user is logged in
if (isset($_SESSION['admin_name']) || isset($_SESSION['user_name'])) {
    // User is logged in

    // Update user status to 'inactive'
    if (isset($_SESSION['admin_name'])) {
        $email = $_SESSION['admin_name'];
    } elseif (isset($_SESSION['user_name'])) {
        $email = $_SESSION['user_name'];
    }

    mysqli_query($conn, "UPDATE user_form SET status = 'inactive' WHERE email = '$email'");

    // Destroy the session
    session_destroy();
}

// Redirect to the login page or wherever you prefer
header('location: login.php');
?>
