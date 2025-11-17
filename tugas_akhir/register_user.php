<?php
require_once('koneksi.php');

// Check connection
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
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex">

  <!-- Left Side -->
  <div class="w-1/2 bg-gradient-to-br from-[#F9A825] to-[#F57F17] relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
        <defs>
          <pattern id="dots" width="8" height="8" patternUnits="userSpaceOnUse">
            <circle cx="4" cy="4" r="1.5" fill="white" />
          </pattern>
        </defs>
        <rect width="100" height="100" fill="url(#dots)" />
      </svg>
    </div>

    <div class="relative h-full flex flex-col justify-center items-center p-12 text-white">
      <img src="https://images.unsplash.com/photo-1592837613828-4b65deb44f15?auto=format&q=80&w=1080"
           alt="Indonesian Kitchen"
           class="w-[400px] h-[300px] object-cover rounded-2xl shadow-2xl mb-8">
      <div class="text-center max-w-md">
        <h2 class="mb-6 text-white text-2xl font-semibold">Why Join Dapoer Nusantara?</h2>
        <ul class="text-left space-y-3 text-white/90">
          <li>🍛 Share your favorite Indonesian recipes</li>
          <li>🍲 Discover traditional and modern dishes</li>
          <li>👩‍🍳 Connect with food enthusiasts</li>
          <li>📚 Save and organize your collection</li>
          <li>💡 Get cooking tips and feedback</li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Right Side -->
  <div class="w-1/2 flex items-center justify-center p-12 bg-white">
    <div class="w-full max-w-md">
      <a href="index.php" class="flex items-center gap-2 mb-8">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#2E7D32]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
        <span class="font-semibold text-2xl text-[#2E7D32]">Dapoer Nusantara</span>
      </a>

      <h1 class="text-[#333333] mb-3 text-2xl font-semibold">Create Account</h1>
      <p class="text-[#737373] text-lg mb-6">Start your culinary journey today</p>

      <?php if ($message): ?>
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4"><?= htmlspecialchars($message) ?></div>
      <?php endif; ?>

      <form method="POST" class="space-y-4">
        <div>
          <label class="block text-[#333333] mb-2">Username</label>
          <input type="text" name="username" required class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-[#2E7D32]">
        </div>

        <div>
          <label class="block text-[#333333] mb-2">Email Address</label>
          <input type="email" name="email" required class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-[#2E7D32]">
        </div>

        <div>
          <label class="block text-[#333333] mb-2">Password</label>
          <input type="password" name="password" required class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-[#2E7D32]">
        </div>

        <div>
          <label class="block text-[#333333] mb-2">Confirm Password</label>
          <input type="password" name="confirmPassword" required class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-[#2E7D32]">
        </div>

        <button type="submit" class="w-full bg-[#2E7D32] hover:bg-[#1B5E20] text-white py-3 rounded-md font-semibold transition">Create Account →</button>
      </form>

      <p class="text-[#737373] mt-6 text-center">
        Already have an account?
        <a href="login_user.php" class="text-[#2E7D32] font-semibold hover:underline">Login now</a>
      </p>
    </div>
  </div>
</body>
</html>
