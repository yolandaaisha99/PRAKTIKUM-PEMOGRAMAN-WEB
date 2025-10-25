<?php
include 'koneksi.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM fans WHERE id=$id");
$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST['nama'];
  $gender = $_POST['gender'];
  $bias = $_POST['bias'];
  $pesan = $_POST['pesan'];

  $conn->query("UPDATE fans SET nama='$nama', gender='$gender', bias='$bias', pesan='$pesan' WHERE id=$id");
  header("Location: aksi.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="judul">
    <h1>Edit Data Penggemar</h1>
  </div>

  <ul class="menu">
    <li><a href="index.html">Home</a></li>
    <li><a href="form.html">Tambah Data</a></li>
    <li><a href="aksi.php">Data Fans</a></li>
  </ul>

  <section class="konten-utama">
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Gender</label>
        <select name="gender" class="form-select" required>
          <option value="Laki-laki" <?= $data['gender']=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
          <option value="Perempuan" <?= $data['gender']=='Perempuan'?'selected':'' ?>>Perempuan</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Bias (Idol Favorit)</label>
        <input type="text" name="bias" class="form-control" value="<?= $data['bias'] ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Pesan</label>
        <textarea name="pesan" class="form-control" rows="3"><?= $data['pesan'] ?></textarea>
      </div>

      <button type="submit" class="btn btn-dark">Perbarui</button>
    </form>
  </section>

  <footer>
    <small>Copyright &copy; Yolanda Aisha Hs | 123210182</small>
  </footer>
</body>
</html>
