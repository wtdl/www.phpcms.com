DROP TABLE IF EXISTS `phpcms_course`;
CREATE TABLE IF NOT EXISTS `phpcms_course` (
  `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '姓名',
  `sex` tinyint(2) NULL DEFAULT NULL,
  `school` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `school_number` int(11) NULL DEFAULT NULL,
  `card` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `parents_phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `addtime` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `show_template` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_deny` tinyint(2) NULL DEFAULT NULL COMMENT '状态0正常，1关闭',
  `updatetime` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) TYPE=MyISAM ;
