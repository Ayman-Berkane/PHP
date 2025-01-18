-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 11 dec 2024 om 10:14
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartphone4u`
--
CREATE DATABASE IF NOT EXISTS `smartphone4u` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `smartphone4u`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `smartphone`
--

CREATE TABLE `smartphone` (
  `id` int(11) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `memory` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `price` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `smartphone`
--

INSERT INTO `smartphone` (`id`, `vendor`, `name`, `memory`, `color`, `price`) VALUES
(1, 'Samsung', 'Galaxy S24', 256, 'Zwart', 799.50),
(2, 'Samsung', 'Galaxy A35', 128, 'Donkerblauw', 379.00),
(3, 'Apple', 'Iphone 14', 128, 'Zwart', 749.00),
(4, 'Apple', 'Iphone 15', 170, 'Geel', 819.00),
(6, 'Samsung', 'Galaxy A36-2', 124, 'Zwart', 250.00),
(7, 'Apple', 'Iphone 16', 256, 'Silver', 1009.00);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `smartphone`
--
ALTER TABLE `smartphone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `smartphone`
--
ALTER TABLE `smartphone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
