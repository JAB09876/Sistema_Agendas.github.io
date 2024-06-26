-- -----------------------------------------------------
-- Schema Sistema_Agenda
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Sistema_Agenda` ;

CREATE SCHEMA IF NOT EXISTS `Sistema_Agenda` DEFAULT CHARACTER SET utf8 ;
USE `Sistema_Agenda` ;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Sucursal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Sucursal` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `telefono` VARCHAR(9) NULL,
  `estado` TINYINT NOT NULL,
  `correo_electronico` VARCHAR(255) NOT NULL,
  `direccion_exacta` VARCHAR(350) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Usuario` (
  `id` CHAR(9) NOT NULL,
  `telefono` VARCHAR(9) NOT NULL,
  `correo_electronico` VARCHAR(255) NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `direccion` VARCHAR(300) NULL,
  `fecha_nacimiento` DATE NULL,
  `contrasenna` VARCHAR(24) NOT NULL,
  `rol` ENUM('Cliente', 'Encargado', 'Administrador') NOT NULL,
  `estado` TINYINT NULL,
  `idSucursal` INT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_Sucursal_Usuario`
    FOREIGN KEY (`idSucursal`)
    REFERENCES `Sistema_Agenda`.`Sucursal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Marca` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(150) NULL,
  `precio` FLOAT NULL,
  `estado` TINYINT NULL,
  `idCategoria` INT NOT NULL,
  `idMarca` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_Categoria_Producto`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `Sistema_Agenda`.`Categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Marca_Producto`
    FOREIGN KEY (`idMarca`)
    REFERENCES `Sistema_Agenda`.`Marca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Estado` (
  `id` INT NOT NULL,
  `descripcion` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Especialidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Especialidad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` TEXT NOT NULL,
  `estado` TINYINT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Medico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Medico` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `estado` TINYINT NOT NULL,
  `idEspecilidad` INT NOT NULL,
  `idSucursal` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_Especialidad_Medico`
    FOREIGN KEY (`idEspecilidad`)
    REFERENCES `Sistema_Agenda`.`Especialidad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Sucursal_Medico`
    FOREIGN KEY (`idSucursal`)
    REFERENCES `Sistema_Agenda`.`Sucursal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Cita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Cita` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idCliente` CHAR(9) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `horaInicio` INT(11) NOT NULL,
  `horaFin` INT(11) NOT NULL,
  `idEstado` INT NOT NULL,
  `idMedico` INT NOT NULL,
  `idSucursal` INT NOT NULL,
  PRIMARY KEY (`id`, `idCliente`),
  CONSTRAINT `FK_Usuario_Cita`
    FOREIGN KEY (`idCliente`)
    REFERENCES `Sistema_Agenda`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Estado_Cita`
    FOREIGN KEY (`idEstado`)
    REFERENCES `Sistema_Agenda`.`Estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Medico_Cita`
    FOREIGN KEY (`idMedico`)
    REFERENCES `Sistema_Agenda`.`Medico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Sucursal_Cita`
    FOREIGN KEY (`idSucursal`)
    REFERENCES `Sistema_Agenda`.`Sucursal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Dia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Dia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Horario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Horario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `hora` INT NOT NULL,
  `estado` TINYINT NULL,
  `idDia` INT NOT NULL,
  `idSucursal` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_Sucursal_Horario`
    FOREIGN KEY (`idSucursal`)
    REFERENCES `Sistema_Agenda`.`Sucursal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Dia_Horario`
    FOREIGN KEY (`idDia`)
    REFERENCES `Sistema_Agenda`.`Dia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Factura` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `total` DECIMAL NULL,
  `estado` TINYINT NULL,
  `idUsuario` CHAR(9) NOT NULL,
  `idSucursal` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_Usuario_Factura`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `Sistema_Agenda`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Sucursal_Factura`
    FOREIGN KEY (`idSucursal`)
    REFERENCES `Sistema_Agenda`.`Sucursal` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Servicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Servicio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `nivel_atencion` VARCHAR(255) NOT NULL,
  `estado` TINYINT NOT NULL,
  `idEspecialidad` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_Especialidad_Servicio`
    FOREIGN KEY (`idEspecialidad`)
    REFERENCES `Sistema_Agenda`.`Especialidad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Subservicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Subservicio` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tiempo` INT NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `monto` DECIMAL(10,2) NOT NULL,
  `estado` TINYINT NOT NULL,
  `idServicio` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_Servicio_Subservicio`
    FOREIGN KEY (`idServicio`)
    REFERENCES `Sistema_Agenda`.`Servicio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Factura_Detalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Factura_Detalle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idFactura` INT NOT NULL,
  `subtotal` DECIMAL NOT NULL,
  `cantidad` INT NULL,
  `estado` TINYINT NULL,
  `idProducto` INT NULL,
  `idSubservicio` INT NOT NULL,
  PRIMARY KEY (`id`, `idFactura`),
  CONSTRAINT `FK_Factura_Factura_Detalle`
    FOREIGN KEY (`idFactura`)
    REFERENCES `Sistema_Agenda`.`Factura` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Producto_Factura_Detalle`
    FOREIGN KEY (`idProducto`)
    REFERENCES `Sistema_Agenda`.`Producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_Subservicio_Factura_Detalle`
    FOREIGN KEY (`idSubservicio`)
    REFERENCES `Sistema_Agenda`.`Subservicio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
