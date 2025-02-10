-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: happy_herbivore
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB-0+deb12u1

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_dutch` varchar(255) NOT NULL,
  `name_english` varchar(255) NOT NULL,
  `name_german` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'Ontbijt','Breakfast','Frühstück','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(2,'Lunch & Diner','Lunch & Dinner','Mittagessen & Abendessen','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(3,'Bijgerechten','Sides','Beilagen','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(4,'Hapjes','Snacks','Snacks','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(5,'Dips','Dips','Dips','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(6,'Dranken','Drinks','Getränke','2025-02-08 14:51:40','2025-02-08 14:51:40');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `imageable_id` int(11) NOT NULL,
  `imageable_type` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES
(1,1,'App\\Models\\Product','images/products/breakfast/smoothie-bowl.jpg','Image of the Morning Boost Smoothie Bowl',NULL,NULL),
(2,2,'App\\Models\\Product','images/products/breakfast/eggcellent-wrap.jpg','Image of the Eggcellent Wrap',NULL,NULL),
(3,3,'App\\Models\\Product','images/products/breakfast/peanut-butter-toast.jpg','Image of the Peanut Butter Power Toast',NULL,NULL),
(4,4,'App\\Models\\Product','images/products/lunch-dinner/protein-packed-bowl.jpg','Image of the Protein-Packed Bowl',NULL,NULL),
(5,5,'App\\Models\\Product','images/products/lunch-dinner/supergreen-salad.jpg','Image of the Supergreen Salad',NULL,NULL),
(6,6,'App\\Models\\Product','images/products/lunch-dinner/zesty-chickpea-wrap.jpg','Image of the Zesty Chickpea Wrap',NULL,NULL),
(7,7,'App\\Models\\Product','images/products/sides/sweet-potato-wedges.jpg','Image of the Sweet Potato Wedges',NULL,NULL),
(8,8,'App\\Models\\Product','images/products/sides/quinoa-salad-cup.jpg','Image of the Quinoa Salad Cup',NULL,NULL),
(9,9,'App\\Models\\Product','images/products/sides/mini-veggie-platter.jpg','Image of the Mini Veggie Platter',NULL,NULL),
(10,10,'App\\Models\\Product','images/products/sides/brown-rice-bowl.jpg','Image of the Brown Rice & Edamame Bowl',NULL,NULL),
(11,11,'App\\Models\\Product','images/products/snacks/roasted-chickpeas.jpg','Image of the Roasted Chickpeas',NULL,NULL),
(12,12,'App\\Models\\Product','images/products/snacks/trail-mix-cup.jpg','Image of the Trail Mix Cup',NULL,NULL),
(13,13,'App\\Models\\Product','images/products/snacks/chia-pudding.jpg','Image of the Chia Pudding Cup',NULL,NULL),
(14,14,'App\\Models\\Product','images/products/snacks/baked-falafel-bites.jpg','Image of the Baked Falafel Bites (4 pcs)',NULL,NULL),
(15,15,'App\\Models\\Product','images/products/snacks/whole-grain-bread-sticks.jpg','Image of the Mini Whole-Grain Breadsticks',NULL,NULL),
(16,16,'App\\Models\\Product','images/products/snacks/apple-cinnamon-chips.jpg','Image of the Apple & Cinnamon Chips',NULL,NULL),
(17,17,'App\\Models\\Product','images/products/snacks/zuccini-fries.jpg','Image of the Zucchini Fries',NULL,NULL),
(18,18,'App\\Models\\Product','images/products/dips/classic-hummus.jpg','Image of the Classic Hummus',NULL,NULL),
(19,19,'App\\Models\\Product','images/products/dips/avocado-lime-dip.jpg','Image of the Avocado Lime Dip',NULL,NULL),
(20,20,'App\\Models\\Product','images/products/dips/greek-yogurt-ranch.jpg','Image of the Greek Yogurt Ranch',NULL,NULL),
(21,21,'App\\Models\\Product','images/products/dips/spicy-sriracha-mayo.jpg','Image of the Spicy Sriracha Mayo',NULL,NULL),
(22,22,'App\\Models\\Product','images/products/dips/garlic-tahini.jpg','Image of the Garlic Tahini Sauce',NULL,NULL),
(23,23,'App\\Models\\Product','images/products/dips/zesty-tomato-sauce.jpg','Image of the Zesty Tomato Salsa',NULL,NULL),
(24,24,'App\\Models\\Product','images/products/dips/peanut-dipping-sauce.jpg','Image of the Peanut Dipping Sauce',NULL,NULL),
(25,25,'App\\Models\\Product','images/products/drinks/green-glow-smoothie.jpg','Image of the Green Glow Smoothie',NULL,NULL),
(26,26,'App\\Models\\Product','images/products/drinks/iced-matcha-latte.jpg','Image of the Iced Matcha Latte',NULL,NULL),
(27,27,'App\\Models\\Product','images/products/drinks/fruit-infused-water.jpg','Image of the Fruit-Infused Water',NULL,NULL),
(28,28,'App\\Models\\Product','images/products/drinks/berry-blast-smoothie.jpg','Image of the Berry Blast Smoothie',NULL,NULL),
(29,29,'App\\Models\\Product','images/products/drinks/citrus-cooler.jpg','Image of the Citrus Cooler',NULL,NULL),
(30,1,'App\\Models\\Category','images/categories/breakfast/smoothie-bowl.png','Image of the Breakfast category',NULL,NULL),
(31,2,'App\\Models\\Category','images/categories/lunch-dinner/protein-packed-bowl.png','Image of the Lunch & Dinner category',NULL,NULL),
(32,3,'App\\Models\\Category','images/categories/sides/sweet-potato-wedges.png','Image of the Sides category',NULL,NULL),
(33,4,'App\\Models\\Category','images/categories/snacks/roasted-chickpeas.png','Image of the Snacks category',NULL,NULL),
(34,5,'App\\Models\\Category','images/categories/dips/classic-hummus.png','Image of the Dips category',NULL,NULL),
(35,6,'App\\Models\\Category','images/categories/drinks/green-glow-smoothie.png','Image of the Drinks category',NULL,NULL);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000001_create_cache_table',1),
(2,'0001_01_01_000002_create_jobs_table',1),
(3,'2025_02_06_094513_create_products_table',1),
(4,'2025_02_06_121609_create_categories_table',1),
(5,'2025_02_06_123518_create_orders_table',1),
(6,'2025_02_06_124811_create_order_statuses_table',1),
(7,'2025_02_06_131604_create_images_table',1),
(8,'2025_02_06_140545_create_users_table',1),
(9,'2025_02_06_213906_create_order_contents_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_contents`
--

