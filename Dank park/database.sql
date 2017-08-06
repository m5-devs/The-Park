
-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 97.74.149.74
-- Generation Time: Jan 21, 2016 at 09:27 PM
-- Server version: 5.5.43
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thepark`
--

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(99) NOT NULL,
  `badge` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `badges`
--


-- --------------------------------------------------------

--
-- Table structure for table `classcodes`
--

CREATE TABLE `classcodes` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `classid` int(99) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classid` (`classid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `classcodes`
--

INSERT INTO `classcodes` VALUES(3, 'abc123', 1);
INSERT INTO `classcodes` VALUES(4, 'VE6n6b', 3);
INSERT INTO `classcodes` VALUES(5, '8bc192', 2);
INSERT INTO `classcodes` VALUES(6, '8ZyHAj', 4);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `teacherid` int(99) NOT NULL,
  `name` varchar(255) NOT NULL,
  `period` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `ab` enum('a','b') DEFAULT NULL,
  `cover` varchar(2047) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teacherid` (`teacherid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` VALUES(1, 2, 'Test Class', '1', NULL, 'https://i.imgur.com/wUDfBEA.png');
INSERT INTO `classes` VALUES(2, 2, 'Test Class 2', '2', 'a', 'https://newevolutiondesigns.com/images/freebies/nature-hd-background-10.jpg');
INSERT INTO `classes` VALUES(3, 2, 'Test Class 3', '3', NULL, 'http://screenlicious.com/wp-content/uploads/2015/03/1004502-sunrise-mountain.jpg');
INSERT INTO `classes` VALUES(4, 2, 'Test Class 4', '4', NULL, 'http://blog.europeandomaincentre.com/wp-content/uploads/2013/02/urban-landscape-series-viii-16840.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `post_id` int(99) NOT NULL,
  `userid` int(99) NOT NULL,
  `comment` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` VALUES(3, 7, 1, 'tetsuidjkfbnl', '2016-01-19 15:02:45');
INSERT INTO `comments` VALUES(4, 7, 2, 'test', '2016-01-19 15:03:26');
INSERT INTO `comments` VALUES(5, 7, 2, 'Test 2', '2016-01-19 15:07:23');
INSERT INTO `comments` VALUES(6, 8, 2, 'Hiiii', '2016-01-19 15:07:56');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `userid` int(99) NOT NULL,
  `message` varchar(2047) NOT NULL,
  `type` enum('feature','bug') NOT NULL DEFAULT 'bug',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` VALUES(22, 1, 'iouyhgfdghjk', 'feature');
INSERT INTO `feedback` VALUES(23, 1, 'Kasimir is a whire', 'bug');
INSERT INTO `feedback` VALUES(24, 1, 'Kasimir is a bitch ass', 'bug');
INSERT INTO `feedback` VALUES(25, 1, 'Sup Kasimir/Alex', 'bug');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_from` int(99) NOT NULL,
  `user_to` int(99) NOT NULL,
  `accepted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_from` (`user_from`),
  KEY `user_to` (`user_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` VALUES(69, 8, 6, '1');
INSERT INTO `friends` VALUES(70, 8, 10, '1');
INSERT INTO `friends` VALUES(98, 4, 2, '1');
INSERT INTO `friends` VALUES(101, 6, 2, '1');
INSERT INTO `friends` VALUES(102, 7, 2, '1');
INSERT INTO `friends` VALUES(103, 8, 2, '1');
INSERT INTO `friends` VALUES(105, 10, 2, '1');
INSERT INTO `friends` VALUES(106, 11, 2, '1');
INSERT INTO `friends` VALUES(108, 9, 6, '1');
INSERT INTO `friends` VALUES(109, 9, 2, '1');
INSERT INTO `friends` VALUES(110, 9, 8, '1');
INSERT INTO `friends` VALUES(111, 9, 10, '1');
INSERT INTO `friends` VALUES(113, 9, 11, '1');
INSERT INTO `friends` VALUES(115, 3, 5, '1');
INSERT INTO `friends` VALUES(116, 3, 11, '1');
INSERT INTO `friends` VALUES(118, 3, 23, '1');
INSERT INTO `friends` VALUES(119, 25, 23, '1');
INSERT INTO `friends` VALUES(120, 3, 9, '1');
INSERT INTO `friends` VALUES(121, 3, 25, '0');
INSERT INTO `friends` VALUES(122, 9, 23, '0');
INSERT INTO `friends` VALUES(123, 9, 23, '0');
INSERT INTO `friends` VALUES(125, 1, 4, '1');
INSERT INTO `friends` VALUES(126, 1, 5, '1');
INSERT INTO `friends` VALUES(127, 1, 11, '1');
INSERT INTO `friends` VALUES(128, 1, 8, '1');
INSERT INTO `friends` VALUES(129, 1, 24, '1');
INSERT INTO `friends` VALUES(131, 1, 6, '1');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `postid` int(99) NOT NULL,
  `userid` int(99) NOT NULL,
  `type` enum('up','down') NOT NULL DEFAULT 'up',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `postid` (`postid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=241 ;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` VALUES(210, 5, 1, 'up');
INSERT INTO `likes` VALUES(217, 4, 1, 'up');
INSERT INTO `likes` VALUES(239, 5, 2, 'up');
INSERT INTO `likes` VALUES(240, 7, 2, 'up');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(4096) COLLATE latin1_general_ci NOT NULL,
  `userid` int(99) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `userid` int(99) NOT NULL,
  `type` enum('post','comment','mention','friend_request','friend_accept','help','like','report','feedback') COLLATE latin1_general_ci NOT NULL,
  `user_from` int(99) NOT NULL,
  `id_from` int(99) DEFAULT NULL,
  `message` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `user_from` (`user_from`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `notifications`
--


-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `userid` int(99) NOT NULL,
  `type` enum('public','private','profile','classroom','help','reshare') NOT NULL DEFAULT 'public',
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` enum('math','science','english','history','foreign language','health','performing arts','visual arts','technology') DEFAULT NULL,
  `profile_to` int(99) DEFAULT NULL,
  `reshare_from` int(99) DEFAULT NULL,
  `private_to` int(99) DEFAULT NULL,
  `classroom_to` int(99) DEFAULT NULL,
  `file` varchar(1023) DEFAULT NULL,
  `ip` int(99) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`,`reshare_from`,`private_to`,`classroom_to`),
  KEY `profile_to` (`profile_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` VALUES(4, 1, 'classroom', 'Hey yo Mr. W!', '2016-01-19 08:57:34', NULL, NULL, NULL, NULL, 1, NULL, -1743072984);
INSERT INTO `posts` VALUES(5, 1, 'classroom', 'test like system', '2016-01-19 09:13:57', NULL, NULL, NULL, NULL, 1, NULL, -1743072984);
INSERT INTO `posts` VALUES(7, 1, 'profile', 'test post', '2016-01-19 15:02:27', NULL, 1, NULL, NULL, NULL, NULL, -1401141199);
INSERT INTO `posts` VALUES(8, 1, 'profile', 'test post 2', '2016-01-19 15:07:42', NULL, 1, NULL, NULL, NULL, NULL, -1401141199);
INSERT INTO `posts` VALUES(9, 3, 'help', 'HELLO, WORLD!', '2016-01-21 21:13:00', '', NULL, NULL, NULL, NULL, NULL, 393659401);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `studentid` int(99) NOT NULL,
  `classid` int(99) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `classroomid` (`classid`),
  KEY `studentid` (`studentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` VALUES(18, 1, 1, '2016-01-19 08:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `testchoices`
--

CREATE TABLE `testchoices` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `questionid` int(99) NOT NULL,
  `value` varchar(2047) NOT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `questionid` (`questionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This table contains answer choices for test questions' AUTO_INCREMENT=19 ;

--
-- Dumping data for table `testchoices`
--

INSERT INTO `testchoices` VALUES(14, 1, 'May 11, 2000', 0);
INSERT INTO `testchoices` VALUES(15, 1, 'July 4, 1776', 1);
INSERT INTO `testchoices` VALUES(16, 1, 'April 30, 1782', 0);
INSERT INTO `testchoices` VALUES(17, 1, 'January 19, 1865', 0);
INSERT INTO `testchoices` VALUES(18, 1, 'May 23, 1965', 0);

-- --------------------------------------------------------

--
-- Table structure for table `testquestions`
--

CREATE TABLE `testquestions` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `testid` int(99) NOT NULL,
  `question` varchar(2047) NOT NULL,
  `type` enum('mc','sa','tf') NOT NULL DEFAULT 'mc' COMMENT 'mc=multiple choice, sa=short answer, tf=true/false',
  `points` int(99) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `testid` (`testid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `testquestions`
--

INSERT INTO `testquestions` VALUES(1, 1, 'When was the US founded?', 'mc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `classid` int(99) NOT NULL,
  `teacherid` int(99) NOT NULL,
  `name` varchar(2047) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classid` (`classid`),
  KEY `teacherid` (`teacherid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` VALUES(1, 1, 2, 'Unit 1 Quiz');

-- --------------------------------------------------------

--
-- Table structure for table `testscores`
--

CREATE TABLE `testscores` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `testid` int(99) NOT NULL,
  `studentid` int(99) NOT NULL,
  `score` varchar(244) NOT NULL,
  `teacherid` int(99) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `testscores`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `signup_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `privilege` enum('0','1','2','3','4') NOT NULL DEFAULT '0' COMMENT '0=Not activated, 1=Normal user, 2=Teacher, 3=Beta tester, 4=Admin',
  `bio` text NOT NULL,
  `avatar` varchar(2047) NOT NULL DEFAULT 'http://goo.gl/18nZh0',
  `cover` varchar(2047) NOT NULL,
  `gender` enum('m','f') NOT NULL DEFAULT 'm',
  `filter` enum('0','1') NOT NULL DEFAULT '1',
  `color` enum('red','deeporange','orange','amber','lightgreen','green','teal','cyan','blue','lightblue','indigo','deeppurple','purple','pink','brown','grey') NOT NULL DEFAULT 'teal',
  `theme` enum('light','dark') NOT NULL DEFAULT 'light',
  `points` int(99) NOT NULL DEFAULT '0',
  `ip` int(99) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'kasimir', 'Kasimir', 'Schulz', 'kasimirkhschulz@gmail.com', '$6$rounds=5000$88703909562971b7$BWFPYJarp8G6qzre.c5n/xVStCmnDP5.pJc023wcj6EHRwsj.qtTuE./7Md98d9/pvGKKmPeLlpB7Uz1JPz0H.', '88703909562971b7ad52f1.59225358', '2015-01-01 00:00:00', '4', 'Creator of the Park', 'https://lh3.googleusercontent.com/-Z8a_q0RNPu8/Vpppqbdw8HI/AAAAAAAABhQ/6IztzYE6yNM/s512/cool-wallpapers26.jpg', 'http://www.gandex.ru/upl/oboi/gandex.ru-11307_41b8059e78a24c3fb869984cd84f9b83.jpg', 'm', '1', 'lightblue', 'light', 100, -1743072998);
INSERT INTO `users` VALUES(2, 'alex', 'Alex', 'Wohlbruck', 'alexwohlbruck@gmail.com', '$6$rounds=5000$20816591055627b3$CNp808tF4uETIaZvaWl5HKyp5p1vT80jOpjBqpMvRA2.0.T1a3sDw7Bj.WY73wFGUWhJoIAS/RodyssNG1orG0', '20816591055627b3711ef025.20671122', '2015-01-01 00:00:00', '2', 'Your supreme ruler', 'https://i.imgur.com/XtGnc70.png', 'https://i.imgur.com/wUDfBEA.png', 'm', '1', 'lightblue', 'light', 96732584, 1166311055);
INSERT INTO `users` VALUES(3, 'elle', 'Elle', 'Boyle', 'elle.boyle@gmail.com', '$6$rounds=5000$236524172569d717$G4dpUfNvAwY2BovwKXb4qGXeL/0gdlfFgQnDZEnD9w/NzDMsnIls8RCUPBkMGN/nyzJ8nnQRAK.N8piXYcCB80', '236524172569d7179a43267.98996110', '2015-11-01 00:00:00', '3', 'Creative Idiot for the Park.', 'http://i.imgur.com/R6rudGL.png', 'https://33.media.tumblr.com/tumblr_m81w50stpL1rbaxuco1_400.gif', 'f', '0', 'indigo', 'light', 30, 1166311055);
INSERT INTO `users` VALUES(4, 'dwohlbruck', 'Dan', 'Wohlbruck', 'dwohlbruck@yahoo.com', '$6$rounds=5000$20964241075601a7$ftgtpkAbizqqpmmq8Xn0Q.JyxKQ5UmQrVJvygo5PX6Qu9iYj90gxvWnRs3qg9DakmAv4Kv9HDZuvCGlleZ.EV/', '20964241075601a73e5ffe67.28025060', '2015-11-01 00:00:00', '3', 'Tech geek and biking enthusiast. Also enjoy sailing, tennis and long walks in the park.', 'http://goo.gl/18nZh0', 'http://i.imgur.com/QkeMYx0.jpg', 'm', '1', 'green', 'dark', 0, 0);
INSERT INTO `users` VALUES(5, 'bear_fishing', 'Jayne', 'Blottman', 'jnblottman@gmail.com', '$6$rounds=5000$104106221956060c$JOQKnQCzJcoSuKMxo5J0119ZODMQk6VHfe/5DcSNX19aR8095f47jEAms0V9Ea1ym748dDNGiSk07mkbuUWka0', '104106221956060c568fb6b0.21690273', '2015-11-01 00:00:00', '3', 'bio now', 'http://d3lp4xedbqa8a5.cloudfront.net/s3/digital-cougar-assets/Cosmo/2014/08/07/40987/kanye-west-laughing.gif', 'http://i.huffpost.com/gen/1641870/images/o-WHITE-HOUSE-facebook.jpg', 'f', '1', 'teal', 'light', 1, 0);
INSERT INTO `users` VALUES(6, 'thepowerwithinx', 'Jacob', 'Mata', 'Jacob4818@gmail.com', '$6$rounds=5000$5911076275613fbc$buVpCeGGetxCfBIRuAuxWDAoOXs2dlAJLXP3SJxnIdf68A6FKTb9uGUuFPsTyc6vQ7s1ypqt1Yhsv08zXRzvr/', '5911076275613fbc193db70.48485245', '2015-11-01 00:00:00', '3', 'Ayyyyyy lmao', 'http://i.imgur.com/C7zF1Q1.png', 'https://goo.gl/7v4D5L', 'm', '0', 'amber', 'dark', 0, 0);
INSERT INTO `users` VALUES(7, 'khschulz', 'Karl', 'Schulz', 'karlheinz@khschulz.com', '$6$rounds=5000$213164152356140e$qRXGwyGE1oulc9q15S0o5TjREl/iWSXDk8BHl4m/RscLoEUJLMONiZwrAdO1WomYh9i3p096fXEhuaAj7ctI6.', '213164152356140e1ab15a22.03665684', '2015-11-01 00:00:00', '3', '', 'http://goo.gl/yaJOvK', 'https://goo.gl/n02BMT', 'm', '1', 'teal', 'light', 0, 0);
INSERT INTO `users` VALUES(8, 'benritchie30', 'Ben', 'Ritchie', 'benritchie30@gmail.com', '$6$rounds=5000$4844942956155965$ACPfs1FH5UU/py2jtSXTW5BLkHg/pyE6H1kK53cn64R0Px3.1CYy4QDrR1tQavQ3LXFfjxNqrP5zxUjkbtNAU.', '48449429561559659afbb5.94561062', '2015-11-01 00:00:00', '3', '', 'http://goo.gl/yaJOvK', 'https://goo.gl/aINp0a', 'm', '1', 'lightblue', 'light', 0, 0);
INSERT INTO `users` VALUES(9, 'lukelaw331', 'Luke', 'Lawrence', 'lukedlawrence@gmail.com', '$6$rounds=5000$503606657561594a$s.mq0FCr9ejHDHDBESxy9k5hMe4IST9df3dZzrejO0Rf5HznllLwcFvvawxzVr7oWMX0jbuwp.3T13LYmhXk8/', '503606657561594a22bc897.05534993', '2015-11-01 00:00:00', '3', '', 'http://media-cache-ec0.pinimg.com/736x/b4/7a/53/b47a538b102e231bc8cfbbb58dd51aab.jpg', 'http://picpuddle.com/wp-content/uploads/2014/06/Cool-Emo-Boys-Hairstyles.jpg', 'm', '0', 'green', 'dark', 0, 0);
INSERT INTO `users` VALUES(10, 'willritchie14', 'Will', 'Ritchie', 'willritchie14@gmail.com', '$6$rounds=5000$1395232574561c27$i4aC3mhMYlAnea0Vvrro2fQKV4UI.3qnTqkF2Yl1hhg7w9zYsQod4ZrktFZoUt56Xigne3BFKBhhIZysX./Rc1', '1395232574561c27bb882247.07821698', '2015-11-01 00:00:00', '3', 'MPHS Student.  Kasimir rocks.', 'https://lh3.ggpht.com/3_YUBGwujgWLwfkmCPn_EW5DdMz0x4dno9XuiVZz4ldRomB8M4wM1V4XIPzPn6w41fnk=w300', 'https://goo.gl/CyXCLf', 'm', '1', 'teal', 'light', 0, 0);
INSERT INTO `users` VALUES(11, 'adam', 'Adam', 'Lipshay', 'amlipshay@gmail.com', '$6$rounds=5000$716391411569d63f$BKsciquNFotfonnx8t9Fxp5Cpu1cFoZEGWR9vmdElgWyJ2B9aGhruS4fhAMchCUyBqcJWKec.5f4wDVwjCN2Z.', '716391411569d63f5186ee3.65408406', '2015-11-01 00:00:00', '3', '', 'https://scontent-atl3-1.xx.fbcdn.net/hphotos-xat1/v/t1.0-9/12072811_1506888292965511_8883186191107134046_n.jpg?oh=14e9d43aea9992267cb5d75e6b94d2e9&oe=570C7F32', 'https://scontent-atl3-1.xx.fbcdn.net/hphotos-xta1/v/t1.0-9/12043196_1506888462965494_7398724035474433244_n.jpg?oh=2221b988ba37db0f918a2591772e6398&oe=56FBA093', 'm', '1', 'green', 'light', 0, 0);
INSERT INTO `users` VALUES(13, 'parkit', 'Robin', 'Williams', 'robinc.williams@cms.k12.nc.us', '$6$rounds=5000$14151234385645e7$u2QDKfGRyH3IMLXxAw3N08aeyOl4409n06MEuymtCLI92sVC.QHnyofiQqOx5uHMhFX7mwIOdF9ofuZPMUuxR1', '14151234385645e7f96e7244.96214506', '2015-11-13 06:39:05', '2', '', 'http://goo.gl/18nZh0', 'http://i.imgur.com/S7HKnnR.jpg', 'f', '1', 'teal', 'light', 0, 0);
INSERT INTO `users` VALUES(23, 'jard', 'Jared', 'Wagler', 'jared.wagler@gmail.com', '$6$rounds=5000$9450979485653135$SRCXEu5S8.b20oN9NtmO.KezcK58MIPTIND3MSDV1B7ZXVEiNMuelM5sMdKbXoBLX/tKwkAUMzAxAG2CqKBos0', '9450979485653135520fe24.19322782', '2015-11-23 06:23:33', '3', '', 'http://i.imgur.com/VEgcGPel.jpg', 'http://i.imgur.com/iMGiuYSh.jpg', 'm', '0', 'red', 'light', 0, 0);
INSERT INTO `users` VALUES(24, 'brandonpieroni', 'Brandon', 'Pieroni', 'brandonpieroni@gmail.com', '$6$rounds=5000$892954128565dba1$xkYWWZfJDjEEmWbGpFJzDc1pi4u.S/InUUfkeVS6tXPujfgN4lzFvk5KaT6ni7vBnAQ6jQP3AoxgrX3oQnjuZ1', '892954128565dba160c93e3.92832887', '2015-12-01 08:17:42', '1', '', 'https://pbs.twimg.com/profile_images/559870134509387776/eDNpfsaz.jpeg', 'https://s-media-cache-ak0.pinimg.com/236x/7e/4c/0b/7e4c0b6b9ffb9eda97e028a7a86e0603.jpg', 'm', '1', 'teal', 'light', 0, 0);
INSERT INTO `users` VALUES(25, 'ericn', 'Eric', 'N', 'ecnjnr@yahoo.com', '$6$rounds=5000$189071577356746a$JDUtLI7ZjUhvwFdleKO7siZoS7ATw4wPUq7q6siDqX3To/wP.F9FxPcPOMqRZFIZ7sKQGaxh9KR9URDYWDMZ71', '189071577356746a6312fc65.01348909', '2015-12-18 13:19:47', '3', '', 'http://ecx.images-amazon.com/images/I/91dHRGIV65L._SL1500_.jpg', 'http://i.imgur.com/tCQjH64.png', 'm', '1', 'cyan', 'dark', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `id` int(99) NOT NULL,
  `code` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` VALUES(13, 'd55bed729fc482202eb9acb009cfeebf');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `badges`
--
ALTER TABLE `badges`
  ADD CONSTRAINT `badges_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classcodes`
--
ALTER TABLE `classcodes`
  ADD CONSTRAINT `classcodes_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacherid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_3` FOREIGN KEY (`user_from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_ibfk_4` FOREIGN KEY (`user_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_from`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`classid`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testchoices`
--
ALTER TABLE `testchoices`
  ADD CONSTRAINT `testchoices_ibfk_1` FOREIGN KEY (`questionid`) REFERENCES `testquestions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testquestions`
--
ALTER TABLE `testquestions`
  ADD CONSTRAINT `testquestions_ibfk_1` FOREIGN KEY (`testid`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `classes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tests_ibfk_2` FOREIGN KEY (`teacherid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `verify`
--
ALTER TABLE `verify`
  ADD CONSTRAINT `verify_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
