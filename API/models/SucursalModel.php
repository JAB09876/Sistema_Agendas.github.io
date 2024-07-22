<?php
/**
 * Clase SucursalModel
 *
 * Esta clase maneja las operaciones de la base de datos para los Sucursals.
 * Proporciona métodos para listar todos los Sucursals, obtener un Sucursal por su ID,
 * crear, actualizar y desactivar Sucursals.
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
     * Listar todos los Sucursals
     *
     * Obtiene todos los Sucursals activos de la base de datos.
     *
     * @return array Lista de objetos de Sucursals.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT * FROM Sistema_Agenda.Sucursal;";

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
     * Obtiene un Sucursal específico de la base de datos usando su ID.
     *
     * @param int $id El ID del Sucursal a obtener.
     * @return object El objeto del Sucursal.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT * FROM Sistema_Agenda.Sucursal;";
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
     * Crear un nuevo Sucursal
     *
     * Inserta un nuevo Sucursal en la base de datos utilizando los datos proporcionados.
     *
     * @param object $objeto Los datos del Sucursal a crear.
     * @return object El objeto del Sucursal creado.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL para crear Sucursal
            $vSQL = "INSERT INTO Sucursal 
                (nombre, 
                telefono, 
                correo_electronico, 
                direccion_exacta) 
                VALUES (
                '$objeto->nombre',
                '$objeto->telefono',
                '$objeto->correo_electronico',
                '$objeto->direccion_exacta');";

            // Ejecutar la consulta
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
     * Actualizar un Sucursal
     *
     * Actualiza los datos de un Sucursal en la base de datos.
     *
     * @param object $objeto Los datos del Sucursal a actualizar.
     * @return object El objeto del Sucursal actualizado.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL para actualizar Sucursal
           
            $vSQL = "UPDATE Sucursal 
                SET nombre = '$objeto->nombre',
                    telefono = '$objeto->telefono',
                    correo_electronico = '$objeto->correo_electronico',
                    direccion_exacta = '$objeto->direccion_exacta'
                WHERE id = $objeto->id;";

           
            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el Sucursal actualizado
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método DELETE
    /**
     * Desactivar un Sucursal
     *
     * Cambia el estado de un Sucursal a "desactivado" en lugar de borrarlo de la base de datos.
     *
     * @param int $id El ID del Sucursal a desactivar.
     * @return string Mensaje de éxito o error.
     */
    /*public function delete($id)
    {
        try {
            // Consulta SQL para desactivar Sucursal
            $vSQL = "UPDATE Sucursal SET estado = 0 WHERE id = $id;";

            // Ejecutar la consulta
            $this->enlace->executeSQL($vSQL);

            // Retornar mensaje de éxito
            return "Sucursal eliminado con éxito.";
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }*/
    #endregion
}