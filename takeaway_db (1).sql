-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 13 дек 2024 в 13:04
-- Версия на сървъра: 10.4.28-MariaDB
-- Версия на PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `takeaway_db`
--

-- --------------------------------------------------------

--
-- Структура на таблица `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Схема на данните от таблица `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Пица Маргарита', 'Традиционна пица с доматен сос и моцарела', 12.50, 'margarita.jpg'),
(2, 'Пица Пеперони', 'Пица с пеперони и моцарела', 14.50, 'pepperoni.jpg'),
(3, 'Бургери', 'Сочно говеждо месо с гарнитури по избор', 9.99, 'burger.jpg'),
(4, 'Сандвич', 'Сандвич с пресни зеленчуци и месо.', 5.50, 'sandwich.jpg'),
(5, 'Бурито', 'Мексиканско бурито с пилешко, ориз и боб.', 6.90, 'burrito.jpg'),
(6, 'Кесадия', 'Вкусна кесадия с разтопено сирене и зеленчуци', 8.50, 'quesadilla.jpg');

-- --------------------------------------------------------

--
-- Структура на таблица `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','canceled') DEFAULT 'pending',
  `user_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Схема на данните от таблица `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `total_price`, `status`, `user_id`, `product_id`, `quantity`, `order_date`) VALUES
(1, '', 12.50, 'pending', 13, '', 1, '2024-12-12 11:29:11'),
(2, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(3, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(4, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(5, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(6, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(7, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(8, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(9, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(10, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(11, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(12, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(13, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(14, '', 12.50, 'pending', 13, '', 1, '2024-12-06 11:29:11'),
(15, '', 12.50, 'pending', 14, '', 1, '2024-12-06 11:29:11'),
(16, '', 12.50, 'pending', 14, '', 1, '2024-12-06 11:29:11'),
(17, '', 12.50, 'pending', 14, '', 1, '2024-12-06 11:29:11'),
(18, '', 12.50, 'pending', 14, '', 1, '2024-12-06 11:29:11'),
(19, '', 12.50, 'pending', 14, '', 1, '2024-12-06 11:29:11'),
(21, '', 12.50, 'pending', 14, '', 1, '2024-12-06 11:29:11'),
(22, '', 12.50, 'pending', 14, '', 1, '2024-12-06 11:29:11'),
(26, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(27, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(29, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(31, '', 37.50, 'pending', 13, '1', 3, '2024-12-06 11:29:11'),
(32, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(33, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(34, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(35, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(36, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(37, '', 50.00, 'pending', 13, '1', 4, '2024-12-06 11:29:11'),
(38, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(39, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(40, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(41, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(42, '', 50.00, 'pending', 13, '1', 4, '2024-12-06 11:29:11'),
(43, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(44, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:11'),
(45, '', 50.00, 'pending', 13, '1', 4, '2024-12-06 11:29:11'),
(46, '', 25.00, 'pending', 13, '1', 2, '2024-12-06 11:29:11'),
(47, '', 25.00, 'pending', 13, '1', 2, '2024-12-06 11:29:11'),
(48, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:29:19'),
(49, '', 25.00, 'pending', 13, '1', 2, '2024-12-06 11:29:48'),
(50, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:30:58'),
(51, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:33:45'),
(52, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:36:26'),
(53, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:37:11'),
(54, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:37:18'),
(55, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:39:28'),
(56, '', 12.50, 'pending', 13, '1', 1, '2024-12-06 11:40:07'),
(57, '', 25.00, 'pending', 13, '1', 2, '2024-12-09 17:50:02'),
(58, '', 8.50, 'pending', 13, '6', 1, '2024-12-09 22:52:23'),
(59, 'Guest', 12.50, 'pending', 13, '1', 1, '2024-12-09 23:05:44'),
(60, 'Guest', 12.50, 'pending', 13, '1', 1, '2024-12-09 23:07:57'),
(61, 'Guest', 25.00, 'pending', 13, '1', 2, '2024-12-09 23:12:07'),
(62, 'Guest', 14.50, 'pending', 13, '2', 1, '2024-12-09 23:14:20'),
(63, 'Guest', 14.50, 'pending', 13, '2', 1, '2024-12-09 23:14:42'),
(64, 'Guest', 62.10, 'pending', 13, '5', 9, '2024-12-09 23:21:29'),
(65, '', 9.99, 'pending', 13, '3', 1, '2024-12-09 23:27:19'),
(66, 'Guest', 12.50, 'pending', 13, '1', 1, '2024-12-09 23:30:53'),
(67, 'Guest', 12.50, 'pending', 13, '1', 1, '2024-12-10 13:19:59'),
(68, 'Guest', 12.50, 'pending', 13, '1', 1, '2024-12-11 22:06:34'),
(69, 'Guest', 12.50, 'pending', 13, '1', 1, '2024-12-11 23:19:04'),
(70, 'Guest', 12.50, 'pending', 13, '1', 1, '2024-12-11 23:31:42');

-- --------------------------------------------------------

--
-- Структура на таблица `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'ввв', '23', '', '2024-11-09 14:19:53'),
(9, '', '22', 'eyceyyy456@abv.bg', '2024-11-19 19:48:47'),
(10, 'riri', '$2y$10$RROkSjOKJw4WuYAk4XF9mOyud81ezI8WX1QTwf8Eva.lIC6wCWWwy', 'riri@abv.bg', '2024-11-19 19:50:58'),
(11, 'kiki', '$2y$10$pEXzpTHwy2nMGz7EyQZ8Het7gOlbQ7Bp/D9COsr6WanZVrS0Z9d4a', 'kiki@abv.bg', '2024-11-19 19:56:54'),
(12, 'w', '$2y$10$CsuiGkB6sEbv.jIFl6yMr.QK1lH2kRw4LwqEDUcc0MV0cRi5QL/Qa', 'w@abv.bg', '2024-11-19 20:46:16'),
(13, 'Edzhe', '$2y$10$S8rJWQZjWn2YCgFkTf5MY.HLmy1JAuJDYteG3WrxgTHHZqWNWjmzO', 'edzhe@abv.bg', '2024-11-27 17:54:57'),
(14, 'gigi', '$2y$10$f0CJY.B30ZGsqhDdeF7l/eYDun/NFeEM8xTPxuvMIPxqC9YI3uoM.', 'gigi@abv.bg', '2024-12-02 19:08:50'),
(15, 'vili', '$2y$10$vPUnrm0kldxbDDSFw5YheeaJPQ0Nm7orZNJM5KjV3B4i4otY0Mtg.', 'vili@abv.bg', '2024-12-06 09:56:07'),
(16, 'с', '$2y$10$9TmQ0Bh3.GRmvvZE7E/Lz..TLLxYTzwl3Stf2HFpZMDEsBymc.50q', 'cs@abv.bg', '2024-12-10 18:44:27');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `menu_item_id` (`menu_item_id`);

--
-- Индекси за таблица `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
