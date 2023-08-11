/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50515 (5.5.15)
 Source Host           : localhost:3306
 Source Schema         : laucher

 Target Server Type    : MySQL
 Target Server Version : 50515 (5.5.15)
 File Encoding         : 65001

 Date: 11/08/2023 11:28:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for kncms_server
-- ----------------------------
DROP TABLE IF EXISTS `kncms_server`;
CREATE TABLE `kncms_server`  (
  `id` int(11) NOT NULL,
  `server_ip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `server_port` int(11) NULL DEFAULT NULL,
  `apikey` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of kncms_server
-- ----------------------------
INSERT INTO `kncms_server` VALUES (0, '127.0.0.1', 7777, 'KNCMS-ADMIN-KEY');

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `uid` int(11) NULL DEFAULT NULL,
  `time` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of logs
-- ----------------------------

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fav` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `shortname` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (0, 'KNCMS', NULL, NULL, 'KNCMS', 'KN');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `avt` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `createdtime` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ActiveCode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ActiveStatus` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (5, 'Khoi_Nguyen', 'Khoi Nguyen', 'nguyen', 'KhNguyenDev.MazTech@gmail.com', NULL, NULL, NULL, '2023-08-10 11:02:221', 'KNCMS-177373', 1);
INSERT INTO `users` VALUES (6, 'Khoi_Nguyen', 'Khoi Nguyen', 'nguyen', 'kngyen205@gmail.com', NULL, NULL, NULL, '2023-08-10 11:05:221', 'KNCMS-398651', 1);
INSERT INTO `users` VALUES (7, 'Khoi_Nguyen', 'Khoi Nguyen', 'nguyen', 'kngyen205@gmail.com', NULL, NULL, NULL, '2023-08-10 11:07:221', 'KNCMS-835148', 1);

SET FOREIGN_KEY_CHECKS = 1;
