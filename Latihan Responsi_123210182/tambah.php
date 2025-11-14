<?php
require 'koneksi.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul_film'] ?? '');
    $sutradara = trim($_POST['sutradara'] ?? '');
    $harga = intval($_POST['harga_tiket'] ?? 0);

    if ($judul === '' || $harga <= 0) {
        $err = 'Judul film dan harga tiket wajib diisi.';
    } else {
        $stmt = $mysqli->prepare("INSERT INTO film (judul_film, sutradara, harga_tiket) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $judul, $sutradara, $harga);
        $stmt->execute();
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tambah Film Baru</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.header-box {
    background-color: #1c344c;
    color: white;
    padding: 25px 30px;
}

.btn-save {
    background-color: #28a745;
    color: white;
    padding: 8px 25px;
    border: none;
    border-radius: 5px;
}

.btn-save:hover {
    background-color: #218838;
}

.btn-back {
    background-color: #9DB2BF;
    color: white;
    padding: 8px 25px;
    border: none;
    border-radius: 5px;
}

.btn-back:hover {
    background-color: #8ea6b4;
}
</style>

</head>
<body class="bg-white">

<!-- HEADER -->
<div class="header-box">
    <h3 class="m-0">Tambah Film Baru</h3>
    <small>Isi form untuk menambahkan film</small>
</div>

<div class="container mt-4">

    <?php if ($err): ?>
        <div class="alert alert-danger"><?php echo $err; ?></div>
    <?php endif; ?>

    <form method="post">

        <div class="mb-3">
            <label class="form-label">Judul Film</label>
            <input type="text" class="form-control" name="judul_film" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sutradara</label>
            <input type="text" class="form-control" name="sutradara">
        </div>

        <div class="mb-4">
            <label class="form-label">Harga Tiket (Rp)</label>
            <input type="number" class="form-control" name="harga_tiket" min="1" required>
        </div>

        <button type="submit" class="btn-save">Simpan</button>
        <a href="index.php" class="btn-back">Kembali</a>

    </form>
</div>

</body>
</html>