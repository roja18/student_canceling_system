<?php
 session_start();
 if(empty($_SESSION['Admin'])){
     header("location:../index.php");
 }

require_once("../includes/connection.php");
if(isset($_POST['submit'])){
    $fname = strtoupper(trim(stripslashes(htmlentities(strip_tags(trim($_POST['fname']))))));
    $email = trim(stripslashes(htmlentities(strip_tags(trim($_POST['email'])))));
    $phone = trim(stripslashes(htmlentities(strip_tags(trim($_POST['phone'])))));
    $gender = trim(stripslashes(htmlentities(strip_tags(trim($_POST['gender'])))));
    $pass = password_hash($phone, PASSWORD_DEFAULT);
    $utype = 'Consultant';

    if(empty($fname)||empty($email)||empty($phone)){
        $errorz = "You must fill all form field";
    }
    else{
        
            $insert = "INSERT INTO `users`(`username`, `passwords`, `userType`, `fullname`, `phone`, `gender`)
            VALUE('$email','$pass','$utype','$fname','$phone','$gender')";
            // echo $insert;
            // die;
            $query = mysqli_query($con,$insert);
            if($query){
            header("location:consultant.php");
            }
            else{
            $errorz = "Fail to regster";
            }
        
            
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
        <?php include("../includes/admin_nav.php")?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <?php include("../includes/admin_top_nav.php")?>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Consultant</h3>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-success fw-bold m-0">Consultants</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small fw-bold">Education<span class="float-end">20%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="visually-hidden">20%</span></div>
                                    </div>
                                    <h4 class="small fw-bold">Life<span class="float-end">40%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="visually-hidden">40%</span></div>
                                    </div>
                                    <h4 class="small fw-bold">Education<span class="float-end">60%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="visually-hidden">60%</span></div>
                                    </div>
                                    <!-- <h4 class="small fw-bold">Payout Details<span class="float-end">80%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="visually-hidden">80%</span></div>
                                    </div> -->
                                    <h4 class="small fw-bold">Total Consultants<span class="float-end">100%</span></h4>
                                    <div class="progress progress-sm mb-3">
                                        <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="visually-hidden">100%</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-success m-0 fw-bold">Consultant Registration Form</p>
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
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>First Name</strong></label><input class="form-control" type="text" id="first_name" placeholder="Cypy Masanja" name="fname"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Gender</strong></label>
                                                        <select class="form-control" name="gender">
                                                            <option value="">--Select Gender--</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong>Phone Number</strong></label><input class="form-control" type="number" id="username" placeholder="0767335357" name="phone"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Email Address</strong></label><input class="form-control" type="email" id="email" placeholder="cypy@gmail.com" name="email"></div>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3"><input name="submit" class="btn btn-success btn-sm" type="submit" value="Register"></div>
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