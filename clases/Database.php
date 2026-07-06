<?php
namespace clases;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        // BUG CORREGIDO: antes se leía de $_ENV, pero nada en el proyecto
        // carga un archivo .env a $_ENV (config/database.php define
        // CONSTANTES, no variables de entorno). Esto hacía que la conexión
        // siempre usara los valores por defecto de aquí abajo, ignorando
        // en silencio lo que se configurara en config/database.php.
        $host    = defined('DB_HOST') ? DB_HOST : 'localhost';
        $db      = defined('DB_NAME') ? DB_NAME : 'trivias_db';
        $user    = defined('DB_USER') ? DB_USER : 'root';
        $pass    = defined('DB_PASS') ? DB_PASS : '';
        $charset = defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new \Exception("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}