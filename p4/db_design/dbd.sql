SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb`;

-- -----------------------------------------------------
-- Table `mydb`.`User`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`User` (
  `userId` VARCHAR(50) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`userId`) )
;


-- -----------------------------------------------------
-- Table `mydb`.`Candidate`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Candidate` (
  `candidateId` VARCHAR(45) NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `lastName` VARCHAR(45) NULL ,
  `telephone` INT NULL ,
  `address` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  PRIMARY KEY (`candidateId`) ,
  INDEX `fk_Candidate_User` (`candidateId` ASC) ,
  CONSTRAINT `fk_Candidate_User`
    FOREIGN KEY (`candidateId` )
    REFERENCES `mydb`.`User` (`userId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


-- -----------------------------------------------------
-- Table `mydb`.`Employeer`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Employeer` (
  `employeerId` VARCHAR(45) NOT NULL ,
  `companyName` VARCHAR(45) NULL ,
  `address` VARCHAR(120) NULL ,
  `telephone` INT NULL ,
  `email` VARCHAR(45) NULL ,
  PRIMARY KEY (`employeerId`) ,
  CONSTRAINT `fk_Candidate_User`
    FOREIGN KEY (`employeerId` )
    REFERENCES `mydb`.`User` (`userId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


-- -----------------------------------------------------
-- Table `mydb`.`Verificator`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Verificator` (
  `verificatorId` VARCHAR(50) NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `lastName` VARCHAR(45) NULL ,
  PRIMARY KEY (`verificatorId`) ,
  INDEX `fk_Candidate_User` (`verificatorId` ASC) ,
  CONSTRAINT `fk_Candidate_User`
    FOREIGN KEY (`verificatorId` )
    REFERENCES `mydb`.`User` (`userId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


-- -----------------------------------------------------
-- Table `mydb`.`ProfessionalData`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`ProfessionalData` (
  `candidateId` VARCHAR(45) NOT NULL ,
  `company` VARCHAR(45) NOT NULL ,
  `iniDate` DATE NOT NULL ,
  `endDate` DATE NULL ,
  `position` VARCHAR(45) NULL ,
  `companyAddress` VARCHAR(120) NULL ,
  `state` ENUM('procesing','verified','notVerified') NULL ,
  `verificatorId` VARCHAR(50) NULL ,
  PRIMARY KEY (`candidateId`, `company`, `iniDate`) ,
  INDEX `fk_ProfessionalData_Candidate` (`candidateId` ASC) ,
  INDEX `fk_ProfessionalData_Verificator` (`verificatorId` ASC) ,
  CONSTRAINT `fk_ProfessionalData_Candidate`
    FOREIGN KEY (`candidateId` )
    REFERENCES `mydb`.`Candidate` (`candidateId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProfessionalData_Verificator`
    FOREIGN KEY (`verificatorId` )
    REFERENCES `mydb`.`Verificator` (`verificatorId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


-- -----------------------------------------------------
-- Table `mydb`.`AcademicData`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`AcademicData` (
  `candidateId` VARCHAR(45) NOT NULL ,
  `centerName` VARCHAR(45) NOT NULL ,
  `degree` VARCHAR(45) NOT NULL ,
  `iniDate` DATE NULL ,
  `endDate` DATE NULL ,
  `state` ENUM('procesing','verified','notVerified') NULL ,
  `verificatorId` VARCHAR(50) NULL ,
  PRIMARY KEY (`candidateId`, `centerName`, `degree`) ,
  INDEX `fk_ProfessionalData_Candidate` (`candidateId` ASC) ,
  INDEX `fk_AcademicData_Verificator` (`verificatorId` ASC) ,
  CONSTRAINT `fk_ProfessionalData_Candidate`
    FOREIGN KEY (`candidateId` )
    REFERENCES `mydb`.`Candidate` (`candidateId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_AcademicData_Verificator`
    FOREIGN KEY (`verificatorId` )
    REFERENCES `mydb`.`Verificator` (`verificatorId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


-- -----------------------------------------------------
-- Table `mydb`.`References`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`References` (
  `referenceName` VARCHAR(45) NOT NULL ,
  `referenceLastName` VARCHAR(45) NOT NULL ,
  `telephone` INT NULL ,
  `relationship` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  PRIMARY KEY (`referenceName`, `referenceLastName`) )
;


-- -----------------------------------------------------
-- Table `mydb`.`CandidateReference`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`CandidateReference` (
  `candidateId` VARCHAR(45) NOT NULL ,
  `referenceName` VARCHAR(45) NOT NULL ,
  `referenceLastName` VARCHAR(45) NOT NULL ,
  `state` ENUM('procesing','verified','notVerified') NULL ,
  `verificatorId` VARCHAR(50) NULL ,
  PRIMARY KEY (`candidateId`, `referenceName`, `referenceLastName`) ,
  INDEX `fk_Candidate_has_References_Candidate` (`candidateId` ASC) ,
  INDEX `fk_Candidate_has_References_References` (`referenceName` ASC, `referenceLastName` ASC) ,
  INDEX `fk_CandidateReference_Verificator` (`verificatorId` ASC) ,
  CONSTRAINT `fk_Candidate_has_References_Candidate`
    FOREIGN KEY (`candidateId` )
    REFERENCES `mydb`.`Candidate` (`candidateId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Candidate_has_References_References`
    FOREIGN KEY (`referenceName` , `referenceLastName` )
    REFERENCES `mydb`.`References` (`referenceName` , `referenceLastName` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CandidateReference_Verificator`
    FOREIGN KEY (`verificatorId` )
    REFERENCES `mydb`.`Verificator` (`verificatorId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `mydb`.`CandidateBill`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`CandidateBill` (
  `candidateId` VARCHAR(45) NOT NULL ,
  `contractingDate` DATE NOT NULL ,
  `serviceType` ENUM('STANDAR', 'SILVER', 'GOLD') NULL ,
  `price` INT NULL ,
  `estimatedVerifTime` INT NULL ,
  PRIMARY KEY (`candidateId`, `contractingDate`) ,
  INDEX `fk_CandidateBill_Candidate` (`candidateId` ASC) ,
  CONSTRAINT `fk_CandidateBill_Candidate`
    FOREIGN KEY (`candidateId` )
    REFERENCES `mydb`.`Candidate` (`candidateId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


-- -----------------------------------------------------
-- Table `mydb`.`EmployeerBill`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`EmployeerBill` (
  `candidateId` VARCHAR(45) NOT NULL ,
  `employeerId` VARCHAR(45) NOT NULL ,
  `serviceType` ENUM('STANDAR','SILVER','GOLD') NOT NULL ,
  `contractingDate` DATE NOT NULL ,
  `expirationDate` DATE NULL ,
  PRIMARY KEY (`candidateId`, `employeerId`, `contractingDate`, `serviceType`) ,
  INDEX `fk_EmployeerBill_Candidate` (`candidateId` ASC) ,
  INDEX `fk_EmployeerBill_Employeer` (`employeerId` ASC) ,
  CONSTRAINT `fk_EmployeerBill_Candidate`
    FOREIGN KEY (`candidateId` )
    REFERENCES `mydb`.`Candidate` (`candidateId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EmployeerBill_Employeer`
    FOREIGN KEY (`employeerId` )
    REFERENCES `mydb`.`Employeer` (`employeerId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


-- -----------------------------------------------------
-- Table `mydb`.`AllowedEmployeer`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`AllowedEmployeer` (
  `candidateId` VARCHAR(45) NOT NULL ,
  `employeerId` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`candidateId`, `employeerId`) ,
  INDEX `fk_Candidate_has_Employeer_Candidate` (`candidateId` ASC) ,
  INDEX `fk_Candidate_has_Employeer_Employeer` (`employeerId` ASC) ,
  CONSTRAINT `fk_Candidate_has_Employeer_Candidate`
    FOREIGN KEY (`candidateId` )
    REFERENCES `mydb`.`Candidate` (`candidateId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Candidate_has_Employeer_Employeer`
    FOREIGN KEY (`employeerId` )
    REFERENCES `mydb`.`Employeer` (`employeerId` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `mydb`.`CenterAnswer`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`CenterAnswer` (
  `candidateId` VARCHAR(45) NOT NULL ,
  `centerName` VARCHAR(45) NOT NULL ,
  `degree` VARCHAR(45) NOT NULL ,
  `observations` VARCHAR(500) NULL ,
  `verified` BOOLEAN NULL ,
  PRIMARY KEY (`candidateId`, `centerName`, `degree`) ,
  INDEX `fk_CenterAnswer_AcademicData` (`candidateId` ASC, `centerName` ASC, `degree` ASC) ,
  CONSTRAINT `fk_CenterAnswer_AcademicData`
    FOREIGN KEY (`candidateId` , `centerName` , `degree` )
    REFERENCES `mydb`.`AcademicData` (`candidateId` , `centerName` , `degree` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;


-- -----------------------------------------------------
-- Table `mydb`.`ReferenceAnswer`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`ReferenceAnswer` (
  `CandidateReference_candidateId` VARCHAR(45) NOT NULL ,
  `CandidateReference_referenceName` VARCHAR(45) NOT NULL ,
  `CandidateReference_referenceLastName` VARCHAR(45) NOT NULL ,
  `RecommendationLetter` VARCHAR(500) NULL ,
  PRIMARY KEY (`CandidateReference_candidateId`, `CandidateReference_referenceName`, `CandidateReference_referenceLastName`) ,
  INDEX `fk_ReferenceAnswer_CandidateReference` (`CandidateReference_candidateId` ASC, `CandidateReference_referenceName` ASC, `CandidateReference_referenceLastName` ASC) ,
  CONSTRAINT `fk_ReferenceAnswer_CandidateReference`
    FOREIGN KEY (`CandidateReference_candidateId` , `CandidateReference_referenceName` , `CandidateReference_referenceLastName` )
    REFERENCES `mydb`.`CandidateReference` (`candidateId` , `referenceName` , `referenceLastName` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
;

-- -----------------------------------------------------
-- Table `mydb`.`Center` (manual)
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Center` (
  `centerName` VARCHAR(50) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`centerName`) )
;



INSERT INTO `User` (`userId`, `password`) VALUES ('drozas', 'ee1743530339ae80fc77f129f1e09097');
INSERT INTO `Verificator` (`verificatorId`, `name`, `lastName`) VALUES ('drozas', 'David', 'Rozas');
INSERT INTO `Center` (`centerName`, `email`) VALUES
('URJC', 'rsajor@gmail.com'),
('NTNU', 'david.rozas@gmail.com');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
