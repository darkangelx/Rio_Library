-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2018 at 12:27 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 = available, 0 = not available'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `author`, `genre_id`, `sec_id`, `status`) VALUES
(4, 'Kawawang Cowboy', 'Kuya eddie gil', 1, 1, 1),
(8, 'Harry Potter and the Chamber of Secrets', 'Juan Dela Cruz', 1, 1, 0),
(14, 'Cow and Chicken', 'Kuya eddie', 2, 1, 0),
(17, 'My Sassy Girl', 'Korean Something', 1, 7, 1),
(18, 'Test', 'Test', 5, 5, 1),
(19, 'Test Book', 'Test Author', 1, 6, 1),
(20, 'Jetman', 'Ninoy Aquino', 3, 5, 1),
(22, 'Test', 'Test', 4, 5, 1),
(23, 'Fiveman', 'Emilio Aguinaldo', 3, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_genre`
--

CREATE TABLE `book_genre` (
  `genre_id` int(11) NOT NULL,
  `book_genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_genre`
--

INSERT INTO `book_genre` (`genre_id`, `book_genre`) VALUES
(1, 'Horror'),
(2, 'Educational'),
(3, 'Science Fiction'),
(4, 'Comedy'),
(5, 'Documentary'),
(6, 'Religion'),
(7, 'Adventure'),
(8, 'Dictionaries'),
(9, 'Journal'),
(10, 'Biography');

-- --------------------------------------------------------

--
-- Table structure for table `book_section`
--

CREATE TABLE `book_section` (
  `sec_id` int(11) NOT NULL,
  `lib_section` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_section`
--

INSERT INTO `book_section` (`sec_id`, `lib_section`) VALUES
(1, 'Child Section'),
(3, 'Midget Section'),
(5, 'Junior Section'),
(6, 'Testing Section'),
(7, 'Sample Section'),
(8, 'Acquisition Section'),
(9, 'Cataloging Section'),
(10, 'Periodicals Section'),
(11, 'Reference Section'),
(12, 'Filipiniana Section'),
(13, 'Archives and Rare Books Collection'),
(14, 'Graduate Library'),
(15, 'Media Services Section');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `login_id` int(11) NOT NULL,
  `login_firstname` varchar(100) NOT NULL,
  `login_lastname` varchar(100) NOT NULL,
  `login_username` varchar(100) NOT NULL,
  `login_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`login_id`, `login_firstname`, `login_lastname`, `login_username`, `login_password`) VALUES
(1, 'Jeffrey', 'Calara', 'jeffreycalara13', '12345678'),
(2, 'John', 'Dela Cruz', 'admin', 'admin'),
(3, 'Andres', 'Bonifacio', '', ''),
(5, 'Apolinario', 'Mabini', '', ''),
(6, 'Andres', 'Rizal', '', ''),
(7, 'Emilio', 'Jacinto', '', ''),
(8, 'Carlos', 'Garcia', '', ''),
(9, 'Ippo', 'Makunochi', '', ''),
(10, 'Jose', 'Burgos', '', ''),
(11, 'Pedro', 'Paterno', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_borrowed` date NOT NULL,
  `date_return` date NOT NULL,
  `date_transaction` date NOT NULL,
  `book_status` int(1) NOT NULL COMMENT '1 = return, 0 = borrowed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`transaction_id`, `user_id`, `book_id`, `date_borrowed`, `date_return`, `date_transaction`, `book_status`) VALUES
(1, 1, 20, '2018-06-10', '2018-06-10', '2018-06-10', 1),
(6, 3, 4, '2018-06-10', '2018-06-10', '2018-06-10', 1),
(7, 6, 14, '2018-06-10', '2018-06-10', '2018-06-10', 1),
(8, 1, 8, '2018-06-11', '2018-06-15', '2018-06-11', 1),
(9, 3, 17, '2018-06-11', '2018-06-10', '2018-06-11', 1),
(10, 3, 14, '2018-06-11', '2018-06-22', '2018-06-11', 1),
(11, 1, 14, '2018-06-11', '2018-06-23', '2018-06-11', 1),
(12, 3, 14, '2018-06-11', '2018-06-23', '2018-06-11', 1),
(13, 6, 8, '2018-06-11', '2018-06-23', '2018-06-11', 0),
(14, 1, 14, '2018-06-11', '2018-06-21', '2018-06-11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_genre`
--
ALTER TABLE `book_genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `book_section`
--
ALTER TABLE `book_section`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `book_genre`
--
ALTER TABLE `book_genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `book_section`
--
ALTER TABLE `book_section`
  MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
