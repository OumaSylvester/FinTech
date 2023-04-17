-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2023 at 06:20 PM
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
-- Table structure for table `users`
--
use finance;
CREATE TABLE `users` (
  `user_id` mediumint(6) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
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
  `title` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `date_of_birth`, `password`, `registration_date`, `user_level`, `address1`, `address2`, `city`, `state_country`, `zcode_pcode`, `phone`, `secret`, `title`) VALUES
(1, 'Mike', 'Rosoft', 'miker@myisp.com', NULL, '$2y$10$UiiBhmXca.0/bwopveFq8uInuX.EVrecinUQYQG546WjAWwZLJNoe', '2017-12-06 08:43:41', 0, '4 The Street', 'The Village', 'Townsville', 'USA', 'WA', '0123777888', '', ''),
(2, 'Jack', 'Smith', 'jsmith@outcook.com', NULL, '$2y$10$NjlsajfCITeb.oDXqu9Neuguh3PBKL5EaqZ5ClfW76nVSnW.W.XNO', '2017-12-06 08:47:24', 1, '3 The Street', '', 'Townsville', 'UK', 'EX7 9PP', '', '', ''),
(4, 'Sylvester', 'Ouma', 'ouma@example.com', NULL, '$2y$10$5KM8jy5MwHIgfVchsdfE8OvuF1cT2VYqU6mte2CWBw1HjmEv3r.ES', '2017-12-06 12:20:33', 0, '6 The Street', 'Derby', 'Townsville', 'UK', 'EX9 9PG', '01234777888', '', ''),
(5, 'Patrick', 'O\'Hara', 'pohara@myisp.org.uk', NULL, '$2y$10$0nmGDVmHdWusgFJRmVZADeL43Y7HCPViBrHj/Z2betxiMdMx5Y2sC', '2017-12-06 12:27:32', 0, '5 The Street', '', 'Townsville', 'UK', 'EX7 9PP', '', '', ''),
(6, 'Frank', 'Incense', 'fincense@myisp.net', NULL, '$2y$10$KCQhEftEJouWPfuOOVoRVOECY/oJTluxHRr85fWlz6nsfN4OHtCie', '2017-12-06 17:02:16', 0, '6 The Street', 'The Village', 'Townsville', 'UK', 'EX7 9PS', '', '', ''),
(7, 'Annie', 'Versary', 'aversary@myisp.com', NULL, '$2y$10$IrQE3TTkWzNm93FP/VYf.O/yMWDJDpIn/.qjrmvN.I97fvakynuza', '2017-12-06 17:11:44', 0, '7 The Street', 'The Village', 'Townsville', 'UK', 'EXP 6PG', '01234777888', '', ''),
(8, 'Rose', 'Bush', 'rbush@myisp.co.uk', NULL, '$2y$10$R2auBMKMe/Qw2fFr8D.S8eUEENUz8r.YUth5NHAyskNYupUzBen5O', '2017-12-06 17:18:30', 0, '7 The Street', '', 'Townsville', 'UK', 'EX7 9PP', '', '', ''),
(9, 'Annie', 'Mossity', 'amossity@myisp.org.uk', NULL, '$2y$10$amqmyEfaOfiZ0MkIzdO90uZMPw4Mi/4RR70nNd0nxaZSOlxlr.8DC', '2017-12-06 17:24:42', 0, '4 The Street', 'The Village', 'Townsville', 'UK', 'EX7 9PP', '01234777888', '', ''),
(10, 'Percy', 'Veer', 'pveer@myisp.com', NULL, '$2y$10$Wvdx/YO4cCcOQvyMVVtapO3F/eiz2Ow3yU9VcczGMC.dcgwbgIXMS', '2017-12-06 17:28:53', 0, '7 The Street', 'The Village', 'Townsville', 'UK', 'EX7 9PG', '01234777888', '', ''),
(11, 'Darrel', 'Doo', 'ddoo@myisp.co.uk', NULL, '$2y$10$cTmJVcuUmTpCOIdQJ8MG3uwLmG7M7V3iE8zPXiNW2PQEdDQZMBftO', '2017-12-06 17:39:30', 0, '5 The Street', 'The Village', 'Townsville', 'UK', 'EX7 9PP', '', '', ''),
(12, 'Stan', 'Dard', 'sdard@myisp.net', NULL, '$2y$10$YUYnU8UvOF/WUJ5h4VK4Qe.I48ZcAbedjPiDekKHlODduqGdJoI9i', '2017-12-06 18:02:04', 0, '3 The Street', '', 'Townsville', 'UK', 'EX7 9PP', '01234777888', '', ''),
(13, 'Nora', 'Bone', 'nbone@myisp.com', NULL, '$2y$10$k9sMvE001164jjzJLs.OpOmb9LtluUEbR4GQ4RT5/rvSPNIqbL6gC', '2017-12-07 17:39:34', 0, '6 The Street', '', 'Townsville', 'UK', 'EX7 9PP', '', '', ''),
(14, 'Barry', 'Onyango', 'bcade@myisp.co.uk', NULL, '$2y$10$TOr.IZq/joHIKSk0Oo.jE.yWau48sUSgtC5TzKJ0sl0AoO2Bsk3lW', '2017-12-08 12:16:58', 0, '5 The Street', '', 'Townsville', 'UK', 'EX7 9PG', '01234777888', '', ''),
(16, 'Lynn', 'Seed', 'lseed@myisp.com', NULL, '$2y$10$nEs3Zhh4V5ZznpcPzGs9gOWupjY2NgV87DPpLu2DjqsdyBNRjf4/C', '2017-12-16 20:03:16', 0, '6 The Street', '', 'Townsville', 'UK', 'EX24 6PG', '01234777888', '', ''),
(17, 'Barry', 'Tone', 'btone@myisp.net', NULL, '$2y$10$w4zMq7ij7NmVDeBBKDSmbu963EwchZwAHPZmgZmTQAQ8Gha2jTD5W', '2017-12-16 20:16:40', 0, '2 The Street', '', 'Townsville', 'USA', 'CA12345', '', '', ''),
(31, 'Rose', 'ouma', 'roseouma@example.come', NULL, '$2y$10$ujpV7w4blsTdQFWOsE1fiOFYtj9zN4w0WcK5V4WJ60Pc5HWodWlGC', '2017-12-29 11:48:04', 0, '3 The Street', 'The Village', 'Townsville', 'UK', 'EX3 1TH', NULL, '', ''),
(38, 'James', 'Smith', 'jsmith@myisp.co.uk', NULL, '$2y$10$NNry7uCLEkaKOScVoRb0SOouR2nwNBoymV71UcT5oq5FQDkFFPRLK', '2023-03-17 18:50:05', 0, 'Londo Road', NULL, 'Londo', 'UK', '100', '07636373773', '', ''),
(39, 'Collins', 'Oduor', 'collo@gmail.com', NULL, '$2y$10$F/QWReCflHe0Lw8P/0eTIud7Toalg8tPrRT/RdK8gEfCVOL/tjEU.', '2023-03-18 14:23:35', 0, 'Kisumu Busia Road', 'Ndere, Siaya', 'Kisumu', 'Kenya', '740 40600', '073455667', 'Nyadenge', ''),
(40, 'Dancun', 'Tsuma', 'tsuma@gmail.com', '1997-06-10', '$2y$10$0XWQL7Yu/qs6dB./uAki5OGp1f9vkWGZSqbLuEhOuNac9/4ygzW4a', '2023-03-20 18:39:21', 0, 'Kakamega', 'Wabasolo', 'Kisumu', 'Kenya', '740 40601', '073389389', 'maiden', ''),
(41, 'Mohammed', 'Salar', 'projectmanager@example.com', '1997-06-20', '$2y$10$41Rip2xE6yyVaONaeN9nzevOjWlkOJX3F7ZUURnfklGRUXuheAIXu', '2023-03-20 19:21:28', 1, 'Cairo road', 'Football corner', 'Cairo', 'Egypt', '254 40600', '073344444', 'salar', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
