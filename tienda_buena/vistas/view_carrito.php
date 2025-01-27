<?php
require_once '../controladores/carritoController.php';
$productosCarrito = $carrito->obtenerProductos();
$total = $carrito->calcularTotal();
?>


<div class="container mt-5 ">
    <h1 class="text-center mb-4"><i class="bi bi-bag-dash"><br></i>Carrito</h1>
    <table class="table table-hover table-bordered align-middle">
        <thead class="table-success">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th class="text-center" scope="col">Cantidad</th>
                <th scope="col">Total</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productosCarrito as $producto): ?>
                <tr>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['precio']; ?>€</td>
                    <td class="text-center"><input class="text-center fw-bold w-25" type="number" value="<?php echo $producto['cantidad']; ?>" onchange="actualizarCantidad(<?php echo $producto['id']; ?>, this.value );"></td>
                    <td><?php echo $producto['cantidad'] * $producto['precio']; ?>€</td>
                    <td class="text-center">
                        <a href=" carrito/eliminarCarrito.php?id_producto=<?php echo $producto['id']; ?>" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash3-fill fw-bold"> Eliminar</i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="/tienda_buena/public/index.php" class="btn btn-outline-success">
            <i class="bi bi-arrow-left"></i> Continuar comprando
        </a>
        <h2 class=" fw-bold">Total: <?php echo $total; ?>€</h2>

    </div>
    <div class="text-end p-2">
        <?php if (count($productosCarrito) < 1) { ?>
            <label class="btn btn-success px-3 fw-bold  fs-5" style="pointer-events: none; background-color:gray">Tramitar pedido</label>
        <?php } else { ?>
            <a href="pedido.php" class="btn btn-success px-3 fw-bold  fs-5">Tramitar pedido</a>
        <?php  } ?>
    </div>

</div>

<script>
    function actualizarCantidad(id, cantidad) {
        fetch("carrito/actualizarCarrito.php?id_producto=" + id + "&cantidad=" + cantidad)
            .then((response) => {
                location.reload();
            })
    }
</script>