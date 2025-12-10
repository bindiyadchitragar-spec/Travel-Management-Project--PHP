-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2024 at 08:42 AM
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
-- Database: `tourism_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `status` enum('booked','cancelled','completed') DEFAULT 'booked',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `booked_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `cancelled_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `package_id`, `status`, `created_at`, `booked_on`, `cancelled_on`) VALUES
(1, 2, 2, 'cancelled', '2024-08-06 08:29:22', '2024-08-07 05:49:38', NULL),
(2, 2, 8, 'cancelled', '2024-08-06 08:30:39', '2024-08-07 05:49:38', '2024-08-07 05:51:24'),
(3, 2, 2, 'cancelled', '2024-08-07 05:48:31', '2024-08-07 05:49:38', '2024-08-07 05:51:34');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Rohan', 'ro@gmail.com', 'sdfvbndcgbn', '2024-08-06 06:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` enum('open','closed') DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `price`, `created_at`) VALUES
(1, 'Weekend City Escape', 'A 2-day trip to explore the city’s top attractions, including a guided tour and local dining experiences.', 199.99, '2024-08-06 07:50:04'),
(2, 'Tropical Beach Getaway', 'A 5-day stay at a luxurious beach resort with all-inclusive meals, water sports, and relaxation options.', 799.99, '2024-08-06 07:50:04'),
(3, 'Mountain Adventure', 'A 7-day adventure package with hiking, camping, and guided mountain excursions.', 899.99, '2024-08-06 07:50:04'),
(4, 'European Grand Tour', 'A 14-day tour through major European cities including guided tours, accommodations, and transportation.', 2999.99, '2024-08-06 07:50:04'),
(5, 'Cultural Heritage Journey', 'An 8-day package exploring historical sites and cultural landmarks with local guides and immersive experiences.', 1499.99, '2024-08-06 07:50:04'),
(6, 'Luxury Safari Experience', 'A 10-day safari with luxury tented camps, game drives, and wildlife viewing in a top safari destination.', 2599.99, '2024-08-06 07:50:04'),
(7, 'Romantic Island Escape', 'A 7-day romantic retreat on a secluded island with private beach dinners and couples’ activities.', 1699.99, '2024-08-06 07:50:04'),
(8, 'Family Fun Vacation', 'A 5-day family package including theme park tickets, family-friendly accommodations, and entertainment options.', 799.99, '2024-08-06 07:50:04'),
(9, 'Cruise Adventure', 'A 10-day cruise with stops at various ports, including onboard activities, excursions, and gourmet dining.', 1199.99, '2024-08-06 07:50:04'),
(10, 'Wellness Retreat', 'A 6-day wellness package with yoga sessions, spa treatments, and health-focused meals in a serene environment.', 1399.99, '2024-08-06 07:50:04'),
(11, 'Historical Egypt Expedition', 'A 12-day tour exploring ancient Egypt’s pyramids, temples, and historical sites with expert guides.', 1799.99, '2024-08-06 07:50:04'),
(12, 'Asian Culinary Journey', 'A 7-day package focused on culinary experiences with cooking classes and dining in top Asian cities.', 1299.99, '2024-08-06 07:50:04'),
(13, 'Desert Adventure', 'A 5-day desert safari with camel rides, sandboarding, and desert camping under the stars.', 899.99, '2024-08-06 07:50:04'),
(14, 'Alpine Ski Retreat', 'A 7-day ski package including lift tickets, ski rentals, and accommodations in a renowned alpine resort.', 1099.99, '2024-08-06 07:50:04'),
(15, 'Caribbean Cruise', 'A 7-day Caribbean cruise with multiple island stops, onboard entertainment, and beach excursions.', 1399.99, '2024-08-06 07:50:04'),
(16, 'Mediterranean Coastal Tour', 'A 10-day coastal tour of Mediterranean countries with scenic drives, local cuisine, and cultural activities.', 1599.99, '2024-08-06 07:50:04'),
(17, 'Australia Outback Expedition', 'A 14-day exploration of Australia’s outback including guided tours, wildlife encounters, and adventure activities.', 2499.99, '2024-08-06 07:50:04'),
(18, 'South American Adventure', 'A 12-day journey through South America including rainforests, ancient ruins, and vibrant cities.', 1899.99, '2024-08-06 07:50:04'),
(19, 'Northern Lights Experience', 'A 5-day trip to view the Northern Lights with guided tours, winter activities, and cozy accommodations.', 999.99, '2024-08-06 07:50:04'),
(20, 'Japan Cultural Immersion', 'A 7-day cultural package exploring traditional Japanese culture, including tea ceremonies, historical sites, and local cuisine.', 1399.99, '2024-08-06 07:50:04'),
(21, 'Luxury Alpine Escape', 'A 7-day luxury stay in an alpine resort with private ski lessons, spa treatments, and gourmet dining.', 1899.99, '2024-08-06 07:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$K8GbTogXyNUPtdXs7g/Hh.mxzYbO7VGLKI9oUlA3rrtDVp/wrYoA.', 'admin', '2024-08-06 06:42:07'),
(2, 'Rohan', 'ro@gmail.com', '$2y$10$l7Ex4o7ypZZWGz5z.U9PIuwjq6EVyuTS5gcIAA.uSLYBQYU0Tt7kS', 'user', '2024-08-06 08:15:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`);

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `issues_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
