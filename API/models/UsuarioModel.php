<?php
class UsuarioModel{
    public $enlace;

    public function __construct() {
       $this->enlace = new MySqlConnect();
    }
    /**
     * Listar usuarios
     * @param 
     * @return $vResultado - Lista de objetos
     */
    public function all(){
        try {
            //Consulta SQL
            $vSQL="SELECT * FROM Usuario ORDER BY nombre DESC;";
            //Ejectuar la consulta
            $vResultado=$this->enlace->executeSQL($vSQL);
            
            //Retornar 
            return $vResultado;
        } catch (Exception $e) {
            die("". $e->getMessage());
        }
    }

     /**
     * Obtener usuario por id
     * @param 
     * @return $vResultado - EL objeto
     */
    public function get($id){
        try {
            //Consulta SQL
            $vSQL= "SELECT * FROM Usuario WHERE id = $id;";

            //Ejectuar la consulta
            $vResultado=$this->enlace->executeSQL($vSQL);
            
            //Retornar 
            return $vResultado[0];
        } catch (Exception $e) {
            die("". $e->getMessage());
        }
    }   

    public function create($telefono, $correo, $nombre, $direccion, $fecha, $contrasenna, $rol, $estado){
        try {
            //Consulta SQL
            $vSQL= "INSERT INTO Usuario 
                    (telefono, correo_electronico, nombre, direccion, fecha_nacimiento, contrasenna, rol, estado) VALUES
                    ($telefono, $correo, $nombre, $direccion, $fecha, $contrasenna, $rol, $$estado);";

            //Ejectuar la consulta
            $this->enlace->executeSQL($vSQL);
            
            return "Usuario  inertado  correctamente"; 
        }catch (Exception $e) {
            die("". $e->getMessage());
        }
    }

    public function update($id, $telefono, $correo, $nombre, $direccion, $fecha, $contrasenna, $rol, $estado){ 
        try {
            $vSQL= "UPDATE Usuario SET ";
            $this->enlace->executeSQL($vSQL);
            return "";
        } catch (Exception $e) {
            die("". $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $vSQL= "UPDATE Usuario SET estado = 0 WHERE id = $id;";
            $this->enlace->executeSQL($vSQL);
            return "Usuario eliminado con éxito.";
        } catch (Exception $e) {
            die("". $e->getMessage());
        }
    }
}