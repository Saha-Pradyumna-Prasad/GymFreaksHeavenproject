-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 03:55 PM
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
-- Database: `gym_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `transaction` varchar(100) DEFAULT 'Pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `product_name`, `customer_name`, `address`, `phone`, `transaction`, `order_date`) VALUES
(1, 'Weight lifting belt', 'SPPA', 'badda', '0186245268', 'badda', '2026-02-04 14:07:32'),
(2, 'Leg press machine', 'manik', 'abdulapur', '04654564656', 'abdulapur', '2026-02-04 14:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) NOT NULL,
  `category` enum('equipment','accessories','supplements') NOT NULL,
  `image` varchar(255) DEFAULT 'default.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`, `image`, `created_at`) VALUES
(1, 'Pre-Workout', 'Best pre-workout we provide', 2800, 'supplements', 'preworkout.jpg', '2026-02-01 13:06:58'),
(4, 'Bemch press machine', 'nice machine', 75000, 'equipment', 'https://i5.walmartimages.com/asr/726f6fc9-4c09-4c65-9a1b-f0a76ce91105.19795db54f554679b36dc48ca66c217e.jpeg', '2026-02-02 15:14:58'),
(5, '	Smith machine', 'Perfect for multiple exercise', 90000, 'equipment', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSoWlwrmIiQUhT4gFaLHhHct1iwEHwIDlmgfQ&s', '2026-02-02 15:22:23'),
(6, 'Leg press machine', 'Quad,Hamstring,Calves,Inner thigh muscle will be perfect train with this machine.', 100000, 'equipment', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_LMue8MEwMMb3CUnFoZXhVmbl1QAzKVC6_g&s', '2026-02-02 15:25:18'),
(7, 'Prechure curl machine', 'Perfect for long head and short head biceps', 60000, 'equipment', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSa3lMkSoE2LViMpQu7Uorvmv6vUaZOvW3SrQ&s', '2026-02-02 15:28:30'),
(8, 'Lat pull down machine', 'Perfect for lats and middle back', 110000, 'equipment', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNByEmPuzl_dQ031PM_wxbFAct8HE84MyVYw&s', '2026-02-02 15:32:18'),
(9, 'Weight lifting belt', 'Unique leather and comfort', 9000, 'accessories', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9-ZRoQS-3i8vCy-fmryuut8Qh4g9EnxNI1Q&s', '2026-02-02 15:33:51'),
(10, 'Wrist guard', 'Good material in here.', 500, 'accessories', 'https://img.drz.lazcdn.com/static/bd/p/47016676ae71dc822fe0467c673f3f08.jpg_720x720q80.jpg', '2026-02-02 15:52:23'),
(14, 'Knee support (1 pis)', 'Heavy squat and leg press support here', 350, 'accessories', 'https://m.media-amazon.com/images/I/616T74IemXL._UF894,1000_QL80_.jpg', '2026-02-02 15:57:42'),
(15, 'Elbow support', 'Perfect push', 400, 'accessories', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxjxJ_oRw7XzT5eJABgu9LrOT6bVlg-q3X-A&s', '2026-02-02 15:59:16'),
(16, 'Protein Shaker Bottle', 'Show your perfectness', 600, 'accessories', 'https://img.drz.lazcdn.com/static/bd/p/0fcb9b66b7bef42000aebe141ad1f2d5.jpg_720x720q80.jpg', '2026-02-02 16:02:13'),
(17, 'Whey protein (5kg)', 'Imported protein', 7000, 'supplements', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQez5Ku2u_yIiiwpAL99N1FIY9gn1OwE4xpw&s', '2026-02-02 16:03:47'),
(18, 'Creatine', 'Pump matters', 2500, 'supplements', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5x9HTQ_i3GCY2RaHKnHd7_sBofwDYyXKcsQ&s', '2026-02-02 16:04:46'),
(19, 'Post Workout', 'Muscle needs recovery', 2200, 'supplements', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxN-PXm8ZjL7VnvHr33fcVsnwzprFkpK9n7A&s', '2026-02-02 16:06:10'),
(20, 'PB fit peanut butter', 'Best peanut butter we provide', 1200, 'supplements', 'https://m.media-amazon.com/images/I/71yiCy+EEXL._SL1000_.jpg', '2026-02-02 16:07:42'),
(21, 'Leg extention machine', 'Multi head quad muscle', 80000, 'equipment', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRj2gChVYpye9V5UndTdLXlNbxefkzWkh0rQg&s', '2026-02-02 16:09:40'),
(22, 'Heavy lifting straps', 'Grip increases strength ', 330, 'accessories', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTDUmadQF5gimyusxVl_MiWI2PZxYD0eVutA&s', '2026-02-02 16:14:05'),
(23, 'BCAA', 'Best for health', 2500, 'supplements', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSmMvGTfgUZOf0lDFlJZdEmGaaJnv4G3yl-kw&s', '2026-02-03 12:50:12'),
(24, 'Pec fly machine', 'Multi fuction pec fly machine', 84000, 'equipment', 'https://welcarefitness.com/image/cache/catalog/SS%20002%20PECFLY%20%20REARDELT-1500x1500.jpg', '2026-02-04 14:18:11'),
(25, 'Punching bag', 'Best quality material', 1800, 'equipment', 'https://invincible.in/cdn/shop/products/2_27ec6f45-8620-43f9-9c62-1c8185663275_1200x.jpg?v=1676361346', '2026-02-04 14:29:18'),
(26, 'Dumble rack with dumbles', '100kg+ weight  ', 250000, 'equipment', 'https://www.vervefitness.com.au/cdn/shop/products/VERVE_Large_Dumbbell_Rack_1800x1800_45d4a3f3-d4e8-4b6e-9c45-cdeef5302a4c.png?v=1607925398', '2026-02-04 14:31:48'),
(27, 'Barbell rack with barbell', 'Perfect standing rack.', 100000, 'equipment', 'https://bellsofsteel.com/cdn/shop/files/CRL-FXB_Carousel_13_6937b5d1-932a-42ed-9450-4d3351184011.jpg?v=1764591072&width=2048', '2026-02-04 14:33:12'),
(28, 'Gym bag', 'Big size bag', 2000, 'accessories', 'https://m.media-amazon.com/images/I/91wv23DWzPL.jpg', '2026-02-04 14:34:57'),
(29, 'Gym shoes', 'Best for workout', 1200, 'accessories', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8-kpUHlQgV8IqhHmwkLAADDsg8-50D67ZYw&s', '2026-02-04 14:36:59'),
(30, 'Gym gloves', 'Best leather', 1300, 'accessories', 'https://www.gymsupplementscenterbangladesh.com/uploads/product/a79380989271adfef2bdcd49aa68fcc2.jpg', '2026-02-04 14:38:22'),
(31, 'Gym towel', 'Softness and hygenic matters', 700, 'accessories', 'https://m.media-amazon.com/images/I/81SKTletWUL._AC_SL400_.jpg', '2026-02-04 14:39:48'),
(32, 'Collagen powder', 'Good for body', 2600, 'supplements', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnXuKDYXIbuljGzDD-1JmWtJboYjMxTM_34Q&s', '2026-02-04 14:41:42'),
(33, 'Omega 3 ', 'Best fish oil', 1800, 'supplements', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkzHIHstLiTAZckpv7uV2sbX_uMcpayPqvFg&s', '2026-02-04 14:43:20'),
(34, 'Himalaya pink salt', 'Best for body water', 350, 'supplements', 'https://chocolateshopbd.com/wp-content/uploads/2024/03/Virginia-Green-Garden-Himalayan-Pink-Salt1.png', '2026-02-04 14:44:52'),
(35, 'Zinc tablet', 'Best for health\r\n', 300, 'supplements', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSDyuNohQGwfjz9UuxEBdPlJweYuPIxqT_RA&s', '2026-02-04 14:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `phone`, `password`, `role`, `created_at`) VALUES
(1, 'admin@gym.com', '01700000000', '123', 'admin', '2026-01-30 16:33:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
