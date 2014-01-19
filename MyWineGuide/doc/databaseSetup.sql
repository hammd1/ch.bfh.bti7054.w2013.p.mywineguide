SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `secure_login` ;
CREATE SCHEMA IF NOT EXISTS `secure_login` DEFAULT CHARACTER SET utf8 ;
USE `secure_login` ;

-- -----------------------------------------------------
-- Table `secure_login`.`members`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `secure_login`.`members` ;

CREATE  TABLE IF NOT EXISTS `secure_login`.`members` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(30) NOT NULL ,
  `email` VARCHAR(50) NOT NULL ,
  `password` CHAR(128) NOT NULL ,
  `salt` CHAR(128) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `secure_login`.`login_attempts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `secure_login`.`login_attempts` ;

CREATE  TABLE IF NOT EXISTS `secure_login`.`login_attempts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `time` VARCHAR(30) NOT NULL ,
  `members_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`, `members_id`) ,
  INDEX `fk_login_attempts_members_idx` (`members_id` ASC) ,
  CONSTRAINT `fk_login_attempts_members`
    FOREIGN KEY (`members_id` )
    REFERENCES `secure_login`.`members` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

INSERT INTO `secure_login`.`members` VALUES(999, 'test_user', 'test1@example.com',
'20fe297a62c67708b722b6002f5cc567a48ecb541aae318c998a1fa55137bed4028b00348fd4e8ee1bed91fc5b756fb8fbaa3e4bdc73e38e8cd4549449bab7d0',
'b1cc517733a3be279904688fefa09506e0a3350f1f9780427bfb11de92c689c26c1b96cb43ea9e47b56e6859b21ae85134fe624195873a85432715c54a584c7d');

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `wineguide` ;
CREATE SCHEMA IF NOT EXISTS `wineguide` ;
USE `wineguide` ;

-- -----------------------------------------------------
-- Table `wineguide`.`wine`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineguide`.`wine` ;

CREATE  TABLE IF NOT EXISTS `wineguide`.`wine` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `winetype` VARCHAR(30) NOT NULL ,
  `country` VARCHAR(30) NOT NULL ,
  `region` VARCHAR(30) NOT NULL ,
  `description` VARCHAR(250) NOT NULL ,
  `year` YEAR NOT NULL ,
  `imagepath` VARCHAR(60) NOT NULL ,
  `rating` INT NULL ,
  `raiting_count` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wineguide`.`grape`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineguide`.`grape` ;

CREATE  TABLE IF NOT EXISTS `wineguide`.`grape` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wineguide`.`wine_has_grape`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineguide`.`wine_has_grape` ;

CREATE  TABLE IF NOT EXISTS `wineguide`.`wine_has_grape` (
  `wine_id` INT NOT NULL ,
  `grape_id` INT NOT NULL ,
  PRIMARY KEY (`wine_id`, `grape_id`) ,
  INDEX `fk_wine_has_grape_grape1_idx` (`grape_id` ASC) ,
  INDEX `fk_wine_has_grape_wine_idx` (`wine_id` ASC) ,
  CONSTRAINT `fk_wine_has_grape_wine`
    FOREIGN KEY (`wine_id` )
    REFERENCES `wineguide`.`wine` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wine_has_grape_grape1`
    FOREIGN KEY (`grape_id` )
    REFERENCES `wineguide`.`grape` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wineguide`.`dish`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineguide`.`dish` ;

CREATE  TABLE IF NOT EXISTS `wineguide`.`dish` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(30) NOT NULL ,
  `dishType` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wineguide`.`wine_has_dish`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineguide`.`wine_has_dish` ;

