<?php

namespace App\Migrations\System;

use Bubu\Database\Database;

class Users
{
    public static function create(string $securityKey): void
    {
        if ($securityKey !== $_ENV['MIGRATION_SECURITY_KEY']) throw new \Exception('Invalid security key');
        Database::createTable('users')
            ->column(
                Database::createColumn('id')
                    ->type('bigint')
                    ->size(20)
                    ->notNull()
                    ->auto_increment()
            )
            ->column(
                Database::createColumn('username')
                    ->type('varchar')
                    ->size(255)
                    ->notNull()
            )
            ->column(
                Database::createColumn('password')
                    ->type('varchar')
                    ->size(255)
                    ->notNull()
            )
            ->column(
                Database::createColumn('created_at')
                    ->type('timestamp')
                    ->notNull()
                    ->defaultValue(['CURRENT_TIMESTAMP', 'const'])
            )
            ->column(
                Database::createColumn('email')
                    ->type('varchar')
                    ->size(255)
                    ->notNull()
            )
            ->column(
                Database::createColumn('email_verification_code')
                    ->type('text')
            )
            ->column(
                Database::createColumn('email_verified_at')
                    ->type('timestamp')
                    ->defaultValue(['NULL', 'const'])
            )
            ->column(
                Database::createColumn('token')
                    ->type('varchar')
                    ->size(255)
                    ->notNull()
            )
            ->addIndex([
                'name'    => 'primary',
                'type'    => 'primary',
                'columns' => ['id']
            ])
            ->addIndex([
                'name'    => 'mail',
                'type'    => 'unique',
                'columns' => ['email']
            ])
            ->addIndex([
                'name'    => 'username',
                'type'    => 'unique',
                'columns' => ['username']
            ])
            ->addIndex([
                'name'    => 'token',
                'type'    => 'unique',
                'columns' => ['token']
            ])
            ->collate('utf8_general_ci')
            ->engine('InnoDB')
            ->execute();
    }
}
