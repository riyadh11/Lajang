-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06 Des 2017 pada 12.20
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db__lajang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrators`
--

CREATE TABLE `administrators` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `administrators`
--

INSERT INTO `administrators` (`id`, `name`, `email`, `password`, `penduduk`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Moersali', 'joko@anwar.com', '$2y$10$kaxIalJdj94FOkT1Zfq6ie6bh0xwynKLpoth/1le/ZVD1rpiOftam', 4, 'PgCachpDqOXfGuBmqMM9XJ1NUFeME16yLrevRoeXU5zhItWhB3gC8iYRF8Vw', '2017-11-27 01:33:24', '2017-12-02 19:47:21', '2017-12-02 19:47:21'),
(3, 'Robert', 'joako@anwar.com', '00000', 5, NULL, NULL, '2017-11-30 05:37:13', '2017-11-30 05:37:13'),
(4, 'Robert', 'root@me.com', '$2y$10$TOBnq0m..YHMGiXsoORWbuVetmoJBj97G9r7/Rvw6mfwcgxRUgdo6', 6, NULL, '2017-12-02 19:46:32', '2017-12-02 19:46:32', NULL),
(5, 'riyadh', 'joko8joki@gmail.com', '$2y$10$OEW4hUtG54CpPs4vjX6kGOuLlkX.xhN1ta8AbSApCLhvREKSoilVm', 8, 'isf0DbaDv3sUPHsMWWex7YF04aAZG9ZlZlohsfu2NF2btEXIagSXg9Zghq3h', '2017-12-04 05:55:09', '2017-12-04 05:55:09', NULL),
(7, 'joko', 'riyadh11@live.com', '$2y$10$ZgcZrj.6N4GUj.OD3KtlbemuQc9LSpzXkSMwyI95g/2KPpy5NRCq2', 12, 'YxrCoyZ8igsvmWT6cR5FSgx9jIOhUAnHnbK83Z7BqxhlySugCqRjdiO5Z7Jn', '2017-12-04 06:16:29', '2017-12-04 06:16:29', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrator_password_resets`
--

CREATE TABLE `administrator_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `administrator_password_resets`
--

INSERT INTO `administrator_password_resets` (`email`, `token`, `created_at`) VALUES
('joko@anwar.com', '$2y$10$OkC4dBQsvTqq2KkWlTmIcOO9xAiWMDMKfg6hbpLwwRRViLKXUEo6e', '2017-12-02 19:46:01'),
('root@me.com', '$2y$10$ERDZ50lbWU/S6Gql31pKOOtrSqbmu/qTNIetdfb59ZSpI6ys2haSq', '2017-12-04 05:33:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_perbaikans`
--

CREATE TABLE `biaya_perbaikans` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `laporan` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `biaya_perbaikans`
--

