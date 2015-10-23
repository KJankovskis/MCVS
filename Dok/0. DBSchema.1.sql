SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `ReservationDB` ;
CREATE SCHEMA IF NOT EXISTS `ReservationDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `ReservationDB` ;

-- -----------------------------------------------------
-- Table `ReservationDB`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ReservationDB`.`User` ;

CREATE TABLE IF NOT EXISTS `ReservationDB`.`User` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(45) NULL,
  `lastName` VARCHAR(45) NULL,
  `role` TINYINT(4) NOT NULL DEFAULT 0,
  `userName` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE INDEX `userName_UNIQUE` (`userName` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ReservationDB`.`Building`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ReservationDB`.`Building` ;

CREATE TABLE IF NOT EXISTS `ReservationDB`.`Building` (
  `idBuilding` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `floors` INT(11) NULL,
  PRIMARY KEY (`idBuilding`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ReservationDB`.`Auditorium`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ReservationDB`.`Auditorium` ;

CREATE TABLE IF NOT EXISTS `ReservationDB`.`Auditorium` (
  `idAuditorium` INT NOT NULL AUTO_INCREMENT,
  `Building_idBuilding` INT NOT NULL,
  `floor` INT(11) NULL,
  `number` INT(11) NULL,
  `maxCapacity` INT(11) NULL,
  `isComputerClass` TINYINT(1) NULL DEFAULT 0,
  `hasBlackboard` TINYINT(1) NULL DEFAULT 0,
  `hasProjector` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`idAuditorium`),
  INDEX `fk_Auditorium_Building1_idx` (`Building_idBuilding` ASC),
  CONSTRAINT `fk_Auditorium_Building1`
    FOREIGN KEY (`Building_idBuilding`)
    REFERENCES `ReservationDB`.`Building` (`idBuilding`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ReservationDB`.`Reservation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ReservationDB`.`Reservation` ;

CREATE TABLE IF NOT EXISTS `ReservationDB`.`Reservation` (
  `idReserv` INT NOT NULL AUTO_INCREMENT,
  `Auditorium_idAuditorium` INT NOT NULL,
  `User_idUser` INT NOT NULL,
  `timeFrom` TIME NULL,
  `timeTo` TIME NULL,
  `dateFrom` DATE NULL,
  `dateTo` DATE NULL,
  PRIMARY KEY (`idReserv`, `Auditorium_idAuditorium`, `User_idUser`),
  INDEX `fk_Reservation_Auditorium_idx` (`Auditorium_idAuditorium` ASC),
  INDEX `fk_Reservation_User1_idx` (`User_idUser` ASC),
  CONSTRAINT `fk_Reservation_Auditorium`
    FOREIGN KEY (`Auditorium_idAuditorium`)
    REFERENCES `ReservationDB`.`Auditorium` (`idAuditorium`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reservation_User1`
    FOREIGN KEY (`User_idUser`)
    REFERENCES `ReservationDB`.`User` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `ReservationDB`.`User`
-- -----------------------------------------------------
START TRANSACTION;
USE `ReservationDB`;
INSERT INTO `ReservationDB`.`User` (`idUser`, `firstName`, `lastName`, `role`, `userName`, `password`) VALUES (1, 'Janis', 'Sniegs', 2, 'sniegs', 'parole');
INSERT INTO `ReservationDB`.`User` (`idUser`, `firstName`, `lastName`, `role`, `userName`, `password`) VALUES (2, 'Sniedzis', 'Pasniedzis', 1, 'pasniedzis', 'parole');
INSERT INTO `ReservationDB`.`User` (`idUser`, `firstName`, `lastName`, `role`, `userName`, `password`) VALUES (3, 'Atvars', 'Sliede', 1, 'sliede', 'parole');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ReservationDB`.`Building`
-- -----------------------------------------------------
START TRANSACTION;
USE `ReservationDB`;
INSERT INTO `ReservationDB`.`Building` (`idBuilding`, `name`, `floors`) VALUES (1, 'A', 1);
INSERT INTO `ReservationDB`.`Building` (`idBuilding`, `name`, `floors`) VALUES (2, 'B', 2);
INSERT INTO `ReservationDB`.`Building` (`idBuilding`, `name`, `floors`) VALUES (3, 'C', 3);
INSERT INTO `ReservationDB`.`Building` (`idBuilding`, `name`, `floors`) VALUES (4, 'D', 4);

COMMIT;


-- -----------------------------------------------------
-- Data for table `ReservationDB`.`Auditorium`
-- -----------------------------------------------------
START TRANSACTION;
USE `ReservationDB`;
INSERT INTO `ReservationDB`.`Auditorium` (`idAuditorium`, `Building_idBuilding`, `floor`, `number`, `maxCapacity`, `isComputerClass`, `hasBlackboard`, `hasProjector`) VALUES (1, 1, 1, 1, 23, 1, 1, 1);
INSERT INTO `ReservationDB`.`Auditorium` (`idAuditorium`, `Building_idBuilding`, `floor`, `number`, `maxCapacity`, `isComputerClass`, `hasBlackboard`, `hasProjector`) VALUES (2, 2, 1, 1, 98, 0, 1, 1);
INSERT INTO `ReservationDB`.`Auditorium` (`idAuditorium`, `Building_idBuilding`, `floor`, `number`, `maxCapacity`, `isComputerClass`, `hasBlackboard`, `hasProjector`) VALUES (3, 2, 1, 4, 15, 0, 1, 0);
INSERT INTO `ReservationDB`.`Auditorium` (`idAuditorium`, `Building_idBuilding`, `floor`, `number`, `maxCapacity`, `isComputerClass`, `hasBlackboard`, `hasProjector`) VALUES (4, 4, 2, 6, 30, 1, 1, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `ReservationDB`.`Reservation`
-- -----------------------------------------------------
START TRANSACTION;
USE `ReservationDB`;
INSERT INTO `ReservationDB`.`Reservation` (`idReserv`, `Auditorium_idAuditorium`, `User_idUser`, `timeFrom`, `timeTo`, `dateFrom`, `dateTo`) VALUES (1, 1, 2, '12:00:00', '13:00:00', '2015-07-20', '2015-07-20');
INSERT INTO `ReservationDB`.`Reservation` (`idReserv`, `Auditorium_idAuditorium`, `User_idUser`, `timeFrom`, `timeTo`, `dateFrom`, `dateTo`) VALUES (2, 2, 2, '12:00:00', '13:00:00', '2015-07-20', '2015-07-20');
INSERT INTO `ReservationDB`.`Reservation` (`idReserv`, `Auditorium_idAuditorium`, `User_idUser`, `timeFrom`, `timeTo`, `dateFrom`, `dateTo`) VALUES (3, 1, 2, '14:00:00', '15:00:00', '2015-07-20', '2015-07-20');
INSERT INTO `ReservationDB`.`Reservation` (`idReserv`, `Auditorium_idAuditorium`, `User_idUser`, `timeFrom`, `timeTo`, `dateFrom`, `dateTo`) VALUES (4, 3, 1, '11:00:00', '17:00:00', '2015-07-20', '2015-07-20');
INSERT INTO `ReservationDB`.`Reservation` (`idReserv`, `Auditorium_idAuditorium`, `User_idUser`, `timeFrom`, `timeTo`, `dateFrom`, `dateTo`) VALUES (5, 4, 1, '09:00:00', '16:00:00', '2015-07-21', '2015-08-20');

COMMIT;

