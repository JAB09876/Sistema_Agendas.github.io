<?php
/**
 * Clase estado
 *
 * Esta clase se encarga de manejar las operaciones CRUD para los estados.
 * Provee métodos para listar todos los estados, obtener un estado por su ID,
 * crear, actualizar y "eliminar" (desactivar) estados.
 */
class estado
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos los registros de estados de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de estados y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $estadoM = new estadoModel();

        // Obtener todos los registros de estados
        $response = $estadoM->all();

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
     * Obtiene un registro de estado por su ID.
     *
     * @param int $id El ID del estado a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del estado y establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $estadoM = new estadoModel();

        // Obtener el registro de estado por ID
        $response = $estadoM->get($id);

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