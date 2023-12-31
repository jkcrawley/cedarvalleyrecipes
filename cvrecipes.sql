-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 23, 2023 at 07:03 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cvrecipes`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(255) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`c_id`, `c_name`) VALUES
(1, 'Dinner'),
(2, 'Breakfast'),
(3, 'Lunch');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_cat` int(11) NOT NULL,
  `r_users` int(11) NOT NULL,
  `r_image` varchar(255) NOT NULL,
  `r_title` varchar(255) NOT NULL,
  `r_recipe` text NOT NULL,
  `r_date` date NOT NULL,
  `r_description` varchar(255) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`r_id`, `r_cat`, `r_users`, `r_image`, `r_title`, `r_recipe`, `r_date`, `r_description`) VALUES
(1, 1, 1, 'istockphoto-1028521356-2048x2048.jpg', 'Mac and Cheese', 'Ingredients\r\n\r\n-Milk\r\n-Flour\r\n-Butter\r\n-Gouda Cheese\r\n-Sharp Chedder\r\n-Parmesan\r\n-Breadcrumbs\r\n-Elbow Mac\r\n\r\n1. Boil elbow macaroni in salted water, drain.\r\n\r\n2. Begin making a roux with equal parts butter and flour.\r\n\r\n2. Add Milk in slowly while stirring.\r\n\r\n3. Slow add in cheddar and gouda, add more milk if needed.\r\n\r\n4. Once cheese sauce is to liking, then pour into baking dish with elbow Mac. Top with breadcrumbs and parmesan cheese.\r\n\r\n5. Bake until top is golden brown and parmesan is melted, approximately 20 minutes.\r\n\r\n6. Enjoy', '2023-12-23', 'My favorite side dish for any BBQ, a simple homemade mac and cheese'),
(2, 1, 1, '', 'Fried Chicken', '<p><strong>Ingredients</strong><br><br>- Chicken broth<br>- 1 whole chicken<br>- 2 eggs<br>- 1 Â½ cup whole milk<br>- Seasoning: Salt, pepper, thyme, oregano, cayenne pepper, garlic powder, onion powder<br>-2 cups flour<br>- Vegetable oil<br><br><br><strong>Directions</strong><br><br>1. &nbsp;Cut whole chicken into 8 pieces (you can save the spine for a delicious future chicken noodle soup!)<br><br>2. Place chicken into container of your choosing, pour in chicken broth, cover and let soak for at least 2 hours.<br><br>3. In a mixing bowl, combine flour and seasonings. Season flour until it becomes colorful and fragrant from the various seasonings. Season to your taste.<br><br>4. &nbsp;whisk eggs and milk.<br><br>5. Bring vegetable oil up to medium heat in either a pot (for faster cooking, but uses more oil) or frying pan (perferably cast iron).<br><br>6. dip chicken into egg mixture then into flour. &nbsp;If you like your chicken to be extra crispy, allow it to sit for at least 10 minutes.<br><br>7. &nbsp;Place Chicken into vegetable and cover. Typically on a medium heat it is fully cooked by the time it reaches a dark brown color, but to be safe you can check with a thermometer and make sure it is 165 degrees.<br><br>8. place on a wire rack or paper towels to drip or soak up vegetable oil.<br><br>9. Enjoy!<br><br><br>&nbsp;</p>', '2023-12-23', 'Simple, but easy fried chicken recipe'),
(3, 1, 1, 'friedchicken.jpg', 'Fried Chicken', '<p><strong>Ingredients</strong><br><br>- Chicken broth<br>- 1 whole chicken<br>- 2 eggs<br>- 1 Â½ cup whole milk<br>- Seasoning: Salt, pepper, thyme, oregano, cayenne pepper, garlic powder, onion powder<br>-2 cups flour<br>- Vegetable oil<br><br><br><strong>Directions</strong><br><br>1. &nbsp;Cut whole chicken into 8 pieces (you can save the spine for a delicious future chicken noodle soup!)<br><br>2. Place chicken into container of your choosing, pour in chicken broth, cover and let soak for at least 2 hours.<br><br>3. In a mixing bowl, combine flour and seasonings. Season flour until it becomes colorful and fragrant from the various seasonings. Season to your taste.<br><br>4. &nbsp;whisk eggs and milk.<br><br>5. Bring vegetable oil up to medium heat in either a pot (for faster cooking, but uses more oil) or frying pan (perferably cast iron).<br><br>6. dip chicken into egg mixture then into flour. &nbsp;If you like your chicken to be extra crispy, allow it to sit for at least 10 minutes.<br><br>7. &nbsp;Place Chicken into vegetable and cover. Typically on a medium heat it is fully cooked by the time it reaches a dark brown color, but to be safe you can check with a thermometer and make sure it is 165 degrees.<br><br>8. place on a wire rack or paper towels to drip or soak up vegetable oil.<br><br>9. Enjoy!</p>', '2023-12-23', 'Homemade, easy to make fried chicken!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` varchar(20) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_level` int(11) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_lvlrequest` varchar(3) NOT NULL,
  `u_newsletter` varchar(3) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_username`, `u_password`, `u_level`, `u_email`, `u_lvlrequest`, `u_newsletter`) VALUES
(1, 'jkcrawley', '$2y$10$38gBvO9fGg8hNa.3GTMq2u3UdAmWCSYX8xnkRV5U4rIuiiCdT1yKe', 1, 'j-crawley@live.com', 'yes', 'yes');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
