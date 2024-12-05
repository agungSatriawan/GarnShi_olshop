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

 Date: 18/02/2024 02:31:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_admin
-- ----------------------------
DROP TABLE IF EXISTS `data_admin`;
CREATE TABLE `data_admin`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_terapis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `spesialis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_admin
-- ----------------------------
INSERT INTO `data_admin` VALUES (1, '', 'dr. DWI RATNA SARI HANDAYANI STr.Kes,MKK,MSi ', 'Ahli Spesialis Terapi', ' Pemilik', NULL, '2023-12-26 22:37:15');
INSERT INTO `data_admin` VALUES (2, '2', 'JENG JULIE', 'Spesialis Mata', 'Pengelola/Terapis', NULL, '2023-12-26 22:36:42');
INSERT INTO `data_admin` VALUES (3, '1', 'LUKMAN HAKIM', 'Spesialis Mata', 'Marketing/Terapis', NULL, '2023-12-26 22:37:44');

-- ----------------------------
-- Table structure for data_obat
-- ----------------------------
DROP TABLE IF EXISTS `data_obat`;
CREATE TABLE `data_obat`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_obat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_created` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_modified` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_obat
-- ----------------------------
INSERT INTO `data_obat` VALUES (2, NULL, 'Billberry', '35000', NULL, NULL, NULL);
INSERT INTO `data_obat` VALUES (3, NULL, 'Madu mata', '65000', NULL, NULL, NULL);
INSERT INTO `data_obat` VALUES (6, NULL, 'madu penambah darah', '75000', NULL, NULL, NULL);
INSERT INTO `data_obat` VALUES (7, NULL, 'Habbatussauda kapsul', '65000', NULL, NULL, NULL);
INSERT INTO `data_obat` VALUES (8, NULL, 'Habbatussauda cair', '65000', NULL, NULL, NULL);
INSERT INTO `data_obat` VALUES (9, NULL, 'Utsu', '1800000', NULL, NULL, NULL);
INSERT INTO `data_obat` VALUES (10, NULL, 'tsubarashi', '1800000', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for data_user
-- ----------------------------
DROP TABLE IF EXISTS `data_user`;
CREATE TABLE `data_user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `nama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_ktp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `whatsapp` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `agama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `provinsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `negara` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `active` int NULL DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_user
-- ----------------------------
INSERT INTO `data_user` VALUES (1, 0, 'Budi', '123456789', 'budi@mail.com', '08123456789', '2002-01-03', 'islam', 'p', 'bogor', 'Bogor', 'jawa barat', 'Indonesia', 1, '2024-02-17 22:33:45');
INSERT INTO `data_user` VALUES (2, 0, 'Adi', '987456321', 'adi@mail.com', '08987456321', '1999-03-11', 'katholik', 'p', 'menteng ', 'Jakarta Pusat', 'DKI Jakarta', 'Indonesia', 1, '2024-02-17 22:33:52');

-- ----------------------------
-- Table structure for email_setting
-- ----------------------------
DROP TABLE IF EXISTS `email_setting`;
CREATE TABLE `email_setting`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_pengirim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `smtp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `port` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `smtp_secure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of email_setting
-- ----------------------------
INSERT INTO `email_setting` VALUES (1, 'admloginsystem@gmail.com', 'hqnw sbgd oeyn jhbl', 'Admin Sarikusuma', 'smtp.gmail.com', '587', 'tls');

-- ----------------------------
-- Table structure for history_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `history_transaksi`;
CREATE TABLE `history_transaksi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_reservasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `metode_pembayaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nominal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of history_transaksi
-- ----------------------------
INSERT INTO `history_transaksi` VALUES (1, '1', 'Cash', '400000', '2024-02-17 21:13:01', NULL);
INSERT INTO `history_transaksi` VALUES (2, '2', 'Cash', '350000', '2024-02-17 21:14:45', NULL);
INSERT INTO `history_transaksi` VALUES (3, '3', 'Cash', '320000', '2024-02-17 21:16:11', NULL);
INSERT INTO `history_transaksi` VALUES (4, '4', 'Cash', '2100000', '2024-02-17 21:19:24', NULL);
INSERT INTO `history_transaksi` VALUES (5, '5', 'Dana', '315000', '2024-02-17 21:21:20', NULL);
INSERT INTO `history_transaksi` VALUES (6, '6', 'OVO', '315000', '2024-02-17 22:53:06', NULL);

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
  `layanan` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of layanan
-- ----------------------------
INSERT INTO `layanan` VALUES (1, 'Terapi Mata', '250000', 1, NULL, '2023-12-25 23:40:20');

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` int NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of login
-- ----------------------------
INSERT INTO `login` VALUES (1, 'admin', 'agungsatriawan21@gmail.com', 0, 1);
INSERT INTO `login` VALUES (2, 'terapis', NULL, 123, 2);

