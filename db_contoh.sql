-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 26 Agu 2014 pada 08.00
-- Versi Server: 5.6.12
-- Versi PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `simabes`
--
CREATE DATABASE IF NOT EXISTS `simabes` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `simabes`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses_pengguna`
--

CREATE TABLE IF NOT EXISTS `akses_pengguna` (
  `kel_id` int(2) NOT NULL,
  `id_menu` int(2) NOT NULL,
  `r` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akses_pengguna`
--

INSERT INTO `akses_pengguna` (`kel_id`, `id_menu`, `r`) VALUES
(2, 1, '1'),
(2, 2, '1'),
(2, 3, '1'),
(2, 8, '1'),
(1, 1, '1'),
(1, 2, '1'),
(1, 3, '1'),
(1, 4, '1'),
(1, 5, '1'),
(1, 6, '1'),
(1, 7, '1'),
(1, 8, '1'),
(4, 1, '1'),
(4, 4, '1'),
(4, 5, '1'),
(4, 8, '1'),
(3, 1, '1'),
(3, 8, '1'),
(6, 1, '1'),
(6, 6, '1'),
(6, 7, '1'),
(6, 8, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `br_data`
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
  `stok` int(3) NOT NULL,
  `stok_min` int(3) NOT NULL,
  `id_rak` int(2) NOT NULL,
  `id_sup` varchar(5) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `ket_brg` text NOT NULL,
  `photo_brg` text NOT NULL,
  `terjual` int(3) NOT NULL COMMENT 'jumlah yang telah terjual (pelayanan/penjualan)',
  `dipesan` enum('0','1','2') NOT NULL COMMENT '0: belum, 1 : sudah dimasukan dalam pesanan 2: pesanan sudah ditindak lanjuti',
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id_brg`),
  KEY `id_sup` (`id_sup`),
  KEY `kategori` (`id_kt_brg`,`id_satuan`,`id_rak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `br_data`
--

INSERT INTO `br_data` (`id_brg`, `kode_brg`, `nm_brg`, `id_kt_brg`, `id_kualitas`, `hrg_beli`, `hrg_jual`, `id_satuan`, `stok`, `stok_min`, `id_rak`, `id_sup`, `tgl_masuk`, `ket_brg`, `photo_brg`, `terjual`, `dipesan`, `wkt_ubah`) VALUES
('BD00006', '', 'Sayap Honda Grand', 'BD', 'A', 30000, 35000, 'S', 2, 1, 1, '0001', '2014-06-21', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 4, '0', '2014-08-15 11:24:31'),
('BD00007', 'asd', 'asd', 'BD', 'A', 12000, 15000, 'B', 21, 2, 1, '0001', '2014-06-23', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/Army.png', 0, '0', '2014-08-15 11:17:28'),
('BD00008', '45106-KG2-AS', 'DISC PAD a', 'BP', 'A', 20000, 25000, 'B', 20, 1, 1, '0001', '2014-07-08', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 0, '0', '2014-07-17 23:48:04'),
('BD00009', '53205-GN5-830FB', 'Cover Handle Front', 'BD', 'A', 20000, 26000, 'S', 6, 1, 1, '0002', '2014-08-13', 'Astrea Grand, Legenda', '../photo/suku_cadang/default.png', 0, '0', '2014-08-20 19:29:59'),
('BD00010', '53205-KEV-830FB', 'Cover Handle Front', 'BD', 'A', 25000, 31000, 'B', 6, 1, 1, '0002', '2014-08-13', 'SupraX', '../photo/suku_cadang/default.png', 1, '0', '2014-08-20 19:30:08'),
('BD00011', 'aa', 'saa', 'BD', 'A', 1000, 1200, 'B', 101, 1, 1, '0001', '2014-08-13', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 0, '0', '2014-08-13 20:50:40'),
('BD00012', 'qq', 'qq', 'BD', 'A', 1000, 1500, 'B', 10, 1, 1, '0001', '2014-08-15', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 0, '0', '2014-08-20 14:44:53'),
('BP00001', '45106-KG2-NA', 'DISC PAD', 'BP', 'A', 25000, 30000, 'S', 1, 1, 1, '0001', '2014-06-21', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 2, '0', '2014-08-24 20:28:09'),
('BP00002', 'kode barang', 'asala aja', 'BP', 'A', 2000, 3000, 'K', 102, 1, 1, '0001', '2014-06-24', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 0, '0', '2014-07-17 23:34:04'),
('BT00001', '12N5-3B KIT', 'BATTERY', 'BT', 'A', 88000, 100000, 'S', 11, 1, 1, '0001', '2014-06-14', 'HND : Astrea Prima/Grand, Impressa, Supra\r\nYMH : Alfa, Force-1, Crypton, Vega, Sigma\r\nSZK : RC80, RC100, RC110, Tornado, Shogun\r\nKWK , Kaze, VSP, Corsa, STR, AR-125,', '../photo/suku_cadang/default.png', 29, '0', '2014-08-15 09:42:34'),
('BT00002', 'GM2-5A-3C-2', 'BATTERY', 'BT', 'A', 68000, 73000, 'S', 18, 1, 1, '0001', '2014-06-14', 'HND : GL PRO, GL Max, GL 100(CDI), MegaPro,', '../photo/suku_cadang/default.png', 2, '0', '2014-07-08 18:43:12'),
('BT00003', 'GM2-3B KIT', 'BATTERY', 'BT', 'A', 86000, 91000, 'S', 12, 1, 1, '0001', '2014-06-14', 'YMM : RXK-New, TZM;\r\nSZK : Satria(kick)', '../photo/suku_cadang/default.png', 1, '0', '2014-07-08 18:43:12'),
('CL00001', 'test', 'test', 'CL', 'A', 200000, 250000, 'B', 11, 1, 1, '0001', '2014-06-24', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 0, '0', '2014-07-24 13:57:49'),
('EL00001', 'asd12e', 'Lampu LED Variasi', 'EL', 'A', 20000, 25000, 'S', 77, 1, 1, '0003', '2014-06-16', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 55, '0', '2014-07-08 18:43:12'),
('EL00002', 'asd12e', 'Lampu LED Variasi', 'EL', 'A', 20000, 25000, 'S', 25, 1, 1, '0003', '2014-06-16', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 5, '0', '2014-07-08 18:43:12'),
('EL00003', '', 'Lampu Hazard', 'EL', 'B', 25000, 30000, 'S', 101, 1, 3, '0004', '2014-06-19', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 4, '0', '2014-07-24 12:55:31'),
('EP00001', 'ASDAS', 'ASAL AJA', 'EP', 'A', 12000, 15000, 'P', 12, 1, 1, '0004', '2014-06-19', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 0, '0', '2014-07-24 13:24:24'),
('OL00001', 'zz', 'zz', 'OL', 'A', 20000, 25000, 'B', 10, 2, 1, '0001', '2014-08-15', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 0, '0', '2014-08-15 11:39:19'),
('OT00001', 'asdasdqwsadaasd', 'asdak sdkas ndnsj fsdx cv', 'OT', 'A', 2000000, 2500000, 'S', 10, 1, 5, '0004', '2014-06-22', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/IMG_1206.jpg', 4, '0', '2014-07-24 13:03:54'),
('OT00002', 'test1', 'test1', 'OT', 'A', 500, 1000, 'S', 21, 1, 4, '0002', '2014-06-22', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 1, '0', '2014-08-20 20:17:46'),
('SU00001', 'asdasd', 'Shock Breaker Variasi', 'SU', 'A', 200000, 250000, 'P', 17, 1, 1, '0001', '2014-06-16', 'Tidak ada keterangan untuk barang ini', '../photo/suku_cadang/default.png', 8, '0', '2014-07-08 18:43:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `br_data_perkendaraan`
--

CREATE TABLE IF NOT EXISTS `br_data_perkendaraan` (
  `id_data` int(11) NOT NULL AUTO_INCREMENT,
  `id_brg` varchar(9) NOT NULL,
  `id_kendaraan` varchar(2) NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id_data`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data untuk tabel `br_data_perkendaraan`
--

INSERT INTO `br_data_perkendaraan` (`id_data`, `id_brg`, `id_kendaraan`, `wkt_ubah`) VALUES
(5, 'BT00002', 'A', '2014-07-08 18:43:12'),
(11, 'EL00001', 'A', '2014-07-08 18:43:12'),
(12, 'EL00002', 'A', '2014-07-08 18:43:12'),
(14, 'SU00001', 'H', '2014-07-08 18:43:12'),
(15, 'SU00001', 'Y', '2014-07-08 18:43:12'),
(38, 'BT00003', 'A', '2014-07-08 18:43:12'),
(73, 'BP00002', 'A', '2014-07-17 23:34:04'),
(74, 'BD00008', 'A', '2014-07-17 23:48:04'),
(77, 'EL00003', 'A', '2014-07-24 12:55:31'),
(79, 'OT00001', 'A', '2014-07-24 13:03:54'),
(80, 'EP00001', 'A', '2014-07-24 13:24:24'),
(84, 'CL00001', 'H', '2014-07-24 13:57:49'),
(89, 'BD00011', 'A', '2014-08-13 20:50:40'),
(90, 'BT00001', 'A', '2014-08-15 09:42:34'),
(92, 'BD00007', 'H', '2014-08-15 11:17:28'),
(94, 'BD00006', 'H', '2014-08-15 11:24:31'),
(96, 'OL00001', 'A', '2014-08-15 11:39:19'),
(97, 'BD00012', 'A', '2014-08-20 14:44:53'),
(98, 'BD00009', 'H', '2014-08-20 19:29:59'),
(99, 'BD00010', 'H', '2014-08-20 19:30:08'),
(100, 'OT00002', 'A', '2014-08-20 20:17:46'),
(101, 'BP00001', 'A', '2014-08-24 20:28:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `br_kategori`
--

CREATE TABLE IF NOT EXISTS `br_kategori` (
  `id_kt_brg` varchar(2) NOT NULL,
  `nm_kt_brg` varchar(25) NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id_kt_brg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `br_kategori`
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
-- Struktur dari tabel `br_kendaraan`
--

CREATE TABLE IF NOT EXISTS `br_kendaraan` (
  `id_kendaraan` varchar(3) NOT NULL,
  `kendaraan` varchar(25) NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id_kendaraan`),
  KEY `id` (`id_kendaraan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `br_kendaraan`
--

INSERT INTO `br_kendaraan` (`id_kendaraan`, `kendaraan`, `wkt_ubah`) VALUES
('A', 'Semua', '2014-07-08 18:43:12'),
('H', 'Honda', '2014-07-08 18:43:12'),
('K', 'Kawasaki', '2014-07-08 18:43:12'),
('S', 'Suzuki', '2014-07-08 18:43:12'),
('Y', 'Yamaha', '2014-07-08 18:43:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `br_kualitas`
--

CREATE TABLE IF NOT EXISTS `br_kualitas` (
  `id_kualitas` varchar(2) NOT NULL,
  `kualitas` varchar(25) NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id_kualitas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `br_kualitas`
--

INSERT INTO `br_kualitas` (`id_kualitas`, `kualitas`, `wkt_ubah`) VALUES
('A', 'Kualitas 1', '2014-07-19 19:18:15'),
('B', 'Kualitas 2', '2014-07-08 18:43:12'),
('L', 'Lokal', '2014-07-08 18:43:12'),
('L2', 'Lokal2', '2014-07-08 18:43:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `br_pembelian`
--

CREATE TABLE IF NOT EXISTS `br_pembelian` (
  `no_pes` varchar(25) NOT NULL,
  `tgl_pes` date NOT NULL,
  `id_sup` varchar(25) NOT NULL,
  `total_pembayaran` double NOT NULL,
  `diterima` enum('0','1') NOT NULL,
  `id_pengguna` text NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`no_pes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `br_pembelian`
--

INSERT INTO `br_pembelian` (`no_pes`, `tgl_pes`, `id_sup`, `total_pembayaran`, `diterima`, `id_pengguna`, `wkt_ubah`) VALUES
('PS/140625/0001', '2014-06-25', '0003', 2000000, '1', '1', '2014-06-25 08:52:20'),
('PS/140625/0002', '2014-06-25', '0001', 200000, '1', '1', '2014-06-25 08:54:15'),
('PS/140629/0001', '2014-06-29', '0001', 860000, '1', '1', '2014-06-29 16:19:28'),
('PS/140630/0001', '2014-06-30', '0001', 120000, '1', '1', '2014-06-30 12:25:34'),
('PS/140630/0002', '2014-06-30', '0001', 120000, '1', '1', '2014-06-30 12:28:33'),
('PS/140703/0001', '2014-07-03', '0001', 424620, '1', '1', '2014-07-03 12:04:57'),
('PS/140717/0001', '2014-07-17', '0001', 880000, '1', '1', '2014-07-17 23:49:44'),
('PS/140723/0001', '2014-07-23', '0001', 12000, '1', '1', '2014-07-23 20:07:35'),
('PS/140724/0001', '2014-07-24', '0004', 2500000, '1', '1', '2014-07-24 12:56:22'),
('PS/140724/0002', '2014-07-24', '0001', 1200000, '1', '1', '2014-07-24 12:56:57'),
('PS/140724/0003', '2014-07-24', '0002', 10000, '1', '1', '2014-07-24 13:13:03'),
('PS/140724/0004', '2014-07-24', '0004', 20120000, '1', '1', '2014-07-24 13:40:44'),
('PS/140724/0005', '2014-07-24', '0001', 0, '1', '1', '2014-07-24 13:55:25'),
('PS/140724/0006', '2014-07-24', '0001', 0, '1', '1', '2014-07-24 13:57:01'),
('PS/140724/0007', '2014-07-24', '0001', 2000000, '1', '1', '2014-07-24 14:04:16'),
('PS/140815/0001', '2014-08-15', '0001', 100000, '1', '1', '2014-08-15 09:38:13'),
('PS/140815/0002', '2014-08-15', '0001', 880000, '1', '1', '2014-08-15 09:43:30'),
('PS/140820/0001', '2014-08-20', '0002', 225000, '1', '1', '2014-08-20 19:30:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `br_pembelian_detail`
--

CREATE TABLE IF NOT EXISTS `br_pembelian_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_pes` varchar(25) NOT NULL,
  `tgl_pes` date NOT NULL,
  `id_sup` varchar(8) NOT NULL,
  `id_brg` varchar(25) NOT NULL,
  `hrg_brg` double NOT NULL,
  `jml_brg` int(11) NOT NULL,
  `total` double NOT NULL,
  `diterima` enum('0','1') NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data untuk tabel `br_pembelian_detail`
--

INSERT INTO `br_pembelian_detail` (`id`, `no_pes`, `tgl_pes`, `id_sup`, `id_brg`, `hrg_brg`, `jml_brg`, `total`, `diterima`, `wkt_ubah`) VALUES
(1, 'PS/140625/0001', '2014-06-25', '0003', 'EL00001', 20000, 100, 2000000, '1', '2014-06-25 08:52:15'),
(2, 'PS/140625/0002', '2014-06-25', '0001', 'BP00002', 2000, 100, 200000, '1', '2014-06-25 08:54:08'),
(3, 'PS/140629/0001', '2014-06-29', '0001', 'BT00003', 86000, 10, 860000, '1', '2014-06-29 16:19:21'),
(4, 'PS/140630/0001', '2014-06-30', '0001', 'EP00001', 12000, 10, 120000, '1', '2014-06-30 12:25:28'),
(5, 'PS/140630/0002', '2014-06-30', '0001', 'EP00001', 12000, 10, 120000, '1', '2014-06-30 12:28:28'),
(6, 'PS/140703/0001', '2014-07-03', '0001', 'BD00006', 20000, 20, 400000, '1', '2014-07-03 12:04:53'),
(7, 'PS/140703/0001', '2014-07-03', '0001', 'BD00007', 1231, 20, 24620, '1', '2014-07-03 12:04:53'),
(8, 'PS/140717/0001', '2014-07-17', '0001', 'BT00001', 88000, 10, 880000, '1', '2014-07-17 23:49:41'),
(9, 'PS/140723/0001', '2014-07-23', '0001', 'EP00001', 12000, 1, 12000, '1', '2014-07-23 20:07:30'),
(10, 'PS/140724/0001', '2014-07-24', '0004', 'EL00003', 25000, 100, 2500000, '1', '2014-07-24 12:56:15'),
(11, 'PS/140724/0002', '2014-07-24', '0001', 'EP00001', 12000, 100, 1200000, '1', '2014-07-24 12:56:54'),
(12, 'PS/140724/0003', '2014-07-24', '0002', 'OT00002', 500, 20, 10000, '1', '2014-07-24 13:09:55'),
(13, 'PS/140724/0004', '2014-07-24', '0004', 'OT00001', 2000000, 10, 20000000, '1', '2014-07-24 13:40:27'),
(14, 'PS/140724/0004', '2014-07-24', '0004', 'EP00001', 12000, 10, 120000, '1', '2014-07-24 13:40:27'),
(15, 'PS/140724/0005', '2014-07-24', '0001', 'CL00001', 200000, 10, 2000000, '0', '2014-07-24 13:55:12'),
(16, 'PS/140724/0006', '2014-07-24', '0001', 'CL00001', 200000, 0, 0, '1', '2014-07-24 13:56:57'),
(17, 'PS/140724/0007', '2014-07-24', '0001', 'CL00001', 200000, 10, 2000000, '1', '2014-07-24 14:03:53'),
(18, 'PS/140815/0001', '2014-08-15', '0001', 'BD00011', 1000, 100, 100000, '1', '2014-08-15 09:38:10'),
(19, 'PS/140815/0002', '2014-08-15', '0001', 'BT00001', 88000, 10, 880000, '1', '2014-08-15 09:43:27'),
(20, 'PS/140820/0001', '2014-08-20', '0002', 'BD00009', 20000, 5, 100000, '1', '2014-08-20 19:30:34'),
(21, 'PS/140820/0001', '2014-08-20', '0002', 'BD00010', 25000, 5, 125000, '1', '2014-08-20 19:30:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `br_rak`
--

CREATE TABLE IF NOT EXISTS `br_rak` (
  `id_rak` int(2) NOT NULL AUTO_INCREMENT,
  `nm_rak` varchar(25) NOT NULL,
  `ket` text NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id_rak`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `br_rak`
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
-- Struktur dari tabel `br_satuan`
--

CREATE TABLE IF NOT EXISTS `br_satuan` (
  `id_satuan` varchar(2) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `br_satuan`
--

INSERT INTO `br_satuan` (`id_satuan`, `satuan`, `wkt_ubah`) VALUES
('B', 'Botol', '2014-07-19 19:27:24'),
('K', 'Kardus', '2014-07-08 18:43:12'),
('P', 'Pasang', '2014-07-08 18:43:12'),
('PC', 'Pack', '2014-07-08 18:43:12'),
('S', 'Satuan', '2014-07-08 18:43:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_pegawai`
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
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id_peg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dt_pegawai`
--

INSERT INTO `dt_pegawai` (`id_peg`, `nm_peg`, `jns_kelamin`, `tmpt_lahir`, `tgl_lahir`, `almt_peg`, `telp_peg`, `pend_peg`, `tgl_bergabung`, `photo_peg`, `pengalaman_peg`, `kel_id`, `wkt_ubah`) VALUES
('PG-1405-001', 'Ahmad Kosasiha', 'L', 'Bogor', '1982-05-06', 'Jl.aaaa', '098777', 'STM : Permesinan', '2014-05-27', '../photo/pegawai/default.png', '2 tahun Astra ', 5, '2014-06-14 00:53:28'),
('PG-1405-002', 'dadang sutisna', 'L', 'garut', '1982-05-08', 'Jl. perintis kemerdekaan', '0879999', 'S1 : Teknik Kendaraan rin', '2014-05-29', '../photo/pegawai/default.png', '2 thn astra internasional', 5, '2014-06-25 09:02:06'),
('PG-1406-003', 'Muhammad Arifin', 'L', 'Bogor', '1991-06-12', 'Jl. jalan', '08777', 'D3 - BSI Bogor', '2014-06-14', '../photo/pegawai/default.png', 'belom ada', 5, '2014-07-08 18:54:38'),
('PG-1406-004', 'Susilawati', 'P', 'Bogor', '1992-04-02', 'jl.', '09881', 'D3 - BSI Bogor', '2014-06-15', '../photo/pegawai/default.png', '2thn', 2, '2014-06-24 22:28:56'),
('PG-1406-005', 'Jejen', 'L', 'garut', '1993-10-02', 'j;.', '098877', '', '2014-06-25', '../photo/pegawai/default.png', '', 5, '2014-08-24 12:49:53'),
('PG-1406-006', 'arisaaa', 'L', 'garut', '2014-06-25', 'asd\r\n', '978', '', '2014-06-25', '../photo/pegawai/default.png', '', 2, '2014-06-25 11:27:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_pelanggan`
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
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id_plg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dt_pelanggan`
--

INSERT INTO `dt_pelanggan` (`id_plg`, `nm_plg`, `tgl_registrasi`, `masa_berlaku`, `almt_plg`, `telp_plg`, `jns_kelamin`, `photo_plg`, `transaksi`, `wkt_ubah`) VALUES
('14050001', 'Aris Winardi', '2014-05-08', '2015-05-08', 'Perumahan Taman Griya Kencana Blok A9/16 RT 003/08 Kel.Kencana, Kec.Tanah Sareal Kota Bogor.', '087870870412', 'L', '../photo/pelanggan/2x3.jpg', 10, '2014-07-08 07:27:56'),
('14050002', 'Ida Farida', '2014-05-08', '2015-05-08', 'Kp.Babakan Leuwiliang Kel.Leuiwiliang Kec.Leuwiliang RT.03-006 Bogor 16640', '085716756295', 'P', '../photo/pelanggan/ida farida.jpg', 4, '2014-07-08 07:44:15'),
('14060006', 'Pipit damayanti', '2014-06-09', '2015-06-09', 'Citereup', '0857111', 'P', '../photo/pelanggan/default.png', 1, '2014-06-09 08:35:29'),
('14060007', 'Yogi Indra', '2014-06-11', '2014-06-11', 'Jl.aasda', '098908', 'L', '../photo/pelanggan/d2.png', 1, '2014-06-11 00:31:42'),
('14060008', 'Kaskul Ganjar Ahmada', '2014-06-12', '2014-06-12', 'Cipanas dalam', '098788', 'L', '../photo/pelanggan/default.png', 1, '2014-06-14 12:04:01'),
('14080001', 'Wahid Joko Winarno', '2014-08-24', '2015-08-24', 'Cliuar', '0896000002', 'L', '../photo/pelanggan/DSCN3338.JPG', 0, '2014-08-24 12:55:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_pengguna`
--

CREATE TABLE IF NOT EXISTS `dt_pengguna` (
  `id_pengguna` int(3) NOT NULL AUTO_INCREMENT,
  `nm_pengguna` text NOT NULL,
  `nm_asli` varchar(30) NOT NULL,
  `kel_id` int(2) NOT NULL,
  `photo_pengguna` text NOT NULL,
  `kt_sandi` text NOT NULL,
  `terakhir_masuk` text NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id_pengguna`),
  KEY `kel_id` (`kel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=148 ;

--
-- Dumping data untuk tabel `dt_pengguna`
--

INSERT INTO `dt_pengguna` (`id_pengguna`, `nm_pengguna`, `nm_asli`, `kel_id`, `photo_pengguna`, `kt_sandi`, `terakhir_masuk`, `wkt_ubah`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'Adminisitrator', 1, '../photo/kotuxkuning.jpg', '21232f297a57a5a743894a0e4a801fc3', '2014-08-26 12:59:31', '2014-07-08 19:37:27'),
(8, '1a0f8e986f500286f4b7cca329ca58e4', 'simabes', 1, '../photo/g4475.png', '1a0f8e986f500286f4b7cca329ca58e4', '2014-08-17 11:05:45', '2014-07-08 18:43:12'),
(64, '3c7854def220f0443c957ada0fe88ba9', 'Aris Winardi', 3, '../photo/pelanggan/aris.png', '1a0f8e986f500286f4b7cca329ca58e4', '2014-08-24 13:38:05', '2014-07-08 18:43:12'),
(65, '18a6afcbe0f9fccde7693f8d95b2ce71', 'Ida Farida', 3, '../photo/pelanggan/ida farida.jpg', '1a0f8e986f500286f4b7cca329ca58e4', '2014-06-21 10:56:13', '2014-07-08 18:43:12'),
(103, '580c23b93ae153cf8530a01d441e1b55', 'Muhammad Arifin', 5, '../photo/pegawai/206502777_d23e8a49cb.jpg', '1a0f8e986f500286f4b7cca329ca58e4', '2014-06-15 09:26:23', '2014-07-08 18:54:38'),
(109, '6e74742e0bdd5cb10a76a905ce8e4fc7', 'Pipit damayanti', 3, '../photo/pelanggan/default.png', '1a0f8e986f500286f4b7cca329ca58e4', '2014-06-09 11:37:00', '2014-07-08 18:43:12'),
(110, '0ad6824c8cf0612e0e758adf8e5b96d0', 'Susilawati', 2, '../photo/pegawai/default.png', 'c1b01c85f96519afb28e43dab8827e18', '2014-06-24 22:29:03', '2014-07-08 18:43:12'),
(111, '998da901fa8c9855054e6c846d85c518', 'Yogi Indra', 3, '../photo/pelanggan/1.png', '1a0f8e986f500286f4b7cca329ca58e4', '', '2014-07-08 18:43:12'),
(112, '05a959de132192a6515b4a78b5dc12de', 'Kaskul Ganjar Ahmada', 3, '../photo/pelanggan/default.png', '1a0f8e986f500286f4b7cca329ca58e4', '', '2014-07-08 18:43:12'),
(117, '0ad6824c8cf0612e0e758adf8e5b96d0', 'Susilawati', 2, '../photo/pegawai/default.png', 'c1b01c85f96519afb28e43dab8827e18', '2014-06-24 22:29:03', '2014-07-08 18:43:12'),
(118, 'c1b01c85f96519afb28e43dab8827e18', 'pelayanan', 2, '../photo/default.png', 'c1b01c85f96519afb28e43dab8827e18', '2014-08-16 14:10:57', '2014-07-08 18:43:12'),
(130, 'b4f98f2994dc09ff73d7d15cbe771da3', 'Jejen', 5, '../photo/pegawai/default.png', 'd41d8cd98f00b204e9800998ecf8427e', '', '2014-08-24 12:49:53'),
(131, '8d445ee9dca0c74c45c2753b6d2392b5', 'arisaaa', 2, '../photo/pegawai/default.png', '7815696ecbf1c96e6894b779456d330e', '2014-06-25 11:27:56', '2014-07-08 18:43:12'),
(141, 'c84258e9c39059a89ab77d846ddab909', 'admin2', 1, '../photo/default.png', '21232f297a57a5a743894a0e4a801fc3', '', '2014-07-08 18:43:12'),
(147, '6100e244b3702e7e8b27c343ace37e66', 'Wahid Joko Winarno', 3, '../photo/pelanggan/default.png', '1a0f8e986f500286f4b7cca329ca58e4', '', '2014-08-24 12:55:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kel_pengguna`
--

CREATE TABLE IF NOT EXISTS `kel_pengguna` (
  `kel_id` int(2) NOT NULL AUTO_INCREMENT,
  `nm_kel` varchar(30) NOT NULL,
  PRIMARY KEY (`kel_id`),
  KEY `kel_id` (`kel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `kel_pengguna`
--

INSERT INTO `kel_pengguna` (`kel_id`, `nm_kel`) VALUES
(1, 'Administrator'),
(2, 'Pelayanan'),
(3, 'Pelanggan'),
(4, 'Gudang'),
(5, 'Mekanik'),
(6, 'Pemilik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuangan`
--

CREATE TABLE IF NOT EXISTS `keuangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `ket` text NOT NULL,
  `masuk` double NOT NULL,
  `keluar` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data untuk tabel `keuangan`
--

INSERT INTO `keuangan` (`id`, `tgl`, `ket`, `masuk`, `keluar`) VALUES
(1, '2014-06-25', 'Pemasukan dari transaksi pelayanan (ST/TR/140625/0001)', 60000, 0),
(2, '2014-06-25', 'Pemasukan dari transaksi penjualan (ST/PL/140625/0001)', 310000, 0),
(3, '2014-06-25', 'Pembayaran pemesanan barang (PS/140625/0001)', 0, 2000000),
(4, '2014-06-25', 'Pembayaran pemesanan barang (PS/140625/0002)', 0, 200000),
(5, '2014-06-25', 'Penjualan Barang Bekas', 500000, 0),
(6, '2014-06-25', 'Pemasukan dari transaksi pelayanan (ST/TR/140625/0002)', 130000, 0),
(7, '2014-06-28', 'Pemasukan dari transaksi penjualan (ST/PL/140628/0001)', 364000, 0),
(8, '2014-06-30', 'Pembayaran pemesanan barang (PS/140629/0001)', 0, 860000),
(9, '2014-06-30', 'Pembayaran pemesanan barang (PS/140630/0001)', 0, 120000),
(10, '2014-06-30', 'Pembayaran pemesanan barang (PS/140630/0002)', 0, 120000),
(11, '2014-06-30', 'Pemasukan dari transaksi penjualan (ST/PL/140630/0001)', 5000000, 0),
(12, '2014-07-03', 'Pembayaran pemesanan barang (PS/140703/0001)', 0, 424620),
(13, '2014-07-05', 'Pemasukan dari transaksi pelayanan (ST/TR/140705/0001)', 170000, 0),
(14, '2014-07-08', 'Pemasukan dari transaksi penjualan (ST/PL/140708/0001)', 725000, 0),
(15, '2014-07-08', 'Pemasukan dari transaksi penjualan (ST/PL/140708/0002)', 291000, 0),
(16, '2014-07-08', 'Pemasukan dari transaksi pelayanan (ST/TR/140708/0001)', 110000, 0),
(17, '2014-07-08', 'Pemasukan dari transaksi pelayanan (ST/TR/140708/0002)', 85000, 0),
(18, '2014-07-08', 'Pemasukan dari transaksi pelayanan (ST/TR/140708/0003)', 105000, 0),
(19, '2014-07-16', 'Pemasukan dari transaksi pelayanan (ST/TR/140716/0001)', 2715000, 0),
(20, '2014-07-16', 'Pemasukan dari transaksi penjualan (ST/PL/140716/0001)', 200000, 0),
(21, '2014-07-16', 'Pemasukan dari transaksi penjualan (ST/PL/140716/0002)', 300000, 0),
(22, '2014-07-17', 'Pembayaran pemesanan barang (PS/140717/0001)', 0, 880000),
(23, '2014-07-23', 'Pembayaran pemesanan barang (PS/140723/0001)', 0, 12000),
(24, '2014-07-24', 'Pembayaran pemesanan barang (PS/140724/0001)', 0, 2500000),
(25, '2014-07-24', 'Pembayaran pemesanan barang (PS/140724/0002)', 0, 1200000),
(26, '2014-07-24', 'Pembayaran pemesanan barang (PS/140724/0003)', 0, 10000),
(27, '2014-07-24', 'Pembayaran pemesanan barang (PS/140724/0004)', 0, 20120000),
(28, '2014-07-24', 'Pembayaran pemesanan barang (PS/140724/0005)', 0, 0),
(29, '2014-07-24', 'Pembayaran pemesanan barang (PS/140724/0006)', 0, 0),
(30, '2014-08-04', 'Pembayaran pemesanan barang (PS/140724/0007)', 0, 2000000),
(31, '2014-08-07', 'Pemasukan dari transaksi penjualan (ST/PL/140807/0001)', 55000, 0),
(32, '2014-08-11', 'Pemasukan dari transaksi penjualan (ST/PL/140811/0001)', 2501000, 0),
(33, '2014-08-13', 'Pemasukan dari transaksi pelayanan (ST/TR/140813/0001)', 61000, 0),
(34, '2014-08-13', 'Pemasukan dari transaksi penjualan (ST/PL/140813/0001)', 100000, 0),
(35, '2014-08-13', 'Pemasukan dari transaksi penjualan (ST/PL/140813/0002)', 125000, 0),
(36, '2014-08-13', 'Pemasukan dari transaksi penjualan (ST/PL/140813/0003)', 350000, 0),
(37, '2014-08-13', 'Pemasukan dari transaksi penjualan (ST/PL/140813/0004)', 300000, 0),
(38, '2014-08-13', 'Pemasukan dari transaksi penjualan (ST/PL/140813/0005)', 30000, 0),
(39, '2014-08-13', 'Pemasukan dari transaksi pelayanan (ST/TR/140813/0002)', 290000, 0),
(40, '2014-08-13', 'Pemasukan dari transaksi pelayanan (ST/TR/140813/0003)', 35000, 0),
(41, '2014-08-13', 'Pemasukan dari transaksi penjualan (ST/PL/140813/0006)', 500000, 0),
(42, '2014-08-15', 'Pemasukan dari transaksi pelayanan (ST/TR/140815/0001)', 35000, 0),
(43, '2014-08-15', 'Pemasukan dari transaksi pelayanan (ST/TR/140815/0002)', 105000, 0),
(44, '2014-08-15', 'Pembayaran pemesanan barang (PS/140815/0001)', 0, 100000),
(45, '2014-08-15', 'Pembayaran pemesanan barang (PS/140815/0002)', 0, 880000),
(46, '2014-08-20', 'Pemasukan dari transaksi pelayanan (ST/TR/140820/0001)', 40000, 0),
(47, '2014-08-20', 'Pembayaran pemesanan barang (PS/140820/0001)', 0, 225000),
(48, '2014-08-24', 'Pemasukan dari transaksi pelayanan (ST/TR/140824/0001)', 55000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_sistem`
--

CREATE TABLE IF NOT EXISTS `log_sistem` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_tipe` enum('Staff','Pelanggan','Sistem') NOT NULL DEFAULT 'Staff',
  `id` varchar(50) NOT NULL,
  `log_lokasi` varchar(50) NOT NULL,
  `log_pesan` text NOT NULL,
  `log_waktu` datetime NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=295 ;

--
-- Dumping data untuk tabel `log_sistem`
--

INSERT INTO `log_sistem` (`log_id`, `log_tipe`, `id`, `log_lokasi`, `log_pesan`, `log_waktu`) VALUES
(1, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-07-08 07:42:22'),
(2, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-07-08 07:42:43'),
(3, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060006) ', '2014-07-08 07:42:43'),
(4, 'Staff', 'Adminisitrator', 'Data Pelanggan', 'Berhasil menghapus pelanggan  dengan ID Pelanggan (14070003)', '2014-07-08 07:43:25'),
(5, 'Staff', 'Adminisitrator', 'Sunting Data Pelanggan', 'Berhasil memperbaharui pelanggan (Ida Farida) dengan ID Pelanggan (14050002)', '2014-07-08 07:44:15'),
(6, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'Transaksi penjualan langsung dengan No Struk (ST/PL/140708/0001)', '2014-07-08 07:46:42'),
(7, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'Transaksi penjualan langsung dengan No Struk (ST/PL/140708/0002)', '2014-07-08 07:50:39'),
(8, 'Staff', '', 'Transaksi Pelayanan', 'Transaksi Pelayanan dengan No Struk (ST/TR/140708/0001)', '2014-07-08 07:54:33'),
(9, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-08 07:54:38'),
(10, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-07-08 07:56:21'),
(11, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-08 12:01:59'),
(12, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-08 12:41:33'),
(13, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'Transaksi Pelayanan dengan No Struk (ST/TR/140708/0002)', '2014-07-08 12:54:46'),
(14, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-08 18:27:23'),
(15, 'Staff', 'Adminisitrator', 'Sunting Data Pegawai', 'Berhasil memperbaharui pegawai (Muhammad Arifin) dengan ID pegawai (PG-1406-003)', '2014-07-08 18:54:38'),
(16, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'Transaksi Pelayanan dengan No Struk (ST/TR/140708/0003)', '2014-07-08 18:57:12'),
(17, 'Staff', 'Adminisitrator', 'Area Pengguna', 'Berhasil menrubah kata sandi ', '2014-07-08 19:36:53'),
(18, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-07-08 19:36:57'),
(19, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-08 19:37:07'),
(20, 'Staff', 'Adminisitrator', 'Area Pengguna', 'Berhasil menrubah kata sandi ', '2014-07-08 19:37:27'),
(21, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-07-08 19:39:19'),
(22, 'Staff', 'pelayanan', 'Masuk', 'Pengguna (pelayanan) Berhasil masuk', '2014-07-08 19:39:26'),
(23, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-12 16:30:41'),
(24, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-12 16:47:44'),
(25, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-07-12 16:49:28'),
(26, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-07-12 16:49:28'),
(27, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060006) ', '2014-07-12 16:49:29'),
(28, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060007) ', '2014-07-12 16:49:29'),
(29, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060008) ', '2014-07-12 16:49:29'),
(30, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-12 17:06:38'),
(31, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-15 01:42:24'),
(32, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-15 02:06:24'),
(33, 'Staff', 'Adminisitrator', 'Tambah Data Pelanggan', 'Berhasil menambahkan pelanggan (nama) dengan ID Pelanggan (14070003) ', '2014-07-15 02:22:15'),
(34, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-15 19:21:30'),
(35, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-15 20:21:59'),
(36, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-07-15 20:22:19'),
(37, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-07-15 20:22:19'),
(38, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-15 21:03:30'),
(39, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-001) ', '2014-07-15 21:13:33'),
(40, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-002) ', '2014-07-15 21:13:33'),
(41, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-001) ', '2014-07-15 21:14:41'),
(42, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-002) ', '2014-07-15 21:14:41'),
(43, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-16 18:32:50'),
(44, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-16 19:33:03'),
(45, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'Transaksi Pelayanan dengan No Struk (ST/TR/140716/0001)', '2014-07-16 20:12:55'),
(46, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'Transaksi penjualan langsung dengan No Struk (ST/PL/140716/0001)', '2014-07-16 20:21:05'),
(47, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-16 21:05:01'),
(48, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'Transaksi penjualan langsung dengan No Struk (ST/PL/140716/0002)', '2014-07-16 21:59:56'),
(49, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-17 23:04:12'),
(50, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (BT00001) ', '2014-07-17 23:49:24'),
(51, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menyelesaikan pemesanan barang dengan No Pesan (PS/140717/0001) ', '2014-07-17 23:49:44'),
(52, 'Staff', 'Adminisitrator', 'Penerimaan Pemesanan Barang', 'Berhasil menyelesaikan Penerimaan barang dengan No Pesan (PS/140717/0001) ', '2014-07-17 23:49:54'),
(53, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-18 00:20:48'),
(54, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-18 04:49:56'),
(55, 'Staff', 'simabes', 'Masuk', 'Pengguna (simabes) Berhasil masuk', '2014-07-18 05:03:13'),
(56, 'Sistem', 'simabes', 'System', 'Pengguna (simabes) keluar', '2014-07-18 05:08:49'),
(57, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-19 09:16:14'),
(58, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-19 12:17:13'),
(59, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-07-19 12:25:06'),
(60, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-19 19:12:20'),
(61, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-21 21:27:54'),
(62, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-23 20:00:40'),
(63, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (EP00001) ', '2014-07-23 20:02:23'),
(64, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menyelesaikan pemesanan barang dengan No Pesan (PS/140723/0001) ', '2014-07-23 20:07:35'),
(65, 'Staff', 'Adminisitrator', 'Penerimaan Pemesanan Barang', 'Berhasil menyelesaikan Penerimaan barang dengan No Pesan (PS/140723/0001) ', '2014-07-23 20:07:54'),
(66, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-24 12:44:49'),
(67, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (EP00001) ', '2014-07-24 12:45:41'),
(68, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (EL00003) ', '2014-07-24 12:55:39'),
(69, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menyelesaikan pemesanan barang dengan No Pesan (PS/140724/0001) ', '2014-07-24 12:56:22'),
(70, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menyelesaikan pemesanan barang dengan No Pesan (PS/140724/0002) ', '2014-07-24 12:56:57'),
(71, 'Staff', 'Adminisitrator', 'Penerimaan Pemesanan Barang', 'Berhasil menyelesaikan Penerimaan barang dengan No Pesan (PS/140724/0001) ', '2014-07-24 12:57:20'),
(72, 'Staff', 'Adminisitrator', 'Penerimaan Pemesanan Barang', 'Berhasil menyelesaikan Penerimaan barang dengan No Pesan (PS/140724/0002) ', '2014-07-24 12:57:38'),
(73, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (OT00002) ', '2014-07-24 13:00:17'),
(74, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (OT00001) ', '2014-07-24 13:04:08'),
(75, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menyelesaikan pemesanan barang dengan No Pesan (PS/140724/0003) ', '2014-07-24 13:13:03'),
(76, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (EP00001) ', '2014-07-24 13:24:31'),
(77, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menyelesaikan pemesanan barang dengan No Pesan (PS/140724/0004) ', '2014-07-24 13:40:44'),
(78, 'Staff', 'Adminisitrator', 'Penerimaan Pemesanan Barang', 'Berhasil menyelesaikan Penerimaan barang dengan No Pesan (PS/140724/0003) ', '2014-07-24 13:41:07'),
(79, 'Staff', 'Adminisitrator', 'Penerimaan Pemesanan Barang', 'Berhasil menyelesaikan Penerimaan barang dengan No Pesan (PS/140724/0004) ', '2014-07-24 13:41:19'),
(80, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-24 13:47:52'),
(81, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (CL00001) ', '2014-07-24 13:54:54'),
(82, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menyelesaikan pemesanan barang dengan No Pesan (PS/140724/0005) ', '2014-07-24 13:55:25'),
(83, 'Staff', 'Adminisitrator', 'Penerimaan Pemesanan Barang', 'Berhasil menyelesaikan Penerimaan barang dengan No Pesan (PS/140724/0005) ', '2014-07-24 13:55:58'),
(84, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (CL00001) ', '2014-07-24 13:56:38'),
(85, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menyelesaikan pemesanan barang dengan No Pesan (PS/140724/0006) ', '2014-07-24 13:57:01'),
(86, 'Staff', 'Adminisitrator', 'Penerimaan Pemesanan Barang', 'Berhasil menyelesaikan Penerimaan barang dengan No Pesan (PS/140724/0006) ', '2014-07-24 13:57:21'),
(87, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (CL00001) ', '2014-07-24 13:57:53'),
(88, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menyelesaikan pemesanan barang dengan No Pesan (PS/140724/0007) ', '2014-07-24 14:04:16'),
(89, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-25 10:07:02'),
(90, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-07-31 17:04:42'),
(91, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-04 14:40:37'),
(92, 'Staff', 'Adminisitrator', 'Penerimaan Pemesanan Barang', 'Berhasil menyelesaikan Penerimaan barang dengan No Pesan (PS/140724/0007) ', '2014-08-04 14:40:56'),
(93, 'Staff', 'Adminisitrator', 'Data Pelanggan', 'Berhasil menghapus pelanggan  dengan ID Pelanggan (14070003)', '2014-08-04 15:05:19'),
(94, 'Staff', 'Adminisitrator', 'Sunting Data Pelanggan', 'Berhasil memperbaharui pelanggan (dedeng) dengan ID Pelanggan (14070002)', '2014-08-04 15:05:31'),
(95, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-04 15:40:56'),
(96, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-05 11:12:36'),
(97, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-05 11:13:27'),
(98, 'Staff', 'simabes', 'Masuk', 'Pengguna (simabes) Berhasil masuk', '2014-08-05 11:14:04'),
(99, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-05 12:48:13'),
(100, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-05 12:48:44'),
(101, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-06 10:08:19'),
(102, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-06 13:17:28'),
(103, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-06 16:18:21'),
(104, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-06 16:20:28'),
(105, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-06 19:08:34'),
(106, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-06 19:21:35'),
(107, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-06 19:24:52'),
(108, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-06 19:25:22'),
(109, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-06 19:29:11'),
(110, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-06 19:44:18'),
(111, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-07 12:04:58'),
(112, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-07 12:06:10'),
(113, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'Transaksi penjualan langsung dengan No Struk (ST/PL/140807/0001)', '2014-08-07 12:09:29'),
(114, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-07 14:24:59'),
(115, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-07 14:56:12'),
(116, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-08 19:16:16'),
(117, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-09 17:32:01'),
(118, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-11 15:09:55'),
(119, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-11 15:20:55'),
(120, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-11 15:26:14'),
(121, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-11 16:00:58'),
(122, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-11 16:09:02'),
(123, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-11 16:49:21'),
(124, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-11 16:49:28'),
(125, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-11 16:53:38'),
(126, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'Transaksi penjualan langsung dengan No Struk (ST/PL/140811/0001)', '2014-08-11 16:55:17'),
(127, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-11 16:56:42'),
(128, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-11 17:10:30'),
(129, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-11 17:10:30'),
(130, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-11 19:10:04'),
(131, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-13 14:38:57'),
(132, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'Transaksi Pelayanan dengan No Struk (ST/TR/140813/0001)', '2014-08-13 15:28:46'),
(133, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'Transaksi penjualan langsung dengan No Struk (ST/PL/140813/0001)', '2014-08-13 15:29:41'),
(134, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-13 15:57:29'),
(135, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-13 17:00:29'),
(136, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'Transaksi penjualan langsung dengan No Struk (ST/PL/140813/0002)', '2014-08-13 17:40:32'),
(137, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'Transaksi penjualan langsung dengan No Struk (ST/PL/140813/0003)', '2014-08-13 17:58:12'),
(138, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-13 18:01:03'),
(139, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'Transaksi penjualan langsung dengan No Struk (ST/PL/140813/0004)', '2014-08-13 18:04:17'),
(140, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'Transaksi penjualan langsung dengan No Struk (ST/PL/140813/0005)', '2014-08-13 18:08:59'),
(141, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-13 18:13:14'),
(142, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-13 18:14:28'),
(143, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-13 19:49:19'),
(144, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'Transaksi Pelayanan dengan No Struk (ST/TR/140813/0002)', '2014-08-13 20:18:14'),
(145, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'Transaksi Pelayanan dengan No Struk (ST/TR/140813/0003)', '2014-08-13 20:23:38'),
(146, 'Staff', 'Adminisitrator', 'Penjualan Langsung', 'Transaksi penjualan langsung dengan No Struk (ST/PL/140813/0006)', '2014-08-13 20:27:42'),
(147, 'Staff', 'Adminisitrator', '', 'Berhasil menambahkan data barang dengan id/kode barang (BD00011 / aa)', '2014-08-13 20:47:22'),
(148, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-13 20:49:49'),
(149, 'Staff', 'Adminisitrator', 'Tambah Barang', 'Berhasil menambahkan data barang dengan id/kode barang (BD00011 / aa)', '2014-08-13 20:50:40'),
(150, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-15 08:50:16'),
(151, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'Transaksi Pelayanan dengan No Struk (ST/TR/140815/0001)', '2014-08-15 08:58:06'),
(152, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'Transaksi Pelayanan dengan No Struk (ST/TR/140815/0002)', '2014-08-15 09:01:34'),
(153, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (BD00011) ', '2014-08-15 09:37:48'),
(154, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menyelesaikan pemesanan barang dengan No Pesan (PS/140815/0001) ', '2014-08-15 09:38:13'),
(155, 'Staff', 'Adminisitrator', 'Penerimaan Pemesanan Barang', 'Berhasil menyelesaikan Penerimaan barang dengan No Pesan (PS/140815/0001) ', '2014-08-15 09:38:37'),
(156, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (BT00001) ', '2014-08-15 09:42:51'),
(157, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menyelesaikan pemesanan barang dengan No Pesan (PS/140815/0002) ', '2014-08-15 09:43:30'),
(158, 'Staff', 'Adminisitrator', 'Penerimaan Pemesanan Barang', 'Berhasil menyelesaikan Penerimaan barang dengan No Pesan (PS/140815/0002) ', '2014-08-15 09:46:28'),
(159, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-15 11:10:03'),
(160, 'Staff', 'Adminisitrator', '', 'Berhasil memperbaharui data barang dengan id/kode barang ( / )', '2014-08-15 11:16:54'),
(161, 'Staff', 'Adminisitrator', 'Sunting Barang', 'Berhasil memperbaharui data barang dengan id/kode barang (BD00007 / asd)', '2014-08-15 11:17:28'),
(162, 'Staff', 'Adminisitrator', 'Sunting Barang', 'Berhasil memperbaharui data barang dengan id/kode barang (BD00006 / )', '2014-08-15 11:24:14'),
(163, 'Staff', 'Adminisitrator', 'Sunting Barang', 'Berhasil memperbaharui data barang dengan id/kode barang (BD00006 / )', '2014-08-15 11:24:31'),
(164, 'Staff', 'Adminisitrator', 'Tambah Barang', 'Berhasil menambahkan data barang dengan id/kode barang (BD00012 / qq)', '2014-08-15 11:38:03'),
(165, 'Staff', 'Adminisitrator', 'Tambah Barang', 'Berhasil menambahkan data barang dengan id/kode barang (OL00001 / zz)', '2014-08-15 11:39:19'),
(166, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-16 11:42:06'),
(167, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-16 14:00:56'),
(168, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-16 14:10:13'),
(169, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-16 14:10:16'),
(170, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-16 14:10:50'),
(171, 'Staff', 'pelayanan', 'Masuk', 'Pengguna (pelayanan) Berhasil masuk', '2014-08-16 14:10:57'),
(172, 'Sistem', 'pelayanan', 'System', 'Pengguna (pelayanan) keluar', '2014-08-16 14:37:37'),
(173, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-16 14:37:41'),
(174, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-17 10:53:05'),
(175, 'Staff', 'simabes', 'Masuk', 'Pengguna (simabes) Berhasil masuk', '2014-08-17 11:05:45'),
(176, 'Sistem', 'simabes', 'System', 'Pengguna (simabes) keluar', '2014-08-17 11:06:18'),
(177, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-17 11:10:09'),
(178, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-19 11:58:36'),
(179, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-19 11:58:46'),
(180, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-19 11:58:46'),
(181, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-001) ', '2014-08-19 11:59:08'),
(182, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-002) ', '2014-08-19 11:59:08'),
(183, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-20 10:25:37'),
(184, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 10:25:49'),
(185, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 10:25:50'),
(186, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 11:21:12'),
(187, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 11:21:12'),
(188, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-20 11:41:30'),
(189, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 11:41:42'),
(190, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 11:41:42'),
(191, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 11:41:56'),
(192, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 11:41:56'),
(193, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-20 11:53:26'),
(194, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 11:53:33'),
(195, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 11:53:33'),
(196, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060006) ', '2014-08-20 11:55:12'),
(197, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060007) ', '2014-08-20 11:55:12'),
(198, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060008) ', '2014-08-20 11:55:13'),
(199, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 11:55:37'),
(200, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 11:55:38'),
(201, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060006) ', '2014-08-20 11:55:38'),
(202, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 12:02:27'),
(203, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 12:02:27'),
(204, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060007) ', '2014-08-20 12:02:27'),
(205, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060006) ', '2014-08-20 12:12:17'),
(206, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060007) ', '2014-08-20 12:12:17'),
(207, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060008) ', '2014-08-20 12:12:17'),
(208, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 12:12:21'),
(209, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 12:12:21'),
(210, 'Staff', '', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 12:57:05'),
(211, 'Staff', '', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 12:57:05'),
(212, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-20 12:57:08'),
(213, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 12:57:15'),
(214, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 12:57:15'),
(215, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 12:57:47'),
(216, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 12:57:47'),
(217, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-20 13:20:14'),
(218, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 14:19:10'),
(219, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-20 14:22:01'),
(220, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-20 14:39:13'),
(221, 'Staff', 'Adminisitrator', 'Sunting Barang', 'Berhasil memperbaharui data barang dengan id/kode barang (BD00012 / qq)', '2014-08-20 14:44:53'),
(222, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'Transaksi Pelayanan dengan No Struk (ST/TR/140820/0001)', '2014-08-20 14:46:30'),
(223, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-20 14:50:53'),
(224, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 14:50:58'),
(225, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 14:50:58'),
(226, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 14:51:47'),
(227, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 14:51:47'),
(228, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-20 14:52:35'),
(229, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-20 14:52:35'),
(230, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-20 19:23:54'),
(231, 'Staff', 'Adminisitrator', 'Sunting Barang', 'Berhasil memperbaharui data barang dengan id/kode barang (BD00009 / 53205-GN5-830FB)', '2014-08-20 19:29:59'),
(232, 'Staff', 'Adminisitrator', 'Sunting Barang', 'Berhasil memperbaharui data barang dengan id/kode barang (BD00010 / 53205-KEV-830FB)', '2014-08-20 19:30:08'),
(233, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (BD00009) ', '2014-08-20 19:30:16'),
(234, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menambahkan pembelian barang dengan ID Barang (BD00010) ', '2014-08-20 19:30:16'),
(235, 'Staff', 'Adminisitrator', 'Barang', 'Berhasil menyelesaikan pemesanan barang dengan No Pesan (PS/140820/0001) ', '2014-08-20 19:30:37'),
(236, 'Staff', 'Adminisitrator', 'Penerimaan Pemesanan Barang', 'Berhasil menyelesaikan Penerimaan barang dengan No Pesan (PS/140820/0001) ', '2014-08-20 19:31:42'),
(237, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-002) ', '2014-08-20 19:33:10'),
(238, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1406-003) ', '2014-08-20 19:33:10'),
(239, 'Staff', 'Adminisitrator', 'Sunting Barang', 'Berhasil memperbaharui data barang dengan id/kode barang (OT00002 / test1)', '2014-08-20 20:17:46'),
(240, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-20 20:26:03'),
(241, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-21 19:56:55'),
(242, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-23 10:02:04'),
(243, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-24 12:41:37'),
(244, 'Staff', 'Adminisitrator', 'Tambah Data Pelanggan', 'Berhasil menambahkan pelanggan (aji) dengan ID Pelanggan (14080001) ', '2014-08-24 12:45:41'),
(245, 'Staff', 'Adminisitrator', 'Data Pelanggan', 'Berhasil menghapus pelanggan  dengan ID Pelanggan (14080001)', '2014-08-24 12:46:07'),
(246, 'Staff', 'Adminisitrator', 'Data Pelanggan', 'Berhasil menghapus pelanggan  dengan ID Pelanggan (14060009)', '2014-08-24 12:46:28'),
(247, 'Staff', 'Adminisitrator', 'Data Pelanggan', 'Berhasil menghapus pelanggan  dengan ID Pelanggan (14070001)', '2014-08-24 12:46:28'),
(248, 'Staff', 'Adminisitrator', 'Data Pelanggan', 'Berhasil menghapus pelanggan  dengan ID Pelanggan (14070002)', '2014-08-24 12:46:28'),
(249, 'Staff', 'Adminisitrator', 'Sunting Data Pegawai', 'Berhasil memperbaharui pegawai (Jejen) dengan ID pegawai (PG-1406-005)', '2014-08-24 12:49:53'),
(250, 'Staff', 'Adminisitrator', 'Tambah Data Pelanggan', 'Berhasil menambahkan pelanggan (Wahid Joko Winarno) dengan ID Pelanggan (14080001) ', '2014-08-24 12:50:40'),
(251, 'Staff', 'Adminisitrator', 'Sunting Data Pelanggan', 'Berhasil memperbaharui pelanggan (Wahid Joko Winarno) dengan ID Pelanggan (14080001)', '2014-08-24 12:51:19'),
(252, 'Staff', 'Adminisitrator', 'Sunting Data Pelanggan', 'Berhasil memperbaharui pelanggan (Wahid Joko Winarno) dengan ID Pelanggan (14080001)', '2014-08-24 12:53:22'),
(253, 'Staff', 'Adminisitrator', 'Sunting Data Pelanggan', 'Berhasil memperbaharui pelanggan (Wahid Joko Winarno) dengan ID Pelanggan (14080001)', '2014-08-24 12:53:39'),
(254, 'Staff', 'Adminisitrator', 'Sunting Data Pelanggan', 'Berhasil memperbaharui pelanggan (Wahid Joko Winarno) dengan ID Pelanggan (14080001)', '2014-08-24 12:54:50'),
(255, 'Staff', 'Adminisitrator', 'Sunting Data Pelanggan', 'Berhasil memperbaharui pelanggan (Wahid Joko Winarno) dengan ID Pelanggan (14080001)', '2014-08-24 12:55:06'),
(256, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14080001) ', '2014-08-24 12:55:17'),
(257, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-24 12:55:44'),
(258, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-24 12:55:44'),
(259, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060006) ', '2014-08-24 12:55:45'),
(260, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060007) ', '2014-08-24 12:55:45'),
(261, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060008) ', '2014-08-24 12:55:45'),
(262, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14080001) ', '2014-08-24 12:55:45'),
(263, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-24 12:56:56'),
(264, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-24 12:56:56'),
(265, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060006) ', '2014-08-24 12:56:56'),
(266, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060007) ', '2014-08-24 12:56:56'),
(267, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14060008) ', '2014-08-24 12:56:57'),
(268, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14080001) ', '2014-08-24 12:56:57'),
(269, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-24 13:06:21'),
(270, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-24 13:06:21'),
(271, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14080001) ', '2014-08-24 13:06:21'),
(272, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-001) ', '2014-08-24 13:30:29'),
(273, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-002) ', '2014-08-24 13:30:29'),
(274, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-001) ', '2014-08-24 13:30:36'),
(275, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-002) ', '2014-08-24 13:30:36'),
(276, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-001) ', '2014-08-24 13:31:00'),
(277, 'Staff', 'Adminisitrator', 'Kartu pegawai', 'Berhasil menambahkan antrian kartu pegawai dengan ID pegawai (PG-1405-002) ', '2014-08-24 13:31:00'),
(278, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-24 13:33:36'),
(279, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-24 13:33:40'),
(280, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-24 13:35:10'),
(281, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-24 13:35:13'),
(282, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-24 13:35:39'),
(283, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-24 13:35:42'),
(284, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-24 13:37:58'),
(285, 'Staff', 'Aris Winardi', 'Masuk', 'Pengguna (Aris Winardi) Berhasil masuk', '2014-08-24 13:38:06'),
(286, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-24 20:24:09'),
(287, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050001) ', '2014-08-24 20:24:21'),
(288, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14050002) ', '2014-08-24 20:24:21'),
(289, 'Staff', 'Adminisitrator', 'Kartu Pelanggan', 'Berhasil menambahkan antrian kartu pelanggan dengan ID Pelanggan (14080001) ', '2014-08-24 20:24:22'),
(290, 'Staff', 'Adminisitrator', 'Transaksi Pelayanan', 'Transaksi Pelayanan dengan No Struk (ST/TR/140824/0001)', '2014-08-24 20:27:17'),
(291, 'Staff', 'Adminisitrator', 'Sunting Barang', 'Berhasil memperbaharui data barang dengan id/kode barang (BP00001 / 45106-KG2-NA)', '2014-08-24 20:28:09'),
(292, 'Sistem', 'Adminisitrator', 'System', 'Pengguna (Adminisitrator) keluar', '2014-08-24 20:28:21'),
(293, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-26 11:53:21'),
(294, 'Staff', 'Adminisitrator', 'Masuk', 'Pengguna (Adminisitrator) Berhasil masuk', '2014-08-26 12:59:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(2) NOT NULL,
  `nm_menu` varchar(20) NOT NULL,
  `class` varchar(10) NOT NULL,
  `links` text NOT NULL,
  `icon` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id_menu`),
  KEY `id_menu` (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
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
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE IF NOT EXISTS `pengaturan` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `versi_aplikasi` varchar(15) NOT NULL,
  `nm_bengkel` varchar(30) NOT NULL,
  `telp1` varchar(30) NOT NULL,
  `telp2` varchar(30) NOT NULL,
  `almt_bengkel` text NOT NULL,
  `logo_bengkel` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `versi_aplikasi`, `nm_bengkel`, `telp1`, `telp2`, `almt_bengkel`, `logo_bengkel`) VALUES
(1, 'Ahwaya Ranc 2', 'Bengkel CV. Anugrah', '(0251) 7543443', '08889000216 / 081318447036', 'Jl. Perum Taman Griya Kencana Blok A18 No.5 Kel.Kencana, Kec.Tanah Sareal Kota Bogor', '../img/logo.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ply_`
--

CREATE TABLE IF NOT EXISTS `ply_` (
  `no_struk` varchar(25) NOT NULL,
  `tgl_struk` date NOT NULL,
  `id_plg` varchar(8) NOT NULL,
  `nm_plg` varchar(25) NOT NULL,
  `uang_bayar` double NOT NULL,
  `total_pembayaran` double NOT NULL,
  `id_pengguna` text NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`no_struk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ply_`
--

INSERT INTO `ply_` (`no_struk`, `tgl_struk`, `id_plg`, `nm_plg`, `uang_bayar`, `total_pembayaran`, `id_pengguna`, `wkt_ubah`) VALUES
('ST/TR/140625/0001', '2014-06-25', '14050001', 'Aris Winardi', 70000, 60000, '1', '2014-06-25 08:43:09'),
('ST/TR/140625/0002', '2014-06-25', '14050002', 'Ida Farida', 130000, 130000, '1', '2014-06-25 19:41:08'),
('ST/TR/140705/0001', '2014-07-05', '14050001', 'Aris Winardi', 200000, 170000, '1', '2014-07-05 09:49:43'),
('ST/TR/140708/0001', '2014-07-08', '14060009', 'dadang', 120000, 110000, '1', '2014-07-08 07:54:33'),
('ST/TR/140708/0002', '2014-07-08', '14050001', 'Aris Winardi', 100000, 85000, '1', '2014-07-08 12:54:46'),
('ST/TR/140708/0003', '2014-07-08', '14070002', 'dedeng', 110000, 105000, '1', '2014-07-08 18:57:12'),
('ST/TR/140716/0001', '2014-07-16', '14050001', 'Aris Winardi', 2715000, 2715000, '1', '2014-07-16 20:12:55'),
('ST/TR/140813/0001', '2014-08-13', '14060009', 'dadang', 65000, 61000, '1', '2014-08-13 15:28:46'),
('ST/TR/140813/0002', '2014-08-13', '14070002', 'dedeng', 300000, 290000, '1', '2014-08-13 20:18:14'),
('ST/TR/140813/0003', '2014-08-13', '14060009', 'dadang', 35000, 35000, '1', '2014-08-13 20:23:38'),
('ST/TR/140815/0001', '2014-08-15', '14050001', 'Aris Winardi', 50000, 35000, '1', '2014-08-15 08:58:06'),
('ST/TR/140815/0002', '2014-08-15', '14050002', 'Ida Farida', 110000, 105000, '1', '2014-08-15 09:01:34'),
('ST/TR/140820/0001', '2014-08-20', '14060006', 'Pipit damayanti', 50000, 40000, '1', '2014-08-20 14:46:30'),
('ST/TR/140824/0001', '2014-08-24', '14050001', 'Aris Winardi', 60000, 55000, '1', '2014-08-24 20:27:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ply_detail1`
--

CREATE TABLE IF NOT EXISTS `ply_detail1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_struk` varchar(25) NOT NULL,
  `id_kt_ply` int(11) NOT NULL,
  `nm_kt_ply` varchar(30) NOT NULL,
  `biaya` double NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data untuk tabel `ply_detail1`
--

INSERT INTO `ply_detail1` (`id`, `no_struk`, `id_kt_ply`, `nm_kt_ply`, `biaya`, `wkt_ubah`) VALUES
(1, 'ST/TR/140625/0001', 100, 'Kelistrikan', 10000, '2014-07-08 18:43:12'),
(2, 'ST/TR/140625/0002', 102, 'Service', 30000, '2014-07-08 18:43:12'),
(3, 'ST/TR/140705/0001', 104, 'Pencucian Motor', 7000, '2014-07-08 18:43:12'),
(4, 'ST/TR/140705/0001', 102, 'Service', 30000, '2014-07-08 18:43:12'),
(5, 'ST/TR/140708/0001', 100, 'Kelistrikan', 10000, '2014-07-08 18:43:12'),
(6, 'ST/TR/140708/0002', 100, 'Kelistrikan', 10000, '2014-07-08 18:43:12'),
(7, 'ST/TR/140708/0003', 101, 'Pemasangan', 5000, '2014-07-08 00:00:00'),
(8, 'ST/TR/140716/0001', 100, 'Kelistrikan', 10000, '2014-07-16 00:00:00'),
(9, 'ST/TR/140716/0001', 101, 'Pemasangan', 5000, '2014-07-16 00:00:00'),
(10, 'ST/TR/140813/0001', 101, 'Pemasangan', 5000, '2014-08-13 00:00:00'),
(11, 'ST/TR/140813/0002', 100, 'Kelistrikan', 10000, '2014-08-13 00:00:00'),
(12, 'ST/TR/140813/0002', 101, 'Pemasangan', 5000, '2014-08-13 00:00:00'),
(13, 'ST/TR/140813/0003', 100, 'Kelistrikan', 10000, '2014-08-13 00:00:00'),
(14, 'ST/TR/140815/0001', 100, 'Kelistrikan', 10000, '2014-08-15 00:00:00'),
(15, 'ST/TR/140815/0002', 101, 'Pemasangan', 5000, '2014-08-15 00:00:00'),
(16, 'ST/TR/140820/0001', 101, 'Pemasangan', 5000, '2014-08-20 00:00:00'),
(17, 'ST/TR/140824/0001', 101, 'Pemasangan', 5000, '2014-08-24 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ply_detail2`
--

CREATE TABLE IF NOT EXISTS `ply_detail2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_struk` varchar(25) NOT NULL,
  `tgl_struk` date NOT NULL,
  `no_polisi` varchar(15) NOT NULL,
  `no_mesin` varchar(20) NOT NULL,
  `jns_kendaraan` varchar(50) NOT NULL,
  `km_terakhir` varchar(12) NOT NULL,
  `keluhan` text NOT NULL,
  `saran` text NOT NULL,
  `id_peg` varchar(11) NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data untuk tabel `ply_detail2`
--

INSERT INTO `ply_detail2` (`id`, `no_struk`, `tgl_struk`, `no_polisi`, `no_mesin`, `jns_kendaraan`, `km_terakhir`, `keluhan`, `saran`, `id_peg`, `wkt_ubah`) VALUES
(1, 'ST/TR/140625/0001', '2014-06-25', 'B 1234 CS', 'Zadas0ad8a', 'Honda Grand 1993', '-', 'lampu mati', '-', 'PG-1405-001', '2014-06-25 08:43:09'),
(2, 'ST/TR/140625/0002', '2014-06-25', 'B231XD', '', '', '', '', '', 'PG-1405-001', '2014-06-25 19:41:08'),
(3, 'ST/TR/140705/0001', '2014-07-05', 'f 6791 rb', '', '', '', '', '', 'PG-1405-001', '2014-07-05 09:49:43'),
(4, 'ST/TR/140708/0001', '2014-07-08', 'B 1234 CSA', '', '', '', '', '', 'PG-1405-001', '2014-07-08 07:54:33'),
(5, 'ST/TR/140708/0002', '2014-07-08', 'B 1234 CSA', '', '', '', '', '', 'PG-1405-001', '2014-07-08 12:54:46'),
(6, 'ST/TR/140708/0003', '2014-07-08', 'B 1234 CS', '', '', '', '', '', 'PG-1406-003', '2014-07-08 18:57:12'),
(7, 'ST/TR/140716/0001', '2014-07-16', 'B 1234 CS', '', '', '', '', '', 'PG-1405-001', '2014-07-16 20:12:55'),
(8, 'ST/TR/140813/0001', '2014-08-13', 'B 1234 CS', '', '', '', '', '', 'PG-1405-001', '2014-08-13 15:28:46'),
(9, 'ST/TR/140813/0002', '2014-08-13', 'B231XD', '', '', '', '', '', 'PG-1405-001', '2014-08-13 20:18:14'),
(10, 'ST/TR/140813/0003', '2014-08-13', 'B 1234 CS', '', '', '', '', '', 'PG-1405-002', '2014-08-13 20:23:38'),
(11, 'ST/TR/140815/0001', '2014-08-15', 'B 1234 CSA', '', '', '', '', '', 'PG-1405-001', '2014-08-15 08:58:06'),
(12, 'ST/TR/140815/0002', '2014-08-15', 'B 1234 CSA', '', '', '', '', '', 'PG-1405-001', '2014-08-15 09:01:34'),
(13, 'ST/TR/140820/0001', '2014-08-20', 'B 009 XC', '', '', '', '', '', 'PG-1405-001', '2014-08-20 14:46:30'),
(14, 'ST/TR/140824/0001', '2014-08-24', 'B 1224 CSA', '', 'Honda Grand 1993', '82444', '-', '-', 'PG-1405-001', '2014-08-24 20:27:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ply_kategori`
--

CREATE TABLE IF NOT EXISTS `ply_kategori` (
  `id_kt_ply` int(11) NOT NULL AUTO_INCREMENT,
  `nm_kt_ply` varchar(30) NOT NULL,
  `biaya` double NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id_kt_ply`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

--
-- Dumping data untuk tabel `ply_kategori`
--

INSERT INTO `ply_kategori` (`id_kt_ply`, `nm_kt_ply`, `biaya`, `wkt_ubah`) VALUES
(100, 'Kelistrikan', 10000, '2014-06-20 19:51:55'),
(101, 'Pemasangan', 5000, '2014-05-28 08:23:09'),
(102, 'Service', 30000, '2014-05-28 08:23:20'),
(103, 'Overhoul', 50000, '2014-05-29 06:53:33'),
(104, 'Pencucian Motor', 7000, '2014-06-10 21:56:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ply_penjualan`
--

CREATE TABLE IF NOT EXISTS `ply_penjualan` (
  `no_struk` varchar(25) NOT NULL,
  `tgl_struk` date NOT NULL,
  `nm_plg` varchar(25) NOT NULL,
  `total_pembayaran` double NOT NULL,
  `uang_bayar` double NOT NULL,
  `id_pengguna` text NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`no_struk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ply_penjualan`
--

INSERT INTO `ply_penjualan` (`no_struk`, `tgl_struk`, `nm_plg`, `total_pembayaran`, `uang_bayar`, `id_pengguna`, `wkt_ubah`) VALUES
('ST/PL/140625/0001', '2014-06-25', 'sopiyan nugraha', 310000, 400000, '1', '2014-07-08 18:43:12'),
('ST/PL/140628/0001', '2014-06-28', 'dena', 364000, 400000, '1', '2014-07-08 18:43:12'),
('ST/PL/140630/0001', '2014-06-30', 'aa', 5000000, 5000000, '1', '2014-07-08 18:43:12'),
('ST/PL/140708/0001', '2014-07-08', 'Aris Winardi', 725000, 800000, '1', '2014-07-08 18:43:12'),
('ST/PL/140708/0002', '2014-07-08', 'sartono', 291000, 300000, '1', '2014-07-08 18:43:12'),
('ST/PL/140716/0001', '2014-07-16', 'dadang lagi', 200000, 400000, '1', '2014-07-16 20:21:05'),
('ST/PL/140716/0002', '2014-07-16', 'dadang', 300000, 400000, '1', '2014-07-16 21:59:56'),
('ST/PL/140807/0001', '2014-08-07', '-', 55000, 400000, '1', '2014-08-07 12:09:29'),
('ST/PL/140811/0001', '2014-08-11', '-', 2501000, 2501000, '1', '2014-08-11 16:55:17'),
('ST/PL/140813/0001', '2014-08-13', '-', 100000, 400000, '1', '2014-08-13 15:29:41'),
('ST/PL/140813/0002', '2014-08-13', 'aceng', 125000, 130000, '1', '2014-08-13 17:40:32'),
('ST/PL/140813/0003', '2014-08-13', '-', 350000, 400000, '1', '2014-08-13 17:58:12'),
('ST/PL/140813/0004', '2014-08-13', '-', 300000, 300000, '1', '2014-08-13 18:04:17'),
('ST/PL/140813/0005', '2014-08-13', 'saya sendiri', 30000, 50000, '1', '2014-08-13 18:08:59'),
('ST/PL/140813/0006', '2014-08-13', '-', 500000, 500000, '1', '2014-08-13 20:27:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ply_penjualan_detail`
--

CREATE TABLE IF NOT EXISTS `ply_penjualan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_struk` varchar(25) NOT NULL,
  `id_brg` varchar(25) NOT NULL,
  `nm_brg` varchar(25) NOT NULL,
  `hrg_brg` double NOT NULL,
  `jml_brg` int(3) NOT NULL,
  `total` double NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data untuk tabel `ply_penjualan_detail`
--

INSERT INTO `ply_penjualan_detail` (`id`, `no_struk`, `id_brg`, `nm_brg`, `hrg_brg`, `jml_brg`, `total`, `wkt_ubah`) VALUES
(1, 'ST/TR/140625/0001', 'EL00002', 'Lampu LED Variasi', 25000, 2, 50000, '2014-07-08 18:43:12'),
(2, 'ST/PL/140625/0001', 'SU00001', 'Shock Breaker Variasi', 250000, 1, 250000, '2014-07-08 18:43:12'),
(3, 'ST/PL/140625/0001', 'EL00003', 'Lampu Hazard', 30000, 2, 60000, '2014-07-08 18:43:12'),
(4, 'ST/TR/140625/0002', 'BT00001', 'BATTERY', 100000, 1, 100000, '2014-07-08 18:43:12'),
(5, 'ST/PL/140628/0001', 'BT00003', 'BATTERY', 91000, 4, 364000, '2014-07-08 18:43:12'),
(6, 'ST/PL/140630/0001', 'OT00001', 'asdak sdkas ndnsj fsdx cv', 2500000, 2, 5000000, '2014-07-08 18:43:12'),
(7, 'ST/TR/140705/0001', 'EL00003', 'Lampu Hazard', 30000, 2, 60000, '2014-07-08 18:43:12'),
(8, 'ST/TR/140705/0001', 'BT00002', 'BATTERY', 73000, 1, 73000, '2014-07-08 18:43:12'),
(11, 'ST/PL/140708/0001', 'BT00001', 'BATTERY', 100000, 7, 700000, '2014-07-08 18:43:12'),
(12, 'ST/PL/140708/0001', 'BD00006', 'Sayap Honda Grand', 25000, 1, 25000, '2014-07-08 18:43:12'),
(13, 'ST/PL/140708/0002', 'BT00003', 'BATTERY', 91000, 1, 91000, '2014-07-08 18:43:12'),
(14, 'ST/PL/140708/0002', 'BT00001', 'BATTERY', 100000, 2, 200000, '2014-07-08 18:43:12'),
(15, 'ST/TR/140708/0001', 'BT00001', 'BATTERY', 100000, 1, 100000, '2014-07-08 18:43:12'),
(16, 'ST/TR/140708/0002', 'EL00001', 'Lampu LED Variasi', 25000, 3, 75000, '2014-07-08 18:43:12'),
(17, 'ST/TR/140708/0003', 'BT00001', 'BATTERY', 100000, 1, 100000, '2014-07-08 00:00:00'),
(18, 'ST/TR/140716/0001', 'BT00001', 'BATTERY', 100000, 2, 200000, '2014-07-16 00:00:00'),
(19, 'ST/TR/140716/0001', 'OT00001', 'asdak sdkas ndnsj fsdx cv', 2500000, 1, 2500000, '2014-07-16 00:00:00'),
(20, 'ST/PL/140716/0001', 'BT00001', 'BATTERY', 100000, 2, 200000, '2014-07-16 00:00:00'),
(22, 'ST/PL/140716/0002', 'EL00001', 'Lampu LED Variasi', 25000, 12, 300000, '2014-07-16 00:00:00'),
(23, 'ST/PL/140804/0001', 'EL00001', 'Lampu LED Variasi', 25000, 2, 50000, '2014-08-04 00:00:00'),
(24, 'ST/PL/140807/0001', 'BD00006', 'Sayap Honda Grand', 25000, 1, 25000, '2014-08-07 00:00:00'),
(25, 'ST/PL/140807/0001', 'BP00001', 'DISC PAD', 30000, 1, 30000, '2014-08-07 00:00:00'),
(26, 'ST/PL/140811/0001', 'OT00001', 'asdak sdkas ndnsj fsdx cv', 2500000, 1, 2500000, '2014-08-11 00:00:00'),
(27, 'ST/PL/140811/0001', 'OT00002', '1111111111111111111111111', 1000, 1, 1000, '2014-08-11 00:00:00'),
(28, 'ST/TR/140813/0001', 'BD00010', 'Cover Handle Front', 31000, 1, 31000, '2014-08-13 00:00:00'),
(29, 'ST/TR/140813/0001', 'EL00001', 'Lampu LED Variasi', 25000, 1, 25000, '2014-08-13 00:00:00'),
(30, 'ST/PL/140813/0001', 'BT00001', 'BATTERY', 100000, 1, 100000, '2014-08-13 00:00:00'),
(33, 'ST/PL/140813/0002', 'BT00001', 'BATTERY', 100000, 1, 100000, '2014-08-13 00:00:00'),
(34, 'ST/PL/140813/0002', 'EL00001', 'Lampu LED Variasi', 25000, 1, 25000, '2014-08-13 00:00:00'),
(35, 'ST/PL/140813/0003', 'BT00001', 'BATTERY', 100000, 1, 100000, '2014-08-13 00:00:00'),
(36, 'ST/PL/140813/0003', 'SU00001', 'Shock Breaker Variasi', 250000, 1, 250000, '2014-08-13 00:00:00'),
(37, 'ST/PL/140813/0004', 'BT00001', 'BATTERY', 100000, 3, 300000, '2014-08-13 00:00:00'),
(38, 'ST/PL/140813/0005', 'BP00001', 'DISC PAD', 30000, 1, 30000, '2014-08-13 00:00:00'),
(39, 'ST/TR/140813/0002', 'EL00001', 'Lampu LED Variasi', 25000, 1, 25000, '2014-08-13 00:00:00'),
(40, 'ST/TR/140813/0002', 'SU00001', 'Shock Breaker Variasi', 250000, 1, 250000, '2014-08-13 00:00:00'),
(41, 'ST/TR/140813/0003', 'EL00001', 'Lampu LED Variasi', 25000, 1, 25000, '2014-08-13 00:00:00'),
(42, 'ST/PL/140813/0006', 'SU00001', 'Shock Breaker Variasi', 250000, 2, 500000, '2014-08-13 00:00:00'),
(43, 'ST/TR/140815/0001', 'EL00001', 'Lampu LED Variasi', 25000, 1, 25000, '2014-08-15 00:00:00'),
(44, 'ST/TR/140815/0002', 'BT00001', 'BATTERY', 100000, 1, 100000, '2014-08-15 00:00:00'),
(45, 'ST/TR/140820/0001', 'BD00006', 'Sayap Honda Grand', 35000, 1, 35000, '2014-08-20 00:00:00'),
(46, 'ST/TR/140824/0001', 'EL00001', 'Lampu LED Variasi', 25000, 2, 50000, '2014-08-24 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sementara`
--

CREATE TABLE IF NOT EXISTS `sementara` (
  `id` varchar(30) NOT NULL,
  `value` double NOT NULL,
  KEY `id_plg` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sup_data`
--

CREATE TABLE IF NOT EXISTS `sup_data` (
  `id_sup` varchar(8) NOT NULL,
  `nm_sup` varchar(30) NOT NULL,
  `almt_sup` text NOT NULL,
  `telp_sup` varchar(13) NOT NULL,
  `wkt_ubah` datetime NOT NULL,
  PRIMARY KEY (`id_sup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sup_data`
--

INSERT INTO `sup_data` (`id_sup`, `nm_sup`, `almt_sup`, `telp_sup`, `wkt_ubah`) VALUES
('0001', 'PT. Sinar Galih', 'Jl. Perintis Kemerdekaan 2', '09899', '2014-07-19 20:03:05'),
('0002', 'PT. Gunung Agung', 'Jl. Gunung Agung', '099222', '2014-07-08 18:43:12'),
('0003', 'Toko Spare Part Merdeka', 'Jl. Merdeka', '098222', '2014-07-08 18:43:12'),
('0004', 'PT. Gajah Mungkur', 'jl. gajah mungkur', '0987777', '2014-07-08 18:43:12'),
('0005', 'asd', 'asd', '0989', '2014-07-08 18:43:12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
