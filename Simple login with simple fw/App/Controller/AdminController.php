<?php
namespace App\Controller;

use App\Views\Page;

class AdminController
{
    /**
     * @return never
     */
    public static function create()
    {
        if (!$_SESSION['authorize']['level3']) {
            (new Page)->show('error', 403, $GLOBALS['lang']['unauthorize']);
        } else {
            (new Page)->show('admin');
        }
    }

    public static function store()
    {
        if (!$_SESSION['authorize']['level3']) {
            (new Page)->show('error', 403, $GLOBALS['lang']['unauthorize']);
        }
    }
}
