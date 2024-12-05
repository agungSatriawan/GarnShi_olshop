/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : sarikusuma

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 03/12/2023 11:34:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_user
-- ----------------------------
DROP TABLE IF EXISTS `data_user`;
CREATE TABLE `data_user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `nama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `whatsapp` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `agama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `provinsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `negara` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_user
-- ----------------------------
INSERT INTO `data_user` VALUES (1, 0, 'agus', 'agus1010@gmail.com', '81388227', '1990-02-21', 'Islam', 'p', 'Kalibata', 'Jakarta Selatan', 'DKI Jakarta', 'Indonesia', '2023-12-02 20:34:39');
INSERT INTO `data_user` VALUES (8, 0, 'vinna', 'vinna1010@gmail.com', '2147483647', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-10-16 00:00:00');
INSERT INTO `data_user` VALUES (11, 10, 'Tes', 'hahahahah123@gmail.c', '66787878', '1994-01-11', 'Islam', 'p', 'kalibata utara II', 'Jakarta Selatan', 'DKI Jakarta', 'Indonesia', '2023-12-02 20:35:50');

-- ----------------------------
-- Table structure for hubungisaya
-- ----------------------------
DROP TABLE IF EXISTS `hubungisaya`;
CREATE TABLE `hubungisaya`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pesan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hubungisaya
-- ----------------------------
INSERT INTO `hubungisaya` VALUES (1, '', '', '');
INSERT INTO `hubungisaya` VALUES (2, '', '', '');
INSERT INTO `hubungisaya` VALUES (3, 'jajaja', '', 'nanananan');
INSERT INTO `hubungisaya` VALUES (4, '', '', '');

-- ----------------------------
-- Table structure for layanan
-- ----------------------------
DROP TABLE IF EXISTS `layanan`;
CREATE TABLE `layanan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `layanan` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jam` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of layanan
-- ----------------------------
INSERT INTO `layanan` VALUES (3, 7, 'periksa mata', '', '', 0);

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` int NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of login
-- ----------------------------
INSERT INTO `login` VALUES (1, 'akram', 12345678, 1);
INSERT INTO `login` VALUES (2, 'dani', 12345678, 2);
INSERT INTO `login` VALUES (3, 'nana', 12345, 2);
INSERT INTO `login` VALUES (4, 'nana@gmail.com', 12345, 2);
INSERT INTO `login` VALUES (5, 'vinna1010@gmail.com', 0, 2);
INSERT INTO `login` VALUES (6, 'adit1010@gmail.com', 12345678, 2);
INSERT INTO `login` VALUES (7, 'alu11@gmail.com', 12345678, 2);
INSERT INTO `login` VALUES (8, 'maulana66@gmail.com', 123, 2);
INSERT INTO `login` VALUES (9, 'maulana123@gmail.com', 123, 2);
INSERT INTO `login` VALUES (10, 'hahahahah123@gmail.com', 123, 2);
INSERT INTO `login` VALUES (11, 'hahahahah123@gmail.com', 123, 2);
INSERT INTO `login` VALUES (12, 'hahahahah123@gmail.com', 123, 2);
INSERT INTO `login` VALUES (13, 'hahahahah123@gmail.com', 123, 2);
INSERT INTO `login` VALUES (14, 'hahahahah123@gmail.com', 123, 2);

SET FOREIGN_KEY_CHECKS = 1;
