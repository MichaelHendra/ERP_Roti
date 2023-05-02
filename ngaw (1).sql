-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2023 at 05:39 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngaw`
--

-- --------------------------------------------------------

--
-- Table structure for table `prosemen`
--

CREATE TABLE `prosemen` (
  `id` int(11) NOT NULL,
  `kode_bom_list` int(11) NOT NULL,
  `qty_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prosemen`
--

INSERT INTO `prosemen` (`id`, `kode_bom_list`, `qty_order`) VALUES
(11, 34, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `t_bom`
--

CREATE TABLE `t_bom` (
  `kode_bom` int(11) NOT NULL,
  `kode_produk` varchar(55) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_bom`
--

INSERT INTO `t_bom` (`kode_bom`, `kode_produk`, `tanggal`, `total_harga`) VALUES
(1, '1', '2023-01-10', 990000),
(4, '4', '2023-01-11', 0),
(6, '1234', '2023-01-12', 20000),
(12, '1', '2023-01-12', 90000),
(45, '1', '2023-01-12', NULL),
(97, '12345', '2023-01-12', 20000),
(123, '1234', '2023-01-12', NULL),
(2222, '12345', '2023-01-12', 1800000),
(12345, '1234', '2023-01-12', 200000),
(111111, '11111', '2023-02-26', 110000);

-- --------------------------------------------------------

--
-- Table structure for table `t_bom_list`
--

