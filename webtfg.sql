-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: webtfg
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

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
-- Table structure for table `problem`
--

DROP TABLE IF EXISTS `problem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `problem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `route` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visibility` varchar(255) NOT NULL,
  `memory` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `language` varchar(50) NOT NULL,
  `subject_id` int NOT NULL,
  `edited` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `AsignaturaID` (`subject_id`),
  CONSTRAINT `problem_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problem`
--

LOCK TABLES `problem` WRITE;
/*!40000 ALTER TABLE `problem` DISABLE KEYS */;
INSERT INTO `problem` VALUES (171,'../app/problemes/0/Progamació de classes i headers','Progamació de classes i headers','Classes de C++','Public','1','1','C++',0,0),(172,'../app/problemes/2/Classes de Python','Classes de Python','Classes de Python','Public','1','1','Python',2,0),(173,'./../app/problemes/2/Clearly a test good','Clearly a test good','    ','Public','1','1','Python',2,0),(175,'../app/problemes/6/Jupyter problem','Jupyter problem ','Jupyter problem ','Public','1','1','Notebook',6,0);
/*!40000 ALTER TABLE `problem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `professor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor`
--

LOCK TABLES `professor` WRITE;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` VALUES (1,'Pepe','Viyuela','$2y$10$eNxpgdh1Qk5r5HQdo7DzeeF.lhNjJsEmPAwfnsPSTgt7wlc9xOfpy','punyetazo@gmail.com'),(3,'as','Youssef','$2y$10$eNxpgdh1Qk5r5HQdo7DzeeF.lhNjJsEmPAwfnsPSTgt7wlc9xOfpy','punyetsazo@gmail.com'),(4,'Assbaghi','iksajklasd','$2y$10$McYjqkQjFZMuwUNtVTZ4MO5Wxt3B4TF5N5ZlmryX4p7Uk0pg6rN.q','sermankerwe@gmail.com'),(5,'asAssbaghi','iksajklasd','$2y$10$nOmfkPG4fN3r8uJeBaRlwe2qgLDOci/dqKJcTHF0mE2u3SagWJtBa','sermankersd@gmail.com'),(6,'Assbaghi','Youssef','$2y$10$fNSN7nTZizXzI2rruJGqXO8I3QL1vqfE7K9ocrqNje2nhT8a7SI8e','punyetasdsdzo@gmail.com'),(7,'Ernest','Valveny','$2y$10$P1H9Znk0rcyzHRceT1NL9u6oNMK0zmq6VNATm2BhSN78rixPYBmtC','ernest@cvc.uab.es'),(8,'Ernest','Valveny','$2y$10$h6gIK9JRPlgt8dM7J39ox.bW0ErdRZeyFvHFNZjdCMcQBm.7btbKG','ernest@cvc.uab.cat'),(9,'Professor','Dalton','$2y$10$g3ZhhsB/hC.ri71XKTe2s.5udaBIg12k9VAKZ4bsPPZuSSRzgxWiC','pd@gmail.com'),(10,'ProfeP','ProfeP','$2y$10$FJ..KOio1MUDPz8e5R5QzOsAdmRL1Dffyv8o.EgYdDkwnNeyaVlrS','asdasdasdasd@gmail.com'),(11,'ProfeP','ProfeP','$2y$10$vZQrZJhkPzuCCkKJlctB6.I0zyY6v50P8IdEOV08zOWdwm130YhJC','asdasdasdasd12@gmail.com'),(12,'asdmaksa','klamsdkla','$2y$10$9BdLxhdJ15I5iWm5j3zTPuS6a1pYYyCmA1NJ2z75JtV1NAqXhAyTe','aklsmdlak@gmail.com'),(18,'asdasdas','asdasdas','$2y$10$XCspAv4IHPovE1lmtChwpeHQuvRyA4cMcN8lfilJNtMx96oMlmPeq','asdasda@asdasdasdasda.com');
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `professor_id` int NOT NULL,
  `subject_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `professor_id` (`professor_id`),
  KEY `session_ibfk_2` (`subject_id`),
  CONSTRAINT `session_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id`) ON DELETE CASCADE,
  CONSTRAINT `session_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session_problems`
--