-- ----------------------------
-- Table structure for nota
-- ----------------------------
DROP TABLE IF EXISTS `nota`;
CREATE TABLE `nota`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_reservasi` int NULL DEFAULT NULL,
  `metode_pembayaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_pembayaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nota
-- ----------------------------
INSERT INTO `nota` VALUES (1, 1, 'Cash', '1', '2024-02-17 21:13:01', NULL);
INSERT INTO `nota` VALUES (2, 2, 'Cash', '1', '2024-02-17 21:14:45', NULL);
INSERT INTO `nota` VALUES (3, 3, 'Cash', '1', '2024-02-17 21:16:11', NULL);
INSERT INTO `nota` VALUES (4, 4, 'Cash', '1', '2024-02-17 21:19:24', NULL);
INSERT INTO `nota` VALUES (5, 5, 'Dana', '1', '2024-02-17 21:21:20', NULL);
INSERT INTO `nota` VALUES (6, 6, 'OVO', '1', '2024-02-17 22:53:06', NULL);

-- ----------------------------
-- Table structure for rekam_medis
-- ----------------------------
DROP TABLE IF EXISTS `rekam_medis`;
CREATE TABLE `rekam_medis`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_dokter` int NOT NULL,
  `id_reservasi` int NULL DEFAULT NULL,
  `layanan` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jam` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mata_kanan_minus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `mata_kanan_plus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `mata_kiri_minus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `mata_kiri_plus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `buta_warna` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `buta_warna_parsial` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `buta_warna_total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lampu15Titik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int NOT NULL,
  `lampuTerangGelap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stikMagnet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `osilatorListrik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `snelled` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kesimpulan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `obat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_modified` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rekam_medis
-- ----------------------------
INSERT INTO `rekam_medis` VALUES (1, 1, 1, 1, 'Terapi Mata', '2024-02-17', '21:12:35pm', 'baik', 'baik', 'baik', 'baik', 'tidak', 'tidak', 'tidak', 'BAIK', 1, 'BAIK', 'BAIK', 'BAIK', 'BAIK', 'pemeriksaan sudah baik\r\n', '3', '2024-02-17 21:12:35', NULL);
INSERT INTO `rekam_medis` VALUES (2, 1, 1, 2, 'Terapi Mata', '2024-02-17', '21:14:30pm', 'baik', 'baik', 'baik', 'cukup', 'tidak', 'tidak', 'tidak', 'cukup', 1, 'baik', 'cukup', 'baik', 'baik', 'pemeriksaan cukup baik', '3', '2024-02-17 21:14:30', NULL);
INSERT INTO `rekam_medis` VALUES (3, 1, 1, 3, 'Terapi Mata', '2024-02-17', '21:15:53pm', 'baik', 'baik', 'baik', 'baik', 'tidak', 'tidak', 'tidak', 'baik', 1, 'baik', 'baik', 'baik', 'baik', 'pasien sudah baik', '7', '2024-02-17 21:15:53', NULL);
INSERT INTO `rekam_medis` VALUES (4, 2, 1, 4, 'Terapi Mata', '2024-02-17', '21:19:07pm', 'cukup', 'cukup', 'cukup', 'cukup', 'tidak', 'tidak', 'tidak', 'cukup', 1, 'cukup', 'cukup', 'cukup', 'cukup', 'cukup', '9', '2024-02-17 21:19:07', NULL);
INSERT INTO `rekam_medis` VALUES (5, 2, 1, 5, 'Terapi Mata', '2024-02-17', '21:20:23pm', 'baik', 'baik', 'baik', 'baik', 'tidak', 'tidak', 'tidak', 'baik', 1, 'baik', 'baik', 'baik', 'baik', 'sudah cukup baik', '7', '2024-02-17 21:20:23', NULL);
INSERT INTO `rekam_medis` VALUES (6, 1, 1, 6, 'Terapi Mata', '2024-02-17', '22:52:49pm', 'Bagus', 'Bagus', 'Bagus', 'Bagus', 'tidak', 'tidak', 'tidak', 'Bagus', 1, 'Bagus', 'Bagus', 'Bagus', 'Bagus', 'Pemeriksan Sempurna', '3', '2024-02-17 22:52:49', NULL);