INSERT INTO `biaya_perbaikans` (`id`, `nama`, `deskripsi`, `unit`, `harga`, `laporan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Marka Jalan', 'Tidak ada', 1, 1000, 11, '2017-12-01 01:33:59', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(3, 'Nama1', 'Desc1', 1, 1, 12, '2017-12-01 07:02:05', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(4, 'Nama2', 'Desc2', 2, 2, 12, '2017-12-01 07:02:05', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(5, 'Nama3', 'Desc3', 3, 3, 12, '2017-12-01 07:02:05', '2017-12-06 03:06:33', '2017-12-06 03:06:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto_laporans`
--

CREATE TABLE `foto_laporans` (
  `id` int(10) UNSIGNED NOT NULL,
  `laporan` int(10) UNSIGNED NOT NULL,
  `url_gambar` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `foto_laporans`
--

INSERT INTO `foto_laporans` (`id`, `laporan`, `url_gambar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 30, 'laporan_182be0c5cdcd5072bb1864cdee4d3d6e_Laporan/progress-34173cb38f07f89ddbebc2ac9128303f-15109218160.png', '2017-11-17 05:30:16', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(12, 30, 'laporan_182be0c5cdcd5072bb1864cdee4d3d6e_Laporan/progress-34173cb38f07f89ddbebc2ac9128303f-15109218161.jpg', '2017-11-17 05:30:16', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(13, 31, 'laporan_182be0c5cdcd5072bb1864cdee4d3d6e_LaBoran/progress-c16a5320fa475530d9583c34fd356ef5-15110647730.png', '2017-11-18 21:12:53', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(14, 32, 'laporan_182be0c5cdcd5072bb1864cdee4d3d6e_LaBoran/progress-6364d3f0f495b6ab9dcf8d3b5c6e0b01-15110648130.png', '2017-11-18 21:13:33', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(15, 33, 'laporan_182be0c5cdcd5072bb1864cdee4d3d6e_LaBoran/progress-182be0c5cdcd5072bb1864cdee4d3d6e-15110669320.png', '2017-11-18 21:48:52', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(16, 34, 'laporan_182be0c5cdcd5072bb1864cdee4d3d6e_LaBoran/progress-e369853df766fa44e1ed0ff613f563bd-15110669360.png', '2017-11-18 21:48:56', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(17, 35, 'laporan_182be0c5cdcd5072bb1864cdee4d3d6e_LaBoran/progress-1c383cd30b7c298ab50293adfecb7b18-15110669950.png', '2017-11-18 21:49:55', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(18, 36, 'laporan_182be0c5cdcd5072bb1864cdee4d3d6e_LaBoran!/progress-19ca14e7ea6328a42e0eb13d585e4c22-15117772690.png', '2017-11-27 03:07:49', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(19, 37, 'laporan_182be0c5cdcd5072bb1864cdee4d3d6e_LaBoran!/progress-a5bfc9e07964f8dddeb95fc584cd965d-15117773640.png', '2017-11-27 03:09:24', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(20, 38, 'laporan_e369853df766fa44e1ed0ff613f563bd_Macet dijalan Soekarno Hatta/progress-a5771bce93e200c36f7cd9dfd0e5deaa-15117831330.png', '2017-11-27 04:45:33', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(21, 39, 'laporan_1c383cd30b7c298ab50293adfecb7b18_Kecelakaan tunggal/progress-d67d8ab4f4c10bf22aa353e27879133c-15120284780.png', '2017-11-30 00:54:38', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(22, 39, 'laporan_1c383cd30b7c298ab50293adfecb7b18_Kecelakaan tunggal/progress-d67d8ab4f4c10bf22aa353e27879133c-15120284781.png', '2017-11-30 00:54:38', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(23, 40, 'laporan_1c383cd30b7c298ab50293adfecb7b18_Kecelakaan tunggal/progress-d645920e395fedad7bbbed0eca3fe2e0-15121353990.png', '2017-12-01 06:36:39', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(24, 41, 'laporan_1c383cd30b7c298ab50293adfecb7b18_Kecelakaan tunggal/progress-3416a75f4cea9109507cacd8e2f2aefc-15121354770.png', '2017-12-01 06:37:57', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(25, 42, 'laporan_19ca14e7ea6328a42e0eb13d585e4c22_Macet dijalan Soekarno Hatta 100 km/progress-a1d0c6e83f027327d8461063f4ac58a6-15122694730.png', '2017-12-02 19:51:13', '2017-12-02 19:51:13', NULL),
(26, 42, 'laporan_19ca14e7ea6328a42e0eb13d585e4c22_Macet dijalan Soekarno Hatta 100 km/progress-a1d0c6e83f027327d8461063f4ac58a6-15122694731.png', '2017-12-02 19:51:13', '2017-12-02 19:51:13', NULL),
(27, 43, 'laporan_19ca14e7ea6328a42e0eb13d585e4c22_Macet dijalan Soekarno Hatta 100 km/progress-17e62166fc8586dfa4d1bc0e1742c08b-15122701510.png', '2017-12-02 20:02:31', '2017-12-02 20:02:31', NULL),
(28, 44, 'laporan_19ca14e7ea6328a42e0eb13d585e4c22_Macet dijalan Soekarno Hatta 100 km/progress-f7177163c833dff4b38fc8d2872f1ec6-15122709660.png', '2017-12-02 20:16:06', '2017-12-02 20:16:06', NULL),
(29, 45, 'laporan_1c383cd30b7c298ab50293adfecb7b18_Kecelakaan tunggal/progress-6c8349cc7260ae62e3b1396831a8398f-15122714670.png', '2017-12-02 20:24:27', '2017-12-02 20:24:27', NULL),
(36, 52, 'laporan_19ca14e7ea6328a42e0eb13d585e4c22_Macet dijalan Soekarno Hatta 100 km/progress-9a1158154dfa42caddbd0694a4e9bdc8-15125578320.png', '2017-12-06 03:57:12', '2017-12-06 03:57:12', NULL),
(37, 53, 'laporan_a5bfc9e07964f8dddeb95fc584cd965d_Hello/progress-d82c8d1619ad8176d665453cfb2e55f0-15125578920.png', '2017-12-06 03:58:12', '2017-12-06 03:58:12', NULL),
(38, 54, 'laporan_19ca14e7ea6328a42e0eb13d585e4c22_Macet dijalan Soekarno Hatta 100 km/progress-a684eceee76fc522773286a895bc8436-15125588520.png', '2017-12-06 04:14:12', '2017-12-06 04:14:12', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `nama`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Jalan Rusak', 'Jalan Rusak', NULL, '2017-11-29 21:32:27', NULL),
(2, 'Macet', 'Jalan Macet', NULL, '2017-11-29 21:32:27', NULL),
(3, 'Kecelakaan', 'Ada kecelakaan', '2017-11-29 18:57:52', '2017-11-29 21:32:27', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatans`
--

CREATE TABLE `kecamatans` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kecamatans`
--

INSERT INTO `kecamatans` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Klojen', '2017-11-29 23:13:24', '2017-12-06 03:06:07', NULL),
(2, 'Blimbing', '2017-11-29 23:19:30', '2017-11-29 23:45:38', NULL),
(3, 'Kedung Kandang', '2017-11-29 23:19:39', '2017-11-29 23:45:38', NULL),
(4, 'Lowokwaru', '2017-11-29 23:19:50', '2017-11-29 23:45:38', NULL),
(5, 'Sukun', '2017-11-29 23:20:06', '2017-11-29 23:45:38', NULL),
(6, 'Palsu', '2017-12-06 03:09:42', '2017-12-06 03:09:45', '2017-12-06 03:09:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelurahans`
--

CREATE TABLE `kelurahans` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` int(10) UNSIGNED NOT NULL,
  `kodepos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelurahans`
--

INSERT INTO `kelurahans` (`id`, `nama`, `kecamatan`, `kodepos`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Klojen', 1, 65111, '2017-11-29 23:32:44', '2017-12-06 04:15:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentars`
--

CREATE TABLE `komentars` (
  `id` int(10) UNSIGNED NOT NULL,
  `laporan` int(10) UNSIGNED NOT NULL,
  `penduduk` int(10) UNSIGNED NOT NULL,
  `komentar` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `komentars`
--

INSERT INTO `komentars` (`id`, `laporan`, `penduduk`, `komentar`, `created_at`, `updated_at`, `deleted_at`) VALUES
(30, 33, 1, 'Rusak berat menyebabkan kecelakaan', '2017-11-17 05:30:16', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(31, 33, 1, 'Progress Palalu!', '2017-11-18 21:12:53', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(32, 33, 1, 'Tambah Progress lagi', '2017-11-18 21:13:33', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(33, 33, 1, 'Lelel', '2017-11-18 21:48:52', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(34, 33, 1, 'Entut', '2017-11-18 21:48:56', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(35, 33, 1, 'hm', '2017-11-18 21:49:55', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(36, 33, 1, 'kkk', '2017-11-27 03:07:49', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(37, 33, 4, 'Masuk Angin!', '2017-11-27 03:09:24', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(38, 34, 1, 'Macet 21 KM', '2017-11-27 04:45:33', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(39, 35, 1, 'Kecelakaan tunggal', '2017-11-30 00:54:37', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(40, 35, 4, 'w', '2017-12-01 06:36:39', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(41, 35, 4, 'aaa', '2017-12-01 06:37:57', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(42, 36, 7, 'Macet 100 Km!!!', '2017-12-02 19:51:13', '2017-12-06 04:11:39', NULL),
(43, 36, 7, '222', '2017-12-02 20:02:31', '2017-12-02 20:15:35', '2017-12-02 20:15:35'),
(44, 36, 7, 'Percobaan!!!!', '2017-12-02 20:16:06', '2017-12-02 20:16:46', NULL),
(45, 35, 7, 'aaaa', '2017-12-02 20:24:27', '2017-12-02 20:26:38', '2017-12-02 20:26:38'),
(52, 36, 10, 'Percobaa@@@n!!!!', '2017-12-06 03:57:12', '2017-12-06 03:57:12', NULL),
(53, 37, 10, 'Jalan Rusak!!', '2017-12-06 03:58:12', '2017-12-06 03:58:45', NULL),
(54, 36, 12, 'Boi1', '2017-12-06 04:14:12', '2017-12-06 04:14:12', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporans`
--

CREATE TABLE `laporans` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul_laporan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelapor` int(10) UNSIGNED NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelurahan` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `kategori` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `status` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporans`
--

INSERT INTO `laporans` (`id`, `judul_laporan`, `pelapor`, `lat`, `long`, `alamat`, `kelurahan`, `kategori`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(33, 'Jalan Rusak Berat', 1, '-7.969594', '112.636209', 'Jl. Cokroaminoto No.34, Klojen, Kota Malang, Jawa Timur 65111, Indonesia', 1, 3, 4, '2017-11-17 05:30:16', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(34, 'Macet dijalan Soekarno Hatta', 1, '-7.941763', '112.622315', 'Ruko Griya Shanta, Jl. Soekarno Hatta No.57, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65142, Indonesia', 1, 1, 2, '2017-11-27 04:45:33', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(35, 'Kecelakaan tunggal', 1, '-7.969594', '112.636209', 'Jl. Cokroaminoto No.34, Klojen, Kota Malang, Jawa Timur 65111, Indonesia', 1, 3, 4, '2017-11-30 00:54:37', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(36, 'Macet dijalan Soekarno Hatta 100 km', 7, '-7.969594', '112.636209', 'Jl. Cokroaminoto No.34, Klojen, Kota Malang, Jawa Timur 65111, Indonesia', 1, 1, 2, '2017-12-02 19:51:13', '2017-12-06 04:11:39', NULL),
(37, 'Boi!!!', 10, '-7.969594', '112.636209', 'Jl. Cokroaminoto No.34, Klojen, Kota Malang, Jawa Timur 65111, Indonesia', 1, 1, 3, '2017-12-06 03:58:12', '2017-12-06 04:12:40', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_11_17_052151_create_penduduks_table', 1),
(4, '2017_11_17_052152_create_penduduk_password_resets_table', 1),
(5, '2017_11_17_053511_create_adminisitrators_table', 1),
(6, '2017_11_17_053738_create_laporans_table', 1),
(7, '2017_11_17_053757_create_votes_table', 1),
(8, '2017_11_17_053821_create_detail_laporans_table', 1),
(9, '2017_11_17_053909_create_status_laporans_table', 1),
(10, '2017_11_17_053933_create_foto_laporans_table', 1),
(11, '2017_11_21_043558_create_status_penduduks_table', 2),
(12, '2017_11_27_081601_create_administrators_table', 3),
(13, '2017_11_27_081602_create_administrator_password_resets_table', 3),
(14, '2017_11_27_112107_create_kategoris_table', 4),
(15, '2017_11_30_055724_create_kecamatans_table', 5),
(16, '2017_11_30_055743_create_kelurahans_table', 5),
(17, '2017_12_01_071344_create_pertanggung-jawabans_table', 6),
(18, '2017_12_01_071739_create_biaya-perbaikans_table', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduks`
--

CREATE TABLE `penduduks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `url_foto` varchar(535) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_avatar.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activation_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penduduks`
--

INSERT INTO `penduduks` (`id`, `name`, `nik`, `email`, `password`, `status`, `url_foto`, `remember_token`, `activation_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ahmad Riyadh Al Faathin', '12345678901', 'ahmad.riyadh72@gmail.com', '$2y$10$9k1No5FTjQnhfxIl3oBReOCy4tdR7L5W1ax6y.u6V9Yn.H8woBA1u', 3, 'default_avatar.png', 'pEpFuQj1EVwFPyM54qFaD1sbbit80ZY8DceujHM6kE0OEdIIi6YK5jJr7P4s', '', '2017-11-16 23:06:08', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(2, 'Nama', '999999', 'r@m.com', '$2y$10$z5hvIjoEU1og7O0N.GlaC.QRTYNU/unUCtIL7X4556YmJTg3qs12q', 2, 'default_avatar.png', 'eqXu35KbE4BFsfZgahwGJpXPZl3jo3CCXlrm3O8LFXDeUwDTnfuZYADJSYL3', '', '2017-11-17 01:16:48', '2017-12-02 19:47:23', NULL),
(4, 'Moersali', '1191919191', 'joko@anwar.com', '$2y$10$V.B7b8O9eH0aUpVdgKemR.EWFLx2hadbVvIBcKslYET.MgCV5J5VG', 1, 'default_avatar.png', NULL, '', '2017-11-27 01:33:24', '2017-12-02 19:47:23', NULL),
(5, 'Robert', '999911199', '999911199.admin.joako@anwar.com', '$2y$10$9MaHv7veH9r1xiuqZ5Z5deF0cC8CWs2C8NPMKwkPdDmS6.vQJp.Hq', 3, 'default_avatar.png', NULL, '', '2017-11-27 02:29:38', '2017-12-06 03:06:44', '2017-12-06 03:06:44'),
(6, 'Robert', '1234567890', '1234567890.admin.root@me.com', '$2y$10$qnQx5e9cXmkW3HU7.onqFeeTW7wTDlKhCVUwBZoStSKWdBebWMpH.', 6, 'default_avatar.png', NULL, '', '2017-12-02 19:46:31', '2017-12-06 03:18:43', NULL),
(7, 'MemeLord', '999999999999', 'meme@lord.com', '$2y$10$iTKnl0bTjPNN3qGyuktiPO2fHamIhqeybe8PxN4u7l3YQ0zQE769O', 1, 'default_avatar.png', NULL, '', '2017-12-02 19:49:27', '2017-12-02 19:49:27', NULL),
(8, 'riyadh', '12345', '12345.admin.joko8joki@gmail.com', '$2y$10$y4VR5X0f.ZD848loqD3fd.u6vVWDdmru67hkR0v1cIKYBL1G9v9y2', 5, 'default_avatar.png', NULL, NULL, '2017-12-04 05:55:08', '2017-12-04 05:55:08', NULL),
(10, 'joko', '123456789011', 'joko8joki@gmail.com', '$2y$10$A1qyo9wXii75PWUM5cXRbOkY2KlQ9gtwDK5HSrmUyXG8vYVe1.8.6', 2, 'default_avatar.png', NULL, '', '2017-12-04 05:57:46', '2017-12-04 06:02:15', NULL),
(11, 'Ahmad Riyadh Al Faathin', '9292929292', '9292929292.admin.riyadh11@live.com', '$2y$10$cjk5droAMm0DK1ZsKVpn0OO6Uw5mxxIzI3F0muUZhS9fRhOt23U3C', 5, 'default_avatar.png', NULL, NULL, '2017-12-04 06:11:03', '2017-12-04 06:11:03', NULL),
(12, 'joko', '99999', '99999.admin.riyadh11@live.com', '$2y$10$f1t9rcJVdsLo350zcxMQKOlkrI78.ZUFUSz9xQ6YxJL5Qy.4o8dxK', 6, 'default_avatar.png', NULL, NULL, '2017-12-04 06:16:29', '2017-12-04 06:16:29', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk_password_resets`
--

CREATE TABLE `penduduk_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanggung_jawabans`
--

CREATE TABLE `pertanggung_jawabans` (
  `id` int(10) UNSIGNED NOT NULL,
  `laporan` int(10) UNSIGNED NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kendala` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `solusi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `administrator` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `pertanggung_jawabans`
--

INSERT INTO `pertanggung_jawabans` (`id`, `laporan`, `keterangan`, `kendala`, `solusi`, `administrator`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11, 35, 'Sudah selesai', 'Lancar bos', 'Lancar semua', 1, '2017-12-01 01:33:59', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(12, 33, 'Percobaan', 'Percobaan Kendala', 'Percobaan Solusi', 1, '2017-12-01 07:02:05', '2017-12-06 03:06:33', '2017-12-06 03:06:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_laporans`
--

CREATE TABLE `status_laporans` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fa fa-image',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `status_laporans`
--

INSERT INTO `status_laporans` (`id`, `nama`, `deskripsi`, `icon`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Diterima', 'Laporan sudah diterima sistem!', 'fa fa-image!', NULL, '2017-11-29 21:45:59', NULL),
(2, 'Diproses', 'Laporan sedang diproses', 'fa fa-image', NULL, '2017-11-29 21:45:59', NULL),
(3, 'Menunggu', 'Laporan sedang menunggu feedback dari pelapor', 'fa fa-image', NULL, '2017-11-29 21:45:59', NULL),
(4, 'Selesai', 'Laporan Sudah Selesai', 'fa fa-image', NULL, '2017-11-29 21:45:59', NULL),
(5, 'Ditutup', 'Laporan Ditutup', 'fa fa-image!', '2017-11-29 19:10:34', '2017-11-29 21:45:59', NULL),
(6, 'Palsu', 'Palsu', 'Palsu', '2017-12-06 03:10:25', '2017-12-06 03:10:28', '2017-12-06 03:10:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_penduduks`
--

CREATE TABLE `status_penduduks` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `status_penduduks`
--

INSERT INTO `status_penduduks` (`id`, `nama`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Belum Aktif', 'Belum diaktivasi', NULL, '2017-12-06 03:06:21', NULL),
(2, 'Aktif penduduk', 'Sudah Aktif Penduduk', NULL, '2017-11-29 21:56:18', NULL),
(3, 'Banned', 'Banned Permanent', NULL, '2017-11-29 21:56:18', NULL),
(4, 'Deaktivasi', 'Nonaktif', NULL, '2017-11-29 21:56:18', NULL),
(5, 'Pending Admin', 'Pending sebagai Admin', NULL, '2017-11-29 21:56:18', NULL),
(6, 'Aktif Admin', 'Aktif Admin', NULL, '2017-11-29 21:56:18', NULL),
(7, 'Banned Admin', 'Admin Banned', NULL, '2017-11-29 21:56:18', NULL),
(8, 'Retired Admin', 'Mantan Admin', NULL, '2017-11-29 21:56:18', NULL),
(9, 'Palsu', 'Palsu', '2017-12-06 03:10:03', '2017-12-06 03:10:09', '2017-12-06 03:10:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `votes`
--

CREATE TABLE `votes` (
  `id` int(10) UNSIGNED NOT NULL,
  `laporan` int(10) UNSIGNED NOT NULL,
  `voter` int(10) UNSIGNED NOT NULL,
  `like` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `votes`
--

INSERT INTO `votes` (`id`, `laporan`, `voter`, `like`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 30, 1, 1, '2017-11-20 21:07:18', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(2, 31, 1, 1, '2017-11-20 21:08:55', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(3, 34, 1, 1, '2017-11-20 21:12:41', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(4, 32, 1, 0, '2017-11-20 21:19:08', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(5, 35, 1, 0, '2017-11-20 21:19:18', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(6, 42, 7, 1, '2017-12-02 19:55:10', '2017-12-02 20:15:47', NULL),
(7, 39, 7, 1, '2017-12-02 20:23:24', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(8, 40, 7, 1, '2017-12-02 20:23:32', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(9, 41, 7, 1, '2017-12-02 20:23:35', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(10, 37, 7, 1, '2017-12-02 20:34:18', '2017-12-06 03:06:33', '2017-12-06 03:06:33'),
(11, 42, 10, 0, '2017-12-06 03:43:45', '2017-12-06 03:44:19', NULL),
(12, 44, 10, 0, '2017-12-06 03:43:57', '2017-12-06 03:44:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `administrators_email_unique` (`email`),
  ADD KEY `administrator__ibfk_penduduk` (`penduduk`);

--
-- Indexes for table `administrator_password_resets`
--
ALTER TABLE `administrator_password_resets`
  ADD KEY `administrator_password_resets_email_index` (`email`),
  ADD KEY `administrator_password_resets_token_index` (`token`);

--
-- Indexes for table `biaya_perbaikans`
--
ALTER TABLE `biaya_perbaikans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `biaya__ibfk__lpj` (`laporan`);

--
-- Indexes for table `foto_laporans`
--
ALTER TABLE `foto_laporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto__ibfk__detail` (`laporan`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatans`
--
ALTER TABLE `kecamatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelurahans`
--
ALTER TABLE `kelurahans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelurahan__ibfk__kecamatan` (`kecamatan`);

--
-- Indexes for table `komentars`
--
ALTER TABLE `komentars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail__ibfk__laporan` (`laporan`),
  ADD KEY `detail__ibfk__penduduk` (`penduduk`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan__ibfk__penduduk` (`pelapor`),
  ADD KEY `laporan__ibfk__kategori` (`kategori`),
  ADD KEY `laporan__ibfk__status` (`status`),
  ADD KEY `laporan__ibfk__kelurahan` (`kelurahan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penduduks`
--
ALTER TABLE `penduduks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penduduks_email_unique` (`email`),
  ADD KEY `penduduk__ibfk__status` (`status`);

--
-- Indexes for table `penduduk_password_resets`
--
ALTER TABLE `penduduk_password_resets`
  ADD KEY `penduduk_password_resets_email_index` (`email`),
  ADD KEY `penduduk_password_resets_token_index` (`token`);

--
-- Indexes for table `pertanggung_jawabans`
--
ALTER TABLE `pertanggung_jawabans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lpj__ibfk__laporan` (`laporan`);

--
-- Indexes for table `status_laporans`
--
ALTER TABLE `status_laporans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_penduduks`
--
ALTER TABLE `status_penduduks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `votes__ibfk__detail` (`laporan`),
  ADD KEY `votes__ibfk__penduduk` (`voter`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `biaya_perbaikans`
--
ALTER TABLE `biaya_perbaikans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `foto_laporans`
--
ALTER TABLE `foto_laporans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kecamatans`
--
ALTER TABLE `kecamatans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelurahans`
--
ALTER TABLE `kelurahans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `komentars`
--
ALTER TABLE `komentars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `penduduks`
--
ALTER TABLE `penduduks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pertanggung_jawabans`
--
ALTER TABLE `pertanggung_jawabans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `status_laporans`
--
ALTER TABLE `status_laporans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `status_penduduks`
--
ALTER TABLE `status_penduduks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `administrators`
--
ALTER TABLE `administrators`
  ADD CONSTRAINT `administrator__ibfk_penduduk` FOREIGN KEY (`penduduk`) REFERENCES `penduduks` (`id`);

--
-- Ketidakleluasaan untuk tabel `biaya_perbaikans`
--
ALTER TABLE `biaya_perbaikans`
  ADD CONSTRAINT `biaya__ibfk__lpj` FOREIGN KEY (`laporan`) REFERENCES `pertanggung_jawabans` (`id`);

--
-- Ketidakleluasaan untuk tabel `foto_laporans`
--
ALTER TABLE `foto_laporans`
  ADD CONSTRAINT `foto__ibfk__detail` FOREIGN KEY (`laporan`) REFERENCES `komentars` (`id`);

--
-- Ketidakleluasaan untuk tabel `kelurahans`
--
ALTER TABLE `kelurahans`
  ADD CONSTRAINT `kelurahan__ibfk__kecamatan` FOREIGN KEY (`kecamatan`) REFERENCES `kecamatans` (`id`);

--
-- Ketidakleluasaan untuk tabel `komentars`
--
ALTER TABLE `komentars`
  ADD CONSTRAINT `detail__ibfk__laporan` FOREIGN KEY (`laporan`) REFERENCES `laporans` (`id`),
  ADD CONSTRAINT `detail__ibfk__penduduk` FOREIGN KEY (`penduduk`) REFERENCES `penduduks` (`id`);

--
-- Ketidakleluasaan untuk tabel `laporans`
--
ALTER TABLE `laporans`
  ADD CONSTRAINT `laporan__ibfk__kategori` FOREIGN KEY (`kategori`) REFERENCES `kategoris` (`id`),
  ADD CONSTRAINT `laporan__ibfk__kelurahan` FOREIGN KEY (`kelurahan`) REFERENCES `kelurahans` (`id`),
  ADD CONSTRAINT `laporan__ibfk__penduduk` FOREIGN KEY (`pelapor`) REFERENCES `penduduks` (`id`),
  ADD CONSTRAINT `laporan__ibfk__status` FOREIGN KEY (`status`) REFERENCES `status_laporans` (`id`);

--
-- Ketidakleluasaan untuk tabel `penduduks`
--
ALTER TABLE `penduduks`
  ADD CONSTRAINT `penduduk__ibfk__status` FOREIGN KEY (`status`) REFERENCES `status_penduduks` (`id`);

--
-- Ketidakleluasaan untuk tabel `pertanggung_jawabans`
--
ALTER TABLE `pertanggung_jawabans`
  ADD CONSTRAINT `lpj__ibfk__laporan` FOREIGN KEY (`laporan`) REFERENCES `laporans` (`id`);

--
-- Ketidakleluasaan untuk tabel `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes__ibfk__detail` FOREIGN KEY (`laporan`) REFERENCES `komentars` (`id`),
  ADD CONSTRAINT `votes__ibfk__penduduk` FOREIGN KEY (`voter`) REFERENCES `penduduks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
