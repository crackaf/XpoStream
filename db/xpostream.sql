-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 11:38 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xpostream`
--

-- --------------------------------------------------------

--
-- Table structure for table `host_streams`
--

CREATE TABLE `host_streams` (
  `stream_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stream_name` varchar(255) NOT NULL,
  `stream_link` varchar(500) NOT NULL,
  `stream_slot` int(11) NOT NULL,
  `stream_type` varchar(10) NOT NULL DEFAULT 'free'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `host_streams`
--

INSERT INTO `host_streams` (`stream_id`, `user_id`, `stream_name`, `stream_link`, `stream_slot`, `stream_type`) VALUES
(1, 1, 'Quintuplets Ending Song', 'https://www.youtube.com/embed/s6k3mW0Kgls', 1, 'free'),
(2, 1, 'Shadows House Ending Song', 'https://www.youtube.com/embed/tfcfJj7LZCk', 2, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `host_stream_tickets`
--

CREATE TABLE `host_stream_tickets` (
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stream_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `host_subscribers`
--

CREATE TABLE `host_subscribers` (
  `host_user_id` int(11) NOT NULL,
  `subscribed_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `host_subscribers`
--

INSERT INTO `host_subscribers` (`host_user_id`, `subscribed_user_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `stream_slots`
--

CREATE TABLE `stream_slots` (
  `slot_id` int(11) NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stream_slots`
--

INSERT INTO `stream_slots` (`slot_id`, `timestamp`) VALUES
(1, '2021-05-19 19:00:00'),
(2, '2021-05-27 03:00:00'),
(3, '2021-05-28 03:00:00'),
(4, '2021-06-29 03:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stream_subscriptions`
--

CREATE TABLE `stream_subscriptions` (
  `stream_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stream_subscriptions`
--

INSERT INTO `stream_subscriptions` (`stream_id`, `user_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_list`
--

CREATE TABLE `users_list` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reg_type` varchar(10) NOT NULL DEFAULT 'viewer',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_list`
--

INSERT INTO `users_list` (`user_id`, `email`, `name`, `password`, `reg_type`, `date`) VALUES
(1, 'zeerak@animecorner.me', 'Zeerak Ahmad', 'zeerak', 'host', '2021-05-24 07:39:36'),
(2, 'arbab@animecorner.me', 'Arbab Hamd Rizwan', 'arbab', 'viewer', '2021-05-25 09:25:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `host_streams`
--
ALTER TABLE `host_streams`
  ADD PRIMARY KEY (`stream_id`);

--
-- Indexes for table `stream_slots`
--
ALTER TABLE `stream_slots`
  ADD PRIMARY KEY (`slot_id`);

--
-- Indexes for table `users_list`
--
ALTER TABLE `users_list`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `host_streams`
--
ALTER TABLE `host_streams`
  MODIFY `stream_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stream_slots`
--
ALTER TABLE `stream_slots`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users_list`
--
ALTER TABLE `users_list`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
