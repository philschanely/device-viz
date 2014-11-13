SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `deviceviz`.`Status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deviceviz`.`Status` (
  `status_id` INT(1) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL,
  `order` INT(1) NOT NULL,
  PRIMARY KEY (`status_id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  UNIQUE INDEX `order_UNIQUE` (`order` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deviceviz`.`Access_Level`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deviceviz`.`Access_Level` (
  `access_level_id` INT(1) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(32) NOT NULL,
  `order` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`access_level_id`),
  UNIQUE INDEX `order_UNIQUE` (`order` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deviceviz`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deviceviz`.`User` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `access_level` INT NOT NULL,
  `status` INT NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `Status_idx` (`status` ASC),
  INDEX `Access Level_idx` (`access_level` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deviceviz`.`Site_Profile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deviceviz`.`Site_Profile` (
  `site_id` INT NOT NULL AUTO_INCREMENT,
  `owner` INT NOT NULL,
  `name` VARCHAR(32) NOT NULL,
  `url` VARCHAR(128) NOT NULL,
  `description` TEXT NULL,
  PRIMARY KEY (`site_id`),
  INDEX `Owner_idx` (`owner` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deviceviz`.`Data Period`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deviceviz`.`Data Period` (
  `period_id` INT NOT NULL AUTO_INCREMENT,
  `site` INT NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  `author` INT NOT NULL,
  PRIMARY KEY (`period_id`),
  INDEX `Site_idx` (`site` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deviceviz`.`Data_Point`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deviceviz`.`Data_Point` (
  `data_point_id` INT NOT NULL AUTO_INCREMENT,
  `period` INT NOT NULL,
  `width` INT(4) NOT NULL,
  `height` INT(4) NOT NULL,
  `url` VARCHAR(128) NOT NULL,
  `sessions` INT(10) NOT NULL,
  `avg_duration` FLOAT(6,2) NOT NULL,
  `avg_pages` FLOAT(3,2) NOT NULL,
  PRIMARY KEY (`data_point_id`),
  INDEX `Data Period_idx` (`period` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deviceviz`.`Icon`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deviceviz`.`Icon` (
  `icon_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(16) NOT NULL,
  PRIMARY KEY (`icon_id`))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deviceviz`.`Device_Group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deviceviz`.`Device_Group` (
  `group_id` INT NOT NULL AUTO_INCREMENT,
  `site` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `icon` INT NOT NULL,
  `min_width` INT(4) NOT NULL DEFAULT 0,
  `max_width` INT(4) NOT NULL DEFAULT 9999,
  `order` INT(2) NOT NULL,
  `allow_portrait` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`group_id`),
  INDEX `Site Profile_idx` (`site` ASC),
  INDEX `Icon_idx` (`icon` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deviceviz`.`Site_Collaborator`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deviceviz`.`Site_Collaborator` (
  `collaborator` INT NOT NULL,
  `site` INT NOT NULL,
  PRIMARY KEY (`collaborator`, `site`),
  INDEX `Site_idx` (`site` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `deviceviz`.`Aggregate_Range`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deviceviz`.`Aggregate_Range` (
  `range_id` INT NOT NULL AUTO_INCREMENT,
  `period` INT NOT NULL,
  `min_sessions` INT(10) NOT NULL DEFAULT 0,
  `max_sessoins` INT(10) NOT NULL DEFAULT 1000000,
  PRIMARY KEY (`range_id`),
  INDEX `Period_idx` (`period` ASC))
ENGINE = MyISAM;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
