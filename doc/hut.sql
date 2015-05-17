SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `osmpoll` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `osmpoll` ;

-- -----------------------------------------------------
-- Table `osmpoll`.`hut`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osmpoll`.`hut` ;

CREATE TABLE IF NOT EXISTS `osmpoll`.`hut` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` MEDIUMTEXT NOT NULL,
  `created_by` VARCHAR(255) NOT NULL,
  `created_osmid` INT(11) NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `osmpoll`.`hut_image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osmpoll`.`hut_image` ;

CREATE TABLE IF NOT EXISTS `osmpoll`.`hut_image` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `hut_id` INT(11) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_hut_image_1_idx` (`hut_id` ASC),
  CONSTRAINT `fk_hut_image_1`
    FOREIGN KEY (`hut_id`)
    REFERENCES `osmpoll`.`hut` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `osmpoll`.`hut_tags`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osmpoll`.`hut_tags` ;

CREATE TABLE IF NOT EXISTS `osmpoll`.`hut_tags` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `hut_id` INT(11) NOT NULL,
  `tagkey` VARCHAR(255) NOT NULL,
  `tagvalue` VARCHAR(255) NOT NULL,
  `created_by` VARCHAR(255) NOT NULL,
  `created_osmid` INT(11) NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_hut_tags_1_idx` (`hut_id` ASC),
  UNIQUE INDEX `tagkey_tagvalue_UNIQUE` (`hut_id` ASC, `tagkey` ASC, `tagvalue` ASC),
  CONSTRAINT `fk_hut_tags_1`
    FOREIGN KEY (`hut_id`)
    REFERENCES `osmpoll`.`hut` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `osmpoll`.`hut_subtags`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osmpoll`.`hut_subtags` ;

CREATE TABLE IF NOT EXISTS `osmpoll`.`hut_subtags` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `parent_hut_tag_id` INT(11) NOT NULL,
  `tagkey` VARCHAR(255) NOT NULL,
  `tagvalue` VARCHAR(255) NOT NULL,
  `created_by` VARCHAR(255) NOT NULL,
  `created_osmid` INT(11) NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `tagkey_tagvalue_UNIQUE` (`parent_hut_tag_id` ASC, `tagkey` ASC, `tagvalue` ASC),
  CONSTRAINT `fk_hut_tags_1`
    FOREIGN KEY (`parent_hut_tag_id`)
    REFERENCES `osmpoll`.`hut_tags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `osmpoll`.`hut_tags_voting`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osmpoll`.`hut_tags_voting` ;

CREATE TABLE IF NOT EXISTS `osmpoll`.`hut_tags_voting` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `hut_tags_id` INT(11) NOT NULL,
  `voting` TINYINT NOT NULL DEFAULT 0,
  `created_by` VARCHAR(255) NOT NULL,
  `created_osmid` INT(11) NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_hut_tags_voting_1_idx` (`hut_tags_id` ASC),
  UNIQUE INDEX `hut_tags_id_created_osmid_UNIQUE` (`hut_tags_id` ASC, `created_osmid` ASC),
  CONSTRAINT `fk_hut_tags_voting_1`
    FOREIGN KEY (`hut_tags_id`)
    REFERENCES `osmpoll`.`hut_tags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_hut_subtags_voting_1`
    FOREIGN KEY (`hut_tags_id`)
    REFERENCES `osmpoll`.`hut_subtags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `osmpoll`.`hut_tags_comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osmpoll`.`hut_tags_comment` ;

CREATE TABLE IF NOT EXISTS `osmpoll`.`hut_tags_comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `hut_tags_id` INT(11) NOT NULL,
  `comment` MEDIUMTEXT NOT NULL,
  `created_by` VARCHAR(255) NOT NULL,
  `created_osmid` INT(11) NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_hut_tags_comment_1_idx` (`hut_tags_id` ASC),
  CONSTRAINT `fk_hut_tags_comment_1`
    FOREIGN KEY (`hut_tags_id`)
    REFERENCES `osmpoll`.`hut_tags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_hut_subtags_comment_1`
    FOREIGN KEY (`hut_tags_id`)
    REFERENCES `osmpoll`.`hut_subtags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `osmpoll`.`hut_comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `osmpoll`.`hut_comment` ;

CREATE TABLE IF NOT EXISTS `osmpoll`.`hut_comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `hut_id` INT(11) NOT NULL,
  `comment` MEDIUMTEXT NOT NULL,
  `created_by` VARCHAR(255) NOT NULL,
  `created_osmid` INT(11) NOT NULL,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_hut_comment_1_idx` (`hut_id` ASC),
  CONSTRAINT `fk_hut_comment_1`
    FOREIGN KEY (`hut_id`)
    REFERENCES `osmpoll`.`hut` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
