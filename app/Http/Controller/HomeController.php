<?php

namespace App\Http\Controller;

use Bubu\View\View;

class HomeController
{
    public static function create()
    {
        (new View)->show('home');
    }
}
