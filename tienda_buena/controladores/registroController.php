<?php
require_once("../modelos/Usuarios.php");
$error = "";
$confirmacion = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nombre"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $password = hash("sha256", $_POST["password"]);
        // $id_rol = $_POST["id_rol"];

        $resultado = UsuarioModelo::registrarUsuario($nombre, $email, $password);

        if ($resultado === true) {
            $confirmacion = "<div class='w-50 m-auto mb-4 text-center alert alert-success'>Usuario agregado con éxito</div>";
            header("Location: login.php");
        } else {
            $error = $resultado;
        }
    } else {
        $error = "<div class='w-50 m-auto mb-4 text-center alert alert-danger'>Faltan registros por rellenar</div>";
    }
}
