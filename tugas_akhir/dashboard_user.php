<?php
session_start();
include ('koneksi.php');

if (!isset($_SESSION['username'])) {
    header("Location: login_user.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard - Dapoer Nusantara</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #FAFAFA;
        color: #333;
    }
    .navbar-custom {
        background-color: #2E7D32;
    }
    .sidebar {
        width: 240px;
        background-color: #E8F5E9;
        position: fixed;
        top: 64px;
        bottom: 0;
        padding: 20px;
    }
    .sidebar a {
        display: block;
        color: #2E7D32;
        text-decoration: none;
        padding: 10px 0;
        font-weight: 600;
    }
    .sidebar a:hover {
        color: #1B5E20;
    }
    .main-content {
        margin-left: 260px;
        padding: 2rem;
    }
    .recipe-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 1rem;
    }
    footer {
        text-align: center;
        padding: 20px;
        background-color: #f3f3f3;
        margin-top: 3rem;
    }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom px-4 py-3">
    <div class="container-fluid d-flex justify-content-between">
        <h1 class="text-white fs-3 m-0">Dapoer Nusantara</h1>
        <div class="d-flex align-items-center gap-3 text-white">
            <span>👤 <?php echo htmlspecialchars($username); ?></span>
            <a href="logout.php" class="btn btn-warning fw-semibold">Logout</a>
        </div>
    </div>
</nav>
<div class="sidebar">
    <a href="#">📖 Dashboard</a>
    <a href="tambah_resep.php">💬 Add Recipe</a>
    <a href="index.php">🏠 Home</a>
</div>
<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-success fw-bold">My Recipes</h2>
            <p>Manage your delicious recipe collection</p>
        </div>

        <a href="tambah_resep.php" class="btn btn-warning fw-semibold">+ Add New Recipe</a>
    </div>

    <?php
    $sql = "SELECT * FROM resep WHERE penulis = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <div class='recipe-card'>
                <h3 class='fw-bold'>" . htmlspecialchars($row['judul']) . "</h3>
                <p>" . htmlspecialchars($row['deskripsi']) . "</p>

                <div class='d-flex gap-2'>
                    <a class='btn btn-success' href='edit_resep.php?id=" . $row['id_resep'] . "'>✏️ Edit</a>
                    <a class='btn btn-danger' onclick=\"return confirm('Delete this recipe?')\" 
                        href='hapus_resep.php?id=" . $row['id_resep'] . "'>🗑️ Delete</a>
                </div>
            </div>
            ";
        }
    } else {
        echo "
        <div class='recipe-card text-center'>
            <p>You haven't added any recipes yet.</p>
            <a href='tambah_resep.php' class='btn btn-warning fw-semibold'>Create Your First Recipe</a>
        </div>";
    }
    ?>
</div>
<footer>
    &copy; 2025 Dapoer Nusantara. All rights reserved.
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
