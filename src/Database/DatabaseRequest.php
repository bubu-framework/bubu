<?php

namespace Bubu\Database;

use PDO;
use Exception;

class DatabaseRequest
{
    const FETCH = 'fetch';
    const FETCH_ALL = 'fetchAll';

    /**
     * @param string $request
     * @param array $values
     * @param string|null $type
     * @param int $mode
     * @return array|bool
     */
    public static function request(string $request, array $values, ?string $type = null, int $mode = PDO::FETCH_ASSOC): mixed
    {
        try {
            $request = Database::setPDO()->prepare($request);
            $i = 1;
            foreach ($values as $key => $value) {
                if ($key === '?') {
                    $key = $i;
                } else {
                    $key = ':' . ltrim($key, ':');
                }
                switch (gettype($value)) {
                    case 'integer':
                        $request->bindValue($key, $value, PDO::PARAM_INT);
                        break;

                    case 'string':
                        $request->bindValue($key, $value, PDO::PARAM_STR);
                        break;

                    case 'boolean':
                        $request->bindValue($key, $value, PDO::PARAM_BOOL);
                        break;

                    case 'NULL':
                        $request->bindValue($key, $value, PDO::PARAM_NULL);
                        break;

                    default:
                        $request->bindValue($key, $value);
                        break;
                }
                $i++;
            }
            $request->execute();
            if ($type === 'fetchAll') {
                $return = $request->fetchAll($mode);
                $request->closeCursor();
                return $return;
            } elseif ($type === 'fetch') {
                $return = $request->fetch($mode);
                $request->closeCursor();
                return $return;
            } else {
                $request->closeCursor();
                return true;
            }
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
