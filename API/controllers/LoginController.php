<?php
/**
 * Clase Login
 *
 * Esta clase se encarga de manejar las operaciones de login del aplicación
 */
class Login 
{
    #region Método LOGIN
    public function access() {
        // Obtener el JSON de la entrada estándar
        $inputJSON = file_get_contents("php://input");
    
        // Decodificar el JSON en un objeto
        $object = json_decode($inputJSON);
    
        // Instanciar el modelo LoginModel
        $loginM = new LoginModel();
    
        // Llamar al método login del modelo para consultar en la base de datos
        $response = $loginM->access($object->id, $object->contrasenna);
    
        // Construir una respuesta JSON en base al resultado de la operación
        if (!empty($response)) {
            $json = [
                "status" => 200,
                "result" => "Login exitoso",
                
            ];
        } else {
            $json = [
                "status" => 400,
                "result" => "No existe un usuario con esos datos",
            ];
        }
    
        // Enviar la respuesta JSON
        http_response_code($json["status"]);
        echo json_encode($json);
    }
    
    #endregion
}