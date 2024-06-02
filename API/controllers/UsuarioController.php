<?php
/**
 * Clase Usuario
 *
 * Esta clase se encarga de manejar las operaciones CRUD para los usuarios.
 * Provee métodos para listar todos los usuarios, obtener un usuario por su ID,
 * crear, actualizar y "eliminar" (desactivar) usuarios.
 */
class Usuario
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos los registros de usuarios de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de usuarios y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $usuarioM = new UsuarioModel();

        // Obtener todos los registros de usuarios
        $response = $usuarioM->all();

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
     * Obtiene un registro de usuario por su ID.
     *
     * @param int $id El ID del usuario a obtener.
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con el registro del usuario y establece el código de respuesta HTTP.
     */
    public function get($id)
    {
        // Instancia del modelo
        $usuarioM = new UsuarioModel();

        // Obtener el registro de usuario por ID
        $response = $usuarioM->get($id);

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
     * Crea un nuevo usuario utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método create del modelo UsuarioModel para insertar el usuario en la base de datos.
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

        // Instanciar el modelo UsuarioModel
        $usuarioM = new UsuarioModel();

        // Llamar al método create del modelo para insertar el usuario en la base de datos
        $response = $usuarioM->create($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo crear el usuario",
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
     * Actualiza todos los datos de un usuario utilizando los datos proporcionados en formato JSON.
     * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
     * Luego, llama al método update del modelo UsuarioModel para actualizar el usuario en la base de datos.
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

        // Instanciar el modelo UsuarioModel
        $usuarioM = new UsuarioModel();

        // Llamar al método update del modelo para actualizar el usuario en la base de datos
        $response = $usuarioM->update($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = [
                "status" => 200,
                "result" => "Usuario actualizado",
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No se pudo actualizar el usuario",
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
     * Cambia el estado de un usuario a "eliminado" en lugar de borrar el registro físicamente de la base de datos.
     *
     * @param int $id El ID del usuario a "eliminar".
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON indicando el resultado de la operación y establece el código de respuesta HTTP.
     */
    public function delete($id)
    {
        // Instancia del modelo
        $usuarioM = new UsuarioModel();

        // Cambiar el estado del usuario a "eliminado"
        $response = $usuarioM->delete($id);

        // Formatear la respuesta
        if ($response === "Usuario eliminado con éxito.") {
            $json = [
                "status" => 200,
                "results" => $response,
            ];
        } else {
            $json = [
                "status" => 400,
                "results" => "No se pudo eliminar al usuario",
            ];
        }

        // Enviar la respuesta JSON
        echo json_encode($json, http_response_code($json["status"]));
    }
    #endregion
}