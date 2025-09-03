-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Sep 2025 pada 03.50
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mahasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nim`, `nama`, `jurusan`, `prodi`, `kelas`, `created_at`, `update_at`) VALUES
(1, '2021002', 'Siti Nurhaliza', 'Sistem Informasi', 'S1 Sistem Informasi', '3B Pagi', '2025-08-28 04:16:31', '2025-09-02 03:39:15'),
(2, '2021003', 'Budi Santoso', 'Teknik Komputer', 'S1 Teknik Komputer', '1C Siang', '2025-08-28 04:16:31', '2025-09-02 03:39:15'),
(3, '2021004', 'Dewi Sartika', 'Manajemen Informatika', 'D3 Manajemen Informatika', '5D Malam', '2025-08-28 04:16:31', '2025-09-02 03:39:15'),
(4, '2021005', 'Rudi Hermawan', 'Teknik Informatika', 'S1 Teknik Informatika', '2A Pagi', '2025-08-28 04:16:31', '2025-09-02 03:39:15'),
(5, '4342211011', 'Muhammad Rois', 'Teknik Informatika', 'S1 Teknik Informatika', '7A Malam', '2025-08-28 04:16:44', '2025-09-02 03:39:15'),
(6, '4342211019', 'Fransiskus', 'Teknik Informatika', 'S1 Sistem Informasi', '7A Malam', '2025-08-28 09:13:12', '2025-09-02 03:39:15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
