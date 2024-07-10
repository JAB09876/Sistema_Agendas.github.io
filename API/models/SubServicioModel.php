<?php
/**
 * Clase subservicioModel
 *
 * Esta clase maneja las operaciones de la base de datos para los subservicios.
 * Proporciona métodos para listar todos los subservicios, obtener un subservicio por su ID,
 * crear, actualizar y desactivar subservicios.
 */
class subservicioModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase subservicioModel
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
     * Listar todos los subservicios
     *
     * Obtiene todos los subservicios activos de la base de datos.
     *
     * @return array Lista de objetos de subservicios.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT *
                     FROM Subservicio
                     WHERE estado = 1;";

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
     * Obtener subservicio por ID
     *
     * Obtiene un subservicio específico de la base de datos usando su ID.
     *
     * @param int $id El ID del subservicio a obtener.
     * @return object El objeto del subservicio.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT * 
                     FROM Subservicio
                     WHERE estado = 1 AND id = $id;";
            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el resultado
            return $vResultado[0];
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

     #region Método GETPRECIO
    /**
     * Obtener subservicio por ID
     *
     * Obtiene el precio del subservicio específico de la base de datos usando su ID.
     *
     * @param int $id El ID del subservicio a obtener.
     * @return double El precio del subservicio.
     */
    public function getPrecio($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT monto  
                     FROM Subservicio
                     WHERE estado = 1 AND id = $id;";
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
     * Crear un nuevo subservicio
     *
     * Inserta un nuevo subservicio en la base de datos utilizando los datos proporcionados.
     *
     * @param object $objeto Los datos del subservicio a crear.
     * @return object El objeto del subservicio creado.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL para crear subservicio
            $vSQL = "INSERT INTO Subservicio 
                (tiempo, 
                descripcion, 
                nombre, 
                monto, 
                estado, 
                idServicio) 
                VALUES (
                $objeto->tiempo,
                '$objeto->descripcion',
                '$objeto->nombre',
                $objeto->monto,
                $objeto->estado,
                $objeto->idServicio);";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSQL);

            // Retornar el subservicio creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método UPDATE
    /**
     * Actualizar un subservicio
     *
     * Actualiza los datos de un subservicio en la base de datos.
     *
     * @param object $objeto Los datos del subservicio a actualizar.
     * @return object El objeto del subservicio actualizado.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL para actualizar subservicio
           
            $vSQL = "UPDATE Subservicio 
                SET tiempo = $objeto->tiempo,
                    descripcion = '$objeto->descripcion',
                    nombre = '$objeto->nombre',
                    monto = $objeto->monto,
                    estado = $objeto->estado,
                    idServicio = $objeto->idServicio
                WHERE id = $objeto->id;";
           
            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el subservicio actualizado
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método DELETE
    /**
     * Desactivar un subservicio
     *
     * Cambia el estado de un subservicio a "desactivado" en lugar de borrarlo de la base de datos.
     *
     * @param int $id El ID del subservicio a desactivar.
     * @return string Mensaje de éxito o error.
     */
    public function delete($id)
    {
        try {
            // Consulta SQL para desactivar subservicio
            $vSQL = "UPDATE Subservicio 
                     SET estado = 0 
                     WHERE id = $id;";

            // Ejecutar la consulta
            $this->enlace->executeSQL($vSQL);

            // Retornar mensaje de éxito
            return "Subservicio eliminado con éxito.";
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion
}