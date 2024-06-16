<?php
/**
 * Clase FacturaModel
 *
 * Esta clase maneja las operaciones de la base de datos para las facturas.
 * Proporciona métodos para listar todos los facturas, obtener una factura por su ID,
 * crear, actualizar y desactivar facturas.
 */
class FacturaModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase FacturaModel
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
     * Listar todos los facturas
     *
     * Obtiene todos los facturas activos de la base de datos.
     *
     * @return array Lista de objetos de facturas.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT f.fecha AS Fecha,
                        f.total AS Total,
                        u.nombre AS Cliente,
                        s.nombre AS Sucursal
                     FROM Factura f, Usuario u, Sucursal s
                     WHERE f.estado = 1 AND u.id = f.idUsuario AND s.id = f.idSucursal;";

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
     * Listar todos las facturas
     *
     * Obtiene todos los facturas activas de la base de datos.
     *
     * @return array Lista de objetos de facturas.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT 
                        f.id AS Factura, 
                        f.fecha AS Fecha,
                        f.total AS Total,
                        f.estado AS Estado,
                        d.id AS Detalle,
                        d.cantidad AS Cantidad,
                        u.id AS Cliente,
                        u.nombre AS NombreCliente,
                        s.nombre AS Sucursal,
                        COALESCE(p.nombre, 'Producto no encontrado') AS Producto,
                        sb.nombre AS Subservicio,
                        c.id AS Cita
                    FROM 
                        Factura f
                        JOIN Factura_Detalle d ON f.id = d.idFactura
                        JOIN Usuario u ON f.idUsuario = u.id
                        JOIN Sucursal s ON f.idSucursal = s.id
                        LEFT JOIN Producto p ON d.idProducto = p.id
                        JOIN Subservicio sb ON d.idSubservicio = sb.id
                        LEFT JOIN Cita c ON c.idCliente = u.id
                    WHERE 
                        f.estado = 1 AND f.id = $id
                    ORDER BY 
                    f.id ASC;";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el resultado
            return $vResultado;
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

}