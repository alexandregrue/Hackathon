-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: localhost    Database: lyrics
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blind_test`
--

DROP TABLE IF EXISTS `blind_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blind_test` (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blind_test`
--

LOCK TABLES `blind_test` WRITE;
/*!40000 ALTER TABLE `blind_test` DISABLE KEYS */;
INSERT INTO `blind_test` VALUES (1,'/assets/songs/BlindTest/beyonce_sweetdreams.mp3','Beyoncé','Sweet dreams'),(2,'/assets/songs/BlindTest/damso_macarena.mp3','Damso','Macarena'),(3,'/assets/songs/BlindTest/travisscott_butterflyeffect.mp3','Travis Scott','Butterfly Effect');
/*!40000 ALTER TABLE `blind_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fake_audience`
--

DROP TABLE IF EXISTS `fake_audience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fake_audience` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lyrics` varchar(255) DEFAULT NULL,
  `id_lyrics` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fake_audience`
--

LOCK TABLES `fake_audience` WRITE;
/*!40000 ALTER TABLE `fake_audience` DISABLE KEYS */;
/*!40000 ALTER TABLE `fake_audience` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lyrics`
--

DROP TABLE IF EXISTS `lyrics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lyrics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `timestamp_start` smallint NOT NULL,
  `timestamp_end` smallint NOT NULL,
  `lyrics_display` text NOT NULL,
  `lyrics_to_guess` varchar(255) NOT NULL,
  `difficulty` tinyint NOT NULL,
  `id_song` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_id_song` (`id_song`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lyrics`
--

LOCK TABLES `lyrics` WRITE;
/*!40000 ALTER TABLE `lyrics` DISABLE KEYS */;
INSERT INTO `lyrics` VALUES (2,0,0,'La bohème, la bohème Nous ne mangions','qu\'un jour sur deux',0,2),(3,0,0,'C\'est là qu\'on s\'est connu Moi qui criait famine','Et toi qui posais nue',0,3),(4,0,0,'On n\'pense pas, Monsieur On n\'pense pas','On prie',0,4),(5,0,0,'Dans l\'église, qui roupille Raide comme une saillie','un cierge de Pâques',0,5),(6,0,0,'I\'ve lost my mind, I\'ve spent the night','on the floor of my bathroom',0,6),(7,0,0,'Now you can be a better man for your','brand-new girl',0,7),(8,0,0,'Some fairytale bliss Just something I can turn to','Somebody I can miss',0,8),(9,0,0,'The legends and the myths The testaments they told The moon','and its eclipse',0,9),(10,0,0,'Ce rythme qui t\'entraîne jusqu\'au bout de la nuit Réveille en toi le','tourbillon d\'un vent de folie',0,10),(11,0,0,'Dans un placard tes idées noires Les notes pourront se danser','Et nous reviendrons les chanter',0,11);
/*!40000 ALTER TABLE `lyrics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `song`
--

DROP TABLE IF EXISTS `song`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `song` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mp3_link` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `artist` varchar(255) DEFAULT NULL,
  `cover_link` varchar(255) DEFAULT NULL,
  `time` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `song`
--

LOCK TABLES `song` WRITE;
/*!40000 ALTER TABLE `song` DISABLE KEYS */;
INSERT INTO `song` VALUES (2,'/assets/songs/Charles-Aznavour-LaBoheme-refrain.mp3','La Bohème','Charles Aznavour','/assets/images/covers/laboheme_refrain.png',21),(3,'/assets/songs/Charles-Aznavour-LaBoheme-couplet.mp3','La Bohème','Charles Aznavour','/assets/images/covers/laboheme_couplet.png',21),(4,'/assets/songs/Jacques-Brel-CesGensLa-refrain.mp3','Ces gens là','Jacques Brel','/assets/images/covers/cesgenslà_refrain.png',10),(5,'/assets/songs/Jacques-Brel-CesGensLa-couplet.mp3','Ces gens là','Jacques Brel','/assets/images/covers/cesgenslà_couplet.png',11),(6,'/assets/songs/Olivia-Rodrigo-Good4U-refrain.mp3','Good 4 U','Olivia Rodrigo','/assets/images/covers/good4u_refrain.png',15),(7,'/assets/songs/Olivia-Rodrigo-Good4U-couplet.mp3','Good 4 U','Olivia Rodrigo','/assets/images/covers/good4u_couplet.png',19),(8,'/assets/songs/ColdPlay-feat-TheChainsmokers-SomethingJustLikeThis-refrain.mp3','Something just like this','Coldplay ft. The Chainsmokers','/assets/images/covers/somethingjustlikethis.png',16),(9,'/assets/songs/ColdPlay-feat-TheChainsmokers-SomethingJustLikeThis-couplet.mp3','Something just like this','Coldplay ft. The Chainsmokers','/assets/images/covers/somethingjustlikethis.png',7),(10,'/assets/songs/DebutdeSoiree-NuitDeFolie-refrain.mp3','Nuit De Folie','Début de Soirée','/assets/images/covers/nuitdefolie_refrain.png',12),(11,'/assets/songs/DebutdeSoiree-NuitDeFolie-couplet.mp3','Nuit De Folie','Début de Soirée','/assets/images/covers/nuitdefolie_couplet.png',13);
/*!40000 ALTER TABLE `song` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-26 12:30:26