-- ----------------------------
-- Table structure for resep
-- ----------------------------
DROP TABLE IF EXISTS `resep`;
CREATE TABLE `resep`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_reservasi` int NULL DEFAULT NULL,
  `id_vitamin` int NULL DEFAULT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of resep
-- ----------------------------
INSERT INTO `resep` VALUES (1, 1, 3, '2024-02-17 21:12:34', NULL);
INSERT INTO `resep` VALUES (2, 2, 3, '2024-02-17 21:14:29', NULL);
INSERT INTO `resep` VALUES (3, 3, 7, '2024-02-17 21:15:53', NULL);
INSERT INTO `resep` VALUES (4, 4, 9, '2024-02-17 21:19:07', NULL);
INSERT INTO `resep` VALUES (5, 5, 7, '2024-02-17 21:20:22', NULL);
INSERT INTO `resep` VALUES (6, 6, 3, '2024-02-17 22:52:49', NULL);

-- ----------------------------
-- Table structure for reservasi
-- ----------------------------
DROP TABLE IF EXISTS `reservasi`;
CREATE TABLE `reservasi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_terapi` date NULL DEFAULT NULL,
  `id_layanan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `date_created` datetime NULL DEFAULT NULL,
  `date_modified` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reservasi
-- ----------------------------
INSERT INTO `reservasi` VALUES (1, '1', '2024-02-11', '1', 1, '2024-02-17 21:11:29', NULL);
INSERT INTO `reservasi` VALUES (2, '1', '2024-02-13', '1', 1, '2024-02-17 21:13:32', NULL);
INSERT INTO `reservasi` VALUES (3, '1', '2024-02-16', '1', 1, '2024-02-17 21:15:00', NULL);
INSERT INTO `reservasi` VALUES (4, '2', '2024-02-04', '1', 1, '2024-02-17 21:18:16', NULL);
INSERT INTO `reservasi` VALUES (5, '2', '2024-02-11', '1', 1, '2024-02-17 21:19:41', NULL);
INSERT INTO `reservasi` VALUES (6, '1', '2024-02-17', '1', 1, '2024-02-17 22:52:04', NULL);

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `date_created` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES (21, 'agungsatriawan21@gmail.com', 'iNzO4TZoaSIpHoBcjVU8T8pNxNpYzTnA6z+z+UnPSro=', 1708197144);
INSERT INTO `token` VALUES (22, 'agungsatriawan21@gmail.com', 'mPwY4gidjP8u0YkwqkOK1zdrY8KGBWoxhw4UHVc8lT8=', 1708197626);
INSERT INTO `token` VALUES (23, 'agungsatriawan21@gmail.com', 'pYljGb2dPr8OPKJ/Pw9njOTV2ty3G0rRyAV2PWf242E=', 1708197759);
INSERT INTO `token` VALUES (24, 'agungsatriawan21@gmail.com', 'PqNfG6aP6wd7GUjLLM9p91QFWlHtv0dOmk8E1l1xe7I=', 1708197808);
INSERT INTO `token` VALUES (25, 'agungsatriawan21@gmail.com', 'mqrSX28VW73uANuuepdFowyQ9FRpZ4VO2I8c7IDUDgo=', 1708198025);
INSERT INTO `token` VALUES (26, 'agungsatriawan21@gmail.com', '/6nuwpJpBO724wNAG0SJC74L59im0ZZ/+visaCn31hk=', 1708198093);
INSERT INTO `token` VALUES (27, 'agungsatriawan21@gmail.com', 'Jfec88Klz6SCCuLz0x9C8ttevsID6yLqnp2+JIvQSvs=', 1708198137);

SET FOREIGN_KEY_CHECKS = 1;
