-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2016 alle 17:43
-- Versione del server: 5.6.15-log
-- PHP Version: 5.5.8

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
-- Struttura della tabella `predecessore`
--

CREATE TABLE IF NOT EXISTS `predecessore` (
  `IdT` int(11) NOT NULL DEFAULT '0',
  `IdP` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdT`,`IdP`),
  KEY `IdP` (`IdP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `predecessore`
--

INSERT INTO `predecessore` (`IdT`, `IdP`) VALUES
(92, 91);

-- --------------------------------------------------------

--
-- Struttura della tabella `progetto`
--

CREATE TABLE IF NOT EXISTS `progetto` (
  `Id_Progetto` int(5) NOT NULL AUTO_INCREMENT,
  `Titolo` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_Progetto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Dump dei dati per la tabella `progetto`
--

INSERT INTO `progetto` (`Id_Progetto`, `Titolo`) VALUES
(93, ''),
(94, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `risorsa`
--

CREATE TABLE IF NOT EXISTS `risorsa` (
  `Id_Risorsa` int(5) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(20) NOT NULL,
  `Costo_O` int(5) NOT NULL,
  `Percentuale_U` int(20) NOT NULL,
  `Id_Task_E` int(5) NOT NULL,
  `Tipo_E` varchar(10) NOT NULL,
  PRIMARY KEY (`Id_Risorsa`),
  KEY `Id_Task_E` (`Id_Task_E`),
  KEY `Tipo_E` (`Tipo_E`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `Id_Task` int(5) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(20) NOT NULL,
  `Durata` int(10) NOT NULL,
  `Partenza` date NOT NULL,
  `EarlyStart` date DEFAULT NULL,
  `LateStart` date DEFAULT NULL,
  `Id_Progetto_E` int(5) NOT NULL,
  `Num_Task` int(5) NOT NULL,
  PRIMARY KEY (`Id_Task`),
  KEY `Id_Progetto_E` (`Id_Progetto_E`),
  KEY `Num_Task` (`Num_Task`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dump dei dati per la tabella `task`
--

INSERT INTO `task` (`Id_Task`, `Nome`, `Durata`, `Partenza`, `EarlyStart`, `LateStart`, `Id_Progetto_E`, `Num_Task`) VALUES
(90, 'primo', 1, '0000-00-00', NULL, NULL, 93, 1),
(91, 'primo', 0, '0000-00-00', NULL, NULL, 94, 1),
(92, 'secondo', 30, '2000-01-23', NULL, NULL, 94, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `Tipo` varchar(10) NOT NULL,
  PRIMARY KEY (`Tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tipo`
--

INSERT INTO `tipo` (`Tipo`) VALUES
('Materiale'),
('Umana');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `predecessore`
--
ALTER TABLE `predecessore`
  ADD CONSTRAINT `Predecessore_ibfk_1` FOREIGN KEY (`IdT`) REFERENCES `task` (`Id_Task`),
  ADD CONSTRAINT `Predecessore_ibfk_2` FOREIGN KEY (`IdP`) REFERENCES `task` (`Id_Task`);

--
-- Limiti per la tabella `risorsa`
--
ALTER TABLE `risorsa`
  ADD CONSTRAINT `Risorsa_ibfk_1` FOREIGN KEY (`Id_Task_E`) REFERENCES `task` (`Id_Task`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Risorsa_ibfk_2` FOREIGN KEY (`Tipo_E`) REFERENCES `tipo` (`Tipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`Id_Progetto_E`) REFERENCES `progetto` (`Id_Progetto`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
