-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 03:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tunetube`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `AlbumID` int(100) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `ReleaseDate` date DEFAULT NULL,
  `ArtistID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`AlbumID`, `Title`, `ReleaseDate`, `ArtistID`) VALUES
(4, 'Dionela', '2024-12-18', 4),
(8, 'MoiraAlbum', '2024-12-19', 5),
(17, 'Ed Sheeran', '2024-12-12', 7),
(18, 'Sugarcane', '2024-12-14', 9),
(19, 'Hale', '2024-12-25', 26),
(20, 'Album 1', '2024-12-17', 3),
(23, 'Album 2', '2024-12-14', 8),
(24, 'Whatsup', '2024-12-12', 3),
(26, 'Album 3', '2024-12-24', 4);

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `ArtistID` int(100) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Genre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`ArtistID`, `Name`, `Genre`) VALUES
(3, 'Bobby McFerrin', 'Pop'),
(4, 'Dionela ft. Jay-R', 'Pop'),
(5, 'Moira Dela Torreee', 'Pop Soul'),
(7, 'Ed Sheeran', 'Pop'),
(8, 'Kurt Fick', 'Pop'),
(9, 'Sugarcane', 'Pop'),
(26, 'Hale', 'Rock'),
(27, 'Bruno Mars', 'Pop'),
(28, 'Tj Monterde', 'Pop');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `FavoriteID` int(100) NOT NULL,
  `UserID` int(100) NOT NULL,
  `SongID` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`FavoriteID`, `UserID`, `SongID`) VALUES
(115, 1, 3),
(114, 1, 4),
(113, 1, 6),
(127, 1, 29),
(128, 1, 50),
(116, 25, 3),
(135, 25, 29),
(132, 44, 3),
(133, 44, 4);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `SongID` int(100) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Duration` time DEFAULT NULL,
  `FilePath` varchar(200) NOT NULL,
  `AlbumID` int(100) DEFAULT NULL,
  `ArtistID` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`SongID`, `Title`, `Duration`, `FilePath`, `AlbumID`, `ArtistID`) VALUES
(3, 'Dont Worry Be Happy', '00:03:51', 'music/song.mp3', 20, 3),
(4, 'Sining', '00:03:20', 'music/sining.mp3', 4, 4),
(6, 'Sundo', '00:04:35', 'music/sundo.mp3', 8, 5),
(28, 'Way Label', '00:04:34', 'music/67516811b6652-WayLabel-AngeloRudy(OfficialMusicVideo)_205.mp3', NULL, NULL),
(29, 'Babalik Sa\'yo', '00:05:07', 'music/6751684a53041-BabalikSayo.mp3', 8, 5),
(31, 'Puhon', '00:03:47', 'music/675168d76e9d3-KurtFick-Puhon(OfficialMusicVideo)_427.mp3', NULL, 8),
(48, 'Tagu-taguan', '00:04:06', 'music/675bfda8c7843-tagu-taguan.mp3', 8, 5),
(49, 'Kumpas', '00:04:28', 'music/675bfddaf2422-Kumpas.mp3', 8, 5),
(50, 'Tagpuan', '00:04:39', 'music/675c1fcc6c914-tagpuan.mp3', 8, 5),
(51, 'Malaya', '00:04:09', 'music/675c20c069e10-Malaya.mp3', 8, 5),
(52, 'Leonora', '00:03:54', 'music/675c212030479-SUGARCANE-Leonora(OfficialLyricVideo)_695.mp3', NULL, 9),
(53, 'A team', '00:04:50', 'music/675c235592300-The A Team- Ed Sheeran lyrics.mp3', 17, 7),
(58, 'Tenerife Sea', '00:04:01', 'music/67624fa813e0f-Tenerife Sea.mp3', 17, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(100) NOT NULL,
  `Username` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Role` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `Role`) VALUES
(1, 'Jayrald Bernales', '$2y$10$3YytOfapnm8j7e468yXYnepWwqdgPHPn.7kbvIAOAddY/qH/4EcqW', 'user@edu.ph', 'User'),
(22, 'Admin', '$2y$10$9fYnDXZcrc2dqrFrEGfQ9u9FHeQZPvK49U0XSFemr1KfkHxckUno.', 'admin@edu.ph', 'Admin'),
(25, 'Jay Rald', '$2y$10$HWeGDxRKgDHT1pOmaGdcKOZVy2iq3lPqp9cl6SpIeJmc7jPEn/Dw6', 'bernalesj28@gmail.com', 'User'),
(29, 'Jay1', '$2y$10$LSBV1uWhEHA3/0BLn1Vff.tTLYq/NsaPpGYVruc2BYPI4G9OWmTB2', 'user@edu.ph1', 'User'),
(30, 'Jay2', '$2y$10$qvN.q9xrjZHy5FU4CUUp1e4wQU7WQuQvvFwItvvAcc8p.DwSzke0a', 'user@edu.ph2', 'User'),
(31, 'Jay3', '$2y$10$C0DELlku5m0e3vk2HAV7fe0rD.B3LsNRQf2OP18L81K02l0wVzqza', 'user@edu.ph3', 'User'),
(32, 'Jay4', '$2y$10$piK2HrfOofgr9JVgxE1lUunGc2NKFfJ3k61k6rmJeJjSiwo2NHK/e', 'user@edu.ph4', 'User'),
(33, 'Jay5', '$2y$10$WNJn5I8IiKORi98JjfZj0eUjuOfmTk5Xqplw5VlObg0axNhkghnSC', 'user@edu.ph5', 'User'),
(34, 'Jay6', '$2y$10$le2YqKi0wGP1Nn2ZBT3/N.rgT.69Pfhn54vke/pRjJCAhfADwNgPG', 'user@edu.ph6', 'User'),
(35, 'Jay7', '$2y$10$DcYE2kSBtit1/dpRJWU.WeoR/HqeigKv55rYt4FBCP6XxPKG9f6Zm', 'user@edu.ph7', 'User'),
(36, 'Jay8', '$2y$10$rvzPy8haK6rsBuZy7CbCuuEQjzswcPByz44TqBWSUmT6RGOC5Z6xG', 'user@edu.ph8', 'User'),
(44, 'jay', '$2y$10$Wm8Z8NmRnOtKgyBWAgKnK.s1wVbRGf1m/eatd2uglKyTXLiEf7Lwa', 'jay@edu.ph', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`AlbumID`),
  ADD KEY `ArtistID` (`ArtistID`),
  ADD KEY `idx_album_release` (`ReleaseDate`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`ArtistID`),
  ADD KEY `idx_artist_genre` (`Genre`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`FavoriteID`),
  ADD UNIQUE KEY `user_song_unique` (`UserID`,`SongID`),
  ADD KEY `SongID` (`SongID`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`SongID`),
  ADD KEY `AlbumID` (`AlbumID`),
  ADD KEY `idx_song_artist` (`ArtistID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `AlbumID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `ArtistID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `FavoriteID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `SongID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`ArtistID`) REFERENCES `artists` (`ArtistID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`SongID`) REFERENCES `songs` (`SongID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`AlbumID`) REFERENCES `albums` (`AlbumID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`ArtistID`) REFERENCES `artists` (`ArtistID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
