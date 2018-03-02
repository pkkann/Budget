-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Vært: localhost
-- Genereringstid: 02. 03 2018 kl. 15:29:33
-- Serverversion: 10.1.30-MariaDB
-- PHP-version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `budget`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `budget`
--

CREATE TABLE `budget` (
  `id` int(11) UNSIGNED NOT NULL,
  `year` int(4) UNSIGNED NOT NULL,
  `inserttimestamp` int(10) NOT NULL,
  `updatetimestamp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Data dump for tabellen `budget`
--

INSERT INTO `budget` (`id`, `year`, `inserttimestamp`, `updatetimestamp`) VALUES
(1, 2018, 1519999230, 1519999230),
(2, 2017, 1520000614, 1520000614);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `post`
--

CREATE TABLE `post` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(75) COLLATE utf8_danish_ci NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `type` int(1) UNSIGNED NOT NULL,
  `budget_id` int(11) UNSIGNED NOT NULL,
  `inserttimestamp` int(10) NOT NULL,
  `updatetimestamp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Data dump for tabellen `post`
--

INSERT INTO `post` (`id`, `name`, `amount`, `type`, `budget_id`, `inserttimestamp`, `updatetimestamp`) VALUES
(1, 'Husleje', '5600.00', 0, 1, 1520000067, 1520000067);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(75) COLLATE utf8_danish_ci NOT NULL,
  `username` varchar(75) COLLATE utf8_danish_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_danish_ci NOT NULL,
  `updatetimestamp` int(10) NOT NULL,
  `inserttimestamp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Data dump for tabellen `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `updatetimestamp`, `inserttimestamp`) VALUES
(1, 'Patrick Kann', 'pk', '$2y$10$YkbALQoEC2gEN5s6eyJsU./uIwnrfF5dFPnT97ep8ikt8Ix9WTeaC', 1519994674, 1519994674);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year` (`year`);

--
-- Indeks for tabel `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `POST_BUDGET` (`budget_id`);

--
-- Indeks for tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tilføj AUTO_INCREMENT i tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `POST_BUDGET` FOREIGN KEY (`budget_id`) REFERENCES `budget` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
