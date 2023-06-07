-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 06 jun 2023 om 15:23
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
(2, 'Aaltje', '$2y$10$2NVwcUH7PiS4P7S7lxN7gevUGCEujO4IHuT0NBb7r1Bn6QJyzUM0q', 'aaltje@gmail.com'),
(3, 'Hallo', '$2y$10$mSx2augsaJ1Af1dprLStduM9tMLRCaJQ4mISkiePmdKLExwmd/sBW', 'hallo@yug.nl');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `contactID` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `birth` date DEFAULT NULL,
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
(1, '06311224455', 'test', 'test', '2023-06-30', 'dutch', 'sickstreet 1', '100020vv', 'delft', 1),
(2, '0631244569', 'Aaltje', 'Veldhoven', '2023-05-19', 'Dutch', 'Keileweg 6', '3021AZ', 'Rotterdam', 2),
(3, '+310063145578', 'Hallohallo', 'Hallo', '2023-06-04', 'Japanese', 'Haunted Maisonnette 3', '1010XD', 'Tokigawa', 3);

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

--
-- Gegevens worden geëxporteerd voor tabel `education`
--

INSERT INTO `education` (`eduID`, `edutitle`, `edudesc`, `company`, `firstDate`, `lastDate`, `resumeID`, `userID`) VALUES
(1, 'Duel Academy', 'Island prospects and resources.', 'KaibaCorp', '2017-06-11', '2023-06-02', 1, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `experience`
--

CREATE TABLE `experience` (
  `workID` int(11) NOT NULL,
  `worktitle` varchar(255) DEFAULT NULL,
  `workdesc` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `firstDate` date DEFAULT NULL,
  `lastDate` date DEFAULT NULL,
  `resumeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `experience`
--

INSERT INTO `experience` (`workID`, `worktitle`, `workdesc`, `company`, `firstDate`, `lastDate`, `resumeID`, `userID`) VALUES
(1, 'Necromancer', 'As a necromancer, I harness the power of ressurection.', 'Gravecorp', '2013-06-11', '2023-06-04', 1, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `interests`
--

CREATE TABLE `interests` (
  `interestID` int(11) NOT NULL,
  `interest` varchar(255) DEFAULT NULL,
  `resumeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `interests`
--

INSERT INTO `interests` (`interestID`, `interest`, `resumeID`, `userID`) VALUES
(1, 'Dueling', 1, 3);

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

--
-- Gegevens worden geëxporteerd voor tabel `languages`
--

INSERT INTO `languages` (`langID`, `language`, `resumeID`, `userID`) VALUES
(1, 'Zombie', 1, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `portfolio`
--

CREATE TABLE `portfolio` (
  `portfolioID` int(11) NOT NULL,
  `IMGtitle` varchar(255) DEFAULT NULL,
  `IMGpath` varchar(255) DEFAULT NULL,
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
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `resumeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `profile`
--

INSERT INTO `profile` (`profileID`, `profileintro`, `profiledesc`, `file_path`, `file_name`, `resumeID`, `userID`) VALUES
(1, 'Hi, I am Hallo.', NULL, '', '', 1, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `resume`
--

CREATE TABLE `resume` (
  `resumeID` int(11) NOT NULL,
  `resumetitle` varchar(50) DEFAULT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `resume`
--

INSERT INTO `resume` (`resumeID`, `resumetitle`, `userID`) VALUES
(1, 'Tzeentch Coordinator', 3),
(2, 'Beleidsadviseur', 3),
(3, 'Winkelmedewerker', 3);

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
-- Gegevens worden geëxporteerd voor tabel `technical`
--

INSERT INTO `technical` (`techID`, `techtitle`, `resumeID`, `userID`) VALUES
(1, 'Nation building', 1, 3);

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
  ADD KEY `fk1` (`userID`);

--
-- Indexen voor tabel `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`eduID`),
  ADD KEY `fk2` (`userID`),
  ADD KEY `college` (`resumeID`);

--
-- Indexen voor tabel `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`workID`),
  ADD KEY `fk3` (`userID`),
  ADD KEY `work` (`resumeID`);

--
-- Indexen voor tabel `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`interestID`),
  ADD KEY `fk4` (`userID`),
  ADD KEY `hobby` (`resumeID`);

--
-- Indexen voor tabel `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`langID`),
  ADD KEY `fk5` (`userID`),
  ADD KEY `lang` (`resumeID`);

--
-- Indexen voor tabel `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`portfolioID`),
  ADD KEY `fk6` (`userID`),
  ADD KEY `port` (`resumeID`);

--
-- Indexen voor tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profileID`),
  ADD KEY `fk7` (`userID`),
  ADD KEY `profile` (`resumeID`);

--
-- Indexen voor tabel `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`resumeID`),
  ADD KEY `fk8` (`userID`);

--
-- Indexen voor tabel `technical`
--
ALTER TABLE `technical`
  ADD PRIMARY KEY (`techID`),
  ADD KEY `fk9` (`userID`),
  ADD KEY `tech` (`resumeID`);

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
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `education`
--
ALTER TABLE `education`
  MODIFY `eduID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `experience`
--
ALTER TABLE `experience`
  MODIFY `workID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `interests`
--
ALTER TABLE `interests`
  MODIFY `interestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `languages`
--
ALTER TABLE `languages`
  MODIFY `langID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `portfolioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `profile`
--
ALTER TABLE `profile`
  MODIFY `profileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `resume`
--
ALTER TABLE `resume`
  MODIFY `resumeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `technical`
--
ALTER TABLE `technical`
  MODIFY `techID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `college` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `fk3` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `interests`
--
ALTER TABLE `interests`
  ADD CONSTRAINT `fk4` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hobby` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `fk5` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lang` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `portfolio`
--
ALTER TABLE `portfolio`
  ADD CONSTRAINT `fk6` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `port` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk7` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `fk8` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `technical`
--
ALTER TABLE `technical`
  ADD CONSTRAINT `fk9` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tech` FOREIGN KEY (`resumeID`) REFERENCES `resume` (`resumeID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
