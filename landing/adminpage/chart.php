<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daily User Registrations</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function fetchUserData() {
    return fetch('fetch_daily_user_registrations.php')
        .then(response => response.json());
}

Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function createBarChart(userData) {
    const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const ctx = document.getElementById("myBarChart");
    const myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: daysOfWeek,
            datasets: [{
                label: "User Registrations",
                backgroundColor: "rgba(78, 115, 223, 0.5)",
                borderColor: "rgba(78, 115, 223, 1)",
                borderWidth: 2,
                hoverBackgroundColor: "rgba(78, 115, 223, 0.7)",
                hoverBorderColor: "rgba(78, 115, 223, 1)",
                data: userData,
            }],
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        suggestedMax: 50,
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, 0.1)",
                    },
                }],
                xAxes: [{
                    gridLines: {
                        display: false,
                    },
                }],
            },
            title: {
                display: true,
                text: 'Daily User Registrations',
                fontSize: 16,
            },
            legend: {
                display: false,
            },
        }
    });
}

fetchUserData()
    .then(userData => createBarChart(userData))
    .catch(error => console.error("Error fetching data:", error));
</script>
</body>
</html>
