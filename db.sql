-- -----------------------------------------------------
-- Table `newindex`.`Keywords`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `newindex`.`Keywords` (
  `id` MEDIUMINT ZEROFILL NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = cp1251
COLLATE = cp1251_general_ci;


-- -----------------------------------------------------
-- Table `newindex`.`Domains`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `newindex`.`Domains` (
  `id` MEDIUMINT ZEROFILL NOT NULL ,
  `domain` VARCHAR(48) NOT NULL ,
  `org` VARCHAR(255) NOT NULL ,
  `state` VARCHAR(255) NOT NULL ,
  `created` TIMESTAMP NOT NULL ,
  `paid_till` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `created` (`created` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = cp1251
COLLATE = cp1251_general_ci;


-- -----------------------------------------------------
-- Table `newindex`.`Sites`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `newindex`.`Sites` (
  `id` MEDIUMINT ZEROFILL NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(48) NOT NULL ,
  `info` VARCHAR(255) NOT NULL ,
  `domain_create` TIMESTAMP NOT NULL ,
  `ref_domain` MEDIUMINT ZEROFILL NOT NULL ,
  `date` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `site` USING BTREE (`name` ASC, `domain_create` ASC) ,
  INDEX `fk_domen` (`ref_domain` ASC) ,
  CONSTRAINT `fk_domen`
    FOREIGN KEY (`ref_domain` )
    REFERENCES `newindex`.`Domains` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = cp1251
COLLATE = cp1251_general_ci;


-- -----------------------------------------------------
-- Table `newindex`.`Urls`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `newindex`.`Urls` (
  `id` INT ZEROFILL NOT NULL AUTO_INCREMENT ,
  `url` TEXT NOT NULL ,
  `ref_site` MEDIUMINT ZEROFILL NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_site` (`ref_site` ASC) ,
  CONSTRAINT `fk_site`
    FOREIGN KEY (`ref_site` )
    REFERENCES `newindex`.`Sites` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = cp1251
COLLATE = cp1251_general_ci;


-- -----------------------------------------------------
-- Table `newindex`.`Positions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `newindex`.`Positions` (
  `ref_keyword` MEDIUMINT ZEROFILL NOT NULL ,
  `ref_url` INT ZEROFILL NOT NULL ,
  `ref_site` MEDIUMINT ZEROFILL NOT NULL ,
  `pos` TINYINT ZEROFILL NOT NULL ,
  `pos_dot` TINYINT ZEROFILL NOT NULL ,
  `links_search` TINYINT(1)  NOT NULL ,
  `date` TIMESTAMP NOT NULL ,
  INDEX `pos` (`pos` ASC, `pos_dot` ASC) ,
  INDEX `fk_site` (`ref_site` ASC) ,
  INDEX `fk_url` (`ref_url` ASC) ,
  INDEX `fk_keyword` (`ref_keyword` ASC) ,
  CONSTRAINT `fk_site`
    FOREIGN KEY (`ref_site` )
    REFERENCES `newindex`.`Sites` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_url`
    FOREIGN KEY (`ref_url` )
    REFERENCES `newindex`.`Urls` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_keyword`
    FOREIGN KEY (`ref_keyword` )
    REFERENCES `newindex`.`Keywords` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = cp1251
COLLATE = cp1251_general_ci;


-- -----------------------------------------------------
-- Table `newindex`.`Updates`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `newindex`.`Updates` (
  `id` SMALLINT ZEROFILL NOT NULL ,
  `date` TIMESTAMP NOT NULL ,
  `count_changes` MEDIUMINT ZEROFILL NOT NULL ,
  `count_keywords` MEDIUMINT ZEROFILL NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = cp1251
COLLATE = cp1251_general_ci;


-- -----------------------------------------------------
-- Table `newindex`.`Ns`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `newindex`.`Ns` (
  `id` MEDIUMINT ZEROFILL NOT NULL ,
  `ns_server` VARCHAR(48) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = cp1251
COLLATE = cp1251_general_ci;


-- -----------------------------------------------------
-- Table `newindex`.`Dns`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `newindex`.`Dns` (
  `ref_domain` MEDIUMINT ZEROFILL NOT NULL ,
  `ref_ns` MEDIUMINT ZEROFILL NOT NULL ,
  INDEX `fk_domain` (`ref_domain` ASC) ,
  INDEX `fk_ns` (`ref_ns` ASC) ,
  CONSTRAINT `fk_domain`
    FOREIGN KEY (`ref_domain` )
    REFERENCES `newindex`.`Domains` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ns`
    FOREIGN KEY (`ref_ns` )
    REFERENCES `newindex`.`Ns` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = cp1251
COLLATE = cp1251_general_ci;


