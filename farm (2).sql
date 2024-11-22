-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2024 at 06:11 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farm`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Good Day', 'Example', '2024-11-16 22:35:56', '2024-11-16 22:35:56'),
(2, 'Weather Update:', 'The weather for the next 7 days is expected to be partly cloudy with occasional rain showers, especially in the afternoons. Temperatures will range between 24°C to 32°C.\r\n\r\nAdvisory for Farmers:\r\n\r\nPlanting Preparation: If you\'re planning to plant crops, ensure your fields are well-drained to prevent waterlogging.\r\nFertilizer Application: Avoid applying fertilizers during heavy rainfall to reduce nutrient runoff.\r\nLivestock Care: Ensure your animals have adequate shelter and access to clean drinking water.', '2024-11-16 22:38:13', '2024-11-16 22:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `calamity_reports`
--

CREATE TABLE `calamity_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `reporter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'For Review',
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calamity_reports`
--

INSERT INTO `calamity_reports` (`id`, `reporter_name`, `email`, `location`, `description`, `created_at`, `viewed`, `updated_at`, `status`, `user_id`, `image_path`) VALUES
(2, 'Justin', 'inorganicdrake@gmail.com', 'Bansud', 'Qwer', '2024-11-17 02:17:09', 1, '2024-11-22 09:38:30', 'canceled', NULL, 'calamity_reports_images/jsRa22tqUaVGCDUMhmIW5kA9VPcnQI9O1HpyAbCz.jpg'),
(3, 'Justin', 'decastrojustin24@gmail.com', 'Barangay Masipit Calapan City', 'fire', '2024-11-17 03:14:21', 1, '2024-11-22 08:17:00', 'canceled', NULL, NULL),
(4, 'Justin', 'decastrojustin24@gmail.com', 'Lalud Calapan City', 'hello', '2024-11-22 08:17:44', 1, '2024-11-22 09:42:59', 'completed', NULL, 'calamity_reports_images/1732296785_XkSQVheNRxqEWhY5zUGwfQ.jpeg'),
(5, 'Testing Profile', 'farmer@farmer.com', 'Lalud Calapan City', 'asdasdasd', '2024-11-22 09:40:02', 1, '2024-11-22 09:40:06', 'For Review', NULL, NULL),
(6, 'Testing Profile', 'decastrojustin123@gmail.com', 'Lalud Calapan City', 'qweqwe', '2024-11-22 09:41:28', 1, '2024-11-22 09:42:54', 'For Review', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `crop_types` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `livestock_types` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `crop_images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `livestock_images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `user_id`, `name`, `email`, `phone`, `crop_types`, `livestock_types`, `crop_images`, `location`, `livestock_images`, `created_at`, `updated_at`) VALUES
(21, 2, 'Justin Mangubat De Castro', 'decastrojustin123@gmail.com', '09091234561', 'Corn', 'Pig', '\"[\\\"images\\\\\\/crops\\\\\\/6740ba4f9f501_XkSQVheNRxqEWhY5zUGwfQ.jpeg\\\"]\"', 'Lalud Calapan City', '\"[\\\"images\\\\\\/livestock\\\\\\/6740ba4fa059a_XkSQVheNRxqEWhY5zUGwfQ.jpeg\\\"]\"', '2024-11-22 09:07:27', '2024-11-22 09:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `farmer_ayudas`
--

CREATE TABLE `farmer_ayudas` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmer_ayudas`
--

INSERT INTO `farmer_ayudas` (`id`, `name`, `email`, `location`, `request`, `created_at`, `updated_at`) VALUES
(1, 'justin', 'decastrojustin24@gmail.com', 'Lalud Calapan City', 'testing', '2024-11-16 20:20:17', '2024-11-16 20:20:17'),
(2, 'Test Feedback Farmer', 'inorganicdrake@gmail.com', 'Barangay Masipit Calapan City', 'hi', '2024-11-16 20:36:48', '2024-11-16 20:36:48'),
(3, 'Justin Mangubat De Castro', 'decastrojustin24@gmail.com', 'Barangay Masipit Calapan City', 'hello', '2024-11-16 20:57:13', '2024-11-16 20:57:13'),
(4, 'FarmerOld', 'decastrojustin24@gmail.com', 'Lalud Calapan Citys', 'asdasd', '2024-11-16 21:04:42', '2024-11-16 21:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Test Feedback Farmer', 'farmer@gmail.com', 'This is a test Feedback', NULL, '2024-08-03 04:10:03', '2024-08-03 04:10:03'),
(3, 'Test Feedback Farmer', 'admin@admin.com', 'This is a test feedback', NULL, '2024-08-03 04:17:09', '2024-08-03 04:17:09'),
(4, 'Testing Feedback', 'testing@feedback.com', 'This is a test feedback from farmer', NULL, '2024-08-03 04:39:33', '2024-08-03 04:39:33'),
(9, 'Testing Profile', 'farmer@farmer.com', 'HI', 2, '2024-11-22 09:11:54', '2024-11-22 09:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_03_113902_create_feedback_table', 1),
(6, '2024_08_03_120550_create_farmers_table', 2),
(7, '2024_11_17_041708_create_farmer_ayudas_table', 3),
(8, '2024_11_17_063358_create_announcements_table', 4),
(9, '2024_11_17_095602_create_calamity_reports_table', 5),
(10, '2024_11_17_101455_add_status_to_calamity_reports_table', 6),
(11, '2024_11_17_110345_add_rs_to_users_table', 7),
(12, '2024_11_21_025406_add_viewed_to_calamity_reports_table', 8),
(13, '2024_11_22_165116_add_user_id_to_calamity_reports_table', 9),
(14, '2024_11_22_170217_add_user_id_to_farmers_table', 10),
(15, '2024_11_22_170904_add_user_id_to_feedbacks_table', 11),
(16, '2024_11_22_172024_add_image_path_to_calamity_reports_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `rs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `rs`) VALUES
(1, 'justin', 'admin@admin.com', NULL, '$2y$12$81DGXC9P2Yta0dLerxmsLeEJdPUnvAiiB8K7NTlHUSBBg.RWSGgIG', NULL, '2024-08-03 03:59:10', '2024-08-03 03:59:10', 'admin', NULL),
(2, 'Testing Profile', 'decastrojustin123@gmail.com', NULL, '$2y$12$lYxD1gNfkPnQ.j.WNFM/SOZuCN4yp.frYN71/crefE2e9L4cSBnua', NULL, '2024-08-03 04:38:53', '2024-11-22 09:40:55', 'user', '12345'),
(3, 'Justin Mangubat De Castro', '23jb6.justin@bcrvtvi.edu.ph', NULL, '$2y$12$l3L.D5lVei9v1SWzQtKT7uyR/lN.fHMjkygWs2RwviFk2ma9aIcYa', NULL, '2024-11-17 03:05:27', '2024-11-17 03:05:27', 'user', '6652'),
(4, 'Justin Mangubat De Castro', 'decastrojustin24@gmail.com', NULL, '$2y$12$WmkBKqOfligSIOzVfO6ZYOlvcSreqK8/WW7TzmOHnpxZsoXuZRb5O', NULL, '2024-11-17 03:07:52', '2024-11-17 03:07:52', 'user', '66522');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calamity_reports`
--
ALTER TABLE `calamity_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calamity_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `farmers_email_unique` (`email`),
  ADD KEY `farmers_user_id_foreign` (`user_id`);

--
-- Indexes for table `farmer_ayudas`
--
ALTER TABLE `farmer_ayudas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `calamity_reports`
--
ALTER TABLE `calamity_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `farmer_ayudas`
--
ALTER TABLE `farmer_ayudas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calamity_reports`
--
ALTER TABLE `calamity_reports`
  ADD CONSTRAINT `calamity_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `farmers`
--
ALTER TABLE `farmers`
  ADD CONSTRAINT `farmers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
