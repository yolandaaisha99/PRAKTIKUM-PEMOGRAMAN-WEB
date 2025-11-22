<?php
session_start();
include 'koneksi.php';

$message = "";

if (!isset($_SESSION['id_user']) && !isset($_SESSION['admin_name'])) {
    header("Location: login_user.php");
    exit();
}

$isAdmin = isset($_SESSION['admin_name']);

if ($isAdmin) {
    $username = $_SESSION['admin_name'] . " (Admin)";
} else {
    $username = $_SESSION['username'];
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID resep tidak ditemukan!");
}

$id_resep = $_GET['id'];

$sql = "SELECT * FROM resep WHERE id_resep = '$id_resep'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Resep tidak ditemukan!");
}

$data = mysqli_fetch_assoc($result);

if (!$isAdmin && $data['id_user'] != $_SESSION['id_user']) {
    die("❌ Kamu tidak punya izin mengedit resep ini!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title       = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
    $steps       = mysqli_real_escape_string($conn, $_POST['steps']);

    $newImage = $data['gambar'];

    if (!empty($_FILES['image']['name'])) {
        $imgName = time() . "_" . $_FILES['image']['name'];
        $tmpPath = $_FILES['image']['tmp_name'];

        if (move_uploaded_file($tmpPath, "uploads/" . $imgName)) {
            $newImage = $imgName;
        }
    }

    $updateQuery = "
        UPDATE resep SET 
            judul      = '$title',
            deskripsi  = '$description',
            bahan      = '$ingredients',
            cara_buat  = '$steps',
            gambar     = '$newImage'
        WHERE id_resep = '$id_resep'
    ";

    if (mysqli_query($conn, $updateQuery)) {

        if ($isAdmin) {
            header("Location: kelola_resep.php");
        } else {
            header("Location: detail_resep.php?id=" . $id_resep);
        }
        exit();
    } else {
        $message = "❌ Gagal mengupdate resep: " . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Recipe | Dapoer Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex flex-col bg-gray-100">

    <nav class="bg-white shadow px-8 py-4 flex justify-between items-center">
        <a href="<?= $isAdmin ? 'kelola_resep.php' : 'index.php' ?>" class="text-green-700 font-bold text-xl">Dapoer Nusantara</a>
        <div class="flex items-center gap-4">
            <span class="text-gray-600">👋 <?= htmlspecialchars($username) ?></span>
            <a href="logout.php" class="text-red-600 font-semibold hover:underline">Logout</a>
        </div>
    </nav>

    <main class="flex-1 p-8">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg">

            <h1 class="text-2xl text-green-700 font-semibold mb-6">Edit Recipe</h1>

            <?php if (!empty($message)): ?>
                <div class="mb-4 p-3 bg-yellow-100 text-yellow-800 rounded">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" class="space-y-6">

                <div>
                    <label class="block mb-2 font-medium">Recipe Title</label>
                    <input type="text" name="title" required
                        value="<?= htmlspecialchars($data['judul']) ?>"
                        class="w-full border p-3 rounded-md" />
                </div>

                <div>
                    <label class="block mb-2 font-medium">Short Description</label>
                    <textarea name="description" required 
                        class="w-full border p-3 rounded-md min-h-[80px]"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Ingredients</label>
                    <textarea name="ingredients" required 
                        class="w-full border p-3 rounded-md min-h-[150px]"><?= htmlspecialchars($data['bahan']) ?></textarea>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Cooking Steps</label>
                    <textarea name="steps" required 
                        class="w-full border p-3 rounded-md min-h-[200px]"><?= htmlspecialchars($data['cara_buat']) ?></textarea>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Current Image</label>
                    <img src="uploads/<?= $data['gambar'] ?>" class="w-48 rounded shadow mb-3">

                    <label class="block font-medium mb-2">Change Image (Optional)</label>
                    <input type="file" name="image" accept="image/*" class="border p-3 rounded-md w-full">
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit"
                        class="flex-1 bg-green-700 text-white py-3 rounded-md font-semibold hover:bg-green-800">
                        Save Changes
                    </button>

                    <?php if ($isAdmin): ?>
                        <a href="kelola_resep.php"
                            class="flex-1 text-center border text-gray-700 py-3 rounded-md font-semibold hover:bg-gray-100">
                            Cancel
                        </a>
                    <?php else: ?>
                        <a href="detail_resep.php?id=<?= $id_resep ?>"
                            class="flex-1 text-center border text-gray-700 py-3 rounded-md font-semibold hover:bg-gray-100">
                            Cancel
                        </a>
                    <?php endif; ?>
                </div>

            </form>
        </div>
    </main>

</body>
</html>