DROP TABLE IF EXISTS `order_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `with_dip` int(11) DEFAULT NULL,
  `extra_choices` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_choices`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_contents`
--

LOCK TABLES `order_contents` WRITE;
/*!40000 ALTER TABLE `order_contents` DISABLE KEYS */;
INSERT INTO `order_contents` VALUES
(1,1,5,1,NULL,NULL,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(2,1,16,3,NULL,'[\"Herb Seasoning\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(3,1,23,3,NULL,NULL,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(4,1,9,2,NULL,NULL,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(5,1,1,3,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(6,1,26,3,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(7,1,28,1,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(8,1,23,2,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(9,1,29,2,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(10,1,21,4,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(11,2,11,1000,NULL,NULL,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(12,3,25,1,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(13,3,26,1,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(14,3,28,1,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(15,3,25,3,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(16,3,25,2,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(17,3,29,4,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(18,3,14,2,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(19,3,10,4,NULL,'[\"Herb Seasoning\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(20,3,17,4,NULL,NULL,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(21,3,7,3,NULL,'[\"Spicy Paprika\"]','2025-02-08 14:51:40','2025-02-08 14:51:40'),
(22,4,11,1000,NULL,NULL,'2025-02-08 14:51:40','2025-02-08 14:51:40');
/*!40000 ALTER TABLE `order_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_statuses`
--

DROP TABLE IF EXISTS `order_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_started` datetime DEFAULT NULL,
  `order_successful` datetime DEFAULT NULL,
  `order_preparing` datetime DEFAULT NULL,
  `order_ready` datetime DEFAULT NULL,
  `order_picked_up` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_statuses`
