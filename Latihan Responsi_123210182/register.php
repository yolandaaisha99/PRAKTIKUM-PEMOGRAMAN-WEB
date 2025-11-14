<?php
require 'koneksi.php';

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if ($username === '' || $password === '' || $password2 === '') {
        $err = 'Semua field harus diisi.';
    } elseif ($password !== $password2) {
        $err = 'Password dan konfirmasi tidak sama.';
    } else {
        $stmt = $mysqli->prepare("SELECT id_user FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $err = 'Username sudah dipakai.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $ins->bind_param('ss', $username, $hash);
            if ($ins->execute()) {
                header('Location: login.php?registered=1');
                exit;
            } else {
                $err = 'Gagal registrasi. Coba lagi.';
            }
        }
        $stmt->close();
    }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register - Bioskop</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.page-box {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 6px 18px rgba(0,0,0,0.08);
}

.left-img {
    background: url('film.jpg') center center / cover no-repeat;
    height: 100%;
    min-height: 550px;
    width: 100%;
}

.form-box {
    padding: 50px;
}

.btn-register {
    background-color: #213555;
    border: none;
}
.btn-register:hover {
    background-color: #1a2a44;
}

.btn-back {
    background-color: #9DB2BF;
    border: none;
}
.btn-back:hover {
    background-color: #8ba3b0;
}
</style>

</head>
<body class="bg-light">

<div class="container py-5">
  <div class="row page-box">

    <!-- GAMBAR FULL KIRI -->
    <div class="col-md-6 p-0">
        <div class="left-img"></div>
    </div>

    <!-- FORM KANAN -->
    <div class="col-md-6 form-box">
        <h3 class="fw-bold">Register</h3>
        <p class="text-muted">Isi semua data dengan benar</p>

        <?php if ($err): ?>
            <div class="alert alert-danger"><?php echo $err; ?></div>
        <?php endif; ?>

        <form method="post">

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password2" class="form-control" required>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-register text-white w-50">Register</button>
                <a href="login.php" class="btn btn-back text-white w-50">Kembali</a>
            </div>

        </form>

        <div class="mt-4">
            <small>Sudah punya akun? <a href="login.php">Login di sini</a></small>
        </div>
    </div>

  </div>
</div>

</body>
</html>