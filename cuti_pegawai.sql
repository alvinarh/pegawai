-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2023 at 05:43 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cuti_pegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` char(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `nama`, `password`, `role`) VALUES
('1', 'admin@gmail.com', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ket_cuti`
--

CREATE TABLE `ket_cuti` (
  `id` int(10) NOT NULL,
  `keterangan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ket_cuti`
--

INSERT INTO `ket_cuti` (`id`, `keterangan`) VALUES
(1, 'Cuti Sakit < 14'),
(2, 'Cuti Sakit > 14 '),
(3, 'Cuti Melahirkan'),
(4, 'Cuti Alasan Penting');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_cuti`
--

CREATE TABLE `permohonan_cuti` (
  `id_cuti` int(10) NOT NULL,
  `kode_pegawai` char(20) NOT NULL,
  `nik` varchar(150) DEFAULT NULL,
  `nama` varchar(150) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `mulai_cuti` date NOT NULL,
  `akhir_cuti` date NOT NULL,
  `surat_dokter` varchar(255) NOT NULL,
  `surat_dokter14` varchar(255) NOT NULL,
  `surat_melahirkan` varchar(255) NOT NULL,
  `surat_alasanpenting` varchar(255) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `verifikasi` int(10) NOT NULL,
  `perihal` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permohonan_cuti`
--

INSERT INTO `permohonan_cuti` (`id_cuti`, `kode_pegawai`, `nik`, `nama`, `tanggal_pengajuan`, `mulai_cuti`, `akhir_cuti`, `surat_dokter`, `surat_dokter14`, `surat_melahirkan`, `surat_alasanpenting`, `keterangan`, `verifikasi`, `perihal`, `status`) VALUES
(68, 'PGW-2023-00018', '3203011309980001', 'Bintari Setiawati', '2023-01-11', '2023-01-12', '2023-01-13', 'surat-dokterPGW-2023-00019-11-01-2023.pdf', '', '', '', 'Cuti Sakit < 14', 1, 'Sakit Flu', 0),
(69, 'PGW-2023-00019', '3325050716002', 'Nurul Arlin ', '2023-01-11', '2023-02-20', '2023-01-12', '', '', 'surat-melahirkanPGW-2023-00020-11-01-2023.pdf', '', 'Cuti Melahirkan', 2, '', 0),
(70, 'PGW-2023-00019', '3325050716002', 'Nurul Arlin ', '2023-01-11', '2023-01-12', '2023-01-13', 'surat-dokterPGW-2023-00020-11-01-2023.pdf', '', '', '', 'Cuti Sakit < 14', 3, 'Sakit Flu', 0),
(80, 'PGW-2023-00002', '3325080504910003', 'Cahya Ayu Ningrum', '2023-01-14', '2023-01-14', '2023-01-17', 'surat-dokter14PGW-2023-00020-14-01-20233.pdf', '', '', '', 'Cuti Sakit < 14', 1, 'sa', 1),
(81, 'PGW-2023-00002', '3325080504910003', 'Cahya Ayu Ningrum', '2023-01-14', '2023-01-14', '2023-01-17', 'surat-dokter14PGW-2023-00020-14-01-20234.pdf', '', '', '', 'Cuti Sakit > 14', 3, 'Flu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pimpinan`
--

CREATE TABLE `pimpinan` (
  `kode_pimpinan` char(20) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(120) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pimpinan`
--

INSERT INTO `pimpinan` (`kode_pimpinan`, `nama`, `jabatan`, `email`, `password`, `no_telp`, `role`) VALUES
('1', 'pimpinan', 'Setwan', 'pimpinan@gmail.com', 'pimpinan', '082345432334', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kode_pegawai` char(20) NOT NULL,
  `nik` varchar(150) DEFAULT NULL,
  `nama` varchar(150) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `jenis_kel` char(10) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(120) NOT NULL,
  `status` varchar(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_pegawai`, `nik`, `nama`, `jabatan`, `jenis_kel`, `no_telp`, `alamat`, `email`, `password`, `status`, `role`) VALUES
('PGW-2023-00002', '3325080504910003', 'Cahya Ayu Ningrum', 'Staff Humas', 'Perempuan', '085747224694', 'Jl. Rambutan No. 18 A', 'cahyaayu@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00004', '3404075103910008', 'Dwi Nugrahini Tri Kusuma Ningrum', 'Staff Umum', 'Perempuan', '081225174477', 'Jl. Singosari Raya ', 'hini@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00005', '3203012503990001', 'Ayuandani Dwi Purnama', 'Staff Persidangan', 'Perempuan', '081344765665', 'Jl. Bulustalan V', 'ayuandani@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00006', '3371025812950001', 'Karlinda Alicia R', 'Staff Humas', 'Perempuan', '089887223566', 'Jl. Pleburan Raya ', 'alicia@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00007', '3325012307970001', 'Setyo Herlambang', 'Staff Keuangan', 'Laki-Laki', '081325443765', 'Jl. Randusari', 'tyok@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00008', '3325081105970003', 'Azhar Alhadi', 'Staff Perlengkapan', 'Laki-Laki', '082322565778', 'Jl. Fatmawati', 'azhar@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00010', '3325010305980001', 'Priskilla Candra Cahyaningtyas', 'Staff Humas', 'Perempuan', '082322454443', 'Jl. Erlangga ', 'tyas@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00011', '3205080710910003', 'Mentari Amanda Titisari', 'Staff Humas', 'Perempuan', '081233454996', 'Jl. Menoreh Raya', 'mentari@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00012', '3203010111890001', 'Rafdan Rahinnaya', 'Staff Humas', 'Laki-Laki', '082334789889', 'Jl. Mataram', 'rafdan@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00013', '3404070612910003', 'Choirul Amin', 'Staff Perlengkapan', 'Laki-Laki', '082322454334', 'Jl. Ketileng Indah', 'amin@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00014', '3325081206870002', 'Decky Eko Supriyanto', 'Staff Perlengkapan', 'Laki-Laki', '087655454558', 'Jl. Majapahit', 'decky@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00015', '3205082512920003', 'Evi Rahmawati', 'Staff Keuangan', 'Perempuan', '082324544829', 'Jl. Plamongan Indah', 'evi@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00016', '3574020206980003', 'Antonius George Raynaldi Eka B. P.', 'Staff Humas', 'Laki-Laki', '082322543776', 'Jl. Sadewa VII ', 'antonius@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00017', '3325082612940003', 'Diana Sulistiana', 'Staff Humas', 'Perempuan', '082322456776', 'Jl. Sriwijaya', 'diana@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00018', '3203011309980001', 'Bintari Setiawati', 'Staff Keuangan', 'Perempuan', '081233667455', 'Jl. Kedungmundu', 'bintari@gmail.com', 'user', 'Aktif', 3),
('PGW-2023-00019', '3325050716002', 'Nurul Arlin ', 'Staff Humas', 'Perempuan', '082322724529', 'Jl. Kusumawardani V K41', 'nurul@gmail.com', 'user', 'Aktif', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `ket_cuti`
--
ALTER TABLE `ket_cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permohonan_cuti`
--
ALTER TABLE `permohonan_cuti`
  ADD PRIMARY KEY (`id_cuti`);

--
-- Indexes for table `pimpinan`
--
ALTER TABLE `pimpinan`
  ADD PRIMARY KEY (`kode_pimpinan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kode_pegawai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ket_cuti`
--
ALTER TABLE `ket_cuti`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permohonan_cuti`
--
ALTER TABLE `permohonan_cuti`
  MODIFY `id_cuti` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
