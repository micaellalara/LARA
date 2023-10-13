<?php
include_once("include/header.php");
include_once("include/DBUtil.php");

$error = [];

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $user_type = $_POST['user_type'];
    $gender = $_POST['gender'];

    $select = "SELECT * FROM user_form WHERE email = '$email'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        if ($pass != $cpass) {
            $error[] = 'Password not matched!';
        } else {
            $insert = "INSERT INTO user_form(name, email, password, user_type, gender) VALUES('$name','$email','$pass','$user_type','$gender')";
            if (mysqli_query($conn, $insert)) {
                // Set user status to 'active' upon registration
                mysqli_query($conn, "UPDATE user_form SET status = 'active' WHERE email = '$email'");
                header('location: login.php');
            } else {
                $error[] = 'Error: ' . mysqli_error($conn);
            }
        }
    }
}
?>

<!-- Rest of your HTML and registration form here -->


<div class="form-container" style="margin: 200px 0 200px 0;">
    <form action="" method="post">
        <h3>REGISTRATION FORM</h3>
        <?php
        if (!empty($error)) {
            foreach ($error as $errMsg) {
                echo '<span class="error-msg">' . $errMsg . '</span>';
            }
        }
        ?>
        <input type="text" name="name" required placeholder="Enter your Name">
        <input type="email" name="email" required placeholder="Enter your Email">
        <input type="password" name="password" required placeholder="Enter your Password">
        <input type="password" name="cpassword" required placeholder="Confirm your Password">
        <select name="user_type">
            <option value="user">USER</option>
            <option value="admin">ADMIN</option>
        </select>
        <label for="gender">Gender:</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female
        <input type="submit" name="submit" value="register now" class="form-btn">
        <p>Already have an Account? <a href="login.php">Login Now</a></p>
    </form>
</div>

<?php include_once("include/footer.php") ?>
