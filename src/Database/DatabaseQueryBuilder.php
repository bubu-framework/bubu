<?php

namespace Bubu\Database;

use \PDO;
use \Exception;

class DatabaseQueryBuilder extends Database
{

    /**
     * @var string $table Table name
     */
    protected string $table;

    /**
     * @param string $table Table name
     */
    public function __construct(string $table)
    {
        $this->tableName = $table;
        return $this;
    }

    /**
     * @param string $request
     * @param array $values
     * @param string|null $type
     * 
     * @return array|void
     */
    private function build(string $request, array $values, ?string $type)
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
