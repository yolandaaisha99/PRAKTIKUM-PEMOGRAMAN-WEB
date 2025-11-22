<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user']) && !isset($_SESSION['admin_name'])) {
    header("Location: login_user.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID resep tidak ditemukan.";
    exit();
}

$id_resep = intval($_GET['id']);

$query = "SELECT gambar FROM resep WHERE id_resep = $id_resep";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Resep tidak ditemukan.";
    exit();
}

$row = mysqli_fetch_assoc($result);
$gambarPath = "uploads/" . $row['gambar'];

if (!empty($row['gambar']) && file_exists($gambarPath)) {
    unlink($gambarPath);
}

$deleteQuery = "DELETE FROM resep WHERE id_resep = $id_resep";
if (mysqli_query($conn, $deleteQuery)) {

    if (isset($_SESSION['id_admin'])) {
        header("Location: kelola_resep.php?status=deleted");
        exit();
    } else {
        header("Location: index.php?status=deleted");
        exit();
    }
} else {
    echo "Gagal menghapus resep: " . mysqli_error($koneksi);
}
?>
