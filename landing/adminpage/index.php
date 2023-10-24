<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'user_db');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$userID = $_SESSION['userID'];

$sql = "SELECT * FROM user_form WHERE id = '$userID' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);







?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Dashboard</title>
    <link href="/lara/landing/adminpage/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="/lara/landing/adminpage/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/lara/landing/adminpage/assets/css/table.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

</head>

<body id="page-top">
    <?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "user_db";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $queryTotal = "SELECT COUNT(*) as activityCount FROM activity";
    $resultTotal = mysqli_query($conn, $queryTotal);

    if (!$resultTotal) {
        die("Query failed: " . mysqli_error($conn));
    }
    $rowTotal = mysqli_fetch_assoc($resultTotal);
    $activityCount = $rowTotal['activityCount'];

    $queryMale = "SELECT COUNT(*) as maleCount FROM user_form WHERE gender = 'male'";
    $resultMale = mysqli_query($conn, $queryMale);

    if (!$resultMale) {
        die("Query failed: " . mysqli_error($conn));
    }

    $rowMale = mysqli_fetch_assoc($resultMale);
    $maleCount = $rowMale['maleCount'];

    $queryFemale = "SELECT COUNT(*) as femaleCount FROM user_form WHERE gender = 'female'";
    $resultFemale = mysqli_query($conn, $queryFemale);

    if (!$resultFemale) {
        die("Query failed: " . mysqli_error($conn));
    }
    $rowFemale = mysqli_fetch_assoc($resultFemale);
    $femaleCount = $rowFemale['femaleCount'];

    $queryAdmin = "SELECT COUNT(*) as adminCount FROM user_form WHERE user_type = 'admin'";
    $resultAdmin = mysqli_query($conn, $queryAdmin);

    if (!$resultAdmin) {
        die("Query failed: " . mysqli_error($conn));
    }

    $rowAdmin = mysqli_fetch_assoc($resultAdmin);
    $adminCount = $rowAdmin['adminCount'];
    mysqli_close($conn);
    ?>



    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="/lara/landing/adminpage/index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ADMIN <sup>Dashboard</sup></div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="/lara/landing/adminpage/index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                LINKS
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="/lara/landing/signup/login.php">Login</a>
                        <a class="collapse-item" href="/lara/landing/signup/registration.php">Register</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/lara/landing/adminpage/tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                CHART
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage"
                    aria-expanded="true" aria-controls="collapsePage">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Activity Chart</span>
                </a>
                <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="/lara/landing/adminpage/data.php">Daily Activity Chart</a>
                        <a class="collapse-item" href="/lara/landing/adminpage/monthbar.php">Monthly Activity Chart</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="/lara/landing/adminpage/assets/img/undraw_rocket.svg"
                    alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components,
                    and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to
                    Pro!</a>
            </div>
            </li>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Announcements
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">September 16, 2023</div>
                                        <span class="font-weight-bold"><b>Early Bird Registration:</b> Don't miss out on
                                            our special early bird registration offer for the activities. Register now
                                            and enjoy discounted booth prices. Grab your spot before they're
                                            gone!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">September 24, 2023</div>
                                        <b>Workshop Sessions:</b> Get ready to enhance your skills with our exclusive
                                        workshop sessions at the Cyber Deluxe Hub. Learn from industry experts and take
                                        your knowledge to the next level.
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">September 25, 2023</div>
                                        <b>Entertainment Galore:</b> Prepare for a night of entertainment like no other
                                        at The Hubbie. Live music, dance performances, and more will keep you
                                        entertained throughout the evening.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500"
                                    href="/lara/landing/adminpage/messages.php">Show All Announcements</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="/lara/landing/adminpage/assets/img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="/lara/landing/adminpage/assets/img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="/lara/landing/adminpage/assets/img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <span><b>
                                            <?php echo $row['name'] ?>
                                        </b></span>
                                    <img class="img-profile rounded-circle"
                                        src="/lara/landing/assets/img/vectors/admin.png">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/lara/landing/signup/logout.php" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>


                    </ul>

                </nav>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>


                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" a
                                                href="activity_list.php">
                                                <a href="activity_list.php" style="text-decoration: none;">Total User
                                                    Activities</a>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $activityCount; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">

                                            <i class='fa fa-user text-gray-300' style='font-size: 35px;'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <a href="male.php" style="text-decoration: none;">Male Users</a>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $maleCount; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-male text-gray-300 " style='font-size: 40px;'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                <a href="female.php" style="text-decoration: none;">Female Users</a>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $femaleCount; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">

                                            <i class="fa fa-female text-gray-300 " style='font-size: 40px;'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Number of Admins</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $adminCount; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Daily User Registrations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function fetchUserData() {
                                return fetch('include/fetch_daily_user_registrations.php')
                                    .then(response => response.json());
                            }

                            // Set new default font family and font color to mimic Bootstrap's default styling
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
                                                    suggestedMax: 10,
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

                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Gender Proportion</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="chart-pie pt-4 pb-2">
                                            <div>
                                                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                                            </div>
                                            <div class="pie-chart-right-top">
                                                <?php include_once('include/DBUtil.php'); ?>

                                                <?php
                                                $query1 = "SELECT count(*) as male FROM user_form WHERE gender = 'male' and user_type = 'user'";
                                                $query2 = "SELECT count(*) as female FROM user_form WHERE gender = 'female' and user_type = 'user' ";

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
                        <footer class="sticky-footer bg-white" style='margin-top: 10%;  width: 100%'>
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    &copy; Copyright <strong><span>TaskWisePro</span></strong>. All Rights Reserved
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Logout" below if you are ready to end your current
                                session.
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="/lara/landing/signup/logout.php">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="/lara/landing/adminpage/assets/vendor/jquery/jquery.min.js"></script>
                <script src="/lara/landing/adminpage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="/lara/landing/adminpage/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
                <script src="/lara/landing/assets/js/sb-admin-2.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                <script src="/lara/landing/adminpage/assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>