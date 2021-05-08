<?php
namespace App\Database;

use PDO;
use Exception;

class Database extends DatabaseRequest
{
    /**
     * @return PDO $pdo
     */
    protected static function setPDO(): PDO
    {
        try {
            $pdo = new PDO(
                'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8;port=' . $_ENV['DB_PORT'],
                $_ENV['DB_USERNAME'],
                $_ENV['DB_PASSWORD']
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    /**
     * @param string $name
     * @return DatabaseCreateColumn
     */
    public static function createColumn(string $name): DatabaseCreateColumn
    {
        return new DatabaseCreateColumn($name);
    }

    /**
     * @param string $name
     * @return DatabaseCreateTable
     */
    public static function createTable(string $name): DatabaseCreateTable
    {
        return new DatabaseCreateTable($name);
    }
}
