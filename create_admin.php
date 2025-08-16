<?php
include 'php/config.php';

$username = 'Animesh';
$plainPassword = 'Animesh123';
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO admins (username, password) VALUES ('$username', '$hashedPassword')";
if (mysqli_query($conn, $sql)) {
    echo "✅ Admin account created successfully.";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}
?>
