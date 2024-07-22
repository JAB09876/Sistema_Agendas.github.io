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
  `descripcion` VARCHAR(25) NOT NULL,
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
-- Table `Sistema_Agenda`.`Dia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Dia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `Sistema_Agenda`.`Dia` (`descripcion`)
VALUES 
('Lunes'),
('Martes'),
('Miércoles'),
('Jueves'),
('Viernes'),
('Sábado'),
('Domingo');


-- -----------------------------------------------------
-- Table `Sistema_Agenda`.`Horario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Sistema_Agenda`.`Horario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `horaInicio` INT NOT NULL,
  `horaFin` INT NOT NULL,
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

- -----------------------------------------------------
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
  `idSubServicio` INT NOT NULL,
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
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_SubServicio_Cita`
    FOREIGN KEY (`idSubServicio`)
    REFERENCES `Sistema_Agenda`.`Subservicio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

INSERT INTO `Sistema_Agenda`.`Sucursal` 
(`nombre`, `telefono`, `estado`, `correo_electronico`, `direccion_exacta`) 
VALUES 
('Sucursal San José', '22223333', 1, 'sanjose@sistema_agenda.cr', 'Avenida Central, San José, Costa Rica');

INSERT INTO `Sistema_Agenda`.`Sucursal` 
(`nombre`, `telefono`, `estado`, `correo_electronico`, `direccion_exacta`) 
VALUES 
('Sucursal Alajuela', '24445555', 1, 'alajuela@sistema_agenda.cr', 'Calle Central, Alajuela, Costa Rica');

INSERT INTO `Sistema_Agenda`.`Sucursal` 
(`nombre`, `telefono`, `estado`, `correo_electronico`, `direccion_exacta`) 
VALUES 
('Sucursal Heredia', '22667788', 1, 'heredia@sistema_agenda.cr', 'Boulevard de las Flores, Heredia, Costa Rica');

-- Insert 1: Administrador
INSERT INTO `Sistema_Agenda`.`Usuario` (id, telefono, correo_electronico, nombre, direccion, fecha_nacimiento, contrasenna, rol, estado, idSucursal) 
VALUES ('123456789', '123456789', 'admin@example.com', 'Admin', '123 Admin St', '1980-01-01', 'admin123', 'Administrador', 1, NULL);

-- Insert 2: Cliente
INSERT INTO `Sistema_Agenda`.`Usuario` (id, telefono, correo_electronico, nombre, direccion, fecha_nacimiento, contrasenna, rol, estado, idSucursal) 
VALUES ('987654321', '987654321', 'johndoe@gmail.com', 'John Doe', '456 Elm Street', '1990-05-10', 'john123', 'Cliente', 1, NULL);

-- Insert 3: Encargado
INSERT INTO `Sistema_Agenda`.`Usuario` (id, telefono, correo_electronico, nombre, direccion, fecha_nacimiento, contrasenna, rol, estado, idSucursal) 
VALUES ('456123789', '456123789', 'janedoe@gmail.com', 'Jane Doe', '789 Maple Avenue', '1985-12-20', 'jane456', 'Encargado', 1, 1);

-- Insert 4: Cliente
INSERT INTO `Sistema_Agenda`.`Usuario` (id, telefono, correo_electronico, nombre, direccion, fecha_nacimiento, contrasenna, rol, estado, idSucursal) 
VALUES ('789456123', '789456123', 'alice@example.com', 'Alice Smith', '101 Oak Street', '1982-08-15', 'alice789', 'Cliente', 1, NULL);

-- Insert 5: Cliente
INSERT INTO `Sistema_Agenda`.`Usuario` (id, telefono, correo_electronico, nombre, direccion, fecha_nacimiento, contrasenna, rol, estado, idSucursal) 
VALUES ('159357852', '159357852', 'bob@example.com', 'Bob Johnson', '303 Pine Street', '1978-03-25', 'bob101', 'Cliente', 1, NULL);

