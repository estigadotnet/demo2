-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 06, 2020 at 02:27 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ga`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_destination`
--

CREATE TABLE `t_destination` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_destination`
--

INSERT INTO `t_destination` (`id`, `Nama`) VALUES
(1, 'Tujuan-1'),
(2, 'Tujuan-2'),
(3, 'Tujuan-3'),
(4, 'Tujuan-4'),
(5, 'Tujuan-5'),
(6, 'Tujuan-6'),
(7, 'Tujuan-7'),
(8, 'Tujuan-8');

-- --------------------------------------------------------

--
-- Table structure for table `t_distribusi`
--

CREATE TABLE `t_distribusi` (
  `id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `Jarak` float(14,2) NOT NULL,
  `Rate_O` float(14,2) NOT NULL,
  `Rate_D` float(14,2) NOT NULL,
  `Demand` float(14,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_distribusi`
--

INSERT INTO `t_distribusi` (`id`, `source_id`, `destination_id`, `Jarak`, `Rate_O`, `Rate_D`, `Demand`) VALUES
(1, 1, 1, 2000.00, 400.00, 250.00, 2000000.00),
(2, 2, 1, 2200.00, 450.00, 300.00, 2000000.00),
(3, 3, 1, 2500.00, 500.00, 350.00, 2000000.00),
(4, 4, 1, 1950.00, 550.00, 250.00, 2000000.00),
(5, 5, 1, 1850.00, 600.00, 400.00, 2000000.00),
(6, 6, 1, 1600.00, 350.00, 250.00, 2000000.00),
(7, 7, 1, 2250.00, 450.00, 200.00, 2000000.00),
(8, 8, 1, 1800.00, 500.00, 300.00, 2000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t_kapal`
--

CREATE TABLE `t_kapal` (
  `id` int(11) NOT NULL,
  `kapal_id` int(11) NOT NULL,
  `Payload` float(14,2) NOT NULL,
  `DischRate` float(14,2) NOT NULL,
  `TCH` float(14,2) NOT NULL,
  `VarCost` float(14,2) NOT NULL,
  `VsLaden` float(14,2) NOT NULL,
  `VsBallast` float(14,2) NOT NULL,
  `ComDay` float(14,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kapal`
--

INSERT INTO `t_kapal` (`id`, `kapal_id`, `Payload`, `DischRate`, `TCH`, `VarCost`, `VsLaden`, `VsBallast`, `ComDay`) VALUES
(1, 1, 9000.00, 1200.00, 11348.00, 3700.00, 12.50, 13.00, 330.00),
(2, 2, 12000.00, 1300.00, 16800.00, 5500.00, 12.50, 13.00, 330.00),
(3, 3, 15000.00, 1500.00, 22800.00, 7500.00, 13.00, 13.50, 330.00),
(4, 6, 15000.00, 1500.00, 22800.00, 7500.00, 13.00, 13.50, 330.00),
(5, 7, 9000.00, 1200.00, 11348.00, 3700.00, 12.50, 13.00, 330.00);

-- --------------------------------------------------------

--
-- Table structure for table `t_kapal0`
--

CREATE TABLE `t_kapal0` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kapal0`
--

INSERT INTO `t_kapal0` (`id`, `Nama`) VALUES
(1, 'Kapal 1'),
(2, 'Kapal 2'),
(3, 'Kapal 3');

-- --------------------------------------------------------

--
-- Table structure for table `t_operator`
--

CREATE TABLE `t_operator` (
  `id` int(11) NOT NULL,
  `Generasi` tinyint(4) NOT NULL,
  `Populasi` tinyint(4) NOT NULL,
  `Seleksi` float(4,2) NOT NULL,
  `CO` float(4,2) NOT NULL,
  `Mutasi` float(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_operator`
--

INSERT INTO `t_operator` (`id`, `Generasi`, `Populasi`, `Seleksi`, `CO`, `Mutasi`) VALUES
(1, 10, 10, 0.60, 0.20, 0.30);

-- --------------------------------------------------------

--
-- Table structure for table `t_parameter`
--

CREATE TABLE `t_parameter` (
  `id` int(11) NOT NULL,
  `Parameter` text NOT NULL,
  `Nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_parameter`
--

INSERT INTO `t_parameter` (`id`, `Parameter`, `Nilai`) VALUES
(1, 'Demand', '2000000'),
(2, 'Metode Perhitungan', 'max');

-- --------------------------------------------------------

--
-- Table structure for table `t_proses`
--

CREATE TABLE `t_proses` (
  `id` int(11) NOT NULL,
  `Generasi` tinyint(4) NOT NULL,
  `Kromosom` text NOT NULL,
  `TotalCost` float(14,2) NOT NULL,
  `TotalCargo` float(14,2) NOT NULL,
  `Fitness` double(9,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_proses`
--

INSERT INTO `t_proses` (`id`, `Generasi`, `Kromosom`, `TotalCost`, `TotalCargo`, `Fitness`) VALUES
(2664, 1, 'a:24:{i:0;d:0.76;i:1;s:4:\"0.42\";i:2;s:4:\"0.12\";i:3;s:4:\"0.55\";i:4;s:4:\"0.77\";i:5;s:4:\"0.23\";i:6;d:0.56;i:7;s:4:\"0.29\";i:8;s:4:\"0.15\";i:9;d:0.89;i:10;s:4:\"0.95\";i:11;s:4:\"0.00\";i:12;s:4:\"0.77\";i:13;s:4:\"0.50\";i:14;d:0.53;i:15;s:4:\"0.62\";i:16;s:4:\"0.50\";i:17;s:4:\"0.67\";i:18;d:0.4;i:19;d:0.61;i:20;d:0.42;i:21;d:0.06999999999999999;i:22;s:4:\"0.19\";i:23;s:4:\"0.19\";}', 159326592.00, 2660850.00, 0.6173318),
(2665, 2, 'a:24:{i:0;d:0.09;i:1;s:4:\"0.32\";i:2;d:0.63;i:3;d:0.6;i:4;s:4:\"0.00\";i:5;d:0.24000000000000002;i:6;d:0.56;i:7;d:0.3;i:8;d:0.17;i:9;d:0.89;i:10;s:4:\"0.95\";i:11;d:0.01;i:12;d:0.78;i:13;s:4:\"0.50\";i:14;d:0.53;i:15;d:0.64;i:16;s:4:\"0.50\";i:17;s:4:\"0.67\";i:18;s:4:\"0.39\";i:19;d:0.62;i:20;s:4:\"0.41\";i:21;s:4:\"0.06\";i:22;d:0.21000000000000002;i:23;d:0.21000000000000002;}', 152259744.00, 2509980.00, 0.6461212),
(2666, 3, 'a:24:{i:0;d:0.09;i:1;d:0.33;i:2;d:0.64;i:3;d:0.6;i:4;d:0.01;i:5;d:0.24000000000000002;i:6;s:4:\"0.55\";i:7;s:4:\"0.29\";i:8;d:0.17;i:9;d:0.89;i:10;d:0.96;i:11;s:4:\"0.00\";i:12;s:4:\"0.77\";i:13;d:0.51;i:14;d:0.53;i:15;d:0.64;i:16;d:0.51;i:17;s:4:\"0.67\";i:18;s:4:\"0.39\";i:19;d:0.61;i:20;s:4:\"0.41\";i:21;s:4:\"0.06\";i:22;d:0.2;i:23;d:0.2;}', 150799456.00, 2334840.00, 0.6530216),
(2667, 4, 'a:24:{i:0;d:0.09;i:1;d:0.33;i:2;d:0.64;i:3;d:0.6;i:4;d:0.01;i:5;d:0.24000000000000002;i:6;s:4:\"0.55\";i:7;s:4:\"0.29\";i:8;d:0.17;i:9;d:0.89;i:10;d:0.96;i:11;s:4:\"0.00\";i:12;s:4:\"0.77\";i:13;d:0.51;i:14;d:0.53;i:15;d:0.64;i:16;d:0.51;i:17;s:4:\"0.67\";i:18;s:4:\"0.39\";i:19;d:0.61;i:20;s:4:\"0.41\";i:21;s:4:\"0.06\";i:22;d:0.2;i:23;d:0.2;}', 150799456.00, 2334840.00, 0.6530216),
(2668, 5, 'a:24:{i:0;d:0.09;i:1;d:0.33;i:2;d:0.64;i:3;d:0.6;i:4;d:0.01;i:5;d:0.24000000000000002;i:6;s:4:\"0.55\";i:7;s:4:\"0.29\";i:8;d:0.17;i:9;d:0.89;i:10;d:0.96;i:11;s:4:\"0.00\";i:12;s:4:\"0.77\";i:13;d:0.51;i:14;d:0.53;i:15;d:0.64;i:16;d:0.51;i:17;s:4:\"0.67\";i:18;s:4:\"0.39\";i:19;d:0.61;i:20;s:4:\"0.41\";i:21;s:4:\"0.06\";i:22;d:0.2;i:23;d:0.2;}', 150799456.00, 2334840.00, 0.6530216),
(2669, 6, 'a:24:{i:0;d:0.09;i:1;d:0.33;i:2;d:0.64;i:3;d:0.6;i:4;d:0.01;i:5;d:0.24000000000000002;i:6;s:4:\"0.55\";i:7;s:4:\"0.29\";i:8;d:0.17;i:9;d:0.89;i:10;d:0.96;i:11;s:4:\"0.00\";i:12;s:4:\"0.77\";i:13;d:0.51;i:14;d:0.53;i:15;d:0.64;i:16;d:0.51;i:17;s:4:\"0.67\";i:18;s:4:\"0.39\";i:19;d:0.61;i:20;s:4:\"0.41\";i:21;s:4:\"0.06\";i:22;d:0.2;i:23;d:0.2;}', 150799456.00, 2334840.00, 0.6530216),
(2670, 7, 'a:24:{i:0;d:0.09;i:1;d:0.33;i:2;d:0.64;i:3;d:0.6;i:4;d:0.01;i:5;d:0.24000000000000002;i:6;s:4:\"0.55\";i:7;s:4:\"0.29\";i:8;d:0.17;i:9;d:0.89;i:10;d:0.96;i:11;s:4:\"0.00\";i:12;s:4:\"0.77\";i:13;d:0.51;i:14;d:0.53;i:15;d:0.64;i:16;d:0.51;i:17;s:4:\"0.67\";i:18;s:4:\"0.39\";i:19;d:0.61;i:20;s:4:\"0.41\";i:21;s:4:\"0.06\";i:22;d:0.2;i:23;d:0.2;}', 150799456.00, 2334840.00, 0.6530216),
(2671, 8, 'a:24:{i:0;d:0.09;i:1;d:0.33;i:2;d:0.64;i:3;d:0.6;i:4;d:0.01;i:5;d:0.24000000000000002;i:6;s:4:\"0.55\";i:7;s:4:\"0.29\";i:8;d:0.17;i:9;d:0.89;i:10;d:0.96;i:11;s:4:\"0.00\";i:12;s:4:\"0.77\";i:13;d:0.51;i:14;d:0.53;i:15;d:0.64;i:16;d:0.51;i:17;s:4:\"0.67\";i:18;s:4:\"0.39\";i:19;d:0.61;i:20;s:4:\"0.41\";i:21;s:4:\"0.06\";i:22;d:0.2;i:23;d:0.2;}', 150799456.00, 2334840.00, 0.6530216),
(2672, 9, 'a:24:{i:0;d:0.09;i:1;d:0.33;i:2;d:0.64;i:3;d:0.6;i:4;d:0.01;i:5;d:0.24000000000000002;i:6;s:4:\"0.55\";i:7;s:4:\"0.29\";i:8;d:0.17;i:9;d:0.89;i:10;d:0.96;i:11;s:4:\"0.00\";i:12;s:4:\"0.77\";i:13;d:0.51;i:14;d:0.53;i:15;d:0.64;i:16;d:0.51;i:17;s:4:\"0.67\";i:18;s:4:\"0.39\";i:19;d:0.61;i:20;s:4:\"0.41\";i:21;s:4:\"0.06\";i:22;d:0.2;i:23;d:0.2;}', 150799456.00, 2334840.00, 0.6530216),
(2673, 10, 'a:24:{i:0;d:0.09;i:1;d:0.33;i:2;d:0.64;i:3;d:0.6;i:4;d:0.01;i:5;d:0.24000000000000002;i:6;s:4:\"0.55\";i:7;s:4:\"0.29\";i:8;d:0.17;i:9;d:0.89;i:10;d:0.96;i:11;s:4:\"0.00\";i:12;s:4:\"0.77\";i:13;d:0.51;i:14;d:0.53;i:15;d:0.64;i:16;d:0.51;i:17;s:4:\"0.67\";i:18;s:4:\"0.39\";i:19;d:0.61;i:20;s:4:\"0.41\";i:21;s:4:\"0.06\";i:22;d:0.2;i:23;d:0.2;}', 150799456.00, 2334840.00, 0.6530216);

-- --------------------------------------------------------

--
-- Table structure for table `t_source`
--

CREATE TABLE `t_source` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_source`
--

INSERT INTO `t_source` (`id`, `Nama`) VALUES
(1, 'Asal-1'),
(2, 'Asal-2'),
(3, 'Asal-3'),
(4, 'Asal-4'),
(5, 'Asal-5'),
(6, 'Asal-6'),
(7, 'Asal-7'),
(8, 'Asal-8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_destination`
--
ALTER TABLE `t_destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_distribusi`
--
ALTER TABLE `t_distribusi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_kapal`
--
ALTER TABLE `t_kapal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_kapal0`
--
ALTER TABLE `t_kapal0`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_operator`
--
ALTER TABLE `t_operator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_parameter`
--
ALTER TABLE `t_parameter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_proses`
--
ALTER TABLE `t_proses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_source`
--
ALTER TABLE `t_source`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_destination`
--
ALTER TABLE `t_destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_distribusi`
--
ALTER TABLE `t_distribusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_kapal`
--
ALTER TABLE `t_kapal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_kapal0`
--
ALTER TABLE `t_kapal0`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_operator`
--
ALTER TABLE `t_operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_parameter`
--
ALTER TABLE `t_parameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_proses`
--
ALTER TABLE `t_proses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2674;

--
-- AUTO_INCREMENT for table `t_source`
--
ALTER TABLE `t_source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
