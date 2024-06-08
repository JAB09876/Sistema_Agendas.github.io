ALTER TABLE Producto
MODIFY COLUMN imagen LONGBLOB NULL; 

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

ALTER TABLE Producto
MODIFY COLUMN imagen LONGBLOB NOT NULL; 
