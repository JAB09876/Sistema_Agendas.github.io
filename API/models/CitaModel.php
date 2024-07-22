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
            $vSQL = "SELECT c.id AS Cita,
                        u.nombre AS Cliente,
                        c.fecha AS Fecha,
                        u.id AS ClienteId,
                        c.horaInicio AS HoraInicio,
                        c.horaFin AS HoraFin,
                        e.descripcion AS Estado,
                        ss.nombre AS SubServicio,
                        ss.id AS SubServicioId,
                        s.nombre AS Sucursal,
                        m.nombre AS Medico,
                        m.id AS MedicoId
                 FROM Cita c
                 JOIN Usuario u ON u.id = c.idCliente
                 JOIN Estado e ON e.id = c.idEstado
                 JOIN Subservicio ss ON ss.id = c.idSubServicio
                 JOIN Sucursal s ON s.id = c.idSucursal
                 JOIN Medico m ON m.id = c.idMedico
                 ORDER BY c.id DESC;";

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
            $vSQL = "SELECT c.id AS Cita,
                        u.nombre AS Cliente,
                        c.fecha AS Fecha,
                        u.id AS ClienteId,
                        c.horaInicio AS HoraInicio,
                        c.horaFin AS HoraFin,
                        e.descripcion AS Estado,
                        ss.nombre AS SubServicio,
                        ss.id AS SubServicioId,
                        s.nombre AS Sucursal,
                        s.id AS SucursalId,
                        m.nombre AS Medico,
                         m.id AS MedicoId
                        FROM Cita c
                        JOIN Usuario u ON u.id = c.idCliente
                        JOIN Estado e ON e.id = c.idEstado
                        JOIN Subservicio ss ON ss.id = c.idSubServicio
                        JOIN Sucursal s ON s.id = c.idSucursal
                        JOIN Medico m ON m.id = c.idMedico
                    WHERE c.id = $id
                    ORDER BY c.id ASC;";
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
                (
                idCliente,
                fecha, 
                horaInicio, 
                horaFin,
                idEstado, 
                idSubServicio,
                idMedico,
                idSucursal) 
                VALUES 
                (
                $objeto->idCliente,
                '$objeto->fecha', 
                '$objeto->horaInicio', 
                '$objeto->horaFin', 
                $objeto->idEstado, 
                $objeto->idSubServicio, 
                $objeto->idMedico, 
                $objeto->idSucursal)";

        // Ejecutar la consulta de inserción
        $vResultado = $this->enlace->executeSQL_DML_last($vSQL);

        // Retornar la cita creada
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
             // Validaciones
        $vSQLVal = "SELECT COUNT(*) AS citas_programadas
        FROM Cita
        WHERE idMedico = '$objeto->idMedico' 
        AND fecha = '$objeto->fecha' 
        AND horaInicio = $objeto->horaInicio 
        AND horaFin = $objeto->horaFin";

        // Ejecutar la consulta para verificar citas programadas
        $resultados = $this->enlace->executeSQL($vSQLVal, 'asoc');

        // Obtener el número de citas programadas
        $citas_programadas = $resultados[0]['citas_programadas'];

        // Verificar si hay citas programadas para el médico en esa fecha y hora
        if ($citas_programadas > 0) {
        return "El doctor tiene citas programadas para esa fecha y hora";
        }

            // Consulta SQL para actualizar cita
            $vSQL = "UPDATE Cita 
                SET fecha = '$objeto->fecha',
                    horaInicio = $objeto->horaInicio,
                    horaFin = $objeto->horaFin,
                    idEstado = $objeto->idEstado,
                    idSubServicio = $objeto->idSubServicio,
                    idMedico = $objeto->idMedico,
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