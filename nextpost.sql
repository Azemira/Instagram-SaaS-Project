-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: nextpost
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `np_accounts`
--

DROP TABLE IF EXISTS `np_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `np_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `instagram_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `proxy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `login_required` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_2` (`user_id`,`username`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `np_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `np_accounts`
--

LOCK TABLES `np_accounts` WRITE;
/*!40000 ALTER TABLE `np_accounts` DISABLE KEYS */;
INSERT INTO `np_accounts` VALUES (1,1,'14926773652','mejrinosman','def502001bc7ce3b4b75b42d85c67ab2cd28e3f088b6845af94c6e1fa524532850fe853bed05f2edd22665d0c8d4ce6dfcf9014ab98de478b76719b219d25772320adc54014eb391bac6aba75d09da70acdcf5beb39cd47ef1f7b66495dbeb4d002d58f31ab43f','','2019-06-23 15:10:36','2019-06-23 18:47:35',0);
/*!40000 ALTER TABLE `np_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `np_captions`
--

DROP TABLE IF EXISTS `np_captions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `np_captions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `caption` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `captions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `np_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `np_captions`
--

LOCK TABLES `np_captions` WRITE;
/*!40000 ALTER TABLE `np_captions` DISABLE KEYS */;
/*!40000 ALTER TABLE `np_captions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `np_files`
--

DROP TABLE IF EXISTS `np_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `np_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `filesize` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `np_files`
--

LOCK TABLES `np_files` WRITE;
/*!40000 ALTER TABLE `np_files` DISABLE KEYS */;
INSERT INTO `np_files` VALUES (1,1,'njemacka-lista.jpg','','lureyali-5d0f97f4c172b.jpg','29159','2019-06-23 15:17:09');
/*!40000 ALTER TABLE `np_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `np_general_data`
--

DROP TABLE IF EXISTS `np_general_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `np_general_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `np_general_data`
--

LOCK TABLES `np_general_data` WRITE;
/*!40000 ALTER TABLE `np_general_data` DISABLE KEYS */;
INSERT INTO `np_general_data` VALUES (1,'settings','{\"site_name\":\"Nextpost\",\"site_description\":\"Nextpost - Auto Post, Schedule & Manage your Instagram Multi Account\",\"site_keywords\":\"nextpost, instagram, auto post, schedule, multiple accounts, social media\",\"currency\":\"USD\",\"proxy\":true,\"user_proxy\":true,\"geonamesorg_username\":\"\",\"logomark\":\"\",\"logotype\":\"\"}'),(2,'integrations','{\"dropbox\":{\"api_key\":\"\"},\"google\":{\"api_key\":\"\",\"client_id\":\"\",\"analytics\":{\"property_id\":\"\"}},\"onedrive\":{\"client_id\":\"\"},\"paypal\":{\"client_id\":\"\",\"client_secret\":\"\",\"environment\":\"sandbox\"},\"stripe\":{\"environment\":\"sandbox\",\"publishable_key\":\"\",\"secret_key\":\"\"},\"facebook\":{\"app_id\":\"\",\"app_secret\":\"\"}}'),(3,'free-trial','{\"size\":7,\"storage\":{\"total\":\"100.00\",\"file\":-1},\"max_accounts\":1,\"file_pickers\":{\"dropbox\":true,\"onedrive\":true,\"google_drive\":true},\"post_types\":{\"timeline_photo\":true,\"timeline_video\":true,\"story_photo\":true,\"story_video\":true,\"album_photo\":true,\"album_video\":true},\"spintax\":true,\"modules\":[]}'),(4,'email-settings','{\"smtp\":{\"host\":\"\",\"port\":\"\",\"encryption\":\"\",\"auth\":true,\"username\":\"\",\"password\":\"\",\"from\":\"\"},\"notifications\":{\"emails\":\"\",\"new_user\":true,\"new_payment\":true}}');
/*!40000 ALTER TABLE `np_general_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `np_options`
--

DROP TABLE IF EXISTS `np_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `np_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `option_value` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `np_options`
--

LOCK TABLES `np_options` WRITE;
/*!40000 ALTER TABLE `np_options` DISABLE KEYS */;
INSERT INTO `np_options` VALUES (1,'payload','a3df5a3df0022278cd14cfbb0e557d8ca0f1e72c.MjIxNQ==');
/*!40000 ALTER TABLE `np_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `np_orders`
--

DROP TABLE IF EXISTS `np_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `np_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_gateway` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `payment_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `total` double(10,2) NOT NULL,
  `paid` double(10,2) NOT NULL,
  `currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `np_orders`
--

LOCK TABLES `np_orders` WRITE;
/*!40000 ALTER TABLE `np_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `np_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `np_packages`
--

DROP TABLE IF EXISTS `np_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `np_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `monthly_price` double(10,2) NOT NULL,
  `annual_price` float(10,2) NOT NULL,
  `settings` text COLLATE utf8_unicode_ci NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `np_packages`
--

LOCK TABLES `np_packages` WRITE;
/*!40000 ALTER TABLE `np_packages` DISABLE KEYS */;
INSERT INTO `np_packages` VALUES (1,'Alpha',4.99,49.00,'{\"storage\":{\"total\":\"150.00\",\"file\":\"15.00\"},\"max_accounts\":1,\"file_pickers\":{\"dropbox\":false,\"onedrive\":false,\"google_drive\":false},\"post_types\":{\"timeline_photo\":true,\"timeline_video\":false,\"story_photo\":true,\"story_video\":false,\"album_photo\":true,\"album_video\":false},\"spintax\":false}',1,'2017-03-18 19:22:44'),(2,'Beta Pack',7.99,79.00,'{\"storage\":{\"total\":\"250\",\"file\":\"30.00\"},\"max_accounts\":3,\"file_pickers\":{\"dropbox\":true,\"onedrive\":true,\"google_drive\":true},\"post_types\":{\"timeline_photo\":true,\"timeline_video\":true,\"story_photo\":true,\"story_video\":true,\"album_photo\":true,\"album_video\":true},\"spintax\":true,\"modules\":[]}',1,'2017-03-18 19:29:19'),(3,'Gamma Pack',17.99,165.79,'{\"storage\":{\"total\":\"300.00\",\"file\":\"50.00\"},\"max_accounts\":-1,\"file_pickers\":{\"dropbox\":true,\"onedrive\":true,\"google_drive\":true},\"post_types\":{\"timeline_photo\":true,\"timeline_video\":true,\"story_photo\":true,\"story_video\":true,\"album_photo\":true,\"album_video\":true},\"spintax\":true}',1,'2017-03-18 19:29:43');
/*!40000 ALTER TABLE `np_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `np_plugins`
--

DROP TABLE IF EXISTS `np_plugins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `np_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idname` (`idname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `np_plugins`
--

LOCK TABLES `np_plugins` WRITE;
/*!40000 ALTER TABLE `np_plugins` DISABLE KEYS */;
/*!40000 ALTER TABLE `np_plugins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `np_posts`
--

DROP TABLE IF EXISTS `np_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `np_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `caption` text COLLATE utf8_unicode_ci NOT NULL,
  `first_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `media_ids` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remove_media` tinyint(1) NOT NULL,
  `account_id` int(11) NOT NULL,
  `is_scheduled` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL,
  `schedule_date` datetime NOT NULL,
  `publish_date` datetime NOT NULL,
  `is_hidden` tinyint(1) NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `np_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `np_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `np_posts`
--

LOCK TABLES `np_posts` WRITE;
/*!40000 ALTER TABLE `np_posts` DISABLE KEYS */;
INSERT INTO `np_posts` VALUES (2,'published',1,'timeline','germani','','','1',0,1,0,'2019-06-23 15:18:12','2019-06-23 15:18:12','2019-06-23 15:18:17',0,'{\"upload_id\":\"573492272050113\",\"pk\":\"2072683030979683350\",\"id\":\"2072683030979683350_14926773652\",\"code\":\"BzDpjwxhiQW\"}');
/*!40000 ALTER TABLE `np_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `np_proxies`
--

DROP TABLE IF EXISTS `np_proxies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `np_proxies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proxy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `use_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `np_proxies`
--

LOCK TABLES `np_proxies` WRITE;
/*!40000 ALTER TABLE `np_proxies` DISABLE KEYS */;
/*!40000 ALTER TABLE `np_proxies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `np_themes`
--

DROP TABLE IF EXISTS `np_themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `np_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idname` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idname` (`idname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `np_themes`
--

LOCK TABLES `np_themes` WRITE;
/*!40000 ALTER TABLE `np_themes` DISABLE KEYS */;
/*!40000 ALTER TABLE `np_themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `np_users`
--

DROP TABLE IF EXISTS `np_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `np_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_subscription` tinyint(1) NOT NULL,
  `settings` text COLLATE utf8_unicode_ci NOT NULL,
  `preferences` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL,
  `expire_date` datetime NOT NULL,
  `date` datetime NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `firstname` (`firstname`),
  KEY `lastname` (`lastname`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `np_users`
--

LOCK TABLES `np_users` WRITE;
/*!40000 ALTER TABLE `np_users` DISABLE KEYS */;
INSERT INTO `np_users` VALUES (1,'admin','admin@admin.com','admin','$2y$10$.jcb5uYa3InFSlkuD4YI4e/hJWnmvjF6LakIjSxOfExYejxU0/4YC','admin','admin',3,1,'{\"storage\":{\"total\":\"300.00\",\"file\":\"50.00\"},\"max_accounts\":-1,\"file_pickers\":{\"dropbox\":true,\"onedrive\":true,\"google_drive\":true},\"post_types\":{\"timeline_photo\":true,\"timeline_video\":true,\"story_photo\":true,\"story_video\":true,\"album_photo\":true,\"album_video\":true},\"spintax\":true}','{\"timezone\":\"UTC\",\"dateformat\":\"Y-m-d\",\"timeformat\":\"24\",\"language\":\"en-US\"}',1,'2030-12-31 23:59:59','2019-06-20 20:13:38','{}');
/*!40000 ALTER TABLE `np_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-24  7:02:02
