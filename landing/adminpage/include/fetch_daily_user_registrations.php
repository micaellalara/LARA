<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT DAYOFWEEK(registration_datetime) AS day, COUNT(*) AS count FROM user_form GROUP BY DAYOFWEEK(registration_datetime)";

$result = $conn->query($query);

$data = array_fill(0, 7, 0);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $day = ($row['day'] + 5) % 7;
        $data[$day] = $row['count'];
    }
}
$conn->close();

echo json_encode($data);
?>
