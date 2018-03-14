-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- 主機: localhost:3306
-- 建立日期: 2016 年 01 月 19 日 14:44
-- 伺服器版本: 5.5.46-cll
-- PHP 版本: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `u2958729_baseball`
--

-- --------------------------------------------------------

--
-- 資料表結構 `明日之星`
--

CREATE TABLE IF NOT EXISTS `明日之星` (
  `SID` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `名字` varchar(10) NOT NULL,
  `身高` int(3) NOT NULL,
  `體重` int(3) NOT NULL,
  `打擊狀況` varchar(255) NOT NULL,
  `投球狀況` varchar(255) NOT NULL,
  `守備位置` varchar(10) NOT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 資料表的匯出資料 `明日之星`
--

INSERT INTO `明日之星` (`SID`, `名字`, `身高`, `體重`, `打擊狀況`, `投球狀況`, `守備位置`) VALUES
(1, '馬虎', 170, 65, 'soso', 'soso', '遊擊手'),
(2, '泰山', 180, 85, '爆發力強，長打能力強', '臂力不錯，守備很好', '三壘手'),
(3, '阿鈣', 177, 75, '有球感，可以練', '球速不錯，低肩側投', '投手'),
(4, '許機轟', 190, 95, '長打能力強，守備、跑壘觀念好', '臂力好，傳球動作流暢', '一壘手');

-- --------------------------------------------------------

--
-- 資料表結構 `比賽`
--

CREATE TABLE IF NOT EXISTS `比賽` (
  `GID` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `日期` varchar(15) NOT NULL,
  `球場` varchar(20) NOT NULL,
  `主隊` varchar(10) NOT NULL,
  `客隊` varchar(10) NOT NULL,
  `比數` varchar(5) NOT NULL,
  `判斷比賽型態` int(1) NOT NULL,
  PRIMARY KEY (`GID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 資料表的匯出資料 `比賽`
--

INSERT INTO `比賽` (`GID`, `日期`, `球場`, `主隊`, `客隊`, `比數`, `判斷比賽型態`) VALUES
(1, '20151010', '埔里', '象', '牛', '10:8', 0),
(2, '2016-01-12', '埔里', '中信兄弟', 'Lamigo桃猿', '5:6', 1),
(3, '2016-01-13', '臺中洲際', '義大犀牛', '中信兄弟', '7:5', 1),
(6, '2016-01-13', '臺北天母棒球場', 'Lamigo桃猿', '中信兄弟', '7:9', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `比賽球員`
--

CREATE TABLE IF NOT EXISTS `比賽球員` (
  `GID` int(255) unsigned NOT NULL,
  `PID` int(255) unsigned NOT NULL,
  PRIMARY KEY (`GID`,`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `比賽選手打擊`
--

CREATE TABLE IF NOT EXISTS `比賽選手打擊` (
  `GID` int(255) unsigned NOT NULL,
  `PID` int(255) unsigned NOT NULL,
  `三振次數` int(2) NOT NULL,
  `全壘打` int(2) NOT NULL,
  `安打` int(2) NOT NULL,
  `打數` int(2) NOT NULL,
  `打點` int(2) NOT NULL,
  `打席數` int(2) NOT NULL,
  PRIMARY KEY (`GID`,`PID`),
  KEY `PID` (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `比賽選手打擊`
--

INSERT INTO `比賽選手打擊` (`GID`, `PID`, `三振次數`, `全壘打`, `安打`, `打數`, `打點`, `打席數`) VALUES
(1, 16, 0, 1, 1, 4, 2, 4),
(2, 9, 1, 0, 2, 3, 1, 4),
(3, 9, 0, 3, 0, 4, 5, 4),
(3, 11, 0, 1, 2, 4, 2, 4),
(3, 16, 1, 2, 1, 4, 3, 4),
(6, 9, 0, 0, 4, 5, 3, 5),
(6, 16, 1, 2, 2, 5, 4, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `比賽選手投球`
--

CREATE TABLE IF NOT EXISTS `比賽選手投球` (
  `GID` int(255) unsigned NOT NULL,
  `PID` int(255) unsigned NOT NULL,
  `局數` float NOT NULL,
  `投球數` int(3) NOT NULL,
  `三振數` int(2) NOT NULL,
  `保送數` int(3) NOT NULL,
  `失誤數` int(2) NOT NULL,
  PRIMARY KEY (`GID`,`PID`),
  KEY `PID` (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `比賽選手投球`
--

INSERT INTO `比賽選手投球` (`GID`, `PID`, `局數`, `投球數`, `三振數`, `保送數`, `失誤數`) VALUES
(1, 6, 5, 0, 1, 0, 0),
(1, 10, 2.5, 40, 0, 3, 2),
(1, 13, 2, 20, 1, 1, 0),
(1, 16, 0, 15, 1, 1, 0),
(3, 19, 2, 32, 4, 1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `比賽選手防守`
--

CREATE TABLE IF NOT EXISTS `比賽選手防守` (
  `GID` int(255) unsigned NOT NULL,
  `PID` int(255) unsigned NOT NULL,
  `局數` float NOT NULL,
  `失誤數` int(2) NOT NULL,
  `守備次數` int(2) NOT NULL,
  PRIMARY KEY (`GID`,`PID`),
  KEY `PID` (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `比賽選手防守`
--

INSERT INTO `比賽選手防守` (`GID`, `PID`, `局數`, `失誤數`, `守備次數`) VALUES
(1, 13, 2, 0, 1),
(1, 16, 0, 1, 7),
(2, 13, 0, 0, 2),
(2, 16, 9, 0, 6),
(3, 9, 9, 0, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `球員`
--

CREATE TABLE IF NOT EXISTS `球員` (
  `PID` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `TID` int(255) unsigned NOT NULL DEFAULT '1',
  `背號` int(3) unsigned NOT NULL,
  `名字` varchar(20) NOT NULL,
  `身高` int(3) NOT NULL,
  `體重` int(3) NOT NULL,
  `尺寸` varchar(4) NOT NULL,
  `守備位置` varchar(10) NOT NULL,
  PRIMARY KEY (`PID`),
  KEY `TID` (`TID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 資料表的匯出資料 `球員`
--

INSERT INTO `球員` (`PID`, `TID`, `背號`, `名字`, `身高`, `體重`, `尺寸`, `守備位置`) VALUES
(6, 2, 12, 'Ben ten', 170, 70, 'L', '右外野手'),
(9, 3, 10, '恰恰', 190, 100, '2L', '捕手'),
(10, 1, 11, '紅龜', 175, 70, 'XL', '中外野手'),
(11, 3, 13, '周董', 185, 80, '2L', '左外野手'),
(13, 2, 15, '廖于誠', 182, 71, 'L', '投手'),
(16, 1, 31, '阿給', 180, 80, 'XL', '一壘手'),
(18, 1, 5, '高智鈞', 180, 82, 'XL', '捕手'),
(19, 3, 99, '陳鴻', 191, 90, '2L', '投手');

-- --------------------------------------------------------

--
-- 資料表結構 `練習項目`
--

CREATE TABLE IF NOT EXISTS `練習項目` (
  `編號` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `PID` int(255) unsigned NOT NULL,
  `打擊` varchar(10) DEFAULT NULL,
  `守備` varchar(10) DEFAULT NULL,
  `時數` float NOT NULL,
  `其他` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`編號`),
  KEY `PID` (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 資料表的匯出資料 `練習項目`
--

INSERT INTO `練習項目` (`編號`, `PID`, `打擊`, `守備`, `時數`, `其他`) VALUES
(1, 6, '打網', '', 2, ''),
(4, 13, '', '', 2, '練投'),
(5, 9, '', '快速滾地', 1, ''),
(6, 11, '打free', '', 1, ''),
(7, 19, '', '投手前滾地', 1, '');

-- --------------------------------------------------------

--
-- 資料表結構 `行事曆`
--

CREATE TABLE IF NOT EXISTS `行事曆` (
  `行事曆ID` int(255) unsigned NOT NULL,
  `年` int(4) unsigned NOT NULL,
  `月` int(2) unsigned NOT NULL,
  `日` int(2) unsigned NOT NULL,
  `內容` varchar(255) NOT NULL,
  PRIMARY KEY (`行事曆ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `隊伍`
--

CREATE TABLE IF NOT EXISTS `隊伍` (
  `TID` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `隊名` varchar(10) NOT NULL,
  `成立日期` varchar(10) NOT NULL,
  `主場地點` varchar(10) NOT NULL,
  PRIMARY KEY (`TID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 資料表的匯出資料 `隊伍`
--

INSERT INTO `隊伍` (`TID`, `隊名`, `成立日期`, `主場地點`) VALUES
(1, '統一獅', '', ''),
(2, '義大犀牛', '', ''),
(3, '中信兄弟', '1980', '臺北');

-- --------------------------------------------------------

--
-- 資料表結構 `飲食`
--

CREATE TABLE IF NOT EXISTS `飲食` (
  `日期` varchar(15) NOT NULL,
  `PID` int(255) unsigned NOT NULL,
  `早餐` varchar(255) NOT NULL,
  `午餐` varchar(255) NOT NULL,
  `晚餐` varchar(255) NOT NULL,
  `額外補充` varchar(255) NOT NULL,
  PRIMARY KEY (`日期`,`PID`),
  KEY `PID` (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `飲食`
--

INSERT INTO `飲食` (`日期`, `PID`, `早餐`, `午餐`, `晚餐`, `額外補充`) VALUES
('2016-01-10', 11, '', '', '', '399吃到飽'),
('2016-01-11', 16, '', '', '', '早:碳烤三明治，午:碳烤三明治，晚:碳烤三明治'),
('2016-01-12', 9, '', '', '', '早:火腿三明治，午:雞排便當，晚:牛肉麵'),
('2016-01-12', 16, '', '', '', '早、午、晚:響食天堂');

--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `比賽選手打擊`
--
ALTER TABLE `比賽選手打擊`
  ADD CONSTRAINT `比賽選手打擊_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `球員` (`PID`);

--
-- 資料表的 Constraints `比賽選手投球`
--
ALTER TABLE `比賽選手投球`
  ADD CONSTRAINT `比賽選手投球_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `球員` (`PID`);

--
-- 資料表的 Constraints `比賽選手防守`
--
ALTER TABLE `比賽選手防守`
  ADD CONSTRAINT `比賽選手防守_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `球員` (`PID`);

--
-- 資料表的 Constraints `球員`
--
ALTER TABLE `球員`
  ADD CONSTRAINT `球員_ibfk_1` FOREIGN KEY (`TID`) REFERENCES `隊伍` (`TID`);

--
-- 資料表的 Constraints `練習項目`
--
ALTER TABLE `練習項目`
  ADD CONSTRAINT `練習項目_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `球員` (`PID`);

--
-- 資料表的 Constraints `飲食`
--
ALTER TABLE `飲食`
  ADD CONSTRAINT `飲食_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `球員` (`PID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
