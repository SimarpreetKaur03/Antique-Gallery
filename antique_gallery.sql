-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2021 at 09:53 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antique gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(50) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price` int(50) NOT NULL,
  `uid` int(10) NOT NULL,
  `pid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_name`, `product_price`, `product_image`, `qty`, `total_price`, `uid`, `pid`) VALUES
(17, ' Royalish Jute and leather Rajasthani Flip-Flops ', 2499, ' assests/images/Products/others/footwear.png ', 1, 2499, 3, 6),
(18, ' ROMAN BELL BOTTOM CLOCK 1800 ', 4999, ' assests/images/Products/decorative/clock.png ', 2, 9998, 4, 17),
(23, ' GOLD FOIL GILDED CHANDELIER ', 20999, ' assests/images/Products/decorative/chandelier.png ', 1, 20999, 1, 18),
(24, ' Antique Wooden Double Door Almirah ', 4999, ' assests/images/Products/furniture/almirah.png ', 1, 4999, 1, 21),
(39, ' Royalish Jute and leather Rajasthani Flip-Flops ', 2499, ' assests/images/Products/others/footwear.png ', 1, 2499, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `checkoutproducts`
--

CREATE TABLE `checkoutproducts` (
  `product_price` int(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `pid` int(10) NOT NULL,
  `oid` int(10) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkoutproducts`
--

INSERT INTO `checkoutproducts` (`product_price`, `qty`, `uid`, `date`, `pid`, `oid`, `id`) VALUES
(2999, 1, 3, '2021-11-18', 3, 3858, 2),
(44999, 2, 2, '2021-11-18', 2, 1233, 3),
(24999, 1, 2, '2021-11-18', 1, 4807, 4),
(52499, 1, 2, '2021-11-18', 9, 4807, 5),
(25999, 1, 2, '2021-11-18', 10, 4807, 6),
(11999, 1, 2, '2021-11-18', 11, 4807, 7),
(5199, 5, 1, '2021-11-19', 19, 5941, 8),
(11999, 2, 4, '2021-11-19', 11, 4927, 9),
(4999, 2, 3, '2021-11-19', 7, 4727, 10),
(20999, 1, 3, '2021-11-19', 18, 4352, 11),
(52499, 5, 4, '2021-11-19', 9, 8003, 13),
(2499, 1, 2, '2021-11-19', 4, 4869, 16),
(2499, 1, 2, '2021-11-19', 6, 4869, 17),
(2999, 1, 2, '2021-11-19', 3, 1525, 18),
(2499, 1, 2, '2021-11-19', 4, 1525, 19);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `date`) VALUES
(4, 'Minal', 'minalkamra7@gmail.com', 'Email Address Change', 'Can I change my email id for the already existing account?', '2021-11-20 16:00:38.000000');

-- --------------------------------------------------------

--
-- Table structure for table `orderhistory`
--

