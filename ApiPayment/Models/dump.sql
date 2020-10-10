CREATE DATABASE  IF NOT EXISTS `payment` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `payment`;
-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: payment
-- ------------------------------------------------------
-- Server version	8.0.21

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
-- Dumping data for table `card`
--

LOCK TABLES `card` WRITE;
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` VALUES (1,'card_ckdyzax9807e5ek6efd8kkjgx','amex','4836',106,106,'2020-08-17 17:36:38','2020-08-17 17:36:38'),(2,'card_ckdyzco5807blrn6d7g82hrb1','visa','8195',116,116,'2020-08-17 17:38:00','2020-08-17 17:38:00'),(3,'card_ckdyzcorg07iief6ebkm3j1cg','visa','7490',120,120,'2020-08-17 17:38:01','2020-08-17 17:38:01'),(4,'card_ckdyzcpbv07ijef6eaxdt6oqt','elo','6017',109,109,'2020-08-17 17:38:02','2020-08-17 17:38:02'),(5,'card_ckdyzcqn9075ry06fbqye8qwj','discover','6671',111,111,'2020-08-17 17:38:03','2020-08-17 17:38:03'),(6,'card_ckdyzcr8607iky16fuio3fbfs','visa','3862',108,108,'2020-08-17 17:38:04','2020-08-17 17:38:04'),(7,'card_ckdyzcrtv07ily16fs95k37hn','amex','4379',102,102,'2020-08-17 17:38:05','2020-08-17 17:38:05'),(8,'card_ckdyzcsdo07edek6epga7iuj6','mastercard','1981',102,102,'2020-08-17 17:38:05','2020-08-17 17:38:05'),(9,'card_ckdyzcszz07r3rs6dl84kef57','amex','8468',104,104,'2020-08-17 17:38:06','2020-08-17 17:38:06'),(10,'card_ckdyzctju07eeek6e53w6ge78','elo','5466',103,103,'2020-08-17 17:38:07','2020-08-17 17:38:07'),(11,'card_ckdyzcu3407bmrn6d12d7byrw','visa','4654',104,104,'2020-08-17 17:38:07','2020-08-17 17:38:07'),(12,'card_ckdyzcv5y07efek6etu8omuv1','mastercard','8409',117,117,'2020-08-17 17:38:09','2020-08-17 17:38:09'),(13,'card_ckdyzcwc707egek6ezxpuy17m','mastercard','0288',119,119,'2020-08-17 17:38:10','2020-08-17 17:38:10'),(14,'card_ckdyzcwwz075vy06f2ameyl3j','mastercard','1293',122,122,'2020-08-17 17:38:11','2020-08-17 17:38:11'),(15,'card_ckdyzczcq075wy06f975c2hsg','discover','8734',113,113,'2020-08-17 17:38:15','2020-08-17 17:38:15'),(16,'card_ckdyzd05607r5rs6dg2z8743i','visa','9646',112,112,'2020-08-17 17:38:15','2020-08-17 17:38:15'),(17,'card_ckdyzd0ow07eiek6ed531e4cn','mastercard','3839',105,105,'2020-08-17 17:38:16','2020-08-17 17:38:16'),(18,'card_ckdyzd1f607ejek6e7nuhut2m','amex','9216',103,103,'2020-08-17 17:38:17','2020-08-17 17:38:17'),(19,'card_ckdyzd2gd07ekek6eggpdg0kw','visa','6926',107,107,'2020-08-17 17:38:18','2020-08-17 17:38:18'),(20,'card_ckdyzd31007r6rs6d9hwveg9z','visa','5522',102,102,'2020-08-17 17:38:19','2020-08-17 17:38:19'),(21,'card_ckdyzd3kp07imy16fhr528gz6','elo','2374',120,120,'2020-08-17 17:38:20','2020-08-17 17:38:20'),(22,'card_ckdyzd44z07iny16fr8wlcyt4','amex','3454',120,120,'2020-08-17 17:38:21','2020-08-17 17:38:21'),(23,'card_ckdyzd4tr07bprn6dtl6epbx7','discover','5491',110,110,'2020-08-17 17:38:21','2020-08-17 17:38:21'),(24,'card_ckdyzd5d207r7rs6dxhoiek76','visa','3667',107,107,'2020-08-17 17:38:22','2020-08-17 17:38:22'),(25,'card_ckdyzd5ym07bqrn6dnf9me5xx','mastercard','3662',113,113,'2020-08-17 17:38:23','2020-08-17 17:38:23'),(26,'card_ckdyzd75y07brrn6dt5fncw45','mastercard','3699',106,106,'2020-08-17 17:38:24','2020-08-17 17:38:24'),(27,'card_ckdyzd7pf07ikef6eys80pw4i','discover','0583',104,104,'2020-08-17 17:38:25','2020-08-17 17:38:25'),(28,'card_ckdyzd8yw07ioy16fldelp90b','diners','5102',104,104,'2020-08-17 17:38:27','2020-08-17 17:38:27'),(29,'card_ckdyzd9hd0760y06f99il3bfq','visa','3371',118,118,'2020-08-17 17:38:27','2020-08-17 17:38:27'),(30,'card_ckdyzda1b07bsrn6d2e5ql9v6','hipercard','0471',108,108,'2020-08-17 17:38:28','2020-08-17 17:38:28'),(31,'card_ckdyzdaka07ilef6etz7yx7rc','visa','3585',119,119,'2020-08-17 17:38:29','2020-08-17 17:38:29'),(32,'card_ckdyzdbf307r9rs6d5ym43mi4','mastercard','8075',117,117,'2020-08-17 17:38:30','2020-08-17 17:38:30'),(33,'card_ckdyzdcl507rars6da7z2kecy','visa','2554',106,106,'2020-08-17 17:38:31','2020-08-17 17:38:31'),(34,'card_ckdyzdd5y07imef6eut9yzyyj','visa','7176',108,108,'2020-08-17 17:38:32','2020-08-17 17:38:32'),(35,'card_ckdyzddpo07btrn6dv273dtes','hipercard','6403',102,102,'2020-08-17 17:38:33','2020-08-17 17:38:33'),(36,'card_ckdyzdesn07ipy16f7dxap1mf','mastercard','3470',112,112,'2020-08-17 17:38:34','2020-08-17 17:38:34'),(37,'card_ckdyzdfco07ioef6eon3j2lky','visa','9798',121,121,'2020-08-17 17:38:35','2020-08-17 17:38:35'),(38,'card_ckdyzdfwy07ipef6exd2v507e','elo','1954',106,106,'2020-08-17 17:38:36','2020-08-17 17:38:36'),(39,'card_ckdyzdgga07burn6d0yf2i8e0','visa','6638',115,115,'2020-08-17 17:38:36','2020-08-17 17:38:36'),(40,'card_ckdyzdh0t07iqef6ey782x5w4','mastercard','2458',103,103,'2020-08-17 17:38:37','2020-08-17 17:38:37'),(41,'card_ckdyzdhk007iref6emjbmfji5','visa','0856',119,119,'2020-08-17 17:38:38','2020-08-17 17:38:38'),(42,'card_ckdyzdi2l07bvrn6d7ewxk9k6','mastercard','4624',108,108,'2020-08-17 17:38:39','2020-08-17 17:38:39'),(43,'card_ckdyzdim90762y06fm3rr8m4x','discover','2635',118,118,'2020-08-17 17:38:39','2020-08-17 17:38:39'),(44,'card_ckdyzdj600763y06f8wrg3pzw','visa','5896',115,115,'2020-08-17 17:38:40','2020-08-17 17:38:40'),(45,'card_ckdyzdjpn07bwrn6dk52i39oj','mastercard','6768',109,109,'2020-08-17 17:38:41','2020-08-17 17:38:41'),(46,'card_ckdyzdk9b07iqy16fbmaprann','visa','0305',121,121,'2020-08-17 17:38:41','2020-08-17 17:38:41'),(47,'card_ckdyzdksw07isef6ekh6iblip','visa','9793',113,113,'2020-08-17 17:38:42','2020-08-17 17:38:42'),(48,'card_ckdyzdlf207bxrn6d4hl6knk9','mastercard','3869',114,114,'2020-08-17 17:38:43','2020-08-17 17:38:43'),(49,'card_ckdyzdlzd07itef6e9k8h6q6n','visa','2718',113,113,'2020-08-17 17:38:44','2020-08-17 17:38:44'),(50,'card_ckdyzdmkq07byrn6dq7spm1qt','visa','5985',110,110,'2020-08-17 17:38:44','2020-08-17 17:38:44'),(51,'card_ckdyzdn3i07bzrn6d69dqd69f','visa','3657',115,115,'2020-08-17 17:38:45','2020-08-17 17:38:45'),(52,'card_ckdyzdnmw07elek6e7pe1r2ps','aura','8323',114,114,'2020-08-17 17:38:46','2020-08-17 17:38:46');
/*!40000 ALTER TABLE `card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (102,'Dr. Valéria Maitê Galindo','45304047656','padrao.thiago@gmail.com','1983-07-02','+55953201211','2020-08-17 16:38:11','2020-08-17 16:38:11'),(103,'Michele Rafaela Bittencourt','23580384902','estrada.santiago@tamoio.com','1975-05-31','+55985355644','2020-08-17 16:38:59','2020-08-17 16:38:59'),(104,'Sra. Mel Rebeca Maia Jr.','73825559840','simon.faria@leal.org','1977-07-20','+55946555724','2020-08-17 16:38:59','2020-08-17 16:38:59'),(105,'Allison Soares Neto','54605680306','cmeireles@dasneves.net.br','2019-04-22','+55961067903','2020-08-17 16:39:00','2020-08-17 16:39:00'),(106,'Sr. Mateus Alonso Ávila','70697593630','constancia48@mascarenhas.com','1985-10-20','+55929376312','2020-08-17 16:39:00','2020-08-17 16:39:00'),(107,'Sra. Hortência Faro Leon Jr.','40359962548','hsantacruz@hotmail.com','1986-11-09','+55924086285','2020-08-17 16:39:01','2020-08-17 16:39:01'),(108,'Dr. Tomás Aaron Rezende Filho','27409169575','oliveira.pedro@gmail.com','1990-03-24','+55918384887','2020-08-17 16:39:01','2020-08-17 16:39:01'),(109,'Luciana Lozano','48203104371','norma.pena@sepulveda.net','2019-03-31','+55960161526','2020-08-17 16:39:02','2020-08-17 16:39:02'),(110,'Dr. Carlos Meireles Prado Neto','28339393618','kcervantes@uol.com.br','1971-01-25','+55959590942','2020-08-17 16:39:02','2020-08-17 16:39:02'),(111,'Emiliano Ortiz Jr.','87346938232','silvana.rangel@yahoo.com','1980-01-03','+55960085937','2020-08-17 16:39:03','2020-08-17 16:39:03'),(112,'Dr. Simão Benjamin Tamoio Jr.','38455427132','salas.vicente@terra.com.br','1996-09-18','+55931474886','2020-08-17 16:39:03','2020-08-17 16:39:03'),(113,'Sr. Gabriel Vila Filho','14650366283','bfernandes@terra.com.br','2005-08-23','+55970695800','2020-08-17 16:39:04','2020-08-17 16:39:04'),(114,'Dr. Joaquin Ferminiano','91165261049','diego21@estrada.org','2008-05-19','+55995225179','2020-08-17 16:39:04','2020-08-17 16:39:04'),(115,'Dr. Sophie Benites Sobrinho','06494643540','clara37@ig.com.br','2013-10-09','+55912249496','2020-08-17 16:39:05','2020-08-17 16:39:05'),(116,'Gabriela Sandoval D\'ávila','38082996498','irene46@flores.net.br','2004-04-08','+55928531103','2020-08-17 16:39:05','2020-08-17 16:39:05'),(117,'Catarina Gabriela Rangel Jr.','91645101665','gabriela30@terra.com.br','2016-06-22','+55986377891','2020-08-17 16:39:06','2020-08-17 16:39:06'),(118,'Pablo Branco Jr.','83861793768','suzana.esteves@terra.com.br','1992-06-14','+55971418376','2020-08-17 16:39:06','2020-08-17 16:39:06'),(119,'Dr. Mel Sanches','55714316444','allison.gil@hotmail.com','1997-09-05','+55912692562','2020-08-17 16:39:06','2020-08-17 16:39:06'),(120,'Srta. Andrea Aragão Jr.','54390472470','tmarin@yahoo.com','1989-10-18','+55971536565','2020-08-17 16:39:07','2020-08-17 16:39:07'),(121,'Fernando Joaquin Carmona Neto','68281783273','garcia.christian@matias.com','1983-05-30','+55995355926','2020-08-17 16:39:07','2020-08-17 16:39:07'),(122,'Srta. Suzana Aranda','51611824664','manuela77@ig.com.br','1984-08-04','+55951570633','2020-08-17 16:39:08','2020-08-17 16:39:08');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `clients_has_gateway`
--

LOCK TABLES `clients_has_gateway` WRITE;
/*!40000 ALTER TABLE `clients_has_gateway` DISABLE KEYS */;
INSERT INTO `clients_has_gateway` VALUES (102,'3589749',102,1),(103,'3589751',103,1),(104,'3589752',104,1),(105,'3589753',105,1),(106,'3589754',106,1),(107,'3589755',107,1),(108,'3589756',108,1),(109,'3589757',109,1),(110,'3589758',110,1),(111,'3589759',111,1),(112,'3589760',112,1),(113,'3589761',113,1),(114,'3589762',114,1),(115,'3589763',115,1),(116,'3589764',116,1),(117,'3589765',117,1),(118,'3589766',118,1),(119,'3589767',119,1),(120,'3589769',120,1),(121,'3589771',121,1),(122,'3589772',122,1);
/*!40000 ALTER TABLE `clients_has_gateway` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `gateway`
--

LOCK TABLES `gateway` WRITE;
/*!40000 ALTER TABLE `gateway` DISABLE KEYS */;
INSERT INTO `gateway` VALUES (1,'pagarme');
/*!40000 ALTER TABLE `gateway` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-18  7:52:37
