<?php
require_once("../includes/connection.php");

if(isset($_POST['session_id'])) {
    $session_id = $_POST['session_id'];
    $query = "SELECT users.fullname, users.username 
            FROM users,session,consultant_sessions 
            WHERE users.username = consultant_sessions.username 
            AND session.sid = consultant_sessions.sid 
            AND session.sid = '$session_id'";
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result) > 0) {
        echo '<option value="">Select Consultant</option>';
        while($row = mysqli_fetch_assoc($result)) {
            echo '<option value="'.$row['username'].'">'.$row['fullname'].'</option>';
        }
    } else {
        echo '<option value="">No consultants available</option>';
    }
}
?>
