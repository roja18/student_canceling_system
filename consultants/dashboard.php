<?php
 session_start();
 if(empty($_SESSION['Consultant'])){
     header("location:../index.php");
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin Dashboard - SCS</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include("../includes/consultant_nav.php")?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include("../includes/consultants_top_nav.php")?>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-6 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Session</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>
                                                <?php
                                                require_once("../includes/connection.php");
                                                $dep = "SELECT COUNT(*) AS total FROM session,consultant_sessions,users WHERE session.sid = consultant_sessions.sid AND users.username = consultant_sessions.username AND users.username='$mtu'";
                                                $sql = mysqli_query($con, $dep);
                                                $array = mysqli_fetch_array($sql);
                                                    $total = $array['total'];
                                                echo $total;
                                                ?>
                                            </span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-6 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Appointments</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>
                                            <?php
                                                require_once("../includes/connection.php");
                                                $dep = "SELECT COUNT(*) AS tota 
                                        FROM `availability`, appointment, session, consultant_sessions
                                        WHERE appointment.aid = availability.aid 
                                        AND session.sid = consultant_sessions.sid
                                        AND availability.consultant_username = '$mtu'";
                                                $sql = mysqli_query($con, $dep);
                                                $array = mysqli_fetch_array($sql);
                                                    $tota = $array['tota'];
                                                echo $tota;
                                                ?>
                                            </span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                </div>
            </div>
            <?php include("../includes/footer.php")?>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/chart.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/theme.js"></script>
</body>

</html>