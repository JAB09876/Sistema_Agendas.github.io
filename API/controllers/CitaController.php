<?php
/**
 * Clase cita
 *
 * Esta clase se encarga de manejar las operaciones CRUD para los citas.
 * Provee métodos para listar todos los citas, obtener un cita por su ID,
 * crear, actualizar y "eliminar" (desactivar) citas.
 */
class cita
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos los registros de citas de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de citas y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $citaM = new citaModel();

        // Obtener todos los registros de citas
        $response = $citaM->all();

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
     * Obtiene un registro de cita por su ID.
     *
     * @param int $id El ID del cita a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del cita y establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $citaM = new citaModel();

        // Obtener el registro de cita por ID
        $response = $citaM->get($id);

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
     * Crea un nuevo cita utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método create del modelo citaModel para insertar el cita en la base de datos.
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

        // Instanciar el modelo citaModel
        $citaM = new citaModel();

        // Llamar al método create del modelo para insertar el cita en la base de datos
        $response = $citaM->create($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo crear el cita",
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
     * Actualiza todos los datos de un cita utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método update del modelo citaModel para actualizar el cita en la base de datos.
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

        // Instanciar el modelo citaModel
        $citaM = new citaModel();

        // Llamar al método update del modelo para actualizar el cita en la base de datos
        $response = $citaM->update($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => "Cita actualizada",
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo actualizar la cita",
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
     * Cambia el estado de un cita a "eliminado" en lugar de borrar el registro físicamente de la base de datos.
     *
     * @param int $id El ID del cita a "eliminar".
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON indicando el resultado de la operación y establece el código de respuesta HTTP.
     */
    public function delete($id)
    {
        // Instancia del modelo
        $citaM = new citaModel();

        // Cambiar el estado del cita a "eliminado"
        $response = $citaM->delete($id);

        // Formatear la respuesta
        if ($response === "cita eliminado con éxito.") {
            $json = [
                "status" => 200,
                "results" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "results" => "No se pudo eliminar al cita",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json, http_response_code($json["status"]));
    }
    #endregion
}