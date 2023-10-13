<?php include_once('include/header.php');?>
<?php
// Define database connection constants
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'user_db');

// Create a database connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle user status change
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

// Handle user deletion
if (isset($_POST['delete'])) {
    $userId = $_POST['delete_id'];

    $sql = "DELETE FROM user_form WHERE id=$userId";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("User deleted successfully.")</script>';
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}

// Query the database
$sql = "SELECT * FROM user_form";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<h2 style="text-align: center; font-size: 30px; font-weight: bolder; margin-top: 20px; margin-bottom: 20px;">USER LIST MANAGEMENT</h2>

<div class="container-fluid" style="margin-bottom: 10%; width: 90%;">
    <div class="table-responsive" style = "overflow-x: hidden;">
        <div class="table-wrapper">
            <table class="table table-striped table-hover">
                <thead style = "text-align: center;">
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
                                    <select name='new_status' class='form-control' onchange='this.form.submit();' style = 'width: 100%;'>
                                        <option value='active' " . ($row["status"] == 'active' ? 'selected' : '') . ">Active</option>
                                        <option value='inactive' " . ($row["status"] == 'inactive' ? 'selected' : '') . ">Inactive</option>
                                        <option value='deactivate' " . ($row["status"] == 'deactivate' ? 'selected' : '') . ">Deactivate</option>
                                    </select>
                                </form>
                            </td>";
                            echo "<td>
                            <form method='post' style='display: inline;'>
                                <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                                <input type='submit' name='delete' value='Delete' class='btn btn-danger' style='width: 100%;'>
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

<?php
// Close the database connection
mysqli_close($conn);
?>
<?php include_once('include/footer.php');?>