<?php
/**
 * Clase Marca
 *
 * Esta clase se encarga de manejar las operaciones CRUD para las marcas.
 * Provee métodos para listar todas las marcas, obtener una categoria por su ID,
 * crear, actualizar y "eliminar" (desactivar) marcas.
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
        $categoriaM = new MarcaModel();

        // Obtener todos los registros de marcas
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
     * Obtiene un registro de marca por su ID.
     *
     * @param int $id El ID del marca a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del marca y establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $categoriaM = new MarcaModel();

        // Obtener el registro de marca por ID
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
}