<!DOCTYPE html>
<html>

<head>
    <title>Monthly Activity Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include_once("../adminpage/include/header.php"); ?>
    <h4 class="text-center my-3 pb-3"><b>MONTHLY ACTIVITY CHART</b></h4>
    <div style="width: 80%; margin: 10px auto 5% auto;">
        <canvas id="myChart"></canvas>
    </div>

    <?php
    function countActivity($specifiedMonth)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "user_db";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $countActSql = "SELECT * FROM activity";
        $countResult = mysqli_query($conn, $countActSql);

        $activityCount = 0; // Initialize activity count for the specified month
    
        if (mysqli_num_rows($countResult) > 0) {
            while ($row = mysqli_fetch_assoc($countResult)) {
                $datetimeString = $row['date'];
                $dateTime = new DateTime($datetimeString);

                // Convert DateTime object to Unix timestamp
                $timestamp = $dateTime->getTimestamp();

                $month = date('n', $timestamp); // Use the Unix timestamp
    
                // Check if the activity occurred in the specified month
                if ($month == $specifiedMonth) {
                    $activityCount++;
                }
            }

            return $activityCount;
        } else {
            return 0; // No results found
        }
    }
    ?>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        var chartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Number of Activities with Set Date Per Month',
                data: [
                    <?= countActivity(1); ?>,
                    <?= countActivity(2); ?>,
                    <?= countActivity(3); ?>,
                    <?= countActivity(4); ?>,
                    <?= countActivity(5); ?>,
                    <?= countActivity(6); ?>,
                    <?= countActivity(7); ?>,
                    <?= countActivity(8); ?>,
                    <?= countActivity(9); ?>,
                    <?= countActivity(10); ?>,
                    <?= countActivity(11); ?>,
                    <?= countActivity(12); ?>
                ],
                backgroundColor: "rgba(78, 115, 223, 0.5",
                borderColor: "rgba(78, 115, 223, 1)",
                borderWidth: 1,
                hoverBorderColor: "rgba(78, 115, 223, 1)",
                hoverBackgroundColor: "rgba(78, 115, 223, 0.7"
            }]
        };


        var myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            minRotation: 0,
                            maxRotation: 0
                        }
                    },
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