<?php
namespace App\Database;

use PDO;
use Exception;

class Database
{
    /**
     * @return PDO $pdo
     */
    private static function setPDO(): PDO
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
     * @param string $request
     * @param array $values
     * @param string|null $type
     * 
     * @return array|void
     */
    private static function request(string $request, array $values, ?string $type)
    {
        try {
            $request = self::setPDO()->prepare($request);
            $request->execute($values);
            if ($type === 'fetchAll') {
                return $request->fetchAll(PDO::FETCH_ASSOC);
            } elseif ($type === 'fetch') {
                return $request->fetch();
            }
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    /**
     * @param string $request
     * @param array $values
     * @param string|null $type
     * 
     * @return array|void
     */
    public static function getRequest(string $request, array $values, ?string $type = null)
    {
        return self::request($request, $values, $type);
    }
}
