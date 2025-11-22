<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin_name'])) {
    header("Location: login_admin.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM komentar WHERE id_komentar = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: kelola_komentar.php?deleted=1");
    exit();
} else {
    echo "Gagal menghapus.";
}
