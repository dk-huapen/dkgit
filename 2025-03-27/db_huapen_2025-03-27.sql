-- MariaDB dump 10.19  Distrib 10.11.4-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_huapen
-- ------------------------------------------------------
-- Server version	10.11.4-MariaDB-1~deb12u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_memo`
--

DROP TABLE IF EXISTS `tb_memo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_memo` (
  `memo_id` int(11) NOT NULL AUTO_INCREMENT,
  `memo_content` varchar(20) NOT NULL,
  `memo_details` text NOT NULL,
  `memo_status` int(11) NOT NULL,
  `memo_type` int(11) NOT NULL,
  `memo_remarks` varchar(20) DEFAULT NULL,
  `memo_update_time` date NOT NULL,
  PRIMARY KEY (`memo_id`),
  KEY `memo_status` (`memo_status`),
  KEY `memo_type` (`memo_type`),
  CONSTRAINT `tb_memo_ibfk_1` FOREIGN KEY (`memo_status`) REFERENCES `tb_status` (`status_id`),
  CONSTRAINT `tb_memo_ibfk_2` FOREIGN KEY (`memo_type`) REFERENCES `tb_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_memo`
--

LOCK TABLES `tb_memo` WRITE;
/*!40000 ALTER TABLE `tb_memo` DISABLE KEYS */;
INSERT INTO `tb_memo` VALUES
(1,'第一阶段网站搭建进度记录','进度：出入库清单整理 \r\n进度：图纸bookrack.php,updata_file-图片和文件合并,台帐和台帐组的增加功能需要测试,其他页面添加二维码，job快速时间需要新增工作时间\r\n备件查看无五角星\r\n其他隐藏的也加入五角星\r\n\r\n技术培训和技术监督版面 表单验证提交到本页，出入库数量合法性检查防止负数 \r\n培训内容及时更新 ',3,3,'备注','2024-03-03'),
(2,'第二阶段台账录入工作','1.结束大批量录入工作；\r\n2.查漏补缺。\r\n\r\n电极型号尺寸\r\n采购计划登记 \r\n\r\nCEMS备件和照片登记',3,3,'','2024-04-21'),
(3,'第三阶段台账录入工作','1.对应逻辑保护清单完善点表中保护连锁信息；\r\n2.设备台帐组中信息完善-\r\n\r\n金积前置器更换记录文件整理\r\n\r\n定期工作关联相关设备',3,3,'设备与相关信息关联','2023-02-19'),
(4,'网站计划新增功能','工作票加入扫描文件填入表格功能\r\n出个模板-显示临时创建视图\r\n加入搜索无图片备件\r\n采购计划增加返修设备操作\r\n定期工作增加到期提醒功能\r\n停机工作关联（初步想在设备组中实现），磨煤机定期检查加入\r\n\r\n自动压缩图片\r\n增加生成PDF考勤表\r\n标准工作项中加入给煤机校验报告并可以存为pdf格式\r\n\r\n\r\n安装imagemagic-php，用php旋转压缩图片\r\n\r\n增加可维修备件及维修记录\r\n\r\n',1,3,'','2024-04-21'),
(5,'网站搭建中存在问题','表格字体样式大小统一-手机查看的台帐组日志中字体特别大\r\n字母数字开头关键字搜索翻页都有问题-搜索关键字时字母数字开头时翻页无法正常显示\r\n上传图片，已有时现在不覆盖，是否需要覆盖？\r\n安装markdown view，安装后仍然无法正常显示md文件\r\n未增加设备组按钮\r\n返回前一页面不刷新\r\nlook_purchase_list_wait.php中备注显示有点问题,现在没问题，在观察\r\n设备组新增中无设备组类型选项，添加失败\r\n库存查看表格更新\r\n\r\n\r\n\r\n\r\nlatex中关键点索引\r\n邮件带附件-记录mail过程\r\nmail收163邮件？\r\nlogwatch进一步完善内容\r\nphp-latex\r\n净烟气定期检查记录\r\n',3,3,'','2024-03-29'),
(6,'暖气费编号','1000163081',4,2,'','2022-12-04'),
(7,'娃娃药','小儿尺桥清热颗粒',1,2,'','2022-12-04'),
(8,'想读的书籍','神秘的程序员 什么塑造了今天的编程世界 漫画编程历史大事件（异步图书出品）\r\n面向对象是怎样工作的，已入手\r\nLinux是怎样工作的\r\n程序是怎样跑起来的\r\n计算机是怎样跑起来的\r\n网络是怎样连接的\r\n一个64位操作系统的设计与实现(图灵出品)\r\n图解机器学习四册 图解HTTP+图解TCP/IP +图解机器学习+图解深度学习白皮\r\n代码整洁之道\r\n图解算法\r\n程序员自我修养，已入手\r\n编码――隐匿在计算机软硬件背后的语言，已入手',1,1,'','2022-12-17'),
(9,'想做的事情','找个htlm模板\r\nphyton爬虫学习\r\njosn，xml对比学习\r\nlatex学习，将技术监督做成latex\r\njquery库学习\r\n通讯学习',1,1,'','2022-12-04'),
(10,'计划培训内容','中间变量\r\n函数_供：功能块\r\n延时闭合\r\n延时断开\r\n\r\n数据类型\r\n结构体\r\n类\r\n语言：梯形图，st语言，fb语言',1,4,'','2022-12-04'),
(11,'技术能手工作','找白签字，技术能手资料',3,4,'','2022-12-04'),
(12,'日常台帐录入工作进度','工作整理删除，开始使用:已开始，还有-1的1000多条，尽量替换使用\r\n\r\n整理核实故障设备和隐患设备：\r\n\r\n定期工作整理后加入定期工作清单-还有吹灰柜，燃油柜，DCS、',3,3,'','2022-12-08'),
(13,'油系统培训资料记录','安全油：润换油母管经过法兰引出，至AST电磁阀模块，至磁力断路油门，至主汽门，至汽轮机前箱内\r\n危急油：润换油母管经过法兰引出，至隔膜阀，至磁力断路油门，至汽轮机前箱内\r\n压力油：润换油母管经过16管引出，至AST电磁阀模块，至主汽门，至隔膜阀，至汽轮机前箱内\r\n\r\nEH油：控制油供至高中调门油动机\r\nOPC油：控制油经过变径进入opc模块出来了供至高中调门油动机卸荷阀\r\n',3,3,'','2022-12-05'),
(14,'为控制系统，设备台帐，设备组台帐写个简介','控制系统简介\r\n按控制系统厂家分类：ABB、Holisys、Tricon、Step200PLC。 按控制系统独立及相关性分类：主机DCS系统---1-4号锅炉、管网公用、1-5号汽轮机DCS；4、5号汽轮机DEH系统；4、5号汽轮机ETS系统；1、2、3号汽轮机DEH系统和ETS系统；脱硫DCS系统',3,3,'','2022-12-04');
/*!40000 ALTER TABLE `tb_memo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_status`
--

DROP TABLE IF EXISTS `tb_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_status` (
  `status_id` int(11) NOT NULL,
  `status_content` varchar(5) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_status`
--

LOCK TABLES `tb_status` WRITE;
/*!40000 ALTER TABLE `tb_status` DISABLE KEYS */;
INSERT INTO `tb_status` VALUES
(-1,'未选择'),
(0,'所有项'),
(1,'计划中'),
(2,'未开始'),
(3,'进行中'),
(4,'已完成');
/*!40000 ALTER TABLE `tb_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_type`
--

DROP TABLE IF EXISTS `tb_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_type` (
  `type_id` int(11) NOT NULL,
  `type_content` varchar(5) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_type`
--

LOCK TABLES `tb_type` WRITE;
/*!40000 ALTER TABLE `tb_type` DISABLE KEYS */;
INSERT INTO `tb_type` VALUES
(-1,'未选择'),
(0,'说有项'),
(1,'学习'),
(2,'生活'),
(3,'网站'),
(4,'工作');
/*!40000 ALTER TABLE `tb_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-27 16:15:02
