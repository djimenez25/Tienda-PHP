<?php require_once '../controladores/compraController.php'; ?>
<div class="container mt-5">
    <h1 class="text-center mb-4 fw-bold">Tramitar Pedido</h1>

    <!-- Formulario para completar pedido -->
    <form class="w-50 m-auto" action="" method="POST">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control border border-success" id="nombre" name="nombre" required>
            </div>
            <div class="col-md-6">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" class="form-control border border-success" id="apellido" name="apellido" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control border border-success" id="direccion" name="direccion" required>
        </div>

        <div class="mb-5">
            <label for="metodo_pago" class="form-label">Método de Pago</label>
            <select class="form-select border border-success" id="metodo_pago" name="metodo_pago">
                <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                <option value="paypal">PayPal</option>
                <option value="contra_reembolso">Contra Reembolso</option>
            </select>
        </div>
        <!-- Botón para volver al carrito -->
        <div class="d-flex justify-content-between align-items-center ">
            <a href="/tienda_buena/public/miCarrito.php" class="btn btn-outline-success">
                <i class="bi bi-arrow-left"></i> Volver atrás
            </a>
            <input type="submit" class="btn btn-success px-4" value="Finalizar Pedido" />
        </div>

    </form>
</div>