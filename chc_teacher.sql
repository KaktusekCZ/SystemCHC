-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 20. lis 2018, 10:33
-- Verze serveru: 10.1.34-MariaDB
-- Verze PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `chcsystem`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `chc_teacher`
--

CREATE TABLE `chc_teacher` (
  `id` int(255) NOT NULL,
  `teacher_id` int(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `verify` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `chc_teacher`
--

INSERT INTO `chc_teacher` (`id`, `teacher_id`, `hash`, `email`, `verify`) VALUES
(14, 65, 'f4d9d74c1321dfde1efd90828796eb8f', 'pikosek35@gmail.com', 0);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `chc_teacher`
--
ALTER TABLE `chc_teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `chc_teacher`
--
ALTER TABLE `chc_teacher`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
