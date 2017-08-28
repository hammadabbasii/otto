-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2017 at 10:03 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ottozilla`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `year` varchar(50) NOT NULL,
  `is_featured` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `user_id`, `category_id`, `title`, `description`, `phone_number`, `price`, `year`, `is_featured`, `created_at`, `updated_at`, `status`) VALUES
(1, 109, 1, 'Honda Civic', 'Best Car Ever', '123456789', '20000', '2014', '1', '2017-08-17 00:00:00', '0000-00-00 00:00:00', 'enable'),
(2, 109, 1, 'Lexus ', 'this is my thing', '123456789', '35000', '2017', '1', '2017-08-15 00:00:00', '0000-00-00 00:00:00', 'enable'),
(3, 109, 1, 'Toyotta Corolla', 'great suspension one of the best car ever', '123456789', '15000', '2015', '1', '2017-08-02 00:00:00', '0000-00-00 00:00:00', 'enable'),
(4, 109, 1, 'Mercedes Benz', 'C Class Car with A Class Body', '123456789', '60000', '2016', '1', '2017-08-15 00:00:00', '0000-00-00 00:00:00', 'enable'),
(5, 109, 1, 'Aqua', 'Honda', '123456789', '18000', '2012', '1', '2017-08-16 00:00:00', '0000-00-00 00:00:00', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `ad_attributes`
--

CREATE TABLE `ad_attributes` (
  `id` bigint(20) NOT NULL,
  `ad_id` bigint(20) NOT NULL,
  `attribute_id` bigint(20) NOT NULL,
  `attribute_value_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ad_images`
--

CREATE TABLE `ad_images` (
  `id` bigint(20) NOT NULL,
  `ad_id` bigint(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ad_images`
--

INSERT INTO `ad_images` (`id`, `ad_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'CR-Cars-Inline-2017-Acura-ILX-12-16.jpg', '2017-08-18 00:00:00', '2017-08-18 00:00:00'),
(2, 1, '2017-EC-Small-Cars-Mazda-3-hatchback.jpg', '2017-08-18 00:00:00', '2017-08-18 00:00:00'),
(3, 2, '161217142430-2017-cars-ferrari-1-overlay-tease.jpg', '2017-08-18 00:00:00', '2017-08-18 00:00:00'),
(4, 2, '2016-er-photo-657582-s-original.jpg', '2017-08-18 00:00:00', '2017-08-18 00:00:00'),
(5, 3, '2016-er-photo-657582-s-original.jpg', '2017-08-18 00:00:00', '2017-08-18 00:00:00'),
(6, 4, '161217142430-2017-cars-ferrari-1-overlay-tease.jpg', '2017-08-18 00:00:00', '2017-08-18 00:00:00'),
(7, 4, '2017-EC-Small-Cars-Mazda-3-hatchback.jpg', '2017-08-18 00:00:00', '2017-08-18 00:00:00'),
(8, 5, 'CR-Cars-Inline-2017-Acura-ILX-12-16.jpg', '2017-08-18 00:00:00', '2017-08-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `attribute_code` varchar(255) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `attribute_image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) NOT NULL,
  `attribute_id` bigint(20) NOT NULL,
  `attribute_value_code` varchar(255) NOT NULL,
  `attribute_value_name` varchar(255) NOT NULL,
  `input_type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `image`, `parent_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Used cars', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(2, 'Bikes', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(3, 'Boats', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(4, 'Auto Accessories', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(5, 'Number Plates', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(6, 'Auto Services', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` int(11) NOT NULL,
  `key` enum('aboutus','terms','policies','help') DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `key`, `title`, `body`, `created_at`, `updated_at`) VALUES
(6, 'terms', 'Terms & Conditions', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\n    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\n    <p>Minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>', '2017-03-20 16:03:09', '2017-07-22 15:48:13'),
(7, 'policies', 'Privacy Policy', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\n    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\n    <p>Minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>', '2017-04-05 00:00:00', '2017-07-22 15:47:33'),
(8, 'aboutus', 'About Us', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\n    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\n    <p>Minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>', '2017-04-13 16:07:16', '2017-04-24 12:53:07'),
(9, 'help', 'Help', '    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\n    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\n    <p>Minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>\n', '2017-04-13 16:07:16', '2017-04-24 12:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ad_id` bigint(20) NOT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_type` enum('admin','dealer','seller','buyer') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'buyer',
  `rights` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'category,product,user,cms,noti',
  `user_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1 means active , 0 means blocked/inactive',
  `dob` date DEFAULT NULL,
  `gender` enum('male','female') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `social_media_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_media_platform` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `notification_status` tinyint(2) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `rights`, `user_name`, `first_name`, `last_name`, `full_name`, `email`, `password`, `status`, `dob`, `gender`, `address`, `city`, `country`, `phone_number`, `company_name`, `image`, `social_media_id`, `social_media_platform`, `notification_status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `last_login`) VALUES
(109, 'buyer', 'category,product,user,cms,noti', 'johnny', 'john', 'denver', 'john denver', 'john@john.com', '', 1, NULL, NULL, '', '', '', '', '', NULL, '', '', 1, NULL, NULL, NULL, NULL, '2017-08-18 15:12:03'),
(115, 'buyer', 'category,product,user,cms,noti', NULL, 'johnathan', 'glazer', '', 'johnny@jani.com', '$2y$10$oNMMXAVPZs93hBmetZqT/ej/Doy4HEh/O62KLzAIzLpiMd2VWu4Zu', 1, '2016-03-16', 'male', '', '', '', '123456789123', '', 'QYoGHAoMoA1R.jpg', '', '', 1, NULL, '2017-08-18 16:02:27', '2017-08-18 16:02:27', NULL, '2017-08-18 21:02:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `ad_attributes`
--
ALTER TABLE `ad_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ad_images`
--
ALTER TABLE `ad_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_id` (`ad_id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ad_attributes`
--
ALTER TABLE `ad_attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ad_images`
--
ALTER TABLE `ad_images`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ads_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ad_images`
--
ALTER TABLE `ad_images`
  ADD CONSTRAINT `ad_images_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
