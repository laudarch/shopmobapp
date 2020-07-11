-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2020 at 06:11 PM
-- Server version: 10.3.23-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopmoba_sma`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`cpses_sh0trt9gm9`@`localhost` PROCEDURE `newshop` (IN `sid` VARCHAR(255), `username` VARCHAR(255), `passwd` VARCHAR(255), `actype` VARCHAR(255), `sname` VARCHAR(255), `slocation` VARCHAR(255), `sgeo` VARCHAR(255), `scategory` VARCHAR(255), `sdescription` VARCHAR(255))  begin
	insert into login (uid, username, passwd, actype)
		values(uid, username, passwd, actype);
	insert into shopinfo (sid, sname, slocation, sgeo, scategory, sdescription)
		values(sid, sname, slocation, sgeo, scategory, sdescription);
	insert into usermap (uid, username, actype)
		values(uid, username, actype);
	insert into loginhistory (uid, lastlogin, lastip, lastlocation)
		values(uid, '1996/09/26 16:00:00', '0.0.0.0', 'Unknown');
end$$

CREATE DEFINER=`cpses_sh0trt9gm9`@`localhost` PROCEDURE `newuser` (IN `uid` VARCHAR(255), `username` VARCHAR(255), `passwd` VARCHAR(255), `actype` VARCHAR(255), `fname` VARCHAR(255), `mname` VARCHAR(255), `lname` VARCHAR(255), `email` VARCHAR(255), `photo` VARCHAR(255))  begin
	insert into login (uid, username, passwd, actype)
		values(uid, username, passwd, actype);
	insert into profile (uid, fname, mname, lname, email, photo)
		values(uid, fname, mname, lname, email, photo);
	insert into usermap (uid, username, actype)
		values(uid, username, actype);
	insert into loginhistory (uid, lastlogin, lastip, lastlocation)
		values(uid, '1996/09/26 16:00:00', '0.0.0.0', 'Unknown');
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` varchar(255) NOT NULL COMMENT 'category id',
  `cname` varchar(255) NOT NULL COMMENT 'catgory name'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='shop info table';

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `uid` varchar(255) NOT NULL COMMENT 'unique user id',
  `username` varchar(255) NOT NULL COMMENT 'username',
  `passwd` varchar(255) NOT NULL COMMENT 'password',
  `actype` varchar(25) NOT NULL COMMENT 'type of account'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='login table';

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`uid`, `username`, `passwd`, `actype`) VALUES
('666', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'sa');

-- --------------------------------------------------------

--
-- Table structure for table `loginhistory`
--

CREATE TABLE `loginhistory` (
  `uid` varchar(255) NOT NULL COMMENT 'unique user id',
  `lastlogin` varchar(255) NOT NULL COMMENT 'last login date/time',
  `lastip` varchar(255) NOT NULL COMMENT 'last ip',
  `lastlocation` varchar(255) DEFAULT NULL COMMENT 'last location(country)'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='login history';

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` varchar(255) NOT NULL COMMENT 'product id',
  `pname` varchar(255) NOT NULL COMMENT 'product name',
  `pcategory` varchar(255) NOT NULL COMMENT 'product category',
  `pprice` varchar(255) NOT NULL COMMENT 'product price'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='product table';

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `uid` varchar(255) NOT NULL COMMENT 'unique user id',
  `fname` varchar(255) NOT NULL COMMENT 'first name',
  `mname` varchar(255) DEFAULT NULL COMMENT 'midddle name',
  `lname` varchar(255) NOT NULL COMMENT 'last name',
  `dob` varchar(255) DEFAULT NULL COMMENT 'Date of birth',
  `email` varchar(255) NOT NULL COMMENT 'Email Address',
  `photo` varchar(255) DEFAULT NULL COMMENT 'photo location',
  `location` varchar(255) DEFAULT NULL COMMENT 'location lat,lon',
  `region` varchar(255) DEFAULT NULL COMMENT 'region',
  `biography` text DEFAULT NULL COMMENT 'biography'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='user personal information table';

-- --------------------------------------------------------

--
-- Table structure for table `shopinfo`
--

CREATE TABLE `shopinfo` (
  `sid` varchar(255) NOT NULL COMMENT 'unique shop id',
  `sname` varchar(255) NOT NULL COMMENT 'shop name',
  `slocation` varchar(255) DEFAULT NULL COMMENT 'shop location',
  `sgeo` varchar(255) DEFAULT NULL COMMENT 'shop geolocation(map)',
  `scategory` varchar(255) NOT NULL COMMENT 'shop category',
  `sdescription` varchar(255) DEFAULT NULL COMMENT 'shop category'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='shop info table';

-- --------------------------------------------------------

--
-- Table structure for table `usermap`
--

CREATE TABLE `usermap` (
  `uid` varchar(255) NOT NULL COMMENT 'unique user id',
  `username` varchar(255) NOT NULL COMMENT 'username',
  `actype` varchar(25) NOT NULL COMMENT 'type of account'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='user map table';

--
-- Dumping data for table `usermap`
--

INSERT INTO `usermap` (`uid`, `username`, `actype`) VALUES
('666', 'admin', 'sa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD UNIQUE KEY `uid` (`cid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD UNIQUE KEY `uid` (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD UNIQUE KEY `uid` (`pid`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `shopinfo`
--
ALTER TABLE `shopinfo`
  ADD UNIQUE KEY `uid` (`sid`);

--
-- Indexes for table `usermap`
--
ALTER TABLE `usermap`
  ADD UNIQUE KEY `uid` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
