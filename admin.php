<?php
session_start();
include 'php/config.php'; // Make sure your DB connection is correct

// Redirect if not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch users from the database
$query = "SELECT * FROM users ORDER BY user_id DESC"; // Adjust query as needed
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ChatApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f8;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <!-- Admin Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Admin Dashboard</h2>
        <a href="admin_login.php" class="btn btn-outline-danger">Logout</a>
    </div>

    <!-- Welcome message with admin name -->
    <div class="alert alert-info">
        Welcome, <strong><?php echo htmlspecialchars($_SESSION['admin_name']); ?></strong>! <br>
        You are logged in as an Admin.
    </div>

    <!-- User List -->
    <div class="row">
        <?php while ($user = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                       
                        <div class="ms-3">
                            <h5 class="mb-0"><?php echo htmlspecialchars($user['fname']); ?></h5>
                            <small>User ID: <?php echo $user['user_id']; ?></small><br>
                            <small>Email: <?php echo $user['email']; ?></small><br>
                            <small>Status: 
                                <span class="badge bg-<?php echo $user['is_blocked'] ? 'danger' : 'success'; ?>">
                                    <?php echo $user['is_blocked'] ? 'Blocked' : 'Active'; ?>
                                </span>
                            </small>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-between">
                        <!-- Delete User -->
                        <a href="delete_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                        
                        <!-- Toggle Block/Unblock User -->
                        <a href="toggle_block.php?id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-warning">
                            <?php echo $user['is_blocked'] ? 'Unblock' : 'Block'; ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
