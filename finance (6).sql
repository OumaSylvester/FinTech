-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 01:17 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `billId` int(11) NOT NULL,
  `employeeID` mediumint(6) UNSIGNED NOT NULL,
  `billImage` varchar(128) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `billingDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`billId`, `employeeID`, `billImage`, `price`, `billingDate`) VALUES
(6, 42, '1679823883_belitasscore.gif', '50000.00', '2023-03-26 09:44:43'),
(7, 42, '1679823892_kennysscore.gif', '10000.00', '2023-03-26 09:44:52'),
(8, 42, '1679823900_pacosscore.gif', '70000.00', '2023-03-26 09:45:01'),
(9, 42, '1679823911_unverified.gif', '100000.00', '2023-03-26 09:45:11'),
(13, 42, '1680718746_board-computer-chip-data-processing-thumbnail2.jpg', '678888.00', '2023-04-09 08:59:28'),
(14, 42, '1681029453_board-computer-chip-data-processing-thumbnail5.jpg', '500000.69', '2023-04-09 08:59:19'),
(15, 42, '1681030834_vietes-trigonometric diagram.png', '2000.90', '2023-04-09 09:00:34'),
(16, 42, '1681303447_board-computer-chip-data-processing-thumbnail.jpg', '678888.00', '2023-04-12 12:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `budgetID` mediumint(6) UNSIGNED NOT NULL,
  `projectManagerID` mediumint(6) UNSIGNED NOT NULL,
  `financeManagerID` mediumint(6) UNSIGNED DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `budgetDescription` varchar(250) NOT NULL,
  `approved` tinytext DEFAULT NULL,
  `dateRequested` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`budgetID`, `projectManagerID`, `financeManagerID`, `amount`, `budgetDescription`, `approved`, `dateRequested`) VALUES
(1, 41, 45, '50000.00', 'Information technology', 'yes', '2023-03-26 15:47:37'),
(2, 41, 45, '999999.99', 'Hire 5 Software Programmers', 'yes', '2023-03-26 17:01:08'),
(5, 41, NULL, '60000.00', 'Test Request Budget', NULL, '2023-04-17 12:41:24'),
(6, 41, NULL, '5000000.00', 'Project Employee Payment', NULL, '2023-04-17 12:42:43'),
(7, 41, NULL, '1000000000.00', 'Restracturing the Internet', NULL, '2023-04-17 12:43:53');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `projectId` mediumint(6) UNSIGNED NOT NULL,
  `projectName` varchar(60) NOT NULL,
  `projectClassification` varchar(60) NOT NULL,
  `expenses` decimal(12,2) NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp(),
  `approved` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectId`, `projectName`, `projectClassification`, `expenses`, `dateAdded`, `approved`) VALUES