-- Insert 6: Encargado
INSERT INTO `Sistema_Agenda`.`Usuario` (id, telefono, correo_electronico, nombre, direccion, fecha_nacimiento, contrasenna, rol, estado, idSucursal) 
VALUES ('852963741', '852963741', 'sarah@example.com', 'Sarah Adams', '505 Cedar Avenue', '1991-10-05', 'sarah202', 'Encargado', 1, 2);

-- Insert 7: Cliente
INSERT INTO `Sistema_Agenda`.`Usuario` (id, telefono, correo_electronico, nombre, direccion, fecha_nacimiento, contrasenna, rol, estado, idSucursal) 
VALUES ('369258147', '369258147', 'mike@example.com', 'Mike Wilson', '707 Walnut Street', '1975-07-12', 'mike303', 'Cliente', 1, NULL);

-- Insert 8: Cliente
INSERT INTO `Sistema_Agenda`.`Usuario` (id, telefono, correo_electronico, nombre, direccion, fecha_nacimiento, contrasenna, rol, estado, idSucursal) 
VALUES ('741852963', '741852963', 'emily@example.com', 'Emily Brown', '909 Birch Avenue', '1988-11-30', 'emily404', 'Cliente', 1, NULL);

-- Insert 9: Encargado
INSERT INTO `Sistema_Agenda`.`Usuario` (id, telefono, correo_electronico, nombre, direccion, fecha_nacimiento, contrasenna, rol, estado, idSucursal) 
VALUES ('123789456', '123789456', 'david@example.com', 'David Miller', '1111 Main Street', '1995-06-18', 'david505', 'Encargado', 1, 3);

-- Insert 10: Cliente
INSERT INTO `Sistema_Agenda`.`Usuario` (id, telefono, correo_electronico, nombre, direccion, fecha_nacimiento, contrasenna, rol, estado, idSucursal) 
VALUES ('369147258', '369147258', 'laura@example.com', 'Laura Garcia', '1212 Cherry Lane', '1970-04-03', 'laura606', 'Cliente', 1, NULL);

INSERT INTO Categoria (descripcion) VALUES ('Cremas y Lociones para Bebés');
INSERT INTO Categoria (descripcion) VALUES ('Suplementos Nutricionales Infantiles');
INSERT INTO Categoria (descripcion) VALUES ('Juguetes Educativos');
INSERT INTO Categoria (descripcion) VALUES ('Ropa Infantil');
INSERT INTO Categoria (descripcion) VALUES ('Accesorios para el Baño');

INSERT INTO Marca (nombre) VALUES ('BabyGlow');
INSERT INTO Marca (nombre) VALUES ('TinyTummies');
INSERT INTO Marca (nombre) VALUES ('SmartToys');

INSERT INTO Producto (nombre, descripcion, precio, estado, idCategoria, idMarca) VALUES ('Crema Hidratante para Bebés', 'Hidratación suave y protectora para la piel delicada del bebé', 10.00, 1, 1, 1);
INSERT INTO Producto (nombre, descripcion, precio, estado, idCategoria, idMarca) VALUES ('Fórmula Infantil en Polvo', 'Fórmula nutricionalmente completa para lactantes y niños pequeños', 20.00, 1, 2, 2);
INSERT INTO Producto (nombre, descripcion, precio, estado, idCategoria, idMarca) VALUES ('Set de Bloques de Construcción', 'Juguete educativo para fomentar la creatividad y habilidades motoras', 15.00, 1, 3, 3);
INSERT INTO Producto (nombre, descripcion, precio, estado, idCategoria, idMarca) VALUES ('Conjunto de Pijamas para Bebés', 'Ropa suave y cómoda para bebés que garantiza una buena noche de sueño', 25.00, 1, 4, 1);
INSERT INTO Producto (nombre, descripcion, precio, estado, idCategoria, idMarca) VALUES ('Juguetes de Baño Flotantes', 'Juguetes de baño seguros y divertidos para el entretenimiento durante el baño', 8.00, 1, 5, 3);
INSERT INTO Producto (nombre, descripcion, precio, estado, idCategoria, idMarca) VALUES ('Loción Protectora para el Sol', 'Protección solar suave y eficaz para bebés y niños pequeños', 12.00, 1, 1, 2);
INSERT INTO Producto (nombre, descripcion, precio, estado, idCategoria, idMarca) VALUES ('Peluche Musical Interactivo', 'Peluche suave y musical que estimula el desarrollo sensorial del bebé', 18.00, 1, 3, 3);
INSERT INTO Producto (nombre, descripcion, precio, estado, idCategoria, idMarca) VALUES ('Vestido de Algodón para Niñas', 'Ropa elegante y cómoda para niñas en algodón suave', 30.00, 1, 4, 2);
INSERT INTO Producto (nombre, descripcion, precio, estado, idCategoria, idMarca) VALUES ('Toalla de Baño con Capucha', 'Toalla absorbente y suave con capucha para bebés después del baño', 14.00, 1, 5, 1);
INSERT INTO Producto (nombre, descripcion, precio, estado, idCategoria, idMarca) VALUES ('Set de Vajilla Infantil', 'Vajilla colorida y segura para niños pequeños con diseños divertidos', 20.00, 1, 3, 3);

