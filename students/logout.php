<?php
    session_start();
    if(isset($_SESSION['Students'])){
        session_destroy();
        unset($_SESSION['Students']);
        header("location:../index.php");
    }
?>