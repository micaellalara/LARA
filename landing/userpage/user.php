<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Management</title>
    <!-- Include Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="/lara/landing/adminpage/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/lara/landing/adminpage/css/table.css" rel="stylesheet">
    <style>
        /* Responsive Styles */
        @media screen and (max-width: 1200px) {
            .activity-card {
                margin: 10px;
                padding: 10px;
            }

            /* Add more responsive styles as needed */
        }

        @media screen and (max-width: 992px) {
            .activity-card {
                margin: 5px;
                padding: 5px;
            }

            /* Add more responsive styles as needed */
        }

        @media screen and (max-width: 768px) {
            .activity-card {
                margin: 10px;
                padding: 10px;
            }

            /* Add more responsive styles as needed */
        }

        @media screen and (max-width: 576px) {
            .activity-card {
                margin: 5px;
                padding: 5px;
            }

            /* Add more responsive styles as needed */
        }

        .activity-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 20px;
            padding: 20px;
        }

        .activity-table {
            width: 100%;
            border-collapse: collapse;
        }

        .activity-table th,
        .activity-table td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: center;
        }

        .activity-table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        .activity-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .date-time-input {
            display: flex;
            flex-direction: column;
        }

        .date-time-input label {
            margin-bottom: 5px;
        }

        .date-time-input input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .custom-btn-primary {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .custom-btn-primary:hover {
            background-color: #007bff;
            text-decoration: none;
            color: white;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            .activity-card {
                margin: 10px;
                padding: 10px;
            }

            .activity-table th,
            .activity-table td {
                padding: 8px;
            }

            .date-time-input input {
                padding: 8px;
            }

            .custom-btn-primary {
                padding: 8px 15px;
            }
        }

        @media screen and (max-width: 576px) {
            .activity-card {
                margin: 5px;
                padding: 5px;
            }

            .activity-table th,
            .activity-table td {
                padding: 6px;
            }

            .date-time-input input {
                padding: 6px;
            }

            .custom-btn-primary {
                padding: 6px 12px;
            }
        }
    </style>
</head>
<?php include_once("include/header.php") ?>

<body>
    <?php
    $userID = $_SESSION['userID'];

    $conn = mysqli_connect('localhost', 'root', '', 'user_db');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Function to fetch and display activities
    function displayActivities($conn)
    {
        $sql = "SELECT * FROM activity ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Activities</h2>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Name</th><th>Date</th><th>Time</th><th>Location</th><th>OOTD</th><th>Status</th><th>Actions</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['time'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['ootd'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td><a href='edit_activity.php?id=" . $row['id'] . "'>Edit</a> | <a href='user.php?delete=" . $row['id'] . "'>Delete</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No activities found.";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['add-activity-button'])) {
            $name = mysqli_real_escape_string($conn, $_POST["activity-name"]);
            $date = mysqli_real_escape_string($conn, $_POST["activity-date"]);
            $time = mysqli_real_escape_string($conn, $_POST["activity-time"]);
            $address = mysqli_real_escape_string($conn, $_POST["activity-location"]);
            $ootd = mysqli_real_escape_string($conn, $_POST["activity-ootd"]);
            $status = mysqli_real_escape_string($conn, $_POST["activity-status"]);

            // Perform input validation (e.g., check for empty fields)
            if (empty($name) || empty($date) || empty($time) || empty($address) || empty($ootd) || empty($status)) {
                echo "Please fill in all fields.";
            } else {
                $sql = "INSERT INTO activity (name, date, time, address, ootd, status, userID) VALUES (?, ?, ?, ?, ?, ?, ?)";

                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssssssi", $name, $date, $time, $address, $ootd, $status, $userID);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Activity added successfully.');</script>";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

            }
        } elseif (isset($_POST['edit-activity-button'])) {
            $id = mysqli_real_escape_string($conn, $_POST['edit-activity-index']);
            $name = mysqli_real_escape_string($conn, $_POST['edit-activity-name']);
            $date = mysqli_real_escape_string($conn, $_POST['edit-activity-date']);
            $time = mysqli_real_escape_string($conn, $_POST['edit-activity-time']);
            $address = mysqli_real_escape_string($conn, $_POST['edit-activity-location']);
            $ootd = mysqli_real_escape_string($conn, $_POST['edit-activity-ootd']);
            $status = mysqli_real_escape_string($conn, $_POST['edit-activity-status']);

            // Input validation for editing
            if (empty($name) || empty($date) || empty($time) || empty($address) || empty($ootd) || empty($status)) {
                echo "Please fill in all fields.";
            } else {
                $stmt = mysqli_prepare($conn, "UPDATE activity SET name=?, date=?, time=?, address=?, ootd=?, status=? WHERE id=?");
                mysqli_stmt_bind_param($stmt, "ssssssi", $name, $date, $time, $address, $ootd, $status, $id);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Activity updated successfully.');</script>";
                } else {
                    echo "Error updating activity: " . mysqli_error($conn);
                }

            }
        }

    }

    if (isset($_GET['delete'])) {
        $id = mysqli_real_escape_string($conn, $_GET['delete']);
        if (mysqli_query($conn, "DELETE FROM activity WHERE id=$id")) {
            echo "<script>alert('Activity deleted successfully.');</script>";
        } else {
            echo "Error deleting activity: " . mysqli_error($conn);
        }
    }

    ?>


    <section class="vh-100">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col col-lg-9 col-xl-7" style="@media (min-width: 1200px); flex: 100%; max-width: 100%;">
                <div class="activity-card rounded-3">
                    <div class="card-body p-4">
                        <h4 class="text-center my-3 pb-3"><b>ACTIVITY MANAGEMENT</b></h4>

                        <button type="button" class="custom-btn-primary mb-3" data-toggle="modal"
                            data-target="#addActivityModal">Add Activity</button>

                        <table class="activity-table">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Activity</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">OOTD</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="activity-list">
                                <?php
                                $query = "SELECT * FROM activity WHERE userID = '$userID'";
                                $result = mysqli_query($conn, $query);
                                $counter = 1;

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $counter . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['address'] . "</td>";
                                    echo "<td>" . $row['time'] . "</td>";
                                    echo "<td>" . $row['date'] . "</td>";
                                    echo "<td>" . $row['ootd'] . "</td>";
                                    echo "<td>" . $row['status'] . "</td>";
                                    echo "<td>";
                                    echo "<a class='custom-btn-primary btn-edit-activity' data-toggle='modal' data-target='#editActivityModal' 
                                        data-id='" . $row['id'] . "' data-name='" . $row['name'] . "' 
                                        data-date='" . $row['date'] . "' data-time='" . $row['time'] . "' 
                                        data-address='" . $row['address'] . "' data-ootd='" . $row['ootd'] . "' 
                                        data-status='" . $row['status'] . "'>Edit</a>";
                                    echo "<a href='?delete=" . $row['id'] . "'>Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                    $counter++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Activity Modal -->
    <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="addActivityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addActivityModalLabel">Add Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="activity-form" method="post" action="">
                        <div class="form-group">
                            <label for="activity-name">Activity Name:</label>
                            <input type="text" class="form-control" id="activity-name" name="activity-name" required>
                        </div>
                        <div class="form-group">
                            <label for="activity-location">Location:</label>
                            <input type="text" class="form-control" id="activity-location" name="activity-location"
                                required>
                        </div>
                        <div class="date-time-input form-group">
                            <label for="activity-time">Time:</label>
                            <input type="time" class="form-control" id="activity-time" name="activity-time" required>
                        </div>
                        <div class="date-time-input form-group">
                            <label for="activity-date">Date:</label>
                            <input type="date" class="form-control" id="activity-date" name="activity-date" required>
                        </div>
                        <div class="ootd-input form-group">
                            <label for="activity-ootd">OOTD:</label>
                            <input type="text" class="form-control" id="activity-ootd" name="activity-ootd" required>
                        </div>
                        <div class="form-group">
                            <label for="activity-status">Status:</label>
                            <select class="form-control" id="activity-status" name="activity-status">
                                <option value="In progress">In progress</option>
                                <option value="Finished">Finished</option>
                                <option value="Canceled">Canceled</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="custom-btn-primary" id="add-activity-button"
                        name="add-activity-button">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Activity Modal -->
    <div class="modal fade" id="editActivityModal" tabindex="-1" role="dialog" aria-labelledby="editActivityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editActivityModalLabel">Edit Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-activity-form" method="post">
                        <input type="hidden" id="edit-activity-index" name="edit-activity-index">
                        <div class="form-group">
                            <label for="edit-activity-name">Activity Name:</label>
                            <input type="text" class="form-control" id="edit-activity-name" name="edit-activity-name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit-activity-location">Location:</label>
                            <input type="text" class="form-control" id="edit-activity-location"
                                name="edit-activity-location" required>
                        </div>
                        <div class="date-time-input form-group">
                            <label for="edit-activity-time">Time:</label>
                            <input type="time" class="form-control" id="edit-activity-time" name="edit-activity-time"
                                required>
                        </div>
                        <div class="date-time-input form-group">
                            <label for="edit-activity-date">Date:</label>
                            <input type="date" class="form-control" id="edit-activity-date" name="edit-activity-date"
                                required>
                        </div>
                        <div class="ootd-input form-group">
                            <label for="edit-activity-ootd">OOTD:</label>
                            <input type="text" class="form-control" id="edit-activity-ootd" name="edit-activity-ootd"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit-activity-status">Status:</label>
                            <select class="form-control" id="edit-activity-status" name="edit-activity-status">
                                <option value="In progress">In progress</option>
                                <option value="Finished">Finished</option>
                                <option value="Canceled">Canceled</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="custom-btn-primary" id="edit-activity-button"
                        name="edit-activity-button">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // JavaScript/jQuery code for handling user interactions
        $(document).ready(function () {
            $('.btn-edit-activity').click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var date = $(this).data('date');
                var time = $(this).data('time');
                var address = $(this).data('address');
                var ootd = $(this).data('ootd');
                var status = $(this).data('status');

                $('#edit-activity-index').val(id);
                $('#edit-activity-name').val(name);
                $('#edit-activity-date').val(date);
                $('#edit-activity-time').val(time);
                $('#edit-activity-location').val(address);
                $('#edit-activity-ootd').val(ootd);
                $('#edit-activity-status').val(status);
            });
        });
    </script>
</body>

<?php include_once("include/footer.php") ?>

</html>