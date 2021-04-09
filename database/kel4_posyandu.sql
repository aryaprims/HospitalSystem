-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 22, 2020 at 10:37 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kel4_posyandu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `nama`) VALUES
(1, 'admin', 'admin'),
(357, 'jeki', 'admin'),
(358, 'coba', 'coba'),
(359, 'coba3', 'coba');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `delete_admin` AFTER DELETE ON `admin` FOR EACH ROW DELETE FROM akun WHERE username=old.username
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `hak_akses` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `password`, `hak_akses`) VALUES
(345, 'admin', '$2y$12$4zhccPrBIbj0Ds7Q6iSuiORtarZr7biV41WMmIKgiHdyCFtEWobHW', 1),
(351, 'anime', '$2y$10$7PZHiii7eXiqEt6u.7EfQuBd/Mx9qZFlBnTBQeiN/6gSYAbjRNbhS', 3),
(352, 'dokter', '$2y$12$sJNQPB4ZBrICdobHyDPN8e9FJo9DJuZB6oqaGxoPX/zuPjs150/XW', 2),
(383, 'jeki', '$2y$10$BRouPtQ/TMbVAHVrfKI9.u5mzIFPFdAfD6guYlubf/TvguXjCQAQC', 1),
(384, 'coba', '$2y$10$cq0QMfI5IrP5errtTPyrxeO9rpBOF1E36qGHwTsgS40vl.Zdp9UNK', 1),
(385, 'coba3', '$2y$10$Nranl58CZEMEJ1cYGv6BIug/BongvQSGFBFMs8ZNs1j2QGK.7ZlQO', 1),
(386, 'owo', '$2y$12$Ckxu36JcWGLMckZHE.4iie6u95cFg1bfJijMB1A64rjroDf.Ei/0.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `spesialis` varchar(20) NOT NULL,
  `lama_bekerja` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `username`, `nama`, `spesialis`, `lama_bekerja`) VALUES
(124, 'dokter', 'dokter', 'anu', '4');

--
-- Triggers `dokter`
--
DELIMITER $$
CREATE TRIGGER `delete_dokter` AFTER DELETE ON `dokter` FOR EACH ROW DELETE FROM akun WHERE username=old.username
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_imunisasi`
--

CREATE TABLE `jadwal_imunisasi` (
  `id_jadwal` int(10) NOT NULL,
  `id_dokter` int(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_imunisasi`
--

INSERT INTO `jadwal_imunisasi` (`id_jadwal`, `id_dokter`, `tanggal`) VALUES
(324, 124, '2020-04-23'),
(325, 124, '2020-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `pasien_user`
--

CREATE TABLE `pasien_user` (
  `username` varchar(30) NOT NULL,
  `nip` int(30) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien_user`
--

INSERT INTO `pasien_user` (`username`, `nip`, `nama`) VALUES
('anime', 1301180162, 'Anime'),
('owo', 1301180164, 'uwu');

--
-- Triggers `pasien_user`
--
DELIMITER $$
CREATE TRIGGER `delete_pasien` AFTER DELETE ON `pasien_user` FOR EACH ROW DELETE FROM akun WHERE username=old.username
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftar_imunisasi`
--

CREATE TABLE `tabel_pendaftar_imunisasi` (
  `id_tabel_pendaftar` int(30) NOT NULL,
  `nip` int(30) NOT NULL,
  `id_jadwal` int(10) NOT NULL,
  `no_antrian` int(10) NOT NULL,
  `usia_anak` varchar(10) NOT NULL,
  `tinggi_anak` varchar(10) NOT NULL,
  `berat_anak` varchar(10) NOT NULL,
  `keluhan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_pendaftar_imunisasi`
--

INSERT INTO `tabel_pendaftar_imunisasi` (`id_tabel_pendaftar`, `nip`, `id_jadwal`, `no_antrian`, `usia_anak`, `tinggi_anak`, `berat_anak`, `keluhan`) VALUES
(347, 1301180164, 324, 1, '4 Tahun', '3 m', '3 kg', 'asdfasf'),
(348, 1301180164, 325, 1, '3 Bulan', '100 cm', '20 kg', 'asdfasdfasdfasfasdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `jadwal_imunisasi`
--
ALTER TABLE `jadwal_imunisasi`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_dokter` (`id_dokter`) USING BTREE;

--
-- Indexes for table `pasien_user`
--
ALTER TABLE `pasien_user`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tabel_pendaftar_imunisasi`
--
ALTER TABLE `tabel_pendaftar_imunisasi`
  ADD PRIMARY KEY (`id_tabel_pendaftar`),
  ADD UNIQUE KEY `nip` (`nip`,`id_jadwal`) USING BTREE,
  ADD KEY `id_jadwal` (`id_jadwal`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=387;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `jadwal_imunisasi`
--
ALTER TABLE `jadwal_imunisasi`
  MODIFY `id_jadwal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT for table `pasien_user`
--
ALTER TABLE `pasien_user`
  MODIFY `nip` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1301184261;

--
-- AUTO_INCREMENT for table `tabel_pendaftar_imunisasi`
--
ALTER TABLE `tabel_pendaftar_imunisasi`
  MODIFY `id_tabel_pendaftar` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`username`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`username`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_imunisasi`
--
ALTER TABLE `jadwal_imunisasi`
  ADD CONSTRAINT `jadwal_imunisasi_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pasien_user`
--
ALTER TABLE `pasien_user`
  ADD CONSTRAINT `pasien_user_ibfk_1` FOREIGN KEY (`username`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tabel_pendaftar_imunisasi`
--
ALTER TABLE `tabel_pendaftar_imunisasi`
  ADD CONSTRAINT `tabel_pendaftar_imunisasi_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pasien_user` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tabel_pendaftar_imunisasi_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_imunisasi` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
