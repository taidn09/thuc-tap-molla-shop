-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 12:07 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `molla`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminId` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `role` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminId`, `name`, `email`, `password`, `image`, `role`) VALUES
(1, 'Admin', 'taidn@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'shipper.jpg', 0),
(21, 'abc', 'abc@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '44379f2b1a5611f625592bbf6e596a47.png', 0),
(22, 'abcaaca', 'absacsa@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '74ce2e1a498f2fa27b5542040be774dc.png', 0),
(23, 'abdas', 'asdsad@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2161df7a31143a6367acb146378f151e.png', 0),
(24, 'test', 'test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'e53125275854402400f74fd6ab3f7659.png', 0),
(25, 'test2', 'test2@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '96d6f2e7e1f705ab5e59c84a6dc009b2.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `roleId` int(11) NOT NULL,
  `adminId` int(11) DEFAULT NULL,
  `roleString` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`roleId`, `adminId`, `roleString`) VALUES
(52, 9, 'dashboard'),
(53, 9, 'product'),
(54, 9, 'category'),
(457, 8, 'dashboard'),
(458, 8, 'product'),
(459, 8, 'product-detail'),
(460, 8, 'product-delete'),
(461, 8, 'product-edit'),
(462, 8, 'product-add'),
(463, 8, 'product-toggle'),
(464, 8, 'product-editOption'),
(465, 8, 'product-deleteOption'),
(466, 8, 'product-uploadProductImages'),
(467, 8, 'category'),
(468, 8, 'category-delete'),
(469, 8, 'user'),
(470, 8, 'user-detail'),
(471, 8, 'user-edit'),
(472, 8, 'user-add'),
(473, 8, 'order'),
(474, 8, 'order-delete'),
(475, 8, 'review'),
(476, 8, 'review-delete'),
(477, 8, 'review-edit'),
(478, 8, 'blog'),
(479, 8, 'blog-detail'),
(480, 8, 'contact'),
(481, 8, 'contact-delete'),
(482, 8, 'statistics'),
(496, 22, 'dashboard'),
(497, 22, 'contact'),
(498, 22, 'contact-delete');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blogId` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `createdAt` date DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `commentsCount` int(11) DEFAULT 0,
  `shortDesc` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `isShown` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blogId`, `title`, `createdAt`, `authorId`, `commentsCount`, `shortDesc`, `content`, `thumbnail`, `isShown`) VALUES
(21, 'MỞ BÁN RANDOM BOX CHỈ VỚI GIÁ 299.000Đ', '2023-05-17', 21, 0, 'MỞ BÁN RANDOM BOX CHỈ VỚI GIÁ 299.000Đ', '<h1>MỞ B&Aacute;N RANDOM BOX CHỈ VỚI GI&Aacute; 299.000Đ</h1>\r\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://staging-toto-cms.mltechsoft.com/uploads/RANDOM_BOX_MT_810dbff991.jpg\" alt=\"\" width=\"590\" height=\"835\"></p>\r\n<p>Ai mà chả thích thử độ may mắn của m&igrave;nh đ&uacute;ng kh&ocirc;ng n&agrave;o? Trong tháng 5 này tụi m&igrave;nh đang có&nbsp;<strong>chương trình ưu đãi cực lớn</strong>&nbsp;đ&oacute; ch&iacute;nh l&agrave;&nbsp;<strong>mở b&aacute;n Random Box trị gi&aacute; l&ecirc;n đến 700.000đ</strong>&nbsp;chỉ với giá&nbsp;<strong>299.000đ</strong>&nbsp;với nhiều&nbsp;<strong>sản phẩm ngẫu nhi&ecirc;n hấp dẫn</strong>&nbsp;đang chờ đợi các FRIEND&rsquo;s tới rinh về. Th&ocirc;ng tin ưu đãi như sau:</p>\r\n<p>Đặc biệt d&agrave;nh cho chương trình l&acirc;̀n này l&agrave;&nbsp;<strong>mở bán giới hạn s&ocirc;́ lượng</strong>&nbsp;chỉ với&nbsp;<strong>100 Random Box</strong>&nbsp;cho 100 bạn may mắn nh&acirc;́t:</p>\r\n<ul>\r\n<li style=\"list-style-type: disc;\">Random Box : bao gồm&nbsp;<strong>2 mẫu Tee Totoday</strong>&nbsp;ngẫu nhi&ecirc;n&nbsp;<strong>trị gi&aacute; 590.000 - 700.000đ</strong>&nbsp;&amp;&nbsp;<strong>1 voucher mua h&agrave;ng trị gi&aacute; 50.000đ.</strong>&nbsp;</li>\r\n<li style=\"list-style-type: disc;\">Với hơn&nbsp;<strong>30 mẫu &aacute;o thun</strong>&nbsp;cực k&igrave; chất lượng v&agrave; thời thượng với mức gi&aacute; nhẹ t&ecirc;nh chờ bạn rinh về.</li>\r\n</ul>\r\n<p>*Lưu ý:</p>\r\n<p>- Khi mua&nbsp;<strong>Random Box</strong>&nbsp;bạn sẽ&nbsp;<strong>được chọn đ&uacute;ng size &aacute;o</strong>&nbsp;v&igrave; ch&uacute;ng tớ đ&atilde; ph&acirc;n size r&otilde; r&agrave;ng cho từng Box n&ecirc;n sẽ kh&ocirc;ng phải lo vấn đề về size &aacute;o nhé.</p>\r\n<p>- Thời gian mở b&aacute;n: 00:00 ngày 12.05.2023 cho đ&ecirc;́n 28.05.2023.</p>\r\n<p>- K&ecirc;nh b&aacute;n: To&agrave;n hệ thống cửa h&agrave;ng v&agrave; online.</p>\r\n<p>- Sản phẩm c&oacute; mặt to&agrave;n bộ tr&ecirc;n hệ thống Website v&agrave; c&aacute;c k&ecirc;nh thương mại điện tử của tụi m&igrave;nh, nhanh tay mua h&agrave;ng để kh&ocirc;ng bỏ lỡ nh&eacute;</p>\r\n<p>- Chương tr&igrave;nh kh&ocirc;ng &aacute;p dụng với c&aacute;c CTKM kh&aacute;c.</p>\r\n<p>- Kh&ocirc;ng áp dụng chung với chi&ecirc;́t kh&acirc;́u VIP.</p>', 'f46dbb1d9cf47830768f1c1f1e16d5ce.png', 1),
(29, 'ngon', '2023-05-21', 21, 0, 'ngon', '<p>ngon</p>\r\n<p><img src=\"https://tse1.mm.bing.net/th?id=OIP.PRSdIhk7842lQCMSBKTOzQHaEO&amp;pid=Api&amp;P=0&amp;h=180\" alt=\"\" width=\"316\" height=\"180\"></p>', '4d3a21d8c684c09c19b93be911827fd5.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `branId` int(11) NOT NULL,
  `brandName` varchar(50) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`branId`, `brandName`, `logo`) VALUES
(1, 'Le Barrel', '1.png'),
(2, 'Something', '2.png'),
(3, 'Costa Brava', '3.png'),
(4, 'Oceanic', '4.png'),
(5, 'Fountain', '5.png'),
(6, 'Black Birds', '6.png'),
(7, 'Hugo', '7.png'),
(8, 'Mountain', '8.png'),
(9, 'Mr Bookers', '9.png');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `title`) VALUES
(4, 'Áo khoác'),
(2, 'Áo thun'),
(1, 'Chưa phân loại'),
(3, 'Túi xách'),
(5, 'Váy');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  `text` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `text`) VALUES
(1, 'red', 'Đỏ'),
(2, 'green', 'Xanh lá'),
(3, 'blue', 'Xanh dương'),
(4, 'yellow', 'Vàng'),
(5, 'black', 'Đen'),
(6, 'white', 'Trắng'),
(7, 'purple', 'Tím'),
(8, 'pink', 'Hồng');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `reply` text DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `userId`, `email`, `phone`, `message`, `reply`, `createdAt`) VALUES
(8, 'Nguyễn Tài', 39, 'wow@gmail.com', '0986512466', 'Rất hài lòng', NULL, '2023-05-20 09:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `images_gallery`
--

CREATE TABLE `images_gallery` (
  `imgId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images_gallery`
--

INSERT INTO `images_gallery` (`imgId`, `productId`, `image`) VALUES
(3, 2, 'product-2-1.jpg'),
(5, 3, 'product-3-1.jpg'),
(6, 3, 'product-3-2.jpg'),
(9, 5, 'product-5-1.jpg'),
(10, 5, 'product-5-2.jpg'),
(15, 21, '7e7812a5fd86ae45360cb13bd587befc.jpg'),
(16, 21, 'ed4de43882dba9aac559e3f874f43f2c.jpg'),
(17, 21, 'c0605a959a1ddd9d77ebf47b4faa7f81.jpg'),
(18, 21, '33fb6436f096217fd811c2bf6be2a44e.jpg'),
(22, 23, 'aaca0f5eb4d2d98a6ce6dffa99f8254b.png'),
(23, 1, '74ce2e1a498f2fa27b5542040be774dc.png'),
(24, 24, 'e53125275854402400f74fd6ab3f7659.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `orderDate` date DEFAULT NULL,
  `receiver` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `province` text DEFAULT NULL,
  `district` text DEFAULT NULL,
  `ward` text DEFAULT NULL,
  `street` text DEFAULT NULL,
  `summary` float DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `orderDate`, `receiver`, `email`, `phone`, `province`, `district`, `ward`, `street`, `summary`, `notes`, `status`) VALUES
(49, 33, '2023-05-17', 'tai tai', 'test2@test.com', '0934567549', 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Phúc Xá', '28 TDT 2', 320, 'Cảm ơn nhiều ạ', 3),
(50, 33, '2023-05-17', 'tai tai', 'test2@test.com', '0934567549', 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Phúc Xá', '28 TDT 2', 80, '', 0),
(51, 36, '2023-05-17', 'tai tai', 'tainguyen@gmail.com', '09872144555', 'Tỉnh Phú Thọ', 'Thành phố Việt Trì', 'Phường Dữu Lâu', 'ghjk', 3520, '', 0),
(52, 36, '2023-05-17', 'tai taitai', 'tainguyen@gmail.com', '0134567888', 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Phúc Xá', '123', 800, '', 0),
(53, 33, '2023-05-20', 'tai tai', 'test2@test.com', '0934567549', 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Phúc Xá', '28 TDT 2', 3135, '', 0),
(54, 39, '2023-05-22', 'Nguyễn Tài', 'wow@gmail.com', '0986512466', 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Phúc Xá', '28 TDT', 200000, '', 3),
(55, 39, '2023-05-22', 'Nguyễn Tài', 'wow@gmail.com', '0986512466', 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Phúc Xá', '28 TDT', 90, '', 1),
(56, 39, '2023-05-22', 'Nguyễn Tài', 'wow@gmail.com', '0986512466', 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Phúc Xá', '28 TDT', 90, '', 1);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `autoDeleteOrderDetails` BEFORE DELETE ON `orders` FOR EACH ROW BEGIN
	DELETE FROM order_details WHERE order_details.orderId = OLD.orderId;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `optionId` int(11) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`orderId`, `productId`, `optionId`, `color`, `size`, `price`, `quantity`, `total`) VALUES
(49, 3, 9, NULL, NULL, 80, 1, 80),
(49, 3, 10, NULL, NULL, 80, 1, 80),
(49, 3, 11, NULL, NULL, 80, 1, 80),
(49, 3, 12, NULL, NULL, 80, 1, 80),
(50, 5, 17, NULL, NULL, 80, 1, 80),
(51, 3, 9, NULL, NULL, 80, 1, 80),
(51, 5, 17, NULL, NULL, 80, 43, 3440),
(52, 2, 6, NULL, NULL, 80, 10, 800),
(53, 21, 27, NULL, NULL, 285, 11, 3135),
(54, 2, 6, NULL, NULL, 200000, 1, 200000),
(55, 1, 34, NULL, NULL, 90, 1, 90),
(56, 1, 34, NULL, NULL, 90, 1, 90);

--
-- Triggers `order_details`
--
DELIMITER $$
CREATE TRIGGER `autoUpdateSold` AFTER INSERT ON `order_details` FOR EACH ROW BEGIN
	Update products SET sold = sold + new.quantity WHERE productId = new.productId;
    UPDATE product_options SET quantity = quantity -new.quantity WHERE optionId = new.optionId;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status_text` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status_text`) VALUES
(1, 'Đang xử lý'),
(2, 'Đang giao hàng'),
(3, 'Đã giao hàng'),
(4, 'Đã hủy'),
(5, 'Trả hàng');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `originalPrice` float DEFAULT NULL,
  `currentPrice` float DEFAULT NULL,
  `description` text DEFAULT NULL,
  `salePercent` float DEFAULT NULL,
  `reviewCount` int(11) DEFAULT 0,
  `rating` float DEFAULT 5,
  `categoryId` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT 0,
  `isShown` tinyint(4) DEFAULT 1,
  `deleted` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `title`, `originalPrice`, `currentPrice`, `description`, `salePercent`, `reviewCount`, `rating`, `categoryId`, `sold`, `isShown`, `deleted`) VALUES
(1, 'product 1', 100, 90, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris. EDITED', 10, 0, 3, 1, 2, 1, 0),
(2, 'product 2', 250000, 200000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris. ', 20, 0, 5, 1, 25, 1, 0),
(3, 'product 3', 100, 80, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris. ', 20, 3, 4.7, 4, 13, 1, 0),
(5, 'product 5', 100, 80, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris. ', 20, 0, 3.3, 1, 45, 1, 0),
(21, 'ÁO THUN UNISEX - TOTODAY - ALWAYS BE YOUR SIDE', 300, 285, 'Good', 5, 0, 4, 1, 19, 1, 0),
(23, '2345t6yuirftgh', 3000000, 2850000, '34567', 5, 0, 5, 4, 0, 0, 1),
(24, 'abcc', 100000, 90, 'Good for you', 10, 0, 5, 1, 0, 1, 0),
(25, 'test2', 9000, 9, 'Hello', 0, 0, 5, 4, 0, 1, 1),
(26, 'test2', 10000, 10, 'Ngon', 0, 0, 5, 4, 0, 1, 1);

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `autoDeleteOptions` BEFORE DELETE ON `products` FOR EACH ROW BEGIN 
	DELETE FROM product_options WHERE productId = OLD.productId;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `autoDeleteReview` BEFORE DELETE ON `products` FOR EACH ROW BEGIN
	DELETE FROM product_reviews WHERE product_reviews.productId = OLD.productId;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_options`
--

CREATE TABLE `product_options` (
  `optionId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `color` varchar(10) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_options`
--

INSERT INTO `product_options` (`optionId`, `productId`, `size`, `color`, `quantity`) VALUES
(6, 2, 'S', '#097a27', 28),
(8, 2, 'XL', '#FFFF00', 47),
(10, 3, 'M', '#FFFF00', 49),
(11, 3, 'S', '#097a27', 49),
(12, 3, 'S', '#FFFF00', 49),
(17, 5, 'M', '#097a27', 5),
(18, 5, 'M', '#FFFF00', 50),
(19, 5, 'S', '#097a27', 50),
(20, 5, 'S', '#FFFF00', 50),
(32, 23, 'S', '#ff0000', 9),
(33, 23, 'M', '#000000', 7),
(34, 1, 'S', 'red', 6),
(35, 1, 'M', 'green', 9),
(36, 1, 'S', 'green', 19),
(37, 1, 'L', 'green', 0),
(38, 1, 'S', 'black', 8),
(39, 1, 'S', 'white', 10),
(40, 1, 'S', 'purple', 0),
(41, 21, 'S', 'blue', 20),
(42, 21, 'S', 'red', 20);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `reviewId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `reviewTime` datetime DEFAULT NULL,
  `helpful` int(11) DEFAULT 0,
  `unhelpful` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`reviewId`, `userId`, `productId`, `star`, `title`, `content`, `reviewTime`, `helpful`, `unhelpful`) VALUES
(21, 33, 5, 3, 'Đẹp', 'Rất tốt', '2023-05-17 03:59:49', 0, 0),
(22, 36, 5, 3, 'dfg', 'ghnjm', '2023-05-17 09:35:36', 0, 0),
(23, 37, 2, 5, 'kjl;', 'ikolp;', '2023-05-17 10:08:42', 0, 0),
(24, 39, 3, 4, 'Ngon ', 'ngon luon', '2023-05-17 10:19:36', 0, 0),
(25, 39, 3, 5, 'Ngon ', 'ngon ơ', '2023-05-18 10:39:25', 0, 0),
(26, 39, 3, 5, 'hello', 'abc', '2023-05-18 10:40:45', 0, 0),
(27, 33, 21, 4, 'Hello', 'abc', '2023-05-18 11:01:45', 0, 0),
(28, 39, 1, 3, 'Ngon', 'ngon', '2023-05-20 11:35:53', 0, 0),
(30, 39, 5, 4, 'tốt', 'tốt', '2023-05-20 14:42:39', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `serviceId` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`serviceId`, `icon`, `title`, `content`) VALUES
(1, 'icon-truck', 'Thanh toán và vận chuyển', 'Miễn phí vận chuyển cho đơn hàng trên 500.000đ'),
(2, 'icon-rotate-left', 'Trả hàng và hoàn tiền', 'Hoàn tiền 100% khi hàng lỗi'),
(3, 'icon-unlock', 'Thanh toán an toàn', 'Thanh toán an toàn 100%'),
(4, 'icon-headphones', 'Chất lượng hỗ trợ', 'Nhân viên tư vẫn hỗ trợ 24/7');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `expired_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `email`, `token`, `expired_time`) VALUES
(6, 'wow@gmail.com', '252106102cc3fbb63cfb606bdf87d643', '2023-05-22 10:09:21'),
(14, 'nguyentantai12b1@gmail.com', '9e7015ca763c23c18c24e8bc7b146cac', '2023-05-22 11:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` tinyint(4) DEFAULT 0,
  `province` text DEFAULT NULL,
  `district` text DEFAULT NULL,
  `ward` text DEFAULT NULL,
  `street` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `fname`, `lname`, `email`, `phone`, `password`, `role`, `province`, `district`, `ward`, `street`) VALUES
(38, NULL, NULL, 'phagame@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', 0, NULL, NULL, NULL, NULL),
(39, 'Nguyễn', 'Tài', 'wow@gmail.com', '0986512466', 'fcea920f7412b5da7be0cf42b8c93759', 0, 'Thành phố Hà Nội', 'Huyện Phúc Thọ', 'Thị trấn Phúc Thọ', '28 TDT'),
(41, NULL, NULL, 'new@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', 0, NULL, NULL, NULL, NULL),
(42, NULL, NULL, 'nguyentantai12b1@gmail.com', NULL, 'fcea920f7412b5da7be0cf42b8c93759', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`userId`, `productId`) VALUES
(41, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blogId`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`branId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images_gallery`
--
ALTER TABLE `images_gallery`
  ADD PRIMARY KEY (`imgId`,`productId`,`image`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`orderId`,`productId`,`optionId`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `product_options`
--
ALTER TABLE `product_options`
  ADD PRIMARY KEY (`optionId`,`productId`,`size`,`color`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`reviewId`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`serviceId`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`userId`,`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blogId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `branId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `images_gallery`
--
ALTER TABLE `images_gallery`
  MODIFY `imgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_options`
--
ALTER TABLE `product_options`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `serviceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
