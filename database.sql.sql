-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 04:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminbids`
--

CREATE TABLE `adminbids` (
  `name` varchar(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  `category` varchar(50) NOT NULL,
  `file_name` varchar(500) NOT NULL,
  `st_bid_price` int(11) NOT NULL,
  `u_date` date NOT NULL,
  `l_date` date NOT NULL,
  `owner` varchar(200) NOT NULL,
  `upi_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `imagesadminpanel`
--

CREATE TABLE `imagesadminpanel` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `imagesadminpanel`
--

INSERT INTO `imagesadminpanel` (`id`, `image_url`, `title`, `description`, `link`) VALUES
(1, 'https://bimmerlife.com/wp-content/uploads/2020/11/img_6-2048x1152.jpg', 'PORSHE 911', 'Get ready for the ride of your life! This sleek Porsche 911 is up for auction, offering unmatched performance and style. With its powerful engine and iconic design, the Porsche 911 is a symbol of automotive excellence.', 'product.php?id=62'),
(2, 'https://images.hdqwalls.com/download/porsche-911-carrera-4s-2019-vf-2560x1440.jpg', 'PORSHE 911 GT3', 'The Porsche 911 GT3 is a high-performance sports car renowned for its precision engineering, exhilarating driving experience, and iconic design.', 'product.php?id=63');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `user_email` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `zip` int(11) NOT NULL,
  `mobilenum` int(11) NOT NULL,
  `delivery_status` enum('pending','on the way','delivered') NOT NULL DEFAULT 'pending',
  `order_id` varchar(100) NOT NULL,
  `payment_id` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`user_email`, `user_name`, `product_id`, `price`, `address`, `zip`, `mobilenum`, `delivery_status`, `order_id`, `payment_id`) VALUES
('krishkakadiya29@gmail.com', 'krish', 51, 201, 'a', 395004, 2147483647, 'on the way', 'krish29@gmail.com20240420053457', '0'),
('temp@gmail.com', 'temp', 68, 75, 'b-101 abc resi., ', 395004, 2147483647, 'on the way', 'temp@gmail.com20240420070603', '0');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `category` varchar(35) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `st_bid_price` int(100) NOT NULL,
  `highest_bid_price` int(11) NOT NULL,
  `highest_bid_price_users` varchar(50) NOT NULL,
  `Last_date` date NOT NULL,
  `upi_id` varchar(20) NOT NULL,
  `owner` varchar(200) NOT NULL,
  `ispaymentdone` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category`, `file_name`, `st_bid_price`, `highest_bid_price`, `highest_bid_price_users`, `Last_date`, `upi_id`, `owner`, `ispaymentdone`) VALUES
(51, 'Sofa', 'The sofa, a staple of home comfort, embodies relaxation and style. Its design evolves with trends, from sleek modern lines to classic tufted elegance. Upholstered in rich fabrics or supple leather, it beckons for leisurely moments and cozy gatherings. The sofa, an essential piece, defines the heart of a living space', 'Furniture', 'sofa.jpg', 200, 201, 'krishkakadiya29@gmail.com', '2024-04-20', '9924157054@gpay.com', 'ieitata@gmail.com', 1),
(55, 'Porshe', 'Get ready for the ride of your life! This sleek Porsche 911 is up for auction, offering unmatched performance and style. With its powerful engine and iconic design, the Porsche 911 is a symbol of automotive excellence.', 'Car', 'dd.jpg', 100, 103, 'rkp@gmail.com', '2024-04-30', 'ad', 'ieitata44@gmail.com', 0),
(62, 'PORSHE 911', 'Get ready for the ride of your life! This sleek Porsche 911 is up for auction, offering unmatched performance and style. With its powerful engine and iconic design, the Porsche 911 is a symbol of automotive excellence.', 'Car', 'porshe.jpg', 175000, 176000, 'krishkakadiya29@gmail.com', '2024-04-30', 'mayurpatell7200@gmai', 'ieitata44@gmail.com', 0),
(63, 'PORSHE 911 GT3', 'The Porsche 911 GT3 is a high-performance sports car renowned for its precision engineering, exhilarating driving experience, and iconic design.', 'Car', 'porsche-911-carrera-4.jpg', 200000, 0, '', '2024-04-24', 'mayurpatell7200@gmai', 'ieitata44@gmail.com', 0),
(64, 'Travel Bags', 'Travel bags: Durable, spacious, and stylish companions for your journeys. Designed with convenience in mind, they offer ample storage, organizational features, and ergonomic designs for hassle-free travel.', 'travel', 'bags.jpg', 3000, 0, '', '2024-04-23', 'ad', 'ieitata44@gmail.com', 0),
(65, 'Laptop', 'Laptop: Portable computing powerhouse for work, study, and entertainment. Compact, versatile, and essential in today\'s digital age for productivity and connectivity on the go', 'Electronics', 'lap.jpg', 6000, 0, '', '2024-04-24', 'Krishkakadiya@okaxis', 'ieitata44@gmail.com', 0),
(66, 'Books', 'Books: Gateways to boundless worlds, offering knowledge, escape, and inspiration. From fiction to non-fiction, they enrich lives and fuel imagination.', 'Books', 'stack-books-with-one-that-says-w.jpg', 100, 0, '', '2024-04-21', 'Krishkakadiya@okaxis', 'ieitata44@gmail.com', 0),
(67, 'Shoes', 'Shoes: Your style\'s foundation, offering comfort, durability, and fashion flair. From sneakers to stilettos, they carry you through every step with confidence.', 'Shoes', 'black-sneakers-yellow-background.jpg', 200, 205, 'rkp@gmail.com', '2024-04-19', 'Krishkakadiya@okaxis', 'ieitata44@gmail.com', 0),
(68, 'PS5 Controller', 'PS5 Controller: Your gaming companion, offering precision, responsiveness, and immersive experiences. Designed for seamless gameplay, it elevates your gaming adventures to new levels of excitement', 'Controller', 'neon-cyberpunk-gamepad-motion-sc.jpg', 70, 75, 'temp@gmail.com', '2024-04-19', 'Krishkakadiya@okaxis', 'ieitata44@gmail.com', 0),
(69, 'Fash Wash', 'Refreshing and revitalizing, it cleanses away impurities, leaving skin feeling clean and rejuvenated. A daily essential for a fresh and glowing complexion.', 'Cream', 'skincare-products-near-lemon-hon.jpg', 50, 0, '', '2024-04-23', 'Krishkakadiya@okaxis', 'ieitata44@gmail.com', 0),
(70, 'Vegetables', 'Nature\'s bounty, packed with vitamins, minerals, and essential nutrients. From vibrant greens to colorful roots, they nourish the body and delight the palate.', 'Vegetables', 'top-view-fruits-vegetables_10573.jpg', 30, 0, '', '2024-04-24', 'mayurpatell7200@gmai', 'ieitata44@gmail.com', 0),
(71, 'Dress', 'Dress: Effortlessly chic and versatile, it embodies style and confidence. From casual elegance to formal flair, it\'s the perfect expression of your individuality.', 'WomenCollection', 'womenscoll.jpg', 15, 0, '', '2024-04-25', 'Krishkakadiya@okaxis', 'ieitata44@gmail.com', 0),
(72, 'HeadPhones', 'Headphones: Your personal soundtrack, delivering immersive audio and unparalleled comfort. Whether for work or play, they elevate every moment with crystal-clear sound.', 'HeadPhones', 'beautiful-woman-enjoying-song-he.jpg', 150, 0, '', '2024-04-30', 'mayurpatell7200@gmai', 'ieitata44@gmail.com', 0),
(88, 'vintage car', 'vintage car', 'Car', 'iStock-588605048-1.jpg', 10000, 0, '', '2024-04-30', '', 'admin', 0),
(89, 'vintage car RR', 'vintage car', 'Books', 'iStock-588605048-1.jpg', 11000, 0, '', '2024-04-30', '', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `email` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `message` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `response`
--

INSERT INTO `response` (`email`, `name`, `mobile`, `message`) VALUES
('a@gmail.com', 'asas', '0', 'asa'),
('a@gmail.com', 'krish', '9824140236', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_auction`
--

