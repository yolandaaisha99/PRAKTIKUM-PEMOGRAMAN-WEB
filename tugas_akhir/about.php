<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Dapoer Nusantara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .hero {
            background: linear-gradient(to bottom right, #E8F5E9, #FFFFFF, #FFF8E1);
            padding: 80px 0;
            text-align: center;
        }
        .hero-icon {
            background: white;
            border-radius: 50%;
            padding: 30px;
            display: inline-block;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .mission-card:hover {
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        .team-member:hover {
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        .cta {
            background: linear-gradient(to bottom right, #2E7D32, #1B5E20);
            color: white;
            padding: 80px 0;
            text-align: center;
        }
    </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>

<section class="hero">
    <div class="container">
        <div class="hero-icon">
            <img src="assets/img/pngegg.png" alt="Leaf Icon" width="64">
        </div>
        <h1 class="text-success mb-4">About Dapoer Nusantara</h1>
        <p class="lead text-secondary">Sebuah komunitas bagi para pecinta makanan untuk berbagi, menemukan, dan melestarikan budaya kuliner Indonesia yang kaya.</p>
    </div>
</section>
<section class="py-5 bg-white">
    <div class="container">
        <div class="rounded-3 overflow-hidden shadow-lg">
            <img src="assets/img/rempah.jpg" alt="rempah-rempah" class="img-fluid d-block mx-auto">
        </div>
    </div>
</section>
<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center text-success mb-5">Our Mission</h2>
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="bg-light rounded-3 p-4 mission-card">
                    <div class="mb-3 d-inline-block p-3 rounded-circle bg-success text-white">
                        ❤️
                    </div>
                    <h5>Passion terhadap Makanan</h5>
                    <p>Kami merayakan warisan kuliner Indonesia yang kaya dan beragam dengan cinta dan keaslian.</p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="bg-light rounded-3 p-4 mission-card">
                    <div class="mb-3 d-inline-block p-3 rounded-circle bg-success text-white">
                        👥
                    </div>
                    <h5>Komunitas Utama</h5>
                    <p>Membangun komunitas yang mendukung di mana para pecinta makanan dapat terhubung, berbagi, dan saling menginspirasi.</p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="bg-light rounded-3 p-4 mission-card">
                    <div class="mb-3 d-inline-block p-3 rounded-circle bg-success text-white">
                        🌏
                    </div>
                    <h5>Pelestarian Budaya</h5>
                    <p>Melestarikan resep tradisional sambil mengadopsi teknik memasak modern dan inovasi.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5 bg-success bg-opacity-10">
    <div class="container">
        <h2 class="text-center text-success mb-4">Our Story</h2>
        <div class="bg-white p-4 rounded-3 shadow-sm">
            <p>Dapoer Nusantara lahir dari ide sederhana: menciptakan sebuah rumah digital di mana para pecinta kuliner Indonesia dapat berkumpul untuk merayakan, berbagi, dan melestarikan tradisi kuliner kita yang luar biasa.</p>
            <p>Dari rempah-rempah aromatik rendang Padang hingga kompleksitas manis gudeg Jawa, masakan Indonesia selengkap kepulauan kami sendiri. Kami percaya resep-resep ini menceritakan kisah tentang budaya, keluarga, dan warisan kami.</p>
            <p>Apakah Anda seorang koki rumahan yang berbagi resep rahasia nenek, seorang koki profesional yang berinovasi dengan cita rasa tradisional, atau seseorang yang baru memulai perjalanan kuliner, Dapoer Nusantara menyambut Anda di dapur kami.</p>
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center text-success mb-5">Meet the Team</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4 text-center">
                <div class="team-member p-4 rounded-3 shadow-sm">
                    <img src="assets/img/yolanda.jpg" alt="yolanda" class="rounded-circle mb-3" width="120" height="120">
                    <h5>Yolanda Aisha HS  | 123210182 </h5>
                    <p class="text-warning">Founder & Developer</p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="team-member p-4 rounded-3 shadow-sm">
                    <img src="assets/img/zhaky.jpg" alt="zhaky" class="rounded-circle mb-3" width="120" height="120">
                    <h5>Zhaky Mahardika  | 123240044</h5>
                    <p class="text-warning">Founder & Developer</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="cta">
    <div class="container">
        <p class="lead mb-4 opacity-90">Mulailah membagikan resep favorit Anda dan temukan harta kuliner baru dari seluruh Indonesia.</p>
        <a href="index.php" class="btn btn-light btn-lg text-success">Browse Recipes</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