CREATE TABLE `orderhistory` (
  `name` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `products` text NOT NULL,
  `amount_paid` int(25) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `oid` int(10) NOT NULL,
  `uid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderhistory`
--

INSERT INTO `orderhistory` (`name`, `email`, `phone`, `address`, `products`, `amount_paid`, `date`, `oid`, `uid`) VALUES
('Saloni', 'saloniie27@gmail.com', '9999999999', 'Burari,Delhi-110084', ' Imperial Bronze Russian Crockery Set (1)<br> 19th Century French Repousse Brass Metal Spice or Jewelry Box (1)', 5498, '2021-11-19', 1525, 2),
('Simarpreet Kaur', 'skmdel07@gmail.com', '6666666666', 'Rohini,Delhi', ' Imperial Bronze Russian Crockery Set (1)', 2999, '2021-11-18', 3858, 3),
('Simarpreet Kaur', 'skmdel07@gmail.com', '6666666666', 'Rohini,Delhi', ' GOLD FOIL GILDED CHANDELIER (1)', 20999, '2021-11-19', 4352, 3),
('Simarpreet Kaur', 'skmdel07@gmail.com', '6666666666', 'Rohini,Delhi', ' Royal Rosewood Regency Chair (2)', 9998, '2021-11-19', 4727, 3),
('Saloni', 'saloniie27@gmail.com', '9999999999', 'Burari,Delhi-110084', ' Victorian Carnelian Ring with Royal Red Ruby (1)<br> Antique Zircon Royal Bangles (1)<br> MAHARANI VINTAGE TEMPLE NECKLACE (1)<br> GOLD REVIVAL DISK EARINGS (1)', 115496, '2021-11-18', 4807, 2),
('Harshita Kamra', 'harshitakamra392@gmail.com', '7777777777', 'Anoopgarh,Rajasthan', ' GOLD REVIVAL DISK EARINGS (2)', 23998, '2021-11-19', 4927, 4),
('Minal', 'minalkamra7@gmail.com', '8888888888', 'Anoopgarh,Rajasthan', ' ANTIQUE BRASS COATED NRITYA DECOR (5)', 25995, '2021-11-19', 5941, 1),
('Harshita Kamra', 'harshitakamra392@gmail.com', '7777777777', 'Anoopgarh,Rajasthan', ' Antique Zircon Royal Bangles (5)', 262495, '2021-11-19', 8003, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(10) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `pprice` int(20) NOT NULL,
  `offer` int(10) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(25) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `availability` varchar(25) NOT NULL,
  `tag` varchar(25) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `nf` varchar(25) NOT NULL,
  `rating` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `pprice`, `offer`, `description`, `category`, `photo`, `availability`, `tag`, `date`, `nf`, `rating`) VALUES
(1, 'Victorian Carnelian Ring with Royal Red Ruby', 24999, 0, 'This beautiful Ring is handcrafted in Solid 925 Sterling Silver. It is free from lead and nickel to prevent from any type of skin allergies.\r\nCertified Ruby Manik 3.9 Carat Astrology Ring for Women.', 'Jewellery', 'assests/images/Products/jewellery/ring.png', 'In Stock', 'Royal', '2021-10-31', 'featured', 5),
(2, 'Kodak Signet 30 35mm Film Camera 1957', 59999, 25, 'Capture the memories with this reusable 35mm film camera. The M35 has a fixed focus lens, manual film winding and rewinding, and a switch to turn flash On/Off.Camera was film tested, and appears to be in good working condition. Body, and lens are in good shape.', 'Retro Tech', 'assests/images/Products/retro tech/camera.png', 'In Stock', 'Royal', '2021-10-31', 'featured', 5),
(3, 'Imperial Bronze Russian Crockery Set', 2999, 0, 'This dinner set from Kaunteya is crafted from sturdy yet sleek fine bone china highlighted with 24 Carat gold.\r\nlack and gold hue has been selected to narrate these vibrant rituals, as the colour black signifies mystery, while gold hue signifies wisdom which is quite a lot like a marriage - a mysterious journey of finding each other and eventually gaining wisdom in the form of eternal love.', 'Crockery', 'assests/images/Products/crockery/teaset.png', 'In Stock', 'Royal', '2021-10-31', 'featured', 5),
(4, '19th Century French Repousse Brass Metal Spice or Jewelry Box', 2499, 0, 'Made from high-quality walnut wood, this magnificently designed wood carved jewellery box is sure to accommodate all your necessities and add a crafty stance to your life style. The fine details in the carvings of this box boast of the Kashmiri beauty and the craftsmanship. This exquisite piece of beauty from its mere look can present the dexterity that has been put in for its creation. Used for keeping valuable items and also as a showpiece.', 'Other', 'assests/images/Products/others/box.png', 'In Stock', 'Royal', '2021-10-31', 'featured', 5),
(5, 'Imperial Shining set of Silver table Spoons', 9999, 0, 'An explosion of creativity and intricacies, motivated from the Victorian Era. This Sterling Silver collection adds the wow factor to your dining table. Made in sterling silver. Stamped in confirmation. A perfect wedding,housewarming gift. Anti Tarnish', 'Crockery', 'assests/images/Products/crockery/spoons.png', 'In Stock', 'Royal', '2021-10-31', 'new', 4),
(6, 'Royalish Jute and leather Rajasthani Flip-Flops', 2499, 0, 'Unique, with an ethnic touch.\r\nFaux leather, soft padding\r\nBeautiful, guilt free patterned straps\r\nSoles made with love, of up-cycled jute\r\nBeautiful patterns and VERY trendy!\r\nHandcrafted by cobblers, fairtrade standards implemented.', 'Other', 'assests/images/Products/others/footwear.png', 'In Stock', 'Royal', '2021-10-31', 'new', 4),
(7, 'Royal Rosewood Regency Chair', 4999, 0, 'Looking for something natural, warm and comfortable? Go for the Royal Rosewood Regency Chair in natural finish. Crafted from handwoven rattan, this armchair brings together style and comfort in a unique design. Grand enough to elevate the look and feel of any room and compact enough to fit into spaces small and large.', 'Furniture', 'assests/images/Products/furniture/chair.png', 'In Stock', 'Royal', '2021-10-31', 'new', 4),
(8, 'Wooden Majestic Queen Bangles Holder', 3499, 0, 'Handcrafted Wooden  Majestic Queen Bangles Holder, Antique Finish Bangles Stand Holder - An ideal gift for all women.This Unique Beautiful Antique look bangle stand is made of fine and smooth best quality Mango wood and is decked with Fine Engraving. We Make amazingly crafted Antique look bangle holder which will surely add more charm to your dressing table and your cabinet.', 'Decorative', 'assests/images/Products/decorative/banglestand.png', 'In Stock', 'Royal', '2021-10-31', 'new', 4),
(9, 'Antique Zircon Royal Bangles', 69999, 25, 'Featuring a gold finish blue meenakari bangle studded with kundan polki, set in mix metal. A pair of 22 Kt gold plated bangle studded with pearl, set in alloy. Store them in moisture free areas and keep them away from water and liquid fragrances.Keep the pieces in packaging provided and do not keep the pieces together.', 'Jewellery', 'assests/images/Products/jewellery/bangles.png', 'In Stock', 'Royal', '2021-10-31', '', 4),
(10, 'MAHARANI VINTAGE TEMPLE NECKLACE', 25999, 0, 'Featuring a gold finish maharani temple pendant necklace studded with shell pearl drops and white beaded strings, set in brass and copper base. Temple-inspired pendants and floral motifs, it is prefect for all your exclusive occasions. Store in moisture free environment.', 'Jewellery', 'assests/images/Products/jewellery/neckpiece.png', 'In Stock', 'Royal', '2021-10-31', '', 4),
(11, 'GOLD REVIVAL DISK EARINGS', 15999, 25, 'The Design Is Made Using A Dough Of Marble Stone Dust Powder And Fevicol. The Base Is MDF. After The Design Is Dry, It Is Painted Using Acrylic Paints/Metallic Emulsion. The Design Is Made Using A Dough Of Marble Stone Dust Powder And Fevicol. The Base Is MDF. After The Design Is Dry, It Is Painted Using Acrylic Paints/Metallic Emulsion.\r\n', 'Jewellery', 'assests/images/Products/jewellery/earrings.png', 'In Stock', 'Royal', '2021-10-31', '', 3),
(12, 'VINTAGE SILVER CROCKERY PLATE STAND', 5999, 0, 'Present frosting-swirled cupcakes, savories or even home accessories with artful charm on this elegant stand. Make a lasting impression on your guests! Central rod disassembles for easy storage and transportation. Can be made into a 2 tier stand. Perfect for festivals, the two storey plate tray stand is the best decor and storage accessory to have around the house. ', 'Crockery', 'assests/images/Products/crockery/stand.png', 'In Stock', 'Royal', '2021-10-31', '', 3),
(13, '19th CENTURY METAL HEAVY CUT JUG', 9999, 35, 'This is A beauty full Pitcher for gift to any one and it makes your kitchen stylish. This will add beauty to your kitchen. This is a very decorative Jug made with Bell Metal. Decorate like never before..!! Create the mehfil-e-sama at your home with this antique looking traditional Jug. A perfect blend of old and modern era. ', 'Crockery', 'assests/images/Products/crockery/jug.png', 'In Stock', 'Royal', '2021-10-31', '', 3),
(14, 'ANTIQUE 19TH CENTURY RADIO', 4999, 0, 'Turn back time in your home with the 19th century AM/FM Analog Tabletop Radio from Sangean. This vintage-style radio features a rounded wooden cabinet with an analog tuning display. Even with an analog display, the soft dial helps to precisely tune in your favorite stations. In addition to AM/FM radio, the built-in 3\" 6.5W full-range speaker can play', 'Retro Tech', 'assests/images/Products/retro tech/radio.png', 'In Stock', 'Royal', '2021-10-31', '', 4),
(15, 'ANTIQUE TV OLD VERSION 3D MODEL', 10999, 0, 'Efficient name in the industry involved in offering the optimum quality of Antique TV Unit.Television Set Tabletop Accent, Living Room Office Shelf Table Desktop Bedroom , Gift Purpose , Blackish-Brown. Wipe it with a dry/damp cloth to clean it. Do not wash it. Intricate Designing and Finishing.', 'Retro Tech', 'assests/images/Products/retro tech/tv.png', 'In Stock', 'Royal', '2021-10-31', '', 3),
(16, 'WOODEN BRASS VINTAGE TELEPHONE 1890', 9999, 25, 'Masco Latest Antique Solid Wood Rotate Dial Numbering Telephone European Style Retro Home Office Landline. It reminds us of the time when such phones highlighted one corner of our room. It is a great possession for vinatge lovers, office dcor, home dcor and gifting.', 'Retro Tech', 'assests/images/Products/retro tech/telephone.png', 'In Stock', 'Royal', '2021-10-31', '', 4),
(17, 'ROMAN BELL BOTTOM CLOCK 1800', 4999, 0, 'This Luxury Roman Bell Bottom Clock Accent will complement your living room, bedroom, or office decor. It is a charming, considerate, and cheerful addition to your home accent. It is made of solid metal and would make an excellent present for someone who collects antiques. Stylish and unique decor accent, perfect for a new home gift or corporate gift.', 'Decorative', 'assests/images/Products/decorative/clock.png', 'In Stock', 'Royal', '2021-10-31', '', 4),
(18, 'GOLD FOIL GILDED CHANDELIER', 20999, 0, 'This 8 Light Chandelier Is A Unique Design, Specially Designed For Bed Room, Drawing Room, Dianing Hall, Office,shop, Showroom, Balcony Etc. It\'s Made In High Quality Material, It\'s Finished Very Fine, Its Brass Shades Is Very Good Finish. This ceiling pendant is UL listed for safety and indoor use only.', 'Decorative', 'assests/images/Products/decorative/chandelier.png', 'In Stock', 'Royal', '2021-10-31', '', 5),
(19, 'ANTIQUE BRASS COATED NRITYA DECOR', 7999, 35, 'This beautiful Dancing Nataraja statue created by craftsmen in India, the lovely statue brings goodness and benevolence to your home and your world\r\nShiva as Nataraja is the Lord of Dance who simultaneously destroys and creates the universe anew with each cycle of his mystical dance.\r\nLord Nataraja Statue carved brass by artist and specially technique with color accents to give a look without sacrificing the details', 'Decorative', 'assests/images/Products/decorative/statue.png', '', 'Royal', '2021-10-31', '', 5),
(20, 'BROWN SANDAL WOOD ANTIQUE SOFA', 7999, 25, 'Impress your friends & family with this beautiful yet durable Bench Couch and enjoy the chatter! Add charm to your place with this exclusive Bench Couch.\r\nIt is well crafted from premium Sheesham wood and quality upholstery.\r\nMaterial - Sheesham Wood & Fabric. ', 'Furniture', 'assests/images/Products/furniture/sofa.png', 'In Stock', 'Royal', '2021-10-31', '', 3),
(21, 'Antique Wooden Double Door Almirah', 4999, 0, 'A neat and versatile cabinet with classic appeal, it can be used to keep your footwear organized and out of sight or simply for extra storage. The louvered doors are made from solid rubber wood and provide the necessary ventilation. The shelves and body are constructed with 15mm thick boards of engineered wood with polyurethane lamination, and the backboard is 3mm thick.', 'Furniture', 'assests/images/Products/furniture/almirah.png', 'In Stock', 'Royal', '2021-10-31', '', 5),
(22, 'RETRO MEENAKARI DRESSING MAKEUP TABLE', 10999, 25, 'Feel like a celebrity with this three-mirror dresser from Woodsala. The makeup and vanity dressing table has 8 drawers of different sizes. Apart from the drawers, the furniture also has  separate shelf for daily items. Designed to look good in both contemporary and colonial-style homes, the dresser blends well with the surroundings. The side-view mirrors provide a complete portrait and can be shut when not in use.', 'Furniture', 'assests/images/Products/furniture/mirror.png', 'In Stock', 'Royal', '2021-10-31', '', 4),
(23, 'PEACOCK SEA SHELL HAND CLUTCH 1990', 3999, 0, 'The beautifully hand embroided Bag are created using zardozi technique,carefully stitching layer upon layer of threads and metal wires and Embellished with Precious or Semi Precious gemstones making each piece one of its kind. Size cm : 22X19X04 Utility : Shoulder Bag Material : Velvet Fabric, Metal Thread Stones.\r\nFeaturing a spacious design and sleek form.', 'Other', 'assests/images/Products/others/handbag.png', 'In Stock', 'Royal', '2021-10-31', '', 4),
(24, 'GOLD COATED KEY PUZZLE PADLOCK', 4999, 35, 'What a symbol of serenity to bless your home with indeed a lovely way to open a door and a comforting way to keep it secured. This lovely gold lock is a truly unique home accessory and perfect as a gift too! A common sight in most Indian homes, the practice of gold metal crafting dates back to ancient times in India. The art and techniques of working with metal right from mining to smelting & modelling of items was developed thousands of years ago.', 'Other', 'assests/images/Products/others/lock.png', 'In Stock', 'Royal', '2021-10-31', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `resetpassword`
--

CREATE TABLE `resetpassword` (
  `id` int(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `otp` int(20) NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resetpassword`
--

INSERT INTO `resetpassword` (`id`, `email`, `otp`, `date`) VALUES
(1, 'minalkamra7@gmail.com', 749778, '2021-11-17 18:47:50.000000'),
(2, 'saloniie27@gmail.com', 870758, '2021-11-19 18:27:04.000000');

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE `search` (
  `sid` int(10) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `top` varchar(10) NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `search`
--

INSERT INTO `search` (`sid`, `sname`, `top`, `photo`) VALUES
(1, 'jewellery', 'yes', 'assests/images/Products/top category/jewellery.png'),
(2, 'crockery', 'yes', 'assests/images/Products/top category/cup.png'),
(3, 'retro tech', 'yes', 'assests/images/Products/top category/camera.png'),
(4, 'furniture', '', ''),
(5, 'decorative', 'yes', 'assests/images/Products/top category/decor.png');

-- --------------------------------------------------------

--
-- Table structure for table `ureviews`
--

CREATE TABLE `ureviews` (
  `sno` int(10) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `review` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ureviews`
--

INSERT INTO `ureviews` (`sno`, `uname`, `email`, `review`, `date`) VALUES
(1, 'Minal', 'minalkamra7@gmail.com', 'I\'ve made several orders with Galerie d\'antiquités and I\'m impressed with delivery.They\'ve been right on time or early and leave my item right at my door. Occasionally I\'ve to return purchases which is a pretty straightforward process, no hoops to jump throughor hidden pitfalls. I couldn\'t be more satisfied with my customer service experience.', '2021-11-11 20:34:55'),
(2, 'Simarpreet Kaur', 'skmdel07@gmail.com', 'I have been very happy using Galerie d\'antiquités for years, with very few issues until recently. It appears that their customer support has changed, most likely due to the Chinese Covid-19 virus, which has brought our country to its knees. I will continue to shop on Galerie d\'antiquités , and will continue to compare their prices against their competition.', '2021-11-11 20:41:32'),
(3, 'Saloni', 'saloniie27@gmail.com', 'Galerie d\'antiquités® is great leading shopping platform the delivery is so fast and product quality is so good I have also ordered a Ring from Galerie d\'antiquités®, the product quality of Galerie d\'antiquités® is gain 4.5 out of 5 , after the payment of product the delivery gets in 4 to 5 days.', '2021-11-11 20:51:43'),
(4, 'Harshita Kamra', 'harshitakamra392@gmail.com', 'Great shopping experience right at my fingertips. Galerie d\'antiquités offers products that may be hard to find locally. Shopping made easy & convenient. Customer Service has been great at Galerie d\'antiquités when I havea problem. It awesome works and is cheap. I\'d 100% rebuy the products and some and also would share with everyone I know.', '2021-11-11 20:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(10) NOT NULL,
  `uname` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(25) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `uname`, `email`, `password`, `date`) VALUES
(1, 'Minal', 'minalkamra7@gmail.com', 'cba123', '2021-11-11'),
(2, 'Saloni', 'saloniie27@gmail.com', 'hello123', '2021-11-11'),
(3, 'Simarpreet Kaur', 'skmdel07@gmail.com', 'simar321', '2021-11-11'),
(4, 'Harshita Kamra', 'harshitakamra392@gmail.com', 'harshi789', '2021-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `uname` varchar(25) NOT NULL,
  `pid` int(10) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wid`, `uid`, `uname`, `pid`, `date`) VALUES
(1, 1, 'Minal', 5, '2021-11-17'),
(3, 1, 'Minal', 2, '2021-11-19'),
(4, 3, 'Simarpreet Kaur', 1, '2021-11-19'),
(5, 3, 'Simarpreet Kaur', 4, '2021-11-19'),
(6, 4, 'Harshita Kamra', 18, '2021-11-19'),
(7, 4, 'Harshita Kamra', 16, '2021-11-19'),
(8, 4, 'Harshita Kamra', 2, '2021-11-19'),
(9, 2, 'Saloni', 18, '2021-11-20'),
(10, 2, 'Saloni', 7, '2021-11-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkoutproducts`
--
ALTER TABLE `checkoutproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderhistory`
--
ALTER TABLE `orderhistory`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search`
--
ALTER TABLE `search`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `ureviews`
--
ALTER TABLE `ureviews`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `checkoutproducts`
--
ALTER TABLE `checkoutproducts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orderhistory`
--
ALTER TABLE `orderhistory`
  MODIFY `oid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8594;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `resetpassword`
--
ALTER TABLE `resetpassword`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `search`
--
ALTER TABLE `search`
  MODIFY `sid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ureviews`
--
ALTER TABLE `ureviews`
  MODIFY `sno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
