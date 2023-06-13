-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Haz 2023, 11:56:38
-- Sunucu sürümü: 10.4.25-MariaDB
-- PHP Sürümü: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `lojistik`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `girisler`
--

CREATE TABLE `girisler` (
  `id` int(11) NOT NULL,
  `k_id` int(11) NOT NULL,
  `g_tarihi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `girisler`
--

INSERT INTO `girisler` (`id`, `k_id`, `g_tarihi`) VALUES
(1, 1, '2023-05-04 22:09:58'),
(2, 6, '2023-05-04 22:10:39'),
(3, 1, '2023-05-04 22:12:23'),
(4, 2, '2023-05-04 22:13:13'),
(5, 1, '2023-05-04 22:13:18'),
(6, 1, '2023-05-04 22:14:26'),
(7, 1, '2023-05-04 22:14:44'),
(8, 1, '2023-05-04 22:19:26'),
(9, 6, '2023-05-04 22:23:11'),
(10, 1, '2023-05-04 22:23:17'),
(11, 1, '2023-05-05 13:09:31'),
(12, 1, '2023-05-05 13:13:48'),
(13, 1, '2023-05-05 15:41:33'),
(14, 1, '2023-05-05 16:31:46'),
(15, 1, '2023-05-05 16:48:05'),
(16, 1, '2023-05-05 17:02:17'),
(17, 1, '2023-05-05 17:02:50'),
(18, 1, '2023-05-05 17:22:01'),
(19, 1, '2023-05-05 17:22:02'),
(20, 1, '2023-05-05 17:31:24'),
(21, 1, '2023-05-05 17:31:48'),
(22, 1, '2023-05-05 20:34:26'),
(23, 1, '2023-05-09 21:42:42'),
(24, 1, '2023-05-16 14:11:18'),
(25, 1, '2023-05-16 14:12:34'),
(26, 6, '2023-05-16 15:02:36'),
(27, 1, '2023-05-16 15:05:46'),
(28, 1, '2023-05-16 15:10:27'),
(29, 6, '2023-05-16 15:10:56'),
(30, 1, '2023-05-16 15:25:40'),
(31, 6, '2023-05-16 17:04:37'),
(32, 1, '2023-05-16 17:06:01'),
(33, 6, '2023-05-16 17:08:19'),
(34, 1, '2023-05-17 18:28:44'),
(35, 6, '2023-05-17 18:29:04'),
(36, 1, '2023-05-17 18:49:37'),
(37, 6, '2023-05-17 20:54:42'),
(38, 1, '2023-05-17 20:58:22'),
(39, 6, '2023-05-17 20:58:39'),
(40, 1, '2023-05-17 20:59:59'),
(41, 6, '2023-05-17 21:02:33'),
(42, 1, '2023-05-17 21:03:24'),
(43, 6, '2023-05-17 21:06:07'),
(44, 1, '2023-05-17 21:06:16'),
(45, 1, '2023-05-18 12:25:37'),
(46, 6, '2023-05-18 12:26:26'),
(47, 1, '2023-05-18 12:40:57'),
(48, 6, '2023-05-18 12:41:14'),
(49, 1, '2023-05-18 12:41:41'),
(50, 1, '2023-05-18 12:44:44'),
(51, 6, '2023-05-18 12:44:55'),
(52, 1, '2023-05-18 12:56:45'),
(53, 6, '2023-05-18 12:56:58'),
(54, 1, '2023-05-18 12:58:00'),
(55, 6, '2023-05-18 12:58:35'),
(56, 1, '2023-05-18 13:02:51'),
(57, 1, '2023-05-18 13:57:55'),
(58, 6, '2023-05-18 14:09:24'),
(59, 1, '2023-05-18 14:10:32'),
(60, 6, '2023-05-18 14:37:52'),
(61, 1, '2023-05-18 14:51:29'),
(62, 1, '2023-05-18 14:51:43'),
(63, 1, '2023-05-18 14:56:36'),
(64, 1, '2023-05-18 15:20:51'),
(65, 1, '2023-05-18 15:29:15'),
(66, 1, '2023-05-18 15:30:30'),
(67, 1, '2023-05-18 15:35:44'),
(68, 6, '2023-05-18 15:48:46'),
(69, 1, '2023-05-18 15:53:18'),
(70, 6, '2023-05-18 16:11:25'),
(71, 1, '2023-05-18 16:17:56'),
(72, 6, '2023-05-18 16:20:42'),
(73, 1, '2023-05-18 16:25:35'),
(74, 1, '2023-05-18 20:45:50'),
(75, 1, '2023-05-19 10:12:53'),
(76, 1, '2023-05-19 10:13:38'),
(77, 6, '2023-05-19 10:13:50'),
(78, 1, '2023-05-21 06:29:17'),
(79, 1, '2023-05-21 19:07:11'),
(80, 6, '2023-05-21 19:10:29'),
(81, 1, '2023-05-21 19:10:41'),
(82, 6, '2023-05-21 19:17:59'),
(83, 1, '2023-05-21 19:19:19'),
(84, 1, '2023-05-26 11:36:31'),
(85, 1, '2023-06-05 11:46:09'),
(86, 1, '2023-06-10 08:09:08'),
(87, 1, '2023-06-10 16:23:51'),
(88, 1, '2023-06-10 18:02:24'),
(89, 1, '2023-06-11 07:57:34'),
(90, 1, '2023-06-11 11:00:06'),
(91, 6, '2023-06-11 11:02:46'),
(92, 1, '2023-06-11 11:20:03'),
(93, 1, '2023-06-12 12:39:26'),
(94, 1, '2023-06-13 11:53:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int(11) NOT NULL,
  `kat_adi` varchar(255) NOT NULL,
  `ekleme_tarihi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `kat_adi`, `ekleme_tarihi`) VALUES
