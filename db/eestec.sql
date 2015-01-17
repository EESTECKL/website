-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 07, 2013 at 12:07 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eestec`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `idArticle` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `textContent` text NOT NULL,
  `idPhoto` int(11) NOT NULL,
  `dateAdded` varchar(45) NOT NULL,
  PRIMARY KEY (`idArticle`),
  KEY `fk_article_photo_idx` (`idPhoto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`idArticle`, `title`, `textContent`, `idPhoto`, `dateAdded`) VALUES
(1, 'EESTEC Observer 2013', 'Dear all,\r\n\r\nwebsite of EESTEC Kaiserslautern has been online. Website is still under construction. However, you can register. Therefore you will be able to receive newsletter about all important events in EESTEC.', 1, '14-07-2013 11:29:17'),
(2, 'Barbecue Party', 'EESTEC is a new organization on University of Kaiserslautern. In order to inform students about possibilities and opportunities in EESTEC, we have organized barbecue party. We had a people from three continents and lot of delicious food. See the gallery below.\r\n\r\nWe are hoping to host more these events in the future. Your ideas for the social gatherings are always welcome.', 2, '14-07-2013 11:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `articleType`
--

CREATE TABLE IF NOT EXISTS `articleType` (
  `idArticleType` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(95) NOT NULL,
  PRIMARY KEY (`idArticleType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `article_has_articleType`
--

CREATE TABLE IF NOT EXISTS `article_has_articleType` (
  `idArticle_has_articleType` int(11) NOT NULL AUTO_INCREMENT,
  `idArticle` int(11) NOT NULL,
  `idArticleType` int(11) NOT NULL,
  PRIMARY KEY (`idArticle_has_articleType`),
  KEY `fk_article_has_articleType_articleType1_idx` (`idArticleType`),
  KEY `fk_article_has_articleType_article1_idx` (`idArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `article_has_gallery`
--

CREATE TABLE IF NOT EXISTS `article_has_gallery` (
  `idArticle_has_gallery` int(45) NOT NULL AUTO_INCREMENT,
  `article_idArticle` int(11) NOT NULL,
  `gallery_idGallery` int(11) NOT NULL,
  PRIMARY KEY (`idArticle_has_gallery`),
  KEY `fk_article_has_gallery_gallery1_idx` (`gallery_idGallery`),
  KEY `fk_article_has_gallery_article1_idx` (`article_idArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `article_has_photo_not_in_gallery`
--

CREATE TABLE IF NOT EXISTS `article_has_photo_not_in_gallery` (
  `idArticle_has_photocol` int(11) NOT NULL AUTO_INCREMENT,
  `idArticle` int(11) NOT NULL,
  `idPhoto` int(11) NOT NULL,
  PRIMARY KEY (`idArticle_has_photocol`),
  KEY `fk_article_has_photo_photo1_idx` (`idPhoto`),
  KEY `fk_article_has_photo_article1_idx` (`idArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `article_has_video`
--

CREATE TABLE IF NOT EXISTS `article_has_video` (
  `idArticle_has_video` int(11) NOT NULL AUTO_INCREMENT,
  `idArticle` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  PRIMARY KEY (`idArticle_has_video`),
  KEY `fk_article_has_video_video1_idx` (`idVideo`),
  KEY `fk_article_has_video_article1_idx` (`idArticle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `idGallery` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(95) NOT NULL,
  PRIMARY KEY (`idGallery`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`idGallery`, `title`) VALUES
(1, 'BarbecueParty'),
(2, 'EESTEC Congress 2013');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_has_photo`
--

CREATE TABLE IF NOT EXISTS `gallery_has_photo` (
  `idGalleryPhoto` int(11) NOT NULL AUTO_INCREMENT,
  `idGallery` int(11) NOT NULL,
  `idPhoto` int(11) NOT NULL,
  PRIMARY KEY (`idGalleryPhoto`),
  KEY `fk_gallery_has_photo_photo1_idx` (`idPhoto`),
  KEY `fk_gallery_has_photo_gallery1_idx` (`idGallery`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `gallery_has_photo`
--

INSERT INTO `gallery_has_photo` (`idGalleryPhoto`, `idGallery`, `idPhoto`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 1, 5),
(4, 1, 6),
(5, 1, 7),
(6, 1, 8),
(7, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE IF NOT EXISTS `gender` (
  `idgender` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(45) NOT NULL,
  PRIMARY KEY (`idgender`),
  UNIQUE KEY `idgender_UNIQUE` (`idgender`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`idgender`, `value`) VALUES
(1, 'female'),
(2, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(145) NOT NULL,
  `idPhoto` varchar(45) DEFAULT NULL,
  `firstName` varchar(45) NOT NULL,
  `secondName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `alumni` tinyint(1) DEFAULT NULL,
  `registrationDate` varchar(45) NOT NULL,
  `dateOfBirth` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `idGender` int(11) DEFAULT NULL,
  `iduniversity` int(11) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `username_UNIQUE` (`email`),
  KEY `fk_member_gender1_idx` (`idGender`),
  KEY `fk_member_university1_idx` (`iduniversity`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`idUser`, `email`, `password`, `idPhoto`, `firstName`, `secondName`, `lastName`, `admin`, `active`, `alumni`, `registrationDate`, `dateOfBirth`, `phone`, `idGender`, `iduniversity`) VALUES
(5, 'jasmin.jahic@gmail.com', '+NXx9rZ3xqybhI6hA23Etv6vISvOANPs9O/OMdCC/F4=', NULL, 'Jasmin', '', 'Jahic', 0, 1, 0, '14-07-2013 11:40:32', NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `member_wrote_article`
--

CREATE TABLE IF NOT EXISTS `member_wrote_article` (
  `idMember_wrote_article` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  PRIMARY KEY (`idMember_wrote_article`),
  KEY `fk_member_has_article_article1_idx` (`idArticle`),
  KEY `fk_member_has_article_member1_idx` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `idPhoto` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(95) NOT NULL,
  `link` varchar(150) NOT NULL,
  PRIMARY KEY (`idPhoto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`idPhoto`, `title`, `link`) VALUES
(1, 'Kaiserslautern', 'images/demo/kl_img.jpg'),
(2, 'Barbecue Party', 'images/demo/imgl.gif'),
(3, 'Barbecue party 1', 'DSC03014.JPG'),
(4, 'Barbecue party 1', 'DSC03015.JPG'),
(5, 'Barbecue party 1', 'DSC03017.JPG'),
(6, 'Barbecue party 1', 'DSC03019.JPG'),
(7, 'Barbecue party 1', 'DSC03021.JPG'),
(8, 'Barbecue party 1', 'DSC03022.JPG'),
(9, 'Barbecue party 1', 'DSC03024.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `university`
--

CREATE TABLE IF NOT EXISTS `university` (
  `iduniversity` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  PRIMARY KEY (`iduniversity`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `university`
--

INSERT INTO `university` (`iduniversity`, `name`) VALUES
(1, 'TU Kaiserslautern'),
(2, 'FH Kaiserslautern');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `idVideo` int(11) NOT NULL,
  `title` varchar(95) NOT NULL,
  `link` varchar(150) NOT NULL,
  PRIMARY KEY (`idVideo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_photo` FOREIGN KEY (`idPhoto`) REFERENCES `photo` (`idPhoto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `article_has_articleType`
--
ALTER TABLE `article_has_articleType`
  ADD CONSTRAINT `fk_article_has_articleType_article1` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_article_has_articleType_articleType1` FOREIGN KEY (`idArticleType`) REFERENCES `articleType` (`idArticleType`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `article_has_gallery`
--
ALTER TABLE `article_has_gallery`
  ADD CONSTRAINT `fk_article_has_gallery_article1` FOREIGN KEY (`article_idArticle`) REFERENCES `article` (`idArticle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_article_has_gallery_gallery1` FOREIGN KEY (`gallery_idGallery`) REFERENCES `gallery` (`idGallery`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `article_has_photo_not_in_gallery`
--
ALTER TABLE `article_has_photo_not_in_gallery`
  ADD CONSTRAINT `fk_article_has_photo_article1` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_article_has_photo_photo1` FOREIGN KEY (`idPhoto`) REFERENCES `photo` (`idPhoto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `article_has_video`
--
ALTER TABLE `article_has_video`
  ADD CONSTRAINT `fk_article_has_video_article1` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_article_has_video_video1` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gallery_has_photo`
--
ALTER TABLE `gallery_has_photo`
  ADD CONSTRAINT `fk_gallery_has_photo_gallery1` FOREIGN KEY (`idGallery`) REFERENCES `gallery` (`idGallery`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gallery_has_photo_photo1` FOREIGN KEY (`idPhoto`) REFERENCES `photo` (`idPhoto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `fk_member_gender1` FOREIGN KEY (`idGender`) REFERENCES `gender` (`idgender`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_member_university1` FOREIGN KEY (`iduniversity`) REFERENCES `university` (`iduniversity`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `member_wrote_article`
--
ALTER TABLE `member_wrote_article`
  ADD CONSTRAINT `fk_member_has_article_article1` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_member_has_article_member1` FOREIGN KEY (`idUser`) REFERENCES `member` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
