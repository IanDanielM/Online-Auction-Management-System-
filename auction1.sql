-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2021 at 10:38 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `bid_amount` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `user_id`, `product_id`, `bid_amount`, `status`) VALUES
(77, 6815, 32, 9700, 1),
(78, 771091, 32, 10000, 1),
(79, 8209, 32, 15000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(255) NOT NULL,
  `cat_title` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(2, 'cars'),
(6, 'des'),
(7, 'art');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `text`) VALUES
('ian', 'iandan874@gmail.com', 'yoyoyoo');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_category` int(255) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `minimum_price` int(255) NOT NULL,
  `prod_img` varchar(255) NOT NULL,
  `session_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `user_id`, `prod_category`, `prod_name`, `minimum_price`, `prod_img`, `session_date`) VALUES
(22, 2147483647, 1, 'bidd', 7000, '1631519951_Auction-770x285.jpg', '2021-09-13 13:30:02'),
(23, 2147483647, 1, 'mayai', 10000, '1631534018_online-auction-concept-taking-action-device-banner-set-digital-bid-buy-art-flat-vector-illustration-145571195.jpg', '2021-09-13 18:50:00'),
(25, 2147483647, 2, 'let', 9000, '1631845732_2021-04-28.png', '2021-09-22 05:28:00'),
(26, 9119, 2, 'polo', 7000, '1631884005_2021-07-16 (1).png', '2021-09-17 16:06:00'),
(28, 9119, 2, 'firii', 9000, '1631884187_2021-07-21.png', '2021-09-17 17:09:00'),
(29, 9119, 7, 'helo', 90000, '1631884236_2021-05-06 (2).png', '2021-09-17 16:16:00'),
(30, 7216, 2, 'lamborgini', 90000, '1631884304_2021-07-04.png', '2021-09-17 17:11:00'),
(31, 7216, 6, '1/2 acre land', 8000, '1631884360_2021-07-06.png', '2021-09-17 19:12:00'),
(32, 2147483647, 6, 'iol', 9500, '1631884952_2021-04-25.png', '2021-09-17 16:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `user_type` varchar(24) NOT NULL DEFAULT 'BIDDER',
  `f_name` varchar(244) NOT NULL,
  `l_name` varchar(24) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(244) NOT NULL,
  `cpassword` varchar(244) NOT NULL,
  `phoneno` int(25) NOT NULL,
  `DOB` date NOT NULL,
  `user_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_type`, `f_name`, `l_name`, `email`, `password`, `cpassword`, `phoneno`, `DOB`, `user_img`) VALUES
(13, 0, 'admin', 'admin', 'admin', 'admin@admin.com', 'admin123', 'admin123', 725083128, '2021-09-01', ''),
(15, 6815, 'bidder', 'Ian', 'Daniel', 'iandan874@gmail.com', 'math', 'math', 795083138, '2021-09-02', '1631519848_online-auction-concept-taking-action-device-banner-set-digital-bid-buy-art-flat-vector-illustration-145571195.jpg'),
(16, 771091, 'bidder', 'pricilla', 'Wambui', 'pri@gmail.com', 'pri', 'pri', 727774592, '2021-09-03', '1631519892_My Post (1).png'),
(17, 2147483647, 'seller', 'Maureen', 'Wambui', 'maureennyakinyua@gmail.com', 'mau', 'mau', 727774592, '2021-09-06', '1631519917_My Post (3).png'),
(19, 7725, 'bidder', 'mr', 'dan', 'mr@gmail.com', 'mrenda77', 'mrenda77', 795083138, '2021-09-01', '1631876630_2021-06-13.png'),
(20, 7216, 'seller', 'paul', 'kibunja', 'paul@gmail.com', 'pau123', 'pau123', 2147483647, '2021-08-13', '1631883768_2021-08-07 (1).png'),
(21, 8209, 'bidder', 'shiti', 'dj', 'djshiti@gmail.com', 'djshiti', 'djshiti', 494044049, '2021-06-09', '1631883834_2021-07-21.png'),
(22, 9119, 'seller', 'demasi', 'dem', 'dem@gmail.com', 'dema2', 'dema2', 8892039, '2021-09-07', '1631883916_2021-07-24.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
