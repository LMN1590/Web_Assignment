-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 04, 2022 at 02:21 PM
-- Server version: 8.0.31
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webass`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `sex` varchar(6) NOT NULL COMMENT 'Nam, Nữ, Khác',
  `birthday` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: user, 1: admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--




CREATE TABLE `news` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `content` text NOT NULL,
  `contentBody` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `news`
--


-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

CREATE TABLE `news_comments` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `datetime` datetime NOT NULL,
  `content` text NOT NULL,
  `news_id` int UNSIGNED NOT NULL,
  `num_like` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
-- Dumping data for table `news_comments`
--



-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float UNSIGNED NOT NULL,
  `img_path` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: hết hàng, 1: còn hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--


-- --------------------------------------------------------

--
-- Table structure for table `prod_comments`
--

CREATE TABLE `prod_comments` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `datetime` datetime NOT NULL,
  `content` text NOT NULL,
  `prod_id` int UNSIGNED NOT NULL,
  `num_like` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


--
-- Dumping data for table `prod_comments`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prod_comments`
--
ALTER TABLE `prod_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prod_comments`
--
ALTER TABLE `prod_comments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

alter table prod_comments add FOREIGN KEY(prod_id) REFERENCES product(id) on delete CASCADE;
alter table prod_comments add FOREIGN KEY(user_id) REFERENCES user(id) on delete CASCADE;

alter table news_comments add FOREIGN KEY(user_id) REFERENCES user(id) on delete CASCADE;
alter table news_comments add FOREIGN KEY(news_id) REFERENCES news(id) on delete CASCADE;

INSERT INTO `user` (`id`, `username`, `password`, `full_name`, `sex`, `birthday`, `email`, `phone`, `address`, `admin`) VALUES
(0, 'LMN', 'nghiale', 'Lê Minh Nghãi', 'Nam', '2002-01-01', 'leminhnghai@gmail.com', '0123456789', 'BK Q10', 0),
(1, 'NHD', 'danhnguyen', 'Nguyễn Hữu Danh', 'Nam', '2002-08-15', 'adudarkwa@gmail.com', '0567891478', 'Tại nhà', 1),
(2, 'NHTH', 'hungnguyen', 'Hung Nguyen', 'Nam', '2002-02-01', 'bantramkam@gmail.com', '000000', 'Tiểu vương quốc Bình Chánh', 0),
(3, 'admin', 'admin', 'Admin cute pho mai que', 'Nữ', '2003-07-25', 'adminchan@gmail.com', '1900190025', 'Khum biết', 1),
(4, 'TTN', 'nhantran', 'Trần Thiện Nhân', 'Khác', '2001-06-14', 'tatcalatainhan@hcmut.edu.vn', '9999999999', 'Khum', 0),
(5, 'Kha Văn Sang', 'sangkha', 'Sang Văn Kha', 'Nam', '2022-12-04', 'nghiachan@gmail.com', '000000', 'awdawdawd', 0);


INSERT INTO `product` (`id`, `name`, `description`, `price`, `img_path`, `status`) VALUES
(0, 'Shoyu Ramen', 'Ramen & nước tương', 900, 'img/product-list/shoyu-ramen.jpg', 0),
(1, 'Shio Ramen', 'Ramen muối', 220, 'img/product-list/shio-ramen.jpg', 1),
(2, 'Cơm Trứng', 'Cơm và trứng chiên', 324, 'img/product-list/rice-cata.jpg', 1),
(3, 'Rượu Sake', 'Rượu Sake nhập khẩu từ Nhật Bản 100%', 950, 'img/product-list/beverage-cata.jpg', 1),
(4, 'Tonkotsu Ramen', 'Ramen cùng thịt lợn', 340, 'img/product-list/ramen-cata.jpg', 1),
(5, 'Sushi', 'Sushi 7 món', 240, 'img/product-list/sushi-cata.jpg', 1),
(6, 'Sukiyaki', 'Sukiyaki thực chất là một món lẩu, trong đó thịt và rau được hầm trong nồi sắt.', 300, 'img/product-list/sukiyaki.jpg', 1),
(7, 'Cơm cà ri', 'Món ăn này được chế biến từ thịt và rau kết hợp với hương thơm của bột cà ri, sau đó đem hầm và ăn với cơm', 430, 'img/product-list/curry-rice.jpg', 1),
(8, 'Mì soba', 'Một món mì làm từ bột kiều mạch ăn với nước tương và nước sốt đường, có đồ ăn kèm như trứng, tempura,...', 200, 'img/product-list/soba.jpg', 1),
(9, 'Karaage', 'Karaage là thịt gà được ướp với nước tương, muối và một số loại gia vị khác nhau, tẩm bột và chiên trong dầu', 150, 'img/product-list/karaage.jpg', 1),
(10, 'Lẩu shabu-shabu', 'Một món ăn trong đó thịt và rau được đun sôi trong nước được chế biến từ tảo konbu và các thành phần khác', 700, 'img/product-list/shabushabu.jpg', 1),
(11, 'Râu mực nướng phết bơ lạc', 'Món ăn siêu đặc biệt của quán ;)', 999, 'img/product-list/squid.jpg', 1);

INSERT INTO `news` (`id`, `name`, `datetime`, `content`, `contentBody`) VALUES
(0, 'Địa điểm mới', '2022-11-15 11:00:00', 'Mở chi nhánh mới ở quận 10', '*	Hôm nay ngày lành tháng tốt, xin phép thông báo với bà con là một chi nhánh mới của cửa hàng chúng tôi sẽ được mở tại quận để có thể phục vụ tốt hơn cho mọi người.\n*	Hôm nay ngày lành tháng tốt, xin phép thông báo với bà con là một chi nhánh mới của cửa hàng chúng tôi sẽ được mở tại quận để có thể phục vụ tốt hơn cho mọi người.'),
(1, 'Danh mục sản phẩm được cập nhật', '2022-12-03 23:32:00', 'Nhiều sản phẩm đã được cập nhật lên trang chủ của chúng tôi', 'Các bạn có thể xem kỹ hơn trên trang web. Ngoài ra, các món ăn cũng đã được bổ sung về số lượng.'),
(2, 'Khẩn cấp khẩn cấp', '2022-12-04 20:06:00', 'Giáo sư Danh Nguyễn đã tramkam', 'Ngày hôm nay, vào lúc 20h00, một buổi tối Chủ Nhật đẹp trời, giáo sư Danh Nguyễn đã thốt lên: \"Má chân 2 tuần còn chưa hết đau!!\"');

INSERT INTO `news_comments` (`id`, `user_id`, `datetime`, `content`, `news_id`, `num_like`) VALUES
(0, 0, '2022-12-03 23:33:00', 'Món ăn thật là tuyệt vời', 1, 0),
(1, 2, '2022-12-04 19:11:22', 'Rất gần nhà, nhưng bị cái hơi nóng', 0, 0),
(2, 2, '2022-12-04 19:48:32', 'Cửa hàng thật là rộng và mát, là một chỗ thích hợp để tôi tramkam', 0, 21),
(3, 3, '2022-12-04 20:11:00', 'hế lô mấy con gà', 2, 0);

INSERT INTO `prod_comments` (`id`, `user_id`, `datetime`, `content`, `prod_id`, `num_like`) VALUES
(0, 2, '2022-12-03 21:02:32', 'Tuyệt vời, món quá ngon', 4, 0),
(1, 2, '2022-12-03 21:08:04', 'Cà ri nấu hơi dai', 7, 0),
(2, 0, '2022-12-03 23:37:21', 'Nhưng mà ăn vẫn rất ngon', 7, 11),
(3, 2, '2022-12-04 19:09:39', 'thịt gà rất thơm\r\n\r\nNhưng hơi dai', 9, 0),
(4, 2, '2022-12-04 19:10:27', 'Quá tuyệt vời\r\n', 8, 4),
(5, 2, '2022-12-04 19:53:56', 'Món ăn rất ngon, đã cho mình một trải nghiệm về xúc tu.', 11, 0),
(6, 3, '2022-12-04 20:10:00', 'Admin muốn bỏ việc do chân đau', 8, 0);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
