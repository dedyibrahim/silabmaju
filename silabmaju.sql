-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2019 at 05:38 AM
-- Server version: 5.7.26-log
-- PHP Version: 7.0.33-0ubuntu0.16.04.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silabmaju`
--

-- --------------------------------------------------------

--
-- Table structure for table `anamnesa`
--

CREATE TABLE `anamnesa` (
  `id_anamnesa` char(10) NOT NULL,
  `id_sampel` char(10) NOT NULL,
  `pelaksana1` char(50) NOT NULL,
  `pelaksana2` char(50) NOT NULL,
  `lokasi_sampel` varchar(100) NOT NULL,
  `cek_parasit` varchar(20) NOT NULL,
  `cek_virus` varchar(20) NOT NULL,
  `cek_bakteri` varchar(20) NOT NULL,
  `cek_jamur` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anamnesa`
--

INSERT INTO `anamnesa` (`id_anamnesa`, `id_sampel`, `pelaksana1`, `pelaksana2`, `lokasi_sampel`, `cek_parasit`, `cek_virus`, `cek_bakteri`, `cek_jamur`) VALUES
('A0002', 'S0001', 'asd', 'asd', 'asd', 'aktif', 'aktif', 'undefined', 'undefined'),
('A0003', 'S0001', 'asd', 'asd', 'asd', 'aktif', 'aktif', 'undefined', 'undefined'),
('C0002', 'S0001', 'asd', 'asd2', 'asd', 'undefined', 'aktif', 'aktif', 'undefined');

-- --------------------------------------------------------

--
-- Table structure for table `data_customer`
--

CREATE TABLE `data_customer` (
  `id_customer` char(10) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email_customer` varchar(50) NOT NULL,
  `no_kontak` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat_lengkap` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_customer`
--

INSERT INTO `data_customer` (`id_customer`, `nama_depan`, `nama_belakang`, `nama_lengkap`, `email_customer`, `no_kontak`, `password`, `alamat_lengkap`, `status`) VALUES
('C0001', 'Dedi', 'Ibrahim', 'Dedi Ibrahim', 'dedyibrahym23@gmail.com', 0, '$2y$10$pC4jDH9lShPT.K4BfDyMxO0yh.fsaaTimJ/q6sYTARetMm.3m9qq2', 'asd', 'online');

-- --------------------------------------------------------

--
-- Table structure for table `data_hasil_lab`
--

CREATE TABLE `data_hasil_lab` (
  `id_anamnesa` varchar(10) NOT NULL,
  `nama_lab` varchar(100) NOT NULL,
  `ditemukan` varchar(100) NOT NULL,
  `jumlah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_sampel`
--

CREATE TABLE `data_sampel` (
  `id_sampel` char(10) NOT NULL,
  `id_customer` char(100) NOT NULL,
  `jenis_sampel` varchar(100) NOT NULL,
  `berat_sampel` int(11) NOT NULL,
  `deskripsi_sampel` varchar(100) NOT NULL,
  `tgl_input` date NOT NULL,
  `gejala` char(50) NOT NULL,
  `asal_sampel` char(50) NOT NULL,
  `status_sampel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_sampel`
--

INSERT INTO `data_sampel` (`id_sampel`, `id_customer`, `jenis_sampel`, `berat_sampel`, `deskripsi_sampel`, `tgl_input`, `gejala`, `asal_sampel`, `status_sampel`) VALUES
('S0001', 'C0001', 'Ikan Betutut', 10, 'Ikan betutut mau sekarat', '2019-07-14', 'kurang tau', 'kolong langit', 'Proses');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_user` char(11) NOT NULL,
  `nama_depan` varchar(50) NOT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `level_pekerjaan` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `nama_depan`, `nama_belakang`, `nama_lengkap`, `status`, `level_pekerjaan`, `username`, `password`) VALUES
('U0001', 'Dedi', 'Ibrahim', 'Dedi Ibrahim', 'Aktif', 'Super Admin', 'admin', '$2y$10$dChcw.5A5FNwZ8qMq1vUXOe.1te44o3diIKq33rF9HHky5s0pXY.a'),
('U0002', 'Zaenudin', 'Ngaciro', 'Zaenudin Ngaciro', 'Aktif', 'Nekropsi', 'user', '$2y$10$MWEJ4yJSEqsdLrlE.hRHDu4ts06UCH18wubPUdEjjzJlFaS3VcIbi'),
('U0003', 'anamnesa', 'anamnesa', 'anamnesa anamnesa', 'Aktif', 'Nekropsi', 'anamnesa', '$2y$10$hfA.UsExr48krbldvENROuT1SBCYDfQ.BV1XT3Zs9fmwJKrk6Ggbm');

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id_anamnesa` char(10) NOT NULL,
  `distribusi_jamur` char(20) NOT NULL,
  `distribusi_parasit` char(20) NOT NULL,
  `distribusi_virus` char(20) NOT NULL,
  `distribusi_bakteri` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kaji_ulang`
--

