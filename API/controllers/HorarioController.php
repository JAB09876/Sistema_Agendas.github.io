<?php
/**
 * Clase Horario
 *
 * Esta clase se encarga de manejar las operaciones CRUD para los Horarios.
 * Provee métodos para listar todos los Horarios, obtener un Horariopor su ID,
 * crear, actualizar y "eliminar" (desactivar) Horarios.
 */
class Horario
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos los registros de Horarios de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de Horarios y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $HorarioM = new HorarioModel();

        // Obtener todos los registros de Horarios
        $response = $HorarioM->all();

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
     * Obtiene un registro de Horariopor su ID.
     *
     * @param int $id El ID del Horarioa obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del Horarioy establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $HorarioM = new HorarioModel();

        // Obtener el registro de Horariopor ID
        $response = $HorarioM->get($id);

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
     * Crea un nuevo Horarioutilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método create del modelo HorarioModel para insertar el Horarioen la base de datos.
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

        // Instanciar el modelo HorarioModel
        $HorarioM = new HorarioModel();

        // Llamar al método create del modelo para insertar el Horarioen la base de datos
        $response = $HorarioM->create($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo crear la Horario",
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
     * Actualiza todos los datos de un Horarioutilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método update del modelo HorarioModel para actualizar el Horarioen la base de datos.
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

        // Instanciar el modelo HorarioModel
        $HorarioM = new HorarioModel();

        // Llamar al método update del modelo para actualizar el Horarioen la base de datos
        $response = $HorarioM->update($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => "Horarioactualizada",
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo actualizar la Horario",
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
     * Cambia el estado de un Horarioa "eliminado" en lugar de borrar el registro físicamente de la base de datos.
     *
     * @param int $id El ID del Horarioa "eliminar".
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON indicando el resultado de la operación y establece el código de respuesta HTTP.
     */
    public function delete($id)
    {
        // Instancia del modelo
        $HorarioM = new HorarioModel();

        // Cambiar el estado del Horarioa "eliminado"
        $response = $HorarioM->delete($id);

        // Formatear la respuesta
        if ($response === "Horarioeliminada con éxito.") {
            $json = [
                "status" => 200,
                "results" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "results" => "No se pudo eliminar la Horario",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json, http_response_code($json["status"]));
    }
    #endregion
}