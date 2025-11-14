<?php
require 'koneksi.php';

// Pastikan sudah login
if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

// Ambil ID film
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Hapus film
    $stmt = $mysqli->prepare("DELETE FROM film WHERE id_film = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Kembali ke index
header("Location: index.php");
exit;
?>
