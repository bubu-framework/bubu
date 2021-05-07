<?php

require '../vendor/autoload.php';
use App\Database\Database;
session_start();

if (!isset($_SESSION['load'])) {
    $_SESSION = [
        'load' => true,
        'username' => null,
        'authorize' => [
            'level1' => false,
            'level2' => false,
            'level3' => false
        ]
    ];
}

$repository = Dotenv\Repository\RepositoryBuilder::createWithDefaultAdapters()->make();
$dotenv = Dotenv\Dotenv::create($repository, '../');
$dotenv->load();
$dotenv->required(['DB_USERNAME', 'DB_PASSWORD', 'DB_NAME', 'DB_HOST', 'DB_PORT']);

$GLOBALS['lang'] = json_decode(file_get_contents("../lang/fr.json"), true);

Database::createTable()
    ->name('Super')
    ->column(
        Database::createColumn('test')
            ->type('int')
            ->size(15)
            ->notNull()
            ->auto_increment()
            ->comments('A simple comment')
            ->build()
    )->column(
        Database::createColumn('test2')
            ->type('int')
            ->build()
    )->column(
        Database::createColumn('abc')
            ->type('varchar')
            ->size(50)
            ->build()
    )
    ->addIndex(
        [
            'name' => 'index1',
            'type' => 'unique',
            'column' => [
                'test',
                'abc'
            ]
        ]
    )
    ->ifNotExists()
    ->build();
