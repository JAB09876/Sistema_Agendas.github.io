<?php
/**
 * Clase ProdctoModel
 *
 * Esta clase maneja las operaciones de la base de datos para los productos.
 * Proporciona métodos para listar todos los productos, obtener un producto por su ID,
 * crear, actualizar y desactivar productos.
 */
class ProductoModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase ProductoModel
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
     * Listar todos los productos
     *
     * Obtiene todos los productos activos de la base de datos.
     *
     * @return array Lista de objetos de productos.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT p.nombre AS Producto,
                        p.precio AS Percio,
                        m.nombre AS Marca,
                        c.descripcion AS Categoría
                     FROM Producto p, Categoria c, Marca m
                     WHERE p.estado = 1 AND c.id = p.idCategoria AND m.id = p.idMarca
                     ORDER BY p.id ASC;";

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
     * Obtener producto por ID
     *
     * Obtiene un producto específico de la base de datos usando su ID.
     *
     * @param int $id El ID del producto a obtener.
     * @return object El objeto del producto.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT p.nombre AS Producto,
                        p.precio AS Percio,
                        p.descripcion AS Descripción,
                        p.estado AS Estado,
                        m.nombre AS Marca,
                        c.descripcion AS Categoría
                     FROM Producto p, Categoria c, Marca m
                     WHERE p.estado = 1 AND p.id = $id AND c.id = p.idCategoria AND m.id = p.idMarca
                     ORDER BY p.id ASC;";

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
     * Crear un nuevo producto
     *
     * Inserta un nuevo producto en la base de datos utilizando los datos proporcionados.
     *
     * @param object $objeto Los datos del producto a crear.
     * @return object El objeto del producto creado.
     */
    public function create($objeto)
    {
        try {

             // Manejar la imagen
            $imagen = $objeto->imagen; // Esto debería ser la ruta temporal de la imagen subida
            $imageData = file_get_contents($imagen);

            // Consulta SQL para crear producto
            $vSQL = "INSERT INTO Producto 
                (nombre, 
                descripcion, 
                precio, 
                estado, 
                imagen,
                idCategoria, 
                idMarca) 
                VALUES ('$objeto->nombre',
                '$objeto->descripcion',
                $objeto->precio,
                $objeto->estado,
                $imageData,
                $objeto->idCategoria,
                $objeto->idMarca);";
            
            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSQL);

            // Retornar el producto creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion
}