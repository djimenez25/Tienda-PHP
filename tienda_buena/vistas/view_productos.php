<?php
require_once '../controladores/carritoController.php';
class Productos
{
    /**
     * Funcion para pintar los productos
     */

    public static function pintarProducto($producto)
    {

        global $carrito;
        $btn_eliminar = $carrito->obtenerProductosById($producto->id)
            ? "<a href='carrito/eliminarCarrito.php?id_producto=$producto->id' class='btn btn-danger'>Eliminar del Carrito</a>"
            : "";
        echo <<<HTML
                <div class="col-md-4">
                    <div class="card m-4" id_producto="$producto->id">
                        <img src="$producto->imagen" class="card-img-top" alt="imagen">
                        <div class="card-body">
                            <h4 class="card-title"> $producto->nombre</h4>
                            <h6 class="card-title"> $producto->descripcion</h6>
                            <p class="card-text"><b>Precio:</b> $producto->precio €</p>           
                            <p class="card-text"><b>Categoria:</b> <span class="badge rounded-pill text-bg-dark"> $producto->nombre_categoria</span></p>
                            <p class="card-text"><b>Stock:</b> $producto->stock</p>
                            <div class="d-grid gap-2 d-md-block">
                                <a href="carrito/añadirCarrito.php?id_producto=$producto->id" class="btn btn-success">Añadir</a>
                                $btn_eliminar
                            </div>
                        </div>
                    </div>
                </div>
                HTML;
    }

    /**
     * Funcion para pintar la paginacion de los productos
     */

    public static function pintarPaginacion($categoria_id, $elementos_pagina, $pagina_actual)
    {

        $conexion = BaseDatos::getConection();
        $result = '';

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
        $totalElementos = $resultado['total'];
        //CEIL devuelve el numero entero de una division, pero el mas alto
        $totalPaginas = ceil($totalElementos / $elementos_pagina);

        //Generamos la paginacion
        $result .= '<nav aria-label="Page navigation example">';
        $result .=  '<ul class="pagination">';

        for ($i = 1; $i <= $totalPaginas; $i++) {
            $activeClass = ($i == $pagina_actual) ? 'style = "background-color: #198754; color:white"' : 'style="color:black; border: 1px solid #198754"';
            $result .= " <li class='page-item'><a class = 'page-link' $activeClass href='?page=$i&categoria=$categoria_id'> $i </a></li>";
        }

        $result .= '</ul>';
        $result .= '</nav>';
        return $result;
    }

    /**
     * Funcion para la paginacion en la busqueda
     */

    public static function pintarPaginacionBusqueda($busqueda, $elementos_pagina, $pagina_actual)
    {

        $conexion = BaseDatos::getConection();
        $result = '';


        $stmt = $conexion->prepare("SELECT COUNT(*) AS total
                                                        FROM productos
                                                        WHERE nombre LIKE :busqueda OR descripcion LIKE :busqueda");

        $likeBusqueda = '%' . $busqueda . '%';
        $stmt->bindParam(':busqueda', $likeBusqueda, PDO::PARAM_STR);

        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalElementos = $resultado['total'];
        //CEIL devuelve el numero entero de una division, pero el mas alto
        $totalPaginas = ceil($totalElementos / $elementos_pagina);

        //Generamos la paginacion
        $result .= '<nav aria-label="Page navigation example">';
        $result .=  '<ul class="pagination">';

        for ($i = 1; $i <= $totalPaginas; $i++) {
            $activeClass = ($i == $pagina_actual) ? 'style = "background-color: #198754; color:white"' : 'style="color:black; border: 1px solid #198754"';
            $result .= " <li class='page-item'><a class = 'page-link' $activeClass href='?page=$i&busqueda=$busqueda'> $i </a></li>";
        }

        $result .= '</ul>';
        $result .= '</nav>';
        return $result;
    }
}
