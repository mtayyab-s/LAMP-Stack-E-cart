-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2016 at 12:56 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cheapbooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `ssn` varchar(13) NOT NULL,
  `name` varchar(46) DEFAULT NULL,
  `address` varchar(60) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`ssn`, `name`, `address`, `phone`) VALUES
('100134532', 'Lindy West', '300 South orlando FL', '786-398-4321'),
('14564323', 'Stephen R Covey', '134 sheldon street Dallas TX', '7886-245-3331'),
('357192800', 'J.K Rowling', '567 Hollywood dr Los Angeles CA', '567-432-1134'),
('890765436', 'Mario Puzo', '321 downing street litte italy CA', '987-567-4356');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ISBN` varchar(20) NOT NULL,
  `title` varchar(32) DEFAULT NULL,
  `year` smallint(4) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `publisher` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ISBN`, `title`, `year`, `price`, `publisher`) VALUES
('0316348406', 'Shrill', 2016, '59.00', 'Hachette'),
('0439554934', 'Harry Potter', 2003, '39.99', 'Scholastic'),
('0451205766 ', 'The Godfather', 1969, '23.25', 'NAL'),
('0684856093', 'The 7 Habits Of Highly Effective', 1998, '21.00', 'Touchstone');

-- --------------------------------------------------------

--
-- Table structure for table `contains`
--

CREATE TABLE `contains` (
  `ISBN` varchar(20) NOT NULL,
  `basketId` varchar(13) NOT NULL,
  `number` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `username` varchar(10) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`username`, `password`, `address`, `phone`, `email`) VALUES
('john', '202cb962ac59075b964b07152d234b70', '300 s', '456-321-1234', 'ali@yahoo.com'),
('sam', 'b51a4ad33cbd2c22f8196ae4857337b2', '450 Park road', '405-234-3433', 'sam@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `shippingorder`
--

CREATE TABLE `shippingorder` (
  `ISBN` varchar(20) NOT NULL,
  `warehouseCode` varchar(13) NOT NULL,
  `username` varchar(10) NOT NULL,
  `number` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shoppingbasket`
--

CREATE TABLE `shoppingbasket` (
  `basketId` varchar(13) NOT NULL,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `ISBN` varchar(20) NOT NULL,
  `warehouseCode` varchar(13) NOT NULL,
  `number` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`ISBN`, `warehouseCode`, `number`) VALUES
('0316348406', '132', 7),
('0439554934', '132', 12),
('0451205766 ', '132', 8),
('0684856093', '132', 12);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouseCode` varchar(13) NOT NULL,
  `name` varchar(46) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouseCode`, `name`, `address`, `phone`) VALUES
('132', 'denim', '300s mattlock', '342-433-1123');

-- --------------------------------------------------------

--
-- Table structure for table `writtenby`
--

CREATE TABLE `writtenby` (
  `ssn` varchar(13) NOT NULL,
  `ISBN` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `writtenby`
--

INSERT INTO `writtenby` (`ssn`, `ISBN`) VALUES
('100134532', '0316348406'),
('14564323', '0684856093'),
('357192800', '0439554934'),
('890765436', '0451205766 ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`ssn`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `contains`
--
ALTER TABLE `contains`
  ADD PRIMARY KEY (`ISBN`,`basketId`),
  ADD KEY `basketId` (`basketId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `shippingorder`
--
ALTER TABLE `shippingorder`
  ADD PRIMARY KEY (`ISBN`,`warehouseCode`,`username`),
  ADD KEY `warehouseCode` (`warehouseCode`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `shoppingbasket`
--
ALTER TABLE `shoppingbasket`
  ADD PRIMARY KEY (`basketId`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`ISBN`,`warehouseCode`),
  ADD KEY `warehouseCode` (`warehouseCode`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouseCode`);

--
-- Indexes for table `writtenby`
--
ALTER TABLE `writtenby`
  ADD PRIMARY KEY (`ssn`,`ISBN`),
  ADD KEY `ISBN` (`ISBN`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contains`
--
ALTER TABLE `contains`
  ADD CONSTRAINT `contains_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`),
  ADD CONSTRAINT `contains_ibfk_2` FOREIGN KEY (`basketId`) REFERENCES `shoppingbasket` (`basketId`);

--
-- Constraints for table `shippingorder`
--
ALTER TABLE `shippingorder`
  ADD CONSTRAINT `shippingorder_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`),
  ADD CONSTRAINT `shippingorder_ibfk_2` FOREIGN KEY (`warehouseCode`) REFERENCES `warehouse` (`warehouseCode`),
  ADD CONSTRAINT `shippingorder_ibfk_3` FOREIGN KEY (`username`) REFERENCES `customers` (`username`);

--
-- Constraints for table `shoppingbasket`
--
ALTER TABLE `shoppingbasket`
  ADD CONSTRAINT `shoppingbasket_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customers` (`username`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`),
  ADD CONSTRAINT `stocks_ibfk_2` FOREIGN KEY (`warehouseCode`) REFERENCES `warehouse` (`warehouseCode`);

--
-- Constraints for table `writtenby`
--
ALTER TABLE `writtenby`
  ADD CONSTRAINT `writtenby_ibfk_1` FOREIGN KEY (`ssn`) REFERENCES `author` (`ssn`),
  ADD CONSTRAINT `writtenby_ibfk_2` FOREIGN KEY (`ISBN`) REFERENCES `book` (`ISBN`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
