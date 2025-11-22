<?php
include('koneksi.php');
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirmPassword'];

    if ($password !== $confirm) {
        $message = "Passwords do not match!";
    } else {
        $check = $conn->prepare("SELECT id FROM admin WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "Admin already exists!";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashedPassword);

            if ($stmt->execute()) {
                header("Location: login_admin.php?registered=1");
                exit();
            } else {
                $message = "Registration failed. Please try again.";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Register | Dapoer Nusantara</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .left-side {
      background: linear-gradient(135deg, #F9A825, #F57F17, #FF6F00);
      position: relative;
      color: white;
    }
    .left-side::before {
      content: "";
      position: absolute;
      inset: 0;
      opacity: 0.1;
      background-image: 
        url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200"><polygon points="100,0 200,57.7 200,173.2 100,230.9 0,173.2 0,57.7" fill="none" stroke="white" stroke-width="4"/></svg>');
      background-size: 80px;
    }
  </style>
</head>
<body class="min-vh-100">
<div class="container-fluid min-vh-100">
  <div class="row min-vh-100">
    <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-center p-5 left-side">
      <div class="rounded-circle bg-white bg-opacity-25 d-flex justify-content-center align-items-center mb-4"
           style="width: 90px; height: 90px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" stroke="white" fill="none" stroke-width="2"
             viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 11c0 .828-.672 1.5-1.5 1.5S9 11.828 9 11s.672-1.5 1.5-1.5S12 10.172 12 11zM15 16H9a3 3 0 01-3-3V9a3 3 0 013-3h6a3 3 0 013 3v4a3 3 0 01-3 3z" />
        </svg>
      </div>
      <h2 class="fw-semibold mb-3">Admin Portal Access</h2>
      <p class="w-75 mx-auto">
        Buat akun administrator yang aman untuk mengelola pengguna, resep, dan analitik untuk Dapoer Nusantara.
      </p>
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
        <h1 class="fw-bold text-dark mb-2">Register Admin</h1>
        <p class="text-secondary mb-4">Administrative access only</p>

        <?php if ($message): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Admin Username</label>
            <input type="text" name="username" required class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" required class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirmPassword" required class="form-control">
          </div>
          <button type="submit" class="btn btn-warning w-100 py-2 fs-5 fw-semibold">
            Create Admin Account →
          </button>
        </form>
        <p class="text-center mt-4">
          Already have an account?
          <a href="login_admin.php" class="text-warning fw-semibold">Login as Admin</a>
        </p>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
