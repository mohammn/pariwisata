-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2022 at 08:42 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pariwisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id` int(11) NOT NULL,
  `idWisata` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id`, `idWisata`, `jumlah`, `tanggal`) VALUES
(2, 1, 12, '2022-06-21'),
(3, 1, 4, '2022-06-22'),
(4, 1, 23, '2022-06-22'),
(5, 1, 12, '2022-06-22'),
(6, 1, 2211, '2022-06-22'),
(7, 1, 12, '2022-06-21'),
(8, 1, 11, '2022-06-22'),
(9, 1, 12, '2022-06-23'),
(12, 7, 11, '2022-06-22'),
(13, 7, 14, '2022-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(256) NOT NULL,
  `rule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `rule`) VALUES
(1, 'admin', 'admin', '$2y$10$VRRoHGGneuOtT1IfR1yc1ewpEz2bp4GyDfOjg5seECrsw9kwgQzy6', 1),
(7, 'anis fitria', 'anis7', '$2y$10$VRRoHGGneuOtT1IfR1yc1ewpEz2bp4GyDfOjg5seECrsw9kwgQzy6', 2),
(8, 'amin sandi', 'amin8', '$2y$10$VRRoHGGneuOtT1IfR1yc1ewpEz2bp4GyDfOjg5seECrsw9kwgQzy6', 2),
(11, 'tes user edit', 'tes11', '$2y$10$skBTT3hwOO8ODkc0zg6ty.9rAcFmo0FWjoQ65RjJt8UMWb7iaqTIe', 2);

-- --------------------------------------------------------

--
-- Table structure for table `wisata`
--

CREATE TABLE `wisata` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `foto` varchar(32) NOT NULL,
  `deskripsi` text NOT NULL,
  `latitude` varchar(8) NOT NULL,
  `longitude` varchar(8) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `operator` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wisata`
--

INSERT INTO `wisata` (`id`, `nama`, `alamat`, `foto`, `deskripsi`, `latitude`, `longitude`, `tanggal`, `operator`) VALUES
(1, 'Pantai Selopeng', 'Sumenep', 'kamaledit.jpg', 'Pantai pasir putih yang indah', '22', '12', '0000-00-00 00:00:00', 8),
(4, 'sungai', 'jawa', 'sungai.jpeg', 'sungai terpanjang', '14', '11', '2022-06-17 09:45:42', 7),
(7, 'tes edit', 'tes', 'tesedit.jpg', 'kjjk', '88', '99', '2022-06-22 12:18:09', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idWisata` (`idWisata`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operator` (`operator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD CONSTRAINT `pengunjung_ibfk_1` FOREIGN KEY (`idWisata`) REFERENCES `wisata` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
