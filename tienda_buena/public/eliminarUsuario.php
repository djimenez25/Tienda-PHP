<?php
require_once '../modelos/Usuarios.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    UsuarioModelo::eliminarUsuario($id);
    header("Location:gestionUsuarios.php");
    exit();
}
