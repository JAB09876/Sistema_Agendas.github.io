<?php
/**
 * Clase subservicio
 *
 * Esta clase se encarga de manejar las operaciones CRUD para los subservicios.
 * Provee métodos para listar todos los subservicios, obtener un subservicio por su ID,
 * crear, actualizar y "eliminar" (desactivar) subservicios.
 */
class subservicio
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos los registros de subservicios de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de subservicios y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $subservicioM = new subservicioModel();

        // Obtener todos los registros de subservicios
        $response = $subservicioM->all();

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
     * Obtiene un registro de subservicio por su ID.
     *
     * @param int $id El ID del subservicio a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del subservicio y establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $subservicioM = new subservicioModel();

        // Obtener el registro de subservicio por ID
        $response = $subservicioM->get($id);

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
     * Crea un nuevo subservicio utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método create del modelo subservicioModel para insertar el subservicio en la base de datos.
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

        // Instanciar el modelo subservicioModel
        $subservicioM = new subservicioModel();

        // Llamar al método create del modelo para insertar el subservicio en la base de datos
        $response = $subservicioM->create($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo crear el subservicio",
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
     * Actualiza todos los datos de un subservicio utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método update del modelo subservicioModel para actualizar el subservicio en la base de datos.
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

        // Instanciar el modelo subservicioModel
        $subservicioM = new subservicioModel();

        // Llamar al método update del modelo para actualizar el subservicio en la base de datos
        $response = $subservicioM->update($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => "Subservicio actualizado",
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo actualizar el subservicio",
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
     * Cambia el estado de un subservicio a "eliminado" en lugar de borrar el registro físicamente de la base de datos.
     *
     * @param int $id El ID del subservicio a "eliminar".
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON indicando el resultado de la operación y establece el código de respuesta HTTP.
     */
    public function delete($id)
    {
        // Instancia del modelo
        $subservicioM = new subservicioModel();

        // Cambiar el estado del subservicio a "eliminado"
        $response = $subservicioM->delete($id);

        // Formatear la respuesta
        if ($response === "Subservicio eliminado con éxito.") {
            $json = [
                "status" => 200,
                "results" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "results" => "No se pudo eliminar el subservicio",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json, http_response_code($json["status"]));
    }
    #endregion
}