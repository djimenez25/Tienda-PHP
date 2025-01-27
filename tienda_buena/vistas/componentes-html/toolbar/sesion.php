<?php if (!isset($_SESSION["usuario"])) { ?>
    <a class="btn btn-outline-success px-3 me-2" href="/tienda_buena/public/login.php">
        Iniciar Sesion
    </a>
    <a class="btn btn-success me-3" href="/tienda_buena/public/registro.php">
        Registrarte
    </a>
<?php } else { ?>
    <div class="dropdown">
        <a href="#" class="nav-link dropdown-toggle text-white fw-bold  me-3 p-2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="text-success-emphasis fw-bold text-success fs-4" id="username"><?php echo $_SESSION['usuario']->nombre; ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <?php if ($_SESSION["usuario"]->rol_id == 3) { ?>
                <li><a class="dropdown-item" href="#">Gestion de productos</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
            <?php } ?>
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li><a class="dropdown-item" href="#">Configuracion</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="/tienda_buena/public/logoff.php">Cerrar Sesion</a></li>
        </ul>
    </div>
<?php } ?>