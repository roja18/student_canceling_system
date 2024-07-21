<?php
session_start();
if(empty($_SESSION['Students'])){
    header("location:../index.php");
    exit;
}
$mtu = $_SESSION['Students'];
// echo $mtu;
require_once("../includes/connection.php");
if(isset($_POST['submit'])){
    $session = $_POST['sesionname'];        
    $consultant = $_POST['sconsultant'];        
    $insert = "INSERT INTO `students_sessions`(`username`, `session`, `consultant`) 
    VALUES('$mtu','$session','$consultant')";
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


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sessions - SCS</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include("../includes/student_nav.php")?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include("../includes/student_top_nav.php")?>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Sessions</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-xl-6">
                        <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">My Sessions</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                <?php
                                                                    require_once("../includes/connection.php");
                                                                    $sql = mysqli_query($con, "SELECT students_sessions.ssid, session.sname, consultant_sessions.username FROM session, consultant_sessions, students_sessions WHERE consultant_sessions.sid = session.sid AND students_sessions.username = '$mtu'");
                                                                    while($array = mysqli_fetch_array($sql)){
                                                                        $apid = $array['ssid'];
                                                                        $sname = $array['sname'];
                                                                        $username = $array['username'];
                                                                        echo "<li class='list-group-item'>
                                                                            <div class='row align-items-center no-gutters'>
                                                                                <div class='col me-2'>
                                                                                    <h6 class='mb-0'><strong>$sname</strong></h6>
                                                                                </div>
                                                                                <div class='col-auto'>
                                                                                    <div class='form-check'><a href='session_going.php?x=$apid&&y=$username'><i class='fas fa-trush text-success'></i></a></label></div>
                                                                                </div>
                                                                            </div>
                                                                        </li>";
                                                                    }
                                                                ?>                                    
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-7 col-xl-6">
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
                                                        <div class="mb-3">
                                                            <label class="form-label" for="session"><strong>Select Session</strong></label>
                                                            <select class="form-control" id="session" name="sesionname">
                                                                <option value="">Select Session</option>
                                                                <?php
                                                                    require_once("../includes/connection.php");
                                                                    $sql = mysqli_query($con, "SELECT * FROM session ORDER BY sid DESC");
                                                                    while($array = mysqli_fetch_array($sql)){
                                                                        $sid = $array['sid'];
                                                                        $sname = $array['sname'];
                                                                        echo "<option value='$sid'>$sname</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="consultant"><strong>Select Consultant</strong></label>
                                                            <select class="form-control" id="consultant" name="sconsultant">
                                                                <option value="">Select Consultant</option>
                                                                <!-- Consultants will be loaded here by AJAX -->
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
            <?php include("../includes/footer.php")?>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/chart.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script>
        $(document).ready(function() {
            $('#session').change(function() {
                var sessionId = $(this).val();
                if(sessionId) {
                    $.ajax({
                        type: 'POST',
                        url: 'fetch_consultants.php',
                        data: 'session_id='+sessionId,
                        success: function(html) {
                            $('#consultant').html(html);
                        }
                    });
                } else {
                    $('#consultant').html('<option value="">Select Consultant</option>');
                }
            });
        });
    </script>
</body>

</html>
