-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2024 at 09:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'thienbao', 'admin', '202cb962ac59075b964b07152d234b70'),
(15, 'bao', 'bao', '202cb962ac59075b964b07152d234b70'),
(16, 'bao11', '123', '698d51a19d8a121ce581499d7b701668'),
(17, 'vu', 'vu', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(10, 'Food', 'Food_Category_9.jpg', 'Yes', 'Yes'),
(14, 'Drink', 'Food_Category_10.jpg', 'Yes', 'Yes'),
(15, 'Food', 'Food_Category_586.jpg', 'Yes', 'No'),
(16, 'Food', 'Food_Category_273.jpg', 'Yes', 'No'),
(17, 'Drink', 'Food_Category_697.jpg', 'Yes', 'No'),
(18, 'Food', 'Food_Category_642.png', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(18, 'Coca', 'Coca', 10.00, 'Food-Name843.jpg', 14, 'Yes', 'Yes'),
(19, 'Pepsi', 'Pepsi', 40.00, 'Food-Name673.jpg', 14, 'Yes', 'Yes'),
(20, 'Burger', 'Burger with meat', 50.00, 'Food-Name662.jpg', 10, 'Yes', 'Yes'),
(21, 'Sausage', 'Sausage', 20.00, 'Food-Name158.jpg', 10, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Burger', 200.00, 1, 200.00, '2023-12-29 11:17:03', 'Ordered', 'bao', '9789879879', 'baonguyen@gmail.com', '323 tran quang khai'),
(2, 'Burger', 200.00, 3, 600.00, '2023-12-29 11:23:01', 'Ordered', 'vu', '980800800', 'vu@gmail.com', '23 dien bien phu'),
(3, 'Cacao Milk', 250.00, 3, 750.00, '2023-12-29 11:26:11', 'Ordered', 'bão', '090678954', 'baohh@gmail.com', '32 Âu Cơ'),
(4, 'Combo burger', 250.00, 2, 500.00, '2023-12-29 11:28:09', 'On Delivery', 'Bằng', '098765340', 'bangchiu@gmail.com', '32 Lạc Long Quân'),
(5, 'Cacao Milk', 250.00, 2, 500.00, '2023-12-29 11:29:41', 'Cancelled', 'Lan', '098987987', 'lan@gmail.com', '32 Lạc Long Quân'),
(6, 'Combo burger', 250.00, 2, 500.00, '2024-01-05 08:19:53', 'Delivered', 'Hue', '030303030303030', 'khoannnn20@gmail.com', '32 Minh Khai'),
(7, 'Combo burger', 250.00, 1, 250.00, '2024-01-06 03:00:02', 'Ordered', 'bbb', '99999999999', 'bbbb@gmail.com', '2222222222222'),
(8, 'Coca', 10.00, 3, 30.00, '2024-01-06 09:11:08', 'Ordered', 'bao', '090909090', 'baont22@gmail.com', '32 minh khai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
