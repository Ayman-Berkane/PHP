-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2024 at 08:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tech-one`
--
CREATE DATABASE IF NOT EXISTS `tech-one` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tech-one`;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'dsadsad', 'addaadad@gmail.com', 'dasdsad', 'adsadasdsa'),
(2, 'dsadsaad', 'dax@gmail.com', 'dsadsadas', 'dsadasdadsa'),
(3, 'ayman', 'ayman.berkane@icloud.com', 'review', 'my review has been taken with care!'),
(4, 'd', 'd@dd.co', 'd', 'd'),
(5, 'piet', 'piet.henk@gmail.com', 'ik will meer producten', 'toppie!');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(999) NOT NULL,
  `img` varchar(999) NOT NULL,
  `description` varchar(9999) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `vendor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `img`, `description`, `price`, `vendor_id`) VALUES
(1, 'AMD Ryzen 5 9600X Processor', 'https://www.megekko.nl/productimg/295030/nw/1_AMD-Ryzen-5-9600X-Processor.jpg', 'De AMD Ryzen 9 9950X is een krachtige 16-core processor uit de Ryzen 9-serie. Met een basiskloksnelheid van 4,30 GHz en een turbokloksnelheid van 5,70 GHz biedt deze processor uitstekende prestaties voor veeleisende toepassingen. Hij is ontworpen voor socket AM5 en ondersteunt AMD Radeon Graphics. Deze processor is een uitstekende keuze voor gebruikers die zoeken naar een high-end CPU met veel cores en krachtige prestaties.', 300.00, 1),
(2, 'Lenovo LOQ 17IRB8 Core i5 RTX 4060 Gaming PC', 'https://www.megekko.nl/productimg/1099097/nw/1_Lenovo-LOQ-17IRB8-Core-i5-RTX-4060-Gaming-PC.jpg', 'De Lenovo LOQ 17IRB8 is een krachtige gaming pc die is uitgerust met een Intel Core i5-13400F processor, 16 GB RAM en een NVIDIA GeForce RTX 4060 grafische kaart met 8 GB videogeheugen. Met een solide 1 TB SSD opslagcapaciteit biedt deze gaming desktop een uitstekende balans tussen prestaties en opslagruimte voor een intensieve gameplay-ervaring. De LOQ 17IRB8 is ontworpen om een breed scala aan moderne games soepel en probleemloos te kunnen draaien.', 899.00, 2),
(3, 'AMD Ryzen 7 7700X Processor', 'https://www.megekko.nl/productimg/294872/nw/1_AMD-Ryzen-7-7700X-Processor.jpg', 'De AMD Ryzen 7 7700X is een krachtige octacore processor uit de nieuwste Ryzen 7 serie. Met een basiskloksnelheid van 4,50 GHz en een turbotakt tot 5,40 GHz, biedt deze processor uitstekende prestaties voor veeleisende taken. De AMD Radeon geïntegreerde grafische oplossing maakt deze CPU geschikt voor een breed scala aan toepassingen. De Ryzen 7 7700X is ontworpen voor Socket AM5, de nieuwste AMD-socket, en wordt geleverd zonder koeler.', 311.00, 1),
(4, 'AMD Ryzen 9 9950X Processor', 'https://www.megekko.nl/productimg/295027/nw/1_AMD-Ryzen-9-9950X-Processor.jpg', 'De AMD Ryzen 9 9950X is een krachtige 16-core processor uit de Ryzen 9-serie. Met een basiskloksnelheid van 4,30 GHz en een turbokloksnelheid van 5,70 GHz biedt deze processor uitstekende prestaties voor veeleisende toepassingen. Hij is ontworpen voor socket AM5 en ondersteunt AMD Radeon Graphics. Deze processor is een uitstekende keuze voor gebruikers die zoeken naar een high-end CPU met veel cores en krachtige prestaties.', 689.00, 1),
(5, 'Intel Core i5-13600K processor', 'https://www.megekko.nl/productimg/310794/nw/1_Intel-Core-i5-13600K-processor.jpg', '104x\r\nDe Intel Core i5-13600K is een krachtige processor uit de 13e generatie Intel Core-serie. Met 14 cores en een basiskloksnelheid van 3,50 GHz biedt deze processor uitstekende prestaties voor veeleisende taken. De geïntegreerde Intel UHD Graphics 770 levert bovendien een solide grafisch vermogen. Deze proces\r\nor is ontworpen voor socket 1700 moederborden en is een uitstekende keuze voor gebruikers op zoek naar een evenwichtige en efficiënte CPU-oplossing.', 277.00, 1),
(6, 'Intel Core i7-13700K processor', 'https://www.megekko.nl/productimg/310792/nw/1_Intel-Core-i7-13700K-processor.jpg', 'De Intel Core i7-13700K processor is een krachtige 16-core CPU uit de populaire Core i7-serie. Met een basiskloksnelheid van 3,40 GHz en de mogelijkheid om te boosten tot hogere frequenties, biedt deze processor uitstekende prestaties voor veeleisende taken. De geïntegreerde Intel UHD Graphics 770 levert bovendien een prima grafische ervaring. Deze socket 1700 processor is perfect voor gebruikers die zowel vermogen als efficiency zoeken in hun desktop-systeem.', 349.00, 1),
(7, 'Intel Core i9-14900KS processor', 'https://www.megekko.nl/productimg/310955/nw/1_Intel-Core-i9-14900KS-processor.jpg', 'De Intel Core i9-14900KS is een krachtige socket 1700 processor met 24 cores en een basiskloksnelheid van 3,20 GHz. Met de geïntegreerde Intel UHD Graphics 770 grafische engine is deze processor een veelzijdige keuze voor veeleisende toepassingen zoals gamen, content creatie en multitasking. Door zijn op prestatie gerichte architectuur en geavanceerde functies biedt de i9-14900KS uitstekende verwerkingskracht voor een breed scala aan taken.', 734.00, 1),
(8, 'MSI MAG Infinite S3', 'https://www.megekko.nl/productimg/1114169/nw/1_MSI-MAG-Infinite-S3-14NUE7-1837EU-i7-14700F-RTX-4070-Gaming-PC.jpg', 'De MSI MAG Infinite S3 14NUE7-1837EU is een krachtige gaming PC die is uitgerust met een Intel Core i7-14700F processor, 16 GB RAM en een NVIDIA GeForce RTX 4070 grafische kaart met 12 GB videogeheugen. Met zijn 20 kernen, 5,40 GHz kloksnelheid en 1 TB SSD-opslagcapaciteit biedt deze PC uitstekende prestaties voor veeleisende games en andere toepassingen. De H610-chipset zorgt voor een solide basis voor een uitstekende gaming-ervaring.', 1599.00, 2),
(9, 'Corsair One i500 Wood Dark Gaming PC', 'https://www.megekko.nl/productimg/100013/nw/1_Corsair-One-i500-Wood-Dark-14900K-4090-64GB-D5-2TBM-2-Gaming-PC.jpg', 'De Corsair One i500 Wood Dark is een krachtige gaming PC voor veeleisende gamers. Uitgerust met een Intel Core i9-14900K processor met 24 cores en turboclocksnelheden tot 6 GHz, 64 GB DDR5 geheugen en een high-end Nvidia GeForce RTX 4090 videokaart met 24 GB VRAM. Deze combinatie biedt meer dan genoeg vermogen voor de meest veeleisende games en content creatie taken. Met een 2 TB SSD-opslag is er ruimte voor een uitgebreide game- en mediabibliotheek. Het elegante houten design past perfect in elke woonkamer of kantoor.', 4699.00, 2),
(10, 'ASUS ROG Strix G13CH-713700053W Core i7 RTX 4070 Gaming PC', 'https://www.megekko.nl/productimg/1148401/nw/1_ASUS-ROG-Strix-G13CH-713700053W-Core-i7-RTX-4070-Gaming-PC.jpg', 'De ASUS ROG Strix G13CH-713700053W is een krachtige gaming pc met een Intel Core i7-13700 processor, 32 GB RAM en een NVIDIA GeForce RTX 4070 grafische kaart. Deze gaming desktop biedt een uitstekende prestatie voor veeleisende games en multitasking. Met een 1 TB SSD voor snelle toegang tot bestanden, is deze pc geschikt voor zowel gaming als productiviteit.', 1569.00, 2),
(11, 'Acer Predator Orion 7000 PO7-655 I9K2664GL Core i9 RTX 4090 Gaming PC', 'https://www.megekko.nl/productimg/1126749/nw/1_Acer-Predator-Orion-7000-PO7-655-I9K2664GL-Core-i9-RTX-4090-Gaming-PC.jpg', '                De Acer Predator Orion 7000 PO7-655 I9K2664GL is een krachtige gaming-pc met een Intel Core i9-14900KF-processor, 24 cores, 64 GB RAM en een Nvidia GeForce RTX 4090-videokaart met 24 GB videogeheugen. Deze PC is uitgerust met een 2 TB SSD en een geavanceerd waterkoelingssysteem, waardoor gebruikers kunnen genieten van een snelle en soepele gaming-ervaring. Dit model is ontworpen voor veeleisende gamers en professionals die behoefte hebben aan topprestaties.            ', 4999.99, 2);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `name` varchar(999) NOT NULL,
  `content` text NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `likes` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `name`, `content`, `rating`, `likes`, `time`, `product_id`) VALUES
(1, 'dasdsa', 'dsadadsa', 0, 5, '2024-10-16 07:59:49', 1),
(2, 'dasdsda', 'dsadas1', 0, 0, '2024-10-16 08:00:28', 3),
(3, 'ayman', 'mooi', 0, 0, '2024-10-16 08:21:18', 1),
(4, 'dasdsadsadsadsa', 'dsasdadsa', 0, 1, '2024-10-18 07:35:50', 3),
(25, 'nee', 'nee', 4, 0, '2024-10-18 08:08:11', 1),
(27, 'Dada', 'dadada', 4, 0, '2024-10-18 09:37:59', 1),
(51, '1', '1', 1, 4, '2024-10-24 09:14:24', 1),
(52, 'jan', 'goed product', 5, 6, '2024-10-24 09:16:10', 1),
(53, '2', '2', 2, 3, '2024-10-25 06:32:22', 1),
(54, 'ayman', 'goed product', 5, 3, '2024-11-03 11:55:20', 1),
(55, '2', '2', 2, 1, '2024-11-03 12:12:52', 1),
(56, 'piet', 'geweldig', 3, 3, '2024-11-05 14:45:21', 1),
(57, 'piet', 'prima', 4, 1, '2024-11-05 14:47:12', 4),
(59, 'Peter', '3', 3, 3, '2024-11-14 08:37:08', 1),
(60, 'piet', '2', 3, 1, '2024-11-18 14:54:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `role` enum('member','admin','store_employee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `first_name`, `last_name`, `img`, `role`) VALUES
(1, 'admin@techone.com', '$2y$10$XU2Vs7BKmyqdI0RIx6HCT.gtYGaHVxppcFH8bo0TOvhsic3Z03kBu', 'Piet', 'Klaasen', 'uploads/674decf06b3d8_image.jpeg', 'admin'),
(8, 'peter.klaas@gmail.com', '$2y$10$keRHCJTy7apjhBCVQZ3yCuDh/iNm/mxcYb/pcXuFTUgKnns07piLm', 'Peter', 'Klaas', 'uploads/674def8b24d3b_How-to-Get-a-JPG-File-with-High-Resolution-Tools-and-Tips.jpg', 'member'),
(9, 'ayman.berkane@icloud.com', '$2y$10$rv/2sBnfbVqBwHzZVqdkze3T46dcyKNBgVh7AyRz3bH/P8wKesHQS', 'Ayman', 'Berkane', '', 'member'),
(11, 'store-employee@techone.com', '$2y$10$JB7GMAlM0ndqISKOIP6KSeFzaFUGcf3ayRJkCTOkwyNc3HYcHu4qa', 'Hans', 'Frederick', 'uploads/674edc69f16c1_GettyImages-473983321__1_.jpg', 'store_employee');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(999) NOT NULL,
  `img` varchar(999) NOT NULL,
  `description` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `img`, `description`) VALUES
(1, 'Hardware', 'https://i.ytimg.com/vi/x-zSLV2nweU/maxresdefault.jpg', 'Check it out!'),
(2, 'Pre Builts', 'https://www.digitalstorm.com/img/desktop-gaming-pcs.webp', 'Check it out!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
