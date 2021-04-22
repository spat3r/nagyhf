drop table profil_has_meal;
drop table profil;
drop table meal;


CREATE TABLE IF NOT EXISTS profil (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usr` VARCHAR(45) NOT NULL,
  `psw` VARCHAR(100) NOT NULL,
  `wt` DOUBLE NOT NULL,
  `wtg` DOUBLE NOT NULL,
  `ht` INT NOT NULL,
  `g` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)
);

CREATE TABLE IF NOT EXISTS meal (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `prot` INT NOT NULL,
  `carb` INT NOT NULL,
  `fat` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)
);

CREATE TABLE IF NOT EXISTS profil_has_meal (
	`profil_id` INT NOT NULL,
	`meal_id` INT NOT NULL,
	`gr` INT NOT NULL,
	`date` DATE NOT NULL,
	`blds_id` TINYINT(1) NOT NULL,
	PRIMARY KEY (`profil_id`, `meal_id`),
	FOREIGN KEY (`profil_id`)	REFERENCES profil (`id`)	ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (`meal_id`)		REFERENCES meal (`id`) 		ON DELETE NO ACTION ON UPDATE NO ACTION
);

/*(usr, psw, wt, wtg, ht, g ) */
INSERT INTO profil VALUES ('1','speti', 'buzi', '82.0', '85.0', '186', '1');
INSERT INTO profil VALUES ('2','anyad', 'rákos', '82.0', '85.0', '186', '1');

INSERT INTO meal VALUES ('1','borsoleves','600', '500', '100');
INSERT INTO meal VALUES ('2','hagyma','200', '300', '50');
INSERT INTO meal VALUES ('3','májkrém','400', '576', '1331');

INSERT INTO profil_has_meal VALUES ('1','1','300','2021-04-22', '1');
INSERT INTO profil_has_meal VALUES ('1','2','456','2021-04-22', '1');
INSERT INTO profil_has_meal VALUES ('1','3','213','2021-04-15', '2');
INSERT INTO profil_has_meal VALUES ('2','2','123','2021-04-13', '3');
INSERT INTO profil_has_meal VALUES ('2','3','45','2021-04-21', '0');

SELECT * FROM meal;
SELECT * FROM profil;
SELECT * FROM profil_has_meal;

/*p.id, p.usr, p.psw, p.wt, p.wtg, p.ht, p.g, h.gr, h.date, h.blds_id, m.prot, m\.carb, m\.fat*/

SELECT  * FROM profil p
inner join profil_has_meal h on p.id = h.profil_id
inner join meal m on m.id = h.meal_id;
