-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost:3306
-- Čas generovania: So 21.Mar 2020, 15:49
-- Verzia serveru: 5.7.28-31-log
-- Verzia PHP: 7.3.11-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `skarduino`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `chat_vykurovanie`
--

CREATE TABLE `chat_vykurovanie` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `text` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `data_vykurovanie`
--

CREATE TABLE `data_vykurovanie` (
  `id` int(11) NOT NULL,
  `teplota1` float NOT NULL,
  `teplota2` float NOT NULL,
  `teplota3` float NOT NULL,
  `teplota4` float NOT NULL,
  `teplota5` float NOT NULL,
  `teplota6` float NOT NULL,
  `code` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `teplomery_vykurovanie`
--

CREATE TABLE `teplomery_vykurovanie` (
  `id` int(11) NOT NULL,
  `teplomer1` text NOT NULL,
  `teplomer2` text NOT NULL,
  `teplomer3` text NOT NULL,
  `teplomer4` text NOT NULL,
  `teplomer5` text NOT NULL,
  `teplomer6` text NOT NULL,
  `cislo` int(11) NOT NULL,
  `referencia` float NOT NULL,
  `hystereza` float NOT NULL,
  `rezim` text NOT NULL,
  `stav` text NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user_vykurovanie`
--

CREATE TABLE `user_vykurovanie` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `mikrokontroler` text NOT NULL,
  `hardver` text NOT NULL,
  `activated` int(11) NOT NULL,
  `code` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `chat_vykurovanie`
--
ALTER TABLE `chat_vykurovanie`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `data_vykurovanie`
--
ALTER TABLE `data_vykurovanie`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `teplomery_vykurovanie`
--
ALTER TABLE `teplomery_vykurovanie`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `user_vykurovanie`
--
ALTER TABLE `user_vykurovanie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `chat_vykurovanie`
--
ALTER TABLE `chat_vykurovanie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `data_vykurovanie`
--
ALTER TABLE `data_vykurovanie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `teplomery_vykurovanie`
--
ALTER TABLE `teplomery_vykurovanie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `user_vykurovanie`
--
ALTER TABLE `user_vykurovanie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
