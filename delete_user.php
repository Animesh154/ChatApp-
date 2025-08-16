<?php
include 'php/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE user_id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error deleting user.";
    }
}
?>
