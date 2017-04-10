-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Apr 2017 um 23:56
-- Server-Version: 10.1.21-MariaDB
-- PHP-Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `csv_import`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sheet_data`
--

DROP TABLE IF EXISTS `sheet_data`;
CREATE TABLE `sheet_data` (
  `uid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL DEFAULT 'NOT NULL',
  `lastname` varchar(50) NOT NULL DEFAULT 'NOT NULL',
  `school` varchar(255) NOT NULL DEFAULT 'NOT NULL',
  `email` varchar(255) NOT NULL DEFAULT 'NOT NULL',
  `subscriber` int(11) NOT NULL,
  `registration` datetime NOT NULL,
  `commit` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `sheet_data`
--
ALTER TABLE `sheet_data`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `sheet_data`
--
ALTER TABLE `sheet_data`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
