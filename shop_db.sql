-- MariaDB dump 10.19  Distrib 10.4.18-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: shop_db
-- ------------------------------------------------------
-- Server version	10.4.18-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_ilosc` int(11) NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `prod_id` (`prod_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `produkty` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (19,5,1,3,'2022-01-20 18:18:27'),(20,5,2,2,'2022-01-20 18:18:27'),(21,5,3,4,'2022-01-20 18:18:27'),(22,5,4,5,'2022-01-20 18:18:27'),(23,5,5,6,'2022-01-20 18:18:27'),(24,5,6,1,'2022-01-20 18:18:27'),(25,5,1,3,'2022-01-20 18:19:39'),(26,5,2,2,'2022-01-20 18:19:39'),(27,5,3,4,'2022-01-20 18:19:39'),(28,5,4,5,'2022-01-20 18:19:39'),(29,5,5,6,'2022-01-20 18:19:39'),(30,5,6,1,'2022-01-20 18:19:39'),(31,5,1,3,'2022-01-20 18:20:22'),(32,5,2,2,'2022-01-20 18:20:22'),(33,5,3,4,'2022-01-20 18:20:22'),(34,5,4,5,'2022-01-20 18:20:22'),(35,5,5,6,'2022-01-20 18:20:22'),(36,5,6,1,'2022-01-20 18:20:22'),(37,5,1,3,'2022-01-20 18:21:15'),(38,5,2,2,'2022-01-20 18:21:15'),(39,5,3,4,'2022-01-20 18:21:15'),(40,5,4,5,'2022-01-20 18:21:15'),(41,5,5,6,'2022-01-20 18:21:15'),(42,5,6,1,'2022-01-20 18:21:15'),(43,5,1,3,'2022-01-20 18:21:56'),(44,5,2,2,'2022-01-20 18:21:56'),(45,5,3,4,'2022-01-20 18:21:56'),(46,5,4,5,'2022-01-20 18:21:56'),(47,5,5,6,'2022-01-20 18:21:56'),(48,5,6,1,'2022-01-20 18:21:56');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produkty`
--

DROP TABLE IF EXISTS `produkty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produkty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `opis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `img` varchar(255) NOT NULL,
  `cena` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produkty`
--

LOCK TABLES `produkty` WRITE;
/*!40000 ALTER TABLE `produkty` DISABLE KEYS */;
INSERT INTO `produkty` VALUES (1,'Aparat Canon EOS','Uchwyć dreszczyk chwili za pomocą łatwej w obsłudze lustrzanki cyfrowej, jej rezultaty Cię zachwycą.','img/aparat.jpg',1800),(2,'Laptop Lenovo ThinkPad','Laptop biznesowy dla profesjonalistów z serii T14, posiada DOTYKOWĄ matrycę FullHD.','img/laptop.jpg',2500),(3,'Tablet Lenovo M7','Zamknięty w klasycznie, kompaktowej obudowie, jest bardziej wytrzymały niż jego poprzednik.','img/tablet.jpg',400),(4,'Smartwatch RS67','Dzięki specjalnemu oprogramowaniu doskonale współgra ze smartfonami, zwiększając ich możliwości.','img/watch.jpg',200),(5,'Smartphone SAMSUNG Galaxy M52','Smartfon Samsung Galaxy M52 5G sprawia, że widzisz świat z całkowicie nowej perspektywy.','img/phone.jpg',1500),(6,'Słuchawki JBL Tune 500BT','Charakteryzują się legendarną jakością brzmienia, pojemną baterią, która pozwala na pracę do 16 godzin, oraz wbudowanym mikrofonem.','img/headset.jpg',150);
/*!40000 ALTER TABLE `produkty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imie` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  `login` text NOT NULL,
  `haslo` text NOT NULL,
  `email` text NOT NULL,
  `kodp` text NOT NULL,
  `adres` text CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'','','admin','Admin1!','','',''),(5,'Adam','Kowalski','akowalski','12345','akowalski@gmail.com','03-200','Zakopane 13');
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

-- Dump completed on 2022-02-01 12:08:49
