-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2022 pada 15.41
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjadwalan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `angkatan`
--

CREATE TABLE `angkatan` (
  `id_angkatan` int(11) NOT NULL,
  `nama_angkatan` varchar(10) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `angkatan`
--

INSERT INTO `angkatan` (`id_angkatan`, `nama_angkatan`, `status`) VALUES
(1, '2017/2018', 0),
(2, '2018/2019', 0),
(3, '2019/2020', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nama_dosen` varchar(128) NOT NULL,
  `nidn` int(50) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rfid_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nama_dosen`, `nidn`, `jurusan_id`, `user_id`, `rfid_id`) VALUES
(1, 'Missi Hikmatyar, M.Kom.', 431108904, 1, 2, 8),
(5, 'Gea Aristi, S.T. M.Kom', 419048903, 1, 6, 4),
(6, 'Yusuf Sumaryana, S.T. M.Kom', 407108205, 1, 7, 5),
(7, 'Randi Rizal, S.T. M.Kom', 427108704, 1, 11, 6),
(8, 'Apt, Srie Rizki', 4665267, 4, 14, 7),
(9, 'Aso Sudiarjo, M.Kom', 416018902, 1, 16, 3),
(10, 'Ruuhwan, S.T, M.Kom', 425029001, 1, 17, 10),
(11, 'Ade Maftuh, S.T. M.Kom', 427108711, 1, 18, 11),
(12, 'Sihabudin, M.Kom', 983726617, 3, 41, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari`
--

CREATE TABLE `hari` (
  `id_hari` int(11) NOT NULL,
  `nama_hari` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hari`
--

INSERT INTO `hari` (`id_hari`, `nama_hari`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jumat'),
(6, 'Sabtu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_kuliah`
--

CREATE TABLE `jadwal_kuliah` (
  `id_jadwal_kuliah` int(11) NOT NULL,
  `pengampu_id` int(11) NOT NULL,
  `jam_belajar_id` int(11) NOT NULL,
  `hari_id` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal_kuliah`
--

INSERT INTO `jadwal_kuliah` (`id_jadwal_kuliah`, `pengampu_id`, `jam_belajar_id`, `hari_id`, `ruangan_id`, `status`) VALUES
(1, 1, 9, 2, 14, 0),
(2, 2, 9, 1, 22, 0),
(3, 3, 6, 6, 24, 0),
(4, 4, 3, 1, 5, 0),
(5, 5, 10, 1, 5, 0),
(6, 6, 8, 4, 28, 0),
(7, 7, 7, 2, 8, 0),
(8, 8, 8, 4, 8, 0),
(9, 9, 7, 2, 7, 0),
(10, 10, 8, 1, 4, 0),
(11, 11, 2, 6, 14, 0),
(12, 12, 8, 5, 2, 0),
(13, 13, 2, 2, 25, 0),
(14, 14, 5, 3, 2, 0),
(15, 15, 9, 1, 27, 0),
(16, 16, 4, 4, 11, 0),
(17, 17, 7, 1, 9, 0),
(18, 18, 3, 6, 27, 0),
(19, 19, 9, 4, 20, 0),
(20, 20, 4, 3, 18, 0),
(21, 21, 10, 1, 2, 0),
(22, 22, 2, 5, 22, 0),
(23, 23, 8, 5, 25, 0),
(24, 24, 1, 3, 22, 0),
(25, 25, 6, 2, 19, 0),
(26, 26, 9, 4, 13, 0),
(27, 27, 1, 5, 29, 0),
(28, 28, 5, 2, 17, 0),
(29, 29, 2, 2, 28, 0),
(30, 30, 5, 4, 15, 0),
(31, 31, 9, 6, 28, 0),
(32, 32, 6, 1, 14, 0),
(33, 33, 2, 3, 11, 0),
(34, 34, 8, 3, 7, 0),
(35, 35, 3, 1, 20, 0),
(36, 36, 4, 3, 23, 0),
(37, 37, 3, 6, 17, 0),
(38, 38, 9, 5, 19, 0),
(39, 39, 2, 6, 18, 0),
(40, 40, 8, 3, 4, 0),
(41, 41, 2, 1, 18, 0),
(42, 42, 1, 2, 20, 0),
(43, 43, 9, 2, 19, 0),
(44, 44, 4, 1, 19, 0),
(45, 45, 9, 5, 9, 0),
(46, 46, 1, 3, 19, 0),
(47, 47, 9, 4, 14, 0),
(48, 48, 6, 3, 8, 0),
(49, 49, 7, 1, 8, 0),
(50, 50, 4, 3, 8, 0),
(51, 51, 8, 5, 26, 0),
(52, 52, 2, 3, 21, 0),
(53, 53, 7, 6, 25, 0),
(54, 54, 9, 3, 12, 0),
(55, 55, 1, 6, 12, 0),
(56, 56, 4, 6, 8, 0),
(57, 57, 1, 6, 4, 0),
(58, 58, 8, 5, 23, 0),
(59, 59, 5, 6, 13, 0),
(60, 60, 1, 2, 22, 0),
(61, 61, 1, 1, 27, 0),
(62, 62, 8, 5, 15, 0),
(63, 63, 3, 1, 2, 0),
(64, 64, 1, 4, 14, 0),
(65, 65, 1, 2, 7, 0),
(66, 66, 11, 3, 8, 0),
(67, 67, 9, 3, 8, 0),
(68, 68, 10, 5, 12, 0),
(69, 69, 6, 6, 21, 0),
(70, 70, 3, 6, 2, 0),
(71, 71, 6, 1, 22, 0),
(72, 72, 4, 4, 8, 0),
(73, 73, 1, 3, 8, 0),
(74, 74, 8, 2, 12, 0),
(75, 75, 3, 2, 5, 0),
(76, 76, 8, 3, 25, 0),
(77, 77, 1, 1, 26, 0),
(78, 78, 6, 1, 23, 0),
(79, 79, 10, 4, 1, 0),
(80, 80, 3, 3, 14, 0),
(81, 87, 1, 2, 10, 0),
(82, 88, 1, 6, 5, 0),
(83, 89, 5, 6, 22, 0),
(84, 90, 9, 4, 4, 0),
(85, 91, 1, 6, 16, 0),
(86, 92, 9, 6, 6, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam_belajar`
--

CREATE TABLE `jam_belajar` (
  `id_jam_belajar` int(11) NOT NULL,
  `jam_belajar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jam_belajar`
--

INSERT INTO `jam_belajar` (`id_jam_belajar`, `jam_belajar`) VALUES
(1, '08.00-08.50'),
(2, '08.50-09.30'),
(3, '09.40-10.30'),
(4, '10.30-11.20'),
(5, '11.20-12.10'),
(6, '12.10-13.00'),
(7, '13.00-13.50'),
(8, '13.50-14.40'),
(9, '14.40-15.30'),
(10, '15.30-16.20'),
(11, '16.20-17.10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(128) NOT NULL,
  `prodi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `prodi_id`) VALUES
(1, 'Teknik Informatika', 1),
(2, 'Teknik Sipil', 1),
(3, 'Manajemen', 2),
(4, 'Farmasi', 3),
(6, 'Bahasa Inggris', 4),
(7, 'Akuntansi', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(128) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `jurusan_id`, `semester_id`) VALUES
(1, 'TI-A17', 1, 6),
(2, 'TI-B17', 1, 6),
(3, 'TI-C17', 1, 6),
(5, 'MNJ-A17', 3, 6),
(6, 'MNJ-B17', 3, 6),
(8, 'MNJ-C17', 3, 6),
(9, 'FA-A17', 4, 6),
(10, 'FA-B17', 4, 6),
(12, 'TI-A18', 1, 4),
(13, 'TI-B18', 1, 4),
(14, 'TI-C18', 1, 4),
(15, 'TI-A19', 1, 2),
(16, 'TI-B19', 1, 2),
(17, 'TI-C19', 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(128) NOT NULL,
  `nim` int(50) NOT NULL,
  `angkatan_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tanggal_lahir` varchar(128) NOT NULL,
  `tempat_tinggal` varchar(128) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `angkatan_id`, `jurusan_id`, `kelas_id`, `tanggal_lahir`, `tempat_tinggal`, `no_hp`, `user_id`) VALUES
(1, 'Ega Nugraha', 1703010040, 1, 1, 1, '16 Agustus 1999', 'Pagerageung, Tasikmalaya', '08975568102', 3),
(3, 'Trisna Wahana', 1703010004, 1, 1, 1, '09 Mei 1999', 'Sukaraja, Tasikmalaya', '082251627189', 10),
(4, 'Radenda Dewabrata', 1703010044, 1, 1, 1, '20 Mei 1998', 'Ciawi, Tasikmalaya', '0872838278', 12),
(5, 'Risma Shafitri', 1703010090, 1, 3, 6, '20 Mei 1998', 'Jamanis, Tasikmalaya', '08281726352', 13),
(6, 'Aulia Nur Halimah', 1703010310, 1, 3, 8, '08 Agustus 1998', 'Cipacing, Tasikmalaya', '08287165267', 15),
(7, 'Iqbal Rapido', 1703010020, 1, 1, 1, '20 Mei 2020', 'Singaparna, Tasikmalaya', '08225162718', 19),
(8, 'Muhammad Faiz', 1703010002, 1, 1, 1, '09 Mei 1999', 'Sukaraja, Tasikmalaya', '082251627181', 20),
(9, 'Irfan Fauzi', 1703010021, 1, 1, 1, '12 Agustus 1999', 'Singaparna, Tasikmalaya', '082251627182', 21),
(10, 'Muhammad Gungun', 1703010009, 1, 1, 1, '09  Maret 1999', 'Sindangkasih, Tasikmalaya', '08975568111', 22),
(11, 'Panji Diyan', 1703010024, 1, 1, 1, '01 Februari 1999', 'Cipacing, Tasikmalaya', '08232718922', 23),
(12, 'Abdul Azis', 1703010033, 1, 1, 1, '08 Agustus 1998', 'Singaparna, Tasikmalaya', '082251627221', 24),
(13, 'Agung Nugraha', 1703010001, 1, 1, 1, '09 Januari 1998', 'Tasikmalaya', '081323748592', 25),
(14, 'Moch Raditya', 1703010028, 1, 1, 1, '17 September 1998', 'Tasikmalaya', '08766452678', 26),
(15, 'Arki Rahman', 1703010027, 1, 1, 1, '08 Agustus 1998', 'Rajapolah, Tasikmalaya', '085221836722', 27),
(16, 'Asep Nopiana', 1703010003, 1, 1, 1, '20 Mei 2020', 'Tasikmalaya', '08287165261', 28),
(17, 'Wildan Fadilah', 1703010011, 1, 1, 1, '12 Agustus 1999', 'Jamanis, Tasikmalaya', '08225162711', 29),
(18, 'Muhammad Farid', 1703010029, 1, 1, 1, '07 Desember 1999', 'Tasikmalaya', '08212212311', 30),
(19, 'Rizky Maulana Hidayat', 1703010038, 1, 1, 1, '19 November 1998', 'Tasikmalaya', '08234211232', 31),
(20, 'Reza Mahendra', 1703010026, 1, 1, 1, '06 April 1999', 'Tasikmalaya', '081323748522', 32),
(21, 'Naufal Ali', 1703010022, 1, 1, 1, '22 April 1999', 'Singaparna, Tasikmalaya', '0829382716', 33),
(22, 'Abdul Rizal Sidiq', 1703010042, 1, 1, 1, '20 Februari 1998', 'Sindangkasih, Tasikmalaya', '08324152871', 34),
(23, 'Julia Refoliani', 1703010012, 1, 1, 1, '07 Februari 1999', 'Tasikmalaya', '08132864627', 35),
(24, 'Rosna Miftahul', 1703010013, 1, 1, 1, '28 Mei 1999', 'Tasikmalaya', '08225162721', 36),
(25, 'Garnis Tri Lasmi', 1703010014, 1, 1, 1, '17 Juni 1999', 'Tasikmalaya', '082122123112', 37),
(26, 'Elsa Septira', 1703010015, 1, 1, 1, '18 September 1999', 'Tasikmalaya', '082817263511', 38),
(27, 'Bella Pertiwi', 1703010016, 1, 1, 1, '12 September 1998', 'Tasikmalaya', '081323748593', 39),
(28, 'Rizal Farid', 1703010099, 1, 1, 2, '18 April 1999', 'Tasikmalaya', '0892826715', 40);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_matkul` int(11) NOT NULL,
  `nama_matkul` varchar(128) NOT NULL,
  `jumlah_sks` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_matkul`, `nama_matkul`, `jumlah_sks`, `jurusan_id`, `semester_id`, `jenis`) VALUES
(1, 'Metodologi Penelitian', 3, 1, 6, 'Teori'),
(2, 'Tata Kelola Audit', 3, 1, 7, 'Teori'),
(3, 'Pasar Modal', 2, 3, 6, 'Teori'),
(5, 'Sistem Terdistribusi', 2, 1, 5, 'Teori'),
(6, 'Struktur Bangunan', 3, 2, 7, 'Teori'),
(8, 'Belah Tikus', 3, 4, 6, 'Praktikum'),
(9, 'Multimedia', 3, 1, 6, 'Teori'),
(10, 'Manajemen Jaringan Komputer', 3, 1, 7, 'Teori'),
(11, 'Sistem Pendukung Keputusan', 3, 1, 6, 'Teori'),
(12, 'Ekonomi Syariah', 3, 3, 7, 'Teori'),
(13, 'Obat Terlarang', 2, 4, 5, 'Teori'),
(14, 'Kewirausahaan', 2, 1, 6, 'Teori'),
(15, 'Rekayasa Sistem', 3, 1, 6, 'Teori'),
(16, 'Komunikasi Antar Personal', 2, 1, 6, 'Teori'),
(17, 'Interaksi Manusia dan Komputer', 3, 1, 6, 'Teori'),
(18, 'Layanan Web', 3, 1, 6, 'Teori'),
(19, 'Data Mining', 3, 1, 6, 'Teori'),
(20, 'Metode Numerik', 3, 1, 4, 'Teori'),
(21, 'Teori Bahasa dan Otomata', 3, 1, 4, 'Teori'),
(22, 'Riset Operasi', 3, 1, 4, 'Teori'),
(23, 'Sistem Informasi', 3, 1, 4, 'Teori'),
(24, 'Sistem Operasi', 3, 1, 4, 'Teori'),
(25, 'Praktikum Sistem Operasi', 1, 1, 4, 'Praktikum'),
(26, 'Jaringan Komputer', 3, 1, 4, 'Teori'),
(27, 'Praktikum Jaringan Komputer', 1, 1, 4, 'Praktikum'),
(28, 'Kalkulus II', 3, 1, 2, 'Teori'),
(29, 'Logika Informatika', 3, 1, 2, 'Teori'),
(30, 'Basis Data', 3, 1, 2, 'Teori'),
(31, 'Praktikum Basis Data', 1, 1, 2, 'Praktikum'),
(32, 'Algoritma dan Struktur Data', 3, 1, 2, 'Teori'),
(33, 'Praktikum Algorithma & Struktur Data', 1, 1, 2, 'Praktikum'),
(34, 'Pendidikan Pancasila dan Kewarganegaraan', 2, 1, 2, 'Teori'),
(35, 'Bahasa Inggris', 2, 1, 2, 'Teori'),
(36, 'Seni Budaya dan Kearifan Lokal', 2, 1, 2, 'Teori'),
(38, 'Strategi Marketing', 3, 3, 6, 'Teori');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `url`, `icon`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-fw fa-tachometer-alt'),
(2, 'Menu', 'menu', 'fas fa-fw fa-folder-minus'),
(6, 'User Akses', 'user_access', 'fas fa-fw fa-wheelchair'),
(8, 'Data Dosen', 'daftar_dosen', 'fas fa-fw fa-user-secret'),
(9, 'Data Mahasiswa', 'data_mahasiswa', 'fas fa-fw fa-user-graduate'),
(10, 'Manajemen Data', 'manajemen_data', 'fas fa-fw fa-box'),
(11, 'Manajemen Mata Kuliah', 'manajemen_matkul', 'fas fa-fw fa-pencil-ruler'),
(13, 'Manajemen Jadwal', 'manajemen_jadwal', 'fas fa-fw fa-calendar-check'),
(14, 'Jadwal Kuliah', 'jadwal_kelas', 'fas fa-fw fa-calendar-check'),
(15, 'Jadwal Mengajar', 'jadwal_mengajar', 'fas fa-fw fa-calendar-check'),
(16, 'Waktu Tidak Bersedia', 'Waktu_tidak_bersedia', 'fas fa-user-times');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengampu`
--

CREATE TABLE `pengampu` (
  `id_pengampu` int(11) NOT NULL,
  `matkul_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `kelas` varchar(120) NOT NULL,
  `tahun_akademik` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengampu`
--

INSERT INTO `pengampu` (`id_pengampu`, `matkul_id`, `dosen_id`, `kelas`, `tahun_akademik`) VALUES
(1, 1, 1, 'TI-A17', '2017/2018'),
(2, 1, 1, 'TI-B17', '2017/2018'),
(3, 1, 1, 'TI-C17', '2017/2018'),
(4, 3, 12, 'MNJ-A17', '2017/2018'),
(5, 3, 12, 'MNJ-B17', '2017/2018'),
(6, 3, 12, 'MNJ-C17', '2017/2018'),
(7, 8, 8, 'FA-A17', '2017/2018'),
(8, 8, 8, 'FA-B17', '2017/2018'),
(9, 9, 6, 'TI-A17', '2017/2018'),
(10, 9, 6, 'TI-B17', '2017/2018'),
(11, 9, 6, 'TI-C17', '2017/2018'),
(12, 11, 9, 'TI-A17', '2017/2018'),
(13, 11, 9, 'TI-B17', '2017/2018'),
(14, 11, 9, 'TI-C17', '2017/2018'),
(15, 14, 7, 'TI-A17', '2017/2018'),
(16, 14, 7, 'TI-B17', '2017/2018'),
(17, 14, 7, 'TI-C17', '2017/2018'),
(18, 15, 5, 'TI-A17', '2017/2018'),
(19, 15, 5, 'TI-B17', '2017/2018'),
(20, 15, 5, 'TI-C17', '2017/2018'),
(21, 16, 5, 'TI-A17', '2017/2018'),
(22, 16, 5, 'TI-B17', '2017/2018'),
(23, 16, 5, 'TI-C17', '2017/2018'),
(24, 17, 1, 'TI-A17', '2017/2018'),
(25, 17, 1, 'TI-B17', '2017/2018'),
(26, 17, 1, 'TI-C17', '2017/2018'),
(27, 18, 10, 'TI-A17', '2017/2018'),
(28, 18, 10, 'TI-B17', '2017/2018'),
(29, 18, 10, 'TI-C17', '2017/2018'),
(30, 19, 5, 'TI-A17', '2017/2018'),
(31, 19, 5, 'TI-B17', '2017/2018'),
(32, 19, 5, 'TI-C17', '2017/2018'),
(33, 20, 9, 'TI-A18', '2017/2018'),
(34, 20, 9, 'TI-B18', '2017/2018'),
(35, 20, 9, 'TI-C18', '2017/2018'),
(36, 21, 1, 'TI-A18', '2017/2018'),
(37, 21, 1, 'TI-B18', '2017/2018'),
(38, 21, 1, 'TI-C18', '2017/2018'),
(39, 22, 10, 'TI-A18', '2017/2018'),
(40, 22, 10, 'TI-B18', '2017/2018'),
(41, 22, 10, 'TI-C18', '2017/2018'),
(42, 23, 7, 'TI-A18', '2017/2018'),
(43, 23, 7, 'TI-B18', '2017/2018'),
(44, 23, 7, 'TI-C18', '2017/2018'),
(45, 24, 10, 'TI-A18', '2017/2018'),
(46, 24, 10, 'TI-B18', '2017/2018'),
(47, 24, 10, 'TI-C18', '2017/2018'),
(48, 25, 10, 'TI-A18', '2017/2018'),
(49, 25, 10, 'TI-B18', '2017/2018'),
(50, 25, 10, 'TI-C18', '2017/2018'),
(51, 26, 7, 'TI-A18', '2017/2018'),
(52, 26, 7, 'TI-B18', '2017/2018'),
(53, 26, 7, 'TI-C18', '2017/2018'),
(54, 27, 7, 'TI-A18', '2017/2018'),
(55, 27, 7, 'TI-B18', '2017/2018'),
(56, 27, 7, 'TI-C18', '2017/2018'),
(57, 28, 11, 'TI-A19', '2017/2018'),
(58, 28, 11, 'TI-B19', '2017/2018'),
(59, 28, 11, 'TI-C19', '2017/2018'),
(60, 29, 6, 'TI-A19', '2017/2018'),
(61, 29, 6, 'TI-B19', '2017/2018'),
(62, 29, 6, 'TI-C19', '2017/2018'),
(63, 30, 5, 'TI-A19', '2017/2018'),
(64, 30, 5, 'TI-B19', '2017/2018'),
(65, 30, 5, 'TI-C19', '2017/2018'),
(66, 31, 5, 'TI-A19', '2017/2018'),
(67, 31, 5, 'TI-B19', '2017/2018'),
(68, 31, 5, 'TI-C19', '2017/2018'),
(69, 32, 9, 'TI-A19', '2017/2018'),
(70, 32, 9, 'TI-B19', '2017/2018'),
(71, 32, 9, 'TI-C19', '2017/2018'),
(72, 33, 9, 'TI-A19', '2017/2018'),
(73, 33, 9, 'TI-B19', '2017/2018'),
(74, 33, 9, 'TI-C19', '2017/2018'),
(75, 34, 11, 'TI-A19', '2017/2018'),
(76, 34, 11, 'TI-B19', '2017/2018'),
(77, 34, 11, 'TI-C19', '2017/2018'),
(78, 35, 6, 'TI-A19', '2017/2018'),
(79, 35, 6, 'TI-B19', '2017/2018'),
(80, 35, 6, 'TI-C19', '2017/2018'),
(87, 38, 12, 'MNJ-A17', '2017/2018'),
(88, 38, 12, 'MNJ-B17', '2017/2018'),
(89, 38, 12, 'MNJ-C17', '2017/2018'),
(90, 36, 9, 'TI-A19', '2017/2018'),
(91, 36, 9, 'TI-B19', '2017/2018'),
(92, 36, 9, 'TI-C19', '2017/2018');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `nama_prodi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`) VALUES
(1, 'Teknik'),
(2, 'Ekonomi'),
(3, 'Kesehatan'),
(4, 'Bahasa'),
(6, 'Pendidikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rfid`
--

CREATE TABLE `rfid` (
  `id_rfid` int(11) NOT NULL,
  `uid_rfid` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rfid`
--

INSERT INTO `rfid` (`id_rfid`, `uid_rfid`) VALUES
(1, '1a:51:42:6b:62'),
(2, 'aa:91:a4:1a:85'),
(3, '79:e4:67:40:ba'),
(4, 'b3:52:39:5:dd'),
(5, 'c3:95:85:5:d6'),
(6, '43:1a:b4:5:e8'),
(7, '73:9b:4e:5:a3'),
(8, '3:83:f0:3:73'),
(9, 'a3:d1:c6:5:b1'),
(10, 'c3:a5:76:5:15'),
(11, '93:b2:3a:5:1e');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rfid_master`
--

CREATE TABLE `rfid_master` (
  `id_rfid_master` int(11) NOT NULL,
  `nama_master` varchar(128) NOT NULL,
  `jabatan` varchar(128) NOT NULL,
  `rfid_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rfid_master`
--

INSERT INTO `rfid_master` (`id_rfid_master`, `nama_master`, `jabatan`, `rfid_id`) VALUES
(4, 'Andri', 'Petugas Kebersihan', 1),
(5, 'Saepul', 'Satpam', 9),
(6, 'Dadang', 'Petugas Kebersihan', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'Dosen'),
(3, 'Mahasiswa'),
(4, 'Staff');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(128) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`, `kapasitas`, `jenis`) VALUES
(1, 'A1 Gedung Solihin', 40, 'Teori'),
(2, 'A2 Gedung Solihin', 40, 'Teori'),
(4, 'A3 Gedung Solihin', 40, 'Teori'),
(5, 'A4 Gedung Solihin', 40, 'Teori'),
(6, 'A5 Gedung Solihin', 40, 'Teori'),
(7, 'B1 Gedung Solihin', 40, 'Teori'),
(8, 'L01 Point 1', 30, 'Praktikum'),
(9, 'B2 Gedung Solihin', 40, 'Teori'),
(10, 'B3 Gedung Solihin', 40, 'Teori'),
(11, 'B4 Gedung Solihin', 40, 'Teori'),
(12, 'L02 Point 1', 30, 'Praktikum'),
(13, 'A10 Gedung B', 40, 'Teori'),
(14, 'A11 Gedung B', 40, 'Teori'),
(15, 'A12 Gedung B', 40, 'Teori'),
(16, 'A13 Gedung B', 40, 'Teori'),
(17, 'A14 Gedung B', 40, 'Teori'),
(18, 'A15 Gedung B', 40, 'Teori'),
(19, 'B10 Gedung B', 40, 'Teori'),
(20, 'B11 Gedung B', 40, 'Teori'),
(21, 'B12 Gedung B', 40, 'Teori'),
(22, 'B13 Gedung B', 40, 'Teori'),
(23, 'B14 Gedung B', 40, 'Teori'),
(24, 'B15 Gedung B', 40, 'Teori'),
(25, 'C1 Gedung B', 40, 'Teori'),
(26, 'C2 Gedung B', 40, 'Teori'),
(27, 'C3 Gedung B', 40, 'Teori'),
(28, 'C4 Gedung B', 40, 'Teori'),
(29, 'C5 Gedung B', 40, 'Teori');

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester`
--

CREATE TABLE `semester` (
  `id_semester` int(11) NOT NULL,
  `nama_semester` int(2) NOT NULL,
  `angkatan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `semester`
--

INSERT INTO `semester` (`id_semester`, `nama_semester`, `angkatan_id`) VALUES
(1, 1, 3),
(2, 2, 3),
(3, 3, 2),
(4, 4, 2),
(5, 5, 1),
(6, 6, 1),
(7, 7, 0),
(8, 8, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester_aktif`
--

CREATE TABLE `semester_aktif` (
  `id_semester_aktif` int(11) NOT NULL,
  `nama_semester` varchar(128) NOT NULL,
  `is_active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `semester_aktif`
--

INSERT INTO `semester_aktif` (`id_semester_aktif`, `nama_semester`, `is_active`) VALUES
(0, 'Genap', 1),
(1, 'Ganjil', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `role_id`) VALUES
(1, 'admin@xuniversity.ac.id', '$2y$10$Jfq0fEv7TVOjudC8MVbLOuuOKM4tTF/C77ZpVC.IFe7jFJUrN4gFa', 1),
(2, 'missihikmatyar@gmail.com', '$2y$10$Jfq0fEv7TVOjudC8MVbLOuuOKM4tTF/C77ZpVC.IFe7jFJUrN4gFa', 2),
(3, 'nugrahaega261@gmail.com', '$2y$10$/Lg/xPpF2AzEkHYGuHhIMeXyS7oEqi3.antMaGEuHMg/Q4ByAXrn2', 3),
(6, 'geaaristi@gmail.com', '$2y$10$et1.vFlPyVGq1Ke1/rSCl.v60okyTQEj7VOoUujUZtlQxj6IBaHHe', 2),
(7, 'yusufsumaryana@gmail.com', '$2y$10$Y/63iFg3rvkIAUjy3qtrQu7bfoF7RspHnSzFTByyfeLSQ6hi9zcnW', 2),
(10, 'trisnawahanaid@gmail.com', '$2y$10$TrPkmmLV23XqdMZzI3FD1eF6.zSOV0S1stt.29onffxQ8bD2FxQg2', 3),
(11, 'randirizal@gmail.com', '$2y$10$7lDg4M8eYr/kuXprYykM5.7wxBa6INOyDu8WEumu.kI6BmHjwzVVm', 2),
(12, 'dewangga@unper.ac.id', '$2y$10$InicB6/mPe9LbD/rhuq0u.Yvi2egIdV9pdORlX3Jb7jwH55V5rhre', 3),
(13, 'rismashafitri@gmail.com', '$2y$10$WR96PG8RMUWfx9ysC1b6Ne1DKMBWcre2/JARg47BnS/phEnOy6CQO', 3),
(14, 'srierizki@gmail.com', '$2y$10$PcHhIGwSy4ZXJK9o4/WfBu3qZUkdYzfqvQJh.2/LQJAbQoo2YeEjS', 2),
(15, 'aulianurhalimah@gmail.com', '$2y$10$.tez9gqW8AwAVNfNIWTlkerWG2TwIZqzSWKXJQ3NHtqKVJ3cCkmVm', 3),
(16, 'asosudiarjo@gmail.com', '$2y$10$2GCVlIoYI1qtF7BfKODuyefWF.DVhaOrnj0N2xlarZWxP8M5z4nta', 2),
(17, 'Ruhwan@gmail.com', '$2y$10$SfNyIP/jsOpnFaYKwFekJe816Y6Xj9mmORiK6rBFFE4IB9k8jQsU.', 2),
(18, 'ademaftuh@gmail.com', '$2y$10$gt5nqhabRbLamySJAEl.W.7hxqrq9AB6nzYjRnZxYEMwOqTN0tFv2', 2),
(19, 'iqbalrapido@gmail.com', '$2y$10$lOA0mXAY2kYdKYrWtBkhHOQil5JS1EJlVo8qEP9dOOyUELK4E/iUa', 3),
(20, 'muhammadfaiz@gmail.com', '$2y$10$gtFDPIjYQaUVNx3cphXqWubgaHi.hGaT12WeNIYrwQdhBTpPj70OG', 3),
(21, 'Irfan@gmail.com', '$2y$10$SPGxivnF39OJi9ZZe7rZ6ehu8ARidq.p5U6Xar74qzRCpdHckDZ7S', 3),
(22, 'Gungun@gmail.com', '$2y$10$RLs88pygMZT9Qehe2l19/OQa9Wehh1DanePF6UxAoSEmvhb5D0cPi', 3),
(23, 'Panji@gmail.com', '$2y$10$xDi3QmefTQiDZVOTea0NW.D0L75Kj.KFNXMBfCSbKtzGwaKxEhl/G', 3),
(24, 'Azis@gmail.com', '$2y$10$PipPy114vxGQ9EdMeGXSru1wzuda103Wf4rJ1AtsZ7KCGJ2OR3qfq', 3),
(25, 'Agung@gmail.com', '$2y$10$P4C/G0tTStChz1IcCkXgj.3QmP6N3wnw/ryvgyGgfijY5EyTvbrhS', 3),
(26, 'Radit@gmail.com', '$2y$10$U0enmHwIFLFw8gc5ZgznNOK0ekHYEEUTlbEfhhSJqhYwZN8Cuh.6q', 3),
(27, 'arki@gmail.com', '$2y$10$qoyXqte7XzZb/HYCMuHG7OtZpUlLtB5SWrbyV7yfHU.ITqW7XH1U6', 3),
(28, 'Asep@gmail.com', '$2y$10$uXiNnnTfkMX8ykHOzmauZuSwikezywGMtz/3ADl6JMcImPFyYZqle', 3),
(29, 'wildan@gmail.com', '$2y$10$XEWDlE/nEzwIcXvvqIov2OhPaacmdyvMOJli3YZ1LfL6hvbc5hU82', 3),
(30, 'farid@gmail.com', '$2y$10$0AhpBp//rLRN/iT091A7xufCsqpM1fGVoA9omlWfp.GgHpDG4jRW2', 3),
(31, 'rizky@gmail.com', '$2y$10$QsroF8vPQ7Q8s/0Qj0HUyOUFYiloOQV1n0HM.bdbjCagE7nv5ye/2', 3),
(32, 'reza@gmail.com', '$2y$10$EA1XmO.3InyY.K2FN6NY2uAj7RoohHoec10opC1MtgRZt1PmRvuly', 3),
(33, 'naufal@gmail.com', '$2y$10$pTtqt0k15yn7qbQ5pE7K6ulXLLIOx0vZ.ZTF9M8zF8p1sLtgFZxzq', 3),
(34, 'abdul@gmail.com', '$2y$10$iiN8E7e2ZVN8dEvtLAbX7exIGDeQtcXXjf3ifHe6NM6V1NkLsJcsa', 3),
(35, 'julia@gmail.com', '$2y$10$6LgyOlTbwQG5Jdc5eg.RauN.OQ1UchdpYNbiBICfFCkwpmfSwSFFS', 3),
(36, 'Rosna@gmail.com', '$2y$10$lSYXWPdXaM471nP2IfUJH.zkEefWeYeCKMLraqdGsiHClAeFu/p6e', 3),
(37, 'garnis@gmail.com', '$2y$10$0rkGEvmHYlTfJBcaDoJvU.N8qMj.bf4ebZoBZs/XgRtqA.m.xozmi', 3),
(38, 'elsa@gmail.com', '$2y$10$DOneYqEETu49VvPNgCDwze4gYJyiaACpCUwrMrAPVz6xSgWQ57NDW', 3),
(39, 'bella@gmail.com', '$2y$10$et1ED0jGDAnuSgCr01dBBOxKTsxJ8ipHdOViqIIiOgNyqu4yNvDeu', 3),
(40, 'rizal@gmail.com', '$2y$10$RrsOQ2QiQxQ64dgRjVhGY.VzznZOF.PgApusgbg/C08gh.IAMO8vy', 3),
(41, 'sihabudin@gmail.com', '$2y$10$hQEf46QD3JNbEALKD7uQbeaN1g5SDcdPWV.uuQ66YCdh0Yvjf/nsa', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_user_access` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_user_access`, `menu_id`, `role_id`) VALUES
(5, 1, 3),
(10, 1, 4),
(11, 6, 1),
(13, 2, 1),
(17, 8, 1),
(18, 9, 1),
(19, 10, 1),
(20, 1, 1),
(22, 11, 1),
(23, 1, 2),
(24, 12, 1),
(25, 13, 1),
(26, 15, 2),
(27, 14, 3),
(28, 1, 6),
(29, 16, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `waktu_tidak_bersedia`
--

CREATE TABLE `waktu_tidak_bersedia` (
  `id_waktu_tidak_bersedia` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `hari_id` int(11) NOT NULL,
  `jam_belajar_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `waktu_tidak_bersedia`
--

INSERT INTO `waktu_tidak_bersedia` (`id_waktu_tidak_bersedia`, `dosen_id`, `hari_id`, `jam_belajar_id`) VALUES
(6, 1, 1, 1),
(7, 5, 2, 2),
(8, 6, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id_angkatan`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indeks untuk tabel `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indeks untuk tabel `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  ADD PRIMARY KEY (`id_jadwal_kuliah`);

--
-- Indeks untuk tabel `jam_belajar`
--
ALTER TABLE `jam_belajar`
  ADD PRIMARY KEY (`id_jam_belajar`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indeks untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `pengampu`
--
ALTER TABLE `pengampu`
  ADD PRIMARY KEY (`id_pengampu`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indeks untuk tabel `rfid`
--
ALTER TABLE `rfid`
  ADD PRIMARY KEY (`id_rfid`);

--
-- Indeks untuk tabel `rfid_master`
--
ALTER TABLE `rfid_master`
  ADD PRIMARY KEY (`id_rfid_master`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indeks untuk tabel `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indeks untuk tabel `semester_aktif`
--
ALTER TABLE `semester_aktif`
  ADD PRIMARY KEY (`id_semester_aktif`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_user_access`);

--
-- Indeks untuk tabel `waktu_tidak_bersedia`
--
ALTER TABLE `waktu_tidak_bersedia`
  ADD PRIMARY KEY (`id_waktu_tidak_bersedia`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `angkatan`
--
ALTER TABLE `angkatan`
  MODIFY `id_angkatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  MODIFY `id_jadwal_kuliah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `jam_belajar`
--
ALTER TABLE `jam_belajar`
  MODIFY `id_jam_belajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pengampu`
--
ALTER TABLE `pengampu`
  MODIFY `id_pengampu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `rfid`
--
ALTER TABLE `rfid`
  MODIFY `id_rfid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `rfid_master`
--
ALTER TABLE `rfid_master`
  MODIFY `id_rfid_master` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `semester`
--
ALTER TABLE `semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_user_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `waktu_tidak_bersedia`
--
ALTER TABLE `waktu_tidak_bersedia`
  MODIFY `id_waktu_tidak_bersedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
