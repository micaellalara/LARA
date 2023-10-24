<?php include_once('include/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Activity List</title>
</head>
<style>
    body {
        background-color: #f0f7fc;
        font-family: Arial, sans-serif;
    }

    .blue-text {
        color: #5a5c69!important;
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
        <h1 class="blue-text">User Activities</h1>
        <table class="activity-table">
            <thead>
                <tr>
                    <th>Activity Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Address</th>
                    <th>OOTD</th>
                    <th>Status</th>
                    <th>UserId</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM activity ORDER BY activity_datetime DESC";

                // Execute the query
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['time'] . '</td>';
                    echo '<td>' . $row['address'] . '</td>';
                    echo '<td>' . $row['ootd'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td>' . $row['userID'] . '</td>';
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

