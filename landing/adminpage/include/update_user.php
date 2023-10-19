<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['edit_id'];
    $newName = $_POST['new_name'];
    $newEmail = $_POST['new_email'];
    $newUserType = $_POST['new_user_type'];
    $newGender = $_POST['new_gender'];
    $newStatus = $_POST['new_status'];

    $sql = "UPDATE user_form SET name='$newName', email='$newEmail', user_type='$newUserType', gender='$newGender', status='$newStatus' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
