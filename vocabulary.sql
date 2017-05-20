-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 Nis 2017, 10:49:55
-- Sunucu sürümü: 10.1.13-MariaDB
-- PHP Sürümü: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `vocabulary`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `memorizes`
--

CREATE TABLE `memorizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) NOT NULL,
  `words_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `memorizes`
--

INSERT INTO `memorizes` (`id`, `users_id`, `words_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 4),
(5, 1, 4),
(7, 2, 5),
(8, 1, 1),
(9, 31, 1),
(10, 31, 2),
(11, 31, 2),
(12, 31, 3),
(13, 31, 4),
(14, 31, 1),
(15, 31, 2),
(16, 31, 3),
(17, 31, 4),
(18, 31, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2017_04_20_114223_create_memorizes_table', 1),
(12, '2017_04_20_114523_create_words_table', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `api_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deviceID` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `api_token`, `deviceID`) VALUES
(31, 'VTLgv3gTZEIlBUpnXQu7Q3Kd35pIwcmaa4WRlNaaLKJGkS0pssLIO42KEdba', '215f91adf07b591d');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `words`
--

CREATE TABLE `words` (
  `id` int(10) UNSIGNED NOT NULL,
  `turkish` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `english` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `words`
--

INSERT INTO `words` (`id`, `turkish`, `english`) VALUES
(1, 'okul', 'school'),
(2, 'kalem', 'pencil'),
(3, 'silgi', 'eraser'),
(4, 'yemek', 'food'),
(5, 'cay', 'tea');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `memorizes`
--
ALTER TABLE `memorizes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `memorizes`
--
ALTER TABLE `memorizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Tablo için AUTO_INCREMENT değeri `words`
--
ALTER TABLE `words`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
