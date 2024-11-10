-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 01:44 PM
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
-- Database: `sekolah3`
--

-- --------------------------------------------------------

--
-- Table structure for table `11`
--

CREATE TABLE `11` (
  `A` varchar(255) DEFAULT NULL,
  `B` varchar(255) DEFAULT NULL,
  `C` varchar(255) DEFAULT NULL,
  `D` varchar(255) DEFAULT NULL,
  `Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `11`
--

INSERT INTO `11` (`A`, `B`, `C`, `D`, `Number`) VALUES
('fisika', 'ekonomi', 'kimia', 'english TL', 1),
('matematika TL', 'biologi', 'jepang', NULL, 2),
('matematika TL', 'sosiologi', 'informatika', 'korea', 3),
('ekonomi', 'geografi', 'mandarin', 'literasi', 4),
('informatika', 'kimia', 'english TL', 'literasi', 5),
('sosiologi', 'biologi', 'jerman', 'literasi', 6);

-- --------------------------------------------------------

--
-- Table structure for table `11wajib`
--

CREATE TABLE `11wajib` (
  `mapelid` varchar(255) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `guru` varchar(255) NOT NULL,
  `ppguru` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `11wajib`
--

INSERT INTO `11wajib` (`mapelid`, `mapel`, `guru`, `ppguru`) VALUES
('bk', 'bk', 'guru bk', ''),
('eng', 'bahasa inggris', 'guru eng', ''),
('erc', 'erc', 'guru erc', ''),
('idn', 'bahasa indonesia', 'guru bindo', ''),
('mat', 'matematika', 'guru mat', ''),
('or', 'olahraga', 'guru or', ''),
('pai', 'pai', 'guru pai', '../upload/guru/fauzi/671726db17e35_1729570523.jpg'),
('pkn', 'ppkn', 'guru pkn', ''),
('sej', 'sejarah', 'guru sej', ''),
('sun', 'bahasa sunda', 'guru sun', '');

-- --------------------------------------------------------

--
-- Table structure for table `12`
--

CREATE TABLE `12` (
  `Number` int(11) NOT NULL,
  `A` varchar(255) DEFAULT NULL,
  `B` varchar(255) DEFAULT NULL,
  `C` varchar(255) DEFAULT NULL,
  `D` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `12`
--

INSERT INTO `12` (`Number`, `A`, `B`, `C`, `D`) VALUES
(1, 'sosiologi', 'jepang', NULL, NULL),
(2, 'english TL', 'geografi', NULL, NULL),
(3, 'biologi', 'ekonomi', NULL, NULL),
(4, 'matematika TL', 'sosiologi', NULL, NULL),
(5, 'informatika', 'kimia', 'english', NULL),
(6, 'fisika', 'ekonomi', 'kimia', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas__112`
--

CREATE TABLE `kelas__112` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `kelaspmt` varchar(255) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `ppImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas__112`
--

INSERT INTO `kelas__112` (`id`, `fullname`, `username`, `kelaspmt`, `mapel`, `ppImg`) VALUES
(8, 'muhammad fauzi ramadhani', 'fauzi', '1A2A3C4D5B6B', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kelas__guru`
--

CREATE TABLE `kelas__guru` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `kelaspmt` varchar(255) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `ppImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas__guru`
--

INSERT INTO `kelas__guru` (`id`, `fullname`, `username`, `kelaspmt`, `mapel`, `ppImg`) VALUES
(9, 'user1234', 'user', '1A,6A', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `username`, `kelas`, `password_hash`) VALUES
(8, 'muhammad fauzi ramadhani', 'fauzi', '112', '$2y$10$CM3wxfgHwMpQ2UpkkevKz.nHxUcLZ.0HPsoHvLYW0IJanpRY/miMW'),
(9, 'user1234', 'user', 'guru', '$2y$10$cKQAzyTcEE9fRLmiUK4jM.ilGItWjxBSZwJlq5vThrlAmNyDuujiK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `11`
--
ALTER TABLE `11`
  ADD PRIMARY KEY (`Number`) USING BTREE;

--
-- Indexes for table `11wajib`
--
ALTER TABLE `11wajib`
  ADD PRIMARY KEY (`mapelid`);

--
-- Indexes for table `12`
--
ALTER TABLE `12`
  ADD PRIMARY KEY (`Number`);

--
-- Indexes for table `kelas__112`
--
ALTER TABLE `kelas__112`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas__guru`
--
ALTER TABLE `kelas__guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas__112`
--
ALTER TABLE `kelas__112`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelas__guru`
--
ALTER TABLE `kelas__guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
