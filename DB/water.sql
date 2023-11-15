-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 15, 2023 at 01:28 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `water`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `SP_DeleteBill`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteBill` (IN `id` INT)   DELETE FROM tbl_bill WHERE tbl_bill.BillID = id$$

DROP PROCEDURE IF EXISTS `SP_DisplayBill`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DisplayBill` ()   SELECT
    tbl_bill.BillID,
    tbl_costumer.Name,
    tbl_costumer.HouseNumber,
    tbl_bill.Date,
    tbl_bill.Amount,
    tbl_bill.Status
FROM
    tbl_bill
INNER JOIN
    tbl_costumer ON tbl_bill.UserID = tbl_costumer.UserID$$

DROP PROCEDURE IF EXISTS `SP_GetAccount`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetAccount` (IN `id` VARCHAR(50), IN `password` VARCHAR(255))   SELECT
    tbl_account.AccountID,
    tbl_account.UserID,
    tbl_account.Username,
    tbl_account.Password,
    tbl_account.Level,
    tbl_costumer.Name,
    tbl_costumer.HouseNumber,
    tbl_costumer.Sex,
    tbl_costumer.Email
FROM tbl_account
INNER JOIN tbl_costumer ON tbl_account.UserID = tbl_costumer.UserID
WHERE tbl_account.Username = id AND tbl_account.Password = password$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

DROP TABLE IF EXISTS `tbl_account`;
CREATE TABLE IF NOT EXISTS `tbl_account` (
  `AccountID` int NOT NULL AUTO_INCREMENT,
  `UserID` int NOT NULL,
  `Username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Level` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`AccountID`),
  KEY `UserID_fk_Customer` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`AccountID`, `UserID`, `Username`, `Password`, `Level`) VALUES
(4, 1, 'cyrus', 'pogi', 'Admin'),
(5, 2, 'jomar', 'reyes', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill`
--

DROP TABLE IF EXISTS `tbl_bill`;
CREATE TABLE IF NOT EXISTS `tbl_bill` (
  `BillID` int NOT NULL AUTO_INCREMENT,
  `UserID` int NOT NULL,
  `Date` date NOT NULL,
  `Amount` float NOT NULL,
  `Status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`BillID`),
  KEY `UserID_fk_Bill` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_bill`
--

INSERT INTO `tbl_bill` (`BillID`, `UserID`, `Date`, `Amount`, `Status`) VALUES
(1, 1, '2023-11-15', 500, 'Paid'),
(3, 2, '2023-11-02', 688.55, 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_costumer`
--

DROP TABLE IF EXISTS `tbl_costumer`;
CREATE TABLE IF NOT EXISTS `tbl_costumer` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HouseNumber` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Sex` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_costumer`
--

INSERT INTO `tbl_costumer` (`UserID`, `Name`, `HouseNumber`, `Sex`, `Email`) VALUES
(1, 'Cyrus E. Tapalla', '187-A', 'Male', 'cyrusthetapalla25@gmail.com'),
(2, 'Jomar Reyes', '186-B', 'Male', 'jomar@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD CONSTRAINT `UserID_fk_Customer` FOREIGN KEY (`UserID`) REFERENCES `tbl_costumer` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD CONSTRAINT `UserID_fk_Bill` FOREIGN KEY (`UserID`) REFERENCES `tbl_costumer` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
