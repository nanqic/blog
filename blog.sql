-- MySQL dump 10.13  Distrib 5.7.26, for Win64 (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.7.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tp_admin`
--

DROP TABLE IF EXISTS `tp_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_admin` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT '管理员名称',
  `password` varchar(32) NOT NULL COMMENT '管理员密码',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_admin`
--

LOCK TABLES `tp_admin` WRITE;
/*!40000 ALTER TABLE `tp_admin` DISABLE KEYS */;
INSERT INTO `tp_admin` VALUES (1,'root','63a9f0ea7bb98050796b649e85481845'),(2,'admin','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `tp_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_article`
--

DROP TABLE IF EXISTS `tp_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_article` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(60) NOT NULL COMMENT '文章标题',
  `author` varchar(30) NOT NULL COMMENT '文章作者',
  `dsc` varchar(255) NOT NULL COMMENT '文章简介',
  `keywords` varchar(60) NOT NULL COMMENT '文章关键字',
  `content` text NOT NULL COMMENT '文章内容',
  `pic` varchar(100) DEFAULT NULL COMMENT '缩略图',
  `click` int(10) NOT NULL DEFAULT '1' COMMENT '文章访问数',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:不推荐 1:推荐',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '发布时间',
  `cate` smallint(6) NOT NULL COMMENT '所属栏目',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_article`
--

LOCK TABLES `tp_article` WRITE;
/*!40000 ALTER TABLE `tp_article` DISABLE KEYS */;
INSERT INTO `tp_article` VALUES (1,'让powershell 执行脚本','Bitbull','windows小技巧.','脚本','<p><span style=\"color: rgb(56, 56, 56);\">Windows默认命令行可以执行命令,不能执行脚本想要通过脚本安装一些软件的话,可以win+A键进入管理员模式,再打上以下代码,回车,就可以了.</span></p><p><code>Set-ExecutionPolicy -ExecutionPolicy RemoteSigned</code></p>','static/uploads/20190626\\2283251f002608539ab18c2861ce3a42.png',61,1,'2019-06-29 21:41:20',11),(2,'linux添加ssh远程连接','Bitbull','远程连接vps','ssh','<p><span style=\"color: rgb(56, 56, 56);\">一些主机服务商出于安全考虑,默认没有开启远程ssh,这就使得我们想要操纵远程服务器时有些繁琐,下面是配置远程ssh的步骤:</span></p><p><span style=\"color: rgb(56, 56, 56);\">1.</span></p><p><code>vi /etc/ssh/sshd_config</code></p><p><span style=\"color: rgb(56, 56, 56);\">2.</span></p><p><span style=\"color: rgb(56, 56, 56);\">修改PermitRootLogin和PasswordAuthentication为yes</span></p><p><span style=\"color: rgb(56, 56, 56);\">3.</span></p><p><code>/etc/init.d/ssh restart</code></p>','static/uploads/20190627\\9834a1d6c6d5921832c2bad3bea96ca5.png',13,0,'2019-06-29 20:30:56',11),(4,'我对宇宙的认知','finesoul','转载自凡灵网(www.finesoul.ga)','宇宙','<h4><b>1. 时间是相对存在的,或许时间本身并不存在</b></h4><p>时间的意义在于我们对过去有怀念, 对未来有憧憬, 如果时间不存在, 那么过去就没有什么好怀念的, 未来也没什么好期待的, 我们只要活在当下就好.</p><h4><b>2. 宇宙存在更高维度, 我们的文明正在成长</b></h4><p>从文明进化的角度分析, 宇宙中一定存在更高纬度, 我们所处的三维世界绝不是整个宇宙. 人类文明至今仍处于摇篮阶段, 我们的周围很有可能存在高等文明, 随着人类文明的进化, 我们能看到的纬度会更多.</p><h4><b>3. 光速是不变的，时间流淌的速度可以改变</b></h4><p>NASA做过这样的实验: 当地球在以30Km/s的速度公转, 而从速度的前方和后方同时向地球发射一道光, 测出的光速竟然惊人的一致! 根据爱因斯坦的相对论, 处在质量超大的天体附近的时间, 当然, 快慢是相对而言的, 物体本身并不能感到时间变慢.</p><h4><b>4. 对于高等文明而言, 三维空间可能不屑一顾</b></h4><p>你会在意一个二维空间的文明发展吗? 或许高等文明就处在我们身边, 只是把我们当作虫子罢了, 只有我们的科技飞速进步时, 他们可能才派个飞行器看我们一眼. (罗斯威尔事件)</p><h4><b>5. 宇宙不止一个, 我们的宇宙不过是千亿分之一</b></h4><p>如果存在更高维度, 那么高维里可能存在无数个低纬世界, 这并不是平行宇宙的理论, 而高维的宇宙里存在多个类似的平行宇宙是很有可能的.</p><h3><i>写在最后: 宇宙有无数可能</i></h3><p style=\"text-align: center;\">宇宙有多种可能，我并不是某一种的坚定支持者，而是选择观望所有可能。</p>','static/uploads/20190627\\819fead9720d8dabe5f9108e54661a12.jpg',19,1,'2019-06-29 21:41:41',13),(5,'测试文章','Bitbull','测试的描述','测试,文章','<p>测试测试</p>',NULL,13,0,'2019-06-29 20:29:56',11),(10,'测试','123','','测试,文章,ssh','<p>ceshi</p>',NULL,9,0,'2019-06-29 21:42:55',11),(11,'测试标题5','123','测试','测试','<p><span style=\"\">测试</span><span style=\"\">测试</span><span style=\"\">测试</span><span style=\"\">测试</span><br></p>',NULL,4,0,'2019-06-29 21:01:50',11);
/*!40000 ALTER TABLE `tp_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_cate`
--

DROP TABLE IF EXISTS `tp_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_cate` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '栏目id',
  `catename` varchar(30) NOT NULL COMMENT '栏目名称',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_cate`
--

LOCK TABLES `tp_cate` WRITE;
/*!40000 ALTER TABLE `tp_cate` DISABLE KEYS */;
INSERT INTO `tp_cate` VALUES (11,'代码'),(13,'天际'),(12,'星空');
/*!40000 ALTER TABLE `tp_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_links`
--

DROP TABLE IF EXISTS `tp_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_links` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '链接id',
  `title` varchar(30) NOT NULL COMMENT '链接标题',
  `url` varchar(60) NOT NULL COMMENT '链接地址',
  `dsc` varchar(255) NOT NULL COMMENT '链接描述',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_links`
--

LOCK TABLES `tp_links` WRITE;
/*!40000 ALTER TABLE `tp_links` DISABLE KEYS */;
INSERT INTO `tp_links` VALUES (3,'推特','http://t.co','推特短链接'),(4,'油管','http://youtu.be','油管短链接');
/*!40000 ALTER TABLE `tp_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp_tags`
--

DROP TABLE IF EXISTS `tp_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp_tags` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(20) NOT NULL COMMENT '标签名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `标签索引` (`tagname`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp_tags`
--

LOCK TABLES `tp_tags` WRITE;
/*!40000 ALTER TABLE `tp_tags` DISABLE KEYS */;
INSERT INTO `tp_tags` VALUES (9,'认知'),(7,'脚本'),(8,'远程连接'),(6,'测试');
/*!40000 ALTER TABLE `tp_tags` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-29 21:44:37
