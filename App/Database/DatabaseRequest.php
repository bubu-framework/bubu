<?php

namespace App\Database;

use PDO;
use Exception;

class DatabaseRequest
{
    /**
     * @param string $request
     * @param array $values
     * @param string|null $type
     * 
     * @return array|void
     */
    public static function request(string $request, array $values, ?string $type)
    {
        try {
            $request = Database::setPDO()->prepare($request);
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
}
