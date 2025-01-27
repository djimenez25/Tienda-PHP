<?php require_once("../controladores/registroController.php"); ?>
<div class="form-login">

    <form class="mt-5 p-4 border border-success border border-2 border rounded-5 shadow-lg" method="POST" action="" style="max-width: 700px; margin: auto;">
        <div class="mb-4 col-lg-8 mx-auto">
            <label for="nombreAddress" class="form-label fw-semibold">Nombre:</label>
            <input
                type="text"
                name="nombre"
                class="form-control border-dark shadow-sm"
                id="nombreAddress"
                aria-describedby="nombreHelp"
                placeholder="Nombre" />

        </div>

        <div class="mb-4 col-lg-8 mx-auto">
            <label for="emailAddress" class="form-label fw-semibold">Email:</label>
            <input
                type="email"
                name="email"
                class="form-control border-dark shadow-sm"
                id="emailAddress"
                aria-describedby="emailHelp"
                placeholder="Email" />

        </div>

        <div class="mb-4 col-lg-8 mx-auto">
            <label for="password" class="form-label fw-semibold">Contraseña:</label>
            <input
                type="password"
                name="password"
                class="form-control border-dark shadow-sm"
                id="password"
                placeholder="Contraseña" />
        </div>

        <?php echo $error ?>
        <?php echo $confirmacion ?>
        <div class="d-grid col-lg-8 mx-auto">
            <input type="submit" class="btn btn-success btn-lg" value="Registrarte"></input>
        </div>
    </form>
</div>