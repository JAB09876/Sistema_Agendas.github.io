<?php
/**
 * Clase Factura
 *
 * Esta clase se encarga de manejar las operaciones CRUD para las facturas.
 * Provee métodos para listar todos las facturas, obtener un factura por su ID,
 * crear, actualizar y "eliminar" (desactivar) facturas.
 */
class factura
{
    #region Método ALL
    /**
     * Método index
     *
     * Obtiene todos las registros de facturas de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con las registros de facturas y establece el código de respuesta HTTP.
     */
    public function index()
    {
        // Instancia del modelo
        $facturaM = new FacturaModel();

        // Obtener todos los registros de facturas
        $response = $facturaM->all();

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

    #region Método ALLDETAIL
    /**
     * Método index
     *
     * Obtiene todos los registros de facturas de la base de datos.
     *
     * @return void No devuelve ningún valor, pero imprime una respuesta JSON con los registros de facturas y establece el código de respuesta HTTP.
     */
    public function get()
    {
        // Instancia del modelo
        $facturaM = new FacturaModel();

        // Obtener todos los registros de facturas
        $response = $facturaM->getD();

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