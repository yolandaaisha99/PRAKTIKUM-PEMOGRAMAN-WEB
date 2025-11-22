<?php
session_start();
include('koneksi.php');

if (!isset($_SESSION['admin_name'])) {
    header("Location: login_admin.php");
    exit();
}

$username = $_SESSION['admin_name'];

$query = "SELECT id_resep, id_user, judul, penulis, deskripsi, gambar, bahan, cara_buat, tanggal 
          FROM resep ORDER BY id_resep ASC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Resep - Dapoer Nusantara</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #FAFAFA;
    }
    .navbar-custom {
        background-color: #2E7D32;
    }
    .btn-warning-custom {
        background-color: #F9A825;
        color: white;
        font-weight: 600;
    }
    .btn-warning-custom:hover {
        background-color: #F57F17;
    }
    .btn-danger-outline {
        border: 1px solid #E53935;
        color: #E53935;
        font-weight: 600;
    }
    .btn-danger-outline:hover {
        background-color: #E53935;
        color: white;
    }
    .table thead {
        background-color: #E8F5E9;
    }
    img.thumb {
        width: 80px;
        border-radius: 6px;
    }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom px-4 py-3">
    <div class="container-fluid d-flex justify-content-between">
        <h1 class="text-white fs-4 m-0">Kelola Resep</h1>
        <div class="d-flex gap-2 align-items-center text-white fw-semibold">
            👑 <?= htmlspecialchars($username); ?>
            <a href="logout.php" class="btn btn-warning-custom ms-3">Logout</a>
            <a href="dashboard_admin.php" class="btn btn-light fw-semibold">Back</a>
        </div>
    </div>
</nav>
<div class="container bg-white rounded shadow mt-4 p-4">

    <h2 class="text-success fw-bold mb-4">Manage Resep</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID Resep</th>
                    <th>ID User</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Bahan</th>
                    <th>Cara Buat</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id_resep']; ?></td>
                    <td><?= $row['id_user']; ?></td>
                    <td><?= htmlspecialchars($row['judul']); ?></td>
                    <td><?= htmlspecialchars($row['penulis']); ?></td>
                    <td><?= substr(htmlspecialchars($row['deskripsi']), 0, 50) . "..."; ?></td>

                    <td>
                        <?php if (!empty($row['gambar'])): ?>
                            <img src="uploads/<?= $row['gambar']; ?>" class="thumb">
                        <?php else: ?>
                            <i class="text-secondary">(No image)</i>
                        <?php endif; ?>
                    </td>

                    <td><?= substr(htmlspecialchars($row['bahan']), 0, 50) . "..."; ?></td>
                    <td><?= substr(htmlspecialchars($row['cara_buat']), 0, 50) . "..."; ?></td>

                    <td><?= date('M d, Y', strtotime($row['tanggal'])); ?></td>

                    <td class="text-center">
                        <button class="btn btn-warning-custom me-1"
                                onclick="editResep(<?= $row['id_resep']; ?>)">
                            Edit
                        </button>

                        <button class="btn btn-danger-outline"
                                onclick="deleteResep(<?= $row['id_resep']; ?>)">
                            Hapus
                        </button>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<footer class="text-center mt-4 p-3 bg-light">
    &copy; 2025 Dapoer Nusantara. All rights reserved.
</footer>
<script>
function editResep(id) {
    window.location.href = "edit_resep.php?id=" + id;
}
function deleteResep(id) {
    if (confirm("Apakah kamu yakin ingin menghapus resep ini?")) {
        window.location.href = "hapus_resep.php?id=" + id;
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
