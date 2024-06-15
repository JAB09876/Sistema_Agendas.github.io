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

-- Insertando los detalles de las facturas
-- Asumiendo que los idSubservicio corresponden a los servicios facturados

INSERT INTO `Sistema_Agenda`.`Factura_Detalle` (idFactura, subtotal, estado, idProducto, idSubservicio) 
VALUES (1, 100.00, 1, NULL, 1);

INSERT INTO `Sistema_Agenda`.`Factura_Detalle` (idFactura, subtotal, estado, idProducto, idSubservicio) 
VALUES (2, 150.00, 1, NULL, 2);

INSERT INTO `Sistema_Agenda`.`Factura_Detalle` (idFactura, subtotal, estado, idProducto, idSubservicio) 
VALUES (3, 200.00, 1, NULL, 3);

INSERT INTO `Sistema_Agenda`.`Factura_Detalle` (idFactura, subtotal, estado, idProducto, idSubservicio) 
VALUES (4, 250.00, 1, NULL, 4);

INSERT INTO `Sistema_Agenda`.`Factura_Detalle` (idFactura, subtotal, estado, idProducto, idSubservicio) 
VALUES (5, 300.00, 1, NULL, 5);
