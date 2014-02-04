-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 04. Feb 2014 um 10:07
-- Server Version: 5.5.28-0ubuntu0.12.04.2
-- PHP-Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `programmkalender`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sendung_id` int(11) NOT NULL,
  `startdatum` int(11) NOT NULL,
  `tag` int(11) NOT NULL,
  `tagesliste` varchar(255) NOT NULL,
  `monatsliste` varchar(255) NOT NULL,
  `startzeit` time NOT NULL,
  `dauer_std` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `redaktionen`
--

CREATE TABLE IF NOT EXISTS `redaktionen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `redaktionsname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sendungen`
--

CREATE TABLE IF NOT EXISTS `sendungen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sendungsname` varchar(255) NOT NULL,
  `redaktion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `termine`
--

CREATE TABLE IF NOT EXISTS `termine` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `beginn` int(11) NOT NULL,
  `dauer_std` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `termin_blacklist`
--

CREATE TABLE IF NOT EXISTS `termin_blacklist` (
  `sendungs_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  PRIMARY KEY (`sendungs_id`,`datum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
