<?php
/**
 * Clase SucursalModel
 *
 * Esta clase maneja las operaciones de la base de datos para las Sucursales.
 * Proporciona métodos para listar todas las Sucursales, obtener una Sucursal por su ID,
 * crear, actualizar y desactivar Sucursales.
 */
class SucursalModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase SucursalModel
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
     * Listar todas las Sucursales
     *
     * Obtiene todas las Sucursales activas de la base de datos.
     *
     * @return array Lista de objetos de Sucursales.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT * 
                     FROM Sucursal
                     WHERE estado = 1
                     ORDER BY id DESC;";

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
     * Obtener Sucursal por ID
     *
     * Obtiene una Sucursal específica de la base de datos usando su ID.
     *
     * @param int $id El ID de la Sucursal a obtener.
     * @return object El objeto del Sucursal.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT * 
                     FROM Sucursal
                     WHERE id = $id AND estado = 1;";
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
     * Crear una nueva Sucursal
     *
     * Inserta una nueao Sucursal en la base de datos utilizando las datos proporcionados.
     *
     * @param object $objeto las datos de la Sucursal a crear.
     * @return object El objeto de la Sucursal creado.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL para crear Sucursal
            $vSQL = "INSERT INTO Sucursal 
                (nombre, 
                telefono,
                estado, 
                correo_electronico, 
                direccion_exacta) 
                VALUES (
                '$objeto->nombre',
                '$objeto->telefono',
                $objeto->estado,
                '$objeto->correo_electronico',
                '$objeto->direccion_exacta');";

            $vResultado = $this->enlace->executeSQL_DML_last($vSQL);
            // Retornar el Sucursal creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método UPDATE
    /**
     * Actualizar una Sucursal
     *
     * Actualiza las datos de una Sucursal en la base de datos.
     *
     * @param object $objeto las datos del Sucursal a actualizar.
     * @return object El objeto del Sucursal actualizado.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL para actualizar Sucursal
           
            $vSQL = "UPDATE Sucursal 
                    SET nombre = '$objeto->nombre',
                        telefono = '$objeto->telefono',
                        estado = $objeto->estado,
                        correo_electronico = '$objeto->correo_electronico',
                        direccion_exacta = '$objeto->direccion_exacta'
                    WHERE id = $objeto->id;";

           
            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el mensaje de que todo salió bien
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método DELETE
    /** 
     * Desactivar una Sucursal
     *
     * Cambia el estado de una Sucursal a "desactivada" en lugar de borrarlo de la base de datos.
     *
     * @param int $id El ID del Sucursal a desactivar.
     * @return string Mensaje de éxito o error.
     */
    public function delete($id)
    {
        try {
            // Consulta SQL para desactivar Sucursal
            $vSQL = "UPDATE Sucursal 
                     SET estado = 0 
                     WHERE id = $id;";

            // Ejecutar la consulta
            $this->enlace->executeSQL($vSQL);

            // Retornar mensaje de éxito
            return "Sucursal eliminada con éxito.";
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método GETNOMBREBYID
    /**
     * Obtener nombre de Sucursal por ID
     *
     * Obtiene una nombre deSucursal específica de la base de datos usando su ID.
     *
     * @param int $id El ID de la Sucursal a obtener.
     * @return string El nombre de la Sucursal a consultar.
     */
    public function getNombreById($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT nombre 
                     FROM Sucursal
                     WHERE id = $id AND estado = 1;";
            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el resultado
            return $vResultado[0];
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

}