CREATE TABLE `kaji_ulang` (
  `id_anamnesa` char(10) NOT NULL,
  `kesiapan_personel` char(2) NOT NULL,
  `kondisi_akomodasi` char(2) NOT NULL,
  `beban_pekerjaan` char(2) NOT NULL,
  `kondisi_peralatan` char(2) NOT NULL,
  `kesesuaian_metode` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kaji_ulang`
--

INSERT INTO `kaji_ulang` (`id_anamnesa`, `kesiapan_personel`, `kondisi_akomodasi`, `beban_pekerjaan`, `kondisi_peralatan`, `kesesuaian_metode`) VALUES
('C0002', 'si', 'si', 'si', 'si', 'si'),
('A0002', 'si', 'si', 'si', 'si', 'si'),
('A0003', 'si', 'si', 'si', 'si', 'si');

-- --------------------------------------------------------

--
-- Table structure for table `lab_bakteri`
--

CREATE TABLE `lab_bakteri` (
  `id_anamnesa` char(10) NOT NULL,
  `tgl_bakteri` date NOT NULL,
  `hasil_bakteri` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_jamur`
--

CREATE TABLE `lab_jamur` (
  `id_anamnesa` char(10) NOT NULL,
  `tgl_jamur` date NOT NULL,
  `hasil_uji` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_parasit`
--

CREATE TABLE `lab_parasit` (
  `id_anamnesa` char(10) NOT NULL,
  `tgl_parasit` date NOT NULL,
  `hasil_parasit` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lab_virus`
--

CREATE TABLE `lab_virus` (
  `id_anamnesa` char(10) NOT NULL,
  `tgl_virus` date NOT NULL,
  `hasil_virus` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `petugas_lab`
--

CREATE TABLE `petugas_lab` (
  `id_anamnesa` char(10) NOT NULL,
  `nama_distribusi` varchar(20) NOT NULL,
  `id_user` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anamnesa`
--
ALTER TABLE `anamnesa`
  ADD PRIMARY KEY (`id_anamnesa`),
  ADD KEY `id_sampel` (`id_sampel`);

--
-- Indexes for table `data_customer`
--
ALTER TABLE `data_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `data_hasil_lab`
--
ALTER TABLE `data_hasil_lab`
  ADD PRIMARY KEY (`id_anamnesa`);

--
-- Indexes for table `data_sampel`
--
ALTER TABLE `data_sampel`
  ADD PRIMARY KEY (`id_sampel`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id_anamnesa`);

--
-- Indexes for table `kaji_ulang`
--
ALTER TABLE `kaji_ulang`
  ADD KEY `kode_anamnesa` (`id_anamnesa`);

--
-- Indexes for table `lab_bakteri`
--
ALTER TABLE `lab_bakteri`
  ADD KEY `kode_anamnesa` (`id_anamnesa`);

--
-- Indexes for table `lab_jamur`
--
ALTER TABLE `lab_jamur`
  ADD KEY `kode_anamnesa` (`id_anamnesa`);

--
-- Indexes for table `lab_parasit`
--
ALTER TABLE `lab_parasit`
  ADD KEY `kode_anamnesa` (`id_anamnesa`);

--
-- Indexes for table `lab_virus`
--
ALTER TABLE `lab_virus`
  ADD KEY `kode_anamnesa` (`id_anamnesa`);

--
-- Indexes for table `petugas_lab`
--
ALTER TABLE `petugas_lab`
  ADD PRIMARY KEY (`id_anamnesa`),
  ADD KEY `id_user` (`id_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anamnesa`
--
ALTER TABLE `anamnesa`
  ADD CONSTRAINT `anamnesa_ibfk_1` FOREIGN KEY (`id_sampel`) REFERENCES `data_sampel` (`id_sampel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_hasil_lab`
--
ALTER TABLE `data_hasil_lab`
  ADD CONSTRAINT `data_hasil_lab_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `anamnesa` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_sampel`
--
ALTER TABLE `data_sampel`
  ADD CONSTRAINT `data_sampel_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `data_customer` (`id_customer`);

--
-- Constraints for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `disposisi_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `lab_jamur` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disposisi_ibfk_2` FOREIGN KEY (`id_anamnesa`) REFERENCES `anamnesa` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kaji_ulang`
--
ALTER TABLE `kaji_ulang`
  ADD CONSTRAINT `kaji_ulang_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `anamnesa` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lab_bakteri`
--
ALTER TABLE `lab_bakteri`
  ADD CONSTRAINT `lab_bakteri_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `disposisi` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lab_parasit`
--
ALTER TABLE `lab_parasit`
  ADD CONSTRAINT `lab_parasit_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `disposisi` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lab_virus`
--
ALTER TABLE `lab_virus`
  ADD CONSTRAINT `lab_virus_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `disposisi` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petugas_lab`
--
ALTER TABLE `petugas_lab`
  ADD CONSTRAINT `petugas_lab_ibfk_1` FOREIGN KEY (`id_anamnesa`) REFERENCES `disposisi` (`id_anamnesa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `petugas_lab_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
