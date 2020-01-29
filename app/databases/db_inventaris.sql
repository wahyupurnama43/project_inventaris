-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jan 2020 pada 13.12
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT
= 0;
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris`
--
CREATE DATABASE
IF NOT EXISTS `db_inventaris` DEFAULT CHARACTER
SET utf8mb4
COLLATE utf8mb4_general_ci;
USE `db_inventaris`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

DROP TABLE IF EXISTS `tb_barang`;
CREATE TABLE `tb_barang`
(
  `id_barang` int
(11) NOT NULL,
  `id_jurusan` int
(11) NOT NULL,
  `nama_barang` varchar
(100) NOT NULL,
  `jumlah_barang` int
(11) NOT NULL,
  `kondisi_barang` varchar
(20) NOT NULL,
  `status_barang` int
(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jurusan`
--

DROP TABLE IF EXISTS `tb_jurusan`;
CREATE TABLE `tb_jurusan`
(
  `id_jurusan` int
(11) NOT NULL,
  `nama_jurusan` varchar
(100) NOT NULL,
  `kode_jurusan` char
(10) NOT NULL,
  `id_kepala_jurusan` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`
id_jurusan`,
`nama_jurusan
`, `kode_jurusan`, `id_kepala_jurusan`) VALUES
(1, 'Design Permodelan Interior dan Bangunan', 'DPIB', 1),
(2, 'Bisnis Konstruksi Property', 'BKP', 2),
(3, 'Teknik Pendingin', 'TP', 3),
(4, 'Teknik Listrik', 'TL', 4),
(5, 'Permesinan', 'PM', 5),
(6, 'Teknik dan Bisnis Sepeda Motor', 'TBSM', 6),
(7, 'Teknik Kendaraan Ringan Otomotif', 'TKRO', 7),
(8, 'Audio Video', 'AV', 8),
(9, 'Multimedia', 'MM', 9),
(10, 'Teknik Komputer Jaringan', 'TKJ', 10),
(11, 'Rekayasa Perangkat Lunak', 'RPL', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kepala_jurusan`
--

DROP TABLE IF EXISTS `tb_kepala_jurusan`;
CREATE TABLE `tb_kepala_jurusan`
(
  `id_kepala_jurusan` varchar
(20) NOT NULL,
  `nama_kepala_jurusan` varchar
(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_menu`
--

DROP TABLE IF EXISTS `tb_menu`;
CREATE TABLE `tb_menu`
(
  `id_menu` int
(11) NOT NULL,
  `nama_menu` varchar
(100) NOT NULL,
  `link_menu` varchar
(100) NOT NULL,
  `icon_menu` varchar
(50) NOT NULL,
  `role_menu` varchar
(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_menu`
--

INSERT INTO `tb_menu` (`
id_menu`,
`nama_menu
`, `link_menu`, `icon_menu`, `role_menu`) VALUES
(1, 'Dashboard', '/', 'fa-home', '0|1|2'),
(2, 'Profile', '/profile', 'fa-user', '0|1|2'),
(4, 'Menu', '/menu', 'fa-compass', '2'),
(5, 'Majors', '/majors', 'fa-th-list', '1|2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peminjaman`
--

DROP TABLE IF EXISTS `tb_peminjaman`;
CREATE TABLE `tb_peminjaman`
(
  `id_peminjaman` int
(11) NOT NULL,
  `id_barang` int
(11) NOT NULL,
  `id_user` int
(11) NOT NULL,
  `tanggal_pinjam` varchar
(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengembalian`
--

DROP TABLE IF EXISTS `tb_pengembalian`;
CREATE TABLE `tb_pengembalian`
(
  `id_pengembalian` int
(11) NOT NULL,
  `id_barang` int
(11) NOT NULL,
  `id_user` int
(11) NOT NULL,
  `tanggal_kembali` varchar
(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`
(
  `id_user` int
(11) NOT NULL,
  `nama_user` varchar
(100) NOT NULL,
  `jenis_kelamin` varchar
(10) NOT NULL,
  `username` varchar
(100) NOT NULL,
  `password` varchar
(255) NOT NULL,
  `jurusan_user` varchar
(10) NOT NULL,
  `kelas_user` varchar
(20) NOT NULL,
  `role_user` int
(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`
id_user`,
`nama_user
`, `jenis_kelamin`, `username`, `password`, `jurusan_user`, `kelas_user`, `role_user`) VALUES
(1, 'I Putu Dwi Payana', 'L', 'admin', '$2y$10$ZepzL/0OmbMRGsOwXI4Dmexo2v0cUwenhQpNGT23BJbD2i5TUnS4.', 'RPL', 'XI RPL 1', 2),
(2, 'I Putu Dwi Payana', 'L', 'dwipayana30', '$2y$10$mZn9IG6ewN7/nr61NH77B.Lj10dHfnn0Sb2fgASjgufp8H4BOMgXW', 'RPL', 'XI RPL 1', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
ADD PRIMARY KEY
(`id_barang`);

--
-- Indeks untuk tabel `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
ADD PRIMARY KEY
(`id_jurusan`);

--
-- Indeks untuk tabel `tb_kepala_jurusan`
--
ALTER TABLE `tb_kepala_jurusan`
ADD PRIMARY KEY
(`id_kepala_jurusan`);

--
-- Indeks untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
ADD PRIMARY KEY
(`id_menu`);

--
-- Indeks untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
ADD PRIMARY KEY
(`id_peminjaman`);

--
-- Indeks untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
ADD PRIMARY KEY
(`id_pengembalian`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
ADD PRIMARY KEY
(`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int
(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id_jurusan` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id_menu` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id_peminjaman` int
(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  MODIFY `id_pengembalian` int
(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
