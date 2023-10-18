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

<?php include_once('include/DBUtil.php');?>
<?php
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

    $conn->close();
    ?>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chartData = {
            labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            datasets: [{
                label: 'Number of Activities Added Per Day',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: "rgba(78, 115, 223, 0.5)",
                borderColor: "rgba(78, 115, 223, 1)",
                borderWidth: 1,
                hoverBorderColor: "rgba(78, 115, 223, 1)",
                hoverBackgroundColor: "rgba(78, 115, 223, 0.7)"
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