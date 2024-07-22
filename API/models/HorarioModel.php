<?php
/**
 * Clase HorarioModel
 *
 * Esta clase maneja las operaciones de la base de datos para los Horarios.
 * Proporciona métodos para listar todos los Horarios, obtener un Horariopor su ID,
 * crear, actualizar y desactivar Horarios.
 */
class HorarioModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase HorarioModel
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
     * Listar todos los Horarios
     *
     * Obtiene todos los Horarios activos de la base de datos.
     *
     * @return array Lista de objetos de Horarios.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT h.id, h.horaInicio, h.horaFin, h.idSucursal, h.idDia, s.nombre as Sucursal
                    FROM Horario h
                    JOIN 
                        Sucursal s ON h.idSucursal = s.id
                    WHERE h.estado = 1
                    ORDER BY h.id DESC;";

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
     * Obtener Horariopor ID
     *
     * Obtiene un Horarioespecífico de la base de datos usando su ID.
     *
     * @param int $id El ID del Horarioa obtener.
     * @return object El objeto del Horario.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT h.id, h.horaInicio, h.horaFin, h.idSucursal, h.idDia, s.nombre as Sucursal
                     FROM Horario h
                     JOIN 
                        Sucursal s ON h.idSucursal = s.id
                     WHERE h.id = $id AND h.estado = 1;";
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
     * Crear un nuevo Horario
     *
     * Inserta un nuevo Horarioen la base de datos utilizando los datos proporcionados.
     *
     * @param object $objeto Los datos del Horarioa crear.
     * @return object El objeto del Horariocreado.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL para crear Horario
            $vSQL = "INSERT INTO Horario
            (horaInicio,
            horaFin,
            estado,
            idDia,
            idSucursal)
            VALUES 
            (
             $objeto->horaInicio,
             $objeto->horaFin,
              $objeto->estado,
              $objeto->idDia,
             $objeto->idSucursal);";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSQL);

            // Retornar el Horariocreado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método UPDATE
    /**
     * Actualizar un Horario
     *
     * Actualiza los datos de un Horarioen la base de datos.
     *
     * @param object $objeto Los datos del Horarioa actualizar.
     * @return object El objeto del Horarioactualizado.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL para actualizar Horario
           
            $vSQL = "UPDATE horario
                SET 
                horaInicio = '{$objeto->horaInicio}',
                horaFin = '{$objeto->horaFin}',
                estado = {$objeto->estado},
                idDia = {$objeto->idDia},
                idSucursal = {$objeto->idSucursal}
                WHERE id = {$objeto->id};";
           
            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el Horarioactualizado
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método DELETE
    /**
     * Desactivar un Horario
     *
     * Cambia el estado de un Horarioa "desactivado" en lugar de borrarlo de la base de datos.
     *
     * @param int $id El ID del Horarioa desactivar.
     * @return string Mensaje de éxito o error.
     */
    public function delete($id)
    {
        try {
            // Consulta SQL para desactivar Horario
            $vSQL = "UPDATE Horario
                     SET estado = 0,
                     WHERE id = $id;";

            // Ejecutar la consulta
            $this->enlace->executeSQL($vSQL);

            // Retornar mensaje de éxito
            return "Horario eliminada con éxito.";
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion
}