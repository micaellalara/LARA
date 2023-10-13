<!DOCTYPE html>
<html>

<head>
    <title>Activity Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include_once("../adminpage/include/header.php"); ?>
    <h4 class="text-center my-3 pb-3"><b>DAILY ACTIVITY CHART</b></h4>
    <div style="width: 80%; margin: 10px auto 5% auto;">
        <canvas id="myChart"></canvas>
    </div>

    <?php
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
    ?>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chartData = {
            labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            datasets: [{
                label: 'Number of Activities Added Per Day',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2',
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 1,
                hoverBackgroundColor: 'rgba(75, 192, 192, 0.5' // Change this color
            }]
        };

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <?php include_once("../adminpage/include/footer.php"); ?>
</body>

</html>