<?php
require_once '../../modelos/Productos.php';

$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

// Llama a la función con el parámetro de búsqueda
$productos = productosModelo::getProductoSearch($busqueda, $page, 15, $categoria);
// header("Location:index.php");

echo json_encode($productos);
BaseDatos::closeConection();
