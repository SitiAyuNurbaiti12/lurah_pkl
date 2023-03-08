-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 05:23 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl_lurah`
--

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pg` int(9) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama_pg` varchar(50) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat_pg` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pg`, `nip`, `nama_pg`, `jabatan`, `jk`, `no_hp`, `alamat_pg`) VALUES
(1, '167704202007', 'Basuki Cahyo', 'Staff Utama', 'Laki-laki', '085365760110', 'Martapura');

-- --------------------------------------------------------

--
-- Table structure for table `pemohon`
--

CREATE TABLE `pemohon` (
  `id_pm` int(9) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username_pm` varchar(55) NOT NULL,
  `password_pm` varchar(55) NOT NULL,
  `tp_lahir` varchar(199) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nik` varchar(28) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` varchar(190) NOT NULL,
  `jk_pmh` varchar(20) NOT NULL,
  `agama` varchar(55) NOT NULL,
  `ktp` varchar(200) NOT NULL,
  `kk` varchar(200) NOT NULL,
  `level` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemohon`
--

INSERT INTO `pemohon` (`id_pm`, `nama`, `username_pm`, `password_pm`, `tp_lahir`, `tgl_lahir`, `nik`, `no_hp`, `alamat`, `jk_pmh`, `agama`, `ktp`, `kk`, `level`) VALUES
(2, 'Junaidi', 'junaidi', 'junaidi', 'Banten', '1992-09-15', '000111222777', '081122223333', 'Jl.Utama Jaya Raya', 'Laki-laki', 'Islam', '7368ktpcnth.jpeg', '4656kkcbth.jpg', 'pemohon'),
(3, 'Sofia', 'sofia', 'sofia', 'Subang', '1999-12-16', '222233334444', '081122223333', 'Jl. Sengsara ABC', 'Perempuan', 'Islam', '8521ktpcwk.png', '7254kkcwek.jpg', 'pemohon');

-- --------------------------------------------------------

--
-- Table structure for table `pj_domisili`
--

CREATE TABLE `pj_domisili` (
  `id_pj_dms` int(9) NOT NULL,
  `id_pm` int(9) NOT NULL,
  `pekerjaan_dms` varchar(170) NOT NULL,
  `alamat_dms` varchar(199) NOT NULL,
  `ktp_dms` varchar(199) NOT NULL,
  `kk_dms` varchar(199) NOT NULL,
  `tgl_dms` date NOT NULL,
  `status_dms` varchar(170) NOT NULL,
  `status_surat` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pj_domisili`
--

