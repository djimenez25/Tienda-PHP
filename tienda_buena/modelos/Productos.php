<?php
require_once 'env.php';
require_once 'BaseDatos.php';

class ProductosModelo
{
    /**
     * Obtiene todos los productos
     */

    public static function getAllProductos($type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT productos.id, productos.nombre, productos.descripcion, productos.imagen, productos.precio, categorias.nombre AS categoria_id, productos.stock FROM productos JOIN categorias ON productos.categoria_id = categorias.id ORDER BY productos.id ASC
    ");
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtiene todos los productos de una categoria
     */

    public static function getProductosByCategoria($categoria_id, $type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM productos WHERE categoria_id = :categoria_id");
        $stmt->bindParam(":categoria_id", $categoria_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtiene los productos por ID
     */

    public static function getProductosById($id, $type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM productos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $producto = $stmt->fetch($type_fetch);
        return $producto;
    }

    /**
     * Obtiene los productos por su nombre
     */

    public static function getProductobyNombre($nombre, $type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM productos WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Con esta funcion vamos a hacer la busqueda por nombre o descripcion
     */

    public static function getProductoSearch($busqueda, $pagina, $elementos_pagina)
    {
        $conexion = BaseDatos::getConection();
        $offset = ($pagina - 1) * $elementos_pagina;


        $stmt = $conexion->prepare("SELECT p. *, c.nombre AS nombre_categoria
                                        FROM productos p
                                        JOIN categorias c ON p.categoria_id = c.id
                                        WHERE p.nombre LIKE :busqueda OR p.descripcion LIKE :busqueda
                                        LIMIT :offset, :elementosPorPagina");

        $likeBusqueda = '%' . $busqueda . '%';
        $stmt->bindParam(':busqueda', $likeBusqueda, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':elementosPorPagina', $elementos_pagina, PDO::PARAM_INT);

        // Ejecutar la consulta
        $stmt->execute();

        // Retornar los resultados con el formato especificado
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Obtiene el total de productos de una busqueda
     */

    public static function getNumeroProductosPorBusqueda($busqueda)
    {

        $conexion = BaseDatos::getConection();


        $stmt = $conexion->prepare("SELECT COUNT(*) AS total
                                                         FROM productos
                                                          WHERE nombre LIKE :busqueda OR descripcion LIKE :busqueda");

        $likeBusqueda = '%' . $busqueda . '%';
        $stmt->bindParam(':busqueda', $likeBusqueda, PDO::PARAM_STR);

        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'];
    }


    /**
     * Obtiene los productos precio
     */

    public static function getProductoByPrecio($precio, $type_fetch = PDO::FETCH_OBJ)
    {
        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM productos WHERE precio = :precio");
        $stmt->bindParam(":precio", $precio, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtiene todos los productos por paginacion
     */

    public static function getAllProductosPaginacion($pagina, $elementos_pagina, $categoria_id = 0, $type_fetch = PDO::FETCH_OBJ)
    {

        $conexion = BaseDatos::getConection();
        $offset = ($pagina - 1) * $elementos_pagina;

        if ($categoria_id > 0) {
            $stmt = $conexion->prepare("SELECT p. *, c.nombre AS nombre_categoria
                                        FROM productos p
                                        JOIN categorias c ON p.categoria_id = c.id
                                        WHERE p.categoria_id = :categoria_id
                                        LIMIT :offset, :elementosPorPagina");

            $stmt->bindParam(":categoria_id", $categoria_id, PDO::PARAM_INT);
        } else {
            $stmt = $conexion->prepare("SELECT p. *, c.nombre AS nombre_categoria
                                        FROM productos p
                                        JOIN categorias c ON p.categoria_id = c.id              
                                        LIMIT :offset, :elementosPorPagina");
        }

        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        $stmt->bindParam(":elementosPorPagina", $elementos_pagina, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Obtiene el numero completo de productos por categoria, si es 0, obtiene todos los productos
     */

    public static function getNumeroProductosPorCategoria($categoria_id)
    {

        $conexion = BaseDatos::getConection();

        if ($categoria_id > 0) {
            $stmt = $conexion->prepare("SELECT COUNT(*) AS total
                                                        FROM productos
                                                        WHERE categoria_id = :categoria_id");
            $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        } else {
            $stmt = $conexion->prepare("SELECT COUNT(*) AS total
                                                        FROM productos");
        }
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'];
    }
}
