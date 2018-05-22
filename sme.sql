-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2018 at 09:28 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sme`
--

-- --------------------------------------------------------

--
-- Table structure for table `appliedloan`
--

CREATE TABLE `appliedloan` (
  `id` int(11) NOT NULL,
  `loanRequested` int(11) NOT NULL,
  `loanPurpose` varchar(200) NOT NULL,
  `repayment` int(11) NOT NULL,
  `assets` varchar(200) NOT NULL,
  `assetValue` varchar(200) NOT NULL,
  `investments` varchar(200) NOT NULL,
  `investmentsValue` int(11) NOT NULL,
  `sme_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appliedloan`
--

INSERT INTO `appliedloan` (`id`, `loanRequested`, `loanPurpose`, `repayment`, `assets`, `assetValue`, `investments`, `investmentsValue`, `sme_id`, `loan_id`, `date_created`, `status`) VALUES
(1, 63, 'funding', 6, 'House', '1000', 'Building', 770, 5, 3, '2018-05-10 13:14:58', ''),
(2, 67, '7y', 12, 'Cars', '67', 'Building', 772, 2, 3, '2018-05-10 16:59:52', 'approved'),
(3, 0, '', 0, '', '', '', 0, 2, 3, '2018-05-10 13:45:21', ''),
(4, 2000, 'hfjdj', 12, 'Cars', '20000', 'Building', 2000, 3, 3, '2018-05-10 16:11:40', ''),
(5, 2000, 'Corporation', 12, 'Cars', '5000', 'Building', 500, 2, 5, '2018-05-10 17:02:31', 'approved'),
(6, 0, '', 0, '', '', '', 0, 2, 4, '2018-05-10 17:49:00', ''),
(7, 2000, ' Building', 6, 'Cars', '2000', 'Building', 2000, 1, 1, '2018-05-13 06:07:49', 'approved'),
(8, 2500, 'The ', 6, 'House', '80000', 'Building', 45000, 0, 1, '2018-05-10 18:37:26', ''),
(9, 34000, 'Builiding', 12, 'Cars', '2000', 'Building', 2000, 2, 1, '2018-05-13 06:07:57', 'approved'),
(10, 2002, 'hdh', 12, 'Cars', '3837', 'Building', 7736, 3, 2, '2018-05-13 06:12:17', 'approved'),
(11, 0, '', 0, '', '', '', 0, 3, 2, '2018-05-22 07:24:04', 'approved'),
(12, 0, '', 0, '', '', '', 0, 3, 1, '2018-05-22 07:24:01', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `approvedloan`
--

CREATE TABLE `approvedloan` (
  `id` int(11) NOT NULL,
  `sme_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `active` varchar(20) NOT NULL,
  `date_approved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `date_submitted` varchar(200) NOT NULL,
  `businessType` varchar(200) NOT NULL,
  `sector` varchar(200) NOT NULL,
  `minimum_amount` int(11) NOT NULL,
  `maximum_amount` int(15) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `date_submitted`, `businessType`, `sector`, `minimum_amount`, `maximum_amount`, `provider_id`, `status`, `date_created`) VALUES
(1, '2018-10-05', 'parternship', 'agriculture', 2000, 5000, 4, 'available', '2018-05-10 17:59:46'),
(2, '62008-10-05', 'incoporation', 'manufacturing', 2000, 50000, 4, 'available', '2018-05-10 18:25:50');

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `id` int(11) NOT NULL,
  `companyName` varchar(20) NOT NULL,
  `phoneNumber` int(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `businessType` varchar(20) NOT NULL,
  `regNumber` varchar(200) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(3) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`id`, `companyName`, `phoneNumber`, `address`, `businessType`, `regNumber`, `user_id`, `status`, `date_created`, `email`) VALUES
(1, 'Old Mutual', 7742729, '266 Chiremba', 'Public', '', 4, '', '2018-05-10 13:06:29', 'mutual@gmail.com'),
(3, 'Ned Bank', 742528992, 'Ned bank', 'Public', '', 8, '', '2018-05-10 16:37:34', 'nedbank@gmail.com'),
(4, 'CBZ', 773, '25 Harare', 'Public', '', 9, '', '2018-05-10 17:59:21', 'cbz@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sme`
--

CREATE TABLE `sme` (
  `id` int(11) NOT NULL,
  `ownerName` varchar(20) NOT NULL,
  `ownerSurname` varchar(20) NOT NULL,
  `ownerPhone` varchar(20) NOT NULL,
  `coName` varchar(20) NOT NULL,
  `regNumber` varchar(20) NOT NULL,
  `businessType` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phoneNumber` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sme`
--

INSERT INTO `sme` (`id`, `ownerName`, `ownerSurname`, `ownerPhone`, `coName`, `regNumber`, `businessType`, `user_id`, `date_created`, `phoneNumber`, `address`, `email`) VALUES
(3, 'Tafara', 'Tafara', '07728927', 'Tansoft', '', 'Private', 13, '2018-05-13 22:21:50', 9027733, 'hatfield', 'tafara@gmail.com'),
(1235, 't', '', '', '', '', '', 0, '2018-05-19 05:29:47', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `user_type` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`, `date_created`) VALUES
(1, 'admin', 'tafadzwatendekaimutero@gmail.com', 'admin', '154072a750541f54250de83a125003a4', '2018-05-10 17:55:30'),
(6, 'cabs', 'cabs@gmail.com', 'provider', 'a2c16ec6ff87a69e522e2288235dcdde', '2018-05-10 14:50:59'),
(8, 'Ned Bank', 'ned@gmail.com', 'provider', 'f68daad189b2fffd0b8cab5e36ec9d96', '2018-05-10 16:12:58'),
(9, 'CBZ', 'cbz@gmail.com', 'provider', 'e4912c6c3e5a46cf01ab90d5d0351690', '2018-05-10 17:57:10'),
(13, 'tafara', 'tafara@gmail.com', 'user', '0c56c222c73204f79e31a71132f098b5', '2018-05-13 06:10:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appliedloan`
--
ALTER TABLE `appliedloan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sme` (`sme_id`),
  ADD KEY `loan` (`loan_id`);

--
-- Indexes for table `approvedloan`
--
ALTER TABLE `approvedloan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sme` (`sme_id`),
  ADD KEY `provider` (`loan_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `sme`
--
ALTER TABLE `sme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appliedloan`
--
ALTER TABLE `appliedloan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `approvedloan`
--
ALTER TABLE `approvedloan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sme`
--
ALTER TABLE `sme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1236;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
