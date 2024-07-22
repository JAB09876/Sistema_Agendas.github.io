<?php
/**
 * Clase Producto
 *
 * Esta clase se encarga de manejar las operaciones CRUD para los productos.
 * Provee métodos para listar todos los productos, obtener un producto por su ID,
 * crear, actualizar y "eliminar" (desactivar) productos.
 */
class producto
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos los registros de productos de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de productos y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $productoM = new ProductoModel();

        // Obtener todos los registros de productos
        $response = $productoM->all();

        // Formatear la respuesta
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "results" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "results" => "No hay registros",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json, http_response_code($json["status"]));
    }
    #endregion

    #region Método GET
    /**
     * Método get
     *
     * Obtiene un registro de producto por su ID.
     *
     * @param int $id El ID del producto a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del producto y establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $productoM = new ProductoModel();

        // Obtener el registro de producto por ID
        $response = $productoM->get($id);

        // Formatear la respuesta
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "results" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "results" => "No hay registros",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json, http_response_code($json["status"]));
    }
    #endregion

     #region Método CREATE
    /**
     * Método create
     *
     * Crea un nuevo producto utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método create del modelo ProductoModel para insertar el producto en la base de datos.
     * Finalmente, devuelve una respuesta JSON indicando el resultado de la operación.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON y establece el código de respuesta HTTP.
     */
    public function create()
    {
        // Obtener el JSON de la entrada estándar
        $inputJSON = file_get_contents("php://input");

        // Decodificar el JSON en un objeto
        $object = json_decode($inputJSON);

        // Instanciar el modelo ProductoModel
        $productoM = new ProductoModel();

        // Llamar al método create del modelo para insertar el producto en la base de datos
        $response = $productoM->create($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => "Producto creado con éxito",
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo crear el producto",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json);
        http_response_code($json["status"]);
    }
    #endregion

    #region Método UPDATE
    /**
     * Método update
     *
     * Actualiza todos los datos de un producto utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método update del modelo ProductoModel para actualizar el producto en la base de datos.
     * Finalmente, devuelve una respuesta JSON indicando el resultado de la operación.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON y establece el código de respuesta HTTP.
     */
    public function update()
    {
        // Obtener el JSON de la entrada estándar
        $inputJSON = file_get_contents("php://input");

        // Decodificar el JSON en un objeto
        $object = json_decode($inputJSON);

        // Instanciar el modelo ProductoModel
        $productoM = new ProductoModel();

        // Llamar al método update del modelo para actualizar el producto en la base de datos
        $response = $productoM->update($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => "Producto actualizado",
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo actualizar el producto",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json);
        http_response_code($json["status"]);
    }
    #endregion
}