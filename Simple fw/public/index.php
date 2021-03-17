<?php

session_start();

if (!isset($_SESSION['load'])) {
    $_SESSION = [
        'load' => true,
        'authorize' => [
            'level1' => false,
            'level2' => false
        ]
    ];
}

require '../vendor/autoload.php';

require '../App/routes.php';

/* WARNING Code non executé après l'appel à la route */