CREATE TABLE `upcoming_auction` (
  `title` varchar(250) NOT NULL,
  `date` varchar(200) NOT NULL,
  `link` varchar(500) NOT NULL,
  `image_url` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upcoming_auction`
--

INSERT INTO `upcoming_auction` (`title`, `date`, `link`, `image_url`) VALUES
('Important Watch\r\n', '07-04-2024 to 08-04-2024', '#', 'https://img.freepik.com/premium-photo/stack-books-with-one-that-says-word-it_732812-1236.jpg?w=740'),
('Painting', '09-05-2025', 'https://www.shutterstock.com/image-illustration/retro-car-old-city-street-600nw-494922733.jpg', 'https://www.shutterstock.com/image-illustration/retro-car-old-city-street-600nw-494922733.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobilenum` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `mobilenum`) VALUES
('krish', 'krishkakadiya29@gmail.com', 'abc@123A', '9924157054'),
('temp', 'temp@gmail.com', 'temp12@A', '9999999999'),
('romit', 'rkp@gmail.com', 'Romit@2005', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `usersallbid`
--

CREATE TABLE `usersallbid` (
  `user_email` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `bid_price` int(11) NOT NULL,
  `timing` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usersallbid`
--

INSERT INTO `usersallbid` (`user_email`, `product_id`, `bid_price`, `timing`) VALUES
('krishkakadiya29@gmail.com', 51, 201, '2024-04-20'),
('temp@gmail.com', 68, 75, '2024-04-20'),
('rkp@gmail.com', 67, 205, '2024-04-20'),
('rkp@gmail.com', 55, 101, '2024-04-20'),
('rkp@gmail.com', 55, 102, '2024-04-20'),
('rkp@gmail.com', 55, 103, '2024-04-20'),
('krishkakadiya29@gmail.com', 62, 176000, '2024-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `user_email` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `paymentstatus` tinyint(1) NOT NULL DEFAULT 0,
  `address` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL,
  `base_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `winners`
--

INSERT INTO `winners` (`user_email`, `price`, `paymentstatus`, `address`, `product_id`, `base_price`) VALUES
('temp@gmail.com', 75, 0, 'null', 68, 70),
('rkp@gmail.com', 205, 0, 'null', 67, 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imagesadminpanel`
--
ALTER TABLE `imagesadminpanel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imagesadminpanel`
--
ALTER TABLE `imagesadminpanel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
