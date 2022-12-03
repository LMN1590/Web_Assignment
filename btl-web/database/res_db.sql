-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2022 at 04:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2
-- CREATE SCHEMA `res_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `res_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `content` text NOT NULL,
  `contentBody` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `name`, `datetime`, `content`,`contentBody`) VALUES
(0, 'Địa điểm mới', '2022-12-01 11:00:00', 'Mở chi nhánh mới ở quận 10','*\tHôm nay ngày lành tháng tốt, xin phép thông báo với bà con là một chi nhánh mới của cửa hàng chúng tôi sẽ được mở tại quận để có thể phục vụ tốt hơn cho mọi người.\n*\tHôm nay ngày lành tháng tốt, xin phép thông báo với bà con là một chi nhánh mới của cửa hàng chúng tôi sẽ được mở tại quận để có thể phục vụ tốt hơn cho mọi người.'),
(1, 'Địa điểm mới', '2022-12-02 17:30:00', 'Mở chi nhánh mới ở thị xã Dĩ An','*\tHôm nay ngày lành tháng tốt, xin phép thông báo với bà con là một chi nhánh mới của cửa hàng chúng tôi sẽ được mở tại quận để có thể phục vụ tốt hơn cho mọi người.');

-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--
CREATE TABLE `news_comments` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `content` text NOT NULL,
  `news_id` int(11) NOT NULL,
  `num_like` int NOT NULL DEFAULT 0,
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_comments`
--

INSERT INTO `news_comments` (`id`, `user_id`, `datetime`, `content`, `news_id`,`num_like`) VALUES
(1, 2052243, '2022-06-15 00:00:00', 'Quán thoáng mát, rộng rãi!', 0,12),
(0, 2052242, '2016-06-22 10:14:59', 'nut', 0,5),
(2, 2052242, '2016-06-22 10:16:04', 'Địa điểm gần nhà, thuận tiện!', 1,0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float UNSIGNED NOT NULL,
  `img_path` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: hết hàng, 1: còn hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `img_path`, `status`) VALUES
(0, 'Shoyu Ramen', 'Ramen & nước tương', 900, 'img/product-list/shoyu-ramen.jpg', 0),
(1, 'Shio Ramen', 'Ramen muối', 220, 'img/product-list/shio-ramen.jpg', 1),
(2, 'Cơm Trứng', 'Cơm và trứng chiên', '324', 'img/product-list/rice-cata.jpg', 1),
(3, 'Rượu Sake', 'Rượu Sake nhập khẩu từ Nhật Bản 100%', '950', 'img/product-list/beverage-cata.jpg', 1),
(4, 'Tonkotsu Ramen', 'Ramen cùng thịt lợn', '340', 'img/product-list/ramen-cata.jpg', 1),
(5, 'Sushi', 'Sushi 7 món', '240', 'img/product-list/sushi-cata.jpg', 1),
(6, 'Sukiyaki', 'Sukiyaki thực chất là một món lẩu, trong đó thịt và rau được hầm trong nồi sắt.', 300, 'img/product-list/sukiyaki.jpg', 1),
(7, 'Cơm cà ri', 'Món ăn này được chế biến từ thịt và rau kết hợp với hương thơm của bột cà ri, sau đó đem hầm và ăn với cơm', 430, 'img/product-list/curry-rice.jpg', 1),
(8, 'Mì soba', 'Một món mì làm từ bột kiều mạch ăn với nước tương và nước sốt đường, có đồ ăn kèm như trứng, tempura,...', 200, 'img/product-list/soba.jpg', 1),
(9, 'Karaage', 'Karaage là thịt gà được ướp với nước tương, muối và một số loại gia vị khác nhau, tẩm bột và chiên trong dầu', 150, 'img/product-list/karaage.jpg', 1),
(10, 'Lẩu shabu-shabu', 'Một món ăn trong đó thịt và rau được đun sôi trong nước được chế biến từ tảo konbu và các thành phần khác', 700, 'img/product-list/shabushabu.jpg', 1),
(11, 'Râu mực nướng phết bơ lạc', 'Món ăn siêu đặc biệt của quán ;)', 999, 'img/product-list/squid.jpg', 1);


-- --------------------------------------------------------

--
-- Table structure for table `prod_comments`
--

CREATE TABLE `prod_comments` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `content` text NOT NULL,
  `prod_id` int(11) NOT NULL,
  `num_like` int NOT NULL,
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prod_comments`
--

INSERT INTO `prod_comments` (`id`, `user_id`, `datetime`, `content`, `prod_id`,`num_like`) VALUES
(0, 2052243, '2022-06-15 00:00:00', 'Nhà hàng tuyệt hảo!', 0,2),
(1, 2052242, '2016-06-22 10:41:30', 'afdf', 1,5),
(2, 2052242, '2016-06-22 10:41:51', 'saikyou', 2,9),
(3, 2052242, '2016-06-22 10:42:01', 'deadweight', 3,1),
(4, 2052242, '2016-06-22 10:43:15', 'blalablala', 4,22),
(5, 2052242, '2016-06-22 10:44:18', 'lmao', 5,8),
(6, 2052242, '2016-06-22 10:12:46', 'nut', 6,5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `sex` varchar(6) NOT NULL COMMENT 'Nam, Nữ, Khác',
  `birthday` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: user, 1: admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `full_name`, `sex`, `birthday`, `email`, `phone`, `address`, `admin`) VALUES
(0, 'LMN', 'nghiale', 'Lê Minh Nghãi', 'Nam', '2002-01-01', 'leminhnghai@gmail.com', '0123456789', 'BK Q10', 0),
(1, 'NHD', 'danhnguyen', 'Nguyễn Hữu Danh', 'Nam', '2002-08-15', 'adudarkwa@gmail.com', '0567891478', 'Tại nhà', 1),
(2, 'NHTH', 'hungnguyen', 'Nguyễn Huỳnh Tuấn Hưng', 'Nam', '2002-02-02', 'bantramkam@gmail.com', '04684548214', 'Vương quốc Bình Chánh', 0),
(3, 'admin', 'admin', 'Admin cute pho mai que', 'Nữ', '2003-07-25', 'adminchan@gmail.com', '1900190025', 'Khum biết', 1),
(4, 'TTN', 'nhantran', 'Trần Thiện Nhân', 'Nam', '2001-06-14', 'tatcalatainhan@hcmut.edu.vn', '9999999999', 'Khum', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `prod_comments`
--
ALTER TABLE `prod_comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prod_comments`
--
ALTER TABLE `prod_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;