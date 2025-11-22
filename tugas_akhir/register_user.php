<?php
require_once('koneksi.php');

if (!$conn || $conn->connect_error) {
    die("Database connection failed: " . ($conn->connect_error ?? "Connection not established"));
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirmPassword'];

    if ($password !== $confirm) {
        $message = "Passwords do not match!";
    } else {
        $check = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $message = "Email already registered!";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed);

            if ($stmt->execute()) {
                header("Location: login_user.php?success=1");
                exit;
            } else {
                $message = "Registration failed, please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Register | Dapoer Nusantara</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .left-panel {
      background: linear-gradient(135deg, #F9A825, #F57F17);
      color: white;
      position: relative;
    }
    .left-panel::before {
      content: "";
      position: absolute;
      inset: 0;
      opacity: 0.15;
      background-image: radial-gradient(white 2px, transparent 2px);
      background-size: 20px 20px;
    }
    .left-panel img {
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    }
  </style>
</head>
<body class="min-vh-100">
<div class="container-fluid min-vh-100">
  <div class="row min-vh-100">
    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center p-5 text-center left-panel">
      <img src="https://images.unsplash.com/photo-1592837613828-4b65deb44f15?auto=format&q=80&w=1080"
           width="400" height="300" class="mb-4 object-fit-cover" alt="Indonesian Kitchen">
      <h2 class="fw-semibold mb-4">Kenapa Bergabung Dengan Dapoer Nusantara?</h2>
      <ul class="list-unstyled text-start" style="max-width: 350px;">
        <li class="mb-2">🍛 Bagikan resep Indonesia favorit Anda</li>
        <li class="mb-2">🍲 Temukan hidangan tradisional dan modern</li>
        <li class="mb-2">👩‍🍳 Terhubung dengan para penggemar makanan</li>
        <li class="mb-2">📚 Simpan dan atur koleksi Anda</li>
        <li class="mb-2">💡 Dapatkan tips memasak dan masukan</li>
      </ul>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-center p-5 bg-white">
      <div class="w-100" style="max-width: 420px;">
        <a href="index.php" class="d-flex align-items-center mb-4 text-decoration-none">
          <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" stroke="#2E7D32" fill="none" stroke-width="2"
               viewBox="0 0 24 24">
            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span class="fs-3 fw-bold text-success ms-2">Dapoer Nusantara</span>
        </a>
        <h1 class="fw-bold text-dark mb-2">Create Account</h1>
        <p class="text-secondary mb-4">Start your culinary journey today</p>

        <?php if ($message): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirmPassword" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
            Create Account →
          </button>
        </form>
        <p class="text-center mt-4">
          Already have an account?
          <a href="login_user.php" class="text-success fw-semibold">Login now</a>
        </p>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
