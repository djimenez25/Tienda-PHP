<?php
require_once '../modelos/Compra.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $usuarioId = $_SESSION['usuario']->id;
    $carrito = $_SESSION['carrito'];



    $total = 0;
    foreach ($_SESSION['carrito'] as $producto) {
        $total += $producto['precio'] * $producto['cantidad'];
    }

    $compraId = compraModelo::registrarCompra($usuarioId, $total);

    //Guardamos los productos del carrito en una variable
    $_SESSION['detalles_pedido'] = $carrito;

    foreach ($carrito as $producto) {
        compraModelo::registroDetalleCompra(
            $compraId,
            $producto['id'],
            $producto['cantidad'],
            $producto['precio']
        );
    }

    //Vaciamos el carrito
    unset($_SESSION["carrito"]);
    header("Location: confirmacion.php");
}
