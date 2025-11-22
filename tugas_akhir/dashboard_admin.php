<?php
session_start();
include ('koneksi.php');

if (!isset($_SESSION['admin_name'])) {
    header("Location: login_admin.php");
    exit();
}

$username = $_SESSION['admin_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Dapoer Nusantara</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body {
        margin: 0;
        font-family: 'Inter', sans-serif;
        background-color: #FAFAFA;
        color: #333;
    }
    .navbar-custom {
        background-color: #2E7D32 !important;
        color: white;
        padding: 1rem 2rem;
    }
    .navbar-custom .btn-warning {
        background-color: #F9A825;
        border: none;
        font-weight: 600;
        color: white;
    }
    .navbar-custom .btn-warning:hover {
        background-color: #F57F17;
    }
    .card {
        border-radius: 12px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
    }
    .card h3 {
        color: #2E7D32;
        margin: 0;
    }
    .quick-actions button {
        background: #E8F5E9;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 1rem;
        width: 100%;
        font-weight: 600;
        text-align: left;
        border: none;
        transition: all .3s;
    }
    .quick-actions button:hover {
        background: #2E7D32;
        color: white;
    }
</style>
</head>
<body>
<nav class="navbar navbar-custom d-flex justify-content-between align-items-center">
    <h1 class="fs-4 m-0 text-white">Admin Dashboard</h1>

    <div class="d-flex align-items-center gap-3">
        <span>👑 <?php echo htmlspecialchars($username); ?></span>
        <button onclick="window.location.href='logout.php'" class="btn btn-warning px-3">Logout</button>
    </div>
</nav>
<div class="container mt-4">
    <h2 style="color:#2E7D32;">Welcome, Admin <?php echo htmlspecialchars($username); ?> 👋</h2>
    <div class="row g-4 mt-2">

        <div class="col-md-4">
            <div class="card p-3">
                <h3>Total Users</h3>
                <p class="fs-4">
                    <?php
                    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM user");
                    $row = mysqli_fetch_assoc($result);
                    echo $row['total'];
                    ?>
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h3>Total Recipes</h3>
                <p class="fs-4">
                    <?php
                    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM resep");
                    $row = mysqli_fetch_assoc($result);
                    echo $row['total'];
                    ?>
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h3>Total Comments</h3>
                <p class="fs-4">
                    <?php
                    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM komentar");
                    $row = mysqli_fetch_assoc($result);
                    echo $row['total'];
                    ?>
                </p>
            </div>
        </div>

    </div>
    <div class="quick-actions mt-4">
        <h3 style="color:#2E7D32;">Quick Actions</h3>
        <button onclick="window.location.href='kelola_user.php'">👥 Manage Users</button>
        <button onclick="window.location.href='kelola_resep.php'">🍳 Manage Recipes</button>
        <button onclick="window.location.href='kelola_komentar.php'">💬 Manage Comments</button>
    </div>
</div>
<footer class="text-center mt-5 py-3 bg-light">
    &copy; 2025 Dapoer Nusantara. All rights reserved.
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
