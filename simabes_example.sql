-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 16, 2015 at 03:01 PM
-- Server version: 5.5.40-1
-- PHP Version: 5.6.4-4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simabes_example`
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
('BD00006', '', 'Sayap Honda Grand', 'BD', 'A', 30000, 35000, 'S', 9, 1, 1, '1', '2014-06-21', 'Tidak ada keterangan untuk barang ini', 'barang/photo/default.png', 1, '0', '2014-10-28 10:08:51'),
('BD00008', '45106-KG2-AS', 'DISC PAD a', 'BP', 'A', 20000, 25000, 'B', 11, 1, 1, '1', '2014-07-08', 'Tidak ada keterangan untuk barang ini', 'barang/photo/default.png', 1, '0', '2014-11-07 20:25:11'),
('BD00009', '53205-GN5-830FB', 'Cover Handle Front', 'BD', 'A', 20000, 26000, 'S', 3, 1, 1, '1', '2014-08-13', 'Astrea Grand, Legenda', 'barang/photo/default.png', 0, '0', '2014-11-02 19:51:33'),
('BD00010', '53205-KEV-830FB', 'Cover Handle Front', 'BD', 'A', 25000, 31000, 'B', 6, 1, 1, '1', '2014-08-13', 'SupraX', 'barang/photo/f53d63bfc4b2fcca2a81ae51546955e4.png', 0, '0', '2014-12-11 15:03:58'),
('BP00001', '45106-KG2-NA', 'DISC PAD', 'BP', 'A', 25000, 30000, 'S', 10, 1, 1, '1', '2014-06-21', 'Tidak ada keterangan untuk barang ini', 'barang/photo/680552858bc73ba6fe46a41cbdd7ca68.jpg', 0, '0', '2014-12-11 15:03:35'),
('BT00001', '12N5-3B KIT', 'BATTERY', 'BT', 'A', 88000, 100000, 'S', 11, 1, 1, '1', '2014-06-14', 'HND : Astrea Prima/Grand, Impressa, Supra\r\nYMH : Alfa, Force-1, Crypton, Vega, Sigma\r\nSZK : RC80, RC100, RC110, Tornado, Shogun\r\nKWK , Kaze, VSP, Corsa, STR, AR-125,', 'barang/photo/default.png', 0, '0', '2014-11-03 11:31:04'),
('BT00002', 'GM2-5A-3C-2', 'BATTERY', 'BT', 'A', 68000, 73000, 'S', 11, 1, 1, '1', '2014-06-14', 'HND : GL PRO, GL Max, GL 100(CDI), MegaPro,', 'barang/photo/default.png', 0, '0', '2014-10-30 20:34:11'),
('BT00003', 'GM2-3B KIT', 'BATTERY', 'BT', 'A', 86000, 91000, 'S', 12, 1, 1, '1', '2014-06-14', 'YMM : RXK-New, TZM;\r\nSZK : Satria(kick)', 'barang/photo/default.png', 0, '0', '2014-10-30 20:33:56'),
('EL00001', 'asd12e', 'Lampu LED Variasi', 'EL', 'A', 20000, 25000, 'S', 21, 1, 1, '1', '2014-06-16', 'Tidak ada keterangan untuk barang ini', 'barang/photo/default.png', 0, '0', '2014-11-03 11:31:11'),
('EL00002', 'asd12e', 'Lampu LED Variasi', 'EL', 'A', 20000, 25000, 'S', 25, 1, 1, '1', '2014-06-16', 'Tidak ada keterangan untuk barang ini', 'barang/photo/default.png', 0, '0', '2014-07-08 18:43:12'),
('EL00003', '', 'Lampu Hazard', 'EL', 'B', 25000, 30000, 'S', 92, 1, 3, '1', '2014-06-19', 'Tidak ada keterangan untuk barang ini', 'barang/photo/default.png', 0, '0', '2014-07-24 12:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `br_data_perkendaraan`
--

CREATE TABLE IF NOT EXISTS `br_data_perkendaraan` (
`id_data` int(11) NOT NULL,
  `id_brg` varchar(9) NOT NULL,
  `id_kendaraan` varchar(2) NOT NULL,
  `wkt_ubah` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `br_data_perkendaraan`
--

INSERT INTO `br_data_perkendaraan` (`id_data`, `id_brg`, `id_kendaraan`, `wkt_ubah`) VALUES
(12, 'EL00002', 'A', '2014-07-08 18:43:12'),
(77, 'EL00003', 'A', '2014-07-24 12:55:31'),
(124, 'BD00006', 'H', '0000-00-00 00:00:00'),
(128, 'BT00003', 'A', '0000-00-00 00:00:00'),
(129, 'BT00002', 'A', '0000-00-00 00:00:00'),
(132, 'BD00009', 'H', '0000-00-00 00:00:00'),
(133, 'BT00001', 'A', '0000-00-00 00:00:00'),
(134, 'EL00001', 'A', '0000-00-00 00:00:00'),
(135, 'BD00008', 'A', '2014-11-07 20:25:11'),
(139, 'BP00001', 'A', '2014-12-11 15:03:35'),
(140, 'BD00010', 'H', '2014-12-11 15:03:58');

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
('BD', 'Body Part', '2014-07-08 18:43:12'),
('BP', 'Brake Part', '2014-07-08 18:43:12'),
('BR', 'Bearing', '2014-07-08 18:43:12'),
('BT', 'Battery', '2014-07-08 18:43:12'),
('CA', 'Cable', '2014-07-08 18:43:12'),
('CG', 'Chain & Gear', '2014-07-08 18:43:12'),
('CL', 'Clutch', '2014-07-08 18:43:12'),
('EL', 'Electric Part', '2014-07-08 18:43:12'),
('EP', 'Engine Part', '2014-07-08 18:43:12'),
('GS', 'Gasket', '2014-07-08 18:43:12'),
('OL', 'Oli', '2014-07-08 18:43:12'),
('OT', 'Other Part', '2014-07-08 18:43:12'),
('SU', 'Suspension', '2014-07-08 18:43:12'),
('WP', 'Wheel Part', '2014-07-08 18:43:12');

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
('A', 'Semua', '2014-07-08 18:43:12'),
('H', 'Honda', '2014-07-08 18:43:12'),
('K', 'Kawasaki', '2014-07-08 18:43:12'),
('S', 'Suzuki', '2014-07-08 18:43:12'),
('Y', 'Yamaha', '2014-07-08 18:43:12');

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
('A', 'Kualitas 1', '2014-07-19 19:18:15'),
('B', 'Kualitas 2', '2014-07-08 18:43:12'),
('L', 'Lokal', '2014-07-08 18:43:12'),
('L2', 'Lokal2', '2014-11-07 19:46:30');

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

--
-- Dumping data for table `br_pembelian`
--

INSERT INTO `br_pembelian` (`no_pes`, `tgl_pes`, `id_sup`, `total_pembayaran`, `diterima`, `id_pengguna`, `wkt_ubah`) VALUES
('PS/141107/0001', '2014-11-07', '1', 200000, '1', '8', '2014-11-07 20:27:05');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `br_pembelian_detail`
--

INSERT INTO `br_pembelian_detail` (`id`, `no_pes`, `tgl_pes`, `id_sup`, `id_brg`, `hrg_brg`, `jml_brg`, `total`, `diterima`, `wkt_ubah`) VALUES
(1, 'PS/141107/0001', '2014-11-07', '1', 'BD00008', 20000, 10, 200000, '1', '2014-11-07 20:27:02');

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
(1, 'RAK-01', '', '2014-07-08 18:42:04'),
(2, 'RAK-02', '', '2014-07-08 18:42:04'),
(3, 'RAK-03', '', '2014-07-08 18:42:04'),
(4, 'RAK-04', '', '2014-07-08 18:42:04'),
(5, 'RAK-05', '', '2014-07-08 18:42:04'),
(6, 'RAK-06', '', '2014-07-08 18:42:04');

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
('B', 'Botol', '2014-07-19 19:27:24'),
('K', 'Kardus', '2014-10-25 08:55:26'),
('P', 'Pasang', '2014-07-08 18:43:12'),
('PC', 'Pack', '2014-07-08 18:43:12'),
('S', 'Satuan', '2014-07-08 18:43:12');

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
('PG-1409-001', 'Ahmad Kosasih', 'L', 'Garut', '1987-09-10', 'Perumahan taman griya kencana blok A3/16. ', '0899922122', 'SMK : Otomotive', '2014-09-30', 'pegawai/photo/3246d31225ec7c5c29c6faada2d07d29.jpg', '5 thn : Astra Suzuki', 5, '2014-10-16 13:55:52');

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
('14050001', 'Aris Winardi', '2014-05-08', '2015-05-08', 'Perumahan Taman Griya Kencana Blok A9/16 RT 003/08 Kel.Kencana, Kec.Tanah Sareal Kota Bogor.', '087870870412', 'L', '../photo/pelanggan/2x3.jpg', 1, 0, '2014-07-08 07:27:56'),
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
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dt_pengguna`
--

