<?php include_once('include/DBUtil.php');?>

<?php
$query = "SELECT DAYOFWEEK(activity_datetime) AS day, COUNT(*) AS count FROM activity GROUP BY DAYOFWEEK(activity_datetime)";

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
