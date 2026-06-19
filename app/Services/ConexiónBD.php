<?php

namespace App\Services;

use PDO;
use PDOException;

/**
 * ConexiónBD
 * Patrón Singleton para gestionar la conexión única a la base de datos
 * Requisito SOLID: Single Responsibility
 */
class ConexiónBD
{
    /**
     * Instancia única de la conexión
     */
    private static ?PDO $instance = null;

    /**
     * Constructor privado para evitar instanciación directa
     */
    private function __construct()
    {
    }

    /**
     * Obtiene la instancia única de PDO
     * 
     * @return PDO Conexión a la base de datos
     * @throws PDOException Si falla la conexión
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::$instance = self::conectar();
        }

        return self::$instance;
    }

    /**
     * Establece la conexión a la base de datos
     * 
     * @return PDO
     * @throws PDOException
     */
    private static function conectar(): PDO
    {
        try {
            $host = env('DB_HOST', 'localhost');
            $dbname = env('DB_DATABASE', 'trivia_system');
            $user = env('DB_USERNAME', 'root');
            $password = env('DB_PASSWORD', '');
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

            $pdo = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);

            return $pdo;
        } catch (PDOException $e) {
            // Registrar error en log
            \Log::error('Error de conexión a BD: ' . $e->getMessage());
            throw new PDOException('Error al conectar a la base de datos: ' . $e->getMessage());
        }
    }

    /**
     * Ejecuta una consulta preparada
     * 
     * @param string $sql Consulta SQL con placeholders
     * @param array $params Parámetros para la consulta
     * @return \PDOStatement
     */
    public static function ejecutar(string $sql, array $params = []): \PDOStatement
    {
        try {
            $pdo = self::getInstance();
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            \Log::error('Error ejecutando consulta: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Obtiene todos los resultados de una consulta
     * 
     * @param string $sql Consulta SQL
     * @param array $params Parámetros
     * @return array
     */
    public static function obtenerTodos(string $sql, array $params = []): array
    {
        $stmt = self::ejecutar($sql, $params);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene un único resultado
     * 
     * @param string $sql Consulta SQL
     * @param array $params Parámetros
     * @return array|false
     */
    public static function obtenerUno(string $sql, array $params = [])
    {
        $stmt = self::ejecutar($sql, $params);
        return $stmt->fetch();
    }

    /**
     * Inserta un registro y devuelve el ID
     * 
     * @param string $tabla Nombre de la tabla
     * @param array $datos Datos a insertar
     * @return string ID del registro insertado
     */
    public static function insertar(string $tabla, array $datos): string
    {
        $columnas = implode(',', array_keys($datos));
        $placeholders = implode(',', array_fill(0, count($datos), '?'));
        $sql = "INSERT INTO $tabla ($columnas) VALUES ($placeholders)";

        self::ejecutar($sql, array_values($datos));
        return self::getInstance()->lastInsertId();
    }

    /**
     * Actualiza registros
     * 
     * @param string $tabla Nombre de la tabla
     * @param array $datos Datos a actualizar
     * @param array $condicion Array con 'columna' => 'valor'
     * @return int Número de filas afectadas
     */
    public static function actualizar(string $tabla, array $datos, array $condicion): int
    {
        $set = implode(',', array_map(fn($k) => "$k = ?", array_keys($datos)));
        $where = implode(' AND ', array_map(fn($k) => "$k = ?", array_keys($condicion)));
        $sql = "UPDATE $tabla SET $set WHERE $where";

        $valores = array_merge(array_values($datos), array_values($condicion));
        $stmt = self::ejecutar($sql, $valores);
        return $stmt->rowCount();
    }

    /**
     * Elimina registros
     * 
     * @param string $tabla Nombre de la tabla
     * @param array $condicion Array con 'columna' => 'valor'
     * @return int Número de filas eliminadas
     */
    public static function eliminar(string $tabla, array $condicion): int
    {
        $where = implode(' AND ', array_map(fn($k) => "$k = ?", array_keys($condicion)));
        $sql = "DELETE FROM $tabla WHERE $where";

        $stmt = self::ejecutar($sql, array_values($condicion));
        return $stmt->rowCount();
    }

    /**
     * Inicia una transacción
     */
    public static function iniciarTransaccion(): void
    {
        self::getInstance()->beginTransaction();
    }

    /**
     * Confirma una transacción
     */
    public static function confirmar(): void
    {
        self::getInstance()->commit();
    }

    /**
     * Revierte una transacción
     */
    public static function revertir(): void
    {
        self::getInstance()->rollBack();
    }

    /**
     * Método privado: evita que se clone la instancia
     */
    private function __clone()
    {
    }

    /**
     * Método privado: evita que se deseserialice
     */
    private function __wakeup()
    {
    }
}