INSERT INTO `dt_pengguna` (`id_pengguna`, `nm_pengguna`, `nm_asli`, `kel_id`, `photo_pengguna`, `kt_sandi`, `terakhir_masuk`, `wkt_ubah`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'Adminisitrator', 1, '../photo/kotuxkuning.jpg', '21232f297a57a5a743894a0e4a801fc3', '2014-12-04 20:10:15', '2014-07-08 19:37:27'),
(8, '1a0f8e986f500286f4b7cca329ca58e4', 'simabes', 1, '../photo/g4475.png', '1a0f8e986f500286f4b7cca329ca58e4', '2015-01-16 14:52:12', '2014-07-08 18:43:12'),
(64, '3c7854def220f0443c957ada0fe88ba9', 'Aris Winardi', 2, '../photo/pelanggan/aris.png', '1a0f8e986f500286f4b7cca329ca58e4', '2014-08-29 19:31:10', '2014-08-29 19:31:01'),
(65, '18a6afcbe0f9fccde7693f8d95b2ce71', 'Ida Farida', 2, '../photo/pelanggan/ida farida.jpg', '1a0f8e986f500286f4b7cca329ca58e4', '2014-08-29 19:33:49', '2014-08-29 14:19:49'),
(170, '23e9d1904a21e1a4b8a82d47652351bd', 'Ahmad Kosasih', 5, 'pegawai/photo/3246d31225ec7c5c29c6faada2d07d29.jpg', 'ddb62cd8defbe648b3b0c10128069685', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kel_pengguna`
--

CREATE TABLE IF NOT EXISTS `kel_pengguna` (
`kel_id` int(2) NOT NULL,
  `nm_kel` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keuangan`
--

INSERT INTO `keuangan` (`id`, `tgl`, `ket`, `masuk`, `keluar`) VALUES
(1, '2014-11-07', 'Pemasukan dari transaksi pelayanan (ST/TR/141107/0001)', 365000, 0),
(2, '2014-11-07', 'Pemasukan dari transaksi penjualan (ST/PL/141107/0001)', 130000, 0),
(3, '2014-11-07', 'Pemasukan dari transaksi pelayanan (ST/TR/141107/0002)', 260000, 0),
(4, '2014-11-07', 'Pembayaran pemesanan barang (PS/141107/0001)', 0, 200000),
(5, '2014-11-08', 'Pemasukan dari transaksi penjualan (ST/PL/141108/0001)', 35000, 0),
(6, '2014-11-08', 'Pemasukan dari transaksi pelayanan (ST/TR/141108/0001)', 35000, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_sistem`
--

INSERT INTO `log_sistem` (`log_id`, `log_tipe`, `pengguna`, `log_lokasi`, `log_pesan`, `log_waktu`) VALUES
(1, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 18:26:26'),
(2, 'Staff', 'Adminisitrator', 'Work Order', 'A:1:Menyimpan Work Order (WO/141107/001)', '2014-11-07 18:26:51'),
(3, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 18:26:51'),
(4, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-07 18:26:53'),
(5, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:1:Menambahkan pelayanan (100 | ST/TR/141107/0001)', '2014-11-07 18:26:56'),
(6, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-07 18:26:57'),
(7, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:1:Menambahkan pelayanan (101 | ST/TR/141107/0001)', '2014-11-07 18:27:00'),
(8, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-07 18:27:01'),
(9, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:1:Menambahkan pelayanan (103 | ST/TR/141107/0001)', '2014-11-07 18:27:04'),
(10, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-07 18:27:04'),
(11, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:1:Menambahkan Barang (SU00001 | ST/TR/141107/0001)', '2014-11-07 18:27:13'),
(12, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-07 18:27:13'),
(13, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:1:Menambahkan Barang (EL00001 | ST/TR/141107/0001)', '2014-11-07 18:27:23'),
(14, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-07 18:27:23'),
(15, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:1:Menyimpan Work Order (WO/141107/001 | ST/TR/141107/0001)', '2014-11-07 18:27:39'),
(16, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 18:27:39'),
(17, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-07 18:27:41'),
(18, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:3:Memperbaharui Work Order (WO/141107/001 | ST/TR/141107/0001)', '2014-11-07 18:27:44'),
(19, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 18:27:44'),
(20, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'A:2:Membuka', '2014-11-07 18:27:46'),
(21, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'A:1:Menyimpan Pelayanan (WO/141107/001 | ST/TR/141107/0001)', '2014-11-07 18:27:49'),
(22, 'Staff', 'Adminisitrator', 'Pembayaran Transaksi ST/TR/141107/0001', 'A:2:Membuka', '2014-11-07 18:27:51'),
(23, 'Staff', 'Adminisitrator', 'Pembayaran Transaksi ST/TR/141107/0001', 'A:1:Menyelesaikan Pelayanan ( ST/TR/141107/0001)', '2014-11-07 18:27:56'),
(24, 'Staff', 'Adminisitrator', 'Pembayaran Transaksi ST/TR/141107/0001', 'A:1:Menyimpan Pemasukan (ST/TR/141107/0001)', '2014-11-07 18:27:56'),
(25, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 18:27:58'),
(26, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 18:29:07'),
(27, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'A:1:Menambahkan Barang (BD00006 | ST/PL/141107/0001)', '2014-11-07 18:29:27'),
(28, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'A:3:Memperbaharui Barang (BD00006 | ST/PL/141107/0001)', '2014-11-07 18:29:39'),
(29, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'A:1:Menambahkan Barang (BD00008 | ST/PL/141107/0001)', '2014-11-07 18:29:46'),
(30, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'A:1:Menyimpan Penjualan (ST/PL/141107/0001)', '2014-11-07 18:29:54'),
(31, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'A:1:Menyelesaikan Penjualan (ST/PL/141107/0001)', '2014-11-07 18:30:00'),
(32, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'A:1:Menyimpan Pemasukan (ST/PL/141107/0001)', '2014-11-07 18:30:00'),
(33, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 18:30:12'),
(34, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 18:30:14'),
(35, 'Staff', 'Adminisitrator', 'Work Order', 'A:1:Menyimpan Work Order (WO/141107/002)', '2014-11-07 18:30:39'),
(36, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 18:30:39'),
(37, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-07 18:30:41'),
(38, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:1:Menambahkan pelayanan (100 | ST/TR/141107/0002)', '2014-11-07 18:30:46'),
(39, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-07 18:30:46'),
(40, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:1:Menambahkan Barang (SU00001 | ST/TR/141107/0002)', '2014-11-07 18:30:51'),
(41, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-07 18:30:51'),
(42, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:1:Menyimpan Work Order (WO/141107/002 | ST/TR/141107/0002)', '2014-11-07 18:31:00'),
(43, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 18:31:00'),
(44, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-07 18:31:02'),
(45, 'Staff', 'Adminisitrator', 'Work Order (cont) ', 'A:3:Memperbaharui Work Order (WO/141107/002 | ST/TR/141107/0002)', '2014-11-07 18:31:05'),
(46, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 18:31:05'),
(47, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'A:2:Membuka', '2014-11-07 18:31:07'),
(48, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'A:1:Menyimpan Pelayanan (WO/141107/002 | ST/TR/141107/0002)', '2014-11-07 18:31:10'),
(49, 'Staff', 'Adminisitrator', 'Pembayaran Transaksi ST/TR/141107/0002', 'A:2:Membuka', '2014-11-07 18:31:12'),
(50, 'Staff', 'Adminisitrator', 'Pembayaran Transaksi ST/TR/141107/0002', 'A:1:Menyelesaikan Pelayanan ( ST/TR/141107/0002)', '2014-11-07 18:31:22'),
(51, 'Staff', 'Adminisitrator', 'Pembayaran Transaksi ST/TR/141107/0002', 'A:1:Menyimpan Pemasukan (ST/TR/141107/0002)', '2014-11-07 18:31:22'),
(52, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 18:31:23'),
(53, 'Staff', 'Adminisitrator', 'Masuk', 'A:6:Pengguna (Adminisitrator) Berhasil masuk', '2014-11-07 18:40:33'),
(54, 'Staff', 'Adminisitrator', 'Tambah Data Pelanggan', 'A:1:Menambahkan data pelanggan (14110001)', '2014-11-07 18:45:30'),
(55, 'Staff', 'Adminisitrator', 'Masuk', 'A:6:Pengguna (Adminisitrator) Berhasil masuk', '2014-11-07 19:09:26'),
(56, 'Staff', 'Adminisitrator', 'Masuk', 'A:6:Pengguna (Adminisitrator) Berhasil masuk', '2014-11-07 19:45:59'),
(57, 'Staff', 'Adminisitrator', 'Sunting Kualitas Barang', 'A:3:Memperbaharui data kualitas barang (L2)', '2014-11-07 19:46:10'),
(58, 'Staff', 'Adminisitrator', 'Sunting Kualitas Barang', 'A:3:Memperbaharui data kualitas barang (L2)', '2014-11-07 19:46:30'),
(59, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-11-07 19:46:52'),
(60, 'Staff', 'Adminisitrator', 'Masuk', 'A:6:Pengguna (Adminisitrator) Berhasil masuk', '2014-11-07 19:49:14'),
(61, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-11-07 19:49:16'),
(62, 'Staff', 'Adminisitrator', 'Masuk', 'A:6:Pengguna (Adminisitrator) Berhasil masuk', '2014-11-07 19:49:38'),
(63, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-11-07 19:49:41'),
(64, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-11-07 19:50:03'),
(65, 'Staff', 'simabes', 'Data Barang', 'A:4:Mengapus data barang (BD00011)', '2014-11-07 19:50:58'),
(66, 'Staff', 'simabes', 'Data Barang', 'A:4:Mengapus data barang (BT00004)', '2014-11-07 19:51:10'),
(67, 'Sistem', 'simabes', 'System', 'Pengguna (simabes) keluar', '2014-11-07 19:51:56'),
(68, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-11-07 19:53:18'),
(69, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-07 19:53:20'),
(70, 'Staff', 'simabes', 'Tambah Data Pegawai', 'A:1:Berhasil menambahkan pegawai ID pegawai (PG-1411-003)', '2014-11-07 20:21:15'),
(71, 'Staff', 'simabes', 'Sunting Data Pegawai', 'A:4:Menyunting data pegawai, ID pegawai (PG-1411-003)', '2014-11-07 20:21:20'),
(72, 'Staff', 'simabes', 'Sunting Data Pegawai', 'A:3:Memperbaharui pegawai (PG-1411-003)', '2014-11-07 20:21:50'),
(73, 'Staff', 'simabes', 'Sunting Barang', 'A:3:Memperbaharui data barang (BD00008)', '2014-11-07 20:25:11'),
(74, 'Staff', 'simabes', 'Stok Minimal', 'A:1:Menambahkan pembelian barang (BD00008)', '2014-11-07 20:25:17'),
(75, 'Staff', 'simabes', 'Pemesanan Barang', 'A:1:Menyimpan Pemesanan barang (PS/141107/0001)', '2014-11-07 20:27:05'),
(76, 'Staff', 'simabes', 'Penerimaan Pemesanan Barang', 'A:1:Menerima Pemesanan barang (PS/141107/0001 | BD00008)', '2014-11-07 20:30:03'),
(77, 'Staff', 'simabes', 'Penerimaan Pemesanan Barang', 'A:1:Menyelesaikan Pemesanan barang (PS/141107/0001)', '2014-11-07 20:30:07'),
(78, 'Staff', 'Adminisitrator', 'Masuk', 'A:6:Pengguna (Adminisitrator) Berhasil masuk', '2014-11-07 20:30:28'),
(79, 'Staff', 'Adminisitrator', '', 'A:1:Menyimpan pengaturan dasar bengkel', '2014-11-07 20:31:56'),
(80, 'Staff', 'Adminisitrator', '', 'A:1:Menyimpan pengaturan dasar bengkel', '2014-11-07 20:32:58'),
(81, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-11-07 20:33:25'),
(82, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-11-07 20:34:26'),
(83, 'Sistem', 'simabes', 'System', 'Pengguna (simabes) keluar', '2014-11-07 20:34:33'),
(84, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-11-08 07:13:59'),
(85, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 07:14:02'),
(86, 'Staff', 'simabes', 'Penjualan Langsung', 'A:1:Menambahkan Barang (BD00006 | ST/PL/141108/0001)', '2014-11-08 07:17:39'),
(87, 'Staff', 'simabes', 'Penjualan Langsung', 'A:1:Menyimpan Penjualan (ST/PL/141108/0001)', '2014-11-08 07:21:54'),
(88, 'Staff', 'simabes', 'Penjualan Langsung', 'A:1:Menyelesaikan Penjualan (ST/PL/141108/0001)', '2014-11-08 07:22:03'),
(89, 'Staff', 'simabes', 'Penjualan Langsung', 'A:1:Menyimpan Pemasukan (ST/PL/141108/0001)', '2014-11-08 07:22:03'),
(90, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 07:22:52'),
(91, 'Staff', 'simabes', 'Work Order', 'A:1:Menyimpan Work Order (WO/141108/001)', '2014-11-08 07:23:13'),
(92, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 07:23:13'),
(93, 'Staff', 'simabes', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-08 07:23:15'),
(94, 'Staff', 'simabes', 'Work Order (cont) ', 'A:1:Menambahkan pelayanan (100 | ST/TR/141108/0001)', '2014-11-08 07:23:20'),
(95, 'Staff', 'simabes', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-08 07:23:20'),
(96, 'Staff', 'simabes', 'Work Order (cont) ', 'A:1:Menambahkan Barang (EL00002 | ST/TR/141108/0001)', '2014-11-08 07:23:29'),
(97, 'Staff', 'simabes', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-08 07:23:30'),
(98, 'Staff', 'simabes', 'Work Order (cont) ', 'A:1:Menyimpan Work Order (WO/141108/001 | ST/TR/141108/0001)', '2014-11-08 07:23:40'),
(99, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 07:23:41'),
(100, 'Staff', 'simabes', 'Work Order (cont) ', 'A:2:Membuka', '2014-11-08 07:23:42'),
(101, 'Staff', 'simabes', 'Work Order (cont) ', 'A:3:Memperbaharui Work Order (WO/141108/001 | ST/TR/141108/0001)', '2014-11-08 07:23:46'),
(102, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 07:23:47'),
(103, 'Staff', 'simabes', 'Transaksi Pelayanan', 'A:2:Membuka', '2014-11-08 07:23:49'),
(104, 'Staff', 'simabes', 'Transaksi Pelayanan', 'A:1:Menyimpan Pelayanan (WO/141108/001 | ST/TR/141108/0001)', '2014-11-08 07:23:54'),
(105, 'Staff', 'simabes', 'Pembayaran Transaksi ST/TR/141108/0001', 'A:2:Membuka', '2014-11-08 07:23:56'),
(106, 'Staff', 'simabes', 'Pembayaran Transaksi ST/TR/141108/0001', 'A:1:Menyelesaikan Pelayanan ( ST/TR/141108/0001)', '2014-11-08 07:24:05'),
(107, 'Staff', 'simabes', 'Pembayaran Transaksi ST/TR/141108/0001', 'A:1:Menyimpan Pemasukan (ST/TR/141108/0001)', '2014-11-08 07:24:05'),
(108, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-08 07:24:07'),
(109, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-11-08 09:52:55'),
(110, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-11-15 14:08:36'),
(111, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-15 14:16:15'),
(112, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-15 14:16:18'),
(113, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-11-15 14:58:53'),
(114, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-15 14:59:01'),
(115, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-11-15 15:09:35'),
(116, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-11-21 23:32:50'),
(117, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-11-29 22:14:30'),
(118, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-12-01 21:08:02'),
(119, 'Staff', 'simabes', 'Tambah Data Pelanggan', 'A:1:Menambahkan data pelanggan (14120001)', '2014-12-01 21:08:32'),
(120, 'Staff', 'simabes', 'Sunting Data Pelanggan', 'A:4:Menyunting data pelanggan, ID pelanggan (14120001)', '2014-12-01 21:08:38'),
(121, 'Staff', 'Adminisitrator', 'Masuk', 'A:6:Pengguna (Adminisitrator) Berhasil masuk', '2014-12-04 19:14:06'),
(122, 'Staff', 'Adminisitrator', '', 'A:1:Menyimpan pengaturan dasar bengkel', '2014-12-04 19:27:18'),
(123, 'Staff', 'Adminisitrator', '', 'A:1:Menyimpan pengaturan dasar bengkel', '2014-12-04 19:28:39'),
(124, 'Staff', 'Adminisitrator', '', 'A:1:Menyimpan pengaturan dasar bengkel', '2014-12-04 19:32:23'),
(125, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-12-04 19:42:34'),
(126, 'Staff', 'simabes', '', 'A:1:Menyimpan pengaturan dasar bengkel', '2014-12-04 19:53:22'),
(127, 'Staff', 'simabes', 'Data Pelanggan', 'A:4:Menghapus data pelanggan, ID pelanggan (14110001)', '2014-12-04 19:54:45'),
(128, 'Staff', 'simabes', 'Data Pelanggan', 'A:4:Menghapus data pelanggan, ID pelanggan (14120001)', '2014-12-04 19:54:45'),
(129, 'Staff', 'simabes', '', 'A:4:Menghapus data pegawai, ID pegawai (PG-1410-002)', '2014-12-04 19:54:54'),
(130, 'Staff', 'simabes', '', 'A:4:Menghapus data pegawai, ID pegawai (PG-1411-003)', '2014-12-04 19:54:54'),
(131, 'Staff', 'simabes', 'Data Pengguna Aplikasi', 'A:4:Menghapus pengguna (204)', '2014-12-04 19:55:19'),
(132, 'Staff', 'simabes', 'Data Pengguna Aplikasi', 'A:4:Menghapus pengguna (206)', '2014-12-04 19:55:19'),
(133, 'Staff', 'simabes', 'Data Kelompok Pengguna', 'A:4:Menghapus kelompok pengguna (7)', '2014-12-04 19:55:27'),
(134, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-12-04 19:58:20'),
(135, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-12-04 20:09:23'),
(136, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:09:26'),
(137, 'Sistem', 'simabes', 'System', 'Pengguna (simabes) keluar', '2014-12-04 20:10:09'),
(138, 'Staff', 'Adminisitrator', 'Masuk', 'A:6:Pengguna (Adminisitrator) Berhasil masuk', '2014-12-04 20:10:15'),
(139, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:13:12'),
(140, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:13:42'),
(141, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:14:02'),
(142, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:14:11'),
(143, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:14:38'),
(144, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:14:51'),
(145, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:16:21'),
(146, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:16:42'),
(147, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:16:54'),
(148, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:17:05'),
(149, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:17:55'),
(150, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:18:02'),
(151, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:18:23'),
(152, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:18:51'),
(153, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:18:59'),
(154, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:19:35'),
(155, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:19:48'),
(156, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:20:16'),
(157, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:20:18'),
(158, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:20:38'),
(159, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:20:49'),
(160, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:21:12'),
(161, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:21:32'),
(162, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:21:42'),
(163, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:34:32'),
(164, 'Staff', 'Adminisitrator', 'Kartu Pegawai', 'A:5:Menambahkan antrian cetak kartu pegawai dengan ID pegawai (PG-1409-001) ', '2014-12-04 20:42:48'),
(165, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:43:36'),
(166, 'Staff', 'Adminisitrator', '', 'A:5:Menambahkan antrian cetak kartu pelanggan dengan ID pelanggan (14050001) ', '2014-12-04 20:50:50'),
(167, 'Staff', 'Adminisitrator', '', 'A:5:Menambahkan antrian cetak kartu pelanggan dengan ID pelanggan (14050002) ', '2014-12-04 20:50:50'),
(168, 'Staff', 'Adminisitrator', 'Data Work Order', 'A:2:Membuka', '2014-12-04 20:51:43'),
(169, 'Staff', '', 'Data Work Order', 'A:2:Membuka', '2014-12-05 19:48:47'),
(170, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-12-05 19:49:00'),
(171, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-12-08 13:48:21'),
(172, 'Sistem', 'simabes', 'System', 'Pengguna (simabes) keluar', '2014-12-08 13:48:33'),
(173, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-12-08 16:01:25'),
(174, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-12-08 16:01:38'),
(175, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-12-08 18:03:53'),
(176, 'Staff', 'simabes', 'Sunting Barang', 'A:3:Memperbaharui data barang (SU00001)', '2014-12-08 18:04:11'),
(177, 'Staff', 'simabes', 'Stok Minimal', 'A:1:Menambahkan pembelian barang (SU00001)', '2014-12-08 18:04:18'),
(178, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-12-09 11:35:48'),
(179, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-12-09 11:36:57'),
(180, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-12-10 12:09:35'),
(181, 'Sistem', 'simabes', 'System', 'Pengguna (simabes) keluar', '2014-12-10 12:10:34'),
(182, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-12-11 15:01:09'),
(183, 'Staff', 'simabes', 'Tambah Barang', 'A:1:Menyimpan data barang (OT00001)', '2014-12-11 15:02:30'),
(184, 'Staff', 'simabes', 'Sunting Barang', 'A:3:Memperbaharui data barang (BP00001)', '2014-12-11 15:03:35'),
(185, 'Staff', 'simabes', 'Sunting Barang', 'A:3:Memperbaharui data barang (BD00010)', '2014-12-11 15:03:58'),
(186, 'Staff', 'simabes', '', 'A:1:Menyimpan pengaturan dasar bengkel', '2014-12-11 15:30:43'),
(187, 'Staff', 'simabes', 'Data Work Order', 'A:2:Membuka', '2014-12-11 15:32:59'),
(188, 'Staff', '', 'Data Work Order', 'A:2:Membuka', '2014-12-11 16:25:52'),
(189, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-12-19 12:55:41'),
(190, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2014-12-26 17:30:08'),
(191, 'Staff', 'simabes', 'Masuk', 'A:6:Pengguna (simabes) Berhasil masuk', '2015-01-16 14:52:12'),
(192, 'Staff', 'simabes', 'Data Barang', 'A:4:Mengapus data barang (OT00001)', '2015-01-16 14:52:32'),
(193, 'Staff', 'simabes', 'Data Barang', 'A:4:Mengapus data barang (SU00001)', '2015-01-16 14:52:32');

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
  `nm_bengkel` varchar(30) NOT NULL,
  `telp1` varchar(30) NOT NULL,
  `telp2` varchar(30) NOT NULL,
  `almt_bengkel` text NOT NULL,
  `logo_bengkel` text NOT NULL,
  `tentang_bengkel` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nm_bengkel`, `telp1`, `telp2`, `almt_bengkel`, `logo_bengkel`, `tentang_bengkel`) VALUES
(1, 'Bengkel CV. Anugraha', '(0251) 75434433', '08889000216 / 081318447036', 'Jl. Perum Taman Griya Kencana Blok A18 No.5 Kel.Kencana, Kec.Tanah Sareal Kota Bogor', '../img/72d0e55155dd4a56bab22d41fad385e8.png', '<h1>Sejarah Bengkel</h1>\r\n\r\nCV. Anugrah adalah perusahaan yang bergerak dibidang pelayanan servis dan penjualan suku cadang khusus motor. Perusahaan yang beralamat di Jl. Perumahan Taman Griya Kencana Blok A18 No.5 . Kel. Kencana, Kec. Tanah Sareal, Kota Bogor. Dengan No.SIUP \r\n<br/><br/>Usaha ini dirintis sejak, tahun 2006 oleh bapak Sartono. Awalnya, bapak Sartono menekuni bisnis servis door to door, karena belum memiliki tempat usaha. Namun dengan ketekunan dan keuletan, akhirnya pada tahun 2007 mantan karyawan PT.Astra ini membuka sebuah bengkel kecil-kecilan. Tahun 2007 hingga 2008, bapak Sartono mulai berpindah-pindah tempat usaha dengan menyewa kios, tujuannya adalah agar warga didaerah tersebut mengenal bengkel ini. Hingga akhirnya usaha ini makin berkembang dari mulut kemulut dan semakin menunjukan kemajuan yang baik. Pelayanan servis dan penjualan suku cadang pun mulai meningkat. Pada tahun 2009, dibangunlah sebuah tempat yang digukan untuk usaha bengkel ini hingga sekarang.\r\n<br/><br/>Sebagai salah satu bengkel motor yang menekankan segi kualitas dengan berkomitmen untuk memberikan layanan dan solusi terbaik bagi pelanggan. Komitmen itu tercemin dalam visi dan misi perusahaan untuk menjadi bengkel yang terpercaya.\r\n<br><br><br>\r\n\r\n<h1>Visi Misi</h1>\r\n\r\n<li><h1>Visi</h1>\r\nMenjadi pusat reparasi motor yang menyediakan suku cadang  dan jasa servis yang mengutamakan pada kepuasan pelanggan didukung dengan tenaga ahli yang kompeten serta pelayanan yang optimal dan terpercaya.</li>\r\n\r\n<li><h1>Misi</h1>\r\n<ul>\r\n<li>Memberikan solusi terbaik pada peyediaan suku cadang terbaik dan reparasi yang terpercaya</li>\r\n<li>Memberikan pelayanan terbaik dan standar mutu pada pelanggan dengan menjalankan proses kerja terbaik sehingga tercapai kepuasan pelanggan.</li>\r\n<li>Meningkatkan motivasi dan semangat kerja karyawan secara optimal melalui peningkatan dedikasi, disiplin, dan kemampuan kerja serta penghargaan yang memadai sesuai dengan kinerjanya.</li>\r\n</ul></li>');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan_sistem`
--

CREATE TABLE IF NOT EXISTS `pengaturan_sistem` (
  `id_pengaturan` varchar(255) NOT NULL,
  `isi_pengaturan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan_sistem`
--

INSERT INTO `pengaturan_sistem` (`id_pengaturan`, `isi_pengaturan`) VALUES
('versi_aplikasi', 'Ahwaya RJ3'),
('tentang_aplikasi', 'Tentang Aplikasi||<b><i>SiMaBeS (Sistem Informasi Manajemen Bengkel Sederhana)</i></b> adalah perangkat lunak sederhana yang berguna untuk mengelola data pada bengkel. SiMaBeS merupakan aplikasi berbasis web yang dibuat dengan bahasa PHP dan MYSQL, adapun fitur yang ada di program ini adalah : Mengolah data (pelanggan, barang, pegawai,transaksi pelayanan, transaksi penjualan langsung), Pembuatan (Kartu pelanggan/pegawai, faktur pemesanan barang, laporan), multiuser, dan lain-lain. SiMaBeS dirilis dengan lisensi GPL. Mohon Perhatian Sebelum mencapai rilis stabil, instalasi versi baru sebaiknya dilakukan secara lengkap. Tidak tersedia proses untuk upgrade karena dalam fase ini masih banyak terjadi perubahan. Versi lama dapat dihapus jika tidak diperlukan, atau instalasi berdampingan pada direktori dan database yang terpisah.');

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
('ST/TR/141107/0001', 'WO/141107/001', '2014-11-07', 400000, 365000, '1', '2014-11-07 18:27:56'),
('ST/TR/141107/0002', 'WO/141107/002', '2014-11-07', 270000, 260000, '1', '2014-11-07 18:31:22'),
('ST/TR/141108/0001', 'WO/141108/001', '2014-11-08', 50000, 35000, '8', '2014-11-08 07:24:05');

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
('ST/TR/141107/0001', 100, '2014-11-07 18:26:56'),
('ST/TR/141107/0001', 101, '2014-11-07 18:27:00'),
('ST/TR/141107/0001', 103, '2014-11-07 18:27:04'),
('ST/TR/141107/0002', 100, '2014-11-07 18:30:46'),
('ST/TR/141108/0001', 100, '2014-11-08 07:23:20');

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
(100, 'Kelistrikan', 10000, '2014-06-20 19:51:55'),
(101, 'Pemasangan', 5000, '2014-05-28 08:23:09'),
(102, 'Service', 30000, '2014-05-28 08:23:20'),
(103, 'Overhoul', 50000, '2014-05-29 06:53:33'),
(104, 'Pencucian Motor', 7000, '2014-06-10 21:56:36');

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
('ST/PL/141107/0001', '2014-11-07', '-', 130000, 150000, '1', '2014-11-07 18:29:54'),
('ST/PL/141108/0001', '2014-11-08', 'aceng', 35000, 50000, '8', '2014-11-08 07:21:54');

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
('ST/TR/141107/0001', 'SU00001', 1, 250000, '2014-11-07 18:27:13'),
('ST/TR/141107/0001', 'EL00001', 2, 50000, '2014-11-07 18:27:23'),
('ST/PL/141107/0001', 'BD00006', 3, 105000, '2014-11-07 18:29:27'),
('ST/PL/141107/0001', 'BD00008', 1, 25000, '2014-11-07 18:29:46'),
('ST/TR/141107/0002', 'SU00001', 1, 250000, '2014-11-07 18:30:51'),
('ST/PL/141108/0001', 'BD00006', 1, 35000, '2014-11-08 07:17:39'),
('ST/TR/141108/0001', 'EL00002', 1, 25000, '2014-11-08 07:23:29');

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
('WO/141107/001', 14050001, '2014-11-07', 'B0012ASD', '', 'Honda Grand', '', '', '-\r\n', 'PG-1409-001', '3', '2014-11-07 18:27:49'),
('WO/141107/002', 14050002, '2014-11-07', 'B0012ASD', '', 'Honda Beat', '', '', '-\r\n', 'PG-1410-002', '3', '2014-11-07 18:31:10'),
('WO/141108/001', 14110001, '2014-11-08', 'B0012ASD', '', 'Honda Grand', '', '', '-', 'PG-1409-001', '3', '2014-11-08 07:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `sementara`
--

CREATE TABLE IF NOT EXISTS `sementara` (
  `id_sementara` varchar(30) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sementara`
--

INSERT INTO `sementara` (`id_sementara`, `value`) VALUES
('pesan_barang', 'SU00001');

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
(1, 'PT. Sinar Galih', 'Jl. Perintis Kemerdekaan 2', '09899', '2014-07-19 20:03:05'),
(2, 'PT. Gunung Agung', 'Jl. Gunung Agung', '099222', '2014-07-08 18:43:12'),
(3, 'Toko Spare Part Merdeka', 'Jl. Merdeka', '098222', '2014-07-08 18:43:12'),
(4, 'PT. Gajah Mungkur', 'Jl. gajah mungkur', '09877773', '2014-10-26 10:40:33');

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
MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=141;
--
-- AUTO_INCREMENT for table `br_pembelian_detail`
--
ALTER TABLE `br_pembelian_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `br_rak`
--
ALTER TABLE `br_rak`
MODIFY `id_rak` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `dt_pengguna`
--
ALTER TABLE `dt_pengguna`
MODIFY `id_pengguna` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=171;
--
-- AUTO_INCREMENT for table `kel_pengguna`
--
ALTER TABLE `kel_pengguna`
MODIFY `kel_id` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `log_sistem`
--
ALTER TABLE `log_sistem`
MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=194;
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
