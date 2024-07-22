<?php
/**
 * Clase especialidad
 *
 * Esta clase se encarga de manejar las operaciones CRUD para los especialidads.
 * Provee métodos para listar todos los especialidads, obtener un especialidad por su ID,
 * crear, actualizar y "eliminar" (desactivar) especialidads.
 */
class especialidad
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos los registros de especialidads de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de especialidads y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $especialidadM = new especialidadModel();

        // Obtener todos los registros de especialidads
        $response = $especialidadM->all();

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
     * Obtiene un registro de especialidad por su ID.
     *
     * @param int $id El ID del especialidad a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del especialidad y establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $especialidadM = new especialidadModel();

        // Obtener el registro de especialidad por ID
        $response = $especialidadM->get($id);

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
     * Crea un nuevo especialidad utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método create del modelo especialidadModel para insertar el especialidad en la base de datos.
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

        // Instanciar el modelo especialidadModel
        $especialidadM = new especialidadModel();

        // Llamar al método create del modelo para insertar el especialidad en la base de datos
        $response = $especialidadM->create($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo crear la especialidad",
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
     * Actualiza todos los datos de un especialidad utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método update del modelo especialidadModel para actualizar el especialidad en la base de datos.
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

        // Instanciar el modelo especialidadModel
        $especialidadM = new especialidadModel();

        // Llamar al método update del modelo para actualizar el especialidad en la base de datos
        $response = $especialidadM->update($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => "Especialidad actualizada",
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo actualizar la especialidad",
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
     * Cambia el estado de un especialidad a "eliminado" en lugar de borrar el registro físicamente de la base de datos.
     *
     * @param int $id El ID del especialidad a "eliminar".
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON indicando el resultado de la operación y establece el código de respuesta HTTP.
     */
    public function delete($id)
    {
        // Instancia del modelo
        $especialidadM = new EspecialidadModel();

        // Cambiar el estado del especialidad a "eliminado"
        $response = $especialidadM->delete($id);

        // Formatear la respuesta
        if ($response === "Especialidad eliminada con éxito.") {
            $json = [
                "status" => 200,
                "results" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "results" => "No se pudo eliminar la especialidad",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json, http_response_code($json["status"]));
    }
    #endregion
}