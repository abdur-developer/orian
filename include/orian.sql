-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2025 at 07:14 PM
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
-- Database: `orian`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(1) NOT NULL,
  `who` text NOT NULL,
  `aim` text NOT NULL,
  `service` text NOT NULL,
  `why` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `who`, `aim`, `service`, `why`) VALUES
(1, 'aa', 'cc', 'bb', 'dd');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(1) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'abdurrahman', '$2y$10$X8uYjjabdfKhGZrOWHFhUe1pbWxRS4G6SDaPNqNSVil/.piX7EmiO');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `ref_id` int(11) NOT NULL COMMENT 'course/ product id',
  `quantity` int(3) NOT NULL DEFAULT 1,
  `price` int(10) NOT NULL COMMENT 'per item price',
  `p_color` varchar(50) DEFAULT NULL,
  `p_size` varchar(50) DEFAULT NULL,
  `is_running` int(1) NOT NULL DEFAULT 1,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `type`, `ref_id`, `quantity`, `price`, `p_color`, `p_size`, `is_running`, `time`) VALUES
(1, 2, 'course', 1, 1, 500, '2', '0', 0, '2025-06-18 08:44:33'),
(3, 2, 'consultant', 1, 1, 0, NULL, NULL, 0, '2025-06-24 04:37:31'),
(5, 2, 'consultant', 2, 1, 90, NULL, NULL, 0, '2025-06-24 20:13:07'),
(6, 2, 'product', 9, 1, 345, NULL, NULL, 0, '2025-07-07 16:34:12'),
(7, 2, 'consultant', 1, 1, 0, NULL, NULL, 0, '2025-07-08 14:02:16'),
(8, 2, 'consultant', 1, 1, 0, NULL, NULL, 0, '2025-07-09 16:30:30'),
(9, 2, 'consultant', 2, 1, 90, NULL, NULL, 0, '2025-07-10 13:18:04'),
(10, 2, 'product', 1, 1, 66, NULL, NULL, 0, '2025-09-15 10:30:58'),
(14, 2, 'consultant', 1, 1, 0, NULL, NULL, 0, '2025-10-05 14:34:25'),
(15, 4, 'consultant', 1, 1, 0, NULL, NULL, 0, '2025-10-05 15:27:26'),
(16, 4, 'product', 1, 1, 66, NULL, NULL, 0, '2025-10-06 08:17:46'),
(17, 4, 'product', 2, 1, 1000, '1', '1', 0, '2025-10-10 09:45:22'),
(18, 4, 'product', 2, 1, 1000, '0', '0', 0, '2025-10-10 14:33:13'),
(19, 4, 'product', 1, 1, 66, '2', '2', 0, '2025-10-10 15:07:12'),
(20, 4, 'product', 1, 1, 66, '1', '1', 0, '2025-10-13 15:32:33'),
(21, 4, 'product', 2, 1, 1000, '1', '0', 0, '2025-10-13 15:32:35'),
(22, 4, 'product', 4, 1, 1000, '0', '0', 0, '2025-10-13 15:32:38'),
(23, 4, 'product', 5, 1, 1000, '0', '0', 0, '2025-10-13 15:32:44'),
(24, 2, 'product', 1, 1, 66, '0', '0', 0, '2025-10-14 16:45:22'),
(25, 2, 'product', 10, 1, 22, '0', '0', 0, '2025-10-14 20:03:43'),
(26, 2, 'product', 10, 1, 22, '0', '0', 0, '2025-10-14 20:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `name`) VALUES
(1, 'Electronics bd'),
(2, 'Fashion & Apparel'),
(3, 'Beauty & Personal Care'),
(4, 'Home & Living'),
(5, 'Groceries & Essentials'),
(6, 'Health & Wellness'),
(7, 'Sports & Outdoors'),
(8, 'Books & Stationery'),
(9, 'Toys & Games'),
(10, 'Automotive'),
(11, 'Jewelry & Watches'),
(14, 'Digital Product');

-- --------------------------------------------------------

--
-- Table structure for table `chat_suggestions`
--

CREATE TABLE `chat_suggestions` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `message_text` varchar(255) NOT NULL,
  `response_text` text DEFAULT NULL,
  `is_initial` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_suggestions`
--

INSERT INTO `chat_suggestions` (`id`, `parent_id`, `message_text`, `response_text`, `is_initial`) VALUES
(1, NULL, 'কোর্স ফি কত?', 'আমাদের বিভিন্ন কোর্সের ফি ভিন্ন। আপনি কোন কোর্সের ফি জানতে চান?', 1),
(2, 1, 'ক্লাস শিডিউল', 'আমাদের ক্লাস শিডিউল কোর্সভেদে ভিন্ন। দয়া করে আপনার কোর্সের নাম জানান।', 0),
(3, 2, 'এডমিশন প্রসেস', 'এডমিশন প্রসেস সম্পর্কে জানতে আমাদের ওয়েবসাইট ভিজিট করুন বা ফেসবুক পেজে মেসেজ দিন।', 0),
(4, 3, 'ওয়েব ডেভেলপমেন্ট', 'ওয়েব ডেভেলপমেন্ট কোর্সের ফি ১৫,০০০ টাকা। ৩ মাস মেয়াদী এই কোর্সে...', 0),
(5, NULL, 'গ্রাফিক ডিজাইন', 'গ্রাফিক ডিজাইন কোর্সের ফি ১২,০০০ টাকা। ২.৫ মাস মেয়াদী...', 1);

-- --------------------------------------------------------

--
-- Table structure for table `circulars`
--

CREATE TABLE `circulars` (
  `id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL DEFAULT 'null',
  `organization` varchar(50) NOT NULL DEFAULT 'null',
  `location` varchar(50) DEFAULT NULL,
  `sort_text` varchar(225) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `img` varchar(225) DEFAULT NULL,
  `img_2` varchar(225) DEFAULT NULL,
  `img_3` varchar(225) DEFAULT NULL,
  `dateline` varchar(50) DEFAULT NULL,
  `g_form_link` varchar(225) DEFAULT NULL,
  `vacancy` int(5) NOT NULL DEFAULT 0,
  `view` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `circulars`
--

INSERT INTO `circulars` (`id`, `title`, `organization`, `location`, `sort_text`, `description`, `img`, `img_2`, `img_3`, `dateline`, `g_form_link`, `vacancy`, `view`, `updated_at`, `created_at`) VALUES
(6, 'sdfs', 'sdfd', 'sdf', 'sdf', 'sdf', 'product_68d0512d00c105.30454647.png', NULL, NULL, '01 January 1970', 'https://docs.google.com/forms/u/0/', 34, NULL, '2025-09-21 19:34:51', '2025-09-21 19:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `confirm_orders`
--

CREATE TABLE `confirm_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `p_color` varchar(50) DEFAULT NULL,
  `p_size` varchar(50) DEFAULT NULL,
  `item_price` int(10) NOT NULL,
  `total_pay` int(10) NOT NULL,
  `quantity` int(2) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `validity` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirm_orders`
--

INSERT INTO `confirm_orders` (`id`, `user_id`, `product_id`, `order_id`, `type`, `p_color`, `p_size`, `item_price`, `total_pay`, `quantity`, `time`, `validity`, `updated_at`) VALUES
(16, 4, 1, 29, 'product', '1', '1', 66, 0, 1, '2025-10-13 15:54:43', '2025-10-13 15:54:43', '2025-10-13 15:54:43'),
(17, 4, 2, 29, 'product', '1', '0', 1000, 0, 1, '2025-10-13 15:54:43', '2025-10-13 15:54:43', '2025-10-13 15:54:43'),
(18, 4, 4, 29, 'product', '0', '0', 1000, 0, 1, '2025-10-13 15:54:43', '2025-10-13 15:54:43', '2025-10-13 15:54:43'),
(19, 4, 5, 29, 'product', '0', '0', 1000, 0, 1, '2025-10-13 15:54:43', '2025-10-13 15:54:43', '2025-10-13 15:54:43'),
(20, 2, 1, 30, 'product', '0', '0', 66, 0, 1, '2025-10-14 19:48:06', '2025-10-14 19:48:06', '2025-10-14 19:48:06'),
(21, 2, 10, 31, 'product', '0', '0', 22, 0, 1, '2025-10-14 20:13:32', '2025-10-14 20:13:32', '2025-10-14 20:13:32'),
(22, 2, 10, 32, 'product', '0', '0', 22, 0, 1, '2025-10-14 20:42:46', '2025-10-14 20:42:46', '2025-10-14 20:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `consultant`
--

CREATE TABLE `consultant` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `img` varchar(50) NOT NULL,
  `validity` int(5) NOT NULL DEFAULT 1 COMMENT 'days'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultant`
--

INSERT INTO `consultant` (`id`, `title`, `price`, `img`, `validity`) VALUES
(1, 'স্টার্টার', 0, 'https://picsum.photos/600?random=10', 1),
(2, 'প্রিমিয়াম আম', 100, 'https://picsum.photos/600?random=11', 30);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `tiktok` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `facebook`, `youtube`, `tiktok`, `instagram`, `location`, `number`, `email`) VALUES
(1, 'https://a.com', 'https://b.v', 'https://cv.v', 'https://d.v', 'e', 'f', 'g@g.g');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount` int(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount`, `time`) VALUES
(1, 'DISCOUNT20', 20, '2025-06-16 11:06:01'),
(3, 'EID25', 25, '2025-07-04 05:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `overview` text DEFAULT NULL,
  `ki_thakbe` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ki_thakbe`)),
  `provider` varchar(225) DEFAULT NULL,
  `badge` varchar(20) DEFAULT NULL,
  `users` int(8) NOT NULL DEFAULT 100,
  `price` float NOT NULL DEFAULT 0,
  `old_price` float NOT NULL DEFAULT 0,
  `feature_video_id` varchar(20) DEFAULT NULL COMMENT 'youtube',
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `instructor` varchar(50) DEFAULT NULL,
  `rating` float DEFAULT 4.8,
  `img` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `title`, `description`, `overview`, `ki_thakbe`, `provider`, `badge`, `users`, `price`, `old_price`, `feature_video_id`, `time`, `instructor`, `rating`, `img`, `status`) VALUES
(1, 'এয়ার ফোর্স কমিশন্ড অফিসার কোর্স', 'প্রতিবছর দেশের সেবায় কাজ করার জন্য বাংলাদেশ বিমানবাহিনী কমিশন্ড অফিসার পদে চাকরি করার স্বপ্ন দেখে অনেকেই। মূলত বিজ্ঞান বিভাগ থেকে যে কেউ এইচএসসি পাসের পর বিমানবাহিনী কমিশন্ড অফিসার পদে আবেদন করতে পারে। কিন্তু বিগত অভিজ্ঞতা থেকে দেখা যায়, সঠিক দিকনির্দেশনা ও প্রস্তুতির অভাবে অনেকই তাদের কাঙ্খিত ফলাফল অর্জন করতে ব্যর্থ হয়। এই সকল সমস্যার সমাধানের জন্য আমরা নিয়ে এসেছি বিমানবাহিনী কমিশন্ড অফিসার কোর্স, যেখানে শিক্ষার্থীরা পাবেন লিখিত, মৌখিক ও প্রিলিমিনারি পরীক্ষায় সঠিকভাবে প্রস্তুতির জন্য প্রয়োজনীয় সকল ধরনের তথ্য ও দিকনির্দেশনা। আমাদের কোর্সের সকল প্রশিক্ষকই অবসরপ্রাপ্ত সামরিক কর্মকর্তাবৃন্দ।', '<h1 class=\"ql-align-center\"><strong>dfgdfg</strong></h1>', '[\"\\u09aa\\u09cd\\u09b0\\u09be\\u09a5\\u09ae\\u09bf\\u0995 \\u09b8\\u09cd\\u09ac\\u09be\\u09b8\\u09cd\\u09a5\\u09cd\\u09af \\u09aa\\u09b0\\u09c0\\u0995\\u09cd\\u09b7\\u09be \\u09b8\\u09ae\\u09cd\\u09aa\\u09b0\\u09cd\\u0995\\u09bf\\u09a4 \\u0997\\u09c1\\u09b0\\u09c1\\u09a4\\u09cd\\u09ac\\u09aa\\u09c2\\u09b0\\u09cd\\u09a3 \\u09a4\\u09a5\\u09cd\\u09af\",\"\\u09b2\\u09bf\\u0996\\u09bf\\u09a4 \\u0993 \\u09ae\\u09cc\\u0996\\u09bf\\u0995 \\u09aa\\u09b0\\u09c0\\u0995\\u09cd\\u09b7\\u09be\\u09b0 \\u09aa\\u09cd\\u09b0\\u09b8\\u09cd\\u09a4\\u09c1\\u09a4\\u09bf\",\"\\u09b8\\u09be\\u099c\\u09be\\u09a8\\u09cb-\\u0997\\u09cb\\u099b\\u09be\\u09a8\\u09cb \\u09b6\\u09b0\\u09cd\\u099f \\u0993 \\u09a1\\u09bf\\u099f\\u09c7\\u0987\\u09b2\\u09b8 \\u09a8\\u09cb\\u099f\\u09b8\",\"\\u0995\\u09ae\\u09bf\\u09b6\\u09a8\\u09cd\\u09a1 \\u0985\\u09ab\\u09bf\\u09b8\\u09be\\u09b0 \\u09b9\\u0993\\u09df\\u09be\\u09b0 \\u099c\\u09a8\\u09cd\\u09af \\u09aa\\u09cd\\u09b0\\u09df\\u09cb\\u099c\\u09a8\\u09c0\\u09df \\u09b8\\u0995\\u09b2 \\u09a7\\u09b0\\u09a8\\u09c7\\u09b0 \\u0997\\u09be\\u0987\\u09a1\\u09b2\\u09be\\u0987\\u09a8 \\u0993 \\u09b8\\u09be\\u09aa\\u09cb\\u09b0\\u09cd\\u099f\"]', 'Bangladesh Air Force', 'new', 100, 500, 1000, 'vrqFJ-yjkRw', '2025-05-16 10:12:41', 'Abdur', 4.8, 'product_68d0512d00c105.30454647.png', 1),
(2, 'up course', 'asdsad', 'dasdsafsdfsdfsdfs', '[\"232\"]', 'ProtiSheba', 'new', 340, 23, 232, 'JUCiOP1WhG0', '2025-09-18 14:30:24', 'Abdur', 3, 'product_68d0512d00c105.30454647.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_module`
--

CREATE TABLE `course_module` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_module`
--

INSERT INTO `course_module` (`id`, `title`, `course_id`) VALUES
(1, 'ফ্রী ক্লাস দেখে যাচাই করুন OK', 1),
(2, 'স্বাস্থ্য পরীক্ষা', 1),
(4, 'ok', 1);

-- --------------------------------------------------------

--
-- Table structure for table `del_user`
--

CREATE TABLE `del_user` (
  `id` int(1) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `wish` varchar(225) NOT NULL,
  `bio` text NOT NULL,
  `address` varchar(225) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=> Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `del_user`
--

INSERT INTO `del_user` (`id`, `student_id`, `name`, `number`, `email`, `password`, `wish`, `bio`, `address`, `status`) VALUES
(1, 0, 'robiul', '01709409269', 'a@a.a', '$2y$10$vk83ZdZHDOX77Np1xHakA.m3ThE.2bcYzm/KCNGj1AN4iANiYcmR2', 'aa', 'aa', 'aaa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_apply`
--

CREATE TABLE `job_apply` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_initial` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `google_form` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_apply`
--

INSERT INTO `job_apply` (`id`, `parent_id`, `is_initial`, `name`, `icon`, `details`, `google_form`) VALUES
(1, NULL, 1, 'সেনাবাহিনী', 'army.png', NULL, NULL),
(2, NULL, 1, 'বিমানবাহিনী', 'air.jfif', NULL, NULL),
(3, NULL, 1, 'নৌবাহিনী', 'navy.jpeg', NULL, NULL),
(4, NULL, 1, 'পুলিশ', 'police.jfif', NULL, NULL),
(5, NULL, 1, 'আনসার', 'ansar.jpg', NULL, NULL),
(6, NULL, 1, 'বিজিবি', 'bgb.webp', NULL, NULL),
(7, NULL, 1, 'অন্যান্য', 'others.jpg', NULL, NULL),
(8, 1, NULL, 'সৈনিক', NULL, '<p><strong style=\"background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);\"><em><s><u>Sainik Job Circular 2025</u></s></em><span class=\"ql-cursor\">﻿</span></strong></p><p>\r\n        </p><p>\r\n          Sainik Job Circular 2025 has been published by Bangladesh Army on 21 February 2025 on the daily Ittefaq newspaper for govt job candidates. The Army Sainik online application will be start from 28 February 2025 and the deadline is 30 March 2025. Interested qualified candidates can submit their Sainik Job application form on the Sainik teletalk com bd website \r\n          <a href=\"http://sainik.teletalk.com.bd\" target=\"_blank\">http://sainik.teletalk.com.bd</a> and \r\n          <a href=\"http://modc.teletalk.com.bd\" target=\"_blank\">modc.teletalk.com.bd</a>.\r\n        </p><p>\r\n    \r\n        </p><h1><strong style=\"background-color: rgb(0, 97, 0); color: rgb(255, 255, 255);\">Army Sainik Job Circular 2025</strong></h1><p>\r\n        </p><p>\r\n          Bangladesh Army has invited applications through online for the recruitment of soldiers in the scheduled cantonment of 2025. Bangladesh Army Sainik job circular 2025 is a great career opportunity for those who are looking for Defense job circular 2025. Men and women of all districts can apply for \r\n          <a href=\"http://sainik.teletalk.com.bd\" target=\"_blank\">sainik.teletalk.com.bd</a> job circular 2025. The age of the candidates interested for admission to the soldier post should be between 17 to 20 years on 9th February 2025.\r\n        </p>', 'https://defence24bd.com');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender` int(1) NOT NULL COMMENT '0=>admin, 1=>user',
  `message` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `sender`, `message`, `timestamp`) VALUES
(1, 2, 1, 'hi', '2025-07-10 17:59:20'),
(2, 2, 0, 'ki kro', '2025-07-10 17:59:41'),
(3, 2, 1, 'kichu na', '2025-07-10 17:59:53'),
(4, 2, 1, 'hi', '2025-10-05 20:34:58'),
(5, 2, 1, 'rrrrrrrr', '2025-10-05 20:35:16'),
(8, 4, 1, 'hi', '2025-10-05 21:27:43'),
(9, 4, 1, 'hhhhhh', '2025-10-05 21:27:47'),
(11, 4, 0, 'Hi', '2025-10-05 21:44:40'),
(12, 2, 0, 'hi', '2025-10-05 21:45:04'),
(13, 4, 0, 'hi 1111111', '2025-10-05 21:45:23'),
(14, 2, 0, 'hi222222222', '2025-10-05 21:45:36'),
(15, 4, 1, '11111111', '2025-10-05 21:53:18'),
(16, 4, 0, 'ok', '2025-10-05 21:53:36'),
(17, 4, 1, 'gggg', '2025-10-05 21:53:44'),
(18, 4, 1, 'jjjjjjj', '2025-10-05 21:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `module_details`
--

CREATE TABLE `module_details` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `time` varchar(10) NOT NULL,
  `is_free` int(1) NOT NULL DEFAULT 0 COMMENT '0=> paid',
  `video` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_details`
--

INSERT INTO `module_details` (`id`, `module_id`, `title`, `time`, `is_free`, `video`) VALUES
(2, 2, 'স্বাস্থ্য পরীক্ষার প্রস্তুতি', '20:30', 0, 'mashup.mp4'),
(6, 4, 'dfgdf', '10:40', 1, 'vid_686ac672c1c96.mp4'),
(7, 4, 'xzv', 'sdf', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `offer_banner`
--

CREATE TABLE `offer_banner` (
  `id` int(1) NOT NULL,
  `img` varchar(225) NOT NULL,
  `link` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offer_banner`
--

INSERT INTO `offer_banner` (`id`, `img`, `link`) VALUES
(1, 'offer_68c940d0658c80.21444078.gif', 'https://www.youtube.com/watch?v=yF5K3-ZaT_o');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `co_status` varchar(20) NOT NULL DEFAULT 'Order Confirm' COMMENT 'Confirm Order',
  `transaction_id` varchar(255) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `coupon` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `amount`, `address`, `status`, `co_status`, `transaction_id`, `currency`, `coupon`, `updated_at`, `created_at`) VALUES
(1, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 490, 'dfgdfibigdfibgidf', 'delivered', 'cancelled', 'ORDER_68527ca054980', 'BDT', 'DISCOUNT10', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(2, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 2600, 'h', 'Pending', 'Order Confirm', 'ORDER_685410b593646', 'BDT', 'fdgh', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(3, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 2600, 'd', 'Pending', 'Order Confirm', 'ORDER_6854111987777', 'BDT', '', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(4, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 2600, 'd', 'Pending', 'Order Confirm', 'ORDER_685411544738b', 'BDT', 'f', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(5, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 2100, 'f', 'ready', 'Order Confirm', 'ORDER_6854e3f411cb7', 'BDT', '', '2025-07-07 18:06:31', '2025-07-07 15:12:32'),
(6, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 2100, 'f', 'Pending', 'Order Confirm', 'ORDER_6854e428d0a98', 'BDT', '', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(7, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 2100, 'f', 'Canceled', 'Order Confirm', 'ORDER_6854f4c781a51', 'BDT', '', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(8, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 2100, 'সস', 'Pending', 'Order Confirm', 'ORDER_6854f51984fd6', 'BDT', '', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(9, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 2060, 'সস', 'Pending', 'Order Confirm', 'ORDER_6854f5257eef3', 'BDT', '', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(10, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 2060, 'সস', 'Canceled', 'Order Confirm', 'ORDER_6854f778820f1', 'BDT', '', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(11, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 2100, 'ff', 'Failed', 'Order Confirm', 'ORDER_6854f83e492dc', 'BDT', '', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(12, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', -10, '', 'Pending', 'Order Confirm', 'ORDER_685aa7cfe6848', 'BDT', 'A10', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(13, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 0, '', 'Pending', 'Order Confirm', 'ORDER_685aa82700320', 'BDT', '', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(14, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 0, '', 'Pending', 'Order Confirm', 'ORDER_685aa91845721', 'BDT', '', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(15, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 0, '', 'Pending', 'Order Confirm', 'ORDER_685aa9c7aed06', 'BDT', '', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(16, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 99, '', 'Pending', 'Order Confirm', 'ORDER_685b06d609627', 'BDT', '', '2025-07-07 15:34:22', '2025-07-07 15:12:32'),
(17, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 445, 'sdfgdgdsgseg', 'Pending', 'Order Confirm', 'ORDER_686bf70db912b', 'BDT', '', '2025-07-07 16:34:21', '2025-07-07 16:34:21'),
(18, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 0, '', 'Pending', 'Order Confirm', 'ORDER_686d24eb46257', 'BDT', '', '2025-07-08 14:02:19', '2025-07-08 14:02:19'),
(19, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 0, '', 'Pending', 'Order Confirm', 'ORDER_686e992860845', 'BDT', '', '2025-07-09 16:30:32', '2025-07-09 16:30:32'),
(20, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 100, '', 'Pending', 'Order Confirm', 'ORDER_686fbd8e74757', 'BDT', '', '2025-07-10 13:18:06', '2025-07-10 13:18:06'),
(21, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 166, 'sds', 'Pending', 'Order Confirm', 'ORDER_68c7eaf24632c', 'BDT', '', '2025-09-15 10:31:14', '2025-09-15 10:31:14'),
(22, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 166, 'free delivary', 'Success', 'cancelled', 'ORDER_68c7f7af93559', 'BDT', '', '2025-09-15 11:25:35', '2025-09-15 11:25:35'),
(23, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 0, '', 'Success', 'cancelled', 'ORDER_68e281f4608a8', 'BDT', '', '2025-10-05 14:34:28', '2025-10-05 14:34:28'),
(24, 4, 'Md Abdur Rahman', 'abdur09226@gmail.com', '01709409255', 0, '', 'Success', 'Order Confirm', 'ORDER_68e28e600c097', 'BDT', '', '2025-10-05 15:27:28', '2025-10-05 15:27:28'),
(25, 4, 'Md Abdur Rahman', 'abdur09226@gmail.com', '01709409255', 166, 'dfgf', 'Success', 'Order Confirm', 'ORDER_68e37b33162a7', 'BDT', '', '2025-10-06 08:17:55', '2025-10-06 08:17:55'),
(26, 4, 'Md Abdur Rahman', 'abdur09226@gmail.com', '01709409255', 1100, 'fgf', 'Success', 'Order Confirm', 'ORDER_68e919035d626', 'BDT', '', '2025-10-10 14:32:35', '2025-10-10 14:32:35'),
(27, 4, 'Md Abdur Rahman', 'abdur09226@gmail.com', '01709409255', 1100, 'dfg', 'Success', 'Order Confirm', 'ORDER_68e91936c04c2', 'BDT', '', '2025-10-10 14:33:26', '2025-10-10 14:33:26'),
(28, 4, 'Md Abdur Rahman', 'abdur09226@gmail.com', '01709409255', 166, 's', 'Success', 'Order Confirm', 'ORDER_68e9212b8b7ec', 'BDT', '', '2025-10-10 15:07:23', '2025-10-10 15:07:23'),
(29, 4, 'Md Abdur Rahman', 'abdur09226@gmail.com', '01709409255', 3166, 'rrfg , Brahmanbaria', 'Success', 'delivery', 'ORDER_68ed20c38de8e', 'BDT', '', '2025-10-13 15:54:43', '2025-10-13 15:54:43'),
(30, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 126, 'দফদ , Dhaka', 'Success', 'cancelled', 'ORDER_68eea8f5c8595', 'BDT', '', '2025-10-14 19:48:05', '2025-10-14 19:48:05'),
(31, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 82, 'delivery , Dhaka', 'Success', 'cancelled', 'ORDER_68eeaeec2bc15', 'BDT', '', '2025-10-14 20:13:32', '2025-10-14 20:13:32'),
(32, 2, 'Md Abdur Rahman', 'abdur09266@gmail.com', '01709409266', 22, 'sdf , Dhaka', 'Success', 'cancelled', 'ORDER_68eeb5c69782a', 'BDT', '', '2025-10-14 20:42:46', '2025-10-14 20:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `impression` int(11) NOT NULL DEFAULT 0,
  `view` int(11) NOT NULL DEFAULT 0,
  `img` varchar(225) DEFAULT NULL,
  `img_2` varchar(225) DEFAULT NULL,
  `img_3` varchar(225) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `sort_text` varchar(225) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `tags` varchar(225) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `impression`, `view`, `img`, `img_2`, `img_3`, `title`, `category`, `sort_text`, `text`, `tags`, `time`, `updated_at`, `date`) VALUES
(1, 0, 0, 'post_68e4179d2c2766.65744740.jpg', NULL, NULL, 'বাংলাদেশ সেনাবাহিনী সম্পর্কে কিছু জানা অজানা তথ্য', 'সেনা বাহিনী', 'বছরে যোগ্যতা সাপেক্ষে কোন ব্যাচে যেমন ১৮০ জনকে নির্বাচিত করা হয়েছে তেমনি যোগ্য কাউকে না পাওয়ায় মাত্র ৪০ জনকে নির্বাচিত করার ইতিহাসও আছে । এখানে সংখ্যা পুরো করতে গিয়ে কখনও মানের সাথে সমঝো', '<p>\r\n    ১। সেনাবাহিনীতে কত ধরনের বিভাগ (কোর) রয়েছে ?<br />\r\n<img src=\"img/circular.png\">\r\n    <br />\r\n    বছরে দুইবার এই ভর্তি প্রক্রিয়া সম্পন্ন হয় । নির্দিষ্ট কোন কোটা নেই এখানে যে কত জন ভর্তি করা হবে । যোগ্যতা সাপেক্ষে কোন ব্যাচে যেমন ১৮০ জনকে নির্বাচিত করা হয়েছে তেমনি যোগ্য কাউকে না পাওয়ায় মাত্র ৪০ জনকে নির্বাচিত করার ইতিহাসও আছে । এখানে\r\n    সংখ্যা পুরো করতে গিয়ে কখনও মানের সাথে সমঝোতা করা হয় না । এবং এইখানকার নির্বাচকরা সম্পূর্ণ প্রভাবমুক্ত থেকে কাজ করতে পারেন বলেই জানি । অনেক জেনারেলের ছেলে পরীক্ষায় অকৃতকার্য হয়েছে এরকম ঘটনা আছে ভুরি ভুরি । বাবার পরিচয়, রাজনৈতিক প্রভাব,\r\n    মামা চাচার টেলিফোন সব কিছুকে উপেক্ষা করে যাচ্ছে বলেই এই সিলেকশন পদ্ধতি নিয়ে কোন বিতর্ক সৃষ্টি হয়েছে বলে কখনও শুনিনি । ১১। নিরবাচনের ক্ষেত্রে মেধার পাশাপাশি আর কোন কোন বিষয়ের উপর গুরুত্ব দেয়া হয় ?<br />\r\n    <br />\r\n    শুধু তাই না একজন অফিসারকে এছাড়া প্রতি বছর দুইবার সব অফিসারকেই শারীরিক যোগ্যতার পরীক্ষা দিতে হয় । এই পরীক্ষার অনেকগুলো আইটেমের মধ্যে শুধু দুইটি আইটেমের কথা বলি । নির্দিষ্ট সময়ের মধ্যে ৩ কিলোমিটার ও ১৬ কিলোমিটার দৌড় ।বুঝতেই পারছেন ফিটনেস\r\n    না থাকলে আপনার আমার পক্ষে এইগুলো করা সম্ভব না । এছাড়াও প্রতি বছর এদের ওজন নেয়া হয় ।<br />\r\n    <br />\r\n    <br />\r\n    <br />\r\n    শারীরিক যোগ্যতা আর ওজন নিয়ন্ত্রনে না রাখতে পারলে পদোন্নতি চিরতরে বন্ধ সহ বিভিন্ন শাস্তিমুলক ব্যাবস্থা নেয়া হয় । কাজেই নিজেদের প্রয়োজনেই সাধারণত কোন অফিসারই ফিটনেসের সাথে কম্প্রোমাইজ করে না।<br />\r\n    <br />\r\n    ১। বাংলাদেশ আর্মির ওয়েবসাইট\r\n</p>', 'bangla, blog, বাংলা ব্লগ,bangladesh, dhaka, bangla , group blog, bengali, news,  বাংলা,  বাংলাদেশ, ঢাকা, খবর, দেশ, নারী, কবিতা, গল্প, জীবন, মুক্তিযুদ্ধ', '2025-05-26 15:00:21', '2025-10-06 19:25:17', '26 May 2025'),
(2, 0, 0, 'product_68d0512d00c105.30454647.png', 'post_68cede561f08b3.78442622.png', NULL, 'বাংলাদেশ সেনাবাহিনী সম্পর্কে কিছু জানা অজানা তথ্য', 'সেনা বাহিনী', 'বছরে যোগ্যতা সাপেক্ষে কোন ব্যাচে যেমন ১৮০ জনকে নির্বাচিত করা হয়েছে তেমনি যোগ্য কাউকে না পাওয়ায় মাত্র ৪০ জনকে নির্বাচিত করার ইতিহাসও আছে । এখানে সংখ্যা পুরো করতে গিয়ে কখনও মানের সাথে সমঝো', '<p>\r\n    ১। সেনাবাহিনীতে কত ধরনের বিভাগ (কোর) রয়েছে ?<br />\r\n<img src=\"img/circular.png\">\r\n    <br />\r\n    বছরে দুইবার এই ভর্তি প্রক্রিয়া সম্পন্ন হয় । নির্দিষ্ট কোন কোটা নেই এখানে যে কত জন ভর্তি করা হবে । যোগ্যতা সাপেক্ষে কোন ব্যাচে যেমন ১৮০ জনকে নির্বাচিত করা হয়েছে তেমনি যোগ্য কাউকে না পাওয়ায় মাত্র ৪০ জনকে নির্বাচিত করার ইতিহাসও আছে । এখানে\r\n    সংখ্যা পুরো করতে গিয়ে কখনও মানের সাথে সমঝোতা করা হয় না । এবং এইখানকার নির্বাচকরা সম্পূর্ণ প্রভাবমুক্ত থেকে কাজ করতে পারেন বলেই জানি । অনেক জেনারেলের ছেলে পরীক্ষায় অকৃতকার্য হয়েছে এরকম ঘটনা আছে ভুরি ভুরি । বাবার পরিচয়, রাজনৈতিক প্রভাব,\r\n    মামা চাচার টেলিফোন সব কিছুকে উপেক্ষা করে যাচ্ছে বলেই এই সিলেকশন পদ্ধতি নিয়ে কোন বিতর্ক সৃষ্টি হয়েছে বলে কখনও শুনিনি । ১১। নিরবাচনের ক্ষেত্রে মেধার পাশাপাশি আর কোন কোন বিষয়ের উপর গুরুত্ব দেয়া হয় ?<br />\r\n    <br />\r\n    শুধু তাই না একজন অফিসারকে এছাড়া প্রতি বছর দুইবার সব অফিসারকেই শারীরিক যোগ্যতার পরীক্ষা দিতে হয় । এই পরীক্ষার অনেকগুলো আইটেমের মধ্যে শুধু দুইটি আইটেমের কথা বলি । নির্দিষ্ট সময়ের মধ্যে ৩ কিলোমিটার ও ১৬ কিলোমিটার দৌড় ।বুঝতেই পারছেন ফিটনেস\r\n    না থাকলে আপনার আমার পক্ষে এইগুলো করা সম্ভব না । এছাড়াও প্রতি বছর এদের ওজন নেয়া হয় ।<br />\r\n    <br />\r\n    <br />\r\n    <br />\r\n    শারীরিক যোগ্যতা আর ওজন নিয়ন্ত্রনে না রাখতে পারলে পদোন্নতি চিরতরে বন্ধ সহ বিভিন্ন শাস্তিমুলক ব্যাবস্থা নেয়া হয় । কাজেই নিজেদের প্রয়োজনেই সাধারণত কোন অফিসারই ফিটনেসের সাথে কম্প্রোমাইজ করে না।<br />\r\n    <br />\r\n    ১। বাংলাদেশ আর্মির ওয়েবসাইট\r\n</p>', 'bangla, blog, বাংলা ব্লগ,bangladesh, dhaka, bangla blog, group blog, bengali, news,  বাংলা,  বাংলাদেশ, ঢাকা, খবর, দেশ, নারী, কবিতা, গল্প, জীবন, মুক্তিযুদ্ধ', '2025-05-26 15:00:21', '2025-09-20 17:03:18', '27 May 2025'),
(3, 0, 0, 'product_68d0512d00c105.30454647.png', NULL, NULL, 'বাংলাদেশ সেনাবাহিনী সম্পর্কে কিছু জানা অজানা তথ্য', 'সেনা বাহিনী', 'বছরে যোগ্যতা সাপেক্ষে কোন ব্যাচে যেমন ১৮০ জনকে নির্বাচিত করা হয়েছে তেমনি যোগ্য কাউকে না পাওয়ায় মাত্র ৪০ জনকে নির্বাচিত করার ইতিহাসও আছে । এখানে সংখ্যা পুরো করতে গিয়ে কখনও মানের সাথে সমঝো', '<p>\r\n    ১। <strong style=\"background-color: rgb(0, 97, 0);\">সেনাবাহিনীতে </strong>কত ধরনের বিভাগ (কোর) রয়েছে ?\r\n    \r\n    বছরে দুইবার এই ভর্তি প্রক্রিয়া সম্পন্ন হয় । নির্দিষ্ট কোন কোটা নেই এখানে যে কত জন ভর্তি করা হবে । যোগ্যতা সাপেক্ষে কোন ব্যাচে যেমন ১৮০ জনকে নির্বাচিত করা হয়েছে তেমনি যোগ্য কাউকে না পাওয়ায় মাত্র ৪০ জনকে নির্বাচিত করার ইতিহাসও আছে । এখানে\r\n    সংখ্যা পুরো করতে গিয়ে কখনও মানের সাথে সমঝোতা করা হয় না । এবং এইখানকার নির্বাচকরা সম্পূর্ণ প্রভাবমুক্ত থেকে কাজ করতে পারেন বলেই জানি । অনেক জেনারেলের ছেলে পরীক্ষায় অকৃতকার্য হয়েছে এরকম ঘটনা আছে ভুরি ভুরি । বাবার পরিচয়, রাজনৈতিক প্রভাব,\r\n    মামা চাচার টেলিফোন সব কিছুকে উপেক্ষা করে যাচ্ছে বলেই এই সিলেকশন পদ্ধতি নিয়ে কোন বিতর্ক সৃষ্টি হয়েছে বলে কখনও শুনিনি । ১১। নিরবাচনের ক্ষেত্রে মেধার পাশাপাশি আর কোন কোন বিষয়ের উপর গুরুত্ব দেয়া হয় ?\r\n    \r\n    শুধু তাই না একজন অফিসারকে এছাড়া প্রতি বছর দুইবার সব অফিসারকেই শারীরিক যোগ্যতার পরীক্ষা দিতে হয় । এই পরীক্ষার অনেকগুলো আইটেমের মধ্যে শুধু দুইটি আইটেমের কথা বলি । নির্দিষ্ট সময়ের মধ্যে ৩ কিলোমিটার ও ১৬ কিলোমিটার দৌড় ।বুঝতেই পারছেন ফিটনেস\r\n    না থাকলে আপনার আমার পক্ষে এইগুলো করা সম্ভব না । এছাড়াও প্রতি বছর এদের ওজন নেয়া হয় ।\r\n    \r\n    \r\n    \r\n    শারীরিক যোগ্যতা আর ওজন নিয়ন্ত্রনে না রাখতে পারলে পদোন্নতি চিরতরে বন্ধ সহ বিভিন্ন শাস্তিমুলক ব্যাবস্থা নেয়া হয় । কাজেই নিজেদের প্রয়োজনেই সাধারণত কোন অফিসারই ফিটনেসের সাথে কম্প্রোমাইজ করে না।\r\n    \r\n    ১। বাংলাদেশ আর্মির ওয়েবসাইট\r\n</p>', 'bangla, blog, বাংলা ব্লগ,bangladesh, dhaka, bangla blog, group blog, bengali, news,  বাংলা,  বাংলাদেশ, ঢাকা, খবর, দেশ, নারী, কবিতা, গল্প, জীবন, মুক্তিযুদ্ধ', '2025-05-26 15:00:21', '2025-07-04 06:03:40', '04 July 2025'),
(6, 0, 0, 'product_68d0512d00c105.30454647.png', 'product_68cece55b62371.76272320.png', 'product_68cece55ca4350.53474737.png', 'Tiny', 'sfd', 'বছরে যোগ্যতা সাপেক্ষে কোন ব্যাচে যেমন ১৮০ জনকে নির্বাচিত করা হয়েছে তেমনি যোগ্য কাউকে না পাওয়ায় মাত্র ৪০ জনকে নির্বাচিত করার ইতিহাসও আছে । এখানে সংখ্যা পুরো করতে গিয়ে কখনও মানের সাথে সমঝো', '<p>dfgdf</p>\r\n<p> </p>', 'abdur,dgh', '2025-09-20 21:55:01', '2025-10-09 16:21:04', '01 January 1970');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `colors` varchar(200) DEFAULT NULL,
  `sizes` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `old_price` float NOT NULL,
  `d_discount` int(3) NOT NULL DEFAULT 0 COMMENT 'delivery discount',
  `status` varchar(20) NOT NULL,
  `rating_count` int(5) NOT NULL DEFAULT 0,
  `img` varchar(225) NOT NULL,
  `img_2` varchar(225) NOT NULL,
  `img_3` varchar(225) NOT NULL,
  `review` varchar(225) NOT NULL,
  `is_feature` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `type`, `price`, `colors`, `sizes`, `description`, `old_price`, `d_discount`, `status`, `rating_count`, `img`, `img_2`, `img_3`, `review`, `is_feature`) VALUES
(1, '(Bangla Watch) বাংলা ঘড়ি SIZE', '2', 66, 'red, green, yello, white', 'L, m, N, o', '<p><strong style=\"background-color: #e60000;\">xggnbfnf</strong></p>', 77, 0, 'Show', 88, 'product_68d0512d00c105.30454647.png', 'product_68cc367965b5e4.93084766.png', 'product_68cc366d00ee51.15817246.jpg', 'sdfgdg', 1),
(2, '(Bangladesh Police Watch) বাংলাদেশ পুলিশের ঘড়ি', '2', 1000, 'green, red', 'M, L', '<p>ঘড়ির বিভিন্ন সুবিধা রয়েছে, যা আমাদের দৈনন্দিন জীবনে গুরুত্বপূর্ণ ভূমিকা পালন করে। নিচে কিছু প্রধান সুবিধার উল্লেখ করা হলো: 1. **সময় জানার সুবিধা**: ঘড়ি সময় সঠিকভাবে জানায়, যা পরিকল্পনা ও সময়সীমা মেনে চলতে সাহায্য করে। 2. **সুবিধাজনক ব্যবহার**: ডিজিটাল ঘড়ি ও স্মার্টওয়াচ সহজেই ব্যবহার করা যায়, যেগুলো সময়, তারিখ এবং অন্যান্য তথ্য প্রদর্শন করে। 3. **ফিটনেস ট্র্যাকিং**: </p>', 2599, 0, 'Sale', 54, 'product_68d0512d00c105.30454647.png', '', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', 1),
(3, '(Bangladesh Police Watch) বাংলাদেশ পুলিশের ঘড়ি', '3', 1000, NULL, NULL, '<p>ঘড়ির বিভিন্ন সুবিধা রয়েছে, যা আমাদের দৈনন্দিন জীবনে গুরুত্বপূর্ণ ভূমিকা পালন করে। নিচে কিছু প্রধান সুবিধার উল্লেখ করা হলো: 1. **সময় জানার সুবিধা**: ঘড়ি সময় সঠিকভাবে জানায়, যা পরিকল্পনা ও সময়সীমা মেনে চলতে সাহায্য করে। 2. **সুবিধাজনক ব্যবহার**: ডিজিটাল ঘড়ি ও স্মার্টওয়াচ সহজেই ব্যবহার করা যায়, যেগুলো সময়, তারিখ এবং অন্যান্য তথ্য প্রদর্শন করে। 3. **ফিটনেস ট্র্যাকিং**: </p>', 2599, 0, 'Sale', 54, 'product_68d0512d00c105.30454647.png', '', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', 0),
(4, '(Bangladesh Police Watch) বাংলাদেশ পুলিশের ঘড়ি', '4', 1000, NULL, NULL, '<p>ঘড়ির বিভিন্ন সুবিধা রয়েছে, যা আমাদের দৈনন্দিন জীবনে গুরুত্বপূর্ণ ভূমিকা পালন করে। নিচে কিছু প্রধান সুবিধার উল্লেখ করা হলো: 1. **সময় জানার সুবিধা**: ঘড়ি সময় সঠিকভাবে জানায়, যা পরিকল্পনা ও সময়সীমা মেনে চলতে সাহায্য করে। 2. **সুবিধাজনক ব্যবহার**: ডিজিটাল ঘড়ি ও স্মার্টওয়াচ সহজেই ব্যবহার করা যায়, যেগুলো সময়, তারিখ এবং অন্যান্য তথ্য প্রদর্শন করে। 3. **ফিটনেস ট্র্যাকিং**: </p>', 2599, 0, 'Sale', 54, 'product_68d0512d00c105.30454647.png', '', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', 1),
(5, '(Bangladesh Police Watch) বাংলাদেশ পুলিশের ঘড়ি', '5', 1000, NULL, NULL, 'ঘড়ির বিভিন্ন সুবিধা রয়েছে, যা আমাদের দৈনন্দিন জীবনে গুরুত্বপূর্ণ ভূমিকা পালন করে। নিচে কিছু প্রধান সুবিধার উল্লেখ করা হলো: 1. **সময় জানার সুবিধা**: ঘড়ি সময় সঠিকভাবে জানায়, যা পরিকল্পনা ও সময়সীমা মেনে চলতে সাহায্য করে। 2. **সুবিধাজনক ব্যবহার**: ডিজিটাল ঘড়ি ও স্মার্টওয়াচ সহজেই ব্যবহার করা যায়, যেগুলো সময়, তারিখ এবং অন্যান্য তথ্য প্রদর্শন করে। 3. **ফিটনেস ট্র্যাকিং**: ', 2599, 0, 'Sale', 54, 'product_68d0512d00c105.30454647.png', '', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', 1),
(9, 'Abdur Rahman', '6', 345, NULL, NULL, '<p><strong style=\"background-color: rgb(161, 0, 0); color: rgb(255, 255, 255);\">rtth</strong></p>', 345346, 0, 'Showrt', 345, 'product_68d0512d00c105.30454647.png', '', '', 'dfgvdfg', 0),
(10, 'Md Abdur Rahman', '1', 22, 'red, green, yello, white', 'L, m, N, o', '<p>iohi</p>', 51, 80, '80 Taka Discount', 22, 'product_68eeac64c7f123.38415937.jpg', 'product_68eeac64cc5428.64574915.jpg', 'product_68eeac64cf6fe1.48279916.jpg', 'sdfgdg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(225) NOT NULL,
  `answer` int(1) NOT NULL,
  `explanation` text DEFAULT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`options`)),
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer`, `explanation`, `options`, `cat_id`) VALUES
(2, 'বাংলাদেশের জাতীয় ফুল কি?', 1, 'শাপলা বাংলাদেশের জাতীয় ফুল, যা জলজ পরিবেশে জন্মায়।', '[\"গোলাপ\",\"শাপলা\",\"গাঁদা\",\"বেলি\"]', 1),
(3, 'বাংলাদেশের দীর্ঘতম নদী কোনটি?', 2, NULL, '[\"যমুনা\",\"পদ্মা\",\"মেঘনা\",\"ব্রহ্মপুত্র\"]', 1),
(4, 'বাংলাদেশের জাতীয় পাখি কোনটি?', 1, 'দোয়েল বাংলাদেশের জাতীয় পাখি, যা ছোট ও সুরেলা কণ্ঠের জন্য পরিচিত।', '[\"ময়না\",\"দোয়েল\",\"কাক\",\"ময়ূর\"]', 1),
(5, 'বাংলাদেশের প্রথম প্রধানমন্ত্রী কে ছিলেন?', 1, '', '[\"\\u09b6\\u09c7\\u0996 \\u09ae\\u09c1\\u099c\\u09bf\\u09ac\\u09c1\\u09b0 \\u09b0\\u09b9\\u09ae\\u09be\\u09a8\",\"\\u09a4\\u09be\\u099c\\u0989\\u09a6\\u09cd\\u09a6\\u09c0\\u09a8 \\u0986\\u09b9\\u09ae\\u09c7\\u09a6\",\"\\u099c\\u09bf\\u09af\\u09bc\\u09be\\u0989\\u09b0 \\u09b0\\u09b9\\u09ae\\u09be\\u09a8\",\"\\u09b9\\u09c1\\u09b8\\u09c7\\u0987\\u09a8 \\u09ae\\u09c1\\u09b9\\u09be\\u09ae\\u09cd\\u09ae\\u09a6 \\u098f\\u09b0\\u09b6\\u09be\\u09a6\"]', 1),
(6, 'rtyhdfgb', 2, 'dfbfgb', '[\"cvb n\",\"cb v\",\"dfgbfvb\",\"vbv\"]', 0);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `img` varchar(225) NOT NULL,
  `link` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `img`, `link`) VALUES
(1, 'product_68d0512d00c105.30454647.png', 'http://facebook.com'),
(3, 'product_68d0512d00c105.30454647.png', 'http://google.com'),
(4, 'product_68d0512d00c105.30454647.png', 'http://localhost/phpmyadmin/index.php'),
(5, 'product_68d0512d00c105.30454647.png', 'https://github.com/abdur-developer');

-- --------------------------------------------------------

--
-- Table structure for table `system_structure`
--

CREATE TABLE `system_structure` (
  `id` int(1) NOT NULL,
  `center` varchar(20) NOT NULL COMMENT 'main district for delivery',
  `outside` int(6) NOT NULL COMMENT 'shipping charge ',
  `inside` int(6) NOT NULL COMMENT 'shipping charge'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_structure`
--

INSERT INTO `system_structure` (`id`, `center`, `outside`, `inside`) VALUES
(1, 'Dhaka', 120, 60);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` text NOT NULL,
  `message` text NOT NULL,
  `sector` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `img`, `message`, `sector`) VALUES
(1, 'মোহাম্মদ রাকিব', 'https://randomuser.me/api/portraits/men/32.jpg', 'আপনাদের কোর্সের মাধ্যমে আমি বাংলাদেশ সেনাবাহিনীতে সৈনিক পদে চাকরি পেয়েছি। তাদের স্টাডি ম্যাটেরিয়াল এবং মডেল টেস্ট আমার প্রস্তুতিতে অনেক সাহায্য করেছে।', 'বাংলাদেশ সেনাবাহিনী'),
(2, 'নাহিদ হাসান', 'https://randomuser.me/api/portraits/men/25.jpg', 'আপনাদের কোর্সের মাধ্যমে আমি বাংলাদেশ সেনাবাহিনীতে সৈনিক পদে চাকরি পেয়েছি। তাদের স্টাডি ম্যাটেরিয়াল এবং মডেল টেস্ট আমার প্রস্তুতিতে অনেক সাহায্য করেছে।', 'বাংলাদেশ নৌবাহিনী'),
(4, 'Abdur Rahman', 'users_6869ea423bb653.17260413.png', 'dfgf', 'dfgvbfd');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `wish` varchar(225) NOT NULL,
  `bio` text NOT NULL,
  `address` varchar(225) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1=> Active',
  `feedback` varchar(225) DEFAULT NULL,
  `show_feedback` int(1) NOT NULL DEFAULT 0,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `student_id`, `name`, `number`, `email`, `password`, `wish`, `bio`, `address`, `status`, `feedback`, `show_feedback`, `time`) VALUES
(2, 421158, 'Md Abdur Rahman', '01709409266', 'abdur09266@gmail.com', '$2y$10$B.3VK5jsIlBLS/sw6pq99.L1R2h5z5Kl7B0h8owN782LTkBYLHKO.', 'Army,Air,Police,Ansar,Others', 'mm', 'Dandapal, Debigong, Panchagarh', 1, 'Canceled order by user.', 0, '2025-12-05 18:14:03'),
(4, NULL, 'Md Abdur Rahman', '01709409255', 'abdur09226@gmail.com', '$2y$10$gUEzf9/klVU5n0E0ZSD8jOhC7Kl4SNgKoAZHQUO6p92LYisloL.Qe', 'Army', '', '', 1, '', 0, '2025-12-05 18:14:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_suggestions`
--
ALTER TABLE `chat_suggestions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `circulars`
--
ALTER TABLE `circulars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confirm_orders`
--
ALTER TABLE `confirm_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `consultant`
--
ALTER TABLE `consultant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_module`
--
ALTER TABLE `course_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `del_user`
--
ALTER TABLE `del_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `job_apply`
--
ALTER TABLE `job_apply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `module_details`
--
ALTER TABLE `module_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `offer_banner`
--
ALTER TABLE `offer_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_structure`
--
ALTER TABLE `system_structure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `chat_suggestions`
--
ALTER TABLE `chat_suggestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `circulars`
--
ALTER TABLE `circulars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `confirm_orders`
--
ALTER TABLE `confirm_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `consultant`
--
ALTER TABLE `consultant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_module`
--
ALTER TABLE `course_module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `del_user`
--
ALTER TABLE `del_user`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_apply`
--
ALTER TABLE `job_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `module_details`
--
ALTER TABLE `module_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `offer_banner`
--
ALTER TABLE `offer_banner`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_suggestions`
--
ALTER TABLE `chat_suggestions`
  ADD CONSTRAINT `chat_suggestions_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `chat_suggestions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `confirm_orders`
--
ALTER TABLE `confirm_orders`
  ADD CONSTRAINT `confirm_orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `confirm_orders_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `course_module`
--
ALTER TABLE `course_module`
  ADD CONSTRAINT `course_module_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_apply`
--
ALTER TABLE `job_apply`
  ADD CONSTRAINT `job_apply_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `job_apply` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module_details`
--
ALTER TABLE `module_details`
  ADD CONSTRAINT `module_details_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `course_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
