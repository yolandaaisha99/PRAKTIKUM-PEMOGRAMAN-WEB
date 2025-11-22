<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    rel="stylesheet"
  />
  <title>Dapoer Nusantara | Home</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .hero {
      background: linear-gradient(135deg, #E8F5E9, #FFF8E1);
      padding: 120px 0;
      text-align: center;
    }
    .hero h1 {
      color: #2E7D32;
      font-weight: 700;
    }
    .hero p {
      color: #525252;
      font-size: 1.2rem;
    }
    .search-bar {
      max-width: 600px;
      margin: 0 auto;
      position: relative;
    }
    .search-bar input {
      padding-left: 40px;
      border: 2px solid #2E7D32;
      border-radius: 50px;
      height: 55px;
    }
    .search-bar i {
      position: absolute;
      top: 16px;
      left: 15px;
      color: #737373;
    }
    .recipe-card {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform .2s;
    }
    .recipe-card:hover {
      transform: translateY(-5px);
    }
  </style>
</head>

<body>
  <?php include 'includes/navbar.php'; ?>
  <section class="hero">
    <div class="container">
      <?php if (isset($_SESSION['id_user'])): ?>
        <h1>Welcome back, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Find your favorite Indonesian recipes 🍛</p>
      <?php else: ?>
        <h1>Welcome to Dapoer Nusantara</h1>
        <p>Discover and share delicious Indonesian recipes 🍛</p>
      <?php endif; ?>
      <form method="GET" class="search-bar mt-4">
        <i class="bi bi-search"></i>
        <input type="text" name="q" class="form-control" placeholder="Search for recipes or users..." 
          value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
      </form>
    </div>
  </section>
  <section class="py-5 flex-grow-1">
    <div class="container">
      <?php
      $search = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';
      $sql = "SELECT * FROM resep";
      if (!empty($search)) {
        $sql .= " WHERE judul LIKE '%$search%' OR penulis LIKE '%$search%'";
      }
      $result = $conn->query($sql);
      $count = $result->num_rows;

      echo "<h3 class='text-center text-success mb-4'>";
      echo !empty($search) ? "Search Results ($count)" : "Featured Recipes";
      echo "</h3>";

      if ($count > 0) {
        echo "<div class='row g-4'>";
        while ($row = $result->fetch_assoc()) {
          echo "
          <div class='col-md-4'>
            <div class='card recipe-card'>
              <img src='uploads/{$row['gambar']}' class='card-img-top' alt='{$row['judul']}'>
              <div class='card-body'>
                <h5 class='card-title text-success'>{$row['judul']}</h5>
                <p class='card-text text-muted'>by {$row['penulis']}</p>
                <a href='detail_resep.php?id={$row['id_resep']}' class='btn btn-success btn-sm'>View Recipe</a>
              </div>
            </div>
          </div>";
        }
        echo "</div>";
      } else {
        echo "<div class='text-center py-5'><p class='text-muted fs-5'>No recipes found matching \"$search\"</p></div>";
      }
      ?>
    </div> 
  </section>
  <?php include 'includes/footer.php'; ?>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"
></script>
</html>
