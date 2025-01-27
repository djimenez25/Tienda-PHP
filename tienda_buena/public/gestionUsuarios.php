<div>
    <table style="border: 1px solid black; margin:auto; margin-top:50px;">
        <tr>
            <td style="font-weight: bold; border: 1px solid black;">ID</td>
            <td style="font-weight: bold; border: 1px solid black;">Nombre</td>
            <td style="font-weight: bold; border: 1px solid black;">Email</td>
            <td style="font-weight: bold; border: 1px solid black;">Password</td>
            <td style="font-weight: bold; border: 1px solid black;">Rol</td>
            <td style="font-weight: bold; border: 1px solid black;">Fecha registro</td>
            <?php
            require_once('../modelos/Usuarios.php');
            foreach (UsuarioModelo::mostrarTodosUsuarios() as $usuario) {
                echo <<<HTML
    <tr>
    <td style="border: 1px solid black;">$usuario->id</td>
    <td style="border: 1px solid black;">$usuario->nombre</td>
    <td style="border: 1px solid black;">$usuario->email</td>
    <td style="border: 1px solid black;">$usuario->password</td>
    <td style="border: 1px solid black;">$usuario->rol_id</td>
    <td style="border: 1px solid black;">$usuario->fecha_registro</td>
    <td style="border: 1px solid black;"><button type="submit" ><a href="eliminarUsuario.php?id=$usuario->id">Eliminar</a></button></td>

    </tr>
    HTML;
            }
            ?>
        </tr>
    </table>
</div>