/*
 Navicat MySQL Data Transfer

 Source Server         : 123.206.65.137
 Source Server Type    : MySQL
 Source Server Version : 100125
 Source Host           : 123.206.65.137:3306
 Source Schema         : fitness-room

 Target Server Type    : MySQL
 Target Server Version : 100125
 File Encoding         : 65001

 Date: 29/04/2018 15:30:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for course_user
-- ----------------------------
DROP TABLE IF EXISTS `course_user`;
CREATE TABLE `course_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `1`(`user_id`) USING BTREE,
  INDEX `2`(`course_id`) USING BTREE,
  CONSTRAINT `1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of course_user
-- ----------------------------
INSERT INTO `course_user` VALUES (5, 4, 7);
INSERT INTO `course_user` VALUES (6, 4, 8);
INSERT INTO `course_user` VALUES (7, 4, 10);
INSERT INTO `course_user` VALUES (8, 4, 9);
INSERT INTO `course_user` VALUES (9, 8, 10);
INSERT INTO `course_user` VALUES (10, 8, 7);
INSERT INTO `course_user` VALUES (11, 10, 7);
INSERT INTO `course_user` VALUES (12, 10, 9);
INSERT INTO `course_user` VALUES (13, 10, 8);

-- ----------------------------
-- Table structure for courses
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `time` datetime(0) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `3`(`room_id`) USING BTREE,
  CONSTRAINT `3` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of courses
-- ----------------------------
INSERT INTO `courses` VALUES (7, '第二个健身房', '健身房健身房健身房健身房', 2, '2018-04-11 00:08:16', '2018-04-10 16:08:18', '2018-04-10 16:08:18');
INSERT INTO `courses` VALUES (8, '第三个课程', '健身房健身房健身房健身房', 5, '2018-04-11 00:08:38', '2018-04-10 16:08:40', '2018-04-10 16:08:40');
INSERT INTO `courses` VALUES (9, '第四个课程', '健身房健身房健身房', 2, '2018-04-11 00:08:52', '2018-04-10 16:08:54', '2018-04-10 16:08:54');
INSERT INTO `courses` VALUES (10, '第五个课程', '健身房健身房健身房健身房', 5, '2018-04-11 00:09:03', '2018-04-10 16:09:05', '2018-04-10 16:09:05');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', 1);

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cover_uri` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (1, 'images/news.jpg', '第一天新闻', 1, '描述描述描述描述', '2018-04-22 14:38:11', '0000-00-00 00:00:00');
INSERT INTO `news` VALUES (2, 'images/d406d4ede34e2bb93a643427c1cbe8e6.jpeg', '第二条新闻', 0, '描述描述描述', '2018-04-22 14:37:49', '2018-04-22 14:37:49');
INSERT INTO `news` VALUES (3, 'images/d406d4ede34e2bb93a643427c1cbe8e6.jpeg', '第二条新闻', 0, '描述描述描述', '2018-04-22 14:38:05', '2018-04-22 14:38:05');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE,
  INDEX `password_resets_token_index`(`token`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cover_uri` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` int(11) NOT NULL,
  `url` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (2, 'hahah', 'images/da9bd6a1474ac425f35acc8cc2ca5283.jpeg', 3, 'https://detail.tmall.com/item.htm?spm=a3211.0-5931653.userDefinedPic_1479714772816_11.1.62bf1f74zNO3s2&id=534569307104&rn=692817cf4c67933780a29fa21cf8460c&abbucket=19&scene=taobao_shop&gccpm=7569784.600.2.subject-1108&sta=gccpm:7569784.600.2.subject-1108&track_params={%22gccpm%22:%227569784.600.2.subject-1108%22}', 0, '2018-04-10 04:43:12', '2018-04-10 16:10:04');
INSERT INTO `products` VALUES (3, '好', 'images/41429428ef91b41894a07e300ccc4452.jpeg', 24, 'https://detail.tmall.com/item.htm?spm=a3211.0-5931653.userDefinedPic_1479714772816_11.1.62bf1f74zNO3s2&id=534569307104&rn=692817cf4c67933780a29fa21cf8460c&abbucket=19&scene=taobao_shop&gccpm=7569784.600.2.subject-1108&sta=gccpm:7569784.600.2.subject-1108&track_params={%22gccpm%22:%227569784.600.2.subject-1108%22}', 0, '2018-04-10 06:28:16', '2018-04-10 06:28:16');
INSERT INTO `products` VALUES (4, 'asdasd', 'images/e840e19829a1b6b2db8f3adac2efff94.jpeg', 15, 'http://www.xitongcheng.com/jiaocheng/atrrvyd.html', 0, '2018-04-13 07:11:26', '2018-04-13 07:11:26');

-- ----------------------------
-- Table structure for room_user
-- ----------------------------
DROP TABLE IF EXISTS `room_user`;
CREATE TABLE `room_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `112`(`room_id`) USING BTREE,
  INDEX `113`(`user_id`) USING BTREE,
  CONSTRAINT `112` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `113` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of room_user
-- ----------------------------
INSERT INTO `room_user` VALUES (21, 6, 4);

-- ----------------------------
-- Table structure for rooms
-- ----------------------------
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cover_uri` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `current_num` int(11) NOT NULL DEFAULT 0,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `equipment_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime(0) NOT NULL,
  `updated_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of rooms
-- ----------------------------
INSERT INTO `rooms` VALUES (2, '第一健身房', 'images/41429428ef91b41894a07e300ccc4452.jpeg', 0, '中华大街和平路交叉', '好多好多', 0, '2018-04-08 04:32:58', '2018-04-13 07:10:31');
INSERT INTO `rooms` VALUES (5, '第二健身房', 'images/efe2c346939b94e77235625f94b8d6de.jpeg', 0, '和平路20号', '器材器材器材器材', 0, '2018-04-10 16:05:44', '2018-04-10 16:05:44');
INSERT INTO `rooms` VALUES (6, '第三健身房', 'images/cbc6d7e8ee9c60cb6c8c8befe4990f26.jpeg', 0, '柏林南路30号', '器材器材器材器材', 0, '2018-04-10 16:06:18', '2018-04-10 16:06:18');
INSERT INTO `rooms` VALUES (7, '第四健身房', 'images/326fdf2f1c3288cec2889361c01f6146.jpeg', 0, '裕翔街10号', '器材器材器材器材', 0, '2018-04-10 16:06:45', '2018-04-10 16:06:45');
INSERT INTO `rooms` VALUES (8, '第五健身房', 'images/b1bedfa4696015e34e1f6ebe6554890b.jpeg', 0, '建设大街122号', '器材器材器材器材器材', 0, '2018-04-10 16:07:09', '2018-04-10 16:07:09');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (4, '13081114776', '小松', '109803058@qq.com', '$2y$10$YdzcJyk2ZGWhELx5r7bBDeZQ4ejUkss.fHv4cbDpSsgro/t2a7y0.', NULL, '2018-04-07 13:57:45', '2018-04-13 07:10:05', 1);
INSERT INTO `users` VALUES (6, '12341231242', 'xiaosong', '123132@qq.com', '$2y$10$b2/JGDC8umyWbepRG65VaOQW0mHv87oFhyrTN4wfqaSiNlWwHmIta', NULL, '2018-04-13 07:09:58', '2018-04-13 07:09:58', 0);
INSERT INTO `users` VALUES (7, '11111111112', '111111', '111111@qq.com', '$2y$10$ulL/hPf7N8Tw/gkMlMINmOTdIVCIdmRhfyX2KIJC2RRjkPy7G91NO', 'i4uEmBwkoSuabwYQsvpaWjH9GPaqzAn3QceoGdIK01N4nUBrNYB2HdDXOl1F', '2018-04-27 05:40:19', '2018-04-27 08:26:53', 0);
INSERT INTO `users` VALUES (8, '11111111111', '1111', '1111@qq.com', '$2y$10$gljIrP.G0lkDlz50K/55Ceawx.Bjg2SVjjTwLILa9ajltWTIFVECa', NULL, '2018-04-27 05:52:10', '2018-04-27 05:52:10', 0);
INSERT INTO `users` VALUES (9, '12345678912', '11111', '11111@qq.com', '$2y$10$GOPBsmvOgQQUWaYUYuJqw.3nexpFTY3IXnkBISLaH/SIX7U3Vc0Iy', 'xMjSoyDP2a6QUireiQgp5G85XIu92PiqeOJglJrwFbeLrK3V6eiiqTMR8jpo', '2018-04-27 08:24:53', '2018-04-27 08:36:29', 0);
INSERT INTO `users` VALUES (10, '12312341233', '123', '123@qq.com', '$2y$10$xP0cTqywMQDri9zclemu3OqBo2bdXErWM6rV24kKRZPhr4iIgLFT2', NULL, '2018-04-27 08:36:53', '2018-04-27 08:36:53', 0);

SET FOREIGN_KEY_CHECKS = 1;