CREATE TABLE `t_bom_list` (
  `kode_bom_list` int(11) NOT NULL,
  `kode_bom` int(11) NOT NULL,
  `kode_produk` int(11) NOT NULL,
  `qty` int(100) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_bom_list`
--

INSERT INTO `t_bom_list` (`kode_bom_list`, `kode_bom`, `kode_produk`, `qty`, `satuan`) VALUES
(25, 1, 2, 100, 'Gram'),
(26, 1, 3, 45, 'Gram'),
(27, 2, 3, 30, 'Gram'),
(28, 3, 3, 40, 'Gram'),
(34, 12345, 3, 100, 'Gram'),
(35, 6, 3, 10, 'Gram'),
(36, 2222, 2, 200, 'Gram'),
(37, 97, 3, 10, 'Gram'),
(38, 12, 2, 10, 'Gram'),
(39, 111111, 2, 10, 'Gram'),
(40, 111111, 3, 10, 'Gram');

-- --------------------------------------------------------

--
-- Table structure for table `t_mo`
--

CREATE TABLE `t_mo` (
  `kode_mo` int(11) NOT NULL,
  `kode_bom` varchar(55) NOT NULL,
  `qty` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_mo`
--

INSERT INTO `t_mo` (`kode_mo`, `kode_bom`, `qty`, `status`) VALUES
(1, '1', '10', '5'),
(2, '1', '10', '5'),
(3, '1', '20', '5'),
(9, '6', '10', '5'),
(45, '12345', '10', '5'),
(77, '97', '10', '5'),
(123, '12345', '12', '5'),
(1111111, '111111', '10', '5'),
(3444445, '1', '10', '1');

-- --------------------------------------------------------

--
-- Table structure for table `t_produk`
--

CREATE TABLE `t_produk` (
  `kode_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `harga` int(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `qty` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produk`
--

INSERT INTO `t_produk` (`kode_produk`, `nama_produk`, `deskripsi`, `gambar`, `harga`, `status`, `qty`) VALUES
(1, 'Donat', 'Donat Enak', '1673312753_ngaw.jpg', 3000, '1', 10),
(2, 'Tepung Terigu', 'Tepung Terigu', 'placeholder.png', 9000, '2', 48010),
(3, 'Telur', 'telur', 'placeholder.png', 2000, '2', 46310),
(1234, 'keju', 'manis', 'placeholder.png', 12000, '1', 22),
(2222, 'roti', 'coklat', 'placeholder.png', 4000, '2', 0),
(11111, 'DON', 'asdasd', 'placeholder.png', 9000, '1', 10),
(12345, 'Roti', 'RasaCoklat', 'placeholder.png', 5000, '1', 10);

-- --------------------------------------------------------

--
-- Table structure for table `t_rfq`
--

CREATE TABLE `t_rfq` (
  `id_rfq` int(11) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `total_harga` int(50) NOT NULL,
  `pembayaran` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_rfq`
--

INSERT INTO `t_rfq` (`id_rfq`, `id_vendor`, `tanggal`, `status`, `total_harga`, `pembayaran`) VALUES
(1, 1, '2023-01-12', '0', 0, 0),
(6, 80, '2023-04-11', '0', 0, 0),
(8, 1, '2023-02-26', '0', 0, 0),
(29, 1, '2023-02-26', '0', 0, 0),
(80, 1, '2023-04-11', '0', 0, 0),
(101, 1, '2023-02-26', '0', 0, 0),
(1002, 1, '2023-02-26', '0', 0, 0),
(10000, 1, '2023-02-26', '0', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_rfq_list`
--

CREATE TABLE `t_rfq_list` (
  `id_rfq_list` int(11) NOT NULL,
  `id_rfq` int(11) NOT NULL,
  `kode_produk` int(11) NOT NULL,
  `qty` int(50) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_rfq_list`
--

INSERT INTO `t_rfq_list` (`id_rfq_list`, `id_rfq`, `kode_produk`, `qty`, `satuan`) VALUES
(19, 1, 2, 10, 'Gram'),
(20, 1, 3, 10, 'Gram'),
(21, 2, 2, 100, 'Gram');

-- --------------------------------------------------------

--
-- Table structure for table `t_sq`
--

CREATE TABLE `t_sq` (
  `id_sq` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `status` int(11) NOT NULL,
  `total_harga` int(50) NOT NULL,
  `metode_pembayaran` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_sq`
--

INSERT INTO `t_sq` (`id_sq`, `id_pelanggan`, `tanggal_transaksi`, `status`, `total_harga`, `metode_pembayaran`) VALUES
(1, 3, '2023-01-11', 3, 30000, 2),
(2, 3, '2023-01-11', 3, 30000, 2),
(6, 3, '2023-02-26', 0, 90000, 0),
(7, 3, '2023-01-12', 1, 30000, 0),
(69, 3, '2023-01-12', 3, 120000, 1),
(9999, 3, '2023-03-22', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_sq_list`
--

CREATE TABLE `t_sq_list` (
  `id_sq_list` int(11) NOT NULL,
  `id_sq` int(11) NOT NULL,
  `kode_produk` int(11) NOT NULL,
  `qty` int(100) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_sq_list`
--

INSERT INTO `t_sq_list` (`id_sq_list`, `id_sq`, `kode_produk`, `qty`, `satuan`) VALUES
(8, 1, 1, 10, 'pcs'),
(9, 2, 1, 10, 'pcs'),
(10, 69, 1234, 10, 'pcs'),
(11, 7, 1, 10, 'pcs'),
(12, 6, 11111, 10, 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `t_vendor`
--

CREATE TABLE `t_vendor` (
  `id_vendor` int(11) NOT NULL,
  `nama_vendor` varchar(55) NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_vendor`
--

INSERT INTO `t_vendor` (`id_vendor`, `nama_vendor`, `telpon`, `alamat`, `status`) VALUES
(1, 'Tedung', '1081684811', '123123', '1'),
(2, 'eka', '1081684811', 'asdas', '1'),
(3, 'eko', '1081684811', 'asd', '2'),
(80, 'ng', '122336', 'asdas', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prosemen`
--
ALTER TABLE `prosemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_bom`
--
ALTER TABLE `t_bom`
  ADD PRIMARY KEY (`kode_bom`);

--
-- Indexes for table `t_bom_list`
--
ALTER TABLE `t_bom_list`
  ADD PRIMARY KEY (`kode_bom_list`);

--
-- Indexes for table `t_mo`
--
ALTER TABLE `t_mo`
  ADD PRIMARY KEY (`kode_mo`);

--
-- Indexes for table `t_produk`
--
ALTER TABLE `t_produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indexes for table `t_rfq`
--
ALTER TABLE `t_rfq`
  ADD PRIMARY KEY (`id_rfq`);

--
-- Indexes for table `t_rfq_list`
--
ALTER TABLE `t_rfq_list`
  ADD PRIMARY KEY (`id_rfq_list`);

--
-- Indexes for table `t_sq`
--
ALTER TABLE `t_sq`
  ADD PRIMARY KEY (`id_sq`);

--
-- Indexes for table `t_sq_list`
--
ALTER TABLE `t_sq_list`
  ADD PRIMARY KEY (`id_sq_list`);

--
-- Indexes for table `t_vendor`
--
ALTER TABLE `t_vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prosemen`
--
ALTER TABLE `prosemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_bom_list`
--
ALTER TABLE `t_bom_list`
  MODIFY `kode_bom_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `t_rfq`
--
ALTER TABLE `t_rfq`
  MODIFY `id_rfq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10001;

--
-- AUTO_INCREMENT for table `t_rfq_list`
--
ALTER TABLE `t_rfq_list`
  MODIFY `id_rfq_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `t_sq`
--
ALTER TABLE `t_sq`
  MODIFY `id_sq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;

--
-- AUTO_INCREMENT for table `t_sq_list`
--
ALTER TABLE `t_sq_list`
  MODIFY `id_sq_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
