<?php

require_once(__DIR__ . '/../modelos/Productos.php');



class Carrito
{


    public function __construct()
    {


        /**
         * Funcion para inicializar el carrito en la sesion si no existe
         */
        if (!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = [];
        }
    }

    /**
     * Funcion para agregar un producto al carrito
     */

    public function agregarProductoCarrito($id, $cantidad = 1)
    {
        if (isset($_SESSION["carrito"][$id])) {
            $_SESSION["carrito"][$id]["cantidad"] += $cantidad;
        } else {
            $producto = ProductosModelo::getProductosById($id, PDO::FETCH_ASSOC);
            if ($producto) {
                $_SESSION["carrito"][$id] = $producto;
                $_SESSION["carrito"][$id]["cantidad"] = 1;
            }
        }
    }

    /**
     * Funcion para eliminar un producto del carrito
     */
    public function eliminarProductoCarrito($id)
    {
        if (isset($_SESSION["carrito"]["$id"])) {
            unset($_SESSION["carrito"][$id]);
        }
    }

    /**
     * Funcion para actualizar la cantidad de productos del carrito
     */

    public function actualizarProductosCarrito($id, $cantidad)
    {
        if (isset($_SESSION["carrito"][$id])) {
            if ($cantidad > 0) {
                $_SESSION["carrito"][$id]["cantidad"] = $cantidad;
            } else {
                $this->eliminarProductoCarrito($id);
            }
        }
    }

    /**
     * Funcion para calcular el total
     */

    public function calcularTotal()
    {
        $total = 0;
        foreach ($_SESSION["carrito"] as $producto) {
            $total += $producto["precio"] * $producto["cantidad"];
        }
        return $total;
    }

    /**
     * Funcion para obtener producto por ID
     */

    public function obtenerProductosById($id)
    {
        return isset($_SESSION["carrito"][$id]) ? $_SESSION["carrito"][$id] : null;
    }

    /**
     * Funcion para obtener productos
     */
    public function obtenerProductos()
    {
        return $_SESSION["carrito"];
    }
}

$carrito = new Carrito();
