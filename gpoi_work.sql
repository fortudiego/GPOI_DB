-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Mar 07, 2016 alle 15:32
-- Versione del server: 5.5.47-0ubuntu0.14.04.1
-- Versione PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gpoi_work`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Predecessore`
--

CREATE TABLE IF NOT EXISTS `Predecessore` (
  `IdT` int(11) NOT NULL DEFAULT '0',
  `IdP` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdT`,`IdP`),
  KEY `IdP` (`IdP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Predecessore`
--

INSERT INTO `Predecessore` (`IdT`, `IdP`) VALUES
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `Risorsa`
--

CREATE TABLE IF NOT EXISTS `Risorsa` (
  `Id_Risorsa` int(5) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(20) NOT NULL,
  `Costo_O` int(5) NOT NULL,
  `Percentuale_U` int(20) NOT NULL,
  `Id_Task_E` int(5) NOT NULL,
  `Tipo_E` varchar(10) NOT NULL,
  PRIMARY KEY (`Id_Risorsa`),
  KEY `Id_Task_E` (`Id_Task_E`),
  KEY `Tipo_E` (`Tipo_E`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `Risorsa`
--

INSERT INTO `Risorsa` (`Id_Risorsa`, `Nome`, `Costo_O`, `Percentuale_U`, `Id_Task_E`, `Tipo_E`) VALUES
(1, 'Gabriele', 500, 50, 1, 'Materiale');

-- --------------------------------------------------------

--
-- Struttura della tabella `Task`
--

CREATE TABLE IF NOT EXISTS `Task` (
  `Id_Task` int(5) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(20) NOT NULL,
  `Durata` int(10) NOT NULL,
  `EarlyStart` date DEFAULT NULL,
  `LateStart` date DEFAULT NULL,
  PRIMARY KEY (`Id_Task`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `Task`
--

INSERT INTO `Task` (`Id_Task`, `Nome`, `Durata`, `EarlyStart`, `LateStart`) VALUES
(1, 'Creazione DB', 20, '2016-03-07', '2016-03-10'),
(2, 'Prova', 10, '2016-03-10', NULL),
(3, 'Realizzazione Piano', 30, '2016-03-17', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `Tipo`
--

CREATE TABLE IF NOT EXISTS `Tipo` (
  `Tipo` varchar(10) NOT NULL,
  PRIMARY KEY (`Tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Tipo`
--

INSERT INTO `Tipo` (`Tipo`) VALUES
('Materiale'),
('Umana');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Predecessore`
--
ALTER TABLE `Predecessore`
  ADD CONSTRAINT `Predecessore_ibfk_1` FOREIGN KEY (`IdT`) REFERENCES `Task` (`Id_Task`),
  ADD CONSTRAINT `Predecessore_ibfk_2` FOREIGN KEY (`IdP`) REFERENCES `Task` (`Id_Task`);

--
-- Limiti per la tabella `Risorsa`
--
ALTER TABLE `Risorsa`
  ADD CONSTRAINT `Risorsa_ibfk_2` FOREIGN KEY (`Tipo_E`) REFERENCES `Tipo` (`Tipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Risorsa_ibfk_1` FOREIGN KEY (`Id_Task_E`) REFERENCES `Task` (`Id_Task`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
