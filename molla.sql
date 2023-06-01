-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 12:10 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminId`, `name`, `email`, `password`, `image`, `role`) VALUES
(1, 'Admin', 'taidn@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'shipper.jpg', 0),
(21, 'Admin 1', 'abc@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '44379f2b1a5611f625592bbf6e596a47.png', 0),
(26, 'vaa', 'a@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '3667f6a0c97490758d7dc9659d01ea34.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `roleId` int(11) NOT NULL,
  `adminId` int(11) DEFAULT NULL,
  `roleString` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(498, 22, 'contact-delete'),
(505, 21, 'dashboard'),
(506, 21, 'product'),
(507, 21, 'product-detail'),
(508, 21, 'product-delete'),
(509, 21, 'product-edit'),
(510, 21, 'product-add'),
(526, 26, 'dashboard'),
(527, 26, 'product'),
(528, 26, 'product-detail'),
(529, 26, 'product-toggle'),
(530, 26, 'category');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blogId` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` date DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `commentsCount` int(11) DEFAULT 0,
  `shortDesc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `isShown` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blogId`, `title`, `createdAt`, `authorId`, `commentsCount`, `shortDesc`, `content`, `thumbnail`, `isShown`) VALUES
(21, 'MỞ BÁN RANDOM BOX CHỈ VỚI GIÁ 299.000Đ', '2023-05-17', 21, 0, 'MỞ BÁN RANDOM BOX CHỈ VỚI GIÁ 299.000Đ', '<h1>MỞ B&Aacute;N RANDOM BOX CHỈ VỚI GI&Aacute; 299.000Đ</h1>\r\n<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://staging-toto-cms.mltechsoft.com/uploads/RANDOM_BOX_MT_810dbff991.jpg\" alt=\"\" width=\"590\" height=\"835\"></p>\r\n<p>Ai mà chả thích thử độ may mắn của m&igrave;nh đ&uacute;ng kh&ocirc;ng n&agrave;o? Trong tháng 5 này tụi m&igrave;nh đang có&nbsp;<strong>chương trình ưu đãi cực lớn</strong>&nbsp;đ&oacute; ch&iacute;nh l&agrave;&nbsp;<strong>mở b&aacute;n Random Box trị gi&aacute; l&ecirc;n đến 700.000đ</strong>&nbsp;chỉ với giá&nbsp;<strong>299.000đ</strong>&nbsp;với nhiều&nbsp;<strong>sản phẩm ngẫu nhi&ecirc;n hấp dẫn</strong>&nbsp;đang chờ đợi các FRIEND&rsquo;s tới rinh về. Th&ocirc;ng tin ưu đãi như sau:</p>\r\n<p>Đặc biệt d&agrave;nh cho chương trình l&acirc;̀n này l&agrave;&nbsp;<strong>mở bán giới hạn s&ocirc;́ lượng</strong>&nbsp;chỉ với&nbsp;<strong>100 Random Box</strong>&nbsp;cho 100 bạn may mắn nh&acirc;́t:</p>\r\n<ul>\r\n<li style=\"list-style-type: disc;\">Random Box : bao gồm&nbsp;<strong>2 mẫu Tee Totoday</strong>&nbsp;ngẫu nhi&ecirc;n&nbsp;<strong>trị gi&aacute; 590.000 - 700.000đ</strong>&nbsp;&amp;&nbsp;<strong>1 voucher mua h&agrave;ng trị gi&aacute; 50.000đ.</strong>&nbsp;</li>\r\n<li style=\"list-style-type: disc;\">Với hơn&nbsp;<strong>30 mẫu &aacute;o thun</strong>&nbsp;cực k&igrave; chất lượng v&agrave; thời thượng với mức gi&aacute; nhẹ t&ecirc;nh chờ bạn rinh về.</li>\r\n</ul>\r\n<p>*Lưu ý:</p>\r\n<p>- Khi mua&nbsp;<strong>Random Box</strong>&nbsp;bạn sẽ&nbsp;<strong>được chọn đ&uacute;ng size &aacute;o</strong>&nbsp;v&igrave; ch&uacute;ng tớ đ&atilde; ph&acirc;n size r&otilde; r&agrave;ng cho từng Box n&ecirc;n sẽ kh&ocirc;ng phải lo vấn đề về size &aacute;o nhé.</p>\r\n<p>- Thời gian mở b&aacute;n: 00:00 ngày 12.05.2023 cho đ&ecirc;́n 28.05.2023.</p>\r\n<p>- K&ecirc;nh b&aacute;n: To&agrave;n hệ thống cửa h&agrave;ng v&agrave; online.</p>\r\n<p>- Sản phẩm c&oacute; mặt to&agrave;n bộ tr&ecirc;n hệ thống Website v&agrave; c&aacute;c k&ecirc;nh thương mại điện tử của tụi m&igrave;nh, nhanh tay mua h&agrave;ng để kh&ocirc;ng bỏ lỡ nh&eacute;</p>\r\n<p>- Chương tr&igrave;nh kh&ocirc;ng &aacute;p dụng với c&aacute;c CTKM kh&aacute;c.</p>\r\n<p>- Kh&ocirc;ng áp dụng chung với chi&ecirc;́t kh&acirc;́u VIP.</p>', '2bf48fc3eaa4a859a5ce131a92c18e7b.jpg', 0),
(32, 'Sản phẩm mới', '2023-05-25', 1, 0, 'Sản phẩm mới', '<p>Sản phẩm mới đến từ cửa h&agrave;ng của ch&uacute;ng t&ocirc;i</p>\r\n<p><img src=\"https://img.cdn.vncdn.io/cdn-pos/d0f3ca-7136/ps/20230410_rmcqzv65.jpg\" alt=\"\" width=\"314\" height=\"314\"></p>', 'f150af00f20b2a21371fc119f7372560.jpg', 1),
(33, 'Sản phẩm mới', '2023-05-25', 1, 0, 'Sản phẩm mới', '<p>Sản phẩm mới</p>\r\n<p><img src=\"https://img.cdn.vncdn.io/cdn-pos/d0f3ca-7136/ps/20230410_rmcqzv65.jpg\" alt=\"\" width=\"317\" height=\"317\"></p>', 'e4b28989af8083fe704664d42b13616f.jpg', 1),
(34, 'Sản phẩm mới', '2023-05-25', 1, 0, 'Tin tức sản phẩm mới', '<p>Sản phẩm mới</p>\r\n<p><img src=\"https://img.cdn.vncdn.io/cdn-pos/d0f3ca-7136/ps/20230410_rmcqzv65.jpg\" alt=\"\" width=\"353\" height=\"353\"></p>', 'c4655d36d0fc81f5d23044430447f592.jpg', 1),
(35, 'Sản phẩm mới', '2023-05-29', 1, 0, 'Sản phẩm mới', '<p>Ch&iacute;nh thức ra mắt bộ sưu tập L&aacute; v&agrave;ng trong gi&oacute;</p>\r\n<p><img src=\"http://imgs.vietnamnet.vn/Images/2015/09/11/19/20150911195605-0909suutap002.jpg\" width=\"459\" height=\"459\"></p>', '110be9b6f32510b23e4e4ed6974b5f97.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `branId` int(11) NOT NULL,
  `brandName` varchar(50) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `title`) VALUES
(4, 'Áo khoác'),
(2, 'Áo thun'),
(1, 'Chưa phân loại'),
(3, 'Unisex');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  `text` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `userId`, `email`, `phone`, `message`, `reply`, `createdAt`) VALUES
(9, 'Nguyễn Tài', NULL, 'tainguyen2003@gmail.com', '0934567542', 'Tôi muốn đặt một lô hàng lớn', '<p>Cảm ơn nhaaaaaaaaaaaaaa anh Bạn</p>', '2023-05-29 09:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `images_gallery`
--

CREATE TABLE `images_gallery` (
  `imgId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(25, 55, '523684c5115318d563aef2009a4fdbd6.jpg'),
