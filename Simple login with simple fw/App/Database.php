<?php
namespace App;

use PDO;
use Exception;

class Database
{
    private static function setPDO()
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

    private static function request(string $request, array $values, ?string $type): ?array
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

    public static function getRequest(string $request, array $values, ?string $type = ''): ?array
    {
        return self::request($request, $values, $type);
    }
}
