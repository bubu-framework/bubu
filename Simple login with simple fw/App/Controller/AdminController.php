<?php
namespace App\Controller;

use App\Views\Page;

class AdminController
{
    public static function create()
    {
        if (!$_SESSION['authorize']['level3']) {
            (new Page)->show('error', 403, 'Vous n\'êtes pas autorisé à rentrer sur cette page.');
        } else {
            (new Page)->show('admin');
        }
    }

    public static function store()
    {
        if (!$_SESSION['authorize']['level3']) {
            (new Page)->show('error', 403, 'Vous n\'êtes pas autorisé à rentrer sur cette page.');
        }
    }
}
