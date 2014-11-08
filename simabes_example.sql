-- phpMyAdmin SQL Dump
-- version 4.2.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 08, 2014 at 10:26 AM
-- Server version: 5.5.39-1
-- PHP Version: 5.6.2-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simabes`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses_pengguna`
--

CREATE TABLE IF NOT EXISTS `akses_pengguna` (
  `kel_id` int(2) NOT NULL,
  `id_menu` int(2) NOT NULL,
  `r` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses_pengguna`
--

INSERT INTO `akses_pengguna` (`kel_id`, `id_menu`, `r`) VALUES
(6, 1, '1'),
(6, 6, '1'),
(6, 7, '1'),
(6, 8, '1'),
(3, 1, '1'),
(3, 2, '1'),
(3, 3, '1'),
(3, 8, '1'),
(1, 1, '1'),
(1, 2, '1'),
(1, 3, '1'),
(1, 4, '1'),
(1, 5, '1'),
(1, 6, '1'),
(1, 7, '1'),
(1, 8, '1'),
(5, 1, '1'),
(5, 3, '1'),
(5, 4, '1'),
(5, 8, '1'),
(4, 1, '1'),
(4, 4, '1'),
(4, 8, '1');

-- --------------------------------------------------------

--
-- Table structure for table `br_data`
--

CREATE TABLE IF NOT EXISTS `br_data` (
  `id_brg` varchar(9) NOT NULL,
  `kode_brg` varchar(25) NOT NULL,
  `nm_brg` varchar(25) NOT NULL,
  `id_kt_brg` varchar(2) NOT NULL,
  `id_kualitas` varchar(2) NOT NULL,
  `hrg_beli` double NOT NULL,
  `hrg_jual` double NOT NULL,
  `id_satuan` varchar(2) NOT NULL,
  `stok` int(5) NOT NULL,
  `stok_min` int(3) NOT NULL,
  `id_rak` int(2) NOT NULL,
  `id_sup` varchar(5) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `ket_brg` text NOT NULL,
  `photo_brg` text NOT NULL,
  `terjual` int(3) NOT NULL COMMENT 'jumlah yang telah terjual (pelayanan/penjualan)',
  `dipesan` enum('0','1','2') NOT NULL COMMENT '0: sudah diterima/belum dipesan, 1 : sudah dimasukan dalam pesanan 2: pesanan sudah ditindak lanjuti',
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `br_data`
--

INSERT INTO `br_data` (`id_brg`, `kode_brg`, `nm_brg`, `id_kt_brg`, `id_kualitas`, `hrg_beli`, `hrg_jual`, `id_satuan`, `stok`, `stok_min`, `id_rak`, `id_sup`, `tgl_masuk`, `ket_brg`, `photo_brg`, `terjual`, `dipesan`, `wkt_ubah`) VALUES
('BD00006', '', 'Sayap Honda Grand', 'BD', 'A', 30000, 35000, 'S', 10, 1, 1, '1', '2014-06-21', 'Tidak ada keterangan untuk barang ini', 'barang/photo/default.png', 0, '0', '2014-11-08 00:00:00'),
('BD00008', '45106-KG2-AS', 'DISC PAD a', 'BP', 'A', 20000, 25000, 'B', 10, 1, 1, '1', '2014-07-08', 'Tidak ada keterangan untuk barang ini', 'barang/photo/default.png', 0, '0', '2014-11-08 00:00:00'),
('BD00009', '53205-GN5-830FB', 'Cover Handle Front', 'BD', 'A', 20000, 26000, 'S', 10, 1, 1, '1', '2014-08-13', 'Astrea Grand, Legenda', 'barang/photo/default.png', 0, '0', '2014-11-08 00:00:00'),
('BD00010', '53205-KEV-830FB', 'Cover Handle Front', 'BD', 'A', 25000, 31000, 'B', 10, 1, 1, '1', '2014-08-13', 'SupraX', 'barang/photo/default.png', 0, '0', '2014-11-08 00:00:00'),
('BP00001', '45106-KG2-NA', 'DISC PAD', 'BP', 'A', 25000, 30000, 'S', 10, 1, 1, '1', '2014-06-21', 'Tidak ada keterangan untuk barang ini', 'barang/photo/default.png', 0, '0', '2014-11-08 00:00:00'),
('BT00001', '12N5-3B KIT', 'BATTERY', 'BT', 'A', 88000, 100000, 'S', 10, 1, 1, '1', '2014-06-14', 'HND : Astrea Prima/Grand, Impressa, Supra\r\nYMH : Alfa, Force-1, Crypton, Vega, Sigma\r\nSZK : RC80, RC100, RC110, Tornado, Shogun\r\nKWK , Kaze, VSP, Corsa, STR, AR-125,', 'barang/photo/default.png', 0, '0', '2014-11-08 00:00:00'),
('BT00002', 'GM2-5A-3C-2', 'BATTERY', 'BT', 'A', 68000, 73000, 'S', 10, 1, 1, '1', '2014-06-14', 'HND : GL PRO, GL Max, GL 100(CDI), MegaPro,', 'barang/photo/default.png', 0, '0', '2014-11-08 00:00:00'),
('BT00003', 'GM2-3B KIT', 'BATTERY', 'BT', 'A', 86000, 91000, 'S', 10, 1, 1, '1', '2014-06-14', 'YMM : RXK-New, TZM;\r\nSZK : Satria(kick)', 'barang/photo/default.png', 0, '0', '2014-11-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `br_data_perkendaraan`
--

CREATE TABLE IF NOT EXISTS `br_data_perkendaraan` (
`id_data` int(11) NOT NULL,
  `id_brg` varchar(9) NOT NULL,
  `id_kendaraan` varchar(2) NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `br_data_perkendaraan`
--

INSERT INTO `br_data_perkendaraan` (`id_data`, `id_brg`, `id_kendaraan`, `wkt_ubah`) VALUES
(1, 'BD00006', 'H', '2014-11-08 00:00:00'),
(2, 'BD00008', 'H', '2014-11-08 00:00:00'),
(3, 'BD00009', 'A', '2014-11-08 00:00:00'),
(4, 'BD00010', 'A', '2014-11-08 00:00:00'),
(5, 'BP00001', 'S', '2014-11-08 00:00:00'),
(6, 'BT00001', 'A', '2014-11-08 00:00:00'),
(7, 'BT00002', 'A', '2014-11-08 00:00:00'),
(8, 'BT00003', 'A', '2014-11-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `br_kategori`
--

CREATE TABLE IF NOT EXISTS `br_kategori` (
  `id_kt_brg` varchar(2) NOT NULL,
  `nm_kt_brg` varchar(25) NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `br_kategori`
--

INSERT INTO `br_kategori` (`id_kt_brg`, `nm_kt_brg`, `wkt_ubah`) VALUES
('BD', 'Body Part', '2014-11-08 00:00:00'),
('BP', 'Brake Part', '2014-11-08 00:00:00'),
('BR', 'Bearing', '2014-11-08 00:00:00'),
('BT', 'Battery', '2014-11-08 00:00:00'),
('CA', 'Cable', '2014-11-08 00:00:00'),
('CG', 'Chain & Gear', '2014-11-08 00:00:00'),
('CL', 'Clutch', '2014-11-08 00:00:00'),
('EL', 'Electric Part', '2014-11-08 00:00:00'),
('EP', 'Engine Part', '2014-11-08 00:00:00'),
('GS', 'Gasket', '2014-11-08 00:00:00'),
('OL', 'Oli', '2014-11-08 00:00:00'),
('OT', 'Other Part', '2014-11-08 00:00:00'),
('SU', 'Suspension', '2014-11-08 00:00:00'),
('WP', 'Wheel Part', '2014-11-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `br_kendaraan`
--

CREATE TABLE IF NOT EXISTS `br_kendaraan` (
  `id_kendaraan` varchar(3) NOT NULL,
  `kendaraan` varchar(25) NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `br_kendaraan`
--

INSERT INTO `br_kendaraan` (`id_kendaraan`, `kendaraan`, `wkt_ubah`) VALUES
('A', 'Semua', '2014-11-08 00:00:00'),
('H', 'Honda', '2014-11-08 00:00:00'),
('K', 'Kawasaki', '2014-11-08 00:00:00'),
('S', 'Suzuki', '2014-11-08 00:00:00'),
('Y', 'Yamaha', '2014-11-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `br_kualitas`
--

CREATE TABLE IF NOT EXISTS `br_kualitas` (
  `id_kualitas` varchar(2) NOT NULL,
  `kualitas` varchar(25) NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `br_kualitas`
--

INSERT INTO `br_kualitas` (`id_kualitas`, `kualitas`, `wkt_ubah`) VALUES
('A', 'Kualitas 1', '2014-11-08 00:00:00'),
('B', 'Kualitas 2', '2014-11-08 00:00:00'),
('L', 'Lokal', '2014-11-08 00:00:00'),
('L2', 'Lokal2', '2014-11-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `br_pembelian`
--

CREATE TABLE IF NOT EXISTS `br_pembelian` (
  `no_pes` varchar(25) NOT NULL,
  `tgl_pes` date NOT NULL,
  `id_sup` varchar(25) NOT NULL,
  `total_pembayaran` double NOT NULL,
  `diterima` enum('0','1') NOT NULL,
  `id_pengguna` text NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `br_pembelian_detail`
--

CREATE TABLE IF NOT EXISTS `br_pembelian_detail` (
`id` int(11) NOT NULL,
  `no_pes` varchar(25) NOT NULL,
  `tgl_pes` date NOT NULL,
  `id_sup` varchar(8) NOT NULL,
  `id_brg` varchar(25) NOT NULL,
  `hrg_brg` double NOT NULL,
  `jml_brg` int(11) NOT NULL,
  `total` double NOT NULL,
  `diterima` enum('0','1') NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `br_rak`
--

CREATE TABLE IF NOT EXISTS `br_rak` (
`id_rak` int(2) NOT NULL,
  `nm_rak` varchar(25) NOT NULL,
  `ket` text NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `br_rak`
--

INSERT INTO `br_rak` (`id_rak`, `nm_rak`, `ket`, `wkt_ubah`) VALUES
(1, 'RAK-01', '', '2014-11-08 00:00:00'),
(2, 'RAK-02', '', '2014-11-08 00:00:00'),
(3, 'RAK-03', '', '2014-11-08 00:00:00'),
(4, 'RAK-04', '', '2014-11-08 00:00:00'),
(5, 'RAK-05', '', '2014-11-08 00:00:00'),
(6, 'RAK-06', '', '2014-11-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `br_satuan`
--

CREATE TABLE IF NOT EXISTS `br_satuan` (
  `id_satuan` varchar(2) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `br_satuan`
--

INSERT INTO `br_satuan` (`id_satuan`, `satuan`, `wkt_ubah`) VALUES
('B', 'Botol', '2014-11-08 00:00:00'),
('K', 'Kardus', '2014-11-08 00:00:00'),
('P', 'Pasang', '2014-11-08 00:00:00'),
('PC', 'Pack', '2014-11-08 00:00:00'),
('S', 'Satuan', '2014-11-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dt_pegawai`
--

CREATE TABLE IF NOT EXISTS `dt_pegawai` (
  `id_peg` varchar(11) NOT NULL,
  `nm_peg` varchar(50) NOT NULL,
  `jns_kelamin` enum('L','P') NOT NULL,
  `tmpt_lahir` varchar(20) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `almt_peg` text NOT NULL,
  `telp_peg` varchar(15) NOT NULL,
  `pend_peg` varchar(25) NOT NULL,
  `tgl_bergabung` date NOT NULL,
  `photo_peg` text NOT NULL,
  `pengalaman_peg` text NOT NULL,
  `kel_id` int(11) NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dt_pegawai`
--

INSERT INTO `dt_pegawai` (`id_peg`, `nm_peg`, `jns_kelamin`, `tmpt_lahir`, `tgl_lahir`, `almt_peg`, `telp_peg`, `pend_peg`, `tgl_bergabung`, `photo_peg`, `pengalaman_peg`, `kel_id`, `wkt_ubah`) VALUES
('PG-1409-001', 'Ahmad Kosasih', 'L', 'Garut', '1987-09-10', 'Perumahan taman griya kencana blok A3/16. ', '0899922122', 'SMK : Otomotive', '2014-09-30', 'pegawai/photo/3246d31225ec7c5c29c6faada2d07d29.jpg', '5 thn : Astra Suzuki', 5, '2014-11-08 00:00:00'),
('PG-1411-002', 'Siti Juleaha', 'L', 'Bogor', '1990-11-01', 'jl. Kenangan no 70 .', '0898123456', 'SMK : Akuntansi', '2014-11-08', 'pegawai/photo/55079bd7efaf2f7a5c843a720ff9e1fe.jpg', '2 Thn : Astra Suzuki', 3, '2014-11-08 10:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `dt_pelanggan`
--

CREATE TABLE IF NOT EXISTS `dt_pelanggan` (
  `id_plg` varchar(8) NOT NULL,
  `nm_plg` varchar(30) NOT NULL,
  `tgl_registrasi` date NOT NULL,
  `masa_berlaku` date NOT NULL,
  `almt_plg` text NOT NULL,
  `telp_plg` varchar(13) NOT NULL,
  `jns_kelamin` enum('L','P') NOT NULL,
  `photo_plg` text NOT NULL,
  `transaksi` int(3) NOT NULL,
  `perpanjang` int(11) NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dt_pelanggan`
--

INSERT INTO `dt_pelanggan` (`id_plg`, `nm_plg`, `tgl_registrasi`, `masa_berlaku`, `almt_plg`, `telp_plg`, `jns_kelamin`, `photo_plg`, `transaksi`, `perpanjang`, `wkt_ubah`) VALUES
('14050001', 'Aris Winardi', '2014-05-08', '2015-05-08', 'Perumahan Taman Griya Kencana Blok A9/16 RT 003/08 Kel.Kencana, Kec.Tanah Sareal Kota Bogor.', '087870870412', 'L', '../photo/pelanggan/2x3.jpg', 2, 0, '2014-07-08 07:27:56'),
('14050002', 'Ida Farida', '2014-05-08', '2015-05-08', 'Kp.Babakan Leuwiliang Kel.Leuiwiliang Kec.Leuwiliang RT.03-006 Bogor 16640', '085716756295', 'P', '../photo/pelanggan/a.PNG', 1, 0, '2014-08-29 14:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `dt_pengguna`
--

CREATE TABLE IF NOT EXISTS `dt_pengguna` (
`id_pengguna` int(3) NOT NULL,
  `nm_pengguna` text NOT NULL,
  `nm_asli` varchar(30) NOT NULL,
  `kel_id` int(2) NOT NULL,
  `photo_pengguna` text NOT NULL,
  `kt_sandi` text NOT NULL,
  `terakhir_masuk` text NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dt_pengguna`
--

INSERT INTO `dt_pengguna` (`id_pengguna`, `nm_pengguna`, `nm_asli`, `kel_id`, `photo_pengguna`, `kt_sandi`, `terakhir_masuk`, `wkt_ubah`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'Adminisitrator', 1, '../photo/kotuxkuning.jpg', '21232f297a57a5a743894a0e4a801fc3', '2014-11-07 20:30:28', '2014-07-08 19:37:27'),
(8, '1a0f8e986f500286f4b7cca329ca58e4', 'simabes', 1, '../photo/g4475.png', '1a0f8e986f500286f4b7cca329ca58e4', '2014-11-08 10:22:46', '2014-07-08 18:43:12'),
(64, '3c7854def220f0443c957ada0fe88ba9', 'Aris Winardi', 2, '../photo/pelanggan/aris.png', '1a0f8e986f500286f4b7cca329ca58e4', '2014-08-29 19:31:10', '2014-08-29 19:31:01'),
(65, '18a6afcbe0f9fccde7693f8d95b2ce71', 'Ida Farida', 2, '../photo/pelanggan/ida farida.jpg', '1a0f8e986f500286f4b7cca329ca58e4', '2014-08-29 19:33:49', '2014-08-29 14:19:49'),
(170, '23e9d1904a21e1a4b8a82d47652351bd', 'Ahmad Kosasih', 5, 'pegawai/photo/3246d31225ec7c5c29c6faada2d07d29.jpg', 'ddb62cd8defbe648b3b0c10128069685', '', '0000-00-00 00:00:00'),
(209, 'bb9af366bcb83df13b7fcd49f3e4f1a2', 'Siti Juleaha', 3, 'pegawai/photo/55079bd7efaf2f7a5c843a720ff9e1fe.jpg', '032340d034963f80389116adc4b06e92', '', '2014-11-08 10:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `kel_pengguna`
--

CREATE TABLE IF NOT EXISTS `kel_pengguna` (
`kel_id` int(2) NOT NULL,
  `nm_kel` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kel_pengguna`
--

INSERT INTO `kel_pengguna` (`kel_id`, `nm_kel`) VALUES
(1, 'Administrator'),
(2, 'Pelanggan'),
(3, 'Pelayanan'),
(4, 'Gudang'),
(5, 'Mekanik'),
(6, 'Pemilik');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan`
--

CREATE TABLE IF NOT EXISTS `keuangan` (
`id` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `ket` longtext NOT NULL,
  `masuk` double NOT NULL,
  `keluar` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan`
--

INSERT INTO `keuangan` (`id`, `tgl`, `ket`, `masuk`, `keluar`) VALUES
(6, '2014-11-08', 'Pemasukan dari transaksi pelayanan (ST/TR/141108/0001)', 35000, 0),
(7, '2014-11-08', 'Pemasukan dari transaksi pelayanan (ST/TR/141108/0001)', 65000, 0),
(8, '2014-11-08', 'Pemasukan dari transaksi penjualan (ST/PL/141108/0001)', 52000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `log_sistem`
--

CREATE TABLE IF NOT EXISTS `log_sistem` (
`log_id` int(11) NOT NULL,
  `log_tipe` enum('Staff','Pelanggan','Sistem') NOT NULL DEFAULT 'Staff',
  `pengguna` varchar(50) NOT NULL,
  `log_lokasi` varchar(50) NOT NULL,
  `log_pesan` text NOT NULL,
  `log_waktu` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_sistem`
--

INSERT INTO `log_sistem` (`log_id`, `log_tipe`, `pengguna`, `log_lokasi`, `log_pesan`, `log_waktu`) VALUES
(1, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 10:14:24'),
(2, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 10:15:06'),
(3, 'Staff', 'simabes', 'Work Order', 'A:1:Menyimpan Work Order (WO/141108/001)', '2014-11-08 10:17:13'),
(4, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 10:17:13'),
(5, 'Staff', 'simabes', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-08 10:17:15'),
(6, 'Staff', 'simabes', 'Work Order (cont) ', 'A:1:Menambahkan pelayanan (101 | ST/TR/141108/0001)', '2014-11-08 10:17:47'),
(7, 'Staff', 'simabes', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-08 10:17:48'),
(8, 'Staff', 'simabes', 'Work Order (cont) ', 'A:1:Menambahkan Barang (BP00001 | ST/TR/141108/0001)', '2014-11-08 10:17:56'),
(9, 'Staff', 'simabes', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-08 10:17:57'),
(10, 'Staff', 'simabes', 'Work Order (cont) ', 'A:1:Menyimpan Work Order (WO/141108/001 | ST/TR/141108/0001)', '2014-11-08 10:18:10'),
(11, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 10:18:10'),
(12, 'Staff', 'simabes', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-08 10:18:13'),
(13, 'Staff', 'simabes', 'Work Order (cont) ', 'A:3:Memperbaharui Work Order (WO/141108/001 | ST/TR/141108/0001)', '2014-11-08 10:18:16'),
(14, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 10:18:17'),
(15, 'Staff', 'simabes', 'Transaksi Pelayanan', 'A:2:Membuka', '2014-11-08 10:18:18'),
(16, 'Staff', 'simabes', 'Transaksi Pelayanan', 'A:1:Menyimpan Pelayanan (WO/141108/001 | ST/TR/141108/0001)', '2014-11-08 10:18:23'),
(17, 'Staff', 'simabes', 'Pembayaran Transaksi ST/TR/141108/0001', 'A:2:Membuka', '2014-11-08 10:18:25'),
(18, 'Staff', 'simabes', 'Pembayaran Transaksi ST/TR/141108/0001', 'A:1:Menyelesaikan Pelayanan ( ST/TR/141108/0001)', '2014-11-08 10:18:31'),
(19, 'Staff', 'simabes', 'Pembayaran Transaksi ST/TR/141108/0001', 'A:1:Menyimpan Pemasukan (ST/TR/141108/0001)', '2014-11-08 10:18:31'),
(20, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 10:18:32'),
(21, 'Staff', 'simabes', 'Penjualan Langsung', 'A:1:Menambahkan Barang (BD00009 | ST/PL/141108/0001)', '2014-11-08 10:18:47'),
(22, 'Staff', 'simabes', 'Penjualan Langsung', 'A:1:Menyimpan Penjualan (ST/PL/141108/0001)', '2014-11-08 10:19:02'),
(23, 'Staff', 'simabes', 'Penjualan Langsung', 'A:1:Menyelesaikan Penjualan (ST/PL/141108/0001)', '2014-11-08 10:19:07'),
(24, 'Staff', 'simabes', 'Penjualan Langsung', 'A:1:Menyimpan Pemasukan (ST/PL/141108/0001)', '2014-11-08 10:19:07'),
(25, 'Sistem', 'simabes', 'System', 'Pengguna (simabes) keluar', '2014-11-08 10:22:35'),
(26, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-11-08 10:22:46'),
(27, 'Staff', 'simabes', 'Data Pengguna Aplikasi', 'A:4:Menghapus pengguna (204)', '2014-11-08 10:23:02'),
(28, 'Staff', 'simabes', 'Data Pengguna Aplikasi', 'A:4:Menghapus pengguna (206)', '2014-11-08 10:23:02'),
(29, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 10:23:10'),
(30, 'Staff', 'simabes', 'Tambah Data Pegawai', 'A:1:Berhasil menambahkan pegawai ID pegawai (PG-1411-002)', '2014-11-08 10:25:03'),
(31, 'Staff', 'simabes', 'Data Kelompok Pengguna', 'A:4:Menghapus kelompok pengguna (7)', '2014-11-08 10:25:20'),
(32, 'Sistem', 'simabes', 'System', 'Pengguna (simabes) keluar', '2014-11-08 10:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(2) NOT NULL,
  `nm_menu` varchar(20) NOT NULL,
  `class` varchar(10) NOT NULL,
  `links` text NOT NULL,
  `icon` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nm_menu`, `class`, `links`, `icon`, `value`) VALUES
(1, 'Halaman Muka', 'menu', '?mod=utama', '../img/rumah_pth.png', ''),
(2, 'Pelanggan', 'menu', '?mod=pelanggan', '../img/orang_pth.png', 'Halaman ini digunakan untuk mengolah data pelanggan seperti : pendaftaran  pelanggan baru, mengetahui data pelanggan dan pembuatan kartu pelanggan'),
(3, 'Pelayanan', 'menu', '?mod=pelayanan', '../img/tab_pth.png', 'Halaman ini digunakan untuk melakukan pelayanan pada sebuah bengkel. Seperti, pelayanan perbaikan, penjualan langsung. dll'),
(4, 'Barang', 'menu', '?mod=barang', '../img/sistem_pth.png', 'Halaman yang digunakan untuk mengolah data barang, pengkategorian barang, hingga pendataan supplier.'),
(5, 'Pegawai', 'menu', '?mod=pegawai', '../img/orang_pth.png', 'Halaman ini digunakan untuk mengolah data pegawai seperti : penambahan pegawai baru, mengetahui data peawai dan pembuatan kartu pegawai'),
(6, 'Pelaporan', 'menu', '?mod=pelaporan', '../img/daftar_pth.png', 'Halaman yang menampilkan laporan data pada sistem. Seperti, Laporan data pelanggan, laporan pelayanan, laporan keuangan, dll'),
(7, 'Sistem', 'menu', '?mod=sistem', '../img/sistem_pth.png', ''),
(8, 'Keluar', 'keluar', '../logout.php', '../img/hapus_pth.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE IF NOT EXISTS `pengaturan` (
`id` int(1) NOT NULL,
  `versi_aplikasi` varchar(15) NOT NULL,
  `nm_bengkel` varchar(30) NOT NULL,
  `telp1` varchar(30) NOT NULL,
  `telp2` varchar(30) NOT NULL,
  `almt_bengkel` text NOT NULL,
  `logo_bengkel` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `versi_aplikasi`, `nm_bengkel`, `telp1`, `telp2`, `almt_bengkel`, `logo_bengkel`) VALUES
(1, 'Ahwaya RJ 2', 'Bengkel CV. Anugraha', '(0251) 75434433', '08889000216 / 081318447036', 'Jl. Perum Taman Griya Kencana Blok A18 No.5 Kel.Kencana, Kec.Tanah Sareal Kota Bogor', '../img/72d0e55155dd4a56bab22d41fad385e8.png');

-- --------------------------------------------------------

--
-- Table structure for table `ply_`
--

CREATE TABLE IF NOT EXISTS `ply_` (
  `no_struk` varchar(25) NOT NULL,
  `no_wo` varchar(25) NOT NULL,
  `tgl_struk` date NOT NULL,
  `uang_bayar` double NOT NULL,
  `total_pembayaran` double NOT NULL,
  `id_pengguna` text NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ply_`
--

INSERT INTO `ply_` (`no_struk`, `no_wo`, `tgl_struk`, `uang_bayar`, `total_pembayaran`, `id_pengguna`, `wkt_ubah`) VALUES
('ST/TR/141108/0001', 'WO/141108/001', '2014-11-08', 70000, 65000, '8', '2014-11-08 10:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `ply_detail`
--

CREATE TABLE IF NOT EXISTS `ply_detail` (
  `no_struk` varchar(25) NOT NULL,
  `id_kt_ply` int(11) NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ply_detail`
--

INSERT INTO `ply_detail` (`no_struk`, `id_kt_ply`, `wkt_ubah`) VALUES
('ST/TR/141108/0001', 101, '2014-11-08 10:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `ply_kategori`
--

CREATE TABLE IF NOT EXISTS `ply_kategori` (
`id_kt_ply` int(11) NOT NULL,
  `nm_kt_ply` varchar(30) NOT NULL,
  `biaya` double NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ply_kategori`
--

INSERT INTO `ply_kategori` (`id_kt_ply`, `nm_kt_ply`, `biaya`, `wkt_ubah`) VALUES
(100, 'Kelistrikan', 10000, '2014-11-08 00:00:00'),
(101, 'Pemasangan', 5000, '2014-11-08 00:00:00'),
(102, 'Service', 30000, '2014-11-08 00:00:00'),
(103, 'Overhoul', 50000, '2014-11-08 00:00:00'),
(104, 'Pencucian Motor', 7000, '2014-11-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ply_penjualan`
--

CREATE TABLE IF NOT EXISTS `ply_penjualan` (
  `no_struk` varchar(25) NOT NULL,
  `tgl_struk` date NOT NULL,
  `nm_plg` varchar(25) NOT NULL,
  `total_pembayaran` double NOT NULL,
  `uang_bayar` double NOT NULL,
  `id_pengguna` text NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ply_penjualan`
--

INSERT INTO `ply_penjualan` (`no_struk`, `tgl_struk`, `nm_plg`, `total_pembayaran`, `uang_bayar`, `id_pengguna`, `wkt_ubah`) VALUES
('ST/PL/141108/0001', '2014-11-08', 'Egi Adithia Pradana', 52000, 60000, '8', '2014-11-08 10:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `ply_penjualan_detail`
--

CREATE TABLE IF NOT EXISTS `ply_penjualan_detail` (
  `no_struk` varchar(25) NOT NULL,
  `id_brg` varchar(25) NOT NULL,
  `jml_brg` int(3) NOT NULL,
  `total` double NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ply_penjualan_detail`
--

INSERT INTO `ply_penjualan_detail` (`no_struk`, `id_brg`, `jml_brg`, `total`, `wkt_ubah`) VALUES
('ST/TR/141108/0001', 'BP00001', 2, 60000, '2014-11-08 10:17:56'),
('ST/PL/141108/0001', 'BD00009', 2, 52000, '2014-11-08 10:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `ply_wo`
--

CREATE TABLE IF NOT EXISTS `ply_wo` (
  `no_wo` varchar(25) NOT NULL,
  `id_plg` int(8) NOT NULL,
  `tgl_wo` date NOT NULL,
  `no_polisi` varchar(15) NOT NULL,
  `no_mesin` varchar(20) NOT NULL,
  `jns_kendaraan` varchar(50) NOT NULL,
  `km_terakhir` varchar(12) NOT NULL,
  `keluhan` text NOT NULL,
  `saran` text NOT NULL,
  `id_peg` varchar(11) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ply_wo`
--

INSERT INTO `ply_wo` (`no_wo`, `id_plg`, `tgl_wo`, `no_polisi`, `no_mesin`, `jns_kendaraan`, `km_terakhir`, `keluhan`, `saran`, `id_peg`, `status`, `wkt_ubah`) VALUES
('WO/141108/001', 14050001, '2014-11-08', 'B6166VKB', 'NDE-1197171', 'Honda Astre Grand 1993', '-', 'rem blong', 'jangan dipaksakan bila rem sudah haus', 'PG-1409-001', '3', '2014-11-08 10:18:23');

-- --------------------------------------------------------

--
-- Table structure for table `sementara`
--

CREATE TABLE IF NOT EXISTS `sementara` (
  `id_sementara` varchar(30) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sup_data`
--

CREATE TABLE IF NOT EXISTS `sup_data` (
`id_sup` int(8) NOT NULL,
  `nm_sup` varchar(30) NOT NULL,
  `almt_sup` text NOT NULL,
  `telp_sup` varchar(13) NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sup_data`
--

INSERT INTO `sup_data` (`id_sup`, `nm_sup`, `almt_sup`, `telp_sup`, `wkt_ubah`) VALUES
(1, 'PT. Sinar Galih', 'Jl. Perintis Kemerdekaan 2', '09899', '2014-11-08 00:00:00'),
(2, 'PT. Gunung Agung', 'Jl. Gunung Agung', '099222', '2014-11-08 00:00:00'),
(3, 'Toko Spare Part Merdeka', 'Jl. Merdeka', '098222', '2014-11-08 00:00:00'),
(4, 'PT. Gajah Mungkur', 'Jl. gajah mungkur', '09877773', '2014-11-08 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `br_data`
--
ALTER TABLE `br_data`
 ADD PRIMARY KEY (`id_brg`), ADD KEY `id_sup` (`id_sup`), ADD KEY `kategori` (`id_kt_brg`,`id_satuan`,`id_rak`);

--
-- Indexes for table `br_data_perkendaraan`
--
ALTER TABLE `br_data_perkendaraan`
 ADD PRIMARY KEY (`id_data`);

--
-- Indexes for table `br_kategori`
--
ALTER TABLE `br_kategori`
 ADD PRIMARY KEY (`id_kt_brg`);

--
-- Indexes for table `br_kendaraan`
--
ALTER TABLE `br_kendaraan`
 ADD PRIMARY KEY (`id_kendaraan`), ADD KEY `id` (`id_kendaraan`);

--
-- Indexes for table `br_kualitas`
--
ALTER TABLE `br_kualitas`
 ADD PRIMARY KEY (`id_kualitas`);

--
-- Indexes for table `br_pembelian`
--
ALTER TABLE `br_pembelian`
 ADD PRIMARY KEY (`no_pes`);

--
-- Indexes for table `br_pembelian_detail`
--
ALTER TABLE `br_pembelian_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `br_rak`
--
ALTER TABLE `br_rak`
 ADD PRIMARY KEY (`id_rak`);

--
-- Indexes for table `br_satuan`
--
ALTER TABLE `br_satuan`
 ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `dt_pegawai`
--
ALTER TABLE `dt_pegawai`
 ADD PRIMARY KEY (`id_peg`);

--
-- Indexes for table `dt_pelanggan`
--
ALTER TABLE `dt_pelanggan`
 ADD PRIMARY KEY (`id_plg`);

--
-- Indexes for table `dt_pengguna`
--
ALTER TABLE `dt_pengguna`
 ADD PRIMARY KEY (`id_pengguna`), ADD KEY `kel_id` (`kel_id`);

--
-- Indexes for table `kel_pengguna`
--
ALTER TABLE `kel_pengguna`
 ADD PRIMARY KEY (`kel_id`), ADD KEY `kel_id` (`kel_id`);

--
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_sistem`
--
ALTER TABLE `log_sistem`
 ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id_menu`), ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ply_`
--
ALTER TABLE `ply_`
 ADD PRIMARY KEY (`no_struk`);

--
-- Indexes for table `ply_detail`
--
ALTER TABLE `ply_detail`
 ADD KEY `no_struk` (`no_struk`), ADD KEY `id_kt_ply` (`id_kt_ply`);

--
-- Indexes for table `ply_kategori`
--
ALTER TABLE `ply_kategori`
 ADD PRIMARY KEY (`id_kt_ply`);

--
-- Indexes for table `ply_penjualan`
--
ALTER TABLE `ply_penjualan`
 ADD PRIMARY KEY (`no_struk`);

--
-- Indexes for table `ply_penjualan_detail`
--
ALTER TABLE `ply_penjualan_detail`
 ADD KEY `no_struk` (`no_struk`);

--
-- Indexes for table `ply_wo`
--
ALTER TABLE `ply_wo`
 ADD PRIMARY KEY (`no_wo`);

--
-- Indexes for table `sementara`
--
ALTER TABLE `sementara`
 ADD KEY `id_plg` (`id_sementara`);

--
-- Indexes for table `sup_data`
--
ALTER TABLE `sup_data`
 ADD PRIMARY KEY (`id_sup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `br_data_perkendaraan`
--
ALTER TABLE `br_data_perkendaraan`
MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `br_pembelian_detail`
--
ALTER TABLE `br_pembelian_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `br_rak`
--
ALTER TABLE `br_rak`
MODIFY `id_rak` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `dt_pengguna`
--
ALTER TABLE `dt_pengguna`
MODIFY `id_pengguna` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=210;
--
-- AUTO_INCREMENT for table `kel_pengguna`
--
ALTER TABLE `kel_pengguna`
MODIFY `kel_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `log_sistem`
--
ALTER TABLE `log_sistem`
MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
MODIFY `id` int(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ply_kategori`
--
ALTER TABLE `ply_kategori`
MODIFY `id_kt_ply` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `sup_data`
--
ALTER TABLE `sup_data`
MODIFY `id_sup` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
