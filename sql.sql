-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 09, 2013 at 09:53 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a5900628_bmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` varchar(128) COLLATE latin1_general_ci NOT NULL,
  `name` varchar(128) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`) VALUES('recent', 'Recent Transactions');
INSERT INTO `admin` (`id`, `name`) VALUES('customers', 'Customers');
INSERT INTO `admin` (`id`, `name`) VALUES('products', 'Product Sales');
INSERT INTO `admin` (`id`, `name`) VALUES('imports', 'Partner Retailers');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` varchar(128) COLLATE latin1_general_ci NOT NULL,
  `name` varchar(128) COLLATE latin1_general_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES('dishwashers', 'Dishwashers');
INSERT INTO `category` (`id`, `name`) VALUES('freezers', 'Freezers');
INSERT INTO `category` (`id`, `name`) VALUES('kitchen_appliances', 'Kitchen Appliances');
INSERT INTO `category` (`id`, `name`) VALUES('microwaves', 'Microwaves');
INSERT INTO `category` (`id`, `name`) VALUES('refrigerators', 'Refrigerators');
INSERT INTO `category` (`id`, `name`) VALUES('stoves_ranges', 'Stoves/Ranges');
INSERT INTO `category` (`id`, `name`) VALUES('washers_dryers', 'Washers/Dryers');

-- --------------------------------------------------------

--
-- Table structure for table `orderSources`
--

DROP TABLE IF EXISTS `orderSources`;
CREATE TABLE `orderSources` (
  `orderid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `storeorderid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `storeurl` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `productid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `quantity` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `storename` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`orderid`,`storeorderid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `orderSources`
--

INSERT INTO `orderSources` (`orderid`, `storeorderid`, `storeurl`, `productid`, `quantity`, `storename`) VALUES('bmOrder_3', '1', 'www.fakestore.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pendingOrders`
--

