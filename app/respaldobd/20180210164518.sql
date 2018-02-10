-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: savdm
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB-0+deb9u1

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `telefono` varchar(500) COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` tinytext COLLATE utf8mb4_spanish_ci NOT NULL,
  `intermediario_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Freddy Navarro','0416-3505468','Sector El Cují, Barquisimeto - Edo. Lara',1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intermediarios`
--

DROP TABLE IF EXISTS `intermediarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intermediarios` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intermediarios`
--

LOCK TABLES `intermediarios` WRITE;
/*!40000 ALTER TABLE `intermediarios` DISABLE KEYS */;
INSERT INTO `intermediarios` VALUES (1,'José Manuel Matheus'),(2,'Francisco Terán');
/*!40000 ALTER TABLE `intermediarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metadatos`
--

DROP TABLE IF EXISTS `metadatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metadatos` (
  `id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `etiqueta` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ayuda` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `error` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Metadatos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metadatos`
--

LOCK TABLES `metadatos` WRITE;
/*!40000 ALTER TABLE `metadatos` DISABLE KEYS */;
INSERT INTO `metadatos` VALUES ('clientes.-','-','',''),('clientes.id','Id','',''),('clientes.nombre','Nombre','',''),('clientes.telefono','Telefono','',''),('clientes.direccion','Dirección','Esciba su Dirección',''),('clientes.intermediario_id','Intermediario_id','',''),('intermediarios.-','-','',''),('intermediarios.id','Id','',''),('intermediarios.nombre','Nombre','',''),('productos.-','-','',''),('productos.id','Id','',''),('productos.nombre','Nombre','',''),('productos.unidadcompra','Unidadcompra','',''),('proveedores.-','-','',''),('proveedores.id','Id','',''),('proveedores.nombre','Nombre','',''),('proveedores.apodo','Apodo','',''),('proveedores.ubicacion','Ubicacion','',''),('proveedores.producto_ids','Producto_ids','',''),('proveedores.intermediario_id','Intermediario_id','',''),('usuarios.-','-','',''),('usuarios.id','Id','',''),('usuarios.clave','Clave','',''),('usuarios.nombre','Nombre','',''),('usuarios.nivel','Nivel','',''),('usuarios.email','Email','',''),('usuarios.activo','Activo','','');
/*!40000 ALTER TABLE `metadatos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metadatos_relaciones`
--

DROP TABLE IF EXISTS `metadatos_relaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metadatos_relaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tabla_maestra` varchar(64) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `campo` varchar(64) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `tabla_extranjera` varchar(64) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `campo_extranjero` varchar(64) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Relaciones';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metadatos_relaciones`
--

LOCK TABLES `metadatos_relaciones` WRITE;
/*!40000 ALTER TABLE `metadatos_relaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `metadatos_relaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `unidadcompra` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Fresas Alvión','Cesta 14Kg'),(2,'Fresas Capitola Grande','Cesta 14Kg'),(3,'Fresas Capitola P.C.','Cesta 14Kg'),(4,'Fresa Millo','Cesta 14Kg'),(5,'Rosas','Paquete');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos_proveedores`
--

DROP TABLE IF EXISTS `productos_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos_proveedores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` tinyint(3) unsigned NOT NULL,
  `proveedor_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos_proveedores`
--

LOCK TABLES `productos_proveedores` WRITE;
/*!40000 ALTER TABLE `productos_proveedores` DISABLE KEYS */;
INSERT INTO `productos_proveedores` VALUES (1,2,2),(2,1,1),(3,2,1);
/*!40000 ALTER TABLE `productos_proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apodo` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ubicacion` tinytext COLLATE utf8mb4_spanish_ci NOT NULL,
  `intermediario_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Luis Daniel Santiago','Daniel Chinolo','Cerca de Agropatria',1),(2,'Digna de Avendaño','La comadre','',1);
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` varchar(32) COLLATE utf8mb4_spanish_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nivel` enum('ADMINISTRADOR','OPERADOR') COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `activo` enum('NO','SI') COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'SI',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Usuarios del sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('admin','$2y$10$pRdBMChBOtUq/H/p2ZsWiOv/wuw4RFOre7e5lnb/wfoZUGVRa8vf2','Admin Istrador','ADMINISTRADOR','admin@localhost.com','SI'),('usuario0','$2y$10$l8wag6s7oQ1Qspia7Tlz0.6GlzYclpaRQCycS9w0b.ZUng4axeWdq','usuario0','ADMINISTRADOR','usuario0@localhost.com','SI'),('usuario1','$2y$10$VTaluRsQPGV79cJ5Zip1feryEy/58hPRovd7eW5cAvQIdv.s09k1K','usuario1','OPERADOR','usuario1@localhost.com','SI');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-10 16:45:20
