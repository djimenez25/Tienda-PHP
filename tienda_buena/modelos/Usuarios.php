<?php
require_once "BaseDatos.php";

class UsuarioModelo
{

    public static function registrarUsuario($nombre, $email, $password)
    {
        $hash = hash("sha256", $password);

        // VERIFICAMOS SI EXISTE EL CORREO
        $stmt = BaseDatos::getConection()->prepare("SELECT id FROM usuarios WHERE email = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->fetch()) {
            return "<div class='w-25 m-auto mb-4 text-center alert alert-danger'>El correo ya está registrado</div>";
        }

        // INSERTAMOS NUEVO USUARIO EN LA BASE DE DATOS
        $stmt = BaseDatos::getConection()->prepare("INSERT INTO usuarios (nombre,email,password) VALUES (:nombre, :email, :password)");
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $hash, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return "<div class='w-25 m-auto mb-4 text-center alert alert-danger'>Error al registrar el usuario</div>";
        }
    }

    public static function loginUsuario($email, $password)
    {
        $hash = hash("sha256", $password);

        $stmt = BaseDatos::getConection()->prepare("SELECT id,nombre,email,password,rol_id FROM usuarios WHERE email = :email AND password = :password");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $hash, PDO::PARAM_STR);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_OBJ);

        if ($usuario) {
            return $usuario;
        } else {
            return false;
        }
    }

    public static function mostrarTodosUsuarios($type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    public static function eliminarUsuario($id)
    {
        $stmt = BaseDatos::getConection()->prepare("DELETE FROM usuarios WHERE id= :id");
        $stmt->bindParam("id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
