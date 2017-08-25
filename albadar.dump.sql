-- MySQL dump 10.13  Distrib 5.7.15, for Linux (x86_64)
--
-- Host: localhost    Database: albadar
-- ------------------------------------------------------
-- Server version	5.7.15-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bimbel`
--

DROP TABLE IF EXISTS `bimbel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bimbel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptno` varchar(15) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `nis` varchar(6) DEFAULT NULL,
  `pyear` varchar(4) DEFAULT NULL,
  `pmonth` varchar(2) DEFAULT NULL COMMENT 'month to pay',
  `cyear` varchar(4) DEFAULT NULL COMMENT 'tahun ajaran',
  `paymenttype` varchar(1) DEFAULT '1' COMMENT '1 tunai 2 tabungan 3 transfer',
  `purpose` text COMMENT 'description of payment by system',
  `description` text COMMENT 'description of payment by operator',
  `createuser` varchar(30) DEFAULT 'admin',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bimbelgroups`
--

DROP TABLE IF EXISTS `bimbelgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bimbelgroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `description` text,
  `createuser` varchar(30) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bookpayment`
--

DROP TABLE IF EXISTS `bookpayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookpayment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptno` varchar(15) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `nis` varchar(6) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL COMMENT 'tahun ajaran',
  `paymenttype` varchar(1) DEFAULT '1' COMMENT '1 tunai 2 tabungan 3 transfer',
  `purpose` text COMMENT 'description of payment by system',
  `description` text COMMENT 'description of payment by operator',
  `createuser` varchar(30) DEFAULT 'admin',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bookpaymentgroups`
--

DROP TABLE IF EXISTS `bookpaymentgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookpaymentgroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `description` text,
  `createuser` varchar(30) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dupsb`
--

DROP TABLE IF EXISTS `dupsb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dupsb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptno` varchar(15) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `nis` varchar(6) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL COMMENT 'tahun ajaran',
  `paymenttype` varchar(1) DEFAULT '1' COMMENT '1 tunai 2 tabungan 3 transfer',
  `purpose` text COMMENT 'description of payment by system',
  `description` text COMMENT 'description of payment by operator',
  `createuser` varchar(30) DEFAULT 'admin',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `dupsbgroups`
--

DROP TABLE IF EXISTS `dupsbgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dupsbgroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `description` text,
  `createuser` varchar(30) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `sppgroup_id` int(11) DEFAULT NULL,
  `bimbelgroup_id` int(11) DEFAULT NULL COMMENT 'kelompok biaya bimbel',
  `dupsbgroup_id` int(11) DEFAULT NULL,
  `bookpaymentgroup_id` int(11) DEFAULT NULL,
  `description` text,
  `createuser` varchar(30) DEFAULT 'admin',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` varchar(10) DEFAULT NULL,
  `paid` varchar(10) DEFAULT NULL COMMENT 'jumlah yang dibayarkan',
  `returnmoney` varchar(10) DEFAULT NULL COMMENT 'jumlah yang kembalian',
  `nis` varchar(5) DEFAULT NULL,
  `yearmonth` varchar(6) DEFAULT NULL COMMENT 'year and month to pay',
  `paymenttype` varchar(1) DEFAULT '1' COMMENT '1 tunai 2 tabungan 3 transfer',
  `purpose` text COMMENT 'description of payment by system',
  `description` text COMMENT 'description of payment by operator',
  `createuser` varchar(30) DEFAULT 'admin',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `receiptdetails`
--

DROP TABLE IF EXISTS `receiptdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receiptdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptno` varchar(15) DEFAULT NULL,
  `description` text,
  `amount` varchar(10) DEFAULT NULL,
  `createuser` varchar(50) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `receipts`
--

DROP TABLE IF EXISTS `receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptno` varchar(15) DEFAULT NULL,
  `rorder` varchar(4) DEFAULT NULL,
  `nis` varchar(10) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `createuser` varchar(50) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currentyear` varchar(4) DEFAULT NULL COMMENT 'current year',
  `initmonth` varchar(2) DEFAULT '07',
  `createuser` varchar(30) DEFAULT 'admin',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `spp`
--

DROP TABLE IF EXISTS `spp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptno` varchar(15) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `nis` varchar(6) DEFAULT NULL,
  `pyear` varchar(4) DEFAULT NULL,
  `pmonth` varchar(2) DEFAULT NULL COMMENT 'month to pay',
  `cyear` varchar(4) DEFAULT NULL COMMENT 'tahun ajaran',
  `paymenttype` varchar(1) DEFAULT '1' COMMENT '1 tunai 2 tabungan 3 transfer',
  `purpose` text COMMENT 'description of payment by system',
  `description` text COMMENT 'description of payment by operator',
  `createuser` varchar(30) DEFAULT 'admin',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sppgroups`
--

DROP TABLE IF EXISTS `sppgroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sppgroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `description` text,
  `createuser` varchar(30) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `initmonth` varchar(2) DEFAULT NULL COMMENT 'first month count',
  `inityear` varchar(4) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL COMMENT 'tahun untuk history, berubah saat daftar ulang, tahun adalah awal tahun pelajaran',
  `grade_id` smallint(6) DEFAULT NULL,
  `sppgroup_id` smallint(6) DEFAULT NULL,
  `bimbelgroup_id` smallint(6) DEFAULT NULL COMMENT 'group pembayaran bimbel',
  `dupsbgroup_id` int(11) DEFAULT NULL,
  `description` text,
  `createuser` varchar(30) DEFAULT 'admin',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=615 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `studentshistory`
--

DROP TABLE IF EXISTS `studentshistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentshistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `year` varchar(4) DEFAULT NULL COMMENT 'tahun untuk history, berubah saat daftar ulang, tahun adalah awal tahun pelajaran',
  `grade_id` smallint(6) DEFAULT NULL,
  `sppgroup_id` smallint(6) DEFAULT NULL,
  `bimbelgroup_id` smallint(6) DEFAULT NULL COMMENT 'group pembayaran bimbel',
  `dupsbgroup_id` int(11) DEFAULT NULL,
  `bookpaymentgroup_id` int(11) DEFAULT NULL COMMENT 'id pembayaran buku',
  `description` text,
  `createuser` varchar(30) DEFAULT 'admin',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=615 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nname` varchar(40) DEFAULT NULL COMMENT 'nickname',
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(40) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `role` varchar(1) DEFAULT '2',
  `password` varchar(64) DEFAULT NULL,
  `salt` varchar(20) DEFAULT NULL,
  `createuser` varchar(60) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-24 21:04:21
