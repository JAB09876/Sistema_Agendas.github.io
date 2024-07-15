<?php
/**
 * Clase Marca
 *
 * Esta clase se encarga de manejar las operaciones CRUD para las marcas.
 * Provee métodos para listar todas las marcas, obtener una marca por su ID,
 * crear y obtener marcas por su nombre.
 */
class Marca
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos los registros de marcas de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de marcas y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $marcaM = new MarcaModel();

        // Obtener todos los registros de marcas
        $response = $marcaM->all();

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
     * Obtiene un registro de marca por su ID.
     *
     * @param int $id El ID de la marca a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro de la marca y establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $marcaM = new MarcaModel();

        // Obtener el registro de marca por ID
        $response = $marcaM->get($id);

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
     * Busca una marca utilizando los datos recibidos en formato JSON.
     * El nombre de la marca debe ser proporcionado en el cuerpo de la solicitud JSON.
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
        $marcaM = new MarcaModel();

        // Llamar al método del modelo para obtener la marca
        $result = $marcaM->getByNombre($objeto);

        // Formatear la respuesta
        if ($result) {
            $json = [
                "status" => 200,
                "results" => $result,
            ];
        } else {
            $json = [
                "status" => 400,
                "results" => "Error al crear la marca",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json, http_response_code($json["status"]));
    }
    #endregion
}
