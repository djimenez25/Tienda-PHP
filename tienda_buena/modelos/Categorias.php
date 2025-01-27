<?php
require_once 'env.php';
require_once 'BaseDatos.php';

class Categorias
{

    /**
     * Obtiene todas las categorias
     */

    public static function getAllCategorias($type_fetch = PDO::FETCH_OBJ)
    {

        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM categorias");
        $stmt->execute();
        return $stmt->fetchAll($type_fetch);
    }

    /**
     * Obtiene una categoria por su ID
     */

    public static function getCategoriasById($id, $type_fetch = PDO::FETCH_OBJ)
    {

        $stmt = BaseDatos::getConection()->prepare("SELECT * FROM categorias WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $categoria = $stmt->fetch($type_fetch);
        $nombre = ($categoria) ? $categoria->nombre : "No existe la categoria";
        return $nombre;
    }
}
