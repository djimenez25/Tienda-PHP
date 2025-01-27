<div class="container mt-5">
    <!-- Lista de productos -->
    <?php
    require_once "../modelos/BaseDatos.php";
    require_once "../modelos/Productos.php";
    require_once "view_productos.php";


    // PAGINACION
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    if (isset($_GET['categoria'])) {
        $categoria = $_GET['categoria'];
    } else {
        $categoria = 0;
    }


    $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
    ?>

    <h2 class="mt-5">Lista de productos
        <?php
        if (!empty($busqueda)) {
            $todos_productos = ProductosModelo::getProductoSearch($busqueda, $page, 15);
            $paginacion = Productos::pintarPaginacionBusqueda($busqueda, 15, $page);
            $numero_productos = ProductosModelo::getNumeroProductosPorBusqueda($busqueda);
            echo "(Mostrando " . count($todos_productos) . " Productos) de
                    <span class='fs-5 badge text-bg-dark'>
                    <span class='badge rounded-pill text-bg-success'>$numero_productos</span>
                    </span>";
        } else {
            $paginacion = Productos::pintarPaginacion($categoria, 15, $page);
            $todos_productos = ProductosModelo::getAllProductosPaginacion($page, 15, $categoria);
            $nombre_categoria = ($categoria > 0) ? Categorias::getCategoriasById($categoria) : "Todas las categorias";
            $numero_productos = ProductosModelo::getNumeroProductosPorCategoria($categoria);
            echo "(Mostrando " . count($todos_productos) . " Productos) de
                    <span class='fs-5 badge text-bg-dark'>$nombre_categoria
                    <span class='badge rounded-pill text-bg-success'>$numero_productos</span>
                    </span>";
        }
        ?>
    </h2>

    <div class="row" id="productos_lista">
        <?php
        echo $paginacion;
        foreach ($todos_productos as $producto) {
            Productos::pintarProducto($producto);
        }
        ?>

    </div>
    <?php echo $paginacion ?>

</div>