DROP TABLE IF EXISTS `pendingOrders`;
CREATE TABLE `pendingOrders` (
  `orderid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `userid` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `data` varchar(60000) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `pendingOrders`
--


DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `pid` varchar(63) COLLATE latin1_general_ci NOT NULL,
  `pcategory` varchar(127) COLLATE latin1_general_ci DEFAULT NULL,
  `pname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pdesc` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageurl` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `dim` varchar(127) COLLATE latin1_general_ci NOT NULL,
  `ratingSum` int(11) NOT NULL,
  `ratingCount` int(11) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000001', 'dishwashers', 'LG Tall Tub Built-In Dishwasher', 'The LG LDF7551 is a quiet dishwasher, packed with cutting-edge features that make it convenient and easy to clean your dishes. The low noise level means you can easily talk on the phone while the dishwasher is operating, and the EasyRack Plus system is flexible enough to accommodate just about any combination of dishes, pots, and cups. ', 'c000001.jpg', 1099.99, 4, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000002', 'stoves_ranges', 'LG 6.3 Cu. Ft. Self-Clean Smooth Top Range', 'This LG electric stove features IntuiTouch controls and premium finishes that make cooking and cleanup practically effortless. The large oven has a spacious capacity of 6.3 cu. ft. and uses the EvenJet Advanced Convection System to blow hot air throughout the oven, ensuring your food is cooked precisely and evenly. ', 'c000002.jpg', 1399.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000005', 'refrigerators', 'GE Profile 20.2 Cu. Ft. Bottom Mount Refrigerator ', 'Offering a snappy combination of elegant looks and storage space, the GE Profile PDRS0MBYLSS Stainless Steel Bottom Mount Refrigerator is the perfect addition to any style of kitchen. Sporting 20.2 cubic feet of storage and a host of technologically advanced features that help your food stay fresh, this fridge is the perfect addition to your home. ', 'c000005.jpg', 1599.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000006', 'washers_dryers', 'LG WaveForce 5.4 Cu. Ft. Top Load HE Washer with Heater', 'The top-loading LG WT5170 gets your clothes cleaner using deep-cleaning WaveForce technology. It combines fast drum movement with powerful water jets while being gentle on garments. It also comes complete with features like ColdWash technology, a large capacity, and more. ', 'c000006.jpg', 1199.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000007', 'washers_dryers', 'LG 5.0 Cu. Ft. Front Load Washer ', 'Tackle those towers of laundry with more gusto. The LG large capacity 5.0 cu.ft. washer lets you do more laundry in fewer loads, giving you more free time and using less water. The Direct Drive Motor operates ultra-efficiently, and the TrueBalance anti-vibration system and LoDecibel quiet operation reduce washer noise and vibration for smooth, whisper-quiet performance. ', 'c000007.jpg', 849.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000008', 'washers_dryers', 'Frigidaire Affinity 4.2 Cu. Ft. Front-Load Washer', 'Ultra efficient and super quiet, the Frigidaire Affinity front-load washer gets clothes clean using advanced technology and an array of convenient features. An NSF-certified allergen cycle removes up to 95% of allergens, while the Vibration Control System and SilentDesign technology ensure near-silent operation. Other features include Express Select Controls, Stay-Fresh Door seal, and more. ', 'c000008.jpg', 849.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000009', 'freezers', 'Frigidaire 16.6 Cu.Ft. Upright Freezer', 'Stock up on the frozen food you love with this handy Frigidaire upright freezer. Get ready for a raft of convenient features including three wire shelves, a basket for simple organisation of your food, a control lock feature and automatic alerts if the door is left open. ', 'c000009.jpg', 799.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000010', 'freezers', 'Haier 5.0 Cu. Ft. Chest Freezer', 'The Haier 5.0 Cu. Ft. capacity chest freezer with removable basket holds approximately 175 pounds of frozen food. A front side adjustable thermostat control is easy to access. And the manual defrost drain makes maintenance for this chest freezer simple. Includes a Power On indicator light and space-saving flat back design. ', 'c000010.jpg', 179.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000011', 'refrigerators', 'Danby 38 Bottle Wine Cooler', 'For those who appreciate a great glass of wine with dinner or while entertaining, this Danby 38-bottle wine chiller lets you dial in your personally-customized settings. A temperature range between 4-18 degrees C with dual temperature zones lets you chill red and whites at their optimal temperature. The LED lighting system showcases your collection beautifully. ', 'c000011.jpg', 299.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000013', 'microwaves', 'Panasonic 1.6 Cu. Ft. Microwave', 'The Panasonic NNH794S 1.6 Cu. Ft. Microwave offers 1200 watts of power output and comes equipped with fifteen Genius Sensor Cook functions. This model also gives you convenient feature settings like Auto Reheat, Auto Defrost, Quick Minute and Popcorn. ', 'c000013.jpg', 279.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000014', 'microwaves', 'Sunbeam 1.0 Cu. Ft. Microwave', 'This Sunbeam SBMW1049SS microwave comes with 1.0 Cu. Ft. of cooking space and a stylish stainless steel look. ', 'c000014.jpg', 99.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000015', 'freezers', 'Frigidaire 19.7 Cu. Ft. Chest Freezer ', 'With a 19.7 cubic foot storage capacity, Store-More removable baskets, and the SpaceWise organization system, this Frigidaire chest freezer gives you more frozen storage for your home. Other features include manual defrost and bright lighting. ', 'c000015.jpg', 789.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000018', 'stoves_ranges', 'Bosch 4.6 Cu. Ft. Self-Clean Smooth Top Convection Range', 'With 8 cooking modes, a 4.6 cubic foot capacity, and European Convection, this Bosch Range delivers tasty meal after tasty meal. It features TOUCH & TURN oven controls for easy operation, and boasts a smooth black and stainless steel exterior. ', 'c000018.jpg', 1999.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000019', 'stoves_ranges', 'Bosch 5.0 Cu. Ft. Self-Clean Gas Range ', 'The Bosch Evolution 500 Series Free-Standing Gas Range features 5 sealed burners including oval shaped bridge burner, ranging from 5k to 16k BTUs, a 500 BTU simmer, continuous cast-iron matte grates, a 5.0 cu.ft convection oven, 4 cooking modes, and hidden bake element to meet all of your cooking needs. ', 'c000019.jpg', 1099.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000020', 'kitchen_appliances', 'Breville Cafe Roma Espresso Machine ', 'Recreate the taste of Old World Italy in your own home with the Breville Cafe Roma Espresso Maker. Beyond its timeless stainless steel body, the 15 bar pump and Thermoblock heating system delivers the perfect amount of heat and compression, cup after cup. The stainless steel wand and froth enhancer offers effortless milk frothing, and the heating tray heats up to 6 espresso cups at a time. ', 'c000020.jpg', 149.99, 8, 150, '10x20x30', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000021', 'dishwashers', 'Samsung 24-in Stainless Steel Built-In Dishwasher Height Adjustable Top Rack Storm Wash', 'Storm Wash - twister-nozzle alignment cleans your dishes more effectively than the standard straight-line nozzles Cycles', 'c000021.jpg', 1661, 9, 124, '61x63x86', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000022', 'dishwashers', 'Frigidaire Gallery 24-in Stainless-steel Built-in Dishwasher', 'Tall-tub design Stainless-steel, stay-in-place door Energy Star compliant Express-Select one-touch controls 14-place setting capacity with silverware basket UltraQuietTM III technology', 'c000022.jpg', 749, 9, 67, '61x64x85', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000023', 'dishwashers', 'Lamber Commercial Dishwasher With Temperature Booster', 'Features: Digital control panel (operations and temperatures). Filter kit - prevents product from blocking drain. Power requirement: 208 - 230 V single phase', 'c000023.jpg', 4534.2, 3, 150, '32x51x51', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000024', 'dishwashers', 'Samsung 24-in. Stainless-steel Built-in Dishwasher DMT210RFS', '14-place setting capacity with silverware basket Energy Star compliant Stainless Steel tub Hard food disposer Advanced quiet washing operation Tact button controls 4 wash cycles Digital leakage sensor Low water consumption Built-in double filtration water system Nylon-coated racking Child safety lock', 'c000024.jpg', 1110, 6, 115, '61x63x86', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000025', 'freezers', 'Danby Designer Chest Freezer 142 L (5 cu.ft.) DCFM142WDD', 'Features: 142 L (5.0 cu.ft.) capacity Energy Star compliant 194 kWh per year Easily accessible front-mount mechanical thermostat Front-mount drain for quick and easy defrost maintenance 1 storage basket for smaller frequently used items Smooth-back design for a flush fit against walls', 'c000025.jpg', 302.43, 4, 96, '86x56x84', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000026', 'freezers', '3.5cf Chest Freezer - White', 'Haier 3.5 cu ft chest freezer Holds approx. 122 lbs frozen food 1 removable basket Power light indicator manual defrost defrost drain', 'c000026.jpg', 246.04, 5, 36, '22x22x33', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000027', 'microwaves', 'Magic Chef Mcd990B Microwave Oven', '0.9 cu. ft. microwave oven. 900W. variable 10 power levels. pre programmed 1 touch cooking, with 3 menu options. Popcorn, dinner plate, and frozen pizza. 5 auto cooking menu. Beverage, soup, baked potato, fresh vegetable, and frozen vegetable. 3 auto defrost for meat, poultry, and fish', 'c000027.jpg', 99.94, 8, 17, '14x20x15', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000028', 'microwaves', 'Frigidaire Stainless-steel Microwave 1.1 cu.ft. FFCM1134LS', '31.1 L (1.1 cu.ft.) capacity 1100 W output power Stainless-steel exterior White interior 99-minute and 99-second cooking timer 10-power levels 2 multiple cooking stages 8 auto cook options 4 auto reheat options Auto defrost Child lock-out Turntable Electronic clock ', 'c000028.jpg', 212.2, 9, 27, '53x43x34', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000029', 'microwaves', '1.3CF STANLS Microwave', 'MAGIC CHEF MCD1311ST 1.3 CUBIC-FT, 1,100-WATT STAINLESS MICROWAVE WITH DIGITAL TOUCH', 'c000029.jpg', 239.99, 7, 24, '42x51x65', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000030', 'refrigerators', 'Danby 249.2 L (8.8 cu. ft.) Mid-size Refrigerator DFF8803W', 'The Danby mid-size refrigerator is the perfect size for a studio apartment, den or as a second refrigerator. Features include a freezer shelf, integrated door storage and vegetable crisper. Features:Capacity: 249.2 L (8.8 cu. ft.)Frost-free operationAdjustable freezer shelf and integrated door storage2 full-width adjustable wire shelvesCrystal vegetable crisperReversible hinge Interior light', 'c000030.jpg', 834.91, 5, 136, '58x58x156', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000031', 'refrigerators', 'Magic Chef Mcbr360W 3.6 Cubic-Ft Refrigerator', 'MAGIC CHEF MCBR360W 3.6 CUBIC-FT REFRIGERATOR (WHITE)', 'c000031.jpg', 211.56, 6, 60, '35x35x35', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000032', 'refrigerators', '11.0 CU.FT ALL Refrigerator', 'The Danby Designer 11 cu. Ft. Energy Star rated all refrigerator is perfect for those who dont need freezer space. With a single door a simple white finish and an integrated handle this model has a fresh tidy look', 'c000032.jpg', 1208.01, 4, 67, '62x62x149', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000033', 'stoves_ranges', 'BlueStarTM Professional 36-in. 6-burner Natural Gas Range', 'With over 125 years of experience making cooking equipment and as the leading manufacturer of high-performance commercial style ranges for the home, it is no surprise that BlueStarTM makes the finest residential ranges available.', 'c000033.jpg', 5425, 3, 432, '91x73x93', 0, 0);
