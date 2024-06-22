-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 22, 2024 lúc 08:28 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ani_fashions`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `IsDeleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`ID`, `Name`, `IsDeleted`) VALUES
(16, 'Gucci', 0),
(17, 'Hemes', 0),
(18, 'Dior ', 0),
(19, 'Prada ', 0),
(20, 'Burberry ', 0),
(21, 'Ralph Lauren ', 0),
(22, 'Céline ', 0),
(23, 'GGG ', 0),
(24, 'BLA ', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `code` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `total` bigint(20) NOT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `IsDeleted` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `code`, `fullname`, `email`, `phone`, `address`, `total`, `note`, `payment`, `order_date`, `status`, `IsDeleted`) VALUES
(10, 'CODE5965', 'kiều đặng bảo sơn', 'baooson3005@gmail.com', '0386278998', 'số nhà b4 khu tập thể viện khoa học nông nghiệp', 46300000, 'can gap', 'Thanh toán khi nhận hàng', '2024-06-22', 0, 0),
(12, 'CODE6500', 'kiều đặng bảo sơn', 'baooson3005@gmail.com', '0386278998', 'số nhà b4 khu tập thể viện khoa học nông nghiệp', 24300000, 'can gap', 'Thanh toán khi nhận hàng', '2024-06-22', 3, 0),
(15, 'CODE5361', 'Nguyễn Văn Huy', 'nguyenvanhuy@gmail.com', '03381123333', 'Hà Nội', 104000000, 'Đúng ngày', 'Thanh toán bằng VNPAY', '2024-06-22', 3, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `code` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `id_order`, `code`, `image`, `name`, `quantity`, `price`) VALUES
(1, 10, 'CODE5965', 'dior4.jpg ', 'NTH00018 ', 1, 34000000),
(2, 10, 'CODE5965', 'gucci7.jpg ', 'NTH00012 ', 1, 12300000),
(4, 12, 'CODE6500', 'gucci3.jpg ', 'NTH00011 ', 1, 12000000),
(5, 12, 'CODE6500', 'gucci7.jpg ', 'NTH00012 ', 1, 12300000),
(7, 15, 'CODE5361', 'dior8.jpg ', 'NTH00017 ', 2, 17000000),
(8, 15, 'CODE5361', 'gucci3.jpg ', 'NTH00011 ', 3, 12000000),
(9, 15, 'CODE5361', 'dior4.jpg ', 'NTH00018 ', 1, 34000000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(255) NOT NULL,
  `Mô tả` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `images` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `category_ID` int(11) DEFAULT NULL,
  `IsDeleted` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`ID`, `Name`, `price`, `Mô tả`, `images`, `status`, `category_ID`, `IsDeleted`) VALUES
(28, 'NTH0004 ', 21000000, '', 'ad5.jpg ', 1, 17, 0),
(29, 'NTH0005 ', 9500000, '', 'ad6.jpg ', 1, 18, 0),
(30, 'NTH0006 ', 16800000, '', 'ad7.jpg ', 1, 19, 0),
(31, 'NTH0007 ', 12000000, '', 'nth007.jpg ', 1, 17, 0),
(32, 'NTH00015 ', 67567570, '', 'nth00015.jpg ', 1, 16, 0),
(34, 'NTH0001 ', 14900000, '', 'dior1.jpg ', 1, 18, 0),
(35, 'NTH0002 ', 35000000, '', 'dior2.jpg ', 1, 18, 0),
(36, 'NTH0008 ', 8000000, '', 'dior3.jpg ', 1, 18, 0),
(38, 'NTH00010 ', 10000000, '', 'gucci1.jpg ', 1, 16, 0),
(39, 'NTH00011 ', 12000000, '', 'gucci3.jpg ', 1, 16, 0),
(40, 'NTH00012 ', 12300000, '', 'gucci7.jpg ', 1, 16, 0),
(41, 'NTH00013 ', 23000000, '', 'gucci8.jpg ', 1, 16, 0),
(42, 'NTH00014 ', 14000000, '', 'dior6.jpg ', 1, 18, 0),
(44, 'NTH00017 ', 17000000, '', 'dior8.jpg ', 1, 18, 0),
(45, 'NTH00016 ', 17900000, '', 'dior7.jpg ', 1, 18, 0),
(46, 'NTH00018 ', 34000000, '', 'dior4.jpg ', 1, 18, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` int(11) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_level` int(50) NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID`, `Name`, `Email`, `user_level`, `password`) VALUES
(18, 'Nguyễn Thị Hương ', 'nguyenthihuong@gmail.com ', 1, '195204 '),
(20, 'Nguyễn Thị Mai ', 'nguyenthimai@gmail.com ', 0, '1608 '),
(21, 'Nguyễn Thế Vinh ', 'nguyenthevinh@gmail.com ', 0, '1919 '),
(25, 'Nguyễn Văn Huy ', 'huy@gmail.com ', 0, '1234 '),
(26, 'Phó Hữu Nghĩa ', 'phohuunghia@gmail.com ', 0, '2005 ');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
