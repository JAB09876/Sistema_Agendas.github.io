<?php
/**
 * Clase citaModel
 *
 * Esta clase maneja las operaciones de la base de datos para los citas.
 * Proporciona métodos para listar todos los citas, obtener un cita por su ID,
 * crear, actualizar y desactivar citas.
 */
class citaModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase citaModel
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
     * Listar todos los citas
     *
     * Obtiene todos los citas activos de la base de datos.
     *
     * @return array Lista de objetos de citas.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT 
                        c.id,
                        c.fecha,
                        c.horaInicio AS [Hora de Inicio],
                        c.horaFin AS [Hora de Finalización],
                        c.idEstado,
                        c.idServicio,
                        s.nombre AS Sucursal,
                        m.nombre AS Medico,
                        serv.nombre AS Servicio,
                        ss.nombre AS SubServicio
                    FROM 
                        Sistema_Agenda.Cita c
                    LEFT JOIN 
                        Sistema_Agenda.Sucursal s ON c.idSucursal = s.id
                    LEFT JOIN 
                        Sistema_Agenda.Medico m ON c.idMedico = m.id
                    LEFT JOIN 
                        Sistema_Agenda.Servicio serv ON c.idServicio = serv.id
                    LEFT JOIN 
                        Sistema_Agenda.Servicio serv ON c.idSubServicio = ss.id
                    WHERE 
                        c.idEstado = 1 
                    ORDER BY 
                        c.fecha DESC;";

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
     * Obtener cita por ID
     *
     * Obtiene un cita específico de la base de datos usando su ID.
     *
     * @param int $id El ID del cita a obtener.
     * @return object El objeto del cita.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT 
                        c.id,
                        c.fecha,
                        c.horaInicio AS [Hora de Inicio],
                        c.horaFin AS [Hora de Finalización],
                        c.idEstado,
                        c.idServicio,
                        s.nombre AS Sucursal,
                        m.nombre AS Medico,
                        serv.nombre AS Servicio
                    FROM 
                        Sistema_Agenda.Cita c
                    LEFT JOIN 
                        Sistema_Agenda.Sucursal s ON c.idSucursal = s.id
                    LEFT JOIN 
                        Sistema_Agenda.Medico m ON c.idMedico = m.id
                    LEFT JOIN 
                        Sistema_Agenda.Servicio serv ON c.idServicio = serv.id
                    WHERE 
                        c.idEstado = 1 
                    ORDER BY 
                        c.fecha DESC;";
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
     * Crear un nuevo cita
     *
     * Inserta un nuevo cita en la base de datos utilizando los datos proporcionados.
     *
     * @param object $objeto Los datos del cita a crear.
     * @return object El objeto del cita creado.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL para crear cita
            $vSQL = "INSERT INTO Cita 
            (id, 
            fecha, 
            horaInicio, 
            horaFin,
            idEstado, 
            idServicio, 
            idMedico, 
            idSucursal) 
            VALUES 
            ('$objeto->id', 
            '$objeto->fecha', 
            $objeto->horaInicio, 
            $objeto->horaFin, 
            $objeto->idEstado, 
            $objeto->idServicio, 
            $objeto->idMedico, 
            $objeto->idSucursal);";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSQL);

            // Retornar el cita creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método UPDATE
    /**
     * Actualizar un cita
     *
     * Actualiza los datos de un cita en la base de datos.
     *
     * @param object $objeto Los datos del cita a actualizar.
     * @return object El objeto del cita actualizado.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL para actualizar cita
           
            $vSQL = "UPDATE Cita 
                     SET fecha = '$objeto->fecha',
                         horaIncio = $objeto->horaInicio,
                         horaFin = $objeto->horaFin,
                         idEstado = $objeto->idEstado,
                         idServicio = $objeto->idServicio,
                         idMedico =  $objeto->idMedico,
                         idSucursal = $objeto->idSucursal
                         WHERE id = '$objeto->id' AND estado = 1;";
           
            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el cita actualizado
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método DELETE
    /**
     * Desactivar un cita
     *
     * Cambia el estado de un cita a "desactivado" en lugar de borrarlo de la base de datos.
     *
     * @param int $id El ID del cita a desactivar.
     * @return string Mensaje de éxito o error.
     */
    public function delete($id)
    {
        try {
            // Consulta SQL para desactivar cita
            $vSQL = "UPDATE Cita 
                     SET estado = 0 
                     WHERE id = $id;";

            // Ejecutar la consulta
            $this->enlace->executeSQL($vSQL);

            // Retornar mensaje de éxito
            return "Cita eliminado con éxito.";
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion
}