INSERT INTO `product` (`pid`, `pcategory`, `pname`, `pdesc`, `imageurl`, `price`, `quantity`, `weight`, `dim`, `ratingSum`, `ratingCount`) VALUES('c000034', 'washers_dryers', 'Sonya Portable Compact Small Laundry Dryer Apartment Size 110v 8.8lbs Capacity-stainless Steel Drum Transparent Lid', 'This compact dryer makes it easy to quickly dry clothes, sheets, table linens, and more, without taking up a lot of room--Perfect for apartments or other small living spaces. The efficient 1400-watt tumble dryer plugs in to any 120-volt outlet and features a spacious 2.8 cu. ft drum, a removable interior lint filter, and a user-friendly control panel', 'c000034.jpg', 279.99, 5, 44, '60x44x66', 0, 0);

--
-- Table structure for table `productOrders`
--

DROP TABLE IF EXISTS `productOrders`;
CREATE TABLE `productOrders` (
  `orderid` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pid` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `amount` int(11) DEFAULT NULL,
  `totalprice` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`orderid`,`pid`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `productOrders`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(63) COLLATE latin1_general_ci DEFAULT NULL,
  `lastname` varchar(63) COLLATE latin1_general_ci DEFAULT NULL,
  `city` varchar(31) COLLATE latin1_general_ci DEFAULT NULL,
  `postal` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `cart` varchar(60000) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=667 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(1, 'me@yahoo.com', 'blackmark', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(2, 'hey@yahoo.com', 'hey@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(3, 'blahblah@yahoo.com', 'blahblah@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(4, 'asd@as.ass', 'asdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(5, 'asd@as.ass', 'asdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(6, 'buddy@yahoo.com', 'buddy@yahoo.com', 'SomeDude', 'His Last Name', 'His bloody city', 'postal friggin ', 'dum dum''s address', '78.. never call', NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(7, 'batman@bat.man', 'joker666', 'Batman', 'Alias', 'Gotham City', 'working?', 'The Bat Cave', '', '{"products":[{"id":"c000009","name":"Frigidaire 16.6 Cu.Ft. Upright Freezer","price":799.99,"img":"c000009.jpg","quantity":1},{"id":"c000010","name":"Haier 5.0 Cu. Ft. Chest Freezer","price":179.99,"img":"c000010.jpg","quantity":1}],"total":979.98}');
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(8, 'hey@yahoo.com', 'hey@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(9, 'heyhey@yahoo.com', 'heyhey@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(12, 'randomName@aaa.com', 'randomName@aaa.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(13, 'abcabcabc@gmail.com', 'abcabcabc@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(14, 'firstUser@yahoo.com', 'firstUser@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(15, 'aaaaaa@aaa.com', 'aaaaaa@aaa.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(16, 'asd@asd.asd', 'asdsdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(17, 'hi@hi.hi', 'hihihi', 'Homeless', 'Man', 'Bumtown', 'G4Y 4S5', 'Under the Bridge', '12345678', '{"products":[{"id":"c000025","name":"Danby Designer Chest Freezer 142 L (5 cu.ft.) DCFM142WDD","price":302.43,"img":"c000025.jpg","quantity":1},{"id":"c000026","name":"3.5cf Chest Freezer - White","price":246.04,"img":"c000026.jpg","quantity":"123"},{"id":"c000001","name":"LG Tall Tub Built-In Dishwasher","price":1099.99,"img":"c000001.jpg","quantity":"999"},{"id":"c000021","name":"Samsung 24-in Stainless Steel Built-In Dishwasher Height Adjustable Top Rack Storm Wash","price":1661,"img":"c000021.jpg","quantity":1}],"total":1131116.36}');
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(18, 'OTHER_STORES', 'OTHER_STORES', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(19, 'newAccount@blah.com', 'newAccount@blah.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(20, 'hi@hi.hii', 'hihihihi', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(21, 'a@a.ah', 'hihihi', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(22, 'hi@hi.hihi', 'gigigi', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(23, 'wasd@asd.asd', 'asdasd', NULL, NULL, NULL, NULL, NULL, NULL, '{"products":[{"id":"c000013","name":"Panasonic 1.6 Cu. Ft. Microwave","price":279.99,"img":"c000013.jpg","quantity":1}],"total":279.99}');
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(24, 'guy@guy.ca', 'guyguy', NULL, NULL, NULL, NULL, NULL, NULL, '{"products":[{"id":"c000001","name":"LG Tall Tub Built-In Dishwasher","price":1099.99,"img":"c000001.jpg","quantity":"2"},{"id":"c000005","name":"GE Profile 20.2 Cu. Ft. Bottom Mount Refrigerator ","price":1599.99,"img":"c000005.jpg","quantity":1}],"total":3799.97}');
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(25, 'testemail@email.com', 'password', 'Mark', 'Tupala', 'Calgary', 'A1A1A1', 'blah', '111-111-1111', '{"products":[{"id":"c000013","name":"Panasonic 1.6 Cu. Ft. Microwave","price":279.99,"img":"c000013.jpg","quantity":4},{"id":"c000006","name":"LG WaveForce 5.4 Cu. Ft. Top Load HE Washer with Heater","price":1199.99,"img":"c000006.jpg","quantity":2},{"id":"c000001","name":"LG Tall Tub Built-In Dishwasher","price":1099.99,"img":"c000001.jpg","quantity":14}],"total":18919.8}');
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(26, 'a@a.aa', 'asdasd', NULL, NULL, NULL, NULL, NULL, NULL, '{"products":[{"id":"c000020","name":"Breville Cafe Roma Espresso Machine ","price":149.99,"img":"c000020.jpg","quantity":"1"}],"total":149.99}');
INSERT INTO `user` (`userid`, `email`, `password`, `firstname`, `lastname`, `city`, `postal`, `address`, `phone`, `cart`) VALUES(666, 'admin', 'blackmarket5', 'The', 'Man', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userOrders`
--

DROP TABLE IF EXISTS `userOrders`;
CREATE TABLE `userOrders` (
  `orderid` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `userid` int(11) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  PRIMARY KEY (`orderid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE  `ratings` (
`userid` INT( 11 ) NOT NULL ,
`pid` VARCHAR( 255 ) NOT NULL ,
`rating` INT NOT NULL ,
PRIMARY KEY (  `userid` ,  `pid` )
) ENGINE = MYISAM