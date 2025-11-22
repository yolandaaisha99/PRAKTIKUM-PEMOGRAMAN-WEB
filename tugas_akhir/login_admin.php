<?php
include('koneksi.php');
session_start();

$message = "";

if (isset($_GET['registered'])) {
    $message = "Registration successful! Please log in.";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id_admin, username, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id_admin'];
            $_SESSION['admin_name'] = $row['username'];

            header("Location: dashboard_admin.php");
            exit();
        } else {
            $message = "Incorrect password!";
        }
    } else {
        $message = "Admin not found!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login | Dapoer Nusantara</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    font-family: 'Inter', sans-serif;
}
.left-bg {
    background: linear-gradient(135deg, #F9A825, #F57F17);
}
.hex-bg {
    opacity: 0.15;
}
.icon-circle {
    width: 90px;
    height: 90px;
    background: rgba(255,255,255,0.25);
    border-radius: 50%;
}
</style>
</head>

<body>

<div class="d-flex min-vh-100">
    <div class="col-12 col-md-6 left-bg text-white d-flex align-items-center justify-content-center position-relative p-5">
        <div class="position-absolute top-0 start-0 w-100 h-100 hex-bg">
            <svg class="w-100 h-100" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="hex" width="10" height="17.32" patternUnits="userSpaceOnUse" patternTransform="scale(0.5)">
                        <polygon points="5,0 10,2.89 10,8.66 5,11.55 0,8.66 0,2.89" fill="none" stroke="white" stroke-width="0.5" />
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#hex)" />
            </svg>
        </div>
        <div class="position-relative text-center">
            <div class="icon-circle d-flex align-items-center justify-content-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-white" width="45" height="45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 .828-.672 1.5-1.5 1.5S9 11.828 9 11s.672-1.5 1.5-1.5S12 10.172 12 11zM15 16H9a3 3 0 01-3-3V9a3 3 0 013-3h6a3 3 0 013 3v4a3 3 0 01-3 3z" />
                </svg>
            </div>

            <h2 class="fw-semibold">Admin Access Panel</h2>
            <p class="mt-3 opacity-75">
                Masuk untuk mengelola pengguna, memantau resep, dan menjaga kelancaran Dapoer Nusantara.
            </p>
        </div>
    </div>
    <div class="col-12 col-md-6 d-flex align-items-center justify-content-center bg-white p-5">

        <div class="w-100" style="max-width: 420px;">
            <a href="index.php" class="text-decoration-none d-flex align-items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-warning" width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="fw-bold fs-4 text-warning">Dapoer Nusantara</span>
            </a>

            <h3 class="fw-bold mb-1">Welcome, Admin</h3>
            <p class="text-secondary mb-4">Sign in to your dashboard</p>

            <?php if ($message): ?>
                <div class="alert alert-danger py-2"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Admin Username</label>
                    <input type="text" class="form-control p-3" name="username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control p-3" name="password" required>
                </div>
                <button type="submit" class="btn w-100 py-3 text-white fw-semibold" style="background:#F9A825; font-size: 1.1rem;">
                    Login →
                </button>
            </form>
            <p class="mt-4 text-center text-secondary">
                Don’t have an admin account?
                <a href="register_admin.php" class="fw-semibold text-warning text-decoration-none">Register here</a>
            </p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
