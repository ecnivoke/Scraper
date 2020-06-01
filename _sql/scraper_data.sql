-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2020 at 02:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scraper`
--

--
-- Dumping data for table `saved_items`
--

INSERT INTO `saved_items` (`id`, `item_id`, `user_id`, `item_info`, `expire_date`, `expired`, `created`, `updated`) VALUES
(21, 1, 15, '{\"price\":\"237,-\",\"former_price\":\"\",\"image\":\"https://image.coolblue.nl/max/500x500/products/1377900\",\"item_name\":\"Smartwatch\",\"item_url\":\"https://www.coolblue.nl/product/817221/samsung-galaxy-watch-46mm-silver.html\",\"item_id\":\"1\"}', '2010-06-03', 1, '2020-06-01 14:10:11', '2020-06-01 14:10:11'),
(22, 2, 15, '{\"price\":\"149,99\",\"former_price\":\"\",\"image\":\"https://image.coolblue.nl/max/500x500/products/1382320\",\"item_name\":\"headset\",\"item_url\":\"https://www.coolblue.nl/product/826125/logitech-g935-wireless-7-1-surround-sound-lightsync-gaming-headset.html\",\"item_id\":\"2\"}', '2020-06-03', 0, '2020-06-01 14:10:11', '2020-06-01 14:10:11'),
(23, 3, 15, '{\"price\":\"229,-\",\"former_price\":\"\",\"image\":\"https://image.coolblue.nl/max/500x500/products/1387964\",\"item_name\":\"nintendo switch\",\"item_url\":\"https://www.coolblue.nl/product/835083/nintendo-switch-lite-grijs.html\",\"item_id\":\"3\"}', '2020-06-03', 0, '2020-06-01 14:10:12', '2020-06-01 14:10:12'),
(24, 1, 15, '{\"price\":\"237,-\",\"former_price\":\"\",\"image\":\"https://image.coolblue.nl/max/500x500/products/1377900\",\"item_name\":\"Smartwatch\",\"item_url\":\"https://www.coolblue.nl/product/817221/samsung-galaxy-watch-46mm-silver.html\",\"item_id\":\"1\"}', '2020-06-03', 0, '2020-06-01 14:10:25', '2020-06-01 14:10:25');

--
-- Dumping data for table `scrape_items`
--

INSERT INTO `scrape_items` (`id`, `item_url`, `item_name`, `user_id`, `status`, `created`, `updated`) VALUES
(1, 'https://www.coolblue.nl/product/817221/samsung-galaxy-watch-46mm-silver.html', 'Smartwatch', 15, 'a', '0000-00-00 00:00:00', '2020-05-23 17:44:34'),
(2, 'https://www.coolblue.nl/product/826125/logitech-g935-wireless-7-1-surround-sound-lightsync-gaming-headset.html', 'headset', 15, 'a', '0000-00-00 00:00:00', '2020-05-23 17:44:34'),
(3, 'https://www.coolblue.nl/product/835083/nintendo-switch-lite-grijs.html', 'nintendo switch', 15, 'a', '0000-00-00 00:00:00', '2020-05-23 17:44:34'),
(4, 'https://www.coolblue.nl/product/667905/apple-magic-mouse-2.html', 'muis', 15, 'a', '0000-00-00 00:00:00', '2020-05-23 17:44:34'),
(5, 'https://www.coolblue.nl/product/667905/apple-magic-mouse-2.html', 'muis', 15, 'a', '0000-00-00 00:00:00', '2020-05-23 17:44:34'),
(6, 'https://www.coolblue.nl/product/852042/apple-airpods-pro-met-draadloze-oplaadcase.html', 'bagger', 15, 'a', '0000-00-00 00:00:00', '2020-05-23 17:44:34'),
(7, 'https://www.coolblue.nl/product/667905/apple-magic-mouse-2.html', 'bagger', 15, 'a', '2020-05-24 00:00:00', '2020-05-24 00:00:00'),
(8, 'https://www.coolblue.nl/product/667905/apple-magic-mouse-2.html', 'bagger', 15, 'a', '2020-05-25 00:00:00', '2020-05-25 00:00:00'),
(9, 'https://www.coolblue.nl/product/667905/apple-magic-mouse-2.html', 'bagger', 15, 'a', '2020-05-25 00:00:00', '2020-05-25 00:00:00'),
(10, 'https://www.coolblue.nl/product/667905/apple-magic-mouse-2.html', 'muis', 32, 'a', '2020-05-25 00:00:00', '2020-05-25 00:00:00'),
(11, 'https://www.coolblue.nl/product/852042/apple-airpods-pro-met-draadloze-oplaadcase.html', 'bagger', 32, 'a', '2020-05-25 00:00:00', '2020-05-25 00:00:00');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `user_group_id`, `status`, `created`, `updated`) VALUES
(15, 'vince', '$2y$10$a2N4sYrV2ZH73qfdNjfNEenkNGOA94uAVl3hiMyoAZZKaw0OB8r5S', 'vince@vince', 1, 'a', '0000-00-00 00:00:00', '2020-05-23 17:43:01'),
(30, 'terst', '$2y$10$NN1zX7DL9CK7QjCF/p8HYeNByeFNOnQoTTzGmET4qNTF0mjuVK/ii', 'test', 3, 'a', '2020-05-24 22:46:05', '2020-05-24 22:46:05'),
(31, 'terstsa', '$2y$10$JriLsw0MH3u2TBf/hjIooOUZawVcLLGJ1SmQUyb8uzXXAMVadJ3hy', 'test', 3, 'a', '2020-05-24 22:46:46', '2020-05-24 22:46:46'),
(32, 'piet', '$2y$10$eHcrOV8Oz0B.Cj9yh8yUY.R1OJ.saKxMbZN2uqlW16aQ/la1uEbmy', 'piet', 1, 'a', '2020-05-25 17:36:27', '2020-05-25 17:36:27');

--
-- Dumping data for table `user_token_auth`
--

INSERT INTO `user_token_auth` (`id`, `username`, `password_hash`, `selector_hash`, `expired`, `expire_date`, `created`) VALUES
(4, 'vince', '$2y$10$TQcglkbwNOkz34ND9ZHELOCarGAE8gPr4HdppwEyNGtjJYnGc4Au6', '$2y$10$Fj61hGceVCWcv0i8Qs6OQuUzoN1tzKc8mm0L8LiIAvvygjy7nzqRu', 1, '2020-05-23', '0000-00-00 00:00:00'),
(6, 'vince', '$2y$10$hxhLwSZD6GOQeUlmKQeVaOOQB2yUV42zQXUj4kk554K7KbyFtnOGy', '$2y$10$MLX6o2zptOL.jYVNcvtY/enD9VwsJ.keM9G0WC2vO3IdGWFAW87WS', 1, '2020-05-23', '0000-00-00 00:00:00'),
(7, 'vince', '$2y$10$2F.XIzDY2mEWcWEkq3PXc.EJthuIHSaZIPZlI4s2SltRUZqdwzanK', '$2y$10$AADY5Wc2RDbxgNkM.Bg2UuWc7eexoQq/FST1VXYqgEZJvRGWW44K6', 1, '2021-05-06', '0000-00-00 00:00:00'),
(8, 'vince', '$2y$10$YRyRxBJkcOpCF1uW9283JerFGHqJ/44Eq9iZSi0AyNN3GrVy5LgLO', '$2y$10$mNZXF0ZjF5razcIqIBUJl./uOKOUpHjo4u98x8ycbfKwa5FCPYLby', 1, '2021-05-06', '0000-00-00 00:00:00'),
(9, 'vince', '$2y$10$47XEbSYmiB9errvW6ZeTyebU.WRmBndulIGaf78AHhs6uqX9mkwtO', '$2y$10$eINXQWMZZwoyxyC/ynV6ieTjPSyrMVJqYw6jhLaQT/ZOCe9gV9R42', 1, '2021-05-06', '0000-00-00 00:00:00'),
(10, 'vince', '$2y$10$BF/4h3Ua22xTY0kDrL.6.O.esD1AWWv3I5pdFba6VIF7GEPuY9Tbu', '$2y$10$LSdxQAg0m2hAallHUM5RPuSqQvH211zYdOrBCvwabmI29w3hr9SrW', 1, '2021-05-06', '0000-00-00 00:00:00'),
(11, 'vince', '$2y$10$ARsUUxnIIkG7sT/PA7A0FeuyVtqGYz14sGGMdO402jZmdJm82pNaC', '$2y$10$iahQU6dVPSmM24H8L0bt1uCHH9J7sbireUqGgBQb77IUmyuMjlMCy', 1, '2021-05-06', '0000-00-00 00:00:00'),
(12, 'vince', '$2y$10$wbKPPWi5AnmLnE1alm50WuChCCbARbBUA1lE2aIBXO.PgvOwqiQju', '$2y$10$UQEqT6HKWVkiGT33o1srMOtz.zlLIG4tkqLgXOkVuZ471xaTTAlfi', 1, '2021-05-06', '0000-00-00 00:00:00'),
(13, 'vince', '$2y$10$SV.4jcFP4s66K6xFX1cYDOkHk29j./NCaZDYv454K/6pkVMRkjGXy', '$2y$10$bs.e41u7pn6FJXpIDuQs/uF9EVqGtf.LrylCWgLF/EJTsLTA4tS9u', 1, '2021-05-06', '2020-05-23 21:21:32'),
(14, 'vince', '$2y$10$AViPXuhelHKJjRaKazH7suB4lU.6F4LHiUE3bhClhmjg35keKkNgi', '$2y$10$25mQAWc6kiaA6fg3fKqZk.maTUZ2LD/UYL9Gmc5MSOTWdAk6MXhKW', 1, '2021-05-06', '2020-05-23 21:22:46'),
(15, 'vince', '$2y$10$1iznDraekmZiagZMLCZx7eHg2Fe9JzjPRMK6bGm7JlrY56uyjOpgS', '$2y$10$4eN2cMToUkT6hdXw.0Mn7uLh8lQBjEkZ8c3aiN8Xo1jk37t8TSg4e', 1, '2021-05-06', '2020-05-24 16:07:20'),
(16, 'vince', '$2y$10$Jl8a1k7VLZuxPVdc6RVxM.fZn5/6jRNNoD8ipgSryyrZU6D3jn53u', '$2y$10$nzKQCGUVXv5os0S54gdbpuVka4lru9/yX2i6KjTv7vgll2AzDftrK', 1, '2021-05-06', '2020-05-24 16:17:27'),
(17, 'vince', '$2y$10$IJX69ONZ3UeTJDJEPVTBS.VxxXaiqeE0r3B2HfWNWpDPmNLD2arAq', '$2y$10$kiiTjhHrZTuIcL0807LW/.g07F3mY9Fo.nPyWk96hho7CSuBny0oO', 1, '2021-05-07', '2020-05-24 22:38:23'),
(18, 'vince', '$2y$10$AlgLMVkmYYoK41vxynuO6O0k7XulvrsC3ThAt917IQB0bqbukGV0C', '$2y$10$CQF9mtCGOJ/.bewCvoNgz.wQ2TmW/WuJ.4f.MefVsfufLh5eftKeC', 1, '2021-05-07', '2020-05-24 22:51:12'),
(19, 'vince', '$2y$10$IonQGTVE4fL99k4atcIusOJXzTpmPatQAvPWJ/nzLHqIGh6qOfpx.', '$2y$10$M.ZAZ3C0/qgolhkoFZqI6ewOtJCyFYBo6DGb.9wVnbE4PPtt7KOhG', 1, '2021-05-07', '2020-05-25 13:18:02'),
(20, 'vince', '$2y$10$jsY4dyMjB/g16Ur3fSZxqOeUxysqsAH2BPXx.VxtyB.mXnUOLQiG.', '$2y$10$N5mM3x3/MukIKJZMKq01VuIL1OzRPhiwBeJN.Y41d9jj7uRv/rhY6', 1, '2021-05-08', '2020-05-25 22:11:13'),
(21, 'vince', '$2y$10$CAnsh2LBHHvNVerWsWzbzefLhBHi5IuvnPFgPHwl7FypYS1mZ4w6C', '$2y$10$.2DVYXr8sDmfqbCxi1lH1uE5feSMnQf2WNUQ6OkJtqjL8l7MocxFK', 1, '2021-05-09', '2020-05-27 13:45:47'),
(22, 'vince', '$2y$10$Mg25uyY3j2nrWJeYcVj47.ySYEjh5ZEu.0HaWcIIFysm1142Ko8Ri', '$2y$10$Lf8k0wu2.xH2qxW3r26NYuOZ1dKj32Mt3jIBwBVon/zfbeOQPclZe', 1, '2021-05-09', '2020-05-27 13:53:51'),
(23, 'vince', '$2y$10$6suv.kYYoPaUa5GsPMcwQuh7kPiF2vRNqbXTjUcRYxtqStKnPlYxu', '$2y$10$OPm7EMVX/BtFayb8oSxHh.mkfEUUhquwEbi5iQ7hwEd4Wr5.6G766', 1, '2021-05-14', '2020-05-31 20:35:15'),
(24, 'vince', '$2y$10$BQ8UCQCLAr.QX1uWfR3U4O3zPqpVJ8MEqU5uL06QRWqoOKEY2WYmi', '$2y$10$IPw0Fp1ZDS8lieqsJHfgfeyJnZoa..mLHocu2v573EyjMQljXB5n6', 0, '2021-05-14', '2020-05-31 21:27:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