INSERT INTO `pj_domisili` (`id_pj_dms`, `id_pm`, `pekerjaan_dms`, `alamat_dms`, `ktp_dms`, `kk_dms`, `tgl_dms`, `status_dms`, `status_surat`) VALUES
(4, 2, 'Buruh', 'Jl. Cempaka GG. Muhajirin RT/RW 011/004 Desa Jawa Laut Kec. Martapura Kab. Banjar', '4691ktpcnth.jpeg', '7253kkcbth.jpg', '2022-12-16', 'Disetujui', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pj_kematian`
--

CREATE TABLE `pj_kematian` (
  `id_pjkt` int(9) NOT NULL,
  `id_pm` int(9) NOT NULL,
  `nm_mgl` varchar(75) NOT NULL,
  `jk_mgl` varchar(20) NOT NULL,
  `tmpt_lhr` varchar(150) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `alamat_mgl` varchar(199) NOT NULL,
  `hari_mgl` varchar(15) NOT NULL,
  `tgl_mgl` date NOT NULL,
  `jam_mgl` varchar(9) NOT NULL,
  `jamwilayah` varchar(8) NOT NULL,
  `tmpt_mgl` varchar(88) NOT NULL,
  `makam` varchar(150) NOT NULL,
  `ktp_mgl` varchar(200) NOT NULL,
  `kk_mgl` varchar(200) NOT NULL,
  `tgl_skk` date NOT NULL,
  `status` varchar(120) NOT NULL,
  `status_surat` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pj_kematian`
--

INSERT INTO `pj_kematian` (`id_pjkt`, `id_pm`, `nm_mgl`, `jk_mgl`, `tmpt_lhr`, `tgl_lhr`, `alamat_mgl`, `hari_mgl`, `tgl_mgl`, `jam_mgl`, `jamwilayah`, `tmpt_mgl`, `makam`, `ktp_mgl`, `kk_mgl`, `tgl_skk`, `status`, `status_surat`) VALUES
(2, 2, 'Abdul Majid', 'Laki-laki', 'Martapura', '1969-06-07', 'JL.Keramat RT 05/00 Desa Tungkaran Kec. Martapura Kab. Banjar', 'Selasa', '2011-10-25', '02:55', 'WIB', 'RSUD Ratu Zalecha Martapura', 'Tempat Pemakaman Umum Desa Tungkaran', '9223ktpcnth.jpeg', '6709kkcbth.jpg', '2022-12-13', 'Telah Disetujui', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pj_pindah`
--

CREATE TABLE `pj_pindah` (
  `id_pj_pindah` int(9) NOT NULL,
  `id_pm` int(9) NOT NULL,
  `negara` varchar(50) NOT NULL,
  `status_kawin` varchar(50) NOT NULL,
  `pendidikan_pdh` varchar(50) NOT NULL,
  `alamat_pdh` varchar(195) NOT NULL,
  `alasan_pdh` varchar(185) NOT NULL,
  `pengikut_pdh` varchar(100) NOT NULL,
  `tgl_pdh` date NOT NULL,
  `pengantar_pdh` varchar(199) NOT NULL,
  `status_pdh` varchar(185) NOT NULL,
  `status_surat` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pj_pindah`
--

INSERT INTO `pj_pindah` (`id_pj_pindah`, `id_pm`, `negara`, `status_kawin`, `pendidikan_pdh`, `alamat_pdh`, `alasan_pdh`, `pengikut_pdh`, `tgl_pdh`, `pengantar_pdh`, `status_pdh`, `status_surat`) VALUES
(3, 2, 'Indonesia', 'Belum Kawin', 'SLTP/Sederajat', 'Jl Gotong Royong Ujung RT/RW 004/006 Desa/Kel Mentaos Kota Banjarbaru Provinsi Kalimantan Selatan', 'Pindah Alamat', '0', '2022-12-17', '5503pngtr.jpg', 'Pengajuan Sudah Sesuai dan Disetujui', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pj_tmampu`
--

CREATE TABLE `pj_tmampu` (
  `id_pj_ktm` int(9) NOT NULL,
  `id_pm` int(9) NOT NULL,
  `pekerjaan_ktm` varchar(170) NOT NULL,
  `alamat_ktm` varchar(199) NOT NULL,
  `tujuan_ktm` varchar(175) NOT NULL,
  `tgl_ktm` date NOT NULL,
  `pengantar_ktm` varchar(199) NOT NULL,
  `status_ktm` varchar(170) NOT NULL,
  `status_surat` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pj_tmampu`
--

INSERT INTO `pj_tmampu` (`id_pj_ktm`, `id_pm`, `pekerjaan_ktm`, `alamat_ktm`, `tujuan_ktm`, `tgl_ktm`, `pengantar_ktm`, `status_ktm`, `status_surat`) VALUES
(3, 2, 'Siswa', 'Jl. Padang Anyar RT 7 Desa Tungkaran Kec Martapura Kab Banjar', 'Pondok Pesantren Darussalam Martapura', '2022-12-16', '7757pngtr.jpg', 'ACC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pj_usaha`
--

CREATE TABLE `pj_usaha` (
  `id_pj_ush` int(9) NOT NULL,
  `id_pm` int(9) NOT NULL,
  `pekerjaan` varchar(70) NOT NULL,
  `jenis_ush` varchar(170) NOT NULL,
  `alamat_ush` varchar(180) NOT NULL,
  `tgl_ush` date NOT NULL,
  `pengantar_rt` varchar(200) NOT NULL,
  `status_ush` varchar(150) NOT NULL,
  `status_surat` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pj_usaha`
--

INSERT INTO `pj_usaha` (`id_pj_ush`, `id_pm`, `pekerjaan`, `jenis_ush`, `alamat_ush`, `tgl_ush`, `pengantar_rt`, `status_ush`, `status_surat`) VALUES
(2, 2, 'Jual Minuman dan Makanan', 'Jualan Minuman dan Makanan Ringan', 'Jl. Sejahtera RT 001/001 Desa Tungkaran Martapura Kab. Banjar', '2022-12-15', '8560pngtr.jpg', 'Telah Disetujui', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rg_domisili`
--

CREATE TABLE `rg_domisili` (
  `id_rg_dms` int(9) NOT NULL,
  `id_pj_dms` int(9) NOT NULL,
  `id_pg` int(9) NOT NULL,
  `tgl_rg_dms` date NOT NULL,
  `no_rg_dms` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rg_domisili`
--

INSERT INTO `rg_domisili` (`id_rg_dms`, `id_pj_dms`, `id_pg`, `tgl_rg_dms`, `no_rg_dms`) VALUES
(1, 4, 1, '2022-12-19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `rg_kematian`
--

CREATE TABLE `rg_kematian` (
  `id_rg_kt` int(9) NOT NULL,
  `id_pjkt` int(9) NOT NULL,
  `id_pg` int(9) NOT NULL,
  `tgl_rg_kt` date NOT NULL,
  `no_rg_kt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rg_kematian`
--

INSERT INTO `rg_kematian` (`id_rg_kt`, `id_pjkt`, `id_pg`, `tgl_rg_kt`, `no_rg_kt`) VALUES
(3, 2, 1, '2022-12-18', '1');

-- --------------------------------------------------------

--
-- Table structure for table `rg_pindah`
--

CREATE TABLE `rg_pindah` (
  `id_rg_pindah` int(9) NOT NULL,
  `id_pj_pindah` int(9) NOT NULL,
  `id_pg` int(9) NOT NULL,
  `tgl_rg_pindah` date NOT NULL,
  `no_rg_pindah` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rg_pindah`
--

INSERT INTO `rg_pindah` (`id_rg_pindah`, `id_pj_pindah`, `id_pg`, `tgl_rg_pindah`, `no_rg_pindah`) VALUES
(1, 3, 1, '2022-12-19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `rg_tmampu`
--

CREATE TABLE `rg_tmampu` (
  `id_rg_ktm` int(9) NOT NULL,
  `id_pj_ktm` int(9) NOT NULL,
  `id_pg` int(9) NOT NULL,
  `tgl_rg_ktm` date NOT NULL,
  `no_rg_ktm` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rg_tmampu`
--

INSERT INTO `rg_tmampu` (`id_rg_ktm`, `id_pj_ktm`, `id_pg`, `tgl_rg_ktm`, `no_rg_ktm`) VALUES
(1, 3, 1, '2022-12-19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `rg_usaha`
--

CREATE TABLE `rg_usaha` (
  `id_rg_ush` int(9) NOT NULL,
  `id_pj_ush` int(9) NOT NULL,
  `id_pg` int(9) NOT NULL,
  `tgl_rg_ush` date NOT NULL,
  `no_rg_ush` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rg_usaha`
--

INSERT INTO `rg_usaha` (`id_rg_ush`, `id_pj_ush`, `id_pg`, `tgl_rg_ush`, `no_rg_ush`) VALUES
(1, 2, 1, '2022-12-19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(9) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pg`);

--
-- Indexes for table `pemohon`
--
ALTER TABLE `pemohon`
  ADD PRIMARY KEY (`id_pm`);

--
-- Indexes for table `pj_domisili`
--
ALTER TABLE `pj_domisili`
  ADD PRIMARY KEY (`id_pj_dms`);

--
-- Indexes for table `pj_kematian`
--
ALTER TABLE `pj_kematian`
  ADD PRIMARY KEY (`id_pjkt`);

--
-- Indexes for table `pj_pindah`
--
ALTER TABLE `pj_pindah`
  ADD PRIMARY KEY (`id_pj_pindah`);

--
-- Indexes for table `pj_tmampu`
--
ALTER TABLE `pj_tmampu`
  ADD PRIMARY KEY (`id_pj_ktm`);

--
-- Indexes for table `pj_usaha`
--
ALTER TABLE `pj_usaha`
  ADD PRIMARY KEY (`id_pj_ush`);

--
-- Indexes for table `rg_domisili`
--
ALTER TABLE `rg_domisili`
  ADD PRIMARY KEY (`id_rg_dms`);

--
-- Indexes for table `rg_kematian`
--
ALTER TABLE `rg_kematian`
  ADD PRIMARY KEY (`id_rg_kt`);

--
-- Indexes for table `rg_pindah`
--
ALTER TABLE `rg_pindah`
  ADD PRIMARY KEY (`id_rg_pindah`);

--
-- Indexes for table `rg_tmampu`
--
ALTER TABLE `rg_tmampu`
  ADD PRIMARY KEY (`id_rg_ktm`);

--
-- Indexes for table `rg_usaha`
--
ALTER TABLE `rg_usaha`
  ADD PRIMARY KEY (`id_rg_ush`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pg` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pemohon`
--
ALTER TABLE `pemohon`
  MODIFY `id_pm` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pj_domisili`
--
ALTER TABLE `pj_domisili`
  MODIFY `id_pj_dms` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pj_kematian`
--
ALTER TABLE `pj_kematian`
  MODIFY `id_pjkt` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pj_pindah`
--
ALTER TABLE `pj_pindah`
  MODIFY `id_pj_pindah` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pj_tmampu`
--
ALTER TABLE `pj_tmampu`
  MODIFY `id_pj_ktm` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pj_usaha`
--
ALTER TABLE `pj_usaha`
  MODIFY `id_pj_ush` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rg_domisili`
--
ALTER TABLE `rg_domisili`
  MODIFY `id_rg_dms` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rg_kematian`
--
ALTER TABLE `rg_kematian`
  MODIFY `id_rg_kt` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rg_pindah`
--
ALTER TABLE `rg_pindah`
  MODIFY `id_rg_pindah` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rg_tmampu`
--
ALTER TABLE `rg_tmampu`
  MODIFY `id_rg_ktm` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rg_usaha`
--
ALTER TABLE `rg_usaha`
  MODIFY `id_rg_ush` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
