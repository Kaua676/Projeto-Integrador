CREATE DATABASE  IF NOT EXISTS `projeto` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `projeto`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: projeto
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `pj`
--

DROP TABLE IF EXISTS `pj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `pj` (
  `id` int NOT NULL AUTO_INCREMENT,
  `im` varchar(12) DEFAULT NULL,
  `nome_fantasia` varchar(100) DEFAULT NULL,
  `data_abertura` date DEFAULT NULL,
  `capital_social` float DEFAULT NULL,
  `cnpj_id` int DEFAULT NULL,
  `endereco_id` int DEFAULT NULL,
  `horario_id` int DEFAULT NULL,
  `natureza_juridica_id` int DEFAULT NULL,
  `regime_federal_id` int DEFAULT NULL,
  `situacao_id` int DEFAULT NULL,
  `enquadramento_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `im` (`im`),
  KEY `pj_ibfk_1` (`cnpj_id`),
  KEY `pj_ibfk_2` (`endereco_id`),
  KEY `pj_ibfk_3` (`horario_id`),
  KEY `pj_ibfk_4` (`natureza_juridica_id`),
  KEY `pj_ibfk_5` (`regime_federal_id`),
  KEY `situacao_id` (`situacao_id`),
  KEY `enquadramento_id` (`enquadramento_id`),
  CONSTRAINT `pj_ibfk_1` FOREIGN KEY (`cnpj_id`) REFERENCES `cnpj` (`id`),
  CONSTRAINT `pj_ibfk_2` FOREIGN KEY (`endereco_id`) REFERENCES `endereco` (`id`),
  CONSTRAINT `pj_ibfk_3` FOREIGN KEY (`horario_id`) REFERENCES `horario` (`id`),
  CONSTRAINT `pj_ibfk_4` FOREIGN KEY (`natureza_juridica_id`) REFERENCES `natureza_juridica` (`id`),
  CONSTRAINT `pj_ibfk_5` FOREIGN KEY (`regime_federal_id`) REFERENCES `regime_federal` (`id`),
  CONSTRAINT `pj_ibfk_6` FOREIGN KEY (`situacao_id`) REFERENCES `situacao` (`id`),
  CONSTRAINT `pj_ibfk_7` FOREIGN KEY (`enquadramento_id`) REFERENCES `enquadramento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pj`
--

LOCK TABLES `pj` WRITE;
/*!40000 ALTER TABLE `pj` DISABLE KEYS */;
INSERT INTO `pj` VALUES (1,'287200108','Teste Projeto','2024-05-04',1000,1,1,NULL,1,1,1,NULL),(2,'28437539-0','AG Modas','2022-10-15',2000,3,3,NULL,1,1,1,NULL);
/*!40000 ALTER TABLE `pj` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-07 13:24:29
