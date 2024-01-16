-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 12:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `removal`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `actorID` varchar(50) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`actorID`, `Lastname`, `Firstname`) VALUES
('A1', 'Worthington', 'Sam'),
('A2', 'Seagal', 'Steven'),
('A3', 'Jones', 'Tommy Lee');

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `dirID` varchar(50) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`dirID`, `Lastname`, `Firstname`) VALUES
('D1', 'Mc Graw', 'Tim'),
('D2', 'Cameroon', 'James');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `mno` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`mno`, `title`, `genre`) VALUES
('111', 'Avatar', 'Adventure'),
('222', 'Under Siege', 'Action'),
('333', 'Home Alone', 'Comedy');

-- --------------------------------------------------------

--
-- Table structure for table `movie_actedin`
--

CREATE TABLE `movie_actedin` (
  `ID` int(11) NOT NULL,
  `mno` varchar(50) DEFAULT NULL,
  `actorNo` varchar(50) DEFAULT NULL,
  `dirID` varchar(50) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_actedin`
--

INSERT INTO `movie_actedin` (`ID`, `mno`, `actorNo`, `dirID`, `role`) VALUES
(1, '222', 'A2', 'D1', 'Lead Actor'),
(2, '111', 'A1', 'D2', 'Lead Actor'),
(3, '222', 'A3', 'D1', 'Supporting Actor');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('admin', 'admin'),
('dessa', 'dessa'),
('joanna', '12345'),
('sindeh', 'sindeh'),
('sindehMarie', 'sindehMarie');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`actorID`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`dirID`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`mno`);

--
-- Indexes for table `movie_actedin`
--
ALTER TABLE `movie_actedin`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `actorNo` (`actorNo`),
  ADD KEY `dirID` (`dirID`),
  ADD KEY `mno` (`mno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie_actedin`
--
ALTER TABLE `movie_actedin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movie_actedin`
--
ALTER TABLE `movie_actedin`
  ADD CONSTRAINT `movie_actedin_ibfk_1` FOREIGN KEY (`actorNo`) REFERENCES `actor` (`actorID`),
  ADD CONSTRAINT `movie_actedin_ibfk_2` FOREIGN KEY (`dirID`) REFERENCES `director` (`dirID`),
  ADD CONSTRAINT `movie_actedin_ibfk_3` FOREIGN KEY (`mno`) REFERENCES `movie` (`mno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
