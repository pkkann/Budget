-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Vært: localhost
-- Genereringstid: 05. 03 2018 kl. 15:50:20
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
  `name` varchar(45) COLLATE utf8_danish_ci NOT NULL,
  `inserttimestamp` int(10) NOT NULL,
  `updatetimestamp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Data dump for tabellen `budget`
--

INSERT INTO `budget` (`id`, `name`, `inserttimestamp`, `updatetimestamp`) VALUES
(3, 'Patrick', 1520249716, 1520249716),
(4, 'Thea', 1520249756, 1520249756);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `post`
--

CREATE TABLE `post` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8_danish_ci NOT NULL,
  `type` enum('expense','income') COLLATE utf8_danish_ci NOT NULL,
  `budget_id` int(10) UNSIGNED NOT NULL,
  `createtimestamp` int(10) NOT NULL,
  `updatetimestamp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

--
-- Data dump for tabellen `post`
--

INSERT INTO `post` (`id`, `name`, `type`, `budget_id`, `createtimestamp`, `updatetimestamp`) VALUES
(1, 'Fælles budget', 'expense', 3, 1520256768, 1520256768),
(2, 'Fælles rådighed', 'expense', 3, 1520256795, 1520256795),
(3, 'Løn', 'income', 3, 1520256842, 1520256842);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tilføj AUTO_INCREMENT i tabel `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
