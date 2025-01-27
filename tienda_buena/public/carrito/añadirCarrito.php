<?php
session_start();
require_once '../../controladores/carritoController.php';



if (isset($_GET["id_producto"])) {
    $id = (int)$_GET["id_producto"];
    $carrito->agregarProductoCarrito($id);



    $_SESSION['mensaje'] = $mensaje;

    $url_origen = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "index.php";
    header("Location: " . $url_origen);
}
