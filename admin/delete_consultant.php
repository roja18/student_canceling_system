<?php
$uid = $_GET['x'];
session_start();
if(empty($_SESSION['Admin'])){
    header("location:../index.php");
}
require_once("../includes/connection.php");


$insert = "DELETE FROM users WHERE uid='$uid'";
// echo $insert;

$query = mysqli_query($con,$insert);
    if($query){
        header("location:consultant.php");
    }
?>