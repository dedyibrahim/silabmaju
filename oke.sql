-- MySQL dump 10.13  Distrib 5.7.26, for Linux (i686)
--
-- Host: localhost    Database: silabmaju
-- ------------------------------------------------------
-- Server version	5.7.26-log

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED='4280100b-9d3e-11e9-b6e6-180373551e3a:1-565,
70fdff0e-efa2-4f30-8019-2feea7315ee8:1-36:1000003-1000089';

--
-- Table structure for table `anamnesa`
--

DROP TABLE IF EXISTS `anamnesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anamnesa` (
  `id_anamnesa` char(10) NOT NULL,
  `id_sampel` char(10) NOT NULL,
  `pelaksana1` char(50) NOT NULL,
  `pelaksana2` char(50) NOT NULL,
  `lokasi_sampel` varchar(100) NOT NULL,
  `cek_parasit` varchar(20) NOT NULL,
  `cek_virus` varchar(20) NOT NULL,
  `cek_bakteri` varchar(20) NOT NULL,
  `cek_jamur` varchar(20) NOT NULL,
  PRIMARY KEY (`id_anamnesa`),
  KEY `id_sampel` (`id_sampel`),
  CONSTRAINT `anamnesa_ibfk_1` FOREIGN KEY (`id_sampel`) REFERENCES `data_sampel` (`id_sampel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anamnesa`
--

LOCK TABLES `anamnesa` WRITE;
/*!40000 ALTER TABLE `anamnesa` DISABLE KEYS */;
INSERT INTO `anamnesa` VALUES ('A0001','SL0001','Zaenudin Ngaciro','sandi apriyoga','Tambak ikan','aktif','aktif','aktif','aktif');
/*!40000 ALTER TABLE `anamnesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_customer`
--

DROP TABLE IF EXISTS `data_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_customer` (
  `id_customer` char(10) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email_customer` varchar(50) NOT NULL,
  `no_kontak` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat_lengkap` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_customer`
--

LOCK TABLES `data_customer` WRITE;
/*!40000 ALTER TABLE `data_customer` DISABLE KEYS */;
INSERT INTO `data_customer` VALUES ('C0001','Dedi','Ibrahim','Dedi Ibrahim','dedyibrahym23@gmail.com',0,'$2y$10$pC4jDH9lShPT.K4BfDyMxO0yh.fsaaTimJ/q6sYTARetMm.3m9qq2','asd','online');
/*!40000 ALTER TABLE `data_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_hasil_lab`
--

DROP TABLE IF EXISTS `data_hasil_lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_hasil_lab` (
  `id_anamnesa` varchar(10) NOT NULL,
  `nama_lab` varchar(100) NOT NULL,
  `ditemukan` varchar(100) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  PRIMARY KEY (`id_anamnesa`),
  CONSTRAINT `data_hasil_lab_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `anamnesa` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_hasil_lab`
--

LOCK TABLES `data_hasil_lab` WRITE;
/*!40000 ALTER TABLE `data_hasil_lab` DISABLE KEYS */;
/*!40000 ALTER TABLE `data_hasil_lab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_sampel`
--

DROP TABLE IF EXISTS `data_sampel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_sampel` (
  `id_sampel` char(10) NOT NULL,
  `id_customer` char(100) NOT NULL,
  `jenis_sampel` varchar(100) NOT NULL,
  `berat_sampel` int(11) NOT NULL,
  `deskripsi_sampel` varchar(100) NOT NULL,
  `tgl_input` date NOT NULL,
  `gejala` char(50) NOT NULL,
  `asal_sampel` char(50) NOT NULL,
  `status_sampel` varchar(100) NOT NULL,
  PRIMARY KEY (`id_sampel`),
  KEY `id_customer` (`id_customer`),
  CONSTRAINT `data_sampel_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `data_customer` (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_sampel`
--

LOCK TABLES `data_sampel` WRITE;
/*!40000 ALTER TABLE `data_sampel` DISABLE KEYS */;
INSERT INTO `data_sampel` VALUES ('SL0001','C0001','Ikan Cupang',20,'Jl.Raya Bogor KM 23 Jakarta Timur','2019-07-25','Ikan suka kejang-kejang','Laut','Proses'),('SL0002','C0001','Ikan Jaer',10,'Kurang tau','2019-07-26','Ikan suka kejang-kejang','Laut','Masuk'),('SL0003','C0001','Kepala Kakap Merah',1000,'Kepala kakap merah dengan berat 1000g','2019-07-27','white spot','Penangkaran','Masuk');
/*!40000 ALTER TABLE `data_sampel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_user`
--

DROP TABLE IF EXISTS `data_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_user` (
  `id_user` char(11) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `level_pekerjaan` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_user`
--

LOCK TABLES `data_user` WRITE;
/*!40000 ALTER TABLE `data_user` DISABLE KEYS */;
INSERT INTO `data_user` VALUES ('U0001','Dedi','Ibrahim','Dedi Ibrahim','Aktif','Super Admin','admin','$2y$10$dChcw.5A5FNwZ8qMq1vUXOe.1te44o3diIKq33rF9HHky5s0pXY.a'),('U0002','Zaenudin','Ngaciro','Zaenudin Ngaciro','Aktif','Nekropsi','user','$2y$10$MWEJ4yJSEqsdLrlE.hRHDu4ts06UCH18wubPUdEjjzJlFaS3VcIbi'),('U0003','anamnesa','anamnesa','anamnesa anamnesa','Aktif','Nekropsi','anamnesa','$2y$10$hfA.UsExr48krbldvENROuT1SBCYDfQ.BV1XT3Zs9fmwJKrk6Ggbm'),('U0004','Input','Bakteri','Input Bakteri','Aktif','Manajer Teknik','teknik','$2y$10$oWL6VdsemCjHuDy24CbSueP63rtksOnoA4iBxl8YYlkhXBvbVPKUW'),('U0005','komar','rudin','komar rudin','Aktif','Lab Jamur','komar','$2y$10$T5I2C9y.a1mFAm1hm9QzzOO7v2ZDu5nP3s8YTAtEQTHppqexflGIa'),('U0006','zaenudin','ngaciro','zaenudin ngaciro','Aktif','Lab Jamur','zaenudin','$2y$10$k6itwZb2deEbKo3mS9hSa.K8iBLX0m0Y3QczmImVowlColqPx7xR6'),('U0007','jumas','ridal','jumas ridal','Aktif','Lab Parasit','jumas','$2y$10$HmR96BPzHayQqvUwJ1/uvOvDpPPUHvyzZRL5mI.HYlgsl6YYsRfQy'),('U0008','sandi','apriyoga','sandi apriyoga','Aktif','Lab Bakteri','sandi','$2y$10$DaQZhmGqqRyoEcljYWKUB.CF3EHuUf8.APnATQ6tWynxxC2gkQO4.'),('U0009','riki','aja','riki aja','Aktif','Lab Virus','riki','$2y$10$zK65O59bm43rBY1v37Xz1eQ6TVAqQ.xwkTblIu0pAPVnqP/yF85kS'),('U0010','rifky','aja','rifky aja','Aktif','Lab Bakteri','rifky','$2y$10$snVrrkQjzPzelNwzzFyWiev7.4j9Q2MbJht6scHRzpBrPbEjSSlee'),('U0011','bahrudin','aja','bahrudin aja','Aktif','Lab Parasit','bahrudin','$2y$10$0jvd/Dx570VKxfV6742ujOREr8T3XWSrfhWjAVsODE.VeriXKmXsK'),('U0012','puat','aja','puat aja','Aktif','Lab Jamur','puat','$2y$10$pQxXJX0MetDOXueiFbmXyuEVKe3fyTp4pw2p0glkQkdQVUkIP7gdy'),('U0013','marpuah ','aja','marpuah  aja','Aktif','Lab Virus','marpuah','$2y$10$shP/d6SFFw5DhLg21NtrlOqeVw.Yo8ydASVGLz8wDhHPTOFrklToq'),('U0014','suhana','aja','suhana aja','Aktif','Lab Bakteri','suhana','$2y$10$qMF2JaYRGibpBFGEJ37SJO25R6p3TZaE47T3Vs9tu1sCaSklOZG0W'),('U0015','apit','aja','apit aja','Aktif','Lab Parasit','apit','$2y$10$okJsMNqFbw6AUb/QT9gRcuJxdj7GXQ7i95JbubHXQpJCX64bsFWgS'),('U0016','ogan','aja','ogan aja','Aktif','Lab Jamur','ogan','$2y$10$ZTLQXGkafgxTY9fwK50PmesjaXoWl5FeSGXesW2RuvjtdjSPiy4vK');
/*!40000 ALTER TABLE `data_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disposisi`
--

DROP TABLE IF EXISTS `disposisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disposisi` (
  `id_anamnesa` char(10) NOT NULL,
  `id_disposisi` varchar(10) NOT NULL,
  `nama_distribusi` varchar(20) NOT NULL,
  `status_distribusi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_disposisi`),
  KEY `id_anamnesa` (`id_anamnesa`) USING BTREE,
  CONSTRAINT `disposisi_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `anamnesa` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disposisi`
--

LOCK TABLES `disposisi` WRITE;
/*!40000 ALTER TABLE `disposisi` DISABLE KEYS */;
INSERT INTO `disposisi` VALUES ('A0001','DSPS0001','Lab Parasit','Proses'),('A0001','DSPS0002','Lab Virus','Proses'),('A0001','DSPS0003','Lab Bakteri','Proses'),('A0001','DSPS0004','Lab Jamur','Proses');
/*!40000 ALTER TABLE `disposisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kaji_ulang`
--

DROP TABLE IF EXISTS `kaji_ulang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kaji_ulang` (
  `id_anamnesa` char(10) NOT NULL,
  `kesiapan_personel` char(20) NOT NULL,
  `kondisi_akomodasi` char(20) NOT NULL,
  `beban_pekerjaan` char(20) NOT NULL,
  `kondisi_peralatan` char(20) NOT NULL,
  `kesesuaian_metode` char(20) NOT NULL,
  KEY `kode_anamnesa` (`id_anamnesa`),
  CONSTRAINT `kaji_ulang_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `anamnesa` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kaji_ulang`
--

LOCK TABLES `kaji_ulang` WRITE;
/*!40000 ALTER TABLE `kaji_ulang` DISABLE KEYS */;
INSERT INTO `kaji_ulang` VALUES ('A0001','si','si','si','si','si');
/*!40000 ALTER TABLE `kaji_ulang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lab_bakteri`
--

DROP TABLE IF EXISTS `lab_bakteri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_bakteri` (
  `id_anamnesa` char(10) NOT NULL,
  `tgl_bakteri` date NOT NULL,
  `hasil_bakteri` char(100) NOT NULL,
  `jumlah_bakteri` varchar(100) NOT NULL,
  KEY `kode_anamnesa` (`id_anamnesa`),
  CONSTRAINT `lab_bakteri_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `anamnesa` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lab_bakteri`
--

LOCK TABLES `lab_bakteri` WRITE;
/*!40000 ALTER TABLE `lab_bakteri` DISABLE KEYS */;
/*!40000 ALTER TABLE `lab_bakteri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lab_jamur`
--

DROP TABLE IF EXISTS `lab_jamur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_jamur` (
  `id_anamnesa` char(10) NOT NULL,
  `tgl_jamur` date NOT NULL,
  `hasil_uji` char(10) NOT NULL,
  `jumlah_jamur` varchar(100) NOT NULL,
  KEY `kode_anamnesa` (`id_anamnesa`),
  CONSTRAINT `lab_jamur_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `anamnesa` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lab_jamur`
--

LOCK TABLES `lab_jamur` WRITE;
/*!40000 ALTER TABLE `lab_jamur` DISABLE KEYS */;
/*!40000 ALTER TABLE `lab_jamur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lab_parasit`
--

DROP TABLE IF EXISTS `lab_parasit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_parasit` (
  `id_anamnesa` char(10) NOT NULL,
  `tgl_parasit` date NOT NULL,
  `hasil_parasit` char(100) NOT NULL,
  `jumlah_parasit` varchar(100) NOT NULL,
  KEY `kode_anamnesa` (`id_anamnesa`),
  CONSTRAINT `lab_parasit_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `anamnesa` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lab_parasit`
--

LOCK TABLES `lab_parasit` WRITE;
/*!40000 ALTER TABLE `lab_parasit` DISABLE KEYS */;
/*!40000 ALTER TABLE `lab_parasit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lab_virus`
--

DROP TABLE IF EXISTS `lab_virus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_virus` (
  `id_virus` int(11) NOT NULL AUTO_INCREMENT,
  `id_anamnesa` char(10) NOT NULL,
  `tgl_virus` date NOT NULL,
  `hasil_virus` char(100) NOT NULL,
  `jumlah_virus` varchar(100) NOT NULL,
  PRIMARY KEY (`id_virus`),
  KEY `kode_anamnesa` (`id_anamnesa`),
  CONSTRAINT `lab_virus_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `anamnesa` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lab_virus`
--

LOCK TABLES `lab_virus` WRITE;
/*!40000 ALTER TABLE `lab_virus` DISABLE KEYS */;
INSERT INTO `lab_virus` VALUES (1,'A0001','2019-07-28','Flu Babi','75'),(2,'A0001','2019-07-28','Flu Burung','750');
/*!40000 ALTER TABLE `lab_virus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `petugas_lab`
--

DROP TABLE IF EXISTS `petugas_lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `petugas_lab` (
  `id_petugas` char(10) NOT NULL,
  `id_disposisi` varchar(20) DEFAULT NULL,
  `id_user` char(10) DEFAULT NULL,
  PRIMARY KEY (`id_petugas`),
  KEY `id_user` (`id_user`),
  KEY `id_distribusi` (`id_disposisi`),
  CONSTRAINT `petugas_lab_ibfk_1` FOREIGN KEY (`id_disposisi`) REFERENCES `disposisi` (`id_disposisi`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `petugas_lab_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `petugas_lab`
--

LOCK TABLES `petugas_lab` WRITE;
/*!40000 ALTER TABLE `petugas_lab` DISABLE KEYS */;
INSERT INTO `petugas_lab` VALUES ('PTG0001',NULL,NULL),('PTG0002',NULL,NULL),('PTG0003',NULL,NULL),('PTG0004',NULL,NULL),('PTG0005',NULL,NULL),('PTG0006',NULL,NULL),('PTG0007',NULL,NULL),('PTG0008',NULL,NULL),('PTG0009','DSPS0001','U0007'),('PTG0010','DSPS0001','U0011'),('PTG0011','DSPS0002','U0009'),('PTG0012','DSPS0002','U0013'),('PTG0013','DSPS0003','U0008'),('PTG0014','DSPS0003','U0010'),('PTG0015','DSPS0004','U0005'),('PTG0016','DSPS0004','U0006');
/*!40000 ALTER TABLE `petugas_lab` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-28 21:55:02
