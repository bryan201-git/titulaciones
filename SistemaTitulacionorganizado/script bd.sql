CREATE DATABASE  IF NOT EXISTS `pruebaproyecto` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `pruebaproyecto`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: pruebaproyecto
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.32-MariaDB

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
-- Table structure for table `actoprotocolario`
--

DROP TABLE IF EXISTS `actoprotocolario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actoprotocolario` (
  `idacto` int(11) NOT NULL AUTO_INCREMENT,
  `idtitulacion` int(11) NOT NULL,
  `idjurado` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `lugar` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `nofep` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idacto`),
  KEY `fk_titulacion_has_jurado_jurado1_idx` (`idjurado`),
  KEY `fk_titulacion_has_jurado_titulacion1_idx` (`idtitulacion`),
  CONSTRAINT `fk_titulacion_has_jurado_jurado1` FOREIGN KEY (`idjurado`) REFERENCES `jurado` (`idjurado`),
  CONSTRAINT `fk_titulacion_has_jurado_titulacion1` FOREIGN KEY (`idtitulacion`) REFERENCES `titulacion` (`idtitulacion`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actoprotocolario`
--

LOCK TABLES `actoprotocolario` WRITE;
/*!40000 ALTER TABLE `actoprotocolario` DISABLE KEYS */;
INSERT INTO `actoprotocolario` VALUES (1,1,2,'2020-09-27','09-10','AULA MAGNA','663'),(2,2,1,'2020-09-07','10-11','AULA MAGNA','664'),(3,4,4,'2020-09-18','11-12','AULA MAGNA','665'),(4,5,3,'2020-08-16','10-11','AULA MAGNA','666'),(5,11,5,'2019-06-15','11-12','AULA MAGNA','667'),(6,12,9,'2019-12-16','12-13','AULA MAGNA','668'),(7,13,12,'2019-08-10','13-14','AULA MAGNA','669'),(8,14,11,'2019-01-01','14-15','AULA MAGNA','670'),(9,15,10,'2019-02-02','15-16','AULA MAGNA','671'),(10,19,8,'2020-09-09','09-10','AULA MAGNA','672'),(11,20,7,'2021-09-08','10-11','AULA MAGNA','673'),(12,23,6,'2021-10-07','11-12','AULA MAGNA','674'),(13,24,13,'2021-06-30','12-13','AULA MAGNA','675'),(14,25,14,'2022-03-11','13-14','AULA MAGNA','676'),(15,26,15,'2021-05-05','14-15','AULA MAGNA','677'),(16,27,16,'2021-08-23','15-16','AULA MAGNA','678'),(17,28,17,'2021-08-19','10-11','AULA MAGNA','679'),(18,30,18,'2018-12-26','11:00','AULA MAGNA','664'),(19,31,19,'2018-11-05','21:00','20000','209');
/*!40000 ALTER TABLE `actoprotocolario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumnos` (
  `noncontrol` varchar(9) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 NOT NULL,
  `apellidopaterno` varchar(20) CHARACTER SET utf8 NOT NULL,
  `apellidomaterno` varchar(20) CHARACTER SET utf8 NOT NULL,
  `telefono` varchar(10) CHARACTER SET utf8 NOT NULL,
  `correo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '12345678',
  `plan` int(11) NOT NULL,
  `status` varchar(1) CHARACTER SET utf8 NOT NULL,
  `kardex` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`noncontrol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` VALUES ('E12345678','nombreprueba','apellidopatprueba','apellidomatprueba','1234567890','prueba@prueba.com','12345678',1996,'1','E12345678.pdf'),('E14020515','Ines','Pallas','Ovejero','7984319937','ines@uv.com','1234ines',2010,'1','E14020515.pdf'),('E14020607','Gonzalo','Manchon','Espi','7330333374','gonzalo@uv.com','gonzalo',2010,'1',NULL),('E14021801','Marina','Llorca','Justo','6171426861','marina@itver.com','marina',2010,'1',NULL),('E14021802','Natalia','Hueso','Rivas','7907306060','natalia@gmail.com','natalia',2010,'0',NULL),('E14021803','Sofia','Tejeiro','Santiago','8704893770','sofia@hotmail.com','sofia',2010,'1',NULL),('E14021804','Sara','Arregui','Lledo','2292884894','sara@hotmail.com','sara',2010,'1',NULL),('E14021805','Victor','Pages','Pont','2293894995','victor@gmail.com','victor',2010,'1',NULL),('E14021806','Patricia','Limon','Montoya','2291037171','patricia@uv.com','patricia',2010,'1',NULL),('E15020515','Bryan','Castillo','Marin','2321200394','bryan_cm96@gmail.com','87654321',2010,'1','E15020515.pdf'),('E15020607','jorge','perez','diaz','2291290792','jorge@hotmail.com','jorge',2010,'1','E15020607.pdf'),('E15021801','bryan','castillo','marin','2321200394','bryan@hotmail.com','bryan',2010,'1','E15021801.pdf'),('E15021802','derian','blanco','reyes','2299070546','derian@hotmail.com','derian',2010,'1',NULL),('E15021803','melisa','cruz','castro','2292530135','melisa@hotmail.com','melisa',2010,'0',NULL),('E15021804','gicelle','hernandez','hernandez','2299159639','gicelle@hotmail.com','gicelle',2010,'0',NULL),('E15021805','luis','freyre','gonzalez','2292884894','freyre@hotmail.com','freyre',2010,'1',NULL),('E15021806','adolfo','pastelin','enciso','2291168442','adolfo@hotmail.com','adolfo',2010,'1',NULL),('E15021807','silvio','hermida','altamirano','2881157128','silvio@hotmail.com','silvio',2010,'1',NULL),('E15021808','daniel','vargas','sanchez','2299091276','daniel@hotmail.com','daniel',2010,'1',NULL),('E15021809','jose','utrera','diaz','2293038089','utrera@hotmail.com','utrera',2010,'0',NULL),('E16020515','Jose Angel','Vallejo','Leyva','7819633118','joseangel@itver.com','joseangel',2010,'1',NULL),('E16020607','Aitor','Mosquera','Huerta','8145419861','aitor@gmail.com','aitor',2010,'1',NULL),('E16021801','Jose Antonio','Cantos','De los Reyes','8782279875','cantos_03@outlook.com','cantos',2010,'0',NULL),('E16021802','Lorenzo','Espino','Comas','8966259272','lorenzo@itver.com','lorenzo',2010,'1',NULL),('E16021803','Cesar','Terol','Saenz','6867945740','cterol@hotmail.com','cterol',2010,'1',NULL),('E16021804','Marc','Redondo','Llopis','8268765358','marc@hotmail.com','marc',2010,'1',NULL),('E16021805','Nuria','Aceituno','Domingo','6791139063','nuria@gmail.com','nuria',2010,'0',NULL),('E16021806','Maria Dolores','Andres','Gabaldon','6708801413','mao@hotmail.com','mao',2010,'0',NULL),('E16021807','Emilia','Busquets','Olivares','7809575654','emilia@hotmail.com','emilia',2010,'1',NULL),('E16021808','Esperanza','Arribas','Matas','8502452699','esperanza@gmail.com','esperanza',2010,'1',NULL),('E16021809','Carolina','Palmer','Pastor','8587192884','carolina@hotmail.com','carolina',2010,'0',NULL),('E78020298','PEPITO','HERNANDEZ','SILVA','1234567890','SILVA@uv.com','abcdefg1',2010,'1','E78020298.pdf');
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cancelaciones`
--

DROP TABLE IF EXISTS `cancelaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cancelaciones` (
  `idCancelacion` int(11) NOT NULL AUTO_INCREMENT,
  `motivo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `idtitulacion` int(11) NOT NULL,
  `fechacancelacion` date NOT NULL,
  PRIMARY KEY (`idCancelacion`),
  KEY `idtitulacion_idx` (`idtitulacion`),
  CONSTRAINT `idtitulacion` FOREIGN KEY (`idtitulacion`) REFERENCES `titulacion` (`idtitulacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cancelaciones`
--

LOCK TABLES `cancelaciones` WRITE;
/*!40000 ALTER TABLE `cancelaciones` DISABLE KEYS */;
INSERT INTO `cancelaciones` VALUES (1,'DESERCION',6,'2019-09-02'),(2,'FALTA DE DOCUMENTACION',7,'2020-01-20'),(3,'FALTA DE DOCUMENTOS',10,'2020-07-10'),(4,'FALTA DE DOCUMENTOS',18,'2019-02-19'),(5,'DESERCION',21,'2021-06-04');
/*!40000 ALTER TABLE `cancelaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jurado`
--

DROP TABLE IF EXISTS `jurado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jurado` (
  `idjurado` int(11) NOT NULL AUTO_INCREMENT,
  `idpresidente` varchar(13) CHARACTER SET utf8 NOT NULL,
  `idsecretario` varchar(13) CHARACTER SET utf8 NOT NULL,
  `idvocal` varchar(13) CHARACTER SET utf8 NOT NULL,
  `idsuplente` varchar(13) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idjurado`),
  KEY `fk_jurado_maestro1_idx` (`idpresidente`),
  KEY `fk_jurado_maestro2_idx` (`idsecretario`),
  KEY `fk_jurado_maestro3_idx` (`idvocal`),
  KEY `fk_jurado_maestro4_idx` (`idsuplente`),
  CONSTRAINT `fk_jurado_maestro1` FOREIGN KEY (`idpresidente`) REFERENCES `maestro` (`rfc`),
  CONSTRAINT `fk_jurado_maestro2` FOREIGN KEY (`idsecretario`) REFERENCES `maestro` (`rfc`),
  CONSTRAINT `fk_jurado_maestro3` FOREIGN KEY (`idvocal`) REFERENCES `maestro` (`rfc`),
  CONSTRAINT `fk_jurado_maestro4` FOREIGN KEY (`idsuplente`) REFERENCES `maestro` (`rfc`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jurado`
--

LOCK TABLES `jurado` WRITE;
/*!40000 ALTER TABLE `jurado` DISABLE KEYS */;
INSERT INTO `jurado` VALUES (1,'MAMM531006DH4','META5310067U0','ROLA531006811','COCD531006DE6'),(2,'COCD531006DE6','ROLA531006811','JUTS5310065V1','RILR531006JV8'),(3,'RILR531006JV8','TUSJ531006F97','ROLA531006811','MAMM531006DH4'),(4,'META5310067U0','COCD531006DE6','TUSJ531006F97','JUTS5310065V1'),(5,'TUSJ531006F97','ROLA531006811','RILR531006JV8','COCD531006DE6'),(6,'BABL661013B81','BEGR691031218','CAMG740613RR2','COCD531006DE6'),(7,'CUCJ620729UBA','EURJ700305CA1','FOML6803105X6','GETC680305UG4'),(8,'HEBD800817DF7','HESJ591223AM3','HORP650415SI9','GUGO651126P74'),(9,'JUTS5310065V1','LEBC6605129B4','MAMM531006DH4','MELA700217MV0'),(10,'MELE680218HSA','MELG680606JB9','MEME700704NK1','META5310067U0'),(11,'MOBE630926BT5','PEOH750417AP6','PIOE670808IH7','RILR531006JV8'),(12,'ROLA531006811','ROLR6910192M9','TEPN670203ETA','TOME700913IH4'),(13,'TUSJ531006F97','YESC6901101G9','COCD531006DE6','ROLA531006811'),(14,'RILR531006JV8','EURJ700305CA1','JUTS5310065V1','MAMM531006DH4'),(15,'TUSJ531006F97','EURJ700305CA1','PIOE670808IH7','LEBC6605129B4'),(16,'HESJ591223AM3','MELE680218HSA','CUCJ620729UBA','ROLA531006811'),(17,'EURJ700305CA1','JUTS5310065V1','HORP650415SI9','HESJ591223AM3'),(18,'CUCJ620729UBA','FOML6803105X6','BEGR691031218','JUTS5310065V1'),(19,'COCD531006DE6','PIOE670808IH7','RILR531006JV8','HESJ591223AM3');
/*!40000 ALTER TABLE `jurado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maestro`
--

DROP TABLE IF EXISTS `maestro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maestro` (
  `rfc` varchar(13) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(70) CHARACTER SET utf8 NOT NULL,
  `correo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `telefono` varchar(10) CHARACTER SET utf8 NOT NULL,
  `nombrecarrera` varchar(85) CHARACTER SET utf8 NOT NULL,
  `cedulaprofesional` varchar(20) CHARACTER SET utf8 NOT NULL,
  `fechaobtencion` date NOT NULL,
  `rol` int(11) DEFAULT NULL,
  `password` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '12345678',
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`rfc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maestro`
--

LOCK TABLES `maestro` WRITE;
/*!40000 ALTER TABLE `maestro` DISABLE KEYS */;
INSERT INTO `maestro` VALUES ('BABL661013B81','Luis Bernardo Ballesteros Barradas','ballesteros@itver.com','2507470436','Ingeniero en sistemas computacionales','ballesteros123','2013-07-01',2,'ballesteros',0),('BEGR691031218','Jose Ramon Beltran Guzman','beltran@itver.com','8531917908','Ingeniero en sistemas computacionales','beltran123','2015-11-24',2,'beltran',0),('CAMG740613RR2','Gabriela Clavel Martinez','gclavel@hotmail.com','7913554779','Maestra en sistemas de informacion','clavel123','2015-11-14',2,'clavel',0),('COCD531006DE6','Delio Coss Camilo','delio@hotmail.com','2291123456','ingeniero en sistemas computacionales','delio123','2014-11-01',3,'delio',1),('CUCJ620729UBA','Jesus Cruzado Calleja','calleja@itver.com','7325726157','Licenciado en sistemas de computacion administrativa','cruzado123','2013-06-20',2,'cruzado',0),('EURJ700305CA1','Jorge Estudillo Ramirez','estudillo@hotmail.com','7636066301','Ingeniero en sistemas computacionales','estudillo123','2016-01-11',1,'estudillo',1),('FOML6803105X6','Lourdes Flores Mendoza','lflores@gmail.com','0392305433','Maestra en sistemas de informacion','lflores123','2015-12-01',2,'lflores',0),('GETC680305UG4','Carlos Julian Genis Triana','genis@gmail.com','4128378523','Maestro en ciencias computacionales','genis123','2016-02-01',1,'genis',1),('GUGO651126P74','Ofelia Gutierrez Giraldi','ogg@gmail.com','4711574914','Maestra en Educacion con esp. en organizacion y administracion de la educ','ofelia123','2014-03-10',2,'ofelia',0),('HEBD800817DF7','Daniela Hernandez Barrios','daniela@hotmail.com','1721025958','Ingeniera en sistemas computacionales','daniela123','2014-05-14',2,'daniela',0),('HESJ591223AM3','Jose Hernandez Silva','silva@itver.com','7381194052','Maestro en sistemas de informacion','silva123','2016-12-04',2,'silva',0),('HORP650415SI9','Patricia Horta Rosado','patricia@gmail.com','2041557724','Maestra en sistemas de informacion','patricia123','2015-03-12',2,'patricia',0),('JUTS5310065V1','Senen Juarez Tinoco','senen@hotmail.com','2291123457','ingeniero en sistemas computacionales','45246258','2014-11-04',2,'senen123',1),('LEBC6605129B4','Carlos Ley Borraz','leyborraz@gmail.com','1930396606','Maestro en ciencias de la computacion','borraz123','2014-04-13',2,'borraz',0),('MAMM531006DH4','Martha Martinez Moreno','martha@hotmail.com','2292112233','licenciada en informatica','martha123','2015-05-23',2,'martha',1),('MELA700217MV0','Ana Maria Melendez Lopez','melendez@hotmail.com','2223214555','Ingeniera en sistemas computacionales','melendez123','2013-10-12',2,'melendez',0),('MELE680218HSA','Esteban Jesus Mendoza y Lopez','mles@itver.com','2814376520','Ingeniero en sistemas computacionales','esteban123','2013-07-21',2,'esteban',0),('MELG680606JB9','Genaro Mendez Lopez','gml@hotmail.com','4609077061','Maestro en sistemas de informacion','genaro123','2013-05-29',2,'genaro',0),('MEME700704NK1','Efren Mezura Montes','efren@gmail.com','9401192949','Doctor en ciencias en ingenieria electrica','efren123','2015-02-11',2,'efren',0),('META5310067U0','Alberto Mendez Torreblanca','alberto@hotmail.com','2292123459','maestro en ciencias en electronica','alberto123','2015-10-15',2,'alberto',0),('MOBE630926BT5','Enrique del Moral Borras','moralb@gmail.com','9964747278','Maestro en sistemas de informacion','delmoral123','2013-06-15',1,'delmoral',1),('PEOH750417AP6','Hector Perez Ortiz','hector@hotmail.com','6585094562','Maestro en redes y telecomunicaciones','perezh123','2016-01-10',3,'perezh',1),('PIOE670808IH7','Ezequiel Piña Ortiz','ezequiel@hotmail.com','2029726903','Ingeniero en sistemas computacionales','ezequiel123','2014-08-22',2,'pinae',0),('RILR531006JV8','Rafael Rivera Lopez','rivera@hotmail.com','2291123450','doctor en ciencias de la computacion','rivera123','2016-11-21',3,'rivera',1),('ROLA531006811','Abelardo Rodriguez Leon','abelardo@hotmail.com','2291123451','doctor en ciencias de la computacion','abelardo123','2016-01-01',2,'abelardo',0),('ROLR6910192M9','Ricardo Rodriguez de la Lanza','ricardorl@itver.com','7703084195','Licenciado en sistemas de computacion administrativa','ricardol123','2015-10-10',1,'ricardol',1),('TEPN670203ETA','Noemi del Carmen Tenorio Prieto','noemi@gmail.com','0771214522','Maestra en ingenieria administrativa','noemi123','2014-04-10',2,'noemi',0),('TOME700913IH4','Jose Enrique Torres Montoya','montoya@hotmail.com','0565337139','Maestro en tecnologia educativa','montoya123','2014-09-23',2,'montoya',0),('TUSJ531006F97','Julia Guadalupe Trujillo Salamanca','trujillo@hotmail.com','2291123458','maestra en sistemas de informacion','trujillo123','2016-11-28',2,'trujillo',0),('YESC6901101G9','Claudio Yepez Sosa','claudioy@gmail.com','8689034688','Ingeniero en sistemas computacionales','yepez123','2016-09-06',2,'yepez',0);
/*!40000 ALTER TABLE `maestro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `titulacion`
--

DROP TABLE IF EXISTS `titulacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `titulacion` (
  `idtitulacion` int(11) NOT NULL AUTO_INCREMENT,
  `noncontrol` varchar(9) CHARACTER SET utf8 NOT NULL,
  `asesormaestro` varchar(13) CHARACTER SET utf8 NOT NULL,
  `opcion` varchar(20) CHARACTER SET utf8 NOT NULL,
  `nombreopcion` varchar(50) CHARACTER SET utf8 NOT NULL,
  `indfece` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `fechaingreso` date DEFAULT NULL,
  `fechaegreso` date DEFAULT NULL,
  `fechalimite` date DEFAULT NULL,
  `nombretema` varchar(200) CHARACTER SET utf8 NOT NULL,
  `dictamen_examen` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `periodotrabajo` varchar(6) CHARACTER SET utf8 DEFAULT NULL,
  `status` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idtitulacion`),
  KEY `fk_titulacion_alumnos_idx` (`noncontrol`),
  KEY `fk_asesor_maestro_idx` (`asesormaestro`),
  CONSTRAINT `fk_asesor_maestro` FOREIGN KEY (`asesormaestro`) REFERENCES `maestro` (`rfc`),
  CONSTRAINT `fk_titulacion_alumnos` FOREIGN KEY (`noncontrol`) REFERENCES `alumnos` (`noncontrol`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `titulacion`
--

LOCK TABLES `titulacion` WRITE;
/*!40000 ALTER TABLE `titulacion` DISABLE KEYS */;
INSERT INTO `titulacion` VALUES (1,'E15020607','COCD531006DE6','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','jun-19','2015-08-23','2019-06-15','2019-04-13','AUTOMATIZACION DE SOLICITUD Y ALMACENAMIENTO DE CERTIFICADOS DE HOMOLOGACION Y PLANES DE CONTROL PARA PPL\'S',NULL,'201901','p'),(2,'E15021801','JUTS5310065V1','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','dic-19','2015-08-23','2019-12-16','2020-05-04','SISTEMA PARA LA SUBDIRECCION DE INFORMACION Y ESTADISTICA DELICTIVA MODULOS 1 - 8',NULL,'201902','p'),(3,'E15021802','ROLA531006811','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','ago-19','2015-08-23','2019-08-10',NULL,'CREACION DE SISTEMAS DE AUTOMATIZACION, SIMULACION Y CONTROL EN E-COMMERCE',NULL,'201902','e'),(4,'E15020600','MAMM531006DH4','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','ene-19','2015-08-23','2019-01-01','2019-05-16','DIGITALIZACION DE LOS ARCHIVOS DE LA SEMARNAT ALMACENADOS EN UNA BASE DE DATOS EN UNA PAGINA WEB LOCAL',NULL,'201901','p'),(5,'E15021803','META5310067U0','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','feb-19','2015-08-23','2019-02-02','2019-02-13','OPTIMIZACION DEL PROCESO DE REQUISICIONES DE CAPACITACIONES DEL AREA DE FORMACION',NULL,'201901','p'),(6,'E15021804','RILR531006JV8','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','mar-19','2015-08-23','2019-03-03',NULL,'IMPLEMENTACION DE BUSQUEDA LOCAL EN EL ALGORITMO COLONIA ARTIFICIAL DE ABEJAS PARA RESOLVER PROBLEMAS DE OPTIMIZACION CON RESTRICCIONES',NULL,'201901','c'),(7,'E15021805','TUSJ531006F97','TITULACION INTEGRAL','TESIS PROFESIONAL','abr-19','2015-08-23','2019-04-04',NULL,'DOCUMENTACION DE LINEAS BASE DE CONFIGURACION DE PLATAFORMAS DE VISUALIZACION OPENSTACK-PIKE',NULL,'201901','c'),(8,'E15021806','TUSJ531006F97','TITULACION INTEGRAL','TESIS PROFESIONAL','may-19','2015-08-23','2019-05-05',NULL,'PROPUESTA DE UPGRADE DE SOFTWARE Y HARDWARE',NULL,'201901','e'),(9,'E15021807','RILR531006JV8','TITULACION INTEGRAL','TESIS PROFESIONAL','jun-19','2015-08-23','2019-06-06',NULL,'DISEÑO E IMPLEMENTACION DE SOLUCIONES IT PARA APOYAR/SIMPLIFICAR LA GESTION DE REPORTING DEL AREA GLOBAL HUMAN RESOURCES INDUSTRIAL AREAS',NULL,'201901','e'),(10,'E15021808','META5310067U0','TITULACION INTEGRAL','EXÁMEN POR ÁREAS DE CONOCIMIENTO','oct-19','2015-08-23','2019-10-10',NULL,'AGENTE INTELIGENTE DE COMPRA VENTA DE ENERGIA',NULL,'201902','c'),(11,'E14020515','YESC6901101G9','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','jul-18','2014-08-21','2018-06-15','2018-07-12','SISTEMA ADMINISTRATIVO DE INVENTARIO Y REGISTRO DE ACTIVIDADES EN ÁREA DE SOPORTE TÉCNICO',NULL,'201801','t'),(12,'E14020607','TUSJ531006F97','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','dic-18','2014-08-21','2018-12-16','2019-01-12','DESARROLLO DEL PROGRAMA DE EVALUACIÓN DE COMPETENCIAS PISTA DE PRUEBAS',NULL,'201802','p'),(13,'E14021801','TOME700913IH4','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','ago-18','2014-08-21','2018-08-10','2018-12-06','AUTOMATIZACIÓN CIERRES CONTABLES Y PLANEACIONES',NULL,'201802','p'),(14,'E14021802','TEPN670203ETA','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','ene-18','2014-08-21','2018-01-01','2018-01-12','TABLEROS DE CONTROL DE GESTIÓN',NULL,'201801','t'),(15,'E14021803','ROLR6910192M9','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','feb-18','2014-08-21','2018-11-02','2018-12-25','PÁGINA EN LA INTRANET PARA LA GESTIÓN DE SERVICIOS TANTO DE SEAP COMO DE MANTENIMIENTO',NULL,'201801','p'),(16,'E14021804','PIOE670808IH7','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','mar-18','2014-08-21','2018-03-03',NULL,'CREACIÓN DE UN SISTEMA WEB CON CARACTERÍSTICAS DE E-COMMERCE UTILIZANDO UN GESTOR DE CONTENIDO WEB',NULL,'201801','e'),(17,'E14021805','PEOH750417AP6','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','abr-18','2014-08-21','2018-04-04',NULL,'ESTANDARIZACIÓN DE REPORTES TÄD',NULL,'201801','e'),(18,'E14021806','MOBE630926BT5','TITULACION INTEGRAL','TESIS PROFESIONAL','may-18','2014-08-21','2018-05-10',NULL,'CICE CROSSDOCKING: SISTEMA DE INFORMACIÓN PARA LOS PROCESOS OPERATIVOS',NULL,'201801','c'),(19,'E15021809','META5310067U0','TITULACION INTEGRAL','TESIS PROFESIONAL','nov-19','2015-08-23','2019-09-09',NULL,'DISEÑO E IMPLEMENTACIÓN DE UN SISTEMA WEB PARA LA ADMINISTRACIÓN DE APLICACIONES',NULL,'201902','t'),(20,'E16020515','MEME700704NK1','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','sep-20','2016-08-19','2020-09-08',NULL,'DESARROLLO E IMPLEMENTACIÓN DE UNA BASE DE DATOS DE ARCHIVOS DIGITALIZADOS PARA UNA CENTRAL TELEFÓNICA',NULL,'202002','t'),(21,'E16020607','MELG680606JB9','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','mar-21','2016-08-19','2021-03-13',NULL,'IMPLEMENTACIÓN Y AUTOMATIZACIÓN DE SOLUCIONES EMPRESARIALES PARA LA MEJORA DE LOS USUARIOS BASADAS EN SHAREPOINT',NULL,'202101','c'),(22,'E16021801','MELE680218HSA','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','abr-20','2016-08-19','2020-04-04',NULL,'AUTOMATIZACIÓN DE REPORTES EJECUTIVOS USANDO MINERÍA DE BASE DE DATOS',NULL,'202001','e'),(23,'E16021802','MELA700217MV0','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','oct-20','2016-08-19','2020-10-07','2020-11-16','DISEÑO E IMPLEMENTACIÓN DEL SOFTWARE DE LA CONSOLA DE OPERACIÓN DEL SISTEMA DE VIGILANCIA MARÍTIMA POR SONAR (SIVISO)',NULL,'202002','p'),(24,'E16021803','MAMM531006DH4','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','jun-20','2016-08-19','2020-06-30','2020-07-15','CONTROL DE INSUMOS POR ÁREAS DE PRODUCCIÓN',NULL,'202001','p'),(25,'E16021804','LEBC6605129B4','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','mar-21','2016-08-19','2021-03-11','2021-05-24','DESARROLLO DE SISTEMA PARA LA GESTIÓN Y EVALUACIÓN DE PROSPECTOS DE CRÉDITO',NULL,'202101','p'),(26,'E16021805','JUTS5310065V1','TITULACION INTEGRAL','TESIS PROFESIONAL','may-20','2016-08-19','2020-05-05',NULL,'DESARROLLO DE SISTEMA PARA LA GESTIÓN Y EVALUACIÓN DE PROSPECTOS DE CRÉDITO',NULL,'202001','t'),(27,'E16021806','HORP650415SI9','TITULACION INTEGRAL','INFORME TÉCNICO DE RESIDENCIA PROFESIONAL','ago-20','2016-08-19','2020-08-23',NULL,'CREACIÓN DE UN SISTEMA PARA EL CONTROL DE EQUIPOS EN EL ÁREA DE DESTILACIÓN',NULL,'202002','t'),(28,'E16021807','HESJ591223AM3','TITULACION INTEGRAL','TESIS PROFESIONAL','ago-20','2016-08-19','2020-08-19',NULL,'ACTUALIZACIÓN DE PÁGINA WEB EN LA INTRANET',NULL,'202002','t'),(29,'E15020515','RILR531006JV8','TITULACION INTEGRAL','INFORME TECNICO DE RESIDENCIA PROFESIONAL','dic-18','2015-08-24','2020-06-09',NULL,'Desarrollo de sistema de titulaciones para el instituto tecnologico de veracruz',NULL,'201802','e'),(30,'E12345678','ROLA531006811','TITULACION INTEGRAL','INFORME TECNICO DE RESIDENCIA PROFESIONAL','dic-18','2018-12-04','2018-12-17',NULL,'Esta es una descripciÃ³n tratando de romper con la ER planteada al inicio-fin de este input!',NULL,'201802','p'),(31,'E78020298','COCD531006DE6','TITULACION INTEGRAL','INFORME TECNICO DE RESIDENCIA PROFESIONAL','dic-18','2018-12-05','2018-11-05','2018-04-02','hackeando paginas webs',NULL,'201802','p');
/*!40000 ALTER TABLE `titulacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'pruebaproyecto'
--

--
-- Dumping routines for database 'pruebaproyecto'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-05  9:42:41
