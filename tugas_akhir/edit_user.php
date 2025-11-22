<?php
session_start();
include('koneksi.php');

if (!isset($_SESSION['admin_name'])) {
    header("Location: login_admin.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID user tidak ditemukan!";
    exit();
}

$id = $_GET['id'];

$query = "SELECT * FROM user WHERE id_user = $id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Data user tidak ditemukan.";
    exit();
}

$user = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $update = "UPDATE user SET username='$username', email='$email' WHERE id_user=$id";

    if (mysqli_query($conn, $update)) {
        header("Location: kelola_user.php?updated=1");
        exit();
    } else {
        echo "Gagal memperbarui user: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit User - Dapoer Nusantara</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #f6f8fa;
        font-family: 'Inter', sans-serif;
    }
    .navbar {
        background-color: #2E7D32 !important;
    }
    .btn-warning {
        background-color: #F9A825 !important;
        border: none;
    }
    .btn-warning:hover {
        background-color: #F57F17 !important;
    }
    .card {
        border-radius: 15px;
    }
</style>
</head>

<body>
<nav class="navbar navbar-dark px-4 py-3">
    <h4 class="text-white m-0">Edit User</h4>
    <button class="btn btn-warning" onclick="window.location.href='kelola_user.php'">Kembali</button>
</nav>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h4 class="text-center mb-3 text-success">Edit Data User</h4>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text" name="username" class="form-control" 
                               value="<?= htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" 
                               value="<?= htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
