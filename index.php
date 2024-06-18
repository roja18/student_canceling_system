<?php
error_reporting(0);
require_once("includes/connection.php");
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    
    if(empty($email)||empty($password)){
        $errorz = "Please! You have to fill all field";
    }
    else{
        $select="SELECT passwords,userType FROM users WHERE username='$email'";
        // echo $select;
        // die;
        $query=mysqli_query($con,$select);
        $ray=mysqli_fetch_array($query);
        $paw=$ray['passwords'];
        $utype=$ray['userType'];
        
        if(password_verify($password,$paw)){
            if($utype=="Students"){
                session_start();
                $_SESSION['Students']=$email;
                header("location:students/dashboard.php");
            }
            elseif($utype=="Admin"){
                session_start();
                $_SESSION['Admin']=$email;
                header("location:admin/dashboard.php");
            }
            elseif($utype=="Consultant"){

                session_start();
                $_SESSION['Consultant']=$email;
                header("location:consultants/dashboard.php");
            }
            
            else{
                $errorz="Something is wrong";
            }
        }
        else{
            $errorz="wrong username or password";
        } 
    }
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - SCS</title>
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
                                        <h4 class="text-dark mb-4">Welcome Back!</h4>
                                    </div>
                                    <form class="user" method="POST" action="index.php">
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
                                        <div class="mb-3"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password"></div>
                                        <div class="mb-3">
                                            
                                        </div><input name="submit" class="btn text-light d-block btn-user w-100" type="submit" style="background: rgb(17,111,3);" value="Login">
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="forgot-password.html">Forgot Password?</a></div>
                                    <div class="text-center"><a class="small" href="register.php">Create an Account!</a></div>
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