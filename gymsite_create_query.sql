drop table profil_has_meal;
drop table profil;
drop table meal;


CREATE TABLE IF NOT EXISTS profil (
    `id` INT NOT NULL AUTO_INCREMENT,
    `usr` VARCHAR(45) NOT NULL,
    `psw` VARCHAR(100) NOT NULL,
    `age` INT NOT NULL,
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
	`hid` INT NOT NULL AUTO_INCREMENT,
	`profil_id` INT NOT NULL,
	`meal_id` INT NOT NULL,
	`gr` INT NOT NULL,
	`date` DATE NOT NULL,
	`blds_id` TINYINT(1) NOT NULL,
    PRIMARY KEY (`hid`),
	FOREIGN KEY (`profil_id`)	REFERENCES profil (`id`)	ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (`meal_id`)		REFERENCES meal (`id`) 		ON DELETE NO ACTION ON UPDATE NO ACTION
);

/*(usr, psw, wt, wtg, ht, g ) */
INSERT INTO profil VALUES ('1','speti', 'a0d8461391e8a7e40d5be6c9ddf24f2f','21', '82.0', '85.0', '186', '1');

INSERT INTO meal VALUES ('1','borsoleves','600', '500', '100');
INSERT INTO meal VALUES ('2','hagyma','200', '300', '50');
INSERT INTO meal VALUES ('3','májkrém','400', '576', '133');
INSERT INTO meal VALUES ('4','babgulyás','159', '357', '369');
INSERT INTO meal VALUES ('5','bolognai penne','453', '147', '258');
INSERT INTO meal VALUES ('6','banán','245', '576', '456');
INSERT INTO meal VALUES ('7','csirke rizs','365', '147', '456');
INSERT INTO meal VALUES ('8','rakott tészta','200', '86', '50');
INSERT INTO meal VALUES ('9','kóla','545', '258', '963');
INSERT INTO meal VALUES ('10','hot dog','122', '534', '576');
INSERT INTO meal VALUES ('11','hambi','676', '345', '567');
INSERT INTO meal VALUES ('12','húsleves','345', '159', '456');

INSERT INTO profil_has_meal VALUES ('1  ','1','1','300','2021-04-22', '1');
INSERT INTO profil_has_meal VALUES (' 2 ','1','2','456','2021-04-22', '1');
INSERT INTO profil_has_meal VALUES (' 3 ','1','3','213','2021-04-15', '2');
INSERT INTO profil_has_meal VALUES (' 4 ','2','2','123','2021-04-13', '3');
INSERT INTO profil_has_meal VALUES (' 5 ','1','3','453','2021-04-27', '0');
INSERT INTO profil_has_meal VALUES (' 6 ','1','4','354','2021-04-27', '1');
INSERT INTO profil_has_meal VALUES (' 7 ','1','5','786','2021-04-27', '2');
INSERT INTO profil_has_meal VALUES (' 8 ','1','6','123','2021-04-27', '3');
INSERT INTO profil_has_meal VALUES (' 9 ','1','7','354','2021-04-27', '1');
INSERT INTO profil_has_meal VALUES (' 10 ','1','8','123','2021-04-27', '2');
INSERT INTO profil_has_meal VALUES ('11  ','1','9','254','2021-04-27', '0');
INSERT INTO profil_has_meal VALUES (' 12 ','1','10','123','2021-04-27', '3');
INSERT INTO profil_has_meal VALUES ('  13','1','11','254','2021-04-27', '4');

SELECT * FROM meal;
SELECT * FROM profil;
SELECT * FROM profil_has_meal;

/*p.id, p.usr, p.psw, p.wt, p.wtg, p.ht, p.g, h.gr, h.date, h.blds_id, m.prot, m\.carb, m\.fat*/

SELECT *  FROM profil p inner join profil_has_meal h on p.id = h.profil_id inner join meal m on m.id = h.meal_id;

/*  KALÓRIA */
SELECT p.age as age, p.wt as wt, p.wtg as wtg, p.ht as ht, p.g as g  FROM profil p inner join profil_has_meal h on p.id = h.profil_id where p.usr = 'speti' AND h.date='2021-04-22' group by p.id;


SELECT h.blds_id, m.prot, m.carb, m.fat  FROM profil p inner join profil_has_meal h on p.id = h.profil_id inner join meal m on m.id = h.meal_id where p.usr = 'speti' AND h.date='2021-04-22';
/*consumed macro*/
SELECT sum(m.prot/1000*h.gr) as prot, sum(m.carb/1000*h.gr) as carb, sum(m.fat/1000*h.gr) as fat FROM profil p inner join profil_has_meal h on p.id = h.profil_id inner join meal m on m.id = h.meal_id where p.usr = 'speti' AND h.date='2021-04-26';
/*profil*/
SELECT p.age as age, p.wt as wt, p.wtg as wtg, p.ht as ht, p.g as g  FROM profil p inner join profil_has_meal h on p.id = h.profil_id  where p.usr LIKE 'speti' group by p.id;
