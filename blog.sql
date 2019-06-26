/*
 Navicat MySQL Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : blog

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 26/06/2019 21:33:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin`  (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '管理员名称',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '管理员密码',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES (1, 'root', '63a9f0ea7bb98050796b649e85481845');

-- ----------------------------
-- Table structure for tp_article
-- ----------------------------
DROP TABLE IF EXISTS `tp_article`;
CREATE TABLE `tp_article`  (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章标题',
  `author` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章作者',
  `dsc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章简介',
  `keywords` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章关键字',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章内容',
  `pic` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '缩略图',
  `click` int(10) NOT NULL DEFAULT 1 COMMENT '文章访问数',
  `state` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0:不推荐 1:推荐',
  `time` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '发布时间',
  `cate` smallint(6) NOT NULL COMMENT '所属栏目',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_article
-- ----------------------------
INSERT INTO `tp_article` VALUES (1, '让powershell 执行脚本', 'Bitbull', 'windows小技巧.', '脚本', '<p><span style=\"color: rgb(56, 56, 56);\">Windows默认命令行可以执行命令,不能执行脚本想要通过脚本安装一些软件的话,可以win+A键进入管理员模式,再打上以下代码,回车,就可以了.</span></p><p><code>Set-ExecutionPolicy -ExecutionPolicy RemoteSigned</code></p>', 'static/uploads/20190626\\2283251f002608539ab18c2861ce3a42.png', 1, 1, '2019-06-26 21:08:18', 11);
INSERT INTO `tp_article` VALUES (2, 'linux添加ssh远程连接', 'Bitbull', '远程连接vps', 'ssh', '<p><span style=\"color: rgb(56, 56, 56);\">一些主机服务商出于安全考虑,默认没有开启远程ssh,这就使得我们想要操纵远程服务器时有些繁琐,下面是配置远程ssh的步骤:</span></p><p><span style=\"color: rgb(56, 56, 56);\">1.</span></p><p><code>vi /etc/ssh/sshd_config</code></p><p><span style=\"color: rgb(56, 56, 56);\">2.</span></p><p><span style=\"color: rgb(56, 56, 56);\">修改PermitRootLogin和PasswordAuthentication为yes</span></p><p><span style=\"color: rgb(56, 56, 56);\">3.</span></p><p><code>/etc/init.d/ssh restart</code></p>', 'static/uploads/20190626\\ac8ec21be0f08b71a628cdd6d10307aa.png', 1, 1, '2019-06-26 21:19:10', 11);

-- ----------------------------
-- Table structure for tp_cate
-- ----------------------------
DROP TABLE IF EXISTS `tp_cate`;
CREATE TABLE `tp_cate`  (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '栏目id',
  `catename` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '栏目名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_cate
-- ----------------------------
INSERT INTO `tp_cate` VALUES (11, '代码');
INSERT INTO `tp_cate` VALUES (13, '天际');
INSERT INTO `tp_cate` VALUES (12, '星空');

-- ----------------------------
-- Table structure for tp_links
-- ----------------------------
DROP TABLE IF EXISTS `tp_links`;
CREATE TABLE `tp_links`  (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '链接id',
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '链接标题',
  `url` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '链接地址',
  `dsc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '链接描述',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_links
-- ----------------------------
INSERT INTO `tp_links` VALUES (5, '趣灵', 'https://finesoul.ga', '趣灵网');
INSERT INTO `tp_links` VALUES (2, '谷歌', 'http://g.co', '谷歌短链接');
INSERT INTO `tp_links` VALUES (3, '推特', 'http://t.co', '推特短链接');
INSERT INTO `tp_links` VALUES (4, '油管', 'http://youtu.be', '油管短链接');

SET FOREIGN_KEY_CHECKS = 1;
