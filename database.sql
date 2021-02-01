-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2021 at 12:49 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cek_jumlah_issued_user` (IN `id_cek` INT)  NO SQL
SELECT status_peminjaman,nama_member,COUNT(b.id_member) AS jumlah_pinjaman
FROM perpus.peminjaman_buku AS A
INNER JOIN perpus.anggota AS B ON A.id_member=id_cek AND
B.id_member=id_cek where status_peminjaman='issued'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cek_jumlah_peminjaman_user` (IN `id_cek` INT)  NO SQL
BEGIN
SELECT nama_member,COUNT(b.id_member) AS jumlah_pinjaman
 FROM perpus.peminjaman_buku AS A
 INNER JOIN perpus.anggota AS B ON A.id_member=id_cek AND
B.id_member=id_cek;
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cek_jumlah_reserved_user` (IN `id_cek` INT)  NO SQL
SELECT status_peminjaman,nama_member,COUNT(b.id_member) AS jumlah_pinjaman
FROM perpus.peminjaman_buku AS A
INNER JOIN perpus.anggota AS B ON A.id_member=id_cek AND
B.id_member=id_cek where status_peminjaman='reserved'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getId` (IN `login` VARCHAR(512))  NO SQL
SELECT * FROM `anggota` WHERE email=login$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `history_peminjaman` (IN `id_cek` INT)  NO SQL
BEGIN
SELECT *, DATEDIFF(CURRENT_DATE(),tanggal_peminjaman), 
CASE
	when tanggal_pengembalian is null then "0000-00-00 00:00:00"
    when tanggal_pengembalian is not null then tanggal_pengembalian
END AS tanggal_pengembalian1,   
CASE
	when DATEDIFF(CURRENT_DATE(),tanggal_peminjaman) > 3 then (DATEDIFF(CURRENT_DATE(),tanggal_peminjaman)-3)*3000
    when DATEDIFF(CURRENT_DATE(),tanggal_peminjaman) < 3 then "-" 
END AS denda  
FROM peminjaman_buku as A INNER JOIN buku AS B on  A.id_buku=B.id_buku where id_member=id_cek order by status_peminjaman ASC,denda DESC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL,
  `update-date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `update-date`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2020-12-21 14:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `admlog`
--

CREATE TABLE `admlog` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `userip` binary(16) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admlog`
--

INSERT INTO `admlog` (`id`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 'admin', 0x3a3a3100000000000000000000000000, '2020-12-18 22:17:40', '2020-12-19 05:17:44', 1),
(2, 'admin', 0x3a3a3100000000000000000000000000, '2020-12-19 02:52:12', '2020-12-19 09:52:52', 1),
(3, '', 0x3a3a3100000000000000000000000000, '2020-12-22 09:05:43', '', 0),
(4, '', 0x3a3a3100000000000000000000000000, '2020-12-23 01:50:46', '', 0),
(5, '', 0x3a3a3100000000000000000000000000, '2020-12-26 03:15:26', '', 0),
(6, '', 0x3a3a3100000000000000000000000000, '2020-12-26 03:15:44', '', 0),
(7, '', 0x3a3a3100000000000000000000000000, '2021-01-08 07:58:54', '', 0),
(8, '', 0x3a3a3100000000000000000000000000, '2021-01-08 07:59:37', '', 0),
(9, '', 0x3a3a3100000000000000000000000000, '2021-01-08 08:00:09', '', 0),
(10, '', 0x3a3a3100000000000000000000000000, '2021-01-08 08:00:25', '', 0),
(11, '', 0x3a3a3100000000000000000000000000, '2021-01-08 08:02:53', '', 0),
(12, '', 0x3a3a3100000000000000000000000000, '2021-01-08 08:03:52', '', 0),
(13, '', 0x3a3a3100000000000000000000000000, '2021-01-14 11:38:40', '', 0),
(14, '', 0x3a3a3100000000000000000000000000, '2021-01-14 12:58:50', '', 0),
(15, '', 0x3a3a3100000000000000000000000000, '2021-01-14 13:00:51', '', 0),
(16, '', 0x3a3a3100000000000000000000000000, '2021-01-15 17:07:56', '', 0),
(17, '', 0x3a3a3100000000000000000000000000, '2021-01-15 17:08:02', '', 0),
(18, '', 0x3a3a3100000000000000000000000000, '2021-01-29 15:42:18', '', 0),
(19, '', 0x3a3a3100000000000000000000000000, '2021-02-01 11:26:35', '', 0),
(20, '', 0x3a3a3100000000000000000000000000, '2021-02-01 11:36:31', '', 0),
(21, '', 0x3a3a3100000000000000000000000000, '2021-02-01 11:36:36', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_member` int(11) NOT NULL,
  `email` varchar(512) NOT NULL,
  `username` varchar(512) DEFAULT NULL,
  `nama_member` varchar(512) NOT NULL,
  `gender` varchar(512) DEFAULT NULL,
  `nomor_telepon_member` varchar(13) DEFAULT NULL,
  `alamat_member` varchar(512) DEFAULT NULL,
  `identitas_member` varchar(512) DEFAULT NULL,
  `file_identitas` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_member`, `email`, `username`, `nama_member`, `gender`, `nomor_telepon_member`, `alamat_member`, `identitas_member`, `file_identitas`, `password`) VALUES
