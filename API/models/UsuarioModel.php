<?php
class UsuarioModel
{
    public $enlace;

    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
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

    /**
     * Inserta un nuevo usuario en la base de datos con los datos proporcionados.
     *
     * @param string $telefono El número de teléfono del usuario.
     * @param string $correo La dirección de correo electrónico del usuario.
     * @param string $nombre El nombre completo del usuario.
     * @param string $direccion La dirección del usuario.
     * @param string $fecha La fecha de nacimiento del usuario en formato AAAA-MM-DD.
     * @param string $contrasenna La contraseña del usuario (ya hasheada).
     * @param string $rol El rol del usuario (por ejemplo, Cliente, Administrador, etc.).
     * @param int $estado El estado del usuario (activo: 1, inactivo: 0).
     * @return string Devuelve un mensaje indicando el resultado de la operación.
     */
    public function create(
        $telefono,
        $correo,
        $nombre,
        $direccion,
        $fecha,
        $contrasenna,
        $rol,
        $estado
    ) {
        try {
            // Verificar si el usuario ya existe en la base de datos
            $vSQLCheck = "SELECT COUNT(*) AS count FROM Usuario WHERE telefono = '$telefono' OR correo_electronico = '$correo';";
            $result = $this->enlace->executeSQL($vSQLCheck);

            if ($result === 0) {
                return "El usuario ya existe en la base de datos";
            }

            // Construir la consulta SQL para insertar el usuario en la tabla Usuario
            $vSQL = "INSERT INTO Usuario (
                telefono, 
                correo_electronico, 
                nombre, 
                direccion, 
                fecha_nacimiento, 
                contrasenna, 
                rol, 
                estado
            ) VALUES (
                '$telefono', 
                '$correo', 
                '$nombre', 
                '$direccion', 
                '$fecha', 
                '$contrasenna', 
                '$rol', 
                $estado
            );";

            // Ejecutar la consulta SQL utilizando el enlace a la base de datos
            $this->enlace->executeSQL($vSQL);

            // Devolver un mensaje indicando que el usuario se ha insertado correctamente
            return "Usuario insertado correctamente";
        } catch (Exception $e) {
            // En caso de error, imprimir el mensaje de error y terminar la ejecución
            die("Error: " . $e->getMessage());
        }
    }

    public function update(
        $id,
        $telefono,
        $correo,
        $nombre,
        $direccion,
        $fecha,
        $contrasenna,
        $rol,
        $estado
    ) {
        try {
            $vSQL = "UPDATE Usuario SET ";
            $this->enlace->executeSQL($vSQL);
            return "";
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
