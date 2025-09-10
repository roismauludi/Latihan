-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Sep 2025 pada 03.26
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
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nim`, `nama`, `jurusan`, `prodi`, `kelas`, `email`, `created_at`, `update_at`) VALUES
(2, '4342211016', 'Budi Santoso', 'Teknik Komputer', 'S1 Teknik Komputer', '1C Siang', 'budi1CSiang@gmail.com', '2025-08-28 04:16:31', '2025-09-10 01:25:45'),
(3, '4342211018', 'Dewi Sartika', 'Manajemen Informatika', 'D3 Manajemen Informatika', '5D Malam', 'Dewi5DMalam@gmail.com', '2025-08-28 04:16:31', '2025-09-10 01:25:45'),
(4, '4342211020', 'Rudi Hermawan', 'Teknik Informatika', 'S1 Teknik Informatika', '2A Pagi', 'rudi2APagi@gmail.com', '2025-08-28 04:16:31', '2025-09-10 01:25:45'),
(5, '4342211011', 'Muhammad Rois', 'Teknik Informatika', 'S1 Teknik Informatika', '7A Malam', 'roismauludi72@gmail.com', '2025-08-28 04:16:44', '2025-09-09 07:12:03'),
(6, '4342211019', 'Fransiskus', 'Teknik Informatika', 'S1 Sistem Informasi', '7A Malam', 'frans7AMalam@gmail.com', '2025-08-28 09:13:12', '2025-09-09 07:03:32'),
(9, '4342211012', 'Budiono', 'Teknik Elektro', 'S1 Teknik Telekomunikasi', '7A Pagi', 'budiono7APagi@gmail.com', '2025-09-03 01:56:02', '2025-09-09 07:03:32');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
