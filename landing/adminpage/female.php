<?php include_once('include/header.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Male Users List</title>
</head>
<style>
    body {
        background-color: #f0f7fc;
        font-family: Arial, sans-serif;
    }

    .blue-text {
        color: #5a5c69 !important;
        font-weight: bolder;
        font-size: 30px;
        text-align: center;
        margin-top: 15px;
    }

    .activity-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .activity-table th,
    .activity-table td {
        border: 1px solid #d3e0ea;
        padding: 10px;
        text-align: center;
        margin-bottom: 15px;
    }

    .activity-table th {
        background-color: #007bff;
        color: #fff;
    }
</style>

<body>
    <?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'user_db');

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>

    <div class="container">
        <h1 class="blue-text">Female User List</h1>
        <table class="activity-table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Registration Date - Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM user_form WHERE gender = 'Female'";

                $result = mysqli_query($conn, $query);


                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['gender'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td>' . $row['registration_datetime'] . '</td>';
                    echo '</tr>';
                }


                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    <?php include_once('include/footer.php'); ?>
</body>

</html>