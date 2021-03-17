<?php

require '../vendor/autoload.php';
session_start();

if (!isset($_SESSION['load'])) {
    $_SESSION = [
        'load' => true,
        'username' => null,
        'authorize' => [
            'level1' => true,
            'level2' => false,
            'level3' => false
        ]
    ];
}

$repository = Dotenv\Repository\RepositoryBuilder::createWithDefaultAdapters()->make();
$dotenv = Dotenv\Dotenv::create($repository, '../');
$dotenv->load();
$dotenv->required(['DB_USERNAME', 'DB_PASSWORD', 'DB_NAME', 'DB_HOST', 'DB_PORT']);

require '../App/Router/routes.php';

/* WARNING Code non executé après l'appel à la route */
