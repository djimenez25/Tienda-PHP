<?php require_once '../modelos/Categorias.php';
require_once '../controladores/carritoController.php';
$categoriaActual = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;
?>
<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
        <a href="/tienda_buena/public/index.php" class="navbar-brand fw-bold fs-4 text-uppercase text-white">La tien<span class="fw-bold fst-italic fs-2 text-uppercase text-success">daw</span></a>
        <form action="/tienda_buena/public/index.php" class="d-flex col-md-4 justify-content-center " role="search">
            <div class="d-flex col-md-8 ">

                <?php require_once 'buscar.php' ?>
            </div>

            <div class="col-md-6 ms-5">
                <?php require_once 'select.php' ?>
            </div>
        </form>

        <div class="ms-2 bg-white rounded-circle p-2">
            <a class="" href="/tienda_buena/public/miCarrito.php"><i class="bi bi-cart text-success fs-4 "></i><span class="badge bg-danger "><?php echo count($carrito->obtenerProductos()) ?></span></a>
        </div>

        <div class="d-flex align-items-center">
            <?php require_once 'sesion.php' ?>
        </div>
    </div>
</nav>

<script>
    const btn_buscar = document.getElementById("btn_buscar");



    function redirigirCategorias() {
        var select = document.getElementById("categorias");
        var categoriaId = select.value;
        window.location.href = "/tienda_buena/public/index.php?categoria=" + categoriaId + "&page=1";
    }
</script>