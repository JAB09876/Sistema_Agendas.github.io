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

