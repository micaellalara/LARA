<?php include_once('include/header.php'); ?>
<?php include_once('include/DBUtil.php'); ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Charts</h1>
    <p class="mb-4">Chart.js is a third-party plugin that is used to generate the charts in this theme. The charts below have been customized - for further customization options, please visit the <a target="_blank" href="https://www.chartjs.org/docs/latest/">official Chart.js documentation</a>.</p>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                    <hr>
                    Styling for the area chart can be found in the <code>/js/demo/chart-area-demo.js</code> file.
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <hr>
                    Styling for the bar chart can be found in the <code>/js/demo/chart-bar-demo.js</code> file.
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User Gender Pie Chart</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <div>
                            <canvas id="myChart" style="width:100%;max-width: 600px; margin-top: -5%;"></canvas>
                        </div>
                        <div class="pie-chart-right-top">
                            <?php
                            $query1 = "SELECT count(*) as male FROM user_form WHERE gender = 'male' and user_type = 'user'";
                            $query2 = "SELECT count(*) as female FROM user_form WHERE gender = 'female' and user_type = 'user'";
                            $result1 = mysqli_query($conn, $query1);
                            $result2 = mysqli_query($conn, $query2);
                            $row1 = mysqli_fetch_assoc($result1);
                            $row2 = mysqli_fetch_assoc($result2);
                            ?>
                            <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
                        </div>
                    </div>
                    <script>
                        var xValues = ["Male", "Female", "Others"];
                        var yValues = [<?php echo $row1['male'] ?>, <?php echo $row2['female'] ?>];
                        var barColors = ["#0000FF", "#F33A6A"];

                        new Chart("myChart", {
                            type: "pie",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                            },
                            options: {
                                title: {
                                    display: true,
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<?php include_once('include/footer.php'); ?>

</div>
</div>
