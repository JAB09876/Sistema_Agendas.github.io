<?php
/**
 * Clase estadoModel
 *
 * Esta clase maneja las operaciones de la base de datos para los estados.
 * Proporciona métodos para listar todos los estados, obtener un estado por su ID,
 * crear, actualizar y desactivar estados.
 */
class estadoModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase estadoModel
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
     * Listar todos los estados
     *
     * Obtiene todos los estados activos de la base de datos.
     *
     * @return array Lista de objetos de estados.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT descripcion as Estado, id as id
                    FROM estado;";

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
     * Obtener estado por ID
     *
     * Obtiene un estado específico de la base de datos usando su ID.
     *
     * @param int $id El ID del estado a obtener.
     * @return object El objeto del estado.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT descripcion, id as id
                 FROM estado
                 WHERE id=$id;";
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