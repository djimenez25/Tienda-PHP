<?php
require_once 'BaseDatos.php';

class compraModelo
{


    /**
     * Funcion para registrar la compra
     */

    public static function registrarCompra($idUsuario, $total)
    {

        $stmt = BaseDatos::getConection()->prepare("INSERT INTO compras (usuario_id,total) VALUES (:usuario_id, :total)");

        $stmt->bindParam(":usuario_id", $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(":total", $total, $total, PDO::PARAM_STR);

        $stmt->execute();
        //Devolvemos el id generado
        return BaseDatos::getConection()->lastInsertId();
    }

    /**
     * Funcion para registrar los detalles de la compra
     */

    public static function registroDetalleCompra($compra, $producto, $cantidad, $precio)
    {

        $stmt = BaseDatos::getConection()->prepare("INSERT INTO detalle_compras (compra_id, producto_id, cantidad, precio) VALUES (:compra_id, :producto_id, :cantidad, :precio)");

        $stmt->bindParam(":compra_id", $compra, PDO::PARAM_INT);
        $stmt->bindParam(":producto_id", $producto, PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(":precio", $precio, PDO::PARAM_STR);

        $stmt->execute();
        return true;
    }
}
