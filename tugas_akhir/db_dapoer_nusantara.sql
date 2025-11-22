-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Nov 2025 pada 11.08
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dapoer_nusantara`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `created_at`) VALUES
(1, 'yolanda45', '$2y$10$CUUTK15KuPwoLbseTDa36OADd.9CBXA.Db4tPXZ4jHkzYjsvqa4jK', '2025-11-09 11:03:33'),
(2, 'olaf', '$2y$10$4geTNmo1WcTggEth65eBrOyIEktz57/nCEqmu.pYtDr2PMcagvnhG', '2025-11-09 11:05:35'),
(3, 'blackcat', '$2y$10$VVc6Q7Bekgln.gW9Lmr1ve7xY1MLOgaEhAHhOR1wITWvFJv/qQV4i', '2025-11-10 11:30:47'),
(4, 'admin', '$2y$10$l5MsQwipntbkY8mFXm0Lo.ZkjJDNmAwoDX2lAlqjzh7/JG75V5tva', '2025-11-19 13:17:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_resep` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `username_komentar` varchar(255) NOT NULL,
  `isi` text DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_resep`, `id_user`, `username_komentar`, `isi`, `tanggal`) VALUES
(57, 46, 1, 'yolanda45', 'enak', '2025-11-22 05:18:57'),
(59, 46, 1, 'yolanda45', 'iyah', '2025-11-22 05:25:22'),
(62, 48, 1, 'yolanda45', 'Ini enak sekali', '2025-11-22 05:51:04'),
(63, 48, 1, 'yolanda45', 'sangat enak', '2025-11-22 06:00:26'),
(64, 49, 1, 'yolanda45', 'enak', '2025-11-22 10:27:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `id_resep` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `bahan` varchar(1000) NOT NULL,
  `cara_buat` varchar(5000) NOT NULL,
  `tanggal` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`id_resep`, `id_user`, `judul`, `penulis`, `deskripsi`, `gambar`, `bahan`, `cara_buat`, `tanggal`) VALUES
(46, 1, 'Gudeg Jogja', 'yolanda45', 'Gudeg adalah makanan khas Yogyakarta yang terkenal dengan cita rasa manis dan gurihnya, terbuat dari nangka muda (gori) yang dimasak perlahan (slow cooking) selama berjam-jam dalam santan dan gula aren. Proses memasak yang panjang ini menghasilkan tekstur nangka yang lembut dan warna coklat kemerahan yang khas, sering kali dipercepat dengan penggunaan daun jati. Makanan tradisional ini biasanya disajikan sebagai lauk pauk lengkap bersama nasi, telur pindang, ayam opor, dan sambal goreng krecek (kulit sapi rebus yang dimasak dengan cabai dan santan).', '1763784173_gudeg.jpg', 'Waktu memasak gudeg membutuhkan waktu yang cukup lama (beberapa jam) dengan api kecil agar bumbu meresap sempurna dan warnanya menjadi coklat pekat. \r\n\r\nBahan-bahan:\r\n\r\n1. Bahan Utama:\r\n   -> 1 kg nangka muda, potong-potong\r\n   -> 1 liter air kelapa\r\n   -> 2 liter santan segar (gunakan santan kental dan encer)\r\n   -> 200 gram gula aren/jawa, sisir halus (pilih yang warnanya pekat)\r\n  -> Telur rebus/pindang (opsional, sesuai selera)\r\n   -> Daun jati (opsional, untuk memberikan warna coklat alami)\r\n\r\n2. Bumbu Halus:\r\n   -> 15 butir bawang merah\r\n    -> 10 siung bawang putih\r\n    -> 10 butir kemiri sangrai\r\n   -> 1 sdm ketumbar sangrai\r\n   -> 2 sdm garam (atau secukupnya)\r\n   -> ½ sdt merica bubuk\r\n\r\n3. Bumbu Cemplung:\r\n   -> 5 lembar daun salam\r\n   -> 2 batang serai, memarkan\r\n   -> Seiris lengkuas, memarkan/geprek', '1. Siapkan Panci: Ambil panci besar atau kuali tanah liat. Susun daun salam, serai, dan lengkuas di dasar panci. Jika menggunakan daun jati, letakkan juga di dasar panci dan di sela-sela nangka muda.\r\n2. Susun Nangka: Masukkan potongan nangka muda di atas bumbu cemplung. Tambahkan telur rebus (jika pakai).\r\n3. Tambahkan Bumbu dan Cairan: Masukkan bumbu halus dan gula aren yang sudah disisir. Tuang air kelapa dan santan hingga semua bahan terendam.\r\n4. Masak dengan Teknik Slow Cooking: Tutup panci dan masak dengan api yang sangat kecil. Proses memasak ini membutuhkan waktu berjam-jam (minimal 4-5 jam) hingga nangka benar-benar empuk, bumbu meresap, dan kuah menyusut serta mengental menjadi areh.\r\n5. Periksa Rasa: Cicipi kuahnya dan tambahkan garam atau gula jika diperlukan. Gudeg Jogja cenderung memiliki rasa manis yang kuat dengan sedikit rasa gurih.\r\n6. Penyajian: Gudeg siap disajikan hangat dengan nasi putih, sambal goreng krecek, dan ayam opor atau tahu/tempe bacem. \r\n\r\nGudeg yang dimasak dengan benar (gudeg kering) dapat bertahan lebih lama karena minimnya kadar air. Selamat mencoba!', '2025-11-22'),
(48, 1, 'Sate Ayam', 'yolanda45', 'Sate ayam adalah hidangan khas Indonesia berupa potongan daging ayam yang ditusuk menggunakan tusuk sate, dimarinasi dengan bumbu sederhana, kemudian dibakar di atas bara api hingga matang, dan disajikan dengan siraman bumbu kacang yang kaya rasa, gurih, serta sedikit manis, seringkali ditemani oleh lontong, irisan bawang merah, dan perasan jeruk limau.', '1763786440_sateayam.jpeg', 'Bahan-bahan\r\n\r\n1. Bahan Sate:\r\n   -> 500 gr daging ayam fillet (dada/paha), potong dadu\r\n   -> Tusuk sate, rendam dalam air agar tidak mudah gosong saat dibakar \r\n\r\n2. Bumbu Marinasi Ayam:\r\n   -> 2 siung bawang putih, haluskan\r\n   -> 1 sdt ketumbar bubuk\r\n   -> 1 sdm kecap manis\r\n   -> 1/2 sdt garam\r\n   -> 1/4 sdt merica bubuk\r\n   -> Sedikit air jeruk nipis (opsional) \r\n\r\n3. Bahan Bumbu Kacang:\r\n   -> 150 gr kacang tanah, goreng\r\n   -> 3 siung bawang putih\r\n   -> 3 buah cabai rawit (sesuai selera)\r\n   -> 50 gr gula merah (gula aren), serut\r\n   -> 3 lembar daun jeruk, buang tulangnya\r\n   -> 2 sdm air asam jawa\r\n   -> 1 sdt garam\r\n   -> 400 ml air panas mendidih\r\n   -> Minyak untuk menumis (opsional) \r\n\r\n4. Bahan Olesan saat Membakar:\r\n   -> 2 sdm bumbu kacang yang sudah jadi\r\n   -> 2 sdm kecap manis\r\n   -> 1 sdm air \r\n\r\n5. Bahan Pelengkap:\r\n   -> Lontong atau nasi putih\r\n   -> Irisan bawang merah mentah\r\n   -> Irisan cabai rawit\r\n   -> Jeruk limau\r\n   -> Kecap manis ', '1. Marinasi Ayam:\r\n   -> Campurkan potongan daging ayam dengan semua bahan bumbu marinasi. Aduk rata.\r\n   -> Diamkan di kulkas minimal 30 menit agar bumbu meresap sempurna. \r\n\r\n2. Membuat Bumbu Kacang:\r\n   -> Goreng kacang tanah, bawang putih, dan cabai rawit (jika menggunakan cabai segar).\r\n   -> Haluskan bahan-bahan yang sudah digoreng bersama gula merah, daun jeruk, garam, dan air asam jawa menggunakan blender atau ulekan.\r\n   -> Tambahkan air panas sedikit demi sedikit sambil dihaluskan hingga mencapai kekentalan yang diinginkan.\r\n   -> (Opsional) Tumis bumbu kacang sebentar dengan sedikit minyak agar lebih awet dan aromanya keluar.\r\n \r\n3. Menusuk Sate:\r\n   -> Ambil 3-4 potong daging ayam yang sudah dimarinasi, lalu tusuk dengan tusuk sate.    Lakukan hingga daging habis. \r\n\r\n4. Membakar Sate:\r\n   -> Siapkan panggangan atau teflon. Panaskan.\r\n   -> Campurkan bahan olesan sate.\r\n   -> Bakar sate di atas panggangan, bolak-balik sambil sesekali diolesi dengan campuran bumbu olesan hingga matang dan ada sedikit bekas bakaran. \r\n\r\n5. Penyajian:\r\n   -> Letakkan beberapa tusuk sate di piring saji.\r\n   -> Siram dengan bumbu kacang yang lezat.\r\n   -> Tambahkan irisan bawang merah mentah dan perasan jeruk limau.\r\n   -> Sajikan bersama lontong, nasi, dan kecap manis. \r\n\r\nSelamat mencoba!', '2025-11-22'),
(49, 1, 'Rendang', 'yolanda45', 'Rendang adalah hidangan daging sapi khas dari Minangkabau, Sumatera Barat, yang terkenal di seluruh dunia karena kelezatannya. Proses memasak rendang sangat unik dan memakan waktu berjam-jam (sekitar empat hingga lima jam) dengan menggunakan santan kelapa dan campuran rempah-rempah yang kaya, dimasak perlahan hingga semua cairan menguap dan bumbu meresap sempurna ke dalam daging. Hasil akhirnya adalah daging yang empuk dengan bumbu kering berwarna cokelat gelap atau kehitaman, yang tidak hanya lezat tetapi juga memiliki masa simpan yang lama secara alami berkat proses karamelisasi dan minimnya kadar air.', '1763802179_rendang.jpg', 'Resep Rendang Daging Sapi Khas Padang \r\nWaktu persiapan: 30 menit\r\nWaktu memasak: 4-5 jam (dengan api kecil)\r\nPorsi: 6-8 porsi \r\n\r\nBahan-bahan\r\n\r\n1. Bahan Utama:\r\n   -> 1 kg daging sapi has dalam, potong-potong sesuai selera\r\n   -> 2-3 liter santan kelapa (gunakan santan kental dan encer dari sekitar 3-4 butir kelapa tua)\r\n   -> 100-150 gram kelapa parut, sangrai hingga kecokelatan (opsional, untuk warna rendang yang lebih gelap) \r\n\r\n2. Bumbu Halus:\r\n   -> 10-15 buah cabai merah keriting (sesuai selera)\r\n   -> 7-10 siung bawang merah\r\n   -> 5 siung bawang putih\r\n   -> 4 butir kemiri, sangrai\r\n   -> 1 ruas jahe\r\n   -> 1 ruas lengkuas\r\n   -> 1 ruas kunyit\r\n   -> 1 sdt ketumbar bubuk\r\n   -> 1/2 sdt merica butiran\r\n   -> 1/2 sdt jintan\r\n   -> Garam secukupnya \r\n   -> Bumbu Aromatik (Bumbu Cemplung):\r\n   -> 2 batang serai, memarkan\r\n   -> 1 lembar daun kunyit, ikat simpul atau sobek-sobek\r\n   -> 4-5 lembar daun jeruk, buang tulang daunnya\r\n   -> 2 lembar daun salam\r\n   -> 2-3 keping asam ka', '1. Siapkan Bumbu: Haluskan semua bahan bumbu halus menggunakan blender atau ulekan. Jika menggunakan blender, tambahkan sedikit minyak goreng atau air untuk mempermudah proses.\r\n2. Masak Santan dan Bumbu: Tuang santan kental dan santan encer ke dalam wajan besar. Masukkan bumbu halus dan semua bumbu aromatik (serai, daun kunyit, daun jeruk, daun salam, asam kandis, dll).\r\n3. Proses Awal (Gulai): Masak campuran santan dan bumbu dengan api sedang sambil diaduk perlahan hingga mendidih dan santan mulai mengental serta berminyak (proses ini penting agar santan tidak pecah).\r\n4. Masukkan Daging: Masukkan potongan daging sapi ke dalam wajan. Aduk rata dan pastikan semua daging terendam dalam kuah santan.\r\n5. Proses Pemasakan (Kalio): Terus masak dengan api kecil. Aduk sesekali, jangan terlalu sering diaduk agar daging tidak hancur. Masak terus hingga kuah menyusut, mengental, dan warnanya berubah menjadi cokelat kemerahan (proses ini disebut menjadi kalio).\r\n6. Menjadi Rendang: Setelah kuah benar-benar menyusut dan berminyak, kecilkan api sekecil mungkin. 7. Terus aduk perlahan dan hati-hati hingga bumbu mengering dan warnanya berubah menjadi cokelat tua kehitaman, serta minyak kelapa (blondo) keluar. Proses ini bisa memakan waktu total 4-5 jam.\r\n8. Tambahkan Kelapa Sangrai (Opsional): Jika menggunakan kelapa parut sangrai, masukkan saat rendang sudah mulai mengering untuk memberikan warna yang lebih pekat dan rasa gurih ekstra. Aduk rata.\r\n9. Penyelesaian: Cicipi rasa dan tambahkan garam jika diperlukan. Rendang siap disajikan. \r\n\r\nSelamat mencoba!', '2025-11-22'),
(50, 1, 'Gulai Umbut Kelapa', 'yolanda45', 'Gulai umbut kelapa adalah hidangan tradisional khas Nusantara yang menawarkan cita rasa unik dan kaya rempah. Bahan utamanya adalah bagian tunas muda dari pohon kelapa yang masih empuk dan berwarna putih, dimasak dalam kuah santan kental yang gurih. Ciri khas masakan ini terletak pada perpaduan tekstur umbut kelapa yang lembut dengan bumbu gulai yang kaya, seperti kunyit, jahe, ketumbar, dan cabai, seringkali ditambahkan bahan pelengkap lain seperti udang, daging sapi, atau rebung untuk menambah kekayaan rasa. Hidangan ini populer di berbagai daerah, terutama Sumatera dan Kalimantan, dan sering disajikan sebagai lauk utama yang lezat saat makan bersama keluarga atau di acara-acara istimewa.', '1763802506_636dacc350729.jpg', '-> 500 gr umbut kelapa muda, potong dadu\r\n   -> 1.2 liter santan sedang\r\n   -> 200 gr udang kupas (opsional)\r\n   -> 2 lembar daun salam\r\n   -> 1 batang serai, memarkan\r\n   -> 1 ruas lengkuas, memarkan\r\n   -> Garam, gula, dan penyedap rasa secukupnya\r\n   -> Minyak untuk menumis \r\n\r\nBumbu Halus:\r\n   -> 8 siung bawang merah\r\n   -> 4 siung bawang putih\r\n   -> 5 butir kemiri, sangrai\r\n   -> 10-15 buah cabai merah keriting (sesuai selera)\r\n   -> 1 ruas kunyit, bakar\r\n   -> 1 ruas jahe\r\n   -> 1 sdt ketumbar bubuk\r\n   -> Terasi bakar secukupnya (opsional)', '1. Rebus Umbut Kelapa: Rebus umbut kelapa yang sudah dipotong dalam air mendidih selama kurang lebih 20-30 menit atau hingga empuk, tetapi jangan terlalu lembek. Tiriskan.\r\n2. Haluskan Bumbu: Haluskan semua bahan \"Bumbu Halus\" menggunakan blender atau ulekan hingga menjadi pasta halus.\r\n3. Tumis Bumbu: Panaskan sedikit minyak di wajan. Tumis bumbu halus, daun salam, serai, dan lengkuas hingga harum dan matang.\r\n4. Masak Udang (Opsional): Masukkan udang kupas dan tumis hingga berubah warna dan matang.\r\nTambahkan Umbut dan Santan: Masukkan umbut kelapa yang sudah direbus ke dalam tumisan bumbu. Aduk rata. Tuangkan santan sedang dan masak dengan api sedang.\r\n5. Bumbui Gulai: Tambahkan garam, gula, dan penyedap rasa secukupnya. Aduk perlahan secara konsisten agar santan tidak \"pecah\".\r\n6. Sajikan: Masak hingga semua bahan matang merata, bumbu meresap, dan kuah mendidih. Cicipi dan koreksi rasa sesuai selera. Gulai umbut kelapa siap disajikan hangat dengan nasi putih.\r\n\r\nSelamat mencoba!', '2025-11-22'),
(51, 1, 'Coto Makassar', 'yolanda45', 'Coto Makassar adalah hidangan berkuah tradisional khas suku Makassar di Sulawesi Selatan, Indonesia, yang terkenal akan kuahnya yang kental, gurih, dan kaya rempah, berkat penggunaan bahan-bahan unik seperti air cucian beras (air tajin) dan kacang tanah sangrai yang dihaluskan. Secara historis, hidangan ini merupakan kuliner kerajaan yang berisi potongan daging dan jeroan sapi (biasanya babat, hati, paru, dan jantung), dimasak perlahan bersama racikan 40 jenis rempah lokal yang dikenal sebagai Rampa Patang Pulo. Coto Makassar otentik selalu disajikan panas-panas dalam mangkuk, dinikmati bersama ketupat atau buras (lontong khas Makassar), serta pelengkap wajib berupa sambal tauco dan perasan jeruk nipis.', '1763802806_65f6c7ff27351.jpg', '-> 500 gr daging sapi (sandung lamur/has dalam)\r\n   -> 200 gr jeroan sapi (paru, hati, jantung, babat, usus), rebus dan potong dadu\r\n   -> 2 liter air cucian beras (air tajin) atau air biasa\r\n   -> 50 gr kacang tanah, goreng dan haluskan \r\n\r\nBumbu Halus (Rampa Patang Pulo):\r\n   -> 8 siung bawang merah\r\n   -> 5 siung bawang putih\r\n   -> 4 butir kemiri sangrai\r\n   -> 1 sdm ketumbar bubuk\r\n   -> 1/2 sdm jintan bubuk\r\n   -> 1/4 sdm lada hitam bubuk\r\n    -> 3 cm jahe\r\n   -> 3 cm lengkuas\r\n   -> 1/2 sdt pala bubuk\r\n   -> 1/4 sdt cengkeh bubuk (atau 2-3 butir cengkeh utuh)\r\n   -> Garam dan gula merah secukupnya \r\n\r\nBumbu Aromatik:\r\n   -> 2 batang serai, memarkan\r\n   -> 2 lembar daun salam\r\n   -> 3 lembar daun jeruk\r\n   -> 2 cm kayu manis\r\n   -> Minyak untuk menumis \r\n\r\nPelengkap:\r\n   -> Bawang goreng (untuk taburan)\r\n   -> Daun bawang dan seledri iris halus\r\n   -> Irisan jeruk nipis\r\n   -> Sambal tauco (khas Coto Makassar)\r\n   -> Ketupat atau buras', '1. Rebus Daging & Jeroan: Rebus daging sapi hingga empuk, buang air rebusan pertama untuk menghilangkan kotoran. Rebus kembali dengan air cucian beras (atau air bersih) hingga mendidih. Masukkan jeroan yang sudah direbus terpisah sebelumnya.\r\n2. Siapkan Bumbu: Haluskan semua bahan \"Bumbu Halus\" menggunakan blender atau ulekan hingga benar-benar halus.\r\n3. Tumis Bumbu: Panaskan sedikit minyak, tumis bumbu halus bersama serai, daun salam, daun jeruk, dan kayu manis hingga harum dan matang.\r\n4. Masak Kuah: Masukkan bumbu tumis ke dalam rebusan daging dan jeroan. Tambahkan kacang tanah goreng yang sudah dihaluskan. Aduk rata.\r\n5. Bumbui: Masak dengan api kecil selama sekitar 30 menit agar bumbu meresap dan kuah mengental. Tambahkan garam dan gula merah secukupnya, koreksi rasa.\r\n6. Sajikan: Siapkan mangkuk, tata potongan daging dan jeroan. Siram dengan kuah panas Coto Makassar. Taburi dengan bawang goreng, daun bawang, dan seledri iris. Sajikan bersama jeruk nipis, sambal tauco, dan ketupat/buras.\r\n\r\nSelamat mencoba!', '2025-11-22'),
(52, 1, 'Papeda Papua dan Ikan Kuah Kuning', 'yolanda45', 'Papeda adalah makanan pokok khas dari Indonesia bagian timur (khususnya Papua dan Maluku) berupa bubur atau adonan kenyal yang terbuat dari tepung sagu, berwarna putih bening, dan memiliki tekstur unik yang lengket mirip lem. Rasanya cenderung hambar sehingga selalu disajikan bersama lauk pendamping berkuah yang kaya rasa, paling populer adalah ikan kuah kuning yang bercita rasa gurih, asam segar, dan pedas, sering kali ditambahi daun kemangi untuk aroma khas.', '1763803113_20230711170714000000papedaikankuning3594887241.jpg', 'Papeda : \r\n   -> 250 gr tepung sagu (tepung tapioka juga bisa digunakan sebagai alternatif)\r\n   -> 500 ml air suhu ruang\r\n   -> 1 liter air mendidih\r\n   -> Sedikit garam (opsional) \r\n\r\nIkan Kuah Kuning :\r\n   -> 500 gr ikan segar (ikan kakap, ikan tenggiri, atau ikan gabus direkomendasikan)\r\n   -> 1 buah tomat, potong-potong\r\n   -> 1 ikat daun kemangi\r\n   -> 1 batang serai, geprek\r\n   -> 3 cm lengkuas, geprek\r\n   -> 2 lembar daun salam\r\n   -> 5 lembar daun jeruk, buang tulang daunnya\r\n   -> 1 sdm air asam jawa\r\n   -> Garam, gula, dan kaldu bubuk secukupnya\r\n   -> Air secukupnya untuk kuah \r\n\r\nBumbu Halus Kuah Kuning :\r\n   -> 5 siung bawang merah\r\n   -> 3 siung bawang putih\r\n   -> 5 cm kunyit\r\n   -> 3 cm jahe\r\n   -> Cabai merah atau rawit sesuai selera', 'Papeda :\r\n\r\n1. Larutkan sagu: Campurkan tepung sagu dan air suhu ruang dalam wadah, aduk rata.\r\n2. Seduh: Didihkan 1 liter air. Setelah mendidih, tuang air mendidih tersebut ke dalam larutan sagu sambil terus diaduk cepat hingga adonan mengental dan berubah warna menjadi bening dan lengket.\r\n3. Tambahkan garam: Masukkan sedikit garam dan aduk kembali hingga merata.\r\n \r\nIkan Kuah Kuning :\r\n1. Tumis bumbu: Haluskan semua bahan bumbu halus. Tumis bumbu halus bersama serai, lengkuas, daun salam, dan daun jeruk hingga harum dan matang.\r\n2. Masak kuah: Tambahkan air secukupnya dan air asam jawa. Masak hingga mendidih.\r\n3. Masak ikan: Masukkan potongan ikan, garam, gula, dan kaldu bubuk. Masak hingga ikan matang dan bumbu meresap. Jangan terlalu sering diaduk agar ikan tidak hancur.\r\n4. Sentuhan akhir: Masukkan potongan tomat dan daun kemangi, aduk sebentar, lalu matikan api. \r\n\r\nPenyajian :\r\nSajikan papeda yang masih panas dalam mangkuk. Tuangkan ikan kuah kuning dengan potongan ikan di atas papeda. Untuk menyantapnya, gunakan dua garpu atau sumpit, gulung-gulung papeda hingga membentuk gumpalan, lalu siram dengan kuah ikan kuning yang melimpah.', '2025-11-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'yolanda45', 'yolanda45@gmail.com', '$2y$10$GZ/yzXV8Cpxr6Ndvnngb8u654PrxGM3c/mIi./S1AOQ2xBRyu5wK.', '2025-11-09 10:40:32'),
(3, 'yolanda99', 'yolanda89@gmail.com', '$2y$10$af3ZJ78EEskdVC/DFKRp/Ohj9xV.G/dWY1iNuQ8GpjDW7IevB9hd.', '2025-11-19 13:03:31');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `komentar_ibfk_1` (`id_resep`),
  ADD KEY `komentar_ibfk_2` (`id_user`);

--
-- Indeks untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id_resep`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `resep`
--
ALTER TABLE `resep`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep` (`id_resep`) ON DELETE CASCADE,
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `fk_user_resep` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
