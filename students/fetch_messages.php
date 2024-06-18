<?php
session_start();
require_once("../includes/connection.php");

$sender = $_SESSION['Students'];
$receiver = $_SESSION['receiver']; // Change as per your requirements

$query = "SELECT * FROM chart WHERE (sender='$sender' AND receiver='$receiver') OR (sender='$receiver' AND receiver='$sender') ORDER BY timestamp ASC";
$result = mysqli_query($con, $query);

$messages = array();
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

echo json_encode($messages);
?>
