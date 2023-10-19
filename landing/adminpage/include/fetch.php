<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>


<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'user_db');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['new_status']) && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $newStatus = $_POST['new_status'];

    $sql = "UPDATE user_form SET status='$newStatus' WHERE id=$userId";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("User status updated successfully.")</script>';
    } else {
        echo "Error updating user status: " . mysqli_error($conn);
    }
}

if (isset($_POST['delete'])) {
    $userId = $_POST['delete_id'];

    $sql = "DELETE FROM user_form WHERE id=$userId";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("User deleted successfully.")</script>';
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM user_form";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

    <style>
        body {
            color: #333; 
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
        }
        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px 25px;
            border-radius: 5px;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
        }
        .table-title {
            background: #007BFF;
            color: #fff;
            padding: 16px 30px;
            margin: -20px -25px 20px;
            border-radius: 5px 5px 0 0;
        }
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }
        .table-title .btn-group {
            float: right;
        }
        .table-title .btn {
            color: #fff;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }
        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }
        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }
        table.table {
            border-collapse: separate;
            border-spacing: 0 15px;
        }
        table.table th, table.table td {
            border-top: none;
            padding: 12px 15px;
            vertical-align: middle;
        }
        table.table th {
            background: #f5f5f5; 
            font-weight: bold;
        }
        table.table td {
            background: #ffffff; 
            text-align: center;
        }
        table.table td:last-child {
            text-align: right;
        }
        table.table td a {
            font-weight: bold;
            color: #007BFF; 
            text-decoration: none;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #F44336; 
        }
        table.table td i {
            font-size: 19px;
        }
    
    </style>
</head>
<body>
<div class="container">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-xs-6">
                        <h2>Manage <b>Users</b></h2>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Change Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["user_type"] . "</td>";
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td>
                                <form method='post' style='display: inline;'>
                                    <input type='hidden' name='user_id' value='" . $row["id"] . "'>
                                    <select name='new_status' class='form-control' onchange='this.form.submit();'>
                                        <option value='active' " . ($row["status"] == 'active' ? 'selected' : '') . ">Active</option>
                                        <option value='inactive' " . ($row["status"] == 'inactive' ? 'selected' : '') . ">Inactive</option>
                                        <option value='deactivate' " . ($row["status"] == 'deactivate' ? 'selected' : '') . ">Deactivate</option>
                                    </select>
                                </form>
                            </td>";
                        echo "<td>
                                <form method='post' style='display: inline;'>
                                    <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                                    <input type='submit' name='delete' value='Delete' class='btn btn-danger'>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No data found.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>
