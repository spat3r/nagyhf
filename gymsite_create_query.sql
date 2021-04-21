CREATE TABLE IF NOT EXISTS `gymsite`.`profil` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `weight` DOUBLE NOT NULL,
  `weightgoal` DOUBLE NOT NULL,
  `height` INT NOT NULL,
  `gender` INT NOT NULL,
  `profilcol` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `gymsite`.`meal` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `prot` INT NOT NULL,
  `carb` INT NOT NULL,
  `fat` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `gymsite`.`profil_has_meal` (
  `profil_id` INT NOT NULL,
  `meal_id` INT NOT NULL,
  `gramms` INT NOT NULL,
  `date` DATETIME NOT NULL,
  `blds_id` TINYINT(1) NOT NULL,
  PRIMARY KEY (`profil_id`, `meal_id`),
  INDEX `fk_profil_has_meal_meal1_idx` (`meal_id` ASC),
  INDEX `fk_profil_has_meal_profil1_idx` (`profil_id` ASC),
  CONSTRAINT `fk_profil_has_meal_profil1`
    FOREIGN KEY (`profil_id`)
    REFERENCES `gymsite`.`profil` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profil_has_meal_meal1`
    FOREIGN KEY (`meal_id`)
    REFERENCES `gymsite`.`meal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB;