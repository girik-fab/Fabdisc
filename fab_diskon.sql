-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Apr 2025 pada 15.06
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fab_diskon`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `gambar_barang` varchar(50) NOT NULL,
  `deskripsi_barang` text NOT NULL,
  `id_diskon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `harga_barang`, `gambar_barang`, `deskripsi_barang`, `id_diskon`) VALUES
(1, 'Baju', 65000, 'baju.jpg', 'Tahan lama dan affordable', 1),
(2, 'Topi', 30000, 'topi', 'Kualitas bagus dan nyaman', 2),
(4, 'Laptop', 5000000, 'laptop.jpg', 'HP 15.6-Inch, AMD Ryzen, 8GB 256GB ', 4),
(5, 'Celana', 70000, 'celana.jfif', 'Bahan berkualitas dan tidak mudah rusak', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_diskon`
--

CREATE TABLE `tb_diskon` (
  `id_diskon` int(11) NOT NULL,
  `barang_diskon` varchar(50) NOT NULL,
  `diskon` int(11) NOT NULL,
  `harga_setelah_diskon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_diskon`
--

INSERT INTO `tb_diskon` (`id_diskon`, `barang_diskon`, `diskon`, `harga_setelah_diskon`) VALUES
(1, 'Baju', 30, 45500),
(2, 'Topi', 45, 16500),
(3, 'Celana', 55, 39150),
(4, 'Laptop', 30, 3500000),
(5, 'Celana', 30, 49000),
(6, 'Baju', 0, 60000),
(7, 'SENDAL JEPIT ', 10, 18000),
(8, 'Oven', 20, 120000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id_pesanan`, `username`, `barang_id`, `nama_barang`, `harga_satuan`, `jumlah`, `total_harga`, `tanggal`) VALUES
(1, 'fabi', 1, 'Baju', 44000, 8, 352000, '2025-04-14 18:27:03'),
(2, 'fabi', 1, 'Baju', 44000, 1, 44000, '2025-04-14 18:27:50'),
(3, 'fabI', 1, 'Baju', 44000, 1, 44000, '2025-04-15 02:28:50'),
(4, 'fabi', 2, 'Topi', 16500, 1, 16500, '2025-04-15 04:05:53'),
(5, 'fabi', 2, 'Topi', 16500, 1, 16500, '2025-04-15 04:06:04'),
(6, 'fabi', 1, 'Baju', 45500, 1, 45500, '2025-04-15 04:07:29'),
(7, 'fab', 4, 'Laptop', 3500000, 1, 3500000, '2025-04-15 04:20:16'),
(8, 'fabI', 3, 'Celana', 39150, 1, 39150, '2025-04-15 06:22:36'),
(9, 'fabi', 1, 'Baju', 45500, 1, 45500, '2025-04-15 09:04:00'),
(10, 'fabi', 2, 'Topi', 16500, 1, 16500, '2025-04-15 09:04:00'),
(11, 'pasha', 2, 'Topi', 16500, 1, 16500, '2025-04-16 04:39:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usser`
--

CREATE TABLE `usser` (
  `id` int(11) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `usser`
--

INSERT INTO `usser` (`id`, `username`, `password`, `role`) VALUES
(1, 'fab', '123', 'admin'),
(2, 'fabi', '123', 'user'),
(3, 'fabians', '123', 'user'),
(4, 'pasha', '123', 'user'),
(5, 'lerio', '12', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_diskon`
--
ALTER TABLE `tb_diskon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indeks untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `usser`
--
ALTER TABLE `usser`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_diskon`
--
ALTER TABLE `tb_diskon`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `usser`
--
ALTER TABLE `usser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
