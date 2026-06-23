<?php
namespace clases;

use clases\Database;

abstract class Service
{
    protected Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // Método auxiliar para obtener conexión PDO
    protected function connection(): \PDO
    {
        return $this->db->getConnection();
    }
}