<?php
namespace App\Controller;

use App\Views\Base;

class Admin
{
    public static function create()
    {
        if (!$_SESSION['authorize']['level3']) {
            Base::show('error', 403, 'Vous n\'êtes pas autorisé à rentrer sur cette page.');
        } else {
            Base::show('admin');
        }
    }

    public static function store()
    {
        if (!$_SESSION['authorize']['level3']) {
            Base::show('error', 403, 'Vous n\'êtes pas autorisé à rentrer sur cette page.');
        }
    }
}
