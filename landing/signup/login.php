<?php
include_once("include/header.php");
include_once("include/DBUtil.php");

session_start();
$error = [];

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        if ($row['user_type'] == 'admin') {
            $_SESSION['user_type'] = 'admin';
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_type'] = 'user';
        }

        // Set the user's name in the session
        $_SESSION['user_name'] = $row['name'];

        // Update user status to 'active'
        mysqli_query($conn, "UPDATE user_form SET status = 'active' WHERE email = '$email'");

        if ($_SESSION['user_type'] == 'admin') {
            header('location: /lara/landing/adminpage/index.php');
        } elseif ($_SESSION['user_type'] == 'user') {
            header('location: /lara/landing/userpage/user.php');
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
}
?>

<div class="form-container">
    <form action="" method="post">  
        <h3 style = "font-size: bolder;">LOG IN FORM</h3>
        <?php
        if (!empty($error)) {
            foreach ($error as $errMsg) {
                echo '<span class="error-msg">' . $errMsg . '</span>';
            }
        }
        ?>
        <input type="email" name="email" required placeholder="Enter your Email">
        <input type="password" name="password" required placeholder="Enter your Password">
        <input type="submit" name="submit" value="login now" class="form-btn">
        <p>Don't have an Account? <a href="registration.php">Sign Up Now</a></p>
    </form>
</div>

<?php include_once("include/footer.php") ?>
