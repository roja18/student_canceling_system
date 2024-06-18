<?php
$uid = $_GET['x'];
session_start();
if(empty($_SESSION['Admin'])){
    header("location:../index.php");
}
require_once("../includes/connection.php");


$insert = "DELETE FROM session WHERE sid='$uid'";
// echo $insert;

$query = mysqli_query($con,$insert);
    if($query){
        header("location:session.php");
    }
?>