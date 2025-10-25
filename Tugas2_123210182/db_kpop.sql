CREATE DATABASE db_kpop;

USE db_kpop;

CREATE TABLE fans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  gender VARCHAR(20),
  bias INT(100),
  kegiatan VARCHAR(100),
  pesan TEXT
);

CREATE TABLE idol (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  grup VARCHAR(100),
  posisi VARCHAR(50)
  posisi2 VARCHAR(50)
);

INSERT INTO idol (nama, grup, posisi, posisi2) VALUES
('Bang Chan', 'Stray Kids', 'Leader, Producer'),
('Hyunjin', 'Stray Kids', 'Main Dancer', 'Sub Rapper')
('San', 'ATEEZ' 'Lead Vocalist', 'Main Dancer'),
('Yeonjun', 'TXT', 'Raper', 'Dancer'),
('Asahi', 'Treasure', 'Vocalist', 'Visual'),
('Jay', 'Enhypen', 'Lead Dancer', 'Rapper'),
('Serim', 'CRAVITY', 'Leader', 'Main Rapper'),
('Jeff', 'EPEX', 'Main Rapper', 'Vocalist'),
('Woobin', 'RIIZE', 'Guitarist', 'Vocalist'),
('Taeyong', 'NCT', 'Leader', 'Main Rapper'),
('Yeji', 'ITZY', 'Leader', 'Main Dancer'),
('Sullyon', 'NMIXX', 'Lead Vocalist', 'Visual'),
('Karina', 'Aespa', 'Leader', 'Main Dancer'),
('Kazuha', 'Le Sserafim', 'Lead Dancer', 'Vocalist'),
('Mia', 'Everglow', 'Main Dancer', 'Main Vocalist'),
('Soyeon', '(G)-idle', 'Leader', 'Main Rapper'),
('Tsuki', 'Billlie', 'Vocalist' , 'Dancer'),
('Sieun', 'STAYC', 'Main Vocalist', 'NULL'),
('Jihan', 'Weekly', 'Lead Vocalist' , 'Visual'),
('Wonyoung', 'IVE', 'Center', 'Vocalist'),
('Hanni', 'NewJeans', 'Lead Vocalist', 'Lead Dancer'),
('Goeun', 'Purple Kiss', 'Main Vocalist', 'Lead Dancer');

