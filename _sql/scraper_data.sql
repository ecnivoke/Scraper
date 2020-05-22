-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2020 at 03:28 PM
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
-- Dumping data for table `scrape_items`
--

INSERT INTO `scrape_items` (`id`, `item_url`, `item_name`, `user_id`) VALUES
(1, 'https://www.coolblue.nl/product/817221/samsung-galaxy-watch-46mm-silver.html', 'Smartwatch', 15),
(2, 'https://www.coolblue.nl/product/826125/logitech-g935-wireless-7-1-surround-sound-lightsync-gaming-headset.html', 'headset', 15),
(3, 'https://www.coolblue.nl/product/835083/nintendo-switch-lite-grijs.html', 'nintendo switch', 15),
(4, 'https://www.coolblue.nl/product/667905/apple-magic-mouse-2.html', 'muis', 15),
(5, 'https://www.coolblue.nl/product/667905/apple-magic-mouse-2.html', 'muis', 15);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `user_group_id`, `status`) VALUES
(15, 'vince', '$2y$10$a2N4sYrV2ZH73qfdNjfNEenkNGOA94uAVl3hiMyoAZZKaw0OB8r5S', 'vince@vince', 1, 'a'),
(25, 'pieter', '$2y$10$8uX8znMqDReRUXyN/PtKLeigVEwzaBl6LR2tW0s8Ap.Iavj66h4gG', 'pieter@piet.com', 3, 'a');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
