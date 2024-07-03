<?php
session_start();
if(empty($_SESSION['Consultant'])){
    header("location:../index.php");
    exit;
}
$mtu = $_SESSION['Consultant'];
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
                        <h3 class="text-dark mb-0">My Profile</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-xl-6">
                        <div class="card mb-3">
                            <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="../assets/img/atc.png" width="160" height="160" />
                                <!-- <div class="mb-3"><button class="btn btn-primary btn-sm" type="button">Change Photo</button></div> -->
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-8 col-xl-6">
                        <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Profile</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    
                                            <?php
                                            require_once("../includes/connection.php");
                                            $dep = "SELECT * FROM users WHERE username = '$mtu'";
                                            $sql = mysqli_query($con, $dep);
                                            $array = mysqli_fetch_array($sql);
                                                $un = $array['username'];
                                                $fl = $array['fullname'];
                                                $ph = $array['phone'];
                                                $ge = $array['gender'];

                                                echo '<li class="list-group-item">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                            <h6 class="mb-0"><strong>Full Name  : </strong>'.$fl.'</h6>
                                                        </div>
                                                        </div>
                                                        </li>
                                                        
                                                        <li class="list-group-item">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                            <h6 class="mb-0"><strong>Gender  : </strong>'.$ge.'</h6>
                                                        </div>
                                                        </div>
                                                        </li>
                                                        
                                                        <li class="list-group-item">
                                                        <div class="row align-items-center no-gutters">
                                                            <div class="col me-2">
                                                            <h6 class="mb-0"><strong>Phone : </strong>'.$ph.'</h6>
                                                        </div>
                                                        </div>
                                                        </li>';
                                            ?>
                                            
                               
                                    
                                </ul>
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