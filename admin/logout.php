<?php
    session_start();
    if(isset($_SESSION['Admin'])){
        session_destroy();
        unset($_SESSION['Admin']);
        header("location:../index.php");
    }
?>