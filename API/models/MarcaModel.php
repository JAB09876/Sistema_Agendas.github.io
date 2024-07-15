<?php
/**
 * Clase MarcaModel
 *
 * Esta clase maneja las operaciones de la base de datos para las marcas.
 * Proporciona métodos para listar todas las marcas y obtener una marca por su ID o nombre.
 */
class MarcaModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase MarcaModel
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
     * Listar todas las marcas
     *
     * Obtiene todas las marcas activas de la base de datos ordenadas por ID descendente.
     *
     * @return array Lista de objetos de marcas.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT * 
                     FROM Marca
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
     * Obtener marca por ID
     *
     * Obtiene una marca específica de la base de datos usando su ID.
     *
     * @param int $id El ID de la marca a obtener.
     * @return object El objeto de la marca.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT *
                     FROM Marca
                     WHERE id = $id;";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el resultado
            return $vResultado[0];
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    /**
     * Obtener marca por nombre
     *
     * Obtiene una marca específica de la base de datos usando su nombre.
     *
     * @param object $objeto Objeto con el nombre de la marca.
     * @return object|null El objeto de la marca si se encuentra, o null si no existe.
     */
    public function getByNombre($objeto)
    {
        try {
            // Consulta SQL
            $nombre = $objeto->nombre;
            $vSQL = "SELECT *
                     FROM Marca
                     WHERE nombre = '$nombre';";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el resultado, o null si no se encuentra ninguna marca
            return isset($vResultado[0]) ? $vResultado[0] : null;
        } catch (Exception $e) {
            die("" . $e->getMessage()); // Manejo básico de errores
        }
    }
}
