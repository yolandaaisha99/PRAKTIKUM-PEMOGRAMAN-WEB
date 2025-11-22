<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    die("Error: Anda harus login terlebih dahulu.");
}

$id_resep = $_POST['id_resep'];
$id_user = $_SESSION['id_user'];
$username_komentar = $_SESSION['username'];
$isi = $_POST['isi'];
$tanggal = date('Y-m-d H:i:s');

if (empty($id_resep)) {
    die("Error: id_resep tidak terkirim.");
}
if (empty($isi)) {
    die("Error: isi komentar kosong.");
}

$cek = mysqli_query($conn, "SELECT * FROM resep WHERE id_resep = '$id_resep'");
if (!$cek) {
    die("SQL Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($cek) == 0) {
    die("Error: ID resep tidak ditemukan di database.");
}

$query = "INSERT INTO komentar (id_resep, id_user, username_komentar, isi, tanggal)
          VALUES ('$id_resep', '$id_user', '$username_komentar', '$isi', '$tanggal')";

if (mysqli_query($conn, $query)) {
    header("Location: detail_resep.php?id=$id_resep");
    exit;
} else {
    echo "Gagal menambah komentar: " . mysqli_error($conn);
}
?>
