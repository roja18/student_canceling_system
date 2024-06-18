<?php
require_once("includes/connection.php");
if(isset($_POST['submit'])){
    $fname = strtoupper(trim(stripslashes(htmlentities(strip_tags(trim($_POST['fname']))))));
    $email = trim(stripslashes(htmlentities(strip_tags(trim($_POST['email'])))));
    $phone = trim(stripslashes(htmlentities(strip_tags(trim($_POST['phone'])))));
    $password = trim(stripslashes(htmlentities(strip_tags(trim($_POST['password'])))));
    $gender = trim(stripslashes(htmlentities(strip_tags(trim($_POST['gender'])))));
    $pass = password_hash($password, PASSWORD_DEFAULT);
    $utype = 'Students';

    if(empty($fname)||empty($email)||empty($phone)||empty($password)){
        $errorz = "You must fill all form field";
    }
    // elseif(strlen($password)<8){
    //     $errorz = "Your Password Must Contain At Least 8 Characters!";
    // }
    // elseif(!preg_match("#[0-9]+#",$password)) {
    //     $errorz = "Your Password Must Contain At Least 1 Number!";
    // }
    // elseif(!preg_match("#[A-Z]+#",$password)) {
    //     $errorz = "Your Password Must Contain At Least 1 Capital Letter!";
    // }
    // elseif(!preg_match("#[a-z]+#",$password)) {
    //     $errorz = "Your Password Must Contain At Least 1 Lowercase Letter!";
    // }
    else{
        
            $insert = "INSERT INTO `users`(`username`, `passwords`, `userType`, `fullname`, `phone`, `gender`)
            VALUE('$email','$pass','$utype','$fname','$phone','$gender')";
            // echo $insert;
            // die;
            $query = mysqli_query($con,$insert);
            if($query){
            header("location:index.php");
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
                            
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="assets/img/atc.png" alt="logo">
                                        <h4 class="text-dark mb-4">Account Regsitration!</h4>
                                    </div>
                                    <form class="user" action="register.php" method="POST">
                                    <span>
                                        <?php
                                            if(isset($errorz)){
                                                echo "<div class='alert alert-danger'>
                                                <strong>Fail! </strong> $errorz.
                                                </div>";
                                            }
                                            
                                        ?>
                                    </span>
                                        <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Full Name..." name="fname"></div>
                                        <div class="mb-3">
                                            <select class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp"name="gender">
                                                <option value="">--Select Gender--</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="number" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Mobile Phone..." name="phone"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password"></div>
                                        <div class="mb-3">
                                            
                                        </div><input name="submit" class="btn text-light d-block btn-user w-100" type="submit" style="background: rgb(17,111,3);" value="Register">
                                        <hr>
                                    </form>
                                    <div class="text-center"><a class="small" href="index.php">I have an Account!</a></div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/mockups/boi.jpg&quot;);"></div>
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