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

 Date: 27/06/2019 11:36:29
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
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES (1, 'root', '63a9f0ea7bb98050796b649e85481845');
INSERT INTO `tp_admin` VALUES (2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

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
  `time` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '发布时间',
  `cate` smallint(6) NOT NULL COMMENT '所属栏目',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_article
-- ----------------------------
INSERT INTO `tp_article` VALUES (1, '让powershell 执行脚本', 'Bitbull', 'windows小技巧.', '脚本', '<p><span style=\"color: rgb(56, 56, 56);\">Windows默认命令行可以执行命令,不能执行脚本想要通过脚本安装一些软件的话,可以win+A键进入管理员模式,再打上以下代码,回车,就可以了.</span></p><p><code>Set-ExecutionPolicy -ExecutionPolicy RemoteSigned</code></p>', 'static/uploads/20190626\\2283251f002608539ab18c2861ce3a42.png', 34, 1, '2019-06-27 10:55:10', 11);
INSERT INTO `tp_article` VALUES (2, 'linux添加ssh远程连接', 'Bitbull', '远程连接vps', 'ssh', '<p><span style=\"color: rgb(56, 56, 56);\">一些主机服务商出于安全考虑,默认没有开启远程ssh,这就使得我们想要操纵远程服务器时有些繁琐,下面是配置远程ssh的步骤:</span></p><p><span style=\"color: rgb(56, 56, 56);\">1.</span></p><p><code>vi /etc/ssh/sshd_config</code></p><p><span style=\"color: rgb(56, 56, 56);\">2.</span></p><p><span style=\"color: rgb(56, 56, 56);\">修改PermitRootLogin和PasswordAuthentication为yes</span></p><p><span style=\"color: rgb(56, 56, 56);\">3.</span></p><p><code>/etc/init.d/ssh restart</code></p>', 'static/uploads/20190627\\9834a1d6c6d5921832c2bad3bea96ca5.png', 8, 0, '2019-06-27 11:10:42', 11);
INSERT INTO `tp_article` VALUES (4, '我对宇宙的认知', 'finesoul', '转载自凡灵网(www.finesoul.ga)', '宇宙', '<h4><b>1. 时间是相对存在的,或许时间本身并不存在</b></h4><p>时间的意义在于我们对过去有怀念, 对未来有憧憬, 如果时间不存在, 那么过去就没有什么好怀念的, 未来也没什么好期待的, 我们只要活在当下就好.</p><h4><b>2. 宇宙存在更高维度, 我们的文明正在成长</b></h4><p>从文明进化的角度分析, 宇宙中一定存在更高纬度, 我们所处的三维世界绝不是整个宇宙. 人类文明至今仍处于摇篮阶段, 我们的周围很有可能存在高等文明, 随着人类文明的进化, 我们能看到的纬度会更多.</p><h4><b>3. 光速是不变的，时间流淌的速度可以改变</b></h4><p>NASA做过这样的实验: 当地球在以30Km/s的速度公转, 而从速度的前方和后方同时向地球发射一道光, 测出的光速竟然惊人的一致! 根据爱因斯坦的相对论, 处在质量超大的天体附近的时间, 当然, 快慢是相对而言的, 物体本身并不能感到时间变慢.</p><h4><b>4. 对于高等文明而言, 三维空间可能不屑一顾</b></h4><p>你会在意一个二维空间的文明发展吗? 或许高等文明就处在我们身边, 只是把我们当作虫子罢了, 只有我们的科技飞速进步时, 他们可能才派个飞行器看我们一眼. (罗斯威尔事件)</p><h4><b>5. 宇宙不止一个, 我们的宇宙不过是千亿分之一</b></h4><p>如果存在更高维度, 那么高维里可能存在无数个低纬世界, 这并不是平行宇宙的理论, 而高维的宇宙里存在多个类似的平行宇宙是很有可能的.</p><h3><i>写在最后: 宇宙有无数可能</i></h3><p style=\"text-align: center;\">宇宙有多种可能，我并不是某一种的坚定支持者，而是选择观望所有可能。</p>', 'static/uploads/20190627\\819fead9720d8dabe5f9108e54661a12.jpg', 1, 1, '2019-06-27 11:08:09', 13);

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
