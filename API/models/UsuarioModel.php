<?php
/**
 * Clase UsuarioModel
 *
 * Esta clase maneja las operaciones de la base de datos para los usuarios.
 * Proporciona métodos para listar todos los usuarios, obtener un usuario por su ID,
 * crear, actualizar y desactivar usuarios.
 */
class UsuarioModel
{
    public $enlace;

    #region Constructor
    /**
     * Constructor de la clase UsuarioModel
     *
     * Inicializa la conexión con la base de datos.
     */
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
    #endregion

    #region Método ALL
    /**
     * Listar todos los usuarios
     *
     * Obtiene todos los usuarios activos de la base de datos.
     *
     * @return array Lista de objetos de usuarios.
     */
    public function all()
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT 
                        u.id,
                        u.telefono,
                        u.correo_electronico,
                        u.nombre AS usuario,
                        u.direccion AS direccion,
                        u.fecha_nacimiento,
                        u.contrasenna,
                        u.rol,
                        u.estado,
                        u.idSucursal,
                        s.nombre AS nombre_sucursal
                    FROM 
                        Usuario u
                    LEFT JOIN 
                        Sucursal s ON u.idSucursal = s.id
                    WHERE 
                        u.estado = 1 
                    ORDER BY 
                        u.nombre DESC;";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el resultado
            return $vResultado;
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método GET
    /**
     * Obtener usuario por ID
     *
     * Obtiene un usuario específico de la base de datos usando su ID.
     *
     * @param int $id El ID del usuario a obtener.
     * @return object El objeto del usuario.
     */
    public function get($id)
    {
        try {
            // Consulta SQL
            $vSQL = "SELECT 
                        u.id,
                        u.telefono,
                        u.correo_electronico,
                        u.nombre AS usuario,
                        u.direccion AS direccion,
                        u.fecha_nacimiento,
                        u.contrasenna,
                        u.rol,
                        u.estado,
                        u.idSucursal,
                        s.nombre AS nombre_sucursal
                    FROM 
                        Usuario u
                    LEFT JOIN 
                        Sucursal s ON u.idSucursal = s.id
                    WHERE 
                        u.estado = 1 AND  u.id = '$id';";

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el resultado
            return $vResultado[0];
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método CREATE
    /**
     * Crear un nuevo usuario
     *
     * Inserta un nuevo usuario en la base de datos utilizando los datos proporcionados.
     *
     * @param object $objeto Los datos del usuario a crear.
     * @return object El objeto del usuario creado.
     */
    public function create($objeto)
    {
        try {
            // Consulta SQL para crear usuario
            if ($objeto->rol === "Encargado") {
                $vSQL = "INSERT INTO Usuario 
                (id, telefono, correo_electronico, nombre, direccion, fecha_nacimiento, 
                contrasenna, rol, estado, idSucursal) 
                VALUES ('$objeto->id', '$objeto->telefono', '$objeto->correo_electronico', 
                '$objeto->nombre', '$objeto->direccion', '$objeto->fecha_nacimiento', 
                '$objeto->contrasenna', '$objeto->rol', $objeto->estado, $objeto->idSucursal);";
            /**
             * Validamos que sea un adminstrador, dado que en las reglas del negocio
             * indica que solo puede haber un administrador
             */
            } else if ($objeto->rol === "Administrador") {
                die("Ya hay un admisntrador en el aplicativo");
            } else {
                $vSQL = "INSERT INTO Usuario 
                (id, telefono, correo_electronico, nombre, direccion, fecha_nacimiento, 
                contrasenna, rol, estado) 
                VALUES ('$objeto->id', '$objeto->telefono', '$objeto->correo_electronico', 
                '$objeto->nombre', '$objeto->direccion', '$objeto->fecha_nacimiento', 
                '$objeto->contrasenna', '$objeto->rol', $objeto->estado);";
            }

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL_DML_last($vSQL);

            // Retornar el usuario creado
            return $this->get($vResultado);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método UPDATE
    /**
     * Actualizar un usuario
     *
     * Actualiza los datos de un usuario en la base de datos.
     *
     * @param object $objeto Los datos del usuario a actualizar.
     * @return object El objeto del usuario actualizado.
     */
    public function update($objeto)
    {
        try {
            // Consulta SQL para actualizar usuario
            if ($objeto->rol === "Encargado") {
                $vSQL = "UPDATE Usuario 
                SET telefono = '$objeto->telefono', 
                    correo_electronico = '$objeto->correo_electronico',
                    nombre = '$objeto->nombre',
                    direccion = '$objeto->direccion',
                    fecha_nacimiento = '$objeto->fecha_nacimiento',
                    contrasenna = '$objeto->contrasenna',
                    rol = '$objeto->rol',
                    estado = $objeto->estado,
                    idSucursal = $objeto->idSucursal
                WHERE id = '$objeto->id' AND estado = 1;";
            } else {
                $vSQL = "UPDATE Usuario 
                SET telefono = '$objeto->telefono', 
                    correo_electronico = '$objeto->correo_electronico',
                    nombre = '$objeto->nombre',
                    direccion = '$objeto->direccion',
                    fecha_nacimiento = '$objeto->fecha_nacimiento',
                    contrasenna = '$objeto->contrasenna',
                    rol = '$objeto->rol',
                    estado = 1
                WHERE id = '$objeto->id' AND estado = 1;";
            }

            // Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);

            // Retornar el usuario actualizado
            return $this->get($objeto->id);
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion

    #region Método DELETE
    /**
     * Desactivar un usuario
     *
     * Cambia el estado de un usuario a "desactivado" en lugar de borrarlo de la base de datos.
     *
     * @param int $id El ID del usuario a desactivar.
     * @return string Mensaje de éxito o error.
     */
    public function delete($id)
    {
        try {
            // Consulta SQL para desactivar usuario
            $vSQL = "UPDATE Usuario SET estado = 0 WHERE id = $id;";

            // Ejecutar la consulta
            $this->enlace->executeSQL($vSQL);

            // Retornar mensaje de éxito
            return "Usuario eliminado con éxito.";
        } catch (Exception $e) {
            die("" . $e->getMessage());
        }
    }
    #endregion
}