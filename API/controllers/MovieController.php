<?php
//localhost:81/api/nombreClaseControlador
class movie
{

    //GET listar
    public function index()
    {
        //Instancia del modelo
        $movieM = new MovieModel();
        //Acción a ejecutar del modelo
        $response = $movieM->all();
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
}