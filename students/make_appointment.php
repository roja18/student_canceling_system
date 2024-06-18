<?php
$uid = $_GET['x'];
session_start();
if(empty($_SESSION['Students'])){
    header("location:../index.php");
}
$mtu = $_SESSION['Students'];
require_once("../includes/connection.php");


$insert = "UPDATE availability SET statuz='Taken' WHERE aid='$uid'";
$apoint = "INSERT INTO `appointment`(`aid`, `username`) VALUES('$uid','$mtu')";

// echo $insert;
$query = mysqli_query($con,$insert);
$squery = mysqli_query($con,$apoint);
    if($query&&$squery){
        header("location:appointment.php");
    }
?>