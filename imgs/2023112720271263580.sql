-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-11-03 09:22:35
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `payment`
--

-- --------------------------------------------------------

--
-- 資料表結構 `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `item` varchar(16) NOT NULL,
  `money` float(8,4) UNSIGNED NOT NULL,
  `location` varchar(20) NOT NULL,
  `note` text NOT NULL,
  `payment` varchar(10) NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `invoice` varchar(10) DEFAULT NULL,
  `type` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `payments`
--

INSERT INTO `payments` (`id`, `date`, `item`, `money`, `location`, `note`, `payment`, `amount`, `invoice`, `type`) VALUES
(1, '2020-01-10', '電腦螢幕', 5289.0000, 'pchome24h購物平台', '撿到寶，讚!!!', '1', 1, 'SR-8924659', '6'),
(2, '0000-00-00', '電信服務', 878.0000, '遠傳電信', '這個月又超過基本月租費很多...', '3', 1, 'SK-1234567', '6'),
(3, '2023-11-03', '黑咖啡', 59.0000, '泰山職訓場內', '買個咖啡提提神，不然上課快陣亡', '2', 2, NULL, '1'),
(4, '2022-08-08', '剉冰', 50.0000, '三重消暑冰店', '', '2', 1, NULL, '1'),
(5, '2023-05-25', '加油', 143.0000, '泰山加油站', '', '4', 0, '', '4'),
(6, '2021-05-27', '母親節蛋糕', 690.0000, '好吃烘焙坊', '其實不好吃', '2', 1, 'VF-5922659', '1'),
(7, '2022-10-01', '豪華雙人房', 2499.0000, '圓山大飯店', '舒服', '1', 0, 'YB-6971254', '3'),
(8, '0000-00-00', '吃牛排', 999.0000, '大直貴族牛排館', '', '5', 3, 'QA-7832169', '1'),
(9, '2022-11-02', '長褲', 799.0000, '三重uniqlo', '', '5', 1, 'WG-6315971', '衣'),
(10, '2023-08-24', '線上課程', 330.0000, 'udemy平台', '', '1', 0, 'RT-3594187', '5');

-- --------------------------------------------------------

--
-- 資料表結構 `pay_methods`
--

CREATE TABLE `pay_methods` (
  `id` int(10) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `pay_methods`
--

INSERT INTO `pay_methods` (`id`, `name`) VALUES
(1, '信用卡'),
(2, '現金'),
(3, '自動扣款'),
(4, 'visa 金融卡'),
(5, '電子支付');

-- --------------------------------------------------------

--
-- 資料表結構 `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, '食'),
(2, '衣'),
(3, '住'),
(4, '行'),
(5, '育'),
(6, '樂');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `pay_methods`
--
ALTER TABLE `pay_methods`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `pay_methods`
--
ALTER TABLE `pay_methods`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
