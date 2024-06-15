<?php
/**
 * Clase LoginModel
 *
 * Esta clase maneja las operaciones de validación de acceso a la aplicación por
 * medio de login.
 */

class LoginModel 
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase LoginModel
     *
     * Inicializa la conexión con la base de datos.
     */
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
    #endregion

    #region Método ACCESS
    /**
     * Verifica las credenciales de inicio de sesión de un usuario.
     *
     * @param string $id El ID del usuario.
     * @param string $contrasenna La contraseña del usuario.
     *
     * @return int Retorna el ID del usuario a solicitar datos
     */
    public function access($id, $contrasenna) 
    {
        try {
            // Preparamos la consulta SQL
            $vSQL = "SELECT rol 
                     FROM Usuario 
                     WHERE id = '$id' AND contrasenna = '$contrasenna' AND estado = 1;";
            
            // Ejecutamos la consulta usando el método executeSQL
            $vResult = $this->enlace->executeSQL($vSQL, "asoc");

            return $vResult;
        } catch (Exception $e) {
            // Capturamos y mostramos cualquier error
            die("Error: " . $e->getMessage());
        }
    }
    #endregion
}