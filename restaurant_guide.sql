-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2019 at 11:13 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant_guide`
--

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `deal_id` int(11) NOT NULL,
  `restaurant_id` varchar(6) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`deal_id`, `restaurant_id`, `start_date`, `end_date`, `description`) VALUES
(1, 'RS001', '2019-10-29', '2019-11-29', 'Buy 1 Get 1 Free Burgers'),
(2, 'RS001', '2019-11-16', '2019-12-16', 'Any Flavour Large Milkshake for €2'),
(3, 'RS002', '2019-11-16', '2019-12-16', 'Tester Drinks for €1'),
(4, 'RS002', '2019-11-17', '2019-11-22', 'Pizza'),
(5, 'RS002', '2019-11-24', '2019-11-29', 'Steak');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `restaurant_id` varchar(6) NOT NULL,
  `username` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`restaurant_id`, `username`) VALUES
('RS003', 'lchavez'),
('RS004', 'lchavez'),
('RS006', 'lchavez'),
('RS007', 'lchavez'),
('RS008', 'lchavez'),
('RS009', 'lchavez'),
('RS011', 'lchavez');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `restaurant_id` varchar(6) NOT NULL,
  `res_name` varchar(25) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `address` varchar(60) NOT NULL,
  `city` varchar(25) NOT NULL,
  `country` varchar(25) NOT NULL,
  `cuisine` varchar(20) NOT NULL,
  `reservation` char(1) NOT NULL DEFAULT 'N',
  `website` varchar(30) DEFAULT NULL,
  `res_image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurant_id`, `res_name`, `phone`, `address`, `city`, `country`, `cuisine`, `reservation`, `website`, `res_image`) VALUES
('RS001', 'Dino\'s Diner', '+011112222', '123 Mid Street', 'Dublin', 'Ireland', 'American', 'Y', 'dinosdiner.com', 'dino-diner.jpg'),
('RS002', 'Ezio\'s Garden', '+011112212', '123 Mid Street', 'Dallas', 'USA', 'Italian', 'N', NULL, 'ezios.jpg'),
('RS003', 'Cafe Manila', '+011113333', '123 High Street', 'Dublin', 'Ireland', 'Filipino', 'N', 'www.cafemanila.com', 'cafe-manila.jpg'),
('RS004', 'Matchip', '+011114444', '123 Fade Street', 'Bray', 'Ireland', 'Korean', 'N', 'www.matchip.ie', 'matchip.jpg'),
('RS005', 'Panda Buffet', '+011114445', '123 Low Street', 'New York', 'USA', 'Fusion', 'N', 'www.pandabuffet.com', 'panda-buffet.jpg'),
('RS006', 'Ruiz Tacqueria', '+011114446', '234 Clear Street', 'Bray', 'Ireland', 'Mexican', 'N', NULL, 'ruiz-taco.jpg'),
('RS007', 'Brian Kang\'s', '+011114448', '246 Fade Street', 'Dublin', 'Ireland', 'Korean', 'N', 'www.bkang.com', 'brian-kangs.jpg'),
('RS008', 'Tablo\'s', '+011114449', '246 Mid Street', 'Toronto', 'Canada', 'Fusion', 'Y', 'www.tablos.com', 'tablos-fusion.jpg'),
('RS009', 'Chavez Bar & Grill', '+011112233', '651 Charity Street', 'Ventura, California', 'USA', 'Filipino', 'Y', 'www.chavezgrill.com', 'chavez-grill.jpg'),
('RS011', 'Hawlucha', '+011114545', '149 George Street', 'Dubllin', 'Ireland', 'Mexican', 'Y', 'www.hawlucha.ie', 'hawlucha.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `username` varchar(13) NOT NULL,
  `restaurant_id` varchar(6) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(280) NOT NULL,
  `rev_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `username`, `restaurant_id`, `title`, `description`, `rev_date`) VALUES
(1, 'lchavez', 'RS001', 'Awesome Food', 'Food was amazing! Great burgers and fries!', '2019-11-11'),
(2, 'lchavez', 'RS001', 'As amazing as last time!', 'Used my deal today and quality is still amazing!', '2019-11-16'),
(3, 'lchavez', 'RS002', 'Okay place', 'Decent food', '2019-11-26'),
(5, 'lchavez', 'RS001', 'Hello', 'Sweet Chaos', '2019-11-20'),
(6, 'lchavez', 'RS001', 'Lovely Pasta', 'Spaghetti Bolognese was amazing here! Lovely ambiance too!', '2019-11-20'),
(10, 'lchavez', 'RS001', 'Great Food', 'Just as the title says! Great Food!', '2019-11-20'),
(12, 'lchavez', 'RS011', 'Love It!', 'The lime and cilantro chicken is to die for! Highly recommend!', '2019-11-20'),
(13, 'lchavez', 'RS007', 'A Hidden Gem', 'This place is a hidden gem! It\'s tucked away and easy to miss but it packs a lot of amazing food!', '2019-11-24'),
(14, 'lchavez', 'RS003', 'Taste of Home', 'A quaint little cafe in the heart of Dublin. I can confidently that what they serve here is very authentic. If you want to have a try at some Filipino food in Dublin, this is the spot!', '2019-11-24'),
(15, 'lchavez', 'RS003', 'Thank You', 'Writing once again to say thank you to the kind owners. Will definitely recommend to others and come back!', '2019-11-24'),
(16, 'lchavez', 'RS006', 'Nice Tacos', 'Perfect for a quick lunch!', '2019-11-24'),
(17, 'lchavez', 'RS005', 'Good buffet', 'Good selection of food here! Could use a better desert section though', '2019-11-24'),
(18, 'lchavez', 'RS007', 'Great Food', 'Great food', '2019-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(13) NOT NULL,
  `password` varchar(13) NOT NULL,
  `name` varchar(25) NOT NULL,
  `date_joined` date NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `security_q` varchar(140) NOT NULL,
  `security_ans` varchar(140) NOT NULL,
  `user_pic` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `date_joined`, `city`, `country`, `email`, `security_q`, `security_ans`, `user_pic`) VALUES
('JamesJ', 'pass', 'James Johnson', '2019-11-23', 'New York', 'USA', 'jamesj@mail.com', 'What is your favourite colour?', 'red', 'default_img.jpg'),
('lchavez', 'pass', 'Louis Chavez', '2019-10-29', 'Dublin', 'Ireland', 'louis@mail.com', 'What was the name of your first pet?', 'Tom', 'IMG_7798_e1.jpg'),
('test', 'pass', 'Mark Tester', '2019-11-17', 'Virginia', 'USA', 'test123@mail.com', 'What is the maiden name of your mother?', 'Reed', 'default_img.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
  ADD PRIMARY KEY (`deal_id`,`restaurant_id`),
  ADD KEY `deals_res_fk` (`restaurant_id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`restaurant_id`,`username`),
  ADD KEY `fav_users_fk` (`username`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`,`username`,`restaurant_id`),
  ADD KEY `reviews_users_fk` (`username`),
  ADD KEY `reviews_res_fk` (`restaurant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deals`
--
ALTER TABLE `deals`
  MODIFY `deal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deals`
--
ALTER TABLE `deals`
  ADD CONSTRAINT `deals_res_fk` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`);

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `fav_restaurant_fk` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`),
  ADD CONSTRAINT `fav_users_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_res_fk` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`restaurant_id`),
  ADD CONSTRAINT `reviews_users_fk` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
