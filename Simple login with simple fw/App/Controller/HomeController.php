<?php
namespace App\Controller;

use App\Views\Base;

class Home
{
    public static function create()
    {
        if (!$_SESSION['authorize']['level1']) {
            Base::show('error', 403, 'Vous n\'êtes pas autorisé à rentrer sur cette page.');
        } else {
            Base::show('home');
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
