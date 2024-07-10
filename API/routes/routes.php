<?php

$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray); // Dejar solo los que tienen valores

// Sin solicitud al API
if (count($routesArray) == 1) {
    $json = array(
        'status' => 404,
        'result' => 'Not found'
    );
    echo json_encode($json, http_response_code($json["status"]));
    return;
}

// Solicitud al API
// http://localhost:81/nombreProyecto/controlador/accion/parametro
if (count($routesArray) > 1 && isset($_SERVER['REQUEST_METHOD'])) {
    $controller = ucfirst($routesArray[2]); // Convertir el nombre del controlador a CamelCase si es necesario
    $action = "index"; // Acción por defecto

    try {
        $response = new $controller();

        if (count($routesArray) <= 3) {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $action = isset($routesArray[3]) ? 'get' : 'index';
                    break;
                case 'POST':
                    $action = 'create';
                    break;
                case 'PUT':
                case 'PATCH':
                    $action = 'update';
                    break;
                case 'DELETE':
                    $action = 'delete';
                    break;
                default:
                    $action = 'index';
                    break;
            }

            if (count($routesArray) == 3 && $action != 'index') {
                $param = $routesArray[3];
                $response->$action($param);
            } else {
                $response->$action();
            }
        } elseif (count($routesArray) == 4) {
            $action = $routesArray[3];
            $param = $routesArray[4];
            $response->$action($param);
        }
    } catch (Throwable $th) {
        $json = array(
            'status' => 404,
            'result' => 'Controller or action not found: ' . $th->getMessage()
        );
        echo json_encode($json, http_response_code($json["status"]));
    }
}