CREATE  TABLE IF NOT EXISTS `wineguide`.`wine_has_dish` (
  `wine_id` INT NOT NULL ,
  `dish_id` INT NOT NULL ,
  PRIMARY KEY (`wine_id`, `dish_id`) ,
  INDEX `fk_wine_has_dish_dish1_idx` (`dish_id` ASC) ,
  INDEX `fk_wine_has_dish_wine1_idx` (`wine_id` ASC) ,
  CONSTRAINT `fk_wine_has_dish_wine1`
    FOREIGN KEY (`wine_id` )
    REFERENCES `wineguide`.`wine` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wine_has_dish_dish1`
    FOREIGN KEY (`dish_id` )
    REFERENCES `wineguide`.`dish` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wineguide`.`food`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineguide`.`food` ;

CREATE  TABLE IF NOT EXISTS `wineguide`.`food` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wineguide`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineguide`.`user` ;

CREATE  TABLE IF NOT EXISTS `wineguide`.`user` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wineguide`.`user_has_wine`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineguide`.`user_has_wine` ;

CREATE  TABLE IF NOT EXISTS `wineguide`.`user_has_wine` (
  `user_id` INT NOT NULL ,
  `wine_id` INT NOT NULL ,
  `number` INT NOT NULL ,
  PRIMARY KEY (`user_id`, `wine_id`) ,
  INDEX `fk_user_has_wine_wine1_idx` (`wine_id` ASC) ,
  INDEX `fk_user_has_wine_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_user_has_wine_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `wineguide`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_wine_wine1`
    FOREIGN KEY (`wine_id` )
    REFERENCES `wineguide`.`wine` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wineguide`.`dish_has_food`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `wineguide`.`dish_has_food` ;

CREATE  TABLE IF NOT EXISTS `wineguide`.`dish_has_food` (
  `dish_id` INT NOT NULL ,
  `food_id` INT NOT NULL ,
  PRIMARY KEY (`dish_id`, `food_id`) ,
  INDEX `fk_dish_has_food_food1_idx` (`food_id` ASC) ,
  INDEX `fk_dish_has_food_dish1_idx` (`dish_id` ASC) ,
  CONSTRAINT `fk_dish_has_food_dish1`
    FOREIGN KEY (`dish_id` )
    REFERENCES `wineguide`.`dish` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dish_has_food_food1`
    FOREIGN KEY (`food_id` )
    REFERENCES `wineguide`.`food` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `wineguide`.`user` VALUES(999, 'test_user');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

DROP USER 'user2'@'localhost';
flush privileges;
CREATE USER 'user2'@'localhost' IDENTIFIED BY 'eKcGZr59zAa2BEWU';
GRANT SELECT, INSERT, UPDATE ON `secure_login`.* TO 'user2'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON `wineguide`.* TO 'user2'@'localhost';

INSERT INTO `wineguide`.`wine`
	VALUES(NULL,'Michel Torino Colección Winemaker Selection', 'Rotwein', 'Argentinien', 'Calchaqui Valley', 'Dunkles Rubinrot mit Violettreflexen. Intensiver Duft nach Brombeeren und schwarzem Pfeffer, wenig Tabak. Vollmundiger Körper mit weichen Tanninen und langem Abgang.', 2012, 'michel_torino_coleccin_winemaker_selection.jpg',4,2);
INSERT INTO `wineguide`.`wine`
	VALUES(NULL,'Argento Selección Malbec', 'Rotwein', 'Argentinien', 'Mendoza Valley', 'Tintenfarben. Duftet nach Kräutern, schwarzen Kirschen und Vanille. Opulenter Auftakt, dicht und fleischig im Gaumen.', 2012, 'argento_seleccin_malbec.jpg',5,1);
INSERT INTO `wineguide`.`wine`
	VALUES(NULL,'Luz de Los Andes Malbec', 'Rotwein', 'Argentinien', 'Mendoza Valley', 'Tiefes Rubinrot mit violetten Reflexen. Intensive Aromen, erinnern an Pflaumen und Brombeeren. Im Gaumen volle Fruchtaromatik, vorwiegend nach schwarzen Kirschen, und im Abgang eine leichte Schokoladennote.', 2012, 'luz_de_los_andes_malbec.jpg',3,1);
INSERT INTO `wineguide`.`wine`
	VALUES(NULL,'Centenario Merlot del Ticino DOC', 'Rotwein', 'Schweiz', 'Tessin', 'Purpurrot. Duftet nach Kirschen, Tabak und Heu. Voller Körper, lange anhaltend im Gaumen.', 2012, 'centenario_merlot_del_ticino_doc.jpg',3,1);
INSERT INTO `wineguide`.`wine`
	VALUES(NULL,'Carmelin Petite Arvine du Valais AOC', 'Weisswein', 'Schweiz', 'Wallis', 'Helles Zitronengelb. Aromen erinnern an rosa Grapefruit, Zitrus- und Passionsfrucht. Im Gaumen ausgewogen, mit einer angenehmen Fruchtsüsse. Mineralisch im Abgang.', 2012, 'carmelin_petite_arvine_du_valais_aoc.jpg',3,1);
INSERT INTO `wineguide`.`wine`
	VALUES(NULL,'Yvorne AOC Chablais', 'Weisswein', 'Schweiz', 'Waadt', 'Blasses Goldgelb. Aromen erinnern an Feuerstein und Ananas, begleitet von einer leichten Hefenote. Im Körper komplex, mit einer saftigen Säure.', 2012, 'yvorne_aoc_chablais.jpg',4,1);
INSERT INTO `wineguide`.`wine`
	VALUES(NULL,'Veuve Clicquot Ponsardin brut', 'Schaumwein', 'Frankreich', 'Champagne', 'Duftet nach Blüten, Hefegebäck und weissem Pfirsich. Voll im Körper, mit einer schön eingebundenen Mousse. Wirkt ausgewogen und lang im Finale.', 2012, 'yveuve_clicquot_ponsardin_brut.jpg',5,1);
INSERT INTO `wineguide`.`wine`
	VALUES(NULL,'Epicuro Primitivo Rosato Puglia IGT', 'Rose', 'Italien', 'Apulien', 'Kräftiges Rosa. Intensiver Duft nach roten Früchten und Kompott. Frisch im Gaumen mit saftiger Säure und lang anhaltend im Abgang.', 2012, 'epicuro_primitivo_rosato_puglia_igt.jpg',2,1);
INSERT INTO `wineguide`.`wine`
	VALUES(NULL,'Oratoire des Papes Châteauneuf-du-Pape AOC', 'Rotwein', 'Frankreich', 'Côtes-du-Rhône', 'Tiefes Rubinrot. Vielschichtig in der Nase, duftet intensiv nach Beeren, begleitet von würzigen Noten. Breit und strukturiert im Gaumen, mit runden Tanninen.', 2011, 'clos_de_loratoire_des_papes_chateauneuf_du_pape_aoc.jpg',5,1);
INSERT INTO `wineguide`.`dish`
	VALUES(NULL, 'Rahmschnitzel', 'deftig');
INSERT INTO `wineguide`.`dish`
	VALUES(NULL, 'Pizza', 'mediteran');
INSERT INTO `wineguide`.`dish`
	VALUES(NULL, 'Spaghetti', 'mediteran');
INSERT INTO `wineguide`.`wine_has_dish`
	VALUES(1, 1);
INSERT INTO `wineguide`.`wine_has_dish`
	VALUES(1, 2);
INSERT INTO `wineguide`.`wine_has_dish`
	VALUES(3, 1);
INSERT INTO `wineguide`.`wine_has_dish`
	VALUES(3, 3);
INSERT INTO `wineguide`.`wine_has_dish`
	VALUES(4, 2);
INSERT INTO `wineguide`.`wine_has_dish`
	VALUES(4, 3);
