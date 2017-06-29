/*
Navicat MySQL Data Transfer

Source Server         : Homestead
Source Server Version : 50717
Source Host           : 192.168.10.10:3306
Source Database       : restaurant

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-06-29 22:31:02
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cate_foods`
-- ----------------------------
DROP TABLE IF EXISTS `cate_foods`;
CREATE TABLE `cate_foods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cate_foods
-- ----------------------------
INSERT INTO `cate_foods` VALUES ('1', 'Appetisers', 'appetisers', '2017-06-27 16:03:46', '2017-06-27 16:03:46');
INSERT INTO `cate_foods` VALUES ('2', 'Starters', 'starters', '2017-06-27 16:03:56', '2017-06-27 16:03:56');
INSERT INTO `cate_foods` VALUES ('3', 'Salads', 'salads', '2017-06-27 16:04:06', '2017-06-27 16:04:06');
INSERT INTO `cate_foods` VALUES ('4', 'Main Dishes', 'main-dishes', '2017-06-27 16:04:13', '2017-06-27 16:04:13');

-- ----------------------------
-- Table structure for `foods`
-- ----------------------------
DROP TABLE IF EXISTS `foods`;
CREATE TABLE `foods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `cate_id` int(10) unsigned NOT NULL,
  `price` double(8,2) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `special` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foods_cate_id_foreign` (`cate_id`),
  CONSTRAINT `foods_cate_id_foreign` FOREIGN KEY (`cate_id`) REFERENCES `cate_foods` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of foods
-- ----------------------------
INSERT INTO `foods` VALUES ('1', 'Tzatsikis', 'tzatsikis', '1', '3.99', 'Refreshing traditional cucumber and garlic yoghurt dip.', '0', '2017-06-27 16:04:39', '2017-06-29 17:31:00');
INSERT INTO `foods` VALUES ('2', 'Aubergine_Salads', 'aubergine_salads', '1', '5.50', '.Pureed eggplant, garlic, green pepper and tomato dip.', '0', '2017-06-27 16:05:09', '2017-06-27 16:05:09');
INSERT INTO `foods` VALUES ('3', 'Aubergine_Salad', 'aubergine_salad', '1', '5.25', 'Pureed eggplant, garlic, green pepper and tomato dip.', '0', '2017-06-27 16:05:29', '2017-06-27 16:05:29');
INSERT INTO `foods` VALUES ('4', 'Haloumi', 'haloumi', '2', '3.99', 'Refreshing traditional cucumber and garlic yoghurt dip.', '0', '2017-06-27 16:05:53', '2017-06-27 16:05:53');
INSERT INTO `foods` VALUES ('5', 'Spinach_Pie', 'spinach_pie', '2', '5.50', '.Pureed eggplant, garlic, green pepper and tomato dip.', '0', '2017-06-27 16:06:15', '2017-06-27 16:06:15');
INSERT INTO `foods` VALUES ('6', 'Olive_Special', 'olive_special', '3', '5.99', 'Refreshing traditional cucumber and garlic yoghurt dip.', '0', '2017-06-27 16:06:43', '2017-06-27 16:06:43');
INSERT INTO `foods` VALUES ('7', 'Greek_Salads', 'greek_salads', '3', '5.50', '.Pureed eggplant, garlic, green pepper and tomato dip.', '1', '2017-06-27 16:07:02', '2017-06-27 16:10:14');
INSERT INTO `foods` VALUES ('8', 'Gusto_Salad', 'gusto_salad', '3', '5.25', 'Pureed eggplant, garlic, green pepper and tomato dip', '0', '2017-06-27 16:07:26', '2017-06-27 16:10:28');
INSERT INTO `foods` VALUES ('9', 'Cornish_Mackerel', 'cornish_mackerel', '4', '5.99', 'Refreshing traditional cucumber and garlic yoghurt dip.', '0', '2017-06-27 16:07:47', '2017-06-27 16:08:59');
INSERT INTO `foods` VALUES ('10', 'Roast_Lamb', 'roast_lamb', '4', '5.50', '.Pureed eggplant, garlic, green pepper and tomato dip.', '1', '2017-06-27 16:08:08', '2017-06-27 16:09:37');
INSERT INTO `foods` VALUES ('11', 'Roast_Lambs', 'roast_lambs', '4', '5.25', 'Pureed eggplant, garlic, green pepper and tomato dip.', '0', '2017-06-27 16:08:28', '2017-06-27 16:09:10');
INSERT INTO `foods` VALUES ('12', 'Pastitsio', 'pastitsio', '4', '5.59', 'Refreshing traditional cucumber and garlic yoghurt dip.', '0', '2017-06-27 16:08:46', '2017-06-28 16:46:01');

-- ----------------------------
-- Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `list_parents` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', 'Home', 'home', ',1,', '0', '2017-06-27 16:01:44', '2017-06-29 15:57:11');
INSERT INTO `menus` VALUES ('2', 'About', 'about', ',2,', '0', '2017-06-27 16:02:21', '2017-06-28 16:37:39');
INSERT INTO `menus` VALUES ('3', 'Igredients', 'igredients', null, '0', '2017-06-27 16:02:34', '2017-06-27 16:02:34');
INSERT INTO `menus` VALUES ('4', 'Menu', 'menu', null, '0', '2017-06-27 16:02:53', '2017-06-27 16:02:53');
INSERT INTO `menus` VALUES ('5', 'Reviews', 'reviews', ',5,', '0', '2017-06-27 16:02:58', '2017-06-28 16:25:46');
INSERT INTO `menus` VALUES ('6', 'Reservations', 'reservations', ',6,', '0', '2017-06-27 16:03:12', '2017-06-28 16:37:51');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2017_06_25_152834_create_group_menus_table', '1');
INSERT INTO `migrations` VALUES ('4', '2017_06_25_153348_create_menus_table', '1');
INSERT INTO `migrations` VALUES ('5', '2017_06_26_115911_create_cate_foods_table', '1');
INSERT INTO `migrations` VALUES ('6', '2017_06_26_214117_create_foods_table', '1');
INSERT INTO `migrations` VALUES ('7', '2017_06_27_084502_create_orders_table', '1');

-- ----------------------------
-- Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `number_person` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('2', 'le van cuong', 'lecuong732@gmail.com', '07/20/2017', '3', '2017-06-28 15:02:37', '2017-06-29 22:26:40');
INSERT INTO `orders` VALUES ('3', 'lecuong', 'lecuong732@gmail.com', '06/30/2017', '3', '2017-06-28 17:17:57', '2017-06-28 17:20:59');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'lecuong732', 'lecuong732@gmail.com', '$2y$10$33HNngRcCFxmhSouZuqJwuLQfmRuVlY8Lo5TK0Vl5UCVCRxFZ6eCy', 'MCpG7cFH0vPKlDOmTllSWmjM8UU8aw84r8uFOtK3abATYFRKwIIBGkILV0PK', '2017-06-27 11:19:01', '2017-06-27 11:19:01');
