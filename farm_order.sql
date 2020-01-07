-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for farm_order
CREATE DATABASE IF NOT EXISTS `farm_order` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `farm_order`;

-- Dumping structure for table farm_order.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `date_create` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `date_create`) VALUES
	(1, 'VEGETABLES', '2019-12-29'),
	(2, 'OILCROPS', '2019-12-29'),
	(4, 'CEREALS', '2020-01-01');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table farm_order.egg
CREATE TABLE IF NOT EXISTS `egg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collected` int(11) DEFAULT '0',
  `good` int(11) DEFAULT '0',
  `bad` int(11) DEFAULT '0',
  `date_create` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.egg: ~2 rows (approximately)
/*!40000 ALTER TABLE `egg` DISABLE KEYS */;
INSERT INTO `egg` (`id`, `collected`, `good`, `bad`, `date_create`) VALUES
	(1, 10, 3, 4, '2020-01-02'),
	(2, 20, 10, 2, '2020-01-02');
/*!40000 ALTER TABLE `egg` ENABLE KEYS */;

-- Dumping structure for table farm_order.expenses
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `quantity` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '0',
  `category` varchar(50) DEFAULT '0',
  `amount` int(10) DEFAULT '0',
  `pMethod` varchar(50) DEFAULT '0',
  `pFrom` varchar(50) DEFAULT '0',
  `date_create` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.expenses: ~2 rows (approximately)
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` (`id`, `quantity`, `title`, `category`, `amount`, `pMethod`, `pFrom`, `date_create`) VALUES
	(2, 4, 'Cheif', 'Medication', 2000, 'cash', 'iuol', '2019-12-27'),
	(3, 13, 'Testing Special', 'Medication', 12000, 'cash', 'iuol', '2020-01-03');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;

-- Dumping structure for table farm_order.feed
CREATE TABLE IF NOT EXISTS `feed` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date_create` varchar(50) NOT NULL DEFAULT '0',
  `chicken_type` varchar(250) NOT NULL DEFAULT '0',
  `quantity` int(10) NOT NULL DEFAULT '0',
  `feed_type` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.feed: ~2 rows (approximately)
/*!40000 ALTER TABLE `feed` DISABLE KEYS */;
INSERT INTO `feed` (`id`, `date_create`, `chicken_type`, `quantity`, `feed_type`) VALUES
	(1, '2020-01-01', 'Broiler', 120, 'feed3'),
	(5, '2020-01-02', 'Layers', 10, 'feed1');
/*!40000 ALTER TABLE `feed` ENABLE KEYS */;

-- Dumping structure for table farm_order.flock
CREATE TABLE IF NOT EXISTS `flock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `available` int(11) DEFAULT NULL,
  `sick` int(11) DEFAULT NULL,
  `dead` int(11) DEFAULT NULL,
  `date_create` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.flock: ~2 rows (approximately)
/*!40000 ALTER TABLE `flock` DISABLE KEYS */;
INSERT INTO `flock` (`id`, `available`, `sick`, `dead`, `date_create`) VALUES
	(1, 10, 1, 2, '2020-01-02'),
	(2, 10, 2, 8, '2020-01-02'),
	(4, 100, 50, 20, '2020-01-02');
/*!40000 ALTER TABLE `flock` ENABLE KEYS */;

-- Dumping structure for table farm_order.medication
CREATE TABLE IF NOT EXISTS `medication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '0',
  `noFlock` int(10) DEFAULT '0',
  `description` varchar(250) DEFAULT '0',
  `date_create` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.medication: ~2 rows (approximately)
/*!40000 ALTER TABLE `medication` DISABLE KEYS */;
INSERT INTO `medication` (`id`, `name`, `noFlock`, `description`, `date_create`) VALUES
	(1, 'pcm', 3, 'pcm', '2020-01-01'),
	(3, 'hh', 20, 'aa', '2020-01-01');
/*!40000 ALTER TABLE `medication` ENABLE KEYS */;

