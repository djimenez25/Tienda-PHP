<?php
session_start();
require_once("../modelos/Usuarios.php");
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {

        $email = $_POST["email"];
        $password = hash("sha256", $_POST["password"]);

        $usuario = UsuarioModelo::loginUsuario($email, $password);

        if ($usuario) {
            $_SESSION["usuario"] = $usuario;
            header("Location: index.php");
        } else {
            $error = "<div class='w-50 m-auto mb-4 text-center alert alert-danger'>Correo o contraseña incorrectos</div>";
        }
    } else {
        $error = "<div class='w-50 m-auto mb-4 text-center alert alert-danger'>Faltan campos por rellenar</div>";
    }
}
