-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2020 pada 06.54
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventaris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `kondisi_barang` varchar(20) NOT NULL,
  `status_barang` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id_jurusan` varchar(20) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `kode_jurusan` char(10) NOT NULL,
  `id_kepala_jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jurusan`, `nama_jurusan`, `kode_jurusan`, `id_kepala_jurusan`) VALUES
('j-5e326de95dd5d', 'Design Property dan Interior Bangunan', 'DPIB', 4),
('j-5e326e5a03a6e', 'Badan Konstruksi Property', 'BKP', 5),
('j-5e326e8d6710b', 'Teknik Pendingin', 'TP', 6),
('j-5e326e994cad0', 'Teknik Listrik', 'TL', 7),
('j-5e326ea52186a', 'Permesinan', 'PM', 8),
('j-5e326eb7322b3', 'Teknik dan Bisnis Sepeda Motor', 'TBSM', 9),
('j-5e326ecc67994', 'Teknik Kendaraan Ringan Otomotif', 'TKRO', 10),
('j-5e326eda3bb37', 'Audio Video', 'AV', 11),
('j-5e326ef9e7ea2', 'Multimedia', 'MM', 12),
('j-5e326f11e9679', 'Teknik Komputer dan Jaringan', 'TKJ', 13),
('j-5e326f1fd04bd', 'Rekayasa Perangkat Lunak', 'RPL', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kepala_jurusan`
--

CREATE TABLE `tb_kepala_jurusan` (
  `id_kepala_jurusan` varchar(20) NOT NULL,
  `nama_kepala_jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `link_menu` varchar(100) NOT NULL,
  `icon_menu` varchar(50) NOT NULL,
  `role_menu` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_menu`
--

INSERT INTO `tb_menu` (`id_menu`, `nama_menu`, `link_menu`, `icon_menu`, `role_menu`) VALUES
(1, 'Dashboard', '/', 'fa-home', '0|1|2'),
(2, 'Profile', '/profile', 'fa-user', '0|1|2'),
(4, 'Menu', '/menu', 'fa-compass', '2'),
(6, 'Students', '/student', 'fa-user-graduate', '2'),
(7, 'Majors', '/major', 'fa-landmark', '1|2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_pinjam` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_kembali` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jurusan_user` varchar(10) NOT NULL,
  `kelas_user` varchar(20) NOT NULL,
  `role_user` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `jenis_kelamin`, `username`, `password`, `jurusan_user`, `kelas_user`, `role_user`) VALUES
(1, 'I Putu Dwi Payana', 'L', 'admin', '$2y$10$ZepzL/0OmbMRGsOwXI4Dmexo2v0cUwenhQpNGT23BJbD2i5TUnS4.', 'RPL', 'XI RPL 1', 2),
(4, 'Petugas DPIB', 'L', 'petugas1', '$2y$10$0uoXIoCkz7YnMHGtfaT3WO5OX/RBcH0TcOVhF7dgHvrxVCh5rOuly', 'DPIB', 'DPIB', 1),
(5, 'Petugas BKP', 'L', 'petugas2', '$2y$10$2SEOAwxC0KeKS3eK0Qd.BeywgarpawCUSPyxh9uYjmKsY.wfWW2gm', 'BKP', 'BKP', 1),
(6, 'Petugas TP', 'L', 'petugas3', '$2y$10$UGFqCPs.j9/FZnFjfe.IHuV5Edl0.fXorvMD1IWvjo6phbRq32ET.', 'TP', 'TP', 1),
(7, 'Petugas TL', 'L', 'petugas4', '$2y$10$.Rkj7WY5FgT0StldN01h9.ePDkzdUv5CXs97TZHEmVXpbG.KyMXkC', 'TL', 'TL', 1),
(8, 'Petugas PM', 'L', 'petugas5', '$2y$10$n.50y3SV.t7n/zPSKoTTcugY2q7eoenxVRNdh2zOrUbO1wQWmkq2u', 'PM', 'PM', 1),
(9, 'Petugas TBSM', 'L', 'petugas6', '$2y$10$.sWY4v7/d6JLgkCK8GzBCevab1uO29cs0ihjyRfgoejHfngazZ87C', 'TBSM', 'TBSM', 1),
(10, 'Petugas TKRO', 'L', 'petugas7', '$2y$10$mKhIupv3HQ8abCvf2IVyb.ng8zBX2Z8AU2ZxyZM4eroRupY23A30S', 'TKRO', 'TKRO', 1),
(11, 'Petugas AV', 'L', 'petugas8', '$2y$10$OKcZIiOqRDwNx4gyeGUFm.SHVQrLkf65/vDI/Ntbnw.nZnTf6Xo4C', 'AV', 'AV', 1),
(12, 'Petugas MM', 'L', 'petugas9', '$2y$10$x.XKrDoUOcKN.0IdvlDZveSMHigj16zCRZp4lANZk2tbRNsybZszu', 'MM', 'MM', 1),
(13, 'Petugas TKJ', 'L', 'petugas10', '$2y$10$FvlIc6gK0Y8wF6ZAHNdZTuXvdQe4/lG3ngCj.kloQdxy5PUF2xX/e', 'TKJ', 'TKJ', 1),
(14, 'Petugas RPL', 'L', 'petugas11', '$2y$10$mgB5kGC/82metU6KZcsOQeQylX6ZnPVoL.W3d9Jaj6mpNuL4YsdhG', 'RPL', 'RPL', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `tb_kepala_jurusan`
--
ALTER TABLE `tb_kepala_jurusan`
  ADD PRIMARY KEY (`id_kepala_jurusan`);

--
-- Indeks untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
