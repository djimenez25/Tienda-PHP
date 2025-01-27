<?php
require_once '../../modelos/Productos.php';
// require_once 'secure.php';
$productos = [];
if (isset($_GET["id_categoria"])) {
    $productos = productosModelo::getProductosByCategoria($_GET["id_categoria"]);
} else {
    $productos = productosModelo::getAllProductos();
}

// echo "<pre>";
// print_r(productosModelo::getAllProductos());
// "</pre>";
// exit;

echo json_encode($productos);
BaseDatos::closeConection();

// session_start();
// $carrito = [
//     "n_elementos" => 0,
//     "precio_total" => 0,
//     "productos" => []
// ];

// if (!isset($_SESSION["carrito"])) {
//     $_SESSION["carrito"] = $carrito;
// }

// $_SESSION["carrito"]["productos"][] = ProductosModelo::getProductosById($_GET["id_productos"]);
// $_SESSION["carrito"]["n_elementos"] = count($_SESSION["carrito"]["productos"][]);
// $_SESSION["carrito"]["precio_total"] = count($_SESSION["carrito"]["productos"][]);
