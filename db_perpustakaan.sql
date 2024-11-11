-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 05:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(200) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `tahun_terbit` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `nama_publisher` varchar(100) NOT NULL,
  `nama_penulis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `foto`, `isbn`, `tahun_terbit`, `harga`, `stok`, `nama_publisher`, `nama_penulis`) VALUES
(16, 'Pemrograman Web', 'Belum ada gambar', '978-1-2345-6781-1', 2014, 75000, 11, 'Juan', 'Dzaki'),
(17, 'Rekayasa Sistem Informasi', 'Belum ada gambar', '978-1-23456-789-5', 2010, 55000, 15, 'Miko', 'Ical'),
(18, 'Dasar Sistem Informasi', 'Belum ada gambar', '978-1-23456-789-12', 2019, 45000, 8, 'Fachrel', 'Tsaqif'),
(24, 'Keamanan Data', 'Belum ada gambar', '978-602-0143-56-1', 2018, 75000, 15, 'Ganapati', 'Abduh'),
(25, 'Desain UI/UX', 'Belum ada gambar', '978-602-0184-92-7', 2009, 45000, 5, 'Valen', 'Made'),
(27, 'Dasar Sistem Informasi', 'Belum ada gambar', '978-1-2345-6781-1', 2009, 98000, 5, 'Fachrel', 'Dzaki');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_user`, `email`, `password`) VALUES
(1, 'syahrul@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL,
  `nama_penulis` varchar(100) NOT NULL,
  `usia` int(11) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama_penulis`, `usia`, `phone`, `email`) VALUES
(3, 'Dzaki', 20, '08653568991', 'dzaki@gmail.com'),
(4, 'Ical', 20, '08656533431', 'Ical@gmail.com'),
(5, 'Tsaqif', 20, '08765435361', 'tsaqif@gmail.com'),
(8, 'Abduh', 20, '08909090112', 'abduh@gmail.com'),
(9, 'Made', 20, '08989748332', 'made@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id_publisher` int(11) NOT NULL,
  `nama_publisher` varchar(100) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `tahun_berdiri` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id_publisher`, `nama_publisher`, `alamat`, `tahun_berdiri`) VALUES
(3, 'Juan', 'Pondok Labu', '2014-02-10'),
(4, 'Miko', 'Pondok Gede', '2024-11-09'),
(5, 'Fachrel', 'Tangerang', '2018-02-09'),
(8, 'Ganapati', 'Bekasi', '2014-06-10'),
(9, 'Valen', 'Pasar Minggu', '2006-06-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `nama_penulis` (`nama_penulis`),
  ADD KEY `nama_publisher` (`nama_publisher`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`),
  ADD UNIQUE KEY `nama_penulis` (`nama_penulis`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id_publisher`),
  ADD UNIQUE KEY `nama_publisher` (`nama_publisher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id_publisher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`nama_publisher`) REFERENCES `publisher` (`nama_publisher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`nama_penulis`) REFERENCES `penulis` (`nama_penulis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
