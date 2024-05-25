<?php
class MovieModel{
    public $enlace;

    public function __construct() {
       $this->enlace = new MySqlConnect();
    }
    /**
     * Listar peliculas
     * @param 
     * @return $vResultado - Lista de objetos
     */
    public function all(){
        try {
            //Consulta SQL
            $vSQL="SELECT * FROM movie order by title desc;";
            //Ejectuar la consulta
            $vResultado=$this->enlace->executeSQL($vSQL);
            
            //Retornar 
            return $vResultado;
        } catch (Exception $e) {
            die("". $e->getMessage());
        }
    }
}