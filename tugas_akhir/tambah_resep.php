<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login_user.php");
    exit();
}

$id_user = $_SESSION['id_user'];
$username = $_SESSION['username'] ?? 'user';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $judul = trim($_POST['title']);
  $deskripsi = trim($_POST['description']);
  $bahan = trim($_POST['ingredients']);
  $cara_buat = trim($_POST['steps']);
  $penulis = $username;
  $imagePath = null;

  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

    $targetDir = "uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    $fileName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($imageFileType, $allowedTypes)) {

      if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $imagePath = $fileName;
      } else {
        $message = "❌ Failed to upload image.";
      }

    } else {
      $message = "❌ Only JPG, JPEG, PNG, GIF allowed.";
    }
  }

  if (empty($message)) {

    $stmt = $conn->prepare("
      INSERT INTO resep (id_user, judul, penulis, deskripsi, gambar, bahan, cara_buat, tanggal)
      VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
    ");

    $stmt->bind_param("issssss", $id_user, $judul, $penulis, $deskripsi, $imagePath, $bahan, $cara_buat);

    if ($stmt->execute()) {
      header("Location: dashboard_user.php?success=1");
      exit;
    } else {
      $message = "❌ Failed to save recipe.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Recipe | Dapoer Nusantara</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .upload-box {
      border: 2px dashed #ccc;
      padding: 40px;
      border-radius: 10px;
      text-align: center;
      cursor: pointer;
      transition: .3s;
    }
    .upload-box:hover {
      border-color: #2E7D32;
    }
  </style>
</head>
<body class="bg-light min-vh-100 d-flex flex-column">
  <nav class="navbar navbar-expand-lg bg-white shadow-sm px-4 py-3">
    <a class="navbar-brand text-success fw-bold" href="../index.php">Dapoer Nusantara</a>
    <div class="ms-auto d-flex align-items-center gap-3">
      <span class="text-muted">👋 <?= htmlspecialchars($username) ?></span>
      <a href="../logout.php" class="text-danger fw-semibold text-decoration-none">Logout</a>
    </div>
  </nav>

  <main class="container my-5 flex-grow-1">
    <div class="col-lg-8 mx-auto bg-white p-5 rounded-4 shadow">
      <h2 class="text-success fw-semibold mb-4">Add New Recipe</h2>

      <?php if ($message): ?>
        <div class="alert alert-warning"><?= htmlspecialchars($message) ?></div>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label fw-semibold">Recipe Title</label>
          <input type="text" name="title" class="form-control" required placeholder="e.g., Nasi Goreng Kampung">
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Short Description</label>
          <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Ingredients</label>
          <textarea name="ingredients" class="form-control" rows="6" required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Cooking Steps</label>
          <textarea name="steps" class="form-control" rows="7" required></textarea>
        </div>
        <div class="mb-4">
          <label class="form-label fw-semibold">Recipe Image</label>
          <label class="upload-box w-100">
            <div class="text-secondary">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" stroke="gray" fill="none" stroke-width="2">
                <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <p class="mt-2">Click to upload image</p>
            </div>
            <input type="file" name="image" accept="image/*" class="d-none" required>
          </label>
        </div>
        <div class="d-flex gap-3">
          <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">Save Recipe</button>
          <a href="dashboard_user.php" class="btn btn-outline-secondary w-100 py-2 fw-semibold">Cancel</a>
        </div>
      </form>
    </div>
  </main>
  <footer class="text-center py-3 text-muted border-top">
    © <?= date('Y') ?> Dapoer Nusantara — All rights reserved.
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