-- Dumping structure for table farm_order.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productID` varchar(50) DEFAULT NULL,
  `custID` varchar(50) DEFAULT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `date_create` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.orders: ~8 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `productID`, `custID`, `quantity`, `date_create`, `status`) VALUES
	(7, '2', 'As@gmail.com', '2', '2020-01-04', '1'),
	(8, '3', 'As@gmail.com', '3', '2020-01-04', '1');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Dumping structure for table farm_order.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '0',
  `description` varchar(50) DEFAULT '0',
  `price` varchar(50) DEFAULT '0',
  `expried_date` varchar(50) DEFAULT '0',
  `cat_id` int(2) DEFAULT '0',
  `quantity` int(10) DEFAULT '0',
  `date_create` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.product: ~0 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `name`, `description`, `price`, `expried_date`, `cat_id`, `quantity`, `date_create`) VALUES
	(2, 'CASSAVA', 'Cassava', '800', '2020-01-29', 1, 11, '2019-12-30'),
	(3, 'RICE', 'rice', '1200', '2020-01-18', 1, 9, '2019-12-30');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table farm_order.profile
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(150) DEFAULT '0',
  `lname` varchar(150) DEFAULT '0',
  `dob` varchar(150) DEFAULT '0',
  `gender` varchar(150) DEFAULT '0',
  `address` varchar(150) DEFAULT '0',
  `phone` varchar(150) DEFAULT '0',
  `email` varchar(150) DEFAULT '0',
  `date_create` varchar(150) DEFAULT '0',
  `passport` varchar(150) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.profile: ~0 rows (approximately)
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` (`id`, `fname`, `lname`, `dob`, `gender`, `address`, `phone`, `email`, `date_create`, `passport`) VALUES
	(2, 'muhammed', 'Babs', '2019-01-10', 'male selected', 'Sokoto', '08060567890', 'As@gmail.com', '2020-01-02', 'uploads/udus.png');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;

-- Dumping structure for table farm_order.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastName` varchar(50) NOT NULL DEFAULT '0',
  `otherName` varchar(50) NOT NULL DEFAULT '0',
  `gender` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(250) NOT NULL DEFAULT '0',
  `status` varchar(250) NOT NULL DEFAULT '0',
  `phoneNo` varchar(50) NOT NULL DEFAULT '0',
  `passport` varchar(50) NOT NULL DEFAULT '0',
  `date_create` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.staff: ~2 rows (approximately)
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`id`, `lastName`, `otherName`, `gender`, `email`, `status`, `phoneNo`, `passport`, `date_create`) VALUES
	(3, 'Umar', 'Abbah', 'Male', 'abah12@gmail.com', '', '090123456678', 'uploads/2348064096223.jpg', '2019-12-29');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

-- Dumping structure for table farm_order.tborders
CREATE TABLE IF NOT EXISTS `tborders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productID` varchar(50) DEFAULT '0',
  `custID` varchar(50) DEFAULT '0',
  `quantity` varchar(50) DEFAULT '0',
  `date_create` varchar(50) DEFAULT '0',
  `status` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.tborders: ~0 rows (approximately)
/*!40000 ALTER TABLE `tborders` DISABLE KEYS */;
/*!40000 ALTER TABLE `tborders` ENABLE KEYS */;

-- Dumping structure for table farm_order.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(250) NOT NULL DEFAULT '0',
  `date_create` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `password`, `date_create`) VALUES
	(4, 'aba@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-01-02'),
	(5, 'As@gmail.com', 'f970e2767d0cfe75876ea857f92e319b', '2020-01-02');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table farm_order.vaccination
CREATE TABLE IF NOT EXISTS `vaccination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vac_date` varchar(50) NOT NULL DEFAULT '0',
  `vac_reason` varchar(50) DEFAULT '0',
  `no_vac` varchar(50) NOT NULL DEFAULT '0',
  `description` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table farm_order.vaccination: ~2 rows (approximately)
/*!40000 ALTER TABLE `vaccination` DISABLE KEYS */;
INSERT INTO `vaccination` (`id`, `vac_date`, `vac_reason`, `no_vac`, `description`) VALUES
	(1, '2019-12-30', 'testing', '10', 'loll'),
	(2, '2020-01-02', 'sssa', '120', 'aaa');
/*!40000 ALTER TABLE `vaccination` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
