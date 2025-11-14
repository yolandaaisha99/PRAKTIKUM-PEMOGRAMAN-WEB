<?php
require 'koneksi.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

// Ambil data film
$films = $mysqli->query("SELECT * FROM film ORDER BY id_film ASC");

// Total harga
$totalRes = $mysqli->query("SELECT SUM(harga_tiket) AS total FROM film");
$total = $totalRes->fetch_assoc()['total'] ?? 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manajemen Film Bioskop</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.navbar-custom {
    background-color: #1c344c;
    padding: 20px;
    color: white;
}

.table th {
    background-color: #1c344c !important;
    color: white !important;
    border: 1px solid #1c344c !important;
}

.table td {
    border: 1px solid #cbd5e1;
}

.btn-tambah {
    background-color: #28a745;
    color: white;
    padding: 10px 18px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-tambah:hover {
    background-color: #218838;
    color: white;
}

.action-edit {
    color: #0d6efd;
    text-decoration: none;
}

.action-edit:hover {
    text-decoration: underline;
}

.action-delete {
    color: #dc3545;
    text-decoration: none;
}

.action-delete:hover {
    text-decoration: underline;
}
</style>
</head>
<body class="bg-light">

<div class="navbar-custom">
    <h3 class="m-0">Manajemen Film Bioskop</h3>
    <small>
        Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
        | <a href="logout.php" class="text-white">Logout</a>
    </small>
</div>

<div class="container mt-4">

    <a href="tambah.php" class="btn-tambah mb-3 d-inline-block">Tambah Film</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th>Judul Film</th>
                <th>Sutradara</th>
                <th width="20%">Harga Tiket</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $films->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id_film']; ?></td>
                <td><?php echo htmlspecialchars($row['judul_film']); ?></td>
                <td><?php echo htmlspecialchars($row['sutradara']); ?></td>
                <td>Rp <?php echo number_format($row['harga_tiket'], 0, ',', '.'); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id_film']; ?>" class="action-edit">Edit</a> |
                    <a href="hapus.php?id=<?php echo $row['id_film']; ?>" 
                       class="action-delete"
                       onclick="return confirm('Hapus film ini?');">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3"><strong>Total Harga Tiket</strong></td>
                <td colspan="2"><strong>Rp <?php echo number_format($total, 0, ',', '.'); ?></strong></td>
            </tr>
        </tfoot>
    </table>

</div>

</body>
</html>