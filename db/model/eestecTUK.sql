SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `eestec` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `eestec` ;

-- -----------------------------------------------------
-- Table `eestec`.`photo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`photo` (
  `idPhoto` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(95) NOT NULL ,
  `link` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`idPhoto`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`article`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`article` (
  `idArticle` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(150) NOT NULL ,
  `textContent` TEXT NOT NULL ,
  `idPhoto` INT NOT NULL ,
  `dateAdded` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idArticle`) ,
  INDEX `fk_article_photo_idx` (`idPhoto` ASC) ,
  CONSTRAINT `fk_article_photo`
    FOREIGN KEY (`idPhoto` )
    REFERENCES `eestec`.`photo` (`idPhoto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`gender`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`gender` (
  `idgender` INT NOT NULL ,
  `value` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idgender`) ,
  UNIQUE INDEX `idgender_UNIQUE` (`idgender` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`university`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`university` (
  `iduniversity` INT NOT NULL ,
  `name` VARCHAR(65) NOT NULL ,
  PRIMARY KEY (`iduniversity`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`member`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`member` (
  `idUser` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(145) NOT NULL ,
  `idPhoto` VARCHAR(45) NULL ,
  `firstName` VARCHAR(45) NOT NULL ,
  `secondName` VARCHAR(45) NULL ,
  `lastName` VARCHAR(45) NOT NULL ,
  `admin` TINYINT(1) NOT NULL ,
  `active` TINYINT(1) NOT NULL ,
  `alumni` TINYINT(1) NULL ,
  `membercol` VARCHAR(45) NULL ,
  `registrationDate` VARCHAR(45) NOT NULL ,
  `dateOfBirth` VARCHAR(45) NULL ,
  `phone` VARCHAR(45) NULL ,
  `idGender` INT NULL ,
  `iduniversity` INT NOT NULL ,
  PRIMARY KEY (`idUser`) ,
  UNIQUE INDEX `username_UNIQUE` (`email` ASC) ,
  INDEX `fk_member_gender1_idx` (`idGender` ASC) ,
  INDEX `fk_member_university1_idx` (`iduniversity` ASC) ,
  CONSTRAINT `fk_member_gender1`
    FOREIGN KEY (`idGender` )
    REFERENCES `eestec`.`gender` (`idgender` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_member_university1`
    FOREIGN KEY (`iduniversity` )
    REFERENCES `eestec`.`university` (`iduniversity` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`video`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`video` (
  `idVideo` INT NOT NULL ,
  `title` VARCHAR(95) NOT NULL ,
  `link` VARCHAR(150) NOT NULL ,
  PRIMARY KEY (`idVideo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`gallery`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`gallery` (
  `idGallery` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(95) NOT NULL ,
  PRIMARY KEY (`idGallery`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`gallery_has_photo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`gallery_has_photo` (
  `idGalleryPhoto` INT NOT NULL AUTO_INCREMENT ,
  `idGallery` INT NOT NULL ,
  `idPhoto` INT NOT NULL ,
  PRIMARY KEY (`idGalleryPhoto`) ,
  INDEX `fk_gallery_has_photo_photo1_idx` (`idPhoto` ASC) ,
  INDEX `fk_gallery_has_photo_gallery1_idx` (`idGallery` ASC) ,
  CONSTRAINT `fk_gallery_has_photo_gallery1`
    FOREIGN KEY (`idGallery` )
    REFERENCES `eestec`.`gallery` (`idGallery` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_gallery_has_photo_photo1`
    FOREIGN KEY (`idPhoto` )
    REFERENCES `eestec`.`photo` (`idPhoto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`articleType`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`articleType` (
  `idArticleType` INT NOT NULL AUTO_INCREMENT ,
  `type` VARCHAR(95) NOT NULL ,
  PRIMARY KEY (`idArticleType`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`article_has_articleType`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`article_has_articleType` (
  `idArticle_has_articleType` INT NOT NULL AUTO_INCREMENT ,
  `idArticle` INT NOT NULL ,
  `idArticleType` INT NOT NULL ,
  PRIMARY KEY (`idArticle_has_articleType`) ,
  INDEX `fk_article_has_articleType_articleType1_idx` (`idArticleType` ASC) ,
  INDEX `fk_article_has_articleType_article1_idx` (`idArticle` ASC) ,
  CONSTRAINT `fk_article_has_articleType_article1`
    FOREIGN KEY (`idArticle` )
    REFERENCES `eestec`.`article` (`idArticle` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_article_has_articleType_articleType1`
    FOREIGN KEY (`idArticleType` )
    REFERENCES `eestec`.`articleType` (`idArticleType` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`article_has_video`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`article_has_video` (
  `idArticle_has_video` INT NOT NULL AUTO_INCREMENT ,
  `idArticle` INT NOT NULL ,
  `idVideo` INT NOT NULL ,
  INDEX `fk_article_has_video_video1_idx` (`idVideo` ASC) ,
  INDEX `fk_article_has_video_article1_idx` (`idArticle` ASC) ,
  PRIMARY KEY (`idArticle_has_video`) ,
  CONSTRAINT `fk_article_has_video_article1`
    FOREIGN KEY (`idArticle` )
    REFERENCES `eestec`.`article` (`idArticle` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_article_has_video_video1`
    FOREIGN KEY (`idVideo` )
    REFERENCES `eestec`.`video` (`idVideo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`article_has_photo_not_in_gallery`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`article_has_photo_not_in_gallery` (
  `idArticle_has_photocol` INT NOT NULL AUTO_INCREMENT ,
  `idArticle` INT NOT NULL ,
  `idPhoto` INT NOT NULL ,
  PRIMARY KEY (`idArticle_has_photocol`) ,
  INDEX `fk_article_has_photo_photo1_idx` (`idPhoto` ASC) ,
  INDEX `fk_article_has_photo_article1_idx` (`idArticle` ASC) ,
  CONSTRAINT `fk_article_has_photo_article1`
    FOREIGN KEY (`idArticle` )
    REFERENCES `eestec`.`article` (`idArticle` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_article_has_photo_photo1`
    FOREIGN KEY (`idPhoto` )
    REFERENCES `eestec`.`photo` (`idPhoto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`member_wrote_article`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`member_wrote_article` (
  `idMember_wrote_article` INT NOT NULL AUTO_INCREMENT ,
  `idUser` INT NOT NULL ,
  `idArticle` INT NOT NULL ,
  PRIMARY KEY (`idMember_wrote_article`) ,
  INDEX `fk_member_has_article_article1_idx` (`idArticle` ASC) ,
  INDEX `fk_member_has_article_member1_idx` (`idUser` ASC) ,
  CONSTRAINT `fk_member_has_article_member1`
    FOREIGN KEY (`idUser` )
    REFERENCES `eestec`.`member` (`idUser` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_member_has_article_article1`
    FOREIGN KEY (`idArticle` )
    REFERENCES `eestec`.`article` (`idArticle` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `eestec`.`article_has_gallery`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `eestec`.`article_has_gallery` (
  `idArticle_has_gallery` VARCHAR(45) NULL ,
  `article_idArticle` INT NOT NULL ,
  `gallery_idGallery` INT NOT NULL ,
  INDEX `fk_article_has_gallery_gallery1_idx` (`gallery_idGallery` ASC) ,
  INDEX `fk_article_has_gallery_article1_idx` (`article_idArticle` ASC) ,
  CONSTRAINT `fk_article_has_gallery_article1`
    FOREIGN KEY (`article_idArticle` )
    REFERENCES `eestec`.`article` (`idArticle` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_article_has_gallery_gallery1`
    FOREIGN KEY (`gallery_idGallery` )
    REFERENCES `eestec`.`gallery` (`idGallery` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `eestec` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
