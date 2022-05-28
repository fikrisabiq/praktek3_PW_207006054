-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 03:52 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zakatfitrah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$CbB7YqNzIyDbmeNcMIZUBui7cVP.iGq0REZwpZUtcV0szfXNdLqFa'),
(2, 'fikri', '$2y$10$Z84jEjJWC.gP6udCdqdUJONLYjxV71KzWUdU26K7CXLC1c46KhPVq');

-- --------------------------------------------------------

--
-- Table structure for table `bayarzakat`
--

CREATE TABLE `bayarzakat` (
  `id_zakat` int(11) NOT NULL,
  `nama_KK` varchar(255) NOT NULL,
  `jumlah_tanggungan` int(11) NOT NULL,
  `jumlah_tanggunganyangdibayar` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bayarzakat`
--

INSERT INTO `bayarzakat` (`id_zakat`, `nama_KK`, `jumlah_tanggungan`, `jumlah_tanggunganyangdibayar`, `id_jenis`) VALUES
(14, 'Adhim Azhari', 1, 1, 1),
(15, 'Sakti Deka Setiarini', 1, 1, 2),
(16, 'Alditio Khairani', 2, 2, 1),
(17, 'Syarief Joseph Wagey', 2, 2, 1),
(18, 'Fauzi Amanda', 1, 1, 2),
(19, 'Mirza Primanelza', 3, 3, 1),
(20, 'Amar Syaraswati', 3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `bayar_beras`
--

CREATE TABLE `bayar_beras` (
  `id_bayar_beras` int(11) NOT NULL,
  `id_zakat` int(11) NOT NULL,
  `total` decimal(11,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bayar_beras`
--

INSERT INTO `bayar_beras` (`id_bayar_beras`, `id_zakat`, `total`) VALUES
(8, 14, '2.5'),
(9, 16, '5.0'),
(10, 17, '5.0'),
(11, 19, '7.5');

-- --------------------------------------------------------

--
-- Table structure for table `bayar_uang`
--

CREATE TABLE `bayar_uang` (
  `id_bayar_uang` int(11) NOT NULL,
  `id_zakat` int(11) NOT NULL,
  `beras` decimal(11,1) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bayar_uang`
--

INSERT INTO `bayar_uang` (`id_bayar_uang`, `id_zakat`, `beras`, `total`) VALUES
(4, 15, '2.5', 30000),
(5, 18, '2.5', 30000),
(6, 20, '7.5', 90000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_bayar`
--

CREATE TABLE `jenis_bayar` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_bayar`
--

INSERT INTO `jenis_bayar` (`id_jenis`, `nama_jenis`) VALUES
(1, 'beras'),
(2, 'uang');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_mustahik`
--

CREATE TABLE `kategori_mustahik` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `jumlah_hak` decimal(11,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_mustahik`
--

INSERT INTO `kategori_mustahik` (`id_kategori`, `nama_kategori`, `jumlah_hak`) VALUES
(1, 'fakir', '4.0'),
(2, 'miskin', '3.5'),
(3, 'mampu', '2.0'),
(4, 'amilin', '3.0'),
(5, 'fisabilillah', '2.0'),
(6, 'mualaf', '2.0'),
(7, 'Ibnu Sabil', '2.0');

-- --------------------------------------------------------

--
-- Table structure for table `mustahik_lainnya`
--

CREATE TABLE `mustahik_lainnya` (
  `id_mustahiklainnya` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `hak` decimal(11,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mustahik_lainnya`
--

INSERT INTO `mustahik_lainnya` (`id_mustahiklainnya`, `nama`, `id_kategori`, `hak`) VALUES
(1, 'Xiaomay', 5, '2.0'),
(3, 'Mainan', 5, '2.0'),
(4, 'fikris', 6, '2.0'),
(5, 'Jaki', 4, '3.0');

-- --------------------------------------------------------

--
-- Table structure for table `mustahik_warga`
--

CREATE TABLE `mustahik_warga` (
  `id_mustahikwarga` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `hak` decimal(11,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mustahik_warga`
--

INSERT INTO `mustahik_warga` (`id_mustahikwarga`, `nama`, `id_kategori`, `hak`) VALUES
(4, 'Adhim Azhari', 1, '4.0'),
(5, 'Sakti Deka Setiarini', 2, '3.5'),
(6, 'Alditio Khairani', 3, '2.0');

-- --------------------------------------------------------

--
-- Table structure for table `muzakki`
--

CREATE TABLE `muzakki` (
  `id_muzakki` int(11) NOT NULL,
  `nama_muzakki` varchar(255) NOT NULL,
  `jumlah_tanggungan` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `muzakki`
--

INSERT INTO `muzakki` (`id_muzakki`, `nama_muzakki`, `jumlah_tanggungan`, `keterangan`) VALUES
(12, 'Adhim Azhari', 1, '-'),
(13, 'Sakti Deka Setiarini', 1, '-'),
(14, 'Alditio Khairani', 2, '-'),
(16, 'Syarief Joseph Wagey', 2, '-'),
(17, 'Fauzi Amanda', 1, '-'),
(18, 'Amar Syaraswati', 3, '-'),
(19, 'Mario Dimas Maulana', 2, '-'),
(20, 'Marza Saury', 4, '-'),
(21, 'Mirza Primanelza', 3, '-'),
(22, 'Fatahillah Aburachman Pradipta', 2, '-'),
(23, 'Priyohadi Asmarandana', 3, '-'),
(24, 'Faishal Maulidah', 3, '-'),
(25, 'Jhon Wiratmansyah', 4, '-'),
(26, 'Arrivaldi Fhadriani', 4, '-'),
(27, 'Yutama Prahasti', 2, '-'),
(28, 'Aliriza Villaransi', 3, '-'),
(29, 'Aditya Sukosulistiowani', 1, '-'),
(30, 'Aldi Heriansyah', 1, '-'),
(31, 'Ekka Azis', 2, ''),
(32, 'Mochammad', 6, '-'),
(33, 'Iyya', 1, '-'),
(34, 'Efendy', 5, '-'),
(35, 'Cucu', 4, '-'),
(36, 'Joko', 6, '-'),
(37, 'Zhali', 4, '-'),
(38, 'Janti', 4, '-'),
(39, 'Hamengkubuwono', 4, '-'),
(40, 'Okto', 1, '-'),
(41, 'Kautsar', 5, '-'),
(42, 'Marwilis', 4, '-'),
(43, 'Syahid', 6, '-'),
(44, 'Mochamad', 1, '-'),
(45, 'Dally', 3, '-'),
(46, 'Husin', 3, '-'),
(47, 'Kelana', 3, '-'),
(48, 'Jajang', 1, '-'),
(49, 'Mulyana', 5, '-'),
(50, 'Suryana', 4, '-'),
(51, 'Adityas', 4, '-'),
(52, 'Gading', 4, '-'),
(53, 'Yudo', 2, '-'),
(54, 'Afendi', 2, '-'),
(55, 'Robiy', 1, '-'),
(56, 'Rifky', 3, '-'),
(57, 'Mansyur', 4, '-'),
(58, 'Efendy', 2, '-'),
(59, 'Mahdur', 4, '-'),
(60, 'Samuri', 2, '-'),
(61, 'Soerianto', 4, '-'),
(62, 'Noki', 3, '-'),
(63, 'Suas', 2, '-'),
(64, 'Hary', 2, '-'),
(65, 'Zulkifli', 4, '-'),
(66, 'Ikmal', 2, '-'),
(67, 'Adhit', 4, '-'),
(68, 'Surianto', 1, '-'),
(69, 'Yonathan', 3, '-'),
(70, 'Zaini', 4, '-'),
(71, 'Fajar', 1, '-'),
(72, 'Bentang', 5, '-'),
(73, 'Bis', 2, '-'),
(74, 'Maliki', 1, '-'),
(75, 'Suryo', 6, '-'),
(76, 'Aminullah', 5, '-'),
(77, 'Rizki', 1, '-'),
(78, 'Hakiem', 5, '-'),
(79, 'Malikussaleh', 5, '-'),
(80, 'Nayaga', 2, '-'),
(81, 'Chairul', 3, '-'),
(82, 'Abdurrasyid', 1, '-'),
(83, 'Nasri', 3, '-'),
(84, 'Satya', 4, '-'),
(85, 'Man', 5, '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bayarzakat`
--
ALTER TABLE `bayarzakat`
  ADD PRIMARY KEY (`id_zakat`),
  ADD KEY `fk_id_jenis` (`id_jenis`);

--
-- Indexes for table `bayar_beras`
--
ALTER TABLE `bayar_beras`
  ADD PRIMARY KEY (`id_bayar_beras`),
  ADD KEY `fk_id_zakat_beras` (`id_zakat`);

--
-- Indexes for table `bayar_uang`
--
ALTER TABLE `bayar_uang`
  ADD PRIMARY KEY (`id_bayar_uang`),
  ADD KEY `fk_id_zakat_uang` (`id_zakat`);

--
-- Indexes for table `jenis_bayar`
--
ALTER TABLE `jenis_bayar`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kategori_mustahik`
--
ALTER TABLE `kategori_mustahik`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `mustahik_lainnya`
--
ALTER TABLE `mustahik_lainnya`
  ADD PRIMARY KEY (`id_mustahiklainnya`),
  ADD KEY `fk_id_kategori_lainnya` (`id_kategori`);

--
-- Indexes for table `mustahik_warga`
--
ALTER TABLE `mustahik_warga`
  ADD PRIMARY KEY (`id_mustahikwarga`),
  ADD KEY `fk_id_kategori_warga` (`id_kategori`);

--
-- Indexes for table `muzakki`
--
ALTER TABLE `muzakki`
  ADD PRIMARY KEY (`id_muzakki`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bayarzakat`
--
ALTER TABLE `bayarzakat`
  MODIFY `id_zakat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bayar_beras`
--
ALTER TABLE `bayar_beras`
  MODIFY `id_bayar_beras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bayar_uang`
--
ALTER TABLE `bayar_uang`
  MODIFY `id_bayar_uang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jenis_bayar`
--
ALTER TABLE `jenis_bayar`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_mustahik`
--
ALTER TABLE `kategori_mustahik`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mustahik_lainnya`
--
ALTER TABLE `mustahik_lainnya`
  MODIFY `id_mustahiklainnya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mustahik_warga`
--
ALTER TABLE `mustahik_warga`
  MODIFY `id_mustahikwarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `muzakki`
--
ALTER TABLE `muzakki`
  MODIFY `id_muzakki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bayarzakat`
--
ALTER TABLE `bayarzakat`
  ADD CONSTRAINT `fk_id_jenis` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_bayar` (`id_jenis`);

--
-- Constraints for table `bayar_beras`
--
ALTER TABLE `bayar_beras`
  ADD CONSTRAINT `fk_id_zakat_beras` FOREIGN KEY (`id_zakat`) REFERENCES `bayarzakat` (`id_zakat`);

--
-- Constraints for table `bayar_uang`
--
ALTER TABLE `bayar_uang`
  ADD CONSTRAINT `fk_id_zakat_uang` FOREIGN KEY (`id_zakat`) REFERENCES `bayarzakat` (`id_zakat`);

--
-- Constraints for table `mustahik_lainnya`
--
ALTER TABLE `mustahik_lainnya`
  ADD CONSTRAINT `fk_id_kategori_lainnya` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_mustahik` (`id_kategori`);

--
-- Constraints for table `mustahik_warga`
--
ALTER TABLE `mustahik_warga`
  ADD CONSTRAINT `fk_id_kategori_warga` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_mustahik` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
