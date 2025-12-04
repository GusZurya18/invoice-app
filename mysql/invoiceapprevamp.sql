-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2025 pada 07.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoiceapprevamp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Elektronik', 'Barang barang elektronik', '2025-09-10 18:42:27', '2025-09-10 18:42:27', 'active'),
(2, 'Furniture', NULL, '2025-09-17 19:52:29', '2025-09-17 19:52:29', 'active'),
(3, 'Barang Bekas', 'Barang bekas rusak dan sudah tidak berguna', '2025-09-24 20:09:22', '2025-09-24 20:09:22', 'active'),
(4, 'Minecraft Builds', 'Bangunan Bangunan Minecraft yang terbuat dari block block kecil Buatan Agus Suka Nugraha', '2025-09-28 20:44:56', '2025-09-28 20:44:56', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `company_settings`
--

CREATE TABLE `company_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'Indonesia',
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `npwp` varchar(255) NOT NULL,
  `siup_tdp` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `tax_rate` decimal(5,2) NOT NULL DEFAULT 11.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `company_settings`
--

INSERT INTO `company_settings` (`id`, `company_name`, `logo`, `address`, `city`, `province`, `postal_code`, `country`, `phone`, `email`, `website`, `fax`, `npwp`, `siup_tdp`, `bank_name`, `account_number`, `account_holder_name`, `tax_rate`, `created_at`, `updated_at`) VALUES
(1, 'Suka YT Build', 'company-logos/mU3HZhnpdsMI1uRDi8NTMLoEtteLKyAwp4mqvf7E.png', 'Jalan Noja', 'Denpasar', 'Bali', '80324', 'Indonesia', '1251251241', 'PutuSukaYT@Business.com', 'https://PutuSukaYT.com', '+62 875 874839', '10.200.300.4-500.600', '1512', 'Bank BCA', '3523623523', 'I Putu Agus Suka Nugraha', 11.00, '2025-10-21 18:45:25', '2025-11-06 20:38:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Agra', 'agra12345@gmail.com', '087864987907', 'Jl Noja Ratna No 19', '2025-09-10 18:42:02', '2025-09-10 18:42:02', 'active'),
(2, 'Surya', 'surya12345@gmail.com', '88888888888', 'Jalan Noja Dukuh No.1 Kesiman Petilan', '2025-09-24 20:49:35', '2025-09-24 20:49:35', 'active'),
(3, 'Prabroro', 'prabrorohigh@gmail.com', '1241251', 'Jl Kenangan Mantan', '2025-10-07 22:37:51', '2025-10-07 22:37:51', 'active'),
(4, 'Bayu', 'bayudharma@gmail.com', '8888888888', 'JL Gadung GG XIII', '2025-10-13 23:02:05', '2025-10-13 23:02:05', 'active'),
(5, 'DODO GANTENG', 'dodo123@gmail.com', '887879387493', 'Jalan Noja', '2025-11-06 20:32:48', '2025-11-06 20:32:48', 'active'),
(6, 'DODO GANTENG', 'dodo12345@gmail.com', '8673942837483', 'Jalan Noja', '2025-11-06 20:35:43', '2025-11-06 20:35:43', 'active'),
(7, 'Putu Agus', 'SukaLaravel234@gmail.com', '01251251241', 'Jalan Noja Dukuh No.1 Kesiman Petilan', '2025-11-06 20:36:07', '2025-11-06 20:36:07', 'active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('draft','pending','paid','cancelled') NOT NULL DEFAULT 'pending',
  `total_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount_percent` decimal(5,2) NOT NULL DEFAULT 0.00,
  `tax_rate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `paid_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `invoices`
--

INSERT INTO `invoices` (`id`, `code`, `customer_id`, `status`, `total_amount`, `discount_percent`, `tax_rate`, `notes`, `payment_proof`, `created_at`, `updated_at`, `start_date`, `due_date`, `paid_status`) VALUES
(2, 'INV1757560049', 1, 'paid', 37800000.00, 10.00, 0.00, 'Terimakasih', 'payments/1Sfl1BsSxe7YVMUyH2hq0UloDb5ln9he8DBdVkHy.png', '2025-09-10 19:07:29', '2025-09-22 19:31:31', '2025-09-11', '2025-09-12', 'done'),
(3, 'INV1757562055', 1, 'paid', 19000000.00, 5.00, 0.00, NULL, 'payments/33sHQAGRO7dKOR3sWsVa4XdNsh2aOjsA3UHqDk4Q.png', '2025-09-10 19:40:55', '2025-09-22 19:31:23', '2025-09-11', '2025-09-12', 'done'),
(4, 'INV1758167761', 1, 'paid', 2339100.00, 10.00, 0.00, NULL, 'payments/vKKuquBSjWhjsyTokauNqCqQKkbYSjUN15l14Q9r.jpg', '2025-09-17 19:56:01', '2025-09-22 19:31:14', '2025-09-18', '2025-09-20', 'done'),
(11, 'INV1758598240', 1, 'paid', 2599000.00, 0.00, 0.00, NULL, NULL, '2025-09-22 19:30:40', '2025-09-22 19:31:57', '2025-09-23', '2025-09-24', 'done'),
(12, 'INV1758766663', 1, 'paid', 20000000.00, 0.00, 0.00, NULL, 'payments/FkuPG96jRmhbPqeIOpnqRpje3mfHqiQp13O7iXSP.png', '2025-09-24 18:17:43', '2025-09-24 19:23:29', '2025-09-25', '2025-09-26', 'done'),
(13, 'INV1758770518', 1, 'paid', 21000000.00, 0.00, 0.00, NULL, NULL, '2025-09-24 19:21:58', '2025-10-05 06:21:30', '2025-09-25', '2025-09-26', 'done'),
(16, 'INV1759674137', 2, 'paid', 24839099.10, 10.00, 0.00, 'asdwasdwasd', 'payments/6uOJWjzXzFgD5a4kXF0kZvyAI4FQcv26yMGkS6pX.png', '2025-10-05 06:22:17', '2025-10-05 06:22:58', '2025-10-05', '2025-10-06', 'done'),
(17, 'INV1759719292', 2, 'pending', 359100.00, 10.00, 0.00, NULL, NULL, '2025-10-05 18:54:52', '2025-10-06 19:17:28', '2025-10-06', '2025-10-07', 'overdue'),
(18, 'INV1759719316', 2, 'pending', 898000.00, 0.00, 0.00, NULL, NULL, '2025-10-05 18:55:16', '2025-10-06 19:17:28', '2025-10-06', '2025-10-07', 'overdue'),
(19, 'INV1759719343', 1, 'pending', 1422150.00, 5.00, 0.00, NULL, NULL, '2025-10-05 18:55:43', '2025-10-06 19:17:28', '2025-10-06', '2025-10-07', 'overdue'),
(26, 'INV1760425089', 1, 'paid', 3590406.00, 10.00, 11.00, 'inget bayar woi', 'payments/JE6XuipBhcFXAGnneV8shjOa9sIhunklRFUeCkou.png', '2025-10-13 22:58:09', '2025-10-21 20:04:16', '2025-10-14', '2025-10-15', 'done'),
(27, 'INV1761193357', 4, 'paid', 1695303.00, 10.00, 11.00, 'tolong bayar segera', NULL, '2025-10-22 20:22:37', '2025-11-06 18:46:39', '2025-10-23', '2025-10-24', 'overdue');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `product_id`, `product_name`, `quantity`, `unit_price`, `total`, `created_at`, `updated_at`) VALUES
(16, 2, 2, 'Iphone 16 Pro MAX', 2, 21000000.00, 42000000.00, '2025-09-22 19:31:31', '2025-09-22 19:31:31'),
(29, 13, 2, 'Iphone 16 Pro MAX', 1, 21000000.00, 21000000.00, '2025-10-05 06:21:30', '2025-10-05 06:21:30'),
(32, 16, 1, 'Laptop ASUS ROG 7 Gaming', 1, 24999999.00, 24999999.00, '2025-10-05 06:22:58', '2025-10-05 06:22:58'),
(36, 17, 8, 'Hell Dragon PVP Arena | 500 x 500', 1, 399000.00, 399000.00, '2025-10-05 18:54:52', '2025-10-05 18:54:52'),
(37, 18, 7, 'Nocturnus Dominions HUB | 300 x 300', 1, 599000.00, 599000.00, '2025-10-05 18:55:16', '2025-10-05 18:55:16'),
(39, 19, 6, 'Blue Elven Faction Spawn | 500 x 500', 3, 499000.00, 1497000.00, '2025-10-05 18:55:43', '2025-10-05 18:55:43'),
(60, 26, 13, 'Space Zone 300x300 | FACTION', 1, 299000.00, 299000.00, '2025-10-21 20:04:16', '2025-10-21 20:04:16'),
(61, 26, 6, 'Blue Elven Faction Spawn | 500 x 500', 1, 499000.00, 499000.00, '2025-10-21 20:04:16', '2025-10-21 20:04:16'),
(62, 26, 15, 'Abandoned Apocalypse Industrial | 500 x 500', 1, 599000.00, 599000.00, '2025-10-21 20:04:16', '2025-10-21 20:04:16'),
(63, 26, 16, 'Whirlygig Fallguys Map | 500 x Diameter', 1, 199000.00, 199000.00, '2025-10-21 20:04:16', '2025-10-21 20:04:16'),
(64, 26, 18, 'Nocturnus Dominions HUB | 300 x 300 | BEST SALES!', 2, 999000.00, 1998000.00, '2025-10-21 20:04:16', '2025-10-21 20:04:16'),
(65, 27, 6, 'Blue Elven Faction Spawn | 500 x 500', 1, 499000.00, 499000.00, '2025-10-22 20:22:37', '2025-10-22 20:22:37'),
(66, 27, 18, 'Nocturnus Dominions HUB | 300 x 300 | BEST SALES!', 1, 999000.00, 999000.00, '2025-10-22 20:22:37', '2025-10-22 20:22:37'),
(67, 27, 16, 'Whirlygig Fallguys Map | 500 x Diameter', 1, 199000.00, 199000.00, '2025-10-22 20:22:37', '2025-10-22 20:22:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_29_000004_create_customers_table', 1),
(5, '2025_08_29_000005_create_categories_table', 1),
(6, '2025_08_29_000006_create_products_table', 1),
(7, '2025_08_29_000007_create_invoices_table', 1),
(8, '2025_08_29_000008_create_invoice_items_table', 1),
(9, '2025_09_03_052324_add_role_to_users_table', 2),
(10, '2025_09_03_084100_add_dates_and_paid_status_to_invoices_table', 2),
(11, '2025_09_08_072612_add_status_to_customers_table', 2),
(12, '2025_09_08_074405_add_status_to_categories_table', 2),
(13, '2025_08_29_071001_add_total_amount_to_invoices_table', 3),
(14, '2025_10_07_000011_create_tasks_table', 3),
(15, '2025_10_07_000012_create_task_comments_table', 3),
(16, '2025_10_07_000013_create_task_files_table', 3),
(17, '2025_10_07_000014_add_priority_to_tasks_table', 3),
(18, '2025_10_07_000015_add_start_date_to_tasks_table', 3),
(19, '2025_10_22_022920_create_company_settings_table', 4),
(20, '2025_10_22_024706_add_tax_rate_to_invoices_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `photo` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `photo`, `stock`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Laptop ASUS ROG 7 Gaming', 1, 24999999.00, 'products/H6zEISW6HIUzUNzzXX3fN1DwEDIRbxwKbgq7Z2oY.png', 9, 'Laptop berkekuatan turbo gacor buat main GTA 5', '2025-09-10 18:43:15', '2025-10-05 06:23:43'),
(2, 'Iphone 16 Pro MAX', 1, 21000000.00, 'products/qt2M1ZQmwMGzMzxPaMFEI8UUlYsiE33hAWYan9Lh.jpg', 96, 'HP TERKUAT DI BUMI', '2025-09-10 19:06:51', '2025-10-05 06:21:30'),
(6, 'Blue Elven Faction Spawn | 500 x 500', 4, 499000.00, 'products/l0bWbtURtHOXPoWqYsUvyipLB7fvW2p5QfQEDpP6.png', 98, 'Minecraft lobby ideals for faction spawn in Minecraft', '2025-09-28 20:48:42', '2025-10-22 20:22:37'),
(7, 'Nocturnus Dominions HUB | 300 x 300', 4, 599000.00, 'products/FAvBrl4S1AQkq17aozEbfsgoBnwPbhgzzyFyHpNp.png', 100, 'Minecraft Build ideals for hub or lobby', '2025-09-28 20:49:34', '2025-09-28 20:49:34'),
(8, 'Hell Dragon PVP Arena | 500 x 500', 4, 399000.00, 'products/qWtoJAwuJi4MePfYj8JDIaUFny4OIJglyIa6MyT8.png', 100, 'Minecraft Builds Ideal for PVP', '2025-09-28 20:50:57', '2025-09-28 23:05:42'),
(13, 'Space Zone 300x300 | FACTION', 4, 299000.00, 'products/wiLLJxNVEDgfpJRFn2vN7hlUkBXPR2zRJHTLdbji.png', 9, NULL, '2025-10-06 20:17:28', '2025-10-21 20:04:16'),
(14, 'Blue Elven Faction Spawn | 500 x 500 | LIMITED', 4, 599000.00, 'products/37SblHzifxMMHVpNFyRFc4aDAuzZeyFD3I6q5Rrz.png', 10, 'Minecraft faction build', '2025-10-07 19:12:23', '2025-10-07 19:12:23'),
(15, 'Abandoned Apocalypse Industrial | 500 x 500', 4, 599000.00, 'products/hZUurjpYPh4YKBix8z3SFnqsc5IB8zEGz18mb2i6.jpg', 19, 'Minecraft build for zombie apocalypse game', '2025-10-07 19:13:28', '2025-10-21 20:04:16'),
(16, 'Whirlygig Fallguys Map | 500 x Diameter', 4, 199000.00, 'products/b46GGBdA5x00QaZGOPbYZuLJwyV0cH7aFiqhHvKc.png', 97, 'Minecraft whirlygig map fallguys replika', '2025-10-07 19:14:25', '2025-10-22 20:22:37'),
(17, 'Hell Dragon PVP Arena | 500 x 500 | PVP ARENA', 4, 399000.00, 'products/NPwP0xOW15vQGv8YOODWuGaltDgdryIl7qbdH1Z6.png', 99, 'Minecraft pvp arena with hell theme', '2025-10-07 19:15:13', '2025-10-07 19:15:13'),
(18, 'Nocturnus Dominions HUB | 300 x 300 | BEST SALES!', 4, 999000.00, 'products/c3vTuN4TGvNkB2KZ5EGX2OdahK9tTVQhj5vcZfGy.png', 7, 'Minecraft structures with dark purple color and magical surroundings', '2025-10-07 19:16:24', '2025-10-22 20:22:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('efGM8tjIZy9EoEiGYj4LE7K4xR1PUDgZLiAlV0DA', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibVZwbzBDc01MbmFQNkpWUlMwanJtcmQwd3I5bGtKbjRQcGNSa1p2MiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi90YXNrcyI7czo1OiJyb3V0ZSI7czoxNzoiYWRtaW4udGFza3MuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1762498000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','in_progress','done') NOT NULL DEFAULT 'pending',
  `start_date` date DEFAULT NULL,
  `priority` enum('low','medium','high') NOT NULL DEFAULT 'medium',
  `deadline` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `status`, `start_date`, `priority`, `deadline`, `user_id`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 'sudharma', 'sdwasd', 'in_progress', '2025-10-07', 'high', '2025-10-09', 1, 5, '2025-10-06 22:43:29', '2025-10-06 23:17:54'),
(4, 'buddha', 'asdwasd', 'done', '2025-10-08', 'medium', '2025-10-11', 1, 5, '2025-10-06 23:17:18', '2025-10-13 23:12:09'),
(5, 'dodo', 'asdwa', 'done', '2025-10-07', 'high', '2025-10-13', 1, 5, '2025-10-06 23:17:34', '2025-10-06 23:18:17'),
(6, 'Hidup Jokowi', 'Jokowi Hidup', 'in_progress', '2025-10-08', 'high', '2025-10-09', 1, 5, '2025-10-07 22:34:16', '2025-10-13 23:15:28'),
(9, 'asdwasd', 'wasdwa', 'pending', '2025-10-23', 'high', '2025-10-24', 1, 5, '2025-10-23 00:15:29', '2025-10-23 00:15:29'),
(10, 'asdwa', 'adwasdwasd', 'pending', '2025-10-23', 'high', '2025-10-23', 1, 5, '2025-10-23 00:15:43', '2025-10-23 00:15:43'),
(11, 'asdwasdwa', 'wasdddwas', 'pending', '2025-10-23', 'medium', '2025-10-24', 1, 5, '2025-10-23 00:16:20', '2025-10-23 00:16:20'),
(12, 'asdwa', 'dwasdwasd', 'in_progress', '2025-10-23', 'high', '2025-11-01', 1, 5, '2025-10-23 00:16:42', '2025-10-23 00:16:42'),
(13, 'dada', 'adadada', 'in_progress', '2025-10-23', 'medium', '2025-10-23', 1, 5, '2025-10-23 00:32:53', '2025-10-23 00:32:53'),
(14, 'tatatasd', 'asdwa', 'pending', '2025-10-23', 'low', '2025-10-24', 1, 5, '2025-10-23 00:33:06', '2025-10-23 00:33:06'),
(15, 'gagata', 'gtata', 'pending', '2025-10-23', 'low', NULL, 1, 5, '2025-10-23 00:33:17', '2025-10-23 00:33:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `task_comments`
--

CREATE TABLE `task_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `task_comments`
--

INSERT INTO `task_comments` (`id`, `task_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(3, 3, 1, 'anjai sudharma', '2025-10-06 22:59:22', '2025-10-06 22:59:22'),
(4, 3, 1, 'wkwkwkwkwk', '2025-10-06 22:59:28', '2025-10-06 22:59:28'),
(5, 5, 1, 'asdwasdw', '2025-10-06 23:18:51', '2025-10-06 23:18:51'),
(6, 5, 1, 'anjai dodo keren', '2025-10-06 23:18:57', '2025-10-06 23:18:57'),
(7, 5, 1, 'asdwasd', '2025-10-06 23:26:59', '2025-10-06 23:26:59'),
(8, 6, 5, 'Hahaii palpale', '2025-10-07 22:34:52', '2025-10-07 22:34:52'),
(9, 6, 1, 'Admin Jelek', '2025-10-07 22:38:55', '2025-10-07 22:38:55'),
(10, 4, 1, 'baru dikit', '2025-10-13 23:05:04', '2025-10-13 23:05:04'),
(11, 4, 5, 'hai admin', '2025-10-13 23:11:44', '2025-10-13 23:11:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `task_files`
--

CREATE TABLE `task_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `task_files`
--

INSERT INTO `task_files` (`id`, `task_id`, `user_id`, `file_path`, `file_type`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 'task_files/1759820352_landing-page.png', 'png', '2025-10-06 22:59:12', '2025-10-06 22:59:12'),
(3, 5, 1, 'task_files/1759821968_whatsapp-image-2025-08-11-at-164641.jpeg', 'jpeg', '2025-10-06 23:26:08', '2025-10-06 23:26:08'),
(4, 6, 1, 'task_files/1759905520_inv1759905356.pdf', 'pdf', '2025-10-07 22:38:40', '2025-10-07 22:38:40'),
(5, 4, 1, 'task_files/1760425566_owner-dashboard.png', 'png', '2025-10-13 23:06:06', '2025-10-13 23:06:06'),
(6, 4, 1, 'task_files/1760425567_owner-dashboard.png', 'png', '2025-10-13 23:06:07', '2025-10-13 23:06:07'),
(7, 4, 1, 'task_files/1760425578_whatsapp-image-2025-08-04-at-130911-f9a529ca-2.png', 'png', '2025-10-13 23:06:18', '2025-10-13 23:06:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Agra Sena', 'agra12345@gmail.com', NULL, '$2y$12$sxZJe8iVm4mlSLg38Lw71OlOLz2VlUI2CeDIPXnUQGR44SNkvWh6O', 'eADp65GHyOJzR7rCPa174cD2atDkj9s2sqpXeuJOiyv8kWGrww8bq47xzruv', '2025-09-10 18:24:24', '2025-10-07 18:57:23', 'user'),
(2, 'Surya', 'surya12345@gmail.com', NULL, '$2y$12$FshKKPnf.v3xZoTv0NqjBu9zvZlfFTiEcMm7H2AhP74YACMG/.RmG', NULL, '2025-09-22 20:40:06', '2025-09-22 20:40:06', 'user'),
(5, 'Admin', 'admin@example.com', NULL, '$2y$12$sc8fOb8RZxGXdvDoNaOjF.wUFzCNBQogtEpVoDRKuNwbSR/sX9mL.', 'ywQjKLHDzOUikA6XScnz5g1JaDSzip2WRCGfOzNCm8Vp7ZaVZ7qiGL5t9Y2K', '2025-09-25 01:04:19', '2025-09-25 01:04:19', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `company_settings`
--
ALTER TABLE `company_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_code_unique` (`code`),
  ADD KEY `invoices_customer_id_foreign` (`customer_id`);

--
-- Indeks untuk tabel `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`),
  ADD KEY `tasks_created_by_foreign` (`created_by`);

--
-- Indeks untuk tabel `task_comments`
--
ALTER TABLE `task_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_comments_task_id_foreign` (`task_id`),
  ADD KEY `task_comments_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `task_files`
--
ALTER TABLE `task_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_files_task_id_foreign` (`task_id`),
  ADD KEY `task_files_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `company_settings`
--
ALTER TABLE `company_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `task_comments`
--
ALTER TABLE `task_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `task_files`
--
ALTER TABLE `task_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoice_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `task_comments`
--
ALTER TABLE `task_comments`
  ADD CONSTRAINT `task_comments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `task_files`
--
ALTER TABLE `task_files`
  ADD CONSTRAINT `task_files_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
