-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2023 at 11:43 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_check_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `group_list`
--

CREATE TABLE `group_list` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(500) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_list`
--

INSERT INTO `group_list` (`group_id`, `group_name`, `admin_id`) VALUES
(1, 'Daily', 3),
(2, 'Weekly', 3);

-- --------------------------------------------------------

--
-- Table structure for table `task_list`
--

CREATE TABLE `task_list` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(500) NOT NULL,
  `due_date` varchar(500) NOT NULL,
  `due_time` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `attachment` varchar(5000) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`task_id`, `task_name`, `due_date`, `due_time`, `description`, `attachment`, `admin_id`, `group_id`) VALUES
(3, 'test', '2220-02-11', '02:12', 'test', 'attachment/WhatsApp Image 2022-12-28 at 4.31.18 PM (1).jpeg', 3, 0),
(4, 'maaz', '2023-02-24', '15:23', 'test', 'attachment/task_list.sql', 3, 0),
(5, 'ahsan', '2202-12-12', '00:23', 'ahsan', 'attachment/Laundry and dry cleaning-pana.png', 3, 0),
(6, 'maaz1', '2023-02-24', '15:34', 'maaz', 'attachment/undraw_electricity_k2ft (1).png', 3, 0),
(7, 'maaz2', '0213-02-13', '13:21', 'najshkjah', 'attachment/Pipeline maintenance-amico.png', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_todo`
--

CREATE TABLE `tbl_todo` (
  `todo_id` int(11) NOT NULL,
  `todo_task` varchar(50) NOT NULL,
  `todo_time` varchar(500) DEFAULT current_timestamp(),
  `adminid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_todo`
--

INSERT INTO `tbl_todo` (`todo_id`, `todo_task`, `todo_time`, `adminid`) VALUES
(3, 'kapre dhone hain', ' Date 3/1/2023 Time 16:53:37', 2),
(4, 'baal katwane hain', ' Date 3/1/2023 Time 16:53:37', 2),
(10, '', ' Date 5/1/2023 Time 12:33:52', 3),
(11, '', ' Date 5/1/2023 Time 12:33:52', 3),
(12, '', ' Date 5/1/2023 Time 12:33:52', 3),
(13, '', ' Date 5/1/2023 Time 12:33:52', 3),
(14, '', ' Date 5/1/2023 Time 12:33:52', 3),
(15, '', ' Date 5/1/2023 Time 12:33:52', 3),
(16, '', ' Date 5/1/2023 Time 12:33:52', 3),
(17, '', ' Date 5/1/2023 Time 12:33:52', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_todo_admin`
--

CREATE TABLE `tbl_todo_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_fullname` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_todo_admin`
--

INSERT INTO `tbl_todo_admin` (`admin_id`, `admin_fullname`, `admin_email`, `admin_password`) VALUES
(1, 'Muhammad Ahsan', 'ahsan@gmail.com', 'ahsan101'),
(2, 'sm taha', 'smtaha@gmail.com', 'taha123'),
(3, 'Maaz Hassan', 'sengineer804@gmail.com', 'maaz123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group_list`
--
ALTER TABLE `group_list`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tbl_todo`
--
ALTER TABLE `tbl_todo`
  ADD PRIMARY KEY (`todo_id`);

--
-- Indexes for table `tbl_todo_admin`
--
ALTER TABLE `tbl_todo_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group_list`
--
ALTER TABLE `group_list`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `task_list`
--
ALTER TABLE `task_list`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_todo`
--
ALTER TABLE `tbl_todo`
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_todo_admin`
--
ALTER TABLE `tbl_todo_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
