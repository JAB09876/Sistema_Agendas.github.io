<?php
/**
 * Clase servicio
 *
 * Esta clase se encarga de manejar las operaciones CRUD para los servicios.
 * Provee métodos para listar todos los servicios, obtener un servicio por su ID,
 * crear, actualizar y "eliminar" (desactivar) servicios.
 */
class servicio
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos los registros de servicios de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de servicios y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $servicioM = new servicioModel();

        // Obtener todos los registros de servicios
        $response = $servicioM->all();

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
     * Obtiene un registro de servicio por su ID.
     *
     * @param int $id El ID del servicio a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del servicio y establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $servicioM = new servicioModel();

        // Obtener el registro de servicio por ID
        $response = $servicioM->get($id);

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
     * Crea un nuevo servicio utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método create del modelo servicioModel para insertar el servicio en la base de datos.
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

        // Instanciar el modelo servicioModel
        $servicioM = new servicioModel();

        // Llamar al método create del modelo para insertar el servicio en la base de datos
        $response = $servicioM->create($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo crear el servicio",
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
     * Actualiza todos los datos de un servicio utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método update del modelo servicioModel para actualizar el servicio en la base de datos.
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

        // Instanciar el modelo servicioModel
        $servicioM = new servicioModel();

        // Llamar al método update del modelo para actualizar el servicio en la base de datos
        $response = $servicioM->update($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => "Servicio actualizado",
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo actualizar el servicio",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json);
        http_response_code($json["status"]);
    }
    #endregion

    #region Método DELETE
    /**
     * Método delete
     *
     * Cambia el estado de un servicio a "eliminado" en lugar de borrar el registro físicamente de la base de datos.
     *
     * @param int $id El ID del servicio a "eliminar".
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON indicando el resultado de la operación y establece el código de respuesta HTTP.
     */
    public function delete($id)
    {
        // Instancia del modelo
        $servicioM = new servicioModel();

        // Cambiar el estado del servicio a "eliminado"
        $response = $servicioM->delete($id);

        // Formatear la respuesta
        if ($response === "Servicio eliminado con éxito.") {
            $json = [
                "status" => 200,
                "results" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "results" => "No se pudo eliminar el servicio",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json, http_response_code($json["status"]));
    }
    #endregion
}