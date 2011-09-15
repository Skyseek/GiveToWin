-- MySQL dump 10.13  Distrib 5.1.58, for redhat-linux-gnu (i386)
--
-- Host: localhost    Database: gtw
-- ------------------------------------------------------
-- Server version	5.1.58-log

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
-- Table structure for table `charity`
--

DROP TABLE IF EXISTS `charity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `charity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `website` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `mission` text,
  `work` text,
  PRIMARY KEY (`id`),
  KEY `fk_charity_charity_status1` (`status_id`),
  CONSTRAINT `fk_charity_charity_status1` FOREIGN KEY (`status_id`) REFERENCES `charity_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `charity`
--

LOCK TABLES `charity` WRITE;
/*!40000 ALTER TABLE `charity` DISABLE KEYS */;
INSERT INTO `charity` VALUES (1,2,'YMCA of the USA','http://www.ymca.net','test@google.com','5551231234','our mission','our work'),(2,1,'Catholic Charities USA','http://www.google.com','test@google.com','5551231234','our mission','our work'),(3,4,'United Way','http://www.google.com','test@google.com','5551231234','our mission','our work'),(4,3,'Goodwill Industries International','http://www.google.com','test@google.com','5551231234','our mission','our work'),(5,2,'American Red Cross','http://www.google.com','test@google.com','5551231234','our mission','our work'),(6,2,'The Salvation Army','http://www.google.com','test@google.com','5551231234','our mission','our work'),(7,2,'Memorial Sloan-Kettering Cancer Center','http://www.google.com','test@google.com','5551231234','our mission','our work'),(8,2,'Boys & Girls Clubs of America','http://www.google.com','test@google.com','5551231234','our mission','our work'),(9,1,'Habitat for Humanity Internation','http://www.google.com','test@google.com','5551231234','our mission','our work'),(10,3,'Easter Seals','http://www.google.com','test@google.com','5551231234','our mission','our work'),(11,5,'World Vision','http://www.google.com','test@google.com','5551231234','our mission','our work');
/*!40000 ALTER TABLE `charity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `charity_log`
--

DROP TABLE IF EXISTS `charity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `charity_log` (
  `log_id` int(11) NOT NULL,
  `charity_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`,`charity_id`),
  KEY `fk_charity_log_charity1` (`charity_id`),
  KEY `fk_charity_log_charity_status1` (`status_id`),
  KEY `fk_charity_log_log1` (`log_id`),
  CONSTRAINT `fk_charity_log_charity1` FOREIGN KEY (`charity_id`) REFERENCES `charity` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_charity_log_charity_status1` FOREIGN KEY (`status_id`) REFERENCES `charity_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_charity_log_log1` FOREIGN KEY (`log_id`) REFERENCES `log` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `charity_log`
--

