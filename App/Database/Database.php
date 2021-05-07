<?php
namespace App\Database;

use PDO;
use Exception;

class Database extends DatabaseFactory
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
}
