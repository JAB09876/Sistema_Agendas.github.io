<?php
/**
 * Clase FacturaModel
 *
 * Esta clase maneja las operaciones de la base de datos para los detalles de las 
 * facturas.
 * Proporciona métodos para listar todos los detalles de las facturas, obtener un *usuario por su ID,
 * crear, actualizar y desactivar detalles de las facturas.
 */
class FacturaDetalleModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase FacturaDetalleModel
     *
     * Inicializa la conexión con la base de datos.
     */
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
    #endregion

    #region Método ALL
    /**
     * Listar todos los detalles de las facturas
     *
     * Obtiene todos los detalles de las facturas activos de la base de datos.
     *
     * @return array Lista de objetos de detalles de las facturas.
     */
    public function all($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT fd.cantidad AS Cantidad,
                            fd.subtotal AS Subtotal,
                            fd.estado AS Estado,
                            p.nombre AS Producto
                            s.nombre AS Subservicio
                     FROM Factura_Detalle fd, Producto p, Subservicio s
                     WHERE p.id = fd.idProducto AND s.id = fd.idSubservicio 
                           AND fd.estado = 1 AND fd.idFactura = $id
                     ORDER BY fd.id ASC;";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el resultado
            return $vResultado;
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método GET
    /**
     * Obtener usuario por ID
     *
     * Obtiene un usuario específico de la base de datos usando su ID.
     *
     * @param int $id El ID del usuario a obtener.
     * @return object El objeto del usuario.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT 
                        u.id,
                        u.telefono,
                        u.correo_electronico,
                        u.nombre AS usuario,
                        u.direccion AS direccion,
                        u.fecha_nacimiento,
                        u.contrasenna,
                        u.rol,
                        u.estado,
                        u.idSucursal,
                        s.nombre AS nombre_sucursal
                    FROM 
                        Usuario u
                    LEFT JOIN 
                        Sucursal s ON u.idSucursal = s.id
                    WHERE 
                        u.estado = 1 AND  u.id = '$id';";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el resultado
            return $vResultado[0];
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método CREATE
    /**
     * Crear un nuevo usuario
     *
     * Inserta un nuevo usuario en la base de datos utilizando los datos proporcionados.
     *
     * @param object $objeto Los datos del usuario a crear.
     * @return object El objeto del usuario creado.
     */
    public function create($detalle, $idFactura)
    {
        try {
            $subservicioM = new subservicioModel();
            $precioSubservicio = $subservicioM->getPrecio($detalle->idSubservicio);
    
            if (isset($detalle->idProducto) && !empty($detalle->idProducto)) {
                $productoM = new ProductoModel();
                $precioProducto = $productoM->getPrecio($detalle->idProducto);
                $subtotal = $precioSubservicio + ($detalle->cantidad * $precioProducto);
    
                // Consulta SQL para crear el detalle con producto
                $vSQL = "INSERT INTO Factura_Detalle 
                            (idFactura, cantidad, subtotal, estado, idProducto, idSubservicio)
                         VALUES
                            ($idFactura, $detalle->cantidad, $subtotal, $detalle->estado, $detalle->idProducto, $detalle->idSubservicio)";
            } else {
                // Consulta SQL para crear el detalle sin producto
                $vSQL = "INSERT INTO Factura_Detalle 
                            (idFactura, subtotal, estado, idSubservicio)
                         VALUES
                            ($idFactura, $precioSubservicio, $detalle->estado, $detalle->idSubservicio)";
            }
    
            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método UPDATE
    /**
     * Actualizar un usuario
     *
     * Actualiza los datos de un usuario en la base de datos.
     *
     * @param object $objeto Los datos del usuario a actualizar.
     * @return object El objeto del usuario actualizado.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL para actualizar usuario
            if ($objeto->rol === "Encargado") {
                $vSQL = "UPDATE Usuario 
                SET telefono = '$objeto->telefono', 
                    correo_electronico = '$objeto->correo_electronico',
                    nombre = '$objeto->nombre',
                    direccion = '$objeto->direccion',
                    fecha_nacimiento = '$objeto->fecha_nacimiento',
                    contrasenna = '$objeto->contrasenna',
                    rol = '$objeto->rol',
                    estado = $objeto->estado,
                    idSucursal = $objeto->idSucursal
                WHERE id = '$objeto->id' AND estado = 1;";
            } else {
                $vSQL = "UPDATE Usuario 
                SET telefono = '$objeto->telefono', 
                    correo_electronico = '$objeto->correo_electronico',
                    nombre = '$objeto->nombre',
                    direccion = '$objeto->direccion',
                    fecha_nacimiento = '$objeto->fecha_nacimiento',
                    contrasenna = '$objeto->contrasenna',
                    rol = '$objeto->rol',
                    estado = 1
                WHERE id = '$objeto->id' AND estado = 1;";
            }

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el usuario actualizado
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método DELETE
    /**
     * Desactivar un usuario
     *
     * Cambia el estado de un usuario a "desactivado" en lugar de borrarlo de la base de datos.
     *
     * @param int $id El ID del usuario a desactivar.
     * @return string Mensaje de éxito o error.
     */
    public function delete($id)
    {
        try {
            // Consulta SQL para desactivar usuario
            $vSQL = "UPDATE Usuario SET estado = 0 WHERE id = $id;";

            // Ejecutar la consulta
            $this->enlace->executeSQL($vSQL);

            // Retornar mensaje de éxito
            return "Usuario eliminado con éxito.";
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion
}