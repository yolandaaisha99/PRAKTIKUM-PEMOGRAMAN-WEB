<?php
require 'koneksi.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$err = '';

$result = $mysqli->prepare("SELECT * FROM film WHERE id_film = ?");
$result->bind_param("i", $id);
$result->execute();
$data = $result->get_result()->fetch_assoc();

if (!$data) {
    die("Film tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul_film']);
    $sutradara = trim($_POST['sutradara']);
    $harga = intval($_POST['harga_tiket']);

    if ($judul === '' || $harga <= 0) {
        $err = "Judul film dan harga wajib diisi.";
    } else {
        $upd = $mysqli->prepare("UPDATE film SET judul_film=?, sutradara=?, harga_tiket=? WHERE id_film=?");
        $upd->bind_param("ssii", $judul, $sutradara, $harga, $id);
        $upd->execute();
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
<title>Edit Film</title>
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

.input-readonly {
    background-color: #f1f1f1;
}
</style>

</head>
<body class="bg-white">

<!-- HEADER -->
<div class="header-box">
    <h3 class="m-0">Edit Film</h3>
    <small>Perbarui informasi film</small>
</div>

<div class="container mt-4">

    <?php if ($err): ?>
        <div class="alert alert-danger"><?php echo $err; ?></div>
    <?php endif; ?>

    <form method="post">

        <div class="mb-3">
            <label class="form-label">ID Film</label>
            <input type="text" name="id_film" class="form-control input-readonly" value="<?php echo $data['id_film']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Film</label>
            <input type="text" name="judul_film" class="form-control" value="<?php echo htmlspecialchars($data['judul_film']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sutradara</label>
            <input type="text" name="sutradara" class="form-control" value="<?php echo htmlspecialchars($data['sutradara']); ?>">
        </div>

        <div class="mb-4">
            <label class="form-label">Harga Tiket (Rp)</label>
            <input type="number" name="harga_tiket" class="form-control" value="<?php echo $data['harga_tiket']; ?>" required>
        </div>

        <button type="submit" class="btn-save">Perbarui</button>
        <a href="index.php" class="btn-back">Kembali</a>

    </form>

</div>

</body>
</html>