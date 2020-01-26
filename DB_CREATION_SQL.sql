CREATE DATABASE  IF NOT EXISTS `bitter_marcub` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bitter_marcub`;
-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: bitter_marcub
-- ------------------------------------------------------
-- Server version	5.7.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `follows`
--

DROP TABLE IF EXISTS `follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `follows` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  PRIMARY KEY (`follow_id`),
  KEY `FK_follows` (`from_id`),
  KEY `FK_follows2` (`to_id`),
  CONSTRAINT `FK_follows` FOREIGN KEY (`from_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `FK_follows2` FOREIGN KEY (`to_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follows`
--

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
INSERT INTO `follows` VALUES (44,29,39),(45,29,36),(46,39,29),(47,39,36),(48,39,38),(49,29,38),(50,29,41),(51,72,67),(52,72,36),(53,72,38);
/*!40000 ALTER TABLE `follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`like_id`),
  KEY `FK_tweet_id_idx` (`tweet_id`),
  KEY `FK_user_id_idx` (`user_id`),
  CONSTRAINT `FK_tweet_id` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`tweet_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tweets`
--

DROP TABLE IF EXISTS `tweets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tweets` (
  `tweet_id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_text` varchar(280) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `original_tweet_id` int(11) NOT NULL DEFAULT '0',
  `reply_to_tweet_id` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tweet_id`),
  KEY `FK_tweets` (`user_id`),
  CONSTRAINT `FK_tweets` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweets`
--

LOCK TABLES `tweets` WRITE;
/*!40000 ALTER TABLE `tweets` DISABLE KEYS */;
INSERT INTO `tweets` VALUES (29,'This is Nick\'s Tweet.',29,0,0,'2019-11-18 20:46:51'),(31,'This is Marcus\'s tweet',39,0,0,'2019-11-18 20:49:25'),(32,'This is Nick\'s Tweet.',39,29,0,'2019-11-18 20:49:49'),(35,'Replying to Nick\'s tweet',29,0,32,'2019-11-19 04:23:31'),(36,'Gim gym gyim!',38,0,0,'2019-11-22 04:50:00'),(37,'Christ is Awesomeway',29,0,0,'2019-12-06 01:24:28'),(38,'It\'s icy!',72,0,0,'2019-12-09 12:52:56'),(39,'Gim gym gyim!',72,36,0,'2019-12-09 12:54:59'),(40,'yes!',72,0,36,'2019-12-09 12:55:37'),(41,'DA',29,0,0,'2020-01-02 17:06:18');
/*!40000 ALTER TABLE `tweets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `screen_name` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `address` varchar(200) NOT NULL,
  `province` varchar(50) NOT NULL,
  `postal_code` varchar(7) NOT NULL,
  `contact_number` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url` varchar(50) NOT NULL,
  `description` varchar(160) NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_pic` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (29,'Nick','T','nick','$2y$10$iZ/lr4uozU9VC3HEwXyPk.Eo4Ig1ExsQLrfJtLV6jWyXhWrDZsm7C','NBCC Campus','New Brunswick','E6L 1W1','123 123 1234','nickt@nbcc.ca','nbcc.ca','Bestestest Instructor','Always on bitter','2019-10-22 01:35:57',''),(36,'Josh','KD','joshKD','$2y$10$3MRtECpRK0BBbRrJ1Ca4Uu07eltlILW/M91WKMm2wiqPrL2UViz6O','School','Saskatchewan','a1a 1a1','123 123 1234','joshkd@email.ca','','','','2019-11-13 18:59:27',''),(38,'Ryan','C','ryanC','$2y$10$CFB0YBUyDW.3EWRW/jziQecF03xvRzWjzBcT/zsIdV62wm/od1t8u','School','Alberta','a1a 1a1','123 123 1234','ryanc@email.ca','','','','2019-11-13 19:09:34',''),(39,'Marcus','Balogh','marcusB','$2y$10$B/rEbw5J./Rz.VyrYZVhTOgsnrs/HKy0LfUUrDxOnD0FX1C.6PkdS','School','New Brunswick','a1a 1a1','123 123 1234','mb@email.ca','','','','2019-11-14 03:09:30',''),(40,'test','test','test','$2y$10$e7ftmtZJjwaP/DDMHe8FfeIqOe7AIeDYuqgBgkP4KuDUiBkUiJMC2','asd','Saskatchewan','a1a 1a1','123 123 1234','test@email.c','s','s','s','2019-11-20 18:49:07',NULL),(41,'Marcus','test','tess','$2y$10$My09EDWsBk8c3r0RoBsTJOV0vL.QMzYJT8R0suWYf0kA0Y5Pz0rYi','160 Tripp Settlement Rd.','British Columbia','E6L 1W1','123 123 1234','test@email.c','','','Keswick Ridge','2019-11-22 03:55:50',NULL),(63,'Alfrednya','Hessel','Alfrednya.Hesse','$2y$10$BznV9LBWpWrHRnx954OPXuOn7VbIYXwC0oxatL4PsR1QOKWeFZLj.','1991 O\'Conner Drives','New Brunswick','E3B 1C2','123 123 1234','Alfrednya.Hessel@gmail.com','www.faker.com','3-D','Sporerborough','2019-12-07 18:44:12',NULL),(64,'Shinnya','Kunze','Shinnya.Kunze12','$2y$10$NPGPVOazhntrYLjLJHkswO4oBC0U1uifzTKKR3lELbDwfalKZ/XLe','05312 Weissnat Street','New Brunswick','E3B 1C2','123 123 1234','notmyemail@gmail','www.faker.com','3-D','Nevillemouth','2019-12-07 18:44:40',NULL),(65,'Lenardnya','Lockman','Lenardnya.Lockm','$2y$10$TnpmQqIAk7HwfskZByMw7eSzVDwmp4IJopmUxA.scq9zbfagu8PPu','051 Robby Mountains','New Brunswick','E3B 1C2','123 123 1234','notmyemail@gmail.wayToLongEmailDomainEnding','www.faker.com','Biff Tannen','East Stewart','2019-12-07 18:44:48',NULL),(66,'Rileynya','Huels','Rileynya.Huels1','$2y$10$t0cvtYOpe/A3WLeFm/UEXO/ooZUM8Ymrbt1I2OnOEWmSgg7gWR8xS','8792 Phil Land','New Brunswick','E3B 1C2','123 123 1234','Rileynya.Huels@gmail.com','www.faker.com','Lorraine Baines','Port Juan','2019-12-07 20:11:00',NULL),(67,'Romeonya','Wuckert','Romeonya.Wucker','$2y$10$FqgvJdOWRBQYXl..y4qf6e5ywut66Ud8ozt7jRJg9jXZeajz70qAW','3702 Yundt Stream','New Brunswick','E3B 1C2','123 123 1234','notmyemail@gmail','www.faker.com','Red The Bum','East Rudolf','2019-12-07 20:11:28',NULL),(68,'Tiaranya','Olson','Tiaranya.Olson1','$2y$10$dFbxkND9ww79DNx29/LyNuTuAUzf3DkT6shjIJ/Zpoo/bjyMB8zmC','71291 Sunshine Dam','New Brunswick','E3B 1C2','123 123 1234','notmyemail@gmail.wayToLongEmailDomainEnding','www.faker.com','Biff Tannen','Ernietown','2019-12-07 20:11:36',NULL),(69,'Alfonzonya','Miller','972mqg229565nyn','$2y$10$GazKv6cA2Ni503UdJpjCFekCB0GsVNZjf6imuSz.ReoMhve4cxl9e','342 Bogisich Loaf','New Brunswick','E3B 1C2','123 123 1234','Alfonzonya.Miller@gmail.com','www.faker.com','Dave McFly','Tasiashire','2019-12-07 20:13:01',NULL),(70,'Olennya','Herman','Olennya.Herman1','$2y$10$MdWh4N7bebNC06UKiVRUhe2OFJrZUqKMwyrXJAjggqa6DRDe.VGMS','04424 Beier Common','New Brunswick','E3B 1C2','123 123 1234','Olennya.Herman@gmail.com','www.faker.com','Goldie Wilson','Lake Basil','2019-12-07 20:14:41',NULL),(71,'Ernestnya','Greenholt','Ernestnya.Green','$2y$10$AVOO9KQisGYFHLZhcdkiPegL1/tDsTlyuyb8YUTpsVSjjiN8kCI16','02760 Althea River','New Brunswick','E3B 1C2','123 123 1234','Ernestnya.Greenholt@gmail.com','www.faker.com','Red The Bum','North Francisco','2019-12-08 03:05:08',NULL),(72,'Lucy','Jones','ljones','$2y$10$ZM7tJe1FyruKaw5vzKZWUeRGsa3DrMpBQBIj1YyKIGEIxr/rGkXNK','111 Main Street','New Brunswick','E3B 5A2','111 222 3344','lucyjones@gmail.com','www.lucyjones.com','Coffee lover','Fredericton','2019-12-09 12:51:09',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-25 22:55:12
