/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : www_malaxyb_com

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-06-13 13:18:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `mb_about`
-- ----------------------------
DROP TABLE IF EXISTS `mb_about`;
CREATE TABLE `mb_about` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_text` text NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_about
-- ----------------------------
INSERT INTO `mb_about` VALUES ('1', '<p>名词解释及规则<b>:</b></p><p>&nbsp;【余额】<b>:</b>等同现金。</p><p>&nbsp;【积分】<b>:</b>余额每流通（转出、支付）一次，余额钱包赠送80%的积分，积分是余额点流通产生的价值。</p><p>&nbsp;【转出】<b>:</b>余额在两个账户或者多个帐户之间的流通。转出规则：通过“转帐”或“扫码支付”，转帐方转出多少余额就收多少现金，同时获得80%的积分。收款方需支付相应的现金给转账方，收款方获得转账额80%余额和20%的积分。	举例<b>:</b>A转帐1000余额给B →A得到1000的现金和800的积分&nbsp;B付出1000现金给A，收到800余额和200积分。</p><p>&nbsp;【转入】<b>:</b>收款（生成二维码）。转入规则与转出规则同理。</p><p>&nbsp;【买入】<b>:</b>在线挂单求购余额。买入规则：为确保线上交易诚信，创建充值订单需扣除100的保证金，交易完成后，保证金自动退还账户。</p><p>&nbsp;【卖出】<b>:</b>在线挂单出售余额。卖出规则：自由，无限制，挂单卖出后得到85%的现金，系统不赠送积分。</p><p>&nbsp;【分享】<b>:</b>分享链接或二维码，推广给其他用户使用，通过分享，被分享者在使用余额钱包的过程能加速分享者的积分释放速度。</p><p>&nbsp;【加速释放规则】<b>:</b>用户积分按2‰的速度释放积分到余额，在用户不断分享其他用户使用余额钱包的情况下，其他用户在转账流通额度和速度可加速其积分释放速度，用户积分释放的速度将有可能是1%、2%、5%、10%，甚至更多。</p><p>&nbsp;【会员级别规则】<b>:</b>用户免费注册，注册成功为普通用户，分享用户后可加速积分释放，当普通用户积分账户满100万时，自动升级为VIP。</p><p>&nbsp;【VIP】<b>:</b>享受15代余额流通的8%加入到积分账户。</p>', '1');
INSERT INTO `mb_about` VALUES ('2', '<p><span style=\"font-size: 1px;\">Noun interpretation and rules:</span></p><p><span style=\"font-size: 1px;\">[balance]: equivalent to cash.</span></p><p><span style=\"font-size: 1px;\">[integral]: every time the asset points are circulated (transferred out, paid) once, the asset wallet gives 80% points, and the integral is the value produced by the circulation of balance.</span></p><p><span style=\"font-size: 1px;\">[transfer out]: the circulation of asset points between two accounts or multiple accounts. Transfer rule: through transfer or sweep code payment, the amount of cash transferred by the transfer party will be collected at the same time, and 80% points will be obtained. The payee must pay the corresponding cash to the transfer party, and the payee obtains the transfer amount of 80% balance and 20% points. For example: A transfer 1000 balance to B to A get 1000 cash and 800 points B pay 1000 cash to A, receive 800 balance and 200 points.</span></p><p><span style=\"font-size: 1px;\">[turn]: a receipt (generating a two-dimensional code). The rules are transferred to the same rule.</span></p><p><span style=\"font-size: 1px;\">[buy]: an online list for balance. Buying rules: in order to ensure the integrity of online transactions, a margin deposit of 100 is required to create a recharge order. After the transaction is completed, the deposit is automatically refunded.</span></p><p><span style=\"font-size: 1px;\">[sell]: an online list sells balance. Selling rules: free, unlimited, and 85% cash after the sale, and the system does not give points.</span></p><p><span style=\"font-size: 1px;\">Sharing: sharing links or two-dimensional codes, popularized for use by other users, and by sharing, the sharing speed of integrator release can be accelerated by the participants in the process of using the asset wallet.</span></p><p><span style=\"font-size: 1px;\">[accelerated release rule]: the user integral releases the integral to the asset at the speed of 2 per thousand. When the user continues to share the asset wallet with other users, other users can speed up the rate of integration release at the rate of transfer and speed of the transfer, and the rate of user integration release will probably be 1%, 2%, 5%, 10%, or even more.</span></p><p><span style=\"font-size: 1px;\">Membership level rules: the user is free to register, the registration is successful as a common user, and the sharing user can accelerate the integration release. When the common user\'s integral account is full 1 million, it is automatically upgraded to VIP.</span></p><p><span style=\"font-size: 1px;\">[VIP] enjoy 8% of the 15 generation balance and add it to the integral account.</span></p>', '2');

-- ----------------------------
-- Table structure for `mb_assets_order`
-- ----------------------------
DROP TABLE IF EXISTS `mb_assets_order`;
CREATE TABLE `mb_assets_order` (
  `ao_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `ao_money` decimal(20,2) NOT NULL,
  `former_money` decimal(20,2) NOT NULL,
  `type` int(11) NOT NULL,
  `ao_time` int(11) NOT NULL,
  PRIMARY KEY (`ao_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_assets_order
-- ----------------------------
INSERT INTO `mb_assets_order` VALUES ('1', '100257', '600.00', '4000.00', '3', '1527573996');
INSERT INTO `mb_assets_order` VALUES ('2', '100256', '-5.00', '0.00', '2', '1527573996');
INSERT INTO `mb_assets_order` VALUES ('3', '100257', '600.00', '4600.00', '3', '1527574014');
INSERT INTO `mb_assets_order` VALUES ('4', '100256', '-5.00', '0.00', '2', '1527574014');
INSERT INTO `mb_assets_order` VALUES ('5', '100257', '6000.00', '5200.00', '3', '1527574057');
INSERT INTO `mb_assets_order` VALUES ('6', '100256', '-50.00', '0.00', '2', '1527574057');
INSERT INTO `mb_assets_order` VALUES ('7', '100257', '-22.40', '11200.00', '1', '1527624002');
INSERT INTO `mb_assets_order` VALUES ('8', '100257', '-22.40', '11200.00', '1', '1527710401');
INSERT INTO `mb_assets_order` VALUES ('9', '100257', '-22.30', '11177.60', '1', '1527796801');
INSERT INTO `mb_assets_order` VALUES ('10', '100257', '-22.30', '11177.60', '1', '1527883202');
INSERT INTO `mb_assets_order` VALUES ('11', '100276', '30000.00', '0.00', '3', '1528767004');
INSERT INTO `mb_assets_order` VALUES ('12', '100275', '-250.00', '0.00', '2', '1528767004');
INSERT INTO `mb_assets_order` VALUES ('13', '100274', '-50.00', '0.00', '2', '1528767004');
INSERT INTO `mb_assets_order` VALUES ('14', '100273', '1800.00', '100000.00', '3', '1528859583');

-- ----------------------------
-- Table structure for `mb_balance_order`
-- ----------------------------
DROP TABLE IF EXISTS `mb_balance_order`;
CREATE TABLE `mb_balance_order` (
  `bo_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `bo_money` decimal(20,2) NOT NULL,
  `former_money` decimal(20,2) NOT NULL,
  `type` int(11) NOT NULL,
  `bo_time` int(11) NOT NULL,
  `target_uid` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`bo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_balance_order
-- ----------------------------
INSERT INTO `mb_balance_order` VALUES ('1', '100257', '-100.00', '16500.00', '8', '1527573996', null);
INSERT INTO `mb_balance_order` VALUES ('2', '100256', '5.00', '0.00', '5', '1527573996', null);
INSERT INTO `mb_balance_order` VALUES ('3', '100257', '-100.00', '16400.00', '8', '1527574014', null);
INSERT INTO `mb_balance_order` VALUES ('4', '100256', '5.00', '0.00', '5', '1527574014', null);
INSERT INTO `mb_balance_order` VALUES ('5', '100257', '-1000.00', '16300.00', '8', '1527574057', null);
INSERT INTO `mb_balance_order` VALUES ('6', '100256', '50.00', '0.00', '5', '1527574057', null);
INSERT INTO `mb_balance_order` VALUES ('7', '100257', '22.40', '15300.00', '1', '1527624002', null);
INSERT INTO `mb_balance_order` VALUES ('8', '100257', '22.40', '15300.00', '1', '1527710401', null);
INSERT INTO `mb_balance_order` VALUES ('9', '100257', '22.30', '15322.40', '1', '1527796801', null);
INSERT INTO `mb_balance_order` VALUES ('10', '100257', '22.30', '15322.40', '1', '1527883202', null);
INSERT INTO `mb_balance_order` VALUES ('11', '100276', '-5000.00', '5000.00', '8', '1528767004', null);
INSERT INTO `mb_balance_order` VALUES ('12', '100275', '250.00', '0.00', '5', '1528767004', null);
INSERT INTO `mb_balance_order` VALUES ('13', '100274', '50.00', '0.00', '5', '1528767004', null);
INSERT INTO `mb_balance_order` VALUES ('14', '100273', '-300.00', '10000.00', '8', '1528859583', null);

-- ----------------------------
-- Table structure for `mb_bank`
-- ----------------------------
DROP TABLE IF EXISTS `mb_bank`;
CREATE TABLE `mb_bank` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `c_name` varchar(16) NOT NULL,
  `b_name` int(11) NOT NULL,
  `b_card` varchar(22) NOT NULL,
  `b_branch` varchar(22) DEFAULT NULL,
  `defult` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_bank
-- ----------------------------
INSERT INTO `mb_bank` VALUES ('1', '100257', '蒋英杰', '1', '6222034000010934804', null, '1');

-- ----------------------------
-- Table structure for `mb_bank_name`
-- ----------------------------
DROP TABLE IF EXISTS `mb_bank_name`;
CREATE TABLE `mb_bank_name` (
  `bn_id` int(11) NOT NULL AUTO_INCREMENT,
  `bn_name` varchar(32) NOT NULL,
  PRIMARY KEY (`bn_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_bank_name
-- ----------------------------
INSERT INTO `mb_bank_name` VALUES ('6', '中国工商银行');

-- ----------------------------
-- Table structure for `mb_beijin`
-- ----------------------------
DROP TABLE IF EXISTS `mb_beijin`;
CREATE TABLE `mb_beijin` (
  `bj_id` int(11) NOT NULL AUTO_INCREMENT,
  `bj_img` varchar(200) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`bj_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_beijin
-- ----------------------------
INSERT INTO `mb_beijin` VALUES ('1', '20180502\\8e2826e3cafa254169c83f8cbc667e8e.png', '1525263617');

-- ----------------------------
-- Table structure for `mb_config`
-- ----------------------------
DROP TABLE IF EXISTS `mb_config`;
CREATE TABLE `mb_config` (
  `co_id` int(11) NOT NULL AUTO_INCREMENT,
  `co_name` varchar(22) NOT NULL,
  `co_config` int(11) NOT NULL,
  PRIMARY KEY (`co_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_config
-- ----------------------------
INSERT INTO `mb_config` VALUES ('1', 'vip第一代', '6');
INSERT INTO `mb_config` VALUES ('2', 'vip第二代至15代', '3');
INSERT INTO `mb_config` VALUES ('3', '普通会员第一代', '5');
INSERT INTO `mb_config` VALUES ('4', '普通会员第二代至15代', '1');
INSERT INTO `mb_config` VALUES ('5', '每日释放千分比', '2');
INSERT INTO `mb_config` VALUES ('6', '每日释放时间', '1528657200');
INSERT INTO `mb_config` VALUES ('7', '余额兑换积分', '600');
INSERT INTO `mb_config` VALUES ('9', 'vip下级互转百分比', '8');
INSERT INTO `mb_config` VALUES ('10', 'vip下级vip互转', '2');

-- ----------------------------
-- Table structure for `mb_current_order`
-- ----------------------------
DROP TABLE IF EXISTS `mb_current_order`;
CREATE TABLE `mb_current_order` (
  `co_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `co_money` decimal(20,2) NOT NULL,
  `former_money` decimal(20,2) NOT NULL,
  `type` int(11) NOT NULL,
  `co_time` int(11) NOT NULL,
  `target_uid` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`co_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_current_order
-- ----------------------------

-- ----------------------------
-- Table structure for `mb_feedback`
-- ----------------------------
DROP TABLE IF EXISTS `mb_feedback`;
CREATE TABLE `mb_feedback` (
  `reply_time` int(11) NOT NULL,
  `f_content` varchar(255) NOT NULL,
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_text` varchar(200) NOT NULL,
  `u_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='回复时间';

-- ----------------------------
-- Records of mb_feedback
-- ----------------------------
INSERT INTO `mb_feedback` VALUES ('1528820828', '回复273建议', '1', '测试', '100273', '1528720114');
INSERT INTO `mb_feedback` VALUES ('0', '', '2', '你好', '100276', '1528823548');
INSERT INTO `mb_feedback` VALUES ('0', '', '3', '这是我的第一条反馈意见', '100277', '1528823803');
INSERT INTO `mb_feedback` VALUES ('0', '', '4', '这是我的第一条反馈意见', '100277', '1528823889');
INSERT INTO `mb_feedback` VALUES ('0', '', '5', '这是我的第一条反馈意见', '100277', '1528824065');
INSERT INTO `mb_feedback` VALUES ('0', '', '6', '这是我的第二条反馈', '100277', '1528824088');
INSERT INTO `mb_feedback` VALUES ('0', '', '7', '第三条', '100277', '1528824102');

-- ----------------------------
-- Table structure for `mb_level_config`
-- ----------------------------
DROP TABLE IF EXISTS `mb_level_config`;
CREATE TABLE `mb_level_config` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(5) NOT NULL,
  `c_config` int(11) NOT NULL,
  `c_money` int(11) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_level_config
-- ----------------------------
INSERT INTO `mb_level_config` VALUES ('1', 'M1', '3', '100');
INSERT INTO `mb_level_config` VALUES ('2', 'M2', '5', '500');
INSERT INTO `mb_level_config` VALUES ('3', 'M3', '7', '1000');
INSERT INTO `mb_level_config` VALUES ('4', 'M4', '9', '2000');
INSERT INTO `mb_level_config` VALUES ('5', 'M5', '12', '5000');
INSERT INTO `mb_level_config` VALUES ('6', 'M6', '15', '10000');

-- ----------------------------
-- Table structure for `mb_lunbo`
-- ----------------------------
DROP TABLE IF EXISTS `mb_lunbo`;
CREATE TABLE `mb_lunbo` (
  `lb_id` int(11) NOT NULL AUTO_INCREMENT,
  `lb_img` varchar(200) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`lb_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_lunbo
-- ----------------------------
INSERT INTO `mb_lunbo` VALUES ('27', '20180524/2dc051ebf95ce0d6c7503d726de65aa1.png', '1527173073');
INSERT INTO `mb_lunbo` VALUES ('28', '20180524/e3e6fadda82f325987c9ecf8c46b34ea.png', '1527173096');
INSERT INTO `mb_lunbo` VALUES ('31', '20180613\\44cf8f13929b1dc10695fb8dac150e21.png', '1528821683');
INSERT INTO `mb_lunbo` VALUES ('32', '20180613\\1bbdf9564b45a7b52e70d34a758d22ed.png', '1528821813');

-- ----------------------------
-- Table structure for `mb_message`
-- ----------------------------
DROP TABLE IF EXISTS `mb_message`;
CREATE TABLE `mb_message` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_text` text NOT NULL,
  `m_title` varchar(100) NOT NULL,
  `m_time` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_message
-- ----------------------------

-- ----------------------------
-- Table structure for `mb_notice`
-- ----------------------------
DROP TABLE IF EXISTS `mb_notice`;
CREATE TABLE `mb_notice` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `n_title` varchar(100) NOT NULL,
  `n_text` text NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_notice
-- ----------------------------
INSERT INTO `mb_notice` VALUES ('2', '公告标题', '<p><span style=\"color: rgb(51, 51, 51); font-size: 16px;\">测试</span>测试<span style=\"color: rgb(51, 51, 51); font-size: 16px;\">测试</span><span style=\"color: rgb(51, 51, 51); font-size: 16px;\">测试</span><a href=\"http://www.malaxyb.com\"></a></p>', '1528822286');

-- ----------------------------
-- Table structure for `mb_sell_order`
-- ----------------------------
DROP TABLE IF EXISTS `mb_sell_order`;
CREATE TABLE `mb_sell_order` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` varchar(12) NOT NULL,
  `u_id_bank` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `user` varchar(12) DEFAULT NULL,
  `user_bank` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `static` int(11) NOT NULL DEFAULT '1',
  `time` int(11) NOT NULL,
  `shi_money` int(11) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_sell_order
-- ----------------------------

-- ----------------------------
-- Table structure for `mb_shengshu`
-- ----------------------------
DROP TABLE IF EXISTS `mb_shengshu`;
CREATE TABLE `mb_shengshu` (
  `ss_id` int(11) NOT NULL AUTO_INCREMENT,
  `ss_text` text NOT NULL,
  `s_id` int(11) NOT NULL,
  `ss_img` varchar(200) NOT NULL,
  `time` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ss_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_shengshu
-- ----------------------------

-- ----------------------------
-- Table structure for `mb_today_assets`
-- ----------------------------
DROP TABLE IF EXISTS `mb_today_assets`;
CREATE TABLE `mb_today_assets` (
  `ts_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `assets` decimal(20,2) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`ts_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mb_today_assets
-- ----------------------------
INSERT INTO `mb_today_assets` VALUES ('1', '100257', '22.40', '1527755145');

-- ----------------------------
-- Table structure for `mb_user`
-- ----------------------------
DROP TABLE IF EXISTS `mb_user`;
CREATE TABLE `mb_user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(22) NOT NULL,
  `u_name` varchar(16) DEFAULT NULL,
  `u_img` varchar(100) DEFAULT NULL,
  `tel` varchar(12) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `pay_pass` varchar(32) NOT NULL,
  `assets` decimal(20,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(20,2) NOT NULL DEFAULT '0.00',
  `time` int(11) NOT NULL,
  `vip_static` int(11) NOT NULL DEFAULT '2',
  `is_card` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `era` int(11) NOT NULL DEFAULT '0',
  `f_uid` int(11) NOT NULL,
  `best_uid` int(11) NOT NULL,
  `speed` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `last_ip` varchar(22) DEFAULT NULL,
  `current` int(11) NOT NULL DEFAULT '0',
  `gold` int(11) NOT NULL DEFAULT '0',
  `wallet_address` varchar(250) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100280 DEFAULT CHARSET=utf8 COMMENT='钱包地址';

-- ----------------------------
-- Records of mb_user
-- ----------------------------
INSERT INTO `mb_user` VALUES ('100275', 'yxh1314', '0', null, '13356809130', '41a96a8094d605ea5af43bf1951654ff', '41a96a8094d605ea5af43bf1951654ff', '0.00', '0.00', '1528720349', '2', '0', '0', '2', '100274', '100273', '0', '1', null, '0', '0', '');
INSERT INTO `mb_user` VALUES ('100276', 'cjb1', '0', null, '13736982551', 'c47a5e7e0d70e00c512d7d0a8b22ff2c', 'c47a5e7e0d70e00c512d7d0a8b22ff2c', '30000.00', '0.00', '1528720497', '2', '0', '0', '3', '100275', '100273', '0', '1', '112.17.235.145', '0', '0', '');
INSERT INTO `mb_user` VALUES ('100277', 'Ce1', '0', null, '15093375805', '17bf4f76f57137ccd405dd56faf83a96', '17bf4f76f57137ccd405dd56faf83a96', '0.00', '0.00', '1528721215', '2', '0', '0', '1', '100273', '100273', '0', '1', '101.66.229.13', '0', '0', 'werfcgh');
INSERT INTO `mb_user` VALUES ('100278', 'ctx888', '0', null, '13362727133', 'fae262e4c1e545642eed8d3a3e8fd89f', 'fae262e4c1e545642eed8d3a3e8fd89f', '0.00', '0.00', '1528721346', '2', '0', '0', '3', '100275', '100273', '0', '1', '58.101.52.184', '0', '0', '');
INSERT INTO `mb_user` VALUES ('100279', 'yxh1315', '0', null, '13806309130', '41a96a8094d605ea5af43bf1951654ff', '41a96a8094d605ea5af43bf1951654ff', '0.00', '0.00', '1528721689', '2', '0', '0', '3', '100275', '100273', '0', '1', null, '0', '0', '');
INSERT INTO `mb_user` VALUES ('100274', 'MALAXYB', '0', null, '18815019091', 'c47a5e7e0d70e00c512d7d0a8b22ff2c', 'c47a5e7e0d70e00c512d7d0a8b22ff2c', '0.00', '0.00', '1528719481', '2', '0', '0', '1', '100273', '100273', '0', '1', '112.17.235.145', '0', '0', '');
INSERT INTO `mb_user` VALUES ('100273', '不知道', '0', null, '13888888888', '59e778220e9785bf72d53b5297a45561', '21218cca77804d2ba1922c33e0151105', '101800.00', '9700.00', '1528689200', '2', '0', '0', '0', '0', '0', '0', '1', '111.1.214.115', '0', '0', '');

-- ----------------------------
-- Table structure for `vpay_admin`
-- ----------------------------
DROP TABLE IF EXISTS `vpay_admin`;
CREATE TABLE `vpay_admin` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(16) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '2',
  `time` int(11) NOT NULL,
  `ip` varchar(18) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `city` varchar(20) NOT NULL DEFAULT '0',
  `system` varchar(20) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vpay_admin
-- ----------------------------
INSERT INTO `vpay_admin` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1', '1521278884', '101.81.16.226', '1', '上海', 'windows', '0');
INSERT INTO `vpay_admin` VALUES ('2', 'user', 'e10adc3949ba59abbe56e057f20f883e', '2', '1521278884', '192.168.0.177', '1', '内网IP', 'windows', '2');
INSERT INTO `vpay_admin` VALUES ('5', 'huang', 'e10adc3949ba59abbe56e057f20f883e', '2', '1521278884', '192.168.5.26', '1', '内网IP', 'windows', '0');
INSERT INTO `vpay_admin` VALUES ('6', 'test', 'e10adc3949ba59abbe56e057f20f883e', '2', '1525507171', null, '1', '0', null, '2');

-- ----------------------------
-- Table structure for `vpay_menu`
-- ----------------------------
DROP TABLE IF EXISTS `vpay_menu`;
CREATE TABLE `vpay_menu` (
  `me_id` int(11) NOT NULL AUTO_INCREMENT,
  `me_name` varchar(18) NOT NULL,
  `me_url` varchar(50) NOT NULL,
  `me_level` int(11) NOT NULL,
  `me_class` varchar(18) NOT NULL,
  `me_ico` varchar(18) NOT NULL,
  PRIMARY KEY (`me_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vpay_menu
-- ----------------------------
INSERT INTO `vpay_menu` VALUES ('1', '会员管理', 'index/index/index', '2', 'index', 'icon-home');
INSERT INTO `vpay_menu` VALUES ('2', '用户银行卡', 'index/menu/card', '2', 'card', 'icon-sitemap');
INSERT INTO `vpay_menu` VALUES ('3', '添加银行', 'index/menu/add_card', '2', 'add_card', 'icon-sitemap');
INSERT INTO `vpay_menu` VALUES ('4', '配置app轮播图', 'index/menu/lunbo', '2', 'lunbo', 'icon-sitemap');
INSERT INTO `vpay_menu` VALUES ('6', '用户申诉', 'index/menu/shensu', '2', 'shensu', 'icon-table');
INSERT INTO `vpay_menu` VALUES ('7', '用户资产记录', 'index/menu/user_money_order', '2', 'user_money_order', 'icon-table');
INSERT INTO `vpay_menu` VALUES ('8', '用户积分记录', 'index/menu/user_assets_order', '2', 'user_assets_order', 'icon-table');
INSERT INTO `vpay_menu` VALUES ('9', '卖出挂单', 'index/menu/sell', '2', 'sell', 'icon-folder-open');
INSERT INTO `vpay_menu` VALUES ('10', '买入挂单', 'index/menu/purshare', '2', 'purshare', 'icon-dollar');
INSERT INTO `vpay_menu` VALUES ('12', '发布公告', 'index/menu/noticemanage', '2', 'noticemanage', 'icon-trello');
INSERT INTO `vpay_menu` VALUES ('13', '投诉建议', 'index/menu/feedback', '2', 'feedback', 'icon-stackexchange');
INSERT INTO `vpay_menu` VALUES ('14', '消息记录', 'index/menu/message', '2', 'message', 'icon-file');
INSERT INTO `vpay_menu` VALUES ('15', '参数配置', 'index/menu/config', '2', 'config', 'icon-cogs');
INSERT INTO `vpay_menu` VALUES ('17', '编辑关于', 'index/menu/about', '2', 'about', 'icon-cogs');
INSERT INTO `vpay_menu` VALUES ('18', '管理员管理', 'index/menu/admin', '1', 'admin', 'icon-cogs');
INSERT INTO `vpay_menu` VALUES ('19', '权限分配', 'index/menu/quanxian', '1', 'quanxian', 'icon-cogs');

-- ----------------------------
-- Table structure for `vpay_share_order`
-- ----------------------------
DROP TABLE IF EXISTS `vpay_share_order`;
CREATE TABLE `vpay_share_order` (
  `sh_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`sh_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vpay_share_order
-- ----------------------------
INSERT INTO `vpay_share_order` VALUES ('1', '100256', '100257', '1527150896');
INSERT INTO `vpay_share_order` VALUES ('2', '100256', '100258', '1527151740');
INSERT INTO `vpay_share_order` VALUES ('3', '100256', '100259', '1527152639');
INSERT INTO `vpay_share_order` VALUES ('4', '100270', '100271', '1528676430');
INSERT INTO `vpay_share_order` VALUES ('5', '100270', '100272', '1528676579');
INSERT INTO `vpay_share_order` VALUES ('6', '100273', '100274', '1528719481');
INSERT INTO `vpay_share_order` VALUES ('7', '100274', '100275', '1528720349');
INSERT INTO `vpay_share_order` VALUES ('8', '100275', '100276', '1528720497');
INSERT INTO `vpay_share_order` VALUES ('9', '100273', '100277', '1528721215');
INSERT INTO `vpay_share_order` VALUES ('10', '100275', '100278', '1528721346');
INSERT INTO `vpay_share_order` VALUES ('11', '100275', '100279', '1528721689');

-- ----------------------------
-- Table structure for `vpay_shop`
-- ----------------------------
DROP TABLE IF EXISTS `vpay_shop`;
CREATE TABLE `vpay_shop` (
  `sh_id` int(11) NOT NULL AUTO_INCREMENT,
  `sh_title` varchar(36) NOT NULL,
  `sh_text` text NOT NULL,
  `sh_img` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`sh_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vpay_shop
-- ----------------------------
INSERT INTO `vpay_shop` VALUES ('2', '123', '<p>资讯内容123</p>', '20180414\\74a7baf9ba42e3633e9dc496ffa57588.png', '1523697854');
