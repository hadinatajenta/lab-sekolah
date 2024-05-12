-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for lab_kommputer
CREATE DATABASE IF NOT EXISTS `lab_kommputer` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lab_kommputer`;

-- Dumping structure for table lab_kommputer.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lab_kommputer.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table lab_kommputer.jadwal_lab
CREATE TABLE IF NOT EXISTS `jadwal_lab` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lab_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `mata_pelajaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Belum mulai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwal_lab_lab_id_foreign` (`lab_id`),
  KEY `jadwal_lab_user_id_foreign` (`user_id`),
  KEY `jadwal_lab_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `jadwal_lab_lab_id_foreign` FOREIGN KEY (`lab_id`) REFERENCES `lab` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lab_kommputer.jadwal_lab: ~8 rows (approximately)
INSERT IGNORE INTO `jadwal_lab` (`id`, `lab_id`, `user_id`, `kelas_id`, `mata_pelajaran`, `tanggal`, `waktu_mulai`, `waktu_selesai`, `status`, `created_at`, `updated_at`) VALUES
	(24, 1, 14, 1, 'IPA', '2024-03-24', '18:00:00', '19:00:00', 'Menunggu', '2024-03-04 08:09:23', '2024-03-04 08:09:23'),
	(25, 2, 14, 9, 'Komputer', '2024-03-28', '18:00:00', '21:00:00', 'Selesai', '2024-03-04 08:11:13', '2024-05-11 06:37:21'),
	(26, 1, 15, 1, '1212212', '2024-04-28', '18:00:00', '19:00:00', 'Dijadwalkan', '2024-05-02 23:42:12', '2024-05-02 23:42:12'),
	(27, 1, 15, 1, 'TIK', '2024-05-08', '08:00:00', '10:00:00', 'Dijadwalkan', '2024-05-03 08:59:34', '2024-05-03 08:59:34'),
	(28, 1, 15, 1, 'TIK', '2024-05-03', '10:00:00', '12:00:00', 'Dijadwalkan', '2024-05-03 09:00:10', '2024-05-03 09:00:10'),
	(29, 1, 15, 2, 'Biologi', '2024-05-03', '13:00:00', '14:00:00', 'Berjalan', '2024-05-03 09:00:40', '2024-05-03 09:20:24'),
	(31, 2, 15, 1, 'TIK', '2024-05-05', '23:00:00', '23:59:00', 'Dijadwalkan', '2024-05-04 08:20:21', '2024-05-04 08:20:21'),
	(32, 2, 15, 8, 'TIK', '2024-05-04', '23:01:00', '23:15:00', 'Dijadwalkan', '2024-05-04 08:23:18', '2024-05-04 08:23:18');

-- Dumping structure for table lab_kommputer.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wali_kelas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lab_kommputer.kelas: ~6 rows (approximately)
INSERT IGNORE INTO `kelas` (`id`, `nama_kelas`, `wali_kelas`, `created_at`, `updated_at`) VALUES
	(1, '7A', 'Dra. Winna Jayadi', '2024-02-01 19:23:24', '2024-05-11 22:49:41'),
	(6, '8D', 'Prof. Dr. kabilator Bocor', '2024-02-10 08:24:44', '2024-05-11 22:50:13'),
	(7, '8B', 'Ir. Sumbul', '2024-02-10 08:24:57', '2024-02-28 00:23:42'),
	(8, '7C', 'Dra. Sudirman', '2024-02-11 22:47:12', '2024-02-28 00:23:32'),
	(10, '8F', 'Jamal Jamet', '2024-05-10 01:35:15', '2024-05-10 01:35:15'),
	(11, '9K', 'Inna', '2024-05-11 22:48:30', '2024-05-11 22:49:24');

