<?php
namespace App\Controller;

use App\Views\Base;

class ChallengesController
{
    public static function create()
    {
        if ($_SESSION['authorize']['level2']) {
            Base::show('challenges');
        } else {
            var_dump($_SESSION);
        }
    }

    public static function store()
    {
        if (!$_SESSION['authorize']['level2']) {
            Base::show('challenges');
        }
    }
}