--

LOCK TABLES `order_statuses` WRITE;
/*!40000 ALTER TABLE `order_statuses` DISABLE KEYS */;
INSERT INTO `order_statuses` VALUES
(1,1,'2025-02-08 15:51:40',NULL,NULL,NULL,NULL,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(2,2,'2025-02-08 15:51:40',NULL,NULL,NULL,NULL,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(3,3,'2025-02-08 15:51:40',NULL,NULL,NULL,NULL,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(4,4,'2025-02-08 15:51:40',NULL,NULL,NULL,NULL,'2025-02-08 14:51:40','2025-02-08 14:51:40');
/*!40000 ALTER TABLE `order_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pickup_number` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES
(1,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(2,2,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(3,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(4,2,'2025-02-08 14:51:40','2025-02-08 14:51:40');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name_dutch` varchar(255) NOT NULL,
  `description_dutch` text DEFAULT NULL,
  `name_english` varchar(255) NOT NULL,
  `description_english` text DEFAULT NULL,
  `name_german` varchar(255) NOT NULL,
  `description_german` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `kcal` int(11) NOT NULL,
  `with_dip` tinyint(1) NOT NULL DEFAULT 0,
  `extra_choices` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra_choices`)),
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(1,1,'Ochtend Boost Smoothie Bowl','Een mix van acai, banaan en gemengde bessen, gegarneerd met granola, chiazaad en kokosvlokken.','Morning Boost Smoothie Bowl','A blend of acai, banana, and mixed berries topped with granola, chia seeds, and coconut flakes.','Morgen Boost Smoothie Bowl','Eine Mischung aus Acai, Banane und gemischten Beeren, garniert mit Müsli, Chiasamen und Kokosflocken.',4.50,300,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(2,1,'Eiercellent Wrap','Volkorenwrap gevuld met roerei, spinazie en een lichte saus op basis van yoghurt.','Eggcellent Wrap','Whole-grain wrap filled with scrambled eggs, spinach, and a light yogurt-based sauce.','Eierartiger Wrap','Vollkorn-Wrap gefüllt mit Rührei, Spinat und einer leichten Sauce auf Joghurtbasis.',3.50,250,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(3,1,'Pindakaas Power Toast','Volkorenbrood met natuurlijke pindakaas en plakjes banaan.','Peanut Butter Power Toast','Whole-grain toast with natural peanut butter and banana slices.','Erdnussbutter Power Toast','Vollkorntoast mit natürlicher Erdnussbutter und Bananenscheiben.',2.80,220,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(4,2,'Eiwitrijke Bowl','Quinoa, gegrilde tofu, geroosterde groenten en een tahindressing.','Protein-Packed Bowl','Quinoa, grilled tofu, roasted vegetables, and a tahini dressing.','Proteinreiche Bowl','Quinoa, gegrillter Tofu, geröstetes Gemüse und ein Tahini-Dressing.',6.00,450,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(5,2,'Supergroene salade','Boerenkool, spinazie, avocado, edamame, komkommer en een citroen-olijfolie vinaigrette.','Supergreen Salad','Kale, spinach, avocado, edamame, cucumber, and a lemon-olive oil vinaigrette.','Supergrüner Salat','Grünkohl, Spinat, Avocado, Edamame, Gurke und eine Zitronen-Olivenöl-Vinaigrette.',5.00,300,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(6,2,'Pittige kikkererwten wrap','Volkorenwrap met gekruide kikkererwten, geraspte wortels, sla en hummus.','Zesty Chickpea Wrap','Whole-grain wrap with spiced chickpeas, shredded carrots, lettuce, and hummus.','Pikanter Kichererbsen-Wrap','Vollkorn-Wrap mit gewürzten Kichererbsen, geraspelten Karotten, Salat und Hummus.',4.50,400,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(7,3,'Zoete aardappelpartjes','In de oven gebakken zoete aardappelpartjes, op smaak gebracht met paprika en een scheutje olijfolie.','Sweet Potato Wedges','Oven-baked sweet potato wedges seasoned with paprika and a touch of olive oil.','Süßkartoffelspalten','Im Ofen gebackene Süßkartoffelspalten, gewürzt mit Paprika und einem Schuss Olivenöl.',3.50,250,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(8,3,'Quinoa Salade Cup','Mini kopje quinoa gemengd met komkommer, cherrytomaatjes, peterselie en citroendressing.','Quinoa Salad Cup','Mini cup of quinoa mixed with cucumber, cherry tomatoes, parsley, and lemon dressing.','Quinoa-Salat-Cup','Minitasse Quinoa gemischt mit Gurke, Kirschtomaten, Petersilie und Zitronendressing.',3.00,200,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(9,3,'Mini Groenteschotel','Een selectie van worteltjes, selderij, komkommerschijfjes en cherrytomaatjes, geserveerd met een dip naar keuze.','Mini Veggie Platter','A selection of carrot sticks, celery, cucumber slices, and cherry tomatoes served with a dip of your choice.','Mini-Gemüseplatte','Eine Auswahl an Karottensticks, Sellerie, Gurkenscheiben und Kirschtomaten, serviert mit einem Dip Ihrer Wahl.',3.00,150,1,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(10,3,'Bruine rijst en edamame bowl','Een klein portie bruine rijst met gestoomde edamame en een scheutje sojasaus.','Brown Rice & Edamame Bowl','A small portion of brown rice topped with steamed edamame and a drizzle of soy sauce.','Bowl aus braunem Reis und Edamame','Eine kleine Portion brauner Reis, garniert mit gedämpften Edamame und einem Schuss Sojasauce.',3.50,300,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(11,4,'Geroosterde kikkererwten','Knapperige geroosterde kikkererwten met pittige paprika- of kruidenkruiden naar keuze.','Roasted Chickpeas','Crunchy roasted chickpeas with your choice of spicy paprika or herb seasoning.','Geröstete Kichererbsen','Knusprig geröstete Kichererbsen mit scharfer Paprika- oder Kräuterwürze nach Wahl.',2.50,180,0,'[\"Spicy Paprika\",\"Herb Seasoning\"]',1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(12,4,'Trailmix Cup','Een mix van noten, gedroogd fruit en zaden voor een energieboost.','Trail Mix Cup','A mix of nuts, dried fruits, and seeds for an energy boost.','Studentenfutter Cup','Eine Mischung aus Nüssen, Trockenfrüchten und Samen für einen Energieschub.',2.00,200,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(13,4,'Chia Pudding Cup','Romige chiapudding gemaakt met amandelmelk en gegarneerd met vers fruit.','Chia Pudding Cup','Creamy chia pudding made with almond milk and topped with fresh fruit.','Chia Pudding Cup','Cremiger Chia-Pudding mit Mandelmilch und garniert mit frischen Früchten.',3.00,250,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(14,4,'Gebakken Falafelhapjes (4 stuks)','Gebakken falafelballetjes geserveerd met een dip naar keuze.','Baked Falafel Bites (4 pcs)','Baked falafel balls served with a dip of your choice.','Gebackene Falafel-Häppchen (4 Stück)','Gebackene Falafelbällchen, serviert mit einem Dip Ihrer Wahl.',3.50,220,1,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(15,4,'Mini Volkoren Broodstengels','Knapperige, voedzame broodstengels, perfect te combineren met hummus of salsa.','Mini Whole-Grain Breadsticks','Crisp, wholesome breadsticks perfect for pairing with hummus or salsa.','Mini Vollkorn-Brotstangen','Knusprige, gesunde Brotstangen, perfekt zu Hummus oder Salsa.',2.00,150,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(16,4,'Appel-kaneelchips','Gebakken appelschijfjes, licht bestrooid met kaneel.','Apple & Cinnamon Chips','Baked apple slices lightly dusted with cinnamon.','Apfel-Zimt-Chips','Gebackene Apfelscheiben, leicht mit Zimt bestäubt.',2.50,100,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(17,4,'Courgette frietjes','Gebakken courgettereepjes bedekt met een dun laagje broodkruim.','Zucchini Fries','Baked zucchini sticks coated in a light breadcrumb crust.','Zucchini-Pommes','Gebackene Zucchinisticks umhüllt mit einer leichten Semmelbröselkruste.',3.00,180,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(18,5,'Klassieke Hummus',NULL,'Classic Hummus',NULL,'Klassischer Hummus',NULL,0.80,70,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(19,5,'Avocado-Limetten-Dip',NULL,'Avocado Lime Dip',NULL,'Avocado-limoendip',NULL,1.00,80,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(20,5,'Griekse Yoghurt Ranch',NULL,'Greek Yogurt Ranch',NULL,'Griechische Joghurt-Ranch',NULL,0.70,50,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(21,5,'Pittige Sriracha Mayo',NULL,'Spicy Sriracha Mayo',NULL,'Scharfe Sriracha Mayo',NULL,0.70,60,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(22,5,'Knoflook-tahinsaus',NULL,'Garlic Tahini Sauce',NULL,'Knoblauch-Tahini-Sauce',NULL,0.90,90,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(23,5,'Pittige tomatensalsa',NULL,'Zesty Tomato Salsa',NULL,'Pikante Tomatensalsa',NULL,0.60,20,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(24,5,'Pindasaus Dipsaus',NULL,'Peanut Dipping Sauce',NULL,'Erdnuss-Dip-Sauce',NULL,0.90,100,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(25,6,'Groene Glow Smoothie','Spinazie, ananas, komkommer en kokoswater.','Green Glow Smoothie','Spinach, pineapple, cucumber, and coconut water.','Grüner Glow-Smoothie','Spinat, Ananas, Gurke und Kokoswasser.',3.50,120,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(26,6,'IJskoude Matcha Latte','Licht gezoete matcha groene thee met amandelmelk.','Iced Matcha Latte','Lightly sweetened matcha green tea with almond milk.','Eisgekühlter Matcha Latte','Leicht gesüßter Matcha-Grüntee mit Mandelmilch.',3.00,90,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(27,6,'Fruitwater','Vers geperst water met een keuze uit citroen-munt, aardbei-basilicum of komkommer-limoen.','Fruit-Infused Water','Freshly infused water with a choice of lemon-mint, strawberry-basil, or cucumber-lime.','Mit Früchten angereichertes Wasser','Frisch aufgegossenes Wasser, wahlweise mit Zitrone-Minze, Erdbeer-Basilikum oder Gurke-Limette.',1.50,0,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(28,6,'Bessen Blast Smoothie','Een romige mix van aardbeien, bosbessen en frambozen met amandelmelk.','Berry Blast Smoothie','A creamy blend of strawberries, blueberries, and raspberries with almond milk.','Beeren-Blast-Smoothie','Eine cremige Mischung aus Erdbeeren, Blaubeeren und Himbeeren mit Mandelmilch.',3.80,140,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40'),
(29,6,'Citruskoeler','Een verfrissende mix van sinaasappelsap, bruisend water en een vleugje limoen.','Citrus Cooler','A refreshing mix of orange juice, sparkling water, and a hint of lime.','Zitruskühler','Eine erfrischende Mischung aus Orangensaft, Mineralwasser und einem Hauch Limette.',3.00,90,0,NULL,1,'2025-02-08 14:51:40','2025-02-08 14:51:40');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('MjEJNNsUEE4MMj1U5oyjX9JLhcUBDu3sLP1ihjLM',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZlhxaUFIMW1DNHpmbWJDYWFOUUNOajRtalJ1aEJPVEcwTlR0c0w2OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaG9vc2Utb3JkZXIvRHJpbmtzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo4OiJsYW5ndWFnZSI7czo3OiJlbmdsaXNoIjtzOjk6Im9yZGVyVHlwZSI7czo3OiJlYXRIZXJlIjt9',1739174705);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-10  9:32:30
