DROP TABLE IF EXISTS `phpcms_course`;
CREATE TABLE IF NOT EXISTS `phpcms_course` (
  `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `nickname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '姓名',
  `sex` tinyint(2) NULL DEFAULT NULL COMMENT '性别',
  `school` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '学校',
  `school_number` int(11) NULL DEFAULT NULL COMMENT '高中报名编号',
  `card` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '身份证号码',
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手机号码',
  `parents_phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '家长电话',
  `is_deny` tinyint(2) NULL DEFAULT NULL COMMENT '状态0正常，1关闭',
  `addtime` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '添加时间',
  `updatetime` int(10) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) TYPE=MyISAM ;
