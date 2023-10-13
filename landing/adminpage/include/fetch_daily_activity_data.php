a<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_db"; // Replace with your actual database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch daily activity data
$query = "SELECT DAYOFWEEK(activity_datetime) AS day, COUNT(*) AS count FROM activity GROUP BY DAYOFWEEK(activity_datetime)";

$result = $conn->query($query);

$data = array_fill(0, 7, 0);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $day = ($row['day'] + 5) % 7;
        $data[$day] = $row['count'];
    }
}

// Close the database connection
$conn->close();

// Return the data as JSON
echo json_encode($data);
?>
