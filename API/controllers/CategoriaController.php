<?php
/**
 * Clase Categoria
 *
 * Esta clase se encarga de manejar las operaciones CRUD para las categorías.
 * Provee métodos para listar todas las categorías, obtener una categoría por su ID,
 * crear, actualizar y "eliminar" (desactivar) categorías.
 */
class Categoria
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos los registros de categorías de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de categorías y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $categoriaM = new CategoriaModel();

        // Obtener todos los registros de categorías
        $response = $categoriaM->all();

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
     * Obtiene un registro de categoría por su ID.
     *
     * @param int $id El ID del categoría a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del categoría y establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $categoriaM = new CategoriaModel();

        // Obtener el registro de categoría por ID
        $response = $categoriaM->get($id);

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
     * Obtiene un registro de categoría utilizando los datos recibidos en formato JSON.
     * El nombre de la categoría debe ser proporcionado en el cuerpo de la solicitud JSON.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el resultado de la operación y establece el código de respuesta HTTP.
     */
    public function create()
    {
        // Obtener el JSON del cuerpo de la solicitud
        $inputJSON = file_get_contents("php://input");

        // Decodificar el JSON en un objeto PHP
        $objeto = json_decode($inputJSON);

        // Instancia del modelo
        $categoriaM = new CategoriaModel();

        // Llamar al método del modelo para obtener la categoría
        $result = $categoriaM->getByNombre($objeto);

        // Formatear la respuesta
        if ($result) {
            $json = [
                "status" => 200,
                "results" => $result,
            ];
        } else {
            $json = [
                "status" => 400,
                "results" => "Error al obtener la categoría",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json, http_response_code($json["status"]));
    }
    #endregion
}
