<?php
session_start();
require_once("../includes/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sender = $_SESSION['Consultant'];
    $receiver = $_SESSION['receiver']; // Change as per your requirements
    $message = $_POST['message'];

    $query = "INSERT INTO chart (sender, receiver, message) VALUES ('$sender', '$receiver', '$message')";
    if (mysqli_query($con, $query)) {
        echo "Message sent successfully";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