LOCK TABLES `charity_log` WRITE;
/*!40000 ALTER TABLE `charity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `charity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `charity_status`
--

DROP TABLE IF EXISTS `charity_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `charity_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(32) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `charity_status`
--

LOCK TABLES `charity_status` WRITE;
/*!40000 ALTER TABLE `charity_status` DISABLE KEYS */;
INSERT INTO `charity_status` VALUES (1,'Submitted','Charity has been submitted. It\'s Now Waiting for GTW staff\'s approval'),(2,'Active','Charity is now Active.'),(3,'Rejected','Charity has been rejected.'),(4,'Suspended','Charity has been suspended by GTW staff.'),(5,'Removed','Charity has removed it\'s self from GTW');
/*!40000 ALTER TABLE `charity_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_state1` (`state_id`),
  KEY `fk_city_city_status1` (`status_id`),
  CONSTRAINT `fk_city_city_status1` FOREIGN KEY (`status_id`) REFERENCES `city_status` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `fk_city_state1` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (1,13,2,'Athens'),(2,13,1,'Atlanta');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city_status`
--

DROP TABLE IF EXISTS `city_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(16) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city_status`
--

LOCK TABLES `city_status` WRITE;
/*!40000 ALTER TABLE `city_status` DISABLE KEYS */;
INSERT INTO `city_status` VALUES (1,'Planned','GTW is currently planning to use this city in the near future.'),(2,'Active','This city is currently active.'),(3,'Disabled','This city has been discontinued.');
/*!40000 ALTER TABLE `city_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city_subscription`
--

DROP TABLE IF EXISTS `city_subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city_subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user_id`,`city_id`),
  KEY `fk_city_subscription_user1` (`user_id`),
  KEY `fk_city_subscription_city1` (`city_id`),
  CONSTRAINT `fk_city_subscription_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_city_subscription_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city_subscription`
--

LOCK TABLES `city_subscription` WRITE;
/*!40000 ALTER TABLE `city_subscription` DISABLE KEYS */;
INSERT INTO `city_subscription` VALUES (1,1,1);
/*!40000 ALTER TABLE `city_subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time_posted` timestamp NULL DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `fk_comment_user1` (`user_id`),
  CONSTRAINT `fk_comment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `website` varchar(256) NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `fk_company_company_status1` FOREIGN KEY (`status_id`) REFERENCES `company_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,1,'Skyseek','http://www.skyseek.com','sean@skyseek.com','8016543007'),(2,1,'Fearyoucanhear','http://www.fearyoucanhear.com','troy@fearyoucanhear.com','8016543007'),(3,1,'Goodmonkeys','http://www.goodmonkeys.com','troy@fearyoucanhear.com','8016543007'),(4,1,'Sears','http://www.sears.com','troy@fearyoucanhear.com','8016543007'),(5,1,'Wal-Mart','http://www.walmart.com','troy@fearyoucanhear.com','8016543007'),(6,1,'Home Depot','http://www.walmart.com','troy@fearyoucanhear.com','8016543007'),(7,1,'7-11','http://www.7-eleven.com','troy@fearyoucanhear.com','8016543007');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_log`
--

DROP TABLE IF EXISTS `company_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_log` (
  `log_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`,`company_id`),
  KEY `fk_company_log_company1` (`company_id`),
  KEY `fk_company_log_company_status1` (`status_id`),
  CONSTRAINT `fk_company_log_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_company_log_company_status1` FOREIGN KEY (`status_id`) REFERENCES `company_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_coupon_log_log10` FOREIGN KEY (`log_id`) REFERENCES `log` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_log`
--

LOCK TABLES `company_log` WRITE;
/*!40000 ALTER TABLE `company_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_status`
--

DROP TABLE IF EXISTS `company_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(16) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_status`
--

LOCK TABLES `company_status` WRITE;
/*!40000 ALTER TABLE `company_status` DISABLE KEYS */;
INSERT INTO `company_status` VALUES (1,'Submitted','Company has been submitted. It\'s Now Waiting for GTW staff\'s approval'),(2,'Active','Company is now Active.'),(3,'Rejected','Company has been rejected.'),(4,'Suspended','Company has been suspended by GTW staff.'),(5,'Removed','Company has removed it\'s self from GTW');
/*!40000 ALTER TABLE `company_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `offer_schedule_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`offer_schedule_id`,`status_id`),
  KEY `fk_coupon_user1` (`user_id`),
  KEY `fk_coupon_coupon_status1` (`status_id`),
  KEY `fk_coupon_offer_schedule1` (`offer_schedule_id`),
  CONSTRAINT `fk_coupon_coupon_status1` FOREIGN KEY (`status_id`) REFERENCES `coupon_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_coupon_offer_schedule1` FOREIGN KEY (`offer_schedule_id`) REFERENCES `offer_schedule` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_coupon_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon`
--

LOCK TABLES `coupon` WRITE;
/*!40000 ALTER TABLE `coupon` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_log`
--

DROP TABLE IF EXISTS `coupon_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon_log` (
  `log_id` int(11) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `coupon_status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_coupon_log_coupon1` (`coupon_id`),
  KEY `fk_coupon_log_coupon_status1` (`coupon_status_id`),
  CONSTRAINT `fk_coupon_log_coupon1` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_coupon_log_coupon_status1` FOREIGN KEY (`coupon_status_id`) REFERENCES `coupon_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_coupon_log_log1` FOREIGN KEY (`log_id`) REFERENCES `log` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_log`
--

LOCK TABLES `coupon_log` WRITE;
/*!40000 ALTER TABLE `coupon_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_status`
--

DROP TABLE IF EXISTS `coupon_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(32) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_status`
--

LOCK TABLES `coupon_status` WRITE;
/*!40000 ALTER TABLE `coupon_status` DISABLE KEYS */;
INSERT INTO `coupon_status` VALUES (1,'Pending','Coupon is currently Pending. Once GTW received payment notification this coupon will become active.'),(2,'Active','Coupon is Active.'),(3,'Used','Coupon has been used. It is no longer valid.');
/*!40000 ALTER TABLE `coupon_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deal_comment`
--

DROP TABLE IF EXISTS `deal_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deal_comment` (
  `id` int(11) NOT NULL,
  `fundraiser_id` int(11) DEFAULT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fundraiser_comment_fundraiser1` (`fundraiser_id`),
  KEY `fk_fundraiser_comment_comment1` (`comment_id`),
  KEY `fk_promotion_comment_offer1` (`offer_id`),
  CONSTRAINT `fk_fundraiser_comment_comment1` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fundraiser_comment_fundraiser1` FOREIGN KEY (`fundraiser_id`) REFERENCES `fundraiser` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_promotion_comment_offer1` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deal_comment`
--

LOCK TABLES `deal_comment` WRITE;
/*!40000 ALTER TABLE `deal_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `deal_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donation`
--

DROP TABLE IF EXISTS `donation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `fundraiser_schedule_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`fundraiser_schedule_id`),
  KEY `fk_donation_user1` (`user_id`),
  KEY `fk_donation_fundraiser_schedule1` (`fundraiser_schedule_id`),
  CONSTRAINT `fk_donation_fundraiser_schedule1` FOREIGN KEY (`fundraiser_schedule_id`) REFERENCES `fundraiser_schedule` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_donation_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donation`
--

LOCK TABLES `donation` WRITE;
/*!40000 ALTER TABLE `donation` DISABLE KEYS */;
/*!40000 ALTER TABLE `donation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `text_content` text,
  `html_content` text,
  `subject` varchar(256) DEFAULT NULL,
  `from_email` varchar(256) DEFAULT NULL,
  `from_alias` varchar(128) DEFAULT NULL,
  `to_email` varchar(256) DEFAULT NULL,
  `to_alias` varchar(128) DEFAULT NULL,
  `time_created` timestamp NULL DEFAULT NULL,
  `time_sent` timestamp NULL DEFAULT NULL,
  `email_template_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_email_email_template1` (`email_template_id`),
  KEY `fk_email_user1` (`user_id`),
  CONSTRAINT `fk_email_email_template1` FOREIGN KEY (`email_template_id`) REFERENCES `email_template` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_email_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_template`
--

DROP TABLE IF EXISTS `email_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `description` text,
  `subject` varchar(256) DEFAULT NULL,
  `text_body` text,
  `html_body` text,
  `from_email` varchar(256) DEFAULT NULL,
  `from_alias` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_template`
--

LOCK TABLES `email_template` WRITE;
/*!40000 ALTER TABLE `email_template` DISABLE KEYS */;
INSERT INTO `email_template` VALUES (1,'User New Email Confirmation','Email sent after a new user subscribes to a newsletter','','',NULL,NULL,NULL),(2,'User New Subscription','User New Subscription',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `email_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fundraiser`
--

DROP TABLE IF EXISTS `fundraiser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fundraiser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charity_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `cost` double DEFAULT '0',
  `goal` double DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `fk_fundraiser_charity1` (`charity_id`),
  KEY `fk_fundraiser_fundraiser_status1` (`status_id`),
  CONSTRAINT `fk_fundraiser_charity1` FOREIGN KEY (`charity_id`) REFERENCES `charity` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fundraiser_fundraiser_status1` FOREIGN KEY (`status_id`) REFERENCES `fundraiser_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fundraiser`
--

LOCK TABLES `fundraiser` WRITE;
/*!40000 ALTER TABLE `fundraiser` DISABLE KEYS */;
INSERT INTO `fundraiser` VALUES (1,1,1,20,2000,'Save the Music','Save the Music'),(2,2,1,20,2000,'Food Drive','Food Drive Description'),(3,3,1,20,2000,'Save the Children','Save the Children'),(4,3,1,20,2000,'Save the Children #2','Save the Children #2');
/*!40000 ALTER TABLE `fundraiser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fundraiser_log`
--

DROP TABLE IF EXISTS `fundraiser_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fundraiser_log` (
  `log_id` int(11) NOT NULL,
  `fundraiser_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `fk_fundraiser_log_fundraiser_status1` (`status_id`),
  KEY `fk_fundraiser_log_fundraiser1` (`fundraiser_id`),
  CONSTRAINT `fk_fundraiser_log_fundraiser1` FOREIGN KEY (`fundraiser_id`) REFERENCES `fundraiser` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fundraiser_log_fundraiser_status1` FOREIGN KEY (`status_id`) REFERENCES `fundraiser_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fundraiser_log_log1` FOREIGN KEY (`log_id`) REFERENCES `log` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fundraiser_log`
--

LOCK TABLES `fundraiser_log` WRITE;
/*!40000 ALTER TABLE `fundraiser_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `fundraiser_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fundraiser_schedule`
--

DROP TABLE IF EXISTS `fundraiser_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fundraiser_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `fundraiser_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fundraiser_schedule_fundraiser1` (`fundraiser_id`),
  KEY `fk_fundraiser_schedule_city1` (`city_id`),
  KEY `fk_fundraiser_schedule_fundraiser_status1` (`status_id`),
  CONSTRAINT `fk_fundraiser_schedule_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fundraiser_schedule_fundraiser1` FOREIGN KEY (`fundraiser_id`) REFERENCES `fundraiser` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fundraiser_schedule_fundraiser_status1` FOREIGN KEY (`status_id`) REFERENCES `fundraiser_schedule_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fundraiser_schedule`
--

LOCK TABLES `fundraiser_schedule` WRITE;
/*!40000 ALTER TABLE `fundraiser_schedule` DISABLE KEYS */;
INSERT INTO `fundraiser_schedule` VALUES (1,1,2,2,'2011-09-04','2011-09-15'),(2,2,2,1,'2011-09-07','2011-09-11');
/*!40000 ALTER TABLE `fundraiser_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fundraiser_schedule_log`
--

DROP TABLE IF EXISTS `fundraiser_schedule_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fundraiser_schedule_log` (
  `fundraiser_schedule_id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`fundraiser_schedule_id`,`log_id`),
  KEY `fk_fundraiser_schedule_log_log1` (`log_id`),
  KEY `fk_fundraiser_schedule_log_fundraiser_status1` (`status_id`),
  CONSTRAINT `fk_fundraiser_schedule_log_fundraiser_schedule1` FOREIGN KEY (`fundraiser_schedule_id`) REFERENCES `fundraiser_schedule` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fundraiser_schedule_log_fundraiser_status1` FOREIGN KEY (`status_id`) REFERENCES `fundraiser_schedule_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fundraiser_schedule_log_log1` FOREIGN KEY (`log_id`) REFERENCES `log` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fundraiser_schedule_log`
--

LOCK TABLES `fundraiser_schedule_log` WRITE;
/*!40000 ALTER TABLE `fundraiser_schedule_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `fundraiser_schedule_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fundraiser_schedule_status`
--

DROP TABLE IF EXISTS `fundraiser_schedule_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fundraiser_schedule_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(32) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fundraiser_schedule_status`
--

LOCK TABLES `fundraiser_schedule_status` WRITE;
/*!40000 ALTER TABLE `fundraiser_schedule_status` DISABLE KEYS */;
INSERT INTO `fundraiser_schedule_status` VALUES (1,'Submitted','Fundraiser Schedule has been submitted. It\'s Now Waiting for GTW staff\'s approval'),(2,'Active','Fundraiser Schedule is now Active.'),(3,'Rejected','Fundraiser Schedule has been rejected.'),(4,'Suspended','Fundraiser Schedule has been suspended by GTW staff.');
/*!40000 ALTER TABLE `fundraiser_schedule_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fundraiser_status`
--

DROP TABLE IF EXISTS `fundraiser_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fundraiser_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(32) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fundraiser_status`
--

LOCK TABLES `fundraiser_status` WRITE;
/*!40000 ALTER TABLE `fundraiser_status` DISABLE KEYS */;
INSERT INTO `fundraiser_status` VALUES (1,'Submitted','Fundraiser has been submitted. It\'s Now Waiting for GTW staff\'s approval'),(2,'Active','Fundraiser is now Active.'),(3,'Rejected','Fundraiser has been rejected.'),(4,'Suspended','Fundraiser has been suspended by GTW staff.');
/*!40000 ALTER TABLE `fundraiser_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL,
  `message` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_log_user` (`user_id`),
  CONSTRAINT `fk_log_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer`
--

DROP TABLE IF EXISTS `offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `value` double NOT NULL,
  `title` varchar(256) NOT NULL,
  `sub_title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `fine_print` text NOT NULL,
  `highlights` text NOT NULL,
  `time_redeem` datetime NOT NULL,
  `time_expire` datetime NOT NULL,
  `minimum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`,`status_id`),
  KEY `fk_offer_company1` (`company_id`),
  KEY `fk_offer_offer_status1` (`status_id`),
  CONSTRAINT `fk_offer_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_offer_offer_status1` FOREIGN KEY (`status_id`) REFERENCES `offer_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer`
--

LOCK TABLES `offer` WRITE;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
INSERT INTO `offer` VALUES (1,1,1,50,'Free Ice Cream Cone','For you!','As a way to thank our customers for their support and to celebrate 33 years of scooping the chunkiest, funkiest ice cream, frozen yogurt and sorbet, Ben & Jerry\'s chocolate frenzy.','An ice cream cone, poke or cornet is a dry, cone-shaped pastry, usually made of a wafer similar in texture to a waffle, allowing ice cream to be eaten without a bowl or spoon. Various types of ice-cream cones include waffle cones, cake cones (or wafer cones), pretzel cones, and sugar cones.','Edible cones have been mentioned in French cooking books as early as 1825, Julien Archambault describes a cone where one can roll \"little waffles\".[1] Another printed reference to an edible cone is in Mrs A. B. Marshallâ€™s Cookery Book, written in 1888 by Agnes B. Marshall (1855â€“1905) of England. Her recipe for \"Cornet with Cream\" says that - \"the cornets were made with almonds and baked in the oven, not pressed between irons\". The influential innovator who published two recipe books and ran a school of cookery.','2011-09-30 11:46:51','2011-10-31 11:46:56',1000);
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer_log`
--

DROP TABLE IF EXISTS `offer_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer_log` (
  `offer_id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`offer_id`,`log_id`),
  KEY `fk_fundraiser_schedule_log_log1` (`log_id`),
  KEY `fk_offer_log_offer1` (`offer_id`),
  KEY `fk_offer_log_offer_status1` (`status_id`),
  CONSTRAINT `fk_fundraiser_schedule_log_log100` FOREIGN KEY (`log_id`) REFERENCES `log` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_offer_log_offer1` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_offer_log_offer_status1` FOREIGN KEY (`status_id`) REFERENCES `offer_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_log`
--

LOCK TABLES `offer_log` WRITE;
/*!40000 ALTER TABLE `offer_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `offer_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer_schedule`
--

DROP TABLE IF EXISTS `offer_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_offer_schedule_offer1` (`offer_id`),
  KEY `fk_offer_schedule_city1` (`city_id`),
  KEY `fk_offer_schedule_offer_schedule_status1` (`status_id`),
  CONSTRAINT `fk_offer_schedule_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_offer_schedule_offer1` FOREIGN KEY (`offer_id`) REFERENCES `offer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_offer_schedule_offer_schedule_status1` FOREIGN KEY (`status_id`) REFERENCES `offer_schedule_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_schedule`
--

LOCK TABLES `offer_schedule` WRITE;
/*!40000 ALTER TABLE `offer_schedule` DISABLE KEYS */;
INSERT INTO `offer_schedule` VALUES (1,1,1,2,'2011-09-01','2011-09-30');
/*!40000 ALTER TABLE `offer_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer_schedule_log`
--

DROP TABLE IF EXISTS `offer_schedule_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer_schedule_log` (
  `offer_schedule_id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`offer_schedule_id`,`log_id`),
  KEY `fk_fundraiser_schedule_log_log1` (`log_id`),
  KEY `fk_offer_schedule_log_offer_schedule1` (`offer_schedule_id`),
  KEY `fk_offer_schedule_log_offer_schedule_status1` (`status_id`),
  CONSTRAINT `fk_fundraiser_schedule_log_log10` FOREIGN KEY (`log_id`) REFERENCES `log` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_offer_schedule_log_offer_schedule1` FOREIGN KEY (`offer_schedule_id`) REFERENCES `offer_schedule` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_offer_schedule_log_offer_schedule_status1` FOREIGN KEY (`status_id`) REFERENCES `offer_schedule_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_schedule_log`
--

LOCK TABLES `offer_schedule_log` WRITE;
/*!40000 ALTER TABLE `offer_schedule_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `offer_schedule_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer_schedule_status`
--

DROP TABLE IF EXISTS `offer_schedule_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer_schedule_status` (
  `id` int(11) NOT NULL,
  `status` varchar(32) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_schedule_status`
--

LOCK TABLES `offer_schedule_status` WRITE;
/*!40000 ALTER TABLE `offer_schedule_status` DISABLE KEYS */;
INSERT INTO `offer_schedule_status` VALUES (1,'Submitted','Offer Schedule has been submitted. It\'s Now Waiting for GTW staff\'s approval'),(2,'Active','Offer Schedule is now Active.'),(3,'Rejected','Offer Schedule has been rejected.'),(4,'Suspended','Offer Schedule has been suspended by GTW staff.');
/*!40000 ALTER TABLE `offer_schedule_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer_status`
--

DROP TABLE IF EXISTS `offer_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer_status` (
  `id` int(11) NOT NULL,
  `status` varchar(32) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer_status`
--

LOCK TABLES `offer_status` WRITE;
/*!40000 ALTER TABLE `offer_status` DISABLE KEYS */;
INSERT INTO `offer_status` VALUES (1,'Submitted','Offer has been submitted. It\'s Now Waiting for GTW staff\'s approval'),(2,'Active','Offer is now Active.'),(3,'Rejected','Offer has been rejected.'),(4,'Suspended','Offer has been suspended by GTW staff.');
/*!40000 ALTER TABLE `offer_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(64) DEFAULT NULL,
  `abbreviation` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES (1,'Alabama','AL'),(2,'Alaska','AK'),(3,'American Samoa','AS'),(4,'Arizona','AZ'),(5,'Arkansas','AR'),(6,'California','CA'),(7,'Colorado','CO'),(8,'Connecticut','CT'),(9,'Delaware','DE'),(10,'District of Columbia','DC'),(11,'Federated States of Micronesia','FM'),(12,'Florida','FL'),(13,'Georgia','GA'),(14,'Guam','GU'),(15,'Hawaii','HI'),(16,'Idaho','ID'),(17,'Illinois','IL'),(18,'Indiana','IN'),(19,'Iowa','IA'),(20,'Kansas','KS'),(21,'Kentucky','KY'),(22,'Louisiana','LA'),(23,'Maine','ME'),(24,'Marshall Islands','MH'),(25,'Maryland','MD'),(26,'Massachusetts','MA'),(27,'Michigan','MI'),(28,'Minnesota','MN'),(29,'Mississippi','MS'),(30,'Missouri','MO'),(31,'Montana','MT'),(32,'Nebraska','NE'),(33,'Nevada','NV'),(34,'New Hampshire','NH'),(35,'New Jersey','NJ'),(36,'New Mexico','NM'),(37,'New York','NY'),(38,'North Carolina','NC'),(39,'North Dakota','ND'),(40,'Northern Mariana Islands','MP'),(41,'Ohio','OH'),(42,'Oklahoma','OK'),(43,'Oregon','OR'),(44,'Palau','PW'),(45,'Pennsylvania','PA'),(46,'Puerto Rico','PR'),(47,'Rhode Island','RI'),(48,'South Carolina','SC'),(49,'South Dakota','SD'),(50,'Tennessee','TN'),(51,'Texas','TX'),(52,'Utah','UT'),(53,'Vermont','VT'),(54,'Virgin Islands','VI'),(55,'Virginia','VA'),(56,'Washington','WA'),(57,'West Virginia','WV'),(58,'Wisconsin','WI'),(59,'Wyoming','WY');
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `facebook_id` int(11) DEFAULT NULL,
  `give_points` double DEFAULT '0',
  `total_donated` double DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `gender` varchar(16) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status_id` (`status_id`),
  KEY `fk_user_user_role1` (`role_id`),
  KEY `fk_user_city1` (`city_id`),
  CONSTRAINT `fk_user_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_user_role1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_user_status1` FOREIGN KEY (`status_id`) REFERENCES `user_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,4,2,1,NULL,0,NULL,'sean@skyseek.com','07ccb82b255404863cca6d6dbb648423','Seans','Thayne','Male',NULL),(2,4,2,1,NULL,0,NULL,'maxwell.ruppersburg@gmail.com','cca8dd8babd4c9996c8dfee788a49d18','Maxwell','Ruppersburg','Male',NULL),(3,4,2,1,NULL,0,NULL,'john.doe@test.com','cca8dd8babd4c9996c8dfee788a49d18','John','Doe','Male',NULL),(4,4,2,1,NULL,0,NULL,'sally.doe@test.com','cca8dd8babd4c9996c8dfee788a49d18','Sally','Doe','Female',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(16) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,'Guest','New visitor to the site.'),(2,'Subscriber','User has subscribed to at least one city\'s subscription.'),(3,'Member','User has submited details, and now needs to confirm his/her email address.'),(4,'Admin','User is an Admin and has full access to the site and the Admin area.');
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(16) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_status`
--

LOCK TABLES `user_status` WRITE;
/*!40000 ALTER TABLE `user_status` DISABLE KEYS */;
INSERT INTO `user_status` VALUES (1,'Pending','User has submitted information, but hasn\'t confirmed there email address'),(2,'Active','User has subscribed to one or more city newsletters'),(3,'Suspended','User has been suspended by GTW staff'),(4,'Cancelled','User has cancelled there service.');
/*!40000 ALTER TABLE `user_status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-09-15  8:18:40
