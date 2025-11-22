<?php
require_once('koneksi.php');
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];

            header("Location: dashboard_user.php");
            exit;
        } else {
            $message = "Incorrect password!";
        }
    } else {
        $message = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login | Dapoer Nusantara</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
      .left-side {
          background: linear-gradient(135deg, #F9A825, #F57F17);
          position: relative;
      }
      .left-side::before {
          content: "";
          position: absolute;
          inset: 0;
          opacity: 0.1;
          background-image: radial-gradient(white 1.5px, transparent 1.5px);
          background-size: 20px 20px;
      }
  </style>
</head>
<body class="min-vh-100">
<div class="container-fluid min-vh-100">
  <div class="row min-vh-100">
    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-white left-side p-5">
        <img src="https://images.unsplash.com/photo-1592837613828-4b65deb44f15?auto=format&q=80&w=1080"
             class="img-fluid rounded shadow mb-4" style="width: 400px; height: 300px; object-fit: cover;">

        <h2 class="fw-semibold">Kenapa Bergabung Dengan Dapoer Nusantara?</h2>
        <ul class="mt-3 fs-5">
            <li>🍛 Bagikan resep Indonesia favorit Anda</li>
            <li>🍲 Temukan hidangan tradisional dan modern</li>
            <li>👩‍🍳 Terhubung dengan para penggemar makanan</li>
            <li>📚 Simpan dan atur koleksi Anda</li>
            <li>💡 Dapatkan tips memasak dan masukan</li>
        </ul>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-center p-5 bg-white">
        <div class="w-100" style="max-width: 420px;">
            <a href="index.php" class="d-flex align-items-center mb-4 text-decoration-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" stroke="#2E7D32" fill="none" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="fs-3 fw-semibold text-success ms-2">Dapoer Nusantara</span>
            </a>
            <h1 class="fw-bold text-dark">Log In</h1>
            <p class="text-secondary mb-4">Start your culinary journey today</p>
            <?php if ($message): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" required class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" required class="form-control">
                </div>
                <button class="btn btn-success w-100 py-2 fs-5">Log In →</button>
            </form>
            <p class="text-center mt-4">
                Don't have an account?
                <a href="register_user.php" class="text-success fw-semibold">Register here</a>
            </p>
        </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