(1, 'Teknoloji', '2023-05-01 19:20:11'),
(2, 'Telefon', '2023-05-01 20:50:36'),
(5, 'Bilgisayar', '2023-05-01 20:54:51'),
(12, 'Kalem', '2023-05-02 19:19:23'),
(14, 'Silgi', '2023-05-03 12:47:52'),
(21, 'Kitap', '2023-05-17 19:43:21'),
(22, 'Çanta', '2023-05-18 16:26:04'),
(23, 'Tablet', '2023-05-18 16:26:27'),
(24, 'Masa', '2023-05-18 16:26:33'),
(25, 'Kazak', '2023-05-18 16:26:41'),
(26, 'Gömlek', '2023-05-18 16:26:48'),
(27, 'Pantolon', '2023-05-18 16:27:03'),
(29, 'Elektronik', '2023-06-13 11:59:27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(255) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `soyad` varchar(255) NOT NULL,
  `departman` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `aktif` int(11) NOT NULL DEFAULT 0,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kullanici_adi`, `ad`, `soyad`, `departman`, `sifre`, `aktif`, `foto`) VALUES
(1, 'admin', 'admin ad', 'admin soyad', 'Müdür', 'd033e22ae348aeb5660fc2140aec35850c4da997', 2, '470515_user.png'),
(2, 'mehmet', 'Mehmet', 'Hasanoğlu', 'Müdür Yardımcısı', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0, '4072105_user.png'),
(6, 'hasan', 'hasan', 'mehmet', 'pazarlama', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, '8973968_user.png'),
(7, 'ibrahim', 'İbrahim', 'Ataş', 'Satış Sorumlusu', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, '1206431_4072105_user.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satislar`
--

CREATE TABLE `satislar` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `satisi_yapan` int(11) NOT NULL,
  `satilan_adet` int(11) NOT NULL,
  `birine_fiyat` int(11) NOT NULL,
  `toplam_tl` int(11) NOT NULL,
  `alici` varchar(255) NOT NULL,
  `tarihi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `satislar`
--

INSERT INTO `satislar` (`id`, `u_id`, `satisi_yapan`, `satilan_adet`, `birine_fiyat`, `toplam_tl`, `alici`, `tarihi`) VALUES
(10, 1, 1, 800, 15, 12000, 'adel', '2023-05-03 22:37:13'),
(11, 7, 1, 200, 15, 3000, 'adel', '2023-05-04 10:50:51'),
(12, 1, 1, 40, 15, 600, 'adel', '2023-05-04 12:04:17'),
(13, 2, 1, 7, 10, 70, 'muhammed', '2023-05-04 12:46:47'),
(15, 1, 1, 20, 9, 180, 'muhammed', '2023-05-04 16:25:54'),
(16, 1, 1, 20, 9, 180, 'muhammed', '2023-05-04 16:26:23'),
(19, 1, 1, 10, 100000000, 1000000000, 'yunus', '2023-05-04 17:06:32'),
(22, 1, 1, 40, 300, 12000, 'y', '2023-05-05 15:17:27'),
(23, 15, 1, 200, 100, 20000, 'y', '2023-05-05 15:25:17'),
(36, 1, 6, 5, 10, 50, 'yunus', '2023-05-18 12:57:24'),
(37, 1, 6, 5, 55, 275, 'muhammed', '2023-05-18 12:57:34'),
(39, 2, 6, 3, 10, 30, 'hasan', '2023-05-19 10:23:45'),
(40, 1, 1, 5, 15, 75, 'mehmet', '2023-05-21 06:34:52'),
(42, 2, 1, 30, 12, 360, 'Hasan', '2023-06-13 11:54:18'),
(44, 7, 1, 100, 23, 2300, 'İbrahim Kerimoğlu', '2023-06-13 12:35:54');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `urun_adi` text NOT NULL,
  `adet` int(11) NOT NULL,
  `kat` int(11) NOT NULL,
  `ekleyen` int(11) NOT NULL,
  `alim_fiyat` int(11) NOT NULL,
  `satim_fiyat` int(11) NOT NULL,
  `tedarikci` varchar(255) NOT NULL,
  `urun_adresi` text NOT NULL,
  `raf_no` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tarihi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `urun_adi`, `adet`, `kat`, `ekleyen`, `alim_fiyat`, `satim_fiyat`, `tedarikci`, `urun_adresi`, `raf_no`, `foto`, `tarihi`) VALUES
(1, 'NEON Silgi Model 58', 45, 14, 1, 10, 15, 'Ahmet', 'kahramanmaraş 46, depo 1', '5645489', '724310_silgi.jpg', '2023-05-02 18:36:32'),
(2, 'Orient Mavi Renk Model 96 2021', 10, 12, 1, 7, 10, 'mehmet', 'kahramanmaraş 46, depo 5', '46556', '3903998_pngwing.com (2).png', '2023-05-02 20:02:22'),
(7, 'kalem Model 112', 700, 12, 1, 12, 21, 'Hasan', 'kilis', '21', '8219763_pngwing.com (2).png', '2023-05-03 15:29:59'),
(12, 'laptop', 100, 5, 1, 5500, 6000, 'asus', 'istanbul', '1222', '402737_laptop.jpg', '2023-05-03 16:42:18'),
(13, 'iphone 11 pro', 20, 2, 1, 15000, 17000, 'apple', 'istanbul', '56', '1945192_telefon.png', '2023-05-03 19:33:59'),
(15, 'Etkili İnsanların 7 Alışkanlıkları ', 800, 21, 1, 20, 100, 'yunus', 'istanbul', '45', '3292709_kitap.jpg', '2023-05-04 16:31:50'),
(18, 'klavye', 100, 1, 1, 10, 12, 'furkan', 'kahramanmaraş depo 2', '45', '5029329_klavye.jpg', '2023-05-16 14:25:47'),
(20, 'Asus Laptop 4GB RAM 256GB SSD Intel corei5 10. Nesil', 16, 5, 1, 5000, 6000, 'Furkan', 'İstanbul - Fatih Depo NO: 5', '896', '325325_402737_laptop.jpg', '2023-06-13 12:21:13');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `girisler`
--
ALTER TABLE `girisler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `k_id` (`k_id`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`);

--
-- Tablo için indeksler `satislar`
--
ALTER TABLE `satislar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `satis_urunu` (`u_id`),
  ADD KEY `satis_yapan` (`satisi_yapan`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kat_id` (`kat`),
  ADD KEY `ekleyen_kul` (`ekleyen`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `girisler`
--
ALTER TABLE `girisler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `satislar`
--
ALTER TABLE `satislar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `girisler`
--
ALTER TABLE `girisler`
  ADD CONSTRAINT `k_id` FOREIGN KEY (`k_id`) REFERENCES `kullanicilar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `satislar`
--
ALTER TABLE `satislar`
  ADD CONSTRAINT `satis_urunu` FOREIGN KEY (`u_id`) REFERENCES `urunler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `satis_yapan` FOREIGN KEY (`satisi_yapan`) REFERENCES `kullanicilar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `urunler`
--
ALTER TABLE `urunler`
  ADD CONSTRAINT `ekleyen_kul` FOREIGN KEY (`ekleyen`) REFERENCES `kullanicilar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kat_id` FOREIGN KEY (`kat`) REFERENCES `kategoriler` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
