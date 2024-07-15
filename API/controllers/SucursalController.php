<?php
/**
 * Clase Sucursal
 *
 * Esta clase se encarga de manejar las operaciones CRUD para las Sucursales.
 * Provee métodos para listar todas los Sucursals, obtener un Sucursal por su ID,
 * crear, actualizar y "eliminar" (desactivar) Sucursales.
 */
class sucursal
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos los registros de Sucursales de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de Sucursales y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $SucursalM = new SucursalModel();

        // Obtener todos los registros de Sucursals
        $response = $SucursalM->all();

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
     * Obtiene un registro de Sucursal por su ID.
     *
     * @param int $id El ID de la Sucursal a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del Sucursal y establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $SucursalM = new SucursalModel();

        // Obtener el registro de Sucursal por ID
        $response = $SucursalM->get($id);

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
        echo json_encode($json);
        http_response_code($json["status"]);
    }
    #endregion

    #region Método CREATE
    /**
     * Método create
     *
     * Crea una nueva Sucursal utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método create del modelo SucursalModel para insertar la Sucursala en la base de datos.
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

        // Instanciar el modelo SucursalModel
        $SucursalM = new SucursalModel();

        // Llamar al método create del modelo para insertar el Sucursal en la base de datos
        $response = $SucursalM->create($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => "Sucursal insertada con éxito.",
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo crear el Sucursal",
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
     * Actualiza todos los datos de una Sucursal utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método update del modelo SucursalModel para actualizar la Sucursal en la base de datos.
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

        // Instanciar el modelo SucursalModel
        $SucursalM = new SucursalModel();

        // Llamar al método update del modelo para actualizar el Sucursal en la base de datos
        $response = $SucursalM->update($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => "Sucursal actualizada con éxito.",
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo actualizar el Sucursal",
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
     * Cambia el estado de un Sucursal a "eliminado" en lugar de borrar el registro físicamente de la base de datos.
     *
     * @param int $id El ID del Sucursal a "eliminar".
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON indicando el resultado de la operación y establece el código de respuesta HTTP.
     */
    public function delete($id)
    {
        // Instancia del modelo
        $SucursalM = new SucursalModel();

        try {
            // Cambiar el estado del Sucursal a "eliminado"
            $response = $SucursalM->delete($id);

            // Formatear la respuesta
            if ($response === "Sucursal eliminada con éxito.") {
                $json = [
                    "status" => 200,
                    "results" => $response,
                ];
            } else {
                $json = [
                    "status" => 400,
                    "results" => "No se pudo eliminar la Sucursal.",
                ];
            }

            // Establecer el código de respuesta HTTP
            http_response_code($json["status"]);

            // Enviar la respuesta JSON
            echo json_encode($json);
        } catch (Exception $e) {
            $json = [
                "status" => 500,
                "results" => "Error en el servidor: " . $e->getMessage(),
            ];

            // Establecer el código de respuesta HTTP
            http_response_code($json["status"]);

            // Enviar la respuesta JSON de error
            echo json_encode($json);
        }
    }
    #endregion

    #region Método GETNOMBREBYID
    /**
     * Método get
     *
     * Obtiene un registro de Sucursal por su ID.
     *
     * @param int $id El ID de la Sucursal a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del Sucursal y establece el código de respuesta HTTP.
     */
    public function getNombreById($id)
    {
        // Instancia del modelo
        $SucursalM = new SucursalModel();

        // Obtener el registro de Sucursal por ID
        $response = $SucursalM->getNombreById($id);

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