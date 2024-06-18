<?php
    session_start();
    if(isset($_SESSION['Consultant'])){
        session_destroy();
        unset($_SESSION['Consultant']);
        header("location:../index.php");
    }
?>