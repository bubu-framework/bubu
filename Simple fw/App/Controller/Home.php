<?php
namespace App\Controller;

use App\Views\Base;

class Home
{
    public static function create()
    {
        if (!$_SESSION['authorize']['level1']) {
            Base::show('error', 403, 'Vous n\'êtes pas autoriser à rentrer sur cette page.');
        } else {
            Base::show('error', null, 'Super!');
        }
    }

    public static function store()
    {
        if (!$_SESSION['authorize']['level1']) {
            Base::show('error', 403, 'Vous n\'êtes pas autoriser à rentrer sur cette page.');
        }
    }
}
