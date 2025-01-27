<?php require_once("../controladores/loginController.php"); ?>
<div class="form-login">

    <form class="mt-5 p-4 border border-success border border-2 border rounded-5 shadow-lg" method="POST" action="" style="max-width: 600px; margin: auto;">
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
        <div class="d-grid col-lg-8 mx-auto">
            <input type="submit" class="btn btn-success btn-lg" value="Login"></input>
        </div>
    </form>
</div>