DROP TABLE IF EXISTS `session_problems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `session_problems` (
  `session_id` int NOT NULL,
  `problem_id` int NOT NULL,
  KEY `session_problems_ibfk_1` (`session_id`),
  KEY `session_problems_ibfk_2` (`problem_id`),
  CONSTRAINT `session_problems_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE CASCADE,
  CONSTRAINT `session_problems_ibfk_2` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session_problems`
--

LOCK TABLES `session_problems` WRITE;
/*!40000 ALTER TABLE `session_problems` DISABLE KEYS */;
/*!40000 ALTER TABLE `session_problems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solution`
--

DROP TABLE IF EXISTS `solution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solution` (
  `id` int NOT NULL AUTO_INCREMENT,
  `route` varchar(255) NOT NULL,
  `problem_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `user` varchar(255) NOT NULL,
  `editing` int NOT NULL DEFAULT '0',
  `edited` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Id_asignatura` (`subject_id`),
  KEY `Usuario` (`user`),
  KEY `Id_problema` (`problem_id`) USING BTREE,
  CONSTRAINT `solution_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  CONSTRAINT `solution_ibfk_2` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `solution_ibfk_3` FOREIGN KEY (`user`) REFERENCES `student` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solution`
--

LOCK TABLES `solution` WRITE;
/*!40000 ALTER TABLE `solution` DISABLE KEYS */;
/*!40000 ALTER TABLE `solution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `session_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`email`),
  KEY `student_ibfk_1` (`session_id`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'Assbaghi','iksajklasd','youssef.assbaghi@e-campus.uab.cat','$2y$10$wmqxL/WbZ.VxpCBXnGUzHONRS63r0TGemZcxxqTx/7DRCURZhAxFu',NULL),(3,'Assbaghi','iksajklasd','sermanker@gmail.com','$2y$10$v1kK859Ze00Cycf/ExLNzeBAZLkH49oWtHUrDpA/1bc8wa6/BnkLm',NULL),(4,'Juan','Perez','localhost@gmail.com','$2y$10$YnMM19UwnDIF1JZBX4t7HeOB4pxdr7MSBMBkgkiizuJJ3hdOaW082',NULL),(5,'asAssbaghi','iksajklasd','asas@gmail.com','$2y$10$MhmvoB2q7/k/K9jt8jsrveKXwZV7IOn1ELEn8SYyq1IVbgDdqKYtS',NULL),(6,'asAssbaghi','iksajklasd','asass@gmail.com','$2y$10$Jt4Dla8Awfytyjpt9SEiyedF4J3zu9nRBQ0ac4/xC5EM68l10udnG',NULL),(7,'asdasd','asdasd','sermansker@gmail.com','$2y$10$QhhDcNBAAh4lAqwZ5qI7g.nXJSnOeW5WCX6ZQyvNsp7SpasztF5.m',NULL),(8,'Assbaghi','iksajklasd','sermankasder@gmail.com','$2y$10$705LiEPcbcwdBVLHWeAMROc/q1QkXpHiOFnZ/EIaEZfYC1IxXgKf6',NULL),(9,'hgh','hgfhfg','hgfhgf@gmail.com','$2y$10$Dmcf6CyWhKasX3SGK.NeueL8w1I4mSd2F/3jYRQRNbzvDqPrDRWw6',NULL),(10,'Ernest','Valveny','Ernest.Valveny@uab.cat','$2y$10$3ejx5cmcxA4Xr3vlKCelpu.LpB//GZidFR/O9qq2.i6yiQ7YnyrrW',NULL),(11,'Pepecito','Vinyuelita','mail@gmail.com','$2y$10$eNxpgdh1Qk5r5HQdo7DzeeF.lhNjJsEmPAwfnsPSTgt7wlc9xOfpy',NULL),(12,'name','surname','namesurname@mail.com','$2y$10$eNxpgdh1Qk5r5HQdo7DzeeF.lhNjJsEmPAwfnsPSTgt7wlc9xOfpy',NULL),(13,'name','surname','n@mail.com','$2y$10$VZ6a3kb2bJTRnqrCs/idnOWHZogXpbRbV6J1cw8APVga8aaOtCTva',NULL),(14,'ASdasd','asdasd','ar@as.co','$2y$10$Z0IuQ.VTgV3n6tspiPlrHOWk4tdyIuX6hgvCr1tRYTuxaFIbnJIM.',NULL),(15,'asdasd','asdasd','asdasd@asdasd.com','$2y$10$suanHleSpmV.gyKmS6rZ8Og9GWktPcbyVyFRNQwHzadMbVQNU.AtO',NULL),(16,'Professor','Dalton','pd@gmail.com','$2y$10$g3ZhhsB/hC.ri71XKTe2s.5udaBIg12k9VAKZ4bsPPZuSSRzgxWiC',NULL),(17,'Nom','Cognom','mail@mail.mail','$2y$10$LS4GfSh/DNF0TWIXwvLAh.VBH3gwPzeTm42YmjqUrN0lleFFJTj4.',NULL),(18,'Pepe','Martinez','pepe@mail.com','$2y$10$xNbhUR5M0.QXCEZMg2A0RedDmu3zmROrx7JWFfdtLqTza78hAevtS',NULL);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (0,'Laboratori de programació','Programacio interactiva per estudiants','3'),(2,'Metodologia de la programació','Programacio interactiva per estudiants','2'),(6,'assignatura nova','Aquesta és una assignatura de prova','1');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  `usage` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Valor` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokens`
--

LOCK TABLES `tokens` WRITE;
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
INSERT INTO `tokens` VALUES (113,'533d5c96ab02cb96877fa5812ecc2de400ef8eeeb79827ac0f7a5e3eca6c650c',0),(114,'88d66d145c62c8895f79ad519bf96002d9862b5fb212e0ce865a0428643a03b6',0),(115,'cf5aa6b1e8e7558b219c351245f715ecd4adae0023a6df95ea53395b2a7a6caf',0),(116,'4d7173f76f02a675d2a113e47ff975ad892e15f8663bf100db5f5c7f37e3c00a',0),(117,'ef26469493653098016864006b02c31490290feca8612f7c535726d7438aed7b',0),(118,'fcb8098f369d4d1d5b21aac3691c06d53cd5b43d1689a9f1b2b692be488d0df4',0),(119,'7560b2d3d6afc6faaf398ad0917aacdaf89452bcf6e5a33b38d1f4f3e7bd5108',0),(120,'8401a33e9deecb740f3f7c9fd5ff635113f92a1e2f14783d8f6aad224a284ce5',0),(121,'264ea622737b5362a6d2edd595b56758309382d50066369f0b44922914934481',0),(122,'2d2163cb3f6cc890ca54c6121befb1223d94194e93acb202e12920787626fc01',1),(123,'06ac9083ba804ffac430e0851005fc574d837fa832459114bc7056f2174df62c',0),(124,'cea55cdfec0eac40b9323a74811528d680546fef6d22601cda1006e9ad975634',0),(125,'8681f30e655e7bf56d53298f3478a4dc06bdf2ac40489f8e36cb5eb9d69f8530',0),(126,'5ff92563e56053eaa89256cd4c5c9d1bbdf5f53df68acf879f2b192934598483',0);
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-11  4:32:42
