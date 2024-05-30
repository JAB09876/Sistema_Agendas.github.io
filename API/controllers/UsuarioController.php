<?php
class Usuario
{

    ### section index
    public function index()
    {
        //Instancia del modelo
        $usuarioM = new UsuarioModel();
        //Acción a ejecutar del modelo
        $response = $usuarioM->all();
        //Formato a la respuesta
        if (isset($response) && !empty($response)) {
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No hay registros"
            );
        }
        echo json_encode($json, http_response_code($json["status"]));
    }
    ### end section index

    ### section get
    public function get($id)
    {
        //Instancia del modelo
        $usuarioM = new UsuarioModel();
        //Acción a ejecutar del modelo
        $response = $usuarioM->get($id);
        //Formato a la respuesta
        if (isset($response) && !empty($response)) {
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No hay registros"
            );
        }
        echo json_encode($json, http_response_code($json["status"]));
    }
    ### end section get

    ### section create
    /**
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
         $inputJSON = file_get_contents('php://input');
        
         // Decodificar el JSON en un objeto
         $object = json_decode($inputJSON);
 
         // Instanciar el modelo UsuarioModel
         $usuarioM = new UsuarioModel();
 
         // Llamar al método create del modelo para actualizar el usuario en la base de datos
         $response = $usuarioM->create($object);
 
         // Construir una respuesta JSON en base al resultado de la operación
         if (isset($response) && !empty($response)) {
             $json = array(
                 'status'=> 200,
                 'result'=> $response
             );
         } else {
             $json = array(
                 'status'=> 400,
                 'result'=> "No se pudo actualizar el usuario"
             );
         }
         echo json_encode($json);
         http_response_code($json["status"]);
    }
    ### end section create

    ### section update
    public function update()
    {
        // Obtener el JSON de la entrada estándar
        $inputJSON = file_get_contents('php://input');
        
        // Decodificar el JSON en un objeto
        $object = json_decode($inputJSON);

        // Instanciar el modelo UsuarioModel
        $usuarioM = new UsuarioModel();

        // Llamar al método update del modelo para actualizar el usuario en la base de datos
        $response = $usuarioM->update($object);

        // Construir una respuesta JSON en base al resultado de la operación
        if (isset($response) && !empty($response)) {
            $json = array(
                'status'=> 200,
                'result'=> $response[0]
            );
        } else {
            $json = array(
                'status'=> 400,
                'result'=> "No se pudo actualizar el usuario"
            );
        }
        echo json_encode($json);
        http_response_code($json["status"]);
    }
    ### end section update

    ### section delete
    public function delete($id)
    {
        //Instancia del modelo
        $usuarioM = new UsuarioModel();
        //Acción a ejecutar del modelo
        $response = $usuarioM->delete($id);
        //Formato a la respuesta
        if ($response === "Usuario eliminado con éxito.") {
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No se pudo eliminar al usuario"
            );
        }
        echo json_encode($json, http_response_code($json["status"]));
    }
    ### end section delete

}

?>
