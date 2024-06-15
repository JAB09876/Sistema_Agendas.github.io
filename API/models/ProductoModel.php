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
            $vSQL = "SELECT 
                        p.id AS id_producto,
                        p.nombre AS nombre_producto,
                        p.descripcion AS descripcion_producto,
                        p.precio AS precio_producto,
                        p.estado AS estado_producto,
                        c.id AS id_categoria,
                        c.descripcion AS descripcion_categoria,
                        m.id AS id_marca,
                        m.nombre AS nombre_marca
                    FROM 
                        Producto p
                    INNER JOIN 
                        Categoria c ON p.idCategoria = c.id
                    INNER JOIN 
                        Marca m ON p.idMarca = m.id
                    WHERE p.estado = 1
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
            $vSQL = "SELECT 
                        p.id AS id_producto,
                        p.nombre AS nombre_producto,
                        p.descripcion AS descripcion_producto,
                        p.precio AS precio_producto,
                        p.estado AS estado_producto,
                        c.id AS id_categoria,
                        c.descripcion AS descripcion_categoria,
                        m.id AS id_marca,
                        m.nombre AS nombre_marca
                    FROM 
                        Producto p
                    INNER JOIN 
                        Categoria c ON p.idCategoria = c.id
                    INNER JOIN 
                        Marca m ON p.idMarca = m.id
                    WHERE p.estado = 1 AND p.id = $id
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