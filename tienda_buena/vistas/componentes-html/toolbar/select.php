<select id="categorias" class="bg-body-secondary border border-success border border-3 form-select me-2" aria-label="Categorias" onchange="redirigirCategorias()">
    <option value="0" <?php echo $categoriaActual == 0 ? 'selected' : ''; ?>>Todas las categorias</option>
    <?php
    foreach (Categorias::getAllCategorias() as $categoria) {
        $selected = $categoriaActual == $categoria->id ? 'selected' : '';
        echo "<option value='$categoria->id' $selected>$categoria->nombre</option>";
    }
    ?>
</select>