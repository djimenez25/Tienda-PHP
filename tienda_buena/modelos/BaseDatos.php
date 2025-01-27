<?php
require_once 'env.php';

class BaseDatos
{
    private static $pdo_conexion;

    public static function getConection()
    {
        if (self::$pdo_conexion === null) {

            try {
                self::$pdo_conexion = new PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
                self::$pdo_conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error al conectar a la base de datos: " . $e->getMessage());
            }
        }
        return self::$pdo_conexion;
    }
    public static function closeConection()
    {
        self::$pdo_conexion = null;
    }
}
