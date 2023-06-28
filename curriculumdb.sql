-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 28 jun 2023 om 14:45
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `curriculumdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts`
--

CREATE TABLE `accounts` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `accounts`
--

INSERT INTO `accounts` (`userID`, `username`, `password`, `email`) VALUES
(1, 'test', '$2y$10$DIf2wwLBCD2ZuCzHZFtJvub84eFfqilLCCplX7YgveQiTQS9r5n4W', 'test@test.com'),
(3, 'Hallo', '$2y$10$UQgj5c2excyl7qvVc/DBOuqMl55FFw58BVcYl1I9bYgkMxUbu7uMi', 'hallo@yahoo.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `contactID` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `birth` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `streetname` varchar(255) DEFAULT NULL,
  `postalcode` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `contact`
--

INSERT INTO `contact` (`contactID`, `phone`, `firstname`, `lastname`, `birth`, `nationality`, `streetname`, `postalcode`, `city`, `userID`) VALUES
(1, '06311224455', 'test', 'test', '07/06/2023', 'dutch', 'sickstreet 1', '100020vv', 'delft', 1),
(3, '0635899654', 'Hallohallo', 'Pendulum', '9/6/1999', 'Japanese', 'Cemetery 8', '1010XD', 'Nagikawa', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `education`
--

CREATE TABLE `education` (
  `eduID` int(11) NOT NULL,
  `edutitle` varchar(50) DEFAULT NULL,
  `edudesc` varchar(255) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `firstDate` date DEFAULT NULL,
  `lastDate` date DEFAULT NULL,
  `resumeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `experience`
--

CREATE TABLE `experience` (
  `workID` int(11) NOT NULL,
  `worktitle` varchar(50) DEFAULT NULL,
  `workdesc` varchar(255) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `firstDate` date DEFAULT NULL,
  `lastDate` date DEFAULT NULL,
  `resumeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `interests`
--

CREATE TABLE `interests` (
  `interestID` int(11) NOT NULL,
  `interest` varchar(50) DEFAULT NULL,
  `resumeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `languages`
--

CREATE TABLE `languages` (
  `langID` int(11) NOT NULL,
  `language` varchar(50) DEFAULT NULL,
  `resumeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `profile`
--

CREATE TABLE `profile` (
  `profileID` int(11) NOT NULL,
  `profileintro` varchar(255) DEFAULT NULL,
  `profiledesc` varchar(255) DEFAULT NULL,
  `filePath` varchar(255) DEFAULT NULL,
  `fileName` varchar(255) DEFAULT NULL,
  `resumeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `resume`
--

CREATE TABLE `resume` (
  `resumeID` int(11) NOT NULL,
  `resumetitle` varchar(50) DEFAULT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `technical`
--

CREATE TABLE `technical` (
  `techID` int(11) NOT NULL,
  `techtitle` varchar(50) DEFAULT NULL,
  `resumeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactID`),
  ADD KEY `contact` (`userID`);

--
-- Indexen voor tabel `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`eduID`),
  ADD KEY `fk_edu_user` (`userID`),
  ADD KEY `fk_edu_res` (`resumeID`);

--
-- Indexen voor tabel `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`workID`),
  ADD KEY `fk_exp_user` (`userID`),
  ADD KEY `fk_exp_res` (`resumeID`);

--
-- Indexen voor tabel `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`interestID`),
  ADD KEY `fk_int_user` (`userID`),
  ADD KEY `fk_int_res` (`resumeID`);

--
-- Indexen voor tabel `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`langID`),
  ADD KEY `fk_lang_user` (`userID`),
  ADD KEY `fk_lang_res` (`resumeID`);

--
-- Indexen voor tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profileID`),
  ADD KEY `fk_prof_user` (`userID`),
  ADD KEY `fk_prof_res` (`resumeID`);

--
-- Indexen voor tabel `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`resumeID`),
  ADD KEY `fk_res_user` (`userID`);

--
-- Indexen voor tabel `technical`
--
ALTER TABLE `technical`
  ADD PRIMARY KEY (`techID`),
  ADD KEY `fk_tech_user` (`userID`),
  ADD KEY `fk_tech_res` (`resumeID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `accounts`
--
ALTER TABLE `accounts`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `education`
--
ALTER TABLE `education`
  MODIFY `eduID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `experience`
--
ALTER TABLE `experience`
  MODIFY `workID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `interests`
--
ALTER TABLE `interests`
  MODIFY `interestID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `languages`
--
ALTER TABLE `languages`
  MODIFY `langID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `profile`
--
ALTER TABLE `profile`
  MODIFY `profileID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `resume`
--
ALTER TABLE `resume`
  MODIFY `resumeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `technical`
--
ALTER TABLE `technical`
  MODIFY `techID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `fk_edu_res` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_edu_user` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `fk_exp_res` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_exp_user` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `interests`
--
ALTER TABLE `interests`
  ADD CONSTRAINT `fk_int_res` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_int_user` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `fk_lang_res` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lang_user` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_prof_res` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prof_user` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `fk_res_user` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `technical`
--
ALTER TABLE `technical`
  ADD CONSTRAINT `fk_tech_res` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tech_user` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
