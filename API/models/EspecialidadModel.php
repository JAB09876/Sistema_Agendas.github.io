<?php
/**
 * Clase especialidadModel
 *
 * Esta clase maneja las operaciones de la base de datos para los especialidads.
 * Proporciona métodos para listar todos los especialidads, obtener un especialidad por su ID,
 * crear, actualizar y desactivar especialidads.
 */
class especialidadModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase especialidadModel
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
     * Listar todos los especialidads
     *
     * Obtiene todos los especialidads activos de la base de datos.
     *
     * @return array Lista de objetos de especialidads.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT * FROM Sistema_Agenda.Especialidad;";

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
     * Obtener especialidad por ID
     *
     * Obtiene un especialidad específico de la base de datos usando su ID.
     *
     * @param int $id El ID del especialidad a obtener.
     * @return object El objeto del especialidad.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT * FROM Sistema_Agenda.Especialidad;";
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
     * Crear un nuevo especialidad
     *
     * Inserta un nuevo especialidad en la base de datos utilizando los datos proporcionados.
     *
     * @param object $objeto Los datos del especialidad a crear.
     * @return object El objeto del especialidad creado.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL para crear especialidad
            $vSQL = "INSERT INTO especialidad 
            (id, 
            descripcion,
            idEstado
            VALUES 
            ('$objeto->id', 
            '$objeto->idEstado', 
            '$objeto->descripcion';";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSQL);

            // Retornar el especialidad creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método UPDATE
    /**
     * Actualizar un especialidad
     *
     * Actualiza los datos de un especialidad en la base de datos.
     *
     * @param object $objeto Los datos del especialidad a actualizar.
     * @return object El objeto del especialidad actualizado.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL para actualizar especialidad
           
            $vSQL = "UPDATE especialidad 
            SET 
                descripcion = '$objeto->descripcion',
                idEstado = '$objeto->idEstado'
            WHERE id = '$objeto->id';";
           
            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el especialidad actualizado
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método DELETE
    /**
     * Desactivar un especialidad
     *
     * Cambia el estado de un especialidad a "desactivado" en lugar de borrarlo de la base de datos.
     *
     * @param int $id El ID del especialidad a desactivar.
     * @return string Mensaje de éxito o error.
     */
    public function delete($id)
    {
        try {
            // Consulta SQL para desactivar especialidad
            $vSQL = "UPDATE especialidad SET estado = 0 WHERE id = $id;";

            // Ejecutar la consulta
            $this->enlace->executeSQL($vSQL);

            // Retornar mensaje de éxito
            return "Especialidad eliminada con éxito.";
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion
}