-- Insertando las especialidades
INSERT INTO Especialidad (descripcion, estado) VALUES ('Ginecología y Obstetricia', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Pediatría y neonatología', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Dermatologia', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Nutrición', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Psicologia', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Endocrinología y Metabolismo', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Medicina Interna', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Radiología e Imágenes Médicas', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Reumatología', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Urología', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Cirugía Plástica', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Vascular Periférico', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Cirugía General', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Cuidados Paliativos y Dolor Crónico', 1);
INSERT INTO Especialidad (descripcion, estado) VALUES ('Geriatría y Gerontología', 1);

-- Insertando servicios basados en el JSON proporcionado

-- Especialidad: Ginecología y Obstetricia
INSERT INTO Servicio (nombre, nivel_atencion, estado, idEspecialidad) VALUES ('Preparación de parto', 'Alto', 1, 1);
INSERT INTO Servicio (nombre, nivel_atencion, estado, idEspecialidad) VALUES ('Partos', 'Alto', 1, 1);
INSERT INTO Servicio (nombre, nivel_atencion, estado, idEspecialidad) VALUES ('Terapias', 'Medio', 1, 1);
INSERT INTO Servicio (nombre, nivel_atencion, estado, idEspecialidad) VALUES ('Consultas Ginecológicas', 'Bajo', 1, 1);

-- Especialidad: Pediatría y neonatología
INSERT INTO Servicio (nombre, nivel_atencion, estado, idEspecialidad) VALUES ('Estimulación para bebés', 'Alto', 1, 2);
INSERT INTO Servicio (nombre, nivel_atencion, estado, idEspecialidad) VALUES ('Pediatría y neonatología', 'Alto', 1, 2);

-- Especialidad: Dermatología
INSERT INTO Servicio (nombre, nivel_atencion, estado, idEspecialidad) VALUES ('Dermatología', 'Medio', 1, 3);

-- Especialidad: Nutrición
INSERT INTO Servicio (nombre, nivel_atencion, estado, idEspecialidad) VALUES ('Dieta Prenatal', 'Bajo', 1, 4);
INSERT INTO Servicio (nombre, nivel_atencion, estado, idEspecialidad) VALUES ('Control de peso', 'Medio', 1, 4);

-- Especialidad: Psicología
INSERT INTO Servicio (nombre, nivel_atencion, estado, idEspecialidad) VALUES ('Soporte mental', 'Medio', 1, 5);
INSERT INTO Servicio (nombre, nivel_atencion, estado, idEspecialidad) VALUES ('Psiquiatría', 'Alto', 1, 5);

-- Subservicios de Ginecología y Obstetricia

-- Subservicios de Preparación de parto
INSERT INTO Subservicio (tiempo, descripcion, nombre, monto, estado, idServicio)
VALUES
    (60, 'Curso de preparación para el parto', 'Curso de preparación para el parto', 150.00, 1, 1),
    (60, 'Yoga prenatal', 'Yoga prenatal', 150.00, 1, 1),
    (60, 'Ejercicios piscina para embarazadas', 'Ejercicios piscina para embarazadas', 150.00, 1, 1),
    (60, 'Seguimiento con Doula', 'Seguimiento con Doula', 150.00, 1, 1),
    (60, 'Terapia de piso pélvico durante el embarazo y en el posparto', 'Terapia de piso pélvico durante el embarazo y en el posparto', 150.00, 1, 1);

-- Subservicios de Partos
INSERT INTO Subservicio (tiempo, descripcion, nombre, monto, estado, idServicio)
VALUES
    (120, 'Parto con analgesia epidural', 'Parto con analgesia epidural', 500.00, 1, 2),
    (120, 'Parto en agua', 'Parto en agua', 500.00, 1, 2),
    (120, 'Parto natural supervisado', 'Parto natural supervisado', 500.00, 1, 2),
    (120, 'Parto en casa', 'Parto en casa', 500.00, 1, 2),
    (120, 'Cesárea respetada', 'Cesárea respetada', 500.00, 1, 2);

-- Subservicios de Terapias
INSERT INTO Subservicio (tiempo, descripcion, nombre, monto, estado, idServicio)
VALUES
    (60, 'Terapia de piso pélvico durante el embarazo y en el posparto', 'Terapia de piso pélvico durante el embarazo y en el posparto', 200.00, 1, 3),
    (60, 'Terapia dermatofuncional para cicatriz de cesárea', 'Terapia dermatofuncional para cicatriz de cesárea', 200.00, 1, 3),
    (60, 'Terapia física', 'Terapia física', 200.00, 1, 3);

-- Subservicios de Consultas Ginecológicas
INSERT INTO Subservicio (tiempo, descripcion, nombre, monto, estado, idServicio)
VALUES
    (60, 'Análisis histológico y citologías', 'Análisis histológico y citologías', 100.00, 1, 4),
    (60, 'Urodinamia y análisis de incontinencia', 'Urodinamia y análisis de incontinencia', 100.00, 1, 4);


-- Subservicios de Pediatría y Neonatología

-- Subservicios de Estimulación para bebés
INSERT INTO Subservicio (tiempo, descripcion, nombre, monto, estado, idServicio)
VALUES
    (60, 'Estimulación Temprana', 'Estimulación Temprana', 150.00, 1, 5),
    (60, 'Estimulación en piscina para bebés', 'Estimulación en piscina para bebés', 150.00, 1, 5);

-- Subservicios de Pediatría y Neonatología
INSERT INTO Subservicio (tiempo, descripcion, nombre, monto, estado, idServicio)
VALUES
    (60, 'Pediatría y neonatología', 'Pediatría y neonatología', 200.00, 1, 6);


-- Subservicios de Dermatología

-- Subservicios de Dermatología
INSERT INTO Subservicio (tiempo, descripcion, nombre, monto, estado, idServicio)
VALUES
    (60, 'Medicina estética', 'Medicina estética', 150.00, 1, 7),
    (60, 'Limpieza facial', 'Limpieza facial', 150.00, 1, 7),
    (60, 'Masajes relajantes', 'Masajes relajantes', 150.00, 1, 7),
    (60, 'Consulta Dermatológica', 'Consulta Dermatológica', 150.00, 1, 7);


-- Subservicios de Nutrición

-- Subservicios de Dieta Prenatal
INSERT INTO Subservicio (tiempo, descripcion, nombre, monto, estado, idServicio)
VALUES
    (60, 'Dieta Prenatal', 'Dieta Prenatal', 100.00, 1, 8);

-- Subservicios de Control de peso
INSERT INTO Subservicio (tiempo, descripcion, nombre, monto, estado, idServicio)
VALUES
    (60, 'Evaluación Antropométrica y Composición Corporal', 'Evaluación Antropométrica y Composición Corporal', 150.00, 1, 9),
    (60, 'Planificación de Dietas Personalizadas', 'Planificación de Dietas Personalizadas', 150.00, 1, 9),
    (60, 'Seguimiento y Ajuste de Planes Alimentarios', 'Seguimiento y Ajuste de Planes Alimentarios', 150.00, 1, 9),
    (60, 'Asesoramiento en Actividad Física', 'Asesoramiento en Actividad Física', 150.00, 1, 9),
    (60, 'Educación Nutricional y Cambios de Hábitos', 'Educación Nutricional y Cambios de Hábitos', 150.00, 1, 9);


-- Subservicios de Psicología

-- Subservicios de Soporte mental
INSERT INTO Subservicio (tiempo, descripcion, nombre, monto, estado, idServicio)
VALUES
    (60, 'Apoyo Emocional durante el Embarazo', 'Apoyo Emocional durante el Embarazo', 200.00, 1, 10),
    (60, 'Manejo del Estrés y la Ansiedad', 'Manejo del Estrés y la Ansiedad', 200.00, 1, 10),
    (60, 'Técnicas de Relajación y Mindfulness', 'Técnicas de Relajación y Mindfulness', 200.00, 1, 10),
    (60, 'Consejería en Salud Mental Posparto', 'Consejería en Salud Mental Posparto', 200.00, 1, 10),
    (60, 'Terapia de Pareja para Padres Primerizos', 'Terapia de Pareja para Padres Primerizos', 200.00, 1, 10);

-- Subservicios de Psiquiatría
INSERT INTO Subservicio (tiempo, descripcion, nombre, monto, estado, idServicio)
VALUES
    (60, 'Evaluación Psiquiátrica Integral', 'Evaluación Psiquiátrica Integral', 300.00, 1, 11),
    (60, 'Tratamiento Farmacológico Seguro durante el Embarazo', 'Tratamiento Farmacológico Seguro durante el Embarazo', 300.00, 1, 11),
    (60, 'Apoyo Psicoterapéutico Especializado', 'Apoyo Psicoterapéutico Especializado', 300.00, 1, 11);
    
INSERT INTO `Sistema_Agenda`.`Medico` (nombre, estado, idEspecilidad, idSucursal) VALUES ('Dr. Juan Pérez', 1, 1, 1);
INSERT INTO `Sistema_Agenda`.`Medico` (nombre, estado, idEspecilidad, idSucursal) VALUES ('Dr. María López', 1, 2, 1);
INSERT INTO `Sistema_Agenda`.`Medico` (nombre, estado, idEspecilidad, idSucursal) VALUES ('Dr. Carlos Sánchez', 1, 3, 1);
INSERT INTO `Sistema_Agenda`.`Medico` (nombre, estado, idEspecilidad, idSucursal) VALUES ('Dr. Ana González', 1, 4, 1);
INSERT INTO `Sistema_Agenda`.`Medico` (nombre, estado, idEspecilidad, idSucursal) VALUES ('Dr. Pedro Rodríguez', 1, 5, 1);
INSERT INTO `Sistema_Agenda`.`Medico` (nombre, estado, idEspecilidad, idSucursal) VALUES ('Dr. Laura Fernández', 1, 6, 1);
INSERT INTO `Sistema_Agenda`.`Medico` (nombre, estado, idEspecilidad, idSucursal) VALUES ('Dr. Jorge Martínez', 1, 7, 1);
INSERT INTO `Sistema_Agenda`.`Medico` (nombre, estado, idEspecilidad, idSucursal) VALUES ('Dr. José Daniel Chaves Campos', 1, 13, 2);

INSERT INTO Estado (id, descripcion) VALUES (1, 'Pendiente');
INSERT INTO Estado (id, descripcion) VALUES (2, 'Confirmada');
INSERT INTO Estado (id, descripcion) VALUES (3, 'Reprogramada');
INSERT INTO Estado (id, descripcion) VALUES (4, 'Completada');
INSERT INTO Estado (id, descripcion) VALUES (5, 'Cancelada');
INSERT INTO Estado (id, descripcion) VALUES (6, 'No asistió');

INSERT INTO `Sistema_Agenda`.`Cita` (idCliente, fecha, horaInicio, horaFin, idEstado, idMedico, idSucursal, idSubServicio) 
VALUES ('159357852', '2024-06-20 09:00:00', 900, 1000, 1, 2, 1, 1);

INSERT INTO `Sistema_Agenda`.`Cita` (idCliente, fecha, horaInicio, horaFin, idEstado, idMedico, idSucursal, idSubServicio) 
VALUES ('369147258', '2024-06-20 10:00:00', 1000, 1100, 1, 2, 1, 1);

INSERT INTO `Sistema_Agenda`.`Cita` (idCliente, fecha, horaInicio, horaFin, idEstado, idMedico, idSucursal, idSubServicio) 
VALUES ('369258147', '2024-06-21 11:00:00', 1100, 1200, 1, 3, 1, 1);

INSERT INTO `Sistema_Agenda`.`Cita` (idCliente, fecha, horaInicio, horaFin, idEstado, idMedico, idSucursal, idSubServicio) 
VALUES ('741852963', '2024-06-21 12:00:00', 1200, 1300, 1, 4, 1, 1);

INSERT INTO `Sistema_Agenda`.`Cita` (idCliente, fecha, horaInicio, horaFin, idEstado, idMedico, idSucursal, idSubServicio) 
VALUES ('789456123', '2024-06-22 13:00:00', 1300, 1400, 1, 5, 1, 1);

INSERT INTO `Sistema_Agenda`.`Cita` (idCliente, fecha, horaInicio, horaFin, idEstado, idMedico, idSucursal, idSubServicio) 
VALUES ('987654321', '2024-06-22 13:00:00', 1300, 1400, 1, 4, 1, 1);


-- Insertando las facturas
INSERT INTO `Sistema_Agenda`.`Factura` (fecha, total, estado, idUsuario, idSucursal) 
VALUES ('2024-06-20', 100.00, 1, '159357852', 1);

INSERT INTO `Sistema_Agenda`.`Factura` (fecha, total, estado, idUsuario, idSucursal) 
VALUES ('2024-06-20', 150.00, 1, '369147258', 1);

INSERT INTO `Sistema_Agenda`.`Factura` (fecha, total, estado, idUsuario, idSucursal) 
VALUES ('2024-06-21', 200.00, 1, '369258147', 1);

INSERT INTO `Sistema_Agenda`.`Factura` (fecha, total, estado, idUsuario, idSucursal) 
VALUES ('2024-06-21', 250.00, 1, '741852963', 1);

INSERT INTO `Sistema_Agenda`.`Factura` (fecha, total, estado, idUsuario, idSucursal) 
VALUES ('2024-06-22', 300.00, 1, '789456123', 1);

INSERT INTO `Sistema_Agenda`.`Factura_Detalle` (idFactura, subtotal, estado, idProducto, idSubservicio, cantidad) 
VALUES (1, 100.00, 1, NULL, 1, 1);

INSERT INTO `Sistema_Agenda`.`Factura_Detalle` (idFactura, subtotal, estado, idProducto, idSubservicio, cantidad) 
VALUES (2, 150.00, 1, NULL, 2, 1);

INSERT INTO `Sistema_Agenda`.`Factura_Detalle` (idFactura, subtotal, estado, idProducto, idSubservicio, cantidad) 
VALUES (3, 200.00, 1, NULL, 3, 1);

INSERT INTO `Sistema_Agenda`.`Factura_Detalle` (idFactura, subtotal, estado, idProducto, idSubservicio, cantidad) 
VALUES (4, 250.00, 1, NULL, 4, 1);

INSERT INTO `Sistema_Agenda`.`Factura_Detalle` (idFactura, subtotal, estado, idProducto, idSubservicio, cantidad) 
VALUES (5, 300.00, 1, NULL, 5, 1);

INSERT INTO `Sistema_Agenda`.`Horario` (`horaInicio`, `horaFin`, `estado`, `idDia`, `idSucursal`)
VALUES (800, 1200, 1, 1, 1);

INSERT INTO `Sistema_Agenda`.`Horario` (`horaInicio`, `horaFin`, `estado`, `idDia`, `idSucursal`)
VALUES (1300, 1700, 1, 1, 2);

INSERT INTO `Sistema_Agenda`.`Horario` (`horaInicio`, `horaFin`, `estado`, `idDia`, `idSucursal`)
VALUES (900, 1300, 1, 1, 3);