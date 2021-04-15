<?php
namespace App\Controller;

use App\Views\Page;

class HomeController
{
    public static function create()
    {
        if (!$_SESSION['authorize']['level1']) {
            (new Page)->show('error', 403, 'Vous n\'êtes pas autorisé à rentrer sur cette page.');
        } else {
            (new Page)->show('home');
        }
    }

    public static function logout()
    {
        $_SESSION['load'] = false;
        session_reset();
        session_unset();
        session_destroy();
        header('Location: /');
        exit('Déconnecté');
    }
}
