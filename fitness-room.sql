/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : fitness-room

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-04-11 12:29:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `courses`
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `time` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `3` (`room_id`),
  CONSTRAINT `3` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of courses
-- ----------------------------
INSERT INTO `courses` VALUES ('3', '第一个课程', '第一个课程的描述', '2', '2018-04-08 20:30:06', '2018-04-08 12:30:07', '2018-04-08 12:30:07');
INSERT INTO `courses` VALUES ('7', '第二个健身房', '健身房健身房健身房健身房', '2', '2018-04-11 00:08:16', '2018-04-10 16:08:18', '2018-04-10 16:08:18');
INSERT INTO `courses` VALUES ('8', '第三个课程', '健身房健身房健身房健身房', '5', '2018-04-11 00:08:38', '2018-04-10 16:08:40', '2018-04-10 16:08:40');
INSERT INTO `courses` VALUES ('9', '第四个课程', '健身房健身房健身房', '2', '2018-04-11 00:08:52', '2018-04-10 16:08:54', '2018-04-10 16:08:54');
INSERT INTO `courses` VALUES ('10', '第五个课程', '健身房健身房健身房健身房', '5', '2018-04-11 00:09:03', '2018-04-10 16:09:05', '2018-04-10 16:09:05');

-- ----------------------------
-- Table structure for `course_user`
-- ----------------------------
DROP TABLE IF EXISTS `course_user`;
CREATE TABLE `course_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `1` (`user_id`),
  KEY `2` (`course_id`),
  CONSTRAINT `1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of course_user
-- ----------------------------
INSERT INTO `course_user` VALUES ('25', '5', '3');
INSERT INTO `course_user` VALUES ('28', '5', '10');
INSERT INTO `course_user` VALUES ('30', '5', '9');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `cover_uri` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `url` mediumtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('2', 'hahah', 'images/da9bd6a1474ac425f35acc8cc2ca5283.jpeg', '3', 'https://detail.tmall.com/item.htm?spm=a3211.0-5931653.userDefinedPic_1479714772816_11.1.62bf1f74zNO3s2&id=534569307104&rn=692817cf4c67933780a29fa21cf8460c&abbucket=19&scene=taobao_shop&gccpm=7569784.600.2.subject-1108&sta=gccpm:7569784.600.2.subject-1108&track_params={%22gccpm%22:%227569784.600.2.subject-1108%22}', '0', '2018-04-10 04:43:12', '2018-04-10 16:10:04');
INSERT INTO `products` VALUES ('3', '好', 'images/41429428ef91b41894a07e300ccc4452.jpeg', '24', 'https://detail.tmall.com/item.htm?spm=a3211.0-5931653.userDefinedPic_1479714772816_11.1.62bf1f74zNO3s2&id=534569307104&rn=692817cf4c67933780a29fa21cf8460c&abbucket=19&scene=taobao_shop&gccpm=7569784.600.2.subject-1108&sta=gccpm:7569784.600.2.subject-1108&track_params={%22gccpm%22:%227569784.600.2.subject-1108%22}', '0', '2018-04-10 06:28:16', '2018-04-10 06:28:16');

-- ----------------------------
-- Table structure for `rooms`
-- ----------------------------
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `cover_uri` varchar(255) NOT NULL,
  `current_num` int(11) NOT NULL DEFAULT '0',
  `location` varchar(255) NOT NULL,
  `equipment_desc` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rooms
-- ----------------------------
INSERT INTO `rooms` VALUES ('2', '第一健身房', 'images/c336c2a0605c1d27e51e040ab5616387.jpeg', '0', '中华大街和平路交叉', '好多好多', '0', '2018-04-08 04:32:58', '2018-04-10 16:07:34');
INSERT INTO `rooms` VALUES ('5', '第二健身房', 'images/efe2c346939b94e77235625f94b8d6de.jpeg', '0', '和平路20号', '器材器材器材器材', '0', '2018-04-10 16:05:44', '2018-04-10 16:05:44');
INSERT INTO `rooms` VALUES ('6', '第三健身房', 'images/cbc6d7e8ee9c60cb6c8c8befe4990f26.jpeg', '0', '柏林南路30号', '器材器材器材器材', '0', '2018-04-10 16:06:18', '2018-04-10 16:06:18');
INSERT INTO `rooms` VALUES ('7', '第四健身房', 'images/326fdf2f1c3288cec2889361c01f6146.jpeg', '0', '裕翔街10号', '器材器材器材器材', '0', '2018-04-10 16:06:45', '2018-04-10 16:06:45');
INSERT INTO `rooms` VALUES ('8', '第五健身房', 'images/b1bedfa4696015e34e1f6ebe6554890b.jpeg', '0', '建设大街122号', '器材器材器材器材器材', '0', '2018-04-10 16:07:09', '2018-04-10 16:07:09');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('4', '13081114776', '小松', '109803058@qq.com', '$2y$10$YdzcJyk2ZGWhELx5r7bBDeZQ4ejUkss.fHv4cbDpSsgro/t2a7y0.', null, '2018-04-07 13:57:45', '2018-04-09 05:01:39', '0');
INSERT INTO `users` VALUES ('5', '13081114886', '小松', '1098030258@qq.com', '$2y$10$iFH.MSs/G8SVbrX4L5/wOuMcO.L6mFojzkR5Zi/fI5UUhr5sZqnCW', null, '2018-04-07 15:16:32', '2018-04-08 06:34:57', '0');