-- Dumping structure for table lab_kommputer.lab
CREATE TABLE IF NOT EXISTS `lab` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_lab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `fasilitas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Tersedia','Tidak tersedia') COLLATE utf8mb4_unicode_ci DEFAULT 'Tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lab_kommputer.lab: ~3 rows (approximately)
INSERT IGNORE INTO `lab` (`id`, `nama_lab`, `kapasitas`, `fasilitas`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Lab IPA', '30', 'aaa', 'Tidak tersedia', '2024-02-02 02:25:31', '2024-05-04 08:17:56'),
	(2, 'Lab Komputer', '100', 'Komputer', 'Tersedia', '2024-02-02 02:27:33', '2024-02-02 02:27:33'),
	(4, 'LAB Fisika', '30', 'abc acbacab', 'Tersedia', '2024-02-10 08:47:24', '2024-03-04 06:46:57');

-- Dumping structure for table lab_kommputer.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lab_kommputer.migrations: ~16 rows (approximately)
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_02_01_065204_create_roles_table', 2),
	(7, '2024_02_01_071612_create_roles_table', 3),
	(8, '2024_02_01_071759_add_role_id_to_users_table', 4),
	(9, '2024_02_01_095202_create_kelas_table', 5),
	(10, '2024_02_01_100706_create_lab_table', 6),
	(11, '2024_02_01_102121_create_jadwal_lab_table', 7),
	(12, '2024_02_02_005435_add_fasilitas_to_lab_table', 8),
	(13, '2024_02_02_010039_modify_jadwal_lab_table', 9),
	(14, '2024_02_02_021127_add_wali_kelas_to_kelas_table', 10),
	(15, '2024_02_02_072918_add_column_to_users_table', 11),
	(16, '2024_02_05_023722_drop_status_column_from_lab_table', 12),
	(17, '2024_02_05_033026_add_status_to_lab_table', 13),
	(18, '2024_05_04_145708_add_foto_profil_to_users_table', 14),
	(19, '2024_05_06_143310_add_kelas_id_to_users_table', 15);

-- Dumping structure for table lab_kommputer.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lab_kommputer.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table lab_kommputer.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lab_kommputer.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table lab_kommputer.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lab_kommputer.roles: ~4 rows (approximately)
INSERT IGNORE INTO `roles` (`id`, `role_name`, `jumlah_user`, `created_at`, `updated_at`) VALUES
	(1, 'Laboran', '1', NULL, '2024-05-03 09:11:04'),
	(3, 'Guru', '4', NULL, '2024-05-11 06:35:10'),
	(4, 'Siswa', '0', NULL, '2024-05-03 15:54:51');

-- Dumping structure for table lab_kommputer.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_belakang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `tanggal_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table lab_kommputer.users: ~12 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `role_id`, `name`, `nama_belakang`, `email`, `nomor_telepon`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `foto_profil`, `kelas_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Jamal', NULL, 'hadi@gmail.com', NULL, NULL, NULL, NULL, 'code.png', NULL, NULL, '$2y$12$q/C/BawM67kSzCmvQGfffOZVpVPHsJo6qau478cPbSxCEgOOutxkK', 'LHfsjltJo5PNneo2H6oXYN2cmP64MF2ClQBOllUKv9xqdAV4jI0bUBR6SUBO', '2024-02-01 03:34:08', '2024-05-06 06:17:58'),
	(14, 3, 'Vina Septiana', NULL, 'vina@gmail.com', NULL, NULL, NULL, NULL, '', NULL, NULL, '$2y$12$eA.vp7/tyQCk0orThOqYuOqR4SDoq18QyIy.iyvF4OLkArCaH1OR.', NULL, '2024-03-04 07:43:16', '2024-03-04 07:43:16'),
	(18, 3, 'Tester 1', NULL, 'tester@gmail.com', NULL, NULL, NULL, NULL, ' ', NULL, NULL, '$2y$12$ol0GdPw2gyQZ2F3GBOzjKeKmhxkEqH8ODzrsFUbo0VUy1KpukONYm', NULL, '2024-05-06 06:40:26', '2024-05-06 06:40:26'),
	(20, 4, 'Siswa 2', NULL, 'siswa2@gmail.com', NULL, NULL, NULL, 'Laki-laki', '', '1', NULL, '$2y$12$RofENd2zt7jjp9rDMxMBJ.3aIjdks9270v5R3e0a/TwoZfK.WmGTi', NULL, '2024-05-06 07:55:58', '2024-05-09 11:54:20'),
	(21, 4, 'Siswa 3', NULL, 'siswa3@gmail.com', NULL, NULL, NULL, NULL, '', '6', NULL, '$2y$12$BtbwfistmMC/5ACNJOvWc.4mrFHROocDigxH3pxkar9zsq90jrnLe', NULL, '2024-05-06 08:27:39', '2024-05-06 08:27:39'),
	(22, 4, 'Siswa 4', NULL, 'siswa4@gmailcom', NULL, NULL, NULL, NULL, '', '1', NULL, '$2y$12$g.mGQ98U4iduxgHzXTgaP.TDUvv9J8eD1vWLwkuzGjwb0BrQ4Vdpu', NULL, '2024-05-07 00:28:02', '2024-05-07 00:28:02'),
	(23, 4, 'Siswa 5', NULL, 'siswwa5@gmail.com', NULL, NULL, NULL, NULL, '', '1', NULL, '$2y$12$t38Z7sDgNCSptLyQCeRm2OTWXWNjLAmgAr45nHzgYYYdyakuU4xK2', NULL, '2024-05-07 00:34:09', '2024-05-07 00:34:09'),
	(24, 3, 'Guru 1', NULL, 'guru@gmail.com', NULL, NULL, NULL, NULL, ' ', NULL, NULL, '$2y$12$iUzye2JuWfk35UotcguoZ.4N5NHFxDbKUxbrVZpVLBuMF0MENzQ8a', NULL, '2024-05-07 08:57:41', '2024-05-07 08:57:41'),
	(25, 4, 'Test Siswa', NULL, 'siswatest@gmail.com', NULL, NULL, NULL, NULL, '', '1', NULL, '$2y$12$QW3/8pj7TmsReeKgbYvedOUvUYXxuJ/b4832zgzIaQLts4CRW1VYa', NULL, '2024-05-09 11:24:15', '2024-05-09 11:24:15'),
	(27, 4, 'Siswa test', NULL, 'siswatesterr@gmail.com', NULL, NULL, NULL, NULL, '', '1', NULL, '$2y$12$ujw7zx2rWJtNdy5RCaWhYu/sp5owTgp0bP0yaAlRf.BTwU51VaJn6', NULL, '2024-05-10 01:44:56', '2024-05-10 01:44:56'),
	(29, 4, 'Agusss', NULL, 'testergmail@gmail.com', NULL, NULL, NULL, NULL, '', '6', NULL, '$2y$12$LR9o8uzEv8yh1zzRLmWfEOyOtMdVOtK4nQN2DSgTuFkQgDAtXGgqq', NULL, '2024-05-10 05:31:42', '2024-05-10 05:31:42'),
	(30, 3, 'Guru 1', NULL, 'guruuu@gmail.com', NULL, NULL, NULL, NULL, ' ', NULL, NULL, '$2y$12$P6.qNTmzuP4X24YY95oR5e46.CLQsnBLSyU15L8Vk10HJVTCVsZEC', NULL, '2024-05-11 06:35:10', '2024-05-11 06:35:10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
