<?php
session_start();
error_reporting(0);
if(empty($_SESSION['Students'])){
    header("location:../index.php");
    exit;
}
$mtu = $_SESSION['Students'];
function getExtension($str) 
{
      $i = strrpos($str,".");
      if (!$i) 
  { 
  return ""; 
  }
      $l = strlen($str) - $i;
      $ext = substr($str,$i+1,$l);
      return $ext;
}
$errors=0;
require_once("../includes/connection.php");
if(isset($_POST['submit'])){
    $caption = trim(stripslashes(htmlentities(strip_tags(trim($_POST['caption'])))));
    $image=$_FILES['image']['name'];
      if ($image) 
      {
        $filename = $_FILES['image']['name'];
        $extension = getExtension($filename);
        $extension = strtolower($extension);
        if (($extension != "png") && ($extension != "jpeg") && ($extension != "jpg")) 
        {
        $errorz="Unsupported File extension!";
        }
        else
        {
        $size=filesize($_FILES['image']['tmp_name']);
        if($size>5145728)
        {
        $errorz="You have exceeded the minimum size limit!";

        }
        $title=rand(10000,99999);
        $name = $title.".".$extension;
        $newname="../forum/$name";
        $copied = copy($_FILES['image']['tmp_name'], $newname);
        if($copied){

            $insert = "INSERT INTO `forum`(`email`, `caption`, `image`) VALUES
            ('$mtu','$caption','$name')";
            // echo $insert;
            // die;
            $query = mysqli_query($con,$insert);
            if($query){
                $sms = "To Post your Post";
                header("location:forum.php?y=$sms");
            }
            else{
            $errorz = "Fail to submit arrival note. You alread submit";
        }}}}

}

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
                        <h3 class="text-dark mb-0">Post</h3>
                    </div>
                    <div class="row">
                        
                        <div class="col-lg-7 col-xl-6">
                        <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-success m-0 fw-bold">Create Post</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" enctype="multipart/form-data">
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
                                                            <label class="form-label" for="session"><strong>Write Caption</strong></label>
                                                            <textarea name="caption" class="form-control" placeholder="Write What You want to share....."></textarea>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="consultant"><strong>Upload Image</strong></label>
                                                            <input type="file" name="image" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3"><input name="submit" class="btn btn-success btn-sm" type="submit" value="Post"></div>
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
    
</body>

</html>
