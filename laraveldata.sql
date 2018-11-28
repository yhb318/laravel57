/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : laraveldata

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-11-23 18:32:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for table_member
-- ----------------------------
DROP TABLE IF EXISTS `table_member`;
CREATE TABLE `table_member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `other` varchar(255) NOT NULL DEFAULT '0',
  `addtime` bigint(15) NOT NULL DEFAULT '0',
  `updatetime` bigint(15) NOT NULL DEFAULT '0',
  `deltime` bigint(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='laravel数据库操作';

-- ----------------------------
-- Records of table_member
-- ----------------------------
INSERT INTO `table_member` VALUES ('1', '测试1', '96863', '1115584848484848', '1529229719', '0');
INSERT INTO `table_member` VALUES ('2', 'Dayle', '96863', '1529227135', '1529229719', '0');
INSERT INTO `table_member` VALUES ('3', 'Dayle54', 'content41', '1529227160', '0', '0');
INSERT INTO `table_member` VALUES ('4', 'Dayle87', 'content87', '1529227729', '0', '0');
INSERT INTO `table_member` VALUES ('8', 'Dayle83', 'orm查询构造器更新', '1529229836', '0', '0');
INSERT INTO `table_member` VALUES ('6', 're', 'cghfhg', '0', '0', '0');
INSERT INTO `table_member` VALUES ('7', 'rtr', 'ghju', '0', '0', '0');
INSERT INTO `table_member` VALUES ('9', '新增80', 'orm查询构造器更新', '1529418666', '0', '0');
INSERT INTO `table_member` VALUES ('10', '新增98', '新内容98', '1529418789', '0', '0');
INSERT INTO `table_member` VALUES ('12', '新增38', '新内容38', '1529420733', '0', '0');
INSERT INTO `table_member` VALUES ('11', '新增33', '新内容33', '1529420695', '0', '0');
INSERT INTO `table_member` VALUES ('13', '新增25', '新内容25', '1529420751', '0', '0');
INSERT INTO `table_member` VALUES ('26', '0', '0', '1529422837', '0', '0');
INSERT INTO `table_member` VALUES ('38', '1batch44', '1batch_comtent44', '0', '0', '0');
INSERT INTO `table_member` VALUES ('39', '1batch65', '1batch_comtent65', '0', '0', '0');
INSERT INTO `table_member` VALUES ('40', '2batch65', '2batch_comtent65', '0', '0', '0');
INSERT INTO `table_member` VALUES ('41', '1batch97', '1batch_comtent97', '0', '0', '0');
INSERT INTO `table_member` VALUES ('42', '2batch97', '2batch_comtent97', '0', '0', '0');
INSERT INTO `table_member` VALUES ('43', '1batch68', '1batch_comtent68', '0', '0', '0');
INSERT INTO `table_member` VALUES ('44', '2batch68', '2batch_comtent68', '0', '0', '0');
INSERT INTO `table_member` VALUES ('45', '1batch72', '1batch_comtent72', '0', '0', '0');
INSERT INTO `table_member` VALUES ('46', '2batch72', '2batch_comtent72', '0', '0', '0');

-- ----------------------------
-- Table structure for table_member_bank
-- ----------------------------
DROP TABLE IF EXISTS `table_member_bank`;
CREATE TABLE `table_member_bank` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `member_id` int(20) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `type` int(20) NOT NULL DEFAULT '0' COMMENT '银行类型 栏目表ID',
  `default` int(1) NOT NULL DEFAULT '0' COMMENT '0=否 1=默认',
  `province` int(20) NOT NULL DEFAULT '0' COMMENT '省',
  `city` int(20) NOT NULL DEFAULT '0' COMMENT '市',
  `country` int(20) NOT NULL DEFAULT '0' COMMENT '县',
  `area_id` int(20) NOT NULL DEFAULT '0' COMMENT '地区ID',
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '银行户名',
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '开户网点',
  `number` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '银行卡号',
  `addtime` int(50) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `del` int(1) NOT NULL DEFAULT '0' COMMENT '0=正常1=已删除',
  `deltime` int(50) NOT NULL DEFAULT '0' COMMENT '删除时间',
  `deluser` int(20) NOT NULL DEFAULT '0' COMMENT '删除用户ID',
  `deladmin` int(20) NOT NULL DEFAULT '0' COMMENT '删除管理员ID',
  UNIQUE KEY `id` (`id`) USING HASH
) ENGINE=MyISAM AUTO_INCREMENT=8729 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='会员多银行表';

-- ----------------------------
-- Records of table_member_bank
-- ----------------------------
INSERT INTO `table_member_bank` VALUES ('8728', '1', '0', '0', '0', '0', '0', '0', '我的银行', '0', '0', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for table_withdraw
-- ----------------------------
DROP TABLE IF EXISTS `table_withdraw`;
CREATE TABLE `table_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '提现申请人id',
  `withdraw` decimal(11,1) NOT NULL DEFAULT '0.0' COMMENT '提现金额',
  `account_type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '打款方式1银行卡  2支付宝',
  `note` varchar(130) NOT NULL DEFAULT '0' COMMENT '备注',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0申请  1打款中  2不允许  3打款失败返还余额 4已打款 ',
  `del` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0正常 1删除(在回收站可物理删除)',
  `addtime` bigint(13) NOT NULL DEFAULT '0' COMMENT '申请提现时间',
  `actime` bigint(13) NOT NULL DEFAULT '0' COMMENT '状态处理时间',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='提现';

-- ----------------------------
-- Records of table_withdraw
-- ----------------------------
INSERT INTO `table_withdraw` VALUES ('1', '20', '10.0', '1', '0', '0', '0', '1525255528', '0');
INSERT INTO `table_withdraw` VALUES ('2', '20', '10.0', '1', '0', '0', '0', '1525255639', '0');
INSERT INTO `table_withdraw` VALUES ('3', '20', '10.0', '1', '0', '0', '0', '1525255877', '0');
INSERT INTO `table_withdraw` VALUES ('4', '20', '10.0', '1', '0', '0', '0', '1525256412', '0');
INSERT INTO `table_withdraw` VALUES ('5', '20', '10.0', '1', '0', '0', '0', '1525258033', '0');
INSERT INTO `table_withdraw` VALUES ('6', '20', '10.0', '1', '0', '2', '0', '1525258083', '0');
INSERT INTO `table_withdraw` VALUES ('7', '18', '123.0', '1', '0', '1', '0', '1525329261', '0');
INSERT INTO `table_withdraw` VALUES ('8', '18', '22.0', '1', '0', '4', '0', '1525329355', '0');
INSERT INTO `table_withdraw` VALUES ('9', '20', '20.0', '2', '0', '2', '0', '1525329383', '0');
INSERT INTO `table_withdraw` VALUES ('10', '21', '123.0', '1', '0', '2', '0', '1525339883', '0');
