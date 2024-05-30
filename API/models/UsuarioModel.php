<?php
class UsuarioModel
{
    public $enlace;

    ### section constructor
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
    ### end section constructor  

    /**
     * Listar usuarios
     * @param
     * @return $vResultado - Lista de objetos
     */
    public function all()
    {
        try {
            //Consulta SQL
            $vSQL = "SELECT * FROM Usuario WHERE estado = 1 ORDER BY nombre DESC;";
            //Ejectuar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            //Retornar
            return $vResultado;
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }

    /**
     * Obtener usuario por id
     * @param
     * @return $vResultado - EL objeto
     */
    public function get($id)
    {
        try {
            //Consulta SQL
            $vSQL = "SELECT * FROM Usuario WHERE id = $id AND estado = 1;";

            //Ejectuar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            //Retornar
            return $vResultado[0];
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }

    
    public function create($objeto) {
        try {
            if ($objeto->rol === "Encargado") {
                $vSQL = "INSERT INTO Usuario 
                (telefono, 
                correo_electronico, 
                nombre, 
                direccion, 
                fecha_nacimiento, 
                contrasenna, 
                rol, 
                estado, 
                idSucursal) 
                VALUES ('$objeto->telefono', 
                '$objeto->correo_electronico', 
                '$objeto->nombre', 
                '$objeto->direccion', 
                '$objeto->fecha_nacimiento', 
                '$objeto->contrasenna', 
                '$objeto->rol', 
                $objeto->estado, 
                $objeto->idSucrsal);";
            } else {
                $vSQL = "INSERT INTO Usuario 
                (telefono, 
                correo_electronico, 
                nombre, 
                direccion, 
                fecha_nacimiento, 
                contrasenna, 
                rol, 
                estado) VALUES ('$objeto->telefono', 
                '$objeto->correo_electronico', 
                '$objeto->nombre', 
                '$objeto->direccion', 
                '$objeto->fecha_nacimiento', 
                '$objeto->contrasenna', 
                '$objeto->rol', 
                $objeto->estado);";
            }

            $vResultado = $this->enlace->executeSQL_DML_last($vSQL);
            return $this->get($vResultado);
        }
        catch (Exception $e) { 
            die("". $e->getMessage());
        }
    }

    public function update($objeto) {
        try {
            
            if ($objeto->rol === "") { 
                $vSQL = "UPDATE Usuario 
                    SET telefono = '$objeto->telefono', 
                    correo_electronico = '$objeto->correo_electronico',
                    nombre = '$objeto->nombre',
                    direccion = '$objeto->direccion',
                    fecha_nacimiento = '$objeto->fecha_nacimiento',
                    contrasenna = '$objeto->contrasenna',
                    rol = '$objeto->rol',
                    estado = $objeto->estado,
                    idScursal = $objeto->idSucursal
                    WHERE id = $objeto->id;";
            } else {
                $vSQL = "UPDATE Usuario 
                    SET telefono = '$objeto->telefono', 
                    correo_electronico = '$objeto->correo_electronico',
                    nombre = '$objeto->nombre',
                    direccion = '$objeto->direccion',
                    fecha_nacimiento = '$objeto->fecha_nacimiento',
                    contrasenna = '$objeto->contrasenna',
                    rol = '$objeto->rol',
                    estado = $objeto->estado
                    WHERE id = $objeto->id;";
            }
            $vResultado = $this->enlace->executeSQL_DML($vSQL);
            
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $vSQL = "UPDATE Usuario SET estado = 0 WHERE id = $id;";
            $this->enlace->executeSQL($vSQL);
            return "Usuario eliminado con éxito.";
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
}
