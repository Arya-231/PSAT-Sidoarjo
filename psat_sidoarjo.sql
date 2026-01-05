-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2025 at 05:18 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `psat_sidoarjo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('superadmin','petugas') DEFAULT 'petugas',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_pendukung`
--

CREATE TABLE `dokumen_pendukung` (
  `id` int(11) NOT NULL,
  `registrasi_id` int(11) NOT NULL,
  `jenis_dokumen` varchar(100) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foto_kemasan`
--

CREATE TABLE `foto_kemasan` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `pelaku_usaha_id` int(11) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `media` enum('WA','Email','Sistem') DEFAULT NULL,
  `status_kirim` enum('Pending','Terkirim','Gagal') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelaku_usaha`
--

CREATE TABLE `pelaku_usaha` (
  `id` int(11) NOT NULL,
  `nama_unit` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk_psat`
--

CREATE TABLE `produk_psat` (
  `id` int(11) NOT NULL,
  `pelaku_usaha_id` int(11) NOT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `nama_komoditas` varchar(255) DEFAULT NULL,
  `nama_ilmiah` varchar(255) DEFAULT NULL,
  `jenis_psat` varchar(255) DEFAULT NULL,
  `kemasan_berat` varchar(100) DEFAULT NULL,
  `label` enum('Hijau','Putih') DEFAULT NULL,
  `klaim` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registrasi_psat`
--

CREATE TABLE `registrasi_psat` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jenis_registrasi` varchar(50) DEFAULT NULL,
  `nomor_registrasi` varchar(100) DEFAULT NULL,
  `alamat_penanganan` text DEFAULT NULL,
  `jenis_merek` enum('teks','logo') DEFAULT NULL,
  `nama_merek` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `tgl_terbit` date DEFAULT NULL,
  `tgl_berakhir` date DEFAULT NULL,
  `status` enum('Aktif','Kadaluarsa','Menunggu') DEFAULT 'Menunggu',
  `file_sertifikat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `dokumen_pendukung`
--
ALTER TABLE `dokumen_pendukung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registrasi_id` (`registrasi_id`);

--
-- Indexes for table `foto_kemasan`
--
ALTER TABLE `foto_kemasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelaku_usaha_id` (`pelaku_usaha_id`);

--
-- Indexes for table `pelaku_usaha`
--
ALTER TABLE `pelaku_usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_psat`
--
ALTER TABLE `produk_psat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelaku_usaha_id` (`pelaku_usaha_id`);

--
-- Indexes for table `registrasi_psat`
--
ALTER TABLE `registrasi_psat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_pendukung`
--
ALTER TABLE `dokumen_pendukung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto_kemasan`
--
ALTER TABLE `foto_kemasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelaku_usaha`
--
ALTER TABLE `pelaku_usaha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk_psat`
--
ALTER TABLE `produk_psat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrasi_psat`
--
ALTER TABLE `registrasi_psat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen_pendukung`
--
ALTER TABLE `dokumen_pendukung`
  ADD CONSTRAINT `dokumen_pendukung_ibfk_1` FOREIGN KEY (`registrasi_id`) REFERENCES `registrasi_psat` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `foto_kemasan`
--
ALTER TABLE `foto_kemasan`
  ADD CONSTRAINT `foto_kemasan_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk_psat` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`pelaku_usaha_id`) REFERENCES `pelaku_usaha` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `produk_psat`
--
ALTER TABLE `produk_psat`
  ADD CONSTRAINT `produk_psat_ibfk_1` FOREIGN KEY (`pelaku_usaha_id`) REFERENCES `pelaku_usaha` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registrasi_psat`
--
ALTER TABLE `registrasi_psat`
  ADD CONSTRAINT `registrasi_psat_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk_psat` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
