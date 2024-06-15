<?php
/**
 * Clase medico
 *
 * Esta clase se encarga de manejar las operaciones CRUD para los medicos.
 * Provee métodos para listar todos los medicos, obtener un medico por su ID,
 * crear, actualizar y "eliminar" (desactivar) medicos.
 */
class medico
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos los registros de medicos de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de medicos y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $medicoM = new medicoModel();

        // Obtener todos los registros de medicos
        $response = $medicoM->all();

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
     * Obtiene un registro de medico por su ID.
     *
     * @param int $id El ID del medico a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del medico y establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $medicoM = new medicoModel();

        // Obtener el registro de medico por ID
        $response = $medicoM->get($id);

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
     * Crea un nuevo medico utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método create del modelo medicoModel para insertar el medico en la base de datos.
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

        // Instanciar el modelo medicoModel
        $medicoM = new medicoModel();

        // Llamar al método create del modelo para insertar el medico en la base de datos
        $response = $medicoM->create($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo crear el medico",
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
     * Actualiza todos los datos de un medico utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método update del modelo medicoModel para actualizar el medico en la base de datos.
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

        // Instanciar el modelo medicoModel
        $medicoM = new medicoModel();

        // Llamar al método update del modelo para actualizar el medico en la base de datos
        $response = $medicoM->update($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => "Medico actualizado",
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo actualizar el medico",
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
     * Cambia el estado de un medico a "eliminado" en lugar de borrar el registro físicamente de la base de datos.
     *
     * @param int $id El ID del medico a "eliminar".
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON indicando el resultado de la operación y establece el código de respuesta HTTP.
     */
    public function delete($id)
    {
        // Instancia del modelo
        $medicoM = new medicoModel();

        // Cambiar el estado del medico a "eliminado"
        $response = $medicoM->delete($id);

        // Formatear la respuesta
        if ($response === "Medico eliminado con éxito.") {
            $json = [
                "status" => 200,
                "results" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "results" => "No se pudo eliminar al medico",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json, http_response_code($json["status"]));
    }
    #endregion
}