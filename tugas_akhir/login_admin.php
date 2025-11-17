<?php
include('koneksi.php');
session_start();

$message = "";

// Show success alert if redirected from registration
if (isset($_GET['registered'])) {
    $message = "Registration successful! Please log in.";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // verify hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login | Dapoer Nusantara</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex">

  <!-- Left Side -->
  <div class="w-1/2 bg-gradient-to-br from-[#F9A825] to-[#F57F17] relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
        <defs>
          <pattern id="hex" width="10" height="17.32" patternUnits="userSpaceOnUse" patternTransform="scale(0.5)">
            <polygon points="5,0 10,2.89 10,8.66 5,11.55 0,8.66 0,2.89" fill="none" stroke="white" stroke-width="0.5" />
          </pattern>
        </defs>
        <rect width="100" height="100" fill="url(#hex)" />
      </svg>
    </div>

    <div class="relative h-full flex flex-col justify-center items-center text-white p-12">
      <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 .828-.672 1.5-1.5 1.5S9 11.828 9 11s.672-1.5 1.5-1.5S12 10.172 12 11zM15 16H9a3 3 0 01-3-3V9a3 3 0 013-3h6a3 3 0 013 3v4a3 3 0 01-3 3z" />
        </svg>
      </div>
      <h2 class="text-2xl font-semibold mb-4">Admin Access Panel</h2>
      <p class="text-center text-white/90 max-w-md">
        Log in to manage users, monitor recipes, and keep Dapoer Nusantara running smoothly.
      </p>
    </div>
  </div>

  <!-- Right Side -->
  <div class="w-1/2 flex items-center justify-center p-12 bg-white">
    <div class="w-full max-w-md">
      <a href="index.php" class="flex items-center gap-2 mb-8">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#F9A825]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
        <span class="font-semibold text-2xl text-[#F9A825]">Dapoer Nusantara</span>
      </a>

      <h1 class="text-[#333333] mb-3 text-2xl font-semibold">Welcome, Admin</h1>
      <p class="text-[#737373] text-lg mb-6">Sign in to your dashboard</p>

      <?php if ($message): ?>
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4"><?= htmlspecialchars($message) ?></div>
      <?php endif; ?>

      <form method="POST" class="space-y-4">
        <div>
          <label class="block text-[#333333] mb-2">Admin Username</label>
          <input type="text" name="username" required class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-[#F9A825]">
        </div>

        <div>
          <label class="block text-[#333333] mb-2">Password</label>
          <input type="password" name="password" required class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-[#F9A825]">
        </div>

        <button type="submit" class="w-full bg-[#F9A825] hover:bg-[#F57F17] text-white py-3 rounded-md font-semibold transition">Login →</button>
      </form>

      <p class="text-[#737373] mt-6 text-center">
        Don’t have an admin account?
        <a href="register_admin.php" class="text-[#F9A825] font-semibold hover:underline">Register here</a>
      </p>
    </div>
  </div>
</body>
</html>
