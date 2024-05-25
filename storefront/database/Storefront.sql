CREATE DATABASE  IF NOT EXISTS `storefront` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `storefront`;
-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: storefront
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `entity_cartitems`
--

DROP TABLE IF EXISTS `entity_cartitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_cartitems` (
  `id_cartitem` mediumint(7) NOT NULL AUTO_INCREMENT,
  `id_item` mediumint(7) DEFAULT NULL,
  `quant` mediumint(7) DEFAULT NULL,
  PRIMARY KEY (`id_cartitem`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_cartitems`
--

LOCK TABLES `entity_cartitems` WRITE;
/*!40000 ALTER TABLE `entity_cartitems` DISABLE KEYS */;
INSERT INTO `entity_cartitems` VALUES (1,3,5),(2,7,1),(3,8,1);
/*!40000 ALTER TABLE `entity_cartitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_catalogitems`
--

DROP TABLE IF EXISTS `entity_catalogitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_catalogitems` (
  `id_catalogitem` mediumint(7) NOT NULL,
  `price` float(12,2) DEFAULT NULL,
  `quant` mediumint(7) DEFAULT NULL,
  PRIMARY KEY (`id_catalogitem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_catalogitems`
--

LOCK TABLES `entity_catalogitems` WRITE;
/*!40000 ALTER TABLE `entity_catalogitems` DISABLE KEYS */;
INSERT INTO `entity_catalogitems` VALUES (1,3.99,1000000),(2,1.49,10000),(3,0.99,100000),(4,5.99,10000),(5,3.99,1000),(6,11.99,1000),(7,4.99,10000),(8,3.99,100);
/*!40000 ALTER TABLE `entity_catalogitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_items`
--

DROP TABLE IF EXISTS `entity_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_items` (
  `id_item` mediumint(7) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `desc` varchar(50) DEFAULT NULL,
  `id_catalogitem` mediumint(5) DEFAULT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_items`
--

LOCK TABLES `entity_items` WRITE;
/*!40000 ALTER TABLE `entity_items` DISABLE KEYS */;
INSERT INTO `entity_items` VALUES (1,'Toothbrush','(1) generic toothbrush',1),(2,'Toothpaste','(1) generic toothpaste',2),(3,'Soap','(1) generic bar soap',3),(4,'Tissue Paper','(1) generic tissue paper',4),(5,'Shower Sponge','(1) generic shower sponge',5),(6,'Nail Clipper','(1) quality nail clipper',6),(7,'Shampoo','(1) generic shampoo',7),(8,'Apples','(6) tasy apples',8);
/*!40000 ALTER TABLE `entity_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_orderitems`
--

DROP TABLE IF EXISTS `entity_orderitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_orderitems` (
  `id_orderitem` mediumint(7) NOT NULL AUTO_INCREMENT,
  `id_item` mediumint(7) DEFAULT NULL,
  `quant` mediumint(7) DEFAULT NULL,
  `price_per_unit` float(12,2) DEFAULT NULL,
  PRIMARY KEY (`id_orderitem`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_orderitems`
--

LOCK TABLES `entity_orderitems` WRITE;
/*!40000 ALTER TABLE `entity_orderitems` DISABLE KEYS */;
INSERT INTO `entity_orderitems` VALUES (1,1,2,3.99),(2,2,1,1.49);
/*!40000 ALTER TABLE `entity_orderitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_orders`
--

DROP TABLE IF EXISTS `entity_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_orders` (
  `id_order` mediumint(7) NOT NULL AUTO_INCREMENT,
  `oder_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_orders`
--

LOCK TABLES `entity_orders` WRITE;
/*!40000 ALTER TABLE `entity_orders` DISABLE KEYS */;
INSERT INTO `entity_orders` VALUES (1,'2024-05-18 12:00:00');
/*!40000 ALTER TABLE `entity_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_users`
--

DROP TABLE IF EXISTS `entity_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_users` (
  `id_user` mediumint(7) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_users`
--

LOCK TABLES `entity_users` WRITE;
/*!40000 ALTER TABLE `entity_users` DISABLE KEYS */;
INSERT INTO `entity_users` VALUES (8,'hansintheair@email.com','$2y$10$ok101JjiFWgTyAF5mvGPj.NQo1hxVtEKZzOoklhGnHnNBfcVTILWe',0);
/*!40000 ALTER TABLE `entity_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xref_orders_orderitems`
--

DROP TABLE IF EXISTS `xref_orders_orderitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xref_orders_orderitems` (
  `id_orders_orderitems` mediumint(7) NOT NULL AUTO_INCREMENT,
  `id_order` mediumint(7) DEFAULT NULL,
  `id_orderitem` mediumint(7) DEFAULT NULL,
  PRIMARY KEY (`id_orders_orderitems`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xref_orders_orderitems`
--

LOCK TABLES `xref_orders_orderitems` WRITE;
/*!40000 ALTER TABLE `xref_orders_orderitems` DISABLE KEYS */;
INSERT INTO `xref_orders_orderitems` VALUES (1,1,1),(2,1,2);
/*!40000 ALTER TABLE `xref_orders_orderitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xref_users_cartitems`
--

DROP TABLE IF EXISTS `xref_users_cartitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xref_users_cartitems` (
  `id_user_cartitem` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) DEFAULT NULL,
  `id_cartitem` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_user_cartitem`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xref_users_cartitems`
--

LOCK TABLES `xref_users_cartitems` WRITE;
/*!40000 ALTER TABLE `xref_users_cartitems` DISABLE KEYS */;
INSERT INTO `xref_users_cartitems` VALUES (1,8,1),(2,8,2),(3,8,3);
/*!40000 ALTER TABLE `xref_users_cartitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xref_users_orders`
--

DROP TABLE IF EXISTS `xref_users_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xref_users_orders` (
  `id_user_orders` mediumint(7) NOT NULL AUTO_INCREMENT,
  `id_user` mediumint(7) DEFAULT NULL,
  `id_order` mediumint(7) DEFAULT NULL,
  PRIMARY KEY (`id_user_orders`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xref_users_orders`
--

LOCK TABLES `xref_users_orders` WRITE;
/*!40000 ALTER TABLE `xref_users_orders` DISABLE KEYS */;
INSERT INTO `xref_users_orders` VALUES (1,1,1);
/*!40000 ALTER TABLE `xref_users_orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-25 13:07:19
