<?php
/**
 * Clase servicioModel
 *
 * Esta clase maneja las operaciones de la base de datos para los servicios.
 * Proporciona métodos para listar todos los servicios, obtener un servicio por su ID,
 * crear, actualizar y desactivar servicios.
 */
class servicioModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase servicioModel
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
     * Listar todos los servicios
     *
     * Obtiene todos los servicios activos de la base de datos.
     *
     * @return array Lista de objetos de servicios.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT 
                        s.id AS id,                 
                        s.nombre AS Nombre,        
                        s.nivel_atencion AS Nivel,  
                        es.id AS EspecialidadId,  
                        es.descripcion AS Especialidad,  
                        e.descripcion AS Estado     
                    FROM 
                        Servicio s
                    JOIN 
                        Especialidad es ON s.idEspecialidad = es.id  
                    JOIN 
                        Estado e ON e.id = s.estado                
                    ORDER BY 
                        s.id DESC;                                  
                    ";

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
     * Obtener servicio por ID
     *
     * Obtiene un servicio específico de la base de datos usando su ID.
     *
     * @param int $id El ID del servicio a obtener.
     * @return object El objeto del servicio.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT 
                            s.id AS id,                 
                            s.nombre AS Nombre,        
                            s.nivel_atencion AS Nivel,  
                            es.id AS EspecialidadId,  
                            es.descripcion AS Especialidad,  
                            e.descripcion AS Estado     
                        FROM 
                            Servicio s
                        JOIN 
                            Especialidad es ON s.idEspecialidad = es.id  
                        JOIN 
                            Estado e ON e.id = s.estado          
                    WHERE s.id = $id AND s.estado = 1;";

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
     * Crear un nuevo servicio
     *
     * Inserta un nuevo servicio en la base de datos utilizando los datos proporcionados.
     *
     * @param object $objeto Los datos del servicio a crear.
     * @return object El objeto del servicio creado.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL para crear servicio
            $vSQL = "INSERT INTO Servicio 
            (nombre, 
             nivel_atencion, 
             estado, 
             idEspecialidad) 
            VALUES (
             '$objeto->nombre',
             '$objeto->nivel',
              $objeto->estado,
              $objeto->especialidad)";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSQL);

            // Retornar el servicio creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método UPDATE
    /**
     * Actualizar un servicio
     *
     * Actualiza los datos de un servicio en la base de datos.
     *
     * @param object $objeto Los datos del servicio a actualizar.
     * @return object El objeto del servicio actualizado.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL para actualizar servicio
           
            $vSQL = "UPDATE Servicio 
                    SET nombre = '$objeto->nombre',
                        nivel_atencion = '$objeto->nivel',
                        estado = $objeto->estado,
                        idEspecialidad = $objeto->especialidad
                    WHERE id = $objeto->id";
           
            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el servicio actualizado
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método DELETE
    /**
     * Desactivar un servicio
     *
     * Cambia el estado de un servicio a "desactivado" en lugar de borrarlo de la base de datos.
     *
     * @param int $id El ID del servicio a desactivar.
     * @return string Mensaje de éxito o error.
     */
    public function delete($id)
    {
        try {
            // Consulta SQL para desactivar servicio
            $vSQL = "UPDATE Servicio 
                     SET estado = 0 
                     WHERE id = $id;";

            // Ejecutar la consulta
            $this->enlace->executeSQL($vSQL);

            // Retornar mensaje de éxito
            return "Servicio eliminado con éxito.";
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion
}