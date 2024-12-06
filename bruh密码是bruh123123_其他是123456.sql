/*
 Navicat Premium Data Transfer

 Source Server         : t
 Source Server Type    : MySQL
 Source Server Version : 50726 (5.7.26)
 Source Host           : localhost:3306
 Source Schema         : member

 Target Server Type    : MySQL
 Target Server Version : 50726 (5.7.26)
 File Encoding         : 65001

 Date: 02/07/2024 11:41:14
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for info
-- ----------------------------
DROP TABLE IF EXISTS `info`;
CREATE TABLE `info`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pw` char(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `fav` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(10) NOT NULL,
  `admin` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of info
-- ----------------------------
INSERT INTO `info` VALUES (1, '张三', 'e10adc3949ba59abbe56e057f20f883e', '396927@qq.com', 1, '听音乐', 1650958885, 0);
INSERT INTO `info` VALUES (2, 'cat', 'e10adc3949ba59abbe56e057f20f883e', '1234@qq.com', 0, '听音乐,玩游戏', 1652746463, 1);
INSERT INTO `info` VALUES (3, 'cat1', 'e10adc3949ba59abbe56e057f20f883e', '1234578@qq.com', 1, '听音乐,踢足球', 1652746775, 1);
INSERT INTO `info` VALUES (4, 'qwe', 'e10adc3949ba59abbe56e057f20f883e', '', 0, '听音乐', 1652746835, 0);
INSERT INTO `info` VALUES (5, 'bruh', '97993de2945a45951a4a0971d703124d', 'mimashibruh123123@qq.com', 1, '打篮球', 1000000000, 1);
INSERT INTO `info` VALUES (6, 'asd123', '4297f44b13955235245b2497399d7a93', 'asd@qq.com', 1, '玩游戏', 1719889343, 0);

SET FOREIGN_KEY_CHECKS = 1;
