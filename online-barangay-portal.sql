-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2020 at 08:48 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online-barangay-portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement_post`
--

CREATE TABLE `announcement_post` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(50) NOT NULL,
  `post_body` text NOT NULL,
  `post_date_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement_post`
--

INSERT INTO `announcement_post` (`post_id`, `post_title`, `post_body`, `post_date_time`) VALUES
(3, 'Sample Title Announcement', 'All of the residents are advised to stay at home until further notice as there is an infected person that has gone into the area and to avoid infection, residents must practice precautionary measures agains the said virus. Thank you.', '12/04/2020 1:17 PM'),
(4, 'Voter Registration Advisory', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n', '12/04/2020 1:29 PM'),
(5, 'Weather Advisory', 'ORY, PURPOSE AND USAGE\r\nLorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book. It usually begins with:\r\n\r\n“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.”\r\nThe purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn\'t distract from the layout. A practice not without controversy, laying out pages with meaningless filler text can be very useful when the focus is meant to be on design, not content.\r\n\r\nThe passage experienced a surge in popularity during the 1960s when Letraset used it on their dry-transfer sheets, and again during the 90s as desktop publishers bundled the text with their software. Today it\'s seen all around th', '12/04/2020 1:30 PM'),
(6, 'Curfew Advisory', 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type edit test ', '12/04/2020 3:12 PM');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `upload_date_time` varchar(50) NOT NULL,
  `directory` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `description`, `upload_date_time`, `directory`) VALUES
(32, 'Certificate of Residency.pdf', 'This document contains Certificate of Residency', '12/19/2020 1:07 PM', 'documents/'),
(34, 'Business Permit.pdf', 'This document contains Business Permit', '12/19/2020 2:41 PM', 'documents/');

-- --------------------------------------------------------

--
-- Table structure for table `official_info`
--

CREATE TABLE `official_info` (
  `official_id` int(11) NOT NULL,
  `official_position` varchar(50) NOT NULL,
  `official_first_name` varchar(50) NOT NULL,
  `official_middle_name` varchar(50) NOT NULL,
  `official_last_name` varchar(50) NOT NULL,
  `official_sex` varchar(50) NOT NULL,
  `official_contact_info` varchar(50) NOT NULL,
  `official_username` varchar(50) NOT NULL,
  `official_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `official_info`
--

INSERT INTO `official_info` (`official_id`, `official_position`, `official_first_name`, `official_middle_name`, `official_last_name`, `official_sex`, `official_contact_info`, `official_username`, `official_password`) VALUES
(10, 'Barangay Chairman/Chairwoman', 'John', 'Garcia', 'Mercado', 'Male', '09541252362', 'admin1', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `resident_info`
--

CREATE TABLE `resident_info` (
  `resident_id` int(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `suffix` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `civil_stat` varchar(50) NOT NULL,
  `voter_stat` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resident_info`
--

INSERT INTO `resident_info` (`resident_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `alias`, `birthday`, `sex`, `mobile_no`, `email`, `religion`, `civil_stat`, `voter_stat`, `username`, `password`) VALUES
(19, 'Kevin', 'Exconde', 'Carmona', 'Jr.', 'Kev', '2000-06-11', 'Male', '09123456789', 'Sample1@gmail.com', 'Roman Catholic', 'Single', 'Registered', 'user1', 'user1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement_post`
--
ALTER TABLE `announcement_post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `official_info`
--
ALTER TABLE `official_info`
  ADD PRIMARY KEY (`official_id`),
  ADD UNIQUE KEY `UNIQUE` (`official_username`);

--
-- Indexes for table `resident_info`
--
ALTER TABLE `resident_info`
  ADD PRIMARY KEY (`resident_id`),
  ADD UNIQUE KEY `UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement_post`
--
ALTER TABLE `announcement_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `official_info`
--
ALTER TABLE `official_info`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `resident_info`
--
ALTER TABLE `resident_info`
  MODIFY `resident_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
