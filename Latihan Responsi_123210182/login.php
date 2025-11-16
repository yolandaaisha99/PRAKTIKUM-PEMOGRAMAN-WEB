<?php
require 'koneksi.php';

$msg = '';
if (isset($_SESSION['logout_msg'])) {
    $msg = $_SESSION['logout_msg'];
    unset($_SESSION['logout_msg']);
}

if (isset($_GET['registered'])) {
    $msg = 'Registrasi berhasil. Silakan login.';
}

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id_user, password FROM users WHERE username=?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($id, $hash);

    if ($stmt->fetch() && password_verify($password, $hash)) {
        $_SESSION['id_user'] = $id;
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        $err = 'Username atau password salah.';
    }
    $stmt->close();
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - Bioskop</title>
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

.btn-login {
    background-color: #213555;
    border: none;
}
.btn-login:hover {
    background-color: #1a2a44;
}
</style>

</head>
<body class="bg-light">

<div class="container py-5">
  <div class="row page-box">

    <div class="col-md-6 p-0">
        <div class="left-img"></div>
    </div>

    <div class="col-md-6 form-box">
        <h3 class="fw-bold">Login</h3>
        <p class="text-muted">Masukkan username dan password</p>

        <?php if ($msg): ?>
            <div class="alert alert-success"><?php echo $msg; ?></div>
        <?php endif; ?>

        <?php if ($err): ?>
            <div class="alert alert-danger"><?php echo $err; ?></div>
        <?php endif; ?>

        <form method="post">

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input name="username" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-login text-white w-100">Login</button>

        </form>

        <div class="mt-4">
            <small>Belum punya akun? <a href="register.php">Daftar di sini</a></small>
        </div>
    </div>

  </div>
</div>

</body>

</html>
