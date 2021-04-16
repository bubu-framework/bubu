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

if ($_ENV['LANG'] === 'auto') {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $acceptLang = explode(',', $_ENV['SUPPORTED_LANGUAGES']); 
    $lang = in_array($lang, $acceptLang) ? $lang : 'fr';
} else {
    $lang = $_ENV['LANG'];
}

$GLOBALS['lang'] = json_decode(file_get_contents("../lang/{$lang}.json"), true);

require '../App/Router/routes.php';

/* WARNING Code non executé après l'appel à la route */
