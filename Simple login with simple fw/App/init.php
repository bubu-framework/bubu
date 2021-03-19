<?php

$repository = Dotenv\Repository\RepositoryBuilder::createWithDefaultAdapters()->make();
$dotenv = Dotenv\Dotenv::create($repository, '../');
$dotenv->load();
$dotenv->required([
    'DB_USERNAME',
    'DB_PASSWORD',
    'DB_NAME',
    'DB_HOST',
    'DB_PORT',
    'SESSION_DURATION'
]);

ini_set('session.gc_maxlifetime', $_ENV['SESSION_DURATION']*60*60*24);