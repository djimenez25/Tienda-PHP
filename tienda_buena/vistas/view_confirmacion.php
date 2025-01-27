<div class="container mt-5">
    <!-- Mensaje de éxito -->
    <div class="alert alert-success text-center py-4">
        <i class="bi bi-check-circle-fill fs-3"></i> <!-- Aumenta el tamaño del icono -->
        <strong class="fs-3">¡Pedido realizado con éxito!</strong> <!-- Aumenta el tamaño del texto -->
    </div>

    <h2 class="text-center mb-4">Detalles de tu Pedido</h2>

    <!-- Resumen de Pedido -->
    <div class="row">
        <div class="col-md-6 mx-auto">
            <ul class="list-group">

                <?php foreach ($_SESSION['detalles_pedido'] as $producto): ?>
                    <li class="list-group-item">
                        <strong><?php echo $producto['nombre']; ?></strong><br>
                        Cantidad: <?php echo $producto['cantidad']; ?><br>
                        Precio Unidad: <?php echo $producto['precio']; ?>€<br>
                        Total: <?php echo  $producto['cantidad'] * $producto['precio']; ?>€
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>

    <!-- Botones de Acción -->
    <div class="text-center mt-5">
        <a href="index.php" class="btn btn-outline-success">Volver al inicio</a>
    </div>
</div>