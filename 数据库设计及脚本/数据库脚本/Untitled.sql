CREATE DATABASE  IF NOT EXISTS `gogojp` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `gogojp`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: gogojp
-- ------------------------------------------------------
-- Server version	5.5.25

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
-- Table structure for table `gogojp_album`
--

DROP TABLE IF EXISTS `gogojp_album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_album` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '合辑id 主键自增',
  `album_name` varchar(80) NOT NULL COMMENT '合辑名称',
  `album_cover` varchar(120) DEFAULT NULL COMMENT '合辑封面',
  `album_description` varchar(2000) DEFAULT NULL COMMENT '合辑描述',
  `album_sign` varchar(30) DEFAULT NULL COMMENT '合辑标签',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `album_status` tinyint(4) DEFAULT '1' COMMENT '专辑状态 1:显示可用 2：禁用',
  PRIMARY KEY (`album_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商品合辑表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_album`
--

LOCK TABLES `gogojp_album` WRITE;
/*!40000 ALTER TABLE `gogojp_album` DISABLE KEYS */;
INSERT INTO `gogojp_album` VALUES (1,'日本小清新合辑',NULL,'小清新系列，不错哦','清新','2014-05-07 06:56:00',1),(2,'韩国重口味合辑',NULL,'重口味系列','鞭打','2014-05-07 13:30:22',1);
/*!40000 ALTER TABLE `gogojp_album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_album_product`
--

DROP TABLE IF EXISTS `gogojp_album_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_album_product` (
  `album_product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '合辑商品自增id 表的主键',
  `product_id` bigint(20) DEFAULT NULL COMMENT '商品id',
  `product_name` varchar(50) DEFAULT NULL COMMENT '商品名称',
  `album_id` int(11) DEFAULT NULL COMMENT '合辑id',
  `small_pic` varchar(50) DEFAULT NULL COMMENT '合辑中商品的缩率图',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`album_product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='合辑商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_album_product`
--

LOCK TABLES `gogojp_album_product` WRITE;
/*!40000 ALTER TABLE `gogojp_album_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `gogojp_album_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_area`
--

DROP TABLE IF EXISTS `gogojp_area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID主键',
  `name` varchar(50) NOT NULL COMMENT '中文名称',
  `pid` int(11) NOT NULL COMMENT '上一级ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=616 DEFAULT CHARSET=utf8 COMMENT='地区表（省份、城市、区域）';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_area`
--

LOCK TABLES `gogojp_area` WRITE;
/*!40000 ALTER TABLE `gogojp_area` DISABLE KEYS */;
INSERT INTO `gogojp_area` VALUES (1,'北京市',0),(2,'天津市',0),(3,'上海市',0),(4,'重庆市',0),(5,'河北省',0),(6,'山西省',0),(7,'台湾省',0),(8,'辽宁省',0),(9,'吉林省',0),(10,'黑龙江省',0),(11,'江苏省',0),(12,'浙江省',0),(13,'安徽省',0),(14,'福建省',0),(15,'江西省',0),(16,'山东省',0),(17,'河南省',0),(18,'湖北省',0),(19,'湖南省',0),(20,'广东省',0),(21,'甘肃省',0),(22,'四川省',0),(23,'贵州省',0),(24,'海南省',0),(25,'云南省',0),(26,'青海省',0),(27,'陕西省',0),(28,'广西壮族自治区',0),(29,'西藏自治区',0),(30,'宁夏回族自治区',0),(31,'新疆维吾尔自治区',0),(32,'内蒙古自治区',0),(33,'澳门特别行政区',0),(34,'香港特别行政区',0),(35,'北京市',1),(36,'天津市',2),(37,'上海市',3),(38,'重庆市',4),(50,'沈阳市',8),(51,'大连市',8),(52,'鞍山市',8),(53,'抚顺市',8),(54,'本溪市',8),(55,'丹东市',8),(56,'锦州市',8),(57,'营口市',8),(58,'阜新市',8),(59,'辽阳市',8),(60,'盘锦市',8),(61,'铁岭市',8),(62,'朝阳市',8),(63,'葫芦岛市',8),(64,'长春市',9),(65,'吉林市',9),(66,'四平市',9),(67,'辽源市',9),(68,'通化市',9),(69,'白山市',9),(70,'松原市',9),(71,'白城市',9),(72,'延边朝鲜族自治州',9),(73,'哈尔滨市',10),(74,'齐齐哈尔市',10),(75,'鹤 岗 市',10),(76,'双鸭山市',10),(77,'鸡 西 市',10),(78,'大 庆 市',10),(79,'伊 春 市',10),(80,'牡丹江市',10),(81,'佳木斯市',10),(82,'七台河市',10),(83,'黑 河 市',10),(84,'绥 化 市',10),(85,'大兴安岭地区',10),(86,'南京市',11),(87,'无锡市',11),(88,'徐州市',11),(89,'常州市',11),(90,'苏州市',11),(91,'南通市',11),(92,'连云港市',11),(93,'淮安市',11),(94,'盐城市',11),(95,'扬州市',11),(96,'镇江市',11),(97,'泰州市',11),(98,'宿迁市',11),(99,'杭州市',12),(100,'宁波市',12),(101,'温州市',12),(102,'嘉兴市',12),(103,'湖州市',12),(104,'绍兴市',12),(105,'金华市',12),(106,'衢州市',12),(107,'舟山市',12),(108,'台州市',12),(109,'丽水市',12),(110,'合肥市',13),(111,'芜湖市',13),(112,'蚌埠市',13),(113,'淮南市',13),(114,'马鞍山市',13),(115,'淮北市',13),(116,'铜陵市',13),(117,'安庆市',13),(118,'黄山市',13),(119,'滁州市',13),(120,'阜阳市',13),(121,'宿州市',13),(122,'巢湖市',13),(123,'六安市',13),(124,'亳州市',13),(125,'池州市',13),(126,'宣城市',13),(127,'福州市',14),(128,'厦门市',14),(129,'莆田市',14),(130,'三明市',14),(131,'泉州市',14),(132,'漳州市',14),(133,'南平市',14),(134,'龙岩市',14),(135,'宁德市',14),(136,'南昌市',15),(137,'景德镇市',15),(138,'萍乡市',15),(139,'九江市',15),(140,'新余市',15),(141,'鹰潭市',15),(142,'赣州市',15),(143,'吉安市',15),(144,'宜春市',15),(145,'抚州市',15),(146,'上饶市',15),(147,'济南市',16),(148,'青岛市',16),(149,'淄博市',16),(150,'枣庄市',16),(151,'东营市',16),(152,'烟台市',16),(153,'潍坊市',16),(154,'济宁市',16),(155,'泰安市',16),(156,'威海市',16),(157,'日照市',16),(158,'莱芜市',16),(159,'临沂市',16),(160,'德州市',16),(161,'聊城市',16),(162,'滨州市',16),(163,'菏泽市',16),(164,'郑州市',17),(165,'开封市',17),(166,'洛阳市',17),(167,'平顶山市',17),(168,'安阳市',17),(169,'鹤壁市',17),(170,'新乡市',17),(171,'焦作市',17),(172,'濮阳市',17),(173,'许昌市',17),(174,'漯河市',17),(175,'三门峡市',17),(176,'南阳市',17),(177,'商丘市',17),(178,'信阳市',17),(179,'周口市',17),(180,'驻马店市',17),(181,'济源市',17),(182,'武汉市',18),(183,'黄石市',18),(184,'十堰市',18),(185,'荆州市',18),(186,'宜昌市',18),(187,'襄樊市',18),(188,'鄂州市',18),(189,'荆门市',18),(190,'孝感市',18),(191,'黄冈市',18),(192,'咸宁市',18),(193,'随州市',18),(194,'仙桃市',18),(195,'天门市',18),(196,'潜江市',18),(197,'神农架林区',18),(198,'恩施土家族苗族自治州',18),(199,'长沙市',19),(200,'株洲市',19),(201,'湘潭市',19),(202,'衡阳市',19),(203,'邵阳市',19),(204,'岳阳市',19),(205,'常德市',19),(206,'张家界市',19),(207,'益阳市',19),(208,'郴州市',19),(209,'永州市',19),(210,'怀化市',19),(211,'娄底市',19),(212,'湘西土家族苗族自治州',19),(213,'广州市',20),(214,'深圳市',20),(215,'珠海市',20),(216,'汕头市',20),(217,'韶关市',20),(218,'佛山市',20),(219,'江门市',20),(220,'湛江市',20),(221,'茂名市',20),(222,'肇庆市',20),(223,'惠州市',20),(224,'梅州市',20),(225,'汕尾市',20),(226,'河源市',20),(227,'阳江市',20),(228,'清远市',20),(229,'东莞市',20),(230,'中山市',20),(231,'潮州市',20),(232,'揭阳市',20),(233,'云浮市',20),(234,'兰州市',21),(235,'金昌市',21),(236,'白银市',21),(237,'天水市',21),(238,'嘉峪关市',21),(239,'武威市',21),(240,'张掖市',21),(241,'平凉市',21),(242,'酒泉市',21),(243,'庆阳市',21),(244,'定西市',21),(245,'陇南市',21),(246,'临夏回族自治州',21),(247,'甘南藏族自治州',21),(248,'成都市',22),(249,'自贡市',22),(250,'攀枝花市',22),(251,'泸州市',22),(252,'德阳市',22),(253,'绵阳市',22),(254,'广元市',22),(255,'遂宁市',22),(256,'内江市',22),(257,'乐山市',22),(258,'南充市',22),(259,'眉山市',22),(260,'宜宾市',22),(261,'广安市',22),(262,'达州市',22),(263,'雅安市',22),(264,'巴中市',22),(265,'资阳市',22),(266,'阿坝藏族羌族自治州',22),(267,'甘孜藏族自治州',22),(268,'凉山彝族自治州',22),(269,'贵阳市',23),(270,'六盘水市',23),(271,'遵义市',23),(272,'安顺市',23),(273,'铜仁地区',23),(274,'毕节地区',23),(275,'黔西南布依族苗族自治州',23),(276,'黔东南苗族侗族自治州',23),(277,'黔南布依族苗族自治州',23),(278,'海口市',24),(279,'三亚市',24),(280,'五指山市',24),(281,'琼海市',24),(282,'儋州市',24),(283,'文昌市',24),(284,'万宁市',24),(285,'东方市',24),(286,'澄迈县',24),(287,'定安县',24),(288,'屯昌县',24),(289,'临高县',24),(290,'白沙黎族自治县',24),(291,'昌江黎族自治县',24),(292,'乐东黎族自治县',24),(293,'陵水黎族自治县',24),(294,'保亭黎族苗族自治县',24),(295,'琼中黎族苗族自治县',24),(296,'昆明市',25),(297,'曲靖市',25),(298,'玉溪市',25),(299,'保山市',25),(300,'昭通市',25),(301,'丽江市',25),(302,'思茅市',25),(303,'临沧市',25),(304,'文山壮族苗族自治州',25),(305,'红河哈尼族彝族自治州',25),(306,'西双版纳傣族自治州',25),(307,'楚雄彝族自治州',25),(308,'大理白族自治州',25),(309,'德宏傣族景颇族自治州',25),(310,'怒江傈傈族自治州',25),(311,'迪庆藏族自治州',25),(312,'西宁市',26),(313,'海东地区',26),(314,'海北藏族自治州',26),(315,'黄南藏族自治州',26),(316,'海南藏族自治州',26),(317,'果洛藏族自治州',26),(318,'玉树藏族自治州',26),(319,'海西蒙古族藏族自治州',26),(320,'西安市',27),(321,'铜川市',27),(322,'宝鸡市',27),(323,'咸阳市',27),(324,'渭南市',27),(325,'延安市',27),(326,'汉中市',27),(327,'榆林市',27),(328,'安康市',27),(329,'商洛市',27),(330,'南宁市',28),(331,'柳州市',28),(332,'桂林市',28),(333,'梧州市',28),(334,'北海市',28),(335,'防城港市',28),(336,'钦州市',28),(337,'贵港市',28),(338,'玉林市',28),(339,'百色市',28),(340,'贺州市',28),(341,'河池市',28),(342,'来宾市',28),(343,'崇左市',28),(344,'拉萨市',29),(345,'那曲地区',29),(346,'昌都地区',29),(347,'山南地区',29),(348,'日喀则地区',29),(349,'阿里地区',29),(350,'林芝地区',29),(351,'银川市',30),(352,'石嘴山市',30),(353,'吴忠市',30),(354,'固原市',30),(355,'中卫市',30),(356,'乌鲁木齐市',31),(357,'克拉玛依市',31),(358,'石河子市　',31),(359,'阿拉尔市',31),(360,'图木舒克市',31),(361,'五家渠市',31),(362,'吐鲁番市',31),(363,'阿克苏市',31),(364,'喀什市',31),(365,'哈密市',31),(366,'和田市',31),(367,'阿图什市',31),(368,'库尔勒市',31),(369,'昌吉市　',31),(370,'阜康市',31),(371,'米泉市',31),(372,'博乐市',31),(373,'伊宁市',31),(374,'奎屯市',31),(375,'塔城市',31),(376,'乌苏市',31),(377,'阿勒泰市',31),(378,'呼和浩特市',32),(379,'包头市',32),(380,'乌海市',32),(381,'赤峰市',32),(382,'通辽市',32),(383,'鄂尔多斯市',32),(384,'呼伦贝尔市',32),(385,'巴彦淖尔市',32),(386,'乌兰察布市',32),(387,'锡林郭勒盟',32),(388,'兴安盟',32),(389,'阿拉善盟',32),(390,'澳门特别行政区',33),(391,'香港特别行政区',34),(400,'石家庄市',5),(401,'唐山市',5),(402,'秦皇岛市',5),(403,'邯郸市',5),(404,'邢台市',5),(405,'保定市',5),(406,'张家口市',5),(407,'承德市',5),(408,'沧州市',5),(409,'廊坊市',5),(410,'衡水市',5),(416,'太原市',6),(417,'大同市',6),(418,'阳泉市',6),(419,'长治市',6),(420,'晋城市',6),(421,'朔州市',6),(422,'晋中市',6),(423,'运城市',6),(424,'忻州市',6),(425,'临汾市',6),(426,'吕梁市',6),(427,'台北市',7),(428,'高雄市',7),(429,'基隆市',7),(430,'台中市',7),(431,'台南市',7),(432,'新竹市',7),(433,'嘉义市',7),(434,'台北县',7),(435,'宜兰县',7),(436,'桃园县',7),(437,'新竹县',7),(438,'苗栗县',7),(439,'台中县',7),(440,'彰化县',7),(441,'南投县',7),(442,'云林县',7),(443,'嘉义县',7),(444,'台南县',7),(445,'高雄县',7),(446,'屏东县',7),(447,'澎湖县',7),(448,'台东县',7),(449,'花莲县',7),(500,'锦江区',248),(501,'青羊区',248),(502,'金牛区',248),(503,'武侯区',248),(504,'成华区',248),(507,'白莲桥',504),(508,'三河场',504),(509,'天回镇',504),(510,'动物园',504),(511,'青龙场',504),(512,'昭觉寺',504),(513,'火车北站',504),(514,'驷马桥',504),(515,'高笋塘',504),(516,'双林路',504),(517,'太升南路',504),(518,'熊猫基地',504),(519,'北湖客运站',504),(520,'富森美家居',504),(521,'新桥',504),(522,'陆军总医院',504),(523,'琉璃场',500),(524,'万达广场',500),(525,'桦林园',500),(526,'金象市',500),(527,'社科院',500),(528,'沙河大桥',500),(530,'八宝街1号',501),(531,'清江中路1号',501),(532,'骡马市',501),(533,'小科甲巷第一城A座1511',500),(534,'城守东大街85号东大商业广场1楼16号(近香槟广场)',500),(535,'清江东路354号1栋3单元201号 ',501),(536,'春熙路',500),(537,'伊藤对面爱家丽苑小区5单元11楼19号',500),(538,'青龙街18号ROME国际2号楼新锐阁17楼11号',501),(539,'人民南路',503),(540,'人民南路',503),(541,'亚太广场',503),(542,'伊藤对面京都大厦18楼9号',500),(543,'数码广场',503),(544,'近郊熊猫大道1375号(近北湖)',501),(545,'学府影城',503),(546,'百花',503),(547,'总府路',500),(548,'瑞升花园',503),(549,'青羊区长顺街',501),(550,'春熙路',501),(551,'通锦路',502),(552,'草市街',501),(553,'青羊区酱园公所街58号',501),(554,'火车南站',503),(555,'青羊区酱园公所街58号',501),(556,'超洋花园',503),(557,'宏明商厦',504),(558,'恒远大厦',502),(559,'金港赛道',500),(560,'凯德广场',502),(561,'蜀都大道',501),(562,'南门武候祠大街',503),(563,'青羊宫',501),(564,'草堂路',501),(565,'数码广场',503),(566,'顺城大街',501),(567,'盐市口',500),(568,'京川宾馆',501),(569,'西华大道',502),(570,'四川大学',503),(571,'一环路西二段',501),(572,'沙湾路',502),(573,'一环路西二段',501),(574,'京川宾馆',503),(575,'高升桥',503),(576,'杜甫草堂',503),(577,'火车南站',503),(578,'杜甫草堂',501),(579,'成都市中同仁路55号（市妇幼保健院旁）',501),(581,'武侯祠大街',503),(582,'武侯大道双楠段94号',503),(583,'银沙路',502),(584,'一环路西三段',502),(585,'金沙车站',501),(586,'高新区',248),(590,'双流县',248),(601,'合江亭',500),(602,'东光小区',500),(603,'牛市口',500),(604,'四川师大',500),(605,'西南交大',502),(606,'抚琴',502),(607,'梁家巷',502),(608,'桐梓林',503),(609,'科华北路',503),(610,'玉林',503),(611,'建设路',504),(612,'马鞍路',504),(613,'水碾河',504),(614,'宽窄巷子',501),(615,'近郊',248);
/*!40000 ALTER TABLE `gogojp_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_area_district`
--

DROP TABLE IF EXISTS `gogojp_area_district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_area_district` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商圈id',
  `name` varchar(30) NOT NULL COMMENT '商圈名称',
  `desc` varchar(1000) NOT NULL COMMENT '商圈描述',
  `city_id` int(11) NOT NULL COMMENT '所在城市',
  `area_id` int(11) NOT NULL DEFAULT '0' COMMENT '所在区域（可以不对应区域）',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否热门',
  `picture_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '升序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='商圈表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_area_district`
--

LOCK TABLES `gogojp_area_district` WRITE;
/*!40000 ALTER TABLE `gogojp_area_district` DISABLE KEYS */;
INSERT INTO `gogojp_area_district` VALUES (2,'来福士商圈','但是发生的发生地方的DFGDGfgdfg$#%#$%',248,503,0,63065,0),(3,'凯丹商圈','佛挡杀佛',248,586,0,63478,1),(10,'春熙路商圈','',248,500,0,63148,1),(19,'王府井','二环科华路口',248,503,0,75661,1),(20,'反对法','fd',248,500,0,75662,0),(21,'士大夫','sdf',248,501,0,75663,0),(22,'第三方','多方',248,501,0,75664,0),(23,'发的','发的',248,500,0,75665,0),(24,'非','发的',248,504,0,75666,0);
/*!40000 ALTER TABLE `gogojp_area_district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_area_street`
--

DROP TABLE IF EXISTS `gogojp_area_street`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_area_street` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商街id',
  `name` varchar(100) NOT NULL COMMENT '商街名称',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '商街类型（1=美食街；其他待定）',
  `city_id` int(11) NOT NULL COMMENT '所在城市',
  `area_id` int(11) NOT NULL DEFAULT '0' COMMENT '所在区域',
  `district_id` int(11) NOT NULL DEFAULT '0' COMMENT '所在商圈',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否热门',
  `picture_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '升序',
  `desc` varchar(500) DEFAULT NULL COMMENT '简介',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='商街表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_area_street`
--

LOCK TABLES `gogojp_area_street` WRITE;
/*!40000 ALTER TABLE `gogojp_area_street` DISABLE KEYS */;
INSERT INTO `gogojp_area_street` VALUES (1,'一品天下美食街',1,248,502,0,1,4143,0,NULL),(2,'玉林美食街',1,248,503,2,1,4146,0,NULL),(4,'琴台路美食街',1,248,501,0,1,63481,-9,NULL),(5,'少陵路美食街',1,248,503,0,0,43097,0,NULL),(6,'外双楠美食街',1,248,503,0,0,43108,0,NULL),(7,'双楠红牌楼美食街',1,248,503,0,0,63413,0,NULL),(8,'肖家河美食街',1,248,503,0,0,44152,0,NULL),(9,'祥和里美食街',1,248,504,0,0,44452,0,NULL),(10,'八宝街美食街',1,248,501,0,0,70764,0,NULL),(12,'郭家桥西街',1,248,502,0,0,75667,0,NULL);
/*!40000 ALTER TABLE `gogojp_area_street` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_customer_advisory`
--

DROP TABLE IF EXISTS `gogojp_customer_advisory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_customer_advisory` (
  `advisory_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表的自增主键',
  `customer_id` int(11) DEFAULT NULL COMMENT '客户id',
  `customer_account` varchar(25) DEFAULT NULL COMMENT '客户账号',
  `customer_nickname` varchar(20) DEFAULT NULL COMMENT '客户昵称',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `isread` tinyint(4) DEFAULT '0' COMMENT '是否已读 (0:未读 1:已读)',
  PRIMARY KEY (`advisory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='客户咨询';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_customer_advisory`
--

LOCK TABLES `gogojp_customer_advisory` WRITE;
/*!40000 ALTER TABLE `gogojp_customer_advisory` DISABLE KEYS */;
INSERT INTO `gogojp_customer_advisory` VALUES (1,1,'3243','test','2014-05-11 05:49:16',0);
/*!40000 ALTER TABLE `gogojp_customer_advisory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_message`
--

DROP TABLE IF EXISTS `gogojp_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_message` (
  `messageid` int(11) NOT NULL AUTO_INCREMENT COMMENT '消息id',
  `form_userid` int(11) DEFAULT NULL COMMENT '消息发问人',
  `to_userid` int(11) DEFAULT NULL COMMENT '消息接收人id',
  `content` varchar(1000) DEFAULT NULL COMMENT '发送消息内容',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `advisory_id` int(11) DEFAULT NULL COMMENT '咨询表相关的外键',
  PRIMARY KEY (`messageid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='客户聊天记录';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_message`
--

LOCK TABLES `gogojp_message` WRITE;
/*!40000 ALTER TABLE `gogojp_message` DISABLE KEYS */;
INSERT INTO `gogojp_message` VALUES (1,1,0,'对方是否','2014-05-11 05:47:41',1);
/*!40000 ALTER TABLE `gogojp_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_order`
--

DROP TABLE IF EXISTS `gogojp_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_order` (
  `orderid` int(25) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(45) NOT NULL COMMENT '订单编号',
  `user_id` int(11) NOT NULL COMMENT '用户标示   主键',
  `user_account` varchar(45) NOT NULL COMMENT '购买账号',
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '订单产生时间',
  `order_freight` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单运费',
  `order_totalprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总价',
  `order_payment` tinyint(4) NOT NULL COMMENT '支付方式 1：支付宝 ',
  `order_status` tinyint(4) NOT NULL COMMENT '订单状态 1：未处理 2：已处理  3：已发货',
  `order_status_update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '订单状态修改时间',
  `order_receive_address` varchar(50) NOT NULL COMMENT '订单收货地址字符串',
  `order_receive_name` varchar(20) NOT NULL COMMENT '订单收货人名字',
  `order_receive_mobile` int(11) DEFAULT NULL COMMENT '订单接收人手机',
  `order_receive_phone` varchar(20) DEFAULT NULL COMMENT '订单接收人座机',
  `order_receive_postcode` varchar(10) DEFAULT NULL COMMENT '订单接受人邮编',
  `remark` varchar(100) DEFAULT NULL COMMENT '备注',
  `order_pay_account` varchar(45) NOT NULL COMMENT '支付账号',
  `logistics_status` int(11) NOT NULL DEFAULT '1' COMMENT '物流状态：1：未发货 2：国外代购中 3：国外物流中转中 4：已到达国内 5：国内物流转运中 6：已签收',
  `pay_time` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '付款时间',
  PRIMARY KEY (`orderid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='用户订单';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_order`
--

LOCK TABLES `gogojp_order` WRITE;
/*!40000 ALTER TABLE `gogojp_order` DISABLE KEYS */;
INSERT INTO `gogojp_order` VALUES (1,'dd34343545',1,'123213213','2014-04-09 03:03:27',8.00,123.00,1,2,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',4,'0000-00-00 00:00:00'),(2,'dd12314356',1,'123213213','2014-04-10 03:03:27',8.00,324.00,1,2,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',1,'0000-00-00 00:00:00'),(3,'dd67577657',1,'123213213','2014-05-09 03:03:27',8.00,22.00,1,3,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',4,'0000-00-00 00:00:00'),(4,'dd56765756',1,'123213213','2014-05-09 03:03:27',8.00,54.00,1,4,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',3,'0000-00-00 00:00:00'),(5,'dd87787875',1,'123213213','2014-05-09 03:03:27',8.00,567.00,1,1,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',5,'0000-00-00 00:00:00'),(6,'dd54654654',1,'123213213','2014-05-09 03:03:27',8.00,56.00,1,2,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',2,'0000-00-00 00:00:00'),(7,'dd54645645',1,'123213213','2014-05-09 03:03:27',8.00,86.00,1,3,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',6,'0000-00-00 00:00:00'),(8,'dd56756765',1,'123213213','2014-05-09 03:03:27',8.00,76.00,1,4,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',1,'0000-00-00 00:00:00'),(9,'dd34535435',1,'123213213','2014-05-09 03:03:27',8.00,686.00,1,1,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',2,'0000-00-00 00:00:00'),(10,'dd67585855',1,'123213213','2014-05-09 03:03:27',8.00,7879.00,1,2,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',3,'0000-00-00 00:00:00'),(11,'dd98394298',1,'123213213','2014-05-09 03:03:27',8.00,123.00,1,2,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',5,'0000-00-00 00:00:00'),(12,'dd49835000',1,'123213213','2014-05-09 03:03:27',8.00,76.00,1,4,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',5,'0000-00-00 00:00:00'),(13,'dd09070699',1,'123213213','2014-05-09 03:03:27',8.00,98.00,1,1,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',6,'0000-00-00 00:00:00'),(14,'dd86054022',1,'123213213','2014-05-09 03:03:27',8.00,45.00,1,1,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',1,'0000-00-00 00:00:00'),(15,'dd45894088',1,'123213213','2014-05-09 03:03:27',8.00,34.00,1,1,'0000-00-00 00:00:00','1','1',1,NULL,'1','12','1',4,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `gogojp_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_orderitem`
--

DROP TABLE IF EXISTS `gogojp_orderitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_orderitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表的自增主键',
  `order_no` varchar(45) NOT NULL COMMENT '订单编号 外键',
  `productid` bigint(20) NOT NULL COMMENT '商品编号',
  `buynumber` int(11) NOT NULL DEFAULT '1' COMMENT '购买商品数量',
  `prodcut_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '购买时商品单价 ',
  `product_name` varchar(128) NOT NULL COMMENT '商品名称',
  `pic_url` varchar(256) DEFAULT NULL COMMENT '商品放大的图片',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type_remark` varchar(90) NOT NULL COMMENT '属性备注',
  `product_num` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='订单项目信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_orderitem`
--

LOCK TABLES `gogojp_orderitem` WRITE;
/*!40000 ALTER TABLE `gogojp_orderitem` DISABLE KEYS */;
INSERT INTO `gogojp_orderitem` VALUES (1,'dd34343545',1,1,333.01,'阿迪达斯运动鞋',NULL,'2014-05-09 07:42:30','35码白色','ad3423432'),(2,'dd34343545',2,2,444.22,'乔丹运动鞋',NULL,'2014-05-09 07:42:30','35码撞色','qd234235');
/*!40000 ALTER TABLE `gogojp_orderitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_product_r_standard`
--

DROP TABLE IF EXISTS `gogojp_product_r_standard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_product_r_standard` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `product_id` int(11) NOT NULL,
  `standard_id` int(11) NOT NULL COMMENT '规格参数id',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `standard_parent_id` int(11) NOT NULL COMMENT '规格类型id(面料，尺寸,颜色等ID)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商品与规格参数关联表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_product_r_standard`
--

LOCK TABLES `gogojp_product_r_standard` WRITE;
/*!40000 ALTER TABLE `gogojp_product_r_standard` DISABLE KEYS */;
INSERT INTO `gogojp_product_r_standard` VALUES (1,1,4,'2014-05-12 15:13:32',1),(2,1,7,'2014-05-12 15:13:32',2),(3,1,12,'2014-05-12 15:13:32',3);
/*!40000 ALTER TABLE `gogojp_product_r_standard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_productcategory`
--

DROP TABLE IF EXISTS `gogojp_productcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_productcategory` (
  `catid` int(11) NOT NULL AUTO_INCREMENT COMMENT '类别编号',
  `cat_name` varchar(20) NOT NULL COMMENT '类别名称',
  `parentid` int(11) DEFAULT NULL COMMENT '父级类别',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `status` tinyint(4) DEFAULT '1' COMMENT '类别是否禁用 （ 1:启用 2：禁用）',
  `level` int(11) NOT NULL COMMENT '分类层级',
  PRIMARY KEY (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='商品类别信息';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_productcategory`
--

LOCK TABLES `gogojp_productcategory` WRITE;
/*!40000 ALTER TABLE `gogojp_productcategory` DISABLE KEYS */;
INSERT INTO `gogojp_productcategory` VALUES (10,'女装',0,'2014-05-11 18:02:59',1,1),(9,'男装',0,'2014-05-11 18:02:29',1,1),(12,'女装上衣',10,'2014-05-11 18:03:34',1,2),(11,'儿童装',0,'2014-05-11 18:03:13',1,1),(19,'男装外套',9,'2014-05-11 18:05:35',1,2),(14,'那幢',9,'2014-05-11 18:03:55',1,2),(15,'外套',9,'2014-05-11 18:04:03',1,2),(16,'小学生',11,'2014-05-11 18:04:11',1,2),(17,'什么',10,'2014-05-11 18:04:20',1,2),(18,'搞不懂',9,'2014-05-11 18:04:32',1,2),(20,'喜爱',10,'2014-05-11 18:05:51',1,2),(21,'伸进病',10,'2014-05-11 18:06:00',1,2),(22,'什么飞机',9,'2014-05-11 18:06:11',1,2),(23,'jb',11,'2014-05-11 18:06:25',1,2),(24,'人妖装',0,'2014-05-11 18:06:46',1,1),(25,'官人',24,'2014-05-11 18:06:54',1,2),(26,'少妇',10,'2014-05-11 18:08:35',1,2),(27,'控件',10,'2014-05-11 18:09:11',1,2);
/*!40000 ALTER TABLE `gogojp_productcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_productinfo`
--

DROP TABLE IF EXISTS `gogojp_productinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_productinfo` (
  `productid` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '商品编号',
  `catid` int(11) DEFAULT NULL COMMENT '类别编号  外键',
  `sign` varchar(50) DEFAULT NULL COMMENT '商品标签',
  `product_name` varchar(128) NOT NULL COMMENT '商品名称',
  `unit` varchar(11) DEFAULT NULL COMMENT '商品单位',
  `old_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `new_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品现价',
  `small_pic` varchar(100) DEFAULT NULL COMMENT '缩率图',
  `big_pic` varchar(100) DEFAULT NULL COMMENT '放大的图片',
  `product_description` varchar(2000) DEFAULT NULL COMMENT '商品简介',
  `product_count` int(11) DEFAULT NULL COMMENT '库存量',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `product_num` varchar(50) NOT NULL COMMENT '商品货号',
  `product_status` tinyint(4) DEFAULT '1' COMMENT '商品上架状态 1：上架 2：下架',
  `product_tag_id` int(11) NOT NULL COMMENT '商品标签id',
  PRIMARY KEY (`productid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商品信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_productinfo`
--

LOCK TABLES `gogojp_productinfo` WRITE;
/*!40000 ALTER TABLE `gogojp_productinfo` DISABLE KEYS */;
INSERT INTO `gogojp_productinfo` VALUES (1,1,'流行','韩国名牌内衣',NULL,1200.00,1100.00,NULL,NULL,'好质量',11,'2014-05-05 09:00:37','1399280425',1,0),(2,2,'古典','日本古典内衣',NULL,1300.00,1000.00,NULL,NULL,'古典美',10,'2014-05-11 08:43:33','1399270425',1,0);
/*!40000 ALTER TABLE `gogojp_productinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_shippingaddress`
--

DROP TABLE IF EXISTS `gogojp_shippingaddress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_shippingaddress` (
  `shipping_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表的自增主键 ',
  `receive_name` varchar(11) DEFAULT NULL COMMENT '接受人名字',
  `receive_address` varchar(56) DEFAULT NULL COMMENT '收货人详细地址',
  `receive_mobile` int(11) DEFAULT NULL COMMENT '收货人联系手机',
  `user_id` int(11) DEFAULT NULL COMMENT '会员id  ',
  `receive_postcode` varchar(8) DEFAULT NULL,
  `receive_phone` varchar(20) DEFAULT NULL COMMENT '接受人座机电话',
  `province_id` int(11) DEFAULT NULL COMMENT '省id',
  `city_id` int(11) DEFAULT NULL COMMENT '市id',
  `county_id` int(11) DEFAULT NULL COMMENT '县id',
  `country_id` int(11) DEFAULT NULL COMMENT '国家id',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`shipping_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收货地址管理';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_shippingaddress`
--

LOCK TABLES `gogojp_shippingaddress` WRITE;
/*!40000 ALTER TABLE `gogojp_shippingaddress` DISABLE KEYS */;
/*!40000 ALTER TABLE `gogojp_shippingaddress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_standard`
--

DROP TABLE IF EXISTS `gogojp_standard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_standard` (
  `standard_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `parent_name` varchar(45) DEFAULT NULL COMMENT '规格类型：面料，尺寸，颜色',
  `standard_parent_id` int(11) DEFAULT '0' COMMENT '规格参数父类id',
  `child_name` varchar(45) DEFAULT NULL COMMENT '规格参数',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`standard_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='商品规格参数基本数据表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_standard`
--

LOCK TABLES `gogojp_standard` WRITE;
/*!40000 ALTER TABLE `gogojp_standard` DISABLE KEYS */;
INSERT INTO `gogojp_standard` VALUES (1,'面料',0,NULL,'0000-00-00 00:00:00'),(2,'尺寸',0,NULL,'0000-00-00 00:00:00'),(3,'颜色',0,NULL,'0000-00-00 00:00:00'),(4,'',1,'牛皮','0000-00-00 00:00:00'),(5,NULL,1,'猪皮','0000-00-00 00:00:00'),(6,NULL,1,'人造革','0000-00-00 00:00:00'),(7,NULL,2,'S','0000-00-00 00:00:00'),(8,NULL,2,'M','0000-00-00 00:00:00'),(9,NULL,2,'L','0000-00-00 00:00:00'),(10,NULL,2,'XL','0000-00-00 00:00:00'),(11,NULL,2,'XXL','0000-00-00 00:00:00'),(12,NULL,3,'浅蓝','0000-00-00 00:00:00'),(13,NULL,3,'深红','0000-00-00 00:00:00'),(14,NULL,3,'淡黄','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `gogojp_standard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_sys_picture_management`
--

DROP TABLE IF EXISTS `gogojp_sys_picture_management`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_sys_picture_management` (
  `picid` int(11) NOT NULL AUTO_INCREMENT COMMENT '表的自增主键 ',
  `pic_title` varchar(50) DEFAULT NULL COMMENT '图片自定义名称标题',
  `big_pic` varchar(56) DEFAULT NULL COMMENT '图片大图',
  `small_pic` varchar(50) DEFAULT NULL COMMENT '缩率图',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  `album_id` int(11) DEFAULT NULL COMMENT '合辑id',
  `istop` tinyint(4) DEFAULT '0' COMMENT '是否置顶 0:取消置顶 1:置顶',
  PRIMARY KEY (`picid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统幻灯片，首页推荐图片管理';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_sys_picture_management`
--

LOCK TABLES `gogojp_sys_picture_management` WRITE;
/*!40000 ALTER TABLE `gogojp_sys_picture_management` DISABLE KEYS */;
/*!40000 ALTER TABLE `gogojp_sys_picture_management` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_tags`
--

DROP TABLE IF EXISTS `gogojp_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(90) NOT NULL,
  `tag_decription` varchar(400) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '标签表',
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_tags`
--

LOCK TABLES `gogojp_tags` WRITE;
/*!40000 ALTER TABLE `gogojp_tags` DISABLE KEYS */;
INSERT INTO `gogojp_tags` VALUES (1,'时尚','好好','2014-05-13 06:24:27'),(2,'淑女','婉约','2014-05-13 06:24:27'),(3,'熟女','热辣','2014-05-13 06:24:27');
/*!40000 ALTER TABLE `gogojp_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gogojp_user`
--

DROP TABLE IF EXISTS `gogojp_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gogojp_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户标示   主键',
  `user_name` varchar(64) DEFAULT NULL COMMENT '用户名',
  `password` varchar(64) DEFAULT NULL COMMENT '密码',
  `email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `user_level` int(11) DEFAULT '0' COMMENT '用户级别 0：普通会员 1:客户  2：管理员',
  `realname` varchar(64) DEFAULT NULL COMMENT '真实姓名',
  `sex` int(11) DEFAULT '1' COMMENT '性别 （1:男性 2：女性）',
  `mobile` char(11) DEFAULT NULL COMMENT '手机号',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='购日本用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gogojp_user`
--

LOCK TABLES `gogojp_user` WRITE;
/*!40000 ALTER TABLE `gogojp_user` DISABLE KEYS */;
INSERT INTO `gogojp_user` VALUES (1,'test','96e79218965eb72c92a549dd5a330112','ThinkPHP@gmail.com',2,'小强2',1,'15828670324','2014-04-27 13:42:01'),(2,'ThinkPHP','96e79218965eb72c92a549dd5a330112','ThinkPHP@gmail.com',2,'小强2',1,'15828670324','2014-04-29 07:13:33'),(14,'小李子','96e79218965eb72c92a549dd5a330112','653260669@qq.com',0,NULL,1,NULL,'2014-04-30 05:56:06'),(12,'ThinkPHP','96e79218965eb72c92a549dd5a330112','ThinkPHP@gmail.com',2,'小强2',1,'15828670324','2014-04-29 08:17:02'),(13,'小李子','96e79218965eb72c92a549dd5a330112','653260669@qq.com',0,NULL,1,NULL,'2014-04-30 05:55:40'),(15,'ppt','96e79218965eb72c92a549dd5a330112','653260669@qq.com',0,NULL,1,NULL,'2014-05-03 09:06:18'),(16,'ppt','96e79218965eb72c92a549dd5a330112','653260669@qq.com',0,NULL,1,NULL,'2014-05-03 09:25:15');
/*!40000 ALTER TABLE `gogojp_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'gogojp'
--
/*!50003 DROP FUNCTION IF EXISTS `getChildLst` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getChildLst`(rootId int) RETURNS varchar(1000) CHARSET utf8
BEGIN
   DECLARE sTemp VARCHAR(1000);
   DECLARE sTempChd VARCHAR(1000);

   SET sTemp = '$';
  SET sTempChd =cast(rootId as CHAR);

  WHILE sTempChd is not null DO
     SET sTemp = concat(sTemp,',',sTempChd);
    SELECT group_concat(catid) INTO sTempChd FROM gogojp_productcategory where FIND_IN_SET(parentid,sTempChd)>0 ;
   END WHILE;
  RETURN sTemp;
 END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-05-13 14:25:25
