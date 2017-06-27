/*
Navicat MySQL Data Transfer

Source Server         : Homestead
Source Server Version : 50717
Source Host           : 192.168.10.10:3306
Source Database       : homestead

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-06-27 14:26:10
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `cates`
-- ----------------------------
DROP TABLE IF EXISTS `cates`;
CREATE TABLE `cates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `list_parents` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cates_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cates
-- ----------------------------

-- ----------------------------
-- Table structure for `cate_foods`
-- ----------------------------
DROP TABLE IF EXISTS `cate_foods`;
CREATE TABLE `cate_foods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cate_foods
-- ----------------------------
INSERT INTO `cate_foods` VALUES ('1', 'Appetisers', 'appetisers', '1', '1', '2017-06-26 21:32:16', '2017-06-26 21:32:16');
INSERT INTO `cate_foods` VALUES ('2', 'Starters', 'starters', '1', '2', '2017-06-26 21:33:19', '2017-06-26 21:33:23');
INSERT INTO `cate_foods` VALUES ('3', 'Salads', 'salads', '1', '3', '2017-06-26 21:33:35', '2017-06-26 21:33:35');
INSERT INTO `cate_foods` VALUES ('4', 'Main Dishes', 'main-dishes', '1', '4', '2017-06-26 21:33:44', '2017-06-26 21:33:44');

-- ----------------------------
-- Table structure for `foods`
-- ----------------------------
DROP TABLE IF EXISTS `foods`;
CREATE TABLE `foods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cate_id` int(10) unsigned NOT NULL,
  `price` double(8,2) NOT NULL,
  `summary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `special` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `foods_cate_id_foreign` (`cate_id`),
  CONSTRAINT `foods_cate_id_foreign` FOREIGN KEY (`cate_id`) REFERENCES `cate_foods` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of foods
-- ----------------------------
INSERT INTO `foods` VALUES ('1', 'Tzatsiki', 'tzatsiki', '1', '3.99', 'Refreshing traditional cucumber and garlic yoghurt dip.', '1', '0', '1', '2017-06-26 23:25:33', '2017-06-26 23:25:33');
INSERT INTO `foods` VALUES ('2', 'Aubergine_Salad', 'aubergine_salad', '1', '5.50', '.Pureed eggplant, garlic, green pepper and tomato dip.', '1', '0', '2', '2017-06-26 23:25:53', '2017-06-26 23:25:53');
INSERT INTO `foods` VALUES ('3', 'Aubergine_Salads', 'aubergine_salads', '1', '5.25', 'Pureed eggplant, garlic, green pepper and tomato dip.', '1', '0', '3', '2017-06-26 23:26:50', '2017-06-26 23:26:50');
INSERT INTO `foods` VALUES ('4', 'Haloumi', 'haloumi', '2', '3.99', 'Refreshing traditional cucumber and garlic yoghurt dip.', '1', '0', '4', '2017-06-26 23:27:12', '2017-06-26 23:27:12');
INSERT INTO `foods` VALUES ('5', 'Spinach_Pie', 'spinach_pie', '2', '5.50', '.Pureed eggplant, garlic, green pepper and tomato dip.', '1', '0', '5', '2017-06-26 23:27:36', '2017-06-26 23:27:36');
INSERT INTO `foods` VALUES ('6', 'Olive_Special', 'olive_special', '3', '5.50', 'Refreshing traditional cucumber and garlic yoghurt dip.', '1', '0', '6', '2017-06-26 23:28:00', '2017-06-26 23:28:00');
INSERT INTO `foods` VALUES ('7', 'Greek_Salad', 'greek_salad', '3', '5.50', '.Pureed eggplant, garlic, green pepper and tomato dip.', '1', '1', '7', '2017-06-26 23:28:34', '2017-06-26 23:31:47');
INSERT INTO `foods` VALUES ('8', 'Gusto_Salad', 'gusto_salad', '3', '5.99', 'Pureed eggplant, garlic, green pepper and tomato dip.', '1', '0', '8', '2017-06-26 23:28:58', '2017-06-26 23:31:21');
INSERT INTO `foods` VALUES ('9', 'Cornish_Mackerel', 'cornish_mackerel', '4', '5.99', 'Refreshing traditional cucumber and garlic yoghurt dip.', '1', '0', '9', '2017-06-26 23:29:22', '2017-06-26 23:31:21');
INSERT INTO `foods` VALUES ('10', 'Roast_Lamb', 'roast_lamb', '4', '5.50', '.Pureed eggplant, garlic, green pepper and tomato dip.', '1', '1', '10', '2017-06-26 23:29:44', '2017-06-26 23:31:21');
INSERT INTO `foods` VALUES ('11', 'Roast_Lambs', 'roast_lambs', '4', '5.25', 'Pureed eggplant, garlic, green pepper and tomato dip.', '1', '0', '11', '2017-06-26 23:30:44', '2017-06-26 23:31:31');
INSERT INTO `foods` VALUES ('12', 'Pastitsio', 'pastitsio', '4', '5.99', 'Refreshing traditional cucumber and garlic yoghurt dip.', '1', '0', '12', '2017-06-26 23:31:04', '2017-06-26 23:31:31');

-- ----------------------------
-- Table structure for `group_menus`
-- ----------------------------
DROP TABLE IF EXISTS `group_menus`;
CREATE TABLE `group_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of group_menus
-- ----------------------------
INSERT INTO `group_menus` VALUES ('18', 'menu top', '1', '1', '2017-06-26 11:22:24', '2017-06-26 11:22:24');

-- ----------------------------
-- Table structure for `images`
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug_original` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of images
-- ----------------------------
INSERT INTO `images` VALUES ('5', '18817969_1180730532073287_1580723174_o.jpg', '1881796911807305320732871580723174o', 'uploads/images/2017/06/-1881796911807305320732871580723174o.jpg', 'uploads/images/2017/06/-1881796911807305320732871580723174o.jpg', '2017-06-16 15:29:01', '2017-06-16 15:29:01');
INSERT INTO `images` VALUES ('6', '18817969_1180730532073287_1580723174_o.jpg', '1881796911807305320732871580723174o-864d86', 'uploads/images/2017/06/-1881796911807305320732871580723174o-864d86.jpg', 'uploads/images/2017/06/-1881796911807305320732871580723174o-864d86.jpg', '2017-06-16 15:32:17', '2017-06-16 15:32:17');
INSERT INTO `images` VALUES ('7', '18869877_1180730518739955_1269351845_o.jpg', '1886987711807305187399551269351845o', 'uploads/images/2017/06/-1886987711807305187399551269351845o.jpg', 'uploads/images/2017/06/-1886987711807305187399551269351845o.jpg', '2017-06-16 15:33:04', '2017-06-16 15:33:04');
INSERT INTO `images` VALUES ('8', '18836209_1180730608739946_678634179_o.jpg', '188362091180730608739946678634179o', 'uploads/images/2017/06/-188362091180730608739946678634179o.jpg', 'uploads/images/2017/06/-188362091180730608739946678634179o.jpg', '2017-06-16 15:33:13', '2017-06-16 15:33:13');
INSERT INTO `images` VALUES ('9', '18836209_1180730502073290_1379170038_o.jpg', '1883620911807305020732901379170038o', 'uploads/images/2017/06/-1883620911807305020732901379170038o.jpg', 'uploads/images/2017/06/-1883620911807305020732901379170038o.jpg', '2017-06-16 15:33:32', '2017-06-16 15:33:32');
INSERT INTO `images` VALUES ('10', '18836340_1180730495406624_1725429765_o.jpg', '1883634011807304954066241725429765o', 'uploads/images/2017/06/-1883634011807304954066241725429765o.jpg', 'uploads/images/2017/06/-1883634011807304954066241725429765o.jpg', '2017-06-16 15:33:32', '2017-06-16 15:33:32');
INSERT INTO `images` VALUES ('11', '18836209_1180730608739946_678634179_o.jpg', '188362091180730608739946678634179o-c0b76b', 'uploads/images/2017/06/-188362091180730608739946678634179o-c0b76b.jpg', 'uploads/images/2017/06/-188362091180730608739946678634179o-c0b76b.jpg', '2017-06-16 15:33:33', '2017-06-16 15:33:33');
INSERT INTO `images` VALUES ('12', '18817817_1180730505406623_2142902719_o.jpg', '1881781711807305054066232142902719o', 'uploads/images/2017/06/-1881781711807305054066232142902719o.jpg', 'uploads/images/2017/06/-1881781711807305054066232142902719o.jpg', '2017-06-16 15:53:15', '2017-06-16 15:53:15');
INSERT INTO `images` VALUES ('13', '18836340_1180730495406624_1725429765_o.jpg', '1883634011807304954066241725429765o', 'uploads/images/2017/06/-1883634011807304954066241725429765o.jpg', 'uploads/images/2017/06/-1883634011807304954066241725429765o.jpg', '2017-06-16 15:54:55', '2017-06-16 15:54:55');
INSERT INTO `images` VALUES ('14', '18817969_1180730532073287_1580723174_o.jpg', '1881796911807305320732871580723174o', 'uploads/images/2017/06/-1881796911807305320732871580723174o.jpg', 'uploads/images/2017/06/-1881796911807305320732871580723174o.jpg', '2017-06-16 15:55:58', '2017-06-16 15:55:58');
INSERT INTO `images` VALUES ('15', '18836209_1180730608739946_678634179_o.jpg', '188362091180730608739946678634179o', 'uploads/images/2017/06/-188362091180730608739946678634179o.jpg', 'uploads/images/2017/06/-188362091180730608739946678634179o.jpg', '2017-06-16 16:02:38', '2017-06-16 16:02:38');
INSERT INTO `images` VALUES ('17', '18836459_1180730622073278_664276832_o.jpg', '188364591180730622073278664276832o', 'uploads/images/2017/06/-188364591180730622073278664276832o.jpg', 'uploads/images/2017/06/-188364591180730622073278664276832o.jpg', '2017-06-16 16:07:59', '2017-06-16 16:07:59');
INSERT INTO `images` VALUES ('18', '18836340_1180730495406624_1725429765_o.jpg', '1883634011807304954066241725429765o-9125d7', 'uploads/images/2017/06/-1883634011807304954066241725429765o-9125d7.jpg', 'uploads/images/2017/06/-1883634011807304954066241725429765o-9125d7.jpg', '2017-06-16 16:13:58', '2017-06-16 16:13:58');
INSERT INTO `images` VALUES ('19', '18901199_1180730498739957_1848481337_o.jpg', '1890119911807304987399571848481337o', 'uploads/images/2017/06/-1890119911807304987399571848481337o.jpg', 'uploads/images/2017/06/-1890119911807304987399571848481337o.jpg', '2017-06-16 16:14:41', '2017-06-16 16:14:41');
INSERT INTO `images` VALUES ('20', '18817817_1180730505406623_2142902719_o.jpg', '1881781711807305054066232142902719o-529fc3', 'uploads/images/2017/06/-1881781711807305054066232142902719o-529fc3.jpg', 'uploads/images/2017/06/-1881781711807305054066232142902719o-529fc3.jpg', '2017-06-18 16:47:00', '2017-06-18 16:47:00');
INSERT INTO `images` VALUES ('21', '18817817_1180730505406623_2142902719_o.jpg', '1881781711807305054066232142902719o', 'uploads/images/2017/06/-1881781711807305054066232142902719o.jpg', 'uploads/images/2017/06/-1881781711807305054066232142902719o.jpg', '2017-06-18 16:47:50', '2017-06-18 16:47:50');
INSERT INTO `images` VALUES ('22', '18817817_1180730505406623_2142902719_o.jpg', '1881781711807305054066232142902719o-bc9563', 'uploads/images/2017/06/-1881781711807305054066232142902719o-bc9563.jpg', 'uploads/images/2017/06/-1881781711807305054066232142902719o-bc9563.jpg', '2017-06-18 16:54:41', '2017-06-18 16:54:41');
INSERT INTO `images` VALUES ('23', '18817817_1180730505406623_2142902719_o.jpg', '1881781711807305054066232142902719o', 'uploads/images/2017/06/-1881781711807305054066232142902719o.jpg', 'uploads/images/2017/06/-1881781711807305054066232142902719o.jpg', '2017-06-18 16:56:01', '2017-06-18 16:56:01');
INSERT INTO `images` VALUES ('24', '18817817_1180730505406623_2142902719_o.jpg', '1881781711807305054066232142902719o', 'uploads/images/2017/06/-1881781711807305054066232142902719o.jpg', 'uploads/images/2017/06/-1881781711807305054066232142902719o.jpg', '2017-06-18 16:56:54', '2017-06-18 16:56:54');
INSERT INTO `images` VALUES ('25', '18817817_1180730505406623_2142902719_o.jpg', '1881781711807305054066232142902719o-645190', 'uploads/images/2017/06/-1881781711807305054066232142902719o-645190.jpg', 'uploads/images/2017/06/-1881781711807305054066232142902719o-645190.jpg', '2017-06-18 17:01:45', '2017-06-18 17:01:45');
INSERT INTO `images` VALUES ('26', '18817817_1180730505406623_2142902719_o.jpg', '1881781711807305054066232142902719o-d1eade', 'uploads/images/2017/06/-1881781711807305054066232142902719o-d1eade.jpg', 'uploads/images/2017/06/-1881781711807305054066232142902719o-d1eade.jpg', '2017-06-18 17:04:42', '2017-06-18 17:04:42');
INSERT INTO `images` VALUES ('27', '18817817_1180730505406623_2142902719_o.jpg', '1881781711807305054066232142902719o-eeee77', 'uploads/images/2017/06/-1881781711807305054066232142902719o-eeee77.jpg', 'uploads/images/2017/06/-1881781711807305054066232142902719o-eeee77.jpg', '2017-06-18 17:07:09', '2017-06-18 17:07:09');
INSERT INTO `images` VALUES ('28', '18817817_1180730505406623_2142902719_o.jpg', '1881781711807305054066232142902719o-934863', 'uploads/images/2017/06/-1881781711807305054066232142902719o-934863.jpg', 'uploads/images/2017/06/-1881781711807305054066232142902719o-934863.jpg', '2017-06-18 21:36:40', '2017-06-18 21:36:40');
INSERT INTO `images` VALUES ('29', '18836340_1180730495406624_1725429765_o.jpg', '1883634011807304954066241725429765o', 'uploads/images/2017/06/-1883634011807304954066241725429765o.jpg', 'uploads/images/2017/06/-1883634011807304954066241725429765o.jpg', '2017-06-18 22:27:09', '2017-06-18 22:27:09');

-- ----------------------------
-- Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `list_parents` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `target` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('6', 'Home', 'home', null, null, null, '0', null, null, '1', '1', '2017-06-26 11:22:54', '2017-06-26 11:22:54');
INSERT INTO `menus` VALUES ('7', 'About', 'about', null, null, null, '0', null, null, '1', '2', '2017-06-26 11:23:33', '2017-06-26 11:23:33');
INSERT INTO `menus` VALUES ('8', 'Igredients', 'igredients', null, null, null, '0', null, null, '1', '3', '2017-06-26 11:23:50', '2017-06-26 11:23:50');
INSERT INTO `menus` VALUES ('9', 'Menu', 'menu', null, null, null, '0', null, null, '1', '4', '2017-06-26 11:24:02', '2017-06-26 11:24:02');
INSERT INTO `menus` VALUES ('10', 'Reviews', 'reviews', null, null, null, '0', null, null, '1', '5', '2017-06-26 11:24:17', '2017-06-26 11:24:17');
INSERT INTO `menus` VALUES ('11', 'Reservations', 'reservations', null, null, null, '0', null, null, '1', '6', '2017-06-26 11:24:36', '2017-06-26 11:24:36');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2017_06_04_041748_create_cates_table', '1');
INSERT INTO `migrations` VALUES ('4', '2017_06_04_042654_create_products_table', '1');
INSERT INTO `migrations` VALUES ('5', '2017_06_05_030202_create_product_images_table', '1');
INSERT INTO `migrations` VALUES ('6', '2017_06_16_145419_create_images_table', '2');
INSERT INTO `migrations` VALUES ('7', '2017_06_20_211133_create_menu_cates_table', '3');
INSERT INTO `migrations` VALUES ('8', '2017_06_20_215116_create_menus_table', '4');
INSERT INTO `migrations` VALUES ('9', '2017_06_25_111911_create_les_table', '5');
INSERT INTO `migrations` VALUES ('10', '2017_06_25_111911_create_cats_table', '6');
INSERT INTO `migrations` VALUES ('11', '2017_06_25_114505_create_lecuongs_table', '7');
INSERT INTO `migrations` VALUES ('12', '2017_06_25_152834_create_group_menus_table', '8');
INSERT INTO `migrations` VALUES ('13', '2017_06_25_153348_create_menus_table', '8');
INSERT INTO `migrations` VALUES ('14', '2017_06_26_115911_create_cate_foods_table', '9');
INSERT INTO `migrations` VALUES ('16', '2017_06_26_214117_create_foods_table', '10');
INSERT INTO `migrations` VALUES ('17', '2017_06_27_084502_create_orders_table', '11');

-- ----------------------------
-- Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_person` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', 'cường', 'lecuong732@gmail.com', '06/20/2017', '2', '2017-06-27 09:13:05', '2017-06-27 09:13:05');
INSERT INTO `orders` VALUES ('2', 'cường', 'lecuong732@gmail.com', '06/16/2017', '3', '2017-06-27 09:14:12', '2017-06-27 09:14:12');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cate_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_name_unique` (`name`),
  KEY `products_cate_id_foreign` (`cate_id`),
  KEY `products_user_id_foreign` (`user_id`),
  CONSTRAINT `products_cate_id_foreign` FOREIGN KEY (`cate_id`) REFERENCES `cates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------

-- ----------------------------
-- Table structure for `product_images`
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of product_images
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lavel` tinyint(4) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'lecuong732', 'lecuong732@gmail.com', '$2y$10$33HNngRcCFxmhSouZuqJwuLQfmRuVlY8Lo5TK0Vl5UCVCRxFZ6eCy', null, 'dKDKBidJwyFSFoWr25IuO3zMOV60G1ryEvrKET4ZZMj4mODJ1FQ42ru73KLs', '2017-06-27 11:19:01', '2017-06-27 11:19:01');
