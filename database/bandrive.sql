-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2019 at 02:51 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bandrive`
--

-- --------------------------------------------------------

--
-- Table structure for table `apiusers`
--

CREATE TABLE `apiusers` (
  `apiUserID` int(11) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `api_key` varchar(150) NOT NULL,
  `api_secret` varchar(150) NOT NULL,
  `emailAddress` varchar(50) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `auth_key` varchar(150) DEFAULT NULL,
  `dateActivated` datetime DEFAULT NULL,
  `insertedBy` int(11) NOT NULL DEFAULT '0',
  `dateCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedBy` int(11) NOT NULL DEFAULT '0',
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apiusers`
--

INSERT INTO `apiusers` (`apiUserID`, `clientID`, `api_key`, `api_secret`, `emailAddress`, `active`, `auth_key`, `dateActivated`, `insertedBy`, `dateCreated`, `updatedBy`, `dateModified`) VALUES
(1, 1, 'api-key', '$2a$08$rTtpL/.k1fvN3q8FnOIY4OKb60Kh4aDLrbmTVBBbCNTUFkRS8vZGm', NULL, 1, NULL, NULL, 0, '0000-00-00 00:00:00', 0, '2018-09-25 01:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `campaignID` int(11) UNSIGNED NOT NULL,
  `campaignName` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `uuid` varchar(50) NOT NULL,
  `campaignType` int(11) NOT NULL,
  `clientID` int(11) UNSIGNED NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL,
  `entries` int(11) NOT NULL DEFAULT '0',
  `creditsUsed` int(11) DEFAULT '0',
  `insertedBy` int(11) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL,
  `updatedBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`campaignID`, `campaignName`, `description`, `uuid`, `campaignType`, `clientID`, `startDate`, `endDate`, `status`, `entries`, `creditsUsed`, `insertedBy`, `dateCreated`, `updatedBy`, `dateModified`) VALUES
(1, 'Test', 'test this ois ok', 'sdfa342', 1, 1, '2018-07-23 00:00:00', '2018-07-25 00:00:00', 1, 0, 0, 1, '0000-00-00 00:00:00', 0, '2018-11-04 07:13:58'),
(2, 'Test', 'test this ois ok', '523wew', 1, 1, '2018-07-23 00:00:00', '2018-07-25 00:00:00', 1, 0, 0, 1, '0000-00-00 00:00:00', 0, '2018-11-04 07:14:02'),
(3, 'Dr IQ', 'afda', '2343wewer', 2, 1, '2018-08-01 00:00:00', '2018-08-12 00:00:00', 1, 0, 0, 1, '2018-08-09 12:19:56', 1, '2018-11-04 07:14:05'),
(4, 'adfadfadsssss', '', '895e24de3261d', 0, 1, '2019-12-12 00:00:00', '2020-02-12 00:00:00', 0, 0, 0, 1, '2018-11-09 13:22:30', 1, '2018-11-09 09:25:32'),
(5, 'test campaign as three', '', 'd9b926b3459e0', 0, 1, '2018-01-12 00:00:00', '2000-01-20 00:00:00', 0, 0, 0, 1, '2018-11-09 13:28:17', 1, '2018-11-09 07:28:17'),
(6, 'This is a good one', 'This is a good one', 'd3d3d25e7c782', 0, 1, '2019-02-13 11:00:00', '2019-02-22 11:00:00', 1, 0, 0, 1, '2019-02-13 09:45:27', 1, '2019-02-13 03:45:27'),
(7, 'Winacarruffle', 'Winacarruffle', 'a7486e4e2d90a', 0, 1, '2019-03-01 17:00:00', '2019-04-06 17:00:00', 1, 0, 0, 1, '2019-03-01 15:32:38', 1, '2019-03-01 09:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `campainrequests`
--

CREATE TABLE `campainrequests` (
  `requestsID` int(10) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `campaignID` int(10) UNSIGNED NOT NULL,
  `messageContent` text NOT NULL,
  `settingType` tinyint(4) NOT NULL DEFAULT '1',
  `settingName` text NOT NULL,
  `payBill` int(50) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertedBy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `updatedBy` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campainrequests`
--

INSERT INTO `campainrequests` (`requestsID`, `clientID`, `campaignID`, `messageContent`, `settingType`, `settingName`, `payBill`, `dateCreated`, `dateModified`, `insertedBy`, `updatedBy`) VALUES
(0, 1, 2, 'Mishba', 2, 'Test', 64785, '2019-03-19 12:53:38', '2019-03-19 09:53:38', 1, 1),
(1, 0, 1, '', 1, '', 0, '2019-03-09 13:28:35', '2019-03-09 10:28:35', 0, 0),
(2, 1, 1, '', 1, '', 0, '2019-03-09 13:34:23', '2019-03-09 10:34:23', 1, 0),
(3, 1, 1, '', 1, '', 23423, '2019-03-09 15:20:23', '2019-03-09 12:20:23', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ccodeentries`
--

CREATE TABLE `ccodeentries` (
  `codeID` int(11) UNSIGNED NOT NULL,
  `cCodeID` int(11) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'uploaded code, or autogenerated codes',
  `code` varchar(50) DEFAULT NULL,
  `insertedBy` int(11) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `updatedBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ccodeentriesmapping`
--

CREATE TABLE `ccodeentriesmapping` (
  `mappingID` int(10) UNSIGNED NOT NULL,
  `cCodeID` int(10) UNSIGNED NOT NULL,
  `cEntryID` int(10) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `insertedBy` int(10) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` int(10) UNSIGNED NOT NULL,
  `narration` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ccodes`
--

CREATE TABLE `ccodes` (
  `codeID` int(11) UNSIGNED NOT NULL,
  `campaignID` int(11) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'uploaded code, or autogenerated codes',
  `cCount` int(11) NOT NULL DEFAULT '0',
  `rule` enum('Once','Multiple') NOT NULL DEFAULT 'Once',
  `originalFileName` varchar(50) DEFAULT NULL,
  `generatedFileName` varchar(50) DEFAULT NULL,
  `insertedBy` int(11) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `updatedBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cdrawentries`
--

CREATE TABLE `cdrawentries` (
  `entryID` int(10) UNSIGNED NOT NULL,
  `drawID` int(10) UNSIGNED NOT NULL,
  `cEntryID` int(10) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL,
  `insertedBy` int(10) UNSIGNED NOT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `narration` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cdraws`
--

CREATE TABLE `cdraws` (
  `drawID` int(11) UNSIGNED NOT NULL,
  `uuid` varchar(50) NOT NULL,
  `campaignID` int(10) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `allowPreviousWinners` tinyint(1) NOT NULL DEFAULT '0',
  `drawNumber` int(10) UNSIGNED NOT NULL,
  `drawEntriesFrom` datetime NOT NULL,
  `drawEntriesTo` datetime NOT NULL,
  `winningNumber` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `entriesCount` int(11) UNSIGNED DEFAULT '0',
  `winnersCount` int(11) NOT NULL DEFAULT '0',
  `processed` int(11) DEFAULT '0',
  `bucketID` int(11) DEFAULT '0',
  `dateProcessed` datetime DEFAULT NULL,
  `dateFirstProcessed` datetime DEFAULT NULL,
  `numberOfRuns` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `dateCreated` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `insertedBy` int(11) UNSIGNED DEFAULT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedBy` int(11) UNSIGNED DEFAULT NULL,
  `narration` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cdrawwinners`
--

CREATE TABLE `cdrawwinners` (
  `winID` int(10) UNSIGNED NOT NULL,
  `drawID` int(10) UNSIGNED NOT NULL,
  `cEntryID` int(10) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `numRun` int(11) NOT NULL DEFAULT '1',
  `dateCreated` datetime NOT NULL,
  `insertedBy` int(10) UNSIGNED NOT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `narration` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `centries`
--

CREATE TABLE `centries` (
  `entryID` int(10) UNSIGNED NOT NULL,
  `cRequestID` int(10) UNSIGNED NOT NULL,
  `cResponseID` int(10) UNSIGNED NOT NULL,
  `Participant` varchar(100) NOT NULL,
  `text` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `campaignID` int(10) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `cCodeID` int(10) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL,
  `insertedBy` int(10) UNSIGNED NOT NULL,
  `dateModified` datetime NOT NULL,
  `updatedBy` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientID` int(11) UNSIGNED NOT NULL,
  `uuid` varchar(50) NOT NULL,
  `clientName` varchar(100) NOT NULL,
  `clientDesc` varchar(255) DEFAULT NULL,
  `telephoneNo` varchar(30) NOT NULL,
  `postalAddress` varchar(100) DEFAULT NULL,
  `physicalAddress` varchar(100) DEFAULT NULL,
  `emailAddress` varchar(200) NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '2',
  `activityHistory` text,
  `insertedBy` int(11) NOT NULL DEFAULT '0',
  `dateCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedBy` int(11) NOT NULL DEFAULT '0',
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table stores our clientsâ€™ information. A client is an';

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientID`, `uuid`, `clientName`, `clientDesc`, `telephoneNo`, `postalAddress`, `physicalAddress`, `emailAddress`, `active`, `activityHistory`, `insertedBy`, `dateCreated`, `updatedBy`, `dateModified`) VALUES
(1, '343etr', 'SYSTEM ADMINISTRATION CLIENT', 'System administration account, should not be listed in any drop-down or grids under client tools', '00000', '00000', 'Nairobi', 'bot@bot.com', 1, '1|2|2013-04-19 15:00:00', 1, '2013-04-19 15:00:00', 1, '2018-11-03 08:27:55'),
(14, '', 'george', NULL, '', NULL, NULL, 'ggatuma@gmail.com', 2, NULL, 0, '2019-02-08 12:44:11', 0, '2019-02-08 09:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `confirmation`
--

CREATE TABLE `confirmation` (
  `requestsID` int(10) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `campaignID` int(10) UNSIGNED NOT NULL,
  `settingName` varchar(60) DEFAULT NULL,
  `settingType` tinyint(4) NOT NULL DEFAULT '1',
  `shortCode` varchar(50) NOT NULL,
  `messageContent` text NOT NULL,
  `serviceUrl` varchar(200) NOT NULL,
  `updatedBy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `active` tinyint(3) NOT NULL DEFAULT '2',
  `dateCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertedBy` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `confirmation`
--

INSERT INTO `confirmation` (`requestsID`, `clientID`, `campaignID`, `settingName`, `settingType`, `shortCode`, `messageContent`, `serviceUrl`, `updatedBy`, `active`, `dateCreated`, `dateModified`, `insertedBy`) VALUES
(0, 1, 1, 'Test', 2, '2345', 'Misheba', '', 1, 2, '2019-03-19 15:22:26', '2019-03-19 12:22:26', 1),
(1, 0, 1, NULL, 1, '', '', 'https://api.brandrive.co.ke/raffles/v1/sdfa342/Test', 0, 2, '2019-03-09 13:28:35', '2019-03-09 10:28:35', 0),
(2, 1, 1, 'Test', 1, '', '', 'https://api.brandrive.co.ke/raffles/v1/sdfa342/Test', 1, 2, '2019-03-09 13:34:23', '2019-03-09 10:34:23', 1),
(3, 1, 1, 'Test', 1, '23423', '', '', 1, 2, '2019-03-09 15:20:23', '2019-03-09 12:20:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contactlists`
--

CREATE TABLE `contactlists` (
  `contactListID` int(11) UNSIGNED NOT NULL,
  `listName` varchar(120) NOT NULL,
  `clientID` int(11) UNSIGNED NOT NULL,
  `originalFileName` varchar(100) DEFAULT NULL,
  `generatedFileName` varchar(100) DEFAULT NULL,
  `insertedBy` int(11) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `dateActivated` datetime NOT NULL,
  `updatedBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactlists`
--

INSERT INTO `contactlists` (`contactListID`, `listName`, `clientID`, `originalFileName`, `generatedFileName`, `insertedBy`, `dateCreated`, `active`, `dateActivated`, `updatedBy`, `dateModified`) VALUES
(1, 'test-500knusssms', 1, 'csdata.csv', '1_1_1528711581.csv', 1, '2018-06-11 13:06:22', 3, '0000-00-00 00:00:00', 1, '2018-06-27 09:32:58'),
(2, 'test455', 1, 'csdata2.csv', '1_1_1530084826.csv', 1, '2018-06-27 10:33:46', 1, '0000-00-00 00:00:00', 1, '2018-06-27 07:33:46'),
(3, 'asdafdfa', 1, 'csdata_xc.xlsx', '1_1_1530086426.xlsx', 1, '2018-06-27 11:00:26', 1, '0000-00-00 00:00:00', 1, '2018-06-27 08:00:26'),
(4, 'ddgsgs', 1, 'csdata_xc.xlsx', '1_1_1530086441.xlsx', 1, '2018-06-27 11:00:41', 1, '0000-00-00 00:00:00', 1, '2018-06-27 08:00:41'),
(5, 'testmesafdafd', 54, '1_1_1530172618.9386.csv', '54_13_1530184032.csv', 13, '2018-06-28 14:07:12', 1, '0000-00-00 00:00:00', 13, '2018-06-28 11:07:12');

-- --------------------------------------------------------

--
-- Table structure for table `creditallocation`
--

CREATE TABLE `creditallocation` (
  `allocationID` int(11) NOT NULL,
  `clientID` int(11) UNSIGNED NOT NULL,
  `creditsAllocated` int(11) NOT NULL,
  `creditStatusID` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `allocatedBy` int(11) UNSIGNED NOT NULL,
  `dateAllocated` datetime NOT NULL,
  `updatedBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `creditallocation`
--

INSERT INTO `creditallocation` (`allocationID`, `clientID`, `creditsAllocated`, `creditStatusID`, `allocatedBy`, `dateAllocated`, `updatedBy`, `dateModified`) VALUES
(331, 1, 1000, 1, 1, '2014-09-28 22:28:59', 1, '2014-09-28 20:28:59'),
(332, 1, 1000, 1, 1, '2014-09-28 22:29:45', 1, '2018-06-28 09:23:47'),
(381, 1, 2, 1, 1, '2018-05-21 15:04:18', 1, '2018-05-21 12:04:18'),
(382, 53, 123222, 1, 1, '2018-06-27 13:57:49', 1, '2018-06-27 10:57:49'),
(383, 54, 1000, 1, 1, '2018-06-28 13:59:45', 1, '2018-06-28 10:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `creditconsumption`
--

CREATE TABLE `creditconsumption` (
  `consumptionID` int(11) NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `transactionID` int(10) UNSIGNED NOT NULL,
  `consumedBy` int(11) UNSIGNED NOT NULL,
  `creditsConsumed` int(11) NOT NULL,
  `creditStatusID` int(11) UNSIGNED NOT NULL,
  `dateConsumed` datetime NOT NULL,
  `updatedBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `creditconsumption`
--

INSERT INTO `creditconsumption` (`consumptionID`, `clientID`, `transactionID`, `consumedBy`, `creditsConsumed`, `creditStatusID`, `dateConsumed`, `updatedBy`, `dateModified`) VALUES
(3, 1, 3, 1, 329, 1, '2018-06-28 10:56:58', 1, '2018-06-28 07:56:58'),
(4, 1, 4, 1, 329, 1, '2018-06-28 10:57:20', 1, '2018-06-28 07:57:20'),
(5, 1, 7, 1, 329, 1, '2018-06-28 11:05:03', 1, '2018-06-28 08:05:03'),
(6, 1, 8, 1, 329, 1, '2018-06-28 11:53:39', 1, '2018-06-28 08:53:39'),
(7, 1, 9, 1, 329, 1, '2018-06-28 12:23:56', 1, '2018-06-28 09:23:56'),
(8, 1, 10, 1, 329, 1, '2018-06-28 12:27:33', 1, '2018-06-28 09:27:33'),
(9, 54, 11, 13, 329, 1, '2018-06-28 14:00:17', 13, '2018-06-28 11:00:17'),
(10, 54, 12, 13, 329, 1, '2018-06-28 14:07:59', 13, '2018-06-28 11:07:59'),
(11, 1, 13, 1, 1, 1, '2018-06-30 04:23:28', 1, '2018-06-30 01:23:28'),
(12, 1, 15, 1, 1, 1, '2018-06-30 04:29:11', 1, '2018-06-30 01:29:11'),
(13, 1, 45, 1, 1, 1, '2018-06-30 04:43:46', 1, '2018-06-30 01:43:46'),
(14, 1, 48, 1, 1, 1, '2018-06-30 04:44:34', 1, '2018-06-30 01:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `crules`
--

CREATE TABLE `crules` (
  `ruleID` tinyint(3) UNSIGNED NOT NULL,
  `rule` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `insertedBy` int(10) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL,
  `updateBy` int(10) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `csettings`
--

CREATE TABLE `csettings` (
  `settingID` int(10) UNSIGNED NOT NULL,
  `campaignID` int(10) UNSIGNED NOT NULL,
  `ruleID` tinyint(3) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `insertedBy` int(10) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL,
  `updateBy` int(10) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emailqueue`
--

CREATE TABLE `emailqueue` (
  `emailQueueID` int(11) NOT NULL,
  `emailDestination` varchar(250) NOT NULL,
  `emailSubject` varchar(200) NOT NULL,
  `emailFrom` varchar(250) DEFAULT NULL,
  `emailMessage` text,
  `emailAttachments` text,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '2',
  `activityHistory` text,
  `insertedBy` int(11) UNSIGNED DEFAULT NULL,
  `dateCreated` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedBy` int(11) UNSIGNED DEFAULT NULL,
  `processed` tinyint(3) UNSIGNED DEFAULT '0',
  `numberOfSends` int(5) UNSIGNED DEFAULT '0',
  `nextSend` datetime DEFAULT NULL,
  `processStatus` int(5) UNSIGNED NOT NULL DEFAULT '0',
  `statusData` text,
  `bucketID` int(5) UNSIGNED DEFAULT '0',
  `status` int(5) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emailqueue`
--

INSERT INTO `emailqueue` (`emailQueueID`, `emailDestination`, `emailSubject`, `emailFrom`, `emailMessage`, `emailAttachments`, `active`, `activityHistory`, `insertedBy`, `dateCreated`, `dateModified`, `updatedBy`, `processed`, `numberOfSends`, `nextSend`, `processStatus`, `statusData`, `bucketID`, `status`) VALUES
(4, '12312@gmail.com', 'New User', 'welcome@secudesk.co.ke', NULL, NULL, 1, NULL, 1, '2018-05-19 01:34:32', '2018-05-18 22:34:32', NULL, 0, 0, NULL, 0, NULL, 0, 0),
(5, 'aadfa@gam.co.c', 'New User', 'welcome@secudesk.co.ke', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n    <title></title>\r\n	    <style type=\"text/css\">\r\n        /* CLIENT-SPECIFIC STYLES */\r\n        #outlook a{padding:0;} /* Force Outlook to provide a \"view in brows=\r\ner\" message */\r\n        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotm=\r\nail to display emails at full width */\r\n        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalCla=\r\nss font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Forc=\r\ne Hotmail to display normal line spacing */\r\n        body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adj=\r\nust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes=\r\n */\r\n        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove sp=\r\nacing between tables in Outlook 2007 and up */\r\n        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of=\r\n resized image in Internet Explorer */\r\n\r\n        /* RESET STYLES */\r\n        body{margin:0; padding:0;}\r\n        img{border:0; height:auto; line-height:100%; outline:none; text-dec=\r\noration:none;}\r\n        table{border-collapse:collapse !important;}\r\n        body{height:100% !important; margin:0; padding:0; width:100% !impor=\r\ntant;}\r\n\r\n        /* iOS BLUE LINKS */\r\n        .appleBody a {color:#68440a; text-decoration: none;}\r\n        .appleFooter a {color:#999999; text-decoration: none;}\r\n\r\n        /* MOBILE STYLES */\r\n        @media screen and (max-width: 525px) {\r\n\r\n            /* ALLOWS FOR FLUID TABLES */\r\n            table[class=\"wrapper\"]{\r\n                width:100% !important;\r\n            }\r\n\r\n            /* ADJUSTS LAYOUT OF LOGO IMAGE */\r\n            td[class=\"logo\"]{\r\n                text-align: left;\r\n                padding: 20px 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"logo\"] img{\r\n                margin:0 auto!important;\r\n            }\r\n\r\n            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */\r\n            td[class=\"mobile-hide\"]{\r\n                display:none;}\r\n\r\n            img[class=\"mobile-hide\"]{\r\n                display: none !important;\r\n            }\r\n\r\n            img[class=\"img-max\"]{\r\n                max-width: 100% !important;\r\n                width: 100% !important;\r\n                height:auto !important;\r\n            }\r\n\r\n            /* FULL-WIDTH TABLES */\r\n            table[class=\"responsive-table\"]{\r\n                width:100%!important;\r\n            }\r\n\r\n            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */\r\n            td[class=\"padding\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            td[class=\"padding-copy\"]{\r\n                padding: 10px 5% 10px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"padding-meta\"]{\r\n                padding: 30px 5% 0px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"no-pad\"]{\r\n                padding: 0 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"no-padding\"]{\r\n                padding: 0 !important;\r\n            }\r\n\r\n            td[class=\"section-padding\"]{\r\n                padding: 50px 15px 50px 15px !important;\r\n            }\r\n\r\n            td[class=\"section-padding-bottom-image\"]{\r\n                padding: 50px 15px 0 15px !important;\r\n            }\r\n\r\n            /* ADJUST BUTTONS ON MOBILE */\r\n            td[class=\"mobile-wrapper\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            table[class=\"mobile-button-container\"]{\r\n                margin:0 auto;\r\n                width:100% !important;\r\n            }\r\n\r\n            a[class=\"mobile-button\"]{\r\n                width:80% !important;\r\n                padding: 15px !important;\r\n                border: 0 !important;\r\n                font-size: 16px !important;\r\n            }\r\n\r\n        }\r\n    </style>\r\n</head>\r\n<body style=\"margin: 0; padding: 0;\">\r\n   \r\n<!-- HEADER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr style=\"background-color:#03A9F4\">\r\n        <td bgcolor=\"#03A9F4\">\r\n            <div align=\"center\" style=\"padding: 0px 15px 0px 15px;\">\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"wrapper\">\r\n                    <!-- LOGO/PREHEADER TEXT -->\r\n                    <tbody><tr>\r\n                        <td style=\"padding: 20px 0px 20px 0px;\" class=\"logo\">\r\n                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                    <td bgcolor=\"#03A9F4\" width=\"100\" align=\"center\">\r\n                                     \r\n								   <a href=\"http://www.clarity.co.ke\" target=\"_blank\">\r\n                                            <img alt=\"clarity\" src=\"\" width=\"214\" height=\"70\" style=\"display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;\" border=\"0\">\r\n                                        </a>\r\n										\r\n                                    </td>\r\n                                </tr>\r\n                                </tbody></table>\r\n                        </td>\r\n                    </tr>\r\n                    </tbody></table>\r\n            </div>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n\r\n<!-- ONE COLUMN SECTION -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 70px 15px 70px 15px;\" class=\"section-padding\">\r\n            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td>\r\n                        <!-- HERO IMAGE -->\r\n                        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                            <tbody>\r\n                            <tr>\r\n                                <td>\r\n                                    <!-- COPY -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvet=\r\nica, Arial, sans-serif; color: #666666;\" class=\"padding-copy\">\r\n                                              Hello asdafadfd, click below to set SET PASSWORD.\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <!-- BULLETPROOF BUTTON -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"mobile-button-container\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 25px 0 0 0;\" class=\"padding-copy\">\r\n                                                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"responsive-table\">\r\n                                                    <tbody>\r\n                                                    <tr>\r\n                                                        <td align=\"center\">\r\n\r\n<a href=\"http://localhost/bulkSMS/index.php/site/set-password?token=eiWsuNFs_m6-6CyeP_PtW4fovbsDBv6U_1526683021\" target=\"_blank\" style=\"font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #256F9C; border-top: 15px solid #256F9C; border-bottom: 15px solid #256F9C; border-left: 25px solid #256F9C; border-right: 25px solid #256F9C; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;\" class=\"mobile-button\">SET PASSWORD\r\n</a></td>\r\n                                                    </tr>\r\n                                                    </tbody>\r\n                                                </table>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\" align=\"center\" class=\"responsive-table\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"f=\r\nont-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                                                <span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444=\r\n;\">Please <b>DO NOT</b> click activate, if you did not create this account. Email us at </span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">support@clarity.co.ke</a>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            </tbody></table>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n	<!-- FOOTER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 0px;\">\r\n            <!-- UNSUBSCRIBE COPY -->\r\n            <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td align=\"center\" style=\"font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                        <span class=\"appleFooter\" style=\"color:#666666;\"></span><br><a class=\"original-only\" href=\"http://clarity.co.ke\" style=\"color: #666666=\r\n; text-decoration: none;\">Visit Us</a><span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444;\">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">Email Us</a>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n</body>\r\n</html>\r\n', NULL, 1, NULL, 1, '2018-05-19 01:37:01', '2018-05-18 22:37:01', NULL, 0, 0, NULL, 0, NULL, 0, 0),
(6, 'katiku@gmail.com', 'New API KEY ', 'welcome@secudesk.co.ke', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n    <title></title>\r\n	    <style type=\"text/css\">\r\n        /* CLIENT-SPECIFIC STYLES */\r\n        #outlook a{padding:0;} /* Force Outlook to provide a \"view in brows=\r\ner\" message */\r\n        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotm=\r\nail to display emails at full width */\r\n        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalCla=\r\nss font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Forc=\r\ne Hotmail to display normal line spacing */\r\n        body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adj=\r\nust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes=\r\n */\r\n        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove sp=\r\nacing between tables in Outlook 2007 and up */\r\n        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of=\r\n resized image in Internet Explorer */\r\n\r\n        /* RESET STYLES */\r\n        body{margin:0; padding:0;}\r\n        img{border:0; height:auto; line-height:100%; outline:none; text-dec=\r\noration:none;}\r\n        table{border-collapse:collapse !important;}\r\n        body{height:100% !important; margin:0; padding:0; width:100% !impor=\r\ntant;}\r\n\r\n        /* iOS BLUE LINKS */\r\n        .appleBody a {color:#68440a; text-decoration: none;}\r\n        .appleFooter a {color:#999999; text-decoration: none;}\r\n\r\n        /* MOBILE STYLES */\r\n        @media screen and (max-width: 525px) {\r\n\r\n            /* ALLOWS FOR FLUID TABLES */\r\n            table[class=\"wrapper\"]{\r\n                width:100% !important;\r\n            }\r\n\r\n            /* ADJUSTS LAYOUT OF LOGO IMAGE */\r\n            td[class=\"logo\"]{\r\n                text-align: left;\r\n                padding: 20px 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"logo\"] img{\r\n                margin:0 auto!important;\r\n            }\r\n\r\n            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */\r\n            td[class=\"mobile-hide\"]{\r\n                display:none;}\r\n\r\n            img[class=\"mobile-hide\"]{\r\n                display: none !important;\r\n            }\r\n\r\n            img[class=\"img-max\"]{\r\n                max-width: 100% !important;\r\n                width: 100% !important;\r\n                height:auto !important;\r\n            }\r\n\r\n            /* FULL-WIDTH TABLES */\r\n            table[class=\"responsive-table\"]{\r\n                width:100%!important;\r\n            }\r\n\r\n            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */\r\n            td[class=\"padding\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            td[class=\"padding-copy\"]{\r\n                padding: 10px 5% 10px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"padding-meta\"]{\r\n                padding: 30px 5% 0px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"no-pad\"]{\r\n                padding: 0 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"no-padding\"]{\r\n                padding: 0 !important;\r\n            }\r\n\r\n            td[class=\"section-padding\"]{\r\n                padding: 50px 15px 50px 15px !important;\r\n            }\r\n\r\n            td[class=\"section-padding-bottom-image\"]{\r\n                padding: 50px 15px 0 15px !important;\r\n            }\r\n\r\n            /* ADJUST BUTTONS ON MOBILE */\r\n            td[class=\"mobile-wrapper\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            table[class=\"mobile-button-container\"]{\r\n                margin:0 auto;\r\n                width:100% !important;\r\n            }\r\n\r\n            a[class=\"mobile-button\"]{\r\n                width:80% !important;\r\n                padding: 15px !important;\r\n                border: 0 !important;\r\n                font-size: 16px !important;\r\n            }\r\n\r\n        }\r\n    </style>\r\n</head>\r\n<body style=\"margin: 0; padding: 0;\">\r\n   \r\n<!-- HEADER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr style=\"background-color:#03A9F4\">\r\n        <td bgcolor=\"#03A9F4\">\r\n            <div align=\"center\" style=\"padding: 0px 15px 0px 15px;\">\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"wrapper\">\r\n                    <!-- LOGO/PREHEADER TEXT -->\r\n                    <tbody><tr>\r\n                        <td style=\"padding: 20px 0px 20px 0px;\" class=\"logo\">\r\n                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                    <td bgcolor=\"#03A9F4\" width=\"100\" align=\"center\">\r\n                                     \r\n								   <a href=\"http://www.clarity.co.ke\" target=\"_blank\">\r\n                                            <img alt=\"clarity\" src=\"\" width=\"214\" height=\"70\" style=\"display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;\" border=\"0\">\r\n                                        </a>\r\n										\r\n                                    </td>\r\n                                </tr>\r\n                                </tbody></table>\r\n                        </td>\r\n                    </tr>\r\n                    </tbody></table>\r\n            </div>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n\r\n<!-- ONE COLUMN SECTION -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 70px 15px 70px 15px;\" class=\"section-padding\">\r\n            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td>\r\n                        <!-- HERO IMAGE -->\r\n                        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                            <tbody>\r\n                            <tr>\r\n                                <td>\r\n                                    <!-- COPY -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvet=\r\nica, Arial, sans-serif; color: #666666;\" class=\"padding-copy\">\r\n                                              Hello cmb23332, click below to set SET API SECRET.\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <!-- BULLETPROOF BUTTON -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"mobile-button-container\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 25px 0 0 0;\" class=\"padding-copy\">\r\n                                                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"responsive-table\">\r\n                                                    <tbody>\r\n                                                    <tr>\r\n                                                        <td align=\"center\">\r\n\r\n<a href=\"http://localhost/bulkSMS/index.php/api-users/set-password?token=uxs0rbn68UV1YPL43Y8q4lEFhEmaLNLT_1526895693\" target=\"_blank\" style=\"font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #256F9C; border-top: 15px solid #256F9C; border-bottom: 15px solid #256F9C; border-left: 25px solid #256F9C; border-right: 25px solid #256F9C; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;\" class=\"mobile-button\">SET API SECRET\r\n</a></td>\r\n                                                    </tr>\r\n                                                    </tbody>\r\n                                                </table>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\" align=\"center\" class=\"responsive-table\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"f=\r\nont-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                                                <span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444=\r\n;\">Please <b>DO NOT</b> click activate, if you did not create this account. Email us at </span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">support@clarity.co.ke</a>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            </tbody></table>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n	<!-- FOOTER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 0px;\">\r\n            <!-- UNSUBSCRIBE COPY -->\r\n            <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td align=\"center\" style=\"font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                        <span class=\"appleFooter\" style=\"color:#666666;\"></span><br><a class=\"original-only\" href=\"http://clarity.co.ke\" style=\"color: #666666=\r\n; text-decoration: none;\">Visit Us</a><span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444;\">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">Email Us</a>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n</body>\r\n</html>\r\n', NULL, 1, NULL, 1, '2018-05-21 12:41:33', '2018-05-21 09:41:33', NULL, 0, 0, NULL, 0, NULL, 0, 0),
(7, 'sss@gmail.com', 'New API KEY ', 'welcome@secudesk.co.ke', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n    <title></title>\r\n	    <style type=\"text/css\">\r\n        /* CLIENT-SPECIFIC STYLES */\r\n        #outlook a{padding:0;} /* Force Outlook to provide a \"view in brows=\r\ner\" message */\r\n        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotm=\r\nail to display emails at full width */\r\n        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalCla=\r\nss font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Forc=\r\ne Hotmail to display normal line spacing */\r\n        body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adj=\r\nust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes=\r\n */\r\n        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove sp=\r\nacing between tables in Outlook 2007 and up */\r\n        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of=\r\n resized image in Internet Explorer */\r\n\r\n        /* RESET STYLES */\r\n        body{margin:0; padding:0;}\r\n        img{border:0; height:auto; line-height:100%; outline:none; text-dec=\r\noration:none;}\r\n        table{border-collapse:collapse !important;}\r\n        body{height:100% !important; margin:0; padding:0; width:100% !impor=\r\ntant;}\r\n\r\n        /* iOS BLUE LINKS */\r\n        .appleBody a {color:#68440a; text-decoration: none;}\r\n        .appleFooter a {color:#999999; text-decoration: none;}\r\n\r\n        /* MOBILE STYLES */\r\n        @media screen and (max-width: 525px) {\r\n\r\n            /* ALLOWS FOR FLUID TABLES */\r\n            table[class=\"wrapper\"]{\r\n                width:100% !important;\r\n            }\r\n\r\n            /* ADJUSTS LAYOUT OF LOGO IMAGE */\r\n            td[class=\"logo\"]{\r\n                text-align: left;\r\n                padding: 20px 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"logo\"] img{\r\n                margin:0 auto!important;\r\n            }\r\n\r\n            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */\r\n            td[class=\"mobile-hide\"]{\r\n                display:none;}\r\n\r\n            img[class=\"mobile-hide\"]{\r\n                display: none !important;\r\n            }\r\n\r\n            img[class=\"img-max\"]{\r\n                max-width: 100% !important;\r\n                width: 100% !important;\r\n                height:auto !important;\r\n            }\r\n\r\n            /* FULL-WIDTH TABLES */\r\n            table[class=\"responsive-table\"]{\r\n                width:100%!important;\r\n            }\r\n\r\n            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */\r\n            td[class=\"padding\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            td[class=\"padding-copy\"]{\r\n                padding: 10px 5% 10px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"padding-meta\"]{\r\n                padding: 30px 5% 0px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"no-pad\"]{\r\n                padding: 0 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"no-padding\"]{\r\n                padding: 0 !important;\r\n            }\r\n\r\n            td[class=\"section-padding\"]{\r\n                padding: 50px 15px 50px 15px !important;\r\n            }\r\n\r\n            td[class=\"section-padding-bottom-image\"]{\r\n                padding: 50px 15px 0 15px !important;\r\n            }\r\n\r\n            /* ADJUST BUTTONS ON MOBILE */\r\n            td[class=\"mobile-wrapper\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            table[class=\"mobile-button-container\"]{\r\n                margin:0 auto;\r\n                width:100% !important;\r\n            }\r\n\r\n            a[class=\"mobile-button\"]{\r\n                width:80% !important;\r\n                padding: 15px !important;\r\n                border: 0 !important;\r\n                font-size: 16px !important;\r\n            }\r\n\r\n        }\r\n    </style>\r\n</head>\r\n<body style=\"margin: 0; padding: 0;\">\r\n   \r\n<!-- HEADER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr style=\"background-color:#03A9F4\">\r\n        <td bgcolor=\"#03A9F4\">\r\n            <div align=\"center\" style=\"padding: 0px 15px 0px 15px;\">\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"wrapper\">\r\n                    <!-- LOGO/PREHEADER TEXT -->\r\n                    <tbody><tr>\r\n                        <td style=\"padding: 20px 0px 20px 0px;\" class=\"logo\">\r\n                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                    <td bgcolor=\"#03A9F4\" width=\"100\" align=\"center\">\r\n                                     \r\n								   <a href=\"http://www.clarity.co.ke\" target=\"_blank\">\r\n                                            <img alt=\"clarity\" src=\"\" width=\"214\" height=\"70\" style=\"display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;\" border=\"0\">\r\n                                        </a>\r\n										\r\n                                    </td>\r\n                                </tr>\r\n                                </tbody></table>\r\n                        </td>\r\n                    </tr>\r\n                    </tbody></table>\r\n            </div>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n\r\n<!-- ONE COLUMN SECTION -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 70px 15px 70px 15px;\" class=\"section-padding\">\r\n            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td>\r\n                        <!-- HERO IMAGE -->\r\n                        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                            <tbody>\r\n                            <tr>\r\n                                <td>\r\n                                    <!-- COPY -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvet=\r\nica, Arial, sans-serif; color: #666666;\" class=\"padding-copy\">\r\n                                              Hello 123212312, click below to set SET API SECRET.\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <!-- BULLETPROOF BUTTON -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"mobile-button-container\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 25px 0 0 0;\" class=\"padding-copy\">\r\n                                                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"responsive-table\">\r\n                                                    <tbody>\r\n                                                    <tr>\r\n                                                        <td align=\"center\">\r\n\r\n<a href=\"http://localhost/bulkSMS/index.php/api-users/set-password?token=v5pQMZs-RsCXcaGzv06wyJVPitHQdUGK_1526895746\" target=\"_blank\" style=\"font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #256F9C; border-top: 15px solid #256F9C; border-bottom: 15px solid #256F9C; border-left: 25px solid #256F9C; border-right: 25px solid #256F9C; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;\" class=\"mobile-button\">SET API SECRET\r\n</a></td>\r\n                                                    </tr>\r\n                                                    </tbody>\r\n                                                </table>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\" align=\"center\" class=\"responsive-table\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"f=\r\nont-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                                                <span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444=\r\n;\">Please <b>DO NOT</b> click activate, if you did not create this account. Email us at </span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">support@clarity.co.ke</a>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            </tbody></table>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n	<!-- FOOTER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 0px;\">\r\n            <!-- UNSUBSCRIBE COPY -->\r\n            <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td align=\"center\" style=\"font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                        <span class=\"appleFooter\" style=\"color:#666666;\"></span><br><a class=\"original-only\" href=\"http://clarity.co.ke\" style=\"color: #666666=\r\n; text-decoration: none;\">Visit Us</a><span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444;\">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">Email Us</a>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n</body>\r\n</html>\r\n', NULL, 1, NULL, 1, '2018-05-21 12:42:26', '2018-05-21 09:42:26', NULL, 0, 0, NULL, 0, NULL, 0, 0),
(16, 'Kamau@kamu.com', 'New User', 'welcome@secudesk.co.ke', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n    <title></title>\r\n	    <style type=\"text/css\">\r\n        /* CLIENT-SPECIFIC STYLES */\r\n        #outlook a{padding:0;} /* Force Outlook to provide a \"view in brows=\r\ner\" message */\r\n        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotm=\r\nail to display emails at full width */\r\n        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalCla=\r\nss font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Forc=\r\ne Hotmail to display normal line spacing */\r\n        body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adj=\r\nust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes=\r\n */\r\n        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove sp=\r\nacing between tables in Outlook 2007 and up */\r\n        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of=\r\n resized image in Internet Explorer */\r\n\r\n        /* RESET STYLES */\r\n        body{margin:0; padding:0;}\r\n        img{border:0; height:auto; line-height:100%; outline:none; text-dec=\r\noration:none;}\r\n        table{border-collapse:collapse !important;}\r\n        body{height:100% !important; margin:0; padding:0; width:100% !impor=\r\ntant;}\r\n\r\n        /* iOS BLUE LINKS */\r\n        .appleBody a {color:#68440a; text-decoration: none;}\r\n        .appleFooter a {color:#999999; text-decoration: none;}\r\n\r\n        /* MOBILE STYLES */\r\n        @media screen and (max-width: 525px) {\r\n\r\n            /* ALLOWS FOR FLUID TABLES */\r\n            table[class=\"wrapper\"]{\r\n                width:100% !important;\r\n            }\r\n\r\n            /* ADJUSTS LAYOUT OF LOGO IMAGE */\r\n            td[class=\"logo\"]{\r\n                text-align: left;\r\n                padding: 20px 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"logo\"] img{\r\n                margin:0 auto!important;\r\n            }\r\n\r\n            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */\r\n            td[class=\"mobile-hide\"]{\r\n                display:none;}\r\n\r\n            img[class=\"mobile-hide\"]{\r\n                display: none !important;\r\n            }\r\n\r\n            img[class=\"img-max\"]{\r\n                max-width: 100% !important;\r\n                width: 100% !important;\r\n                height:auto !important;\r\n            }\r\n\r\n            /* FULL-WIDTH TABLES */\r\n            table[class=\"responsive-table\"]{\r\n                width:100%!important;\r\n            }\r\n\r\n            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */\r\n            td[class=\"padding\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            td[class=\"padding-copy\"]{\r\n                padding: 10px 5% 10px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"padding-meta\"]{\r\n                padding: 30px 5% 0px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"no-pad\"]{\r\n                padding: 0 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"no-padding\"]{\r\n                padding: 0 !important;\r\n            }\r\n\r\n            td[class=\"section-padding\"]{\r\n                padding: 50px 15px 50px 15px !important;\r\n            }\r\n\r\n            td[class=\"section-padding-bottom-image\"]{\r\n                padding: 50px 15px 0 15px !important;\r\n            }\r\n\r\n            /* ADJUST BUTTONS ON MOBILE */\r\n            td[class=\"mobile-wrapper\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            table[class=\"mobile-button-container\"]{\r\n                margin:0 auto;\r\n                width:100% !important;\r\n            }\r\n\r\n            a[class=\"mobile-button\"]{\r\n                width:80% !important;\r\n                padding: 15px !important;\r\n                border: 0 !important;\r\n                font-size: 16px !important;\r\n            }\r\n\r\n        }\r\n    </style>\r\n</head>\r\n<body style=\"margin: 0; padding: 0;\">\r\n   \r\n<!-- HEADER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr style=\"background-color:#03A9F4\">\r\n        <td bgcolor=\"#03A9F4\">\r\n            <div align=\"center\" style=\"padding: 0px 15px 0px 15px;\">\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"wrapper\">\r\n                    <!-- LOGO/PREHEADER TEXT -->\r\n                    <tbody><tr>\r\n                        <td style=\"padding: 20px 0px 20px 0px;\" class=\"logo\">\r\n                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                    <td bgcolor=\"#03A9F4\" width=\"100\" align=\"center\">\r\n                                     \r\n								   <a href=\"http://www.clarity.co.ke\" target=\"_blank\">\r\n                                            <img alt=\"clarity\" src=\"\" width=\"214\" height=\"70\" style=\"display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;\" border=\"0\">\r\n                                        </a>\r\n										\r\n                                    </td>\r\n                                </tr>\r\n                                </tbody></table>\r\n                        </td>\r\n                    </tr>\r\n                    </tbody></table>\r\n            </div>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n\r\n<!-- ONE COLUMN SECTION -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 70px 15px 70px 15px;\" class=\"section-padding\">\r\n            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td>\r\n                        <!-- HERO IMAGE -->\r\n                        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                            <tbody>\r\n                            <tr>\r\n                                <td>\r\n                                    <!-- COPY -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvet=\r\nica, Arial, sans-serif; color: #666666;\" class=\"padding-copy\">\r\n                                              Hello Kamau, click below to set SET PASSWORD.\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <!-- BULLETPROOF BUTTON -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"mobile-button-container\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 25px 0 0 0;\" class=\"padding-copy\">\r\n                                                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"responsive-table\">\r\n                                                    <tbody>\r\n                                                    <tr>\r\n                                                        <td align=\"center\">\r\n\r\n<a href=\"http://localhost/bulkSMS/index.php/site/set-password?token=PyelOtwKzU5zsraJmGlTBf9UuOnk90DK_1530088186\" target=\"_blank\" style=\"font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #256F9C; border-top: 15px solid #256F9C; border-bottom: 15px solid #256F9C; border-left: 25px solid #256F9C; border-right: 25px solid #256F9C; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;\" class=\"mobile-button\">SET PASSWORD\r\n</a></td>\r\n                                                    </tr>\r\n                                                    </tbody>\r\n                                                </table>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\" align=\"center\" class=\"responsive-table\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"f=\r\nont-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                                                <span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444=\r\n;\">Please <b>DO NOT</b> click activate, if you did not create this account. Email us at </span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">support@clarity.co.ke</a>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            </tbody></table>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n	<!-- FOOTER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 0px;\">\r\n            <!-- UNSUBSCRIBE COPY -->\r\n            <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td align=\"center\" style=\"font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                        <span class=\"appleFooter\" style=\"color:#666666;\"></span><br><a class=\"original-only\" href=\"http://clarity.co.ke\" style=\"color: #666666=\r\n; text-decoration: none;\">Visit Us</a><span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444;\">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">Email Us</a>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n</body>\r\n</html>\r\n', NULL, 1, NULL, 1, '2018-06-27 11:29:46', '2018-06-27 08:29:46', NULL, 0, 0, NULL, 0, NULL, 0, 0);
INSERT INTO `emailqueue` (`emailQueueID`, `emailDestination`, `emailSubject`, `emailFrom`, `emailMessage`, `emailAttachments`, `active`, `activityHistory`, `insertedBy`, `dateCreated`, `dateModified`, `updatedBy`, `processed`, `numberOfSends`, `nextSend`, `processStatus`, `statusData`, `bucketID`, `status`) VALUES
(17, 'ggatuma@gmail.com', 'New User', 'welcome@secudesk.co.ke', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n    <title></title>\r\n	    <style type=\"text/css\">\r\n        /* CLIENT-SPECIFIC STYLES */\r\n        #outlook a{padding:0;} /* Force Outlook to provide a \"view in brows=\r\ner\" message */\r\n        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotm=\r\nail to display emails at full width */\r\n        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalCla=\r\nss font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Forc=\r\ne Hotmail to display normal line spacing */\r\n        body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adj=\r\nust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes=\r\n */\r\n        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove sp=\r\nacing between tables in Outlook 2007 and up */\r\n        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of=\r\n resized image in Internet Explorer */\r\n\r\n        /* RESET STYLES */\r\n        body{margin:0; padding:0;}\r\n        img{border:0; height:auto; line-height:100%; outline:none; text-dec=\r\noration:none;}\r\n        table{border-collapse:collapse !important;}\r\n        body{height:100% !important; margin:0; padding:0; width:100% !impor=\r\ntant;}\r\n\r\n        /* iOS BLUE LINKS */\r\n        .appleBody a {color:#68440a; text-decoration: none;}\r\n        .appleFooter a {color:#999999; text-decoration: none;}\r\n\r\n        /* MOBILE STYLES */\r\n        @media screen and (max-width: 525px) {\r\n\r\n            /* ALLOWS FOR FLUID TABLES */\r\n            table[class=\"wrapper\"]{\r\n                width:100% !important;\r\n            }\r\n\r\n            /* ADJUSTS LAYOUT OF LOGO IMAGE */\r\n            td[class=\"logo\"]{\r\n                text-align: left;\r\n                padding: 20px 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"logo\"] img{\r\n                margin:0 auto!important;\r\n            }\r\n\r\n            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */\r\n            td[class=\"mobile-hide\"]{\r\n                display:none;}\r\n\r\n            img[class=\"mobile-hide\"]{\r\n                display: none !important;\r\n            }\r\n\r\n            img[class=\"img-max\"]{\r\n                max-width: 100% !important;\r\n                width: 100% !important;\r\n                height:auto !important;\r\n            }\r\n\r\n            /* FULL-WIDTH TABLES */\r\n            table[class=\"responsive-table\"]{\r\n                width:100%!important;\r\n            }\r\n\r\n            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */\r\n            td[class=\"padding\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            td[class=\"padding-copy\"]{\r\n                padding: 10px 5% 10px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"padding-meta\"]{\r\n                padding: 30px 5% 0px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"no-pad\"]{\r\n                padding: 0 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"no-padding\"]{\r\n                padding: 0 !important;\r\n            }\r\n\r\n            td[class=\"section-padding\"]{\r\n                padding: 50px 15px 50px 15px !important;\r\n            }\r\n\r\n            td[class=\"section-padding-bottom-image\"]{\r\n                padding: 50px 15px 0 15px !important;\r\n            }\r\n\r\n            /* ADJUST BUTTONS ON MOBILE */\r\n            td[class=\"mobile-wrapper\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            table[class=\"mobile-button-container\"]{\r\n                margin:0 auto;\r\n                width:100% !important;\r\n            }\r\n\r\n            a[class=\"mobile-button\"]{\r\n                width:80% !important;\r\n                padding: 15px !important;\r\n                border: 0 !important;\r\n                font-size: 16px !important;\r\n            }\r\n\r\n        }\r\n    </style>\r\n</head>\r\n<body style=\"margin: 0; padding: 0;\">\r\n   \r\n<!-- HEADER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr style=\"background-color:#03A9F4\">\r\n        <td bgcolor=\"#03A9F4\">\r\n            <div align=\"center\" style=\"padding: 0px 15px 0px 15px;\">\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"wrapper\">\r\n                    <!-- LOGO/PREHEADER TEXT -->\r\n                    <tbody><tr>\r\n                        <td style=\"padding: 20px 0px 20px 0px;\" class=\"logo\">\r\n                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                    <td bgcolor=\"#03A9F4\" width=\"100\" align=\"center\">\r\n                                     \r\n								   <a href=\"http://www.clarity.co.ke\" target=\"_blank\">\r\n                                            <img alt=\"clarity\" src=\"\" width=\"214\" height=\"70\" style=\"display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;\" border=\"0\">\r\n                                        </a>\r\n										\r\n                                    </td>\r\n                                </tr>\r\n                                </tbody></table>\r\n                        </td>\r\n                    </tr>\r\n                    </tbody></table>\r\n            </div>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n\r\n<!-- ONE COLUMN SECTION -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 70px 15px 70px 15px;\" class=\"section-padding\">\r\n            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td>\r\n                        <!-- HERO IMAGE -->\r\n                        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                            <tbody>\r\n                            <tr>\r\n                                <td>\r\n                                    <!-- COPY -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvet=\r\nica, Arial, sans-serif; color: #666666;\" class=\"padding-copy\">\r\n                                              Hello ggatuma, click below to set SET PASSWORD.\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <!-- BULLETPROOF BUTTON -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"mobile-button-container\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 25px 0 0 0;\" class=\"padding-copy\">\r\n                                                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"responsive-table\">\r\n                                                    <tbody>\r\n                                                    <tr>\r\n                                                        <td align=\"center\">\r\n\r\n<a href=\"http://localhost/bulkSMS/index.php/site/set-password?token=77aZjojUBaFOvAh6cD0S0vpjjYtcS8m2_1530181389\" target=\"_blank\" style=\"font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #256F9C; border-top: 15px solid #256F9C; border-bottom: 15px solid #256F9C; border-left: 25px solid #256F9C; border-right: 25px solid #256F9C; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;\" class=\"mobile-button\">SET PASSWORD\r\n</a></td>\r\n                                                    </tr>\r\n                                                    </tbody>\r\n                                                </table>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\" align=\"center\" class=\"responsive-table\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"f=\r\nont-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                                                <span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444=\r\n;\">Please <b>DO NOT</b> click activate, if you did not create this account. Email us at </span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">support@clarity.co.ke</a>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            </tbody></table>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n	<!-- FOOTER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 0px;\">\r\n            <!-- UNSUBSCRIBE COPY -->\r\n            <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td align=\"center\" style=\"font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                        <span class=\"appleFooter\" style=\"color:#666666;\"></span><br><a class=\"original-only\" href=\"http://clarity.co.ke\" style=\"color: #666666=\r\n; text-decoration: none;\">Visit Us</a><span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444;\">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">Email Us</a>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n</body>\r\n</html>\r\n', NULL, 1, NULL, 1, '2018-06-28 13:23:09', '2018-06-28 10:23:09', NULL, 0, 0, NULL, 0, NULL, 0, 0),
(18, 'ggatuma@gmail.com', 'RESET PASSWORD', 'welcome@secudesk.co.ke', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n    <title></title>\r\n	    <style type=\"text/css\">\r\n        /* CLIENT-SPECIFIC STYLES */\r\n        #outlook a{padding:0;} /* Force Outlook to provide a \"view in brows=\r\ner\" message */\r\n        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotm=\r\nail to display emails at full width */\r\n        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalCla=\r\nss font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Forc=\r\ne Hotmail to display normal line spacing */\r\n        body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adj=\r\nust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes=\r\n */\r\n        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove sp=\r\nacing between tables in Outlook 2007 and up */\r\n        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of=\r\n resized image in Internet Explorer */\r\n\r\n        /* RESET STYLES */\r\n        body{margin:0; padding:0;}\r\n        img{border:0; height:auto; line-height:100%; outline:none; text-dec=\r\noration:none;}\r\n        table{border-collapse:collapse !important;}\r\n        body{height:100% !important; margin:0; padding:0; width:100% !impor=\r\ntant;}\r\n\r\n        /* iOS BLUE LINKS */\r\n        .appleBody a {color:#68440a; text-decoration: none;}\r\n        .appleFooter a {color:#999999; text-decoration: none;}\r\n\r\n        /* MOBILE STYLES */\r\n        @media screen and (max-width: 525px) {\r\n\r\n            /* ALLOWS FOR FLUID TABLES */\r\n            table[class=\"wrapper\"]{\r\n                width:100% !important;\r\n            }\r\n\r\n            /* ADJUSTS LAYOUT OF LOGO IMAGE */\r\n            td[class=\"logo\"]{\r\n                text-align: left;\r\n                padding: 20px 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"logo\"] img{\r\n                margin:0 auto!important;\r\n            }\r\n\r\n            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */\r\n            td[class=\"mobile-hide\"]{\r\n                display:none;}\r\n\r\n            img[class=\"mobile-hide\"]{\r\n                display: none !important;\r\n            }\r\n\r\n            img[class=\"img-max\"]{\r\n                max-width: 100% !important;\r\n                width: 100% !important;\r\n                height:auto !important;\r\n            }\r\n\r\n            /* FULL-WIDTH TABLES */\r\n            table[class=\"responsive-table\"]{\r\n                width:100%!important;\r\n            }\r\n\r\n            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */\r\n            td[class=\"padding\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            td[class=\"padding-copy\"]{\r\n                padding: 10px 5% 10px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"padding-meta\"]{\r\n                padding: 30px 5% 0px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"no-pad\"]{\r\n                padding: 0 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"no-padding\"]{\r\n                padding: 0 !important;\r\n            }\r\n\r\n            td[class=\"section-padding\"]{\r\n                padding: 50px 15px 50px 15px !important;\r\n            }\r\n\r\n            td[class=\"section-padding-bottom-image\"]{\r\n                padding: 50px 15px 0 15px !important;\r\n            }\r\n\r\n            /* ADJUST BUTTONS ON MOBILE */\r\n            td[class=\"mobile-wrapper\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            table[class=\"mobile-button-container\"]{\r\n                margin:0 auto;\r\n                width:100% !important;\r\n            }\r\n\r\n            a[class=\"mobile-button\"]{\r\n                width:80% !important;\r\n                padding: 15px !important;\r\n                border: 0 !important;\r\n                font-size: 16px !important;\r\n            }\r\n\r\n        }\r\n    </style>\r\n</head>\r\n<body style=\"margin: 0; padding: 0;\">\r\n   \r\n<!-- HEADER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr style=\"background-color:#03A9F4\">\r\n        <td bgcolor=\"#03A9F4\">\r\n            <div align=\"center\" style=\"padding: 0px 15px 0px 15px;\">\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"wrapper\">\r\n                    <!-- LOGO/PREHEADER TEXT -->\r\n                    <tbody><tr>\r\n                        <td style=\"padding: 20px 0px 20px 0px;\" class=\"logo\">\r\n                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                    <td bgcolor=\"#03A9F4\" width=\"100\" align=\"center\">\r\n                                     \r\n								   <a href=\"http://www.clarity.co.ke\" target=\"_blank\">\r\n                                            <img alt=\"clarity\" src=\"\" width=\"214\" height=\"70\" style=\"display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;\" border=\"0\">\r\n                                        </a>\r\n										\r\n                                    </td>\r\n                                </tr>\r\n                                </tbody></table>\r\n                        </td>\r\n                    </tr>\r\n                    </tbody></table>\r\n            </div>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n\r\n<!-- ONE COLUMN SECTION -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 70px 15px 70px 15px;\" class=\"section-padding\">\r\n            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td>\r\n                        <!-- HERO IMAGE -->\r\n                        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                            <tbody>\r\n                            <tr>\r\n                                <td>\r\n                                    <!-- COPY -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvet=\r\nica, Arial, sans-serif; color: #666666;\" class=\"padding-copy\">\r\n                                              Hello ggatuma, click below to set SET PASSWORD.\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <!-- BULLETPROOF BUTTON -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"mobile-button-container\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 25px 0 0 0;\" class=\"padding-copy\">\r\n                                                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"responsive-table\">\r\n                                                    <tbody>\r\n                                                    <tr>\r\n                                                        <td align=\"center\">\r\n\r\n<a href=\"http://localhost/bulkSMS/index.php/site/set-password?token=RSt0IIlUdi8izDOU-g2iMIynK7OftpwX_1530182834\" target=\"_blank\" style=\"font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #256F9C; border-top: 15px solid #256F9C; border-bottom: 15px solid #256F9C; border-left: 25px solid #256F9C; border-right: 25px solid #256F9C; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;\" class=\"mobile-button\">SET PASSWORD\r\n</a></td>\r\n                                                    </tr>\r\n                                                    </tbody>\r\n                                                </table>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\" align=\"center\" class=\"responsive-table\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"f=\r\nont-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                                                <span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444=\r\n;\">Please <b>DO NOT</b> click activate, if you did not create this account. Email us at </span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">support@clarity.co.ke</a>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            </tbody></table>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n	<!-- FOOTER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 0px;\">\r\n            <!-- UNSUBSCRIBE COPY -->\r\n            <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td align=\"center\" style=\"font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                        <span class=\"appleFooter\" style=\"color:#666666;\"></span><br><a class=\"original-only\" href=\"http://clarity.co.ke\" style=\"color: #666666=\r\n; text-decoration: none;\">Visit Us</a><span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444;\">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">Email Us</a>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n</body>\r\n</html>\r\n', NULL, 1, NULL, 1, '2018-06-28 13:47:14', '2018-06-28 10:47:14', NULL, 0, 0, NULL, 0, NULL, 0, 0),
(19, 'ggatuma@gmail.com', 'RESET PASSWORD', 'welcome@secudesk.co.ke', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n    <title></title>\r\n	    <style type=\"text/css\">\r\n        /* CLIENT-SPECIFIC STYLES */\r\n        #outlook a{padding:0;} /* Force Outlook to provide a \"view in brows=\r\ner\" message */\r\n        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotm=\r\nail to display emails at full width */\r\n        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalCla=\r\nss font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Forc=\r\ne Hotmail to display normal line spacing */\r\n        body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adj=\r\nust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes=\r\n */\r\n        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove sp=\r\nacing between tables in Outlook 2007 and up */\r\n        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of=\r\n resized image in Internet Explorer */\r\n\r\n        /* RESET STYLES */\r\n        body{margin:0; padding:0;}\r\n        img{border:0; height:auto; line-height:100%; outline:none; text-dec=\r\noration:none;}\r\n        table{border-collapse:collapse !important;}\r\n        body{height:100% !important; margin:0; padding:0; width:100% !impor=\r\ntant;}\r\n\r\n        /* iOS BLUE LINKS */\r\n        .appleBody a {color:#68440a; text-decoration: none;}\r\n        .appleFooter a {color:#999999; text-decoration: none;}\r\n\r\n        /* MOBILE STYLES */\r\n        @media screen and (max-width: 525px) {\r\n\r\n            /* ALLOWS FOR FLUID TABLES */\r\n            table[class=\"wrapper\"]{\r\n                width:100% !important;\r\n            }\r\n\r\n            /* ADJUSTS LAYOUT OF LOGO IMAGE */\r\n            td[class=\"logo\"]{\r\n                text-align: left;\r\n                padding: 20px 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"logo\"] img{\r\n                margin:0 auto!important;\r\n            }\r\n\r\n            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */\r\n            td[class=\"mobile-hide\"]{\r\n                display:none;}\r\n\r\n            img[class=\"mobile-hide\"]{\r\n                display: none !important;\r\n            }\r\n\r\n            img[class=\"img-max\"]{\r\n                max-width: 100% !important;\r\n                width: 100% !important;\r\n                height:auto !important;\r\n            }\r\n\r\n            /* FULL-WIDTH TABLES */\r\n            table[class=\"responsive-table\"]{\r\n                width:100%!important;\r\n            }\r\n\r\n            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */\r\n            td[class=\"padding\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            td[class=\"padding-copy\"]{\r\n                padding: 10px 5% 10px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"padding-meta\"]{\r\n                padding: 30px 5% 0px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"no-pad\"]{\r\n                padding: 0 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"no-padding\"]{\r\n                padding: 0 !important;\r\n            }\r\n\r\n            td[class=\"section-padding\"]{\r\n                padding: 50px 15px 50px 15px !important;\r\n            }\r\n\r\n            td[class=\"section-padding-bottom-image\"]{\r\n                padding: 50px 15px 0 15px !important;\r\n            }\r\n\r\n            /* ADJUST BUTTONS ON MOBILE */\r\n            td[class=\"mobile-wrapper\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            table[class=\"mobile-button-container\"]{\r\n                margin:0 auto;\r\n                width:100% !important;\r\n            }\r\n\r\n            a[class=\"mobile-button\"]{\r\n                width:80% !important;\r\n                padding: 15px !important;\r\n                border: 0 !important;\r\n                font-size: 16px !important;\r\n            }\r\n\r\n        }\r\n    </style>\r\n</head>\r\n<body style=\"margin: 0; padding: 0;\">\r\n   \r\n<!-- HEADER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr style=\"background-color:#03A9F4\">\r\n        <td bgcolor=\"#03A9F4\">\r\n            <div align=\"center\" style=\"padding: 0px 15px 0px 15px;\">\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"wrapper\">\r\n                    <!-- LOGO/PREHEADER TEXT -->\r\n                    <tbody><tr>\r\n                        <td style=\"padding: 20px 0px 20px 0px;\" class=\"logo\">\r\n                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                    <td bgcolor=\"#03A9F4\" width=\"100\" align=\"center\">\r\n                                     \r\n								   <a href=\"http://www.clarity.co.ke\" target=\"_blank\">\r\n                                            <img alt=\"clarity\" src=\"\" width=\"214\" height=\"70\" style=\"display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;\" border=\"0\">\r\n                                        </a>\r\n										\r\n                                    </td>\r\n                                </tr>\r\n                                </tbody></table>\r\n                        </td>\r\n                    </tr>\r\n                    </tbody></table>\r\n            </div>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n\r\n<!-- ONE COLUMN SECTION -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 70px 15px 70px 15px;\" class=\"section-padding\">\r\n            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td>\r\n                        <!-- HERO IMAGE -->\r\n                        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                            <tbody>\r\n                            <tr>\r\n                                <td>\r\n                                    <!-- COPY -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvet=\r\nica, Arial, sans-serif; color: #666666;\" class=\"padding-copy\">\r\n                                              Hello ggatuma, click below to set SET PASSWORD.\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <!-- BULLETPROOF BUTTON -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"mobile-button-container\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 25px 0 0 0;\" class=\"padding-copy\">\r\n                                                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"responsive-table\">\r\n                                                    <tbody>\r\n                                                    <tr>\r\n                                                        <td align=\"center\">\r\n\r\n<a href=\"http://localhost/bulkSMS/index.php/site/set-password?token=xXMjSwvy6jzPMVOVm1M1YrxHZKEfOA-6_1530182848\" target=\"_blank\" style=\"font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #256F9C; border-top: 15px solid #256F9C; border-bottom: 15px solid #256F9C; border-left: 25px solid #256F9C; border-right: 25px solid #256F9C; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;\" class=\"mobile-button\">SET PASSWORD\r\n</a></td>\r\n                                                    </tr>\r\n                                                    </tbody>\r\n                                                </table>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\" align=\"center\" class=\"responsive-table\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"f=\r\nont-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                                                <span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444=\r\n;\">Please <b>DO NOT</b> click activate, if you did not create this account. Email us at </span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">support@clarity.co.ke</a>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            </tbody></table>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n	<!-- FOOTER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 0px;\">\r\n            <!-- UNSUBSCRIBE COPY -->\r\n            <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td align=\"center\" style=\"font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                        <span class=\"appleFooter\" style=\"color:#666666;\"></span><br><a class=\"original-only\" href=\"http://clarity.co.ke\" style=\"color: #666666=\r\n; text-decoration: none;\">Visit Us</a><span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444;\">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">Email Us</a>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n</body>\r\n</html>\r\n', NULL, 1, NULL, 1, '2018-06-28 13:47:28', '2018-06-28 10:47:28', NULL, 0, 0, NULL, 0, NULL, 0, 0),
(20, 'ggatuma@gmail.com', 'RESET PASSWORD', 'welcome@secudesk.co.ke', '<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n    <title></title>\r\n	    <style type=\"text/css\">\r\n        /* CLIENT-SPECIFIC STYLES */\r\n        #outlook a{padding:0;} /* Force Outlook to provide a \"view in brows=\r\ner\" message */\r\n        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotm=\r\nail to display emails at full width */\r\n        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalCla=\r\nss font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Forc=\r\ne Hotmail to display normal line spacing */\r\n        body, table, td, a{-webkit-text-size-adjust:100%; -ms-text-size-adj=\r\nust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes=\r\n */\r\n        table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove sp=\r\nacing between tables in Outlook 2007 and up */\r\n        img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of=\r\n resized image in Internet Explorer */\r\n\r\n        /* RESET STYLES */\r\n        body{margin:0; padding:0;}\r\n        img{border:0; height:auto; line-height:100%; outline:none; text-dec=\r\noration:none;}\r\n        table{border-collapse:collapse !important;}\r\n        body{height:100% !important; margin:0; padding:0; width:100% !impor=\r\ntant;}\r\n\r\n        /* iOS BLUE LINKS */\r\n        .appleBody a {color:#68440a; text-decoration: none;}\r\n        .appleFooter a {color:#999999; text-decoration: none;}\r\n\r\n        /* MOBILE STYLES */\r\n        @media screen and (max-width: 525px) {\r\n\r\n            /* ALLOWS FOR FLUID TABLES */\r\n            table[class=\"wrapper\"]{\r\n                width:100% !important;\r\n            }\r\n\r\n            /* ADJUSTS LAYOUT OF LOGO IMAGE */\r\n            td[class=\"logo\"]{\r\n                text-align: left;\r\n                padding: 20px 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"logo\"] img{\r\n                margin:0 auto!important;\r\n            }\r\n\r\n            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */\r\n            td[class=\"mobile-hide\"]{\r\n                display:none;}\r\n\r\n            img[class=\"mobile-hide\"]{\r\n                display: none !important;\r\n            }\r\n\r\n            img[class=\"img-max\"]{\r\n                max-width: 100% !important;\r\n                width: 100% !important;\r\n                height:auto !important;\r\n            }\r\n\r\n            /* FULL-WIDTH TABLES */\r\n            table[class=\"responsive-table\"]{\r\n                width:100%!important;\r\n            }\r\n\r\n            /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */\r\n            td[class=\"padding\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            td[class=\"padding-copy\"]{\r\n                padding: 10px 5% 10px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"padding-meta\"]{\r\n                padding: 30px 5% 0px 5% !important;\r\n                text-align: center;\r\n            }\r\n\r\n            td[class=\"no-pad\"]{\r\n                padding: 0 0 20px 0 !important;\r\n            }\r\n\r\n            td[class=\"no-padding\"]{\r\n                padding: 0 !important;\r\n            }\r\n\r\n            td[class=\"section-padding\"]{\r\n                padding: 50px 15px 50px 15px !important;\r\n            }\r\n\r\n            td[class=\"section-padding-bottom-image\"]{\r\n                padding: 50px 15px 0 15px !important;\r\n            }\r\n\r\n            /* ADJUST BUTTONS ON MOBILE */\r\n            td[class=\"mobile-wrapper\"]{\r\n                padding: 10px 5% 15px 5% !important;\r\n            }\r\n\r\n            table[class=\"mobile-button-container\"]{\r\n                margin:0 auto;\r\n                width:100% !important;\r\n            }\r\n\r\n            a[class=\"mobile-button\"]{\r\n                width:80% !important;\r\n                padding: 15px !important;\r\n                border: 0 !important;\r\n                font-size: 16px !important;\r\n            }\r\n\r\n        }\r\n    </style>\r\n</head>\r\n<body style=\"margin: 0; padding: 0;\">\r\n   \r\n<!-- HEADER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr style=\"background-color:#03A9F4\">\r\n        <td bgcolor=\"#03A9F4\">\r\n            <div align=\"center\" style=\"padding: 0px 15px 0px 15px;\">\r\n                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"wrapper\">\r\n                    <!-- LOGO/PREHEADER TEXT -->\r\n                    <tbody><tr>\r\n                        <td style=\"padding: 20px 0px 20px 0px;\" class=\"logo\">\r\n                            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n                                <tbody><tr>\r\n                                    <td bgcolor=\"#03A9F4\" width=\"100\" align=\"center\">\r\n                                     \r\n								   <a href=\"http://www.clarity.co.ke\" target=\"_blank\">\r\n                                            <img alt=\"clarity\" src=\"\" width=\"214\" height=\"70\" style=\"display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px;\" border=\"0\">\r\n                                        </a>\r\n										\r\n                                    </td>\r\n                                </tr>\r\n                                </tbody></table>\r\n                        </td>\r\n                    </tr>\r\n                    </tbody></table>\r\n            </div>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n\r\n<!-- ONE COLUMN SECTION -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 70px 15px 70px 15px;\" class=\"section-padding\">\r\n            <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"500\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td>\r\n                        <!-- HERO IMAGE -->\r\n                        <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                            <tbody>\r\n                            <tr>\r\n                                <td>\r\n                                    <!-- COPY -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvet=\r\nica, Arial, sans-serif; color: #666666;\" class=\"padding-copy\">\r\n                                              Hello ggatuma, click below to set SET PASSWORD.\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <!-- BULLETPROOF BUTTON -->\r\n                                    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"mobile-button-container\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"padding: 25px 0 0 0;\" class=\"padding-copy\">\r\n                                                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"responsive-table\">\r\n                                                    <tbody>\r\n                                                    <tr>\r\n                                                        <td align=\"center\">\r\n\r\n<a href=\"http://localhost/bulkSMS/index.php/site/set-password?token=_jg3I9LrKgGpoFZIIcbVlhwU2uPv6Naj_1530182983\" target=\"_blank\" style=\"font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #256F9C; border-top: 15px solid #256F9C; border-bottom: 15px solid #256F9C; border-left: 25px solid #256F9C; border-right: 25px solid #256F9C; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;\" class=\"mobile-button\">SET PASSWORD\r\n</a></td>\r\n                                                    </tr>\r\n                                                    </tbody>\r\n                                                </table>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            <tr>\r\n                                <td align=\"center\">\r\n                                    <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\" align=\"center\" class=\"responsive-table\">\r\n                                        <tbody>\r\n                                        <tr>\r\n                                            <td align=\"center\" style=\"f=\r\nont-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                                                <span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444=\r\n;\">Please <b>DO NOT</b> click activate, if you did not create this account. Email us at </span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">support@clarity.co.ke</a>\r\n                                            </td>\r\n                                        </tr>\r\n                                        </tbody>\r\n                                    </table>\r\n                                </td>\r\n                            </tr>\r\n                            </tbody></table>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n	<!-- FOOTER -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n    <tbody><tr>\r\n        <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 0px;\">\r\n            <!-- UNSUBSCRIBE COPY -->\r\n            <table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" class=\"responsive-table\">\r\n                <tbody><tr>\r\n                    <td align=\"center\" style=\"font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;\">\r\n                        <span class=\"appleFooter\" style=\"color:#666666;\"></span><br><a class=\"original-only\" href=\"http://clarity.co.ke\" style=\"color: #666666=\r\n; text-decoration: none;\">Visit Us</a><span class=\"original-only\" style=\"font-family: Arial, sans-serif; font-size: 12px; color: #444444;\">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><a style=\"color: #666666; text-decoration: none;\" href=\"mailto:support@clarity.co.ke\">Email Us</a>\r\n                    </td>\r\n                </tr>\r\n                </tbody></table>\r\n        </td>\r\n    </tr>\r\n    </tbody></table>\r\n</body>\r\n</html>\r\n', NULL, 1, NULL, 1, '2018-06-28 13:49:43', '2018-06-28 10:49:43', NULL, 0, 0, NULL, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupID` int(5) UNSIGNED NOT NULL,
  `groupTypeID` int(5) UNSIGNED NOT NULL,
  `groupName` varchar(45) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `active` tinyint(3) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `insertedBy` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupID`, `groupTypeID`, `groupName`, `description`, `active`, `dateCreated`, `insertedBy`, `dateModified`, `updatedBy`) VALUES
(1, 1, 'Super Admin [Full access]', 'Super Admins (Full access)', 1, '2013-04-19 11:51:06', 1, '2018-06-27 08:16:06', 1),
(19, 3, 'testw', 'test', 3, '2018-05-21 14:23:03', 1, '2018-06-27 08:16:41', 1),
(20, 3, 'New Groupt', '', 1, '2018-06-27 14:09:16', 1, '2018-06-27 11:09:16', 1),
(21, 3, 'Client-users', 'Client-users', 1, '2018-06-28 13:20:22', 1, '2018-06-28 10:20:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mnemonics`
--

CREATE TABLE `mnemonics` (
  `mnemonicID` int(11) UNSIGNED NOT NULL,
  `mnemonicName` varchar(120) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `insertedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mnemonics`
--

INSERT INTO `mnemonics` (`mnemonicID`, `mnemonicName`, `dateCreated`, `insertedBy`, `dateModified`, `updatedBy`) VALUES
(1, '^CUST_NAME^', '1970-01-01 00:00:00', 1, '2011-03-02 11:32:10', 1),
(2, '^CURRENCY^', '1970-01-01 00:00:00', 0, '2011-03-02 11:32:24', 0),
(3, '^AVAIL_BAL^', '1970-01-01 00:00:00', 0, '2011-03-02 11:33:21', 0),
(4, '^LEDGER_BAL^', '1970-01-01 00:00:00', 0, '2011-03-02 11:33:21', 0),
(5, '^CLIENTID^', '1970-01-01 00:00:00', 0, '2018-05-22 08:42:36', 0),
(6, '^AMOUNT^', '1970-01-01 00:00:00', 0, '2011-03-02 11:33:22', 0),
(7, '^MSISDN^', '1970-01-01 00:00:00', 0, '2011-04-08 11:39:02', 0),
(8, '^BUYING_RATE^', '1970-01-01 00:00:00', 0, '2011-03-02 11:33:22', 0),
(9, '^SELLING_RATE^', '1970-01-01 00:00:00', 0, '2011-03-02 11:33:22', 0),
(10, '^REASON^', '1970-01-01 00:00:00', 0, '2011-03-02 11:34:07', 0),
(11, '^MERCHANT_NAME^', '1970-01-01 00:00:00', 0, '2011-03-02 11:34:07', 0),
(12, '^REF_NUMBER^', '1970-01-01 00:00:00', 0, '2011-03-02 11:34:07', 0),
(13, '^ACCOUNT^', '1970-01-01 00:00:00', 0, '2011-03-02 11:34:07', 0),
(14, '^BALANCE^', '1970-01-01 00:00:00', 0, '2011-03-02 11:34:07', 0),
(15, '^ACTION^', '1970-01-01 00:00:00', 0, '2011-03-08 04:22:38', 0),
(16, '^PIN_NUMBER^', '1970-01-01 00:00:00', 1, '2011-03-10 12:12:10', 1),
(17, '^CLIENT_SIGNATURE^', '1970-01-01 00:00:00', 0, '2011-03-24 07:42:01', 0),
(18, '^SOURCE^', '1970-01-01 00:00:00', 0, '2011-03-28 17:17:11', 0),
(19, '^DESTINATION^', '1970-01-01 00:00:00', 0, '2011-03-28 17:17:11', 0),
(20, '^RECIPIENT_MSISDN^', '1970-01-01 00:00:00', 0, '2011-03-28 17:38:05', 0),
(21, '^TILL_BALANCE^', '1970-01-01 00:00:00', 0, '2011-04-18 10:28:10', 0),
(22, '^TRANSACTION_TYPE^', '1970-01-01 00:00:00', 0, '2018-01-11 09:39:59', 0),
(23, '^DATEFROM^', '2012-01-17 12:06:10', 237, '2012-04-26 12:38:44', 237),
(24, '^DATETO^', '2012-07-30 16:27:54', 237, '2012-07-30 13:27:54', 237);

-- --------------------------------------------------------

--
-- Table structure for table `outbound`
--

CREATE TABLE `outbound` (
  `outboundID` int(11) UNSIGNED NOT NULL,
  `transactionID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `messageID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `gatewayUUID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `sourceAddress` varchar(13) NOT NULL,
  `accessCode` int(11) DEFAULT '0',
  `MSISDN` bigint(15) NOT NULL,
  `serviceID` bigint(20) DEFAULT '0',
  `lastSend` datetime DEFAULT NULL,
  `firstSend` datetime DEFAULT NULL,
  `priority` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `nextSend` datetime DEFAULT NULL,
  `expiryDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `numberOfSends` smallint(6) NOT NULL DEFAULT '0',
  `delivered` tinyint(5) NOT NULL DEFAULT '0',
  `statusCode` int(5) NOT NULL,
  `deliveryTime` datetime DEFAULT NULL,
  `resend` tinyint(4) DEFAULT '0',
  `resendFrequency` smallint(5) UNSIGNED DEFAULT NULL,
  `maxSends` smallint(5) UNSIGNED DEFAULT NULL,
  `dateCreated` datetime NOT NULL,
  `updatedBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `outmessages`
--

CREATE TABLE `outmessages` (
  `messageID` int(11) UNSIGNED NOT NULL,
  `messageContent` text,
  `msgLength` smallint(2) UNSIGNED DEFAULT NULL,
  `msgPages` tinyint(1) UNSIGNED DEFAULT NULL,
  `messageStatusID` int(11) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `createdBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedBy` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outmessages`
--

INSERT INTO `outmessages` (`messageID`, `messageContent`, `msgLength`, `msgPages`, `messageStatusID`, `dateCreated`, `createdBy`, `dateModified`, `updatedBy`) VALUES
(1, 'this is a good test message to send out', 39, 1, 1, '2018-06-28 12:23:56', 1, '2018-06-28 09:23:56', 1),
(2, 'send test message out to the customer', 37, 1, 1, '2018-06-28 14:07:58', 13, '2018-06-28 11:07:58', 13),
(3, 'This is a test message  to -797138040', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(4, 'This is a test message  to -704776060', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(5, 'This is a test message  to -719546774', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(6, 'This is a test message  to -700892072', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(7, 'This is a test message  to -711776617', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(8, 'This is a test message  to -723531278', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(9, 'This is a test message  to -795764105', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(10, 'This is a test message  to -797601375', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(11, 'This is a test message  to -799984951', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(12, 'This is a test message  to -714886256', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(13, 'This is a test message  to -797235188', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(14, 'This is a test message  to -721488863', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(15, 'This is a test message  to -701404744', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(16, 'This is a test message  to -796950799', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(17, 'This is a test message  to -799441940', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(18, 'This is a test message  to -715770310', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(19, 'This is a test message  to -743895803', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(20, 'This is a test message  to -712726813', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(21, 'This is a test message  to -798402333', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(22, 'This is a test message  to -712151415', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(23, 'This is a test message  to -797050810', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(24, 'This is a test message  to -712805894', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(25, 'This is a test message  to -713419856', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(26, 'This is a test message  to -713984227', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(27, 'This is a test message  to -712399884', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(28, 'This is a test message  to -746270254', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(29, 'This is a test message  to -714646984', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(30, 'This is a test message  to -721643242', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(31, 'This is a test message  to -726907774', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(32, 'This is a test message  to -790026349', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(33, 'This is a test message  to -790271008', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(34, 'This is a test message  to -707320506', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(35, 'This is a test message  to -728548123', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(36, 'This is a test message  to -703331113', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(37, 'This is a test message  to -722696353', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(38, 'This is a test message  to -715511207', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(39, 'This is a test message  to -729700973', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(40, 'This is a test message  to -717386741', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(41, 'This is a test message  to -703173261', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(42, 'This is a test message  to -712392426', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(43, 'This is a test message  to -798766615', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(44, 'This is a test message  to -726102135', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(45, 'This is a test message  to -725975525', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(46, 'This is a test message  to -719620807', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(47, 'This is a test message  to -726701416', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(48, 'This is a test message  to -743192338', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(49, 'This is a test message  to -705864454', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(50, 'This is a test message  to -727227259', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(51, 'This is a test message  to -798457845', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(52, 'This is a test message  to -702888137', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(53, 'This is a test message  to -714572772', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(54, 'This is a test message  to -724496352', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(55, 'This is a test message  to -790277759', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(56, 'This is a test message  to -729754834', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(57, 'This is a test message  to -792940331', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(58, 'This is a test message  to -711862982', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(59, 'This is a test message  to -722421781', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(60, 'This is a test message  to -722108674', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(61, 'This is a test message  to -705782986', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(62, 'This is a test message  to -718095806', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(63, 'This is a test message  to -710166607', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(64, 'This is a test message  to -727564928', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(65, 'This is a test message  to -727211878', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(66, 'This is a test message  to -701642791', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(67, 'This is a test message  to -743537251', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(68, 'This is a test message  to -796230656', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(69, 'This is a test message  to -722914135', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(70, 'This is a test message  to -700887373', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(71, 'This is a test message  to -710171865', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(72, 'This is a test message  to -796291623', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(73, 'This is a test message  to -729904267', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(74, 'This is a test message  to -799473691', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(75, 'This is a test message  to -725799970', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(76, 'This is a test message  to -710531508', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(77, 'This is a test message  to -728543462', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(78, 'This is a test message  to -704414737', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(79, 'This is a test message  to -796614777', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(80, 'This is a test message  to -727202063', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(81, 'This is a test message  to -705731474', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(82, 'This is a test message  to -718409907', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(83, 'This is a test message  to -714683781', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(84, 'This is a test message  to -705885382', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(85, 'This is a test message  to -724179037', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(86, 'This is a test message  to -700752466', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(87, 'This is a test message  to -795965340', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(88, 'This is a test message  to -710819073', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(89, 'This is a test message  to -716151493', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(90, 'This is a test message  to -796577091', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(91, 'This is a test message  to -729372725', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(92, 'This is a test message  to -743758121', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(93, 'This is a test message  to -718581105', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(94, 'This is a test message  to -717627653', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(95, 'This is a test message  to -712555398', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(96, 'This is a test message  to -725093796', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(97, 'This is a test message  to -726749378', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(98, 'This is a test message  to -792773925', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(99, 'This is a test message  to -790317124', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(100, 'This is a test message  to -717290413', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(101, 'This is a test message  to -700603318', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(102, 'This is a test message  to -724791040', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(103, 'This is a test message  to -712731629', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(104, 'This is a test message  to -706548940', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(105, 'This is a test message  to -705305178', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(106, 'This is a test message  to -715244690', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(107, 'This is a test message  to -726795170', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(108, 'This is a test message  to -726245747', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(109, 'This is a test message  to -714503501', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(110, 'This is a test message  to -727291324', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(111, 'This is a test message  to -702850742', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(112, 'This is a test message  to -700297356', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(113, 'This is a test message  to -726279017', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(114, 'This is a test message  to -741806327', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(115, 'This is a test message  to -705302326', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(116, 'This is a test message  to -702415934', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(117, 'This is a test message  to -725827397', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(118, 'This is a test message  to -729598337', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(119, 'This is a test message  to -713749057', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(120, 'This is a test message  to -797652700', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(121, 'This is a test message  to -791720306', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(122, 'This is a test message  to -740521505', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(123, 'This is a test message  to -727715512', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(124, 'This is a test message  to -707480986', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(125, 'This is a test message  to -715256491', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(126, 'This is a test message  to -716324188', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(127, 'This is a test message  to -724501013', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(128, 'This is a test message  to -791030374', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(129, 'This is a test message  to -706183666', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(130, 'This is a test message  to -729009625', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(131, 'This is a test message  to -714599371', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(132, 'This is a test message  to -791786926', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(133, 'This is a test message  to -724287520', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(134, 'This is a test message  to -717679078', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(135, 'This is a test message  to -723801719', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(136, 'This is a test message  to -700449443', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(137, 'This is a test message  to -792428313', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(138, 'This is a test message  to -714984671', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(139, 'This is a test message  to -797917248', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(140, 'This is a test message  to -702696018', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(141, 'This is a test message  to -701377771', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(142, 'This is a test message  to -702498822', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(143, 'This is a test message  to -726481942', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(144, 'This is a test message  to -702828773', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(145, 'This is a test message  to -713199297', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(146, 'This is a test message  to -708344780', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(147, 'This is a test message  to -704397210', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(148, 'This is a test message  to -726792562', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(149, 'This is a test message  to -728040987', 37, 1, 1, '2018-06-30 04:00:03', 1, '2018-06-30 01:00:03', 1),
(150, 'This is a test message  to -724423111', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(151, 'This is a test message  to -746104372', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(152, 'This is a test message  to -796539139', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(153, 'This is a test message  to -724994959', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(154, 'This is a test message  to -746224012', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(155, 'This is a test message  to -740254647', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(156, 'This is a test message  to -711118398', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(157, 'This is a test message  to -792786837', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(158, 'This is a test message  to -712408175', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(159, 'This is a test message  to -725325767', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(160, 'This is a test message  to -716464878', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(161, 'This is a test message  to -718398263', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(162, 'This is a test message  to -702650133', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(163, 'This is a test message  to -796335574', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(164, 'This is a test message  to -746048672', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(165, 'This is a test message  to -721722906', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(166, 'This is a test message  to -700674454', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(167, 'This is a test message  to -713448303', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(168, 'This is a test message  to -798766665', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(169, 'This is a test message  to -700061291', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(170, 'This is a test message  to -710459886', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(171, 'This is a test message  to -797130910', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(172, 'This is a test message  to -706127408', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(173, 'This is a test message  to -741582814', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(174, 'This is a test message  to -720608051', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(175, 'This is a test message  to -704460653', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(176, 'This is a test message  to -701415479', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(177, 'This is a test message  to -716499116', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(178, 'This is a test message  to -795221767', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(179, 'This is a test message  to -710616556', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(180, 'This is a test message  to -728505913', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(181, 'This is a test message  to -717277534', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(182, 'This is a test message  to -723773670', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(183, 'This is a test message  to -799866169', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(184, 'This is a test message  to -727024400', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(185, 'This is a test message  to -706893510', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(186, 'This is a test message  to -712015616', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(187, 'This is a test message  to -729417675', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(188, 'This is a test message  to -727570550', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(189, 'This is a test message  to -712779537', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(190, 'This is a test message  to -746210436', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(191, 'This is a test message  to -713084869', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(192, 'This is a test message  to -713394581', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(193, 'This is a test message  to -720570314', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(194, 'This is a test message  to -725686492', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(195, 'This is a test message  to -705914152', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(196, 'This is a test message  to -726655606', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(197, 'This is a test message  to -717555531', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(198, 'This is a test message  to -792016094', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(199, 'This is a test message  to -721372675', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(200, 'This is a test message  to -746562303', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(201, 'This is a test message  to -708262131', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(202, 'This is a test message  to -792378974', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(203, 'This is a test message  to -701203762', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(204, 'This is a test message  to -705879234', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(205, 'This is a test message  to -713966673', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(206, 'This is a test message  to -711157331', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(207, 'This is a test message  to -703672870', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(208, 'This is a test message  to -710404481', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(209, 'This is a test message  to -721819053', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(210, 'This is a test message  to -797391279', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(211, 'This is a test message  to -715305679', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(212, 'This is a test message  to -711800103', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(213, 'This is a test message  to -723329752', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(214, 'This is a test message  to -716000992', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(215, 'This is a test message  to -743421447', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(216, 'This is a test message  to -725293674', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(217, 'This is a test message  to -798729871', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(218, 'This is a test message  to -706375058', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(219, 'This is a test message  to -717302407', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(220, 'This is a test message  to -716427480', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(221, 'This is a test message  to -707559524', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(222, 'This is a test message  to -708011525', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(223, 'This is a test message  to -717433494', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(224, 'This is a test message  to -702827557', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(225, 'This is a test message  to -716352902', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(226, 'This is a test message  to -718454178', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(227, 'This is a test message  to -711280495', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(228, 'This is a test message  to -710901460', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(229, 'This is a test message  to -708513381', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(230, 'This is a test message  to -743426009', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(231, 'This is a test message  to -790777283', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(232, 'This is a test message  to -714448379', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(233, 'This is a test message  to -719225800', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(234, 'This is a test message  to -791272088', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(235, 'This is a test message  to -797453043', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(236, 'This is a test message  to -797580298', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(237, 'This is a test message  to -721328831', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(238, 'This is a test message  to -719174450', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(239, 'This is a test message  to -720989581', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(240, 'This is a test message  to -729573590', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(241, 'This is a test message  to -713539615', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(242, 'This is a test message  to -702148317', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(243, 'This is a test message  to -703210810', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(244, 'This is a test message  to -724668653', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(245, 'This is a test message  to -746940439', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(246, 'This is a test message  to -710342172', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(247, 'This is a test message  to -719207245', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(248, 'This is a test message  to -702090653', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(249, 'This is a test message  to -706592568', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(250, 'This is a test message  to -706146809', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(251, 'This is a test message  to -706643211', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(252, 'This is a test message  to -741881063', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(253, 'This is a test message  to -716012421', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(254, 'This is a test message  to -702807646', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(255, 'This is a test message  to -716409907', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(256, 'This is a test message  to -721942415', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(257, 'This is a test message  to -721249504', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(258, 'This is a test message  to -700378226', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(259, 'This is a test message  to -728371905', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(260, 'This is a test message  to -703616353', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(261, 'This is a test message  to -715644834', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(262, 'This is a test message  to -746741663', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(263, 'This is a test message  to -741970004', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(264, 'This is a test message  to -702539770', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(265, 'This is a test message  to -743349320', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(266, 'This is a test message  to -723724232', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(267, 'This is a test message  to -711435348', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(268, 'This is a test message  to -728431438', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(269, 'This is a test message  to -726388314', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(270, 'This is a test message  to -704920676', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(271, 'This is a test message  to -717598662', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(272, 'This is a test message  to -723923574', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(273, 'This is a test message  to -712261047', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(274, 'This is a test message  to -740590226', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(275, 'This is a test message  to -746270001', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(276, 'This is a test message  to -726782675', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(277, 'This is a test message  to -792357280', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(278, 'This is a test message  to -723598382', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(279, 'This is a test message  to -718310217', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(280, 'This is a test message  to -716851406', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(281, 'This is a test message  to -746900505', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(282, 'This is a test message  to -726391666', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(283, 'This is a test message  to -792128135', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(284, 'This is a test message  to -720666408', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(285, 'This is a test message  to -727382252', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(286, 'This is a test message  to -741562299', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(287, 'This is a test message  to -721510699', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(288, 'This is a test message  to -705370597', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(289, 'This is a test message  to -716577567', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(290, 'This is a test message  to -799076450', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(291, 'This is a test message  to -714468887', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(292, 'This is a test message  to -797396354', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(293, 'This is a test message  to -719664462', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(294, 'This is a test message  to -708427560', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(295, 'This is a test message  to -722930837', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(296, 'This is a test message  to -720720066', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(297, 'This is a test message  to -723633805', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(298, 'This is a test message  to -705860630', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(299, 'This is a test message  to -726003688', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(300, 'This is a test message  to -796233353', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(301, 'This is a test message  to -702643983', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(302, 'This is a test message  to -703918379', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(303, 'This is a test message  to -795142726', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(304, 'This is a test message  to -746585754', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(305, 'This is a test message  to -702349877', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(306, 'This is a test message  to -790498585', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(307, 'This is a test message  to -708650160', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(308, 'This is a test message  to -707435352', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(309, 'This is a test message  to -703831985', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(310, 'This is a test message  to -725907533', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(311, 'This is a test message  to -796416390', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(312, 'This is a test message  to -724615469', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(313, 'This is a test message  to -720385211', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(314, 'This is a test message  to -714084776', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(315, 'This is a test message  to -792354665', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(316, 'This is a test message  to -723522266', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(317, 'This is a test message  to -706905462', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(318, 'This is a test message  to -708122687', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(319, 'This is a test message  to -796950370', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(320, 'This is a test message  to -721154985', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(321, 'This is a test message  to -790552441', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(322, 'This is a test message  to -716511809', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(323, 'This is a test message  to -795593946', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(324, 'This is a test message  to -796139609', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(325, 'This is a test message  to -708808317', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(326, 'This is a test message  to -726358488', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(327, 'This is a test message  to -715407927', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(328, 'This is a test message  to -723344726', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(329, 'This is a test message  to -716677049', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(330, 'This is a test message  to -718581145', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(331, 'This is a test message  to -702374664', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(332, 'This is a test message  to -797138040', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(333, 'This is a test message  to -704776060', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(334, 'This is a test message  to -719546774', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(335, 'This is a test message  to -700892072', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(336, 'This is a test message  to -711776617', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(337, 'This is a test message  to -723531278', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(338, 'This is a test message  to -795764105', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(339, 'This is a test message  to -797601375', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(340, 'This is a test message  to -799984951', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(341, 'This is a test message  to -714886256', 37, 1, 1, '2018-06-30 04:00:04', 1, '2018-06-30 01:00:04', 1),
(342, 'This is a test message  to -797235188', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(343, 'This is a test message  to -721488863', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(344, 'This is a test message  to -701404744', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(345, 'This is a test message  to -796950799', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(346, 'This is a test message  to -799441940', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(347, 'This is a test message  to -715770310', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(348, 'This is a test message  to -743895803', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(349, 'This is a test message  to -712726813', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(350, 'This is a test message  to -798402333', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(351, 'This is a test message  to -712151415', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(352, 'This is a test message  to -797050810', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(353, 'This is a test message  to -712805894', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(354, 'This is a test message  to -713419856', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(355, 'This is a test message  to -713984227', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(356, 'This is a test message  to -712399884', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(357, 'This is a test message  to -746270254', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(358, 'This is a test message  to -714646984', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(359, 'This is a test message  to -721643242', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(360, 'This is a test message  to -726907774', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(361, 'This is a test message  to -790026349', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(362, 'This is a test message  to -790271008', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(363, 'This is a test message  to -707320506', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(364, 'This is a test message  to -728548123', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(365, 'This is a test message  to -703331113', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(366, 'This is a test message  to -722696353', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(367, 'This is a test message  to -715511207', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(368, 'This is a test message  to -729700973', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(369, 'This is a test message  to -717386741', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(370, 'This is a test message  to -703173261', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(371, 'This is a test message  to -712392426', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(372, 'This is a test message  to -798766615', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(373, 'This is a test message  to -726102135', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(374, 'This is a test message  to -725975525', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(375, 'This is a test message  to -719620807', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(376, 'This is a test message  to -726701416', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(377, 'This is a test message  to -743192338', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(378, 'This is a test message  to -705864454', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(379, 'This is a test message  to -727227259', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(380, 'This is a test message  to -798457845', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(381, 'This is a test message  to -702888137', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(382, 'This is a test message  to -714572772', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(383, 'This is a test message  to -724496352', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(384, 'This is a test message  to -790277759', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(385, 'This is a test message  to -729754834', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(386, 'This is a test message  to -792940331', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(387, 'This is a test message  to -711862982', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(388, 'This is a test message  to -722421781', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(389, 'This is a test message  to -722108674', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(390, 'This is a test message  to -705782986', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(391, 'This is a test message  to -718095806', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(392, 'This is a test message  to -710166607', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(393, 'This is a test message  to -727564928', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(394, 'This is a test message  to -727211878', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(395, 'This is a test message  to -701642791', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(396, 'This is a test message  to -743537251', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(397, 'This is a test message  to -796230656', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(398, 'This is a test message  to -722914135', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(399, 'This is a test message  to -700887373', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(400, 'This is a test message  to -710171865', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(401, 'This is a test message  to -796291623', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(402, 'This is a test message  to -729904267', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(403, 'This is a test message  to -799473691', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(404, 'This is a test message  to -725799970', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(405, 'This is a test message  to -710531508', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(406, 'This is a test message  to -728543462', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(407, 'This is a test message  to -704414737', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(408, 'This is a test message  to -796614777', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(409, 'This is a test message  to -727202063', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(410, 'This is a test message  to -705731474', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(411, 'This is a test message  to -718409907', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(412, 'This is a test message  to -714683781', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(413, 'This is a test message  to -705885382', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(414, 'This is a test message  to -724179037', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(415, 'This is a test message  to -700752466', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(416, 'This is a test message  to -795965340', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(417, 'This is a test message  to -710819073', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(418, 'This is a test message  to -716151493', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(419, 'This is a test message  to -796577091', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(420, 'This is a test message  to -729372725', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(421, 'This is a test message  to -743758121', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(422, 'This is a test message  to -718581105', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(423, 'This is a test message  to -717627653', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(424, 'This is a test message  to -712555398', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(425, 'This is a test message  to -725093796', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(426, 'This is a test message  to -726749378', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(427, 'This is a test message  to -792773925', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(428, 'This is a test message  to -790317124', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(429, 'This is a test message  to -717290413', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(430, 'This is a test message  to -700603318', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(431, 'This is a test message  to -724791040', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(432, 'This is a test message  to -712731629', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(433, 'This is a test message  to -706548940', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(434, 'This is a test message  to -705305178', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(435, 'This is a test message  to -715244690', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(436, 'This is a test message  to -726795170', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(437, 'This is a test message  to -726245747', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(438, 'This is a test message  to -714503501', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(439, 'This is a test message  to -727291324', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(440, 'This is a test message  to -702850742', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(441, 'This is a test message  to -700297356', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(442, 'This is a test message  to -726279017', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(443, 'This is a test message  to -741806327', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(444, 'This is a test message  to -705302326', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(445, 'This is a test message  to -702415934', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(446, 'This is a test message  to -725827397', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(447, 'This is a test message  to -729598337', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(448, 'This is a test message  to -713749057', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(449, 'This is a test message  to -797652700', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(450, 'This is a test message  to -791720306', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(451, 'This is a test message  to -740521505', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(452, 'This is a test message  to -727715512', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(453, 'This is a test message  to -707480986', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(454, 'This is a test message  to -715256491', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(455, 'This is a test message  to -716324188', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(456, 'This is a test message  to -724501013', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(457, 'This is a test message  to -791030374', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(458, 'This is a test message  to -706183666', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(459, 'This is a test message  to -729009625', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(460, 'This is a test message  to -714599371', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(461, 'This is a test message  to -791786926', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(462, 'This is a test message  to -724287520', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1);
INSERT INTO `outmessages` (`messageID`, `messageContent`, `msgLength`, `msgPages`, `messageStatusID`, `dateCreated`, `createdBy`, `dateModified`, `updatedBy`) VALUES
(463, 'This is a test message  to -717679078', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(464, 'This is a test message  to -723801719', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(465, 'This is a test message  to -700449443', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(466, 'This is a test message  to -792428313', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(467, 'This is a test message  to -714984671', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(468, 'This is a test message  to -797917248', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(469, 'This is a test message  to -702696018', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(470, 'This is a test message  to -701377771', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(471, 'This is a test message  to -702498822', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(472, 'This is a test message  to -726481942', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(473, 'This is a test message  to -702828773', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(474, 'This is a test message  to -713199297', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(475, 'This is a test message  to -708344780', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(476, 'This is a test message  to -704397210', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(477, 'This is a test message  to -726792562', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(478, 'This is a test message  to -728040987', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(479, 'This is a test message  to -724423111', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(480, 'This is a test message  to -746104372', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(481, 'This is a test message  to -796539139', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(482, 'This is a test message  to -724994959', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(483, 'This is a test message  to -746224012', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(484, 'This is a test message  to -740254647', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(485, 'This is a test message  to -711118398', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(486, 'This is a test message  to -792786837', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(487, 'This is a test message  to -712408175', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(488, 'This is a test message  to -725325767', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(489, 'This is a test message  to -716464878', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(490, 'This is a test message  to -718398263', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(491, 'This is a test message  to -702650133', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(492, 'This is a test message  to -796335574', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(493, 'This is a test message  to -746048672', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(494, 'This is a test message  to -721722906', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(495, 'This is a test message  to -700674454', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(496, 'This is a test message  to -713448303', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(497, 'This is a test message  to -798766665', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(498, 'This is a test message  to -700061291', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(499, 'This is a test message  to -710459886', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(500, 'This is a test message  to -797130910', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(501, 'This is a test message  to -706127408', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(502, 'This is a test message  to -741582814', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(503, 'This is a test message  to -720608051', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(504, 'This is a test message  to -704460653', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(505, 'This is a test message  to -701415479', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(506, 'This is a test message  to -716499116', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(507, 'This is a test message  to -795221767', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(508, 'This is a test message  to -710616556', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(509, 'This is a test message  to -728505913', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(510, 'This is a test message  to -717277534', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(511, 'This is a test message  to -723773670', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(512, 'This is a test message  to -799866169', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(513, 'This is a test message  to -727024400', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(514, 'This is a test message  to -706893510', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(515, 'This is a test message  to -712015616', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(516, 'This is a test message  to -729417675', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(517, 'This is a test message  to -727570550', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(518, 'This is a test message  to -712779537', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(519, 'This is a test message  to -746210436', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(520, 'This is a test message  to -713084869', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(521, 'This is a test message  to -713394581', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(522, 'This is a test message  to -720570314', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(523, 'This is a test message  to -725686492', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(524, 'This is a test message  to -705914152', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(525, 'This is a test message  to -726655606', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(526, 'This is a test message  to -717555531', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(527, 'This is a test message  to -792016094', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(528, 'This is a test message  to -721372675', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(529, 'This is a test message  to -746562303', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(530, 'This is a test message  to -708262131', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(531, 'This is a test message  to -792378974', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(532, 'This is a test message  to -701203762', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(533, 'This is a test message  to -705879234', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(534, 'This is a test message  to -713966673', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(535, 'This is a test message  to -711157331', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(536, 'This is a test message  to -703672870', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(537, 'This is a test message  to -710404481', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(538, 'This is a test message  to -721819053', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(539, 'This is a test message  to -797391279', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(540, 'This is a test message  to -715305679', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(541, 'This is a test message  to -711800103', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(542, 'This is a test message  to -723329752', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(543, 'This is a test message  to -716000992', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(544, 'This is a test message  to -743421447', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(545, 'This is a test message  to -725293674', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(546, 'This is a test message  to -798729871', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(547, 'This is a test message  to -706375058', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(548, 'This is a test message  to -717302407', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(549, 'This is a test message  to -716427480', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(550, 'This is a test message  to -707559524', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(551, 'This is a test message  to -708011525', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(552, 'This is a test message  to -717433494', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(553, 'This is a test message  to -702827557', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(554, 'This is a test message  to -716352902', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(555, 'This is a test message  to -718454178', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(556, 'This is a test message  to -711280495', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(557, 'This is a test message  to -710901460', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(558, 'This is a test message  to -708513381', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(559, 'This is a test message  to -743426009', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(560, 'This is a test message  to -790777283', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(561, 'This is a test message  to -714448379', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(562, 'This is a test message  to -719225800', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(563, 'This is a test message  to -791272088', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(564, 'This is a test message  to -797453043', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(565, 'This is a test message  to -797580298', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(566, 'This is a test message  to -721328831', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(567, 'This is a test message  to -719174450', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(568, 'This is a test message  to -720989581', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(569, 'This is a test message  to -729573590', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(570, 'This is a test message  to -713539615', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(571, 'This is a test message  to -702148317', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(572, 'This is a test message  to -703210810', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(573, 'This is a test message  to -724668653', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(574, 'This is a test message  to -746940439', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(575, 'This is a test message  to -710342172', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(576, 'This is a test message  to -719207245', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(577, 'This is a test message  to -702090653', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(578, 'This is a test message  to -706592568', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(579, 'This is a test message  to -706146809', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(580, 'This is a test message  to -706643211', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(581, 'This is a test message  to -741881063', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(582, 'This is a test message  to -716012421', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(583, 'This is a test message  to -702807646', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(584, 'This is a test message  to -716409907', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(585, 'This is a test message  to -721942415', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(586, 'This is a test message  to -721249504', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(587, 'This is a test message  to -700378226', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(588, 'This is a test message  to -728371905', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(589, 'This is a test message  to -703616353', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(590, 'This is a test message  to -715644834', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(591, 'This is a test message  to -746741663', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(592, 'This is a test message  to -741970004', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(593, 'This is a test message  to -702539770', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(594, 'This is a test message  to -743349320', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(595, 'This is a test message  to -723724232', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(596, 'This is a test message  to -711435348', 37, 1, 1, '2018-06-30 04:00:05', 1, '2018-06-30 01:00:05', 1),
(597, 'This is a test message  to -728431438', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(598, 'This is a test message  to -726388314', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(599, 'This is a test message  to -704920676', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(600, 'This is a test message  to -717598662', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(601, 'This is a test message  to -723923574', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(602, 'This is a test message  to -712261047', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(603, 'This is a test message  to -740590226', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(604, 'This is a test message  to -746270001', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(605, 'This is a test message  to -726782675', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(606, 'This is a test message  to -792357280', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(607, 'This is a test message  to -723598382', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(608, 'This is a test message  to -718310217', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(609, 'This is a test message  to -716851406', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(610, 'This is a test message  to -746900505', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(611, 'This is a test message  to -726391666', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(612, 'This is a test message  to -792128135', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(613, 'This is a test message  to -720666408', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(614, 'This is a test message  to -727382252', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(615, 'This is a test message  to -741562299', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(616, 'This is a test message  to -721510699', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(617, 'This is a test message  to -705370597', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(618, 'This is a test message  to -716577567', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(619, 'This is a test message  to -799076450', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(620, 'This is a test message  to -714468887', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(621, 'This is a test message  to -797396354', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(622, 'This is a test message  to -719664462', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(623, 'This is a test message  to -708427560', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(624, 'This is a test message  to -722930837', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(625, 'This is a test message  to -720720066', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(626, 'This is a test message  to -723633805', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(627, 'This is a test message  to -705860630', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(628, 'This is a test message  to -726003688', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(629, 'This is a test message  to -796233353', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(630, 'This is a test message  to -702643983', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(631, 'This is a test message  to -703918379', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(632, 'This is a test message  to -795142726', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(633, 'This is a test message  to -746585754', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(634, 'This is a test message  to -702349877', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(635, 'This is a test message  to -790498585', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(636, 'This is a test message  to -708650160', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(637, 'This is a test message  to -707435352', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(638, 'This is a test message  to -703831985', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(639, 'This is a test message  to -725907533', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(640, 'This is a test message  to -796416390', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(641, 'This is a test message  to -724615469', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(642, 'This is a test message  to -720385211', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(643, 'This is a test message  to -714084776', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(644, 'This is a test message  to -792354665', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(645, 'This is a test message  to -723522266', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(646, 'This is a test message  to -706905462', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(647, 'This is a test message  to -708122687', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(648, 'This is a test message  to -796950370', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(649, 'This is a test message  to -721154985', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(650, 'This is a test message  to -790552441', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(651, 'This is a test message  to -716511809', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(652, 'This is a test message  to -795593946', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(653, 'This is a test message  to -796139609', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(654, 'This is a test message  to -708808317', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(655, 'This is a test message  to -726358488', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(656, 'This is a test message  to -715407927', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(657, 'This is a test message  to -723344726', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(658, 'This is a test message  to -716677049', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(659, 'This is a test message  to -718581145', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(660, 'This is a test message  to -702374664', 37, 1, 1, '2018-06-30 04:00:06', 1, '2018-06-30 01:00:06', 1),
(661, 'this is a test message', 22, 1, 0, '2018-06-30 04:23:28', 0, '2018-06-30 01:23:28', 0),
(663, 'this is a test message', 22, 1, 0, '2018-06-30 04:29:11', 0, '2018-06-30 01:29:11', 0),
(693, 'this is a test message', 22, 1, 0, '2018-06-30 04:43:46', 0, '2018-06-30 01:43:46', 0),
(696, 'this is a test message', 22, 1, 0, '2018-06-30 04:44:34', 0, '2018-06-30 01:44:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `passwordstatuses`
--

CREATE TABLE `passwordstatuses` (
  `passwordStatusID` int(11) UNSIGNED NOT NULL,
  `passwordStatus` varchar(60) NOT NULL,
  `insertedBy` int(11) UNSIGNED DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `updatedBy` int(11) UNSIGNED DEFAULT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passwordstatuses`
--

INSERT INTO `passwordstatuses` (`passwordStatusID`, `passwordStatus`, `insertedBy`, `dateCreated`, `updatedBy`, `dateModified`) VALUES
(0, 'NEW USER', 1, '2013-07-05 10:11:29', 1, '2013-07-05 07:11:29'),
(1, 'ACTIVE', 1, '2013-07-05 10:11:29', 1, '2013-07-05 07:11:29'),
(2, 'ONE-TIME', 1, '2013-07-05 10:11:29', 1, '2013-07-05 07:11:29'),
(3, 'LOCKED', 1, '2013-07-05 10:11:29', 1, '2013-07-05 07:11:29'),
(4, 'EXPIRED', 1, '2013-07-05 10:11:29', 1, '2013-07-05 07:11:29'),
(5, 'DORMANT', 1, '2013-07-05 10:11:29', 1, '2013-07-05 07:11:29'),
(6, 'DELETED USER', 1, '2013-07-05 10:11:29', 1, '2013-07-05 07:11:29'),
(7, 'RESET', 1, '2013-07-05 10:11:29', 1, '2013-07-05 07:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `protocols`
--

CREATE TABLE `protocols` (
  `protocolID` int(11) UNSIGNED NOT NULL,
  `protocol` varchar(45) NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '2',
  `insertedBy` int(11) NOT NULL DEFAULT '0',
  `dateCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedBy` int(11) NOT NULL DEFAULT '0',
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table stores information on the various types of requests ch';

--
-- Dumping data for table `protocols`
--

INSERT INTO `protocols` (`protocolID`, `protocol`, `active`, `insertedBy`, `dateCreated`, `updatedBy`, `dateModified`) VALUES
(1, 'GET', 1, 1, '2013-03-28 09:09:43', 1, '2013-04-05 05:42:49'),
(2, 'POST', 1, 1, '2013-03-28 09:09:48', 1, '2013-04-05 05:43:07'),
(3, 'JSON', 1, 1, '2013-03-28 09:09:55', 1, '2018-05-07 12:21:38'),
(4, 'SOAP', 1, 1, '2013-03-28 09:10:01', 1, '2013-03-28 03:10:01'),
(7, 'Internal USSD', 1, 1, '2013-05-16 18:36:07', 1, '2018-05-07 12:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `reportID` int(11) UNSIGNED NOT NULL,
  `reportName` varchar(255) NOT NULL,
  `reportTypeID` int(11) UNSIGNED NOT NULL,
  `reportOutputColumns` text NOT NULL,
  `reportQuery` text,
  `active` tinyint(3) UNSIGNED NOT NULL,
  `insertedBy` int(11) UNSIGNED DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `updatedBy` int(11) UNSIGNED DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateActivated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`reportID`, `reportName`, `reportTypeID`, `reportOutputColumns`, `reportQuery`, `active`, `insertedBy`, `dateCreated`, `updatedBy`, `dateModified`, `dateActivated`) VALUES
(2, 'CREDIT STATUS REPORT', 1, 'id,clientName,allocated,consumed', 'select  @rownum:=@rownum+1 as id,clientName,ifnull(cAllocated.cAllocated,0)allocated ,ifnull(cConsumed.cConsumed,0) as consumed ,  ifnull((ifnull(cAllocated.cAllocated,0)  - ifnull(cConsumed.cConsumed,0) ),0) creditsAvailable from clients c left join  (select clientID , ifnull(sum(creditsAllocated),0) as cAllocated from creditAllocation ca  where ca.creditStatusID =1 group by clientID  ) as cAllocated on c.clientID = cAllocated.clientID left join (select clientID, ifnull(sum(cc.creditsConsumed),0) as cConsumed from creditConsumption cc where cc.creditStatusID =1 group by cc.clientid ) as cConsumed on cConsumed.clientID = c.clientID, (select @rownum := 0)  tmp group by c.clientID ', 1, NULL, NULL, NULL, '2018-05-22 08:40:12', NULL),
(4, 'CREDIT ALLOCATION REPORT', 1, 'id,clientName,creditsAllocated,creditStatus,dateAllocated', 'select @rownum:=@rownum+1 as id, clientName,creditsAllocated, if(creditstatusid =1,\'ACTIVE\',\'Deleted\') as creditStatus ,dateAllocated from creditAllocation ca join clients c using (clientID ) , (select @rownum := 0)  tmp   where   date(dateAllocated) BETWEEN \'^DATEFROM^\' and \'^DATETO^\'  and clientID IN (\'^CLIENTID^\')   group by c.clientID', 1, NULL, NULL, NULL, '2018-05-22 08:54:03', NULL),
(5, 'CREDIT CONSUMPTION REPORT', 1, 'id,clientName,creditsConsumed, dateConsumed ', 'select @rownum:=@rownum+1 as id, clientName,creditsConsumed, dateConsumed from creditConsumption cc join clients c using (clientID ) , (select @rownum := 0) tmp where date(dateConsumed) BETWEEN \'^DATEFROM^\' and \'^DATETO^\' and creditstatusid =1 and  clientID IN (\'^CLIENTID^\') group by c.clientID', 0, NULL, NULL, NULL, '2018-05-22 09:18:30', NULL),
(6, 'Bulk Messages by Date', 1, 'id,clientName,sentTime,completionTime,status,source,creditsAssigned,creditsUsed,totalSent,successfull,pending,failed,messageContent', 'select @rownum:=@rownum+1 as id, clientName, sentTime,completionTime,broadcastStatusName as status,source,creditsAssigned,creditsUsed,ifnull(count(distinct outboundid),0)totalSent, ifnull(count(distinct(if(statuscode =0,outboundid,null))),0) pending,  ifnull(count(distinct(if(statuscode =1,outboundid,null))),0) successfull,ifnull(count(distinct(if(statuscode not in (1,0),outboundid,null))),0) failed,messageContent from clients c join broadCasts b on c.clientid = b.clientid join broadcastStatus bs on b.broadcastStatusID = bs.broadcastStatusID join outMessages o on b.messageid = o.messageID join transactions t on b.transactionid = t.transactionid left join outbound ot on (b.messageid = ot.messageid and b.transactionid = ot.transactionID) , (select @rownum := 0) tmp  where date(sentTime) BETWEEN \'^DATEFROM^\' and \'^DATETO^\'   group by broadcastid order by broadcastID desc ', 1, NULL, NULL, NULL, '2018-05-22 09:26:46', NULL),
(8, 'Client CREDIT STATUS REPORT', 2, 'id,clientName,allocated,consumed', 'select  @rownum:=@rownum+1 as id,clientName,ifnull(cAllocated.cAllocated,0)allocated ,ifnull(cConsumed.cConsumed,0) as consumed ,  ifnull((ifnull(cAllocated.cAllocated,0)  - ifnull(cConsumed.cConsumed,0) ),0) creditsAvailable from clients c left join  (select clientID , ifnull(sum(creditsAllocated),0) as cAllocated from creditAllocation ca  where ca.creditStatusID =1 group by clientID  ) as cAllocated on c.clientID = cAllocated.clientID left join (select clientID, ifnull(sum(cc.creditsConsumed),0) as cConsumed from creditConsumption cc where cc.creditStatusID =1 group by cc.clientid ) as cConsumed on cConsumed.clientID = c.clientID, (select @rownum := 0)  tmp where c.clientID =\'^CLIENTID^\' group by c.clientID ', 1, NULL, NULL, NULL, '2018-06-28 11:31:36', NULL),
(9, 'CLIENT CREDIT ALLOCATION REPORT', 2, 'id,clientName,creditsAllocated,creditStatus,dateAllocated', 'select @rownum:=@rownum+1 as id, clientName,creditsAllocated, if(creditstatusid =1,\'ACTIVE\',\'Deleted\') as creditStatus ,dateAllocated from creditAllocation ca join clients c using (clientID ) , (select @rownum := 0)  tmp   where   date(dateAllocated) BETWEEN \'^DATEFROM^\' and \'^DATETO^\'  and clientID IN (\'^CLIENTID^\')   group by c.clientID', 1, NULL, NULL, NULL, '2018-05-22 08:54:03', NULL),
(10, 'CLIENT CREDIT CONSUMPTION REPORT', 2, 'id,clientName,creditsConsumed, dateConsumed ', 'select @rownum:=@rownum+1 as id, clientName,creditsConsumed, dateConsumed from creditConsumption cc join clients c using (clientID ) , (select @rownum := 0) tmp where date(dateConsumed) BETWEEN \'^DATEFROM^\' and \'^DATETO^\' and creditstatusid =1 and  clientID IN (\'^CLIENTID^\') group by c.clientID', 0, NULL, NULL, NULL, '2018-05-22 09:18:30', NULL),
(11, 'cLIENT Bulk Messages by Date', 2, 'id,clientName,sentTime,completionTime,status,source,creditsAssigned,creditsUsed,totalSent,successfull,pending,failed,messageContent', 'select @rownum:=@rownum+1 as id, clientName, sentTime,completionTime,broadcastStatusName as status,source,creditsAssigned,creditsUsed,ifnull(count(distinct outboundid),0)totalSent, ifnull(count(distinct(if(statuscode =0,outboundid,null))),0) pending,  ifnull(count(distinct(if(statuscode =1,outboundid,null))),0) successfull,ifnull(count(distinct(if(statuscode not in (1,0),outboundid,null))),0) failed,messageContent from clients c join broadCasts b on c.clientid = b.clientid join broadcastStatus bs on b.broadcastStatusID = bs.broadcastStatusID join outMessages o on b.messageid = o.messageID join transactions t on b.transactionid = t.transactionid left join outbound ot on (b.messageid = ot.messageid and b.transactionid = ot.transactionID) , (select @rownum := 0) tmp  where date(sentTime) BETWEEN \'^DATEFROM^\' and \'^DATETO^\' and c.clientID =\'^CLIENTID^\'  group by broadcastid order by broadcastID desc ', 1, NULL, NULL, NULL, '2018-06-28 11:30:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reporttypes`
--

CREATE TABLE `reporttypes` (
  `reportTypeID` int(11) UNSIGNED NOT NULL,
  `reportTypeName` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(3) NOT NULL DEFAULT '2',
  `dateCreated` datetime NOT NULL,
  `insertedBy` int(11) NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reporttypes`
--

INSERT INTO `reporttypes` (`reportTypeID`, `reportTypeName`, `description`, `active`, `dateCreated`, `insertedBy`, `dateModified`, `updatedBy`) VALUES
(1, 'Admin', 'Admin Reports', 1, '2013-06-06 14:07:02', 1, '2018-05-22 08:21:23', 1),
(2, 'Channels - SMS', 'Channels SMS reports', 1, '2013-06-26 14:24:23', 1, '2013-07-01 07:53:25', 1),
(3, 'Channels - USSD', 'Channels USSD reports', 1, '2013-06-27 09:34:37', 1, '2013-07-01 07:54:09', 1),
(4, 'Channels - Transactions', 'Channels Transactions reports', 1, '2013-07-01 09:53:33', 1, '2013-07-01 07:55:29', 1),
(5, 'Payments', 'For all payments related reports', 3, '2013-06-07 12:47:34', 1, '2013-07-16 13:42:59', 1),
(6, 'Payments - Airtime', 'Payments Airtime reports', 3, '2013-07-01 10:57:46', 1, '2013-07-16 13:43:06', 1),
(7, 'Payments - C2B', 'Payments C2B reports', 3, '2013-07-01 10:58:21', 1, '2013-07-16 13:43:14', 1),
(8, 'Payments - Mpesa', 'Payments Mpesa reports', 3, '2013-07-01 10:58:50', 1, '2013-07-16 13:43:23', 1),
(9, 'Payments - Utility ', 'Payments Utility reports', 3, '2013-07-01 11:04:19', 1, '2013-07-16 13:43:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rpaymentsettings`
--

CREATE TABLE `rpaymentsettings` (
  `rSettingID` int(10) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `campaignID` int(10) UNSIGNED NOT NULL,
  `settingName` varchar(60) DEFAULT NULL,
  `settingType` tinyint(4) NOT NULL DEFAULT '1',
  `shortCode` varchar(50) NOT NULL,
  `serviceUrl` varchar(200) NOT NULL,
  `serviceKey` varchar(200) DEFAULT NULL,
  `serviceSecret` varchar(200) DEFAULT NULL,
  `servicePassKey` varchar(200) DEFAULT NULL,
  `updatedBy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `active` tinyint(3) NOT NULL DEFAULT '2',
  `activityHistory` text,
  `dateCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertedBy` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rpaymentsettings`
--

INSERT INTO `rpaymentsettings` (`rSettingID`, `clientID`, `campaignID`, `settingName`, `settingType`, `shortCode`, `serviceUrl`, `serviceKey`, `serviceSecret`, `servicePassKey`, `updatedBy`, `active`, `activityHistory`, `dateCreated`, `dateModified`, `insertedBy`) VALUES
(1, 0, 1, NULL, 1, '', 'https://api.brandrive.co.ke/raffles/v1/sdfa342/Test', NULL, NULL, NULL, 0, 2, NULL, '2019-03-09 13:28:35', '2019-03-09 10:28:35', 0),
(2, 1, 1, 'Test', 1, '', 'https://api.brandrive.co.ke/raffles/v1/sdfa342/Test', NULL, NULL, NULL, 1, 2, NULL, '2019-03-09 13:34:23', '2019-03-09 10:34:23', 1),
(3, 1, 1, 'Test', 1, '23423', '', '23432', '3243', '34243', 1, 2, NULL, '2019-03-09 15:20:23', '2019-03-09 12:20:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sourceaddresses`
--

CREATE TABLE `sourceaddresses` (
  `sourceAddressID` int(11) UNSIGNED NOT NULL,
  `sourceAddress` varchar(50) DEFAULT NULL,
  `accessCode` int(11) NOT NULL,
  `dedicated` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `insertedBy` int(11) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL,
  `updatedBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sourceaddresses`
--

INSERT INTO `sourceaddresses` (`sourceAddressID`, `sourceAddress`, `accessCode`, `dedicated`, `active`, `insertedBy`, `dateCreated`, `updatedBy`, `dateModified`) VALUES
(151, 'GETBUCKS', 2342423, 1, 1, 1, '2014-09-24 05:54:40', 1, '2018-06-27 09:03:44'),
(152, '2030', 0, 1, 1, 1, '2014-09-24 05:56:17', 1, '2014-09-24 03:56:17'),
(153, 'REAL', 0, 1, 1, 1, '2014-12-05 11:16:33', 1, '2015-09-17 12:28:38'),
(154, '51992', 0, 1, 1, 1, '2014-12-18 07:21:59', 1, '2014-12-18 05:21:59'),
(155, 'INTELLIGENT', 0, 1, 1, 1, '2017-03-28 11:52:36', 1, '2017-03-28 09:52:36'),
(156, '12w22', 0, 1, 1, 1, '2018-05-16 12:36:08', 1, '2018-05-16 09:36:08');

-- --------------------------------------------------------

--
-- Table structure for table `sourceaddressmapping`
--

CREATE TABLE `sourceaddressmapping` (
  `mappingID` int(11) UNSIGNED NOT NULL,
  `settingName` varchar(60) DEFAULT NULL,
  `sourceAddressID` int(11) UNSIGNED NOT NULL,
  `clientID` int(11) UNSIGNED NOT NULL,
  `keyword` varchar(100) DEFAULT '',
  `active` tinyint(3) DEFAULT NULL,
  `activityHistory` text,
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertedBy` int(11) UNSIGNED DEFAULT NULL,
  `updatedBy` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `statuscodes`
--

CREATE TABLE `statuscodes` (
  `statusCodeID` int(11) NOT NULL,
  `statTypeID` int(11) NOT NULL,
  `statusCode` varchar(45) DEFAULT NULL,
  `statusCodeDesc` varchar(100) DEFAULT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '2',
  `dateCreated` datetime DEFAULT NULL,
  `insertedBy` int(11) DEFAULT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table stores hub specific codes that denote particular state';

--
-- Dumping data for table `statuscodes`
--

INSERT INTO `statuscodes` (`statusCodeID`, `statTypeID`, `statusCode`, `statusCodeDesc`, `active`, `dateCreated`, `insertedBy`, `dateModified`, `modifiedBy`) VALUES
(1, 1, '0', 'unprocessed requests or responses', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(2, 1, '1', 'Delivered request/response', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(3, 1, '2', 'inprocess - request/response still being proc', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(4, 1, '3', 'Failed', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(5, 1, '4', 'Exhausted - Expiry date reached', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(6, 1, '5', 'Exhausted - Escalated', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(7, 1, '6', 'Cannot identify route for request (http 404)', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(8, 1, '7', 'system/host error, to be retried (http: 500,4', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(9, 1, '8', 'invalid credentials', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(10, 1, '9', 'invalid Request - parameter validation failed', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(11, 1, '10', 'duplicate requests', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(12, 1, '11', 'timeout, result unknown', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(13, 1, '12', 'account is disabled', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(14, 1, '32', 'Forwarded to operator', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(15, 1, '25', 'Failed to be delivered to end user (EMG 25)', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(16, 1, '40', 'NO SDP linkID', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(17, 1, '41', 'SMS message is greater than <6> SMS (6*153)', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 0),
(18, 1, 'aaaa', 'test 1234', 1, '2018-04-30 22:18:42', 1, '2018-04-30 19:18:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transactionID` int(11) UNSIGNED NOT NULL,
  `source` varchar(15) NOT NULL DEFAULT '0',
  `destination` varchar(20) NOT NULL DEFAULT '0',
  `dateCreated` datetime NOT NULL,
  `serviceID` int(4) UNSIGNED NOT NULL DEFAULT '0',
  `transactionTypeID` int(11) UNSIGNED NOT NULL,
  `inboundSMSID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `cost` int(11) NOT NULL DEFAULT '0',
  `statusCodeID` int(10) UNSIGNED NOT NULL,
  `insertedBy` int(10) UNSIGNED NOT NULL,
  `extraData` text,
  `updatedBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transactionID`, `source`, `destination`, `dateCreated`, `serviceID`, `transactionTypeID`, `inboundSMSID`, `cost`, `statusCodeID`, `insertedBy`, `extraData`, `updatedBy`, `dateModified`) VALUES
(3, 'GETBUCKS', '0', '2018-06-28 10:56:58', 3, 2, 0, 0, 0, 1, NULL, 1, '2018-06-28 07:56:58'),
(4, 'GETBUCKS', '0', '2018-06-28 10:57:20', 3, 2, 0, 0, 0, 1, NULL, 1, '2018-06-28 07:57:20'),
(7, 'GETBUCKS', '0', '2018-06-28 11:05:03', 3, 2, 0, 0, 0, 1, NULL, 1, '2018-06-28 08:05:03'),
(8, 'GETBUCKS', '0', '2018-06-28 11:53:39', 3, 2, 0, 0, 0, 1, NULL, 1, '2018-06-28 08:53:39'),
(9, 'GETBUCKS', '0', '2018-06-28 12:23:56', 3, 2, 0, 0, 0, 1, NULL, 1, '2018-06-28 09:23:56'),
(10, 'GETBUCKS', '0', '2018-06-28 12:27:33', 3, 2, 0, 0, 0, 1, NULL, 1, '2018-06-28 09:27:33'),
(11, 'INTELLIGENT', '0', '2018-06-28 14:00:17', 4, 2, 0, 0, 0, 13, NULL, 13, '2018-06-28 11:00:17'),
(12, 'INTELLIGENT', '0', '2018-06-28 14:07:58', 4, 2, 0, 0, 0, 13, NULL, 13, '2018-06-28 11:07:58'),
(13, 'GETBUCKS', '254726742902', '2018-06-30 04:23:28', 3, 1, 0, 0, 0, 1, NULL, 0, '2018-06-30 01:23:28'),
(15, 'GETBUCKS', '254726742902', '2018-06-30 04:29:11', 3, 1, 0, 0, 0, 1, NULL, 0, '2018-06-30 01:29:11'),
(45, 'GETBUCKS', '254726742902', '2018-06-30 04:43:46', 3, 1, 0, 0, 0, 1, NULL, 0, '2018-06-30 01:43:46'),
(48, 'GETBUCKS', '254726742902', '2018-06-30 04:44:34', 3, 1, 0, 0, 0, 1, NULL, 0, '2018-06-30 01:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `transactionstatus`
--

CREATE TABLE `transactionstatus` (
  `transactionStatusID` int(11) NOT NULL,
  `statusCode` smallint(3) NOT NULL,
  `statusName` varchar(50) NOT NULL,
  `shortDescription` varchar(255) DEFAULT NULL,
  `statusDescription` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL,
  `activityHistory` text NOT NULL,
  `insertedBy` int(10) DEFAULT NULL,
  `updatedBy` int(10) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactionstatus`
--

INSERT INTO `transactionstatus` (`transactionStatusID`, `statusCode`, `statusName`, `shortDescription`, `statusDescription`, `active`, `activityHistory`, `insertedBy`, `updatedBy`, `dateCreated`, `dateModified`) VALUES
(1, 103, 'STATUS_UNKNOWN', NULL, 'Status for this transaction is not known.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(2, 104, 'GENERAL_EXCEPTION_OCCURRED', NULL, 'A generic exception occurred during processing', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(3, 105, 'INACTIVE_CLIENT', NULL, 'This client is inactive. Please contact Cellulant\'s support to resolve this.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(4, 106, 'INACTIVE_SERVICE', NULL, 'This service is inactive for this client. Please contact Cellulant\'s support to resolve this.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(5, 107, 'INACTIVE_VOUCHER_OWNER', NULL, 'The voucher owner is inactive. Please contact Cellulant\'s support to resolve this.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(6, 108, 'VOUCHER_OWNER_DOESNT_EXIST', NULL, 'The client has not been configured as a voucher owner. Please contact Cellulant\'s support to resolve this.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(7, 109, 'CUSTOMER_MSISDN_MISSING', NULL, 'the customer\'s phone number (MSISDN) is missing', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(8, 110, 'INVALID_CUSTOMER_MSISDN', NULL, 'The customer phone number (MSISDN) provided is invalid', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(9, 111, 'INVALID_INVOICE_AMOUNT_SPECIFIED', NULL, 'The invoice amount provided is invalid for this service.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(10, 112, 'INVOICE_AMOUNT_NOT_SPECIFIED', NULL, 'The invoice amount is mandatory and is not provided.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(11, 113, 'INVALID_SYNC_VALUE', NULL, 'The sync value provided is not valid. Use 1 or 0', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(12, 114, 'SYNC_VALUE_NOT_SPECIFIED', NULL, 'The sync value is not specified.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(13, 115, 'INVALID_CURRENCY_CODE', NULL, 'Invalid currency code provided for the service. Use the ISO currency code or contact Cellulant\'s support for assistance.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(14, 117, 'INVALID_EXPIRY_DATE', NULL, 'The expiry date provided is invalid.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(15, 118, 'INVOICE_EXPIRY_DATE_NOT_SPECIFIED', NULL, 'The expiry date for the invoice has not been specified and is required.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(16, 119, 'INVOICE_NARRATION_NOT_SPECIFIED', NULL, 'The invoice narration/text has not been specified and is required.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(17, 120, 'INVOICE_ACCOUNTNUMBER_NOT_SPECIFIED', NULL, 'The account number has not been provided and is required.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(18, 121, 'INVOICE_ACCOUNTNAME_NOT_SPECIFIED', NULL, 'The account name for the invoice raised has not been provided and is required.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(19, 122, 'INVALID_DUEDATE_SPECIFIED', NULL, 'The due date provided is invalid.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(20, 123, 'INVOICE_DUEDATE_NOT_SPECIFIED', NULL, 'The due date for the invoice has not been provided.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(21, 128, 'INACTIVE_RESPONSE_TEMPLATE', NULL, 'The template configured for customer notification is currently not active. Please contact Cellulant support to rectify.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(22, 129, 'INVOICE_DUEDATE_NOT_SPECIFIED', NULL, 'No template has been configured for customer notification as required. Please contact Cellulant support to rectify.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(23, 130, 'NEW_INVOICE', NULL, 'Invoice has successfully been uploaded and waiting presentment.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(24, 131, 'CLIENT_AUTHENTICATED_SUCCESSFULLY', NULL, 'Authentication was a success', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(25, 132, 'CLIENT_AUTHENTICATION_FAILED', NULL, 'Invalid Credentials. Authentication Failed', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(26, 135, 'INVOICE_NUMBER_NOT_SPECIFIED', NULL, 'Invoice number not provided', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(27, 136, 'PAYMENT_ID_NOT_SPECIFIED', NULL, 'The payment ID for this payment transaction has not been provided and is required.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(28, 137, 'ACK_STATUSCODE_NOT_SPECIFIED', NULL, 'Status Code for acknowledgement not provided. Use (140:Accept), (141:Reject),\n(219:Escalate).', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(29, 139, 'PAYMENT_POSTED_SUCCESSFULLY', NULL, 'Payment pending acknowledgement', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-10-25 09:42:03'),
(30, 140, 'PAYMENT_ACCEPTED', NULL, 'The payment has been marked as accepted by the receiver client after acknowledgement.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(31, 141, 'PAYMENT_REJECTED', NULL, 'The payment has been marked as Rejected by the receiver client after acknowledgement.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(32, 143, 'PAYMENT_ID_DOESNT_EXIST', NULL, 'The payer transaction ID provided does not exist in the system/ cannot be found', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(33, 145, 'BEEP_TRANSACTIONID_NOT_SPECIFIED', NULL, 'A Beep transaction ID has not been provided and is required.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(34, 146, 'INVOICE_DOESNT_EXIST', NULL, 'The invoice with the provided invoice number does not exist in our system.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(35, 152, 'RECEIVER_ACKNOWLEDGMENT_OK', NULL, 'The acknowledgement was successful.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(36, 159, 'DUPLICATE_INVOICE', NULL, 'An invoice with the same invoice number exists; Duplicate invoice found.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(37, 163, 'CLIENT_USERNAME_NOT_PROVIDED', NULL, 'The user name to be used in authentication has not been provided.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(38, 164, 'CLIENT_PASSWORD_NOT_PROVIDED', NULL, 'The password to be used in authentication has not been provided.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(39, 166, 'SERVICE_ID_NOT_SPECIFIED', NULL, 'Service ID for service to be used has not been provided and is required.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(40, 167, 'SERVICE_ID_PROVIDED_INVALID', NULL, 'The service ID provided is invalid. please contact Cellulant\'s support for confirmation.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(41, 173, 'GENERIC_SUCCESS_STATUS_CODE', NULL, 'Transaction processed successfully', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(42, 174, 'GENERIC_FAILURE_STATUS_CODE', NULL, 'A failure occurred while processing the request', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(43, 175, 'MSISDN_HAS_NO_INVOICES', NULL, 'Mobile number has no pending invoices', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(44, 178, 'PENDING_CLIENT_ACK', NULL, 'The transaction is pending acknowledgement from the client', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(45, 179, 'PENDING_REVERSAL', NULL, 'Transaction pending reversal', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(46, 180, 'PAYMENT_ACKNOWLEDGED_REJECTED', NULL, 'The payment was acknowledged by the receiver as rejected', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(47, 181, 'TRANSACTION_TIMED_OUT_STATUS', NULL, 'The transaction has timed out', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(48, 183, 'TRANSACTION_CLIENT_ACK_OK', NULL, 'Transaction acknowledged successfully', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(49, 186, 'CLIENT_HAS_NO_PENDING_BILLS', NULL, 'Client has no pending payments for processing', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(50, 187, 'CLIENT_HAS_PENDING_BILLS', NULL, 'Client has pending payments for processing', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(51, 195, 'CANCELLED_INVOICE', NULL, 'The invoice has been canceled successfully.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(52, 197, 'VOUCHER_UPLOAD_SUCCESSFUL', NULL, 'The voucher upload was successful', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(53, 198, 'VOUCHER_UPLOAD_FAILED', NULL, 'Voucher upload failed', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(54, 199, 'INVALID_UPLOAD_FILESIZE', NULL, 'The upload file size is invalid', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(55, 200, 'PAYMENT_SUCCESSFUL', NULL, 'PAYMENT_SUCCESSFUL', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2018-04-30 10:36:46'),
(56, 201, 'CATEGORY_NAME_NOT_SPECIFIED', NULL, 'The event Name (category name) has not bee specified and is required', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(57, 202, 'CHECKSUM_NOT_SPECIFIED', NULL, 'The check sum value has not been specified and is required.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(58, 203, 'DENOMINATION_NAME_NOT_SPECIFIED', NULL, 'The denomination name has not been specified and is required', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(59, 204, 'DENOMINATION_VALUE_NOT_SPECIFIED', NULL, 'The denomination value has not been specified and is required.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(60, 205, 'VOUCHER_SIZE_NOT_SPECIFIED', NULL, 'Voucher size (count) has not been specified and is required.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(61, 206, 'CATEGORY_SPECIFIED_IS_INVALID', NULL, 'The Category ID specified is invalid', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(62, 207, 'VOUCHER_ID_MISSING', NULL, 'Voucher ID missing', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(63, 208, 'VOUCHER_FETCHED_SUCCESSFULLY', NULL, 'Fetched voucher successfully', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(64, 210, 'CATEGORY_ID_OR_AMOUNT_INVALID', NULL, 'The Category ID or amount specified is invalid', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(65, 211, 'VOUCHER_NOT_OBTAINED', NULL, 'Voucher not obtained', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(66, 212, 'VOUCHER_NOT_MARKED_AS_USED', NULL, 'The voucher specified is already marked as used', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(67, 213, 'VOUCHER_MARKED_AS_USED', NULL, 'Voucher marked as used', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(68, 214, 'VOUCHER_PENDING_PAYMENT', NULL, 'Voucher purchase pending payment', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(69, 216, 'PAYMENT_MANUALLY_FAILED', NULL, 'Payment manually rejected', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(70, 217, 'PAYMENT_MANUALLY_ACCEPTED', NULL, 'Payment manually accepted', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(71, 219, 'TRANSACTION_ESCALATED_STATUS', NULL, 'The transaction has been escalated', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(72, 221, 'INVOICE_FOLLOWED', NULL, 'Successfully updated transaction as authorized', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(73, 224, 'TRANSACTION_REVERSED', NULL, 'Payment fully reversed', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(74, 226, 'MSISDN_HAS_INVOICES', NULL, 'Mobile number has pending invoices', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(75, 227, 'ACC_HAS_INVOICES', NULL, 'Account number has pending invoices', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(76, 228, 'ACC_HAS_NO_INVOICES', NULL, 'Account number has no pending invoices', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(77, 229, 'DUPLICATE_PAYMENT', NULL, 'A payment with the same payer Transaction ID was found; Duplicate payment', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(78, 231, 'AMOUNT_OVER_LIMIT_FOR_PAYMENT', NULL, 'The amount specified is above the maximum limit set for this service', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(79, 232, 'AMOUNT_UNDER_LIMIT_FOR_PAYMENT', NULL, 'The amount specified is below the minimum limit set for this service', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(80, 233, 'INVOICE_UPLOAD_NOT_ALLOWED', NULL, 'This service does not allow upload of invoices', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(81, 234, 'PARAMETERS_MISSING', NULL, 'Some required parameters are missing', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(82, 235, 'PAYMENT_NOT_FOUND', NULL, 'No payment was found for this voucher', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(83, 236, 'REVERSAL_NOT_POSSIBLE', NULL, 'Reversal is not possible for this payment.', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(84, 237, 'CANCELATION_NOT_VALID', NULL, 'Cancellation not valid; cannot cancel the transaction in this state', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(85, 239, 'TRANSACTION_ALREADY_ESCALATED', NULL, 'The transaction was already escalated, it can be manually accepted or rejected only', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(86, 240, 'TRANSACTION_ALREADY_ACKNOWLEDGED_ACCEPTED', NULL, 'Transaction already acknowledged as ACCEPTED', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(87, 241, 'TRANSACTION_ALREADY_ACKNOWLEDGED_REJECTED', NULL, 'Transaction already acknowledged as REJECTED', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2013-07-12 15:54:04', '2013-07-12 12:54:04'),
(88, 404, 'HELD_PAYMENTS_STATUS_CODE', NULL, 'Payment Held', 1, '1|1|02-06-\n2014 17:00:00', 1, 1, '2014-04-07 13:09:58', '2014-04-07 11:50:07'),
(89, 310, 'PAYMENT_RECEIVED_SUCCESFULLY', 'Payment Received Succesfully', 'Payment Received Succesfully', 1, '1|1|2014-06-27 11:03:37,', 1, 1, '2014-06-28 08:30:17', '2014-06-28 05:30:17'),
(90, 188, 'PAYMENT_ACCEPTED_CRAFT', 'Payment Accepted Craft', 'The payment has been marked as accepted by the receiver client', 1, '1|1|02-06-2013 17:00:00', 1, 1, '2014-07-09 15:02:34', '2014-07-09 12:02:34'),
(91, 250, 'INVOICE_PAYMENT_PROCESS_IN_PROGRESS', 'The payment for the invoice is in progress', 'The payment for the invoice is in progress', 1, '1', 1, 1, '2014-10-22 00:00:00', '2014-10-22 11:11:37'),
(92, 251, 'INVOICE_PAYMENT_FAILED', 'Payment for the invoice failed', 'Payment for the invoice failed', 1, '1', 1, 1, '2014-10-22 00:00:00', '2014-10-22 11:11:37'),
(93, 252, 'INVOICE_PARTIALLY_PAID', 'The invoice has been partially paid', 'The invoice has been partially paid', 1, '1', 1, 1, '2014-10-22 00:00:00', '2014-10-22 11:15:16'),
(94, 253, 'INVOICE_FULLY_PAID', 'The invoice has been fully paid', 'The invoice has been fully paid', 1, '1', 1, 1, '2014-10-22 00:00:00', '2014-10-29 06:19:22'),
(95, 254, 'INVOICE_PAYMENTS_FAILED_UPDATE', 'The invoice not updated with payment provided', 'The invoice not updated with payment provided', 1, '1', 1, 1, '2014-10-22 00:00:00', '2014-10-29 06:19:22'),
(96, 255, 'INVOICE_PAYMENTS_UPDATED', 'The invoice has been updated with payment provided', 'The invoice has been updated with payment provided', 1, '1', 1, 1, '2014-10-22 00:00:00', '2014-10-29 06:19:22'),
(97, 256, 'INVOICE_MANUALLY_MARKED_AS_PAID', 'Invoice has been manually marked as paid.', 'Invoice has been manually marked as paid.', 1, '1', 1, 1, '2014-10-29 00:00:00', '2014-10-29 06:20:26'),
(98, 401, 'PAYMENT_MARKED_FOR_REPROCESSING', 'Marked for reprocessing', 'Marked for reprocessing', 1, '1', 1, 1, '2015-05-04 12:53:20', '2015-05-04 09:53:20'),
(99, 189, 'TRANSACTION_RETRY_STATUS', NULL, NULL, 0, '', NULL, NULL, NULL, '2018-04-28 22:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `transactiontypes`
--

CREATE TABLE `transactiontypes` (
  `transactionTypeID` int(11) UNSIGNED NOT NULL,
  `transactionType` varchar(20) NOT NULL,
  `createdBy` int(11) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `updatedBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactiontypes`
--

INSERT INTO `transactiontypes` (`transactionTypeID`, `transactionType`, `createdBy`, `dateCreated`, `updatedBy`, `dateModified`) VALUES
(1, 'Normal', 1, '2012-08-01 10:15:22', 1, '2012-08-01 04:15:22'),
(2, 'Broadcast', 1, '2012-08-01 10:15:23', 1, '2012-08-01 04:15:23'),
(3, 'BulkUpload', 1, '2012-08-01 10:15:23', 1, '2012-08-01 04:15:23'),
(4, 'Inbox/Outbox', 1, '2012-08-01 10:15:23', 1, '2018-05-21 10:49:23'),
(5, 'Quick SMS', 1, '2012-08-01 10:15:23', 1, '2018-05-21 10:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `userconfirmation`
--

CREATE TABLE `userconfirmation` (
  `rSettingID` int(10) UNSIGNED NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `campaignID` int(10) UNSIGNED NOT NULL,
  `settingName` varchar(60) DEFAULT NULL,
  `settingType` tinyint(4) NOT NULL DEFAULT '1',
  `shortCode` varchar(50) NOT NULL,
  `serviceUrl` varchar(200) NOT NULL,
  `serviceKey` varchar(200) DEFAULT NULL,
  `serviceSecret` varchar(200) DEFAULT NULL,
  `servicePassKey` varchar(200) DEFAULT NULL,
  `updatedBy` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `active` tinyint(3) NOT NULL DEFAULT '2',
  `activityHistory` text,
  `dateCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `insertedBy` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userconfirmation`
--

INSERT INTO `userconfirmation` (`rSettingID`, `clientID`, `campaignID`, `settingName`, `settingType`, `shortCode`, `serviceUrl`, `serviceKey`, `serviceSecret`, `servicePassKey`, `updatedBy`, `active`, `activityHistory`, `dateCreated`, `dateModified`, `insertedBy`) VALUES
(1, 0, 1, NULL, 1, '', 'https://api.brandrive.co.ke/raffles/v1/sdfa342/Test', NULL, NULL, NULL, 0, 2, NULL, '2019-03-09 13:28:35', '2019-03-09 10:28:35', 0),
(2, 1, 1, 'Test', 1, '', 'https://api.brandrive.co.ke/raffles/v1/sdfa342/Test', NULL, NULL, NULL, 1, 2, NULL, '2019-03-09 13:34:23', '2019-03-09 10:34:23', 1),
(3, 1, 1, 'Test', 1, '23423', '', '23432', '3243', '34243', 1, 2, NULL, '2019-03-09 15:20:23', '2019-03-09 12:20:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

CREATE TABLE `usergroups` (
  `userGroupID` int(11) UNSIGNED NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL,
  `groupID` int(11) UNSIGNED NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL,
  `insertedBy` int(11) UNSIGNED DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `updatedBy` int(11) UNSIGNED DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usergroups`
--

INSERT INTO `usergroups` (`userGroupID`, `userID`, `groupID`, `active`, `insertedBy`, `dateCreated`, `updatedBy`, `dateModified`) VALUES
(2, 5, 21, 1, 1, '2019-02-08 12:42:57', 1, '2019-02-08 09:42:57'),
(3, 6, 21, 1, 1, '2019-02-08 12:44:12', 1, '2019-02-08 09:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `userlogs`
--

CREATE TABLE `userlogs` (
  `userLogID` int(11) NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL,
  `loginTime` datetime DEFAULT NULL,
  `logoutTime` datetime DEFAULT NULL,
  `loginIP` varchar(100) DEFAULT NULL,
  `attemptsBeforeLogin` smallint(6) NOT NULL DEFAULT '0',
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateCreated` datetime DEFAULT NULL,
  `insertedBy` int(10) DEFAULT NULL,
  `updatedBy` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Logs users';

-- --------------------------------------------------------

--
-- Table structure for table `userpasswordrequest`
--

CREATE TABLE `userpasswordrequest` (
  `requestID` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `token` varchar(150) NOT NULL,
  `IP` varchar(100) NOT NULL,
  `active` int(11) DEFAULT '0',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userpasswordrequest`
--

INSERT INTO `userpasswordrequest` (`requestID`, `email`, `token`, `IP`, `active`, `dateCreated`) VALUES
(1, 'erssfd@codds.com', 'NU9iVx_G-K0PR7dt1pe0mYBtSMZx8yJQ_1524261287', '::1', 1, '2018-04-20 21:54:47'),
(2, 'kamau223@csse.com', 'JuNPZkN2MX0xvxMMVx4xtNOSdxFVeHw8_1524261340', '::1', 1, '2018-04-20 21:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) UNSIGNED NOT NULL,
  `uuid` varchar(50) NOT NULL,
  `clientID` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `fullNames` varchar(120) DEFAULT NULL,
  `emailAddress` varchar(120) DEFAULT NULL,
  `IDNumber` varchar(30) DEFAULT NULL,
  `MSISDN` bigint(15) NOT NULL,
  `password` varchar(150) DEFAULT NULL,
  `passwordAttempts` smallint(6) NOT NULL DEFAULT '0',
  `passwordStatusID` int(11) UNSIGNED NOT NULL,
  `auth_key` varchar(150) DEFAULT NULL,
  `access_token_expired_at` int(11) NOT NULL DEFAULT '0',
  `registration_ip` varchar(50) NOT NULL DEFAULT '',
  `last_login_ip` varchar(50) NOT NULL DEFAULT '',
  `last_login_at` int(11) DEFAULT NULL,
  `datePasswordChanged` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `dateActivated` datetime DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedBy` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `uuid`, `clientID`, `username`, `fullNames`, `emailAddress`, `IDNumber`, `MSISDN`, `password`, `passwordAttempts`, `passwordStatusID`, `auth_key`, `access_token_expired_at`, `registration_ip`, `last_login_ip`, `last_login_at`, `datePasswordChanged`, `status`, `dateActivated`, `dateCreated`, `dateModified`, `updatedBy`, `createdBy`) VALUES
(1, '23aasdad', 1, 'thesuperadminaccount', 'The Super Administrator Account', 'test@test.com', '12345678', 254721851111, '$2y$13$Vx7utS1j.QJKo7kKPoF6KedGAFltZngXEQLvdPuqbUJv.NtXHxYpC', 1, 1, 'D6qS3GFZJ4Tk88UsBXoP_OpSqY6UchrA_1532122083', 1537030321, '::1', '::1', 1536943921, '2015-06-15 16:50:57', 1, '2014-10-05 13:32:14', '2013-04-19 10:37:25', '2018-11-03 10:54:22', 1, 1),
(6, '', 14, 'ggatuma@gmail.com', NULL, 'ggatuma@gmail.com', NULL, 0, NULL, 0, 0, 'UnAAMCmlmfnQjUoNg0rnEWTV9Aj56W4M_1549619052', 0, '', '', NULL, NULL, NULL, NULL, '2019-02-08 12:44:12', '2019-02-08 09:44:12', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vlist`
--

CREATE TABLE `vlist` (
  `vListID` int(11) UNSIGNED NOT NULL,
  `listName` varchar(120) NOT NULL,
  `clientID` int(11) UNSIGNED NOT NULL,
  `originalFileName` varchar(100) DEFAULT NULL,
  `generatedFileName` varchar(100) DEFAULT NULL,
  `insertedBy` int(11) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `dateActivated` datetime NOT NULL,
  `updatedBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vlistactions`
--

CREATE TABLE `vlistactions` (
  `permissionID` int(11) UNSIGNED NOT NULL,
  `moduleID` int(11) UNSIGNED NOT NULL,
  `entityActionID` int(10) UNSIGNED NOT NULL,
  `groupID` int(11) UNSIGNED NOT NULL,
  `access` tinyint(3) UNSIGNED NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL,
  `insertedBy` int(11) UNSIGNED DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `updatedBy` int(11) UNSIGNED DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vlistentries`
--

CREATE TABLE `vlistentries` (
  `vListActionID` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `actionStepID` int(10) UNSIGNED DEFAULT NULL,
  `vListID` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL,
  `extraData` text NOT NULL,
  `insertedBy` int(11) UNSIGNED NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `updatedBy` int(11) UNSIGNED NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vrequests`
--

CREATE TABLE `vrequests` (
  `channelRequestID` int(11) UNSIGNED NOT NULL,
  `MSISDN` bigint(20) NOT NULL,
  `accessPoint` varchar(20) NOT NULL COMMENT 'The actual short code value\n',
  `message` text,
  `gatewayID` int(11) UNSIGNED NOT NULL,
  `gatewayUID` varchar(65) DEFAULT NULL,
  `payload` text,
  `priority` tinyint(4) NOT NULL DEFAULT '1',
  `connectorID` int(11) UNSIGNED NOT NULL,
  `clientSystemID` int(11) NOT NULL,
  `activityID` int(11) NOT NULL DEFAULT '0',
  `overalStatus` int(11) NOT NULL DEFAULT '0',
  `statusHistory` text,
  `statusDescription` text,
  `serviceDescription` varchar(255) DEFAULT NULL COMMENT 'Contains service descriptors where available\n',
  `expiryDate` datetime NOT NULL,
  `appID` int(11) DEFAULT NULL,
  `dateResponded` datetime DEFAULT NULL,
  `dateCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateClosed` datetime DEFAULT NULL,
  `MOCost` float(7,2) DEFAULT '0.00',
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bucketID` int(5) NOT NULL DEFAULT '0',
  `lastSend` datetime NOT NULL,
  `firstSend` datetime NOT NULL,
  `nextSend` datetime NOT NULL,
  `numberOfSends` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This is the table that stores all requests that come to hub ';

-- --------------------------------------------------------

--
-- Table structure for table `vresponses`
--

CREATE TABLE `vresponses` (
  `channelResponseID` int(11) UNSIGNED NOT NULL,
  `channelRequestID` int(11) NOT NULL DEFAULT '0',
  `MSISDN` bigint(20) NOT NULL,
  `accessPoint` varchar(20) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `gatewayID` int(11) UNSIGNED NOT NULL,
  `gatewayUID` varchar(65) DEFAULT NULL,
  `networkID` int(11) NOT NULL,
  `connectorRuleID` int(11) UNSIGNED NOT NULL,
  `IMCID` int(11) UNSIGNED DEFAULT NULL,
  `clientSystemID` int(11) NOT NULL,
  `externalSystemServiceID` int(11) DEFAULT NULL,
  `connectorID` int(11) UNSIGNED NOT NULL,
  `priority` tinyint(2) UNSIGNED DEFAULT '0',
  `clientSMSID` varchar(20) NOT NULL,
  `encrypted` tinyint(1) NOT NULL DEFAULT '0',
  `overalStatus` int(11) NOT NULL DEFAULT '0',
  `statusHistory` text COMMENT 'This column maintains the history status of the bulk. should contain the folowing {appID,status,date}',
  `statusDescription` text,
  `serviceDescription` varchar(255) DEFAULT NULL COMMENT 'Contains service descriptors where available\n',
  `dateCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expiryDate` datetime NOT NULL,
  `retry` tinyint(1) DEFAULT '0',
  `processed` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `bucketID` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `lastSend` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `firstSend` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nextsend` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `numberOfSends` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `deliveryReportID` int(11) UNSIGNED NOT NULL,
  `deliveryDate` datetime NOT NULL,
  `payload` text,
  `appID` int(11) DEFAULT NULL,
  `dateResponded` datetime DEFAULT NULL,
  `dateClosed` datetime DEFAULT NULL,
  `MTCost` float(7,2) DEFAULT NULL,
  `messageLength` int(11) DEFAULT NULL,
  `numberOfSMS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='channelResponses stores responses to be sent out to users by';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apiusers`
--
ALTER TABLE `apiusers`
  ADD PRIMARY KEY (`apiUserID`),
  ADD UNIQUE KEY `api_key_unique` (`api_key`),
  ADD KEY `fk_apiUsers_clients1_idx` (`clientID`);

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`campaignID`);

--
-- Indexes for table `campainrequests`
--
ALTER TABLE `campainrequests`
  ADD PRIMARY KEY (`requestsID`),
  ADD KEY `fk_services_clients1_idx` (`clientID`),
  ADD KEY `fk_cServices_insertedBy` (`insertedBy`);

--
-- Indexes for table `ccodeentries`
--
ALTER TABLE `ccodeentries`
  ADD PRIMARY KEY (`codeID`),
  ADD KEY `campaignID` (`cCodeID`),
  ADD KEY `updatedBy` (`updatedBy`),
  ADD KEY `clientID` (`clientID`),
  ADD KEY `insertedBy` (`insertedBy`);

--
-- Indexes for table `ccodeentriesmapping`
--
ALTER TABLE `ccodeentriesmapping`
  ADD PRIMARY KEY (`mappingID`),
  ADD KEY `clientID` (`clientID`),
  ADD KEY `cEntryID` (`cEntryID`);

--
-- Indexes for table `ccodes`
--
ALTER TABLE `ccodes`
  ADD PRIMARY KEY (`codeID`),
  ADD UNIQUE KEY `clientID` (`clientID`),
  ADD KEY `campaignID` (`campaignID`),
  ADD KEY `insertedBy` (`insertedBy`),
  ADD KEY `updatedBy` (`updatedBy`);

--
-- Indexes for table `cdrawentries`
--
ALTER TABLE `cdrawentries`
  ADD PRIMARY KEY (`entryID`),
  ADD KEY `clientID` (`clientID`),
  ADD KEY `cEntryID` (`cEntryID`),
  ADD KEY `drawID` (`drawID`);

--
-- Indexes for table `cdraws`
--
ALTER TABLE `cdraws`
  ADD PRIMARY KEY (`drawID`),
  ADD UNIQUE KEY `MSISDN` (`drawNumber`),
  ADD KEY `drawNumber` (`drawNumber`),
  ADD KEY `campaignID` (`campaignID`),
  ADD KEY `clientID` (`clientID`);

--
-- Indexes for table `cdrawwinners`
--
ALTER TABLE `cdrawwinners`
  ADD PRIMARY KEY (`winID`),
  ADD KEY `insertedBy` (`insertedBy`),
  ADD KEY `updatedBy` (`updatedBy`),
  ADD KEY `cEntryID` (`cEntryID`),
  ADD KEY `clientID` (`clientID`),
  ADD KEY `drawID` (`drawID`);

--
-- Indexes for table `centries`
--
ALTER TABLE `centries`
  ADD PRIMARY KEY (`entryID`),
  ADD KEY `campaignID` (`campaignID`),
  ADD KEY `clientID` (`clientID`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientID`),
  ADD UNIQUE KEY `clientName_UNIQUE` (`clientName`),
  ADD UNIQUE KEY `uuid_2` (`uuid`),
  ADD KEY `uuid` (`uuid`);

--
-- Indexes for table `confirmation`
--
ALTER TABLE `confirmation`
  ADD PRIMARY KEY (`requestsID`),
  ADD KEY `fk_services_clients1_idx` (`clientID`),
  ADD KEY `fk_cServices_insertedBy` (`insertedBy`),
  ADD KEY `fk_cServices_updatedBy` (`updatedBy`);

--
-- Indexes for table `contactlists`
--
ALTER TABLE `contactlists`
  ADD PRIMARY KEY (`contactListID`),
  ADD UNIQUE KEY `bulkTargetName` (`listName`),
  ADD KEY `partnerID` (`clientID`),
  ADD KEY `insertedBy` (`insertedBy`),
  ADD KEY `updatedBy` (`updatedBy`);

--
-- Indexes for table `creditallocation`
--
ALTER TABLE `creditallocation`
  ADD PRIMARY KEY (`allocationID`),
  ADD KEY `partnerID` (`clientID`),
  ADD KEY `allocatedBy` (`allocatedBy`),
  ADD KEY `updatedBy` (`updatedBy`);

--
-- Indexes for table `creditconsumption`
--
ALTER TABLE `creditconsumption`
  ADD PRIMARY KEY (`consumptionID`),
  ADD KEY `consumedBy` (`consumedBy`),
  ADD KEY `clientID` (`clientID`),
  ADD KEY `transactionID` (`transactionID`);

--
-- Indexes for table `crules`
--
ALTER TABLE `crules`
  ADD PRIMARY KEY (`ruleID`),
  ADD KEY `insertedBy` (`insertedBy`),
  ADD KEY `updateBy` (`updateBy`);

--
-- Indexes for table `csettings`
--
ALTER TABLE `csettings`
  ADD PRIMARY KEY (`settingID`),
  ADD KEY `campaignID` (`campaignID`),
  ADD KEY `insertedBy` (`insertedBy`),
  ADD KEY `updateBy` (`updateBy`),
  ADD KEY `clientID` (`clientID`),
  ADD KEY `ruleID` (`ruleID`);

--
-- Indexes for table `emailqueue`
--
ALTER TABLE `emailqueue`
  ADD PRIMARY KEY (`emailQueueID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupID`),
  ADD KEY `fk_groups_groupTypes` (`groupTypeID`);

--
-- Indexes for table `mnemonics`
--
ALTER TABLE `mnemonics`
  ADD PRIMARY KEY (`mnemonicID`);

--
-- Indexes for table `outbound`
--
ALTER TABLE `outbound`
  ADD PRIMARY KEY (`outboundID`),
  ADD UNIQUE KEY `messageID_2` (`messageID`,`MSISDN`),
  ADD KEY `messageID` (`messageID`),
  ADD KEY `transactionID` (`transactionID`),
  ADD KEY `outbound_nextSend` (`nextSend`),
  ADD KEY `MSISDN` (`MSISDN`),
  ADD KEY `sourceAddress` (`sourceAddress`),
  ADD KEY `firstSend` (`firstSend`),
  ADD KEY `lastSend` (`lastSend`),
  ADD KEY `numberOfSends` (`numberOfSends`),
  ADD KEY `statusCode` (`statusCode`),
  ADD KEY `priority` (`priority`);

--
-- Indexes for table `outmessages`
--
ALTER TABLE `outmessages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `passwordstatuses`
--
ALTER TABLE `passwordstatuses`
  ADD PRIMARY KEY (`passwordStatusID`),
  ADD UNIQUE KEY `passwordStatus` (`passwordStatus`);

--
-- Indexes for table `protocols`
--
ALTER TABLE `protocols`
  ADD PRIMARY KEY (`protocolID`),
  ADD UNIQUE KEY `protocolID_UNIQUE` (`protocolID`),
  ADD UNIQUE KEY `protocol_2` (`protocol`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`reportID`),
  ADD UNIQUE KEY `reportName_UNIQUE` (`reportName`),
  ADD KEY `fk_reports_reportTypes1_idx` (`reportTypeID`);

--
-- Indexes for table `reporttypes`
--
ALTER TABLE `reporttypes`
  ADD PRIMARY KEY (`reportTypeID`);

--
-- Indexes for table `rpaymentsettings`
--
ALTER TABLE `rpaymentsettings`
  ADD PRIMARY KEY (`rSettingID`),
  ADD KEY `fk_services_clients1_idx` (`clientID`),
  ADD KEY `fk_cServices_insertedBy` (`insertedBy`),
  ADD KEY `fk_cServices_updatedBy` (`updatedBy`);

--
-- Indexes for table `sourceaddresses`
--
ALTER TABLE `sourceaddresses`
  ADD PRIMARY KEY (`sourceAddressID`),
  ADD UNIQUE KEY `sourceaddress_unique` (`sourceAddress`),
  ADD KEY `fk_sourceAdress_insertedBy` (`insertedBy`),
  ADD KEY `fk_sourceAdress_updatedBy` (`updatedBy`),
  ADD KEY `sourceAddress_Index` (`sourceAddress`);

--
-- Indexes for table `sourceaddressmapping`
--
ALTER TABLE `sourceaddressmapping`
  ADD PRIMARY KEY (`mappingID`),
  ADD KEY `mappingID` (`mappingID`),
  ADD KEY `sourceAddressID` (`sourceAddressID`),
  ADD KEY `clientID` (`clientID`);

--
-- Indexes for table `statuscodes`
--
ALTER TABLE `statuscodes`
  ADD PRIMARY KEY (`statusCodeID`),
  ADD KEY `fk_errorCodes_errorCategories1_idx` (`statTypeID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `serviceID` (`serviceID`),
  ADD KEY `transactionTypeID` (`transactionTypeID`),
  ADD KEY `dateOpened` (`dateCreated`);

--
-- Indexes for table `transactionstatus`
--
ALTER TABLE `transactionstatus`
  ADD PRIMARY KEY (`transactionStatusID`),
  ADD UNIQUE KEY `statusCode` (`statusCode`);

--
-- Indexes for table `transactiontypes`
--
ALTER TABLE `transactiontypes`
  ADD PRIMARY KEY (`transactionTypeID`);

--
-- Indexes for table `userconfirmation`
--
ALTER TABLE `userconfirmation`
  ADD PRIMARY KEY (`rSettingID`),
  ADD KEY `fk_services_clients1_idx` (`clientID`),
  ADD KEY `fk_cServices_insertedBy` (`insertedBy`),
  ADD KEY `fk_cServices_updatedBy` (`updatedBy`);

--
-- Indexes for table `usergroups`
--
ALTER TABLE `usergroups`
  ADD PRIMARY KEY (`userGroupID`),
  ADD UNIQUE KEY `userID` (`userID`,`groupID`),
  ADD KEY `fk_userGroups_groups_idx` (`groupID`);

--
-- Indexes for table `userlogs`
--
ALTER TABLE `userlogs`
  ADD PRIMARY KEY (`userLogID`),
  ADD KEY `fk_userLogins_users1_idx` (`userID`);

--
-- Indexes for table `userpasswordrequest`
--
ALTER TABLE `userpasswordrequest`
  ADD PRIMARY KEY (`requestID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `userName` (`username`),
  ADD KEY `fk_users_clients1_idx` (`clientID`),
  ADD KEY `fk_users_passwordStatuses` (`passwordStatusID`);

--
-- Indexes for table `vlist`
--
ALTER TABLE `vlist`
  ADD PRIMARY KEY (`vListID`),
  ADD UNIQUE KEY `bulkTargetName` (`listName`),
  ADD KEY `partnerID` (`clientID`),
  ADD KEY `insertedBy` (`insertedBy`),
  ADD KEY `updatedBy` (`updatedBy`);

--
-- Indexes for table `vlistactions`
--
ALTER TABLE `vlistactions`
  ADD PRIMARY KEY (`permissionID`),
  ADD UNIQUE KEY `moduleID` (`moduleID`,`entityActionID`,`groupID`),
  ADD KEY `fk_permissions_groups1_idx` (`groupID`),
  ADD KEY `fk_permissions_moduleActions1_idx` (`moduleID`),
  ADD KEY `entityActionID` (`entityActionID`);

--
-- Indexes for table `vlistentries`
--
ALTER TABLE `vlistentries`
  ADD PRIMARY KEY (`vListActionID`),
  ADD KEY `name` (`name`),
  ADD KEY `code` (`actionStepID`),
  ADD KEY `active` (`status`) USING BTREE,
  ADD KEY `vListID` (`vListID`),
  ADD KEY `insertedBy` (`insertedBy`),
  ADD KEY `updatedBy` (`updatedBy`);

--
-- Indexes for table `vrequests`
--
ALTER TABLE `vrequests`
  ADD PRIMARY KEY (`channelRequestID`,`dateCreated`),
  ADD UNIQUE KEY `UNIQUE_gatewayID_gatewayUID_activityID` (`gatewayID`,`MSISDN`,`gatewayUID`,`activityID`),
  ADD KEY `clientSystemID_index` (`clientSystemID`),
  ADD KEY `bucketID` (`bucketID`),
  ADD KEY `activityID` (`activityID`),
  ADD KEY `dateCreated_index` (`dateCreated`),
  ADD KEY `MSISDN` (`MSISDN`),
  ADD KEY `nextSend_index` (`nextSend`),
  ADD KEY `overalStatus_index` (`overalStatus`);

--
-- Indexes for table `vresponses`
--
ALTER TABLE `vresponses`
  ADD PRIMARY KEY (`channelResponseID`),
  ADD UNIQUE KEY `CLIENTSMSID_CLIENT` (`clientSystemID`,`clientSMSID`),
  ADD KEY `processed` (`processed`),
  ADD KEY `numberofsends` (`numberOfSends`),
  ADD KEY `nextSend` (`nextsend`),
  ADD KEY `clientSystemID_index` (`clientSystemID`),
  ADD KEY `bucketID` (`bucketID`),
  ADD KEY `connectorID` (`connectorID`),
  ADD KEY `connectorRuleID` (`connectorRuleID`),
  ADD KEY `deliveryReportID` (`deliveryReportID`),
  ADD KEY `gatewayID` (`gatewayID`),
  ADD KEY `overalStatus` (`overalStatus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apiusers`
--
ALTER TABLE `apiusers`
  MODIFY `apiUserID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ccodeentries`
--
ALTER TABLE `ccodeentries`
  MODIFY `codeID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ccodeentriesmapping`
--
ALTER TABLE `ccodeentriesmapping`
  MODIFY `mappingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ccodes`
--
ALTER TABLE `ccodes`
  MODIFY `codeID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cdraws`
--
ALTER TABLE `cdraws`
  MODIFY `drawID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `centries`
--
ALTER TABLE `centries`
  MODIFY `entryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contactlists`
--
ALTER TABLE `contactlists`
  MODIFY `contactListID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `creditallocation`
--
ALTER TABLE `creditallocation`
  MODIFY `allocationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=384;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
