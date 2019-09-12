-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Des 2018 pada 00.36
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl_satpolpp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_aduan`
--

CREATE TABLE `tb_aduan` (
  `aduan_id` varchar(15) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `pos_id` varchar(15) NOT NULL,
  `aduan_lokasi` varchar(50) NOT NULL,
  `aduan_keterangan` text NOT NULL,
  `aduan_tgl` date NOT NULL,
  `aduan_foto` text,
  `aduan_status` int(1) NOT NULL DEFAULT '0',
  `aduan_cek` enum('tolak','terima','sukses') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_aduan`
--

INSERT INTO `tb_aduan` (`aduan_id`, `user_id`, `pos_id`, `aduan_lokasi`, `aduan_keterangan`, `aduan_tgl`, `aduan_foto`, `aduan_status`, `aduan_cek`) VALUES
('ADU001', 'MAS004', 'POS001', 'Jalan Raya dari barat Pengadilan Agama sampai SMA ', 'Tanah berceceran di jalanan menggangu pengguna jalan', '2017-01-13', '', 1, 'sukses'),
('ADU002', 'MAS002', 'POS007', 'Perempatan lampu merah di Kudus', 'Anak jalanan ngamen yang bila tidak dikasih menggores body mobil', '2017-01-18', '', 1, 'sukses'),
('ADU003', 'MAS003', 'POS002', ' Ruas jalan R. Agil Kusumadya ', 'Bahan bangunan yang berceceran di trotoar sehingga menutup jalan', '2017-02-28', '5c1260a31909a.jpg', 1, 'sukses'),
('ADU004', 'MAS004', 'POS006', 'Emperan Toko Sekitar menara', 'banyak yang tidur di emperan toko', '2017-03-01', '5c1263cd62da4.jpg', 1, 'sukses'),
('ADU005', 'MAS001', 'POS002', 'cafe cadal jati wetan', 'Tempat karoeke yang masih buka di malam hari', '2017-04-14', '5c12672e7b625.jpg', 1, 'sukses'),
('ADU006', 'MAS005', 'POS009', 'Klumpit Gebog', 'Penambangan Galian C Ilegal', '2017-06-09', '5c1279d711b89.jpg', 1, 'sukses'),
('ADU007', 'MAS006', 'POS002', 'Rumah Sehat  Cenara Jati', 'Panti pijat yang melayani pijat plus-plus', '2017-06-22', '5c127e8ee7da8.jpg', 1, 'sukses'),
('ADU008', 'MAS006', 'POS009', 'Warung Mbah jo Besito Gebog', 'Penjualan Miras', '2017-07-05', '', 1, 'sukses'),
('ADU009', 'MAS007', 'POS002', 'Kawasan PLN ke Timur', 'Terdapat Waria dan PSK mangkal', '2017-07-07', '5c1283523ca5c.jpg', 1, 'sukses'),
('ADU010', 'MAS008', 'POS004', 'Desa kalirejo Undaan', 'Penjualan miras yang meresahkan warga setempat', '2017-07-10', '', 1, 'sukses'),
('ADU011', 'MAS008', 'POS007', 'Hongosoco Jekulo', 'Pembangunan Tower yang tidak berizin', '2018-12-14', '5c137f2d3c31f.jpg', 1, 'sukses'),
('ADU012', 'MAS002', 'POS005', 'Warung Kopi Barongan belakang Toko Obet ', 'Siswa yang bolos pada jam sekolah', '2018-12-14', '', 1, 'sukses'),
('ADU013', 'MAS002', 'POS009', 'Perempatan Panjang', 'Pencopetan atau penjambretan', '2018-12-15', '', 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_coba`
--

CREATE TABLE `tb_coba` (
  `id` int(11) DEFAULT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_coba`
--

INSERT INTO `tb_coba` (`id`, `nama`, `telepon`) VALUES
(1, 'agung', '081262711'),
(2, 'dina', '08127181');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_desa`
--

CREATE TABLE `tb_desa` (
  `desa_id` varchar(15) NOT NULL,
  `kecamatan_id` varchar(15) NOT NULL,
  `desa_nama` varchar(50) NOT NULL,
  `desa_lat` double NOT NULL,
  `desa_long` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_desa`
--

INSERT INTO `tb_desa` (`desa_id`, `kecamatan_id`, `desa_nama`, `desa_lat`, `desa_long`) VALUES
('DES001', 'KEC001', 'Wergu Wetan', -6.81415085987584, 110.84883741271972),
('DES002', 'KEC001', 'Demaan', -6.8037533703265005, 110.83360246551513),
('DES003', 'KEC002', 'Undaan Lor', -6.874762872222637, 110.81830314529418),
('DES004', 'KEC001', 'Kerjasan', -6.805170254596959, 110.83329669368743),
('DES005', 'KEC003', 'Piji', -6.755001488344177, 110.85922292602538),
('DES006', 'KEC001', 'Wergu Kulon', -6.81251028735749, 110.84368757141112),
('DES007', 'KEC001', 'Barongan', -6.7985545411100246, 110.84727100265502),
('DES008', 'KEC002', 'Undaan Kidul', -6.890889268354029, 110.80978444946288),
('DES009', 'KEC004', 'Kedungdowo', -6.793291734582647, 110.79587987792968),
('DES010', 'KEC004', 'Prambatan Lor', -6.803114173046621, 110.81660798919677),
('DES011', 'KEC005', 'Klaling', -6.807482004166642, 110.92454007995605),
('DES012', 'KEC005', 'Hadipolo', -6.803071559864379, 110.90909055603026),
('DES013', 'KEC003', 'Lau', -6.7189031771062515, 110.87686113250732),
('DES014', 'KEC006', 'Gondosari', -6.738220582801784, 110.84127358329772),
('DES015', 'KEC006', 'Besito', -6.755896453634505, 110.84325841796874);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hasil_aduan`
--

CREATE TABLE `tb_hasil_aduan` (
  `hasil_id` varchar(15) NOT NULL,
  `aduan_id` varchar(10) NOT NULL,
  `pelanggaran_id` varchar(10) NOT NULL,
  `hasil_penanganan` text NOT NULL,
  `hasil_hasil` text NOT NULL,
  `hasil_foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_hasil_aduan`
--

INSERT INTO `tb_hasil_aduan` (`hasil_id`, `aduan_id`, `pelanggaran_id`, `hasil_penanganan`, `hasil_hasil`, `hasil_foto`) VALUES
('2018-HSL001', 'ADU001', 'PEL004', 'Melakukan tindak lanjut bersama Kepala Desa Dersalam, Babinsa, Babinkamtibmas', 'penyegelan proyek tersebut dengan memasang Satpol PP line', '5c1201dde2976.jpg'),
('2018-HSL002', 'ADU002', 'PEL003', 'Penertiban dan pembinaan', 'Berkurangnya anak jalanan yang mengamen di perempatan lampu merah', '5c12055e7642e.jpg'),
('2018-HSL003', 'ADU003', 'PEL004', 'Diberi peringatan', 'Trotoar bersih dari bahan bangunan', '5c1261a44c7b1.jpg'),
('2018-HSL004', 'ADU004', 'PEL003', 'Dibawa ke kantor satpol pp', 'Didata dan dibina', '5c1264748db6e.jpg'),
('2018-HSL005', 'ADU005', 'PEL001', 'Ditindak lanjuti', 'Disegel dan ditutup', '5c12676f0bbc9.jpg'),
('2018-HSL006', 'ADU006', 'PEL001', 'Diberi Surat Peringatan', 'Ditertibkan', '5c127ad799623.jpg'),
('2018-HSL007', 'ADU007', 'PEL002', 'Diberi surat pernyataan ', 'Diteribkan ', '5c127fbd28076.jpg'),
('2018-HSL008', 'ADU008', 'PEL002', 'Ditertibkan dan Penyitaan ', 'Berkurangnya penjual miras', '5c1280c72620c.jpg'),
('2018-HSL009', 'ADU009', 'PEL002', 'Diberi pembinaan', 'Berkurangnya Waria dan PSK di daerah tersebut', '5c1285dc2ade2.jpg'),
('2018-HSL010', 'ADU010', 'PEL002', 'Didata dan Disita miras tersebut', 'Ditertibkan', '5c12862658565.jpg'),
('2018-HSL011', 'ADU011', 'PEL004', 'Diberi peringatan untuk mengurus izin bangun', 'Penutupan sementara ', '5c137fa36df10.jpg'),
('2018-HSL012', 'ADU012', 'PEL005', 'Dibawa ke kantor untuk dibina', 'Siswa berjanji tidak bolos lagi', '5c139f2e6d6e7.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kecamatan`
--

CREATE TABLE `tb_kecamatan` (
  `kecamatan_id` varchar(15) NOT NULL,
  `kecamatan_nama` varchar(50) NOT NULL,
  `kecamatan_lat` double NOT NULL,
  `kecamatan_long` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kecamatan`
--

INSERT INTO `tb_kecamatan` (`kecamatan_id`, `kecamatan_nama`, `kecamatan_lat`, `kecamatan_long`) VALUES
('KEC001', 'Kota', -6.806991956800623, 110.84145597351073),
('KEC002', 'Undaan', -6.886245263297313, 110.81201604736327),
('KEC003', 'Dawe', -6.728918916352647, 110.86587480438232),
('KEC004', 'Kaliwungu', -6.785003230230401, 110.78352025878905),
('KEC005', 'Jekulo', -6.803795983448247, 110.93956045043944),
('KEC006', 'Gebog', -6.7658261954496615, 110.83845189941405);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggaran`
--

CREATE TABLE `tb_pelanggaran` (
  `pelanggaran_id` varchar(10) NOT NULL,
  `pelanggaran_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pelanggaran`
--

INSERT INTO `tb_pelanggaran` (`pelanggaran_id`, `pelanggaran_nama`) VALUES
('PEL001', 'Pelanggaran Perda Kab. Kudus'),
('PEL002', 'Penyakit Masyarakat'),
('PEL003', 'Perilaku Menyimpang'),
('PEL004', 'Perizinan'),
('PEL005', 'Lain-lain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pos`
--

CREATE TABLE `tb_pos` (
  `pos_id` varchar(15) NOT NULL,
  `desa_id` varchar(15) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `pos_nama` varchar(50) NOT NULL,
  `pos_telp` varchar(15) NOT NULL,
  `pos_alamat` text NOT NULL,
  `pos_lat` double NOT NULL,
  `pos_long` double NOT NULL,
  `pos_foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pos`
--

INSERT INTO `tb_pos` (`pos_id`, `desa_id`, `user_id`, `pos_nama`, `pos_telp`, `pos_alamat`, `pos_lat`, `pos_long`, `pos_foto`) VALUES
('POS001', 'DES001', 'USR004', 'Pos Wergu', '085802020676', 'Ruku GOR Wergu Wetan', -6.816792809015692, 110.84939531219482, '5c131ff32756b.jpg'),
('POS002', 'DES002', 'USR005', 'Pos Pendopo', '085802080674', 'Belakang Pendopo Bupati', -6.805852062079129, 110.84255031478881, '5c1320e8b7355.jpg'),
('POS003', 'DES005', 'USR006', 'Pos Dawe', '085802020123', 'Jl Raya Kudus Colo', -6.749652971120043, 110.86198023675047, '5c1321393aaf5.jpg'),
('POS004', 'DES008', 'USR007', 'Pos Undaan', '085802020111', 'Jl Raya Kudus Purwodadi', -6.898941609649652, 110.80489210021972, '5c1321afb94b5.jpg'),
('POS005', 'DES007', 'USR002', 'Pos Barongan', '085128119281', 'Jl. Sosrokartono No.39, Barongan', -6.7985545411100246, 110.84725490940093, '5c13228f6e755.jpg'),
('POS006', 'DES004', 'USR008', 'Pos Menara', '081622102891', 'Taman Menara', -6.80505306883844, 110.8331464899826, '5c132358a1df9.jpg'),
('POS007', 'DES011', 'USR009', 'Pos Jekulo', '081728901223', 'Jl. Kudus - Pati KM 10', -6.805713570012665, 110.92522672546386, '5c1324b52715c.jpg'),
('POS008', 'DES009', 'USR010', 'Pos Kaliwungu', '08126212118', 'Jl. Kudus - Jepara KM 5', -6.797579754369752, 110.80314329994201, '5c1325dc2d977.jpg'),
('POS009', 'DES014', 'USR011', 'Pos Gebog', '081627118921', 'Jl. Rahtawu Raya No.2', -6.7410973507473715, 110.84133795631408, '5c1329238d491.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` varchar(15) NOT NULL,
  `user_nama` varchar(50) NOT NULL,
  `user_tmp_lahir` varchar(20) DEFAULT NULL,
  `user_tgl_lahir` date DEFAULT NULL,
  `user_jk` enum('lk','pr') DEFAULT NULL,
  `user_telp` varchar(15) DEFAULT NULL,
  `user_alamat` text,
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_level` enum('kep','pet','staf','masy') NOT NULL,
  `user_foto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `user_nama`, `user_tmp_lahir`, `user_tgl_lahir`, `user_jk`, `user_telp`, `user_alamat`, `user_username`, `user_password`, `user_level`, `user_foto`) VALUES
('MAS001', 'Mohammad Yusuf', 'Kudus', '1997-04-14', 'lk', '085802020676', 'Kudus', 'mokong', '55fc08419e9750203c1de7c72488a4d6', 'masy', '5beacd6c7084d.png'),
('MAS002', 'Ida Nur', 'Kudus', '1997-04-15', 'pr', '083910289102', 'Jambean Bae', 'ida', '7f78f270e3e1129faf118ed92fdf54db', 'masy', '5beae979a9dd2.jpg'),
('MAS003', 'Kurnia Andi', 'Jepara', '1993-08-17', 'lk', '085678965786', 'Panjang', 'andi', 'ce0e5bf55e4f71749eade7a8b95c4e46', 'masy', '5bf61f9207ad8.jpg'),
('MAS004', 'Al aziz', 'Kudus', '1993-12-09', 'lk', '085161728191', 'Dersalam bae Kudus', 'aziz', 'b85dc795ba17cb243ab156f8c52124e1', 'masy', '5c11eb90bfca5.jpg'),
('MAS005', 'Ahmed Al Qudsy', 'Kudus', '1987-02-03', 'lk', '081219228101', 'Klumpit bae Kudus', 'ahmed', '9193ce3b31332b03f7d8af056c692b84', 'masy', '5c126d6abe98b.jpg'),
('MAS006', 'Puput', 'Kudus', '1990-01-01', 'pr', '085161272881', 'Piji Dawe ', 'puput', 'f95c24c42b0f2ea683727cc47cde3ad2', 'masy', '5c1276444f2a9.jpg'),
('MAS007', 'Mukhlas Fitrianto', 'Kudus', '1996-08-13', 'lk', '085162712812', 'Dersalam ', 'muklas', '3211988211d0359a868a73e5b6647b6f', 'masy', '5c12825e295eb.jpg'),
('MAS008', 'Dide Fauzan', 'Kudus', '1995-04-04', 'lk', '081292122135', 'Prambatan Kaliwungu Kudus', 'dide', '63dfba48b8edc2269b5d11291ebccf82', 'masy', '5c1282aa5c7ba.jpg'),
('USR001', 'Hilda Rahmawati', NULL, NULL, NULL, NULL, NULL, 'hilda', 'ad31b478525413f0b1b1d8bf0aebeb7c', 'staf', NULL),
('USR002', 'Farid Akbar', '', NULL, '', '', '', 'farid', 'a1d12da42d4302e53d510954344ad164', 'pet', ''),
('USR003', 'Djati Solehah', '', NULL, '', '', '', 'djati', 'b1f9d9cc7c4177eecefdc186e4dfc459', 'kep', ''),
('USR004', 'Bowo', '', '0000-00-00', '', '', '', 'bowo', '9b930621eaa7ca7e9f6f584a1450b8a6', 'pet', ''),
('USR005', 'Edi', '', '0000-00-00', '', '', '', 'edi', '8457dff5491b024de6b03e30b609f7e8', 'pet', ''),
('USR006', 'Rudi', '', '0000-00-00', '', '', '', 'rudi', '1755e8df56655122206c7c1d16b1c7e3', 'pet', ''),
('USR007', 'Danang', '', '0000-00-00', '', '', '', 'danang', '6a17faad3b1275fd2558d5435c58440e', 'pet', ''),
('USR008', 'Tejo', '', '0000-00-00', '', '', '', 'tejo', 'ee6a8a14c94213e6a6ca06d90268bfdb', 'pet', ''),
('USR009', 'Dani', '', '0000-00-00', '', '', '', 'dani', '55b7e8b895d047537e672250dd781555', 'pet', ''),
('USR010', 'Gunawan', '', '0000-00-00', '', '', '', 'gunawan', 'dc96b97c4ffbead46ca25ef5d4b77cbe', 'pet', ''),
('USR011', 'Aan', '', '0000-00-00', '', '', '', 'aan', '4607ed4bd8140e9664875f907f48ae14', 'pet', ''),
('USR012', 'Dwi Cahyo', '', '0000-00-00', '', '', '', 'dwi', '7aa2602c588c05a93baf10128861aeb9', 'pet', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_aduan`
--
ALTER TABLE `tb_aduan`
  ADD PRIMARY KEY (`aduan_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pos_id` (`pos_id`),
  ADD KEY `pos_id_2` (`pos_id`);

--
-- Indexes for table `tb_desa`
--
ALTER TABLE `tb_desa`
  ADD PRIMARY KEY (`desa_id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`);

--
-- Indexes for table `tb_hasil_aduan`
--
ALTER TABLE `tb_hasil_aduan`
  ADD PRIMARY KEY (`hasil_id`),
  ADD KEY `aduan_id` (`aduan_id`),
  ADD KEY `pelanggaran_id` (`pelanggaran_id`);

--
-- Indexes for table `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  ADD PRIMARY KEY (`kecamatan_id`);

--
-- Indexes for table `tb_pelanggaran`
--
ALTER TABLE `tb_pelanggaran`
  ADD PRIMARY KEY (`pelanggaran_id`);

--
-- Indexes for table `tb_pos`
--
ALTER TABLE `tb_pos`
  ADD PRIMARY KEY (`pos_id`),
  ADD KEY `desa_id` (`desa_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_aduan`
--
ALTER TABLE `tb_aduan`
  ADD CONSTRAINT `tb_aduan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_aduan_ibfk_2` FOREIGN KEY (`pos_id`) REFERENCES `tb_pos` (`pos_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_desa`
--
ALTER TABLE `tb_desa`
  ADD CONSTRAINT `tb_desa_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `tb_kecamatan` (`kecamatan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_hasil_aduan`
--
ALTER TABLE `tb_hasil_aduan`
  ADD CONSTRAINT `tb_hasil_aduan_ibfk_1` FOREIGN KEY (`aduan_id`) REFERENCES `tb_aduan` (`aduan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_hasil_aduan_ibfk_2` FOREIGN KEY (`pelanggaran_id`) REFERENCES `tb_pelanggaran` (`pelanggaran_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pos`
--
ALTER TABLE `tb_pos`
  ADD CONSTRAINT `tb_pos_ibfk_1` FOREIGN KEY (`desa_id`) REFERENCES `tb_desa` (`desa_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pos_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
