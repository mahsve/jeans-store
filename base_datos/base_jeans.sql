SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema base_jeans
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema base_jeans
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `base_jeans` DEFAULT CHARACTER SET utf8 ;
USE `base_jeans` ;

-- -----------------------------------------------------
-- Table `base_jeans`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_jeans`.`usuario` (
  `usuario` VARCHAR(25) NOT NULL,
  `clave` CHAR(40) NOT NULL,
  `estatus` CHAR(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_jeans`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_jeans`.`clientes` (
  `cedula` CHAR(8) NOT NULL,
  `nombres` VARCHAR(60) NOT NULL,
  `direccion` VARCHAR(120) NOT NULL,
  `estatus` CHAR(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`cedula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_jeans`.`producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_jeans`.`producto` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `existencia` INT NOT NULL,
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `base_jeans`.`factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `base_jeans`.`factura` (
  `numero` INT NOT NULL AUTO_INCREMENT,
  `cliente` CHAR(8) NOT NULL,
  `cantidad` INT NOT NULL,
  `producto` INT NOT NULL,
  `precio` FLOAT NOT NULL,
  `descuento` INT NOT NULL,
  `estatus` CHAR(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`numero`),
  INDEX `fk_clientes_factura_idx` (`cliente` ASC),
  INDEX `fk_producto_factura_idx` (`producto` ASC),
  CONSTRAINT `fk_clientes_factura`
    FOREIGN KEY (`cliente`)
    REFERENCES `base_jeans`.`clientes` (`cedula`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_producto_factura`
    FOREIGN KEY (`producto`)
    REFERENCES `base_jeans`.`producto` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

INSERT INTO `producto` (`codigo`, `existencia`) VALUES (NULL, '0');

INSERT INTO `usuario` (`usuario`, `clave`, `estatus`) VALUES ('admin', SHA1('1234'), 'A'), ('admin2', SHA1('1234'), 'I');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
