<?php
include 'php/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT is_blocked FROM users WHERE user_id = $id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    
    // Toggle the 'is_blocked' status
    $newStatus = $user['is_blocked'] ? 0 : 1;
    $updateSql = "UPDATE users SET is_blocked = $newStatus WHERE id = $id";
    
    if (mysqli_query($conn, $updateSql)) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating status.";
    }
}
?>
