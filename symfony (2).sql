-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 jun 2018 om 20:04
-- Serverversie: 10.1.30-MariaDB
-- PHP-versie: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `datepicker` date NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `appointment_firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customer`
--

CREATE TABLE `customer` (
  `id` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone_number` int(40) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `gender`, `adress`, `zipcode`, `date_of_birth`, `email`, `telephone_number`, `city`, `country`, `image_url`) VALUES
(1, 'Lion', 'Siek', 'sdsds', 'sqewds', '2492WR', '2020-03-09', 'lions2000@live.nl', 627302816, 'Den Haag', 'Nederland', 'sdsdsds');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `factuur`
--

CREATE TABLE `factuur` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `factuur`
--

INSERT INTO `factuur` (`id`, `date`, `userId`) VALUES
(1, '2018-06-12 00:00:00', 1),
(2, '2018-06-12 23:19:34', 1),
(3, '2018-06-12 23:20:13', 1),
(4, '2018-06-12 23:20:23', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'Lion', 'lion', 'lions2000@live.nl', 'lions2000@live.nl', 1, NULL, '$2y$13$SVxs93Vy0ksF.O3MyMTWze7RCxnbIuvUX0nFNFBJK0FiAp/9LllpG', '2018-05-28 22:31:28', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(10) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_price`, `category`, `description`, `image_url`) VALUES
(1, 'Mooie ding', 20, 'mooie dingen', 'hele mooie ding', 'sdsdsd'),
(2, 'Mooie ding', 7643, 'mooie dingen', 'hele mooie ding', '50064a1f5d06f0ac826b03beb646d21c.jpeg'),
(3, 'Mooie ding', 54, 'mooie dingen', 'hele mooie ding', 'e0a425585d4e5d32e69f193f74135545.jpeg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `regel`
--

CREATE TABLE `regel` (
  `id` int(11) NOT NULL,
  `aantal` double DEFAULT NULL,
  `factuurId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `regel`
--

INSERT INTO `regel` (`id`, `aantal`, `factuurId`, `productId`) VALUES
(1, 1, 4, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `first_name`, `last_name`) VALUES
(1, 'Lion', 'lion', 'lions2000@live.nl', 'lions2000@live.nl', 1, NULL, '$2y$13$Dq1PK1ikz1AJ4mULs9VqAuCQy7RwJ32vILzPksPygCxNU.fUEgRGa', '2018-06-13 23:25:51', NULL, NULL, 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}', 'Lion', 'Siek');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `factuur`
--
ALTER TABLE `factuur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3214771064B64DCC` (`userId`);

--
-- Indexen voor tabel `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `regel`
--
ALTER TABLE `regel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_58DE2CB7AE1E8728` (`factuurId`),
  ADD KEY `IDX_58DE2CB736799605` (`productId`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `factuur`
--
ALTER TABLE `factuur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `regel`
--
ALTER TABLE `regel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `factuur`
--
ALTER TABLE `factuur`
  ADD CONSTRAINT `FK_3214771064B64DCC` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `regel`
--
ALTER TABLE `regel`
  ADD CONSTRAINT `FK_58DE2CB736799605` FOREIGN KEY (`productId`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FK_58DE2CB7AE1E8728` FOREIGN KEY (`factuurId`) REFERENCES `factuur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
