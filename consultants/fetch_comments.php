<?php
session_start();
if (empty($_SESSION['Consultant'])) {
    echo 'Unauthorized';
    exit;
}
require_once("../includes/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['postId'])) {
    $postId = $_GET['postId'];

    $stmt = $con->prepare("SELECT * FROM comments WHERE fid = ? ORDER BY comment_id DESC");
    $stmt->bind_param("i", $postId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        echo json_encode($comments);
    } else {
        echo 'Failed to fetch comments';
    }

    $stmt->close();
}
?>
