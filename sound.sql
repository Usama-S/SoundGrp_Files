-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 03:23 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sound`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `artistId` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `coverPhoto` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `artistId`, `description`, `coverPhoto`) VALUES
(1, 'national', 1, 'national songs', 'cover.jpg'),
(3, 'moseeqi', 3, 'classical moseeqi', '84738387-stock-vector-generic-semi-trailer-truck.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'atif aslam'),
(3, 'amjad sabri');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phoneNumber` bigint(20) NOT NULL,
  `userTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `password`, `phoneNumber`, `userTypeId`) VALUES
(1, 'jack', 'jack@sound.com', 'admin_123', 90078601, 2),
(2, 'harry', 'harry@gmail.com', 'harry_123', 90078601, 1),
(3, 'test', 'test@gmail.com', 'test123', 6786786, 1);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'rock'),
(2, 'pop'),
(3, 'jazz'),
(4, 'classical'),
(6, 'waste genre_delete');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `language` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`) VALUES
(1, 'urdu'),
(2, 'english');

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `artistId` int(11) NOT NULL,
  `albumId` int(11) DEFAULT NULL,
  `genreId` int(11) NOT NULL,
  `languageId` int(11) NOT NULL,
  `releaseDate` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `source` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id`, `title`, `artistId`, `albumId`, `genreId`, `languageId`, `releaseDate`, `description`, `source`) VALUES
(1, 'Pak Sarzameen', 1, 1, 4, 1, '2020-10-14', 'a simple national song', 'tajdar-e-haram.mp3'),
(2, 'Tajdar -e- Haram', 3, 1, 4, 1, '2020-10-15', 'amjad sabri\'s kalam', 'tajdar-e-haram.mp3'),
(14, 'Hola', 3, 3, 1, 2, '2019-11-29', 'sorry, we\'re out of descriptions.', 'tajdar-e-haram.mp3'),
(17, 'hello', 3, 3, 1, 2, '2019-11-29', 'sorry', 'tajdar-e-haram.mp3'),
(18, 'Check1', 3, NULL, 2, 1, '2018-12-30', 'sorry', 'tajdar-e-haram.mp3'),
(19, 'yeah', 1, NULL, 2, 1, '2020-12-31', 'hello null id', 'tajdar-e-haram.mp3'),
(21, 'remix', 1, 1, 1, 1, '2020-12-24', 'a classical music in a new way', 'tajdar-e-haram1.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `musicratings`
--

CREATE TABLE `musicratings` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `musicId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `musicratings`
--

INSERT INTO `musicratings` (`id`, `userId`, `rating`, `musicId`) VALUES
(1, 2, 4, 2),
(4, 2, 1, 2),
(5, 3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `musicreviews`
--

CREATE TABLE `musicreviews` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `musicId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `musicreviews`
--

INSERT INTO `musicreviews` (`id`, `userId`, `comment`, `musicId`) VALUES
(1, 2, 'This is a very good audio.', 2),
(5, 3, 'worst song', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phoneNumber` bigint(20) NOT NULL,
  `userTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phoneNumber`, `userTypeId`) VALUES
(1, 'jack', 'jack@sound.com', 'admin_123', 90078601, 2),
(2, 'harry', 'harry@gmail.com', 'harry_123', 90078601, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`id`, `name`) VALUES
(1, 'standard'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `videoratings`
--

CREATE TABLE `videoratings` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `rating` float NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videoratings`
--

INSERT INTO `videoratings` (`id`, `userId`, `rating`, `videoId`) VALUES
(1, 3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `videoreviews`
--

CREATE TABLE `videoreviews` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `artistId` int(11) NOT NULL,
  `albumId` int(11) DEFAULT NULL,
  `genreId` int(11) NOT NULL,
  `languageId` int(11) NOT NULL,
  `releaseDate` date NOT NULL,
  `description` varchar(500) NOT NULL,
  `source` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `artistId`, `albumId`, `genreId`, `languageId`, `releaseDate`, `description`, `source`) VALUES
(1, 'Warriyo', 3, 3, 1, 2, '2016-12-15', 'default song just for testing', 'https://www.youtube.com/watch?v=yJg-Y5byMMw'),
(2, 'invisible', 1, 1, 1, 2, '2018-10-27', 'Julius Dreisig & Zeus X Crona - Invisible [NCS Release]', 'https://www.youtube.com/watch?v=QglaLzo_aPk'),
(3, 'happy birthday', 1, 1, 1, 1, '2020-12-31', 'happy happy birthday', 'https://www.youtube.com/watch?v=PoBq0rqzuX0'),
(4, 'hbd', 1, NULL, 2, 2, '2020-11-30', 'a new happy birthday song', 'https://www.youtube.com/watch?v=PoBq0rqzuX0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artistId` (`artistId`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userTypeId` (`userTypeId`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albumId` (`albumId`),
  ADD KEY `artistId` (`artistId`),
  ADD KEY `genreId` (`genreId`),
  ADD KEY `languageId` (`languageId`);

--
-- Indexes for table `musicratings`
--
ALTER TABLE `musicratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `musicId` (`musicId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `musicreviews`
--
ALTER TABLE `musicreviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `musicId` (`musicId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videoratings`
--
ALTER TABLE `videoratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `videoId` (`videoId`);

--
-- Indexes for table `videoreviews`
--
ALTER TABLE `videoreviews`
  ADD KEY `userId` (`userId`),
  ADD KEY `videoId` (`videoId`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albumId` (`albumId`),
  ADD KEY `artistId` (`artistId`),
  ADD KEY `genreId` (`genreId`),
  ADD KEY `languageId` (`languageId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `musicratings`
--
ALTER TABLE `musicratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `musicreviews`
--
ALTER TABLE `musicreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `videoratings`
--
ALTER TABLE `videoratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`artistId`) REFERENCES `artists` (`id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`userTypeId`) REFERENCES `usertypes` (`id`);

--
-- Constraints for table `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `music_ibfk_1` FOREIGN KEY (`albumId`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `music_ibfk_2` FOREIGN KEY (`artistId`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `music_ibfk_3` FOREIGN KEY (`genreId`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `music_ibfk_4` FOREIGN KEY (`languageId`) REFERENCES `languages` (`id`);

--
-- Constraints for table `musicratings`
--
ALTER TABLE `musicratings`
  ADD CONSTRAINT `musicratings_ibfk_1` FOREIGN KEY (`musicId`) REFERENCES `music` (`id`),
  ADD CONSTRAINT `musicratings_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `employee` (`id`);

--
-- Constraints for table `musicreviews`
--
ALTER TABLE `musicreviews`
  ADD CONSTRAINT `musicreviews_ibfk_1` FOREIGN KEY (`musicId`) REFERENCES `music` (`id`),
  ADD CONSTRAINT `musicreviews_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `employee` (`id`);

--
-- Constraints for table `videoratings`
--
ALTER TABLE `videoratings`
  ADD CONSTRAINT `videoratings_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `videoratings_ibfk_2` FOREIGN KEY (`videoId`) REFERENCES `videos` (`id`);

--
-- Constraints for table `videoreviews`
--
ALTER TABLE `videoreviews`
  ADD CONSTRAINT `videoreviews_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `videoreviews_ibfk_2` FOREIGN KEY (`videoId`) REFERENCES `videos` (`id`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`albumId`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `videos_ibfk_2` FOREIGN KEY (`artistId`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `videos_ibfk_3` FOREIGN KEY (`genreId`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `videos_ibfk_4` FOREIGN KEY (`languageId`) REFERENCES `languages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
