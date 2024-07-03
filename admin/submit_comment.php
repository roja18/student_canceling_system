<?php
session_start();
if (empty($_SESSION['Admin'])) {
    echo 'Unauthorized';
    exit;
}
require_once("../includes/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['postId'];
    $comment = $_POST['comment'];
    $email = $_SESSION['Admin'];

    $stmt = $con->prepare("INSERT INTO comments (fid, comment, email) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $postId, $comment, $email);

    if ($stmt->execute()) {
        echo 'Comment submitted successfully';
    } else {
        echo 'Failed to submit comment';
    }

    $stmt->close();
}
?>
