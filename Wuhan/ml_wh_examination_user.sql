-- phpMyAdmin SQL Dump
-- http://www.phpmyadmin.net
--
-- 生成日期: 2018 年 01 月 14 日 19:18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `oApQuepvDTerncorSajz`
--

-- --------------------------------------------------------

--
-- 表的结构 `ml_wh_examination_user`
--

CREATE TABLE IF NOT EXISTS `ml_wh_examination_user` (
  `year` year(4) NOT NULL,
  `exam_name` enum('Mid-term','Final') NOT NULL,
  `semester` enum('Fall','Spring') NOT NULL,
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `studentNumber` int(11) NOT NULL,
  `courseList` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `cid` (`cid`),
  KEY `cid_2` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=411 ;

--
-- 转存表中的数据 `ml_wh_examination_user`
--

INSERT INTO `ml_wh_examination_user` (`year`, `exam_name`, `semester`, `cid`, `studentNumber`, `courseList`, `time`) VALUES
(2017, 'Mid-term', 'Fall', 13, 18020057, '317,319', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 14, 18020054, '622,666,704,742,780,822', '2018-01-09 10:11:00'),
(2017, 'Mid-term', 'Fall', 21, 18020554, '', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 22, 18020055, '327,369,392,520,545', '2017-11-05 12:17:23'),
(2018, 'Final', 'Spring', 25, 18028004, '627,666,746,780,822,867', '2018-01-11 07:10:51'),
(2017, 'Mid-term', 'Fall', 26, 18020056, '329,364,517,553', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 27, 18029027, '618,656,704,750,776,893', '2018-01-14 11:00:53'),
(2017, 'Mid-term', 'Fall', 28, 18020856, '329,364,517,553', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 29, 18021089, '338,369,417,519,545', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 30, 18029008, '338,369,479,520,545', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 31, 18021241, '331,375,391,521,549', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 32, 19020115, '312,413,465,497,503,532', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 33, 18021099, '551', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 34, 18020132, '324,368,391,522,559', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 35, 18021217, '325,375,391,436,549', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 36, 18020074, '321,375,391,549', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 37, 18020103, '323,366,393,559', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 38, 18021184, '623,666,744,780', '2018-01-14 11:09:38'),
(2018, 'Final', 'Spring', 39, 18029011, '616,666,744,780,889', '2018-01-10 23:34:05'),
(2017, 'Mid-term', 'Fall', 40, 18029031, '334,388', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 41, 18028001, '337,371,392,511,547', '2017-11-05 11:59:33'),
(2018, 'Final', 'Spring', 42, 18020131, '625,662,701,784', '2018-01-09 15:20:39'),
(2017, 'Mid-term', 'Fall', 43, 18020130, '337,364,553', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 44, 18020101, '335,375,391,524,549', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 45, 18021066, '626,668,751,773,893', '2018-01-14 10:27:43'),
(2017, 'Mid-term', 'Fall', 46, 18029041, '326,390,519', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 47, 18020027, '338,373,388,555,577', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 48, 18021227, '622,666,742,780,848,888', '2018-01-14 08:10:05'),
(2018, 'Final', 'Spring', 50, 18020113, '626,666,741,780', '2018-01-09 23:38:54'),
(2017, 'Mid-term', 'Fall', 52, 18021136, '520', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 53, 18021133, '618,666,750,780,848,889', '2018-01-13 12:50:41'),
(2017, 'Mid-term', 'Fall', 54, 17021247, '338,378,436,553', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 55, 18021041, '326,366,393,524,557', '2017-11-06 23:29:25'),
(2018, 'Final', 'Spring', 56, 18021031, '625,662,779,867,894', '2018-01-09 10:56:23'),
(2017, 'Mid-term', 'Fall', 57, 18021085, '325,375,391,526,549', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 58, 18021122, '338,364,524,553', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 59, 18021102, '336,377,417,519,551', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 60, 18021032, '323,375,389,549,576', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 61, 18021197, '327,369,519,545,576', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 62, 18029028, '327,379,478,519,559', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 63, 18020078, '325,377,389,551,575', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 64, 18020019, '625,668,745,773,892', '2018-01-13 03:49:12'),
(2018, 'Final', 'Spring', 65, 18021090, '630,670,786,894', '2018-01-09 10:28:20'),
(2018, 'Final', 'Spring', 66, 18020084, '628,656,743,776,868', '2018-01-11 05:59:45'),
(2017, 'Mid-term', 'Fall', 67, 18028038, '573', '2017-11-08 05:47:15'),
(2017, 'Mid-term', 'Fall', 68, 18020110, '', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 69, 18021140, '334,379,392,559', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 70, 18021204, '624,670,741,786,868,892', '2018-01-14 11:07:57'),
(2017, 'Mid-term', 'Fall', 71, 18021195, '328,369,418,498,526,545', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 72, 15049008, '388', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 73, 18021530, '327,365,391,524,547', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 74, 18020138, '572', '2017-11-05 11:33:30'),
(2017, 'Mid-term', 'Fall', 75, 18020191, '332,366,414,496,524,557', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 76, 18021142, '324,366,417,526,557', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 77, 18020075, '614,662,703,749,779,867', '2018-01-14 11:08:12'),
(2017, 'Mid-term', 'Fall', 78, 18029021, '321,366,437,526,557', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 79, 18021063, '321,366,391,557', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 80, 18021082, '322,378,524,553', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 81, 18021077, '326,375,393,521,549', '2017-11-05 11:30:31'),
(2017, 'Mid-term', 'Fall', 82, 18021228, '332,368,523,559', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 83, 18021040, '625,670,686,722,786', '2018-01-14 10:39:23'),
(2017, 'Mid-term', 'Fall', 84, 18038008, '', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 85, 18020126, '624,658,750,772,867', '2018-01-14 11:01:21'),
(2017, 'Mid-term', 'Fall', 86, 18021179, '323,369,525,545', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 87, 18028008, '', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 88, 18020159, '324,371,390,547', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 89, 18021020, '338,369,393,525,545', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 90, 18021106, '525', '2017-11-05 12:25:50'),
(2018, 'Final', 'Spring', 92, 18020104, '615,664,749,785,890', '2018-01-12 03:13:36'),
(2017, 'Mid-term', 'Fall', 93, 17025001, '561', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 94, 18020025, '325,377,479,524,551,575', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 95, 19020193, '571,593', '2017-11-04 11:34:20'),
(2018, 'Final', 'Spring', 96, 18021001, '622,662,704,723,779,894', '2018-01-12 00:25:23'),
(2017, 'Mid-term', 'Fall', 97, 18021219, '337,377,478,551', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 98, 18020038, '378,393,525,553', '2017-11-05 11:33:17'),
(2017, 'Mid-term', 'Fall', 99, 18021226, '324,364,553', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 100, 18028034, '321,479', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 101, 18021199, '335,375,388,438,549', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 102, 18020123, '333,375,478,524,549', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 103, 18020092, '333,375,523,549', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 104, 18021208, '332,378,479,521,553', '2017-11-05 11:33:58'),
(2017, 'Mid-term', 'Fall', 105, 18021137, '338,373,393,479,518,555', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 106, 18021120, '323,375,436,549', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 107, 18028005, '', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 108, 18021153, '366', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 109, 18029004, '616,664,702,749,771', '2018-01-10 11:37:05'),
(2018, 'Final', 'Spring', 110, 18021123, '619,666,703,745,780,869', '2018-01-11 02:26:44'),
(2017, 'Mid-term', 'Fall', 111, 18020102, '324,373,523,549', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 112, 18020099, '', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 113, 18020135, '622,656,745,776,869', '2018-01-14 11:02:17'),
(2017, 'Mid-term', 'Fall', 114, 18021061, '324,369,393,479,521,545', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 115, 18020013, '555', '2017-11-09 02:39:10'),
(2017, 'Mid-term', 'Fall', 116, 18020098, '327,369,389,417,545', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 117, 19021192, '685,698,733,759,850,871', '2018-01-09 11:01:38'),
(2018, 'Final', 'Spring', 118, 18021529, '622,656,746,776,888', '2018-01-14 11:03:19'),
(2017, 'Mid-term', 'Fall', 119, 18021056, '336,373,390,522,555', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 120, 18021183, '333,366,438,523,557', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 121, 18028014, '', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 122, 18021068, '332,379,388,438,559', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 123, 18029010, '322,364,553', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 124, 18020083, '329,366,436,459,518,557', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 125, 17020145, '329,388,438', '2017-11-05 11:22:47'),
(2017, 'Mid-term', 'Fall', 126, 18021171, '324,375,417,521,549,570', '2017-11-05 11:20:03'),
(2017, 'Mid-term', 'Fall', 127, 18021234, '322,369,390,545', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 128, 18021132, '337,365,478,521,547', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 129, 18021029, '327,368,388,417,559', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 130, 18020206, '325,375,389,549,575', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 131, 18020115, '620,670,747,786,820', '2018-01-09 11:13:45'),
(2017, 'Mid-term', 'Fall', 132, 18020174, '', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 133, 18021058, '329,364,389,553', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 134, 18028016, '408', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 135, 19020060, '394,415,460,515,527,596', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 136, 18021023, '331,375,391,522,549', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 137, 18020125, '621,662,746,779,889', '2018-01-11 07:35:43'),
(2017, 'Mid-term', 'Fall', 138, 18021042, '336,436', '2017-11-05 12:00:53'),
(2018, 'Final', 'Spring', 139, 18021014, '614,670,747,786,820', '2018-01-14 11:14:47'),
(2017, 'Mid-term', 'Fall', 140, 18021285, '322,378,459,522,553', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 141, 18021130, '625,666,749,780,847,888', '2018-01-11 00:52:14'),
(2017, 'Mid-term', 'Fall', 142, 18021037, '328,368,518,559', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 143, 18021100, '321,369,393,517,545', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 144, 18020028, '', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 145, 18020180, '323,373,393,523,555', '2017-11-05 11:07:42'),
(2017, 'Mid-term', 'Fall', 146, 18020030, '323,375,437,549', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 147, 18021243, '329,366,392,459,518,557', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 148, 18021220, '331,379,391,522,559', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 149, 18021198, '323,373,391,522,555', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 150, 18021044, '329,378,390,519,553', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 151, 18021178, '334,379,388,393,559', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 152, 18021069, '325,369,390,436,517,545', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 153, 18021092, '325,375,549', '2017-11-06 11:04:07'),
(2017, 'Mid-term', 'Fall', 154, 18020018, '335,369,417,438,517,545', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 155, 18021109, '523', '2017-11-05 12:08:45'),
(2018, 'Final', 'Spring', 156, 18021147, '622,662,704,723,779,867', '2018-01-14 10:44:06'),
(2017, 'Mid-term', 'Fall', 157, 18021078, '324,366,388,557', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 158, 18028019, '329', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 159, 18021182, '334,373,388,393,555', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 160, 18021546, '414', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 161, 18021168, '331,378,390,522,553', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 162, 18020061, '334,368,392,518,559', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 163, 18020112, '325,364,418,524,553', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 164, 18021081, '627,666,747,780,845,888', '2018-01-14 10:48:32'),
(2017, 'Mid-term', 'Fall', 165, 18021101, '547', '2017-11-05 12:04:27'),
(2017, 'Mid-term', 'Fall', 166, 18021488, '407,463,516,530,574', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 167, 18021160, '322,366,392,523,557', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 168, 17023098, '322,369,390,519,545', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 169, 18020111, '336,371,390,416,517,547', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 170, 18021111, '323,366,416,557,570', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 171, 18021076, '327,365,438,518,547', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 172, 18021145, '331,369,418,526,545,576', '2017-11-05 11:31:43'),
(2017, 'Mid-term', 'Fall', 174, 18021047, '335,366,478,557', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 175, 18029002, '', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 176, 18028037, '324,437,521,577', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 177, 18021084, '617,668,770,773,847', '2018-01-11 10:04:37'),
(2017, 'Mid-term', 'Fall', 178, 19020189, '561', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 179, 18020051, '315,400,472,503,542,584', '2017-11-05 03:05:30'),
(2017, 'Mid-term', 'Fall', 180, 18028032, '322', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 181, 18021221, '323,371,510,547', '2017-11-05 11:25:36'),
(2018, 'Final', 'Spring', 182, 18021514, '680,701,761,854,875', '2018-01-09 13:26:35'),
(2018, 'Final', 'Spring', 183, 18020118, '621,656,743,776,848', '2018-01-14 10:58:39'),
(2017, 'Mid-term', 'Fall', 184, 18028020, '336,375,416,519,549', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 185, 19021069, '407,460,516,593', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 186, 18021505, '396,467,534,574,593', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 187, 19021073, '681,738,756,850,871', '2018-01-13 16:50:02'),
(2018, 'Final', 'Spring', 188, 18020133, '690,759,816,850,871', '2018-01-09 14:45:18'),
(2017, 'Mid-term', 'Fall', 189, 18021543, '407,463,509,530,593', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 190, 18021512, '346,406,528,578,593', '0000-00-00 00:00:00'),
(2018, 'Final', 'Spring', 191, 19020010, '684,698,738,815,852,873', '2018-01-10 02:03:38'),
(2017, 'Mid-term', 'Fall', 192, 19021200, '407,460,499,527,570,593', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 193, 18020461, '593', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 194, 19021081, '318,401,467,505,534,593', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 195, 19021133, '403', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 196, 18021139, '338,375,437,519,549,576', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 197, 18021511, '402,470,514,540,593', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 198, 18029042, '328,365,391,479,526,547', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 199, 18020020, '334,372,412,518,551,576', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 200, 18050054, '', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 201, 18020069, '327,364,459,524,553,576', '0000-00-00 00:00:00'),
(2017, 'Mid-term', 'Fall', 202, 18021215, '321,375,393,459,523,549', '2017-11-05 11:14:11'),
(2017, 'Mid-term', 'Fall', 203, 18029012, '553', '2017-11-08 23:51:47'),
(2017, 'Mid-term', 'Fall', 204, 18021161, '377', '2017-11-03 11:48:38'),
(2017, 'Mid-term', 'Fall', 205, 19021157, '319,395,470,504,540,593', '2017-11-03 12:02:24'),
(2017, 'Mid-term', 'Fall', 206, 18020544, '', '2017-11-03 12:10:40'),
(2017, 'Mid-term', 'Fall', 207, 18020033, '331,365,390,479,518,547', '2017-11-03 12:35:13'),
(2017, 'Mid-term', 'Fall', 209, 18021857, '', '2017-11-03 12:46:57'),
(2018, 'Final', 'Spring', 210, 18021018, '627,656,746,776,890', '2018-01-12 03:12:47'),
(2017, 'Mid-term', 'Fall', 211, 18021067, '551', '2017-11-05 11:35:26'),
(2017, 'Mid-term', 'Fall', 212, 18021054, '337,365,388,547', '2017-11-03 13:42:28'),
(2018, 'Final', 'Spring', 213, 18021187, '615,668,702,751,773', '2018-01-13 13:14:42'),
(2018, 'Final', 'Spring', 214, 18020157, '614,751,782,868', '2018-01-14 08:56:48'),
(2017, 'Mid-term', 'Fall', 215, 18021103, '327,368,392,523,559', '2017-11-03 14:17:18'),
(2017, 'Mid-term', 'Fall', 216, 18020195, '330,371,519,547', '2017-11-03 14:24:13'),
(2017, 'Mid-term', 'Fall', 217, 18029007, '333,373,437,517,555', '2017-11-03 14:26:26'),
(2017, 'Mid-term', 'Fall', 218, 18021046, '325,373,388,555', '2017-11-03 14:37:57'),
(2017, 'Mid-term', 'Fall', 219, 18021180, '326,372,393,416,517,551', '2017-11-03 14:51:18'),
(2018, 'Final', 'Spring', 220, 17021140, '615,704,748,786,867', '2018-01-14 08:10:19'),
(2017, 'Mid-term', 'Fall', 221, 10721046, '', '2017-11-03 15:20:08'),
(2017, 'Mid-term', 'Fall', 222, 18020062, '', '2017-11-03 15:20:21'),
(2017, 'Mid-term', 'Fall', 223, 18021024, '521', '2017-11-08 23:30:21'),
(2017, 'Mid-term', 'Fall', 224, 18021005, '326,377,392,520,551', '2017-11-03 15:27:42'),
(2018, 'Final', 'Spring', 225, 17023038, '621,662,779,847', '2018-01-14 11:02:45'),
(2017, 'Mid-term', 'Fall', 226, 18029025, '336,375,390,416,522,549', '2017-11-04 01:51:59'),
(2017, 'Mid-term', 'Fall', 227, 18021194, '336,365,479,547', '2017-11-04 02:26:07'),
(2017, 'Mid-term', 'Fall', 228, 18021079, '437', '2017-11-04 04:44:54'),
(2017, 'Mid-term', 'Fall', 229, 18021070, '321,375,388,549', '2017-11-04 04:49:42'),
(2017, 'Mid-term', 'Fall', 231, 18021015, '329,375,388,414,438,549', '2017-11-05 11:24:01'),
(2017, 'Mid-term', 'Fall', 232, 18021113, '323,371,418,547', '2017-11-04 12:47:58'),
(2017, 'Mid-term', 'Fall', 233, 180200548, '', '2017-11-05 02:39:51'),
(2017, 'Mid-term', 'Fall', 234, 18021059, '553', '2017-11-09 02:46:36'),
(2017, 'Mid-term', 'Fall', 235, 18021188, '324,377,418,437,520,551', '2017-11-05 10:50:14'),
(2017, 'Mid-term', 'Fall', 236, 18029009, '372,392', '2017-11-05 11:16:26'),
(2017, 'Mid-term', 'Fall', 237, 18021117, '334,378,413,521,553', '2017-11-05 11:12:18'),
(2017, 'Mid-term', 'Fall', 238, 18021181, '338,375,393,478,549', '2017-11-05 11:14:49'),
(2017, 'Mid-term', 'Fall', 239, 18021201, '338,366,392,518,557', '2017-11-05 11:32:26'),
(2017, 'Mid-term', 'Fall', 240, 18021527, '337,378,553,593', '2017-11-05 11:23:32'),
(2018, 'Final', 'Spring', 241, 18021035, '617,664,750,785,848,891', '2018-01-14 11:10:33'),
(2017, 'Mid-term', 'Fall', 242, 17021209, '337,371,390,478,547', '2017-11-05 11:31:54'),
(2017, 'Mid-term', 'Fall', 243, 17020192, '330,373,415,521,555', '2017-11-05 11:31:48'),
(2018, 'Final', 'Spring', 244, 18021212, '623,670,775,846,893', '2018-01-12 13:14:03'),
(2017, 'Mid-term', 'Fall', 245, 18020100, '330,373,390,555', '2017-11-05 11:31:52'),
(2017, 'Mid-term', 'Fall', 247, 18020005, '327,372,389,551,575', '2017-11-05 11:32:42'),
(2017, 'Mid-term', 'Fall', 248, 18028030, '438', '2017-11-05 11:34:21'),
(2018, 'Final', 'Spring', 249, 18020052, '627,666,747,778,849,888', '2018-01-14 10:14:16'),
(2017, 'Mid-term', 'Fall', 250, 17021005, '333,373,437,478', '2017-11-05 11:35:59'),
(2017, 'Mid-term', 'Fall', 251, 18021087, '330,366,557', '2017-11-05 11:38:01'),
(2018, 'Final', 'Spring', 252, 18020136, '615,664,749,785,890', '2018-01-12 03:21:21'),
(2017, 'Mid-term', 'Fall', 253, 18021218, '438', '2017-11-07 10:34:12'),
(2017, 'Mid-term', 'Fall', 254, 17020043, '331,366,396,498,580', '2017-11-05 11:39:44'),
(2017, 'Mid-term', 'Fall', 255, 18021247, '321,366,523,557,576', '2017-11-05 11:41:41'),
(2017, 'Mid-term', 'Fall', 256, 17020179, '322,366,391,557', '2017-11-05 11:43:42'),
(2017, 'Mid-term', 'Fall', 257, 18020158, '327,369,392,521,545', '2017-11-05 11:44:29'),
(2018, 'Final', 'Spring', 258, 18020032, '630,670,747,786,890', '2018-01-10 11:23:25'),
(2017, 'Mid-term', 'Fall', 259, 17020025, '201,334,522,575', '2017-11-05 11:49:55'),
(2017, 'Mid-term', 'Fall', 260, 17021183, '336,371,547', '2017-11-05 11:53:02'),
(2017, 'Mid-term', 'Fall', 261, 18021237, '330,373,393,517,555', '2017-11-05 12:12:06'),
(2017, 'Mid-term', 'Fall', 262, 18029016, '327,378,390,519,553', '2017-11-05 12:13:59'),
(2017, 'Mid-term', 'Fall', 263, 19020054, '314,403,475,504,537,573', '2017-11-05 12:22:52'),
(2018, 'Final', 'Spring', 264, 18020453, '684,736,759,817,854,875', '2018-01-09 14:43:33'),
(2017, 'Mid-term', 'Fall', 265, 18021186, '332,364,415,524,553', '2017-11-05 12:26:15'),
(2018, 'Final', 'Spring', 266, 18021011, '621,658,747,778', '2018-01-14 11:12:21'),
(2018, 'Final', 'Spring', 268, 18021170, '869', '2018-01-14 09:47:19'),
(2017, 'Mid-term', 'Fall', 269, 18021166, '322,369,479,545', '2017-11-05 12:46:39'),
(2017, 'Mid-term', 'Fall', 270, 17023036, '333,366,518,557,576', '2017-11-05 14:34:00'),
(2017, 'Mid-term', 'Fall', 271, 18021074, '325,369,545', '2017-11-05 23:41:20'),
(2018, 'Final', 'Spring', 272, 19020004, '689,698,752,865,881', '2018-01-12 04:50:50'),
(2017, 'Mid-term', 'Fall', 273, 18021159, '578', '2017-11-06 00:28:57'),
(2017, 'Mid-term', 'Fall', 274, 18020455, '596', '2017-11-09 23:45:34'),
(2018, 'Final', 'Spring', 275, 18021165, '680,818,843,859,883', '2018-01-09 13:56:34'),
(2018, 'Final', 'Spring', 276, 19020236, '691,756,808,840,856,877', '2018-01-12 04:52:22'),
(2017, 'Mid-term', 'Fall', 277, 18021489, '433,467,494,534,583', '2017-11-06 01:56:28'),
(2017, 'Mid-term', 'Fall', 278, 18021121, '513', '2017-11-06 06:09:32'),
(2017, 'Mid-term', 'Fall', 279, 18029003, '324,375,459,478,549', '2017-11-06 10:21:04'),
(2017, 'Mid-term', 'Fall', 280, 18021185, '335,373,437,520,555,577', '2017-11-06 10:32:03'),
(2018, 'Final', 'Spring', 281, 18021057, '631,660,782,847', '2018-01-14 08:39:11'),
(2017, 'Mid-term', 'Fall', 282, 18021244, '326,371,392,459,525,547', '2017-11-06 10:53:18'),
(2017, 'Mid-term', 'Fall', 283, 19021040, '316,400,472,502,542,594', '2017-11-06 11:31:48'),
(2017, 'Mid-term', 'Fall', 284, 19020013, '397,474,512,536,561,594', '2017-11-06 11:41:18'),
(2017, 'Mid-term', 'Fall', 285, 19020102, '320,402,470,497,506,540', '2017-11-06 23:43:58'),
(2017, 'Mid-term', 'Fall', 287, 19021041, '', '2017-11-06 13:16:15'),
(2017, 'Mid-term', 'Fall', 288, 19020028, '406,412,465,498,516,532', '2017-11-06 13:27:05'),
(2017, 'Mid-term', 'Fall', 289, 17013153, '373', '2017-11-07 02:49:51'),
(2017, 'Mid-term', 'Fall', 290, 18021149, '519', '2017-11-08 14:15:12'),
(2018, 'Final', 'Spring', 291, 18021125, '620,662,746,784,889', '2018-01-09 10:37:54'),
(2017, 'Mid-term', 'Fall', 292, 18020147, '335,366,478,557', '2017-11-06 23:29:26'),
(2018, 'Final', 'Spring', 293, 18020001, '660', '2018-01-14 10:32:24'),
(2017, 'Mid-term', 'Fall', 294, 18021083, '324,364,520,553,577', '2017-11-06 23:37:19'),
(2017, 'Mid-term', 'Fall', 295, 17023005, '334', '2017-11-06 23:40:06'),
(2018, 'Final', 'Spring', 296, 18021284, '629,662,744,779', '2018-01-14 11:16:53'),
(2017, 'Mid-term', 'Fall', 297, 18020023, '418', '2017-11-09 05:48:53'),
(2017, 'Mid-term', 'Fall', 302, 18021053, '459', '2017-11-08 02:30:07'),
(2017, 'Mid-term', 'Fall', 304, 18020000, '377,459,493,573,602,343,582', '2017-11-09 06:29:57'),
(2018, 'Final', 'Spring', 305, 17020069, '813', '2018-01-14 10:31:04'),
(2017, 'Mid-term', 'Fall', 306, 19021271, '309', '2017-11-11 14:14:28'),
(2017, '', 'Fall', 307, 19020158, '', '2017-12-02 17:28:15'),
(2018, 'Final', 'Spring', 308, 18020054, '622,666,704,742,780,822', '2018-01-09 10:11:00'),
(2018, 'Final', 'Spring', 309, 18020054, '622,666,704,742,780,822', '2018-01-09 10:11:00'),
(2018, 'Final', 'Spring', 310, 18020054, '622,666,704,742,780,822', '2018-01-09 10:11:00'),
(2018, 'Final', 'Spring', 311, 19021030, '614,729,833,859,888,687', '2018-01-09 09:45:30'),
(2018, 'Final', 'Spring', 312, 19020085, '690,736,853,874,758', '2018-01-09 09:47:11'),
(2018, 'Final', 'Spring', 313, 17020054, '611,688,786,863,622,648', '2018-01-11 10:33:38'),
(2018, 'Final', 'Spring', 314, 18021090, '630,670,786,894', '2018-01-09 10:28:20'),
(2018, 'Final', 'Spring', 315, 19021026, '610,690,701,727,854,875', '2018-01-09 10:52:04'),
(2018, 'Final', 'Spring', 316, 19021092, '611,691,699,724,864,880', '2018-01-09 10:37:29'),
(2018, 'Final', 'Spring', 317, 18021125, '620,662,746,784,889', '2018-01-09 10:37:54'),
(2018, 'Final', 'Spring', 318, 18021031, '625,662,779,867,894', '2018-01-09 10:56:23'),
(2018, 'Final', 'Spring', 319, 19021192, '685,698,733,759,850,871', '2018-01-09 11:01:38'),
(2018, 'Final', 'Spring', 320, 18020115, '620,670,747,786,820', '2018-01-09 11:13:45'),
(2018, 'Final', 'Spring', 321, 18020055, '', '2018-01-09 11:52:14'),
(2018, 'Final', 'Spring', 322, 19021136, '607,699,731,844,865,881', '2018-01-09 12:48:43'),
(2018, 'Final', 'Spring', 323, 17021140, '615,704,748,786,867', '2018-01-14 08:10:19'),
(2018, 'Final', 'Spring', 324, 18021514, '680,701,761,854,875', '2018-01-09 13:26:35'),
(2018, 'Final', 'Spring', 325, 18021509, '605,684,732,757,854,875', '2018-01-09 13:32:59'),
(2018, 'Final', 'Spring', 326, 18021165, '680,818,843,859,883', '2018-01-09 13:56:34'),
(2018, 'Final', 'Spring', 327, 18020127, '660', '2018-01-14 09:38:08'),
(2018, 'Final', 'Spring', 328, 19021009, '692,740,757,850,871', '2018-01-09 14:29:20'),
(2018, 'Final', 'Spring', 329, 18020453, '684,736,759,817,854,875', '2018-01-09 14:43:33'),
(2018, 'Final', 'Spring', 330, 18020133, '690,759,816,850,871', '2018-01-09 14:45:18'),
(2018, 'Final', 'Spring', 331, 18020129, '614,668,744,773,892', '2018-01-09 15:00:28'),
(2018, 'Final', 'Spring', 332, 18021110, '626,668,702,746,773,867', '2018-01-09 15:04:35'),
(2018, 'Final', 'Spring', 333, 18020131, '625,662,701,784', '2018-01-09 15:20:39'),
(2018, 'Final', 'Spring', 334, 18020113, '626,666,741,780', '2018-01-09 23:38:54'),
(2018, 'Final', 'Spring', 335, 19021012, '612,693,732,808,865,881', '2018-01-10 00:33:02'),
(2018, 'Final', 'Spring', 336, 17020046, '627,658,748,779,858,867', '2018-01-10 01:08:43'),
(2018, 'Final', 'Spring', 337, 18020126, '624,658,750,772,867', '2018-01-14 11:01:21'),
(2018, 'Final', 'Spring', 338, 18020188, '818', '2018-01-10 01:23:28'),
(2018, 'Final', 'Spring', 339, 19021229, '688,699,726,761,854,875', '2018-01-10 01:41:21'),
(2018, 'Final', 'Spring', 340, 19020010, '684,698,738,815,852,873', '2018-01-10 02:03:38'),
(2018, 'Final', 'Spring', 341, 18021001, '622,662,704,723,779,894', '2018-01-12 00:25:23'),
(2018, 'Final', 'Spring', 342, 18020019, '625,668,745,773,892', '2018-01-13 03:49:12'),
(2018, 'Final', 'Spring', 343, 19021100, '611,729,817,843,861,885', '2018-01-10 09:25:34'),
(2018, 'Final', 'Spring', 344, 18020032, '630,670,747,786,890', '2018-01-10 11:23:25'),
(2018, 'Final', 'Spring', 345, 19021008, '738', '2018-01-10 11:36:45'),
(2018, 'Final', 'Spring', 346, 18029004, '616,664,702,749,771', '2018-01-10 11:37:05'),
(2018, 'Final', 'Spring', 347, 18029011, '616,666,744,780,889', '2018-01-10 23:34:05'),
(2018, 'Final', 'Spring', 348, 18021130, '625,666,749,780,847,888', '2018-01-11 00:52:14'),
(2018, 'Final', 'Spring', 349, 19020231, '714,809,831,854,875', '2018-01-11 01:03:19'),
(2018, 'Final', 'Spring', 350, 19020048, '731', '2018-01-12 04:43:43'),
(2018, 'Final', 'Spring', 351, 18021123, '619,666,703,745,780,869', '2018-01-11 02:26:44'),
(2018, 'Final', 'Spring', 352, 19020002, '711,726,761,809,854,875', '2018-01-11 07:58:36'),
(2018, 'Final', 'Spring', 353, 18020084, '628,656,743,776,868', '2018-01-11 05:59:45'),
(2018, 'Final', 'Spring', 354, 18028004, '627,666,746,780,822,867', '2018-01-11 07:10:51'),
(2018, 'Final', 'Spring', 355, 18020125, '621,662,746,779,889', '2018-01-11 07:35:43'),
(2018, 'Final', 'Spring', 356, 18021084, '617,668,770,773,847', '2018-01-11 10:04:37'),
(2018, 'Final', 'Spring', 357, 18020001, '660', '2018-01-14 10:32:24'),
(2018, 'Final', 'Spring', 358, 19021166, '612,726,757,838,852,873', '2018-01-11 12:01:58'),
(2018, 'Final', 'Spring', 359, 17020152, '630,658,736,778,890', '2018-01-11 12:31:51'),
(2018, 'Final', 'Spring', 360, 19020027, '612,731,814,846,852,873', '2018-01-11 23:17:59'),
(2018, 'Final', 'Spring', 361, 18021073, '619,660,750,782,867,890', '2018-01-12 01:59:57'),
(2018, 'Final', 'Spring', 362, 18021018, '627,656,746,776,890', '2018-01-12 03:12:47'),
(2018, 'Final', 'Spring', 363, 18020104, '615,664,749,785,890', '2018-01-12 03:13:36'),
(2018, 'Final', 'Spring', 364, 18020136, '615,664,749,785,890', '2018-01-12 03:21:21'),
(2018, 'Final', 'Spring', 365, 18029023, '', '2018-01-12 04:06:09'),
(2018, 'Final', 'Spring', 366, 19020236, '691,756,808,840,856,877', '2018-01-12 04:52:22'),
(2018, 'Final', 'Spring', 367, 19020004, '689,698,752,865,881', '2018-01-12 04:50:50'),
(2018, 'Final', 'Spring', 368, 18020039, '626,668,702,746,773,867', '2018-01-12 07:38:49'),
(2018, 'Final', 'Spring', 369, 18021212, '623,670,775,846,893', '2018-01-12 13:14:03'),
(2018, 'Final', 'Spring', 370, 18021187, '615,668,702,751,773', '2018-01-13 13:14:42'),
(2018, 'Final', 'Spring', 371, 18021152, '623,658,741,778,893', '2018-01-13 07:23:16'),
(2018, 'Final', 'Spring', 372, 17023130, '734', '2018-01-13 11:15:01'),
(2018, 'Final', 'Spring', 373, 18021133, '618,666,750,780,848,889', '2018-01-13 12:50:41'),
(2018, 'Final', 'Spring', 374, 19021073, '681,738,756,850,871', '2018-01-13 16:50:02'),
(2018, 'Final', 'Spring', 375, 18021033, '617,660,782', '2018-01-14 02:38:24'),
(2018, 'Final', 'Spring', 376, 17020200, '', '2018-01-14 02:37:33'),
(2018, 'Final', 'Spring', 377, 18020464, '611,658,686,741,772', '2018-01-14 04:59:02'),
(2018, 'Final', 'Spring', 378, 18020059, '620,664,748,770,771', '2018-01-14 05:21:15'),
(2018, 'Final', 'Spring', 379, 18021227, '622,666,742,780,848,888', '2018-01-14 08:10:05'),
(2018, 'Final', 'Spring', 380, 18020456, '685,701,733,757,850,871', '2018-01-14 08:36:28'),
(2018, 'Final', 'Spring', 381, 18021057, '631,660,782,847', '2018-01-14 08:39:11'),
(2018, 'Final', 'Spring', 382, 18020157, '614,751,782,868', '2018-01-14 08:56:48'),
(2018, 'Final', 'Spring', 383, 19020050, '688,701,756,813,850,871', '2018-01-14 09:06:12'),
(2018, 'Final', 'Spring', 384, 18021170, '869', '2018-01-14 09:47:19'),
(2018, 'Final', 'Spring', 385, 18020458, '609,687,725,811,865,881', '2018-01-14 10:11:39'),
(2018, 'Final', 'Spring', 386, 18020052, '627,666,747,778,849,888', '2018-01-14 10:14:16'),
(2018, 'Final', 'Spring', 387, 18021066, '626,668,751,773,893', '2018-01-14 10:27:43'),
(2018, 'Final', 'Spring', 388, 17020070, '', '2018-01-14 10:28:38'),
(2018, 'Final', 'Spring', 389, 17020069, '813', '2018-01-14 10:31:04'),
(2018, 'Final', 'Spring', 390, 18021040, '625,670,686,722,786', '2018-01-14 10:39:23'),
(2018, 'Final', 'Spring', 391, 18029027, '618,656,704,750,776,893', '2018-01-14 11:00:53'),
(2018, 'Final', 'Spring', 392, 18021147, '622,662,704,723,779,867', '2018-01-14 10:44:06'),
(2018, 'Final', 'Spring', 393, 18028036, '627,747,893', '2018-01-14 10:47:03'),
(2018, 'Final', 'Spring', 394, 18021081, '627,666,747,780,845,888', '2018-01-14 10:48:32'),
(2018, 'Final', 'Spring', 395, 18021167, '623,658,749,772', '2018-01-14 10:52:41'),
(2018, 'Final', 'Spring', 396, 18021202, '624,658,750,778,847', '2018-01-14 10:56:11'),
(2018, 'Final', 'Spring', 397, 18020118, '621,656,743,776,848', '2018-01-14 10:58:39'),
(2018, 'Final', 'Spring', 398, 17023038, '621,662,779,847', '2018-01-14 11:02:45'),
(2018, 'Final', 'Spring', 399, 18021529, '622,656,746,776,888', '2018-01-14 11:03:19'),
(2018, 'Final', 'Spring', 400, 18020135, '622,656,745,776,869', '2018-01-14 11:02:17'),
(2018, 'Final', 'Spring', 401, 18021011, '621,658,747,778', '2018-01-14 11:12:21'),
(2018, 'Final', 'Spring', 402, 18021035, '617,664,750,785,848,891', '2018-01-14 11:10:33'),
(2018, 'Final', 'Spring', 403, 18020075, '614,662,703,749,779,867', '2018-01-14 11:08:12'),
(2018, 'Final', 'Spring', 404, 18021204, '624,670,741,786,868,892', '2018-01-14 11:07:57'),
(2018, 'Final', 'Spring', 405, 18021184, '623,666,744,780', '2018-01-14 11:09:38'),
(2018, 'Final', 'Spring', 406, 18020198, '692,737,759,850,871', '2018-01-14 11:11:57'),
(2018, 'Final', 'Spring', 407, 18021214, '622,660,761,782,889', '2018-01-14 11:11:34'),
(2018, 'Final', 'Spring', 408, 18021014, '614,670,747,786,820', '2018-01-14 11:14:47'),
(2018, 'Final', 'Spring', 409, 7123152, '656', '2018-01-14 11:13:37'),
(2018, 'Final', 'Spring', 410, 18021284, '629,662,744,779', '2018-01-14 11:16:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;