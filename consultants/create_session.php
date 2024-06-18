<?php
 session_start();
 if(empty($_SESSION['Consultant'])){
     header("location:../index.php");
 }
$mtu = $_SESSION['Consultant'];
require_once("../includes/connection.php");
if(isset($_POST['submit'])){
    $sname = $_POST['sname'];        
    $insert = "INSERT INTO `consultant_sessions`(`username`, `sid`)
    VALUE('$mtu','$sname')";
    // echo $insert;
    // die;
    $query = mysqli_query($con,$insert);
    if($query){
    $succ = "Success to add session";
    }
    else{
    $errorz = "Fail to add session";
    }
        
            
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
                        <h3 class="text-dark mb-0">My Sessions</h3>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-5">
                            
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-success fw-bold m-0">My Sessions List</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        require_once("../includes/connection.php");
                                        $dep = "SELECT session.sname, consultant_sessions.csid FROM session,consultant_sessions,users WHERE session.sid = consultant_sessions.sid AND users.username = consultant_sessions.username AND users.username='$mtu'";
                                        $sql = mysqli_query($con, $dep);
                                        while($array = mysqli_fetch_array($sql)){
                                            $un = $array['sname'];
                                            $sid = $array['csid'];
                                            echo "<h4 class='small fw-bold'>$un<span class='float-end'><a href='delete_my_session.php?x=$sid'><i class='fas fa-trash text-danger'></i></a></span></h4>
                                            <div class='progress progress-sm mb-3'>
                                                <div class='progress-bar bg-success' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%;'></div>
                                            </div>";
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-success m-0 fw-bold">Create Session</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST">
                                            <span>
                                        <?php
                                            if(isset($errorz)){
                                                echo "<div class='alert alert-danger'>
                                                <strong>Fail!</strong> $errorz.
                                                </div>";
                                            }
                                            elseif(isset($succ)){
                                                echo "<div class='alert alert-success'>
                                                <strong>Success!</strong> $succ.
                                                </div>";
                                            }
                                        ?>
                                    </span>
                                                <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="first_name"><strong>Select Session</strong></label>
                                                        <select class="form-control" type="text" id="first_name" name="sname">
                                                            <?php
                                                                require_once("../includes/connection.php");
                                                                $dep = "SELECT * FROM session ORDER BY sid DESC";
                                                                $sno = 1;
                                                                $sql = mysqli_query($con, $dep);
                                                                while($array = mysqli_fetch_array($sql)){
                                                                    $aid = $array['sid'];
                                                                    $un = $array['sname'];
                        
                                                                    echo "<option value='$aid'>$un</option>";
                                                                }
                                                            ?>
                                                            
                                                        </select>
                                                    </div>
                                                    </div>
                                                   
                                                </div>
                                                <div class="mb-3"><input name="submit" class="btn btn-success btn-sm" type="submit" value="Create"></div>
                                            </form>
                                        </div>
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