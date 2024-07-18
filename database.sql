-- -------------------------------------------------------------
-- TablePlus 6.1.2(568)
--
-- https://tableplus.com/
--
-- Database: ci4
-- Generation Time: 2024-07-19 00:27:36.2720
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `product_details` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int unsigned NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `extra_info_title` varchar(255) DEFAULT NULL,
  `extra_info_description` text,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text,
  `meta_description` text,
  `seo_address` varchar(255) DEFAULT NULL,
  `product_description` text,
  `video_embed_code` text,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `product_discounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int unsigned NOT NULL,
  `customer_group` varchar(100) DEFAULT NULL,
  `priority` int DEFAULT NULL,
  `discount_rate_tl` decimal(10,2) DEFAULT NULL,
  `discount_rate_usd` decimal(10,2) DEFAULT NULL,
  `discount_rate_eur` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_discounts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `product_images` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int unsigned NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product_code` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `quantity` int NOT NULL,
  `extra_discount` float NOT NULL,
  `tax_rate` float NOT NULL,
  `price_tl` decimal(10,2) NOT NULL,
  `price_usd` decimal(10,2) NOT NULL,
  `price_eur` decimal(10,2) NOT NULL,
  `second_price_tl` decimal(10,2) NOT NULL,
  `stock_deduct` tinyint(1) NOT NULL,
  `feature_section` tinyint(1) NOT NULL,
  `new_product_expiry` date DEFAULT NULL,
  `sort` int NOT NULL,
  `show_on_homepage` int NOT NULL,
  `is_new_product` tinyint(1) NOT NULL,
  `installment_number` int NOT NULL,
  `warranty_period` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `product_details` (`id`, `product_id`, `product_title`, `extra_info_title`, `extra_info_description`, `meta_title`, `meta_keywords`, `meta_description`, `seo_address`, `product_description`, `video_embed_code`) VALUES
(1, 1, 'Sample Product 1', 'Extra Info 1', 'Extra description for product 1.', 'Meta Title 1', 'keywords, product 1', 'Meta description for product 1.', 'sample-product-1', 'Description for product 1.', '<iframe></iframe>'),
(2, 2, 'Sample Product 2', 'Extra Info 2', 'Extra description for product 2.', 'Meta Title 2', 'keywords, product 2', 'Meta description for product 2.', 'sample-product-2', 'Description for product 2.', '<iframe></iframe>'),
(3, 3, 'Sample Product 3', 'Extra Info 3', 'Extra description for product 3.', 'Meta Title 3', 'keywords, product 3', 'Meta description for product 3.', 'sample-product-3', 'Description for product 3.', '<iframe></iframe>');

INSERT INTO `product_discounts` (`id`, `product_id`, `customer_group`, `priority`, `discount_rate_tl`, `discount_rate_usd`, `discount_rate_eur`, `start_date`, `end_date`) VALUES
(1, 1, 'General', 1, 5.00, 1.00, 0.90, '2024-01-01', '2024-12-31'),
(2, 2, 'VIP', 2, 10.00, 2.00, 1.80, '2024-01-01', '2024-12-31'),
(3, 3, 'Wholesale', 3, 15.00, 3.00, 2.70, '2024-01-01', '2024-12-31');

INSERT INTO `product_images` (`id`, `product_id`, `image_path`) VALUES
(1, 1, 'sample1.jpg'),
(2, 1, 'sample2.jpg'),
(3, 2, 'sample3.jpg'),
(4, 2, 'sample4.jpg'),
(5, 3, 'sample5.jpg'),
(6, 3, 'sample6.jpg');

INSERT INTO `products` (`id`, `product_code`, `status`, `quantity`, `extra_discount`, `tax_rate`, `price_tl`, `price_usd`, `price_eur`, `second_price_tl`, `stock_deduct`, `feature_section`, `new_product_expiry`, `sort`, `show_on_homepage`, `is_new_product`, `installment_number`, `warranty_period`, `created_at`, `updated_at`) VALUES
(1, 'P001', 1, 50, 10, 18, 100.00, 20.00, 18.00, 95.00, 1, 1, '2024-12-31', 1, 1, 1, 12, 24, '2024-07-18 23:59:42', '2024-07-18 23:59:42'),
(2, 'P002', 1, 30, 5, 18, 200.00, 40.00, 36.00, 190.00, 1, 1, '2024-12-31', 2, 1, 1, 12, 24, '2024-07-18 23:59:42', '2024-07-18 23:59:42'),
(3, 'P003', 1, 20, 15, 18, 300.00, 60.00, 54.00, 285.00, 1, 1, '2024-12-31', 3, 1, 1, 12, 24, '2024-07-18 23:59:42', '2024-07-18 23:59:42');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;