(26, 55, 'a586bd9d7ebb00e69524dd2656c3e6dd.jpg'),
(27, 55, '6513d0f4c312b1d4e2c3fffeef04752f.jpg'),
(28, 55, '754b955002b2598377175baf264dd5f4.jpg'),
(29, 55, '9fc974c5da68f2c06cba551dd0326acc.jpg'),
(30, 56, 'f8c47e17164739bdf7ceabcb1372a8d3.jpg'),
(31, 56, '740cd3b8f0c6ee1c9fa8fc85b93bcf21.jpg'),
(32, 56, '76cb4156590df5eebdfde5c65733107c.jpg'),
(33, 56, 'c49d72287babcce56eafa9168807c25f.jpg'),
(34, 57, '18d3594ccf7e45e850c18e43ebf10c4f.jpg'),
(35, 57, '9aa25605e3d5a223dde734855c34f3ca.jpg'),
(36, 57, '864294fa2e9c536ae6ab60e2172923d6.jpg'),
(40, 1, '21bb22123b04c8f5ec46725ddb0159ac.jpg'),
(41, 1, 'cb0e192bfb946d2668f9074b75462eaf.jpg'),
(43, 58, 'ebc2307b7393f8b1dd9fd34fb5c7cc39.jpg'),
(45, 58, '12bf78a740af6d82d511b9ae7bd7bd52.jpg'),
(46, 59, 'b705706dcca98477c638262fa8ed481d.jpg'),
(47, 59, '4a5741d2db6cdb34b70eb5253c8df7d2.jpg'),
(48, 59, '4200e9e66c8c60b9f249e615fd9e0ac1.jpg'),
(49, 60, '04dec4d7226bf00827e6a12c6d5ea413.jpg'),
(50, 60, '40723627e0e7b8bbfad7556758effc9b.jpg'),
(51, 60, '5914020f59be095640bf7211257a68cd.jpg'),
(52, 61, '0df63ad5c6bda06150c3771c10026f99.jpg'),
(53, 61, '2ba89f32091d1dc02b09e1d28ecac542.jpg'),
(54, 61, '5d571851a670a5c0a963ee1caba61a2d.jpg'),
(55, 24, '1e31e4a9933f98d80d6b0b3ee70faf46.jpg'),
(56, 24, '1524cc608d581a634057c328b2f56a35.jpg'),
(57, 24, '52bf53a1825af657b8088a30a8970b70.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `orderDate`, `receiver`, `email`, `phone`, `province`, `district`, `ward`, `street`, `summary`, `notes`, `status`) VALUES
(72, 54, '2023-05-30', 'Nguyễn Tấn Tài', 'kingdomrok81@gmail.com', '0987866515', 'Tỉnh Cao Bằng', 'Thành phố Cao Bằng', 'Phường Sông Hiến', '28 Trịnh Đình Thảo', 1202000, '', 1),
(73, 54, '2023-05-30', 'Nguyễn Tấn Tài', 'kingdomrok81@gmail.com', '0987866515', 'Tỉnh Cao Bằng', 'Thành phố Cao Bằng', 'Phường Sông Hiến', '28 Trịnh Đình Thảo', 1202000, '', 1);

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
  `price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `returned` tinyint(4) DEFAULT 0,
  `return_reason` text DEFAULT NULL,
  `return_image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`orderId`, `productId`, `optionId`, `price`, `quantity`, `total`, `returned`, `return_reason`, `return_image`) VALUES
