<?php
include('koneksi.php');
session_start();
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID resep tidak ditemukan!";
    exit;
}

$id_resep = $_GET['id'];
$query = "SELECT resep.*, user.username AS penulis 
          FROM resep 
          JOIN user ON user.id_user = resep.id_user
          WHERE resep.id_resep = '$id_resep'";

$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "
        <div style='padding:20px; font-family:Arial'>
            <h2>Resep tidak ditemukan!</h2>
            <a href='index.php'>← Kembali ke Home</a>
        </div>
    ";
    exit;
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $data['judul']; ?> - Dapoer Nusantara</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <a href="index.php" class="btn btn-success mb-3">← Back to Home</a>
    <div class="card mb-4">
        <img src="uploads/<?php echo $data['gambar']; ?>" class="card-img-top" alt="<?php echo $data['judul']; ?>">
        <div class="card-body">
            <h2 class="card-title text-success"><?php echo $data['judul']; ?></h2>
            <p class="text-muted">by <?php echo $data['penulis']; ?></p>
            <h5>Description</h5>
            <p><?php echo nl2br($data['deskripsi']); ?></p>
            <h5>Ingredients</h5>
            <p><?php echo nl2br($data['bahan']); ?></p>
            <h5>Steps</h5>
            <p><?php echo nl2br($data['cara_buat']); ?></p>
        </div>
    </div>
    <h4 class="text-success">Comments</h4>

    <?php
    $comments = mysqli_query($conn, 
        "SELECT komentar.*, user.username 
         FROM komentar
         JOIN user ON user.id_user = komentar.id_user
         WHERE komentar.id_resep = '$id_resep'
         ORDER BY komentar.tanggal DESC"
    );

    if (mysqli_num_rows($comments) > 0) {
        while ($c = mysqli_fetch_assoc($comments)) {
            echo "
            <div class='card mb-2'>
                <div class='card-body'>
                    <strong>{$c['username']}</strong>
                    <p class='mb-0'>{$c['isi']}</p>
                    <small class='text-muted'>{$c['tanggal']}</small>
                </div>
            </div>";
        }
    } else {
        echo "<p class='text-muted'>No comments yet. Be the first to comment!</p>";
    }
    ?>

    <div class="mt-4">
        <h5>Add a Comment</h5>
        <form method="POST" action="tambah_komentar.php">
            <input type="hidden" name="id_resep" value="<?php echo $id_resep; ?>">
            <div class="mb-3">
                <textarea class="form-control" name="isi" rows="3" placeholder="Write your comment..." required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
