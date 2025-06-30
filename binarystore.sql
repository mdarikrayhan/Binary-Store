-- -------------------------------------------------------------
-- TablePlus 6.6.4(624)
--
-- https://tableplus.com/
--
-- Database: binarystore
-- Generation Time: 2025-06-30 10:10:27.7790
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image_url` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `cost` int DEFAULT NULL,
  `shipping_address` text,
  `shipping_phone` varchar(255) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image_url` varchar(255) DEFAULT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` enum('admin','user') NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `division` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `upazila` varchar(255) DEFAULT NULL,
  `zipcode` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `categories` (`id`, `name`, `description`, `image_url`, `user_id`, `created_at`) VALUES
(1, 'Electronics', 'Velit unde minus vol', 'public/uploads/categories/1751256151Electronics.jpg68620c5717baa-Electronics.jpg', 1, '2025-06-30 10:02:31'),
(2, 'Perfume', 'At proident necessi', 'public/uploads/categories/1751256168Perfume.jpg68620c6816b34-Perfume.jpg', 1, '2025-06-30 10:02:48');

INSERT INTO `orders` (`id`, `product_id`, `user_id`, `order_status`, `cost`, `shipping_address`, `shipping_phone`, `quantity`, `created_at`) VALUES
(1, 1, 4, 'delivered', 233, 'Proident proident ', '+1 (976) 747-7467', 1, '2025-06-30 10:05:03'),
(2, 3, 4, 'pending', 209, 'Hic ipsa ea veniam', '+1 (265) 638-1333', 1, '2025-06-30 10:06:37');

INSERT INTO `products` (`id`, `name`, `description`, `image_url`, `price`, `quantity`, `category_id`, `user_id`, `created_at`) VALUES
(1, 'Computer Demo 1', 'Nobis id atque et u', 'public/uploads/products/1751256188com1.jpeg68620c7c61a2b-com1.jpeg', 233, 960, 1, 1, '2025-06-30 10:03:08'),
(2, 'Computer Demo 2', 'Veniam nostrum haru', 'public/uploads/products/1751256204com2.jpeg68620c8c55261-com2.jpeg', 772, 561, 1, 1, '2025-06-30 10:03:24'),
(3, 'Perfume Demo', 'Voluptas aut ut corr', 'public/uploads/products/1751256222PPerfume.jpeg68620c9e6a2b3-PPerfume.jpeg', 209, 839, 2, 1, '2025-06-30 10:03:42');

INSERT INTO `users` (`id`, `role`, `email`, `password`, `first_name`, `last_name`, `phone`, `division`, `district`, `upazila`, `zipcode`, `created_at`) VALUES
(1, 'admin', 'mdarikrayhan@gmail.com', '$2y$12$Z/11.skYo4drkEVUO5Wjk.8haBSMS9pyQxO.jj5TUehPTHj.puTFO', 'Md Arik', 'Rayhan', '+8801780873393', '5', '23', '373', 6620, '2025-06-30 09:45:46'),
(4, 'user', 'arikrayhan1000@gmail.com', '$2y$12$oItQJrBW0oF5.w8Gs7b7ZuGmlibO7q2jqhvwbyRMOtEGLm51FLX1W', 'Evelyn', 'Cox', '+1 (916) 304-6417', '5', '21', '357', 6400, '2025-06-30 10:01:29');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;