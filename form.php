<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="judul">
    <h1>Buat Website</h1>
  </div>

  <ul class="menu">
    <li><a href="index.html">Home</a></li>
    <li><a href="form.html">Profil</a></li>
    <li><a href="aksi.php">Aksi</a></li>
  </ul>

  <section class="konten-utama">
    <h2 class="mb-4">Formulir Pendaftaran Penggemar</h2>

    <form action="aksi.php" method="post" class="needs-validation" novalidate>
      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" name="nama" required>
        <div class="invalid-feedback">Nama wajib diisi!</div>
      </div>

      <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label><br>
        <div class="form-check form-check-inline">
          <input type="radio" class="form-check-input" name="gender" value="Laki-laki" required>
          <label class="form-check-label">Laki-laki</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" class="form-check-input" name="gender" value="Perempuan" required>
          <label class="form-check-label">Perempuan</label>
        </div>
        <div class="invalid-feedback">Pilih salah satu gender.</div>
      </div>

      <div class="mb-3">
        <label class="form-label">Nama Grup KPOP yang disukai</label>
        <select class="form-select" name="bias" required>
          <option selected disabled value="">Pilih</option>
          <option value="1">Stray Kids (Bangchan)</option>
          <option value="2">Stray Kids (Hyunjin)</option>
          <option value="3">ATEEZ (San)</option>
          <option value="4">TXT (Yeonjun)</option>
          <option value="5">Aespa (Karina)</option>
          <option value="6">Le Sserafim (Kazuha)</option>
          <option value="7">IVE (Wonyoung)</option>
          <option value="8">NewJeans (Hanni)</option>
          <option value="9">NCT (Taeyong)</option>
          <option value="10">Treasure (Asahi)</option>
          <option value="11">Enhypen (Jay)</option>
          <option value="12">RIIZE (Woobin)</option>
          <option value="13">ITZY (Yeji)</option>
          <option value="14">(G)-IDLE (Soyeon)</option>
          <option value="15">Everglow (Mia)</option>
          <option value="16">STAYC (Sieun)</option>
          <option value="17">NMIXX (Sullyon)</option>
          <option value="18">Weekly (Jihan)</option>
          <option value="19">Billlie (Tsuki)</option>
          <option value="20">Purple Kiss (Goeun)</option>
          <option value="21">CRAVITY (Serim)</option>
          <option value="22">EPEX (Jeff)</option>
        </select>
        <div class="invalid-feedback">Harap pilih bias favorit.</div>
      </div>

      <div class="mb-3">
        <label class="form-label">Aktivitas favorit sebagai fans</label><br>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="aktivitas[]" value="Streaming lagu">
          <label class="form-check-label">Streaming lagu</label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="aktivitas[]" value="Vote di acara musik">
          <label class="form-check-label">Vote di acara musik</label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="aktivitas[]" value="Mengoleksi album">
          <label class="form-check-label">Mengoleksi album</label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="aktivitas[]" value="Ikut fan project">
          <label class="form-check-label">Ikut fan project</label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="aktivitas[]" value="Datang ke konser">
          <label class="form-check-label">Datang ke konser</label>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Pesan</label>
        <textarea class="form-control" name="pesan" rows="4"></textarea>
      </div>

      <button type="submit" class="btn btn-dark">Kirim</button>
    </form>
  </section>

  <footer>
    <small>Copyright &copy; Yolanda Aisha Hs | 123210182</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

 <script>
    (() => {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>
</body>
</html>
