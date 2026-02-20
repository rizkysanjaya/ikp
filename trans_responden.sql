/*
 Navicat Premium Dump SQL

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80403 (8.4.3)
 Source Host           : localhost:3306
 Source Schema         : ikp_bkn

 Target Server Type    : MySQL
 Target Server Version : 80403 (8.4.3)
 File Encoding         : 65001

 Date: 20/02/2026 09:55:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for trans_responden
-- ----------------------------
DROP TABLE IF EXISTS `trans_responden`;
CREATE TABLE `trans_responden`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_survei` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  `jenis_layanan_id` int NOT NULL,
  `instansi_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `pendidikan_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pekerjaan_id` int NOT NULL,
  `umur` int NOT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `saran_masukan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jenis_layanan_id`(`jenis_layanan_id` ASC) USING BTREE,
  INDEX `instansi_id`(`instansi_id` ASC) USING BTREE,
  INDEX `pendidikan_id`(`pendidikan_id` ASC) USING BTREE,
  INDEX `pekerjaan_id`(`pekerjaan_id` ASC) USING BTREE,
  CONSTRAINT `trans_responden_ibfk_1` FOREIGN KEY (`jenis_layanan_id`) REFERENCES `ref_jenis_layanan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `trans_responden_ibfk_2` FOREIGN KEY (`instansi_id`) REFERENCES `ref_instansi` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `trans_responden_ibfk_3` FOREIGN KEY (`pendidikan_id`) REFERENCES `ref_pendidikan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `trans_responden_ibfk_4` FOREIGN KEY (`pekerjaan_id`) REFERENCES `ref_pekerjaan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 313 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trans_responden
-- ----------------------------
INSERT INTO `trans_responden` VALUES (1, 'Fitri Wijaya', '2025-12-19 14:43:15', 6, '5502', 'kp-006', 5, 37, 'L', NULL);
INSERT INTO `trans_responden` VALUES (2, 'Gita Rahmawati', '2025-12-15 10:07:28', 1, '6428', 'kp-001', 3, 45, 'P', NULL);
INSERT INTO `trans_responden` VALUES (3, 'Dian Wibowo', '2025-12-05 15:10:00', 3, '5210', 'kp-001', 6, 30, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (4, 'Eka Wibowo', '2025-11-28 10:54:24', 6, '6416', 'kp-001', 1, 33, 'L', NULL);
INSERT INTO `trans_responden` VALUES (5, 'Fitri Handayani', '2026-01-08 14:42:44', 3, '6109', 'kp-002', 1, 29, 'P', NULL);
INSERT INTO `trans_responden` VALUES (6, 'Budi Pratama', '2026-01-01 13:12:41', 2, '6371', 'kp-002', 2, 50, 'L', NULL);
INSERT INTO `trans_responden` VALUES (7, 'Dian Nugroho', '2026-01-07 10:10:25', 5, '6573', 'kp-005', 1, 31, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (8, 'Eka Wibowo', '2025-12-30 15:21:33', 2, '6526', 'kp-007', 4, 26, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (9, 'Dian Kusuma', '2026-01-01 09:15:53', 5, '5208', 'kp-004', 2, 34, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (10, 'Agus Saputra', '2025-12-08 09:15:13', 5, '8033', 'kp-005', 2, 55, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (11, 'Agus Susanti', '2025-12-15 10:46:46', 4, '5910', 'kp-004', 5, 33, 'L', NULL);
INSERT INTO `trans_responden` VALUES (12, 'Agus Lestari', '2026-01-02 12:57:23', 4, '306', 'kp-001', 3, 48, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (13, 'Indra Handayani', '2025-12-05 12:23:18', 3, '6474', 'kp-006', 3, 33, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (14, 'Citra Saputra', '2026-01-01 12:30:11', 2, '6271', 'kp-008', 2, 39, 'L', NULL);
INSERT INTO `trans_responden` VALUES (15, 'Citra Wijaya', '2026-01-09 12:51:42', 5, '7412', 'kp-003', 6, 37, 'P', NULL);
INSERT INTO `trans_responden` VALUES (16, 'Fitri Wibowo', '2025-12-19 08:18:00', 3, '4049', 'kp-002', 6, 25, 'P', NULL);
INSERT INTO `trans_responden` VALUES (17, 'Dian Kusuma', '2025-11-28 09:12:44', 4, '6512', 'kp-008', 5, 27, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (18, 'Fitri Handayani', '2025-12-10 09:42:59', 5, '5304', 'kp-003', 1, 35, 'P', 'Proses terlalu lama.');
INSERT INTO `trans_responden` VALUES (19, 'Dian Wijaya', '2026-01-23 08:55:47', 3, '400', 'kp-003', 3, 54, 'L', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (20, 'Citra Kusuma', '2026-01-23 14:19:18', 5, '6904', 'kp-005', 4, 53, 'L', NULL);
INSERT INTO `trans_responden` VALUES (21, 'Indra Susanti', '2025-12-04 09:00:49', 1, '6706', 'kp-005', 1, 43, 'P', NULL);
INSERT INTO `trans_responden` VALUES (22, 'Indra Handayani', '2026-01-09 10:48:19', 1, '5606', 'kp-005', 1, 48, 'L', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (23, 'Eka Nugroho', '2026-01-23 13:11:32', 1, '5405', 'kp-006', 3, 49, 'P', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (24, 'Fitri Wibowo', '2025-11-28 08:15:26', 5, '5276', 'kp-004', 1, 53, 'L', 'Sistem sering down.');
INSERT INTO `trans_responden` VALUES (25, 'Dian Kusuma', '2026-01-22 12:07:21', 4, '7209', 'kp-002', 5, 45, 'P', NULL);
INSERT INTO `trans_responden` VALUES (26, 'Indra Wijaya', '2025-12-25 13:10:30', 3, '4035', 'kp-005', 6, 56, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (27, 'Joko Susanti', '2026-01-23 15:27:26', 3, '6806', 'kp-001', 4, 31, 'L', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (28, 'Eka Handayani', '2025-12-03 10:38:18', 1, '5605', 'kp-001', 1, 40, 'P', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (29, 'Fitri Wijaya', '2025-12-12 12:47:00', 6, '7971', 'kp-005', 6, 50, 'P', NULL);
INSERT INTO `trans_responden` VALUES (30, 'Indra Lestari', '2025-12-03 14:46:37', 4, '5509', 'kp-009', 5, 47, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (31, 'Fitri Handayani', '2025-12-23 11:59:16', 4, '7412', 'kp-002', 3, 28, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (32, 'Agus Wibowo', '2025-12-16 13:37:28', 5, '6502', 'kp-003', 2, 48, 'P', 'Petugas kurang ramah.');
INSERT INTO `trans_responden` VALUES (33, 'Citra Nugroho', '2026-01-09 13:58:52', 5, '7406', 'kp-006', 2, 33, 'L', 'Petugas kurang ramah.');
INSERT INTO `trans_responden` VALUES (34, 'Citra Rahmawati', '2025-12-08 14:02:29', 4, '5508', 'kp-008', 1, 25, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (35, 'Indra Susanti', '2025-11-28 15:14:55', 3, '6508', 'kp-006', 2, 36, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (36, 'Joko Saputra', '2026-01-09 11:47:49', 2, '6575', 'kp-002', 3, 36, 'L', NULL);
INSERT INTO `trans_responden` VALUES (37, 'Indra Kusuma', '2026-01-09 14:50:15', 5, '4018', 'kp-001', 6, 29, 'L', NULL);
INSERT INTO `trans_responden` VALUES (38, 'Budi Lestari', '2026-01-19 09:04:01', 5, '7208', 'kp-001', 5, 51, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (39, 'Budi Rahmawati', '2025-12-08 10:22:52', 4, '5603', 'kp-001', 6, 38, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (40, 'Hadi Pratama', '2025-12-25 09:12:32', 1, '7714', 'kp-006', 2, 49, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (41, 'Gita Handayani', '2026-01-02 10:50:14', 6, '6271', 'kp-005', 6, 54, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (42, 'Eka Pratama', '2025-12-05 15:15:47', 2, '6871', 'kp-009', 4, 43, 'L', 'Proses terlalu lama.');
INSERT INTO `trans_responden` VALUES (43, 'Fitri Pratama', '2026-01-15 10:51:41', 6, '6574', 'kp-005', 6, 49, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (44, 'Budi Susanti', '2025-12-11 08:00:31', 5, '5504', 'kp-008', 1, 39, 'L', NULL);
INSERT INTO `trans_responden` VALUES (45, 'Budi Susanti', '2026-01-06 11:54:52', 4, '4035', 'kp-002', 3, 37, 'L', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (46, 'Indra Lestari', '2025-11-27 10:03:36', 5, '4006', 'kp-006', 5, 50, 'L', NULL);
INSERT INTO `trans_responden` VALUES (47, 'Dian Nugroho', '2026-01-09 11:19:57', 3, '4006', 'kp-005', 2, 52, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (48, 'Joko Rahmawati', '2025-12-09 12:16:19', 3, '7705', 'kp-004', 2, 36, 'P', NULL);
INSERT INTO `trans_responden` VALUES (49, 'Agus Lestari', '2025-11-28 14:09:03', 1, '6303', 'kp-008', 1, 28, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (50, 'Dian Lestari', '2025-12-03 12:35:30', 4, '5475', 'kp-009', 4, 33, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (51, 'Dian Lestari', '2026-01-23 09:08:22', 2, '7801', 'kp-003', 2, 43, 'L', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (52, 'Eka Pratama', '2026-01-08 09:20:36', 1, '7672', 'kp-001', 3, 43, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (53, 'Gita Lestari', '2025-12-05 11:17:35', 4, '5909', 'kp-005', 1, 50, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (54, 'Fitri Susanti', '2025-12-19 12:41:35', 1, '7715', 'kp-008', 3, 37, 'P', NULL);
INSERT INTO `trans_responden` VALUES (55, 'Indra Wibowo', '2025-11-28 14:27:14', 4, '7872', 'kp-005', 5, 26, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (56, 'Budi Handayani', '2026-01-06 09:07:33', 4, '5302', 'kp-009', 3, 39, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (57, 'Indra Handayani', '2025-11-28 13:24:42', 6, '302', 'kp-003', 4, 57, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (58, 'Fitri Lestari', '2025-12-09 14:57:09', 3, '5502', 'kp-007', 2, 51, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (59, 'Joko Handayani', '2025-12-19 15:03:50', 4, '6529', 'kp-001', 1, 51, 'L', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (60, 'Budi Nugroho', '2025-11-27 13:30:48', 2, '6001', 'kp-002', 5, 31, 'L', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (61, 'Citra Susanti', '2025-12-26 10:19:13', 1, '6405', 'kp-003', 1, 33, 'L', 'Sistem sering down.');
INSERT INTO `trans_responden` VALUES (62, 'Fitri Handayani', '2026-01-23 15:20:58', 2, '6713', 'kp-004', 4, 32, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (63, 'Eka Wibowo', '2026-01-12 15:22:16', 3, '7007', 'kp-006', 3, 26, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (64, 'Agus Susanti', '2025-12-02 15:00:40', 2, '5373', 'kp-009', 1, 54, 'L', 'Mohon kejelasan status.');
INSERT INTO `trans_responden` VALUES (65, 'Agus Susanti', '2026-01-16 14:47:31', 3, '7871', 'kp-005', 5, 38, 'P', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (66, 'Agus Nugroho', '2025-12-15 08:28:15', 2, '6471', 'kp-004', 2, 44, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (67, 'Indra Susanti', '2025-12-19 08:02:46', 6, '4019', 'kp-008', 6, 39, 'P', NULL);
INSERT INTO `trans_responden` VALUES (68, 'Joko Lestari', '2025-12-31 10:56:44', 5, '7710', 'kp-002', 5, 43, 'P', NULL);
INSERT INTO `trans_responden` VALUES (69, 'Indra Pratama', '2025-12-30 08:19:37', 5, '6513', 'kp-008', 5, 29, 'L', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (70, 'Budi Pratama', '2026-01-23 15:17:17', 4, '5610', 'kp-007', 3, 51, 'P', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (71, 'Budi Kusuma', '2025-11-28 12:07:21', 2, '7604', 'kp-007', 3, 56, 'L', NULL);
INSERT INTO `trans_responden` VALUES (72, 'Dian Rahmawati', '2025-12-23 13:06:24', 3, '5909', 'kp-001', 3, 40, 'P', NULL);
INSERT INTO `trans_responden` VALUES (73, 'Citra Saputra', '2025-12-23 08:22:00', 3, '8203', 'kp-004', 1, 27, 'L', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (74, 'Dian Wibowo', '2026-01-01 13:55:41', 5, '7710', 'kp-009', 2, 43, 'P', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (75, 'Eka Kusuma', '2026-01-08 14:06:50', 5, '4067', 'kp-002', 1, 52, 'L', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (76, 'Gita Susanti', '2026-01-05 12:26:47', 4, '6503', 'kp-008', 1, 42, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (77, 'Citra Handayani', '2025-12-26 10:52:41', 4, '8400', 'kp-008', 5, 51, 'P', NULL);
INSERT INTO `trans_responden` VALUES (78, 'Eka Nugroho', '2025-12-12 09:01:45', 5, '7073', 'kp-005', 5, 48, 'P', NULL);
INSERT INTO `trans_responden` VALUES (79, 'Citra Wibowo', '2025-12-05 08:40:00', 4, '7204', 'kp-008', 1, 30, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (80, 'Hadi Rahmawati', '2025-12-03 08:00:08', 4, '6601', 'kp-002', 4, 39, 'L', NULL);
INSERT INTO `trans_responden` VALUES (81, 'Joko Saputra', '2025-12-31 09:07:23', 6, '7313', 'kp-009', 1, 53, 'P', NULL);
INSERT INTO `trans_responden` VALUES (82, 'Budi Rahmawati', '2026-01-09 10:04:54', 2, '6416', 'kp-007', 5, 41, 'P', NULL);
INSERT INTO `trans_responden` VALUES (83, 'Agus Saputra', '2026-01-02 12:09:36', 6, '7710', 'kp-005', 6, 30, 'P', NULL);
INSERT INTO `trans_responden` VALUES (84, 'Eka Wijaya', '2025-12-17 10:00:17', 6, '7718', 'kp-006', 4, 32, 'P', 'Persyaratan berbelit.');
INSERT INTO `trans_responden` VALUES (85, 'Agus Wibowo', '2026-01-02 11:45:19', 6, '6703', 'kp-008', 3, 44, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (86, 'Budi Lestari', '2026-01-15 09:20:53', 5, '6871', 'kp-008', 5, 56, 'L', 'Persyaratan berbelit.');
INSERT INTO `trans_responden` VALUES (87, 'Joko Handayani', '2025-12-03 13:40:03', 1, '5900', 'kp-005', 1, 31, 'L', NULL);
INSERT INTO `trans_responden` VALUES (88, 'Agus Kusuma', '2026-01-02 11:37:39', 6, '7373', 'kp-005', 1, 42, 'P', NULL);
INSERT INTO `trans_responden` VALUES (89, 'Joko Wibowo', '2025-12-22 14:11:03', 5, '6428', 'kp-002', 3, 45, 'L', NULL);
INSERT INTO `trans_responden` VALUES (90, 'Dian Susanti', '2025-11-27 15:01:18', 5, '6420', 'kp-004', 3, 37, 'L', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (91, 'Eka Nugroho', '2026-01-09 11:46:44', 5, '5224', 'kp-006', 5, 26, 'P', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (92, 'Joko Susanti', '2025-12-01 10:02:03', 2, '5610', 'kp-001', 2, 55, 'L', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (93, 'Hadi Pratama', '2025-12-26 12:51:16', 6, '5673', 'kp-006', 1, 32, 'P', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (94, 'Fitri Rahmawati', '2026-01-02 14:34:05', 5, '5409', 'kp-008', 4, 44, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (95, 'Dian Pratama', '2025-12-12 12:47:59', 1, '4050', 'kp-005', 2, 29, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (96, 'Indra Pratama', '2025-12-24 14:55:54', 2, '8210', 'kp-002', 6, 32, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (97, 'Eka Pratama', '2026-01-06 10:43:23', 2, '6408', 'kp-007', 4, 42, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (98, 'Joko Handayani', '2026-01-08 13:15:52', 3, '7318', 'kp-005', 2, 44, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (99, 'Hadi Wijaya', '2025-12-10 15:01:33', 2, '3008', 'kp-002', 6, 32, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (100, 'Budi Handayani', '2025-12-31 13:47:10', 4, '5273', 'kp-004', 3, 29, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (101, 'Indra Wijaya', '2025-12-29 11:16:27', 6, '6407', 'kp-008', 4, 34, 'P', NULL);
INSERT INTO `trans_responden` VALUES (102, 'Hadi Nugroho', '2026-01-22 15:09:44', 6, '4045', 'kp-004', 4, 40, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (103, 'Gita Wibowo', '2025-12-31 09:50:23', 6, '6201', 'kp-007', 6, 51, 'L', NULL);
INSERT INTO `trans_responden` VALUES (104, 'Fitri Lestari', '2026-01-12 14:08:40', 4, '3003', 'kp-009', 2, 25, 'L', NULL);
INSERT INTO `trans_responden` VALUES (105, 'Fitri Saputra', '2026-01-05 12:58:02', 4, '5313', 'kp-003', 6, 48, 'P', NULL);
INSERT INTO `trans_responden` VALUES (106, 'Joko Saputra', '2025-12-26 14:08:45', 5, '4057', 'kp-003', 4, 35, 'P', NULL);
INSERT INTO `trans_responden` VALUES (107, 'Eka Lestari', '2025-12-26 15:20:40', 3, '5202', 'kp-004', 6, 25, 'P', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (108, 'Citra Susanti', '2025-12-12 10:04:16', 4, '7602', 'kp-005', 6, 56, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (109, 'Hadi Kusuma', '2026-01-16 11:21:42', 3, '4016', 'kp-003', 5, 35, 'L', NULL);
INSERT INTO `trans_responden` VALUES (110, 'Hadi Wijaya', '2025-12-25 09:18:31', 2, '4051', 'kp-007', 6, 25, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (111, 'Indra Saputra', '2026-01-01 08:08:46', 2, '8206', 'kp-005', 6, 51, 'P', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (112, 'Dian Wibowo', '2025-12-05 09:47:13', 4, '7103', 'kp-001', 1, 53, 'L', NULL);
INSERT INTO `trans_responden` VALUES (113, 'Eka Kusuma', '2025-12-15 10:36:03', 3, '5118', 'kp-008', 2, 30, 'P', NULL);
INSERT INTO `trans_responden` VALUES (114, 'Budi Pratama', '2025-12-17 09:29:31', 1, '4053', 'kp-006', 5, 38, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (115, 'Indra Nugroho', '2026-01-06 10:16:00', 5, '2060', 'kp-002', 6, 31, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (116, 'Eka Pratama', '2025-12-12 11:53:14', 6, '6503', 'kp-006', 1, 44, 'L', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (117, 'Gita Susanti', '2025-12-19 08:31:44', 5, '3004', 'kp-003', 3, 33, 'L', NULL);
INSERT INTO `trans_responden` VALUES (118, 'Citra Rahmawati', '2025-12-02 11:34:14', 5, '8171', 'kp-007', 6, 34, 'P', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (119, 'Budi Rahmawati', '2025-12-16 12:14:17', 3, '7872', 'kp-005', 4, 56, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (120, 'Citra Susanti', '2026-01-09 15:14:56', 6, '4047', 'kp-003', 1, 45, 'L', NULL);
INSERT INTO `trans_responden` VALUES (121, 'Budi Susanti', '2025-12-15 12:35:14', 2, '7805', 'kp-003', 3, 43, 'P', NULL);
INSERT INTO `trans_responden` VALUES (122, 'Gita Saputra', '2026-01-09 12:45:56', 6, '5306', 'kp-002', 4, 29, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (123, 'Gita Handayani', '2026-01-22 12:11:05', 6, '4052', 'kp-001', 2, 55, 'P', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (124, 'Dian Saputra', '2026-01-23 08:44:12', 5, '7721', 'kp-006', 4, 25, 'P', NULL);
INSERT INTO `trans_responden` VALUES (125, 'Indra Nugroho', '2025-12-08 11:02:34', 4, '7326', 'kp-001', 3, 26, 'P', NULL);
INSERT INTO `trans_responden` VALUES (126, 'Agus Handayani', '2025-12-05 14:54:03', 1, '5408', 'kp-004', 6, 33, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (127, 'Citra Pratama', '2025-11-27 14:56:16', 4, '5205', 'kp-008', 3, 41, 'L', NULL);
INSERT INTO `trans_responden` VALUES (128, 'Hadi Rahmawati', '2025-12-23 09:42:54', 3, '6518', 'kp-007', 4, 52, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (129, 'Budi Susanti', '2025-12-12 12:51:49', 1, '6422', 'kp-005', 6, 50, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (130, 'Joko Nugroho', '2025-12-15 10:26:32', 3, '8035', 'kp-002', 3, 34, 'P', NULL);
INSERT INTO `trans_responden` VALUES (131, 'Indra Lestari', '2025-12-19 14:22:31', 5, '8008', 'kp-007', 1, 29, 'P', NULL);
INSERT INTO `trans_responden` VALUES (132, 'Eka Rahmawati', '2025-12-10 09:30:33', 5, '6701', 'kp-007', 5, 32, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (133, 'Joko Handayani', '2025-12-03 09:44:25', 4, '7303', 'kp-005', 6, 52, 'L', NULL);
INSERT INTO `trans_responden` VALUES (134, 'Indra Pratama', '2026-01-02 11:39:16', 2, '1010', 'kp-005', 5, 41, 'P', NULL);
INSERT INTO `trans_responden` VALUES (135, 'Gita Rahmawati', '2026-01-15 09:10:41', 1, '8033', 'kp-006', 1, 30, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (136, 'Agus Pratama', '2025-12-09 10:23:50', 5, '6703', 'kp-007', 5, 50, 'L', NULL);
INSERT INTO `trans_responden` VALUES (137, 'Agus Rahmawati', '2026-01-06 08:14:51', 3, '7402', 'kp-004', 6, 50, 'P', NULL);
INSERT INTO `trans_responden` VALUES (138, 'Indra Wibowo', '2026-01-08 13:36:18', 2, '8020', 'kp-001', 1, 26, 'L', NULL);
INSERT INTO `trans_responden` VALUES (139, 'Dian Kusuma', '2025-12-23 11:09:05', 1, '6114', 'kp-002', 5, 46, 'L', 'Mohon kejelasan status.');
INSERT INTO `trans_responden` VALUES (140, 'Gita Wijaya', '2025-12-05 08:56:55', 4, '8271', 'kp-006', 2, 39, 'L', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (141, 'Budi Handayani', '2026-01-13 08:54:05', 3, '3014', 'kp-007', 1, 45, 'P', NULL);
INSERT INTO `trans_responden` VALUES (142, 'Eka Wibowo', '2026-01-02 12:29:56', 5, '7901', 'kp-008', 1, 42, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (143, 'Agus Nugroho', '2026-01-16 11:44:39', 1, '7307', 'kp-006', 1, 26, 'L', NULL);
INSERT INTO `trans_responden` VALUES (144, 'Budi Saputra', '2025-12-05 09:49:44', 4, '6114', 'kp-007', 5, 34, 'L', NULL);
INSERT INTO `trans_responden` VALUES (145, 'Citra Saputra', '2026-01-02 15:29:19', 2, '6413', 'kp-002', 4, 55, 'L', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (146, 'Budi Wijaya', '2025-12-17 11:19:26', 3, '6510', 'kp-007', 2, 51, 'P', NULL);
INSERT INTO `trans_responden` VALUES (147, 'Budi Kusuma', '2026-01-09 14:39:28', 3, '8830', 'kp-008', 6, 57, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (148, 'Joko Susanti', '2026-01-09 08:13:15', 3, '7902', 'kp-009', 3, 47, 'P', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (149, 'Indra Susanti', '2025-12-19 11:38:47', 2, '6106', 'kp-005', 2, 39, 'L', NULL);
INSERT INTO `trans_responden` VALUES (150, 'Citra Kusuma', '2025-12-05 13:37:30', 1, '5210', 'kp-009', 4, 32, 'P', NULL);
INSERT INTO `trans_responden` VALUES (151, 'Hadi Wibowo', '2025-12-19 08:46:41', 6, '6415', 'kp-001', 1, 39, 'P', NULL);
INSERT INTO `trans_responden` VALUES (152, 'Budi Lestari', '2026-01-01 08:42:25', 1, '8026', 'kp-009', 6, 56, 'L', NULL);
INSERT INTO `trans_responden` VALUES (153, 'Fitri Susanti', '2025-11-28 12:48:42', 6, '5808', 'kp-006', 6, 25, 'P', NULL);
INSERT INTO `trans_responden` VALUES (154, 'Joko Pratama', '2026-01-02 13:35:16', 5, '304', 'kp-001', 2, 30, 'L', NULL);
INSERT INTO `trans_responden` VALUES (155, 'Dian Rahmawati', '2025-11-28 13:16:01', 4, '7003', 'kp-003', 4, 53, 'P', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (156, 'Joko Wibowo', '2025-12-12 10:40:46', 6, '6419', 'kp-007', 3, 45, 'P', NULL);
INSERT INTO `trans_responden` VALUES (157, 'Hadi Saputra', '2025-12-31 09:29:38', 2, '8033', 'kp-008', 1, 34, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (158, 'Agus Wijaya', '2025-12-11 10:08:38', 3, '7008', 'kp-004', 2, 50, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (159, 'Indra Handayani', '2025-12-26 14:35:30', 2, '5508', 'kp-009', 1, 44, 'L', 'Petugas kurang ramah.');
INSERT INTO `trans_responden` VALUES (160, 'Budi Lestari', '2025-12-05 14:23:13', 2, '7702', 'kp-001', 1, 30, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (161, 'Budi Susanti', '2025-12-26 11:07:06', 6, '5900', 'kp-003', 2, 56, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (162, 'Gita Wibowo', '2026-01-15 12:46:19', 6, '5408', 'kp-001', 1, 35, 'L', NULL);
INSERT INTO `trans_responden` VALUES (163, 'Dian Lestari', '2026-01-23 11:31:47', 1, '5871', 'kp-001', 4, 28, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (164, 'Gita Kusuma', '2026-01-02 15:17:53', 2, '7700', 'kp-008', 2, 31, 'L', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (165, 'Joko Susanti', '2025-12-29 09:14:34', 1, '6702', 'kp-004', 5, 40, 'L', NULL);
INSERT INTO `trans_responden` VALUES (166, 'Indra Kusuma', '2025-12-08 11:55:51', 6, '6102', 'kp-006', 2, 41, 'P', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (167, 'Joko Susanti', '2025-12-18 10:45:15', 5, '7201', 'kp-005', 1, 34, 'P', NULL);
INSERT INTO `trans_responden` VALUES (168, 'Citra Kusuma', '2025-12-12 09:59:19', 1, '5274', 'kp-008', 3, 39, 'P', NULL);
INSERT INTO `trans_responden` VALUES (169, 'Fitri Wibowo', '2025-12-15 10:52:40', 5, '7315', 'kp-007', 3, 39, 'L', NULL);
INSERT INTO `trans_responden` VALUES (170, 'Agus Nugroho', '2025-12-18 12:32:32', 1, '3015', 'kp-007', 1, 49, 'P', NULL);
INSERT INTO `trans_responden` VALUES (171, 'Agus Wijaya', '2026-01-21 11:34:33', 6, '8014', 'kp-003', 4, 33, 'P', NULL);
INSERT INTO `trans_responden` VALUES (172, 'Hadi Pratama', '2026-01-13 11:38:25', 4, '7807', 'kp-005', 4, 44, 'P', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (173, 'Citra Kusuma', '2026-01-16 09:19:54', 4, '6117', 'kp-005', 4, 35, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (174, 'Fitri Rahmawati', '2025-12-12 14:08:12', 4, '4061', 'kp-001', 4, 39, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (175, 'Joko Saputra', '2025-11-28 11:47:20', 6, '6203', 'kp-009', 3, 27, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (176, 'Budi Nugroho', '2026-01-23 13:21:18', 4, '5172', 'kp-007', 3, 40, 'L', NULL);
INSERT INTO `trans_responden` VALUES (177, 'Fitri Nugroho', '2025-12-18 15:11:06', 6, '5174', 'kp-001', 3, 32, 'P', NULL);
INSERT INTO `trans_responden` VALUES (178, 'Citra Kusuma', '2026-01-23 10:16:50', 4, '6406', 'kp-006', 2, 34, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (179, 'Fitri Rahmawati', '2026-01-21 08:00:56', 4, '4058', 'kp-001', 4, 37, 'L', NULL);
INSERT INTO `trans_responden` VALUES (180, 'Citra Nugroho', '2025-12-03 11:29:32', 4, '7715', 'kp-004', 4, 47, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (181, 'Fitri Saputra', '2025-12-19 09:00:04', 2, '3006', 'kp-004', 1, 28, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (182, 'Gita Handayani', '2025-12-19 14:36:40', 4, '6871', 'kp-007', 1, 28, 'P', NULL);
INSERT INTO `trans_responden` VALUES (183, 'Gita Nugroho', '2026-01-15 08:53:07', 1, '8011', 'kp-003', 3, 50, 'P', NULL);
INSERT INTO `trans_responden` VALUES (184, 'Gita Handayani', '2025-12-18 12:11:34', 3, '7210', 'kp-004', 5, 52, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (185, 'Fitri Saputra', '2025-12-02 13:36:10', 1, '5300', 'kp-008', 6, 46, 'P', NULL);
INSERT INTO `trans_responden` VALUES (186, 'Joko Handayani', '2025-12-23 08:55:39', 3, '8201', 'kp-004', 3, 45, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (187, 'Fitri Lestari', '2025-12-29 14:41:46', 1, '5807', 'kp-007', 1, 42, 'L', NULL);
INSERT INTO `trans_responden` VALUES (188, 'Dian Wibowo', '2025-12-15 13:45:45', 5, '6171', 'kp-003', 3, 38, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (189, 'Dian Pratama', '2026-01-16 12:34:16', 1, '3012', 'kp-008', 4, 38, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (190, 'Budi Lestari', '2025-12-24 11:22:04', 3, '6423', 'kp-001', 6, 52, 'P', NULL);
INSERT INTO `trans_responden` VALUES (191, 'Citra Lestari', '2025-12-19 08:05:32', 4, '6709', 'kp-005', 3, 50, 'P', NULL);
INSERT INTO `trans_responden` VALUES (192, 'Citra Saputra', '2025-11-28 08:00:44', 1, '4028', 'kp-001', 5, 56, 'P', NULL);
INSERT INTO `trans_responden` VALUES (193, 'Budi Saputra', '2026-01-08 15:24:45', 1, '6410', 'kp-001', 2, 40, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (194, 'Eka Wijaya', '2025-12-12 14:59:50', 2, '8172', 'kp-005', 4, 34, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (195, 'Agus Wijaya', '2025-11-28 08:25:03', 5, '7322', 'kp-007', 6, 37, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (196, 'Gita Pratama', '2026-01-01 11:39:02', 1, '4038', 'kp-007', 4, 50, 'P', NULL);
INSERT INTO `trans_responden` VALUES (197, 'Eka Susanti', '2025-11-27 08:21:25', 3, '3009', 'kp-009', 5, 35, 'L', 'dolor ipsum sit amet dolor ipsum sit amet dolor ipsum sit amet dolor ipsum sit amet dolor ipsum sit amet dolor ipsum sit amet dolor ipsum sit amet dolor ipsum sit amet dolor ipsum sit amet');
INSERT INTO `trans_responden` VALUES (198, 'Indra Nugroho', '2025-12-26 10:48:23', 6, '7103', 'kp-002', 4, 37, 'P', NULL);
INSERT INTO `trans_responden` VALUES (199, 'Dian Rahmawati', '2026-01-02 08:57:18', 3, '4045', 'kp-009', 5, 29, 'P', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (200, 'Fitri Wijaya', '2025-12-30 09:51:10', 6, '6426', 'kp-002', 4, 32, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (201, 'Joko Rahmawati', '2025-12-24 12:07:30', 5, '7507', 'kp-001', 4, 47, 'P', NULL);
INSERT INTO `trans_responden` VALUES (202, 'Indra Lestari', '2026-01-02 15:04:14', 2, '7971', 'kp-003', 3, 35, 'L', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (203, 'Joko Saputra', '2025-12-19 11:41:18', 6, '6472', 'kp-007', 1, 36, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (204, 'Citra Nugroho', '2026-01-14 10:03:59', 2, '7305', 'kp-002', 4, 40, 'L', NULL);
INSERT INTO `trans_responden` VALUES (205, 'Citra Wijaya', '2026-01-13 14:14:39', 2, '6475', 'kp-007', 3, 27, 'P', NULL);
INSERT INTO `trans_responden` VALUES (206, 'Indra Handayani', '2025-12-26 11:36:14', 4, '7013', 'kp-004', 4, 42, 'L', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (207, 'Hadi Rahmawati', '2026-01-02 13:28:50', 4, '6612', 'kp-007', 5, 49, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (208, 'Eka Wibowo', '2025-12-31 12:05:48', 3, '6603', 'kp-003', 1, 49, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (209, 'Fitri Saputra', '2026-01-16 14:32:23', 5, '6371', 'kp-001', 6, 29, 'L', NULL);
INSERT INTO `trans_responden` VALUES (210, 'Agus Rahmawati', '2025-12-12 11:12:07', 4, '8020', 'kp-008', 6, 54, 'L', NULL);
INSERT INTO `trans_responden` VALUES (211, 'Eka Pratama', '2026-01-22 09:39:32', 2, '6672', 'kp-002', 6, 25, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (212, 'Indra Wijaya', '2026-01-09 12:12:38', 4, '7500', 'kp-008', 1, 33, 'P', NULL);
INSERT INTO `trans_responden` VALUES (213, 'Eka Wibowo', '2026-01-16 10:34:25', 5, '6505', 'kp-007', 1, 33, 'P', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (214, 'Hadi Rahmawati', '2025-12-10 14:30:17', 2, '9910', 'kp-007', 1, 27, 'L', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (215, 'Budi Kusuma', '2026-01-22 09:56:47', 4, '5802', 'kp-002', 4, 50, 'L', NULL);
INSERT INTO `trans_responden` VALUES (216, 'Citra Handayani', '2026-01-19 14:05:59', 2, '6519', 'kp-003', 4, 41, 'P', NULL);
INSERT INTO `trans_responden` VALUES (217, 'Gita Wijaya', '2026-01-02 08:45:55', 5, '8017', 'kp-007', 1, 38, 'L', 'Mohon kejelasan status.');
INSERT INTO `trans_responden` VALUES (218, 'Fitri Wijaya', '2026-01-13 08:25:51', 5, '2100', 'kp-003', 3, 33, 'L', NULL);
INSERT INTO `trans_responden` VALUES (219, 'Agus Wibowo', '2025-11-27 09:35:30', 4, '5805', 'kp-002', 4, 38, 'P', 'Mohon kejelasan status.');
INSERT INTO `trans_responden` VALUES (220, 'Indra Pratama', '2025-12-12 11:49:49', 2, '7806', 'kp-004', 3, 34, 'P', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (221, 'Fitri Pratama', '2026-01-08 10:19:02', 6, '5273', 'kp-002', 3, 36, 'P', NULL);
INSERT INTO `trans_responden` VALUES (222, 'Gita Lestari', '2025-12-30 14:42:13', 4, '7607', 'kp-005', 4, 55, 'P', NULL);
INSERT INTO `trans_responden` VALUES (223, 'Budi Handayani', '2026-01-09 11:22:45', 6, '7405', 'kp-005', 1, 37, 'P', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (224, 'Indra Kusuma', '2026-01-16 08:07:47', 3, '5607', 'kp-001', 3, 47, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (225, 'Dian Susanti', '2026-01-02 14:08:39', 2, '7907', 'kp-006', 4, 39, 'P', NULL);
INSERT INTO `trans_responden` VALUES (226, 'Fitri Wibowo', '2025-12-02 13:01:08', 5, '6910', 'kp-008', 1, 41, 'P', NULL);
INSERT INTO `trans_responden` VALUES (227, 'Gita Saputra', '2025-12-23 10:51:27', 2, '5219', 'kp-007', 4, 54, 'L', NULL);
INSERT INTO `trans_responden` VALUES (228, 'Citra Wibowo', '2025-11-28 13:46:10', 2, '8000', 'kp-004', 6, 57, 'P', 'Mohon ruang tunggu diperluas.');
INSERT INTO `trans_responden` VALUES (229, 'Joko Wijaya', '2026-01-02 11:37:48', 5, '6522', 'kp-005', 3, 48, 'L', NULL);
INSERT INTO `trans_responden` VALUES (230, 'Indra Lestari', '2026-01-22 13:01:35', 6, '6418', 'kp-003', 6, 25, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (231, 'Fitri Wibowo', '2025-12-15 10:49:37', 1, '6671', 'kp-003', 6, 36, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (232, 'Fitri Pratama', '2025-12-09 09:23:35', 6, '4056', 'kp-007', 2, 28, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (233, 'Fitri Lestari', '2026-01-16 14:08:35', 3, '6602', 'kp-008', 4, 37, 'P', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (234, 'Hadi Pratama', '2026-01-16 15:12:59', 4, '6900', 'kp-007', 1, 47, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (235, 'Indra Handayani', '2026-01-23 10:41:06', 5, '5871', 'kp-005', 2, 25, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (236, 'Joko Nugroho', '2025-12-31 11:44:16', 5, '7717', 'kp-008', 1, 48, 'P', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (237, 'Fitri Kusuma', '2026-01-12 10:44:14', 1, '7271', 'kp-003', 2, 39, 'L', NULL);
INSERT INTO `trans_responden` VALUES (238, 'Agus Pratama', '2026-01-23 14:42:42', 5, '7315', 'kp-001', 3, 32, 'P', NULL);
INSERT INTO `trans_responden` VALUES (239, 'Gita Wibowo', '2025-12-11 12:42:06', 2, '6424', 'kp-005', 2, 33, 'P', NULL);
INSERT INTO `trans_responden` VALUES (240, 'Gita Pratama', '2026-01-12 09:49:07', 2, '4058', 'kp-005', 2, 44, 'L', NULL);
INSERT INTO `trans_responden` VALUES (241, 'Gita Wibowo', '2026-01-22 13:29:58', 6, '7073', 'kp-006', 3, 40, 'L', NULL);
INSERT INTO `trans_responden` VALUES (242, 'Agus Lestari', '2025-12-26 12:00:33', 3, '4004', 'kp-002', 6, 36, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (243, 'Agus Handayani', '2026-01-22 12:03:02', 3, '7372', 'kp-009', 1, 39, 'P', NULL);
INSERT INTO `trans_responden` VALUES (244, 'Hadi Lestari', '2026-01-23 12:15:16', 5, '5901', 'kp-005', 6, 27, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (245, 'Joko Lestari', '2025-12-26 14:36:53', 6, '6609', 'kp-007', 5, 26, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (246, 'Indra Rahmawati', '2025-12-03 14:49:41', 6, '5276', 'kp-009', 5, 44, 'P', NULL);
INSERT INTO `trans_responden` VALUES (247, 'Indra Pratama', '2025-12-12 09:51:00', 1, '8820', 'kp-005', 6, 55, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (248, 'Agus Nugroho', '2026-01-21 11:33:57', 1, '3018', 'kp-005', 3, 51, 'P', NULL);
INSERT INTO `trans_responden` VALUES (249, 'Budi Lestari', '2025-11-28 12:33:16', 1, '5508', 'kp-002', 2, 41, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (250, 'Gita Saputra', '2025-12-04 13:37:55', 5, '6200', 'kp-008', 1, 34, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (251, 'Citra Handayani', '2026-01-19 14:33:49', 1, '6672', 'kp-007', 4, 47, 'L', NULL);
INSERT INTO `trans_responden` VALUES (252, 'Eka Nugroho', '2025-11-28 12:34:41', 5, '4037', 'kp-001', 1, 30, 'L', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (253, 'Hadi Wibowo', '2025-12-17 10:34:25', 4, '7712', 'kp-005', 6, 40, 'L', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (254, 'Fitri Saputra', '2025-12-18 13:00:11', 6, '5200', 'kp-002', 2, 42, 'L', NULL);
INSERT INTO `trans_responden` VALUES (255, 'Dian Handayani', '2026-01-01 12:32:30', 2, '7100', 'kp-002', 4, 38, 'L', NULL);
INSERT INTO `trans_responden` VALUES (256, 'Indra Rahmawati', '2025-12-10 12:02:09', 6, '5473', 'kp-001', 5, 31, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (257, 'Indra Nugroho', '2025-12-19 13:16:11', 4, '5306', 'kp-009', 2, 48, 'P', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (258, 'Citra Nugroho', '2025-12-12 08:48:43', 2, '6302', 'kp-003', 3, 50, 'P', NULL);
INSERT INTO `trans_responden` VALUES (259, 'Eka Wijaya', '2026-01-23 10:08:05', 3, '7809', 'kp-006', 1, 44, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (260, 'Gita Pratama', '2026-01-05 09:38:52', 1, '5700', 'kp-006', 4, 27, 'P', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (261, 'Indra Handayani', '2025-12-12 15:09:57', 2, '3013', 'kp-004', 1, 34, 'P', NULL);
INSERT INTO `trans_responden` VALUES (262, 'Joko Wijaya', '2026-01-23 11:29:56', 2, '8210', 'kp-002', 1, 47, 'P', NULL);
INSERT INTO `trans_responden` VALUES (263, 'Fitri Nugroho', '2025-12-12 14:33:15', 6, '5309', 'kp-002', 1, 37, 'L', 'Sangat membantu, sukses terus BKN.');
INSERT INTO `trans_responden` VALUES (264, 'Eka Wijaya', '2025-12-15 12:21:11', 2, '6902', 'kp-008', 1, 49, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (265, 'Budi Wijaya', '2025-12-12 14:54:50', 4, '7804', 'kp-003', 2, 44, 'L', NULL);
INSERT INTO `trans_responden` VALUES (266, 'Budi Rahmawati', '2025-12-22 14:47:12', 5, '7603', 'kp-006', 6, 39, 'P', NULL);
INSERT INTO `trans_responden` VALUES (267, 'Eka Nugroho', '2025-12-05 12:44:59', 6, '6272', 'kp-006', 2, 33, 'L', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (268, 'Budi Rahmawati', '2025-12-31 10:15:26', 3, '6806', 'kp-005', 1, 43, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (269, 'Dian Wibowo', '2026-01-15 13:20:12', 1, '2040', 'kp-002', 2, 43, 'P', 'Parkiran agak penuh.');
INSERT INTO `trans_responden` VALUES (270, 'Fitri Handayani', '2025-12-16 14:45:30', 5, '5400', 'kp-009', 6, 54, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (271, 'Joko Wijaya', '2025-12-11 08:41:43', 3, '401', 'kp-005', 6, 37, 'L', NULL);
INSERT INTO `trans_responden` VALUES (272, 'Citra Wibowo', '2026-01-23 12:40:05', 1, '6400', 'kp-004', 6, 45, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (273, 'Agus Handayani', '2026-01-02 12:10:43', 4, '3006', 'kp-005', 1, 42, 'P', NULL);
INSERT INTO `trans_responden` VALUES (274, 'Fitri Saputra', '2026-01-13 11:24:51', 5, '8830', 'kp-005', 6, 55, 'P', 'Respon chat WA mohon dipercepat.');
INSERT INTO `trans_responden` VALUES (275, 'Budi Lestari', '2025-12-02 13:23:07', 2, '5500', 'kp-001', 2, 47, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (276, 'Agus Saputra', '2025-12-24 12:49:50', 2, '6708', 'kp-005', 2, 38, 'P', NULL);
INSERT INTO `trans_responden` VALUES (277, 'Gita Saputra', '2025-12-19 10:02:00', 6, '3006', 'kp-008', 4, 27, 'P', NULL);
INSERT INTO `trans_responden` VALUES (278, 'Gita Kusuma', '2026-01-07 09:54:25', 5, '6173', 'kp-001', 4, 40, 'P', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (279, 'Agus Wijaya', '2025-12-04 12:58:42', 3, '5472', 'kp-009', 4, 35, 'P', NULL);
INSERT INTO `trans_responden` VALUES (280, 'Citra Susanti', '2025-12-18 11:43:37', 3, '6405', 'kp-005', 5, 44, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (281, 'Gita Handayani', '2025-12-26 15:24:14', 5, '5113', 'kp-004', 2, 44, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (282, 'Hadi Lestari', '2026-01-05 14:16:51', 5, '5804', 'kp-006', 6, 41, 'P', NULL);
INSERT INTO `trans_responden` VALUES (283, 'Joko Handayani', '2025-12-05 08:06:13', 2, '3005', 'kp-002', 2, 36, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (284, 'Eka Pratama', '2025-12-31 09:24:00', 4, '6519', 'kp-001', 1, 37, 'L', NULL);
INSERT INTO `trans_responden` VALUES (285, 'Joko Handayani', '2025-12-29 08:18:45', 2, '7808', 'kp-005', 1, 37, 'L', NULL);
INSERT INTO `trans_responden` VALUES (286, 'Agus Nugroho', '2026-01-16 12:31:26', 6, '5610', 'kp-005', 4, 27, 'L', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (287, 'Budi Rahmawati', '2026-01-14 14:22:17', 5, '4057', 'kp-003', 4, 48, 'L', 'Alur pelayanan sudah jelas.');
INSERT INTO `trans_responden` VALUES (288, 'Agus Wijaya', '2025-12-05 14:22:57', 3, '6414', 'kp-006', 1, 46, 'P', NULL);
INSERT INTO `trans_responden` VALUES (289, 'Gita Nugroho', '2025-12-26 12:25:44', 1, '6401', 'kp-006', 5, 48, 'P', NULL);
INSERT INTO `trans_responden` VALUES (290, 'Hadi Kusuma', '2025-12-19 09:40:17', 4, '6175', 'kp-004', 5, 54, 'L', NULL);
INSERT INTO `trans_responden` VALUES (291, 'Indra Wibowo', '2026-01-16 13:27:58', 1, '7971', 'kp-007', 5, 55, 'L', NULL);
INSERT INTO `trans_responden` VALUES (292, 'Citra Rahmawati', '2025-12-30 11:28:46', 5, '5205', 'kp-005', 2, 28, 'P', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (293, 'Fitri Nugroho', '2026-01-21 12:51:05', 1, '6573', 'kp-006', 5, 38, 'P', 'Petugas kurang ramah.');
INSERT INTO `trans_responden` VALUES (294, 'Joko Saputra', '2025-12-25 12:20:05', 4, '6711', 'kp-009', 4, 50, 'L', 'Terima kasih, pelayanan sangat cepat.');
INSERT INTO `trans_responden` VALUES (295, 'Hadi Susanti', '2025-12-05 09:15:25', 2, '7008', 'kp-007', 3, 31, 'L', NULL);
INSERT INTO `trans_responden` VALUES (296, 'Joko Handayani', '2026-01-16 09:37:43', 6, '6473', 'kp-003', 6, 29, 'L', NULL);
INSERT INTO `trans_responden` VALUES (297, 'Dian Wibowo', '2025-12-19 13:16:31', 3, '7073', 'kp-008', 2, 48, 'P', 'Mohon kejelasan status.');
INSERT INTO `trans_responden` VALUES (298, 'Eka Nugroho', '2025-12-03 12:35:41', 5, '8830', 'kp-008', 6, 44, 'L', NULL);
INSERT INTO `trans_responden` VALUES (299, 'Joko Handayani', '2025-12-16 08:06:50', 3, '7013', 'kp-006', 1, 50, 'L', NULL);
INSERT INTO `trans_responden` VALUES (300, 'Citra Susanti', '2026-01-09 11:10:24', 6, '3003', 'kp-005', 1, 46, 'P', NULL);
INSERT INTO `trans_responden` VALUES (301, 'responden ', '2026-01-27 07:40:32', 3, '2000', 'kp-005', 5, 77, 'P', '');
INSERT INTO `trans_responden` VALUES (302, 'orang ', '2026-01-27 07:41:18', 3, '2010', 'kp-007', 4, 54, 'L', '');
INSERT INTO `trans_responden` VALUES (303, 'klklklklklkk', '2026-01-27 07:42:14', 3, '1030', 'kp-007', 4, 87, 'L', 'okokok jelekkkkkk');
INSERT INTO `trans_responden` VALUES (304, 'reza kaset', '2026-01-27 09:10:41', 5, '4049', 'kp-001', 2, 27, 'L', '');
INSERT INTO `trans_responden` VALUES (305, 'aaaa', '2026-01-29 01:23:34', 1, '2000', 'kp-006', 3, 22, 'L', '');
INSERT INTO `trans_responden` VALUES (306, 'rizky', '2026-01-29 01:27:28', 1, '1020', 'kp-003', 6, 44, 'L', '');
INSERT INTO `trans_responden` VALUES (307, 'reza', '2026-01-29 01:28:18', 1, '1030', 'kp-007', 5, 44, 'P', '');
INSERT INTO `trans_responden` VALUES (308, 'hfhhffhfhfhf', '2026-01-29 02:15:51', 2, '2050', 'kp-007', 5, 34, 'P', '');
INSERT INTO `trans_responden` VALUES (309, 'hghghgghg', '2026-01-29 02:59:46', 2, '2000', 'kp-008', 5, 65, 'P', 'looooooooooooooooo lllllllllllllllllllll');
INSERT INTO `trans_responden` VALUES (310, 'Ambar', '2026-01-29 03:44:23', 1, '1010', 'kp-005', 5, 23, 'P', 'Nya kitu weh');
INSERT INTO `trans_responden` VALUES (311, 'Musbah', '2026-01-29 03:47:04', 1, '2040', 'kp-007', 5, 20, 'L', 'Tidak ada');
INSERT INTO `trans_responden` VALUES (312, 'aaaa', '2026-02-04 05:13:46', 1, '1020', 'kp-008', 3, 45, 'L', '');

SET FOREIGN_KEY_CHECKS = 1;
