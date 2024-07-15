<?php
/**
 * Clase CategoriaModel
 *
 * Esta clase maneja las operaciones de la base de datos para las categorías.
 * Proporciona métodos para listar todas las categorías, obtener una categoría por su ID,
 * y buscar una categoría por su nombre.
 */
class CategoriaModel
{
    /**
     * @var MySqlConnect $enlace Objeto de conexión a la base de datos MySQL.
     */
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase CategoriaModel
     *
     * Inicializa la conexión con la base de datos.
     */
    public function __construct()
    {
        $this->enlace = new MySqlConnect(); // Suponiendo que MySqlConnect es la clase para la conexión a MySQL.
    }
    #endregion

    #region Método ALL
    /**
     * Listar todas las categorías
     *
     * Obtiene todas las categorías activas de la base de datos ordenadas por ID descendente.
     *
     * @return array Lista de objetos de categorías.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT * 
                     FROM Categoria
                     ORDER BY id DESC;";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el resultado
            return $vResultado;
        } catch (Exception $e) {
            die("" . $e->getMessage()); // Manejo básico de errores
        }
    }
    #endregion

    #region Método GET
    /**
     * Obtener categoría por ID
     *
     * Obtiene una categoría específica de la base de datos usando su ID.
     *
     * @param int $id El ID de la categoría a obtener.
     * @return object|null El objeto de la categoría si se encuentra, o null si no hay resultados.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT *
                     FROM Categoria
                     WHERE id = $id;";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el resultado
            return isset($vResultado[0]) ? $vResultado[0] : null;
        } catch (Exception $e) {
            die("" . $e->getMessage()); // Manejo básico de errores
        }
    }
    #endregion

    #region Método getByNombre
    /**
     * Obtener categoría por nombre
     *
     * Busca una categoría específica en la base de datos usando su nombre (descripción).
     *
     * @param object $objeto Objeto que contiene el nombre de la categoría en la propiedad 'descripcion'.
     * @return object|null El objeto de la categoría si se encuentra, o null si no hay resultados.
     */
    public function getByNombre($objeto)
    {
        try {
            // Consulta SQL
            $descripcion = $objeto->descripcion; // Suponiendo que 'descripcion' es un campo en el objeto
            $vSQL = "SELECT *
                     FROM Categoria
                     WHERE descripcion = '$descripcion';";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el resultado
            return isset($vResultado[0]) ? $vResultado[0] : null;
        } catch (Exception $e) {
            die("" . $e->getMessage()); // Manejo básico de errores
        }
    }
    #endregion
}