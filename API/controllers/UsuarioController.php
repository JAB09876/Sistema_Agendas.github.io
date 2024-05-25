<?php
//localhost:81/api/nombreClaseControlador
class usuario
{

    //GET listar
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
        echo json_encode($json,
            http_response_code($json["status"]));

    }

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
        echo json_encode($json,
            http_response_code($json["status"]));
    }

    public function create($pJson)
    {
         // Decodificar el JSON recibido
         $data = json_decode($pJson, true);

         // Verificar que todos los campos necesarios están presentes
         if (!isset($data['telefono'], $data['correo'], $data['nombre'], $data['direccion'], $data['fecha'], $data['contrasenna'], $data['rol'], $data['estado'])) {
             throw new Exception("Faltan datos necesarios");
         }
 
         // Asignar los datos a variables locales
         $telefono = $data['telefono'];
         $correo = $data['correo'];
         $nombre = $data['nombre'];
         $direccion = $data['direccion'];
         $fecha = $data['fecha'];
         $contrasenna = password_hash($data['contrasenna'], PASSWORD_DEFAULT);;
         $rol = $data['rol'];
         $estado = $data['estado'];

        //Instancia del modelo
        $usuarioM = new UsuarioModel();
        //Acción a ejecutar del modelo
        $response = $usuarioM->create($telefono, $correo, $nombre, $direccion, $fecha, $contrasenna, $rol, $estado);
        //Formato a la respuesta
        if ($response === "Usuario insertado correctamente") {
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "Ya hay un usuario con esos datos"
            );
        }
        echo json_encode($json,
            http_response_code($json["status"]));
    }
}
