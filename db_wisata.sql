-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 19, 2024 at 05:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `paket_wisata`
--

CREATE TABLE `paket_wisata` (
  `id` int NOT NULL,
  `nama_paket` varchar(255) DEFAULT NULL,
  `gambar_url` text,
  `youtube_link` text,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paket_wisata`
--

INSERT INTO `paket_wisata` (`id`, `nama_paket`, `gambar_url`, `youtube_link`, `deskripsi`) VALUES
(2, 'Wisata Alam Bunga Rafflessia', 'https://asset.kompas.com/crops/FttoZhan2Auu-tplwbFucDOfIUM=/3x0:996x662/750x500/data/photo/2022/01/25/61ef9ca74ad26.jpg', 'https://youtu.be/8S0nhcjI3Qg?si=5f82g5TuhMfRg46x', 'Melihat proses mekarnya bunga terbesar di dunia pada habitat aslinya'),
(4, 'Tour Benteng Marlborough', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/Front_gate_of_Fort_Marlborough%2C_Bengkulu_2015-04-19_02.jpg/413px-Front_gate_of_Fort_Marlborough%2C_Bengkulu_2015-04-19_02.jpg', 'https://youtu.be/GJW6bSsDIAA?si=mQqt26Ltj8P1pT38', 'Benteng peninggalan Inggris terbesar di Asia Tenggara');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_hp` varchar(20) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `durasi` int NOT NULL,
  `jumlah_peserta` int NOT NULL,
  `penginapan` varchar(5) DEFAULT NULL,
  `transportasi` varchar(5) DEFAULT NULL,
  `makanan` varchar(5) DEFAULT NULL,
  `total_tagihan` decimal(10,2) NOT NULL,
  `tanggal_daftar` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `nama`, `nomor_hp`, `tempat`, `durasi`, `jumlah_peserta`, `penginapan`, `transportasi`, `makanan`, `total_tagihan`, `tanggal_daftar`) VALUES
(8, 'Fiqri', '085158560066', 'wisata rafflesia', 1, 2, 'Ya', 'Ya', 'Tidak', 4400000.00, '2024-08-16 17:25:19'),
(10, 'Budi', '081122334455', 'benteng marlborough', 3, 4, 'Ya', 'Tidak', 'Tidak', 12000000.00, '2024-08-17 03:57:47'),
(11, 'Andi', '0822334455', 'benteng marlborough', 2, 6, 'Ya', 'Ya', 'Ya', 32400000.00, '2024-08-17 04:11:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `paket_wisata`
--
ALTER TABLE `paket_wisata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paket_wisata`
--
ALTER TABLE `paket_wisata`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
