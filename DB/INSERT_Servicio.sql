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
