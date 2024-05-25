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

    public function create() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!isset($data['telefono'], $data['correo_electronico'], $data['nombre'], $data['direccion'], $data['fecha_nacimiento'], $data['contrasenna'], $data['rol'], $data['estado'])) {
            $json = array(
                'status' => 400,
                'result' => 'Faltan datos necesarios'
            );
            echo json_encode($json);
            http_response_code($json["status"]);
            return;
        }

        $telefono = $data['telefono'];
        $correo_electronico = $data['correo_electronico'];
        $nombre = $data['nombre'];
        $direccion = $data['direccion'];
        $fecha_nacimiento = $data['fecha_nacimiento'];
        $contrasenna = password_hash($data['contrasenna'], PASSWORD_DEFAULT);
        $rol = $data['rol'];
        $estado = $data['estado'];

        $usuarioM = new UsuarioModel();
        $response = $usuarioM->create($telefono, $correo_electronico, $nombre, $direccion, $fecha_nacimiento, $contrasenna, $rol, $estado);

        if ($response === "Usuario insertado correctamente") {
            $json = array(
                'status' => 200,
                'result' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'result' => $response
            );
        }
        echo json_encode($json);
        http_response_code($json["status"]);
    }
}