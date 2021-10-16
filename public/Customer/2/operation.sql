-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Eki 2021, 21:39:31
-- Sunucu sürümü: 10.4.13-MariaDB
-- PHP Sürümü: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `operation`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ticket_transaction_statuses`
--

CREATE TABLE `ticket_transaction_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `ticket_transaction_statuses`
--

INSERT INTO `ticket_transaction_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Yapılacak', '2021-10-11 19:28:46', '2021-10-11 19:28:46', NULL),
(2, 'Test Edilecek', '2021-10-11 19:28:46', '2021-10-11 19:28:46', NULL),
(3, 'Değerlendirilecek', '2021-10-11 19:28:46', '2021-10-11 19:28:46', NULL),
(4, 'Test Edildi', '2021-10-11 19:28:46', '2021-10-11 19:28:46', NULL),
(5, 'Tekrar Değerlendirilecek', '2021-10-11 19:28:46', '2021-10-11 19:28:46', NULL),
(6, 'İptal Edildi', '2021-10-11 19:28:46', '2021-10-11 19:28:46', NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ticket_transaction_statuses`
--
ALTER TABLE `ticket_transaction_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ticket_transaction_statuses`
--
ALTER TABLE `ticket_transaction_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
