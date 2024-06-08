<?php
/**
 * Clase medicoModel
 *
 * Esta clase maneja las operaciones de la base de datos para los medicos.
 * Proporciona métodos para listar todos los medicos, obtener un medico por su ID,
 * crear, actualizar y desactivar medicos.
 */
class medicoModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase medicoModel
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
     * Listar todos los medicos
     *
     * Obtiene todos los medicos activos de la base de datos.
     *
     * @return array Lista de objetos de medicos.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT * FROM Sistema_Agenda.medico;";

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
     * Obtener medico por ID
     *
     * Obtiene un medico específico de la base de datos usando su ID.
     *
     * @param int $id El ID del medico a obtener.
     * @return object El objeto del medico.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT * FROM Sistema_Agenda.medico;";
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
     * Crear un nuevo medico
     *
     * Inserta un nuevo medico en la base de datos utilizando los datos proporcionados.
     *
     * @param object $objeto Los datos del medico a crear.
     * @return object El objeto del medico creado.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL para crear medico
            $vSQL = "INSERT INTO Medico 
                (nombre, 
                foto, 
                idEspecialidad, 
                idEstado,
                idSucursal) 
                VALUES (
                '$objeto->nombre',
                '$objeto->foto',
                $objeto->idEspecialidad,
                $objeto->idEstado,
                $objeto->idSucursal);";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSQL);

            // Retornar el medico creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método UPDATE
    /**
     * Actualizar un medico
     *
     * Actualiza los datos de un medico en la base de datos.
     *
     * @param object $objeto Los datos del medico a actualizar.
     * @return object El objeto del medico actualizado.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL para actualizar medico
           
            $vSQL = "UPDATE servicio 
            SET nombre = '$objeto->nombre',
                foto = '$objeto->foto',
                idEspecialidad = $objeto->idEspecialidad,
                idEstado = $objeto->estado,
                idSucursal = $objeto->idSucursal
            WHERE id = $objeto->id;";
           
            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el medico actualizado
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método DELETE
    /**
     * Desactivar un medico
     *
     * Cambia el estado de un medico a "desactivado" en lugar de borrarlo de la base de datos.
     *
     * @param int $id El ID del medico a desactivar.
     * @return string Mensaje de éxito o error.
     */
    public function delete($id)
    {
        try {
            // Consulta SQL para desactivar medico
            $vSQL = "UPDATE medico SET estado = 0 WHERE id = $id;";

            // Ejecutar la consulta
            $this->enlace->executeSQL($vSQL);

            // Retornar mensaje de éxito
            return "medico eliminada con éxito.";
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion
}