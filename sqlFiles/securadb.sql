-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2018 at 01:31 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `securadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_info`
--

CREATE TABLE `file_info` (
  `s_id` int(100) NOT NULL,
  `uid` int(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `size` decimal(10,2) NOT NULL,
  `chksum` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `last_down` datetime DEFAULT NULL,
  `del_flag` enum('0','1') NOT NULL,
  `down_perm` int(4) DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_info`
--

INSERT INTO `file_info` (`s_id`, `uid`, `file_name`, `size`, `chksum`, `created_at`, `last_down`, `del_flag`, `down_perm`, `delete_at`) VALUES
(1, 1, 'test_1', '5.00', 'ddd', '2018-03-28 07:17:00', NULL, '0', 644, NULL),
(1, 1, 'test_2', '1.00', 'ffff', '2018-03-31 19:00:00', NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setup_config`
--

CREATE TABLE `setup_config` (
  `config_flag` int(1) NOT NULL DEFAULT '0',
  `storage_count` int(100) NOT NULL,
  `sec_perm` int(5) NOT NULL DEFAULT '400',
  `enforce_https` int(1) NOT NULL DEFAULT '1',
  `user_capacity` int(100) NOT NULL,
  `total_capacity` int(100) NOT NULL,
  `free_capacity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setup_config`
--

INSERT INTO `setup_config` (`config_flag`, `storage_count`, `sec_perm`, `enforce_https`, `user_capacity`, `total_capacity`, `free_capacity`) VALUES
(3, 1, 400, 1, 400, 500, 500);

-- --------------------------------------------------------

--
-- Table structure for table `storage_detail`
--

CREATE TABLE `storage_detail` (
  `s_id` int(100) NOT NULL,
  `s_tag` varchar(100) NOT NULL,
  `s_model` varchar(100) NOT NULL,
  `s_os` varchar(50) NOT NULL,
  `s_total_space` int(100) NOT NULL,
  `s_ip` varchar(50) NOT NULL,
  `s_uname` varchar(10) NOT NULL,
  `s_passwd` varchar(10) NOT NULL,
  `s_keypath` varchar(100) NOT NULL,
  `s_port` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `storage_detail`
--

INSERT INTO `storage_detail` (`s_id`, `s_tag`, `s_model`, `s_os`, `s_total_space`, `s_ip`, `s_uname`, `s_passwd`, `s_keypath`, `s_port`) VALUES
(1, 'STRG1', 'Laptop', 'Mint', 500, '127.0.0.1', 'lucideus', '1170342146', '', 22);

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `uid` int(100) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `c_url` varchar(50) NOT NULL,
  `c_city` varchar(100) NOT NULL,
  `c_state` varchar(100) NOT NULL,
  `c_country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`uid`, `emp_id`, `f_name`, `m_name`, `l_name`, `company`, `c_url`, `c_city`, `c_state`, `c_country`) VALUES
(1, 'EMP1', 'Hardik', 'Singh', 'Negi', 'SecuraStore', 'http://www.secura.com', 'Noida', 'UP', 'India');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `uid` int(100) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `passwd_hash` varchar(100) NOT NULL,
  `usr_lvl` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`uid`, `email_id`, `passwd_hash`, `usr_lvl`) VALUES
(1, 'hardiksinghnegi@gmail.com', '$2y$10$ZFtKBtTRtEeu2owq3ifuZud1Fwbdn5DrK.BxULgEzM.EtpqVENxZO', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_info`
--
ALTER TABLE `file_info`
  ADD PRIMARY KEY (`uid`,`file_name`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `storage_detail`
--
ALTER TABLE `storage_detail`
  ADD PRIMARY KEY (`s_id`),
  ADD UNIQUE KEY `s_tag` (`s_tag`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `emp_id` (`emp_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `storage_detail`
--
ALTER TABLE `storage_detail`
  MODIFY `s_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `uid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `uid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `file_info`
--
ALTER TABLE `file_info`
  ADD CONSTRAINT `file_info_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user_login` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `file_info_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `storage_detail` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD CONSTRAINT `user_detail_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user_login` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
