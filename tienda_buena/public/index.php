<?php session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index | Tienda</title>
    <?php include_once("../vistas/componentes-html/head.php"); ?>
</head>

<body>
    <div>
        <?php include_once("../vistas/componentes-html/toolbar/toolbar.php"); ?>
        <div>
            <?php include_once("../vistas/view_index.php"); ?>
        </div>
        <?php include_once("../vistas/componentes-html/footer.php"); ?>
    </div>
</body>

</html>