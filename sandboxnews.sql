-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 07, 2023 at 11:40 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SandBoxNews`
--

-- --------------------------------------------------------

--
-- Table structure for table `sandboxnews`
--

CREATE TABLE `sandboxnews` (
  `id` int(20) NOT NULL,
  `Titre` varchar(255) NOT NULL,
  `Alias` varchar(255) NOT NULL,
  `Contenu` longtext NOT NULL,
  `Dateajout` date NOT NULL,
  `Datemaj` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sandboxnews`
--

INSERT INTO `sandboxnews` (`id`, `Titre`, `Alias`, `Contenu`, `Dateajout`, `Datemaj`) VALUES
(1, 'Test', 'Test', 'Hello World', '2023-12-08', '2023-12-09'),
(2, 'Test2', 'Test2', 'Hello', '2023-12-15', '2023-12-10'),
(3, 'Test3', 'Test3', 'Hello World', '2023-12-09', '2023-12-10'),
(4, 'Test4', 'Test4', 'Hello Hasler', '2023-12-16', '2023-12-10'),
(5, 'Test de recrutement', 'TR-Enet Business', 'Hello Manoel', '2023-12-09', '2023-12-17'),
(6, 'Test5', 'Test5', 'Hello World', '2023-12-17', '2023-12-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sandboxnews`
--
ALTER TABLE `sandboxnews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sandboxnews`
--
ALTER TABLE `sandboxnews`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
