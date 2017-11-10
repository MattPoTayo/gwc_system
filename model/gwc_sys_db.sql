-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: gwc_sys_db
-- ------------------------------------------------------
-- Server version	5.7.10-log

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
-- Table structure for table `activity_detail`
--

DROP TABLE IF EXISTS `activity_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_detail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `HeadID` int(11) NOT NULL DEFAULT '0',
  `TypeOfEntity` int(11) NOT NULL DEFAULT '0',
  `ClientID` int(11) NOT NULL DEFAULT '0',
  `SupplierID` int(11) NOT NULL DEFAULT '0',
  `ContactID` int(11) NOT NULL DEFAULT '0',
  `ActivityType` int(11) NOT NULL DEFAULT '0',
  `BrandID` int(11) NOT NULL DEFAULT '0',
  `ActivityDetail` varchar(45) NOT NULL DEFAULT '',
  `Mark` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_detail`
--

LOCK TABLES `activity_detail` WRITE;
/*!40000 ALTER TABLE `activity_detail` DISABLE KEYS */;
INSERT INTO `activity_detail` VALUES (1,3,2,0,9,6,7,2,'Check if Flex is available',1),(2,13,1,298,0,16,1,1,'Purchase Monitor, HDD Keyboard Mouse ',1),(3,14,1,298,0,16,1,1,'Purchase Monitor, HDD Keyboard Mouse ',1),(4,15,1,298,0,16,5,1,'Delivered Monitor, HDD, Keyboard and Mouse',1),(5,16,1,308,0,11,2,2,'Sample Only',1),(6,7,1,282,0,30,1,3,'Sample Only',1),(7,7,1,308,0,8,3,5,'Test',1);
/*!40000 ALTER TABLE `activity_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_head`
--

DROP TABLE IF EXISTS `activity_head`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_head` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Reference` bigint(22) NOT NULL DEFAULT '0',
  `Source` int(11) NOT NULL DEFAULT '0',
  `Destination` int(11) NOT NULL DEFAULT '0',
  `Comment` varchar(256) NOT NULL DEFAULT '',
  `Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Mark` int(11) NOT NULL DEFAULT '0',
  `Creator` int(11) NOT NULL DEFAULT '0',
  `Type` int(11) NOT NULL DEFAULT '0',
  `ActivityDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_head`
--

LOCK TABLES `activity_head` WRITE;
/*!40000 ALTER TABLE `activity_head` DISABLE KEYS */;
INSERT INTO `activity_head` VALUES (1,1,278,0,'','2017-03-20 09:58:18',-1,278,1,'2017-03-20 09:58:18'),(2,2,280,0,'','2017-03-20 11:23:41',-1,280,1,'2017-03-20 11:23:41'),(3,3,253,0,'Normal Daily Activity','2017-03-20 11:24:44',1,253,2,'2017-04-19 00:00:00'),(4,4,253,0,'Daily Activity','2017-03-20 11:29:16',2,253,1,'2017-03-20 00:00:00'),(5,5,253,0,'fsdfs','2017-03-20 11:31:54',-1,253,1,'2017-03-20 00:00:00'),(6,6,253,0,'','2017-04-25 13:29:04',2,253,1,'2017-04-25 13:29:04'),(7,7,253,0,'Sample Report','2017-04-26 10:50:48',2,253,1,'2017-04-26 00:00:00'),(8,8,253,0,'','2017-05-11 09:55:46',-1,253,1,'2017-05-11 09:55:46'),(9,9,253,0,'','2017-05-11 10:03:26',-1,253,1,'2017-05-11 10:03:26'),(10,10,284,0,'','2017-05-22 15:11:22',2,284,1,'2017-05-22 03:11:22'),(11,11,280,0,'n ','2017-05-22 15:51:34',2,280,1,'2017-05-22 00:00:00'),(12,12,287,0,'','2017-05-22 15:51:48',-1,287,1,'2017-05-22 03:51:48'),(13,13,287,0,'f','2017-05-22 15:53:22',1,287,1,'2017-05-22 00:00:00'),(14,14,287,0,'','2017-05-22 15:56:46',-1,287,1,'2017-05-22 03:56:46'),(15,15,287,0,'r','2017-05-22 15:57:23',2,287,1,'2017-05-22 00:00:00'),(16,16,253,0,'Sample Report','2017-05-22 15:58:13',1,253,1,'2017-06-21 00:00:00'),(17,17,287,0,'','2017-05-22 15:58:47',-1,287,1,'2017-05-22 03:58:47'),(18,18,253,0,'','2017-05-22 15:59:12',-1,253,1,'2017-05-22 03:59:12'),(19,19,253,0,'','2017-05-22 16:04:19',2,253,1,'2017-05-22 04:04:19'),(20,20,284,0,'','2017-06-02 17:00:21',2,284,1,'2017-06-02 05:00:21'),(21,21,283,0,'','2017-06-13 20:28:53',-1,283,1,'2017-06-13 08:28:53');
/*!40000 ALTER TABLE `activity_head` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_mode`
--

DROP TABLE IF EXISTS `activity_mode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_mode` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_mode`
--

LOCK TABLES `activity_mode` WRITE;
/*!40000 ALTER TABLE `activity_mode` DISABLE KEYS */;
INSERT INTO `activity_mode` VALUES (1,'Client'),(2,'Supplier');
/*!40000 ALTER TABLE `activity_mode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activity_type`
--

DROP TABLE IF EXISTS `activity_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_type` (
  `ID` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL DEFAULT '',
  `Mode` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_type`
--

LOCK TABLES `activity_type` WRITE;
/*!40000 ALTER TABLE `activity_type` DISABLE KEYS */;
INSERT INTO `activity_type` VALUES (1,'Follow-Up',1),(2,'Canvass',1),(3,'Telemarketing',1),(4,'Send Quotation',1),(5,'Delivery',1),(6,'Follow-Up',2),(7,'Inqure Item',2);
/*!40000 ALTER TABLE `activity_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `wid` int(4) DEFAULT '0',
  `prefixnumber` int(4) DEFAULT '0',
  `code` varchar(45) DEFAULT '',
  `name` varchar(45) DEFAULT '',
  `address` varchar(1024) DEFAULT '',
  `contact` varchar(512) DEFAULT '',
  `invoicename` varchar(45) DEFAULT '',
  `show` int(2) DEFAULT '0',
  `sqlserver` varchar(45) DEFAULT '',
  `port` varchar(45) DEFAULT '',
  `sqldatabase` varchar(45) DEFAULT '',
  `sqlusername` varchar(45) DEFAULT '',
  `sqlpassword` varchar(45) DEFAULT '',
  `isremote` int(1) DEFAULT '0',
  `ownername` varchar(512) DEFAULT '',
  `tin` varchar(45) DEFAULT '',
  `acc` varchar(45) DEFAULT '',
  `businessname` varchar(100) DEFAULT '',
  `localnetworkip` varchar(45) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `ix_branchwid` (`wid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES (1,10,10,'10','Gadget Works Corporation','#17 Payapa St. Brgy Plainview Mandaluyong, Metro Manila','(02) 899 1883','',1,'localhost','80','gwc_sys_db','root','121586',0,'','','','','localhost'),(2,11,11,'11','Branch','','','',1,'localhost','','nelsoft_test_2','root','121586',0,'','','','','localhost');
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brand` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (1,0,'None'),(2,10002,'LENOVO'),(3,10003,'SEAGATES'),(4,10004,'Kingston'),(5,10005,'Digital Persona'),(6,10006,'Dell'),(7,10007,'HP'),(8,10008,'Intel'),(9,10009,'Thermaltake'),(10,100010,'Microsoft'),(11,100011,'AMD'),(12,100012,'Logitech'),(13,100013,'N-Computing'),(14,100014,'D-Link'),(15,100015,'Belden'),(16,100016,'Generic'),(17,100017,'Zotac');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,0,'NONE'),(2,10002,'Desktop / Server'),(3,10003,'Laptop'),(4,10004,'Peripherals'),(5,10005,'CCTV'),(6,10006,'Biometrics'),(7,10007,'Printers'),(8,10008,'Office Supplies'),(9,10009,'Software'),(10,100010,'Consumables'),(11,100011,'Banbros Commercial Inc.'),(12,100012,'Thermaltake'),(13,100013,'Network Hardware');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `particular` varchar(45) CHARACTER SET latin1 DEFAULT '',
  `value` varchar(128) CHARACTER SET latin1 DEFAULT '',
  `date` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (2,'clientid','1001','2016-08-12 00:00:00'),(6,'application','GWC','2016-08-12 00:00:00'),(7,'branchid','10','2016-08-12 00:00:00'),(8,'systemversion','1.0','2016-08-12 00:00:00'),(9,'dbversion','1.0','2016-08-12 00:00:00');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Wid` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(45) NOT NULL DEFAULT '',
  `Mobile` varchar(45) DEFAULT '',
  `Landline` varchar(45) DEFAULT '',
  `Email` varchar(45) DEFAULT '',
  `ClientID` int(11) NOT NULL DEFAULT '0',
  `SupplierID` int(11) NOT NULL DEFAULT '0',
  `IsClient` int(2) NOT NULL DEFAULT '0',
  `ContactOwner` int(11) NOT NULL DEFAULT '0',
  `Designation` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,10001,'None','09999999999','(02) 999 9999','sample@gmail.com',0,1,0,0,''),(6,100011,'Matt','0999999999','363 2223','matt.nelsoft@gmail.com',281,0,1,0,''),(7,100011,'Juan Dela Cruz','095234242342','2342342','juan@mcs.com.ph',0,9,0,280,''),(8,100011,'Maria Clara','034234233','342342','maria@hb.com',282,0,1,0,''),(9,100011,'Ma.Monica Milano ','09055899427','535 0137 ','monica.m@nova-hub.net',291,0,1,0,''),(10,100011,'Chris Abadier','09055148597','706-0362','chris.abadier@gmail.com',292,0,1,0,''),(11,100011,'Vic Lino','09324152082','632 405 51 22','victor.lino@figarigroup.com',293,0,1,0,''),(12,100011,'Mr. Wesley Tambong','09178129035','728-8491','wesley.tambong@tvird.com.ph',294,0,1,280,''),(13,100011,'Ms. Janine Suaverdez','09088634402','470-2834','Purchasing@ph.lantro.com',295,0,1,280,''),(14,100011,'Ms. Anne Rochelle Palentinos','09985817336','(02) 542 1592','annerochelle.palentinos@bibo.com.ph',296,0,1,280,''),(15,100011,'Jimmy Ogaro','09178622508','(02) 818-9511','Jimmy.Ogaro@asia.lockton.com',297,0,1,283,''),(16,100011,'Rolando H. Polidario','09175629057','7485819','pol_cpa@yahoo.com',298,0,1,287,''),(17,100011,'Eufemia M. Montano  ','0','02-7356976','vye.montano@magsaysay.com.ph',299,0,1,287,''),(18,100011,'Ronillo Ylo','0','7320001 Loc 304','ronillo.ylo@tzuchi.org.ph',300,0,1,287,''),(19,100011,'Arnold S. Mercado',' 0917 8020269','987-1761','arnold.mercado@rebelalliance.ph',301,0,1,284,''),(20,100011,'Ian Jonas R. Dela Cruz','0','317-3670','contracts2@firstoceanic.com.ph',302,0,1,284,''),(21,100011,'Robert S. Gaw','09988960708','555-0101','rsgaw@taftproperty.com.ph',303,0,1,284,''),(22,100011,'Mylene Morales','0','230-6899/2306888','mamorales@pascuallab.com',304,0,1,284,''),(23,100011,'Mr. Randy Lasam','0','462-6224','rlasam@teleserv.com.ph',305,0,1,280,''),(24,100011,'Raeven De Leon','0','7277633','0',0,10,0,280,''),(25,100011,'Mr. James','0','584 9905','0',0,11,0,280,''),(26,100011,'Ms. SHEILA SABINIANO','0906.6412752','7050-834   ','sheila@vdidistribution.com',0,12,0,287,''),(27,100011,'Mr. James','0','584 9905','0',0,13,0,280,''),(28,100011,'Ernesto Guadalupe','09058800741','353 7237','ernesto@philcopy.com.ph',308,0,1,0,'Account Executive'),(29,100011,'Ms. Mae Abuan','09390665847','556-2075  556-1269  556-1343','maeabuan@gamail.com',309,0,1,0,'ICTE Teacher'),(30,100011,'Pearl Garcia','0','771 0560','fsri.admin@rgoc.com.ph',310,0,1,0,'Purchasing'),(31,100011,'Nanette/ Gasper','752-1056','752-1056','N/A',311,0,1,0,'Purchaser'),(32,100011,'Bong/ Uyboco','842-8961 / 772-2633','842-8961 / 772-2633','bonguyboco@metro.com',312,0,1,0,'Purchasing'),(33,100011,'Sharon SY','242-11-11','242-11-11','sales@solidmac.com.ph',313,0,1,0,''),(34,100011,'Bobis Majean','6879061','6879061','maryjane_bobbis@wvi.org',314,0,1,0,'ADMIN/PURCHASING OFFICER'),(35,100011,'Ferry Pangilinan','09175079306','571-5291 Local 260','fpangilinan@wriglyschool.com',315,0,1,0,''),(36,100011,'Boy Raymundo','588-8888 / (02) 645 5011','588-8888 / (02) 645 5011','girly.delacruz_dion@uniliever.com',316,0,1,0,'IT'),(37,100011,'Jenny C. Chua','7413489','7413489','co.jenny@mbc.edu.ph',317,0,1,0,'Registrar /Admin'),(38,100011,'Karen Calpo','4561405','4561405','Karen Calpo <karen.calpo@gmail.com>',318,0,1,0,'Purchaser'),(39,100011,'Sunshine Siojo','857-1846','857-1846','Sunshine.siojo@timcorp.ph',319,0,1,0,'Finance Specialist'),(40,100011,'Kit Maquinana','651-6888','651-6888','kmaquinana@thunderbird-asia.com',320,0,1,0,'Procurement Assistant'),(41,100011,'Jun Monforte','536-7629 / (02) 526 6740','536-7629 / (02) 526 6740','jp_monforte@yahoo.com',321,0,1,0,'IT Head'),(42,100011,'Erwin Gustilo','632 849 1575, 63906 2431 350','632 849 1575, 63906 2431 350','erwin.gustilo@sykes.com',322,0,1,0,'Purchasing'),(43,100011,'Julian Lilio','3185000','3185000','julian.lilio@thebayleaf.com.ph',323,0,1,0,'IT Officer'),(44,100011,'Janice Dela Cruz','892-4831','892-4831','purchasing@nesic.com.ph',324,0,1,0,'Purchasing Officer'),(45,100011,'Ruel Roque','217-1676','217-1676','ruel.roque.ext@nsn.com',325,0,1,0,'IT Head'),(46,100011,'Ms. Lora Dee','843-2864','843-2864','loradee. manila@newsim.ph',326,0,1,0,''),(47,100011,'Ms. Lora Dee','843-2864','843-2864','loradee. manila@newsim.ph',327,0,1,0,''),(48,100011,'Joy Gazmen','811-6888','811-6888','joy.gasmen@newworldhotels.com',328,0,1,0,'I.T Supervisor'),(49,100011,'Jude Inggala',' 654-4126 loc113,654-4823',' 654-4126 loc113,654-4823','jlulanday@pami.ph / jrreyes@pami.ph',329,0,1,0,''),(50,100011,'Chris Rivera','841-4312','841-4312','cvrivera@pdic.gov.ph',330,0,1,0,'IT Head for PC/Laptop/Printer'),(51,100011,'Aldrin Dalisay',' (02) 477 8720',' (02) 477 8720','procurement@proviewglobal.com',331,0,1,0,'Procurement'),(52,100011,'Jon Carino','470-7054','470-7054','N/A',332,0,1,0,'IT OFFICER'),(53,100011,'Sandra Bongay','3677502','3677502','spcckalookan@yahoo.com.ph',333,0,1,0,'Purchasing'),(54,100011,'Dr. Pio S. Ticca','2888274','2888274','hgbafi@yahoo.com',334,0,1,0,'President'),(55,100011,'Fe Fano ','0919-4717810','(02) 705-1797/ 705-1734 loc 1349','fe.fano@banbros.ph',0,14,0,288,'Account Executive'),(56,100012,'Atty. Jeff Marvick de Gulan','09226224409','2934730','jeffdegulan@gmail.com',335,0,1,287,'School Director'),(57,100012,'Ms. Malou Constantino','63 0917 899-7143','632 772-2963','malou.constantino@cinergitech.com',336,0,1,0,'Purchasing Head'),(58,100012,'Ms. Tess','-','(02) 922 0899','-',0,15,0,280,'Sales'),(59,100012,'Ms. Jasmine','-','(02) 903 6232','-',0,16,0,280,'Sales'),(60,100012,'Ms. Vanessa ','-','(02) 522 0915','-',0,17,0,280,'Sales'),(61,100012,'Mr. Aerol','-','(02) 381 1174','-',0,18,0,280,'Sales'),(62,100013,'Atty Jeff Marvick de Gulan','09226224409','2934730','jeffdegulan@gmail.com',337,0,1,287,'School Director'),(63,100013,'Matthew Tizon','-','-','mattizon.mt@gmail.com',338,0,1,0,'Testing'),(64,100013,'Benz','09278893576','09278893576','benjie@ncomputingph.com',0,19,0,287,'CEO'),(65,100013,'Marcus Von Hammer','-','584 9905','marcus@technoworld.com.ph',339,0,1,280,'Test'),(66,100013,'JOY','-','584-0000','-',0,20,0,287,'-'),(67,100013,'Ms. Gen Chua','-','781 0581 to 84','-',0,21,0,280,'-'),(68,100014,'Ms. Charmaine Magtangub','-','921 8100','-',0,22,0,280,'Sales'),(69,100014,'Paulo Vasquez','09358585240','(02) 800-6077 / 398-2326','paulo.vasquez@hino.com.ph',340,0,1,283,'IT Consultant'),(70,100014,'Shaira Mae De Vera','-','(+632) 688-3333 / (+632) 651-9999','sdevera@msi-ecs.com.ph',0,23,0,283,'Sales'),(71,100014,'Gio Formoso','09058917237','890 7516','gio.formoso@mdscsi.com',341,0,1,283,'Purchasing'),(72,100014,'Sharecel','09983771383','-','-',0,24,0,283,'Sales'),(73,100014,'Shaira Mae De Vera','-','-','sdevera@msi-ecs.com.ph',0,25,0,283,'Sales'),(74,100014,'Chona Sitier','09358752677','(083) 554-3173 local (244)','cgsitier@rdcorp.com.ph',342,0,1,283,'Purchasing'),(75,100014,'Ms. Pamela Villanueva','-','671-5611','pamela@technopaq-thakral.com',0,26,0,280,'Sales'),(76,100014,'Ms. Hyd Pulido','-','(632) 858 5555','Hyd Pulido <HPulido@msi-ecs.com.ph>',0,27,0,280,'Sales'),(77,100014,'Cindy Capistrano','09178206414','776-4764 loc 209Â Â Â Â Â Â Â Â ','cindy.capistrano@imvph.com',0,28,0,280,'Sales'),(78,100014,'Ms. Jinky ','09465069188','535-7333 loc 112','-',0,29,0,280,'Sales'),(79,100014,'Arianne Tan ','-','363-7777','yang@millennium.com.ph',0,30,0,280,'Sales'),(80,100014,'Lyn Chan ','0927-8524111','252-5051 to 56 Loc 134','lyn_chan@lenotech.com.ph',0,31,0,280,'Sales'),(81,100014,'Josefa Maranan','-','3187999','josefa.maranan@versatech.com.ph',0,32,0,280,'Sales'),(82,100014,'Ms. Yolly/Ms. Jessa','-','02 5279667; 02 5279668','-',0,33,0,280,'Sales'),(83,100014,'Ms. Janine Suaverdez','63 908 863-4402 ','63 2 621-8619/17 ','Purchasing@ph.lantro.com',343,0,1,280,'Purchasing Officer'),(84,100014,'Jan Torres and Ms. Susaliza Lim','0977-8239233','02)219-3577','susaliza.lim@grabtaxi.com',344,0,1,280,'Procurement Head and Officer'),(85,100014,'Mr. Tito Dimanarig and Mr. Elmer Rivera; Ms. ','09495070314','857-7775','ebrivera@rexpublishing.com',345,0,1,280,'Procurement Officer'),(86,100014,'Paul Antiquin','-','920-5291','purchasing@sysuinc.com.ph',346,0,1,280,'Purchasing Officer'),(87,100014,'Raffy Temblor and Mica Fajardo','09175765402','02) 772-3133','supplychain@cardinalagri.com',347,0,1,280,'Procurement Officer'),(88,100014,'Jerick Mamaed','-','422 6888','-',0,34,0,280,'Sales'),(89,100014,'Kristine Tianes/Rhea','-','724-3340/477-8200 loc 1000','-',0,35,0,280,'Sales'),(90,100014,'Crystal and Rica','-','722-0495 / 723-4279','-',0,36,0,280,'Sales'),(91,100014,'Ms. MJ Laredo','-',' 376-6515 (loc.101) Â ','mjlaredo01@gmail.com',348,0,1,280,'Sales'),(92,100014,'Noel T.','63917-8390170 ','7084324 local 219','noel@jtphotoworld.com',0,37,0,280,'Sales'),(93,100014,'Portillo Ma Guia Grace','-','884-9090','Guia_Portillo@canon.com.ph',0,38,0,280,'Sales'),(94,100014,'Ms. Cris/Ms. Grace','-','(02)633-1624 / (02)633-4986','-',0,39,0,280,'Sales'),(95,100014,'-','-','(046) 477 2873','-',0,40,0,280,'Sales'),(96,100014,'Ms. Marivic Lingat','639255884386','(02) 632 0720','-',0,41,0,280,'Sales'),(97,100014,'Ms. Marien','-','(02) 654 0888 loc 531','-',0,42,0,280,'Sales'),(98,100014,'Jannelle/ Jonas','-','661-4303 to 07 ','-',0,43,0,280,'Sales'),(99,100014,'Ms. Rachelle Dula','-','721-8888','-',0,44,0,280,'Sales'),(100,100014,'Rose Ritual','-','724-7303/725-0690','-',0,45,0,280,'Sales'),(101,100014,'Tony Liao','09123343123','353 2323','tony@nelsoft.com.ph',349,0,1,253,'CEO');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity`
--

DROP TABLE IF EXISTS `entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(120) NOT NULL,
  `Address` varchar(225) NOT NULL,
  `Phone` varchar(120) NOT NULL,
  `Birthdate` datetime DEFAULT '0000-00-00 00:00:00',
  `Username` varchar(120) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Level` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Mark` int(11) NOT NULL,
  `AccountOwner` int(11) NOT NULL DEFAULT '0',
  `IsClient` int(2) NOT NULL DEFAULT '0',
  `IsManager` int(2) NOT NULL DEFAULT '0',
  `TeamID` int(11) NOT NULL DEFAULT '0',
  `Tin` varchar(45) DEFAULT NULL,
  `VatMode` int(11) NOT NULL DEFAULT '1',
  `Client` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=350 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity`
--

LOCK TABLES `entity` WRITE;
/*!40000 ALTER TABLE `entity` DISABLE KEYS */;
INSERT INTO `entity` VALUES (253,'SUPERADMIN','PH','(+63) 0000 000 0000','1970-01-01 00:00:00','superadmin','94077f3953f77316560367e2b54ba721',1,2,1,0,0,0,0,NULL,1,0),(280,'Marilou Panugaling','Reparo St. Brgy. 145 Bagong Barrio Caloocan','09161546964','1991-10-15 00:00:00','mpanugaling@gadgetworkscorp-ph.com','94077f3953f77316560367e2b54ba721',1,1,1,0,0,1,24,NULL,1,0),(281,'Nelsoft Systems Inc','8c 8f Marc 2000 Tower','(02) 363 7237','2017-03-20 00:00:00','support@nelsoft.com.ph','',1,4,1,280,1,0,0,NULL,1,0),(282,'Henderson Blake','Marco Polo Ortigas','334324','2017-03-20 11:55:48','support@hb.com','',1,4,1,253,1,0,0,NULL,1,0),(283,'Johna Burcel','15 Sto. Tomas St., Santolan Pasig City','09262607982','1992-01-21 00:00:00','jburcel@gadgetworkscorp-ph.com','eb819d5c693483cfa19b7fd4f90ba84b',1,1,1,0,0,1,11,NULL,1,0),(284,'Jenifer Lotivio','B1 L12 Sunshineville Talon Dos BFRV Las Piñas','09225391273','1984-05-11 00:00:00','jlotivio@gadgetworkscorp-ph.com','eb819d5c693483cfa19b7fd4f90ba84b',1,1,1,0,0,1,12,NULL,1,0),(285,'Karen Hipolito','Sitio Sampaguita, Calantipe, Apalit, Pampanga','09269989870','1993-05-11 00:00:00','khipolito@gadgetworkscorp-ph.com','eb819d5c693483cfa19b7fd4f90ba84b',1,1,1,0,0,1,14,NULL,1,0),(286,'Judith Retaga','S25 Katarungan St. Bgry. Plainview Mandaluyong City','09262607984','1988-10-26 00:00:00','jretaga@gadgetworkscorp-ph.com','eb819d5c693483cfa19b7fd4f90ba84b',1,1,1,0,0,1,20,NULL,1,0),(287,'Richard Sobrepeña','217 Kabulusan 2 Brgy. 22 6 St., Caloocan City','09175454155','1978-03-07 00:00:00','rsobrepena@gadgetworkscorp-ph.com','eb819d5c693483cfa19b7fd4f90ba84b',1,1,1,0,0,1,16,NULL,1,0),(288,'Precious Jane Sison','16-E Rote St. Rosario, Pasig City','09771756994','1995-07-20 00:00:00','psison@gadgetworkscorp-ph.com','94077f3953f77316560367e2b54ba721',1,1,1,0,0,0,1,NULL,1,0),(289,'Precious Danica Carpio','Sta. Rosa Laguna','0916 651 7667','1986-02-25 00:00:00','pcarpio@gadgetworkscorp-ph.com','eb819d5c693483cfa19b7fd4f90ba84b',1,1,1,0,0,1,17,NULL,1,0),(290,'Katrina Mondero','493 M. Diaz St. Brgy. Pineda Pasig City','09429872819','1997-10-24 00:00:00','kmondero@gadgetworkscorp-ph.com','eb819d5c693483cfa19b7fd4f90ba84b',1,1,1,0,0,0,1,NULL,1,0),(291,' novaSOLUTIONS (PHILIPPINES),INC','Unit A and B 11th Floor, The JMT Corporate Condominium #27 ADB Avenue, Ortigas Center, Pasig City','535 0137 ','2017-04-26 00:00:00','cherrylyn.v@nova-hub.com','',1,4,1,284,1,0,0,'008-257-903',1,0),(292,'Macropharma Corp.','Macropharma Bldg., CW Ortigas Home Depot No. 1 Julia Vargas Ave. Brgy. Ugong Pasig City 1604','63(2) 706-0362 / 63(2) 941-0133','2017-04-27 00:00:00','chris.abadier@gmail.com','',1,4,1,283,1,0,0,'201-981-544',1,0),(293,'Figari Group','Penthouse, W Fifth Bldg. Bonifacio Global City, Taguig City, 1634, Philippines','632 405 51 22','2017-04-27 11:26:19','sales@figarigroup.com','',1,4,1,283,1,0,0,NULL,1,0),(294,'Agata Mining / TVI Resource Devt’ Phils. Inc.','22nd Floor, Equitable Bank Tower 8751 Paseo de Roxas  Makati City','728-8491 Loc. 703','2017-04-27 11:54:14','wesley.tambong@tvird.com.ph','',1,4,1,280,1,0,0,NULL,1,0),(295,'Lantro Philippines Inc.','420-D Francisco F. Legaspi St. Maybunga Pasig','470-2834','2017-04-27 11:57:07','Purchasing@ph.lantro.com','',1,4,1,280,1,0,0,NULL,1,0),(296,'BIBO Global Oppurtunity Inc','Unit 2 17th Floor Tower 6789, Ayala Ave. Makati City','(02) 542 1592','2017-04-27 11:59:20','annerochelle.palentinos@bibo.com.ph','',1,4,1,280,1,0,0,NULL,1,0),(297,'DBP Insurance Brokerage, Incorporated','4th Floor, DBP Head Office Bldg.,   corner Sen. Gil J. Puyat & Makati  Avenues, Makati City, Philippines.  ','(02) 818-9511','2017-05-03 10:18:50','alvin.casanova@asia.lockton.com','',1,4,1,283,1,0,0,NULL,1,0),(298,'Polidario Accountancy','Acacia Malabon City','7485819','2017-05-03 00:00:00','pol_cpa@yahoo.com','',1,4,1,287,1,0,0,NULL,1,0),(299,'University of the East','2219 C.M. Recto Avenue Manila','02-7356976','2017-05-03 12:03:20','vye.montano@magsaysay.com.ph','',1,4,1,287,1,0,0,NULL,1,0),(300,'Taiwan Buddhist Tzuchi Foundation PH','76 Cordillera St. cor Agno Dona Josefa QC','7320001 Loc 304','2017-05-03 00:00:00','ronillo.ylo@tzuchi.org.ph','',1,4,1,287,1,0,0,NULL,1,0),(301,'Rebel Alliance Food Supply Inc./Toby','2314 G/F Whitespace Building Don Chino Roces Ave Extension Makati','987-1761','2017-05-04 00:00:00','arnold.mercado@rebelalliance.ph','',1,4,1,284,1,0,0,NULL,1,0),(302,'First Oceanic Property Management, Inc.','OSG House 102 L.P Leviste St., Salcedo Village, Makati City','317-3670','2017-05-04 16:09:57','contracts2@firstoceanic.com.ph','',1,4,1,284,1,0,0,NULL,1,0),(303,'Taft Property','29F BDO Equitable Tower Paseo de Roxas, Makati City','555-0101','2017-05-04 16:16:34','rsgaw@taftproperty.com.ph','',1,4,1,284,1,0,0,NULL,1,0),(304,'Pascual Laboratories, Inc.','9F Eton Centris Cyberpod One, EDSA cor. Quezon Ave. Brgy. Pinahan, Q.C','230-6899/230-6888','2017-05-04 00:00:00','mamorales@pascuallab.com','',1,4,1,284,1,0,0,'',1,0),(305,'Pilipinas Teleserv Inc.','4/F San Diego Bldg. 462 C. Palanca St. Quiapo Manila','462-6224','2017-05-08 12:32:34','rlasam@teleserv.com.ph','',1,4,1,280,1,0,0,NULL,1,0),(306,'Leo De Jesus','Quezon City','09178711071','1971-10-02 00:00:00','leo.dejesus@gadgetworkscorp-ph.com','eb819d5c693483cfa19b7fd4f90ba84b',1,1,1,0,0,1,22,NULL,1,0),(307,'Accounting GWC','Mandaluyong','833 1883','2015-05-09 00:00:00','accounting@gadgetworkscorp-ph.com','eb819d5c693483cfa19b7fd4f90ba84b',1,1,1,0,0,1,21,NULL,1,0),(308,'Philcopy Corporation','J.P Rizal Makati','353 7237','2017-05-11 09:34:52','support@philcopy.com.ph','',1,4,1,253,1,0,0,'100023232232',2,0),(309,'Integrated Montessori Center','51 Diego Silang Street AFPOVAI Phase 2 Fort Bonifacio, Taguig City','556-2075  556-1269  556-1343','2017-05-11 09:36:44','maeabuan@gamail.com','',1,4,1,286,1,0,0,'',1,0),(310,'Liquigaz Philippines Corporation','3RD Floor NOL Tower, Commerce Avenue Madrigal Business Park, Ayala-Alabang, Muntinlupa City','771 0560','2017-05-11 00:00:00','pgarcia@lquigaz.com','',1,4,1,284,1,0,0,'',1,0),(311,'Metro Parking Management (Phils), Inc.','4th Floor Salustiana D.Ty Tower 104 Paseo De Roxas','752-1056','2017-05-22 11:56:50','N/A','',1,4,1,287,1,0,0,'',1,0),(312,'Metro, Inc. ','La Fuerza Compound, Alabang-Zapote Road, Almanza, Las PiÃ±as City Las PiÃ±as Metro Manila','842-8961 / 772-2633','2017-05-22 00:00:00','bonguyboco@metro.com','',1,4,1,287,1,0,0,'',1,0),(313,'SOLID BUSINESS MACHINES CENTER Inc.','','242-11-11','2017-05-22 12:01:00','sales@solidmac.com.ph','',1,4,1,287,1,0,0,'',1,0),(314,'WORLD VISION','UNIT 1504 ANTEL GLOBAL CORP. CENTER DONA JULIA VARGAS AVE, PASIG CITY','6879061','2017-05-22 14:36:59','maryjane_bobbis@wvi.org','',1,4,1,287,1,0,0,'',1,0),(315,'Reedley International School','Josol Bldg. J Cruz Street Brgy Ugong  E. Rodriguewz Jr. Avenue Pasig City','571-5291 Local 260','2017-05-22 00:00:00','fpangilinan@wriglyschool.com , ris@reedleyschool.com','',1,4,1,287,1,0,0,'',1,0),(316,'Unilever RFM Ice Cream Inc. ','Amang Rodriguez Ave., Manggahan Light Industrial Park, Bo. Manggahan, Pasig City','588-8888 / (02) 645 5011','2017-05-22 14:44:24','girly.delacruz_dion@uniliever.com','',1,4,1,287,1,0,0,'',1,0),(317,'Manila Business College','1671 MBC Bldg Alvarez st Cor M. Hizon St Sta Cruz Manila','7413489','2017-05-22 14:48:10','co.jenny@mbc.edu.ph','',1,4,1,287,1,0,0,'',1,0),(318,'CLC Marketing Ventures','QC','4561405','2017-05-22 00:00:00','Karen Calpo <karen.calpo@gmail.com>','',1,4,1,287,1,0,0,'',1,0),(319,'Versa Print/ TimCorp','Yakal Corner Bacawan San Antonio Village Makati City','857-1846','2017-05-22 14:58:45','Sunshine.siojo@timcorp.ph','',1,4,1,287,1,0,0,'',1,0),(320,'THUNDERBIRD RESORTS','Binangonan, Rizal','651-6888','2017-05-22 15:00:53','kmaquinana@thunderbird-asia.com','',1,4,1,287,1,0,0,'',1,0),(321,'The Maritime Training Center of the Philippines','3rd flr. G.E. Antonio Bldg. TM Kalaw cor J. Bocobo St. Ermita Manila','536-7629 / (02) 526 6740','2017-05-22 15:02:28','jp_monforte@yahoo.com','',1,4,1,287,1,0,0,'',1,0),(322,'Sykes Asia, Incorporated ','25F Robinsons Summit Center, 6783 Ayala Avenue ','632 849 1575, 63906 2431 350','2017-05-22 15:04:36','erwin.gustilo@sykes.com','',1,4,1,287,1,0,0,'',1,0),(323,'The Bayleaf Hotel','Muralla St. Intramuros Manila','3185000','2017-05-22 15:06:13','julian.lilio@thebayleaf.com.ph','',1,4,1,287,1,0,0,'',1,0),(324,'Nesic Philippines Inc.','Legaspi, Makati, 1229 Metro Manila','892-4831','2017-05-22 15:08:13','purchasing@nesic.com.ph','',1,4,1,287,1,0,0,'',1,0),(325,'NetworkLabs, Inc.','Bldg. 1 UP Ayala Land Technohub Commonwealth Ave. Brgy UP Campus QC','217-1676','2017-05-22 15:10:04','ruel.roque.ext@nsn.com','',1,4,1,287,1,0,0,'',1,0),(326,'New Simulator Center of the Philippines Inc.','2323 Marconi St., San Isidro Makati City','843-2864','2017-05-22 15:11:51','loradee. manila@newsim.ph','',1,4,1,287,1,0,0,'',1,0),(327,'New Simulator Center of the Philippines Inc.','2323 Marconi St., San Isidro Makati City','843-2864','2017-05-22 15:19:11','loradee. manila@newsim.ph','',1,4,1,287,1,0,0,'',1,0),(328,'New World Hotel Makati','A. Arnaiz Ave., Makati City','811-6888','2017-05-22 15:20:37','joy.gasmen@newworldhotels.com','',1,4,1,287,1,0,0,'',1,0),(329,'Passenger Accident Management and Insurance Agency, Inc.','2402-2403 One Corporate Center Dona Julia Vargas corner Meralco Avenue,Ortigas Center, Ortigas, Pasig City, 1600 PhilippinesÂ ',' 654-4126 loc113,654-4823','2017-05-22 15:22:07','jlulanday@pami.ph / jrreyes@pami.ph','',1,4,1,287,1,0,0,'',1,0),(330,'PDIC','6th Flr. SSS Bldg. Ayala Ave. Makati City','841-4312','2017-05-22 15:23:43','cvrivera@pdic.gov.ph','',1,4,1,287,1,0,0,'',1,0),(331,'Proview Global Philippines','U101 Hanston Sq#17 San Miguel, Ortigas',' (02) 477 8720','2017-05-22 15:25:02','procurement@proviewglobal.com','',1,4,1,287,1,0,0,'',1,0),(332,'PSG ASIA','Unit 2208 Jollibee Plaza F. Ortigas Road,Ortigas Center','470-7054','2017-05-22 15:26:35','N/A','',1,4,1,287,1,0,0,'',1,0),(333,'System Plus Computer College','141-143  6th and 7th Sts., 10th Ave. Caloocan City','3677502','2017-05-22 15:30:19','spcckalookan@yahoo.com','',1,4,1,287,1,0,0,'',1,0),(334,'Higher Ground Baptist Aca Fdn Inc','','2888274','2017-05-22 15:32:42','hgbafi@yahoo.com','',1,4,1,287,1,0,0,'',1,0),(335,'Probex School Inc','113 M. H Del Pilar St Santulan Malabon City','2934730','2017-06-02 00:00:00','jeffdegulan@gmail.com','',1,4,1,287,1,0,0,'o',1,0),(336,'CiNERGi Industrial Solutions, Inc.','G/F Hamilton Centre 9598 Kamagong St. San Antonio Village Makati','632 772-2963; 506-9227','2017-06-02 14:58:12','malou.constantino@cinergitech.com','',1,4,1,280,1,0,0,'008-440-732-000',1,0),(337,'Probex School  Inc','113 M H Del Pilar Santulan Malabon City','2934730','2017-06-02 15:46:40','jeffdegulan@gmail.com','',1,4,1,287,1,0,0,'0',1,0),(338,'Testing ','123 Dest C','1233443','2017-06-02 15:56:26','matt.nelsoft@gmail.com','',1,4,1,253,1,0,0,'-',1,0),(339,'Testign','Manila City','584 9905','2017-06-02 16:44:57','matt.nelsoft@gmail.com','',1,4,1,280,1,0,0,'-',1,0),(340,'Subic GS Auto Inc. ','4998 Ninoy Aquino Ave, ParaÃ±aque, Metro Manila','(02) 800-6077 / 398-2326','2017-06-05 00:00:00','paulo.vasquez@hino.com.ph','',1,4,1,283,1,0,0,'007-330-309-000',1,0),(341,'MDS Call Solutions, Inc.					','2F BJS Bldg. 1869 P. Domingo St. Brgy. Kasilawan, Makati City','890 7516','2017-06-05 15:30:08','gio.formoso@mdscsi.com','',1,4,1,283,1,0,0,'006-892-608	',1,0),(342,'RD Corp.','1st Road Calumpang, General Santos City, 9500','(083) 554-3173 local (244)','2017-06-13 00:00:00','jmvcruz@rdcorp.com.ph','',1,4,1,283,1,0,0,'005-257-867',1,0),(343,'LanTro Phils. Inc.','420 Unit D, F. Legaspi St, Maybunga, Pasig City','63 2 621-8619/17 ','2017-06-19 10:19:41','Purchasing@ph.lantro.com','',1,4,1,280,1,0,0,' 202-950-644-000',1,0),(344,'Grab Company','2251 12Th Floor, Wilcon IT Hub. Chino Roces Ave. cor EDSA, Makati City','02)219-3577','2017-06-19 10:25:41','Jan.Torres@Grab.co','',1,4,1,280,1,0,0,'-',1,0),(345,'Rex Printing Company Inc','84 p flerinto st. Sta Mesa QC Landmark: Between banawe and Biak Bato ',' 857-7775','2017-06-19 10:36:03','tsdimanarig@rexpublishing.com.ph ','',1,4,1,280,1,0,0,'-',1,0),(346,'SYSU Group of Companies/ McCormick Phils. Inc.','G/F SYSU Centre 145 panay ave. Q,C','920-5291','2017-06-19 10:39:14','purchasing@sysuinc.com.ph','',1,4,1,280,1,0,0,'-',1,0),(347,'CARDINAL AGRI PRODUCTS, INC.','7/F Sagittarius Building  111 H.V. Dela Costa Street, Salcedo Village  Makati City','02) 772-3133','2017-06-19 10:45:13','supplychain@cardinalagri.com','',1,4,1,280,1,0,0,'-',1,0),(348,'Naturale Labs, Inc.','73 Scout Fernandez St., Brgy. Laging Handa, QC',' 376-6515 (loc.101) Â ','2017-06-19 14:11:23','mjlaredo01@gmail.com','',1,4,1,280,1,0,0,'-',1,0),(349,'Nelsoft Systems Inc','Marc 2000 Tower Manila','353 3232','2017-07-02 14:39:06','support@nelsoft.com.ph','',1,4,1,253,1,0,0,'123 231 123 2322',1,0);
/*!40000 ALTER TABLE `entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(120) NOT NULL,
  `Category` varchar(120) DEFAULT '',
  `Subcategory` varchar(120) DEFAULT '',
  `Description` varchar(500) DEFAULT '',
  `Weight` decimal(10,2) DEFAULT '0.00',
  `Buy` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Sell` decimal(10,2) DEFAULT '0.00',
  `Mark` int(11) DEFAULT '0',
  `Code` varchar(120) DEFAULT '',
  `SupplierID` int(11) DEFAULT '0',
  `Brand` varchar(120) DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (4,'Digital Persona Biometrics','6','','\" URU4500 Digital Persona URU Fingerprint Reader for IN/OUT  - PC Based -     Unlimited Fingerprint Templates    Unlimited Transaction Records    USB Connection / Fingerprint   FREE Time and Attendance Software (DTR)\"',0.00,23000.00,0.00,1,'BD000',9,'5'),(5,'ST1000DM010','4','','1TB 7200RPM 64MB Hard Drive',0.00,2350.00,0.00,1,'0',9,'3'),(6,'kt200232','4','','Kingston SUV400S37/120GB 120GB 2.5 Solid State Drive',0.00,2900.00,0.00,2,'0',10,'4'),(7,'SUV400S37','4','','Kingston SUV400S37/120GB 120GB 2.5 Solid State Drive',0.00,2900.00,0.00,1,'0',13,'4'),(8,'','2','','Test',45.50,54326.00,0.00,1,'',10,'3'),(9,'','1','','',0.00,0.00,0.00,2,'',14,'1'),(10,'0000026527','4','','Intel I7-7700 3.6GHZ 8MB CPU',0.00,14900.00,0.00,1,'-',10,'8'),(11,'SeagateHDD','4','','Seagate 1TB Hard Disk Drive for Internal Desktop',0.00,2350.00,0.00,1,'-',10,'3'),(12,'SeagateHDD','4','','Seagate 1TB Hard Disk Drive for Internal Desktop',0.00,2350.00,0.00,-1,'-',10,'3'),(13,'XHX421C14FB2/8','4','','XHX421C14FB2/8 kingston  8GB 2133mhz DDR4 Fury X',0.00,3300.00,0.00,1,'-',15,'4'),(14,'ThermaltakeSSE','4','','Thermaltake Smart SE 730W 87% Efficiency APFC Semi-Modular Power Supply',0.00,3300.00,0.00,1,'-',15,'9'),(15,'CA-1C1-00M1WN-00','4','','CA-1C1-00M1WN-00 Thermaltake Versa H24 Windowed ATX Mid-Tower Case',0.00,2116.00,0.00,1,'-',18,'9'),(16,' FQC-08289','9','',' Microsoft FQC-08289 Windows 7 Professional SP1 64-Bit OEM with Sealed',0.00,5000.00,0.00,1,'-',16,'10'),(17,'RX480','1','','Radeon RX 480 8gb DDR5 Video Card',0.00,15000.00,0.00,1,'-',13,'11'),(18,'mk220','4','','Logitech mk220  wireless Keyboard & Mouse   ',0.00,950.00,0.00,1,'-',10,'12'),(19,'L300','2','','N-Computing L300 Series',0.00,6500.00,0.00,1,'-',19,'13'),(20,'DES1024A','13','','DES 1024A 10/100 Switch HUB 24 Port Switch D-Link',0.00,19000.00,0.00,1,'-',20,'14'),(21,'Cable','13','','Belden Cat5E',0.00,4700.00,0.00,1,'-',20,'15'),(22,'RJ45','13','','RJ 45 100pcs',0.00,200.00,0.00,1,'-',22,'16'),(23,'INFOCUS IN112X 3200','1','','INFOCUS IN112X 3200 ANSI LUMENS PROJECTOR WITH BAG',0.00,17.00,0.00,2,'0',23,'1'),(24,'INFOCUS IN112X 3200','1','','INFOCUS IN112X 3200 ANSI LUMENS PROJECTOR WITH BAG',0.00,17.00,0.00,1,'0',23,'1'),(25,'URU4500 Digital Persona','1','','URU4500 Digital Persona',0.00,4.00,0.00,1,'-',24,'1'),(26,'SM-G955 Samsung Galaxy S8+','1','','SM-G955 Samsung Galaxy S8+',0.00,0.00,0.00,2,'151',23,'1'),(27,'SM-G955 Samsung Galaxy S8+','1','','SM-G955 Samsung Galaxy S8+',0.00,41.00,0.00,2,'151',23,'1'),(28,'ZOTAC ZBOX-CI323NANO','2','','ZOTAC ZBOX-CI323NANO-U Zbox Nano SFF, Mini PC',0.00,8.00,0.00,1,'0',37,'1');
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Message` varchar(1000) NOT NULL,
  `Type` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'Welcome to new <strong>Gadget Works Corporation </strong> system',3),(2,'<br>Start by: <br>(1) Add your client and contact person <br>(2) Add supplier of the item <br> (3) Record item under nego.<br> (4) Create Sales Order <br><br>Note:use the shortcuts keys or navigate on the menu',3);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `particular`
--

DROP TABLE IF EXISTS `particular`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `particular` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Transaction` int(11) NOT NULL,
  `Inventory` int(11) NOT NULL,
  `Type` int(11) NOT NULL COMMENT '1 for buy, 2 for borrow, 3 for sell',
  `Amount` decimal(10,2) NOT NULL,
  `Mark` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `particular`
--

LOCK TABLES `particular` WRITE;
/*!40000 ALTER TABLE `particular` DISABLE KEYS */;
INSERT INTO `particular` VALUES (4,1,4,1,24000.00,1),(5,3,0,1,90000.00,2),(6,7,5,1,2350.00,1),(7,8,6,1,2900.00,2),(8,24,7,1,2900.00,1),(9,32,8,1,54326.00,1),(10,34,9,1,0.00,2),(11,35,10,1,14900.00,1),(12,35,11,1,2350.00,1),(13,35,12,1,2350.00,-1),(14,37,13,1,3300.00,1),(15,37,14,1,3300.00,1),(16,38,15,1,2116.00,1),(17,39,16,1,5000.00,1),(18,40,17,1,15000.00,1),(19,41,18,1,950.00,1),(20,42,19,1,6500.00,1),(21,43,20,1,1900.00,1),(22,45,21,1,4700.00,1),(23,46,22,1,200.00,1),(24,51,23,1,17.00,2),(25,53,24,1,17.00,1),(26,54,25,1,4.00,1),(27,58,26,1,0.00,2),(28,58,27,1,41.00,2),(29,61,28,1,840000.00,1);
/*!40000 ALTER TABLE `particular` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `particular_activity`
--

DROP TABLE IF EXISTS `particular_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `particular_activity` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Activity` int(11) NOT NULL,
  `Details` int(11) NOT NULL,
  `Type` int(11) NOT NULL COMMENT '1 for buy, 2 for borrow, 3 for sell',
  `Amount` decimal(10,2) NOT NULL,
  `Mark` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `particular_activity`
--

LOCK TABLES `particular_activity` WRITE;
/*!40000 ALTER TABLE `particular_activity` DISABLE KEYS */;
INSERT INTO `particular_activity` VALUES (1,3,1,1,0.00,1),(2,13,2,1,0.00,1),(3,14,3,1,0.00,-1),(4,15,4,1,0.00,2),(5,16,5,1,0.00,1),(6,7,6,1,0.00,2),(7,7,7,1,0.00,2);
/*!40000 ALTER TABLE `particular_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `particular_activty`
--

DROP TABLE IF EXISTS `particular_activty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `particular_activty` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Transaction` int(11) NOT NULL,
  `Details` int(11) NOT NULL,
  `Type` int(11) NOT NULL COMMENT '1 for buy, 2 for borrow, 3 for sell',
  `Amount` decimal(10,2) NOT NULL,
  `Mark` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `particular_activty`
--

LOCK TABLES `particular_activty` WRITE;
/*!40000 ALTER TABLE `particular_activty` DISABLE KEYS */;
/*!40000 ALTER TABLE `particular_activty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `particular_sales`
--

DROP TABLE IF EXISTS `particular_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `particular_sales` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Sales` int(11) NOT NULL DEFAULT '0',
  `Details` int(11) NOT NULL DEFAULT '0',
  `Type` int(11) NOT NULL DEFAULT '0',
  `Amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Mark` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `particular_sales`
--

LOCK TABLES `particular_sales` WRITE;
/*!40000 ALTER TABLE `particular_sales` DISABLE KEYS */;
INSERT INTO `particular_sales` VALUES (1,1,1,1,10000.00,1),(2,3,2,1,100000.00,1),(3,4,3,1,10000.00,1),(4,5,4,1,5000.00,1),(5,6,5,1,100000.00,1),(6,6,6,1,50000.00,1),(7,8,7,1,10000.00,1),(8,9,8,1,150000.00,1),(9,10,9,1,100000.00,1),(10,11,10,1,90000.00,1),(11,12,11,1,100000.00,1),(12,13,12,1,100000.00,1),(13,13,13,1,60000.00,1),(14,13,14,1,15000.00,1),(15,7,15,1,10000.00,1),(16,21,16,1,7500.00,1),(17,24,17,1,15000.00,2),(18,25,18,1,15000.00,2);
/*!40000 ALTER TABLE `particular_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` int(11) NOT NULL COMMENT '1 for cash, 2 for check',
  `Date` datetime DEFAULT '0000-00-00 00:00:00',
  `Amount` decimal(10,2) DEFAULT NULL,
  `CBank` varchar(60) DEFAULT '',
  `CDate` datetime DEFAULT '0000-00-00 00:00:00',
  `Client` int(11) DEFAULT '0',
  `SID` int(11) DEFAULT '0',
  `Mark` int(11) DEFAULT '0',
  `CNum` varchar(60) DEFAULT '',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,1,'2017-05-22 16:17:01',90000.00,'','0000-00-00 00:00:00',281,0,1,''),(2,1,'2017-08-27 18:18:00',1000.99,'','0000-00-00 00:00:00',281,1,1,'');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_terms`
--

DROP TABLE IF EXISTS `payment_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_terms` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL DEFAULT '',
  `Days` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_terms`
--

LOCK TABLES `payment_terms` WRITE;
/*!40000 ALTER TABLE `payment_terms` DISABLE KEYS */;
INSERT INTO `payment_terms` VALUES (1,' COD - Cash On Delivery',1),(2,'30 Days PDC',30),(3,'15 Days PDC',15),(4,'7 Days PDC',7);
/*!40000 ALTER TABLE `payment_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_detail`
--

DROP TABLE IF EXISTS `purchase_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_detail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `HeadID` int(11) NOT NULL DEFAULT '0',
  `InventoryID` int(11) NOT NULL DEFAULT '0',
  `Qty` int(11) NOT NULL DEFAULT '0',
  `ItemRemarks` varchar(45) NOT NULL DEFAULT '',
  `Mark` int(11) NOT NULL DEFAULT '0',
  `PurchaseCost` decimal(11,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_detail`
--

LOCK TABLES `purchase_detail` WRITE;
/*!40000 ALTER TABLE `purchase_detail` DISABLE KEYS */;
INSERT INTO `purchase_detail` VALUES (1,1,15,3,'',1,2116.00),(2,2,21,4,'',1,4700.00),(3,3,25,3,'',1,4.00),(4,4,20,5,'',1,19000.00);
/*!40000 ALTER TABLE `purchase_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_head`
--

DROP TABLE IF EXISTS `purchase_head`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_head` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SalesOrderID` int(11) NOT NULL DEFAULT '0',
  `Source` int(11) NOT NULL DEFAULT '0',
  `Destination` int(11) NOT NULL DEFAULT '0',
  `Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Mark` int(11) NOT NULL DEFAULT '0',
  `Creator` int(11) NOT NULL DEFAULT '0',
  `Type` int(11) NOT NULL DEFAULT '0',
  `DeliveryDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TermID` int(11) NOT NULL DEFAULT '0',
  `ContactID` int(11) NOT NULL DEFAULT '0',
  `Status` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_head`
--

LOCK TABLES `purchase_head` WRITE;
/*!40000 ALTER TABLE `purchase_head` DISABLE KEYS */;
INSERT INTO `purchase_head` VALUES (1,13,253,18,'2017-08-27 15:58:11',1,253,1,'0000-00-00 00:00:00',0,0,0),(2,13,253,20,'2017-08-27 15:58:11',1,253,1,'0000-00-00 00:00:00',0,0,0),(3,13,253,24,'2017-08-27 15:58:11',1,253,1,'0000-00-00 00:00:00',0,0,0),(4,12,253,20,'2017-08-27 17:23:31',1,253,1,'0000-00-00 00:00:00',0,0,0);
/*!40000 ALTER TABLE `purchase_head` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_detail`
--

DROP TABLE IF EXISTS `sales_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_detail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `HeadID` int(11) NOT NULL DEFAULT '0',
  `InventoryID` int(11) NOT NULL DEFAULT '0',
  `Qty` int(11) NOT NULL DEFAULT '0',
  `ItemRemarks` varchar(45) NOT NULL DEFAULT '',
  `Mark` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_detail`
--

LOCK TABLES `sales_detail` WRITE;
/*!40000 ALTER TABLE `sales_detail` DISABLE KEYS */;
INSERT INTO `sales_detail` VALUES (1,1,4,3,'None',1),(2,3,15,3,'None',1),(3,4,20,3,'None',1),(4,5,4,3,'None',1),(5,6,19,3,'None',1),(6,6,24,2,'None',1),(7,8,4,100,'None',1),(8,9,4,10,'None',1),(9,10,4,10,'None',1),(10,11,19,10,'None',1),(11,12,20,5,'None',1),(12,13,15,3,'None',1),(13,13,21,4,'None',1),(14,13,25,3,'None',1),(15,7,19,3,'None',1),(16,21,11,3,'None',1),(17,24,17,3,'None',1),(18,25,8,3,'None',1);
/*!40000 ALTER TABLE `sales_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_head`
--

DROP TABLE IF EXISTS `sales_head`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_head` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Reference` bigint(22) NOT NULL DEFAULT '0',
  `Source` int(11) NOT NULL DEFAULT '0',
  `Destination` int(11) NOT NULL DEFAULT '0',
  `Comment` varchar(45) NOT NULL DEFAULT '',
  `Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Mark` int(11) NOT NULL DEFAULT '0',
  `Creator` int(11) NOT NULL DEFAULT '0',
  `Type` int(11) NOT NULL DEFAULT '0',
  `DeliveryDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TermID` int(11) NOT NULL DEFAULT '1',
  `ContactID` int(11) NOT NULL DEFAULT '1',
  `Approved` int(1) NOT NULL DEFAULT '0',
  `ManagerApproval` int(11) NOT NULL DEFAULT '0',
  `SecondaryApproval` int(11) NOT NULL DEFAULT '0',
  `DeliveryCharge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `BDF` decimal(10,2) NOT NULL DEFAULT '0.00',
  `AccountingApproval` int(11) NOT NULL DEFAULT '0',
  `Status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_head`
--

LOCK TABLES `sales_head` WRITE;
/*!40000 ALTER TABLE `sales_head` DISABLE KEYS */;
INSERT INTO `sales_head` VALUES (1,1,253,349,'Testing','2017-07-02 14:42:57',1,253,1,'2017-07-02 00:00:00',2,101,0,0,0,0.00,0.00,0,0),(2,2,253,338,'','2017-07-02 14:46:28',2,253,1,'2017-07-02 00:00:00',1,101,0,0,0,0.00,0.00,0,0),(3,3,253,282,'','2017-07-03 08:01:02',1,253,1,'2017-07-03 00:00:00',1,101,0,0,0,0.00,0.00,0,0),(4,4,253,0,'','2017-07-04 10:25:56',1,253,1,'2017-07-04 10:25:56',1,1,0,0,0,0.00,0.00,0,0),(5,5,253,282,'','2017-07-04 10:27:12',1,253,1,'2017-07-04 00:00:00',1,101,0,0,0,0.00,0.00,0,0),(6,6,253,282,'Testing ','2017-07-04 13:21:56',2,253,1,'2017-07-04 00:00:00',1,101,0,0,0,1000.00,1000.00,0,0),(7,7,253,308,'','2017-07-04 16:16:19',1,253,1,'2017-07-04 00:00:00',1,101,0,0,0,0.00,0.00,0,0),(8,8,253,0,'','2017-07-04 16:17:23',1,253,1,'2017-07-04 16:17:23',1,1,0,0,0,0.00,0.00,0,0),(9,9,253,0,'','2017-07-04 16:18:25',1,253,1,'2017-07-04 16:18:25',1,1,0,0,0,0.00,0.00,0,0),(10,10,253,282,'','2017-07-04 16:19:56',1,253,1,'2017-07-04 00:00:00',1,101,0,0,0,0.00,0.00,0,0),(11,11,253,282,'','2017-07-04 16:20:28',1,253,1,'2017-07-21 00:00:00',1,101,1,0,253,1000.00,0.00,0,0),(12,12,253,282,'','2017-07-04 16:34:15',1,253,1,'2017-07-04 00:00:00',1,101,1,253,253,10000.00,0.00,0,1),(13,13,253,282,'','2017-07-07 07:08:06',1,253,1,'2017-07-07 00:00:00',1,101,1,253,253,0.00,0.00,0,1),(14,14,253,0,'','2017-08-26 11:24:50',-1,253,1,'2017-08-26 11:24:50',1,1,0,0,0,0.00,0.00,0,0),(15,15,253,0,'','2017-08-26 11:33:42',-1,253,1,'2017-08-26 11:33:42',1,1,0,0,0,0.00,0.00,0,0),(16,16,253,0,'','2017-08-26 11:35:27',-1,253,1,'2017-08-26 11:35:27',1,1,0,0,0,0.00,0.00,0,0),(17,17,253,0,'','2017-08-26 11:36:56',-1,253,1,'2017-08-26 11:36:56',1,1,0,0,0,0.00,0.00,0,0),(18,18,253,0,'','2017-08-26 11:38:51',-1,253,1,'2017-08-26 11:38:51',1,1,0,0,0,0.00,0.00,0,0),(19,19,253,0,'','2017-08-26 12:15:21',-1,253,1,'2017-08-26 12:15:21',1,1,0,0,0,0.00,0.00,0,0),(20,20,253,282,'','2017-08-27 18:00:51',-1,253,1,'2017-08-27 00:00:00',1,101,0,0,0,0.00,0.00,0,0),(21,21,253,308,'','2017-08-31 10:12:24',1,253,1,'2017-08-31 00:00:00',2,101,0,0,0,0.00,0.00,0,0),(22,22,253,0,'','2017-08-31 10:18:47',-1,253,1,'2017-08-31 10:18:47',1,1,0,0,0,0.00,0.00,0,0),(23,23,253,0,'','2017-08-31 10:22:29',-1,253,1,'2017-08-31 10:22:29',1,1,0,0,0,0.00,0.00,0,0),(24,24,253,0,'','2017-08-31 10:24:20',-1,253,1,'2017-08-31 10:24:20',1,1,0,0,0,0.00,0.00,0,0),(25,25,253,0,'','2017-08-31 10:30:28',-1,253,1,'2017-08-31 10:30:28',1,1,0,0,0,0.00,0.00,0,0);
/*!40000 ALTER TABLE `sales_head` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(120) NOT NULL,
  `Address` varchar(225) NOT NULL,
  `Phone` varchar(120) NOT NULL,
  `Birthdate` datetime DEFAULT '0000-00-00 00:00:00',
  `Username` varchar(120) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Level` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `Mark` int(11) NOT NULL,
  `Tin` varchar(45) DEFAULT NULL,
  `VatMode` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (9,'MCS','Marco Polo, Ortigas','02 363 2222','2017-03-20 11:01:41','suppor@mcs.com.ph','supplieronly',1,1,1,NULL,1),(10,'Infoworx inc ','E Rodriguez Sr. Ave, Quezon City','7277633','2017-05-09 11:50:52','0','supplieronly',1,1,1,NULL,1),(11,'PC EXPRESS','UNIT 44 SM MEGAMALL BLDG B, Epifanio de los Santos Ave, Mandaluyong','584 9905','2017-05-09 13:09:47','0','supplieronly',1,1,1,NULL,1),(12,'Vinea Distribution Inc','47 Kamias Road, Barangay Pinyahan, Quezon City   ','7050-834       ','2017-05-09 13:18:02','sheila@vdidistribution.com','supplieronly',1,1,1,NULL,1),(13,'PC EXPRESS','UNIT 44 SM MEGAMALL BLDG B, Epifanio de los Santos Ave, Mandaluyong,','584 9905','2017-05-09 13:55:21','0','supplieronly',1,1,1,NULL,1),(14,'Banbros Commercial Inc.',' # 32 Pilar cor. Araullo Aditional Hills, San Juan, Metro Manila, Manila, Metro Manila','(02) 727-3009/7182808','2017-05-23 17:20:14','fe.fano@banbros.ph','supplieronly',1,1,1,'005-028-570-000',1),(15,'Technoline','29, Sct. Gandia Street, Quezon City,','(02) 922 0899','2017-06-02 15:03:16','-','supplieronly',1,1,1,'-',1),(16,'hardcom computer system company','Cityland Pioneer, 128 Pioneer St, Highway Hills, Mandaluyong','(02) 903 6232','2017-06-02 15:08:54','-','supplieronly',1,1,1,'-',1),(17,'Dynaquest PC Sales','EspaÃ±a corner Dos Castillas Street, 1581 EspaÃ±a Blvd, Sampaloc, Manila','(02) 522 0915','2017-06-02 15:10:47','-','supplieronly',1,1,1,'-',1),(18,'Nanotec Corporation','42 Ilang-Ilang Street, Dona Manuela Subdivision, Las Pinas','(02) 381 1174','2017-06-02 15:15:30','-','supplieronly',1,1,1,'-',1),(19,'N Computing Ph','Ortigas','09278893576','2017-06-02 16:23:00','benjie@ncomputingph.com','supplieronly',1,1,1,'',1),(20,'American Technologies Inc','-','584-0000','2017-06-02 17:03:56','-','supplieronly',1,1,1,'',1),(21,'Bridge','Metro Manila','781 0581 to 84','2017-06-02 17:07:18','gen_chua','supplieronly',1,1,1,'-',1),(22,'Grand Force Marketing','Grace Park Caloocan City','921 8100','2017-06-02 17:35:13','-','supplieronly',1,1,1,'-',1),(23,'MSI-ECS Phils.','MSI-ECS COMPLEX, M. Eusebio Avenue San Miguel, Pasig City, Metro Manila, Philippines 1600','	 (+632) 688-3333 / (+632) 651-9999','2017-06-05 14:30:12','sdevera@msi-ecs.com.ph','supplieronly',1,1,1,'-',1),(24,'VDI Distribution','47 Kamias Rd, Diliman, Quezon City','705 0834','2017-06-05 16:00:42','-','supplieronly',1,1,1,'-',1),(25,'MSI-ECS Phils.','MSI-ECS COMPLEX, M. Eusebio Avenue San Miguel, Pasig City, Metro Manila, Philippines 1600','63(2) 706-0362 / 63(2) 941-0133','2017-06-05 16:58:12','-','supplieronly',1,1,1,'-',1),(26,'Technopaq Incorporated','2/F Astron Bldg Eulogio Rodriguez Jr. Ave, Pasig','671-5611','2017-06-19 09:11:09','pamela@technopaq-thakral.com','supplieronly',1,1,1,'-',1),(27,'Wordtext Systems, Inc','WSI Corporate Center, 1005 Metropolitan Avenue, Corner Kakarong Street, Santa Cruz, Makati, ','(632) 858 5555','2017-06-19 09:19:25','HPulido@msi-ecs.com.ph','supplieronly',1,1,1,'-',1),(28,'International Microvillage','1169 Chino Roces Ave, Makati, 1203 Metro Manila','776-4764 loc 209Â Â Â Â Â Â Â Â ','2017-06-19 09:24:13','cindy.capistrano@imvph.com','supplieronly',1,1,1,'-',1),(29,'Mustard Seed System Corporation','Mustard Seed Corporate Center No. 47 , Kamias Road, Brgy. Pinyahan, Quezon City','535-7333 loc 112','2017-06-19 09:32:20','-','supplieronly',1,1,1,'-',1),(30,'Millennium Computer Tech. Corp.','#53 Tangali St. San Jose QC','363-7777','2017-06-19 09:51:51','yang@millennium.com.ph','supplieronly',1,1,1,'-',1),(31,'Lenotech Corporationâ€Ž','3453, V. Mapa Street, Sta Mesa, Manila, 1016 Metro Manila','2525051 to 56','2017-06-19 09:57:26','lyn_chan@lenotech.com.ph','supplieronly',1,1,1,'-',1),(32,'Versatech International','1803 East Tower, Philippine Stock Exchange Exchange Rd. Ortigas, Pasig City ','3187999','2017-06-19 10:02:17','josefa.maranan@versatech.com.ph','supplieronly',1,1,1,'-',1),(33,'Istudio-SM-Manila','SM. Manila, Concepcion Cor Arroceros & San Marcelino, Ermita, Manila, ','02 5279667 02 5279668','2017-06-19 10:05:57','-','supplieronly',1,1,1,'-',1),(34,'MEC Networks Corporation','307 P. Tuazon Blvd. Corner 21st St., Quezon City,','422 6888','2017-06-19 13:47:28','-','supplieronly',1,1,1,'-',1),(35,'Iontech Incorporated','Lee Street, Mandaluyong,','724-3340/477-8200 loc 1000','2017-06-19 13:56:13','-','supplieronly',1,1,1,'-',1),(36,'Innovista Technologies, Inc.','4th Floor, ATCO Bldg, 137 Aurora Blvd QC','722-0495 / 723-4279','2017-06-19 14:05:49','-','supplieronly',1,1,1,'-',1),(37,' JT Photoworld','1434 General Luna St., Paco, Manila','7084324 local 219','2017-06-19 15:24:44','noel@jtphotoworld.com','supplieronly',1,1,1,'-',1),(38,'Canon Philippines','Warehouse no. 6, Km 19 Sabrina Compound, West Service Road, Sucat ParaÃ±aque City','884-9090','2017-06-19 15:37:57','Guia_Portillo@canon.com.ph','supplieronly',1,1,1,'-',1),(39,'Electroworld Megamall','Cyberzone, SM Megamall Building B, EDSA Cor DoÃ±a Julia Vargas Ave, Ortigas Center, Mandaluyong,','(02)633-1624 / (02)633-4986','2017-06-19 15:41:09','-','supplieronly',1,1,1,'-',1),(40,'cavitech solution inc','360, Molino Road, Molino III, Bacoor, 4102 Cavite','(046) 477 2873','2017-06-19 15:43:24','-','supplieronly',1,1,1,'-',1),(41,'Gigaworkz Technologies Inc.','Suite 815, Bldg., Ortigas Pasig City, Philippines, Ortigas Ave, Pasig,','(02) 632 0720','2017-06-19 15:46:13','-','supplieronly',1,1,1,'-',1),(42,'goldtech international distribution inc','268 N Domingo St, San Juan, 1500 Metro Manila','(02) 654 0888 loc 531','2017-06-19 16:10:08','-','supplieronly',1,1,1,'-',1),(43,'Touchstream Digital, Inc.','tlanta Centre Building, 31 Annapolis, San Juan, ','661-4303 to 07 ','2017-06-19 16:14:33','-','supplieronly',1,1,1,'-',1),(44,'Ubertech, Inc.','35 1st St, Quezon City,','721-8888','2017-06-19 16:16:54','-','supplieronly',1,1,1,'-',1),(45,'Techtron Systems, Inc.',' Room 306, Quadstar Building, 80 Ortigas Avenue, Greenhills, San Juan City,','724-7303/725-0690','2017-06-19 16:20:33','-','supplieronly',1,1,1,'-',1);
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_brand`
--

DROP TABLE IF EXISTS `supplier_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_brand` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SupplierID` int(11) NOT NULL DEFAULT '1',
  `BrandID` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_brand`
--

LOCK TABLES `supplier_brand` WRITE;
/*!40000 ALTER TABLE `supplier_brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL DEFAULT '',
  `ManagerID` int(11) NOT NULL DEFAULT '0',
  `Active` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'None',0,1),(6,'Matthew Tizon',278,0),(7,'Matthew Tizon',278,1),(8,'Marilou Panugaing',280,0),(9,'Marilou Panugaing',280,0),(10,'Marilou Panugaing',280,0),(11,'Johna Burcel',283,1),(12,'Marilou Panugaling',280,0),(13,'Jenifer Lotivio',284,0),(14,'Karen Hipolito',285,1),(15,'Judith Retaga',286,0),(16,'Richard Sobrepeña',287,1),(17,'Precious Danica Carpio',289,1),(18,'Leo De Jesus',306,0),(19,'Accounting GWC',307,0),(20,'Judith Retaga',286,1),(21,'Accounting GWC',307,1),(22,'Leo De Jesus',306,1),(23,'Marilou Panugaling',280,0),(24,'Marilou Panugaling',280,1);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Reference` varchar(60) NOT NULL,
  `Source` int(11) NOT NULL,
  `Destination` int(11) NOT NULL,
  `Comment` varchar(1000) NOT NULL,
  `Date` datetime NOT NULL,
  `Mark` int(11) NOT NULL,
  `Creator` int(11) NOT NULL,
  `Type` int(11) NOT NULL,
  `SupplierID` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (1,'1',200,100,'MCS','2017-03-20 11:10:59',-1,253,1,9),(2,'2',200,100,'MCS','2017-03-20 11:58:33',-1,253,1,9),(3,'3',200,100,'MCS','2017-04-27 09:37:27',-1,280,1,9),(4,'4',200,100,'MCS','2017-05-03 12:00:47',-1,280,1,9),(5,'',200,100,'','2017-05-04 15:23:12',-1,284,1,0),(6,'',200,100,'','2017-05-09 11:40:27',-1,280,1,0),(7,'7',200,100,'MCS','2017-05-09 11:51:21',-1,280,1,9),(8,'8',200,100,'MCS','2017-05-09 12:50:10',-1,280,1,9),(9,'9',200,100,'PC EXPRESS','2017-05-09 13:11:28',-1,280,1,11),(10,'',200,100,'','2017-05-09 13:12:27',-1,280,1,0),(11,'11',200,100,'MCS','2017-05-09 13:13:32',-1,280,1,9),(12,'',200,100,'','2017-05-09 13:16:12',-1,280,1,0),(13,'13',200,100,'PC EXPRESS','2017-05-09 13:16:34',-1,280,1,11),(14,'14',200,100,'Vinea Distribution Inc','2017-05-09 13:22:41',-1,287,1,12),(15,'15',200,100,'MCS','2017-05-09 13:23:21',-1,280,1,9),(16,'15',200,100,'MCS','2017-05-09 13:24:44',-1,280,1,9),(17,'15',200,100,'MCS','2017-05-09 13:25:01',-1,280,1,9),(18,'18',200,100,'Vinea Distribution Inc','2017-05-09 13:27:15',-1,287,1,12),(19,'19',200,100,'Vinea Distribution Inc','2017-05-09 13:28:07',-1,287,1,12),(20,'20',200,100,'PC EXPRESS','2017-05-09 13:29:09',-1,280,1,11),(21,'',200,100,'','2017-05-09 13:34:06',-1,280,1,0),(22,'22',200,100,'Vinea Distribution Inc','2017-05-09 13:40:06',-1,253,1,12),(23,'23',200,100,'PC EXPRESS','2017-05-09 13:45:44',-1,280,1,11),(24,'24',200,100,'PC EXPRESS','2017-05-09 13:56:19',1,280,1,13),(25,'',200,100,'Vinea Distribution Inc','2017-05-09 14:05:08',2,287,1,12),(26,'',200,100,'Vinea Distribution Inc','2017-05-09 14:28:44',2,287,1,12),(27,'',200,100,'','2017-05-09 14:42:47',-1,280,1,0),(28,'',200,100,'','2017-05-09 14:55:58',-1,280,1,0),(29,'',200,100,'','2017-05-10 09:05:07',-1,283,1,0),(30,'',200,100,'','2017-05-11 09:41:24',-1,253,1,0),(31,'',200,100,'','2017-05-11 09:56:45',-1,253,1,0),(32,'32',200,100,'Infoworx inc ','2017-05-22 16:05:40',1,253,1,10),(33,'',200,100,'','2017-05-23 17:20:35',-1,288,1,0),(34,'',200,100,'Banbros Commercial Inc.','2017-05-23 17:24:31',-1,288,1,14),(35,'',200,100,'Infoworx inc ','2017-06-02 14:41:55',1,280,1,10),(36,'',200,100,'','2017-06-02 15:23:39',-1,280,1,0),(37,'37',200,100,'Technoline','2017-06-02 15:24:05',1,280,1,15),(38,'38',200,100,'Nanotec Corporation','2017-06-02 15:29:57',1,280,1,18),(39,'39',200,100,'hardcom computer system company','2017-06-02 15:31:45',1,280,1,16),(40,'40',200,100,'PC EXPRESS','2017-06-02 15:33:49',1,280,1,13),(41,'41',200,100,'Infoworx inc ','2017-06-02 15:36:51',1,280,1,10),(42,'42',200,100,'N Computing Ph','2017-06-02 17:10:48',1,280,1,19),(43,'',200,100,'American Technologies Inc','2017-06-02 17:12:54',1,280,1,20),(44,'44',200,100,'Bridge','2017-06-02 17:16:08',2,280,1,21),(45,'45',200,100,'American Technologies Inc','2017-06-02 17:27:21',1,287,1,20),(46,'46',200,100,'Grand Force Marketing','2017-06-02 17:35:31',1,280,1,22),(47,'',200,100,'','2017-06-05 09:23:15',-1,280,1,0),(48,'',200,100,'','2017-06-05 11:26:23',-1,280,1,0),(49,'',200,100,'','2017-06-05 11:26:48',-1,280,1,0),(50,'',200,100,'','2017-06-05 11:27:23',-1,280,1,0),(51,'51',200,100,'MSI-ECS Phils.','2017-06-05 14:30:42',2,283,1,23),(52,'',200,100,'','2017-06-05 14:36:47',2,283,1,0),(53,'',200,100,'MSI-ECS Phils.','2017-06-05 14:37:31',1,283,1,23),(54,'54',200,100,'VDI Distribution','2017-06-05 16:00:48',1,283,1,24),(55,'',200,100,'','2017-06-05 16:50:40',-1,283,1,0),(56,'',200,100,'','2017-06-05 16:51:31',-1,283,1,0),(57,'',200,100,'','2017-06-05 16:54:42',-1,283,1,0),(58,'58',200,100,'MSI-ECS Phils.','2017-06-05 16:58:15',2,283,1,23),(59,'',200,100,'','2017-06-19 14:14:06',-1,280,1,0),(60,'',200,100,'','2017-06-19 14:16:56',-1,280,1,0),(61,'61',200,100,' JT Photoworld','2017-06-19 22:51:46',2,280,1,37),(62,'',200,100,'','2017-08-26 12:02:32',-1,253,1,0);
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permission`
--

DROP TABLE IF EXISTS `user_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_permission` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Wid` int(11) NOT NULL DEFAULT '0',
  `Code` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permission`
--

LOCK TABLES `user_permission` WRITE;
/*!40000 ALTER TABLE `user_permission` DISABLE KEYS */;
INSERT INTO `user_permission` VALUES (23,283,'101'),(24,283,'102'),(25,283,'103'),(26,283,'105'),(27,283,'106'),(28,283,'108'),(29,283,'110'),(30,283,'114'),(40,284,'102'),(41,284,'103'),(42,284,'105'),(43,284,'106'),(44,284,'108'),(45,284,'114'),(46,285,'102'),(47,285,'103'),(48,285,'106'),(49,285,'108'),(50,285,'110'),(58,287,'102'),(59,287,'103'),(60,287,'105'),(61,287,'106'),(62,287,'108'),(63,287,'110'),(64,287,'114'),(73,289,'102'),(74,289,'103'),(75,289,'105'),(76,289,'106'),(77,289,'108'),(78,289,'110'),(79,289,'114'),(80,290,'102'),(81,290,'103'),(82,290,'104'),(83,290,'105'),(84,290,'106'),(85,290,'108'),(86,290,'109'),(87,290,'114'),(105,286,'102'),(106,286,'103'),(107,286,'105'),(108,286,'106'),(109,286,'108'),(110,286,'110'),(111,286,'114'),(112,286,'115'),(113,307,'102'),(114,307,'103'),(115,307,'104'),(116,307,'105'),(117,307,'106'),(118,307,'108'),(119,307,'109'),(120,307,'110'),(121,307,'114'),(122,307,'116'),(132,306,'102'),(133,306,'103'),(134,306,'104'),(135,306,'105'),(136,306,'106'),(137,306,'108'),(138,306,'109'),(139,306,'110'),(140,306,'114'),(141,306,'115'),(142,306,'116'),(170,280,'102'),(171,280,'103'),(172,280,'114'),(173,280,'105'),(174,280,'106'),(175,280,'108'),(176,280,'117'),(177,280,'110'),(178,288,'102'),(179,288,'103'),(180,288,'104'),(181,288,'114'),(182,288,'105'),(183,288,'106'),(184,288,'108'),(185,288,'109'),(186,288,'117'),(187,288,'116');
/*!40000 ALTER TABLE `user_permission` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-10 14:21:34
