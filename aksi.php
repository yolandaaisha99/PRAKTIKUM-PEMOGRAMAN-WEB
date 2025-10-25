<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $bias = isset($_POST['bias']) ? $_POST['bias'] : '';
    $aktivitas = isset($_POST['aktivitas']) ? implode(', ', $_POST['aktivitas']) : '';
    $pesan = isset($_POST['pesan']) ? $_POST['pesan'] : '';

    $cekBias = $conn->query("SELECT id FROM idol WHERE id = '$bias'");
    if ($cekBias && $cekBias->num_rows > 0) {
        $sql = "INSERT INTO fans (nama, gender, bias, aktivitas, pesan)
                VALUES ('$nama', '$gender', '$bias', '$aktivitas', '$pesan')";
        if ($conn->query($sql)) {
            echo "<div class='alert alert-success text-center'>Data berhasil ditambahkan!</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Gagal menambahkan data: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>Bias tidak valid! Pastikan memilih idol yang terdaftar.</div>";
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM fans WHERE id=$id");
    header("Location: aksi.php");
    exit;
}

$sql = "SELECT fans.id, fans.nama, fans.gender, idol.nama AS bias, fans.aktivitas, fans.pesan
        FROM fans
        INNER JOIN idol ON fans.bias = idol.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Penggemar K-Pop</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="judul">Data Penggemar</div>

    <ul class="menu">
        <li><a href="index.html">Home</a></li>
        <li><a href="form.html">Tambah Data</a></li>
        <li><a href="aksi.php">Data Fans</a></li>
    </ul>

    <div class="konten-utama">
        <h2 class="text-center mb-4">Daftar Penggemar K-Pop</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Bias (Idol Favorit)</th>
                        <th>Aktivitas</th>
                        <th>Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0) { ?>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['gender'] ?></td>
                                <td><?= $row['bias'] ?></td>
                                <td><?= $row['aktivitas'] ?></td>
                                <td><?= $row['pesan'] ?></td>
                                <td>
                                    <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="aksi.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr><td colspan="7">Belum ada data fans.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <p>Copyright © Yolanda Aisha Hs | 123210182</p>
    </footer>

</body>
</html>
