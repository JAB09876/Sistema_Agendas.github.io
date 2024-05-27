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

   /**
 * Crea un nuevo usuario utilizando los datos proporcionados en formato JSON.
 * Lee el JSON de la entrada estándar (php://input), decodifica los datos y realiza validaciones.
 * Luego, llama al método create del modelo UsuarioModel para insertar el usuario en la base de datos.
 * Finalmente, devuelve una respuesta JSON indicando el resultado de la operación.
 *
 * @return void No devuelve ningún valor, pero imprime una respuesta JSON y establece el código de respuesta HTTP.
 */
public function create() {
    // Obtener el JSON de la entrada estándar
    $json = file_get_contents('php://input');
    
    // Decodificar el JSON en un array asociativo
    $data = json_decode($json, true);

    // Verificar si se proporcionaron todos los datos necesarios
    if (!isset($data['telefono'], $data['correo_electronico'], $data['nombre'], $data['direccion'], $data['fecha_nacimiento'], $data['contrasenna'], $data['rol'], $data['estado'])) {
        // Si faltan datos, construir y devolver una respuesta JSON de error
        $json = array(
            'status' => 400,
            'result' => 'Faltan datos necesarios'
        );
        echo json_encode($json);
        http_response_code($json["status"]);
        return;
    }

    // Asignar los datos del JSON a variables locales
    $telefono = $data['telefono'];
    $correo_electronico = $data['correo_electronico'];
    $nombre = $data['nombre'];
    $direccion = $data['direccion'];
    $fecha_nacimiento = $data['fecha_nacimiento'];
    // Hashear la contraseña antes de almacenarla en la base de datos
    $contrasenna = password_hash($data['contrasenna'], PASSWORD_DEFAULT);
    $rol = $data['rol'];
    $estado = $data['estado'];

    // Instanciar el modelo UsuarioModel
    $usuarioM = new UsuarioModel();
    
    // Llamar al método create del modelo para insertar el usuario en la base de datos
    $response = $usuarioM->create($telefono, $correo_electronico, $nombre, $direccion, $fecha_nacimiento, $contrasenna, $rol, $estado);

    // Construir una respuesta JSON en base al resultado de la operación
    if ($response === "Usuario insertado correctamente") {
        $json = array(
            'status' => 200,
            'result' => $response
        );
        
    } else if ($response === "El usuario ya existe en la base de datos") {
        $json = array(
            'status' => 409,
            'result' => $response
        );
    } else {
        $json = array(
            'status' => 400,
            'result' => $response
        );
    }

    
    // Imprimir la respuesta JSON y establecer el código de respuesta HTTP
    echo json_encode($json);
    http_response_code($json["status"]);
    }
}