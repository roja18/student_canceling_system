<?php
$uid = $_GET['x'];
session_start();
if(empty($_SESSION['Consultant'])){
    header("location:../index.php");
}
require_once("../includes/connection.php");


$insert = "DELETE FROM availability WHERE aid='$uid'";
// echo $insert;

$query = mysqli_query($con,$insert);
    if($query){
        header("location:availability.php");
    }
?>