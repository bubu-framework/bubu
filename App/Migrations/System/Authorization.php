<?php

namespace App\Migrations\System;

use Bubu\Database\Database;

class Authorization
{
    public static function create(string $securityKey): void
    {
        if ($securityKey !== $_ENV['MIGRATION_SECURITY_KEY']) throw new \Exception('Invalid security key');
        self::createAuthorization([
            // authorization list
            'create', 'read', 'view' // etc
        ]);
    }

    private static function createAuthorization(array $authorizationName)
    {
        $db = Database::CreateTable('authorization')
        ->column(
            Database::CreateColumn('id')
                ->type('bigint')
                ->size('20')
                ->notNull()
        )
        ->foreignKey([
            'name'       => 'FK_id',
            'references' => 'users',
            'columns'    => ['id'],
            'foreign'    => ['id']
        ]);

        foreach ($authorizationName as $value) {
            $db->column(
                Database::createColumn($value)
                    ->type('tinyint')
                    ->size(1)
                    ->defaultValue([0, 'int'])
            );
        }
        $db->execute();
    }
}
