<?php
error_reporting(0);
require_once("includes/connection.php");
$mtu = $_GET['x'];
if(isset($_POST['submit'])){
    $npassword = trim(stripslashes(htmlentities(strip_tags(trim($_POST['npassword'])))));
    $cpassword = trim(stripslashes(htmlentities(strip_tags(trim($_POST['cpassword'])))));
    $email = $_POST['email'];
    $psw = password_hash($npassword, PASSWORD_DEFAULT);

    if(empty($npassword)||empty($cpassword)){
        $errorz = "Please! You have to fill all field";
    }
    else{
        if($npassword!=$cpassword){
            $errorz = "New password and Confim password are not the same";
        }
        else{
            $select="UPDATE users SET passwords='$psw' WHERE username='$email'";
            // echo $select;
            // die;
            $query=mysqli_query($con,$select);
            if($query){
                header("location:index.php"); 
            }
            else{
                $errorz = "Email! does not existing";
            }
        }
    }
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Update Password - SCS</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body class="bg-gradient-primary" style="background: rgb(255,255,255);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/mockups/com.jpeg&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="assets/img/atc.png" alt="logo">
                                        <h4 class="text-dark mb-4">Update Password</h4>
                                    </div>
                                    <form class="user" method="POST" action="">
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
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Enter New Password" name="npassword"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Confim Password" name="cpassword"></div>
                                        <input type="hidden" name="email" value="<?php echo $mtu?>">
                                        <div class="mb-3">
                                        </div><input name="submit" class="btn text-light d-block btn-user w-100" type="submit" style="background: rgb(17,111,3);" value="Update">
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="login.php">Back to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>