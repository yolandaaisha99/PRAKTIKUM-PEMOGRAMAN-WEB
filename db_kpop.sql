-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Okt 2025 pada 12.46
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
-- Database: `db_kpop`
--

--
-- Dumping data untuk tabel `fans`
--

INSERT INTO `fans` (`id`, `nama`, `gender`, `bias`, `aktivitas`, `pesan`) VALUES
(7, 'yolanda', 'Perempuan', 15, 'Streaming lagu, Vote di acara musik', 'llooolo'),
(8, 'yolanda', 'Perempuan', 15, 'Streaming lagu, Vote di acara musik', 'llooolo'),
(9, 'yolanda', 'Perempuan', 15, 'Streaming lagu, Vote di acara musik', 'llooolo'),
(10, 'Rama', 'Laki-laki', 3, 'Ikut fan project', 'Aku ingin idolku tau aku fans mereka!'),
(11, 'Rama', 'Laki-laki', 3, 'Ikut fan project', 'Aku ingin idolku tau aku fans mereka!');

--
-- Dumping data untuk tabel `idol`
--

INSERT INTO `idol` (`id`, `nama`, `grup`, `posisi`, `posisi2`) VALUES
(1, 'Bang Chan', 'Stray Kids', 'Leader, Producer', ''),
(2, 'Hyunjin', 'Stray Kids', 'Main Dancer, Sub Rapper', ''),
(3, 'San', 'ATEEZ', 'Lead Vocalist, Main Dancer', ''),
(4, 'Yeonjun', 'TXT', 'Rapper, Dancer', ''),
(5, 'Asahi', 'Treasure', 'Vocalist, Visual', ''),
(6, 'Jay', 'Enhypen', 'Lead Dancer, Rapper', ''),
(7, 'Serim', 'CRAVITY', 'Leader, Main Rapper', ''),
(8, 'Jeff', 'EPEX', 'Main Rapper, Vocalist', ''),
(9, 'Woobin', 'RIIZE', 'Guitarist, Vocalist', ''),
(10, 'Taeyong', 'NCT', 'Leader, Main Rapper', ''),
(11, 'Yeji', 'ITZY', 'Leader, Main Dancer', ''),
(12, 'Sullyon', 'NMIXX', 'Lead Vocalist, Visual', ''),
(13, 'Karina', 'Aespa', 'Leader, Main Dancer', ''),
(14, 'Kazuha', 'Le Sserafim', 'Lead Dancer, Vocalist', ''),
(15, 'Mia', 'Everglow', 'Main Dancer, Main Vocalist', ''),
(16, 'Soyeon', '(G)-IDLE', 'Leader, Main Rapper', ''),
(17, 'Tsuki', 'Billlie', 'Vocalist, Dancer', ''),
(18, 'Sieun', 'STAYC', 'Main Vocalist', ''),
(19, 'Jihan', 'Weekly', 'Lead Vocalist, Visual', ''),
(20, 'Wonyoung', 'IVE', 'Center, Vocalist', ''),
(21, 'Hanni', 'NewJeans', 'Lead Vocalist, Lead Dancer', ''),
(22, 'Goeun', 'Purple Kiss', 'Main Vocalist, Lead Dancer', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
