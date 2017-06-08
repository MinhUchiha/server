-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2017 at 02:16 PM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id1623391_gr`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classid` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `classname` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `setember` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classid`, `classname`, `setember`, `teacher`) VALUES
('1002', 'Tiếng Nhật chuyên ngành 2', '20162', 'pvhong'),
('1003', 'Tiếng Nhật chuyên ngành 2', '20162', 'pvhong'),
('1004', 'Tiếng Nhật 2', '20162', 'tdgiap'),
('1005', 'Tiếng Nhật 1', '20162', 'tdgiap'),
('1006', 'ITSS', '20162', 'tdgiap'),
('9902', 'Tiếng Nhật 1', '20171', 'tdgiap'),
('9909', 'Tiếng Nhật 3', '20171', 'tdgiap');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentid` int(11) NOT NULL,
  `postid` int(10) NOT NULL,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentid`, `postid`, `username`, `content`, `timestamp`) VALUES
(13, 9, 'tdgiap', 'Chú ý', '2017-06-06 05:26:42'),
(14, 10, 'tdgiap', 'hihi', '2017-06-06 07:44:45'),
(15, 10, 'tdgiap', 'xin chao', '2017-06-06 07:45:06'),
(16, 10, 'tdgiap', 'xin chao', '2017-06-06 07:45:07'),
(17, 10, 'tdgiap', 'xin chao', '2017-06-06 07:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `classid` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `homeworkid` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`classid`, `content`, `homeworkid`) VALUES
('1002', 'Bài 2 sách giáo khoa trang 23', 3),
('1002', 'Bài 5 sách giáo khoa trang 22', 4),
('1002', 'Xây dựng web bằng ruby on rails', 5),
('9909', 'Bài 5 sách minanonihongo trang 12', 6),
('1004', 'Bài 17 sách giáo khoa trang 90', 9),
('1004', 'Bài 21 sách giáo khoa trang 90', 14),
('1004', 'Bai tu chon\nabc', 15);

-- --------------------------------------------------------

--
-- Table structure for table `learner`
--

CREATE TABLE `learner` (
  `username` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `classid` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `learnerid` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `learner`
--

INSERT INTO `learner` (`username`, `classid`, `learnerid`) VALUES
('chaunn', '9909', 3),
('ltnghia', '9909', 4),
('hvtrung', '1004', 6),
('hvtrung', '1006', 10),
('ltnghia', '1004', 11),
('pthanh', '1004', 13),
('hvtrung', '9909', 14),
('ltnghia', '1002', 15),
('tdduc', '1004', 16);

-- --------------------------------------------------------

--
-- Table structure for table `point`
--

CREATE TABLE `point` (
  `pointid` int(10) NOT NULL,
  `learnerid` int(11) NOT NULL,
  `point` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `point`
--

INSERT INTO `point` (`pointid`, `learnerid`, `point`) VALUES
(4, 3, 6),
(5, 3, 7),
(6, 4, 8.5),
(8, 3, 7),
(9, 3, 7),
(10, 3, 7),
(13, 6, 6),
(18, 11, 9),
(19, 13, 11),
(20, 13, 8),
(21, 13, 8),
(22, 13, 8),
(23, 14, 7.4),
(24, 14, 7.4),
(25, 16, 6.4),
(26, 16, 6.4);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postid` int(10) NOT NULL,
  `classid` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postid`, `classid`, `title`, `username`, `content`, `timestamp`) VALUES
(9, '1004', 'Thông báo thi kết thúc', 'tdgiap', 'Môn học thi kết thúc ngày 27/5', '2017-05-26 20:49:52'),
(10, '1004', 'Hình thức thi kết thúc', 'tdgiap', 'Loại hình thi: trắc nhiêm\r\nthời gian: 90 phút', '2017-05-28 06:25:09'),
(11, '1004', 'Kiem tra 15\'', 'tdgiap', 'On tat ca cac bai', '2017-06-06 07:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE `relationship` (
  `relationshipid` int(10) NOT NULL,
  `parent` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `learner` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`relationshipid`, `parent`, `learner`) VALUES
(4, 'duccm', 'hvtrung');

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `id` int(10) NOT NULL,
  `classid` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `day` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`id`, `classid`, `day`, `time`) VALUES
(1, '1004', '2', '8h30-12h00'),
(2, '1004', '5', '8h30-11h00'),
(3, '1006', '3', '13h00-14h30'),
(4, '1004', '4', '13h00-15h30'),
(5, '9909', '3', '6h45-8h20'),
(6, '1002', '2', '13h-15h30');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` int(1) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `username`, `role`, `password`, `birthday`) VALUES
('Bùi Huy Hào', 'bhhao', 3, '$2y$10$NP1eHWgHJ/rSOfwBOi749.aY/Cb/IMYbonSrF4wX0lqxQCCTLI5aK', '1993-10-24'),
('Nguyễn Ngọc Châu', 'chaunn', 3, '$2y$10$88tvzqmv5KnIOpI28ViJzeQWkIFM4TY8PcCcF6MZ6w4SAskKE4QTi', '1998-12-31'),
('Dư Minh Phương', 'dmphuong', 3, '$2y$10$CTh7Q5WGiJWlRprU1VKiO.kjCKSSxLZ4KzsTgnTtji9AMBYuYY0XC', '1994-10-22'),
('Chu Minh Đức', 'duccm', 4, '$2y$10$5EvS4r0v4ALdhUEq0pA6HOanIhIqp8KfX0vKEgkRp6djcDi/1.BqC', '1970-04-03'),
('Hoàng Văn Trung', 'hvtrung', 3, '$2y$10$tMDkrSGAcnfT96V.8.5tGOpQWUblZDOni1UMrKs7zMph50jSUa5Yi', '1994-05-28'),
('Lưu Trung Nghĩa', 'ltnghia', 3, '$2y$10$4iS05if5wRhFKKJ9zLUQF.E.jRxxSbz0YW74SP/HDDSPjpRjC/vi.', '1994-03-20'),
('Nguyễn Quang Minh', 'nqminh', 1, '$2y$10$e4xyDuuYzMW/Fle97YKM3euFptcWTkhYOX5Dg03suYIjjta.3Ttle', '1995-11-30'),
('Phan Thanh', 'pthanh', 3, '$2y$10$ht5cAGp/QK5Gn5fWW.KalO0fuyXHxnyzqlxW.rM0xeNVH5Hci0MQ.', '1994-08-27'),
('Phạm Văn Hồng', 'pvhong', 2, '$2y$10$FSZKoATgXUZBW3I1dFvtYOGN1a275YbHLArk6ooM5Q8EbF5ZkAtty', '1980-03-20'),
('Trịnh Đình Đức', 'tdduc', 3, '$2y$10$My8rJeSQb3gUQHaQSW234uMAXu75lv34eSfAglHPHtW9k1SLc.FBu', '1994-10-22'),
('Trần Đình Giáp', 'tdgiap', 2, '$2y$10$Tf0gmwzPnOyLQyxhra6jzeKS5i8SrsNfR4CY06ecvCKPXO1KNX.ZK', '1979-02-03'),
('Trịnh Kiên', 'tkien', 4, '$2y$10$nUbhXj8kxd1Qk6vcrXERCegq.ZupfB7ghuoBojMgyYtXHFbsRhlzm', '1980-02-28'),
('Trần Trung Hiếu', 'tthieu', 3, '$2y$10$DxO.gBoaRbC9hBWpOkN.JO3I5aq5N4GCn0ts8CvaDlhubdteRuilq', '1994-05-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classid`),
  ADD KEY `class_ibfk_1` (`teacher`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentid`),
  ADD KEY `comment_ibfk_1` (`postid`),
  ADD KEY `comment_ibfk_2` (`username`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`homeworkid`),
  ADD KEY `homework_ibfk_1` (`classid`);

--
-- Indexes for table `learner`
--
ALTER TABLE `learner`
  ADD PRIMARY KEY (`learnerid`),
  ADD KEY `username` (`username`),
  ADD KEY `calssname` (`classid`);

--
-- Indexes for table `point`
--
ALTER TABLE `point`
  ADD PRIMARY KEY (`pointid`),
  ADD KEY `classid` (`learnerid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `classid` (`classid`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
  ADD PRIMARY KEY (`relationshipid`),
  ADD KEY `relationship_ibfk_1` (`parent`),
  ADD KEY `relationship_ibfk_2` (`learner`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_ibfk_1` (`classid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `homeworkid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `learner`
--
ALTER TABLE `learner`
  MODIFY `learnerid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `point`
--
ALTER TABLE `point`
  MODIFY `pointid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `relationship`
--
ALTER TABLE `relationship`
  MODIFY `relationshipid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `user` (`username`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `post` (`postid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `homework_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class` (`classid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `learner`
--
ALTER TABLE `learner`
  ADD CONSTRAINT `learner_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `learner_ibfk_2` FOREIGN KEY (`classid`) REFERENCES `class` (`classid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `point`
--
ALTER TABLE `point`
  ADD CONSTRAINT `point_ibfk_1` FOREIGN KEY (`learnerid`) REFERENCES `learner` (`learnerid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class` (`classid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `relationship`
--
ALTER TABLE `relationship`
  ADD CONSTRAINT `relationship_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relationship_ibfk_2` FOREIGN KEY (`learner`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `time`
--
ALTER TABLE `time`
  ADD CONSTRAINT `time_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class` (`classid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
