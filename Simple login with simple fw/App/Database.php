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
            echo 'Exception reçue : ' . $e->getMessage() . "\n";
        }
    }

    private static function request($request, $values, $type)
    {
        try {
            $request = self::setPDO()->prepare($request);
            $request->execute($values);
            if ($type === 'fetchAll') {
                return $request->fetchAll(PDO::FETCH_ASSOC);
            } elseif ($type === 'fetch') {
                return $request->fetch();
            } else {
                return $request;
            }
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public static function getRequest($request, $values, $type = '')
    {
        return self::request($request, $values, $type);
    }
}
