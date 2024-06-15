<?php
/**
 * Clase CategoriaModel
 *
 * Esta clase maneja las operaciones de la base de datos para las categorias.
 * Proporciona métodos para listar todas las categorias y obtener una categoría por su ID.
 */
class CategoriaModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase CategoriaModel
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
     * Listar todas las categorías
     *
     * Obtiene todas las categorías activos de la base de datos.
     *
     * @return array Lista de objetos de categorías.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT * 
                     FROM Categoria
                     ORDER BY descripcion ASC;";

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
     * Obtener categoria por ID
     *
     * Obtiene un categoria específico de la base de datos usando su ID.
     *
     * @param int $id El ID de la categoria a obtener.
     * @return object El objeto de la categoria.
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
            return $vResultado[0];
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion
}