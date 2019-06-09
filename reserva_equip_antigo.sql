-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema reserva_equip
-- -----------------------------------------------------


-- -----------------------------------------------------
-- Table `reserva_equip`.`t_item`
-- -----------------------------------------------------
CREATE TABLE `t_item` (
  `cod_item` INT(20) NOT NULL,
  `t_tipo` VARCHAR(45) NULL,
  `valor_item` DOUBLE NULL,
  `conteudo_item` VARCHAR(150) NULL,
  `ativo_item` VARCHAR(1) NOT NULL DEFAULT '1',
  `data_cadastro` DATETIME NOT NULL,
  `usu_cadastro` VARCHAR(15) NOT NULL,
  `obs_item` VARCHAR(150) NULL,
  PRIMARY KEY (`cod_item`),
  UNIQUE INDEX `cod_item_UNIQUE` (`cod_item` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reserva_equip`.`t_nivel`
-- -----------------------------------------------------
CREATE TABLE `t_nivel` (
  `cod_nivel` INT NOT NULL AUTO_INCREMENT,
  `nome_nivel` VARCHAR(45) NOT NULL,
  `descricao_nivel` VARCHAR(100) NOT NULL,
  `ativo_nivel` VARCHAR(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cod_nivel`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reserva_equip`.`t_usuario`
-- -----------------------------------------------------
CREATE TABLE `t_usuario` (
  `cod_usuario` INT NOT NULL AUTO_INCREMENT,
  `login_usuario` VARCHAR(15) NOT NULL,
  `senha_usuario` VARCHAR(45) NOT NULL,
  `nome_usuario` VARCHAR(45) NOT NULL,
  `ativo_usuario` VARCHAR(1) NOT NULL DEFAULT '1',
  `data_cadastro` DATETIME NOT NULL,
  `usu_cadastro` VARCHAR(15) NOT NULL,
  `t_nivel_cod_nivel` INT NOT NULL,
  PRIMARY KEY (`cod_usuario`, `t_nivel_cod_nivel`),
  INDEX `fk_t_usuario_t_nivel1_idx` (`t_nivel_cod_nivel` ASC),
  UNIQUE INDEX `login_usuario_UNIQUE` (`login_usuario` ASC),
  CONSTRAINT `fk_t_usuario_t_nivel1`
    FOREIGN KEY (`t_nivel_cod_nivel`)
    REFERENCES `reserva_equip`.`t_nivel` (`cod_nivel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reserva_equip`.`t_rotina`
-- -----------------------------------------------------
CREATE TABLE `t_rotina` (
  `cod_rotina` INT NOT NULL AUTO_INCREMENT,
  `nome_rotina` VARCHAR(45) NOT NULL,
  `descricao_rotina` VARCHAR(100) NOT NULL,
  `ativa_rotina` VARCHAR(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cod_rotina`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reserva_equip`.`t_rotina_has_t_nivel`
-- -----------------------------------------------------
CREATE TABLE `t_rotina_has_t_nivel` (
  `t_rotina_cod_rotina` INT NOT NULL,
  `t_nivel_cod_nivel` INT NOT NULL,
  PRIMARY KEY (`t_rotina_cod_rotina`, `t_nivel_cod_nivel`),
  INDEX `fk_t_rotina_has_t_nivel_t_nivel1_idx` (`t_nivel_cod_nivel` ASC),
  INDEX `fk_t_rotina_has_t_nivel_t_rotina_idx` (`t_rotina_cod_rotina` ASC),
  CONSTRAINT `fk_t_rotina_has_t_nivel_t_rotina`
    FOREIGN KEY (`t_rotina_cod_rotina`)
    REFERENCES `reserva_equip`.`t_rotina` (`cod_rotina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_rotina_has_t_nivel_t_nivel1`
    FOREIGN KEY (`t_nivel_cod_nivel`)
    REFERENCES `reserva_equip`.`t_nivel` (`cod_nivel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reserva_equip`.`t_check`
-- -----------------------------------------------------
CREATE TABLE `t_check` (
  `cod_check` INT NOT NULL,
  `info_check` VARCHAR(150) NOT NULL,
  `data_check` DATE NOT NULL,
  `t_reserva_cod_reserva` INT NOT NULL,
  `t_usuario_cod_usuario` INT NOT NULL,
  PRIMARY KEY (`cod_check`, `t_reserva_cod_reserva`, `t_usuario_cod_usuario`),
  INDEX `fk_t_check_t_usuario1_idx` (`t_usuario_cod_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_t_check_t_usuario1`
    FOREIGN KEY (`t_usuario_cod_usuario`)
    REFERENCES `reserva_equip`.`t_usuario` (`cod_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reserva_equip`.`t_reserva`
-- -----------------------------------------------------
CREATE TABLE `t_reserva` (
  `cod_reserva` INT NOT NULL,
  `data_reserva` DATE NOT NULL,
  `data_inicio` DATE NOT NULL,
  `hora_inicio` TIME NOT NULL,
  `data_fim` DATE NOT NULL,
  `hora_fim` TIME NOT NULL,
  `just_reserva` VARCHAR(150) NOT NULL,
  `cancela_reserva` VARCHAR(1) NOT NULL,
  `t_item_cod_item` INT(20) NOT NULL,
  `t_usuario_cod_usuario` INT NOT NULL,
  `t_check_cod_check` INT NOT NULL,
  PRIMARY KEY (`cod_reserva`, `t_item_cod_item`, `t_usuario_cod_usuario`),
  INDEX `fk_t_reserva_t_item1_idx` (`t_item_cod_item` ASC),
  INDEX `fk_t_reserva_t_usuario1_idx` (`t_usuario_cod_usuario` ASC),
  INDEX `fk_t_reserva_t_check1_idx` (`t_check_cod_check` ASC),
  CONSTRAINT `fk_t_reserva_t_item1`
    FOREIGN KEY (`t_item_cod_item`)
    REFERENCES `reserva_equip`.`t_item` (`cod_item`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_reserva_t_usuario1`
    FOREIGN KEY (`t_usuario_cod_usuario`)
    REFERENCES `reserva_equip`.`t_usuario` (`cod_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_t_reserva_t_check1`
    FOREIGN KEY (`t_check_cod_check`)
    REFERENCES `reserva_equip`.`t_check` (`cod_check`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
