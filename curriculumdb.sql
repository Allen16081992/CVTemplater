-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 15 jun 2023 om 19:39
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
(3, 'Hallo', '$2y$10$mSx2augsaJ1Af1dprLStduM9tMLRCaJQ4mISkiePmdKLExwmd/sBW', 'hallo@yuger.nl');

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
(1, 'Duel Academy', 'Island prospects and resources.', 'KaibaCorp', '2017-06-11', '2023-06-02', 1, 3),
(6, 'Artillery Operator', 'I have skills in shooting on coördinates.', 'Military School', '1920-01-01', '1921-01-01', 4, 2);

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
(1, 'Necromancer', 'As a necromancer, I harness the power of ressurection.', 'Gravecorp', '2013-06-11', '2023-06-04', 1, 3),
(6, 'Sturmbannführer', 'Als SS bevelhebber veeg ik dorpjes van de kaart voor saus.', 'Waffen-SS', '1938-04-26', '1944-08-13', 4, 2),
(7, 'Aartsbisschop', 'Als Aartsbisschop vervul ik een hoge rang in de kerk voor een wijntje.', 'Rooms-Katholieke Kerk', '1945-01-09', '1951-12-31', 3, 2);

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
(1, 'Swimming', 4, 2);

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
(1, 'Spanish', 4, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `profile`
--

CREATE TABLE `profile` (
  `profileID` int(11) NOT NULL,
  `profileintro` varchar(255) DEFAULT NULL,
  `profiledesc` varchar(255) DEFAULT NULL,
  `filePath` varchar(255) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `resumeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `profile`
--

INSERT INTO `profile` (`profileID`, `profileintro`, `profiledesc`, `filePath`, `fileName`, `resumeID`, `userID`) VALUES
(2, 'acdcdsdvvds', 'vdsvds', '../img/avatars/648b43dd3b4c1_EnemyPress.jpg', '648b43dd3b4c1_EnemyPress.jpg', 3, 2);

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
(2, 'Clown', 3),
(3, 'Bishbaalkin', 2),
(4, 'Novigrod Police', 2);

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
(1, 'Writer', 4, 2);

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
  ADD PRIMARY KEY (`eduID`);

--
-- Indexen voor tabel `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`workID`);

--
-- Indexen voor tabel `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`interestID`);

--
-- Indexen voor tabel `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`langID`);

--
-- Indexen voor tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profileID`),
  ADD KEY `resumeID` (`resumeID`,`userID`);

--
-- Indexen voor tabel `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`resumeID`),
  ADD KEY `fk_resume_accounts` (`userID`);

--
-- Indexen voor tabel `technical`
--
ALTER TABLE `technical`
  ADD PRIMARY KEY (`techID`),
  ADD KEY `fk_technical_resume` (`userID`);

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
  MODIFY `eduID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `experience`
--
ALTER TABLE `experience`
  MODIFY `workID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT voor een tabel `profile`
--
ALTER TABLE `profile`
  MODIFY `profileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `resume`
--
ALTER TABLE `resume`
  MODIFY `resumeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `technical`
--
ALTER TABLE `technical`
  MODIFY `techID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
