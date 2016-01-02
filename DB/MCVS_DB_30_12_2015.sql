-- MySQL Script generated by MySQL Workbench
-- 12/30/15 17:21:05
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema mcvs_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mcvs_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mcvs_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_latvian_ci ;
USE `mcvs_db` ;

-- -----------------------------------------------------
-- Table `mcvs_db`.`auditorija`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`auditorija` (
  `idAuditorija` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `aNumursNosaukums` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `aTips` VARCHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `aAdrese` VARCHAR(70) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `aPilseta` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `aMaksimalaisStudentuSkaits` INT(11) NOT NULL COMMENT '',
  `tafele` TINYINT(1) NOT NULL COMMENT '',
  `projektors` TINYINT(1) NOT NULL COMMENT '',
  `videoKonference` TINYINT(1) NOT NULL COMMENT '',
  PRIMARY KEY (`idAuditorija`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`auditorijanoslogojums`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`auditorijanoslogojums` (
  `idAuditorijaNoslogojums` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `Auditorija_idAuditorija` INT(11) NOT NULL COMMENT '',
  `aDatums` DATE NOT NULL COMMENT '',
  `aLaiksNo` TIME NOT NULL COMMENT '',
  `aLaiksLidz` TIME NOT NULL COMMENT '',
  PRIMARY KEY (`idAuditorijaNoslogojums`, `Auditorija_idAuditorija`)  COMMENT '',
  INDEX `fk_AuditorijaNoslogojums_Auditorija1_idx` (`Auditorija_idAuditorija` ASC)  COMMENT '',
  CONSTRAINT `fk_AuditorijaNoslogojums_Auditorija1`
    FOREIGN KEY (`Auditorija_idAuditorija`)
    REFERENCES `mcvs_db`.`auditorija` (`idAuditorija`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`grupasplanosana`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`grupasplanosana` (
  `gpID` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `gpKurss` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpPasniedzejsVards` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpPasniedzejsUzvards` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpPasniedzejsPK` VARCHAR(12) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpAuditorijaAdrese` VARCHAR(70) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpAuditorijaPilseta` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpAuditorijaNumursNosaukums` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpSakumaDatums` DATE NOT NULL COMMENT '',
  `gpBeiguDatums` DATE NOT NULL COMMENT '',
  PRIMARY KEY (`gpID`)  COMMENT '')
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`kurss`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`kurss` (
  `idKurss` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `kursaKods` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `kKursaNosaukums` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `kursaApraksts` VARCHAR(300) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `nepieciesamaisAuditorijasTips` VARCHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `kMaksimalaisStudentuSkaits` INT(11) NOT NULL COMMENT '',
  `kursaIlgums` INT(11) NOT NULL COMMENT '',
  `kursaDiplomaDokuments` LONGBLOB NULL DEFAULT NULL COMMENT '',
  `kursaProgrammaDokuments` LONGBLOB NULL DEFAULT NULL COMMENT '',
  `kursaMacibuMaterialsDokuments` LONGBLOB NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`idKurss`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`macibugrupa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`macibugrupa` (
  `idMacibuGrupa` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `Kurss_idKurss` INT(11) NOT NULL COMMENT '',
  `Auditorija_idAuditorija` INT(11) NOT NULL COMMENT '',
  `mgDatumsNo` DATE NOT NULL COMMENT '',
  `mgDatumsLidz` DATE NOT NULL COMMENT '',
  PRIMARY KEY (`idMacibuGrupa`, `Kurss_idKurss`, `Auditorija_idAuditorija`)  COMMENT '',
  INDEX `fk_MacibuGrupa_Auditorija1_idx` (`Auditorija_idAuditorija` ASC)  COMMENT '',
  INDEX `fk_MacibuGrupa_Kurss1_idx` (`Kurss_idKurss` ASC)  COMMENT '',
  CONSTRAINT `fk_MacibuGrupa_Auditorija1`
    FOREIGN KEY (`Auditorija_idAuditorija`)
    REFERENCES `mcvs_db`.`auditorija` (`idAuditorija`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MacibuGrupa_Kurss1`
    FOREIGN KEY (`Kurss_idKurss`)
    REFERENCES `mcvs_db`.`kurss` (`idKurss`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`persona` (
  `idPersona` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `vards` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `uzvards` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `epasts` VARCHAR(70) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `talrunis` VARCHAR(15) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `personasKods` VARCHAR(12) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `dzivesAdrese` VARCHAR(70) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `dzivesPilseta` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `darbaAdrese` VARCHAR(70) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `darbaPilseta` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `foto` LONGBLOB NULL DEFAULT NULL COMMENT '',
  `lietotajaLoma` VARCHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `lietotajvards` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `parole` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`idPersona`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`persona_has_kurss`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`persona_has_kurss` (
  `Persona_idPersona` INT(11) NOT NULL COMMENT '',
  `Kurss_idKurss` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`Persona_idPersona`, `Kurss_idKurss`)  COMMENT '',
  INDEX `fk_Persona_has_Kurss_Kurss1_idx` (`Kurss_idKurss` ASC)  COMMENT '',
  INDEX `fk_Persona_has_Kurss_Persona1_idx` (`Persona_idPersona` ASC)  COMMENT '',
  CONSTRAINT `fk_Persona_has_Kurss_Kurss1`
    FOREIGN KEY (`Kurss_idKurss`)
    REFERENCES `mcvs_db`.`kurss` (`idKurss`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Persona_has_Kurss_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mcvs_db`.`persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`persona_has_macibugrupa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`persona_has_macibugrupa` (
  `Persona_idPersona` INT(11) NOT NULL COMMENT '',
  `MacibuGrupa_idMacibuGrupa` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`Persona_idPersona`, `MacibuGrupa_idMacibuGrupa`)  COMMENT '',
  INDEX `fk_Persona_has_MacibuGrupa_MacibuGrupa1_idx` (`MacibuGrupa_idMacibuGrupa` ASC)  COMMENT '',
  INDEX `fk_Persona_has_MacibuGrupa_Persona1_idx` (`Persona_idPersona` ASC)  COMMENT '',
  CONSTRAINT `fk_Persona_has_MacibuGrupa_MacibuGrupa1`
    FOREIGN KEY (`MacibuGrupa_idMacibuGrupa`)
    REFERENCES `mcvs_db`.`macibugrupa` (`idMacibuGrupa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Persona_has_MacibuGrupa_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mcvs_db`.`persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`personaapgutais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`personaapgutais` (
  `idPersonaApgutais` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `Persona_idPersona` INT(11) NOT NULL COMMENT '',
  `SertifikatsDiplomsKurss` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`idPersonaApgutais`, `Persona_idPersona`)  COMMENT '',
  INDEX `fk_PersonaApgutais_Persona_idx` (`Persona_idPersona` ASC)  COMMENT '',
  CONSTRAINT `fk_PersonaApgutais_Persona`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mcvs_db`.`persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`personanoslogojums`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`personanoslogojums` (
  `idPersonaNoslogojums` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `Persona_idPersona` INT(11) NOT NULL COMMENT '',
  `pDatums` DATE NOT NULL COMMENT '',
  `pLaiksNo` TIME NOT NULL COMMENT '',
  `pLaiksLidz` TIME NOT NULL COMMENT '',
  PRIMARY KEY (`idPersonaNoslogojums`, `Persona_idPersona`)  COMMENT '',
  INDEX `fk_PersonaNoslogojums_Persona1_idx` (`Persona_idPersona` ASC)  COMMENT '',
  CONSTRAINT `fk_PersonaNoslogojums_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mcvs_db`.`persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`grupasPlanosanaStudenti`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`grupasPlanosanaStudenti` (
  `gpsID` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `grupasplanosana_gpID` INT(11) NOT NULL COMMENT '',
  `gpsVards` VARCHAR(25) NOT NULL COMMENT '',
  `gpsUzvards` VARCHAR(25) NOT NULL COMMENT '',
  `gpsPK` VARCHAR(12) NOT NULL COMMENT '',
  PRIMARY KEY (`gpsID`, `grupasplanosana_gpID`)  COMMENT '',
  INDEX `fk_grupasPlanosanaStudenti_grupasplanosana1_idx` (`grupasplanosana_gpID` ASC)  COMMENT '',
  CONSTRAINT `fk_grupasPlanosanaStudenti_grupasplanosana1`
    FOREIGN KEY (`grupasplanosana_gpID`)
    REFERENCES `mcvs_db`.`grupasplanosana` (`gpID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mcvs_db`.`Auditorija`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`Auditorija` (
  `idAuditorija` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `aNumursNosaukums` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `aTips` VARCHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `aAdrese` VARCHAR(70) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `aPilseta` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `aMaksimalaisStudentuSkaits` INT(11) NOT NULL COMMENT '',
  `tafele` TINYINT(1) NOT NULL COMMENT '',
  `projektors` TINYINT(1) NOT NULL COMMENT '',
  `videoKonference` TINYINT(1) NOT NULL COMMENT '',
  PRIMARY KEY (`idAuditorija`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`AuditorijaNoslogojums`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`AuditorijaNoslogojums` (
  `idAuditorijaNoslogojums` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `Auditorija_idAuditorija` INT(11) NOT NULL COMMENT '',
  `aDatums` DATE NOT NULL COMMENT '',
  `aLaiksNo` TIME NOT NULL COMMENT '',
  `aLaiksLidz` TIME NOT NULL COMMENT '',
  PRIMARY KEY (`idAuditorijaNoslogojums`, `Auditorija_idAuditorija`)  COMMENT '',
  INDEX `fk_AuditorijaNoslogojums_Auditorija1_idx` (`Auditorija_idAuditorija` ASC)  COMMENT '',
  CONSTRAINT `fk_AuditorijaNoslogojums_Auditorija1`
    FOREIGN KEY (`Auditorija_idAuditorija`)
    REFERENCES `mcvs_db`.`Auditorija` (`idAuditorija`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`GrupasPlanosana`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`GrupasPlanosana` (
  `gpID` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `gpKurss` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpPasniedzejsVards` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpPasniedzejsUzvards` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpPasniedzejsPK` VARCHAR(12) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpAuditorijaAdrese` VARCHAR(70) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpAuditorijaPilseta` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpAuditorijaNumursNosaukums` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpSakumaDatums` DATE NOT NULL COMMENT '',
  `gpBeiguDatums` DATE NOT NULL COMMENT '',
  PRIMARY KEY (`gpID`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`GrupasPlanosanaStudenti`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`GrupasPlanosanaStudenti` (
  `gpsID` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `grupasplanosana_gpID` INT(11) NOT NULL COMMENT '',
  `gpsVards` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpsUzvards` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `gpsPK` VARCHAR(12) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`gpsID`, `grupasplanosana_gpID`)  COMMENT '',
  INDEX `fk_grupasPlanosanaStudenti_grupasplanosana1_idx` (`grupasplanosana_gpID` ASC)  COMMENT '',
  CONSTRAINT `fk_grupasPlanosanaStudenti_grupasplanosana1`
    FOREIGN KEY (`grupasplanosana_gpID`)
    REFERENCES `mcvs_db`.`GrupasPlanosana` (`gpID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`Kurss`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`Kurss` (
  `idKurss` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `kursaKods` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `kKursaNosaukums` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `kursaApraksts` VARCHAR(300) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `nepieciesamaisAuditorijasTips` VARCHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `kMaksimalaisStudentuSkaits` INT(11) NOT NULL COMMENT '',
  `kursaIlgums` INT(11) NOT NULL COMMENT '',
  `kursaDiplomaDokuments` LONGBLOB NULL DEFAULT NULL COMMENT '',
  `kursaProgrammaDokuments` LONGBLOB NULL DEFAULT NULL COMMENT '',
  `kursaMacibuMaterialsDokuments` LONGBLOB NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`idKurss`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`MacibuGrupa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`MacibuGrupa` (
  `idMacibuGrupa` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `Kurss_idKurss` INT(11) NOT NULL COMMENT '',
  `Auditorija_idAuditorija` INT(11) NOT NULL COMMENT '',
  `mgDatumsNo` DATE NOT NULL COMMENT '',
  `mgDatumsLidz` DATE NOT NULL COMMENT '',
  PRIMARY KEY (`idMacibuGrupa`, `Kurss_idKurss`, `Auditorija_idAuditorija`)  COMMENT '',
  INDEX `fk_MacibuGrupa_Auditorija1_idx` (`Auditorija_idAuditorija` ASC)  COMMENT '',
  INDEX `fk_MacibuGrupa_Kurss1_idx` (`Kurss_idKurss` ASC)  COMMENT '',
  CONSTRAINT `fk_MacibuGrupa_Auditorija1`
    FOREIGN KEY (`Auditorija_idAuditorija`)
    REFERENCES `mcvs_db`.`Auditorija` (`idAuditorija`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_MacibuGrupa_Kurss1`
    FOREIGN KEY (`Kurss_idKurss`)
    REFERENCES `mcvs_db`.`Kurss` (`idKurss`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`Persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`Persona` (
  `idPersona` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `vards` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `uzvards` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `epasts` VARCHAR(70) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `talrunis` VARCHAR(15) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `personasKods` VARCHAR(12) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `dzivesAdrese` VARCHAR(70) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `dzivesPilseta` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `darbaAdrese` VARCHAR(70) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `darbaPilseta` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `foto` LONGBLOB NULL DEFAULT NULL COMMENT '',
  `lietotajaLoma` VARCHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `lietotajvards` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  `parole` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`idPersona`)  COMMENT '')
ENGINE = InnoDB
AUTO_INCREMENT = 22
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`PersonaApgutais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`PersonaApgutais` (
  `idPersonaApgutais` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `Persona_idPersona` INT(11) NOT NULL COMMENT '',
  `SertifikatsDiplomsKurss` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_latvian_ci' NOT NULL COMMENT '',
  PRIMARY KEY (`idPersonaApgutais`, `Persona_idPersona`)  COMMENT '',
  INDEX `fk_PersonaApgutais_Persona_idx` (`Persona_idPersona` ASC)  COMMENT '',
  CONSTRAINT `fk_PersonaApgutais_Persona`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mcvs_db`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`PersonaNoslogojums`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`PersonaNoslogojums` (
  `idPersonaNoslogojums` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `Persona_idPersona` INT(11) NOT NULL COMMENT '',
  `pDatums` DATE NOT NULL COMMENT '',
  `pLaiksNo` TIME NOT NULL COMMENT '',
  `pLaiksLidz` TIME NOT NULL COMMENT '',
  PRIMARY KEY (`idPersonaNoslogojums`, `Persona_idPersona`)  COMMENT '',
  INDEX `fk_PersonaNoslogojums_Persona1_idx` (`Persona_idPersona` ASC)  COMMENT '',
  CONSTRAINT `fk_PersonaNoslogojums_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mcvs_db`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`Persona_has_Kurss`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`Persona_has_Kurss` (
  `Persona_idPersona` INT(11) NOT NULL COMMENT '',
  `Kurss_idKurss` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`Persona_idPersona`, `Kurss_idKurss`)  COMMENT '',
  INDEX `fk_Persona_has_Kurss_Kurss1_idx` (`Kurss_idKurss` ASC)  COMMENT '',
  INDEX `fk_Persona_has_Kurss_Persona1_idx` (`Persona_idPersona` ASC)  COMMENT '',
  CONSTRAINT `fk_Persona_has_Kurss_Kurss1`
    FOREIGN KEY (`Kurss_idKurss`)
    REFERENCES `mcvs_db`.`Kurss` (`idKurss`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Persona_has_Kurss_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mcvs_db`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


-- -----------------------------------------------------
-- Table `mcvs_db`.`Persona_has_MacibuGrupa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mcvs_db`.`Persona_has_MacibuGrupa` (
  `Persona_idPersona` INT(11) NOT NULL COMMENT '',
  `MacibuGrupa_idMacibuGrupa` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`Persona_idPersona`, `MacibuGrupa_idMacibuGrupa`)  COMMENT '',
  INDEX `fk_Persona_has_MacibuGrupa_MacibuGrupa1_idx` (`MacibuGrupa_idMacibuGrupa` ASC)  COMMENT '',
  INDEX `fk_Persona_has_MacibuGrupa_Persona1_idx` (`Persona_idPersona` ASC)  COMMENT '',
  CONSTRAINT `fk_Persona_has_MacibuGrupa_MacibuGrupa1`
    FOREIGN KEY (`MacibuGrupa_idMacibuGrupa`)
    REFERENCES `mcvs_db`.`MacibuGrupa` (`idMacibuGrupa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Persona_has_MacibuGrupa_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mcvs_db`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_latvian_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