(1, 'ian@gmail.com', 'Phantom1', 'Ian Felix Jonathan Simanjutak', 'pria', '082389004609', 'Kompleks Perumahan PT.RAPP', 'KTP', '', '698d51a19d8a121ce581499d7b701668'),
(2, 'ian1@gmail.com', 'phantom2', 'Calvin Simatupang', 'pria', '082389424111', 'Jalan Kemerdekaan no 5, Tarutung Tapanuli UTara', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(3, 'ian2@gmail.com', 'phantom3', 'Graha Napitupulu', 'pria', '82289424609', 'Jl kenangan nomor 2, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(4, 'ian3@gmail.com', 'phantom4', 'Wahyu Nababan', 'pria', '82389425609', 'Jl kenangan nomor 1, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(5, 'ian4@gmail.com', 'phantom5', 'Daniel Simbolon', 'pria', '82389122609', 'Jl kenangan nomor 4, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(6, 'ian5@gmail.com', 'phantom6', 'Rio Fransiskus', 'pria', '82329425609', 'Jl kenangan nomor 3, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(7, 'ian6@gmail.com', 'phantom7', 'Jose Sipayung', 'pria', '82377425698', 'Jl kenangan nomor 5, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(8, 'ian7@gmail.com', 'phantom8', 'Donny Harahap', 'pria', '82389427709', 'Jl kenangan nomor 6, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(9, 'ian8@gmail.com', 'phantom9', 'Juntri Dolok Saribu', 'pria', '82389425699', 'Jl kenangan nomor 7, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(10, 'ian9@gmail.com', 'phantom10', 'Bertonius haloho', 'pria', '82390425609', 'Jl kenangan nomor 8, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(11, 'ian10@gmail.com', 'phantom11', 'Irene Siagian', 'wanita', '82389925609', 'Jl kenangan nomor 9, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(12, 'ian11@gmail.com', 'phantom12', 'Melamitha Andreas', 'wanita', '82311125609', 'Jl kenangan nomor 10, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(13, 'ian12@gmail.com', 'phantom13', 'Zelda Sibuea', 'wanita', '82389425111', 'Jl kenangan nomor 11, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(14, 'ian13@gmail.com', 'phantom14', 'Grace Agatha', 'wanita', '82389425123', 'Jl kenangan nomor 12, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(15, 'ian14@gmail.com', 'phantom15', 'Mikhalindo Samosir', 'wanita', '82389429909', 'Jl kenangan nomor 13, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(16, 'ian15@gmail.com', 'phantom16', 'Dewi Mardani', 'wanita', '82389412111', 'Jl kenangan nomor 14, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(17, 'ian16@gmail.com', 'phantom17', 'Daniel Evan', 'pria', '82389985609', 'Jl kenangan nomor 15, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(18, 'ian17@gmail.com', 'phantom18', 'Evan Adrianus', 'pria', '85289425609', 'Jl kenangan nomor 16, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(19, 'ian18@gmail.com', 'phantom19', 'Atania Tyhra', 'wanita', '89589425609', 'Jl kenangan nomor 17, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(20, 'ian19@gmail.com', 'phantom20', 'Dewi Siagian', 'wanita', '82189425609', 'Jl kenangan nomor 18, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(21, 'ian20@gmail.com', 'phantom21', 'Seo Dalmi', 'wanita', '82189426509', NULL, 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(22, 'ian21@gmail.com', 'phantom22', 'Nam Dosan', 'pria', '82189425509', NULL, 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(23, 'ian22@gmail.com', 'phantom23', 'Han jipyeong', 'pria', NULL, 'Jl kenangan nomor 19, KTT', 'KTP', '', '202cb962ac59075b964b07152d234b70'),
(24, 'ian23@gmail.com', 'phantom24', 'Mbok Darmi', 'wanita', NULL, 'Jl kenangan nomor 20, KTT', NULL, '', '202cb962ac59075b964b07152d234b70'),
(30, 'abygail@gmail.com', 'Abygail', 'Natasya Abygail', '', '089561128773', 'Jalan Kejawan putih tambak no 18, Keputih tegal timur', 'KTP', 'identity_card_example.b686f703.jpg', '202cb962ac59075b964b07152d234b70'),
(31, 'shafiravirdausi@gmail.com', 'shafira', 'Shafira Firdausi', '', '081234567890', 'pandaan', 'KTM', 'polosan najwa.jpg', '2ec4b0bdf35a294f7b42496e0a19ceea'),
(32, 'percobaan.tkk@gmail.com', 'iaa', 'Natasya Abygail', '', '082389221111', 'Kampung', 'KTM', 'identity_card_example.b686f703.jpg', '202cb962ac59075b964b07152d234b70'),
(33, 'ntsyaabygaill@gmail.com', 'abeegell_', 'natasya', '', '08518239719', 'kepo', 'KTP', 'Screen Shot 2021-01-13 at 10.09.05.png', '827ccb0eea8a706c4c34a16891f84e7b'),
(34, 'bokuto@fukurodani.ac.jp', 'bokuto', 'Bokuto Kotaro', '', '12345', 'jepang', 'KTP', 'banner-img.png', '01302f8c04051f428eb2dc20b4fd16fa'),
(35, 'ian1111@gmail.com', '123', 'Ian F', '', '1231231231231', '123', 'KTP', '26691.jpg', '202cb962ac59075b964b07152d234b70'),
(36, 'ian111@gmail.com', 'Phantom1', 'Ian Felix Jonathan Simanjutak', '', '081122334455', 'testes', 'KTP', '26691.jpg', '202cb962ac59075b964b07152d234b70');

--
-- Triggers `anggota`
--
DELIMITER $$
CREATE TRIGGER `sebelum_update_data` BEFORE UPDATE ON `anggota` FOR EACH ROW INSERT INTO anggota_data_lama
SET
 id_member = OLD.id_member,
 email = OLD.email,
 username = OLD.username,
 gender = OLD.gender,
 nama_member = OLD.nama_member,
 nomor_telepon_member = OLD.nomor_telepon_member,
 alamat_member = OLD.alamat_member,
 password = OLD.password
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `anggota_data_lama`
--

CREATE TABLE `anggota_data_lama` (
  `id_anggota_before` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `email` varchar(512) NOT NULL,
  `username` varchar(512) DEFAULT NULL,
  `nama_member` varchar(512) NOT NULL,
  `gender` varchar(512) DEFAULT NULL,
  `nomor_telepon_member` varchar(13) DEFAULT NULL,
  `alamat_member` varchar(512) DEFAULT NULL,
  `identitas_member` varchar(512) DEFAULT NULL,
  `file_identitas` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL,
  `tanggal_ganti` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `anggota_data_lama`
--

INSERT INTO `anggota_data_lama` (`id_anggota_before`, `id_member`, `email`, `username`, `nama_member`, `gender`, `nomor_telepon_member`, `alamat_member`, `identitas_member`, `file_identitas`, `password`, `tanggal_ganti`) VALUES
(1, 2, 'ian1@gmail.com', 'phantom2', 'Calvin Simatupang', 'pria', '82189424609', 'Jl Akasia tarutung', NULL, '', '202cb962ac59075b964b07152d234b70', '2020-12-22 22:27:36'),
(2, 1, 'ian@gmail.com', 'phantom1', 'Ian Felix', 'pria', '82389424609', 'Kompleks Perumahan PT.RAPP', NULL, '', '202cb962ac59075b964b07152d234b70', '2020-12-22 22:47:13'),
(3, 1, 'ian@gmail.com', 'Phantom1', 'Ian Felix JS', 'pria', '089766551122', '', NULL, '', '202cb962ac59075b964b07152d234b70', '2020-12-22 22:49:02'),
(4, 1, 'ian@gmail.com', 'Phantom1', 'Ian Felix JS', 'pria', '082389004609', 'Kompleks Perumahan PT.RAPP dm35a, Pelalawan, Riau', NULL, '', '202cb962ac59075b964b07152d234b70', '2020-12-22 23:02:15'),
(5, 1, 'ian@gmail.com', 'Phantom1', 'Ian Felix JS', 'pria', '082389004609', 'Kompleks Perumahan PT.RAPP dm35a, Pelalawan, Riau', NULL, '', 'new', '2020-12-22 23:03:55'),
(6, 1, 'ian@gmail.com', 'Phantom1', 'Ian Felix JS', 'pria', '082389004609', 'Kompleks Perumahan PT.RAPP dm35a, Pelalawan, Riau', NULL, '', '202cb962ac59075b964b07152d234b70', '2020-12-22 23:04:05'),
(7, 1, 'ian@gmail.com', 'Phantom1', 'Ian Felix JS', 'pria', '082389004609', 'Kompleks Perumahan PT.RAPP dm35a, Pelalawan, Riau', NULL, '', '698d51a19d8a121ce581499d7b701668', '2020-12-26 03:16:41'),
(8, 1, 'ian@gmail.com', 'Phantom1', 'Ian Felix JS', 'pria', '082389004609', 'Kompleks Perumahan PT.RAPP dm35a, Pelalawan, Riau', NULL, '', '202cb962ac59075b964b07152d234b70', '2021-01-14 08:53:50'),
(9, 1, 'ian@gmail.com', 'Phantom1', 'Ian Felix JS', 'pria', '082389004609', 'Kompleks Perumahan PT.RAPP dm35a, Pelalawan, Riau', NULL, '', '202cb962ac59075b964b07152d234b70', '2021-01-14 14:05:14'),
(10, 1, 'ian@gmail.com', 'Phantom1', 'Ian Felix Jonathan Simanjutak', 'pria', '0082389004601', 'Kompleks Perumahan PT.RAPP dm35a, Pelalawan, Riau', NULL, '', '202cb962ac59075b964b07152d234b70', '2021-01-14 14:05:26'),
(11, 1, 'ian@gmail.com', 'Phantom1', 'Ian Felix Jonathan Simanjutak', 'pria', '0082389004601', 'Kompleks Perumahan PT.RAPP dm35a, Pelalawan, Riau', NULL, '', '202cb962ac59075b964b07152d234b70', '2021-01-15 09:13:41'),
(12, 1, 'ian@gmail.com', 'Phantom1', 'Ian Felix Jonathan Simanjutak', 'pria', '082389004609', 'Kompleks Perumahan PT.RAPP', NULL, '', '202cb962ac59075b964b07152d234b70', '2021-01-15 09:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `biaya_langganan`
--

CREATE TABLE `biaya_langganan` (
  `nomor_pembayaran` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `jumlah_pembayaran` int(11) NOT NULL,
  `bukti_pembayaran` varchar(256) NOT NULL,
  `tanggal_pembayaran` timestamp NOT NULL DEFAULT current_timestamp(),
  `lama_langganan` int(11) NOT NULL,
  `status` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `biaya_langganan`
--

INSERT INTO `biaya_langganan` (`nomor_pembayaran`, `id_member`, `jumlah_pembayaran`, `bukti_pembayaran`, `tanggal_pembayaran`, `lama_langganan`, `status`) VALUES
(1, 1, 10000, '', '2020-12-21 14:38:45', 2, 'verified'),
(2, 2, 15000, '', '2020-12-21 14:38:45', 3, 'verified'),
(3, 3, 10000, '', '2020-12-21 14:38:45', 2, 'verified'),
(4, 4, 5000, '', '2020-12-21 14:38:45', 1, 'verified'),
(5, 5, 10000, '', '2020-12-21 14:38:45', 2, 'verified'),
(6, 6, 10000, '', '2020-12-21 14:38:45', 2, 'verified'),
(7, 7, 15000, '', '2020-12-21 14:38:45', 3, 'verified'),
(8, 8, 20000, '', '2020-12-21 14:38:45', 4, 'verified'),
(9, 9, 10000, '', '2020-12-21 14:38:45', 2, 'verified'),
(10, 10, 5000, '', '2020-12-21 14:38:45', 1, 'verified'),
(11, 11, 10000, '', '2020-12-21 14:38:45', 2, 'verified'),
(12, 12, 10000, '', '2020-12-21 14:38:45', 2, 'verified'),
(13, 13, 5000, '', '2020-12-21 14:38:45', 1, 'verified'),
(14, 14, 10000, '', '2020-12-21 14:38:45', 2, 'verified'),
(15, 15, 15000, '', '2020-12-21 14:38:45', 3, 'verified'),
(16, 16, 20000, '', '2020-12-21 14:38:45', 4, 'verified'),
(17, 17, 10000, '', '2020-12-21 14:38:45', 2, 'verified'),
(18, 18, 10000, '', '2020-12-21 14:38:45', 2, 'verified'),
(19, 19, 15000, '', '2020-12-21 14:38:45', 3, 'verified'),
(20, 20, 5000, '', '2020-12-21 14:38:45', 1, 'verified'),
(22, 32, 10000, '', '2020-12-26 14:34:04', 2, 'verified'),
(25, 1, 10000, 'lambangITS.png', '2021-01-02 03:04:46', 2, 'not verified'),
(30, 4, 200000, '', '2021-01-13 17:15:42', 40, 'verified'),
(31, 1, 5000, 'welcome.png', '2021-01-13 17:28:16', 1, 'verified'),
(32, 1, 5000, '26691.jpg', '2021-01-14 14:06:41', 1, 'verified'),
(33, 1, 5000, '', '2021-01-14 14:14:16', 1, 'verified'),
(34, 1, 5000, '26691.jpg', '2021-01-15 09:20:56', 1, 'verified'),
(35, 2, 5000, '', '2021-01-15 09:37:16', 1, 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `id_publisher` int(11) NOT NULL,
  `kode_kategori` int(11) NOT NULL,
  `judul_buku` varchar(512) NOT NULL,
  `isbn` varchar(512) NOT NULL,
  `jumlah_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `id_publisher`, `kode_kategori`, `judul_buku`, `isbn`, `jumlah_buku`) VALUES
(1, 2, 2, 'puisi yang indah', '9786028519934', 5),
(2, 1, 2, 'Tuhan yang Maha Esa', '9785028519939', 3),
(3, 1, 3, 'Siapa yang paling pancasila', '9785054519939', 3),
(4, 1, 4, 'Jenaka Politik Negeri Ini', '1285054519939', 3),
(5, 1, 5, 'Internet of Thing', '9215054519939', 3),
(6, 1, 6, 'interstellar of the dimension', '9785051119939', 3),
(7, 1, 7, 'Iptek yang terlarang', '9700954519939', 3),
(8, 1, 8, 'The naked traveller', '9785054519139', 3),
(9, 1, 1, 'The Shakespere', '1485054519139', 3),
(10, 1, 2, 'Agama yang terdiskriminasi', '1445054519139', 2),
(11, 1, 3, 'Sebatang kara', '1485054519139', 3),
(12, 1, 4, 'Rocky Gerung: Politik ku', '2285054519139', 3),
(13, 1, 5, 'SmartCity di surabaya', '1485054519139', 3),
(14, 1, 6, 'Mars for Future', '1482254519139', 3),
(15, 1, 7, 'The development of future', '1400054519139', 3),
(16, 1, 8, 'Hallstat city', '1485054519139', 2),
(17, 1, 8, 'National Geographic Travell', '1485054519139', 2),
(18, 1, 2, 'Para Pencari Tuhan', '1485054519290', 3),
(19, 5, 5, 'Lockout', '9785677588257', 9),
(20, 4, 7, 'Brest Fortress (Brestskaya krepost)', '9785319901352', 18),
(21, 14, 8, 'Porky\'s', '9781285890904', 14),
(22, 5, 2, 'Barbarian Queen', '9788646628551', 1),
(23, 15, 1, 'Burning Plain, The', '9780469628137', 19),
(24, 4, 5, 'Prisoners', '9782411098771', 18),
(25, 2, 7, 'Toxic Avenger, The', '9786718929893', 10),
(26, 16, 3, 'Good Earth, The', '9780389281783', 4),
(27, 8, 4, 'Baboona', '9784604055091', 11),
(28, 19, 2, 'Jesus of Nazareth', '9781448739878', 4),
(29, 17, 1, 'Stella Does Tricks', '9870294205360', 8),
(30, 16, 1, 'Time of Roses (Ruusujen aika)', '9870772299000', 8),
(31, 8, 3, 'Disturbing Behavior', '9870929065260', 4),
(32, 9, 8, 'Beautiful Bali', '9870929738192', 4),
(33, 12, 6, 'George The Monkey', '9786718929893', 5),
(34, 15, 7, 'Tiwo Likes to Wake Up Early, Tiwo Likes Vegetables, dan Tiwo’s Piggy Bank.', '9788646628551', 2),
(35, 7, 8, 'Pure Papua', '9870929737123', 3),
(36, 20, 6, 'Harry Potter and the Sorcerer’s Stone', '9780659197260', 5),
(37, 21, 6, 'Harry Potter and the Chamber of Secrets', '9780773729744', 3),
(38, 20, 6, 'Harry Potter and the Prisoner of Azkaban', '9780432372444', 10),
(39, 21, 6, 'Harry Potter and the Goblet of Fire', '9780611508805', 5),
(40, 20, 6, 'Harry Potter and the Order of the Phoenix', '9780760018492', 3),
(41, 22, 6, 'Harry Potter and the Half-Blood Prince', '9780251189608', 10),
(42, 21, 6, 'Harry Potter and the Deathly Hallows', '9780284951063', 4);

-- --------------------------------------------------------

--
-- Table structure for table `data_donasi`
--

CREATE TABLE `data_donasi` (
  `id_donasi` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `jenis` varchar(512) NOT NULL,
  `jumlah` varchar(13) DEFAULT NULL,
  `keterangan` varchar(512) DEFAULT NULL,
  `status` varchar(512) DEFAULT NULL,
  `tanngal_donasi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_donasi`
--

INSERT INTO `data_donasi` (`id_donasi`, `id_member`, `jenis`, `jumlah`, `keterangan`, `status`, `tanngal_donasi`) VALUES
(1, 3, 'Uang', '100000', 'tunai', NULL, '2021-01-13 17:09:42'),
(2, 1, 'Uang', '5000', 'Transfer', NULL, '2021-01-14 14:08:26'),
(3, 19, 'Uang', '5000', 'Transfer', NULL, '2021-01-15 09:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `kode_kategori` int(11) NOT NULL,
  `deskripsi_kategori` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`kode_kategori`, `deskripsi_kategori`) VALUES
(1, 'Poetry'),
(2, 'Religion'),
(3, 'Philosopy'),
(4, 'Politics'),
(5, 'Technology'),
(6, 'Fiction'),
(7, 'Science'),
(8, 'Travel'),
(9, 'History');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_buku`
--

CREATE TABLE `peminjaman_buku` (
  `nomor_peminjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_staff` int(11) DEFAULT NULL,
  `tanggal_peminjaman` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_pengembalian` timestamp NULL DEFAULT NULL,
  `status_peminjaman` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `peminjaman_buku`
--

INSERT INTO `peminjaman_buku` (`nomor_peminjaman`, `id_buku`, `id_member`, `id_staff`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status_peminjaman`) VALUES
(1, 1, 1, 5, '2020-12-21 15:00:17', '2021-01-13 17:14:14', 'returned'),
(2, 3, 2, 1, '2020-12-21 15:00:17', NULL, 'issued'),
(3, 4, 3, 2, '2020-12-21 15:00:17', NULL, 'issued'),
(4, 5, 4, 2, '2020-12-21 15:00:17', NULL, 'issued'),
(5, 6, 5, 1, '2020-12-21 15:00:17', NULL, 'issued'),
(6, 2, 1, 1, '2020-12-21 15:00:17', NULL, 'issued'),
(15, 17, 1, 1, '2021-01-13 17:15:13', NULL, 'issued'),
(16, 23, 1, 3, '2021-01-13 17:12:55', NULL, 'issued'),
(17, 20, 1, 5, '2021-01-11 16:48:04', NULL, 'issued'),
(18, 6, 1, 4, '2021-01-13 17:13:16', '2021-01-13 17:13:42', 'returned'),
(19, 2, 2, 2, '2021-01-13 17:14:28', '2021-01-13 17:14:43', 'returned'),
(20, 16, 1, NULL, '2021-01-14 13:30:22', NULL, 'reserved'),
(21, 10, 1, 1, '2021-01-14 14:11:43', NULL, 'issued'),
(22, 1, 1, 1, '2021-01-14 14:12:36', '2021-01-14 14:13:01', 'returned'),
(24, 32, 1, 2, '2021-01-15 09:32:52', NULL, 'issued'),
(25, 1, 1, 2, '2021-01-15 09:34:04', '2021-01-15 09:35:08', 'returned');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL,
  `nama_penulis` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama_penulis`) VALUES
(1, 'A. Damhoeri'),
(2, 'A. Kembara'),
(3, 'A. Kohar Ibrahim'),
(4, 'Abdul hadi'),
(5, 'Abrar Yusra'),
(6, 'Afrizal Malna'),
(7, 'Agam Wispi'),
(8, 'Ahmad Fuadi'),
(9, 'Akhudiat'),
(10, 'Bustami Narda'),
(11, 'Andrea Hirata'),
(12, 'Pidi Baiq'),
(13, 'Tere Liye'),
(14, 'Dewi lestari'),
(15, 'Asma Nadia'),
(16, 'Raditya Dika'),
(17, 'Ayu Utami'),
(18, 'Ika Natassa'),
(19, 'Eka Kurniawan'),
(20, 'Babe Cabita'),
(21, 'Ernest Hemmingway'),
(22, 'Joan Didion'),
(23, 'Ray Bradbury'),
(24, 'George R.R. Martin'),
(25, 'Ayn Rand'),
(26, 'Gillian Flynn'),
(27, 'Vladimir Nabokov'),
(28, 'Jane Austen'),
(29, 'J. K. Rowling'),
(30, 'Diana Wynne Jones'),
(31, 'penulis baru'),
(32, 'Kezia Belva'),
(33, 'Kezia Belva');

-- --------------------------------------------------------

--
-- Table structure for table `penulis_buku`
--

CREATE TABLE `penulis_buku` (
  `id_buku` int(11) NOT NULL,
  `id_penulis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penulis_buku`
--

INSERT INTO `penulis_buku` (`id_buku`, `id_penulis`) VALUES
(1, 1),
(2, 1),
(8, 1),
(3, 2),
(5, 2),
(1, 3),
(4, 3),
(1, 4),
(7, 4),
(6, 5),
(16, 7),
(31, 7),
(21, 8),
(14, 9),
(9, 10),
(10, 11),
(11, 11),
(27, 11),
(35, 12),
(12, 13),
(13, 15),
(15, 16),
(28, 16),
(18, 17),
(22, 17),
(23, 17),
(19, 18),
(26, 19),
(20, 20),
(33, 20),
(24, 21),
(30, 22),
(29, 23),
(32, 26),
(34, 26),
(17, 28),
(25, 28),
(36, 29),
(37, 29),
(38, 29),
(39, 29),
(40, 29),
(41, 29),
(42, 29);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id_publisher` int(11) NOT NULL,
  `nama_publisher` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id_publisher`, `nama_publisher`) VALUES
(1, 'Gramedia Pustaka Utama'),
(2, 'Elexmedia Komputindo'),
(3, 'Andi'),
(4, 'Gagas Media'),
(5, 'Gramedia Widiasarana Indonesia'),
(6, 'Agro Media'),
(7, 'Erlangga'),
(8, 'Mizan'),
(9, 'Tiga Serangkai'),
(10, 'Bentang Pustaka'),
(11, 'Bumi Aksara'),
(12, 'Persada'),
(13, 'Harper Collines'),
(14, 'Macmillan'),
(15, 'Campbell'),
(16, 'Penguin Random House'),
(17, 'Priddy Books'),
(18, 'Simon & Schuster'),
(19, 'Scholastic'),
(20, 'Bloomsbury Publishing'),
(21, 'Scholastic Press'),
(22, 'Pottermore'),
(25, 'penerbit baru'),
(26, 'Maulida Meirisdina'),
(27, 'Maulida Meirisdina');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(11) NOT NULL,
  `nama_staff` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id_staff`, `nama_staff`) VALUES
(1, 'Ahmad Gumilar'),
(2, 'Yanto Reviesw'),
(3, 'Jarwo Pribadi'),
(4, 'Calvin Simatupang'),
(5, 'Yaskur Rafii'),
(6, 'Prima Secondary');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userip` binary(16) NOT NULL,
  `loginTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-21 16:12:28', '2021-01-15 06:35:40', 1),
(2, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-22 07:03:05', '2021-01-15 06:35:40', 1),
(3, 0, 'abygail@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-22 07:19:52', NULL, 1),
(4, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-22 07:24:40', '2021-01-15 06:35:40', 1),
(5, 0, 'shafiravirdausi@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-22 08:51:34', NULL, 1),
(6, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-22 22:18:48', '2021-01-15 06:35:40', 1),
(7, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-22 23:11:20', '2021-01-15 06:35:40', 1),
(8, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-22 23:14:39', '2021-01-15 06:35:40', 1),
(9, 0, 'percobaan.tkk@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-23 01:22:33', '2020-12-23 01:23:41', 1),
(10, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-23 01:50:49', '2021-01-15 06:35:40', 1),
(11, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-23 02:18:10', '2021-01-15 06:35:40', 1),
(12, 0, 'abygail@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-26 03:15:48', '2020-12-26 03:16:56', 1),
(13, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-26 03:16:59', '2021-01-15 06:35:40', 1),
(14, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-26 12:38:16', '2021-01-15 06:35:40', 1),
(15, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2020-12-26 13:58:41', '2021-01-15 06:35:40', 1),
(16, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-02 02:16:07', '2021-01-15 06:35:40', 1),
(17, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-02 02:32:09', '2021-01-15 06:35:40', 1),
(18, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-02 02:47:21', '2021-01-15 06:35:40', 1),
(19, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-06 15:00:24', '2021-01-15 06:35:40', 1),
(20, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-06 15:36:08', '2021-01-15 06:35:40', 1),
(21, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-07 04:10:18', '2021-01-15 06:35:40', 1),
(22, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-08 07:59:40', '2021-01-15 06:35:40', 1),
(23, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-08 11:41:14', '2021-01-15 06:35:40', 1),
(24, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-08 11:43:07', '2021-01-15 06:35:40', 1),
(25, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-08 11:52:17', '2021-01-15 06:35:40', 1),
(26, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-08 12:13:06', '2021-01-15 06:35:40', 1),
(27, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-11 08:46:51', '2021-01-15 06:35:40', 1),
(28, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-13 16:44:47', '2021-01-15 06:35:40', 1),
(29, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-13 16:46:31', '2021-01-15 06:35:40', 1),
(30, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-13 17:08:00', '2021-01-15 06:35:40', 1),
(31, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-13 17:39:31', '2021-01-15 06:35:40', 1),
(32, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-14 08:50:10', '2021-01-15 06:35:40', 1),
(33, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-14 11:38:44', '2021-01-15 06:35:40', 1),
(34, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-14 12:43:59', '2021-01-15 06:35:40', 1),
(35, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-14 12:57:25', '2021-01-15 06:35:40', 1),
(36, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-14 13:00:29', '2021-01-15 06:35:40', 1),
(37, 0, 'bokuto@fukurodani.ac.jp', 0x3a3a3100000000000000000000000000, '2021-01-14 13:01:06', '2021-01-15 06:05:40', 1),
(38, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-14 13:28:26', '2021-01-15 06:35:40', 1),
(39, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-14 14:04:20', '2021-01-15 06:35:40', 1),
(40, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-15 06:22:05', '2021-01-15 06:35:40', 1),
(41, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-15 06:35:45', NULL, 1),
(42, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-15 06:47:29', '2021-01-15 07:09:19', 1),
(43, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-15 07:17:33', '2021-01-15 07:26:09', 1),
(44, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-15 07:52:10', '2021-01-15 07:58:05', 1),
(45, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-15 07:59:54', '2021-01-15 08:00:58', 1),
(46, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-15 08:59:05', '2021-01-15 08:59:14', 1),
(47, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-15 09:11:49', '2021-01-15 09:21:38', 1),
(48, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-15 17:08:12', NULL, 1),
(49, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-01-29 15:42:21', NULL, 1),
(50, 0, 'ian@gmail.com', 0x3a3a3100000000000000000000000000, '2021-02-01 11:26:38', '2021-02-01 11:34:51', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admlog`
--
ALTER TABLE `admlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `anggota_data_lama`
--
ALTER TABLE `anggota_data_lama`
  ADD PRIMARY KEY (`id_anggota_before`);

--
-- Indexes for table `biaya_langganan`
--
ALTER TABLE `biaya_langganan`
  ADD PRIMARY KEY (`nomor_pembayaran`),
  ADD KEY `id_member` (`id_member`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `kode_kategori` (`kode_kategori`),
  ADD KEY `id_publisher` (`id_publisher`);

--
-- Indexes for table `data_donasi`
--
ALTER TABLE `data_donasi`
  ADD PRIMARY KEY (`id_donasi`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  ADD PRIMARY KEY (`nomor_peminjaman`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_staff` (`id_staff`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indexes for table `penulis_buku`
--
ALTER TABLE `penulis_buku`
  ADD PRIMARY KEY (`id_penulis`,`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id_publisher`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admlog`
--
ALTER TABLE `admlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `anggota_data_lama`
--
ALTER TABLE `anggota_data_lama`
  MODIFY `id_anggota_before` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `biaya_langganan`
--
ALTER TABLE `biaya_langganan`
  MODIFY `nomor_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `data_donasi`
--
ALTER TABLE `data_donasi`
  MODIFY `id_donasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `kode_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  MODIFY `nomor_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id_publisher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `biaya_langganan`
--
ALTER TABLE `biaya_langganan`
  ADD CONSTRAINT `biaya_langganan_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `anggota` (`id_member`);

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori_buku` (`kode_kategori`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_publisher`) REFERENCES `publisher` (`id_publisher`);

--
-- Constraints for table `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  ADD CONSTRAINT `peminjaman_buku_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `peminjaman_buku_ibfk_2` FOREIGN KEY (`id_member`) REFERENCES `anggota` (`id_member`),
  ADD CONSTRAINT `peminjaman_buku_ibfk_3` FOREIGN KEY (`id_staff`) REFERENCES `staff` (`id_staff`);

--
-- Constraints for table `penulis_buku`
--
ALTER TABLE `penulis_buku`
  ADD CONSTRAINT `penulis_buku_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `penulis_buku_ibfk_2` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
