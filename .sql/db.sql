-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Feb 10, 2023 at 12:07 PM
-- Server version: 5.7.40
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `name`) VALUES
(1, 'junior garçon'),
(2, 'senior fille'),
(3, 'senior garçon'),
(4, 'junior fille');

-- --------------------------------------------------------

--
-- Table structure for table `categorie_club`
--

CREATE TABLE `categorie_club` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie_club`
--

INSERT INTO `categorie_club` (`id`, `club_id`, `categorie_id`) VALUES
(7, 4, 4),
(8, 4, 1),
(9, 4, 2),
(10, 4, 3),
(11, 3, 4),
(12, 3, 1),
(13, 3, 2),
(14, 3, 3),
(15, 5, 4),
(16, 5, 1),
(17, 5, 2),
(18, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`id`, `name`, `num`) VALUES
(3, 'Lannion', 22007),
(4, 'Guingamp ', 22012),
(5, 'Plérin', 22038);

-- --------------------------------------------------------

--
-- Table structure for table `joueur`
--

CREATE TABLE `joueur` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `birth` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `license` varchar(11) NOT NULL,
  `categorie_club_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `joueur`
--

INSERT INTO `joueur` (`id`, `firstname`, `lastname`, `birth`, `email`, `license`, `categorie_club_id`) VALUES
(45, 'Lohya', 'Nicolas', '2017-06-01', 'nico.pro@gmail.com', '6715008', 14),
(46, 'testUser', 'testUser', '2017-06-01', 'testUser@gmail.com', '7995536', 17),
(47, 'testUser', 'testUser', '2017-06-01', 'testUser@gmail.com', '0098634', 12),
(48, 'testUser', 'testUser', '2017-06-01', 'testUser@gmail.com', '5181925', 17),
(49, 'testUser', 'testUser', '2017-06-01', 'testUser@gmail.com', '9346924', 12),
(50, 'testUser', 'testUser', '2017-06-01', 'testUser@gmail.com', '4887120', 12),
(51, 'testUser', 'testUser', '2017-06-01', 'testUser@gmail.com', '1835723', 16),
(52, 'testUser', 'testUser', '2017-06-01', 'testUser@gmail.com', '6300292', 14),
(53, 'testUser', 'testUser', '2017-06-01', 'testUser@gmail.com', '9112103', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorie_club`
--
ALTER TABLE `categorie_club`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_club_fk0` (`club_id`),
  ADD KEY `categorie_club_fk1` (`categorie_id`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categori_club` (`categorie_club_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categorie_club`
--
ALTER TABLE `categorie_club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categorie_club`
--
ALTER TABLE `categorie_club`
  ADD CONSTRAINT `categorie_club_fk0` FOREIGN KEY (`club_id`) REFERENCES `club` (`id`),
  ADD CONSTRAINT `categorie_club_fk1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Constraints for table `joueur`
--
ALTER TABLE `joueur`
  ADD CONSTRAINT `fk_categori_club` FOREIGN KEY (`categorie_club_id`) REFERENCES `categorie_club` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