(1, 'Web development', 'Information Technology', '50000.00', '2023-03-23 14:57:22', ''),
(3, 'Roof top Finishing', 'Building and Construction', '100000.00', '2023-03-23 14:57:22', ''),
(4, 'Education Support', 'Phylanthropy', '20000.00', '2023-03-23 15:50:03', ''),
(5, 'Advertisement', 'Marketing', '10000.00', '2023-03-23 15:51:13', ''),
(6, 'System Security', 'Information Technology', '400000.00', '2023-03-23 15:51:50', ''),
(32, 'Railway Construction', 'Loans', '500000.00', '2023-04-05 21:11:01', ''),
(33, 'Railway Construction', 'Loans', '500000.00', '2023-04-05 21:14:03', ''),
(34, 'Railway Construction', 'Loans', '500000.00', '2023-04-05 21:15:06', ''),
(54, 'Railway Construction', 'Loans', '5.00', '2023-04-09 11:31:06', ''),
(56, 'Source Code Control', 'Information Technology', '40000.50', '2023-04-09 11:35:43', '');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` mediumint(6) UNSIGNED NOT NULL,
  `task_name` varchar(60) NOT NULL,
  `task_description` varchar(250) NOT NULL,
  `project_id` mediumint(6) UNSIGNED NOT NULL,
  `finished` tinyint(2) NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `task_description`, `project_id`, `finished`, `dateAdded`) VALUES
(2, 'Landing Page Design', 'UI design\r\nUX design', 1, 0, '2023-04-06 17:31:44'),
(3, 'Backend Design', 'Login Design\r\nLogout Design, Logic design, Login Programming', 1, 0, '2023-04-06 22:21:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` mediumint(6) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_pic` varchar(128) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `password` char(60) NOT NULL,
  `registration_date` datetime NOT NULL,
  `user_level` smallint(6) UNSIGNED NOT NULL,
  `address1` varchar(50) NOT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `state_country` char(25) NOT NULL,
  `zcode_pcode` char(10) NOT NULL,
  `phone` char(15) DEFAULT NULL,
  `secret` varchar(30) NOT NULL,
  `title` varchar(60) NOT NULL,
  `approved` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `profile_pic`, `date_of_birth`, `password`, `registration_date`, `user_level`, `address1`, `address2`, `city`, `state_country`, `zcode_pcode`, `phone`, `secret`, `title`, `approved`) VALUES
(1, 'Mike', 'Rosoft', 'miker@myisp.com', '', NULL, '$2y$10$UiiBhmXca.0/bwopveFq8uInuX.EVrecinUQYQG546WjAWwZLJNoe', '2017-12-06 08:43:41', 0, '4 The Street', 'The Village', 'Townsville', 'USA', 'WA', '0123777888', '', '', NULL),
(2, 'Jack', 'Smith', 'jsmith@outcook.com', '', NULL, '$2y$10$NjlsajfCITeb.oDXqu9Neuguh3PBKL5EaqZ5ClfW76nVSnW.W.XNO', '2017-12-06 08:47:24', 1, '3 The Street', '', 'Townsville', 'UK', 'EX7 9PP', '', '', '', 'yes'),
(4, 'Sylvester', 'Ouma', 'ouma@example.com', '', NULL, '$2y$10$5KM8jy5MwHIgfVchsdfE8OvuF1cT2VYqU6mte2CWBw1HjmEv3r.ES', '2017-12-06 12:20:33', 0, '6 The Street', 'Derby', 'Townsville', 'UK', 'EX9 9PG', '01234777888', '', '', NULL),
(5, 'Patrick', 'O\'Hara', 'pohara@myisp.org.uk', '', NULL, '$2y$10$0nmGDVmHdWusgFJRmVZADeL43Y7HCPViBrHj/Z2betxiMdMx5Y2sC', '2017-12-06 12:27:32', 0, '5 The Street', '', 'Townsville', 'UK', 'EX7 9PP', '', '', '', NULL),
(6, 'Frank', 'Incense', 'fincense@myisp.net', '', NULL, '$2y$10$KCQhEftEJouWPfuOOVoRVOECY/oJTluxHRr85fWlz6nsfN4OHtCie', '2017-12-06 17:02:16', 0, '6 The Street', 'The Village', 'Townsville', 'UK', 'EX7 9PS', '', '', '', NULL),
(7, 'Annie', 'Versary', 'aversary@myisp.com', '', NULL, '$2y$10$IrQE3TTkWzNm93FP/VYf.O/yMWDJDpIn/.qjrmvN.I97fvakynuza', '2017-12-06 17:11:44', 0, '7 The Street', 'The Village', 'Townsville', 'UK', 'EXP 6PG', '01234777888', '', '', NULL),
(8, 'Rose', 'Bush', 'rbush@myisp.co.uk', '', NULL, '$2y$10$R2auBMKMe/Qw2fFr8D.S8eUEENUz8r.YUth5NHAyskNYupUzBen5O', '2017-12-06 17:18:30', 0, '7 The Street', '', 'Townsville', 'UK', 'EX7 9PP', '', '', '', NULL),
(9, 'Annie', 'Mossity', 'amossity@myisp.org.uk', '', NULL, '$2y$10$amqmyEfaOfiZ0MkIzdO90uZMPw4Mi/4RR70nNd0nxaZSOlxlr.8DC', '2017-12-06 17:24:42', 0, '4 The Street', 'The Village', 'Townsville', 'UK', 'EX7 9PP', '01234777888', '', '', NULL),
(10, 'Percy', 'Veer', 'pveer@myisp.com', '', NULL, '$2y$10$Wvdx/YO4cCcOQvyMVVtapO3F/eiz2Ow3yU9VcczGMC.dcgwbgIXMS', '2017-12-06 17:28:53', 0, '7 The Street', 'The Village', 'Townsville', 'UK', 'EX7 9PG', '01234777888', '', '', NULL),
(11, 'Darrel', 'Doo', 'ddoo@myisp.co.uk', '', NULL, '$2y$10$cTmJVcuUmTpCOIdQJ8MG3uwLmG7M7V3iE8zPXiNW2PQEdDQZMBftO', '2017-12-06 17:39:30', 0, '5 The Street', 'The Village', 'Townsville', 'UK', 'EX7 9PP', '', '', '', NULL),
(12, 'Stan', 'Dard', 'sdard@myisp.net', '', NULL, '$2y$10$YUYnU8UvOF/WUJ5h4VK4Qe.I48ZcAbedjPiDekKHlODduqGdJoI9i', '2017-12-06 18:02:04', 0, '3 The Street', '', 'Townsville', 'UK', 'EX7 9PP', '01234777888', '', '', NULL),
(13, 'Nora', 'Bone', 'nbone@myisp.com', '', NULL, '$2y$10$k9sMvE001164jjzJLs.OpOmb9LtluUEbR4GQ4RT5/rvSPNIqbL6gC', '2017-12-07 17:39:34', 0, '6 The Street', '', 'Townsville', 'UK', 'EX7 9PP', '', '', '', NULL),
(14, 'Barry', 'Onyango', 'bcade@myisp.co.uk', '', NULL, '$2y$10$TOr.IZq/joHIKSk0Oo.jE.yWau48sUSgtC5TzKJ0sl0AoO2Bsk3lW', '2017-12-08 12:16:58', 0, '5 The Street', '', 'Townsville', 'UK', 'EX7 9PG', '01234777888', '', '', NULL),
(16, 'Lynn', 'Seed', 'lseed@myisp.com', '', NULL, '$2y$10$nEs3Zhh4V5ZznpcPzGs9gOWupjY2NgV87DPpLu2DjqsdyBNRjf4/C', '2017-12-16 20:03:16', 0, '6 The Street', '', 'Townsville', 'UK', 'EX24 6PG', '01234777888', '', '', NULL),
(17, 'Barry', 'Tone', 'btone@myisp.net', '', NULL, '$2y$10$w4zMq7ij7NmVDeBBKDSmbu963EwchZwAHPZmgZmTQAQ8Gha2jTD5W', '2017-12-16 20:16:40', 0, '2 The Street', '', 'Townsville', 'USA', 'CA12345', '', '', '', NULL),
(31, 'Rose', 'ouma', 'roseouma@example.come', '', NULL, '$2y$10$ujpV7w4blsTdQFWOsE1fiOFYtj9zN4w0WcK5V4WJ60Pc5HWodWlGC', '2017-12-29 11:48:04', 0, '3 The Street', 'The Village', 'Townsville', 'UK', 'EX3 1TH', NULL, '', '', NULL),
(38, 'James', 'Smith', 'jsmith@myisp.co.uk', '', NULL, '$2y$10$NNry7uCLEkaKOScVoRb0SOouR2nwNBoymV71UcT5oq5FQDkFFPRLK', '2023-03-17 18:50:05', 0, 'Londo Road', NULL, 'Londo', 'UK', '100', '07636373773', '', '', NULL),
(39, 'Collins', 'Oduori', 'collo@gmail.com', 'download (3).jpg', NULL, '$2y$10$F/QWReCflHe0Lw8P/0eTIud7Toalg8tPrRT/RdK8gEfCVOL/tjEU.', '2023-03-18 14:23:35', 0, 'Kisumu Busia Road', 'Ndere, Siaya', 'Kisumu', 'Kenya', '740 40600', '073455667', 'Nyadenge', '', NULL),
(40, 'Dancuun', 'Tsuma', 'tsuma@gmail.com', 'download (6).jpg', '1997-06-10', '$2y$10$0XWQL7Yu/qs6dB./uAki5OGp1f9vkWGZSqbLuEhOuNac9/4ygzW4a', '2023-03-20 18:39:21', 0, 'Kakamega', 'Wabasolo', 'Kisumu', 'Kenya', '740 40601', '073389389', 'maiden', 'Project Employee', NULL),
(41, 'Sylvester', 'Ouma', 'projectmanager@example.com', 'download (6).jpg', '1997-06-20', '$2y$10$41Rip2xE6yyVaONaeN9nzevOjWlkOJX3F7ZUURnfklGRUXuheAIXu', '2023-03-20 19:21:28', 1, 'Cairo road', 'Football corner', 'Cairo', 'Egypt', '254 40600', '073344444', 'salar', 'Project Manager', 'yes'),
(42, 'Yasir', 'Moha', 'yasir@gmail.com', 'saudi-yasir.jpg', '1996-11-06', '$2y$10$qgQBU7zxPG7To3qNcZBQMuyj7l7Qcb/8f75.RzRFCl030DE97t4vi', '2023-03-20 20:29:26', 2, 'Mombasa street3', 'utalli', 'Mombasa', 'Saudi Arabia', '234 40500', '074844994', 'dog', 'Finance Employee', NULL),
(43, 'Salvado', 'Kipkap', 'employee@gmail.com', 'download.jpg', '2000-02-15', '$2y$10$dngV8Gr0m3uXTkGavqFXLO0SHk.qULOq7bvvz8w0hJ.FCouc2iUeO', '2023-03-20 21:05:59', 0, 'Kampala Road', NULL, 'Kampala', 'Kenya', '255 40600', '84848488', 'dog', 'Project Employee', NULL),
(44, 'Marion', 'Kip', 'marion@gmail.com', 'saudi-marion.jpg', '1999-08-19', '$2y$10$ffy1hpXkqgVW5RIGQRiT0OxtTMh4miy5mnCr9orj0lDqoCXDsmpOy', '2023-03-21 17:21:06', 0, 'Kipsang road', NULL, 'Abu Dhabi', 'Qatar', '254 40505', '07773737', 'abibi', 'Project Employee', NULL),
(45, 'Elen', 'Degenre', 'financeman@gmail.com', 'download (4).jpg', '2004-11-05', '$2y$10$LAy.cms4Saf5RMdmnzUiUeF0BuFMIbWtePTI/okZejFaxNiHJVdXm', '2023-03-26 11:21:43', 3, 'Siaya Busia road', 'Ndere center', 'Kisumu', 'Kenya', '740 40600', '013383883', 'township', 'Finance Manager', NULL),
(46, 'Abdul', 'Dulai', 'owner@example.com', 'owner.jpg', '1999-03-27', '$2y$10$BUrgCo5bn5B5Pjn8lIuWNeD6WE7M6FvdSXy4Cc65yUclHecNCLBcS', '2023-03-27 14:00:02', 4, 'Saudi town', 'Saudi drive', 'Riyadh', 'Saudi Arabia', '233 6000', '05949949', 'big cat', 'Owner', NULL),
(47, 'Pauline', 'Adipo Ouma', 'pauline@example.com', 'download.jpg', '1994-07-27', '$2y$10$k2eMvXiBDkhrd6xnvy6HTObN4iSV0pk.Tf1rl8b5DL8dILqMJQWtC', '2023-03-27 23:09:24', 0, 'Kawangware 56', 'Mafuta Shop', 'Nairobi', 'Kenya', '254 7889', '79138388', 'kitchen', 'Project Employee', NULL),
(48, 'molly', 'ouma', 'princessmolly991@gmail.com', '1681302380_Grass_Block3.png', '2000-01-19', '$2y$10$dVm1.giChWWXDbuEydBBCeQd3Q0WPv3F9vAg/OSlFvgXwNzzNy2wy', '2023-04-12 15:26:20', 0, 'eldoret', NULL, 'eldoret', 'kenya', '254 000', '0711249327', 'jacky', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `projectID` mediumint(6) UNSIGNED NOT NULL,
  `employeeID` mediumint(6) UNSIGNED DEFAULT NULL,
  `projectManagerId` mediumint(6) UNSIGNED NOT NULL,
  `dateAssigned` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`projectID`, `employeeID`, `projectManagerId`, `dateAssigned`) VALUES
(1, 44, 41, '2023-03-27 16:25:21'),
(3, 44, 41, '2023-03-27 16:25:21'),
(1, 40, 41, '2023-03-27 16:25:21'),
(1, 48, 41, '2023-04-12 15:35:23'),
(4, 48, 41, '2023-04-12 15:59:17'),
(6, 48, 41, '2023-04-12 16:06:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`billId`),
  ADD KEY `employeeID` (`employeeID`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`budgetID`),
  ADD KEY `projectManagerID` (`projectManagerID`),
  ADD KEY `financeManagerID` (`financeManagerID`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projectId`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD KEY `userID` (`employeeID`),
  ADD KEY `projectID` (`projectID`),
  ADD KEY `projectManagerId` (`projectManagerId`),
  ADD KEY `employeeID` (`employeeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `billId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `budgetID` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `projectId` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`employeeID`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`projectManagerID`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`projectId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work`
--
ALTER TABLE `work`
  ADD CONSTRAINT `work_ibfk_1` FOREIGN KEY (`employeeID`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `work_ibfk_2` FOREIGN KEY (`projectID`) REFERENCES `project` (`projectId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work_ibfk_3` FOREIGN KEY (`projectManagerId`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
