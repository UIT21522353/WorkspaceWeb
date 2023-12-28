-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 28, 2023 at 12:35 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodies`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_qty` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `product_qty`, `created_at`) VALUES
(98, 23, 25, 1, '2023-12-26 10:54:38'),
(99, 23, 20, 1, '2023-12-28 08:43:32'),
(101, 23, 19, 1, '2023-12-28 09:25:15'),
(102, 23, 29, 1, '2023-12-28 09:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `popular` tinyint NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `status`, `popular`, `image`, `created_at`) VALUES
(1, 'Action', 'action', 'Fast-paced and intense gameplay. Focus on physical challenges, combat, and reflexes.', 0, 1, 'action.jpg', '2023-12-28 11:29:18'),
(2, 'Adventure ', 'adventure', 'Story-driven with a focus on exploration and puzzle-solving.', 0, 1, 'adventure.jpg', '2023-12-28 11:30:37'),
(3, 'Sports \r\n\r\n', 'sports', 'Simulates real-world sports.', 0, 1, 'sports.jpg', '2023-12-28 11:31:37'),
(12, 'Side Dish', 'side-dish', 'Perfect side-kicks for perfect main dishes', 0, 1, '1702819351.jpg', '2023-12-17 13:22:31'),
(13, 'Main Dish', 'main-dish', 'Must-have', 0, 1, '1702824726.jpg', '2023-12-17 13:27:11'),
(14, 'Dessert', 'dessert', 'Wide array of delectable sweets and treats', 0, 1, '1702819929.jpg', '2023-12-17 13:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `msg` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tracking_no` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `address` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` int NOT NULL,
  `payment_mode` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_id` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `comments` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_no`, `user_id`, `name`, `email`, `phone`, `address`, `total_price`, `payment_mode`, `payment_id`, `status`, `comments`, `created_at`) VALUES
(85, 'hSjs7XnxdostjVx2lN67', 23, 'gh', 'd@e', '123', ' ,  , Ward An Khanh, District 2', 380000, 'COD', '', 0, '', '2023-12-26 10:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `qty`, `price`, `created_at`) VALUES
(74, 85, 21, 1, 210000, '2023-12-26 10:54:06'),
(75, 85, 20, 1, 170000, '2023-12-26 10:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `small_description` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `original_price` int NOT NULL,
  `selling_price` int NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `status` tinyint NOT NULL,
  `trending` tinyint NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`, `image`, `qty`, `status`, `trending`, `created_at`) VALUES
(1, 1, 'God of War', 'god-of-war', 'Epic journey as a legendary warrior.', 'Embark on an epic journey as a legendary warrior battling mythical creatures.', 60, 50, 'god-of-war.jpg', 100, 0, 1, '2023-12-28 11:36:00'),
(2, 1, 'Marvel\'s Spider-Man', 'marvels-spider-man', 'Stealthy assassin in the shadows', 'Become a stealthy assassin and navigate through the shadows to complete deadly missions.', 50, 40, 'marvels-spider-man.jpg', 150, 0, 1, '2023-12-28 11:37:36'),
(3, 1, 'Resident Evil Village', 'resident-evil-village', 'Procedurally generated world.', 'Explore a procedurally generated world, battling monsters and unlocking new abilities.', 40, 30, 'resident-evil-village.jpg', 120, 0, 1, '2023-12-28 11:39:40'),
(4, 2, 'Horizon Zero Dawn', 'horizon-zero-dawn', 'Thrilling adventure to uncover mysteries.', 'Embark on a thrilling adventure to uncover the mysteries of a lost civilization.', 65, 55, 'horizon-zero-dawn.jpg', 90, 0, 1, '2023-12-28 11:43:30'),
(5, 2, 'Ghost of Tsushima', 'ghost-of-tsushima', 'Journey through magical realms.', 'Journey through magical realms and solve puzzles to restore balance to the world.', 60, 50, 'ghost-of-tsushima.jpg', 110, 0, 1, '2023-12-28 11:46:32'),
(6, 2, 'Days Gone', 'days-gone', 'Search for hidden treasures.', 'Search for hidden treasures in exotic locations, but beware of traps and enemies.', 50, 40, 'days-gone.jpg', 130, 0, 1, '2023-12-28 11:47:34'),
(7, 3, 'FIFA 22', 'fifa-22', 'The latest installment in the FIFA series.', 'Experience the excitement of football with realistic gameplay in FIFA 22.', 70, 60, 'fifa-22.jpg', 80, 0, 1, '2023-12-28 11:57:17'),
(8, 3, 'NBA 2K22', 'nba-2k22', 'The premier basketball simulation game.', 'Play the most realistic basketball game with NBA 2K22.', 60, 50, 'nba-2k22.jpg', 120, 0, 1, '2023-12-28 11:58:11'),
(9, 3, 'Gran Turismo Sport', 'gran-turismo-sport', 'A stunning racing experience.', 'Immerse yourself in the world of realistic racing with Gran Turismo Sport.', 60, 50, 'gran-turismo-sport.jpg', 120, 0, 1, '2023-12-28 12:00:36'),
(19, 13, 'Les Huitres Gratiness', 'les-huitres-gratiness', '\"Les Huitres Gratiness\" is a savory French dish featuring briny and succulent oysters, exquisitely prepared to tantalize the taste buds. The dish delivers a harmonious blend of fresh flavors and delicate textures, making it a delightful choice for seafood enthusiasts.', '\"Les Huitres Gratiness\" is a delightful French culinary creation that showcases the finest oysters meticulously prepared to perfection. Each bite offers a delightful burst of maritime freshness, accentuated by subtle yet rich flavor profiles. The dish is a testament to culinary craftsmanship, offering a remarkable indulgence for seafood connoisseurs.', 150000, 120000, '1702820115.jpeg', 30, 0, 1, '2023-12-17 13:35:15'),
(20, 13, 'La Fricassée de Lotte', 'la-Fricassee-de-lotte', '\"La Fricassée de Lotte\" is a delectable French dish featuring monkfish, expertly prepared with flavorful ingredients to deliver a rich, savory experience, showcasing the culinary artistry of French cuisine.', '\"La Fricassée de Lotte\" is a classic French culinary masterpiece that highlights the delicate and firm texture of monkfish, combined with aromatic herbs, savory sauces, and perfectly balanced seasonings. This dish presents a harmonious blend of flavors and textures, creating a memorable dining experience that reflects the essence of French gastronomy.', 200000, 170000, '1702820492.jpeg', 19, 0, 1, '2023-12-17 13:41:32'),
(21, 13, 'Le Boeuf du Boucher', 'le-boeuf-du-boucher', '\"Le Boeuf du Boucher\" translates to \"Butcher\'s Beef\" in English and is a delectable French dish that showcases the finest cuts of beef, skillfully prepared to perfection, representing the epitome of French culinary expertise.', '\"Le Boeuf du Boucher\" is a culinary delight that epitomizes the art of French butchery, featuring premium cuts of beef expertly seasoned and cooked to showcase the natural flavors and textures of the meat. This dish embodies the essence of French gastronomy, offering a succulent and unforgettable dining experience.', 250000, 210000, '1702824697.jpg', 39, 0, 1, '2023-12-17 13:47:12'),
(22, 14, 'Pot de Crème à la Citrouille', 'pot-de-creme-a-la-citrouille', 'Indulge in the rich and creamy flavors of \"Pot de Crème à la Citrouille,\" a delightful French dessert with a seasonal twist, featuring the warm essence of pumpkin in every spoonful.', '\"Pot de Crème à la Citrouille\" is a luxurious French dessert that artfully combines velvety smooth custard with the comforting flavors of pumpkin and a hint of seasonal spices. This indulgent treat embodies the essence of autumn, offering a delectable fusion of creamy textures and warm, fragrant undertones.', 190000, 160000, '1702821998.jpg', 40, 0, 1, '2023-12-17 13:49:21'),
(23, 14, 'Baba au Rum', 'baba-au-rum', 'Indulge in the timeless elegance of Baba au Rum, a classic French dessert soaked in rum syrup. Savor the rich flavors and moist texture of this delectable treat, perfect for those who appreciate the artistry of fine pastry.', 'Baba au Rum, a culinary masterpiece originating from France, is a dessert that embodies sophistication and indulgence. This delectable treat features a light and airy yeast cake, perfectly infused with a generous amount of rum syrup. The result is a moist, flavorful delight that captivates the palate with every bite. Whether served plain or with a dollop of whipped cream, Baba au Rum is a celebration of the harmonious marriage between sweet pastry and the robust notes of rum. Elevate your dessert experience with this exquisite classic that has stood the test of time.', 140000, 90000, '1702823245.jpg', 25, 0, 1, '2023-12-17 14:26:19'),
(24, 12, 'Salad de Chou', 'salad-de-chou', 'Experience the crisp freshness of Salad de Chou, a delightful French cabbage salad that combines vibrant vegetables with a zesty dressing. Elevate your palate with this light and flavorful dish.', 'Salad de Chou, a French cabbage salad, is a celebration of freshness and simplicity. Crisp shredded cabbage is paired with an array of colorful vegetables, creating a visually appealing and nutrition-packed dish. The salad is elevated with a tangy and flavorful dressing, perfectly balancing the textures and tastes. Whether served as a refreshing side or a light main course, Salad de Chou is a culinary delight that brings together the goodness of garden-fresh ingredients with the artistry of French cuisine. Immerse yourself in a symphony of flavors with every forkful of this vibrant salad.', 120000, 95000, '1702823476.jpg', 50, 0, 1, '2023-12-17 14:31:16'),
(25, 14, 'Opera', 'opera', 'Indulge in the opulent layers of Opera, a French pastry masterpiece. This decadent dessert features delicate layers of almond sponge, coffee buttercream, and rich chocolate ganache.', 'Opera, a quintessential French pastry, is a symphony of flavors and textures that delights dessert enthusiasts worldwide. This luxurious creation consists of meticulously crafted layers, including almond sponge, coffee buttercream, and sumptuous chocolate ganache. The almond sponge provides a delicate and nutty base, while the coffee-infused buttercream adds a subtle richness. The ensemble is harmonized with a velvety chocolate ganache, creating a perfect balance of sweetness and depth. Each slice of Opera is a journey through layers of indulgence, making it a centerpiece of refined pastry artistry.', 80000, 65000, '1702823763.jpg', 45, 0, 1, '2023-12-17 14:36:03'),
(26, 12, 'Pommes Dauphine', 'pommes-dauphine', 'Delight in the crispy elegance of Pommes Dauphine, a French fancy side dish marrying mashed potatoes and choux pastry, resulting in golden, bite-sized orbs with a creamy interio', 'Pommes Dauphine, a whimsical French creation, transforms the humble potato into a culinary work of art. Mashed potatoes are skillfully combined with choux pastry, creating a light and airy dough. The mixture is then shaped into small rounds and deep-fried to a golden perfection. The result is Pommes Dauphine—crispy on the outside, soft and creamy on the inside. Each bite is a symphony of textures and flavors, making this side dish a delightful addition to any gastronomic affair. Elevate your dining experience with the sophisticated charm of Pommes Dauphine.', 150000, 110000, '1702824085.jpg', 60, 0, 1, '2023-12-17 14:39:54'),
(27, 12, 'Haricots Verts Amandine', 'haricots-verts-amandine', 'Elevate your plate with Haricots Verts Amandine, a sophisticated French fancy side dish featuring tender green beans adorned with buttery almond slivers, creating a harmonious balance of flavors and textures.', 'Haricots Verts Amandine, a refined French side dish, showcases the delicate beauty of slender green beans paired with the rich nuttiness of almonds. The beans are blanched to perfection, maintaining their vibrant color and crispness. Buttered almond slivers are generously sprinkled over the beans, adding a layer of richness and a delightful crunch. This elegant combination creates a symphony of flavors, making Haricots Verts Amandine a sophisticated addition to any dining experience. Immerse yourself in the world of French culinary finesse with this exquisite side dish.', 170000, 170000, '1702824305.jpg', 25, 0, 0, '2023-12-17 14:45:05'),
(28, 13, 'Ratatouille au Fromage', 'ratatouille-au-fromage', 'Savor the indulgent twist with Ratatouille au Fromage, a flavorful dish where layers of zucchini, eggplant, and tomatoes are nestled in a rich cheese blend, creating a mouthwatering symphony of textures and tastes.', 'Ratatouille au Fromage takes the classic French dish to new heights by introducing a luscious layer of melted cheese to the traditional vegetable medley. Thinly sliced zucchini, eggplant, and tomatoes are skillfully arranged and baked to perfection. A decadent blend of cheeses, including mozzarella, Parmesan, and goat cheese, is melted over the vegetables, creating a gooey and flavorful topping. The result is a dish that marries the rustic charm of Ratatouille with the irresistible allure of melted cheese. Each forkful is a journey through layers of savory goodness, making Ratatouille au Fromage a delightful centerpiece for any gourmet occasion.', 240000, 240000, '1702824611.jpg', 60, 0, 1, '2023-12-17 14:50:11'),
(29, 14, 'Fraise Napoléon', 'fraise-napoleon', 'Savor the sweet delicacy of Fraise Napoléon, a refined French dessert featuring crispy layers of puff pastry, light pastry cream, and fresh strawberries.', 'Fraise Napoléon is an elegant sweet creation that captivates lovers of French desserts. This delight consists of thin layers of puff pastry, carefully baked to achieve a crispy texture. Between these layers, a light and creamy pastry cream adds a touch of finesse. The ensemble is crowned with fresh strawberries, bringing a fruity and sweet note to each bite. Fraise Napoléon embodies the art of French pastry with its perfect marriage of textures and flavors. Enjoy this exquisite dessert for an unparalleled culinary experience.', 110000, 87000, '1702824913.jpg', 43, 0, 0, '2023-12-17 14:55:13'),
(30, 13, 'Coq au Vin Blanc', 'coq-au-vin-blanc', 'Elevate your dining experience with Coq au Vin Blanc, a French culinary masterpiece where tender chicken is bathed in a velvety white wine sauce, accompanied by mushrooms and pearl onions.', 'Coq au Vin Blanc is a culinary symphony that brings together the delicate flavors of tender chicken, white wine, and aromatic vegetables. The chicken is braised to perfection, resulting in succulent, fall-off-the-bone meat. The dish is elevated with a velvety white wine sauce that infuses every bite with richness and depth. Mushrooms and pearl onions add a delightful complexity, creating a harmonious ensemble. Coq au Vin Blanc is a celebration of French gastronomy, offering a refined and comforting dining experience. Immerse yourself in the art of French cooking with this exquisite main dish.', 230000, 230000, '1702825561.jpg', 20, 0, 0, '2023-12-17 15:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `adult` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `note` varchar(500) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` int NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_general_ci DEFAULT 'default.jpg',
  `verification_code` varchar(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `verify_status` tinyint DEFAULT '0' COMMENT '0=no, 1=yes',
  `password` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `role_as` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `image`, `verification_code`, `verify_status`, `password`, `role_as`, `created_at`) VALUES
(22, 'Phạm Nguyệt Quỳnh', 'phamnguyetquynh0307@gmail.com', 989598472, 'default.jpg', '394481', 1, '$2y$10$J8tjpZRK.1C7KDU48Knq7OU5R4VkMJRDwWIxavrNJpIwZAZnRRXHq', 1, '2023-12-17 15:25:10'),
(23, 'Nguyen Mai Huu Phuc', 'phucnguyenmaihuuuit@gmail.com', 888135231, 'default.jpg', '621009', 1, '$2y$10$cWYCLPh7q2am96G.96j4cuD2MhCLFiwaPol27utDsqLbAvljAkDF2', 0, '2023-12-25 14:48:49'),
(24, 'Nguyen Mai Huu Phuc', '21522474@gm.uit.edu.vn', 888135231, 'default.jpg', '486162', 0, '$2y$10$KAI7aa4OO72niu4pAV9NiuhqAF716Cmg1o58SmjLeoWQ3waT0bJ.K', 0, '2023-12-25 16:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_qty` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `product_qty`, `created_at`) VALUES
(10, 23, 21, 1, '2023-12-26 10:53:29'),
(11, 23, 23, 1, '2023-12-28 08:43:37'),
(12, 23, 25, 1, '2023-12-28 08:43:39'),
(13, 23, 26, 1, '2023-12-28 09:16:33'),
(14, 23, 29, 1, '2023-12-28 09:16:44');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
