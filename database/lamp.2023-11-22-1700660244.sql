-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: database
-- Generation Time: Jan 06, 2024 at 11:45 AM
-- Server version: 5.7.29
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lamp`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar`
--

CREATE TABLE `pendaftar` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `semester` int(11) NOT NULL,
  `status_bayar` tinyint(1) NOT NULL DEFAULT '0',
  `jenis_matakuliah` varchar(20) NOT NULL,
  `berkas` varchar(100) NOT NULL,
  `status_ajuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftar`
--

INSERT INTO `pendaftar` (`id`, `nama`, `email`, `hp`, `semester`, `status_bayar`, `jenis_matakuliah`, `berkas`, `status_ajuan`) VALUES
(24, 'Muhammad Irfani', '20104037@ittelkom-pwt.ac.id', '911', 6, 1, 'A', 'example.pdf', 'belum di verifikasi'),
(25, 'Hank Voigh', 'hank@fbi.gov', '911', 1, 0, 'A', 'example.pdf', 'belum di verifikasi'),
(27, 'Muhammad Irfani', '20104037@ittelkom-pwt.ac.id', '911', 3, 0, 'C', 'example.pdf', 'belum di verifikasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
