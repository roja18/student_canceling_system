<?php
$uid = $_GET['x'];
session_start();
if(empty($_SESSION['Consultant'])){
    header("location:../index.php");
}
require_once("../includes/connection.php");


$insert = "DELETE FROM consultant_sessions WHERE csid='$uid'";
// echo $insert;

$query = mysqli_query($con,$insert);
    if($query){
        header("location:create_session.php");
    }
?>