(72, 59, 54, 558000, 1, 558000, 0, NULL, NULL),
(72, 60, 57, 644000, 1, 644000, 0, NULL, NULL),
(73, 59, 54, 558000, 1, 558000, 0, NULL, NULL),
(73, 60, 57, 644000, 1, 644000, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status_text` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `originalPrice` float DEFAULT NULL,
  `currentPrice` float DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `salePercent` float DEFAULT NULL,
  `reviewCount` int(11) DEFAULT 0,
  `rating` float DEFAULT 5,
  `categoryId` int(11) DEFAULT NULL,
  `sold` int(11) DEFAULT 0,
  `isShown` tinyint(4) DEFAULT 1,
  `deleted` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `title`, `originalPrice`, `currentPrice`, `description`, `salePercent`, `reviewCount`, `rating`, `categoryId`, `sold`, `isShown`, `deleted`) VALUES
(1, 'Ngày đầu tuần', 300000, 270000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris. EDITED', 10, 2, 4, 1, 6, 1, 0),
(2, 'Đêm cuối', 250000, 200000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris. ', 20, 0, 5, 4, 25, 0, 0),
(3, 'Hàng về', 200000, 160000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris. ', 20, 5, 4.4, 4, 14, 1, 1),
(5, 'Its gradient', 200000, 160000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris. ', 20, 3, 3.7, 3, 45, 1, 0),
(21, 'Be your side', 300000, 285000, 'Good', 5, 0, 4, 2, 20, 1, 0),
(24, 'Colaborate', 250000, 225000, 'Good for you', 10, 0, 5, 1, 0, 0, 0),
(55, 'Perfection', 200000, 194000, 'Mô tả', 3, 0, 5, 1, 0, 1, 0),
(56, 'Punch needle', 300000, 288000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris.', 4, 0, 5, 1, 0, 1, 0),
(57, 'Simplicity', 400000, 380000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris.', 5, 0, 5, 1, 0, 1, 0),
(58, 'Signature today', 500000, 470000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris.', 6, 0, 5, 1, 0, 0, 0),
(59, 'Today up', 600000, 558000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris.', 7, 0, 5, 1, 0, 1, 0),
(60, 'Neosist', 700000, 644000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris.', 8, 0, 5, 1, 0, 1, 0),
(61, 'Continue', 800000, 728000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque molestie tellus velit, in pretium risus condimentum ut. Fusce vel ligula sit amet magna maximus dictum. Sed vulputate eu dui at convallis. Nam vitae ante fermentum, scelerisque turpis a, fermentum felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis rhoncus accumsan. Praesent fermentum sit amet velit sit amet molestie. Quisque eget risus a arcu volutpat fringilla. Morbi a metus non arcu scelerisque convallis. In euismod purus vel arcu molestie faucibus. Nunc vulputate, eros vel eleifend efficitur, lectus eros fermentum magna, sed feugiat leo sapien vitae mauris.', 9, 0, 5, 1, 0, 1, 0);

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
  `quantity` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_options`
--

INSERT INTO `product_options` (`optionId`, `productId`, `size`, `color`, `quantity`, `deleted`) VALUES
(6, 2, 'S', '#097a27', 28, 0),
(8, 2, 'XL', '#FFFF00', 47, 0),
(10, 3, 'M', '#FFFF00', 48, 0),
(11, 3, 'S', '#097a27', 49, 0),
(12, 3, 'S', '#FFFF00', 49, 0),
(17, 5, 'M', '#097a27', 5, 0),
(18, 5, 'M', '#FFFF00', 50, 0),
(19, 5, 'S', '#097a27', 50, 0),
(20, 5, 'S', '#FFFF00', 50, 0),
(34, 1, 'S', 'red', 29, 0),
(35, 1, 'M', 'green', 9, 0),
(36, 1, 'S', 'green', 16, 0),
(37, 1, 'L', 'green', 0, 0),
(38, 1, 'S', 'black', 8, 0),
(39, 1, 'S', 'white', 10, 0),
(40, 1, 'S', 'purple', 0, 0),
(41, 21, 'S', 'blue', 19, 0),
(42, 21, 'S', 'red', 20, 0),
(43, 55, 'S', 'red', 0, 0),
(44, 55, 'S', 'yellow', 0, 0),
(45, 55, 'S', 'black', 0, 0),
(46, 56, 'M', 'white', 0, 0),
(47, 56, 'XL', 'white', 20, 0),
(48, 57, 'M', 'white', 20, 0),
(49, 57, 'M', 'black', 20, 0),
(50, 57, 'L', 'black', 20, 0),
(51, 24, 'M', 'white', 20, 0),
(52, 24, 'L', 'white', 20, 0),
(53, 59, 'M', 'purple', 23, 0),
(54, 59, 'L', 'purple', 23, 0),
(55, 59, 'L', 'black', 23, 0),
(56, 60, 'S', 'yellow', 300, 0),
(57, 60, 'M', 'yellow', 300, 0),
(58, 61, 'S', 'black', 30, 0),
(59, 61, 'L', 'black', 30, 0),
(60, 61, 'L', 'white', 30, 0),
(61, 58, 'M', 'blue', 2000, 0),
(62, 58, 'S', 'red', 200, 0),
(63, 58, 'L', 'white', 30, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(30, 39, 5, 5, 'tốt', 'tốt', '2023-05-20 14:42:39', 0, 0),
(31, 39, 1, 5, 'Ngon', 'Ngon', '2023-05-23 09:41:48', 0, 0),
(32, 70, 3, 5, 'Tốt', 'Sản phẩm chất lượng, hợp túi tiền', '2023-06-01 14:37:42', 0, 0),
(33, 70, 3, 3, 'Hello', 'Hello\r\n', '2023-06-01 14:40:02', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `serviceId` int(11) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `street` text DEFAULT NULL,
  `socialLogin` tinyint(4) DEFAULT 0,
  `avatar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `fname`, `lname`, `email`, `phone`, `password`, `role`, `province`, `district`, `ward`, `street`, `socialLogin`, `avatar`) VALUES
(45, 'Nguyễn', 'Tấn Tài', '', '', '9e8d1907830b840fc2fffedc6c32aecf', 0, '', '', '', '', 1, NULL),
(46, 'Nguyễn', 'Tài', 'bieee.rise@gmail.com', '0968144233', 'd5587a8fdcce38de17dd138fcf3a7d64', 0, 'Thành phố Hà Nội', 'Quận Ba Đình', 'Phường Phúc Xá', '28 A Trịnh Đình Thảo', 1, ''),
(54, 'Nguyễn', 'Tấn Tài', 'kingdomrok81@gmail.com', '0934567547', '6089697bfc9cb5bb3d09d8513f31fcde', 0, 'Tỉnh Cao Bằng', 'Thành phố Cao Bằng', 'Phường Sông Hiến', '28 Trịnh Đình Thảo', 1, 'e2fbcbe5f31ae04a385b9abc00efb3bc.png'),
(58, NULL, NULL, 'phagame@gmail.com', NULL, 'fcea920f7412b5da7be0cf42b8c93759', 0, NULL, NULL, NULL, NULL, 0, NULL),
(59, NULL, NULL, 'newAccount@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', 0, NULL, NULL, NULL, NULL, 0, NULL),
(60, NULL, NULL, 'newAccount2@gmail.com', NULL, 'e10adc3949ba59abbe56e057f20f883e', 0, NULL, NULL, NULL, NULL, 0, NULL),
(64, 'Nguyễn', 'Tấn Tài', 'kingdom3149.rok.3@gmail.com', '', '9e8d1907830b840fc2fffedc6c32aecf', 0, '', '', '', '', 1, NULL),
(65, 'Nguyễn', 'Tấn Tài', 'kingdom3149.rok.2@gmail.com', '0934567546', '8bc5f7026c8d775ab5791cdf5c77d45b', 0, 'Tỉnh Cao Bằng', 'Thành phố Cao Bằng', 'Phường Sông Hiến', '28 Trịnh Đình Thảo', 1, NULL),
(66, 'Nguyễn', 'Tấn Tài', 'kingdom3149.rok.1@gmail.com', '0934567548', '4c35826a6e9950db0076eedd8d2325ca', 0, 'Tỉnh Cao Bằng', 'Thành phố Cao Bằng', 'Phường Sông Hiến', '28 Trịnh Đình Thảo', 1, '4f7f0b95fdc55df305d367dc45ce5049.png'),
(68, 'Nguyen', 'TanTai', 'taint3112@gmail.com', '', '6e96ac2294f85a0cd1c543553de76e64', 0, '', '', '', '', 1, 'https://lh3.googleusercontent.com/a/AAcHTtc1v1psd6nZUZac2JGQ_XQyqM5zH8A_0sKPOzG7=s96-c'),
(70, 'Ti', 'Nguyễn', 'grayink69@gmail.com', '', '6ae04dc6952f245a6cf68607945f32f8', 0, '', '', '', '', 1, 'https://scontent.fsgn2-7.fna.fbcdn.net/v/t1.30497-1/84628273_176159830277856_972693363922829312_n.jpg?stp=c15.0.50.50a_cp0_dst-jpg_p50x50&_nc_cat=1&ccb=1-7&_nc_sid=12b3be&_nc_ohc=T1s2hGEaBOsAX_yq534&_nc_ht=scontent.fsgn2-7.fna&edm=AP4hL3IEAAAA&oh=00_AfAFEaKNVJDyuE7YWuyNq8zbTl9hW7FrbtdlGidu673TdQ&oe=649FB6D9');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`userId`, `productId`) VALUES
(41, 21),
(43, 2);

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
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=531;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blogId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `branId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `images_gallery`
--
ALTER TABLE `images_gallery`
  MODIFY `imgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `product_options`
--
ALTER TABLE `product_options`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
