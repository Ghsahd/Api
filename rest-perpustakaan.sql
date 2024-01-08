-- phpMyAdmin SQL Dump
-- version 5.2.1-dev+20230105.dfd5f13078
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Des 2023 pada 12.31
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rest-perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nomor_anggota` varchar(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nomor_anggota`, `nama`, `email`, `alamat`, `nomor_telepon`, `password`) VALUES
(35, 'AGT001', 'Berkah Jaya', 'berkah@gmail.com', 'Desa suber makmur', '09876543672', 'berkah12'),
(36, 'AGT002', 'Pokse', 'pokse@gmail.com', 'Desa sumber abadi', '0987654345', 'pokse123'),
(37, 'AGT003', 'anam', 'anam@gmail.com', 'desa sumber raja', '089765435267', 'anam1234'),
(38, 'AGT004', 'hatim', 'hatim@gmail.com', 'Desa sleman', '0897676543', 'hatim123'),
(39, 'AGT005', 'Berkah Jaya', 'berkah@gmail.com', 'desa besani', '089765423159', 'berkah12'),
(40, 'AGT006', 'Sinta Maharani', 'sinta@gmail.com', 'Kalimantan,Indonesia', '0897654354', 'sinta123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` varchar(50) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `lokasi_buku` varchar(50) NOT NULL,
  `lokasi_terbit` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `kode_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `kategori`, `jumlah`, `lokasi_buku`, `lokasi_terbit`, `tanggal_masuk`) VALUES
(7, 'BK003', 'Kuda Berlayar', 'rahmat', 'cv jogja', '2005', 'cerpen', 7, 'RAK 01', 'Bandung', '2023-06-01'),
(8, 'BK0005', 'Kisah Rasul', 'Ryan Ardian', 'CV marhaban', '2008', 'Cerpen', 7, 'RAK 4', 'JAKARTA', '2023-06-07'),
(9, 'BK003', 'Sangkuriang', 'Rian Ardian', 'CV JASA PRINT', '2009', 'Cerpen', 7, 'Rak 2', 'Semarang', '2023-06-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_digital`
--

CREATE TABLE `buku_digital` (
  `id_buku_digital` int(11) NOT NULL,
  `kode_buku` varchar(50) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` varchar(10) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `link` text NOT NULL,
  `link_sampul` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `buku_digital`
--

INSERT INTO `buku_digital` (`id_buku_digital`, `kode_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `kategori`, `jumlah`, `tanggal_masuk`, `link`, `link_sampul`) VALUES
(2, 'BK0001', 'Iwan Fals', 'iwan', 'iwan', '2003', 'musis', 12, '2023-12-15', 'https://online.fliphtml5.com/dbefk/xesx/', 'https://online.fliphtml5.com/dbefk/xesx/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_rusak`
--

CREATE TABLE `buku_rusak` (
  `id_buku_rusak` int(11) NOT NULL,
  `no_keluar` varchar(50) NOT NULL,
  `kode_buku` varchar(50) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_rusak` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `buku_rusak`
--

INSERT INTO `buku_rusak` (`id_buku_rusak`, `no_keluar`, `kode_buku`, `stok_awal`, `tanggal_keluar`, `jumlah_rusak`, `keterangan`) VALUES
(1, 'RSK001', 'BK003', 10, '2023-11-09', 2, 'kehujanan'),
(2, 'RSK002', 'BK003', 10, '2023-11-11', 1, 'Kehujanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-08-18-025340', 'App\\Database\\Migrations\\User', 'default', 'App', 1692327530, 1),
(2, '2023-08-18-030035', 'App\\Database\\Migrations\\User', 'default', 'App', 1692327917, 2),
(3, '2023-08-19-093440', 'App\\Database\\Migrations\\Buku', 'default', 'App', 1692438318, 3),
(4, '2023-08-19-095026', 'App\\Database\\Migrations\\Lokasi', 'default', 'App', 1692438851, 4),
(5, '2023-08-27-162618', 'App\\Database\\Migrations\\Peminjaman', 'default', 'App', 1693153866, 5),
(6, '2023-08-18-030035', 'App\\Database\\Migrations\\Anggota', 'default', 'App', 1698898452, 6),
(7, '2023-11-02-035238', 'App\\Database\\Migrations\\BukuRusak', 'default', 'App', 1698898452, 6),
(8, '2023-11-02-040605', 'App\\Database\\Migrations\\BukuMasuk', 'default', 'App', 1698898452, 6),
(9, '2023-12-14-095341', 'App\\Database\\Migrations\\BukuDigital', 'default', 'App', 1702548119, 7),
(11, '2023-12-18-163544', 'App\\Database\\Migrations\\PeminjamanOnline', 'default', 'App', 1702917502, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `kode_buku` varchar(11) NOT NULL,
  `nomor_anggota` varchar(11) NOT NULL,
  `status` enum('Pinjam','Kembali') NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `denda` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `kode_buku`, `nomor_anggota`, `status`, `tanggal_peminjaman`, `tanggal_pengembalian`, `denda`) VALUES
(13, 'BK002', 'AGT004', 'Kembali', '2023-10-19', '2023-10-22', 0),
(17, 'BK003', 'AGT005', 'Kembali', '2023-11-08', '2023-11-11', 0),
(18, 'BK0005', 'AGT005', 'Kembali', '2023-10-19', '2023-10-22', 0),
(19, 'BK003', 'AGT005', 'Kembali', '2023-10-19', '2023-10-22', 0),
(20, 'BK0005', 'AGT005', 'Kembali', '2023-10-19', '2023-10-22', 0),
(21, 'BK003', 'AGT005', 'Kembali', '2023-10-19', '2023-10-22', 0),
(22, 'BK0005', 'AGT005', 'Kembali', '2023-10-19', '2023-10-22', 0),
(23, 'BK003', 'AGT005', 'Kembali', '2023-10-19', '2023-10-22', 0),
(24, 'BK0005', 'AGT005', 'Kembali', '2023-10-19', '2023-10-22', 0),
(25, 'BK0005', 'AGT005', 'Kembali', '2023-10-19', '2023-10-22', 0),
(26, 'BK003', 'AGT005', 'Kembali', '2023-10-19', '2023-10-22', 0),
(27, 'BK0005', 'AGT005', 'Kembali', '2023-10-19', '2023-10-22', 0),
(28, 'BK0005', 'AGT005', 'Pinjam', '2023-10-19', '2023-10-22', 0),
(29, 'BK0005', 'AGT005', 'Kembali', '2023-11-08', '2023-11-11', 0),
(30, 'BK003', 'AGT005', 'Pinjam', '2023-10-20', '2023-10-23', 0),
(31, 'BK003', 'AGT005', 'Pinjam', '2023-10-20', '2023-10-23', 0),
(32, 'BK0005', 'AGT005', 'Kembali', '2023-10-29', '2023-11-01', 0),
(33, 'BK003', 'AGT005', 'Kembali', '2023-10-29', '2023-11-01', 0),
(34, 'BK0005', 'AGT005', 'Pinjam', '2023-10-20', '2023-10-23', 0),
(35, 'BK003', 'AGT005', 'Pinjam', '2023-10-20', '2023-10-23', 0),
(36, 'BK003', 'AGT005', 'Pinjam', '2023-10-20', '2023-10-23', 0),
(37, 'BK003', 'AGT006', 'Pinjam', '2023-11-01', '2023-11-04', 0),
(38, 'BK003', 'AGT006', 'Pinjam', '2023-11-01', '2023-11-04', 0),
(39, 'BK0005', 'AGT006', 'Pinjam', '2023-11-01', '2023-11-04', 0),
(40, 'BK0005', 'AGT006', 'Pinjam', '2023-11-01', '2023-11-04', 0),
(41, 'BK0005', 'AGT006', 'Pinjam', '2023-11-11', '2023-11-14', 0),
(42, 'BK0005', 'AGT006', 'Pinjam', '2023-11-11', '2023-11-14', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_online`
--

CREATE TABLE `peminjaman_online` (
  `id_peminjaman_online` int(11) NOT NULL,
  `kode_buku` varchar(11) NOT NULL,
  `nomor_anggota` varchar(11) NOT NULL,
  `status` enum('Diajukan','Diterima') NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `peminjaman_online`
--

INSERT INTO `peminjaman_online` (`id_peminjaman_online`, `kode_buku`, `nomor_anggota`, `status`, `tanggal_peminjaman`, `tanggal_pengembalian`) VALUES
(1, 'BK0001', 'AGT001', 'Diterima', '2023-12-19', '2023-12-22'),
(2, 'BK0001', 'AGT001', 'Diterima', '2023-12-19', '2023-12-22'),
(3, 'BK0001', 'AGT006', 'Diajukan', '2023-12-19', '2023-12-22'),
(4, 'BK0001', 'AGT006', 'Diajukan', '2023-12-21', '2023-12-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` enum('Admin','Anggota') NOT NULL,
  `nomor_anggota` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `role`, `nomor_anggota`) VALUES
(19, 'admin@gmail.com', 'admin123', 'Admin', '0'),
(40, 'hatim@gmail.com', 'hatim123', 'Anggota', 'AGT004'),
(41, 'berkah@gmail.com', 'berkah12', 'Anggota', 'AGT005'),
(42, 'sinta@gmail.com', 'sinta123', 'Anggota', 'AGT006');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `buku_digital`
--
ALTER TABLE `buku_digital`
  ADD PRIMARY KEY (`id_buku_digital`);

--
-- Indeks untuk tabel `buku_rusak`
--
ALTER TABLE `buku_rusak`
  ADD PRIMARY KEY (`id_buku_rusak`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `peminjaman_online`
--
ALTER TABLE `peminjaman_online`
  ADD PRIMARY KEY (`id_peminjaman_online`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `buku_digital`
--
ALTER TABLE `buku_digital`
  MODIFY `id_buku_digital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `buku_rusak`
--
ALTER TABLE `buku_rusak`
  MODIFY `id_buku_rusak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_online`
--
ALTER TABLE `peminjaman_online`
  MODIFY `id_peminjaman_online` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
