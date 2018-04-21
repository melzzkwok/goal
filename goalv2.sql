-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2018 at 08:01 AM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goal`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_list`
--

CREATE TABLE `activity_list` (
  `activity_id` int(11) NOT NULL,
  `activity_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activity_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activity_list`
--

INSERT INTO `activity_list` (`activity_id`, `activity_name`, `activity_img`, `cat_id`) VALUES
(1, 'Walking', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/walking.jpg', 1),
(2, 'Running', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/running.jpg', 1),
(3, 'Swimming', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/swimming.jpg', 1),
(4, 'Yoga', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/yoga.jpg', 1),
(5, 'Pilates', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/pilates.jpg', 1),
(6, 'Strength Training', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/strengthtraining.jpg', 1),
(7, 'Weight loss', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/weightloss.jpg', 2),
(9, 'Eating healthier', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/eatinghealthier.jpg', 2),
(10, 'Reduce smoking', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/nosmoking.jpg', 3),
(11, 'Reduce painkiller', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/reducepainkiller.jpg', 3),
(12, 'Having timely meals', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/havingtimelymeal.jpg', 3),
(13, 'Sleep hours', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/sleephours.jpg', 4),
(14, 'Sleep early', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/sleepearly.jpg', 4),
(15, 'Me time', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/meditate.jpg', 4),
(16, 'Travel', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/travel.jpg', 4),
(17, 'Others', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/others.jpg', 5),
(18, 'Flexibility and Stretching', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/flexstretch.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`cat_id`, `cat_name`, `cat_img`) VALUES
(1, 'Exercise', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/exercise.jpg'),
(2, 'Diet', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/diet.jpg'),
(3, 'Habits', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/habits.jpg'),
(4, 'Lifestyle', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/lifestyle.jpg'),
(5, 'Others', 'https://raw.githubusercontent.com/melzzkwok/goal/master/public/image/others.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dummy`
--

CREATE TABLE `dummy` (
  `dummy_id` int(11) NOT NULL,
  `dummy_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dummy_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dummy`
--

INSERT INTO `dummy` (`dummy_id`, `dummy_name`, `dummy_value`) VALUES
(1, 'test1', 'blah'),
(2, 'egg', 'lala'),
(3, 'haha', 'lol'),
(4, 'haha', 'melvin'),
(5, 'lolvv', 'hahar'),
(6, 'james', 'vap'),
(7, 'jkjk', 'qwet'),
(8, 'test update', 'test update');

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

CREATE TABLE `goal` (
  `goal_id` int(11) NOT NULL,
  `goal_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `goal_unit` float DEFAULT NULL,
  `goal_current_unit` float DEFAULT NULL,
  `goal_unitType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `goal_frequency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `goal_priority` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `goal_startdate` date DEFAULT NULL,
  `goal_enddate` date DEFAULT NULL,
  `goal_reminder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `goal_complete_pts` int(11) DEFAULT NULL,
  `goal_complete` tinyint(1) NOT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `goal`
--

INSERT INTO `goal` (`goal_id`, `goal_description`, `goal_unit`, `goal_current_unit`, `goal_unitType`, `goal_frequency`, `goal_priority`, `goal_startdate`, `goal_enddate`, `goal_reminder`, `goal_complete_pts`, `goal_complete`, `activity_id`, `cat_id`, `user_id`) VALUES
(9, '112', 112, 12, '12', '12', 'Medium', '2008-11-11', '2008-11-11', '12', 12, 0, 3, 1, 2),
(49, 'swimming test', 7, 7, 'times', 'each week', 'normal', '2018-02-17', '2018-10-30', 'every day', 1, 1, 3, 1, 1),
(50, 'test new update_001', 1, 1, 'kilograms', 'each day', 'low', '2018-01-15', '2018-05-23', 'every day', 1, 1, 3, 1, 1),
(51, 'rrrr', 14, 14, 'kilograms', 'each day', 'high', '2018-02-19', '2018-08-27', 'every day', 1, 1, 1, 1, 1),
(52, 'test2', 1, 1, 'times', 'each week', 'High', '2008-11-11', '2008-11-11', 'every week', 1, 1, 1, 1, 1),
(53, 'sleep early', 1, 1, 'calories', 'each day', 'high', '2018-02-18', '2019-01-01', 'every day', 1, 1, 14, 4, 1),
(57, 'stretch my back', 2, 1, 'times', 'each day', 'high', '2018-02-01', '2018-02-21', 'every day', 0, 0, 18, 1, 1),
(58, 'go to swimming complex', 2, 1, 'times', 'each week', 'low', '2018-02-01', '2018-02-24', 'every month', 0, 0, 3, 1, 1),
(59, 'do some yoga', 2, 0, 'times', 'each month', 'normal', '2018-02-01', '2018-02-24', 'every day', 1, 0, 4, 1, 1),
(60, 'loss some fats', 5, 1, 'kilograms', 'each month', 'normal', '2018-02-01', '2018-02-23', 'every day', 0, 0, 7, 2, 1),
(67, 'walk', 12, 12, 'times', 'each day', 'high', '2018-02-19', '2018-02-19', 'every day', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `goal_reward`
--

CREATE TABLE `goal_reward` (
  `reward_id` int(11) NOT NULL,
  `reward_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reward_description` text COLLATE utf8_unicode_ci,
  `reward_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reward_unlock_pts` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `goal_reward`
--

INSERT INTO `goal_reward` (`reward_id`, `reward_name`, `reward_description`, `reward_img`, `reward_unlock_pts`) VALUES
(1, 'Reward 1', 'FUN FACT: Walking is a low impact activity that\'s a great option if you have the physical capability.', 'https://raw.githubusercontent.com/melzzkwok/goal/my-edit/public/image/reward-sample.jpg', 0),
(2, 'Reward 2', 'FUN FACT: Swimming or doing water exercises can help unwind muscles, while the buoyancy of the water can help those with musculoskeletal or joint pain.', 'https://raw.githubusercontent.com/melzzkwok/goal/my-edit/public/image/reward-sample.jpg', 2),
(3, 'Reward 3', 'FUN FACT: The breathing component of yoga might be just as helpful to ease the chronic pain as the movement and stretching.', 'https://raw.githubusercontent.com/melzzkwok/goal/my-edit/public/image/reward-sample.jpg', 5),
(4, 'Reward 4', 'FUN FACT: Pilates helps with core strength building, stability, posture and balance.', 'https://raw.githubusercontent.com/melzzkwok/goal/my-edit/public/image/reward-sample.jpg', 8),
(5, 'Reward 5', 'FUN FACT: Muscle strengthening exercises and resistance training can help you control chronic pain by increasing the strength of muscles around the joints, which elevate the stress off the joint when in use.', 'https://raw.githubusercontent.com/melzzkwok/goal/my-edit/public/image/reward-sample.jpg', 12),
(6, 'Reward 6', 'Reward description', 'https://raw.githubusercontent.com/melzzkwok/goal/my-edit/public/image/reward-sample.jpg', 16),
(7, 'Reward 7', 'Reward description', 'https://raw.githubusercontent.com/melzzkwok/goal/my-edit/public/image/reward-sample.jpg', 20),
(8, 'Reward 8', 'Reward description', 'https://raw.githubusercontent.com/melzzkwok/goal/my-edit/public/image/reward-sample.jpg', 55),
(9, 'Reward 9', 'Reward description', 'https://raw.githubusercontent.com/melzzkwok/goal/my-edit/public/image/reward-sample.jpg', 85),
(10, 'Reward 10', 'Reward description', 'https://raw.githubusercontent.com/melzzkwok/goal/my-edit/public/image/reward-sample.jpg', 100),
(11, 'Reward 11', 'Reward description', 'https://raw.githubusercontent.com/melzzkwok/goal/my-edit/public/image/reward-sample.jpg', 100),
(12, 'Reward 12', 'Reward description', 'https://raw.githubusercontent.com/melzzkwok/goal/my-edit/public/image/reward-sample.jpg', 100);

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `progress_id` int(11) NOT NULL,
  `progress_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `progress_unit` float NOT NULL,
  `goal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`progress_id`, `progress_date`, `progress_unit`, `goal_id`) VALUES
(102, '2018-03-17 10:58:35', 0, 50),
(103, '2018-03-17 10:58:35', 0, 52),
(104, '2018-03-17 10:58:35', 0, 53),
(116, '2018-03-15 14:25:08', 0, 57),
(117, '2018-03-15 14:25:08', 0, 58),
(118, '2018-03-15 14:25:08', 0, 59),
(119, '2018-03-15 14:25:08', 0, 60),
(121, '2018-03-16 14:25:09', 1, 57),
(122, '2018-03-16 14:25:09', 1, 58),
(123, '2018-03-16 14:25:09', 0, 59),
(124, '2018-03-16 14:25:09', 1, 60),
(126, '2018-03-17 14:25:11', 1, 57),
(127, '2018-03-17 14:25:11', 1, 58),
(128, '2018-03-17 14:25:11', 2, 59),
(129, '2018-03-17 14:25:11', 2, 60),
(131, '2018-03-18 14:25:13', 1, 57),
(132, '2018-03-18 14:25:13', 1, 58),
(133, '2018-03-18 14:25:13', 1, 59),
(134, '2018-03-18 14:25:13', 1, 60),
(141, '2018-03-19 20:02:28', 1, 57),
(142, '2018-03-19 20:02:28', 1, 58),
(143, '2018-03-19 20:02:28', 0, 59),
(144, '2018-03-19 20:02:28', 1, 60),
(146, '2018-03-20 05:56:00', 1, 57),
(147, '2018-03-20 05:56:00', 1, 58),
(148, '2018-03-20 05:56:00', 0, 59),
(149, '2018-03-20 05:56:00', 1, 60),
(151, '2018-03-21 10:00:21', 1, 57),
(152, '2018-03-21 10:00:21', 1, 58),
(153, '2018-03-21 10:00:21', 0, 59),
(154, '2018-03-21 10:00:21', 1, 60),
(156, '2018-03-25 15:10:00', 1, 57),
(157, '2018-03-25 15:10:00', 1, 58),
(158, '2018-03-25 15:10:00', 0, 59),
(159, '2018-03-25 15:10:00', 1, 60);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rewardpoint_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `rewardpoint_total`) VALUES
(1, '123', '123', 49),
(2, 'test', 'test', 0),
(3, '11', '11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_reward`
--

CREATE TABLE `user_reward` (
  `userReward_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_reward`
--

INSERT INTO `user_reward` (`userReward_id`, `user_id`, `reward_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 3),
(4, 1, 2),
(5, 1, 4),
(6, 1, 5),
(7, 1, 6),
(8, 1, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_list`
--
ALTER TABLE `activity_list`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `dummy`
--
ALTER TABLE `dummy`
  ADD PRIMARY KEY (`dummy_id`);

--
-- Indexes for table `goal`
--
ALTER TABLE `goal`
  ADD PRIMARY KEY (`goal_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `goal_ibfk_2` (`activity_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `goal_reward`
--
ALTER TABLE `goal_reward`
  ADD PRIMARY KEY (`reward_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`progress_id`),
  ADD KEY `goal_id` (`goal_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `user_reward`
--
ALTER TABLE `user_reward`
  ADD PRIMARY KEY (`userReward_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reward_id` (`reward_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_list`
--
ALTER TABLE `activity_list`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dummy`
--
ALTER TABLE `dummy`
  MODIFY `dummy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `goal`
--
ALTER TABLE `goal`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `goal_reward`
--
ALTER TABLE `goal_reward`
  MODIFY `reward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_reward`
--
ALTER TABLE `user_reward`
  MODIFY `userReward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_list`
--
ALTER TABLE `activity_list`
  ADD CONSTRAINT `activity_list_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category_list` (`cat_id`);

--
-- Constraints for table `goal`
--
ALTER TABLE `goal`
  ADD CONSTRAINT `goal_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `goal_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `activity_list` (`activity_id`),
  ADD CONSTRAINT `goal_ibfk_3` FOREIGN KEY (`cat_id`) REFERENCES `category_list` (`cat_id`);

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`goal_id`) REFERENCES `goal` (`goal_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_reward`
--
ALTER TABLE `user_reward`
  ADD CONSTRAINT `user_reward_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `user_reward_ibfk_2` FOREIGN KEY (`reward_id`) REFERENCES `goal_reward` (`reward_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
