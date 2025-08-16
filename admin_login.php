<?php
session_start();
include 'php/config.php'; // Make sure this connects to your MySQL database

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM admins WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);

        // Verify hashed password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['username'];
            header("Location: admin.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Admin account not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login - ChatApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f1f2f6;
        }
        .login-box {
            max-width: 400px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3 class="mb-4 text-center">Admin Login</h3>

    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">
        <div class="mb-3">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100" type="submit">Login</button>
    </form>
</div>

</body>
</html>
